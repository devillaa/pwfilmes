<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            ['nome' => 'Ação'],
            ['nome' => 'Comédia'],
            ['nome' => 'Drama'],
            ['nome' => 'Terror'],
            ['nome' => 'Ficção Científica'],
            ['nome' => 'Romance'],
            ['nome' => 'Animação'],
            ['nome' => 'Documentário'],
        ]);
    }
}
