<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Focus Meow') }}
        </h1>
    </x-slot>

    <x-slot name="slot">
        <div class="px-4 py-4 mx-auto">
            @if(Auth::id() == $meow->user_id)
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <div id="meow-form" data-tags="{{ $tags }}" data-meow="{{ $meow }}" data-meowTags="{{ $meow->tags }}"></div>

                @if(session()->has('success'))
                    <div>
                        <span class="font-medium text-green-600">
                            {{ session()->get('success') }}
                        </span>
                    </div>
                @endif
            @else
                <x-meow :meow="$meow" />
            @endif
        </div>
    </x-slot>
</x-app-layout>
<script src="/js/meow-form.js"></script>
