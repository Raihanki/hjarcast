<x-app-layout>
    <x-slot name="header">{{ $title }}</x-slot>
    <x-slot name="title">{{ $title }}</x-slot>

    <x-card>
        <div class="my-3">
            <x-link-button href="{{ route('playlists.index') }}"
                class="uppercase tracking-wider font-semibold inline-flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                </svg>
                Back to your playlist
            </x-link-button>
        </div>
        <div class="my-3">
            @include('playlists._form', [
            "type" => "update",
            "route" => route('playlists.update', $playlist->slug),
            "playlist" => $playlist
            ])
        </div>
    </x-card>
</x-app-layout>