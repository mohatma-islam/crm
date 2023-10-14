@props(['serviceLevel', 'websites', 'serviceLevel_lookups', 'serviceLevelMaintenance_lookups',
 'session_website_id', 'website_show_url', 'serviceLevel_url'])

<x-content-between>

    <x-title>
        @if ($serviceLevel->exists)
        Update Service Level
        @else
        Create Service Level
        @endif
    </x-title>

    <button class="btn btn-primary"><a class="dropdown-item" 
        href="{{ $website_show_url ?? ($serviceLevel_url ?? url()->previous()) }}"> <i class="fa fa-arrow-left"
        aria-hidden="true"></i> Back </a></button>

</x-content-between>

<x-alert />

{{-- Checking if service Level model exits in the database or not --}}
@if ($serviceLevel->exists)
    {{-- If service Level data is found then use PATCH method for update --}}
    <form action="{{ route('serviceLevel.update', $serviceLevel->id) }}" method="POST">
        @csrf
        @method('PATCH')
    @else
        {{-- If service Level data is not found then use POST method for create --}}
        <form action="{{ route('serviceLevel.store') }}" method="POST">
            @csrf
@endif


{{-- dropdown options to get all website --}}
<x-form.dropdown name="website_id">
    @foreach ($websites as $website)
        {{-- if service Level object exists then get the matching website id from the database for Update --}}
        @if ($serviceLevel->exists)
            <option value="{{ $website->id }}"
                {{ $website->id == old('website_id', $serviceLevel->website->id) ? 'selected' : '' }}>
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
                {{-- if service Level object does not exists then get the old user input id for Create --}}
                <option value="{{ $website->id }}" {{ $website->id == old('website_id') ? 'selected' : '' }}>
                    {{ $website->website_name }}
                </option>
        @endif
    @endforeach
</x-form.dropdown>

{{-- Service level values are coming from the Service Level lookups table --}}
{{-- dropdown options to display all the Service level options --}}
<x-form.dropdown name="service_level_lookup_id">
    @foreach ($serviceLevel_lookups as $serviceLevel_lookup)
        {{-- if Service level object exists then get the matching service level value for Update --}}
        @if ($serviceLevel->exists)
            <option value="{{ $serviceLevel_lookup->id }}"
                {{ $serviceLevel_lookup->id == old('service_level_lookup_id', $serviceLevel->serviceLevel_lookup->id) ? 'selected' : '' }}>
                {{ $serviceLevel_lookup->value }}
            </option>
        @else
        {{-- if Service level object does exists then get the old user input service level value for Create --}}
            <option value="{{ $serviceLevel_lookup->id }}" {{ $serviceLevel_lookup->id == old('service_level_lookup_id') ? 'selected' : '' }}>
                {{ $serviceLevel_lookup->value }}
            </option>
        @endif
    @endforeach
</x-form.dropdown>

{{-- Maintenance Time values are coming from Service Level Maintenance table --}}
{{-- dropdown options to display all the Maintenance Time options --}}
<x-form.dropdown name="maintenance_lookup_id">
    @foreach ($serviceLevelMaintenance_lookups as $serviceLevelMaintenance_lookup)
        {{-- if Maintenance Time object exists then get the matching maintenance Time value for Update --}}
        @if ($serviceLevel->exists)
            <option value="{{ $serviceLevelMaintenance_lookup->id }}"
                {{ $serviceLevelMaintenance_lookup->id == old('maintenance_lookup_id', $serviceLevel->serviceLevelMaintenance_lookup->id) ? 'selected' : '' }}>
                {{ $serviceLevelMaintenance_lookup->value }}
            </option>
        @else
        {{-- if Maintenance Time object does exists then get the old user input maintenance Time value for Create --}}
            <option value="{{ $serviceLevelMaintenance_lookup->id }}"
                {{ $serviceLevelMaintenance_lookup->id == old('maintenance_lookup_id') ? 'selected' : '' }}>
                {{ $serviceLevelMaintenance_lookup->value }}
            </option>
        @endif
    @endforeach
</x-form.dropdown>

<x-form.button :model="$serviceLevel" />

</form>
