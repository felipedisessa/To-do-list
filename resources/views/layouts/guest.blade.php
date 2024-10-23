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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased">
    @if(config('app.dev_login') === true)
        <div class="flex items-center space-x-4 justify-center bg-[#2096a8]">
            <div class="flex space-x-4 justify-between font-black">
            <span class="py-1 px-4 rounded-md bg-[#207e90] border-[#3ad4bd] text-white flex items-center space-x-2">
                <i class="fas fa-code-branch"></i>
                <span>{{$branch}}</span>
            </span>
                <span class="py-1 px-4 rounded-md bg-[#207e90] border-[#3ad4bd] text-white flex items-center space-x-2">
                <i class="fas fa-server"></i>
                <span>{{$env}}</span>
            </span>
            </div>
            <form action="{{route('dev-login')}}" class=" font-semibold flex-col rounded-lg p-1">
                <label class=" flex-auto text-white ">
                    <select name="user"
                            class="rounded-md bg-[#207e90] border-[#3ad4bd] p-1 px-4">
                        <option value="1">Admin</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </label>
                <button type="submit"
                        class="px-4 py-1 bg-[#207e90] border-[#3ad4bd] hover:bg-[#1aaab3] hover:border-[#3ad4bd] text-white rounded-md">
                    Login
                </button>
            </form>
        </div>
    @endif

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-100 dark:bg-slate-900">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-slate-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-slate-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
