<script src="https://js.stripe.com/v3/"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    <p class="mb-4">
                        Redirecting you to checkout.<br>
                        Click the link below if your browser does not automatically forward you to the payment page.
                    </p>
                    <div id="redirect">
                    {{ $checkout->button('Proceed to Checkout', ['class' => 'p-4 bg-purple-900 text-white text-bold']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('footer-scripts')
        <script>
            window.addEventListener('load', function() {
                $('#redirect').find('button').click();
            });
        </script>
    @endpush
</x-app-layout>
