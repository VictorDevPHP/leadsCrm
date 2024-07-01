<div>
    <div style="margin-top: 70px;">
        <div class="flex justify-center mt-4">
            <div class="w-full max-w-7xl">
                <table id="customersTable" class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 bg-gray-800 text-white">Nome</th>
                            <th class="py-2 px-4 bg-gray-800 text-white">Email</th>
                            <th class="py-2 px-4 bg-gray-800 text-white">WhatsApp</th>
                            <th class="py-2 px-4 bg-gray-800 text-white">ID Meta</th>
                            <th class="py-2 px-4 bg-gray-800 text-white">ID Google</th>
                            <th class="py-2 px-4 bg-gray-800 text-white">Pagamento Mensal</th>
                            <th class="py-2 px-4 bg-gray-800 text-white">Tipo de Pagamento</th>
                            <th class="py-2 px-4 bg-gray-800 text-white">Orçamento Mensal</th>
                            <th class="py-2 px-4 bg-gray-800 text-white">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td class="border px-4 py-2">{{ $customer->name }}</td>
                                <td class="border px-4 py-2">{{ $customer->email }}</td>
                                <td class="border px-4 py-2">{{ $customer->whatsapp }}</td>
                                <td class="border px-4 py-2">{{ $customer->id_meta }}</td>
                                <td class="border px-4 py-2">{{ $customer->id_google }}</td>
                                <td class="border px-4 py-2">{{ $customer->monthly_payment }}</td>
                                <td class="border px-4 py-2">{{ $customer->type_payment }}</td>
                                <td class="border px-4 py-2">{{ $customer->budget_monthly }}</td>
                                <td class="border px-4 py-2">
                                    <button href="#" class="text-blue-500 hover:text-blue-700" wire:click='edit({{$customer->id}})'>Editar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

