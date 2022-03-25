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
            <form method="POST" action="{{ route('makeMeow') }}">
                @csrf
                <div>
                    <x-label for="meow-content" :value="__('New Meow')" />
                    <x-textarea id="meow-content" name="content" required />
                </div>
                <x-button class="ml-3">
                    {{ __('Meow!') }}
                </x-button>
            </form>
            <div id="meowFormSuccess" class="alert alert-success mt-2" hidden>
                <span>Meow Posted! 😺</span>
            </div>
            <div id="meowFormError" class="alert alert-warning mt-2" hidden>
                <span>Meow Post Error!</span>
            </div>
        </div>
    </x-slot>
</x-app-layout>
