@extends('layouts.app')

{{-- ---------------------------------------- --}}
{{-- --- BELOW IS THE L7 MANAGEMENT CODE ---- --}}
{{-- ---------------------------------------- --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <title>L7 Wood Working Management</title>
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
</head>

{{-- ------------------------------------------------------ --}}
{{-- --- TABLE SHOWING A LIST OF ALL EXISTING PRODUCTS ---- --}}
{{-- ------------------------------------------------------ --}}
<body class="bg-gray-900 fadeTag">
    <div class="flex items-center justify-center h-screen bg-gray-900">
        <div class="col-span-12">
            <h1 class="text-4xl md:text-6xl font-abrilFatface text-gray-300 text-center mt-6 mb-3">Management</h1>
            <div class="overflow-y-scroll overh-max-96">
                <table class="table text-gray-400 border-separate space-y-6 text-sm scale-90 md:scale-100">
                    {{-- Table Header --}}
                    <thead class="bg-gray-800 text-gray-400">
                        <tr>
                            <th class="p-3">Name</th>
                            <th class="p-3 text-left">ID</th>
                            <th class="p-3 text-left">Date Added</th>
                            <th class="p-3 text-left">Edit</th>
                            <th class="p-3 text-left">Delete</th>
                        </tr>
                    </thead>
                    {{-- List All Products as well as Edit and Delete Buttons--}}
                    @foreach ($products as $product)
                        <tbody>
                            <tr class="bg-gray-700">
                                <td class="p-3">
                                    <div class="flex align-items-center">
                                        <div class="ml-3">
                                            <div class="text-gray-300">{{ $product->productName }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-3 text-gray-300">
                                    {{ $product->id }}
                                </td>
                                <td class="p-3 font-bold text-gray-300">
                                    {{ $product->created_at }}
                                </td>
                                <td class="p-3">
                                    <form action="products/{{ $product->id }}/edit" method="GET"
                                        enctype="multipart/form-data">
                                        <button
                                            class="material-icons-outlined text-base text-yellow-500 hover:text-gray-100 hover:cursor-pointer mx-2 no-underline">edit</button>
                                    </form>
                                </td>
                                <td class="p-3">
                                    <button onclick="showModal()"
                                        class="material-icons-round text-base text-red-400 hover:text-gray-100 hover:cursor-pointer ml-2 no-underline">delete_outline</button>
                                </td>
                            </tr>
                        </tbody>
                        {{-- Delete Item Confirm/Cancel Modal --}}
                        <div id="myModal" class="absolute top-0 h-screen bg-black opacity-95 modal">
                            <div class="flex justify-center">
                                <div class="w-2/3 lg:w-1/3 h-1/4 text-center">
                                    <section class="modal-content h-1/4 bg-white rounded-lg mt-64">
                                        <h1 class="text-black pt-4">Delete this item?</h1>
                                        <div class="mt-3 flex justify-center pb-4">
                                            <button onclick="hideModal()"
                                                class="text-black border border-black px-4 py-2 rounded-sm mr-3">Cancel</button>
                                            <form action="/products/{{ $product->id }}" method="POST"
                                                enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button
                                                    class="bg-red-700 text-white px-4 py-2 rounded-sm">Delete</button>

                                            </form>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                        {{-- Modal END --}}
                    @endforeach
                </table>
            </div>
            <div>
                {{-- Button for adding a new Product --}}
                <form action="{{ route('product.create') }}">
                    <button
                        class="mt-2 bg-[#228280] hover:bg-[#f41f26bb] w-full hover:shadow-md hover:scale-105 transition ease-out duration-500 px-4 md:px-4 py-2 rounded-md text-gray-200 text-md md:text-xl scale-90 md:scale-100"><a
                            class="text-gray-200 hover:text-gray-200 no-underline"
                            href="{{ route('product.create') }}">Add
                            Work</a></button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    function showModal() {
        modal.style.display = "block";
    }

    function hideModal() {
        modal.style.display = "none";
    }
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>


<style>
    .fadeTag {
        animation: fadeInAnimation ease 2s;
        animation-iteration-count: 1;
        animation-fill-mode: forwards;
    }

    @keyframes fadeInAnimation {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .table {
        border-spacing: 0 15px;
    }

    i {
        font-size: 1rem !important;
    }

    .table tr {
        border-radius: 20px;
    }

    tr td:nth-child(n+5),
    tr th:nth-child(n+5) {
        border-radius: 0 .625rem .625rem 0;
    }

    tr td:nth-child(1),
    tr th:nth-child(1) {
        border-radius: .625rem 0 0 .625rem;
    }

    /* The Modal (background) */
    .modal {
        display: none;
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
