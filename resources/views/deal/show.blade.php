@extends('layout')
@section('content')
    <x-content-between>

        <x-title>Deal</x-title>

        <x-button-back/>

    </x-content-between>

    <table class="table border">
        <tbody>

            <tr>
                <th>Deal ID</th>
                <td>{{ $deal->id }}</td>
            </tr>

            <tr>
                <th>Client Name</th>
                <td scope="row">
                    <a href="{{ route('client.show', $deal->client->id) }}">{{ $deal->client->client_name }}</a>
                </td>
            </tr>

            <tr>
                <th>Stage</th>
                <td>
                    {{ $deal->deal_stage_lookup->value }}
                </td>
            </tr>

            <tr>
                <th>
                    Estimated deal
                </th>
                <td>£ {{ $deal->estimated_deal }}</td>
            </tr>

            <tr>
                <th>
                    Created
                </th>
                <td>{{ $deal->updated_at->format('d/m/Y') }}</td>
            </tr>

            <tr>
                <th>
                    Updated
                </th>
                <td>{{ $deal->updated_at->format('d/m/Y') }}</td>
            </tr>

            <tr>
                <th>
                    Actions
                </th>
                <td>
                    <a href="{{ route('deal.edit', $deal->id) }}" class="text-success me-3">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
            
                    <a href="{{ $deal->id }}" class="text-danger delete" data-bs-toggle="modal" data-id="{{ $deal->id }}"
                        data-bs-target="#ModalDelete">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>

        </tbody>
    </table>

    <x-delete-modal action="{{ route('deal.destroy') }}">
        Deal Transaction Record
    </x-delete-modal>
@endsection
