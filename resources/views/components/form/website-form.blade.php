@props(['website', 'clients', 'session_client_id', 'client_show_url', 'website_url'])

<x-content-between>

    <x-title>
        @if ($website->exists)
        Update Website Record
        @else
        Create Website Record
        @endif
    </x-title>

    <button class="btn btn-primary"><a class="dropdown-item" 
        href="{{ $client_show_url ?? ($website_url ?? url()->previous()) }}"> <i class="fa fa-arrow-left"
        aria-hidden="true"></i> Back </a></button>

</x-content-between>

<x-alert />

{{-- Checking if website model exits in the database or not --}}
@if ($website->exists)
    {{-- If website data is found then use PATCH method for update --}}
    <form action="{{ route('website.update', $website->id) }}" method="POST">
        @csrf
        @method('PATCH')
    @else
        {{-- If website data is not found then use POST method for create --}}
        <form action="{{ route('website.store') }}" method="POST">
            @csrf
            {{-- get the user id who is logged in and send it to activity model --}}
            <input type="text" name="created_by_id" value="{{ Auth::user()->id }}" id="created_by_id" hidden>
@endif

{{-- dropdown to get client model data from database --}}
<x-form.dropdown name="client_id">
    @foreach ($clients as $client)
        @if ($website->exists)
            <option value="{{ $client->id }}"
                {{ $client->id == old('client_id', $website->client->id) ? 'selected' : '' }}>
                {{ $client->client_name }}
            </option>
        @else
            {{-- if client id exists then get the client id from the session which is coming from client show page --}}
            @if($session_client_id)
                <option value="{{ $client->id }}"
                    {{ $client->id == old('client_id', $session_client_id) ? 'selected' : '' }}>
                    {{ $client->client_name }}
                </option>
            @endif
                {{-- if ther is no client model data, then get the old user data after validation --}}
                <option value="{{ $client->id }}" {{ $client->id == old('client_id') ? 'selected' : '' }}>
                    {{ $client->client_name }}
                </option>
        @endif
    @endforeach
</x-form.dropdown>

<x-form.input :model="$website" name="website_name" type="text"/>
<x-form.input :model="$website" name="website_address" type="text"/>

<x-form.button :model="$website" />

</form>
