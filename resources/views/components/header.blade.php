<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>{{$title}}</title>
    @if(!empty($cssLinks))
    @foreach ($cssLinks as $link)
        @php
            $filePath = public_path("CSS/{$link}.css");
        @endphp
            @if (file_exists($filePath))
            <link rel="stylesheet" href="{{asset('CSS/' . $link  . '.css')}}">
            @endif
    @endforeach
    @endif
</head>
<body class="{{ $body_classes ?? '' }}">

<header class="relative">
    <div class="bg-white flex justify-between items-center px-12 py-2
    md:px-32 md:py-3
    lg:px-48 lg:py-3
    xl:px-72 xl:py-3">
            
              @auth
            <img src="{{ Auth::user()->image }}" alt="logo" style="width:60px;height:60px;border-radius:50%">
            @endauth

            <img src="/images/logo_dark.svg" alt="logo">
        <div class="min-w-20 flex justify-between md:justify-end">
            <i class="toogle fa-solid fa-bars text-2xl cursor-pointer md:hidden"></i>

            @auth
            <a href="/user_profile" class="ml-2 bg-gray-800 text-white py-1 px-3 rounded-xl hover:text-yellow-500">Welcome: {{Auth::user()->name }}</a>
            @endauth

            @if (Auth::user())

                <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="ml-2 bg-gray-800 text-white py-1 px-3 rounded-xl hover:text-yellow-500">Logout</button>
                </form>
            @else

                <a href="/register" class="ml-2 bg-gray-800 text-white py-1 px-3 rounded-xl hover:text-yellow-500">Register</a>
                <a href="/login" class="ml-2 bg-gray-800 text-white py-1 px-3 rounded-xl hover:text-yellow-500">Login</a>
            @endif
        </div>
    </div>
    <nav class="absolute md:relative w-[100%] bg-gray-800 text-white hidden md:block z-10">
        <ul class="flex flex-col justify-center items-start gap-4 p-5
        md:flex-row md:justify-between md:items-center md:px-20 md:py-3
        xl:px-72">
            <li class="hover:text-yellow-500"><a href="/">Home</a></li>
             @if(Auth::user())
                @if (Auth::check() && Auth::user()->role == "admin")
                    <li class="hover:text-yellow-500"><a href="/dashboard">Dashboard</a></li>
                @else
                    <li class="hover:text-yellow-500"><a href="/user_profile">Profile</a></li>
                @endif
            @endif
            <li class="hover:text-yellow-500"><a href="#">Contact</a></li>
            <li class="hover:text-yellow-500"><a href="#">About Us</a></li>
            <li class="cursor-pointer relative group">
                <span class="hover:text-yellow-500">Topics
                <i class="fa-solid fa-chevron-down text-xs ml-2 group-hover:hidden"></i>
                <i class="fa-solid fa-chevron-up text-xs ml-2 hidden group-hover:inline-block"></i>
                </span>

                 <ul class="bg-gray-800 absolute top-6 left-0 min-w-32 p-5 flex-col gap-4 hidden group-hover:flex hover:flex">
                     @foreach ($topics as $topic)
                    <li class="hover:text-yellow-500"><a href="#">{{ $topic->name }}</a></li>
                    @endforeach
                </ul>
            </li>

        </ul>
    </nav>
</header>
