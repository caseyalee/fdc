<script src="https://js.stripe.com/v3/"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile & Contact Preferences') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-6 bg-white border-b border-gray-200">
                    <div class="mx-auto mt-8">
                        @include('partials.user-profile-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
