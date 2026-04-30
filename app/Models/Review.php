<?php

namespace App\Models;

use App\Models\Guide;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'guide_id',
        'guest_name',
        'guest_email',
        'rating',
        'comment',
    ];

    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }
}
