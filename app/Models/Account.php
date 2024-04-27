<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['id_cliente', 'id_meta', 'id_google', 'status'];
}
