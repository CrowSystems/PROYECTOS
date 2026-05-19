<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MachineController extends Controller
{
    public function index()
    {
        $machines = Machine::with('brand')->orderBy('name')->paginate(15);
        return view('content.machines.index', compact('machines'));
    }

    public function create()
    {
        return view('content.machines.create', [
            'machine' => new Machine(),
            'brands' => Brand::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('machines', 'public');
        }
        Machine::create($data);
        return redirect()->route('content.machines.index')->with('success', 'Máquina creada.');
    }

    public function edit(Machine $machine)
    {
        return view('content.machines.edit', [
            'machine' => $machine,
            'brands' => Brand::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Machine $machine)
    {
        $data = $this->validateData($request);
        if ($request->hasFile('image')) {
            if ($machine->image_path) Storage::disk('public')->delete($machine->image_path);
            $data['image_path'] = $request->file('image')->store('machines', 'public');
        }
        $machine->update($data);
        return redirect()->route('content.machines.index')->with('success', 'Máquina actualizada.');
    }

    public function destroy(Machine $machine)
    {
        if ($machine->image_path) Storage::disk('public')->delete($machine->image_path);
        $machine->delete();
        return back()->with('success', 'Máquina eliminada.');
    }

    private function validateData(Request $r): array
    {
        return $r->validate([
            'name' => ['required', 'string', 'max:255'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'model' => ['nullable', 'string', 'max:120'],
            'serial' => ['nullable', 'string', 'max:120'],
            'description' => ['nullable', 'string'],
            'active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]) + ['active' => (bool)$r->input('active', false)];
    }
}
