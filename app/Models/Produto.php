<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
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
        'imagem',
        'unidade_medida',
        'quantidade_minima',
        'preco_unitario',
    ];

    protected $casts = [
        'categorias' => 'array'
    ];

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'produtos_categorias', 'id_produto', 'id_categoria');
    }

}
