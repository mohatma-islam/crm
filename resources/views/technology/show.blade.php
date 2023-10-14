@extends('layout')
@section('content')
    <x-content-between>

        <x-title>Technology</x-title>

        <x-button-back/>

    </x-content-between>

    <table class="table border">
        <tbody>

            <tr>
                <th>Technology ID</th>
                <td>{{ $technology->id }}</td>
            </tr>

            <tr>
                <th>Website Name</th>
                <td scope="row">
                    <a href="{{ route('website.show', $technology->website->id) }}">{{ $technology->website->website_name }}</a>
                </td>
            </tr>

            <tr>
                <th>Technology</th>
                <td>
                    {{ $technology->technology_lookup->value }}
                </td>
            </tr>

            <tr>
                <th>
                    Created
                </th>
                <td>{{ $technology->created_at->format('d/m/Y') }}</td>
            </tr>

            <tr>
                <th>
                    Updated
                </th>
                <td>{{ $technology->updated_at->format('d/m/Y') }}</td>
            </tr>

            <tr>
                <th>
                    Actions
                </th>
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

        </tbody>
    </table>

    <x-delete-modal action="{{ route('technology.destroy') }}">
        Delete Technology Record
    </x-delete-modal>
@endsection
