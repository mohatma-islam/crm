@extends('layout')
@section('content')

    <x-grid-row>

        <x-grid-col width="col-6 col-md-6">
            <x-title>Technologies</x-title>
        </x-grid-col>

        <x-grid-col width="col-6 col-md-6">
            <button class="btn btn-primary float-end"><a class="dropdown-item" href="{{ route('technology.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a></button>
        </x-grid-col>

    <x-message />

    </x-grid-row>
    
    <div class="table-responsive">

        <table class="table border">
            <thead>
                <tr>
                    <x-table.column :column="$column" columnName="id" :direction="$direction" route="technology.index">
                        ID
                    </x-table.column>
                    
                    <x-table.column :column="$column" columnName="website_id" :direction="$direction" route="technology.index">
                        Website Name
                    </x-table.column>

                    <x-table.column :column="$column" columnName="technology_lookup_id" :direction="$direction" route="technology.index">
                        Technology
                    </x-table.column>

                    <x-table.column :column="$column" columnName="created_at" :direction="$direction" route="technology.index">
                        Created
                    </x-table.column>

                    <x-table.column :column="$column" columnName="updated_at" :direction="$direction" route="technology.index">
                        Updated
                    </x-table.column>

                    <th scope="col">Actions</th>
        
                </tr>
            </thead>
            <tbody>
        
                @foreach ($technologies as $technology)
                    <tr>
                        <td>{{ $technology->id }}</td>
                    
                        <td scope="row">
                            <a href="{{ route('website.show', $technology->website->id) }}">{{ $technology->website->website_name }}</a>
                        </td>
                    
                        <td>
                            <a href="{{ route('technology.show', $technology->id) }}">{{ $technology->technology_lookup->value }}</a>
                        </td>
                    
                        <td>{{ $technology->created_at->format('d/m/Y') }}</td>
                        <td>{{ $technology->updated_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('technology.edit', $technology->id) }}" class="text-success me-3">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                    
                            <a href="{{ $technology->id }}" class="text-danger delete" data-bs-toggle="modal" data-id="{{ $technology->id }}"
                                data-bs-target="#ModalDelete">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        
        </table>

    </div>

    <x-delete-modal action="{{ route('technology.destroy') }}">
        Delete Technology Record
    </x-delete-modal>

    <x-pagination :model="$technologies" />
@endsection