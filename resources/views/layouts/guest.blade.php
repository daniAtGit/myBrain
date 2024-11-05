<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/brain.png')}}">
        <link rel="icon" type="image/png" href="{{asset('images/brain.png')}}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/brain.png')}}">
        <link rel="icon" type="image/png" href="{{asset('images/brain.png')}}">

        <style>
            .sfondo{
                background:url({{asset('images/sfondo.jpg')}}) no-repeat center center fixed;
            }
        </style>

        @laravelPWA
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 sfondo">
{{--            <div>--}}
{{--                <a href="/">--}}
{{--                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--                </a>--}}
{{--            </div>--}}

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="flex sm:justify-center items-center">
                    <img src="{{asset('images/logo.png')}}" title="myBrain!" style="width:100px;background:#fff;border-radius:60px;padding:15px;">
                </div>

                {{ $slot }}
            </div>
        </div>
    </body>
</html>
