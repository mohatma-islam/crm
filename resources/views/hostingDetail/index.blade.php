@extends('layout')
@section('content')

    <x-grid-row>

        <x-grid-col width="col-6 col-md-6">
            <x-title>Hosting Details</x-title>
        </x-grid-col>

        <x-grid-col width="col-6 col-md-6">
            <button class="btn btn-primary float-end"><a class="dropdown-item" href="{{ route('hostingDetail.create') }}"><i class="fa fa-plus"
                aria-hidden="true"></i> Create New</a></button>
        </x-grid-col>

    <x-message />

    </x-grid-row>

    <div class="table-responsive">

        <table class="table border">
            <thead>
                
                <tr>
                    <x-table.column :column="$column" columnName="id" :direction="$direction" route="hostingDetail.index">
                        ID
                    </x-table.column>

                    <x-table.column :column="$column" columnName="website_id" :direction="$direction" route="hostingDetail.index">
                        Website Name
                    </x-table.column>

                    <x-table.column :column="$column" columnName="forge_server_id" :direction="$direction" route="hostingDetail.index">
                        Server Name
                    </x-table.column>

                    <x-table.column :column="$column" columnName="host_name" :direction="$direction" route="hostingDetail.index">
                        Host Name
                    </x-table.column>

                    <x-table.column :column="$column" columnName="host_username" :direction="$direction" route="hostingDetail.index">
                        Host Username
                    </x-table.column>

                    <x-table.column :column="$column" columnName="host_password" :direction="$direction" route="hostingDetail.index">
                        Host Password
                    </x-table.column>

                    <x-table.column :column="$column" columnName="host_port_number" :direction="$direction" route="hostingDetail.index">
                        Port Number
                    </x-table.column>

                    <x-table.column :column="$column" columnName="server_supplier_lookup_id" :direction="$direction" route="hostingDetail.index">
                        Server Supplier
                    </x-table.column>

                    <x-table.column :column="$column" columnName="connection_type_lookup_id" :direction="$direction" route="hostingDetail.index">
                        Connection Type
                    </x-table.column>

                    <x-table.column :column="$column" columnName="created_at" :direction="$direction" route="hostingDetail.index">
                        Created
                    </x-table.column>

                    <x-table.column :column="$column" columnName="updated_at" :direction="$direction" route="hostingDetail.index">
                        Updated
                    </x-table.column>

                    <th scope="col">Actions</th>
                </tr>

            </thead>
            <tbody>
        
                @foreach ($hostingDetails as $hostingDetail)

                    <tr>
                        <td scope="row">{{ $hostingDetail->id }}</td>
                        <td scope="row"><a
                                href="{{ route('website.show', $hostingDetail->website->id) }}">{{ $hostingDetail->website->website_name }}</a>
                        </td>

                        {{-- check if forge server id in the databse empty or not
                        if forge server id is not found then show show empty table data --}}
                        @if ($hostingDetail->forge_server_id != '')
                            @foreach ($serverDetails['servers'] as $server)
                                @if ($server['id'] == $hostingDetail->forge_server_id)
                                    <td scope="row"><a href="{{ route('hostingDetail.server', $server['id']) }}">{{ $server['name'] }}</a></td>
                                @endif
                            @endforeach
                        @else
                            <td scope="row"></td>
                        @endif

                        <td scope="row"><a href="{{ route('hostingDetail.show', $hostingDetail->id) }}">{{ $hostingDetail->host_name }}</a>
                        </td>
                        <td scope="row">{{ $hostingDetail->host_username }}</td>
                        <td scope="row">
                        <input class="form-control" type="password" value="{{ $hostingDetail->host_password }}"
                        onclick="this.type='text';" onblur="this.type='password';">
                        </td>
                        <td scope="row">{{ $hostingDetail->host_port_number }}</td>
                        <td scope="row">{{ $hostingDetail->server_supplier_lookup->value }}</td>
                        <td scope="row">{{ $hostingDetail->connection_type_lookup->value }}</td>
                        <td scope="row">{{ $hostingDetail->created_at->format('d/m/Y') }}</td>
                        <td scope="row">{{ $hostingDetail->updated_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('hostingDetail.edit', $hostingDetail->id) }}" class="text-success me-3">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>

                            <a href="{{ $hostingDetail->id }}" class="text-danger delete" data-bs-toggle="modal"
                                data-id="{{ $hostingDetail->id }}" data-bs-target="#ModalDelete">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
        
            </tbody>
        
        </table>
    </div>

    <x-delete-modal action="{{ route('hostingDetail.destroy') }}">
        Delete Hosting Detail Record
    </x-delete-modal>

    <x-pagination :model="$hostingDetails" />
@endsection
