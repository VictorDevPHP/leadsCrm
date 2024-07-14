<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

        <!-- Styles -->
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        {{-- datatales --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>        
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @if (auth()->check())
                    {{ $slot }}
                @endif
                <script>
                    window.addEventListener('swal:modal', event => {
                        Swal.fire({
                            title: event.detail[0].title,
                            icon: event.detail[0].icon,
                            html: event.detail[0].html,
                            customClass: event.detail[0].customClass,
                            showCloseButton: event.detail[0].showCloseButton,
                            showCancelButton: event.detail[0].showCancelButton,
                            showConfirmButton: event.detail[0].showConfirmButton,
                            confirmButtonText: event.detail[0].confirmButtonText,
                            cancelButtonText: event.detail[0].cancelButtonText,
                            cancelButtonText: event.detail[0].cancelButtonText,
                            focusConfirm: true,
                            didOpen: () => {
                                if (event.detail[0].origin == 'connect') {
                                    intervalId =  setInterval(function() {
                                        Livewire.dispatch('checkConnection');
                                    }, 3000);
                                }
                            }
                        });
                    });
                    window.addEventListener('return', event => {
                        if (event.detail[0].conected) {
                            clearInterval(intervalId);
                            Swal.close();
                        }
                    });
                    
                    $(document).ready(function() {
                        $('#customersTable').DataTable();
                    });
                </script>
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
