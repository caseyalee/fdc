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

                    {{-- Subscription Table --}}
                    @if( $user->subscribed('default') )

                        <div class="p-6 bg-white border-b border-gray-200">

                            <h2 class="text-bold text-lg lg:text-2xl mb-4">Your Subscriptions</h2>

                            <table class="border-collapse w-full">
                                <thead class="bg-gray-100 border border-gray-200">
                                    <tr>
                                        <th scope="col" class="px-3 py-2 text-left text-sm font-normal text-gray-500 uppercase tracking-wider border border-gray-200 hidden lg:table-cell">Subscription</th>
                                        <th scope="col" class="px-3 py-2 text-center text-sm font-normal text-gray-500 uppercase tracking-wider border border-gray-200 hidden lg:table-cell">Marketplace</th>
                                        @if( $user->subscription('default')->onTrial() || $user->subscription('default')->onGracePeriod() )
                                        <th scope="col" class="px-3 py-2 text-left text-sm font-normal text-gray-500 uppercase tracking-wider border border-gray-200 hidden lg:table-cell">Valid Through</th>
                                        @endif
                                        <th scope="col" class="px-3 py-2 text-center text-sm font-normal text-gray-500 uppercase tracking-wider border border-gray-200 hidden lg:table-cell">Status</th>
                                        <th scope="col" class="px-3 py-2 text-center text-sm font-normal text-gray-500 uppercase tracking-wider border border-gray-200 hidden lg:table-cell">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr class="bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                    {{-- Subscription Title/Name --}}
                                    <td class="w-full lg:w-auto p-3 text-gray-800 border border-b block lg:table-cell relative lg:static">
                                        <span class="lg:hidden absolute top-0 right-0 bg-gray-200 px-2 py-1 text-xs font-bold uppercase">Subscription</span>
                                        <span class="text-sm">
                                            {{$subscription->product_name}}
                                        </span>
                                    </td>


                                    {{-- Marketplace Link --}}
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                        <span class="lg:hidden absolute top-0 right-0 bg-gray-200 px-2 py-1 text-xs font-bold uppercase">Marketplace</span>

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
                                    

                                    {{-- Subscription Date --}}
                                    @if( $user->subscription('default')->onTrial() || $user->subscription('default')->onGracePeriod() )
                                    <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                                        <span class="lg:hidden absolute top-0 right-0 bg-gray-200 px-2 py-1 text-xs font-bold uppercase">Valid Through</span>
                                        <span class="text-sm">
                                            @if($subscription->ends_at)
                                                {{ $subscription->ends_at->toFormattedDateString() }}
                                            @elseif($subscription->trial_ends_at)
                                                {{ $subscription->trial_ends_at->toFormattedDateString() }}
                                            @endif
                                        </span>
                                    </td>
                                    @endif


                                    {{-- Subscription Status --}}
                                    <td class="w-full lg:w-auto p-3 text-gray-800 border border-b block lg:table-cell relative lg:static text-center whitespace-nowrap">
                                        <span class="lg:hidden absolute top-0 right-0 bg-gray-200 px-2 py-1 text-xs font-bold uppercase">Status</span>
                                        <span class="px-2 w-20 text-center inline-block text-xs leading-5 font-semibold rounded-full {{$user->subscription_status_label_color}}">
                                            {{$user->subscription_status_label}}
                                        </span>
                                        @if( $user->subscription('default')->onGracePeriod() )
                                            <br><span class="block text-xs">Non-renewing</span>
                                        @endif
                                    </td>


                                    {{-- Subscription Actions --}}
                                    <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                                        <span class="lg:hidden absolute top-0 right-0 bg-gray-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>


                                        @if( $user->subscription('default')->onGracePeriod() )
                                            <a href="{{route('billing')}}" class="text-c-purple hover:text-c-purple-light underline pl-6 text-sm">Renew</a>
                                        @else
                                            <a href="{{route('billing')}}" class="text-c-purple hover:text-c-purple-light underline pl-6 text-sm">Update Billing Info</a>
                                        @endif
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>

                    @endif
                    {{-- End Subscription Table --}}

                    {{-- Sign Up CTA --}}
                    @if ( !$user->subscribed('default') )
                        @include('partials.pricing-table',['user',$user])
                    @endif


                    @if(count($invoices))
                    {{-- Invoices Table --}}
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-bold text-lg lg:text-2xl mb-4">Your Invoice History</h2>
                        <table class="border-collapse w-full">
                            <thead class="bg-gray-100 border border-gray-200">
                            <tr>
                                <th scope="col" class="px-3 py-2 text-left text-sm font-normal text-gray-500 uppercase tracking-wider border border-gray-200 hidden lg:table-cell">Description</th>
                                <th scope="col" class="px-3 py-2 text-center text-sm font-normal text-gray-500 uppercase tracking-wider border border-gray-200 hidden lg:table-cell">Total</th>
                                <th scope="col" class="px-3 py-2 text-center text-sm font-normal text-gray-500 uppercase tracking-wider border border-gray-200 hidden lg:table-cell">Date</th>
                                <th scope="col" class="px-3 py-2 text-center text-sm font-normal text-gray-500 uppercase tracking-wider border border-gray-200 hidden lg:table-cell">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($invoices as $invoice)
                                <tr class="bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                    <td class="w-full lg:w-auto p-3 text-gray-800 border border-b block lg:table-cell relative lg:static">
                                        {{ $invoice->lines->first()->description }}
                                    </td>

                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                        {{ $invoice->total() }}
                                    </td>

                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                        {{ $invoice->date()->toFormattedDateString() }}
                                    </td>
                                    
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                        <a class="text-c-purple hover:text-c-purple-light underline pl-6" target="_blank" href="{{ $invoice->hosted_invoice_url }}">Download</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                    {{-- End Invoices Table --}}

            </div>
        </div>
    </div>
</x-app-layout>
