<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Movimiento;
use App\Models\Producto;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalProductos = Producto::count();
        $totalCategorias = Categoria::count();
        $productosStockBajo = Producto::whereColumn('stock', '<=', 'stock_minimo')->count();
        $ultimosMovimientos = Movimiento::with(['producto', 'user'])
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact(
            'totalProductos',
            'totalCategorias',
            'productosStockBajo',
            'ultimosMovimientos'
        ));
    }
}
