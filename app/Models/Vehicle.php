<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'plaque',
        'color',
        'mark',
        'type'
    ];

    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }

    public function owner()
    {
        return $this->hasOne(Owner::class);
    }

}
