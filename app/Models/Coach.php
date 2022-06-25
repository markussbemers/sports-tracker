<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\AppUser;
use App\Models\Teams;

class Coach extends Model {
    
    use HasFactory;

    // to allow mass assignment of these fields
    protected $fillable = [];

    public function teams() {
        return $this->hasMany(Teams::class);
    }

    public function app_user() {
        return $this->belongsTo(AppUser::class);
    }
}
