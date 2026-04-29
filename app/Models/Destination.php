<?php

namespace App\Models;

use App\Models\Guide;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'image',
        'latitude',
        'longitude',
        'location_name',
    ];

    public function guides()
    {
        return $this->hasMany(Guide::class);
    }
}