<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    @vite(['resources/css/app.css', 'resources/css/custom.css']) <!-- Vite for assets -->
    @if (isset($cssLinks))
        @foreach ($cssLinks as $cssLink)
            <link rel="stylesheet" href="{{ $cssLink }}">
        @endforeach
    @endif
</head>
<body>
    <!-- Include the header component -->
    <x-header :cssLinks="$cssLinks" :title="$title" />

    <!-- Main content section -->
    <main>
        @yield('content')
    </main>

    @yield('scripts')

    <!-- Include the footer component -->
    <x-footer :jsLinks="$jsLinks" />
</body>
</html>
