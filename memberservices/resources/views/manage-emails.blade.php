<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Emails') }}
        </h2>
    </x-slot>


    <div class="py-6 lg:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 lg:p-8">

                @if (session('status'))
                    <div class="bg-blue-200 px-6 py-4 mx-auto mb-8 rounded-md text-lg flex items-center">
                        <svg viewBox="0 0 24 24" class="text-blue-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
                            <path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm.25,5a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,12.25,5ZM14.5,18.5h-4a1,1,0,0,1,0-2h.75a.25.25,0,0,0,.25-.25v-4.5a.25.25,0,0,0-.25-.25H10.5a1,1,0,0,1,0-2h1a2,2,0,0,1,2,2v4.75a.25.25,0,0,0,.25.25h.75a1,1,0,1,1,0,2Z"></path>
                        </svg>
                        <span class="text-blue-800"> {{ session('status') }} </span>
                    </div>
                @endif

                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="align-middle inline-block min-w-full px-6">
                            <div class="overflow-hidden border-b border-gray-200">

                                <table class="border-collapse w-full border border-gray-200">
                                      <thead class="bg-gray-100 border border-gray-200">
                                        <tr>
                                          <th scope="col" class="px-6 py-2 text-left text-sm font-normal text-gray-500 uppercase tracking-wider border border-gray-200 hidden lg:table-cell">
                                            ID
                                          </th>
                                          <th scope="col" class="px-6 py-2 text-left text-sm font-normal text-gray-500 uppercase tracking-wider border border-gray-200 hidden lg:table-cell">
                                            Subject
                                          </th>
                                          <th scope="col" class="px-6 py-2 text-left text-sm font-normal text-gray-500 uppercase tracking-wider border border-gray-200 hidden lg:table-cell">
                                            Internal Description
                                          </th>
                                          <th scope="col" class="px-6 py-2 text-center text-sm font-normal text-gray-500 uppercase tracking-wider border border-gray-200 hidden lg:table-cell">
                                            Updated
                                          </th>
                                          <th scope="col" class="px-6 py-2 text-center text-sm font-normal text-gray-500 uppercase tracking-wider border border-gray-200 hidden lg:table-cell">
                                            Actions
                                          </th>
                                        </tr>
                                      </thead>
                                
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($emails as $email)

                                        <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0 text-sm">
                                            <td class="px-6 py-4">
                                                <div class="text-xs text-gray-500">
                                                    {{$email->id}}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <a class="text-c-purple hover:text-c-purple-light" href="{{route('admin-emails-edit',$email)}}">{{$email->subject}}</a>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-xs text-gray-500 font-semibold">
                                                    {{$email->internal_description}}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-xs text-gray-500">
                                                {{ $email->updated_at->toFormattedDateString() }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex space-x-2">
                                                    <a href="{{route('admin-emails-edit',$email)}}" class="bg-c-purple hover:bg-c-purple-light text-white px-3 py-1 rounded-sm font-semibold">Edit</a>
                                                    <a href="{{route('admin-email-preview',$email)}}" target="_blank" class="bg-green-600 hover:bg-green-500 text-white px-3 py-1 rounded-sm font-semibold">Preview</a>
                                                </div>
                                            </td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Table --}}

            </div>
        </div>
    </div>
</x-app-layout>