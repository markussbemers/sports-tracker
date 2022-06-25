<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\AppUser;
use App\Models\Team;

class TeamPlayer extends Model
{
    use HasFactory;

    // to allow mass assignment of these fields
    protected $fillable = ['is_default_attending'];

    public function teams() {
        return $this->belongsTo(Team::class);
    }

    public function app_users() {
        return $this->belongsTo(AppUser::class);
    }
}
