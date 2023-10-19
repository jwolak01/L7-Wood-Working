@extends('layouts.app')

{{-- --------------------------------------------------- --}}
{{-- --- BELOW IS THE L7 EDIT PRODUCT CODE ---- --}}
{{-- --------------------------------------------------- --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>Edit Product</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" />
</head>

<body class="bg-white">

    {{-- When the user clicks on the Confirm Edit button all necessary changes to the Product will be made --}}
    <form id="main-form" class="py-6 mt-24 lg:mx-96" action="/business/product/edit/{{ $product->id }}" method="POST"
        enctype=multipart/form-data>
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <h1 class="mb-10 text-3xl text-zinc-800 text-center font-redHatDisplay">Modify Your Display</h1>

        {{-- Edit Product Name and Description Inputs --}}
        <div class="mb-5 mx-10">
            <label class="mb-3 block text-base font-medium text-[#07074D]">
                Edit Name:
            </label>
            <input type="text" name="productName" id="productName" value="{{ $product->productName }}"
                form="main-form"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
        </div>

        <div class="mb-5 mx-10">
            <label for="message" class="mb-3 block text-base font-medium text-[#07074D]">
                Edit Description:
            </label>
            <textarea rows="10" name="productDescription" id="productDescription" form="main-form"
                class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"> {{ $product->productDescription }}</textarea>
        </div>

        {{-- Edit Product's Cover Image --}}
        <div class="mb-5 mx-10">
            <h2 class="text-zinc-800 text-center font-redHatDisplay">Edit Cover Image</h2>

            <img class="mt-3 h-64 w-full object-cover lg:scale-75" id="currentCoverImage"
                src="{{ $productCoverImagePath }}" />

            {{-- Below is a Vue.js Component called EditCoverImageApp.vue --}}
            {{-- -- This Component uses FilePond in order to Edit images -- --}}
            <div class="wrapper">
                <div id="reveal-content" class="show">
                    <div id="editCoverImageApp">
                    </div>
                </div>
            </div>
        </div>

        @vite('resources/js/editCoverImageApp.js')

        {{-- Delete/Insert Additional Images to Product --}}
        <div class="grid mx-2 md:grid-cols-2 md:gap-1">
            <div>
                {{-- Once the "bulk_delete" button is pressed the system will remove all of the 
                    images that have been checked in the checkbox 

                    IMPORTANT! In order for the system to delete the images in real time
                    jQuery and ajax have been used which can be located within the script tag below html code --}}
                <div class="flex justify-center">
                    <h2 class="text-zinc-800 text-center ml-6 font-redHatDisplay mb-5">Remove Existing
                        Image(s)
                    </h2>
                    <button type="button" name="bulk_delete" id="bulk_delete" form="image-form" class="h-full"><img
                            class="flex-justify-center hover:scale-110 transition ease-out duration-500"
                            src="{{ asset('images/trash.png') }}"></button>
                </div>
                {{-- Displays all Images, not including the Cover Image, relating to the Product being examined --}}
                <div class="image_table grid grid-cols-2 gap-2 justify-evenly mx-4 mt-4 mb-5 md:mt-0 mr-5">
                    @foreach ($productPaths as $productPath)
                        <form id="image-form" method="POST">
                            {{ csrf_field() }}
                            <input type="checkbox" name="image_checkbox" value="{{ $productPath }}"
                                class="image_checkbox absolute mt-2 ml-2 scale-125" form="image-form" />
                            <img src="{{ $productPath }}" class="h-36 md:h-48 w-full object-cover"
                                form="image-form" />
                            <input type="hidden" class="id" name="id" value="{{ $product->id }}"
                                form="image-form" />
                        </form>
                    @endforeach
                </div>
            </div>
            {{-- Below is a Vue.js Component called EditAddImagesApp.vue --}}
            <div class="md:border-l-2 border-gray-400" id='editAddImagesApp'></div>
            @vite('resources/js/editAddImagesApp.js')

        </div>

    </form>

    {{-- Once this button is clicked all necessary changes will be made --}}
    <div class="pb-6 mx-10 lg:mx-96">
        <button
            class="hover:shadow-md w-full rounded-md bg-[#f41f26bb] hover:bg-[#228280] transition ease-out duration-500 py-3 px-8 text-center text-base font-semibold text-white outline-none"
            form="main-form">
            Confirm Edit
        </button>
    </div>
</body>

</html>

{{-- Below examines all checkboxes that have been checked and adds them to a list.
    The list and Product id will be applied to remove the images from both the Database and directory --}}
<script type="text/javascript">
    $(document).on('click', '#bulk_delete', function() {
        var image_path = [];
        var id;
        $('.image_checkbox:checked').each(function() {
            image_path.push($(this).val());
        });
        $('.id').each(function() {
            id = $(this).val();
            console.log(id);
        });
        // Sends the Product id and all paths, relating to the checked checkboxes, to the Product Controller
        $.ajax({
            url: "{{ route('images.removeImage') }}",
            method: "get",
            data: {
                image_path: image_path,
                id: id
            },
            success: function(data) {
                console.log("data-removed")
                console.log(data)
                location.reload();
            }
        });
    });
</script>
