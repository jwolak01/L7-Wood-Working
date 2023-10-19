@extends('layouts.navigation')

@section('content')

    <head>
        <title>Contact</title>
    </head>

    <body class="mt-10">
        <div class="flex items-center justify-center p-12">
            <!-- Author: FormBold Team -->
            <!-- Learn More: https://formbold.com -->
            <div class="mx-auto w-full max-w-[550px]">
                <div class="mt-10 md:mt-16 mb-2 md:mb-6 flex justify-center text-xl md:text-2xl font-redHatDisplay">Contact
                </div>
                <form action="mailto:jwolak73@gmail.com" method="POST" enctype="text/plain">
                    <div class="mb-5">
                        <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                            Full Name
                        </label>
                        <input type="text" name="name" id="name" placeholder="Full Name"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                    <div class="mb-5">
                        <label for="email" class="mb-3 block text-base font-medium text-[#07074D]">
                            Email Address
                        </label>
                        <input type="email" name="email" id="email" placeholder="example@domain.com"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                    <div class="mb-5">
                        <label for="subject" class="mb-3 block text-base font-medium text-[#07074D]">
                            Subject
                        </label>
                        <input type="text" name="subject" id="subject" placeholder="Enter your subject"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                    <div class="mb-5">
                        <label for="message" class="mb-3 block text-base font-medium text-[#07074D]">
                            Message
                        </label>
                        <textarea rows="4" name="message" id="message" placeholder="Type your message"
                            class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></textarea>
                    </div>
                    <div>
                        <button type="submit"
                            class="hover:shadow-form rounded-md bg-[#f41f4de5] hover:bg-[#228280] transition ease-out duration-500 py-3 px-8 text-base font-semibold text-white outline-none">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>

    @extends('layouts.footer')
