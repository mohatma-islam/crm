@extends('layout')
@section('content')
    <x-content-between>

        <x-title>Service Level</x-title>

        <x-button-back/>

    </x-content-between>

    <table class="table border">
        <tbody>

            <tr>
                <th>Service Level ID</th>
                <td>{{ $serviceLevel->id }}</td>
            </tr>

            <tr>
                <th>Website Name</th>
                <td scope="row">
                    <a href="{{ route('website.show', $serviceLevel->website->id) }}">{{ $serviceLevel->website->website_name }}</a>
                </td>
            </tr>

            <tr>
                <th>Service Level</th>
                <td>
                    {{ $serviceLevel->serviceLevel_lookup->value }}
                </td>
            </tr>

            <tr>
                <th>Maintenance Time</th>
                <td>
                    {{ $serviceLevel->serviceLevelMaintenance_lookup->value }}
                </td>
            </tr>

            <tr>
                <th>
                    Created
                </th>
                <td>{{ $serviceLevel->created_at->format('d/m/Y') }}</td>
            </tr>

            <tr>
                <th>
                    Updated
                </th>
                <td>{{ $serviceLevel->updated_at->format('d/m/Y') }}</td>
            </tr>

            <tr>
                <th>
                    Actions
                </th>
                <td>
                    <a href="{{ route('serviceLevel.edit', $serviceLevel->id) }}" class="text-success me-3">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
            
                    <a href="{{ $serviceLevel->id }}" class="text-danger delete" data-bs-toggle="modal"
                        data-id="{{ $serviceLevel->id }}" data-bs-target="#ModalDelete">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>

        </tbody>
    </table>

    <x-delete-modal action="{{ route('serviceLevel.destroy') }}">
        Delete Client Contact Record
    </x-delete-modal>

@endsection
