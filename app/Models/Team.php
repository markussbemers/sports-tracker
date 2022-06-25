<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\TeamPlayer;
use App\Models\Coach;
use App\Models\Organization;
use App\Models\Training;

class Team extends Model {

    use HasFactory;

    // to allow mass assignment of these fields
    protected $fillable = ['name'];

    public function team_players() {
        return $this->hasMany(TeamPlayer::class);
    }

    public function training() {
        return $this->hasMany(Training::class);
    }

    public function coaches() {
        return $this->belongsTo(Coach::class);
    }

    public function organizations() {
        return $this->belongsTo(Organization::class);
    }
}
