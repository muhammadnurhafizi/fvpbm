<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemPackage extends Model
{
    use HasFactory, SoftDeletes;

    public function external_uom() {
        return $this->belongsTo(UOM::class, 'external_uom_id');
    }

    public function internal_uom() {
        return $this->belongsTo(UOM::class, 'internal_uom_id');
    }
}
