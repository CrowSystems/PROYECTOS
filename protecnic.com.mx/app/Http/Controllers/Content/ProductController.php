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
        $data = $this->validateData($request);
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }
        Product::create($data);
        return redirect()->route('content.products.index')->with('success', 'Producto creado.');
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
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['nullable', 'string', 'max:120'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'product_type' => ['nullable', 'string', 'max:120'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]) + ['active' => (bool)$r->input('active', false)];
    }
}
