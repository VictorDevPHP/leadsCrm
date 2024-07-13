<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConnectedSession extends Model
{
    use HasFactory;

    protected $table = 'connected_sessions';

    protected $fillable = [
        'connected',
        'customer_id',
        'qrcode',
        'session_name'
    ];
}
