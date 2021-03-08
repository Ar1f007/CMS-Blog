@section('js-bootstrap')
{{-- TinyMCE  --}}
<script src="https://cdn.tiny.cloud/1/oxzyyytfotncnb59039af65x34vf4mh4o5f21caijx6w1kh9/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>

{{-- flatpickr --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection

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
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-label for="title" :value="__('Title')" />
                            <x-input type="text" name="title" id="title" class="block mt-1 w-full" value="" />
                        </div>
                        <div class="mt-5">
                            <x-label for="content" :value="__('Content')" />
                            <!--/*// TinyMCE */  -->
                            <textarea class="content w-full border rounded" name="content" id="content"></textarea>
                        </div>
                        <div class="mt-5">
                            <x-label for="image" :value="__('Image')" />
                            <x-input type="file" name="image" id="image" class="cursor-pointer block mt-1 w-full"
                                value="" />
                        </div>
                        <div class="mt-5">
                            <x-label for="published_at" :value="__('Published At')" />
                            <x-input type="text" name="published_at" id="published_at" class="mt-1 w-full" value="" />
                        </div>

                        {{-- add button  --}}
                        <div class="flex items-cente justify-start  mt-5">
                            <x-button>
                                {{ __('Add Post') }}
                            </x-button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>

{{-- TinyMCE --}}
<script>
    tinymce.init({
      selector: 'textarea.content',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
   });
</script>

{{-- flatpickr --}}
<script>
    flatpickr('#published_at',{
            enableTime: true,
            enableSeconds: true
        })
    $(document).ready(function() {
    $('.tags-selector').select2();
});
</script>