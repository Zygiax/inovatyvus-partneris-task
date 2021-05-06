<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckMake extends Model
{
    use HasFactory;
    protected $table = 'trucks_make';

    public function truck()
    {
        return $this->belongsTo(Truck::class, 'trucks_make_id', 'id');
    }
}
