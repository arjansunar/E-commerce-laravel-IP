@extends('_layouts.master')

@section('body')
    <div class="flex justify-center space-x-3 mb-3">
    @if (isset($has_category) && $has_category)
        @foreach($categories as $category)
            @if(isset($next_route_prefix) && $next_route_prefix)
                <a href="{{$next_route_prefix}}/{{$category["id"]}}"  class="bg-gray-200 text-gray-500 hover:bg-blue-600 hover:text-white px-4 py-2 rounded">{{$category["name"]}}</a>
            @endif
        @endforeach
    @endif
    </div>
        <div class="container mx-auto px-6 mb-8">
                <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                    @forelse($products as $product)  
                        <!-- single card props needed name and price-->
                        <div x-data=" {p_id: {{$product['id']}}}" class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                            <div class="flex items-end justify-end h-56 w-full bg-cover" style="background-image: url({{$product['image_url']}}); background-position: center">
                                <button x-on:click="fetch('/api/add-to-cart',{method:'POST',headers: {'Content-Type': 'application/json'}, body: JSON.stringify({'product_id':p_id,'quantity': 1})}).then(()=> location.reload())" class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </button>
                            </div>
                            <div class="px-5 py-3">
                                <h3 class="text-gray-700 uppercase">{{$product['name']}}</h3>
                                <span class="text-gray-500 mt-2">${{$product['price']}}</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center">No Current items!</div>
                    @endforelse  
                </div>
        </div>
@endsection
