<?php

namespace App\Livewire\Components;

use App\Http\Controllers\API\wpp\WppApi;
use App\Models\ConnectedSession;
use App\Models\Customer;
use App\Models\QRCode;
use Livewire\Component;

class Connect extends Component
{
    public $content;
    public $data;
    public $sessionName;
    protected $listeners = [
        'checkConnection' => 'checkConnection'
    ];
    /**
     * Mount the component.
     *
     * @param int $customer_id The ID of the customer.
     * @return void
     */
    public function mount($customer_id)
    {
        $WppApi = new WppApi;
        $sessions = $WppApi->listSessions();
        $this->sessionName = 'session-' . Customer::where('id', $customer_id)->value('whatsapp');
        $this->data['conected'] = in_array($this->sessionName, $sessions['response']);
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
    public function create($customer_id)
    {
        $this->sessionName = 'session-'.Customer::where('id', $customer_id)->value('whatsapp');
        (new WppApi)->connect($this->sessionName);
        $qrCode = null;
        while (true) {
            $qrCode = QRCode::where('session', $this->sessionName)->value('qrCode');
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
            'data'              =>  $qrCode,
            'origin'            =>  'connect'
        ]);
        QRCode::where('session', $this->sessionName)->delete();
    }
    public function checkConnection()
    {
        $connected = ConnectedSession::where('session_name', $this->sessionName)->value('connected');
        if($connected == true){
            $this->dispatch('return', [
                'conected' => $connected,
            ]);
        }
    }
}
