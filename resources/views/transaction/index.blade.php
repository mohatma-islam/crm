@extends('layout')
@section('content')

    <x-grid-row>

        <x-grid-col width="col-6 col-md-6">
            <x-title>Transactions</x-title>
        </x-grid-col>

        <x-grid-col width="col-6 col-md-6">
            <button class="btn btn-primary float-end"><a class="dropdown-item" href="{{ route('transaction.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a></button>
        </x-grid-col>

    <x-message />

    </x-grid-row>

    <div class="table-responsive">

        <table class="table border">
            <thead>
                <tr>
                    <x-table.column :column="$column" columnName="id" :direction="$direction" route="transaction.index">
                        ID
                    </x-table.column>
                    
                    <x-table.column :column="$column" columnName="client_id" :direction="$direction" route="transaction.index">
                        Clien Name
                    </x-table.column>

                    <x-table.column :column="$column" columnName="type" :direction="$direction" route="transaction.index">
                        Type
                    </x-table.column>

                    <x-table.column :column="$column" columnName="amount" :direction="$direction" route="transaction.index">
                        Amount
                    </x-table.column>

                    <x-table.column :column="$column" columnName="created_at" :direction="$direction" route="transaction.index">
                        Created
                    </x-table.column>

                    <x-table.column :column="$column" columnName="updated_at" :direction="$direction" route="transaction.index">
                        Updated
                    </x-table.column>

                    <th scope="col">Actions</th>
        
                </tr>
            </thead>
            <tbody>
        
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                    
                        <td scope="row">
                            <a href="{{ route('client.show', $transaction->client->id) }}">{{ $transaction->client->client_name }}</a>
                        </td>
                    
                        <td>
                            <a href="{{ route('transaction.show', $transaction->id) }}">{{ $transaction->type }}</a>
                        </td>

                        <td>£ {{ $transaction->amount }}</td>
                    
                        <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
                        <td>{{ $transaction->updated_at->format('d/m/Y') }}</td>
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
                @endforeach
            </tbody>
        
        </table>

    </div>

    <x-delete-modal action="{{ route('transaction.destroy') }}">
        Delete Transaction Record
    </x-delete-modal>

    <x-pagination :model="$transactions" />
@endsection