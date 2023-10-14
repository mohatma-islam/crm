@props(['route'])

<button class="btn btn-primary">
    <a href="{{ route($route) }}" class="text-white">
        {{ $slot }}
    </a>
</button>