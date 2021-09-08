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
        <div x-data="{ cartOpen: false , isOpen: false, cart: [], resetCart(){this.cart = getCookie('cart') ? Object.values(JSON.parse(getCookie('cart'))):[]}}">
            @include('_layouts._navbar')
            
            @include('_layouts._cart')
    
            <main class="my-8">
                @yield('body')
            </main>

            @include('_layouts._footer')
        </div>
        <script>
        function getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for(let i = 0; i <ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function setCookie(cname, cvalue, exmins) {
            const d = new Date();
            d.setTime(d.getTime() + (exmins*60*1000));
            let expires = "expires="+ d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function setCart(pid, quantity){
            let cartInCookie = JSON.parse(getCookie('cart'));
            cartInCookie[pid].quantity =quantity;
            console.log(cartInCookie)
            setCookie("cart", JSON.stringify(cartInCookie),10)
        }

        function removeFromCart(pid){
            let cartInCookie = JSON.parse(getCookie('cart'));
            delete cartInCookie[pid]
            setCookie("cart", JSON.stringify(cartInCookie),10)
        }
        // let cartData= Alpine.reactive({cart: []})
    </script>
    </body>
</html>
