@props(['client', 'users', 'client_url'])

<x-content-between>

    <x-title>
        @if ($client->exists)
        Update Client Record
        @else
        Create Client Record
        @endif
    </x-title>

    <button class="btn btn-primary"><a class="dropdown-item" 
        href="{{ $client_url ?? url()->previous() }}"> <i class="fa fa-arrow-left"
        aria-hidden="true"></i> Back </a></button>

</x-content-between>

<x-alert />

{{-- Checking if client model exits in the database or not --}}
@if ($client->exists)
    {{-- If client data is found then use PATCH method for update --}}
    <form action="{{ route('client.update', $client->id) }}" method="POST">
        @csrf
        @method('PATCH')
    @else
        {{-- If client data is not found then use POST method for create --}}
        <form action="{{ route('client.store') }}" method="POST">
            @csrf
@endif

<x-form.input :model="$client" name="client_name" type="text"/>

{{-- dropdown to get user model data from database --}}
<x-form.dropdown name="client_account_manager_id">
    @foreach ($users as $user)
        @if ($client->exists)
            <option value="{{ $user->id }}"
                {{ $user->id == old('client_account_manager_id', $client->user->id) ? 'selected' : '' }}>
            @else
                {{-- if ther is no user model data, then get the old user data after validation --}}
            <option value="{{ $user->id }}" {{ $user->id == old('client_account_manager_id') ? 'selected' : '' }}>
        @endif
        {{ $user->user_name }}
    @endforeach
</x-form.dropdown>


<x-form.input :model="$client" type="text" name="client_postal_address" />

<x-form.field>
    <x-form.label name="created_at" />
    <input type="date" class="form-control" name="created_at"
        value="{{ old('created_at', !empty($client->created_at) ? date('Y-m-d', strtotime($client->created_at)) : date('Y-m-d')) }}"
        id="created_at">
</x-form.field>

<x-form.button :model="$client" />

</form>
