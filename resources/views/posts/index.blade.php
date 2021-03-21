<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-center text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-validation-errors />
            <x-success-message />

            {{-- add post button  --}}

            {{-- show add post button option only if is the page for posts index (not trashed-posts index) --}}
            @if (\Request::is('posts'))
            <div class="flex justify-end">
                <button>
                    <a class="bg-transparent text-gray-500 font-semibold hover:text-gray-700 py-2 px-4 border border-b border-gray-200 hover:border-gray rounded shadow-sm sm:rounded-lg"
                        href=" {{ route('posts.create')}}">
                        Add Post
                    </a>
                </button>
            </div>
            @endif

            {{-- posts table  --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                @if ($posts->count() > 0)
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Image
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Title
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Category
                                                </th>
                                                <th scope="col" class="relative px-6 py-3">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                                <th scope="col" class="relative px-6 py-3">
                                                    <Trash class="sr-only">Trash</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($posts as $post)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <img src="{{ asset('storage/' . $post->image) }}" width="80px"
                                                        alt="Image of the Post">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $post->title }}
                                                </td>
                                                <td class="px-7 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $post->category->name }}
                                                </td>
                                                <td class=" px-6 py-4 whitespace-nowrap text-right text-sm
                                                        font-medium">
                                                    @if (!$post->trashed())
                                                    <a href="{{ route('posts.edit', $post->id) }}"
                                                        class="text-indigo-600 hover:text-indigo-900">
                                                        Edit
                                                    </a>
                                                    @else
                                                    <form action="{{route('restore-posts', $post->id)}}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            class="text-indigo-600 hover:text-indigo-900">
                                                            Restore
                                                        </button>
                                                    </form>
                                                    @endif

                                                </td>
                                                <td>
                                                    <form action="{{route('posts.destroy', $post->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-900 ml-3">
                                                            {{ $post->trashed() ? 'Delete' : 'Trash'}}
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-4">
                                    {{ $posts->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @else
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    No Posts Yet!
                </div>
                @endif
            </div>
        </div>
    </div>

</x-app-layout>