@extends('layout')
@section('content')
    <x-content-between>

        <x-title>Activity</x-title>

        <x-button-back/>

    </x-content-between>

    <x-message />

    <table class="table border">
        <tbody>

            <tr>
                <th>Actvity ID</th>
                <td>{{ $activity->id }}</td>
            </tr>

            <tr>
                <th>Client Name</th>
                <td><a href="{{ route('client.show', $activity->client->id) }}">{{ $activity->client->client_name }}</a> </td>
            </tr>

            <tr>
                <th>Activity Type</th>
                <td>{{ $activity->activity_type }}</td>
            </tr>

            <tr>
                <th>Activity Description</th>
                <td>{{ $activity->activity_description }}</td>
            </tr>

            <tr>
                <th>
                    Created By
                </th>
                <td>{{ $activity->user->user_name }}</td>
            </tr>

            <tr>
                <th>
                    Created
                </th>
                <td>{{ $activity->created_at->format('d/m/Y') }}</td>
            </tr>

            <tr>
                <th>
                    Updated
                </th>
                <td>{{ $activity->updated_at->format('d/m/Y') }}</td>
            </tr>

            <tr>
                <th>
                    Actions
                </th>
                <td>
                    <a href="{{ route('activity.edit', $activity->id) }}" class="text-success me-3">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
            
                    <a href="{{ $activity->id }}" class="text-danger delete" data-bs-toggle="modal"
                        data-id="{{ $activity->id }}" data-bs-target="#ModalDelete">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>

        </tbody>
    </table>

    <x-delete-modal action="{{ route('activity.destroy') }}">
        Delete Activity Record
    </x-delete-modal>

@endsection