<!-- component -->
<section>
    <div class="container max-w-full mx-auto py-12 px-6">

        <h1 class="text-center text-4xl text-black font-medium leading-snug tracking-tight">
            Hi {{auth()->user()->first_name}}!<br>Select a plan below to get started.
        </h1>

        <p class="text-center text-lg text-gray-700 mt-2 px-6 lg:px-12">
            Become a member and gain access to the <a href="/save/" target="_blank">FDC Marketplace</a> for discounts on travel, dining, shopping and more, in addition to Community benefits.
        </p>
        <div class="h-1 mx-auto bg-c-purple-lighter w-24 opacity-75 mt-4 rounded"></div>

        <div class="max-w-full md:max-w-6xl mx-auto my-3 md:pl-8">
            <div class="relative block flex flex-col md:flex-row items-center">
                <div class="w-11/12 max-w-sm sm:w-3/5 lg:w-1/3 sm:my-5 my-8 relative z-0 rounded-lg shadow-lg md:-mr-4">
                    <div class="bg-white text-black rounded-lg shadow-inner shadow-lg overflow-hidden">
                        <div class="block text-left text-sm sm:text-md max-w-sm mx-auto mt-2 text-black px-8 lg:px-6">
                            <h1 class="text-lg font-medium uppercase p-3 pb-0 text-center tracking-wide">
                                Community
                            </h1>
                            <h2 class="text-sm text-gray-500 text-center pb-6">FREE</h2>
                            <span class="text-center block">
                                Curious? Take the first step and start exploring!
                            </span>
                        </div>

                        <div class="flex flex-wrap mt-3 px-6">
                            <ul>
                                <li class="flex items-center">
                                    <div class=" rounded-full p-2 fill-current text-green-700">
                                        <svg class="w-6 h-6 align-middle" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700 text-lg ml-3">Blogs</span>
                                </li>
                                <li class="flex items-center">
                                    <div class=" rounded-full p-2 fill-current text-green-700">
                                        <svg class="w-6 h-6 align-middle" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700 text-lg ml-3">Podcasts</span>
                                </li>
                                <li class="flex items-center">
                                    <div class=" rounded-full p-2 fill-current text-green-700">
                                        <svg class="w-6 h-6 align-middle" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700 text-lg ml-3">Faith Equality Index (FEI)</span>
                                </li>
                                <li class="flex items-center">
                                    <div class=" rounded-full p-2 fill-current text-green-700">
                                        <svg class="w-6 h-6 align-middle" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700 text-lg ml-3">Monthly Newsletter <span class="block text-xs">(optional)</span></span>
                                </li>
                            </ul>
                        </div>
                        <div class="block flex items-center p-8">
                            <a class="text-center mt-3 text-lg font-semibold bg-c-purple w-full text-white rounded-lg px-6 py-3 block shadow-xl hover:bg-c-purple-darker" href="/sign-up/">
                                Sign Up
                            </a>
                        </div>
                    </div>
                </div>

                <div class="w-full max-w-md sm:w-2/3 lg:w-1/3 sm:my-5 my-8 relative z-10 bg-white rounded-lg shadow-lg">
                    <div class="text-sm leading-none rounded-t-lg bg-gray-200 text-black font-semibold uppercase py-4 text-center tracking-wide">
                        Annual
                    </div>
                    <div class="block text-left text-sm sm:text-md max-w-sm mx-auto mt-2 text-black px-8 lg:px-6">
                        <h1 class="text-lg font-medium uppercase p-3 pb-0 text-center tracking-wide">
                            Full Access
                        </h1>
                        <h2 class="text-sm text-gray-500 text-center pb-6"><span class="text-3xl">$25</span> /year</h2>
                        <span class="text-center block">
                            Save $35/yr when you subscribe to an annual plan for just $25.
                        </span>
                    </div>
                    <div class="flex pl-8 justify-start sm:justify-start mt-3">
                        <ul>
                            <li class="flex items-center mb-2">
                                <div class=" rounded-full p-2 fill-current text-green-700">
                                    <svg class="w-6 h-6 align-middle" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg>
                                </div>
                                <span class="text-gray-700 font-bold text-base ml-3">All Community Features</span>
                            </li>
                            <li class="flex items-center mb-2">
                                <div class="rounded-full p-2 fill-current text-green-700">
                                    <svg class="w-6 h-6 align-middle" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg>
                                </div>
                                <span class="text-gray-700 text-lg ml-3">Dining Savings <span class="block text-xs">(Avg $500+/yr)</span></span>
                            </li>
                            <li class="flex items-center mb-2">
                                <div class="rounded-full p-2 fill-current text-green-700">
                                    <svg class="w-6 h-6 align-middle" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg>
                                </div>
                                <span class="text-gray-700 text-lg ml-3">Travel Savings<span class="block text-xs">(Avg $350+/yr)</span></span>
                            </li>
                            <li class="flex items-center mb-2">
                                <div class="rounded-full p-2 fill-current text-green-700">
                                    <svg class="w-6 h-6 align-middle" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg>
                                </div>
                                <span class="text-gray-700 text-lg ml-3">Shopping Savings<span class="block text-xs">(Avg $550+/yr)</span></span>
                            </li>
                        </ul>
                    </div>

                    <div class="block flex items-center p-8 text-center uppercase">
                        <a href="{{route('checkout',['membership'=>'annual'])}}" class="mt-3 text-lg font-semibold bg-c-purple w-full text-white rounded-lg px-6 py-3 block shadow-xl hover:bg-c-purple-darker">
                            Sign Up
                        </a>
                    </div>

                </div>

                <div class="w-11/12 max-w-sm sm:w-3/5 lg:w-1/3 sm:my-5 my-8 relative z-0 rounded-lg shadow-lg md:-ml-4">
                    <div class="bg-white text-black rounded-lg shadow-inner shadow-lg overflow-hidden lg:pl-6">
                        <div class="block text-left text-sm sm:text-md max-w-sm mx-auto mt-2 text-black px-8 lg:px-6">
                            <h1 class="text-lg font-medium uppercase p-3 pb-0 text-center tracking-wide">
                                Monthly
                            </h1>
                            <h2 class="text-sm text-gray-500 text-center pb-6">$5/mo</h2>
                            <span class="text-center block">Pay as you go on a monthly basis.</span>
                        </div>
                        <div class="flex flex-wrap mt-3 px-6">
                            <ul>
                                <li class="flex items-center mb-2">
                                    <div class=" rounded-full p-2 fill-current text-green-700">
                                        <svg class="w-6 h-6 align-middle" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700 font-semibold text-base ml-3">All Community Features</span>
                                </li>
                                <li class="flex items-center mb-2">
                                    <div class="rounded-full p-2 fill-current text-green-700">
                                        <svg class="w-6 h-6 align-middle" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700 text-lg ml-3">Dining Savings <span class="block text-xs">(Avg $500+/yr)</span></span>
                                </li>
                                <li class="flex items-center mb-2">
                                    <div class="rounded-full p-2 fill-current text-green-700">
                                        <svg class="w-6 h-6 align-middle" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700 text-lg ml-3">Travel Savings<span class="block text-xs">(Avg $350+/yr)</span></span>
                                </li>
                                <li class="flex items-center mb-2">
                                    <div class="rounded-full p-2 fill-current text-green-700">
                                        <svg class="w-6 h-6 align-middle" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700 text-lg ml-3">Shopping Savings<span class="block text-xs">(Avg $550+/yr)</span></span>
                                </li>
                            </ul>
                        </div>

                        <div class="block flex items-center p-8 text-center">
                            <a href="{{route('checkout',['membership'=>'monthly'])}}" class="mt-3 text-lg font-semibold bg-c-purple w-full text-white rounded-lg px-6 py-3 block shadow-xl hover:bg-c-purple-darker">
                                Sign Up
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center text-sm">
                Not sure where to start? <a class="text-c-purple underline" href="{{route('checkout',['trial'=>1,'membership'=>'monthly'])}}">Try FREE for 7 days</a>.<br>
                Cancel anytime. Billed monthly after trial expires.
            </div>
        </div>
    </div>
</section>
