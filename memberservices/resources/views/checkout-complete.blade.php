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
                <div class="px-6 py-6 bg-white border-b border-gray-200">
                        <h3 class="text-c-purple text-lg lg:text-2xl xl:text-4xl font-bold tracking-tight mb-4">Thanks for joining our rapidly growing FDC Marketplace!</h3>
                        <div class="text-lg">
                            <p class="mb-3 font-bold">
                                You’ll be receiving an email from us shortly to activate your Marketplace account.<br>
                                Please take a moment to update your contact preferences below.
                            </p>
                        </div>
                        <div class="mx-auto mt-8">
                            @include('partials.user-profile-form')
                        </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
