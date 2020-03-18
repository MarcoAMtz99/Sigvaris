<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPacientesExpedienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes_expediente', function (Blueprint $table) {
            //
            $table->string('receta')->nullable();
            $table->string('identificacion')->nullable();
            $table->string('inapam')->nullable();

        });
    }

    
}
