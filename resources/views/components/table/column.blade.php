@props(['column', 'columnName', 'direction', 'route'])

<th scope="col">
    <a href="{{ route($route, [
        'column' => $columnName,
        'direction' => $direction
    ]) }}">
        {{ $slot }}
        @if ($column === $columnName)
            @if ($direction === 'asc')
                <i class="fa fa-arrow-up"></i>
            @else
                <i class="fa fa-arrow-down"></i>
            @endif
        @else
            <i class="fa fa-sort"></i>
        @endif
    </a>
</th>