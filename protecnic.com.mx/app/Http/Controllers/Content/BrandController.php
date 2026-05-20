<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Devuelve un mensaje legible cuando el upload no es válido.
     * Acepta el objeto crudo de Symfony (que SÍ existe aunque haya fallado).
     */
    protected function uploadErrorMessage($file): string
    {
        $messages = [
            UPLOAD_ERR_INI_SIZE   => 'El archivo excede el límite "upload_max_filesize" de php.ini.',
            UPLOAD_ERR_FORM_SIZE  => 'El archivo excede el MAX_FILE_SIZE del formulario.',
            UPLOAD_ERR_PARTIAL    => 'El archivo se subió de forma parcial. Reintenta.',
            UPLOAD_ERR_NO_FILE    => 'No se recibió ningún archivo.',
            UPLOAD_ERR_NO_TMP_DIR => 'PHP no tiene carpeta temporal accesible. Verifica "upload_tmp_dir" en php.ini (CÓDIGO 6).',
            UPLOAD_ERR_CANT_WRITE => 'PHP no puede escribir en disco. Verifica permisos del directorio temporal (CÓDIGO 7).',
            UPLOAD_ERR_EXTENSION  => 'Una extensión de PHP detuvo la subida (CÓDIGO 8).',
        ];

        $code = method_exists($file, 'getError') ? $file->getError() : -1;

        Log::warning('Upload fallido', [
            'controller' => static::class,
            'code'       => $code,
            'name'       => method_exists($file, 'getClientOriginalName') ? $file->getClientOriginalName() : null,
        ]);

        return ($messages[$code] ?? "Error de upload desconocido (código {$code}).");
    }

    public function index()
    {
        $brands = Brand::orderBy('name')->paginate(15);
        return view('content.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('content.brands.create', ['brand' => new Brand()]);
    }

    public function store(Request $request)
    {
        $rawLogo = $request->files->get('logo');
        if ($rawLogo && ! $rawLogo->isValid()) {
            return back()->withInput()->withErrors(['logo' => $this->uploadErrorMessage($rawLogo)]);
        }

        $data = $this->validateData($request);

        if ($request->hasFile('logo')) {
            $data = array_merge($data, $this->extractLogoData($request->file('logo')));
        }

        Brand::create($data);
        return redirect()->route('content.brands.index')->with('success', 'Marca creada.');
    }

    public function edit(Brand $brand)
    {
        return view('content.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $rawLogo = $request->files->get('logo');
        if ($rawLogo && ! $rawLogo->isValid()) {
            return back()->withInput()->withErrors(['logo' => $this->uploadErrorMessage($rawLogo)]);
        }

        $data = $this->validateData($request);

        if ($request->hasFile('logo')) {
            // Borrar archivo viejo si existía (la BD se sobreescribe automáticamente)
            if ($brand->logo_path) {
                try { Storage::disk('public')->delete($brand->logo_path); } catch (\Throwable $e) {}
            }
            $data = array_merge($data, $this->extractLogoData($request->file('logo')));
        }

        $brand->update($data);
        return redirect()->route('content.brands.index')->with('success', 'Marca actualizada.');
    }

    /**
     * Lee la imagen subida y devuelve el array con los 3 campos:
     *   logo_data (binario para BD), logo_mime (tipo MIME), logo_path (ruta en storage si se logró).
     * Si el filesystem falla, igual guardamos la imagen en la BD — así nunca queda invisible.
     */
    protected function extractLogoData(\Illuminate\Http\UploadedFile $file): array
    {
        // 1) Leemos el binario ANTES de mover el archivo (la operación move/store invalida el tmp).
        $binary = @file_get_contents($file->getRealPath());
        $mime   = $file->getClientMimeType();

        if ($binary === false) {
            Log::warning('No se pudo leer el binario del logo', ['name' => $file->getClientOriginalName()]);
            return [];
        }

        $out = [
            'logo_data' => $binary,
            'logo_mime' => $mime,
        ];

        // 2) Intentamos también guardar el archivo (es opcional ahora; la BD ya tiene la copia).
        try {
            $path = $file->store('brands', 'public');
            if ($path) {
                $out['logo_path'] = $path;
            }
        } catch (\Throwable $e) {
            Log::warning('No se pudo guardar el logo en storage (la BD sí lo tiene)', ['msg' => $e->getMessage()]);
        }

        return $out;
    }

    public function destroy(Brand $brand)
    {
        if ($brand->logo_path) Storage::disk('public')->delete($brand->logo_path);
        $brand->delete();
        return back()->with('success', 'Marca eliminada.');
    }

    private function validateData(Request $r): array
    {
        $data = $r->validate([
            'name'             => ['required', 'string', 'max:255'],
            'description'      => ['nullable', 'string'],
            'website_url'      => ['nullable', 'url', 'max:255'],
            'active'           => ['nullable', 'boolean'],
            'show_in_carousel' => ['nullable', 'boolean'],
            'carousel_order'   => ['nullable', 'integer', 'min:0', 'max:9999'],
            // Hasta 5 MB y aceptamos formatos comunes incluyendo SVG (logos vectoriales)
            'logo' => ['nullable', 'file', 'mimes:jpeg,jpg,png,gif,svg,webp', 'max:5120'],
        ], [
            'logo.uploaded' => 'No se pudo subir el logo. Revisa el tamaño máximo de PHP (upload_max_filesize en php.ini).',
            'logo.mimes'    => 'El logo debe ser un archivo JPG, PNG, GIF, SVG o WebP.',
            'logo.max'      => 'El logo no puede pesar más de 5 MB.',
        ]);

        $data['active']           = (bool) $r->input('active', false);
        $data['show_in_carousel'] = (bool) $r->input('show_in_carousel', false);
        $data['carousel_order']   = (int)  $r->input('carousel_order', 0);

        return $data;
    }
}
