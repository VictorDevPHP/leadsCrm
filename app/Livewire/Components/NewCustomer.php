<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Customer;

class NewCustomer extends Component
{
    public $name;
    public $email;
    public $whatsapp;
    public $id_meta;
    public $id_google;
    public $monthly_payment;
    public $type_payment;
    public $budget_monthly;
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'whatsapp' => 'required|string|max:20',
        'id_meta' => 'nullable|string|max:255',
        'id_google' => 'nullable|string|max:255',
        'monthly_payment' => 'required|numeric',
        'type_payment' => 'required|string|max:255',
        'budget_monthly' => 'required|numeric',
    ];
    public function mount($data = null){
        
    }
    public function submit()
    {
        $this->validate();
        
        Customer::create([
            'name' => $this->name,
            'email' => $this->email,
            'whatsapp' => $this->whatsapp,
            'id_meta' => $this->id_meta,
            'id_google' => $this->id_google,
            'monthly_payment' => $this->monthly_payment,
            'type_payment' => $this->type_payment,
            'budget_monthly' => $this->budget_monthly,
        ]);

        session()->flash('message', 'Cliente cadastrado com sucesso!');
        
        $this->reset();
    }

    public function render()
    {
        return view('livewire.components.new-customer');
    }
}
