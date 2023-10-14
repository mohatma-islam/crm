@extends('layout')
@section('content')
    <x-content-between>

        <x-title>Hosting Detail</x-title>

        <button class="btn btn-primary"><a class="dropdown-item" 
            href="{{ $websiteShowUrl ?? ($clientShowUrl ?? 
            ($hostingDetaillUrl ?? route('hostingDetail.index'))) }}">
             <i class="fa fa-arrow-left"
            aria-hidden="true"></i> Back </a></button>

    </x-content-between>

    <x-message />

    <table class="table border">
        <tbody>

            <tr>
                <th>Hosting Detail ID</th>
                <td scope="row">{{ $hostingDetail->id }}</td>
            </tr>

            <tr>
                <th>Website Name</th>
                <td scope="row"><a
                        href="{{ route('website.show', $hostingDetail->website->id) }}">{{ $hostingDetail->website->website_name }}</a>
                </td>
            </tr>

            <tr>
                <th>Server Name</th>
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
            </tr>

            <tr>
                <th>Host Name</th>
                <td scope="row"><a href="{{ route('hostingDetail.show', $hostingDetail->id) }}">{{ $hostingDetail->host_name }}</a>
                </td>
            </tr>

            <tr>
                <th>
                    Host Username
                </th>
                <td scope="row">{{ $hostingDetail->host_username }}</td>
            </tr>

            <tr>
                <th>
                    Host Password
                </th>
                <td scope="row">
                    <input class="form-control" type="password" value="{{ $hostingDetail->host_password }}"
                     onclick="this.type='text';" onblur="this.type='password';">
                </td>
            </tr>

            <tr>
                <th>
                    Port Number
                </th>
                <td scope="row">{{ $hostingDetail->host_port_number }}</td>
            </tr>

            <tr>
                <th>
                    Server Supplier
                </th>
                <td scope="row">{{ $hostingDetail->server_supplier_lookup->value }}</td>
            </tr>

            <tr>
                <th>
                    Connection Type
                </th>
                <td scope="row">{{ $hostingDetail->connection_type_lookup->value }}</td>
            </tr>

            <tr>
                <th>
                    Created
                </th>
                <td scope="row">{{ $hostingDetail->created_at->format('d/m/Y') }}</td>
            </tr>

            <tr>
                <th>
                    Updated
                </th>
                <td scope="row">{{ $hostingDetail->updated_at->format('d/m/Y') }}</td>
            </tr>

            <tr>
                <th>
                    Actions
                </th>
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

        </tbody>
    </table>

    <x-delete-modal action="{{ route('hostingDetail.destroy') }}">
        Delete Hosting Detail Record
    </x-delete-modal>
@endsection
