<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = new Product();

        $data = [

            ['name' => 'Pelota de Fútbol', 'description' => 'Pelota oficial de fútbol', 'quantity' => 1, 'category_id' => 1],
            ['name' => 'Muñeca de Plástico', 'description' => 'Muñeca para jugar', 'quantity' => 1, 'category_id' => 1],
            ['name' => 'Rompecabezas', 'description' => 'Rompecabezas de 100 piezas', 'quantity' => 1, 'category_id' => 1],
            ['name' => 'Raqueta de Tenis', 'description' => 'Raqueta profesional de tenis', 'quantity' => 1, 'category_id' => 2],
            ['name' => 'Balón de Baloncesto', 'description' => 'Balón oficial de baloncesto', 'quantity' => 1, 'category_id' => 2],
            ['name' => 'Guantes de Boxeo', 'description' => 'Guantes para boxeo', 'quantity' => 1, 'category_id' => 2],
            ['name' => 'Balón de Fútbol', 'description' => 'Balón oficial de fútbol', 'quantity' => 1, 'category_id' => 2],
            ['name' => 'Camisa de Vestir', 'description' => 'Camisa formal para hombres', 'quantity' => 1, 'category_id' => 3],
            ['name' => 'Gorra de Béisbol', 'description' => 'Gorra clásica de béisbol', 'quantity' => 1, 'category_id' => 3],
            ['name' => 'Chocolate Amargo', 'description' => 'Chocolate negro al 70%', 'quantity' => 1, 'category_id' => 4],
            ['name' => 'Café Orgánico', 'description' => 'Café en grano 100% orgánico', 'quantity' => 1, 'category_id' => 4],
            ['name' => 'Frutas Variadas', 'description' => 'Mezcla de frutas frescas', 'quantity' => 1, 'category_id' => 4],
            ['name' => 'Zumo de Naranja Natural', 'description' => 'Zumo recién exprimido', 'quantity' => 1, 'category_id' => 4],
            ['name' => 'Miel de Abeja', 'description' => 'Miel pura y natural', 'quantity' => 1, 'category_id' => 4],
            ['name' => 'Queso Fresco', 'description' => 'Queso fresco de vaca', 'quantity' => 1, 'category_id' => 4]

        ];

        $product->insert($data);
    }
}
