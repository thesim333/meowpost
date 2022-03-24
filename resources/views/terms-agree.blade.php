<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Terms and Conditions") }}
        </h1>
    </x-slot>
    <x-slot name="slot">
    <div>
        <p>Things written here that you have to agree to before using MeowPost.</p>
    </div>
    <div>
        <form method="POST" action="{{ route('agreeTerms') }}">
            @csrf
            <div class="block mt-4">
                <label for="agree" class="inline-flex items-center">
                    <input id="agree" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="agree" value="yes" required>
                    <span class="ml-2 text-sm text-gray-600">{{ __('Agree') }}</span>
                </label>
            </div>
            <input type="hidden" name="intended" value="{{ session('intended') }}">
            <x-button class="ml-3">
                {{ __('Go') }}
            </x-button>
    </div>
    </x-slot>
</x-app-layout>
