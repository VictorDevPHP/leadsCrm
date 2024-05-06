<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToAnunciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->unsignedBigInteger('id_meta')->nullable();
            $table->unsignedBigInteger('id_google')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->dropColumn('id_meta');
            $table->dropColumn('id_google');
        });
    }
}
