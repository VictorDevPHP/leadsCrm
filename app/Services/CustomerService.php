<?php 

namespace App\Services;
use App\Models\Customer;

class CustomerService
{
    public static function getSessionCustomer($custome_id): string 
    {
        return 'session-'.Customer::where('id', $custome_id)->value('whatsapp');
    }

}