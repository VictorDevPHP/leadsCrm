<div>
    @if (auth()->user()->can('admin'))
    <div style="margin-top: 70px;">
        <div class="flex justify-center space-x-8 p-4 bg-gray-900 text-gray-200">
            <h1>Mostrar lista de clientes</h1>
        </div>
    </div>
    @else
    <div style="display: flex;">
        <div style="flex: 0 0 250px; height: 100vh; background-color: #1a202c; padding: 20px; color: #a0aec0; flex-direction: column;">
            <button class="focus:outline-none {{ $component == 'customer' ? 'text-white border-b-2 border-blue-500' : 'text-gray-400' }}" wire:click="selectComponent('customer', {{auth()->user()->customer_id}})">
                <h1 class="font-semibold text-xl leading-tight hover:text-white transition-colors duration-200" style="margin: 30px 0;">
                    <i class="fas fa-user-alt"></i>  Cliente
                </h1>
            </button>
            <button class="focus:outline-none {{ $component == 'config' ? 'text-white border-b-2 border-blue-500' : 'text-gray-400' }}" wire:click="selectComponent('config', {{auth()->user()->customer_id}})">
                <h1 class="font-semibold text-xl leading-tight hover:text-white transition-colors duration-200" style="margin: 30px 0;">
                    <i class="fas fa-cogs"></i> Configurações
                </h1>
            </button>
            <button class="focus:outline-none {{ $component == 'connect' ? 'text-white border-b-2 border-blue-500' : 'text-gray-400' }}" wire:click="selectComponent('connect', {{auth()->user()->customer_id}})">
                <h1 class="font-semibold text-xl leading-tight hover:text-white transition-colors duration-200" style="margin: 30px 0;">
                    <i class="fas fa-plug"></i> Conectar WhatsApp
                </h1>
            </button>
        </div>
        <div style="flex: 1; background-color: #111827; color: #a0aec0; padding: 20px;">
            @switch($component)
                @case('customer')
                    @livewire('Components.Customer', ['customer_id' => auth()->user()->customer_id])
                    @break

                @case('config')
                    @livewire('Components.Config', ['customer_id' => auth()->user()->customer_id])
                    @break
        
                @case('connect')
                    @livewire('Components.Connect', ['customer_id' => auth()->user()->customer_id])
                    @break
        
                @default
                    <!-- Código padrão caso nenhuma das condições anteriores seja atendida -->
            @endswitch
        </div>
    </div>
    @endif
</div>