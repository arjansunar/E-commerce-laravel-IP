@extends('_layouts.master')

@section('body')
<div x-data="{count: 1}" class="container mx-auto px-6">
    <div class="md:flex md:items-center">
        <div class="w-full h-64 md:w-1/2 lg:h-96">
            <img class="h-full w-full rounded-md object-cover max-w-lg mx-auto" src="{{$main["image_url"]}}" alt="{{$main["name"]}}">
        </div>
        <div class="w-full max-w-lg mx-auto mt-5 md:ml-8 md:mt-0 md:w-1/2">
            <h3 class="text-gray-700 uppercase text-lg">{{$main["name"]}}</h3>
            <span class="text-gray-500 mt-3">${{$main["price"]}}</span>
            <hr class="my-3">
            <div  class="mt-2">
                <label class="text-gray-700 text-sm" for="count">Count:</label>
                <div class="flex items-center mt-1">
                    <button @click="count++" class="text-gray-500 focus:outline-none focus:text-gray-600">
                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </button>
                    <span class="text-gray-700 text-lg mx-2" x-text="count"></span>
                    <button @click="(count > 1 ? count-- : count)" class="text-gray-500 focus:outline-none focus:text-gray-600">
                        <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </button>
                </div>
            </div>
            <hr class="my-3">
            <div class="">
                <label class="text-gray-700 text-sm" for="description">Description:</label>
                <div class="text-gray-500 mt-1">{!! $main["description"] !!}</div>
            </div>
            <div class="flex items-center mt-6">
                <button x-on:click="fetch('/api/add-to-cart',{method:'POST',headers: {'Content-Type': 'application/json'}, body: JSON.stringify({'product_id':{{$main["id"]}},'quantity': count})}).then(()=> location.reload())" class="flex space-x-2 px-8 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-500 focus:outline-none focus:bg-indigo-500 ">
                    <span>Add to cart</span>
                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </button>
            </div>
        </div>
    </div>
    <div class="mt-16">
        <h3 class="text-gray-600 text-2xl font-medium">More Products</h3>
        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
            @forelse($products as $product)
                <div x-data=" {p_id: {{$product['id']}}}" class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                    <div class="cursor-pointer flex items-end justify-end h-56 w-full bg-cover" style="background-image: url({{$product['image_url']}}); background-position: center">
                        <button x-on:click="fetch('/api/add-to-cart',{method:'POST',headers: {'Content-Type': 'application/json'}, body: JSON.stringify({'product_id':p_id,'quantity': 1})}).then(()=> location.reload())" class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </button>
                    </div>
                    <div class="px-5 py-3">
                        <h3 class="text-gray-700 uppercase">{{$product['name']}}</h3>
                        <div class="flex justify-between mt-2">
                            <span class="text-gray-500">${{$product['price']}}</span>
                            <a href="/product/{{$product['id']}}" class="flex items-center text-gray-500 text-sm uppercase font-medium rounded hover:underline focus:outline-none">
                                <span>View More</span>
                                <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
            <div class="text-center">No items currently!!</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
