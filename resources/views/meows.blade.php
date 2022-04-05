<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Latest Meows') }}
        </h1>
    </x-slot>

    <x-slot name="slot">
        <x-tag-links :tags="$tags" />
        @livewire('meows-incremental')
        @livewireScripts
    </x-slot>
</x-app-layout>
