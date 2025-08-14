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
                'categoria_id' => 5,
                'imagem' => 'https://tse1.mm.bing.net/th/id/OIP.ldq5ICa6Cc-dXr6Xez2dkQHaLH?rs=1&pid=ImgDetMain&o=7&rm=3',
                'trailer' => 'https://www.youtube.com/watch?v=zSWdZVtXT7E',
            ],
            [
                'nome' => 'A Origem',
                'sinopse' => 'Um ladrão que invade os sonhos das pessoas para roubar segredos corporativos recebe a missão de implantar uma ideia na mente de um CEO.',
                'ano' => 2010,
                'categoria_id' => 1,
                'imagem' => 'https://images.justwatch.com/poster/241712232/s718/a-origem.jpg',
                'trailer' => 'https://www.youtube.com/watch?v=YoHD9XEInc0',
            ],
            [
                'nome' => 'O Poderoso Chefão',
                'sinopse' => 'A saga da família mafiosa Corleone, liderada pelo patriarca Don Vito Corleone.',
                'ano' => 1972,
                'categoria_id' => 3,
                'imagem' => 'https://tse3.mm.bing.net/th/id/OIP.4NBQS9MvNNoryQqvAqMnuQHaKk?rs=1&pid=ImgDetMain&o=7&rm=3',
                'trailer' => 'https://www.youtube.com/watch?v=sY1S34973zA',
            ],
        ]);
    }
}
