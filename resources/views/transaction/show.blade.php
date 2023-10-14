@extends('layout')
@section('content')
    <x-content-between>

        <x-title>Transaction</x-title>

        <x-button-back/>

    </x-content-between>

    <table class="table border">
        <tbody>

            <tr>
                <th>Transaction ID</th>
                <td>{{ $transaction->id }}</td>
            </tr>

            <tr>
                <th>Client Name</th>
                <td scope="row">
                    <a href="{{ route('client.show', $transaction->client->id) }}">{{ $transaction->client->client_name }}</a>
                </td>
            </tr>

            <tr>
                <th>Type</th>
                <td>
                    {{ $transaction->type }}
                </td>
            </tr>

            <tr>
                <th>
                    Amount
                </th>
                <td>£ {{ $transaction->amount }}</td>
            </tr>

            <tr>
                <th>
                    Created
                </th>
                <td>{{ $transaction->updated_at->format('d/m/Y') }}</td>
            </tr>

            <tr>
                <th>
                    Updated
                </th>
                <td>{{ $transaction->updated_at->format('d/m/Y') }}</td>
            </tr>

            <tr>
                <th>
                    Actions
                </th>
                <td>
                    <a href="{{ route('transaction.edit', $transaction->id) }}" class="text-success me-3">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
            
                    <a href="{{ $transaction->id }}" class="text-danger delete" data-bs-toggle="modal" data-id="{{ $transaction->id }}"
                        data-bs-target="#ModalDelete">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>

        </tbody>
    </table>

    <x-delete-modal action="{{ route('transaction.destroy') }}">
        Delete Transaction Record
    </x-delete-modal>
@endsection
