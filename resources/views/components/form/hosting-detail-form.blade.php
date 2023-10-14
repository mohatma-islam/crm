@props(['hostingDetail', 'serverDetails',
 'server_supplier_lookups', 'connection_type_lookups',
  'session_website_id', 'website_show_url', 'hostingDetail_url'])

<x-content-between>

    <x-title>
        @if ($hostingDetail->exists)
        Update Hosting Detail Record
        @else
        Create Hosting Detail Record
        @endif
    </x-title>

    <button class="btn btn-primary"><a class="dropdown-item" 
        href="{{ $website_show_url ?? ($hostingDetail_url ?? url()->previous()) }}"> <i class="fa fa-arrow-left"
        aria-hidden="true"></i> Back </a></button>

</x-content-between>

<x-alert />

{{-- Checking if website model exits in the database or not --}}
@if ($hostingDetail->exists)
    {{-- If website data is found then use PATCH method for update --}}
    <form action="{{ route('hostingDetail.update', $hostingDetail->id) }}" method="POST">
        @csrf
        @method('PATCH')
    @else
        {{-- If website data is not found then use POST method for create --}}
        <form action="{{ route('hostingDetail.store') }}" method="POST">
            @csrf
@endif

{{-- dropdown options to get all website --}}
<x-form.dropdown name="website_id">
    @foreach ($websites as $website)
        {{-- if hosting object exists then get the matching website id from the database for Update --}}
        @if ($hostingDetail->exists)
            <option value="{{ $website->id }}"
                {{ $website->id == old('website_id', $hostingDetail->website->id) ? 'selected' : '' }}>
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
                {{-- if hosting object does not exists then get the old user input id for Create --}}
                <option value="{{ $website->id }}" {{ $website->id == old('website_id') ? 'selected' : '' }}>
                    {{ $website->website_name }}
                </option>
        @endif
    @endforeach
</x-form.dropdown>

{{-- dropdown options to get all the server id from forge servers --}}
<x-form.dropdown name="forge_server_id">
    @foreach ($serverDetails['servers'] as $server)
        @if ($hostingDetail->exists)
            <option value="{{ $server['id'] }}"
            {{ $server['id'] == old('forge_server_id', $hostingDetail->forge_server_id) ? 'selected' : '' }}>
                {{ $server['name'] }}
            </option>
        @else
            <option value="{{ $server['id'] }}" {{ $server['id'] == old('forge_server_id') ? 'selected' : '' }}>
                {{ $server['name'] }}
            </option>
        @endif
    @endforeach
</x-form.dropdown>


<x-form.input :model="$hostingDetail" name="host_name" type="text"/>
<x-form.input :model="$hostingDetail" name="host_username" type="text"/>
<x-form.input :model="$hostingDetail" name="host_password" type="password"/>
<x-form.input :model="$hostingDetail" name="host_port_number" type="text"/>

{{-- Server Supplier values are coming from the edit and create view page, as hardcoded value --}}
{{-- dropdown options to display all the server supplier options --}}
<x-form.dropdown name="server_supplier_lookup_id">
    @foreach ($server_supplier_lookups as $server_supplier_lookup)
        {{-- if hosting object exists then get the matching server supplier value for Update --}}
        @if ($hostingDetail->exists)
            <option value="{{ $server_supplier_lookup->id }}"
                {{ $server_supplier_lookup->id == old('server_supplier', $hostingDetail->server_supplier_lookup->id) ? 'selected' : '' }}>
                {{ $server_supplier_lookup->value }}
            </option>
        @else
            {{-- if hosting object does exists then get the old user input server supplier value for Create --}}
            <option value="{{ $server_supplier_lookup->id }}"
                {{ $server_supplier_lookup->id == old('server_supplier_lookup_id') ? 'selected' : '' }}>
                {{ $server_supplier_lookup->value }}
            </option>
        @endif
    @endforeach
</x-form.dropdown>

{{-- Connection type values are coming from the edit and create view page, as hardcoded value --}}
{{-- dropdown options to display all the server supplier options --}}
<x-form.dropdown name="connection_type_lookup_id">
    @foreach ($connection_type_lookups as $connection_type_lookup)
        {{-- if hosting object exists then get the matching connection type value for Update --}}
        @if ($hostingDetail->exists)
            <option value="{{ $connection_type_lookup->id }}"
                {{ $connection_type_lookup->id == old('connection_type', $hostingDetail->connection_type_lookup->id) ? 'selected' : '' }}>
                {{ $connection_type_lookup->value }}
            </option>
        @else
            {{-- if hosting object does exists then get the old user input connection type value for Create --}}
            <option value="{{ $connection_type_lookup->id }}"
                {{ $connection_type_lookup->id == old('connection_type_lookup_id') ? 'selected' : '' }}>
                {{ $connection_type_lookup->value }}
            </option>
        @endif
    @endforeach
</x-form.dropdown>


<x-form.button :model="$hostingDetail" type="text"/>

</form>
