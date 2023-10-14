@extends('layout')
@section('content')
    <x-content-between>

        <x-title>Client Contact</x-title>
        
        <x-button-back/>

    </x-content-between>

    <table class="table border">
        <tbody>

            <tr>
                <th>Client Contact ID</th>
                <td>{{ $clientContact->id }}</td>
            </tr>

            <tr>
                <th>Client Name</th>
                <td>
                    <a href="{{ route('client.show', $clientContact->client->id) }}">{{ $clientContact->client->client_name }}</a>
                </td>
            </tr>

            <tr>
                <th>Client Primary Contact</th>
                <td><input class="form-check-input" type="checkbox" name="flexRadioDefault" id="flexRadioDefault2"
                    value="{{ $clientContact->client_primary_contact }}"
                    {{ $clientContact->client_primary_contact === 1 ? 'checked' : '' }} disabled></td>
            </tr>

            <tr>
                <th>Client Contact Name</th>
                <td><a href="{{ route('clientContact.show', $clientContact->id) }}">{{ $clientContact->client_contact_first_name }}
                    {{ $clientContact->client_contact_surname }}</a> </td>
            </tr>

            <tr>
                <th>
                    Client Email Address
                </th>
                <td>{{ $clientContact->client_email_address }} </td>
            </tr>

            <tr>
                <th>
                    Client Phone Number
                </th>
                <td>{{ $clientContact->client_phone_number }} </td>
            </tr>

            <tr>
                <th>
                    Created
                </th>
                <td>{{ $clientContact->created_at->format('d/m/Y') }}</td>
            </tr>

            <tr>
                <th>
                    Updated
                </th>
                <td>{{ $clientContact->updated_at->format('d/m/Y') }}</td>
            </tr>

            <tr>
                <th>
                    Actions
                </th>
                <td>
                    <a href="{{ route('clientContact.edit', $clientContact->id) }}" class="text-success me-3">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
            
                    <a href="{{ $clientContact->id }}" class="text-danger delete" data-bs-toggle="modal"
                        data-id="{{ $clientContact->id }}" data-bs-target="#ModalDelete">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>

        </tbody>
    </table>

    <x-delete-modal action="{{ route('clientContact.destroy') }}">
        Delete Client Contact Record
    </x-delete-modal>
@endsection
