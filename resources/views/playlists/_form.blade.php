<form action="{{ $route }}" method="POST" enctype="multipart/form-data">
    @if($type === "update")
    @method('put')
    @endif
    @csrf
    <div class="mt-5 block md:flex">
        @isset($playlist->thumbnail)
        <div class="mb-0 md:-mb-3 mr-5">
            <img class="w-40" id="prevThumbnail" src="{{ asset('storage/' . $playlist->thumbnail) }}"
                alt="{{ $playlist->name }}">
        </div>
        @endisset
        <div class="block">
            <x-label for="thumbnail">Thumbnail</x-label>
            <input type="file" id="thumbnail" name="thumbnail" class="mt-2 block focus:outline-none">
            @error('thumbnail')
            <div class="my-1">
                <span class="text-red-500 text-sm">{{ $message }}</span>
            </div>
            @enderror
        </div>
    </div>
    <div class="mt-5">
        <x-label for="name">Name</x-label>
        <input type="text" name="name"
            class="mt-1 w-full px-3 py-2 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition duration-75 @error('name') border border-red-400 @enderror"
            value="{{ old('name') ?? $playlist->name }}" autofocus required />
        @error('name')
        <div class="my-1">
            <span class="text-red-500 text-sm">{{ $message }}</span>
        </div>
        @enderror
    </div>
    <div class="mt-5">
        <x-label for="description">Description</x-label>
        <textarea type="text" name="description"
            class="mt-1 w-full px-3 py-2 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition duration-75 @error('description') border border-red-400 @enderror"
            required>{{ old('description') ?? $playlist->description }}</textarea>
        @error('description')
        <div class="my-1">
            <span class="text-red-500 text-sm">{{ $message }}</span>
        </div>
        @enderror
    </div>
    <div class="mt-5">
        <x-label for="price">Price</x-label>
        <input type="number" name="price"
            class="mt-1 w-full px-3 py-2 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition duration-75 @error('price') border border-red-400 @enderror"
            value="{{ old('price') ?? $playlist->price }}" autofocus required />
        @error('price')
        <div class="my-1">
            <span class="text-red-500 text-sm">{{ $message }}</span>
        </div>
        @enderror
    </div>
    <x-button class="uppercase tracking-wider my-5">{{ $type }}</x-button>
</form>

<script>
    const thumbnail = document.querySelector('#thumbnail');
    const prevThumbnail = document.querySelector('#prevThumbnail');
    
    thumbnail.addEventListener('change', () => {
        const tempThumbnail = URL.createObjectURL(thumbnail.files[0]);
        prevThumbnail.src = tempThumbnail;
    });
</script>