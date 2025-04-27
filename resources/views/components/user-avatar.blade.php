@props(['user', 'size' => 'w-12 h-12'])

@if ($user)
    <img class="{{ $size }} rounded-full" src="{{ $user->imageUrl() }}" alt="{{ $user->name }}">
@endif 