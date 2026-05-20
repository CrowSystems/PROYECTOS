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
        // Detección temprana de errores de PHP en el upload (códigos 1-8).
        // Usamos files->get() porque hasFile() oculta el archivo cuando falló el upload.
        $rawLogo = $request->files->get('logo');
        if ($rawLogo && ! $rawLogo->isValid()) {
            return back()->withInput()->withErrors(['logo' => $this->uploadErrorMessage($rawLogo)]);
        }

        $data = $this->validateData($request);

        // Para guardar usamos $request->file() (devuelve el wrapper de Laravel con ->store()).
        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('brands', 'public');
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
            if ($brand->logo_path) Storage::disk('public')->delete($brand->logo_path);
            $data['logo_path'] = $request->file('logo')->store('brands', 'public');
        }

        $brand->update($data);
        return redirect()->route('content.brands.index')->with('success', 'Marca actualizada.');
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
