<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Relative extends Model
{
    use HasFactory, SoftDeletes;

    public function army_card() {
        return $this->belongsTo(ArmyCard::class);
    }

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function patient_relation() {
        return $this->belongsTo(PatientRelation::class);
    }
}
