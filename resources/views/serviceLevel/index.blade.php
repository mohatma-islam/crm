@extends('layout')
@section('content')

    <x-grid-row>

        <x-grid-col width="col-6 col-md-6">
            <x-title>Service Levels</x-title>
        </x-grid-col>

        <x-grid-col width="col-6 col-md-6">
            <button class="btn btn-primary float-end"><a class="dropdown-item" href="{{ route('serviceLevel.create') }}"><i class="fa fa-plus"
                aria-hidden="true"></i> Create New</a></button>
        </x-grid-col>

    <x-message />

    </x-grid-row>

    <div class="table-responsive">

        <table class="table border">
            <thead>
                <tr>
                    <x-table.column :column="$column" columnName="id" :direction="$direction" route="serviceLevel.index">
                        ID
                    </x-table.column>

                    <x-table.column :column="$column" columnName="website_id" :direction="$direction" route="serviceLevel.index">
                        Website Name
                    </x-table.column>

                    <x-table.column :column="$column" columnName="service_level_lookup_id" :direction="$direction" route="serviceLevel.index">
                        Service Level
                    </x-table.column>

                    <x-table.column :column="$column" columnName="maintenance_lookup_id" :direction="$direction" route="serviceLevel.index">
                        Maintenance Time
                    </x-table.column>

                    <x-table.column :column="$column" columnName="created_at" :direction="$direction" route="serviceLevel.index">
                        Created
                    </x-table.column>

                    <x-table.column :column="$column" columnName="updated_at" :direction="$direction" route="serviceLevel.index">
                        Updated
                    </x-table.column>

                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($serviceLevels as $serviceLevel)
                    <tr>
                        <td>{{ $serviceLevel->id }}</td>

                        <td scope="row">
                            <a
                                href="{{ route('website.show', $serviceLevel->website->id) }}">{{ $serviceLevel->website->website_name }}</a>
                        </td>

                        <td><a href="{{ route('serviceLevel.show', $serviceLevel->id) }}">
                                {{ $serviceLevel->serviceLevel_lookup->value }}</a>
                        </td>
                        <td>
                            {{ $serviceLevel->serviceLevelMaintenance_lookup->value }}
                        </td>

                        <td>{{ $serviceLevel->created_at->format('d/m/Y') }}</td>
                        <td>{{ $serviceLevel->updated_at->format('d/m/Y') }}</td>
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
                @endforeach

            </tbody>

        </table>
    </div>



    <x-delete-modal action="{{ route('serviceLevel.destroy') }}">
        Delete Client Contact Record
    </x-delete-modal>

    <x-pagination :model="$serviceLevels" />
@endsection
