<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_form', function (Blueprint $table) {
            $table->integer('field_id')->unsigned();
            $table->integer('form_id')->unsigned();

            $table->foreign('field_id')->references('id')->on('fields')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('form_id')->references('id')->on('forms')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('field_form');
    }
}
