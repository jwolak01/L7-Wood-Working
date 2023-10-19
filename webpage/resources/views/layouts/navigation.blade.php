<!DOCTYPE html>
<html>

{{-- NavBar for Gallery View --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Styling --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    {{-- Allows for Product fade-in  --}}
    <link rel="stylesheet" href="{{ asset('style/fadeIn.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('style/navbarHamburgerAnimation.css') }}" type="text/css">

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    {{-- This script is used for Hamburger button click animation --}}
    <script src="{{ asset('js/hamburgerButtonClickAnimation.js') }}"></script>

    @vite('resources/css/app.css')
</head>

<body>
    <div class="fixed top-0 z-10 bg-zinc-800 w-full drop-shadow-lg">
        <div class="relative mx-auto">
            <nav class="flex items-center w-full" x-data="{ open: false }">
                {{-- L7 Logo --}}
                <div class="flex justify-start items-center ml-6 lg:ml-24 md:ml-10 w-full h-16">
                    <div class="font-fellPica text-zinc-800 hover:text-black">
                        <a href="{{ url('/home') }}" class="flex items-center">
                            <h1 class="text-2xl md:text-3xl text-white">L7</h1>
                            <h1 class="text-xl mdtext-xl ml-0.5 md:ml-2 text-white">woodworking</h1>
                        </a>
                    </div>
                </div>

                {{-- Menu Options for larger screens --}}
                <div class="hidden lg:flex justify-end items-center mr-20 font-poppins text-white font-thin">
                    <a href="/products"
                        class="py-2 px-4 cursor-pointer tracking-wide border-x-zinc-800 border-x-2 hover:border-x-gray-100 hover:text-[#228280]  transition duration-700 ease-in-out">
                        <h2>Gallery</h2>
                    </a>
                    {{-- <a href="/custom" class="py-2 px-4 cursor-pointer tracking-wide border-x-zinc-800 border-x-2 hover:border-x-gray-100 hover:text-[#228280] transition duration-700 ease-in-out"><h1>Custom</h1></a> --}}
                    <a href="/home#About"
                        class="py-2 px-4 cursor-pointer tracking-wide border-x-zinc-800 border-x-2 hover:border-x-gray-100 hover:text-[#228280] transition duration-700 ease-in-out">
                        <h2>About</h2>
                    </a>
                </div>

                {{-- Hamburger Menu Button --}}
                <button onclick="myFunction(this)"
                    class="text-white w-12 h-10 mr-8 relative focus:outline-none lg:hidden" @click="open = !open">
                    <span class="sr-only">Open main menu</span>
                    <div class=" absolute transform  -translate-x-1/2 -translate-y-1/2">
                        <span aria-hidden="true"
                            class=" absolute h-0.5 w-8 bg-current transform transition duration-500 ease-in-out"
                            :class="{ 'rotate-45': open, ' -translate-y-1.5': !open }"></span>
                        <span aria-hidden="true"
                            class=" absolute  h-0.5 w-8 bg-current transform transition duration-500 ease-in-out"
                            :class="{ 'opacity-0': open }"></span>
                        <span aria-hidden="true"
                            class=" absolute  h-0.5 w-8 bg-current transform  transition duration-500 ease-in-out"
                            :class="{ '-rotate-45': open, ' translate-y-1.5': !open }"></span>
                    </div>
                </button>
            </nav>
            {{-- Menu Options for Mobile/Tablet --}}
            <ul id="menu"
                class="text-black w-full font-poppins font-thin text-center text-[17px] md:text-[19px] lg:hidden">
                <li>
                    <ul class="text-zinc-800 rounded ">
                        <li id="link" class="mt-5 pt-8 text-white md:text-xl"><a
                                class="border-y-zinc-800 border-y-2 py-1 px-3 hover:border-y-gray-100 text-white transition duration-700 ease-in-out"
                                href="{{ url('/products') }}">Gallery</a></li>
                        {{-- <li id="link" class="w-full my-10 text-white hover:text-gray-200 md:text-xl md:py-8"><a
                                href="{{ url('/custom') }}">Custom</a></li> --}}
                        <li id="link" class="mt-5 pb-8 text-white md:text-xl"><a
                                class="border-y-zinc-800 border-y-2 py-1 px-3 hover:border-y-gray-100 text-white transition duration-700 ease-in-out"
                                href="/home#about">About</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</body>

</html>
