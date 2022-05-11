<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('address_id');
            $table->string('vri_id')->unique();

            $table->string('registration_type_number');
            $table->string('modification_name');
            $table->string('factory_number');

            $table->unsignedInteger('release_year');

            $table->date('verification_date');
            $table->date('valid_until');

            $table->boolean('is_valid');

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
        Schema::dropIfExists('counters');
    }
}
