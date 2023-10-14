@props(['deal', 'clients', 'client_url', 'session_client_id', 'deal_url', 'client_show_url', 'stage_arrays', 'deal_stage_lookups'])

<x-content-between>

    <x-title>
        @if ($deal->exists)
            Update Deal Record
        @else
            Create Deal Record
        @endif
    </x-title>

    <button class="btn btn-primary"><a class="dropdown-item"
            href="{{ $client_show_url ?? ($client_url ?? ($deal_url ?? url()->previous())) }}"> <i class="fa fa-arrow-left"
                aria-hidden="true"></i> Back </a></button>

</x-content-between>

<x-alert />

{{-- Checking if deal model exits in the database or not --}}
@if ($deal->exists)
    {{-- If deal data is found then use PATCH method for update --}}
    <form action="{{ route('deal.update', $deal->id) }}" method="POST">
        @csrf
        @method('PATCH')
    @else
        {{-- If deal data is not found then use POST method for create --}}
        <form action="{{ route('deal.store') }}" method="POST">
            @csrf
@endif

{{-- dropdown to get client model data from database --}}
<x-form.dropdown name="client_id">
    @foreach ($clients as $client)
        @if ($deal->exists)
            <option value="{{ $client->id }}"
                {{ $client->id == old('client_id', $deal->client->id) ? 'selected' : '' }}>
                {{ $client->client_name }}
            </option>
        @else
            {{-- if client id exists then get the client id from the session which is coming from client show page --}}
            @if ($session_client_id)
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

{{-- <x-form.input :model="$deal" type="text" name="stage" /> --}}

{{-- stage values are coming from deal stage lookups table --}}
{{-- dropdown options to display all the stage options --}}
<x-form.dropdown name="deal_stage_id">
    @foreach ($deal_stage_lookups as $deal_stage_lookup)
        {{-- if stage object exists then get the matching stage value for Update --}}
        @if ($deal->exists)
            <option value="{{ $deal_stage_lookup->id }}"
                {{ $deal_stage_lookup->id == old('deal_stage_id', $deal->deal_stage_lookup->id) ? 'selected' : '' }}>
                {{ $deal_stage_lookup->value }}
            </option>
        @else
            {{-- if stage object does exists then get the old user input stage value for Create --}}
            <option value="{{ $deal_stage_lookup->id }}"
                {{ $deal_stage_lookup->id == old('deal_stage_id') ? 'selected' : '' }}>
                {{ $deal_stage_lookup->value }}
            </option>
        @endif
    @endforeach
</x-form.dropdown>

<x-form.input :model="$deal" type="number" name="estimated_deal" />

<x-form.field>
    <x-form.label name="created_at" />
    <input type="date" class="form-control" name="created_at"
        value="{{ old('created_at', !empty($deal->created_at) ? date('Y-m-d', strtotime($deal->created_at)) : date('Y-m-d')) }}"
        id="created_at">
</x-form.field>


<x-form.button :model="$deal" />

</form>
