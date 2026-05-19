@extends('layouts.app')
@section('title', 'Productos')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Productos / Artículos</h1>
    <a href="{{ route('content.products.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">+ Nuevo producto</a>
</div>
<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-left">
            <tr>
                <th class="px-4 py-3">Imagen</th>
                <th class="px-4 py-3">Nombre</th>
                <th class="px-4 py-3">SKU</th>
                <th class="px-4 py-3">Marca</th>
                <th class="px-4 py-3">Tipo</th>
                <th class="px-4 py-3">Precio</th>
                <th class="px-4 py-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr class="border-t">
                <td class="px-4 py-3">
                    @if($p->image_path)<img src="{{ asset('storage/'.$p->image_path) }}" class="w-12 h-12 object-cover rounded">@else <span class="text-slate-400">—</span> @endif
                </td>
                <td class="px-4 py-3 font-medium">{{ $p->name }}</td>
                <td class="px-4 py-3 text-slate-600">{{ $p->sku }}</td>
                <td class="px-4 py-3">{{ $p->brand?->name }}</td>
                <td class="px-4 py-3">{{ $p->product_type }}</td>
                <td class="px-4 py-3">${{ number_format((float)$p->price, 2) }}</td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('content.products.edit', $p) }}" class="text-blue-600 hover:underline">Editar</a>
                    <form action="{{ route('content.products.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline ml-2">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $products->links() }}</div>
@endsection
