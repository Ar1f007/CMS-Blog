<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-center text-xl text-gray-800 leading-tight">
            {{ isset($tag) ? __('Edit Tag') : __('Create Tag') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <x-validation-errors />
            <x-error />
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST"
                        action="{{ isset($tag) ?  route('tags.update', $tag->id) :  route('tags.store')}}">
                        @csrf

                        @if (isset($tag))

                        @method('PUT')

                        @endif

                        <!-- tag name -->
                        <div>
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                value="{{ isset($tag) ? $tag->name : ''}}" required />
                        </div>

                        {{-- add button  --}}
                        <div class="flex items-cente justify-start  mt-4">
                            <button
                                class="bg-transparent text-gray-500 font-semibold  py-2 px-4 hover:bg-gray-50 border border-b border-gray-200 hover:border-white-500 rounded shadow-sm sm:rounded-lg focus:outline-none">
                                {{ isset($tag) ? __('Update') : __('Add Tag') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>