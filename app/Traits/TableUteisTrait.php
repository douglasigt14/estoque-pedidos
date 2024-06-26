<?php
namespace App\Traits;

trait TableUteisTrait
{
    public function getCamposCentralizados()
    {
        if (property_exists($this, 'camposCentralizados')) {
            return $this->camposCentralizados;
        }
        return [];
    }

    public function getNomesCampos()
    {
        if (property_exists($this, 'nomesCampos')) {
            return $this->nomesCampos;
        }
        return [];
    }

    public function getField($campo)
    {
        $nomesCampos = $this->getNomesCampos();
        return $nomesCampos[$campo] ?? $campo;
    }

    public function deveCentralizarCampo($campo)
    {
        $camposCentralizados = $this->getCamposCentralizados();
        return in_array($campo, $camposCentralizados);
    }
}


