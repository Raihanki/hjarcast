<div x-show="open" {{ $attributes->merge(["class" => "absolute inset-0 bg-black bg-opacity-50 z-50 flex
    items-center justify-center"])
    }}>
    <div class="bg-white md:max-w-xl w-1/2 rounded-md shadow-sm overflow-hidden">
        <div class="px-4 py-5 flex items-center justify-between bg-gray-200">
            <div class="tracking-wider text-lg">{{ $title }}</div>
            <div @click="open = false">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400 cursor-pointer" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
        <div class="p-5 text-md text-lg">
            {{ $slot }}
            <div class="flex pt-6">
                <button type="submit"
                    class="px-2 mr-3 py-2 text-xs uppercase font-semibold tracking-wider shadow-sm rounded-md text-white bg-blue-500 hover:bg-blue-600 cursor-pointer focus:outline-none focus:ring focus:ring-blue-600 ring-opacity-30 transition duration-75">Confirm</button>
                <button type="button" @click="open = false"
                    class="px-2 py-2 text-xs uppercase font-semibold tracking-wider shadow-sm rounded-md text-white bg-red-500 hover:bg-red-600 cursor-pointer focus:outline-none focus:ring focus:ring-red-600 ring-opacity-30 transition duration-75">
                    Cancel</button>
            </div>
        </div>
    </div>
</div>