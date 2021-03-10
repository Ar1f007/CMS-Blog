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
            {{ isset($post) ? __('Edit Post') : __('Create Post') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <x-validation-errors />
            <x-success-message />

            {{-- resource for creating post  --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST"
                        action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store')}}"
                        enctype="multipart/form-data">
                        @csrf
                        @if (isset($post))
                        @method('PUT')
                        @endif
                        <div>
                            <x-label for="title" :value="__('Title')" />
                            <x-input type="text" name="title" id="title" class="block mt-1 w-full"
                                value="{{ isset($post) ? $post->title : old('title')}}" />
                        </div>
                        <div class="mt-5">
                            <x-label for="content" :value="__('Content')" />
                            <!--/*// TinyMCE */  -->
                            <textarea class="content w-full border rounded" name="content"
                                id="content">{{ isset($post)? $post->content : old('content') }}</textarea>
                        </div>

                        <div class="mt-5">

                            @if (isset($post))
                            <img src="{{ asset('storage/' . $post->image)}}" alt="" style="width: 100%">
                            @endif

                            <x-label for="image" :value="__('Image')" />
                            <x-input type="file" name="image" id="image" class="cursor-pointer block mt-1 w-full" />
                        </div>
                        <div class="mt-5">
                            <x-label for="category" :value="__('Choose Category')" />

                            <select class="block mt-1 w-full" name="category" id="category">
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}" @if (isset($post)) @if ($category->id ==
                                    $post->category_id)
                                    selected
                                    @endif
                                    @endif>
                                    {{$category->name}}
                                </option>
                                @endforeach
                            </select>

                        </div>

                        @if ($tags->count() > 0) <div class="mt-5">
                            <x-label for="tags" :value="__('Tags')" />
                            <select class="block mt-1 w-full" name="tags[]" id="tags" multiple>
                                @foreach ($tags as $tag)

                                {{-- hasTag() method function is defined in Post model --}}
                                <option value=" {{ $tag->id }} " @if(isset($post)) @if ($post->hasTag($tag->id))
                                    selected
                                    @endif
                                    @endif
                                    >
                                    {{ $tag->name }}
                                </option>
                                @endforeach

                            </select>
                        </div>
                        @endif
                        <div class="mt-5">
                            <x-label for="published_at" :value="__('Published At')" />
                            <x-input type="text" name="published_at" id="published_at" class="mt-1 w-full"
                                value="{{ isset($post)? $post->published_at : old('published_at') }}" />
                        </div>

                        {{-- add button  --}}
                        <div class="flex items-cente justify-start  mt-5">
                            <x-button>
                                {{ isset($post) ? __('Update') : __('Add Post') }}
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