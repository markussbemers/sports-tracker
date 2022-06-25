<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\AppUser;
use App\Models\Training;

class TeamPlayerAttendenceTraining extends Model {

    use HasFactory;

    // to allow mass assignment of these fields
    protected $fillable = [];

    public function app_users() {
        return $this->belongsTo(AppUser::class);
    }

    public function training() {
        return $this->belongsTo(Training::class);
    }
}
