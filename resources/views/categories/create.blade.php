<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-center text-xl text-gray-800 leading-tight">
            {{ isset($category) ? __('Edit Category') : __('Create Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <x-validation-errors />
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST"
                        action="{{ isset($category) ?  route('categories.update', $category->id) :  route('categories.store')}}">
                        @csrf

                        @if (isset($category))

                        @method('PUT')

                        @endif

                        <!-- category name -->
                        <div>
                            <x-label for="name" :value="__('NAME')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                value="{{ isset($category) ? $category->name : ''}}" required />
                        </div>

                        {{-- add button  --}}
                        <div class="flex items-cente justify-start  mt-4">
                            <button
                                class="bg-transparent text-gray-500 font-semibold  py-2 px-4 hover:bg-gray-50 border border-b border-gray-200 hover:border-white-500 rounded shadow-sm sm:rounded-lg focus:outline-none">
                                {{ isset($category) ? __('Update') : __('Add Category') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>