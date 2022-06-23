<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use HasFactory, SoftDeletes;

    public function price_type() {
        return $this->belongsTo(PriceType::class);
    }

    public function uom() {
        return $this->belongsTo(UOM::class);
    }
}
