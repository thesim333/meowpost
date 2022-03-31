<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Hey $name, What do you want to Meow about today?") }}
        </h1>
    </x-slot>

    <x-slot name="slot">
        <div class="px-4 py-4">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div id="meow-form" data-tags="{{ $tags }}"></div>
        </div>
    </x-slot>
</x-app-layout>
<script src="/js/meow-form.js"></script>
