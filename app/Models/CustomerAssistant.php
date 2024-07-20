<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAssistant extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'id_assistant',
        'active',
        'session_name'
    ];

}
