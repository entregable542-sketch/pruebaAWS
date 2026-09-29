@extends('layout')

@section('title', 'Nuevo Movimiento - Sistema de Almacén')

@section('content')
<div class="px-4 py-6 sm:px-0">
    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Nuevo Movimiento</h1>

    <div class="bg-white shadow rounded-lg p-6 max-w-2xl">
        <form action="{{ route('movimientos.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="producto_id" class="block text-sm font-medium text-gray-700 mb-1">Producto</label>
                <select name="producto_id" id="producto_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Seleccionar producto</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                            {{ $producto->nombre }} (Stock: {{ $producto->stock }})
                        </option>
                    @endforeach
                </select>
                @error('producto_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Movimiento</label>
                <select name="tipo" id="tipo" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Seleccionar tipo</option>
                    <option value="entrada" {{ old('tipo') == 'entrada' ? 'selected' : '' }}>Entrada</option>
                    <option value="salida" {{ old('tipo') == 'salida' ? 'selected' : '' }}>Salida</option>
                </select>
                @error('tipo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="cantidad" class="block text-sm font-medium text-gray-700 mb-1">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" min="1" value="{{ old('cantidad') }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('cantidad')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="motivo" class="block text-sm font-medium text-gray-700 mb-1">Motivo</label>
                <textarea name="motivo" id="motivo" rows="3" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('motivo') }}</textarea>
                @error('motivo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('movimientos.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                    Registrar Movimiento
                </button>
            </div>
        </form>
    </div>
</div>
