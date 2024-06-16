<div class="flex items-center justify-center min-h-screen bg-custom-gray">
    <form class="bg-white rounded-lg shadow-md p-6" wire:submit.prevent="submit">
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email:</label>
            <input type="email" id="email" wire:model="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>

        <div class="mb-4">
            <label for="profile" class="block text-gray-700">Perfil:</label>
            <select id="profile" wire:model="profile" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="admin">Administrador</option>
                <option value="user_client">Usuário - Cliente</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="client" class="block text-gray-700">Cliente:</label>
            <select id="client" wire:model="client" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="w-full py-2 px-4 text-custom-text bg-custom-gray hover:bg-custom-gray-dark rounded-lg shadow-md">Enviar convite</button>

    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>