@props(['transaction','clients', 'session_client_id', 'transaction_url', 'client_show_url'])

<x-content-between>

    <x-title>
        @if ($transaction->exists)
        Update Transaction Record
        @else
        Create Transaction Record
        @endif
    </x-title>

    <button class="btn btn-primary"><a class="dropdown-item" 
        href="{{ $client_show_url ?? ($transaction_url ?? url()->previous()) }}"> <i class="fa fa-arrow-left"
        aria-hidden="true"></i> Back </a></button>

</x-content-between>

<x-alert />

{{-- Checking if transaction model exits in the database or not --}}
@if ($transaction->exists)
    {{-- If transaction data is found then use PATCH method for update --}}
    <form action="{{ route('transaction.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PATCH')
    @else
        {{-- If transaction data is not found then use POST method for create --}}
        <form action="{{ route('transaction.store') }}" method="POST">
            @csrf
@endif

{{-- dropdown to get client model data from database --}}
<x-form.dropdown name="client_id">
    @foreach ($clients as $client)
        @if ($transaction->exists)
            <option value="{{ $client->id }}"
                {{ $client->id == old('client_id', $transaction->client->id) ? 'selected' : '' }}>
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

<x-form.input :model="$transaction" type="text" name="type" />
<x-form.input :model="$transaction" type="number" name="amount" />

<x-form.field>
    <x-form.label name="created_at" />
    <input type="date" class="form-control" name="created_at"
        value="{{ old('created_at', !empty($transaction->created_at) ? date('Y-m-d', strtotime($transaction->created_at)) : date('Y-m-d')) }}"
        id="created_at">
</x-form.field>

<x-form.button :model="$transaction" />

</form>
