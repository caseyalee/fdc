<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Members') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                {{-- BEGIN TABLE --}}
                <div class="flex flex-col">
                  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="align-middle inline-block min-w-full px-6">
                      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                          <thead class="bg-gray-100">
                            <tr>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Subscription
                              </th>
                              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stripe Customer ID
                              </th>
                            </tr>
                          </thead>
                          <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                            <tr>
                              <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                  {{-- <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
                                  </div> --}}
                                  <div>
                                    <div class="text-sm font-medium text-gray-900">
                                      {{$user->full_name}}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                      {{$user->email}}
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap">
                                @if ($user->subscription())

                                <div class="text-sm text-gray-500">{{$user->subscription()->stripe_status}}</div>
                                <div class="text-sm text-gray-900"><a target="_blank" href="https://dashboard.stripe.com/test/subscriptions/{{$user->subscription()->stripe_id}}">{{$user->subscription()->stripe_id}}</a></div>
                                @else    
                                    <div class="text-sm text-gray-500">No Subscription</div>
                                @endif

                              </td>
                              <td class="px-6 py-4 whitespace-nowrap">
                                <a class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800" target="_blank" href="https://dashboard.stripe.com/test/customers/{{$user->stripe_id}}">
                                  {{$user->stripe_id}}
                                </a>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- END TABLE --}}
            </div>
        </div>
    </div>
</x-app-layout>
