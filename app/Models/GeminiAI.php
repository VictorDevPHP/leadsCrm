<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeminiAI extends Model
{
    use HasFactory;
    protected $table = 'gemini_ai';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = [
        'customer_id',
        'instruct',
        'session_name',
        'active'
    ];
}
