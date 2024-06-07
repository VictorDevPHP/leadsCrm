<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = [
        'expires_at',
    ];

    protected $fillable = [
        'email', 'token', 'expires_at', 'profile', 'customer_id',
    ];
}