<form action="{{ $route }}" method="POST">
    @if($type === "update")
    @method('put')
    @endif
    @csrf
    <div class="mt-5">
        <x-label for="name">Name</x-label>
        <input type="text" name="name"
            class="mt-1 w-full px-3 py-2 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition duration-75 @error('name') border border-red-400 @enderror"
            value="{{ old('name') ?? $tag->name }}" autofocus required />
        @error('name')
        <div class="my-1">
            <span class="text-red-500 text-sm">{{ $message }}</span>
        </div>
        @enderror
    </div>
    <x-button class="uppercase tracking-wider my-5">{{ $type }}</x-button>
</form>