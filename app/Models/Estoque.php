<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_at',
    ];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'produtos_em_estoque', 'id_estoque', 'id_produto');
    }



}
