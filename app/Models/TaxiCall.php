<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxiCall extends Model
{
    use HasFactory;

    protected $fillable = [
        'passenger_id',
        'driver_id',
    ];

}
