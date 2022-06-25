<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SportsType;
use App\Models\OrganizationLeader;

class Organization extends Model {

    use HasFactory;

    // to allow mass assignment of these fields
    protected $fillable = ['name'];

    public function sports_types() {
        return $this->belongsTo(SportsType::class);
    }

    public function organization_leaders() {
        return $this->belongsTo(OrganizationLeader::class);
    }
}
