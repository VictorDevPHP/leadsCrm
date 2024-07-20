<?php

use App\Http\Controllers\API\OpenAI\Threads\Messages;
use Illuminate\Support\Facades\Route;

Route::post('/createThread', [Messages::class, 'createChat']);
Route::post('/sendMessage', [Messages::class, 'sendMessage']);
