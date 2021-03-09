<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-center text-xl text-gray-800 leading-tight">
            {{ __('tags') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <x-validation-errors />
            <x-success-message />

            {{-- add tag button  --}}
            <div class="flex justify-end">
                <button>
                    <a class="bg-transparent text-gray-500 font-semibold hover:text-gray-700 py-2 px-4 border border-b border-gray-200 hover:border-transparent rounded shadow-sm sm:rounded-lg"
                        href=" {{ route('tags.create')}}">
                        Add tag
                    </a>
                </button>
            </div>

            {{-- tag table  --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                @if($tags->count() > 0)
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
                                                    Name
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Total Posts
                                                </th>
                                                <th scope="col" class="relative px-6 py-3">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                                <th scope="col" class="relative px-6 py-3">
                                                    <span class="sr-only">Delete</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($tags as $tag)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $tag->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{-- {{ $tag->posts->count() }} --}}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('tags.edit', $tag->id) }}"
                                                        class="text-indigo-600 hover:text-indigo-900">Edit</a>

                                                    <button class="text-red-600 hover:text-red-900 ml-3"
                                                        onclick="handleDelete({{ $tag->id }})">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @include('tags.delete-modal')
                                </div>
                                <div class="mt-4">
                                    {{ $tags->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    No tags Yet!
                </div>
                @endif
            </div>

        </div>
    </div>

</x-app-layout>