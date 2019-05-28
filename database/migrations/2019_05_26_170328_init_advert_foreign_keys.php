<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitAdvertForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adverts', function (Blueprint $table) {

            $table->bigInteger('mark_id')
                ->nullable(false)
                ->unsigned();

            $table->foreign('mark_id')
                ->references('id')
                ->on('marks')
                ->onDelete('cascade');

            $table->bigInteger('engine_id')
                ->nullable(false)
                ->unsigned();

            $table->foreign('engine_id')
                ->references('id')
                ->on('engines')
                ->onDelete('cascade');

            $table->bigInteger('transmission_id')
                ->nullable(false)
                ->unsigned();

            $table->foreign('transmission_id')
                ->references('id')
                ->on('transmissions')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
