<div>
    <div class="card customer-data bg-gray-900 shadow-lg mx-auto p-6 rounded-lg">
        <div class="card-header text-center">
            <h2 class="card-title text-2xl font-bold text-gray-300">Detalhes do Cliente: 
                <span class="list-group-text font-bold text-blue-400">
                    <b>{{$data['customer']['name']}}</b>
                </span>
            </h2>
        </div>
        <div class="card-body mt-6">
            <ul class="list-group list-group-flush space-y-4">
                <li class="list-group-item flex justify-between items-center border-b border-gray-600 py-2 bg-gray-800">
                    <i class="fas fa-envelope-open-text text-gray-300"></i>
                    <span class="list-group-text font-bold text-pink-400">
                        Email: <b>{{$data['customer']['email']}}</b>
                    </span>
                    <span id="customer-type-payment" class="list-group-text text-right"></span>
                </li>
                <li class="list-group-item flex justify-between items-center border-b border-gray-600 py-2 bg-gray-800">
                    <i class="fab fa-whatsapp text-gray-300"></i>
                    <span class="list-group-text font-bold text-pink-400">
                        WhatsApp: <b>{{$data['customer']['whatsapp']}}</b>
                        <a href="https://wa.me/{{$data['customer']['whatsapp']}}" target="_blank" class="text-green-500 ml-2">
                            <i class="fab fa-whatsapp"></i> Chat
                        </a>
                    </span>
                    <span id="customer-type-payment" class="list-group-text text-right"></span>
                </li>
                <li class="list-group-item flex justify-between items-center border-b border-gray-600 py-2 bg-gray-800">
                    <i class="fas fa-credit-card mr-1 text-pink-400"></i>
                    <span class="list-group-text font-bold text-pink-400">
                        Tipo de Pagamento: <b>{{$data['customer']['type_payment']}}</b>
                    </span>
                    <span id="customer-type-payment" class="list-group-text text-right"></span>
                </li>
                <li class="list-group-item flex justify-between items-center py-2 bg-gray-700">
                    <i class="fas fa-wallet mr-1 text-indigo-400"></i>
                    <span class="list-group-text font-bold text-indigo-400">
                        Orçamento Mensal: <b> R$ {{$data['customer']['monthly_payment']}}
                    </span>
                    <span id="customer-budget-monthly" class="list-group-text text-right"></span>
                </li>
            </ul>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
        @foreach ($responsaveis as $responsavel)
            <div class="card bg-white shadow-lg p-6 rounded-lg">
                <div class="card-header text-center">
                    <img src="{{ asset('storage/' . $responsavel->profile_photo_path) }}" alt="{{ $responsavel->name }}"
                        class="w-20 h-20 rounded-full mx-auto mb-2">
                    <h2 class="card-title text-xl font-bold text-blue-600">{{ $responsavel->name }}</h2>
                </div>
                <div class="card-body mt-4">
                    <p class="text-gray-700">{{ $responsavel->email }}</p>
                    {{-- <p class="text-gray-700">{{ $responsavel->position }}</p> --}}
                    {{-- <p class="text-gray-700">
                        ({{ substr($responsavel->phone, 2, 2) }}) {{ substr($responsavel->phone, 4, 5) }}-{{ substr($responsavel->phone, 9, 4) }}
                        <a href="https://wa.me/{{ $responsavel->phone }}" target="_blank" class="text-green-500 ml-2">
                            <i class="fab fa-whatsapp"></i> Chat
                        </a>
                    </p> --}}
                </div>
            </div>
        @endforeach
    </div>
</div>
