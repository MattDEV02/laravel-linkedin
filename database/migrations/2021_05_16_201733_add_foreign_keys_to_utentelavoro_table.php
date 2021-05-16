<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUtentelavoroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('utentelavoro', function (Blueprint $table) {
            $table->foreign('lavoro', 'LavoroUtenteFK')->references('id')->on('lavoro')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('utente', 'UtenteLavoroFK')->references('id')->on('utente')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('utentelavoro', function (Blueprint $table) {
            $table->dropForeign('LavoroUtenteFK');
            $table->dropForeign('UtenteLavoroFK');
        });
    }
}
