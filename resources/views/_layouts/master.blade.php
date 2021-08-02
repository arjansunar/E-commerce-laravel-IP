<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="referrer" content="always">

        <meta name="description" content="e-commerce home page">

        <title>Ecommerce</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js')}}"></script>
        <script defer src="https://unpkg.com/alpinejs@3.2.2/dist/cdn.min.js"></script>

    </head>
    <body>
        <div x-data="{ cartOpen: false , isOpen: false }">
            @include('_layouts._navbar')
            
            @include('_layouts._cart')
    
            <main class="my-8">
                @yield('body')
            </main>

            @include('_layouts._footer')
        </div>
    </body>
</html>
