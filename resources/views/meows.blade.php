<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Latest Meows') }}
        </h1>
    </x-slot>

<!-- @section('title', 'Latest Meows!') -->

<!-- @section('heading', 'Latest Meows') -->

<!-- @section('content') -->
    <x-slot name="slot">
        <div>
            @foreach ($data as $meow)
                @include('meow', ['meow' => $meow])
            @endforeach
        </div>
    </x-slot>
<!-- @endsection -->
</x-app-layout>
