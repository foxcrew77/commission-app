<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="The modern, accessible and dark theme ready HTML dashboard. Full of custom, reusable components to speed up the development of admin panels.">
    <meta name="author" content="abdulbasit-dev">
    {{-- @vite('resources/css/app.css')
    @vite(['resources/js/app.js']) --}}
    <title>Laravel Windmill Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>

    <link rel="stylesheet" href="{{asset('assets/css/tailwind.output.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/Chart.min.css') }}"/>

    {{-- favicon --}}
    <link rel="icon" sizes="180x180" href="{{ asset('assets/img/windmill.png') }}">

    {{-- feather icon --}}
    <script src="{{ asset('js/feather.min.js') }}"></script>


    {{-- driver and workman sidebar icons --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    {{-- alpine js --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- activating this will produce two darkmode button --}}

    {{-- alpine plugin --}}
    <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    

    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

    {{-- multiselect --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/css/multi-select-tag.css"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/multiselect.css') }}">
    <style>
        .material-symbols-outlined {
          font-variation-settings:
          'FILL' 0,
          'wght' 400,
          'GRAD' 0,
          'opsz' 22
        }
        
        </style>

</head>
<body>
<div
        class="flex h-screen bg-gray-50 dark:bg-gray-900"
        :class="{ 'overflow-hidden': isSideMenuOpen }"
>
    <!-- Desktop sidebar -->
    @include('includes.desktop-sidebar')

    <!-- Mobile sidebar -->
    @include('includes.mobile-sidebar')

    
    <div class="flex flex-col flex-1 w-full">
        @include('includes.header')
        @include('includes.breadcrumb')
        <main class="h-full overflow-y-auto">
            @yield('content')
        </main>
    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script>feather.replace();</script>
{{-- multiselect --}}
{{-- <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script> --}}

<script src="{{ asset("assets/js/alpine.min.js") }}" defer></script>
<script src="{{ asset("assets/js/Chart.min.js") }}" defer></script>
<script src="{{ asset("assets/js/init-alpine.js") }}"></script>
<script src="{{ asset("assets/js/charts-lines.js") }}" defer></script>
<script src="{{ asset("assets/js/charts-pie.js") }}" defer></script>
<script>
//     window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
//     const newColorScheme = event.matches ? "dark" : "light";
//     if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
// }
    
// });

</script>
</body>
</html>
