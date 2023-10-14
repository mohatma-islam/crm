@extends('layout')
@section('content')

    <x-grid-row>

        <x-grid-col width="col-2 col-md-8">
            <x-title>Deal</x-title>
        </x-grid-col>

        <x-grid-col width="col-6 pe-3 col-md-2 ps-md-3">
            <x-dropdown-filter filterName="Filter By Stage">
                @foreach ($deal_stages as $deal_stage)
                    <li>
                        <input class="form-check-input" type="radio" name="deal_stage" value="{{ $deal_stage->id }}" {{ $deal_stage->id == $selectedDealStage ? 'checked' : ''}}>
                        <label class="form-check-label">
                            {{ $deal_stage->value }}
                        </label>
                    </li>
                @endforeach
            </x-dropdown-filter>
        </x-grid-col>

        <x-grid-col width="col-4 col-md-2">
            <button class="btn btn-primary float-end"><a class="dropdown-item" href="{{ route('deal.create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a></button>
        </x-grid-col>

    <x-message />

    </x-grid-row>

    <div class="table-responsive">

        <table class="table border">
            <thead>
                <tr>
                    <x-table.column :column="$column" columnName="id" :direction="$direction" route="deal.index">
                        ID
                    </x-table.column>
                    
                    <x-table.column :column="$column" columnName="client_id" :direction="$direction" route="deal.index">
                        Clien Name
                    </x-table.column>

                    <x-table.column :column="$column" columnName="deal_stage_id" :direction="$direction" route="deal.index">
                        Stage
                    </x-table.column>

                    <x-table.column :column="$column" columnName="estimated_deal" :direction="$direction" route="deal.index">
                        Est. Deal
                    </x-table.column>

                    <x-table.column :column="$column" columnName="created_at" :direction="$direction" route="deal.index">
                        Created
                    </x-table.column>

                    <x-table.column :column="$column" columnName="updated_at" :direction="$direction" route="deal.index">
                        Updated
                    </x-table.column>

                    <th scope="col">Actions</th>
        
                </tr>
            </thead>
            <tbody>
        
                @foreach ($deals as $deal)
                    <tr>
                        <td>{{ $deal->id }}</td>
                    
                        <td scope="row">
                            <a href="{{ route('client.show', $deal->client->id) }}">{{ $deal->client->client_name }}</a>
                        </td>
                    
                        <td>
                            <a href="{{ route('deal.show', $deal->id) }}">{{ $deal->deal_stage_lookup->value }}</a>
                        </td>

                        <td>£ {{ $deal->estimated_deal }}</td>
                    
                        <td>{{ $deal->created_at->format('d/m/Y') }}</td>
                        <td>{{ $deal->updated_at->format('d/m/Y') }}</td>
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
                @endforeach
            </tbody>
        
        </table>

    </div>

    <x-delete-modal action="{{ route('deal.destroy') }}">
        Delete Deal Record
    </x-delete-modal>

    <x-pagination :model="$deals" />
@endsection