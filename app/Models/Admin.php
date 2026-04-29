<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    // Mass assignment protection
    protected $fillable = ['name', 'email', 'password'];

    // Hide password in arrays
    protected $hidden = ['password'];
}