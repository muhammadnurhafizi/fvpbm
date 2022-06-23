<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    public function instruction() {
        return $this->belongsTo(Instruction::class);
    }

    public function frequency() {
        return $this->belongsTo(Frequency::class);
    }

    public function quantity_formula() {
        return $this->belongsTo(QuantityFormula::class);
    }

    public function item_package() {
        return $this->hasOne(ItemPackage::class);
    }

    public function stock() {
        return $this->hasOne(Stock::class);
    }

    public function prices() {
        return $this->hasMany(Price::class);
    }
}
