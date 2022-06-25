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
        Schema::create('team_player', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('is_default_attending')->default(0)->change();
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('team_id')->references('id')->on('team');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_player');
    }
};
