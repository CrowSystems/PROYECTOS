<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TechnicianController extends Controller
{
    public function index()
    {
        $technicians = User::where('role', User::ROLE_TECHNICIAN)
            ->withCount('reports')
            ->orderBy('name')->paginate(15);
        return view('supervisor.technicians.index', compact('technicians'));
    }

    public function create()
    {
        return view('supervisor.technicians.create', ['technician' => new User()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'password' => ['required', 'string', 'min:6'],
        ]);
        $data['password'] = Hash::make($data['password']);
        $data['role'] = User::ROLE_TECHNICIAN;
        $data['active'] = true;
        User::create($data);
        return redirect()->route('supervisor.technicians.index')->with('success', 'Técnico creado.');
    }

    public function edit(User $technician)
    {
        abort_if($technician->role !== User::ROLE_TECHNICIAN, 404);
        return view('supervisor.technicians.edit', compact('technician'));
    }

    public function update(Request $request, User $technician)
    {
        abort_if($technician->role !== User::ROLE_TECHNICIAN, 404);
        $data = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($technician->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'password' => ['nullable', 'string', 'min:6'],
            'active' => ['nullable', 'boolean'],
        ]);
        if (!empty($data['password'])) $data['password'] = Hash::make($data['password']);
        else unset($data['password']);
        $data['active'] = (bool)($data['active'] ?? false);
        $technician->update($data);
        return redirect()->route('supervisor.technicians.index')->with('success', 'Técnico actualizado.');
    }

    public function destroy(User $technician)
    {
        abort_if($technician->role !== User::ROLE_TECHNICIAN, 404);
        $technician->update(['active' => false]);
        return back()->with('success', 'Técnico desactivado.');
    }
}
