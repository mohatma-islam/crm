@extends('layout')
@section('content')

    <x-grid-row>
        <x-grid-col width="col-6 col-md-7">
            <x-title>Website</x-title>
        </x-grid-col>

        <x-grid-col width="col-6 col-md-2 mb-2">
            <button class="btn btn-primary float-end"><a class="dropdown-item"
                    href="{{ route('whois.index', $website->website_address) }}"> <i class="fa fa-search"
                        aria-hidden="true"></i> Whois</a></button>
        </x-grid-col>

        <x-grid-col width="col-6 col-md-2 ps-md-5">
            <x-dropdown name="Create">
                <li><a class="dropdown-item" href="{{ route('hostingDetail.create') }}">Hosting Detail</a></li>
                <li><a class="dropdown-item" href="{{ route('technology.create') }}">Technology</a></li>
                <li><a class="dropdown-item" href="{{ route('serviceLevel.create') }}">Service Level</a></li>
            </x-dropdown>
        </x-grid-col>

        <x-grid-col width="col-6 col-md-1 pb-3">
            <button class="btn btn-primary float-end"><a class="dropdown-item"
                    href="{{ $client_show_url ?? ($website_url ?? url()->previous()) }}">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Back </a></button>
        </x-grid-col>
    </x-grid-row>


    <table class="table border">
        <tbody>

            <tr>
                <th>Website ID</th>
                <td>{{ $website->id }}</td>
            </tr>

            <tr>
                <th>Client Name</th>
                <td>
                    <a href="{{ route('client.show', $website->client->id) }}">{{ $website->client->client_name }}</a>
                </td>
            </tr>

            <tr>
                <th>Website Name</th>
                <td>{{ $website->website_name }}</td>
            </tr>

            <tr>
                <th>Website Address</th>
                <td>{{ $website->website_address }}</td>
            </tr>

            <tr>
                <th>Website Technology Stack</th>
                <td>
                    @if ($website->technologies->count())
                        <ul>

                            @foreach ($website->technologies as $technology)
                                <li>

                                    <a href="{{ route('technology.show', $technology->id) }}">{{ $technology->technology_lookup->value }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        No Technology Record Added
                    @endif
                </td>
            </tr>

            <tr>
                <th>Services</th>
                <td>
                    @if ($website->serviceLevels->count())
                        <ul>
                            @foreach ($website->serviceLevels as $serviceLevel)
                                <li>
                                    <a href="{{ route('serviceLevel.show', $serviceLevel->id) }}">{{ $serviceLevel->serviceLevel_lookup->value }},
                                        {{ $serviceLevel->serviceLevelMaintenance_lookup->value }} Maintenance</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        No Service Level Record Added
                    @endif
                </td>
            </tr>

            <tr>
                <th>
                    Created
                </th>
                <td>
                    {{ $website->created_at->format('d/m/Y') }}
                </td>
            </tr>

            <tr>
                <th>
                    Updated
                </th>
                <td>
                    {{ $website->updated_at->format('d/m/Y') }}
                </td>
            </tr>

            <tr>
                <th>
                    Actions
                </th>
                <td>
                    <a href="{{ route('website.edit', $website->id) }}" class="text-success me-3">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>

                    <a href="{{ $website->id }}" class="text-danger delete" data-bs-toggle="modal"
                        data-id="{{ $website->id }}" data-bs-target="#ModalDelete">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>

        </tbody>
    </table>

    {{-- check if Hosting Details exits or not --}}
    @if (!$website->hostingDetail)
    @else
        <x-item.accordio-hosting-detail :hostingDetail="$website->hostingDetail" />
    @endif

    <x-delete-modal action="{{ route('website.destroy') }}">
        Delete Website Record
    </x-delete-modal>
@endsection
