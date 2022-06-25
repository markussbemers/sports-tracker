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
        Schema::create('team_player_attendence_trainings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('app_users_id')->constrained();
            $table->foreignId('training_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_player_attendence_trainings');
    }
};
