@extends('layout')

@section('content')

    <x-grid-row>
        <x-grid-col width="col-12 col-md-9">
            <x-title>Client</x-title>
        </x-grid-col>

        <x-grid-col width="col-6 col-md-2 ps-md-5">
            <x-dropdown name="Create">
                @if ($client->deal == null)
                    <li><a class="dropdown-item" href="{{ route('deal.create') }}">Deal</a></li>
                @endif
                <li><a class="dropdown-item" href="{{ route('transaction.create') }}">Transaction</a></li>
                <li><a class="dropdown-item" href="{{ route('clientContact.create') }}">Client Contact</a></li>
                <li><a class="dropdown-item" href="{{ route('website.create') }}">Website</a></li>
            </x-dropdown>
        </x-grid-col>

        <x-grid-col width="col-6 col-md-1 pb-3 d-flex justify-content-end">
            <button class="btn btn-primary"><a class="dropdown-item" href="{{ $clientUrl ?? url()->previous() }}">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Back </a></button>
        </x-grid-col>
    </x-grid-row>

    <x-message />


    <table class="table border">
        <tbody>

            <tr>
                <th>Client ID</th>
                <td scope="row">{{ $client->id }}</td>
            </tr>

            <tr>
                <th>Client Name</th>
                <td>{{ $client->client_name }}</td>
            </tr>

            <tr>
                <th>Deal Stage</th>
                <td>
                    @if ($client->deal != null)
                        <a href="{{ route('deal.show', $client->deal->id) }}">
                            <span class="badge text-white text-bg-{{ $color }}">{{ $client->deal->deal_stage_lookup->value }}</span>
                        </a>
                    @endif
                </td>
            </tr>

            <tr>
                <th>Est. deal</th>
                <td>
                    @if ($client->deal != null)
                        £ {{ $client->deal->estimated_deal }}
                    @endif
                </td>
            </tr>

            <tr>
                <th>Account Manager</th>
                <td>{{ $client->user->user_name }}</td>
            </tr>

            <tr>
                <th>Address</th>
                <td>{{ $client->client_postal_address }}</td>
            </tr>

            <tr>
                <th>Created</th>
                <td>{{ $client->created_at->format('d/m/Y') }}</td>
            </tr>

            <tr>
                <th>Updated</th>
                <td>{{ $client->updated_at->format('d/m/Y') }}</td>
            </tr>

            <tr>
                <th>Actions</th>
                <td>
                    <a href="{{ route('client.edit', $client->id) }}" class="text-success me-3">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>

                    <a href="{{ $client->id }}" class="text-danger delete" data-bs-toggle="modal"
                        data-id="{{ $client->id }}" data-bs-target="#ModalDelete">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>

        </tbody>
    </table>

    <x-delete-modal action="{{ route('client.destroy') }}">
        Delete Client Record
    </x-delete-modal>

    {{-- show related transactions --}}
    @if ($client->transactions->count())
        <x-item.accordio-transaction :transactions="$client->transactions" />
    @endif

    {{-- show related client contacts --}}
    @if ($client->clientContacts->count())
        <x-item.accordio-client-contact :clientContacts="$client->clientContacts" />
    @endif

    {{-- show related websites --}}
    @if ($client->websites->count())
        <x-item.accordio-website :websites="$client->websites" />

        {{-- check if hosting detail exits on the website or not --}}

        @if ($totalHostingDetails > 0)
            <x-item.accordio-hosting-details>

                @foreach ($client->websites as $website)
                    @if ($website->hostingDetail != null)
                        <tr>
                            <td>{{ $website->hostingDetail->id }}</td>
                            <td><a href="{{ route('website.show', $website->id) }}"> {{ $website->website_name }}</a>
                            </td>
                            {{-- check if forge server id exists in the databse empty or not
                                if forge server id is not found then show show empty table data --}}
                            @if ($website->hostingDetail->forge_server_id != '')
                                @foreach ($serverDetails['servers'] as $server)
                                    @if ($server['id'] == $website->hostingDetail->forge_server_id)
                                        <td scope="row"><a
                                                href="{{ route('hostingDetail.server', $server['id']) }}">{{ $server['name'] }}</a>
                                        </td>
                                    @endif
                                @endforeach
                            @else
                                <td scope="row"></td>
                            @endif
                            <td><a href="{{ route('hostingDetail.show', $website->hostingDetail->id) }}">
                                    {{ $website->hostingDetail->host_name }}</a> </td>
                            <td>{{ $website->hostingDetail->host_username }}</td>
                            <td>
                                <input class="form-control" type="password"
                                    value="{{ $website->hostingDetail->host_password }}" onclick="this.type='text';"
                                    onblur="this.type='password';">
                            </td>
                            <td>{{ $website->hostingDetail->host_port_number }}</td>
                            <td>{{ $website->hostingDetail->server_supplier_lookup->value }}</td>
                            <td>{{ $website->hostingDetail->connection_type_lookup->value }}</td>
                        </tr>
                    @endif
                @endforeach

            </x-item.accordio-hosting-details>
        @endif
    @endif

    {{-- show related activities --}}
    @if ($client->activities->count())
        <x-item.accordio-activity :activities="$client->activities" />
    @endif

@endsection
