@extends('layout')
@section('content')
    <x-grid-row>
        <x-grid-col width="col-6 col-md-3">
            <x-title>Activities</x-title>
        </x-grid-col>

        <x-grid-col width="col-12 col-md-6">
            <x-search name="search" :value="request('search')" placeholder="Search type of Description" />
        </x-grid-col>

        <x-grid-col width="col-12 col-md-3 pb-3 d-flex justify-content-end">
            <x-button-create-new redirectTo="/activities/create" />
        </x-grid-col>
    
        <x-message />

    </x-grid-row>


    <div class="table-responsive">

        <table class="table border">
            <thead>
                <tr>
                    <x-table.column :column="$column" columnName="id" :direction="$direction" route="activity.index">
                        ID
                    </x-table.column>

                    <x-table.column :column="$column" columnName="client_id" :direction="$direction" route="activity.index">
                        Clients Name
                    </x-table.column>

                    <x-table.column :column="$column" columnName="type" :direction="$direction" route="activity.index">
                        Type
                    </x-table.column>

                    <x-table.column :column="$column" columnName="activity_description" :direction="$direction" route="activity.index">
                        Description
                    </x-table.column>

                    <x-table.column :column="$column" columnName="created_by_id" :direction="$direction" route="activity.index">
                        Created By
                    </x-table.column>

                    <x-table.column :column="$column" columnName="created_at" :direction="$direction" route="activity.index">
                        Created
                    </x-table.column>

                    <x-table.column :column="$column" columnName="updated_at" :direction="$direction" route="activity.index">
                        Created
                    </x-table.column>

                    <th scope="col">Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($activities as $activity)
                    <tr>
                        <td>{{ $activity->id }}</td>
                        <td><a href="{{ route('client.show', $activity->client->id) }}">{{ $activity->client->client_name }}</a>
                        </td>
                        <td><a href="{{ route('activity.show', $activity->id) }}">{{ $activity->activity_type }}</a> </td>
                        <td>{{ $activity->activity_description }}</td>
                        <td>{{ $activity->user->user_name }}</td>
                        <td>{{ $activity->created_at->format('d/m/Y') }}</td>
                        <td>{{ $activity->updated_at->format('d/m/Y') }}</td>
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
                @endforeach

            </tbody>

        </table>
    </div>


    <x-delete-modal action="{{ route('activity.destroy') }}">
        Delete Activity Record
    </x-delete-modal>

    <x-pagination :model="$activities" />
@endsection
