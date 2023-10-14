@props(['width'])
<div class="{{ isset($width) ? $width : '' }} p-0 m-0">
    {{ $slot }}
</div>