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
                            <form method="POST" action="{{ route('user-profile-update',auth()->user()) }}">
                                @csrf

                                <div class="mb-4 flex space-x-4">
                                    <div class="w-1/2">
                                        <x-label for="first_name" :value="__('First Name')" />
                                        <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name') ?? auth()->user()->first_name" required/>
                                    </div>
                                    <div class="w-1/2">
                                        <x-label for="last_name" :value="__('Last Name')" />
                                        <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name') ?? auth()->user()->last_name" required/>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <x-label for="address1" :value="__('Street Address')" />
                                    <x-input id="address1" class="block mt-1 mb-2 w-full" type="text" name="address1" :value="old('address1') ?? auth()->user()->address1" placeholder="Street Address"/>
                                </div>
                                <div class="mb-4">
                                    <x-label for="address2" :value="__('Suite/Apt. Number')" />
                                    <x-input id="address2" class="block mt-1 w-full" type="text" name="address2" :value="old('address2') ?? auth()->user()->address2" placeholder="Suite/Apt Number"/>
                                </div>

                                <div class="mb-4 flex space-x-4">
                                    <div class="w-1/2">
                                        <x-label for="city" :value="__('City')" />
                                        <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city') ?? auth()->user()->city" required/>
                                    </div>
                                    <div class="w-1/2">
                                        <x-label for="state" :value="__('State')" />
                                        <select name="state" id="state" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" required>
                                            <option value="">Select State</option>
                                            <option value="AL" @if (auth()->user()->state == 'AL') selected @endif>Alabama</option>
                                            <option value="AK" @if (auth()->user()->state == 'AK') selected @endif>Alaska</option>
                                            <option value="AZ" @if (auth()->user()->state == 'AZ') selected @endif>Arizona</option>
                                            <option value="AR" @if (auth()->user()->state == 'AR') selected @endif>Arkansas</option>
                                            <option value="CA" @if (auth()->user()->state == 'CA') selected @endif>California</option>
                                            <option value="CO" @if (auth()->user()->state == 'CO') selected @endif>Colorado</option>
                                            <option value="CT" @if (auth()->user()->state == 'CT') selected @endif>Connecticut</option>
                                            <option value="DE" @if (auth()->user()->state == 'DE') selected @endif>Delaware</option>
                                            <option value="DC" @if (auth()->user()->state == 'DC') selected @endif>District of Columbia</option>
                                            <option value="FL" @if (auth()->user()->state == 'FL') selected @endif>Florida</option>
                                            <option value="GA" @if (auth()->user()->state == 'GA') selected @endif>Georgia</option>
                                            <option value="HI" @if (auth()->user()->state == 'HI') selected @endif>Hawaii</option>
                                            <option value="ID" @if (auth()->user()->state == 'ID') selected @endif>Idaho</option>
                                            <option value="IL" @if (auth()->user()->state == 'IL') selected @endif>Illinois</option>
                                            <option value="IN" @if (auth()->user()->state == 'IN') selected @endif>Indiana</option>
                                            <option value="IA" @if (auth()->user()->state == 'IA') selected @endif>Iowa</option>
                                            <option value="KS" @if (auth()->user()->state == 'KS') selected @endif>Kansas</option>
                                            <option value="KY" @if (auth()->user()->state == 'KY') selected @endif>Kentucky</option>
                                            <option value="LA" @if (auth()->user()->state == 'LA') selected @endif>Louisiana</option>
                                            <option value="ME" @if (auth()->user()->state == 'ME') selected @endif>Maine</option>
                                            <option value="MD" @if (auth()->user()->state == 'MD') selected @endif>Maryland</option>
                                            <option value="MA" @if (auth()->user()->state == 'MA') selected @endif>Massachusetts</option>
                                            <option value="MI" @if (auth()->user()->state == 'MI') selected @endif>Michigan</option>
                                            <option value="MN" @if (auth()->user()->state == 'MN') selected @endif>Minnesota</option>
                                            <option value="MS" @if (auth()->user()->state == 'MS') selected @endif>Mississippi</option>
                                            <option value="MO" @if (auth()->user()->state == 'MO') selected @endif>Missouri</option>
                                            <option value="MT" @if (auth()->user()->state == 'MT') selected @endif>Montana</option>
                                            <option value="NE" @if (auth()->user()->state == 'NE') selected @endif>Nebraska</option>
                                            <option value="NV" @if (auth()->user()->state == 'NV') selected @endif>Nevada</option>
                                            <option value="NH" @if (auth()->user()->state == 'NH') selected @endif>New Hampshire</option>
                                            <option value="NJ" @if (auth()->user()->state == 'NJ') selected @endif>New Jersey</option>
                                            <option value="NM" @if (auth()->user()->state == 'NM') selected @endif>New Mexico</option>
                                            <option value="NY" @if (auth()->user()->state == 'NY') selected @endif>New York</option>
                                            <option value="NC" @if (auth()->user()->state == 'NC') selected @endif>North Carolina</option>
                                            <option value="ND" @if (auth()->user()->state == 'ND') selected @endif>North Dakota</option>
                                            <option value="OH" @if (auth()->user()->state == 'OH') selected @endif>Ohio</option>
                                            <option value="OK" @if (auth()->user()->state == 'OK') selected @endif>Oklahoma</option>
                                            <option value="OR" @if (auth()->user()->state == 'OR') selected @endif>Oregon</option>
                                            <option value="PA" @if (auth()->user()->state == 'PA') selected @endif>Pennsylvania</option>
                                            <option value="RI" @if (auth()->user()->state == 'RI') selected @endif>Rhode Island</option>
                                            <option value="SC" @if (auth()->user()->state == 'SC') selected @endif>South Carolina</option>
                                            <option value="SD" @if (auth()->user()->state == 'SD') selected @endif>South Dakota</option>
                                            <option value="TN" @if (auth()->user()->state == 'TN') selected @endif>Tennessee</option>
                                            <option value="TX" @if (auth()->user()->state == 'TX') selected @endif>Texas</option>
                                            <option value="UT" @if (auth()->user()->state == 'UT') selected @endif>Utah</option>
                                            <option value="VT" @if (auth()->user()->state == 'VT') selected @endif>Vermont</option>
                                            <option value="VA" @if (auth()->user()->state == 'VA') selected @endif>Virginia</option>
                                            <option value="WA" @if (auth()->user()->state == 'WA') selected @endif>Washington</option>
                                            <option value="WV" @if (auth()->user()->state == 'WV') selected @endif>West Virginia</option>
                                            <option value="WI" @if (auth()->user()->state == 'WI') selected @endif>Wisconsin</option>
                                            <option value="WY" @if (auth()->user()->state == 'WY') selected @endif>Wyoming</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4 flex space-x-4">
                                    <div class="w-1/2">
                                        <x-label for="zip" :value="__('Zip Code')" />
                                        <x-input id="zip" class="block mt-1 w-full" type="text" name="zip" :value="old('zip') ?? auth()->user()->zip" required/>
                                    </div>
                                    <div class="w-1/2">
                                        <x-label for="email" :value="__('Email Address')" />
                                        <x-input id="email" class="block mt-1 w-full bg-gray-100 text-gray-500" type="text" name="email" value="{{auth()->user()->email}}" readonly disabled/>
                                    </div>
                                </div>


                                <div class="mb-4">
                                    <div class="mb-4">
                                        <x-label for="preferences" :value="__('Communication Preferences')" />
                                        <span class="text-sm text-gray-500">Please select one or more of the following preferences that you'd like to receive from us.</span>
                                    </div>
                                    <div class="w-full block mb-2">
                                        <label for="pref_marketing_emails" class="inline-flex items-center">
                                            <input id="pref_marketing_emails" name="pref_marketing_emails" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" @if (auth()->user()->pref_marketing_emails != 'false') checked @endif>
                                            <span class="ml-2 text-sm text-gray-600">{{ __('Receive Marketing Emails?') }}</span>
                                        </label>
                                    </div>
                                    <div class="w-full block mb-2">
                                        <label for="pref_newsletter_emails" class="inline-flex items-center">
                                            <input id="pref_newsletter_emails" name="pref_newsletter_emails" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" @if (auth()->user()->pref_newsletter_emails != 'false') checked @endif>
                                            <span class="ml-2 text-sm text-gray-600">{{ __('Receive Monthly Newsletter?') }}</span>
                                        </label>
                                    </div>
                                    <div class="w-full block mb-2">
                                        <label for="pref_sms" class="inline-flex items-center">
                                            <input id="pref_sms" name="pref_sms" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" @if (auth()->user()->pref_sms != 'false') checked @endif>
                                            <span class="ml-2 text-sm text-gray-600">{{ __('Receive SMS Messages?') }}</span>
                                        </label>
                                    </div>

                                </div>

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
