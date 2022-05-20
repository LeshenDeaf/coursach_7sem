<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainNumberTable extends Migration
{
    public function up()
    {
        Schema::create('main_number', function (Blueprint $table) {
            $table->id();

            $table->foreignId('address_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('main_number');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('esplus');
    }
}
