@extends('layout')
@section('content')

    <x-grid-row>
        <x-grid-col width="col-6 col-md-3">
            <x-title>Client Contacts</x-title>
        </x-grid-col>

        <x-grid-col width="col-12 col-md-6">
            <x-search name="search" :value="request('search')" placeholder="Search Client First Name or Last Name or Email Address" />
        </x-grid-col>

        <x-grid-col width="col-12 col-md-3 pb-3 d-flex justify-content-end">
            <x-button-create-new redirectTo="/clientContacts/create"/>
        </x-grid-col>

    <x-message />

    </x-grid-row>


    <div class="table-responsive">
        <table class="table border">
            <thead>

                <tr> 
                    <x-table.column :column="$column" columnName="id" :direction="$direction" route="clientContact.index">
                        ID
                    </x-table.column>
                    
                    <x-table.column :column="$column" columnName="client_id" :direction="$direction" route="clientContact.index">
                        Client Name
                    </x-table.column>

                    <x-table.column :column="$column" columnName="client_contact_first_name" :direction="$direction" route="clientContact.index">
                        Primary Contact
                    </x-table.column>

                    <x-table.column :column="$column" columnName="client_contact_surname" :direction="$direction" route="clientContact.index">
                        Contact Name
                    </x-table.column>

                    <x-table.column :column="$column" columnName="client_email_address" :direction="$direction" route="clientContact.index">
                        Email Address
                    </x-table.column>

                    <x-table.column :column="$column" columnName="client_phone_number" :direction="$direction" route="clientContact.index">
                        Phone Number
                    </x-table.column>

                    <x-table.column :column="$column" columnName="created_at" :direction="$direction" route="clientContact.index">
                        Created
                    </x-table.column>

                    <x-table.column :column="$column" columnName="updated_at" :direction="$direction" route="clientContact.index">
                        Updated
                    </x-table.column>

                    <th scope="col">Actions</th>
                </tr>

            </thead>
            
            <tbody>
        
                @foreach ($clientContacts as $clientContact)
                    <tr>
                        <td>{{ $clientContact->id }}</td>
                        <td><a href="{{ route('client.show', $clientContact->client->id) }}">{{ $clientContact->client->client_name }}</a>
                        </td>
                    
                        <td> <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="flexRadioDefault2"
                                value="{{ $clientContact->client_primary_contact }}"
                                {{ $clientContact->client_primary_contact === 1 ? 'checked' : '' }} disabled> </td>
                    
                        <td><a href="{{ route('clientContact.show', $clientContact->id) }}">{{ $clientContact->client_contact_first_name }}
                                {{ $clientContact->client_contact_surname }}</a> </td>
                        <td>{{ $clientContact->client_email_address }} </td>
                        <td>{{ $clientContact->client_phone_number }} </td>
                        <td>{{ $clientContact->created_at->format('d/m/Y') }}</td>
                        <td>{{ $clientContact->updated_at->format('d/m/Y') }}</td>
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
                @endforeach
        
            </tbody>
        
        </table>    
    </div>

    <x-delete-modal action="{{ route('clientContact.destroy') }}">
        Delete Client Contact Record
    </x-delete-modal>

    <x-pagination :model="$clientContacts" />
@endsection
