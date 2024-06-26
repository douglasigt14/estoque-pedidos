<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeQuantidadeToJsonInProdutosTable extends Migration
{
    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->json('qtd')->change();
        });
    }

    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->integer('qtd')->change(); // Ajuste para seu tipo original se necessário
        });
    }
}
