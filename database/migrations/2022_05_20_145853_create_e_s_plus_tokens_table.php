<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateESPlusTokensTable extends Migration
{
    public function up()
    {
        Schema::create('e_s_plus_tokens', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()
                ->cascadeOnUpdate()->cascadeOnDelete();

//            $table->string('access_token');
            $table->text('refresh_token');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('e_s_plus_tokens');
    }
}
