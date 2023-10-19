@extends('layouts.app')

{{-- --------------------------------------------------------------- --}}
{{-- --- BELOW IS THE L7 CODE WHICH ALLOWS TO ADD A NEW PRODUCT ---- --}}
{{-- --------------------------------------------------------------- --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <title>Add Product</title>

    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">
</head>

<body class="bg-white">

    {{-- STANDARD FORM ALLOWING THE USER TO ADD THE PRODUCT INFO AS WELL AS IMAGES --}}
    <form class="form font-redHatDisplay py-6 mt-24 lg:mx-96" action="/business/product/create" method="POST" enctype=multipart/form-data>
        @csrf
        <h1 class="mb-10 text-3xl font-bold font-zinc-800 text-center">Add Your Work</h1>

        <div class="mb-5 mx-10">
            <label class="mb-3 block text-base font-medium text-[#07074D]">
                Product Name:
            </label>
            <div role="alert" id="product-alert" style="display:none">
                <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                    Hey Asshole!!
                </div>
                <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                    <p>Am I supposed to guess the name of this shit?</p>
                </div>
            </div>
            <input type="text" name="productName" id="productName" placeholder="enter name of product" value=""
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
        </div>
        <div class="mb-5 mx-10">
            <label for="message" class="mb-3 block text-base font-medium text-[#07074D]">
                Description:
            </label>
            <div role="alert" id="description-alert" style="display:none">
                <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                    The Fuck Bro!!
                </div>
                <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                    <p>Where the fuck is the description??</p>
                </div>
            </div>
            <textarea rows="10" name="productDescription" id="productDescription" placeholder="type your description"
                class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></textarea>
        </div>

        {{-- BELOW IS A VUE.JS COMPONENT, ALLOWING THE USER TO ADD A COVER IMAGE AND ANY ADDITIONAL IMAGES --}}
        <div class="max-w-lg mx-auto mt-8 mb-6">
            <div id="app"></div>
        </div>

        @vite('resources/js/app.js')

        {{-- SUBMIT BUTTON --}}
        <div class="mx-10">
            <button id="submit-check"
                class="hover:shadow-md w-full rounded-md bg-[#f41f26bb] hover:bg-[#228280] transition ease-out duration-500 py-3 px-8 text-center text-base font-semibold text-white outline-none">
                Submit Product
            </button>
        </div>
    </form>
</body>

</html>

<script>
    // Below checks if all input fields have been properly added. 
    // If not the system will notify the user
    document.getElementById("submit-check").addEventListener("click", function(event) {
        var productAlert = document.getElementById('product-alert');
        var descriptionAlert = document.getElementById('description-alert');

        var productName = document.getElementById('productName').value;
        var productDescription = document.getElementById('productDescription').value;

        if (productName == '') {
            productAlert.style.display = 'block';
            event.preventDefault();
        } else {
            productAlert.style.display = 'none';
        }

        if (productDescription == '') {
            descriptionAlert.style.display = 'block';
            event.preventDefault();
        } else {
            descriptionAlert.style.display = 'none';
        }

    });
</script>
