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
            <script src="CSS/{{ $link }}.css"></script>
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
        <img src="/images/logo_dark.svg" alt="logo">
        <div class="min-w-20 flex justify-between md:justify-end">
            <i class="toogle fa-solid fa-bars text-2xl cursor-pointer md:hidden"></i>
            @if (session('user'))
                <a href="#" class="ml-2 bg-gray-800 text-white py-1 px-3 rounded-xl hover:text-yellow-500">Logout</a>
            @else
                <a href="#" class="ml-2 bg-gray-800 text-white py-1 px-3 rounded-xl hover:text-yellow-500">Login</a>
            @endif
        </div>
    </div>
    <nav class="absolute md:relative w-[100%] bg-gray-800 text-white hidden md:block z-10">
        <ul class="flex flex-col justify-center items-start gap-4 p-5
        md:flex-row md:justify-between md:items-center md:px-20 md:py-3
        xl:px-72">
            <li class="hover:text-yellow-500"><a href="#">Home</a></li>
            @if (session('user'))
                <li class="hover:text-yellow-500"><a href="#">Profile</a></li>
            @endif
            <li class="hover:text-yellow-500"><a href="#">Contact</a></li>
            <li class="hover:text-yellow-500"><a href="#">About Us</a></li>
            <li class="cursor-pointer relative group">
                <span class="hover:text-yellow-500">Topics
                <i class="fa-solid fa-chevron-down text-xs ml-2 group-hover:hidden"></i>
                <i class="fa-solid fa-chevron-up text-xs ml-2 hidden group-hover:inline-block"></i>
                </span>

                <ul class="bg-gray-800 absolute top-6 left-0 min-w-32 p-5 flex-col gap-4 hidden group-hover:flex hover:flex">
                    <li class="hover:text-yellow-500"><a href="#">Math</a></li>
                    <li class="hover:text-yellow-500"><a href="#">English</a></li>
                    <li class="hover:text-yellow-500"><a href="#">Computer</a></li>
                    <li class="hover:text-yellow-500"><a href="#">Science</a></li>
                </ul>
            </li>

        </ul>
    </nav>
</header>
