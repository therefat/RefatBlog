@section('title','Browser All Post')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Browse Posts
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4 text-right">
                        <a href="{{route('admin.post.create')}}">
                            <x-primary-button>Add a post</x-primary-button>
                        </a>

                    </div>
                    {{--                    success message --}}
                    @if(session('success'))

                        <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Success</span>
                            <div>
                                <span class="font-medium">Success!</span> {{session('success')}}
                            </div>
                        </div>
                    @endif
                    {{--                   Post table --}}


                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Author
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Views
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Created
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($posts as $post)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$post->title}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$post->category->name}}
                                    </td>
                                    <td class="px-6 py-4">

                                        {{$post->user->name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{number_format($post->views)}}

                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $post->created_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 space-x-3 text-right">
                                        <a href="{{route('blog.show',$post)}}" target="_blank" class="font-medium text-teal-600 dark:text-teal-500 hover:underline">View</a>
                                        <a href="{{route('admin.post.edit',$post)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                        <form class="inline-flex" onclick="return confirm('Are You Sure Delete This Post')" action="{{route('admin.post.destroy',$post)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class=" font-medium text-red-600 dark:text-blue-500 hover:underline">Delete</button>

                                        </form>
                                    </td>
                                </tr>
                            @empty

                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        No Data Found
                                    </th>
                                    <td class="px-6 py-4">

                                    </td>
                                    <td class="px-6 py-4">

                                    </td>
                                    <td class="px-6 py-4">

                                    </td>
                                    <td class="px-6 py-4">

                                    </td>
                                    <td class="px-6 py-4 space-x-3 text-right">
                                    </td>
                                </tr>


                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4"> {{$posts->links()}}</div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>


