<div class="p-6 rounded-lg">
    <div class="relative bg-black-100 bg-whatsapp p-6 rounded-lg shadow-lg font-roboto">
        <div class="absolute top-2 right-2">
            <span>Status </span><span class="status-indicator {{ $connected ? 'bg-green-500' : 'bg-red-500' }}"></span>
        </div>
        <div class="flex space-x-4">
            <button wire:click="disconnect" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <i class="fas fa-sign-out-alt mr-2"></i>
                <span>Desconectar</span>
            </button>
            <button wire:click="sendMessage" class="bg-black-500 hover:bg-black-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <i class="fas fa-paper-plane mr-2"></i>
                <span>Disparar Mensagem</span>
            </button>
        </div>
    </div>
    <style>
        .bg-whatsapp {
            background: url('https://www.transparenttextures.com/patterns/cubes.png') repeat;
        }
        .status-indicator {
            display: inline-block;
            width: 16px;
            height: 16px;
            border-radius: 50%;
        }

        .bg-green-500 {
            background-color: #10B981;
        }

        .bg-red-500 {
            background-color: #EF4444;
        }

        .relative {
            position: relative;
        }

        .absolute {
            position: absolute;
        }

        .top-2 {
            top: 0.5rem;
        }

        .right-2 {
            right: 0.5rem;
        }
    </style>
</div>
