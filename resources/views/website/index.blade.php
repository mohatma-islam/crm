@extends('layout')
@section('content')
    <x-grid-row>
        <x-grid-col width="col-6 col-md-3">
            <x-title>Websites</x-title>
        </x-grid-col>

        <x-grid-col width="col-12 col-md-6">
            <x-search name="search" :value="request('search')" placeholder="Search Website Name or Website Address" />
        </x-grid-col>

        <x-grid-col width="col-12 col-md-3 pb-3 d-flex justify-content-end">
            <x-button-create-new redirectTo="/websites/create" />
        </x-grid-col>
    
        <x-message />

    </x-grid-row>


    <div class="table-responsive">

        <table class="table border">
            <thead>
                <tr>
                    <x-table.column :column="$column" columnName="id" :direction="$direction" route="website.index">
                        ID
                    </x-table.column>

                    <x-table.column :column="$column" columnName="client_id" :direction="$direction" route="website.index">
                        Client Name
                    </x-table.column>

                    <x-table.column :column="$column" columnName="website_name" :direction="$direction" route="website.index">
                        Name
                    </x-table.column>

                    <x-table.column :column="$column" columnName="website_address" :direction="$direction" route="website.index">
                        Address
                    </x-table.column>

                    <x-table.column :column="$column" columnName="created_at" :direction="$direction" route="website.index">
                        Created
                    </x-table.column>

                    <x-table.column :column="$column" columnName="updated_at" :direction="$direction" route="website.index">
                        Updated
                    </x-table.column>

                    <th scope="col">Actions</th>
                </tr>
            </thead>
            
            <tbody>

                @foreach ($websites as $website)
                    <tr>
                        <td>{{ $website->id }}</td>
                        <td> <a
                                href="{{ route('client.show', $website->client->id) }}">{{ $website->client->client_name }}</a>
                        </td>
                        <td><a href="{{ route('website.show', $website->id) }}">{{ $website->website_name }}</a></td>
                        <td>{{ $website->website_address }}</td>
                        <td>{{ $website->created_at->format('d/m/Y') }}</td>
                        <td>{{ $website->updated_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('website.edit', $website->id) }}" class="text-success me-3">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>

                            <a href="{{ $website->id }}" class="text-danger delete" data-bs-toggle="modal"
                                data-id="{{ $website->id }}" data-bs-target="#ModalDelete">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>

    <x-delete-modal action="{{ route('website.destroy') }}">
        Delete Website Record
    </x-delete-modal>

    <x-pagination :model="$websites" />
@endsection
