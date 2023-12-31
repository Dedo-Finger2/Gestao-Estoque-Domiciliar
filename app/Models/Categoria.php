<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
    ];

    public function categorias()
    {
        return $this->belongsToMany(Produto::class, 'produtos_categorias', 'id_categoria', 'id_produto');
    }

}
