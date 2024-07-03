<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Component;
use App\Models\Customer as CustomerModel;

class Customer extends Component
{
    public $responsaveis;
    public $data;
    /**
     * Mount the component.
     *
     * @param int $customer_id The ID of the customer.
     * @return void
     */
    public function mount($customer_id){
        $this->responsaveis = User::where('customer_id', auth()->user()->customer_id)->get();
        $this->data['customer'] = CustomerModel::find($customer_id);
    }
    public function render()
    {
        return view('livewire.components.customer');
    }
}
