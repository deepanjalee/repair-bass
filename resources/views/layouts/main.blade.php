<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />

    @vite(['resources/js/app.js'])
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @livewireStyles
</head>

<body>
    <div id="app">
        @include('layouts.template.navbar')

        @include('layouts.template.sidebar')

        <div class="p-4 sm:ml-64">
            <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-700 mt-14">
                @yield('content')
            </div>
        </div>
    </div>



    @livewireScripts

    <!-- Load jQuery first -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

    <!-- Load Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Load Select2 JS after jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select a state",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
