<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable  = [
        'username',
        'email',
        'flight_id',
        'fname',
        'fdesc',
        'fprice',
        'user_id'
    ];
}