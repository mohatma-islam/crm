@props(['filterName'])

<div class="dropdown">
    <button class="btn btn-light dropdown-toggle w-100" type="button"
        data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-filter" aria-hidden="true"></i> {{ $filterName }}
    </button>
    <ul class="dropdown-menu w-100 ps-3 pt-3" aria-labelledby="dropdownMenuButton1">

        <form action="#" method="GET">
            
            {{ $slot }}

            <button class="btn btn-light w-50 mt-2 ms-5" type="submit">Filter</button>

        </form>

    </ul>
</div>