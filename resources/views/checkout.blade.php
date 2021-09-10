@extends('_layouts.master')

@section('body')
<div class="container mx-auto px-6">
    <h3 class="text-gray-700 text-2xl font-medium">Checkout</h3>
    <div class="flex flex-col lg:flex-row mt-8">
        <div class="w-full lg:w-1/2 order-2">
            <form x-data="{userinfo: {name: '' , phone: '', address: '', date: ''}}" @submit.prevent= "window.location.href= `/bill?name=${userinfo.name}&phone=${userinfo.phone}&address=${userinfo.address}&date=${userinfo.date}`" class=" lg:w-3/4">
                <div class="">
                    <h4 class="text-sm text-gray-500 font-medium">Name</h4>
                    <div class="mt-4 flex">
                        <label class="block flex-1 ml-3">
                            <input x-model= "userinfo.name" required type="text" class="p-2 form-input mt-1 block w-full text-gray-700" placeholder="name">
                        </label>
                    </div>
                </div>
                <div class="mt-4">
                    <h4 class="text-sm text-gray-500 font-medium">Phone number</h4>
                    <div class="mt-4 flex">
                        <label class="block flex-1 ml-3">
                            <input x-model= "userinfo.phone" required type="number" class="p-2 form-input mt-1 block w-full text-gray-700" placeholder="phone">
                        </label>
                    </div>
                </div>
                <div class="mt-4">
                    <h4 class="text-sm text-gray-500 font-medium">Details</h4>
                    <div class="mt-4 flex">
                        <label class="block flex-1 ml-3 ">
                            <input x-model= "userinfo.address" required type="text" class="p-2 form-input mt-1 block w-full text-gray-700" placeholder="Address">
                        </label>
                    </div>
                </div>
                <div class="mt-4">
                    <h4 class="text-sm text-gray-500 font-medium">Date</h4>
                    <div class="mt-6 flex">
                        <label class="block flex-1">
                            <input x-model= "userinfo.date" required type="date" class="form-input mt-1 block w-full text-gray-700" placeholder="Date">
                        </label>
                    </div>
                </div>
                <hr class="mt-5">  
                <div class="flex items-center justify-end mt-6">
                    <button type="submit" class="flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                        <span>Generate Bill</span>
                        <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </button>
                </div>
            </form>
        </div>
        <div x-data="{total_items: 0, total_price: 0}" class="w-full mb-8 flex-shrink-0 order-1 lg:w-1/2 lg:mb-0 lg:order-2">
            <div class="flex justify-center lg:justify-end">
                <div class="border rounded-md max-w-md w-full px-4 py-3">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-700 font-medium" x-text= "`Order total (${total_items})`"></h3>
                        <span class="text-gray-600 text-sm" x-text="total_price > 0 ?`total: $${total_price}`: 'no items'"></span>
                    </div>
                    @forelse($products as $id => $value)
                        <div x-init="total_items+=info.quantity; total_price += (info.quantity * {{$value->price}})" x-data="{info: {quantity: {{$value->quantity}}, deleted: false}}" x-show="!info.deleted" class="flex justify-between mt-6">
                            <div class="flex">
                                <img class="h-20 w-20 object-cover rounded" src="{{$value->image}}" alt="{{$value->name}}">
                                <div class="mx-3">
                                    <h3 class="text-sm text-gray-600">{{$value->name}}</h3>
                                    <div class="flex items-center mt-2">
                                         <button @click="(info.quantity++); setCart({{$id}},info.quantity); total_items++; total_price+= {{$value->price}}" class="text-gray-500 focus:outline-none focus:text-gray-600">
                                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </button>
                                        <span class="text-gray-700 mx-2" x-text="info.quantity"></span>
                                        <template x-if="info.quantity > 1">
                                            <button @click="(info.quantity > 1 ? info.quantity-- : info.quantity); setCart({{$id}},info.quantity); total_items--; total_price -= {{$value->price}}" class="text-gray-500 focus:outline-none focus:text-gray-600">
                                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </button>
                                        </template>
                                        <button @click="removeFromCart({{$id}}); info.deleted=true; total_items-=info.quantity; total_price -= {{$value->price}}* info.quantity" class="ml-4 text-gray-500 focus:outline-none focus:text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <span class="text-gray-600">${{$value->price}}</span>
                        </div>
                    @empty
                    <div class="text-gray-600 mt-2 text-center "> Empty cart !!</div>
                    @endforelse
                    <hr class="mt-4">  
                    <div class="flex space-x-5">                  
                        <button @click="window.location.reload()" class="flex mt-6 items-center px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                            <span>Update</span>
                            <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
