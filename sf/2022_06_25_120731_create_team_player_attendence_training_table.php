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
        Schema::create('team_player_attendence_training', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('will_attend_training_id')->references('id')->on('training');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_player_attendence_training');
    }
};
