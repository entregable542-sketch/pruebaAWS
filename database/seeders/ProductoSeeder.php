<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = Categoria::all();

        $productos = [
            ['nombre' => 'Laptop HP', 'sku' => 'LAP-001', 'precio' => 899.99, 'stock' => 15, 'stock_minimo' => 5],
            ['nombre' => 'Mouse Inalámbrico', 'sku' => 'MOU-001', 'precio' => 29.99, 'stock' => 50, 'stock_minimo' => 10],
            ['nombre' => 'Teclado Mecánico', 'sku' => 'TEC-001', 'precio' => 79.99, 'stock' => 30, 'stock_minimo' => 8],
            ['nombre' => 'Monitor 24"', 'sku' => 'MON-001', 'precio' => 199.99, 'stock' => 20, 'stock_minimo' => 5],
            ['nombre' => 'Audífonos Bluetooth', 'sku' => 'AUD-001', 'precio' => 49.99, 'stock' => 40, 'stock_minimo' => 10],
            ['nombre' => 'Café Premium 1kg', 'sku' => 'CAF-001', 'precio' => 12.99, 'stock' => 100, 'stock_minimo' => 20],
            ['nombre' => 'Té Verde 50 bolsas', 'sku' => 'TE-001', 'precio' => 8.99, 'stock' => 80, 'stock_minimo' => 15],
            ['nombre' => 'Camiseta Algodón', 'sku' => 'CAM-001', 'precio' => 19.99, 'stock' => 60, 'stock_minimo' => 12],
            ['nombre' => 'Pantalón Jeans', 'sku' => 'PAN-001', 'precio' => 39.99, 'stock' => 45, 'stock_minimo' => 10],
            ['nombre' => 'Zapatos Deportivos', 'sku' => 'ZAP-001', 'precio' => 59.99, 'stock' => 35, 'stock_minimo' => 8],
        ];

        foreach ($productos as $index => $producto) {
            $producto['categoria_id'] = $categorias[$index % $categorias->count()]->id;
            $producto['descripcion'] = 'Descripción del producto '.$producto['nombre'];
            Producto::create($producto);
        }
    }
}
