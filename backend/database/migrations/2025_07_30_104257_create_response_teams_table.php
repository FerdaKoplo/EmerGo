<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('response_teams', function (Blueprint $table) {
            $table->id();
            $table->string('emergency_type');
            $table->string('location');
            $table->string('number');
            $table->string('status');
            $table->string('category');
            $table->double('latitude');
            $table->double('longitude');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('response_teams');
    }
};