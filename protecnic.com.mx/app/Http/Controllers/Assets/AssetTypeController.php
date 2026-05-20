<?php

namespace App\Http\Controllers\Assets;

use App\Http\Controllers\Controller;
use App\Models\AssetType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AssetTypeController extends Controller
{
    public function index()
    {
        $types = AssetType::withCount('assets')->orderBy('name')->paginate(20);
        return view('assets.types.index', compact('types'));
    }

    public function create()
    {
        return view('assets.types.create', ['type' => new AssetType()]);
    }

    public function store(Request $request)
    {
        AssetType::create($this->validateType($request));
        return redirect()->route('assets.types.index')->with('success', 'Tipo de equipo creado.');
    }

    public function edit(AssetType $assetType)
    {
        return view('assets.types.edit', ['type' => $assetType]);
    }

    public function update(Request $request, AssetType $assetType)
    {
        $assetType->update($this->validateType($request, $assetType));
        return redirect()->route('assets.types.index')->with('success', 'Tipo de equipo actualizado.');
    }

    public function destroy(AssetType $assetType)
    {
        if ($assetType->assets()->exists()) {
            return back()->with('error', 'No se puede eliminar: hay equipos registrados con este tipo.');
        }
        $assetType->delete();
        return back()->with('success', 'Tipo de equipo eliminado.');
    }

    protected function validateType(Request $request, ?AssetType $type = null): array
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:80',
                              Rule::unique('asset_types', 'name')->ignore($type?->id)],
            'description' => ['nullable', 'string', 'max:500'],
            'icon'        => ['nullable', 'string', 'max:50'],
            'active'      => ['nullable', 'boolean'],
        ]);

        // Si no llegó (checkbox desmarcado sin hidden) asumimos activo en alta
        $data['active'] = (bool) ($data['active'] ?? ($type === null));

        return $data;
    }
}
