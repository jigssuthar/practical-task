
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Edit') }}
                            </h2>
                        </header>
                    
                        <form method="post" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            @method('PUT')
                            
                            <!-- Product Name -->
                            <div>
                                <x-input-label for="productName" :value="__('Product name')" />
                                <input type="text" id="productName" name="name" class="mt-1 block w-full" value="{{ $product->name }}" required>
                            </div>
                            
                            <!-- Product Price -->
                            <div>
                                <x-input-label for="price" :value="__('Product Price')" />
                                <input type="number" id="price" name="price" step="0.01" class="mt-1 block w-full" value="{{ $product->price }}" placeholder="Enter product price" required>
                            </div>
                            
                            <!-- Product Image -->
                            <div>
                                <x-input-label for="productImage" :value="__('Product Image')" />
                                
                                <!-- Show current image -->
                                @if ($product->image)
                                    <div class="mb-4">
                                        <img src="{{ asset('products/'.$product->image) }}" alt="Product Image" class="w-32 h-32 object-cover">
                                    </div>
                                @endif
                                
                                <!-- File input for updating image -->
                                <input type="file" id="productImage" name="image" class="mt-1 block w-full">
                            </div>
                        
                            <!-- Product Category -->
                            <div>
                                <x-input-label for="category_id" :value="__('Product Category')" />
                                <select class="mt-1 block w-full select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name="category_id" required>
                                    <option selected="selected" disabled>Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <!-- Product Description -->
                            <div>
                                <x-input-label for="description" :value="__('Product Description')" />
                                <textarea id="description" name="description" class="mt-1 block w-full" rows="4" placeholder="Enter product description">{{ $product->description }}</textarea>
                            </div>
                            
                            <!-- Submit button -->
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update') }}</x-primary-button>
                        
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
