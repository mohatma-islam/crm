@extends('layout')
@section('content')
    <x-grid-row>

        <x-grid-col width="col-6 col-md-2">
            <x-title>Clients</x-title>
        </x-grid-col>

        <x-grid-col width="col-12 col-md-4 float-end">
            <x-search name="search" :value="request('search')" placeholder="Search Client" />
        </x-grid-col>

        <x-grid-col width="col-9 col-md-2 ps-md-4">
            <x-button-create-new redirectTo="/clients/create" />
        </x-grid-col>

        <x-grid-col width="col-2 col-md-1 mb-2">
            <button class="btn btn-warning"><a class="dropdown-item" href="/clients/exportsClients"><i
                        class="fa fa-download"></i>
                    Export</a></button>
        </x-grid-col>

        <x-grid-col width="col-12 col-md-3 ps-md-3">
            <x-dropdown-filter filterName="Filter By Account Manager">
                @foreach ($users as $user)
                    <li>
                        <input class="form-check-input" type="radio" name="user" value="{{ $user->id }}"
                            {{ $user->id == $selectedUser ? 'checked' : '' }}>
                        <label class="form-check-label">
                            {{ $user->user_name }}
                        </label>
                    </li>
                @endforeach
            </x-dropdown-filter>
        </x-grid-col>

        <x-message />

    </x-grid-row>

    <div class="table-responsive">
        <table class="table border">
            <thead>
                <tr>
                    <x-table.column :column="$column" columnName="id" :direction="$direction" route="client.index">
                        ID
                    </x-table.column>

                    <x-table.column :column="$column" columnName="client_name" :direction="$direction" route="client.index">
                        Client Name
                    </x-table.column>

                    <x-table.column :column="$column" columnName="" :direction="$direction" route="client.index">
                        Deal Stage
                    </x-table.column>

                    <x-table.column :column="$column" columnName="" :direction="$direction" route="client.index">
                        Est. Deal
                    </x-table.column>

                    <x-table.column :column="$column" columnName="client_account_manager_id" :direction="$direction"
                        route="client.index">
                        Account Manager
                    </x-table.column>

                    <x-table.column :column="$column" columnName="client_postal_address" :direction="$direction"
                        route="client.index">
                        Address
                    </x-table.column>

                    <x-table.column :column="$column" columnName="created_at" :direction="$direction" route="client.index">
                        Created
                    </x-table.column>

                    <x-table.column :column="$column" columnName="updated_at" :direction="$direction" route="client.index">
                        Updated
                    </x-table.column>

                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td scope="row">{{ $client->id }}</td>
                        <td> <a href="{{ route('client.show', $client->id) }}">{{ $client->client_name }}</a> </td>

                        @if ($client->deal != null)
                            <td>
                                @if ($client->deal->deal_stage_lookup->value == 'New')
                                    <a href="{{ route('deal.show', $client->deal->id) }}"><span
                                            class="badge text-white text-bg-primary">{{ $client->deal->deal_stage_lookup->value }}</span></a>
                                @elseif ($client->deal->deal_stage_lookup->value == 'Proposal')
                                    <a href="{{ route('deal.show', $client->deal->id) }}"><span
                                            class="badge text-white text-bg-info">{{ $client->deal->deal_stage_lookup->value }}</span></a>
                                @elseif ($client->deal->deal_stage_lookup->value == 'Negotiation')
                                    <a href="{{ route('deal.show', $client->deal->id) }}"><span
                                            class="badge text-white text-bg-warning">{{ $client->deal->deal_stage_lookup->value }}</span></a>
                                @elseif ($client->deal->deal_stage_lookup->value == 'Won')
                                    <a href="{{ route('deal.show', $client->deal->id) }}"><span
                                            class="badge text-white text-bg-success">{{ $client->deal->deal_stage_lookup->value }}</span></a>
                                @else
                                    <a href="{{ route('deal.show', $client->deal->id) }}"><span
                                            class="badge text-white text-bg-danger">{{ $client->deal->deal_stage_lookup->value }}</span></a>
                                @endif
                            </td>
                        @else
                            <td></td>
                        @endif

                        <td> {{ $client->deal != null ? '£ ' . $client->deal->estimated_deal : '' }}</td>

                        <td>{{ $client->user->user_name }}</td>
                        <td>{{ $client->client_postal_address }}</td>
                        <td>{{ $client->created_at->format('d/m/Y') }}</td>
                        <td>{{ $client->updated_at->format('d/m/Y') }}</td>
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
                @endforeach
            </tbody>
        </table>
    </div>

    <x-delete-modal action="{{ route('client.destroy') }}">
        Delete Client Record
    </x-delete-modal>

    <x-pagination :model="$clients" />
@endsection
