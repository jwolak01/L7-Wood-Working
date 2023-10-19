@extends('layouts.navigation')



@section('content')


    {{-- The following is the code which provides a Gallery if finished works done by the L7 owner --}}

    <body class="mt-28 md:-mt-10 bg-white">

        {{-- Section describing the View --}}
        <section class="svgWoodWorkingFadeIn mx-2 md:mx-32 lg:mx-96 productFadeTag">
            <div class="md:mt-44 flex justify-center items-center w-full h-24 text-zinc-700 md:text-2xl tracking-wide">
                <h1 class="text-4xl md:text-5xl font-abrilFatface">Gallery</h1>
            </div>
            <div class="flex justify-center items-center -mt-4">
                <img src="{{ asset('images/divider.png') }}" class="w-52" />
            </div>
            <div class="mt-2 flex justify-center">
                <p class="mt-2 mx-4 text-center text-gray-600 mb-16 md:mb-20 text-sm">Scroll down to checkout some of my
                    completed projects
                </p>
            </div>
        </section>

        {{-- Used to increment imageIDs. This incrementation is necessary in order for Bootstrap Carousel to differentiate images --}}
        @php
            $id = 0;
            $imageID = 'id' . $id;
            $productID;
        @endphp

        {{-- -------------------------- --}}
        {{-- - Gallery Section begins - --}}
        {{-- -------------------------- --}}

        <div class="scrolling-pagination">
            @foreach ($productInventory as $key => $product)
                {{-- If $key == 0 display Product and it's information --}}
                @if ($key == 0)
                    <hr class="svgBreakFadeIn hidden md:block border-0.5 border-gray-500 mx-14 lg:mx-80 productFadeTag">
                @else
                    {{-- If $key != 0 hide product information until scrolled upon --}}
                    <div class="reveal">
                        <hr class="hidden md:block border-1 border-gray-700 mx-14 lg:mx-80">
                @endif
                <section class="svgTabFadeIn flex justify-center items-center md:h-1/2 lg:h-4/6 productFadeTag">
                    <div class="w-11/12 lg:w-7/12 justify-center">
                        <div class="md:grid md:grid-cols-2 md:gap-4 place-content-center">
                            <div id="{{ $imageID }}"
                                class="carousel slide carousel-fade w-full flex justify-center lg:scale-90"
                                data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($product as $path)
                                        <div class="carousel-item @if ($loop->first) active @endif">
                                            <div class="slider-image text-center h-80 md:h-96">
                                                <img src="{{ asset($path) }}" alt="{{ asset($path) }}"
                                                    class="h-full w-full object-cover rounded-sm">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Product Arrow functions --}}
                                @if (count($product) > 1)
                                    <div class="h-14">
                                        <button class="carousel-control-prev w-8 h-80 md:h-96" type="button"
                                            data-bs-target="#{{ $imageID }}" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon bg-black rounded-r-md h-1/4"
                                                aria-hidden="true"></span>
                                            <span class="visually-hidden border-2">Previous</span>
                                        </button>
                                        <button class="carousel-control-next w-8 mr-0.75 h-80 md:h-96" type="button"
                                            data-bs-target="#{{ $imageID }}" data-bs-slide="next">
                                            <span class="carousel-control-next-icon bg-black rounded-l-md h-1/4"
                                                aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                @endif
                            </div>

                            {{-- Description of the Product --}}
                            <div class="mb-24 md:0">
                                <h1 class="mt-2 md:mx-6 font-suwannaphum tracking-wide text-2xl md:text-2xl text-gray-600">
                                    {{ $productNames[$id] }}</h1>
                                <p class="text-xs md:text-sm mb-8 mt-2 md:mt-4 lg:mt-8 md:mx-6 text-gray-600">
                                    {{ $productDescriptions[$id] }}</p>
                                @php
                                    $productID = $productIDs[$id];
                                @endphp
                                <form action="/products/{{ $productIDs[$id] }}" method="GET"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <button
                                        class="ml-0 md:ml-6 hover:drop-shadow-2xl bg-[#f22613] hover:bg-[#228280] transition duration-700 ease-in-out py-2 px-16 text-base font-libreBaskerville text-white">View</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
        </div>
        @php
            $id = $id + 1;
            $imageID = 'id' . $id;
        @endphp
        @endforeach
        </div>

        {{-- -------------------------- --}}
        {{-- ----- End of Gallery ----- --}}
        {{-- -------------------------- --}}

        {{-- Bootstrap Carousel bundle --}}
        <script src="{{ asset('js/bootstrapCarousel.min.js') }}"></script>
    </body>

    @extends('layouts.footer')

    {{-- Used to assist in Product animation upon scroll --}}
    <script src="{{ asset('js/scrollAnimation.js') }}"></script>
