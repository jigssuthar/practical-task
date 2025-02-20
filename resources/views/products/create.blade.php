
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('ADD') }}
                            </h2>
                        </header>
                    
                        <form method="post" action="{{route('product.store') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            <div>
                                <x-input-label for="" :value="__('Product name')" />
                                <input type="text" id="productName" name="name" class="mt-1 block w-full" required>
                            </div>
                            <div>
                                <x-input-label for="" :value="__('Product Price')" />
                                <input type="number" id="price" name="price" step="0.01" class=" mt-1 block w-full" placeholder="Enter product price" required>
                            </div> <div>
                                <x-input-label for="" :value="__('Product Image')" />
                                <input type="file" id="productImage" name="image" class="mt-1 block w-full" required>

                            </div>
                            <div>
                                <x-input-label for="" :value="__('Product Category')" />
                                <select id="category" name="category_id" class="mt-1 block w-full" required>
                                    <option value="" selected disabled>Choose Category</option>
                                    @foreach ($category as $categorys)
                                    <option value="{{ $categorys->id }}">{{ $categorys->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                               <x-input-label for="" :value="__('Product Description')" />
                               <textarea id="description" name="description" class="mt-1 block w-full" rows="4" placeholder="Enter product description"></textarea>
                           </div>
                            
                       
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                    
                                @if (session('status') === 'password-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
