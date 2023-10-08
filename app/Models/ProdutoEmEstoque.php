<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoEmEstoque extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = "produtos_em_estoques";

    protected $fillable = [
        'id_produto',
        'id_estoque',
        'quantidade',
        'valor_pago'
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'id_produto');
    }

    public function estoque()
    {
        return $this->belongsTo(Estoque::class, 'id_estoque');
    }

}
