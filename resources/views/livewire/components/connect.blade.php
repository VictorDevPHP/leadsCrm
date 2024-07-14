<div>
    @if ($data['conected'] == true)
        @livewire('components.whatsapp-settings', ['connected' => $data['conected']])
    @else
        <div style="position: relative; min-height: 100vh;">
            <div class="d-flex justify-content-center align-items-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                <button wire:click="create({{auth()->user()->customer_id}})" wire:loading.attr="disabled" wire:loading.class.remove="btn-primary" class="btn btn-primary" style="font-size: 20px; padding: 10px 20px; transition: all 0.3s ease-in-out; box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1); cursor: pointer;">
                    <span wire:loading.remove wire:target="create"><i class="fab fa-whatsapp"></i> Iniciar Conexão</span>
                    <span wire:loading wire:target="create"><i class="fas fa-spinner fa-spin fa-lg"></i></span>
                </button>
            </div>
        </div>
    @endif
</div>