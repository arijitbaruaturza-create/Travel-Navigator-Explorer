<?php

namespace App\Models;

use App\Models\Guide;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'guide_id',
        'destination_id',
        'guest_name',
        'guest_email',
        'date',
        'status',
        'notes',
    ];

    protected $dates = ['date'];

    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
