@section('title','Create New Post')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Write a New Post
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{--                   Write a new Post Form--}}
                    <form method="post" novalidate action="{{ route('admin.post.store') }}" class=" space-y-6">
{{--                        Title--}}
                        <div>
                            <x-input-label for="title" value="Title" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
{{--                        Body--}}
                        <div>
                            <x-input-label for="body" value="Body" />
                            <textarea id="body"  name="body" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..." :value="old('body')" required autofocus autocomplete="body"></textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('body')" />
                        </div>
{{--                    Category--}}
                        <div>
                            <x-input-label for="category" value="Category" />



                                <select id="category" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required >

                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @selected(old('category_id') == $category->id)>{{$category->name}} </option>
                                    @endforeach

                                </select>


                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                        </div>



                        <x-primary-button>Create</x-primary-button>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

