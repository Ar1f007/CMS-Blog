<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-center text-xl text-gray-800 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <x-validation-errors />
            <x-success-message />

            {{-- resource for creating post  --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('posts.store') }}">
                        @csrf
                        <div>
                            <x-label for="title" :value="__('Title')" />
                            <x-input type="text" name="title" id="title" class="block mt-1 w-full" value="" />
                        </div>
                        <div class="mt-2">
                            <x-label for="content" :value="__('Content')" />
                            <!--/*// TinyMCE */  -->
                            <textarea class="content block mt-1 w-full border rounded" name="content"
                                id="content"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

{{-- TinyMCE  --}}
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

<script>
    tinymce.init({
            selector:'textarea.content'
            });
</script>