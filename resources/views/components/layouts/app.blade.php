<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title ?? 'Page Title' }}</title>
        @livewireStyles
        @vite('resources/css/app.css')
        <wireui:scripts />
    </head>
    <body>
        <x-notifications position="top-right" />
        <x-dialog z-index="z-50" blur="md" align="center" />
        {{ $slot }}
        <script>
            window.addEventListener('reload', event => {
                window.location.reload();
            })
        </script>
        @livewireScripts
    </body>
</html>
