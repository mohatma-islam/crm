@props(['clientContact', 'clients', 'session_client_id', '$client_show_url', 'clientContact_url'])

<x-content-between>

    <x-title>
        @if ($clientContact->exists)
        Update Client Contact Record
        @else
        Create Client Contact Record
        @endif

    </x-title>

    <button class="btn btn-primary"><a class="dropdown-item" 
        href="{{ $client_show_url ?? ($clientContact_url ?? url()->previous()) }}"> <i class="fa fa-arrow-left"
        aria-hidden="true"></i> Back </a></button>

</x-content-between>

<x-alert />

{{-- Checking if client contact model exits in the database or not --}}
@if ($clientContact->exists)
    {{-- If client contact data is found then use PATCH method for update --}}
    <form action="{{ route('clientContact.update', $clientContact->id) }}" method="POST">
        @csrf
        @method('PATCH')
    @else
        {{-- If client contact data is not found then use POST method for create --}}
        <form action="{{ route('clientContact.store') }}" method="POST">
            @csrf
            {{-- get the user id who is logged in and send it to activity model --}}
            <input type="text" name="created_by_id" value="{{ Auth::user()->id }}" hidden id="created_by_id">
@endif

{{-- dropdown to get client model data from database --}}
<x-form.dropdown name="client_id" selection_type="multiple">
    @foreach ($clients as $client)
        @if ($clientContact->exists)
            <option value="{{ $client->id }}"
                {{ $client->id == old('client_id', $clientContact->client->id) ? 'selected' : '' }}>
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

<x-form.checkbox :model="$clientContact" name="client_primary_contact" value="1"/>
<x-form.input :model="$clientContact" name="client_contact_first_name" type="text"/>
<x-form.input :model="$clientContact" name="client_contact_surname" type="text"/>
<x-form.input :model="$clientContact" name="client_email_address" type="text"/>
<x-form.input :model="$clientContact" name="client_phone_number" type="text"/>

<x-form.button :model="$clientContact" />

</form>
