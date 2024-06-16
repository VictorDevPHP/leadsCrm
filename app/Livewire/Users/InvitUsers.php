<?php

namespace App\Livewire\Users;

use App\Http\Controllers\InvitationController;
use App\Models\Customer;
use Livewire\Component;

class InvitUsers extends Component
{
    public $email;
    public $profile;
    public $customers;
    public $client;
    public function mount()
    {
        $this->customers = Customer::all();
        $this->profile = 'user_client';
        $this->client = $this->customers->first()->id ?? null;
    }
    public function render()
    {
        return view('livewire.users.invit-users');
    }

    public function submit()
    {
        $data = [
            'email' => $this->email,
            'profile' => $this->profile,
            'customer_id' => $this->client,
        ];
        $invitation = (new InvitationController())->sendInvitation($data);
        $this->dispatch('swal:modal', [
            'title'             => 'Convite Enviado',
            'icon'              => 'success',
            'text'              => 'O convite foi enviado com sucesso para o email '.$this->email,
            'customClass'       => '',
            'showCloseButton'   =>  false,
            'showCancelButton'  =>  false,
            'showConfirmButton' =>  true,
            'confirmButtonText' =>  'Ok',
            'module'            =>  'Invitation',
            'data'              =>  $invitation
        ]);
    }
}
