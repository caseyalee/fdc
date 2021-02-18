<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Email') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm lg:rounded-lg">
                <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

                    <div class="w-full px-6 py-4 bg-white shadow-md overflow-hidden lg:rounded-lg">

                        <h4 class="text-xl mb-6"><span class="font-bold">Editing Email:</span> {{$email->internal_description}}</h4>

                        @if (session('status'))
                            <div class="bg-blue-100 px-6 py-4 mx-auto my-4 rounded-md text-base flex items-center">
                                <svg viewBox="0 0 24 24" class="text-blue-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
                                    <path fill="currentColor" d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm.25,5a1.5,1.5,0,1,1-1.5,1.5A1.5,1.5,0,0,1,12.25,5ZM14.5,18.5h-4a1,1,0,0,1,0-2h.75a.25.25,0,0,0,.25-.25v-4.5a.25.25,0,0,0-.25-.25H10.5a1,1,0,0,1,0-2h1a2,2,0,0,1,2,2v4.75a.25.25,0,0,0,.25.25h.75a1,1,0,1,1,0,2Z"></path>
                                </svg>
                                <span class="text-blue-800"> {{ session('status') }} </span>
                            </div>
                        @endif

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('admin-emails-update',$email) }}">
                            @csrf
                            <div>
                                <x-label for="subject" :value="__('Subject')" />
                                <span class="text-sm text-gray-500">The subject line of the email.</span>
                                <x-input id="subject" class="block mt-1 w-full" type="text" name="subject" :value="old('subject') ?? $email->subject" required autofocus />
                            </div>

                            <div class="mt-4">
                                <x-label for="email_body" :value="__('Message Body')" />
                                <span class="text-sm text-gray-500">
                                    Note: This field expects <a class="text-purple-600 underline" href="https://www.markdownguide.org/cheat-sheet/" target="_blank">markdown</a> input.<br>
                                    Introduction and signature are automatically included and should not be part of the message body
                                </span>
                                <x-textarea id='email_body' name='email_body' class='block mt-3 w-full' :rows='10' required>{{ old('email_body', $email->email_body) }}</x-textarea>
                            </div>

                            <span class="mt-3 block text-sm text-gray-700"><span class="font-bold">CTA/Button</span> (Optional) : If you want to include a styled call to action button at the end of the email body.</span>

                            <div class="mt-3 flex space-x-4">
                                <div class="w-1/2">
                                    <x-label for="cta_title" :value="__('Button Text')" />
                                    <span class="text-sm text-gray-500">The text of the button.</span>
                                    <x-input id="cta_title" class="block mt-1 w-full" type="text" name="cta_title" :value="old('cta_title') ?? $email->cta_title"/>
                                </div>
                                <div class="w-1/2">
                                    <x-label for="cta_link" :value="__('Button Link/URL')" />
                                    <span class="text-sm text-gray-500">Enter a URL (including https://) or <span class="font-mono text-red-500">[sso]</span> short tag to generate a dynamic SSO link.</span>
                                    <x-input id="cta_link" class="block mt-1 w-full" type="text" name="cta_link" :value="old('cta_link') ?? $email->cta_link"/>
                                </div>
                            </div>


                            <div class="block mt-4">
                                <label for="preview" class="inline-flex items-center">
                                    <input id="preview" name="preview" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Preview after saving?') }}</span>
                                </label>
                            </div>

                            <input type="hidden" name="id" value="{{$email->id}}">

                            <div class="flex items-center justify-end mt-4">
                                <x-button>Update</x-button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>



