<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @role('admin')
                        I am an admin!
                    @else
                        I am not an admin...
                    @endrole
                    You're logged in!

                        @foreach($subscriptions as $subscription)
                            {{$subscription->stripe_status}}
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
