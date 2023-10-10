<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'imagem',
        'unidade_medida',
        'quantidade_minima',
        'preco_unitario',
        'updated_at'
    ];

    protected $casts = [
        'categorias' => 'array'
    ];

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'produtos_categorias', 'id_produto', 'id_categoria');
    }

    public function estoques()
    {
        return $this->belongsToMany(Estoque::class, 'produtos_em_estoques', 'id_produto', 'id_estoque');
    }

    public function produtosEmEstoques()
    {
        return $this->hasMany(ProdutoEmEstoque::class, 'id_produto', 'id');
    }
}
