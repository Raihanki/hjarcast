<x-app-layout>
    <x-slot name="header">{{ $title }}</x-slot>
    <x-slot name="title">{{ $title }}</x-slot>

    <x-card class="w-full md:w-3/4">
        <div class="my-3">
            <x-link-button href="{{ route('videos.index', $playlist->slug) }}"
                class="uppercase tracking-wider font-semibold inline-flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                </svg>
                Back to playlist list
            </x-link-button>
        </div>
        <div class="my-3">
            <form action="{{ route('videos.update', [$playlist->slug, $video->unique_video_id]) }}" method="post">
                @method('put')
                @include('videos._form', [
                "type" => "Update"
                ])
            </form>
        </div>
    </x-card>
</x-app-layout>