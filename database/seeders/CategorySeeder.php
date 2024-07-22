<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = new Category();

        $data = [

            ['name' => 'Juguetes', 'description' => 'juguetes para personas de todas las edades.'],
            ['name' => 'Deporte', 'description' => 'Elementos deportivos para practicar tu disciplina.'],
            ['name' => 'Vestuario', 'description' => 'Prendas de vistirpara todas las personas de todas las edades.'],
            ['name' => 'Alimentos', 'description' => 'Todo tipo de alimentos.'],

        ];

        $category->insert($data);
    }
}
