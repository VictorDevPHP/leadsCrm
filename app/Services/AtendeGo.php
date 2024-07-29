<?php 

namespace App\Services;

abstract class AtendeGo
{
    protected static function getSessionPrefix(): string
    {
        return 'session-';
    }
}