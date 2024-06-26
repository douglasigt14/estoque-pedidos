<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\TableUteisTrait;

class Produto extends Model
{
    use HasFactory, SoftDeletes, TableUteisTrait;

    protected $guarded = [];

    protected $visible = [
        'id', 'nome', 'preco', 'preco_revenda', 'descricao', 'cor'
    ];

    protected $camposCentralizados = [
        'preco', 'preco_revenda', 'cor','id'
    ];

    protected $nomesCampos = [
        'id' => 'COD',
        'quantidade' => 'Qtd',
        'preco' => 'Preço',
        'preco_revenda' => 'Revenda',
    ];
}

