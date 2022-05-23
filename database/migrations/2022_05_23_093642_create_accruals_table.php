<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccrualsTable extends Migration
{
    public function up()
    {
        Schema::create('accruals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_id');

            $table->date('period');
            $table->float('accrued');
            $table->integer('current_data');
            $table->integer('consumption');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('accruals');
    }
}
