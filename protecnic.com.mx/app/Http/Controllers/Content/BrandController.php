<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
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
        $data = $this->validateData($request);
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
        return $r->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'active' => ['nullable', 'boolean'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]) + ['active' => (bool)$r->input('active', false)];
    }
}
