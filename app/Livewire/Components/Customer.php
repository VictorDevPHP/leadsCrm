<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Customer as CustomerModel;

class Customer extends Component
{
    public $data;
    /**
     * Mount the component.
     *
     * @param int $customer_id The ID of the customer.
     * @return void
     */
    public function mount($customer_id){
        $this->data['customer'] = CustomerModel::find($customer_id);
    }
    public function render()
    {
        return view('livewire.components.customer');
    }
}
