<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmeFavorito extends Model
{
    use HasFactory;

    protected $table = 'filme_favoritos';

    protected $fillable = [
        'user_id',
        'filme_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function filme()
    {
        return $this->belongsTo(Filme::class);
    }
}
