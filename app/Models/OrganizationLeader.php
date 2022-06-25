<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\AppUser;
use App\Models\Organiztion;

class OrganizationLeader extends Model {
    
    use HasFactory;

    // to allow mass assignment of these fields
    protected $fillable = [];

    public function app_user() {
        return $this->belongsTo(AppUser::class);
    }

    public function organiztions() {
        return $this->hasMany(Organiztion::class);
    }
}
