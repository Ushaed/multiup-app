<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css" rel="stylesheet"/>
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    </head>
    <body class="antialiased">

        <div class="max-w-md mx-auto bg-slate-100 rounded-lg p-4 mt-12">
            <form method="post" action="/" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500">
                    @error('title')
                        <div class="text-red-400 text-sm">{{ $message }}</div>
                    @enderror
                </div>      
                <div class="mb-6">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                    <textarea name="description" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray 50 rounded-lg border border-gray-300 focus:ring-blue-500" placeholder="Leave a comment..."></textarea>
                    @error('description')
                        <div class="text-red-400 text-sm">{{ $message }}</div>
                    @enderror
                </div> 
                <div>
                    <input type="file" class="filepond" name="image" multiple credits="false">
                </div>    
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Submit
                </button> 
            </form>
        </div>

        <script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
        <script>
            // Register the plugin
            FilePond.registerPlugin(FilePondPluginImageEdit);
            FilePond.registerPlugin(FilePondPluginImageCrop);
            FilePond.registerPlugin(FilePondPluginImageResize);
            FilePond.registerPlugin(FilePondPluginImagePreview);

            // Get a reference to the file input element
            const inputElement = document.querySelector('input[type="file"]');
        
            // Create a FilePond instance
            const pond = FilePond.create(inputElement,{
                imageResizeTargetWidth: 200,
                imageResizeTargetHeight: 144,
                imageResizeUpscale: false,
                imageResizeMode: "contain",
            });

            FilePond.setOptions({
                server: {
                    process: '/upload',
                    revert: '/delete',
                    headers: {
                        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                    }
                },
            });
        </script>
    </body>
</html>
