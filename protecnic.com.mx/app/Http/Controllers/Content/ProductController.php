<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('brand')->orderBy('name')->paginate(15);
        return view('content.products.index', compact('products'));
    }

    public function create()
    {
        return view('content.products.create', [
            'product' => new Product(),
            'brands' => Brand::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image') && ! $request->file('image')->isValid()) {
            return back()->withInput()->withErrors([
                'image' => $this->imageUploadError($request->file('image')),
            ]);
        }

        $data = $this->validateData($request);
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }
        Product::create($data);
        return redirect()->route('content.products.index')->with('success', 'Producto creado.');
    }

    protected function imageUploadError(\Illuminate\Http\UploadedFile $file): string
    {
        $codes = [
            UPLOAD_ERR_INI_SIZE   => 'El archivo excede upload_max_filesize de php.ini.',
            UPLOAD_ERR_FORM_SIZE  => 'El archivo excede MAX_FILE_SIZE del formulario.',
            UPLOAD_ERR_PARTIAL    => 'Subida parcial, reintenta.',
            UPLOAD_ERR_NO_FILE    => 'No se recibió ningún archivo.',
            UPLOAD_ERR_NO_TMP_DIR => 'PHP no tiene carpeta temporal. Verifica upload_tmp_dir.',
            UPLOAD_ERR_CANT_WRITE => 'PHP no puede escribir en el disco temporal.',
            UPLOAD_ERR_EXTENSION  => 'Una extensión PHP detuvo la subida.',
        ];
        return $codes[$file->getError()] ?? "Error de upload (código {$file->getError()}).";
    }

    public function edit(Product $product)
    {
        return view('content.products.edit', [
            'product' => $product,
            'brands' => Brand::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        if ($request->hasFile('image') && ! $request->file('image')->isValid()) {
            return back()->withInput()->withErrors([
                'image' => $this->imageUploadError($request->file('image')),
            ]);
        }

        $data = $this->validateData($request);
        if ($request->hasFile('image')) {
            if ($product->image_path) Storage::disk('public')->delete($product->image_path);
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }
        $product->update($data);
        return redirect()->route('content.products.index')->with('success', 'Producto actualizado.');
    }

    public function destroy(Product $product)
    {
        if ($product->image_path) Storage::disk('public')->delete($product->image_path);
        $product->delete();
        return back()->with('success', 'Producto eliminado.');
    }

    private function validateData(Request $r): array
    {
        return $r->validate([
            'name'         => ['required', 'string', 'max:255'],
            'sku'          => ['nullable', 'string', 'max:120'],
            'brand_id'     => ['nullable', 'exists:brands,id'],
            'product_type' => ['nullable', 'string', 'max:120'],
            'description'  => ['nullable', 'string'],
            'price'        => ['nullable', 'numeric', 'min:0'],
            'active'       => ['nullable', 'boolean'],
            'image'        => ['nullable', 'file', 'mimes:jpeg,jpg,png,gif,svg,webp', 'max:5120'],
        ], [
            'image.uploaded' => 'No se pudo subir la imagen. Revisa el límite de PHP (upload_max_filesize).',
            'image.mimes'    => 'La imagen debe ser JPG, PNG, GIF, SVG o WebP.',
            'image.max'      => 'La imagen no puede pesar más de 5 MB.',
        ]) + ['active' => (bool)$r->input('active', false)];
    }
}
