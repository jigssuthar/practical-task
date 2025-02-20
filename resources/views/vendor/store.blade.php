<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Store Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Store Information') }}
                            </h2>
                    
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Update your Store information here.") }}
                            </p>
                        </header>
                        <form method="post" action="{{ route('vendor.update') }}" enctype="multipart/form-data"  class="mt-6 space-y-6">
                            @csrf
                            @method('PUT') 
                            <div>
                                <x-input-label for="name" :value="__('store_name')" />
                                <x-text-input id="store_name" name="store_name" type="text" class="mt-1 block w-full" :value="old('store_name', $user->store_name)" required autofocus autocomplete="store_name" />
                                <x-input-error class="mt-2" :messages="$errors->get('store_name')" />
                            </div>
                            <div>
                                <x-input-label for="name" :value="__('Description')" />
                                <x-text-input id="description" name="store_description" type="text" class="mt-1 block w-full" :value="old('store_description', $user->store_description)" required autofocus autocomplete="description" />
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                    
                                @if (session('status') === 'profile-updated')
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
