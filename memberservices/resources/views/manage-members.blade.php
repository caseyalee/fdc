<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Members') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-x-auto shadow-sm sm:rounded-lg p-8">
                {{-- BEGIN TABLE --}}
                <div class="flex flex-col">
                  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="align-middle inline-block min-w-full px-6">
                        <table class="border-collapse w-full border border-gray-200">
                          <thead class="bg-gray-100 border border-gray-200">
                            <tr>
                              <th scope="col" class="px-6 py-2 text-left text-sm font-normal text-gray-500 uppercase tracking-wider border border-gray-200">
                                Name
                              </th>
                              <th scope="col" class="px-6 py-2 text-left text-sm font-normal text-gray-500 uppercase tracking-wider border border-gray-200">
                                Subscription
                              </th>
                              <th scope="col" class="px-6 py-2 text-left text-sm font-normal text-gray-500 uppercase tracking-wider border border-gray-200">
                                Stripe Customer ID
                              </th>
                              <th scope="col" class="px-6 py-2 text-center text-sm font-normal text-gray-500 uppercase tracking-wider border border-gray-200">
                                Status
                              </th>
                            </tr>
                          </thead>
                          <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                            <tr class="bg-white lg:hover:bg-gray-100 ">
                              
                              <td class="px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center">
                                  <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="{{$user->avatar}}" alt="Avatar">
                                  </div>
                                  <div class="ml-2">
                                    <div class="text-sm font-medium text-gray-900">
                                      {{$user->full_name}}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                      {{$user->email}}
                                    </div>
                                  </div>
                                </div>
                              </td>

                              <td class="px-6 py-4 border-b border-gray-200">
                                @if ($user->subscription())
                                  <div class="text-xs text-gray-600 font-mono"><a target="_blank" href="https://dashboard.stripe.com/subscriptions/{{$user->subscription()->stripe_id}}">{{$user->subscription()->stripe_id}}</a></div>
                                @else    
                                  <div class="text-sm text-gray-500">No Subscription</div>
                                @endif
                              </td>

                              <td class="px-6 py-4 border-b border-gray-200">
                                <a class="text-xs leading-5 font-mono text-gray-600" target="_blank" href="https://dashboard.stripe.com/customers/{{$user->stripe_id}}">
                                  {{$user->stripe_id}}
                                </a>
                              </td>

                              <td class="px-6 py-4 border-b border-gray-200 text-center">
                                <span class="px-2 w-20 text-center inline-block text-xs leading-5 font-semibold rounded-full {{$user->subscription_status_label_color}}">
                                  {{$user->subscription_status_label}}
                                </span>
                              </td>

                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                  </div>
                </div>
                {{-- END TABLE --}}
            </div>
        </div>
    </div>
</x-app-layout>
