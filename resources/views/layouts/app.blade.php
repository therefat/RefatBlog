<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title',"Refat Blog") | {{ config('app.name', 'Refat Blog') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <style>
            .custom-content h1 {
                display: block !important;
                font-weight: bold !important;
                font-size: 2em !important;
                margin-block-start: 0.67em !important;
                margin-block-end: 0.67em !important;
                margin-inline-start: 0 !important;
                margin-inline-end: 0 !important;
            }
            .custom-content h2 {
                display: block !important;
                font-weight: bold !important;
                font-size: 1.5em !important;
                margin-block-start: 0.83em !important;
                margin-block-end: 0.83em !important;
                margin-inline-start: 0 !important;
                margin-inline-end: 0 !important;
            }
            .custom-content h3 {
                display: block !important;
                font-weight: bold !important;
                font-size: 1.17em !important;
                margin-block-start: 1em !important;
                margin-block-end: 1em !important;
                margin-inline-start: 0 !important;
                margin-inline-end: 0 !important;
            }
            .custom-content h6 {
                display: block !important;
                font-weight: bold !important;
                font-size: 0.67em !important;
                margin-block-start: 2.33em !important;
                margin-block-end: 2.33em !important;
                margin-inline-start: 0 !important;
                margin-inline-end: 0 !important;
            }
            /*!* Isolate Summernote styles *!*/
            /*.summernote-container * {*/
            /*    all: revert; !* Unset Tailwind styles *!*/
            /*    font-family: inherit;*/
            /*    font-size: inherit;*/
            /*    line-height: inherit;*/
            /*    margin: 0;*/
            /*    padding: 0;*/
            /*    box-sizing: border-box;*/
            /*}*/

            /* Reapply basic styling for Summernote content */
            .summernote-container .note-editor h1 {
                all: revert; /* Revert to browser's default styles */
            }
            .summernote-container .note-editor h2 {
                all : revert;
            }
            .summernote-container .note-editor h3 {
                all : revert;
            }
            .summernote-container .note-editor h4 {
                all : revert;
            }
            .summernote-container .note-editor h5 {
                all : revert;
            }
            .summernote-container .note-editor h6 {
                all : revert;
            }
            .summernote-container .note-editor p {
                all : revert;
            }
            .summernote-container .note-editor table {
                all : revert;
            }
            .summernote-container .note-editor ul {
                all : revert;
            }
            .summernote-container .note-editor ol {
                all : revert;
            }

            /* Customize Summernote styles if needed */


        </style>
        <!-- include libraries(jQuery, bootstrap) -->
{{--        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">--}}
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}

            </main>
        </div>
        <script>
            $('#summernote').summernote({
                placeholder: 'Hello stand alone ui',
                tabsize: 2,
                height: 300,
                toolbar: [
                    ['style', ['style','code']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                styleTags: ['p', 'h1', 'h2', 'h3', 'h4', 'h5'],
            });
        </script>
    </body>
</html>
