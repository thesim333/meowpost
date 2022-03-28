<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Focus Meow') }}
        </h1>
    </x-slot>

    <x-slot name="slot">
        <div class="max-w-2xl px-4 py-4 mx-auto">
            @if(Auth::id() == $meow->user->id)
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('updateMeow', $meow->id) }}">
                            @method('PUT')
                            @csrf
                            <div>
                                <x-label for="meow-content" :value="__('New Meow')" />
                                <x-textarea id="meow-content" name="content" required :value="$meow->content" />
                            </div>
                            <x-button class="ml-3">
                                {{ __('Re-Meow!') }}
                            </x-button>
                        </form>
                    </div>
                    <div class="flex px-3 justify-between items-baseline">
                        <h6>User: {{ $meow->user->fullName }}</h6>
                        <span>{{ $meow->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @if(session()->has('success'))
                    <div>
                        <span class="font-medium text-green-600">
                            {{ session()->get('success') }}
                        </span>
                    </div>
                @endif
                <x-submit-success :success="isset($success) ? $success : false" />
            @else
                <x-meow :meow="$meow" />
            @endif
        </div>
    </x-slot>
</x-app-layout>
