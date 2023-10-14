@props(['technology', 'technology_lookups',
'session_website_id', 'website_show_url', 'technolog_url'])

<x-content-between>

    <x-title>
        @if ($technology->exists)
        Update Technology
        @else
        Create Technology
        @endif
    </x-title>

    <button class="btn btn-primary"><a class="dropdown-item" 
        href="{{ $website_show_url ?? ($technolog_url ?? url()->previous()) }}"> <i class="fa fa-arrow-left"
        aria-hidden="true"></i> Back </a></button>

</x-content-between>

<x-alert />

{{-- Checking if Technology model exits in the database or not --}}
@if ($technology->exists)
    {{-- If Technology data is found then use PATCH method for update --}}
    <form action="{{ route('technology.update', $technology->id) }}" method="POST">
        @csrf
        @method('PATCH')
    @else
        {{-- If Technology data is not found then use POST method for create --}}
        <form action="{{ route('technology.store') }}" method="POST">
            @csrf
@endif


{{-- dropdown options to get all website --}}
<x-form.dropdown name="website_id">
    @foreach ($websites as $website)
        {{-- if technology object exists then get the matching website id from the database for Update --}}
        @if ($technology->exists)
            <option value="{{ $website->id }}"
                {{ $website->id == old('website_id', $technology->website->id) ? 'selected' : '' }}>
                {{ $website->website_name }}
            </option>
        @else
            {{-- if website id exists then get the website id from the session which is coming from website show page --}}
            @if($session_website_id)
                <option value="{{ $website->id }}"
                    {{ $website->id == old('website_id', $session_website_id) ? 'selected' : '' }}>
                    {{ $website->website_name }}
                </option>
            @endif
            {{-- if technology object does not exists then get the old user input id for Create --}}
            <option value="{{ $website->id }}" {{ $website->id == old('website_id') ? 'selected' : '' }}>
                {{ $website->website_name }}
            </option>
        @endif
    @endforeach
</x-form.dropdown>


{{-- technology look values are coming from technology lookup table --}}
{{-- dropdown options to display all the technology options --}}
<x-form.dropdown name="technology_lookup_id">
    @foreach ($technology_lookups as $technology_lookup)
        {{-- if technology object exists then get the matching technology lookup value for Update --}}
        @if ($technology->exists)
            <option value="{{ $technology_lookup->id }}"
                {{ $technology_lookup->id == old('technology_lookup_id', $technology->technology_lookup->id) ? 'selected' : '' }}>
                {{ $technology_lookup->value }}
            </option>
        @else
        {{-- if technology object does exists then get the old user input technology lookup value for Create --}}
            <option value="{{ $technology_lookup->id }}" {{ $technology_lookup->id == old('technology_lookup_id') ? 'selected' : '' }}>
                {{ $technology_lookup->value }}
            </option>
        @endif
    @endforeach
</x-form.dropdown>

<x-form.button :model="$technology" />

</form>