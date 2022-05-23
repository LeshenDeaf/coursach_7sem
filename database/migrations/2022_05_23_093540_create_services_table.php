<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->foreignId('main_number_id');
            $table->bigInteger('es_id');
            $table->string('code');
            $table->string('name');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
}
