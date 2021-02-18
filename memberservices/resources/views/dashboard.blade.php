<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Member Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                    @if (session('status'))
                            <div class="bg-gray-200 px-6 py-4 mx-6 my-4 rounded-md text-lg flex items-center">
                                <svg viewBox="0 0 24 24" class="text-blue-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
                                    <path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm.25,5a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,12.25,5ZM14.5,18.5h-4a1,1,0,0,1,0-2h.75a.25.25,0,0,0,.25-.25v-4.5a.25.25,0,0,0-.25-.25H10.5a1,1,0,0,1,0-2h1a2,2,0,0,1,2,2v4.75a.25.25,0,0,0,.25.25h.75a1,1,0,1,1,0,2Z"></path>
                                </svg>
                                <span class="text-blue-800"> {{ session('status') }} </span>
                            </div>
                    @endif

                    @if($subscription)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-bold text-lg lg:text-2xl mb-4">Your Subscriptions</h2>
                        <!-- component -->
                        <table class="border-collapse w-full">
                            <thead>
                            <tr>
                                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Subscription</th>
                                @if($user->subscribed())
                                    <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Marketplace</th>
                                @endif
                                @if(($subscription->onTrial() && $subscription->trial_ends_at) || $subscription->ends_at)
                                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Valid Through</th>
                                @endif
                                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Status</th>
                                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-gray-200 px-2 py-1 text-xs font-bold uppercase">Subscription</span>
                                    <span class="text-sm">
                                        {{$subscription->product_name}}
                                    </span>
                                </td>
                                @if($user->subscribed())
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                        <span class="lg:hidden absolute top-0 left-0 bg-gray-200 px-2 py-1 text-xs font-bold uppercase">Marketplace</span>

                                        <div class="text-sm" x-data="showMarketplace({{$subscription->created_at->timestamp}})">
                                             <div x-show="isPending()">
                                                <span class="animate-pulse text-green-900 font-semibold">Processing</span>
                                            </div>
                                            <div x-show="isComplete()">
                                                <a class="text-c-purple underline hover:no-underline" href="https://fdc.enjoymydeals.com/?cvt={{$user->CVT}}" target="_blank">Visit Marketplace</a>
                                            </div>
                                        </div>

                                        <script>
                                            function showMarketplace(purchaseTime) {
                                                var now = Date.now() / 1000 | 0;
                                                var minutesAgo = (now-purchaseTime)/60;
                                                console.log(minutesAgo);
                                                return {
                                                    isComplete() {
                                                        return minutesAgo >= 3
                                                    },
                                                    isPending() {
                                                        return minutesAgo < 3
                                                    },
                                                }
                                            }
                                        </script>
                                    </td>
                                @endif
                                @if(($subscription->onTrial() && $subscription->trial_ends_at) || $subscription->ends_at)
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-gray-200 px-2 py-1 text-xs font-bold uppercase">Valid Through</span>
                                    <span class="text-sm">
                                        @if($subscription->trial_ends_at)
                                            {{ $subscription->trial_ends_at->toFormattedDateString() }}
                                        @elseif($subscription->ends_at)
                                            {{ $subscription->ends_at->toFormattedDateString() }}
                                        @endif
                                    </span>
                                </td>
                                @endif
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-gray-200 px-2 py-1 text-xs font-bold uppercase">Status</span>
                                    <span class="rounded py-1 px-3 text-xs font-bold {{$subscription->color}}">{{$subscription->status_text}}</span>
                                </td>
                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                    <span class="lg:hidden absolute top-0 left-0 bg-gray-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>

                                    <a href="{{route('billing')}}" class="text-c-purple hover:text-c-purple-light underline pl-6 text-sm">Update Billing Info</a>

                                    @if($subscription->stripe_status == 'canceled')
                                        <a href="{{route('renew')}}" class="text-c-purple hover:text-c-purple-light underline pl-6 text-sm">Renew</a>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    @endif


                    @if(count($invoices))

                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-bold text-lg lg:text-2xl mb-4">Your Invoice History</h2>
                        <table class="border-collapse w-full">
                            <thead>
                            <tr>
                                <th class="p-3 font-bold uppercase bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">Description</th>
                                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Total</th>
                                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Date</th>
                                <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($invoices as $invoice)
                                <tr class="bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                        <span class="lg:hidden absolute top-0 left-0 bg-gray-200 px-2 py-1 text-xs font-bold uppercase">Description</span>
                                        {{ $invoice->lines->first()->description }}
                                    </td>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                        <span class="lg:hidden absolute top-0 left-0 bg-gray-200 px-2 py-1 text-xs font-bold uppercase">Total</span>
                                        {{ $invoice->total() }}
                                    </td>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                        <span class="lg:hidden absolute top-0 left-0 bg-gray-200 px-2 py-1 text-xs font-bold uppercase">Date</span>
                                        {{ $invoice->date()->toFormattedDateString() }}
                                    </td>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                        <span class="lg:hidden absolute top-0 left-0 bg-gray-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
                                        <a class="text-c-purple hover:text-c-purple-light underline pl-6" target="_blank" href="{{ $invoice->hosted_invoice_url }}">Download</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    @endif

                @if (!$user->subscribed('default'))
                    @include('partials.pricing-table')
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
