<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPagosigHistorialCambiosVenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historial_cambios_venta', function (Blueprint $table) {
            //
            $table->integer('pagosig')->nullable();
             $table->integer('pagosaldo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historial_cambios_venta', function (Blueprint $table) {
            //
             $table->dropColumn('pagosig');
              $table->dropColumn('pagosaldo');
        });
    }
}
