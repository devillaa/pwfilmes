<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'sinopse',
        'ano',
        'categoria_id',
        'imagem',
        'trailer',
        'tmdb_id',
        'avaliacao_media',
        'total_avaliacoes',
        'duracao',
        'diretor',
        'elenco'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function favoritos()
    {
        return $this->hasMany(FilmeFavorito::class);
    }

    public function favoritadoPor()
    {
        return $this->belongsToMany(User::class, 'filme_favoritos');
    }

    public function isFavoritadoPor($userId)
    {
        return $this->favoritadoPor()->where('user_id', $userId)->exists();
    }
}
