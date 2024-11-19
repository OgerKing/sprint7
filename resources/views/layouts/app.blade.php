<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap"
            rel="stylesheet"
        />

        <script
            type="text/javascript"
            src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"
        ></script>
        <script
            type="text/javascript"
            src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"
        ></script>
        <script
            type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"
        ></script>
        <link
            rel="stylesheet"
            type="text/css"
            href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"
        />

        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="app-container" id="wrats-app-container">
            @livewire('navigation', ['currentRouteName' => Route::current()->getName()])

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
     
            @livewire('components.snackbar-notification')
            <x-first-login-modal />

        </div>

    </body>

</html>
