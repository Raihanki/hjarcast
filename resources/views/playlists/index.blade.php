<x-app-layout>
    <x-slot name="header">{{ $title }}</x-slot>
    <x-slot name="title">{{ $title }}</x-slot>

    <x-card>
        <div class="my-3">
            <x-link-button href="{{ route('playlists.create') }}"
                class="uppercase tracking-wider font-semibold inline-flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Create new playlist
            </x-link-button>
        </div>

        @if(session()->has('message'))
        <div class="py-3 px-5 bg-green-400 text-white rounded-md shadow-sm mb-1">
            <span>{{ session()->get('message') }}</span>
        </div>
        @endif
        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Published</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach($playlists as $playlist)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-sm">
                                {{ $playlists->count() * ($playlists->currentpage() - 1) + $loop->iteration }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $playlist->name }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $playlist->created_at->format('d F Y') }}
                            </td>
                            <td class="px-4 py-3 text-sm" x-data="{'open' : false}">
                                <form action="{{ route('playlists.destroy', $playlist->slug) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <a href="{{ route('playlists.edit', $playlist->slug) }}"
                                        class="text-purple-500">Edit</a> |
                                    <button type="button" @click="open = true"
                                        class="text-purple-500 cursor-pointer">Delete</button>
                                    <x-modal title="Delete Playlist">Are you sure want to delete this playlist ?
                                    </x-modal>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 text-xs font-semibold tracking-wide uppercase bg-gray-50 border-t sm:grid-cols-9">
                {{ $playlists->links() }}
            </div>
        </div>

    </x-card>
</x-app-layout>