<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Meows for $name") }}
        </h1>
    </x-slot>
    <x-slot name="slot">
    <div>
        @foreach ($data as $meow)
            @include('meow', ['meow' => $meow])
        @endforeach
    </div>
    </x-slot>
</x-app-layout>