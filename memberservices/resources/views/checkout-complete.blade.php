<script src="https://js.stripe.com/v3/"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout Complete!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-6 lg:py-20 bg-white border-b border-gray-200 text-center">

                        <h3 class="text-c-purple text-lg lg:text-2xl xl:text-4xl font-bold tracking-tight mb-4">Thanks for joining our rapidly growing FDC Marketplace!</h3>
                        <div class="text-lg max-w-3xl mx-auto">
                            <p class="mb-3 font-bold">
                                You’ll be receiving an email from us shortly to activate your Marketplace account.
                            </p>

                            <div class="flex justify-center items-center w-12 h-12 my-8 mx-auto">
                                    <svg class="animate-spin text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="#782B88" stroke-width="4"></circle>
                                      <path class="opacity-75" fill="#782B88" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                            </div>

                            <p class="mb-3">
                                We’re excited for you to jump in and begin exploring, as you’ll discover easy and convenient discounts that matter to YOU and YOUR everyday life!
                            </p>
                             <p class="mb-3 text-sm">
                                Eager to get there without the email? This page will also redirect you to do the same in less than 1 minute.  Enjoy!
                            </p>
                        </div>

                </div>
            </div>
        </div>
    </div>
    @push('footer-scripts')
        <script>
            window.addEventListener('load', function() {
                var counter = 0;
                function checkTimeout() {
                    counter++;
                    var redirect_url = "{{env('APP_URL')}}" + "/dashboard";
                    if (counter >= 45) {
                      window.location.href = redirect_url;
                    }
                }
                setInterval(checkTimeout, 1000);
            });
        </script>
    @endpush
</x-app-layout>
