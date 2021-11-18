@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-md text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>