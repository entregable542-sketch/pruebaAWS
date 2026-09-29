<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MovimientoController extends Controller
{
    public function index(): View
    {
        $movimientos = Movimiento::with(['producto', 'user'])
            ->latest()
            ->paginate(15);

        return view('movimientos.index', compact('movimientos'));
    }

    public function create(): View
    {
        $productos = Producto::all();

        return view('movimientos.create', compact('productos'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'tipo' => 'required|in:entrada,salida',
            'cantidad' => 'required|integer|min:1',
            'motivo' => 'nullable|string',
        ]);

        $producto = Producto::findOrFail($validated['producto_id']);

        if ($validated['tipo'] === 'salida' && $producto->stock < $validated['cantidad']) {
            return back()->withErrors(['cantidad' => 'No hay stock suficiente para esta salida.'])->withInput();
        }

        Movimiento::create([
            'producto_id' => $validated['producto_id'],
            'tipo' => $validated['tipo'],
            'cantidad' => $validated['cantidad'],
            'motivo' => $validated['motivo'],
            'user_id' => Auth::id(),
        ]);

        $cambio = $validated['tipo'] === 'entrada' ? $validated['cantidad'] : -$validated['cantidad'];
        $producto->increment('stock', $cambio);

        return redirect()->route('movimientos.index')->with('success', 'Movimiento registrado correctamente.');
    }
}
