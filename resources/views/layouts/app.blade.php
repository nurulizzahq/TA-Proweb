<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/scss/unreset.scss', 'resources/css/ui.css'])
    @yield('topAssets')
</head>

<body>

    <x-dashboard.sidebar />

    <main class="p-4 sm:ml-64">
        {{ $slot }}
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/datepicker.min.js"></script>
    @yield('bottomAssets')
</body>

</html>
