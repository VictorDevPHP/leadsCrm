<?php

namespace App\Livewire\Components;

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
        dd('disconect');
        $this->connected = false;
    }

    public function sendMessage()
    {
        dd('enviar mensagens');
    }
}
