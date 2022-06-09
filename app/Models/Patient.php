<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    public function address() {
        return $this->belongsTo(Address::class);
    }

    public function gender() {
        return $this->belongsTo(Gender::class);
    }

    public function relative() {
        return $this->hasOne(Relative::class);
    }
}
