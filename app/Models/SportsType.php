<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Organization;

class SportsType extends Model {
    
    use HasFactory;

    // to allow mass assignment of these fields
    protected $fillable = ['type'];

    public function organizations() {
        return $this->hasMany(Organization::class);
    }
}
