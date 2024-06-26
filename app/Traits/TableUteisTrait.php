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

    public function getNameFields()
    {
        if (property_exists($this, 'nameFields')) {
            return $this->nameFields;
        }
        return [];
    }


    public function getHideFields()
    {
        if (property_exists($this, 'hideFields')) {
            return $this->hideFields;
        }
        return [];
    }

    public function getField($field)
    {
        $nameFields = $this->getNameFields();
        return $nameFields[$field] ?? $field;
    }

    public function isCenterField($field)
    {
        $camposCentralizados = $this->getCamposCentralizados();
        return in_array($field, $camposCentralizados);
    }

    public function isHideField($campo)
    {
        $hideFields = $this->getHideFields();
        return in_array($campo, $hideFields);
    }
}


