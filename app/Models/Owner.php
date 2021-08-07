<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'identification',
        'first_name',
        'second_name',
        'last_name',
        'direction',
        'phone',
        'city',
        'vehicle_id'
    ];

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class);
    }
}
