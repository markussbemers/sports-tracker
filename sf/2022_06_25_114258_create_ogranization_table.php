<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ogranization', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 50)->unique;
            $table->foreign('ogranization_leader')->references('id')->on('ogranization_leader');
            $table->foreign('sports_type')->references('id')->on('sports_type');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ogranization');
    }
};
