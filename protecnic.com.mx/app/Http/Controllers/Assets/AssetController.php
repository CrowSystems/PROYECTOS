<?php

namespace App\Http\Controllers\Assets;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AssetController extends Controller
{
    /**
     * Listado principal de equipos con filtros (tipo + estatus + búsqueda).
     * Aquí también se preparan las listas usadas por el modal de asignación.
     */
    public function index(Request $request)
    {
        $query = Asset::with(['type', 'currentAssignment.user']);

        // Filtros
        if ($request->filled('type_id')) {
            $query->where('asset_type_id', $request->type_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('q')) {
            $term = '%'.$request->q.'%';
            $query->where(function ($q) use ($term) {
                $q->where('code', 'like', $term)
                  ->orWhere('brand', 'like', $term)
                  ->orWhere('model', 'like', $term)
                  ->orWhere('serial_number', 'like', $term)
                  ->orWhere('service_tag', 'like', $term)
                  ->orWhere('location', 'like', $term);
            });
        }

        $assets = $query->orderBy('code')->paginate(15)->withQueryString();

        // Datos para el modal de asignación rápida
        $availableAssets = Asset::available()->with('type')->orderBy('code')->get();
        $usersWithoutEquipment = User::query()
            ->where('active', true)
            ->whereDoesntHave('currentAssetAssignments')
            ->orderBy('name')
            ->get();

        return view('assets.index', [
            'assets'                => $assets,
            'types'                 => AssetType::active()->orderBy('name')->get(),
            'statuses'              => Asset::STATUSES,
            'availableAssets'       => $availableAssets,
            'usersWithoutEquipment' => $usersWithoutEquipment,
            'filters'               => $request->only(['type_id', 'status', 'q']),
        ]);
    }

    public function create()
    {
        return view('assets.create', [
            'asset'    => new Asset(),
            'types'    => AssetType::active()->orderBy('name')->get(),
            'statuses' => Asset::STATUSES,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateAsset($request);
        Asset::create($data);

        return redirect()->route('assets.index')->with('success', 'Equipo registrado.');
    }

    public function edit(Asset $asset)
    {
        return view('assets.edit', [
            'asset'    => $asset,
            'types'    => AssetType::active()->orderBy('name')->get(),
            'statuses' => Asset::STATUSES,
        ]);
    }

    public function update(Request $request, Asset $asset)
    {
        $data = $this->validateAsset($request, $asset);
        $asset->update($data);

        return redirect()->route('assets.index')->with('success', 'Equipo actualizado.');
    }

    public function destroy(Asset $asset)
    {
        if ($asset->isAssigned()) {
            return back()->with('error', 'El equipo está asignado. Libéralo antes de eliminar.');
        }

        $asset->delete();
        return back()->with('success', 'Equipo eliminado del inventario.');
    }

    // ---------------- helpers ----------------

    protected function validateAsset(Request $request, ?Asset $asset = null): array
    {
        return $request->validate([
            'code'                => ['required', 'string', 'max:50',
                                      Rule::unique('assets', 'code')->ignore($asset?->id)->whereNull('deleted_at')],
            'asset_type_id'       => ['required', 'exists:asset_types,id'],
            'brand'               => ['nullable', 'string', 'max:100'],
            'model'               => ['nullable', 'string', 'max:100'],
            'cost'                => ['nullable', 'numeric', 'min:0'],
            'serial_number'       => ['nullable', 'string', 'max:100'],
            'service_tag'         => ['nullable', 'string', 'max:100'],
            'processor'           => ['nullable', 'string', 'max:120'],
            'ram'                 => ['nullable', 'string', 'max:50'],
            'disk'                => ['nullable', 'string', 'max:80'],
            'operating_system'    => ['nullable', 'string', 'max:80'],
            'mac_ethernet'        => ['nullable', 'string', 'max:32'],
            'mac_wifi'            => ['nullable', 'string', 'max:32'],
            'location'            => ['nullable', 'string', 'max:120'],
            'notes'               => ['nullable', 'string'],
            'registered_at'       => ['nullable', 'date'],
            'last_maintenance_at' => ['nullable', 'date'],
            'status'              => ['required', Rule::in(array_keys(Asset::STATUSES))],
        ]);
    }
}
