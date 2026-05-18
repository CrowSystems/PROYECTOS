<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramAdminController extends Controller
{
    public function index()
    {
        $programs = Program::orderBy('order')->paginate(15);
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create', ['program' => new Program()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('programs', 'public');
        }
        Program::create($data);

        return redirect()
            ->route('admin.programs.index')
            ->with('success', 'Programa creado correctamente.');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('programs', 'public');
        }
        $program->update($data);

        return redirect()
            ->route('admin.programs.index')
            ->with('success', 'Programa actualizado.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return back()->with('success', 'Programa eliminado.');
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            'title'        => ['required', 'string', 'max:160'],
            'summary'      => ['required', 'string', 'max:300'],
            'description'  => ['required', 'string'],
            'image'        => ['nullable', 'image', 'max:4096'],
            'order'        => ['nullable', 'integer', 'min:0'],
            'is_active'    => ['nullable', 'boolean'],
            'is_featured'  => ['nullable', 'boolean'],
        ]) + [
            'is_active'   => $request->boolean('is_active'),
            'is_featured' => $request->boolean('is_featured'),
            'order'       => (int) $request->input('order', 0),
        ];
    }
}
