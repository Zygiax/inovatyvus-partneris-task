<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;
    protected $table = 'trucks';

    public function make()
    {
        return $this->hasOne(TruckMake::class, 'id', 'trucks_make_id');
    }
}
