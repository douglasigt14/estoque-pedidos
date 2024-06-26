<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = [];
    
    protected $visible = [
        'id', 'nome', 'preco','preco_revenda','descricao'
    ];

    protected $casts = [
        'quantidade' => 'array',
    ];

    protected $camposCentralizados = [
        'quantidade', 'preco', 'preco_revenda'
    ];

    protected $nomesCampos = [
        'quantidade' => 'Qtd',
        'preco' => 'Preço',
        'preco_revenda' => 'Revenda',
    ];

    public function getField($campo)
    {
        return $this->nomesCampos[$campo] ?? $campo;
    }

    public function deveCentralizarCampo($campo)
    {
        return in_array($campo, $this->camposCentralizados);
    }
}
