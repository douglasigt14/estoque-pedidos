<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $visible = [
        'id', 'nome', 'descricao', 'quantidade', 'preco','preco_revenda'
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
