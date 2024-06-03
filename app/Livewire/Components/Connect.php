<?php

namespace App\Livewire\Components;

use App\Http\Controllers\API\wpp\WppApi;
use App\Models\Customer;
use App\Models\QRCode;
use Livewire\Component;

class Connect extends Component
{
    public $content;
    public $data;
    /**
     * Mount the component.
     *
     * @param int $customer_id The ID of the customer.
     * @return void
     */
    public function mount($customer_id)
    {
        $this->data['customer'] = Customer::find($customer_id);
    }
    public function render()
    {
        return view('livewire.components.connect');
    }

    /**
     * Create a new session and display a QR code for connection.
     *
     * @param int $customer_id The ID of the customer.
     * @return void
     */
    public function create($customer_id){
        $sessionName = 'session-'.Customer::where('id', $customer_id)->value('whatsapp');
        (new WppApi)->connect($sessionName);
        $qrCode = null;
        while (true) {
            $qrCode = QRCode::where('session', $sessionName)->value('qrCode');
            if ($qrCode) {
                break;
            }
            sleep(1);
        }
        $html = view('livewire.components.qr_code', ['qrCode' => $qrCode])->render();
        $this->dispatch('swal:modal', [
            'title'             => '',
            'icon'              => 'info',
            'html'              => $html,
            'customClass'       => '',
            'showCloseButton'   =>  false,
            'showCancelButton'  =>  true,
            'showConfirmButton' =>  true,
            'confirmButtonText' =>  'Ok',
            'cancelButtonText'  =>  'Cancelar',
            'module'            =>  'QRCode',
            'data'              =>  $qrCode
        ]);
        QRCode::where('session', $sessionName)->delete();
    }
}
