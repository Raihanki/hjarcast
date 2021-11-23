@csrf
<div class="">
    <x-label for="title">title</x-label>
    <input type="text" name="title"
        class="mt-1 w-full px-3 py-2 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition duration-75 @error('title') border border-red-400 @enderror"
        value="{{ old('title') ?? $video->title }}" autofocus required />
    @error('title')
    <div class="my-1">
        <span class="text-red-500 text-sm">{{ $message }}</span>
    </div>
    @enderror
</div>
<div class="mt-5">
    <x-label for="description">Description</x-label>
    <textarea type="text" name="description"
        class="mt-1 w-full px-3 py-2 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition duration-75 @error('description') border border-red-400 @enderror"
        required>{{ old('description') ?? $video->description }}</textarea>
    @error('description')
    <div class="my-1">
        <span class="text-red-500 text-sm">{{ $message }}</span>
    </div>
    @enderror
</div>
<div class="mt-5">
    <x-label for="unique_video_id">Unique Youtube Link Code</x-label>
    <input type="text" name="unique_video_id"
        class="mt-1 w-full px-3 py-2 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition duration-75 @error('unique_video_id') border border-red-400 @enderror"
        value="{{ old('unique_video_id') ?? $video->unique_video_id }}" required />
    @error('unique_video_id')
    <div class="my-1">
        <span class="text-red-500 text-sm">{{ $message }}</span>
    </div>
    @enderror
</div>
<div class="mt-5">
    <x-label for="episode">Episode</x-label>
    <input type="text" name="episode"
        class="mt-1 w-full px-3 py-2 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition duration-75 @error('episode') border border-red-400 @enderror"
        value="{{ old('episode') ?? $video->episode }}" required />
    @error('episode')
    <div class="my-1">
        <span class="text-red-500 text-sm">{{ $message }}</span>
    </div>
    @enderror
</div>
<div class="mt-5">
    <x-label for="runtime">Runtime</x-label>
    <input type="text" name="runtime"
        class="mt-1 w-full px-3 py-2 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:ring-opacity-50 transition duration-75 @error('runtime') border border-red-400 @enderror"
        value="{{ old('runtime') ?? $video->runtime }}" required />
    @error('runtime')
    <div class="my-1">
        <span class="text-red-500 text-sm">{{ $message }}</span>
    </div>
    @enderror
</div>
<x-button class="uppercase tracking-wider my-5" type="submit">{{ $type }}</x-button>