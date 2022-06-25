<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Coach;
use App\Models\TeamPlayer;
use App\Models\OrganizationLeader;
use App\Models\TeamPlayerAttendenceTraining;

class AppUser extends Model {

    use HasFactory;

    // to allow mass assignment of these fields
    protected $fillable = ['name'];

    public function coaches() {
        return $this->hasMany(Coach::class);
    }

    public function team_players() {
        return $this->hasMany(TeamPlayer::class);
    }

    public function organization_leaders() {
        return $this->hasMany(OrganizationLeader::class);
    }

    public function team_player_attendence_trainings() {
        return $this->hasMany(TeamPlayerAttendenceTraining::class);
    }
}
