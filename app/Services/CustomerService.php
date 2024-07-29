<?php 

namespace App\Services;
use App\Models\Customer;

class CustomerService extends AtendeGo
{
    public static function getSessionCustomer($custome_id): string 
    {
        return self::getSessionPrefix().Customer::where('id', $custome_id)->value('whatsapp');
    }

}