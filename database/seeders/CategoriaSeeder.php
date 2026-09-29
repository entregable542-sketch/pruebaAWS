<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Electrónica', 'descripcion' => 'Productos electrónicos y dispositivos'],
            ['nombre' => 'Alimentos', 'descripcion' => 'Alimentos y bebidas'],
            ['nombre' => 'Ropa', 'descripcion' => 'Vestimenta y accesorios'],
            ['nombre' => 'Hogar', 'descripcion' => 'Artículos para el hogar'],
            ['nombre' => 'Deportes', 'descripcion' => 'Artículos deportivos y recreación'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
