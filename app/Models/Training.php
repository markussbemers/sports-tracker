<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\TeamPlayerAttendenceTraining;
use App\Models\Team;

class Training extends Model
{
    use HasFactory;

    // to allow mass assignment of these fields
    protected $fillable = ['start_date_and_time'];

    public function team_player_attendence_trainings() {
        return $this->hasMany(TeamPlayerAttendenceTraining::class);
    }

    public function team() {
        return $this->belongsTo(Team::class);
    }
}
