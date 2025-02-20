<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            @if (auth()->user()->hasRole('customer') || auth()->user()->hasRole('admin'))
                    <div>
                        <a href="{{ route('product.index') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                            Product
                        </a>
                    </div>
            @endif

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        <!-- Loop through the products -->
                        @if ($product && count($product) > 0)
                        @foreach($product as $products)
                            <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4">
                                <img class="w-full h-48 object-cover rounded-t-lg" src="{{ asset('products/'. $products->image) }}" alt="Product Image">
                                <div class="mt-4">
                                    <h2 class="text-xl font-semibold text-gray-900">{{ $products->name }}</h2>
                                    <p class="text-gray-600 mt-2">{{ $products->description }}</p>
                                    <p class="mt-2 text-lg font-bold text-gray-900">₹{{ number_format($products->price, 2) }}</p>
                                    <p class="mt-2 text-lg  text-gray-900">Store - {{ $products->user->store_name}}</p>
                                    <a href="" class="block mt-4 bg-blue-500 text-white text-center rounded-md py-2">Order Now</a>
                                </div>
                            </div>
                        @endforeach
                        @else
                        <div class="bg-white p-4 rounded-lg shadow-md">
                            <p class="text-center text-gray-600">No products available at the moment.</p>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>