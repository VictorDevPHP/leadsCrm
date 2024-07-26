<?php

namespace App\Livewire\Components;

use App\Http\Controllers\API\wpp\WppApi;
use App\Services\CustomerService;
use Livewire\Component;

class WhatsAppSettings extends Component
{
    public $connected;

    public function mount($connected)
    {
        $this->connected = $connected;
    }

    public function render()
    {
        return view('livewire.components.whatsapp-settings');
    }

    public function disconnect()
    {
        WppApi::disconect(CustomerService::getSessionCustomer(auth()->user()->customer_id));
        $this->connected = false;
        
    }

    public function sendMessage()
    {
        dd('enviar mensagens');
    }
}
