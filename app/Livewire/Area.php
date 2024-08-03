<?php
namespace App\Livewire;

use App\Models\ConnectedSession;
use App\Models\Customer;
use Livewire\Component;

class Area extends Component{
    public $component;
    public $customer_id;
    public $customers;
    public $text_connect;

    public function mount(){
        $this->component = (auth()->user()->profile == 'admin') ? 'listCustomers' : 'customer';
        $this->customer_id = auth()->user()->customer_id ? null : 'admin';
        $wpp_connected = ConnectedSession::where('session_name', 'session-'.Customer::where('id', $this->customer_id)->value('whatsapp'));
        if($wpp_connected == true){
            $this->text_connect = 'WhatsApp';
        }else{
            $this->text_connect = 'Conectar WhatsApp';
        }
    }

    public function render(){
        return view('livewire.area-customer');
    }

    /**
     * Selects a component. 
     *
     * @param string $componentSelected The componentSelected component.
     * @return void
     */
    public function selectComponent(string $componentSelected, int $id): void{
        $this->component = $componentSelected;      
    }
}