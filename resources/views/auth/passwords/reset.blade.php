@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">{{ __('Reset Password') }}</h1>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="mt-8 space-y-6">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label for="email" class="sr-only">{{ __('Email Address') }}</label>
                        <input id="email" type="email" placeholder="{{ __('Email Address') }}"
                            class="appearance-none relative block w-full px-4 py-3 border border-gray-300
                                   placeholder-gray-500 text-gray-900 rounded-md
                                   focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
                                   focus:z-10 sm:text-sm @error('email') border-red-500 @enderror"
                            name="email" value="{{ $email ?? old('email') }}"
                            required autocomplete="email" autofocus>
                        @error('email')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="sr-only">{{ __('New Password') }}</label>
                        <input id="password" type="password" placeholder="{{ __('New Password') }}"
                            class="appearance-none relative block w-full px-4 py-3 border border-gray-300
                                   placeholder-gray-500 text-gray-900 rounded-md
                                   focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
                                   focus:z-10 sm:text-sm @error('password') border-red-500 @enderror"
                            name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password-confirm" class="sr-only">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" placeholder="{{ __('Confirm Password') }}"
                            class="appearance-none relative block w-full px-4 py-3 border border-gray-300
                                   placeholder-gray-500 text-gray-900 rounded-md
                                   focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
                                   focus:z-10 sm:text-sm"
                            name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent
                                   text-sm font-medium rounded-md text-white bg-indigo-600
                                   hover:bg-indigo-700 focus:outline-none focus:ring-2
                                   focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
