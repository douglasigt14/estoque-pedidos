<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Produto;

class UpdateProdutoQuantidadeToJson extends Command
{
    protected $signature = 'update:produto-quantidade-json';
    protected $description = 'Atualiza o campo quantidade de todos os produtos para a estrutura JSON';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Estrutura JSON padrão
        $defaultQuantidade = [
            'RN' => 0,
            'P' => 0,
            'M' => 0,
            'G' => 0,
            'GG' => 0
        ];

        // Atualizar todos os produtos
        Produto::query()->update(['quantidade' => json_encode($defaultQuantidade)]);

        $this->info('Todos os registros do model Produto foram atualizados para a nova estrutura JSON.');
    }
}

