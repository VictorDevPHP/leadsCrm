<div class="p-6 rounded-lg">
    <div class="bg-black-100 bg-whatsapp p-6 rounded-lg shadow-lg font-roboto">
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
    </style>
</div>
