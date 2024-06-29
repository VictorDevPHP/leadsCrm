<?php

namespace App\Livewire\Components;

use App\Models\Customer;
use Livewire\Component;

class ListCustomers extends Component
{
    public $customers;
    public function mount(){
        $this->customers = Customer::all();
    }

    public function render()
    {
        return view('livewire.components.list-customers');
    }

}
