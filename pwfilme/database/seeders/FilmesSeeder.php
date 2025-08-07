<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('filmes')->insert([
            [
                'nome' => 'Interestelar',
                'sinopse' => 'Um grupo de exploradores viaja através de um buraco de minhoca no espaço em uma tentativa de garantir a sobrevivência da humanidade.',
                'ano' => 2014,
                'categoria' => 'Ficção Científica',
                'imagem' => 'interestelar.jpg',
                'trailer' => 'https://www.youtube.com/watch?v=zSWdZVtXT7E',
            ],
            [
                'nome' => 'A Origem',
                'sinopse' => 'Um ladrão que invade os sonhos das pessoas para roubar segredos corporativos recebe a missão de implantar uma ideia na mente de um CEO.',
                'ano' => 2010,
                'categoria' => 'Ação',
                'imagem' => 'a_origem.jpg',
                'trailer' => 'https://www.youtube.com/watch?v=YoHD9XEInc0',
            ],
            [
                'nome' => 'O Poderoso Chefão',
                'sinopse' => 'A saga da família mafiosa Corleone, liderada pelo patriarca Don Vito Corleone.',
                'ano' => 1972,
                'categoria' => 'Drama',
                'imagem' => 'poderoso_chefao.jpg',
                'trailer' => 'https://www.youtube.com/watch?v=sY1S34973zA',
            ],
        ]);
    }
}
