<?php

namespace App\Http\Controllers\Assets;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssetAssignmentController extends Controller
{
    /**
     * Asigna un activo disponible a un colaborador.
     * Recibe asset_id + user_id desde el modal del index.
     */
    public function assign(Request $request)
    {
        $data = $request->validate([
            'asset_id'         => ['required', 'exists:assets,id'],
            'user_id'          => ['required', 'exists:users,id'],
            'assignment_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $asset = Asset::findOrFail($data['asset_id']);

        if (! $asset->isAvailable()) {
            return back()->with('error', 'El equipo no está disponible para asignar.');
        }

        DB::transaction(function () use ($asset, $data) {
            AssetAssignment::create([
                'asset_id'         => $asset->id,
                'user_id'          => $data['user_id'],
                'assigned_by_id'   => auth()->id(),
                'assigned_at'      => now(),
                'assignment_notes' => $data['assignment_notes'] ?? null,
            ]);

            $asset->update(['status' => Asset::STATUS_ASSIGNED]);
        });

        return back()->with('success', 'Equipo asignado correctamente.');
    }

    /**
     * BAJA = liberar la asignación vigente.
     * Marca released_at = ahora y devuelve el equipo al pool "Disponible".
     */
    public function release(Request $request, Asset $asset)
    {
        $data = $request->validate([
            'release_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $assignment = $asset->currentAssignment;

        if (! $assignment) {
            return back()->with('error', 'El equipo no tiene una asignación vigente.');
        }

        DB::transaction(function () use ($assignment, $asset, $data) {
            $assignment->update([
                'released_at'    => now(),
                'released_by_id' => auth()->id(),
                'release_notes'  => $data['release_notes'] ?? null,
            ]);

            $asset->update(['status' => Asset::STATUS_AVAILABLE]);
        });

        return back()->with('success', 'Asignación liberada. El equipo quedó disponible.');
    }
}
