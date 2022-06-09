<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArmyCard extends Model
{
    use HasFactory, SoftDeletes;

    public function veteran_status() {
        return $this->belongsTo(VeteranStatus::class);
    }

    public function agency() {
        return $this->belongsTo(Agency::class);
    }

    public function army_type() {
        return $this->belongsTo(ArmyType::class);
    }

    public function relatives() {
        return $this->hasMany(Relative::class);
    }
}
