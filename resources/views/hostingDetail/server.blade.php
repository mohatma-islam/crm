@extends('layout')
@section('content')
    <x-content-between>

        <x-title>Server Detail</x-title>

        <x-button-back/>

    </x-content-between>

    <x-table.table :headers="[
        'id',
        'Server Name',
        'Type',
        'Provider',
        'Provider id',
        'Size',
        'Region',
        'Ubuntu Version',
        'PHP version',
        'Database Type',
        'IP address',
        'SSH Port',
        'Created At',
        'Is Ready',
    ]">
        <x-table.server-detail-table-data :serverDetail="$serverDetail['server']" />

    </x-table.table>

    <h3>Sites</h3>

    <x-table.table :headers="[
        'id',
        'Site Name',
        'Status',
        'Repository',
        'Repository Branch',
        'Repository Status',
        'Project Type',
        'Php Version',
        'Created At',
        'Is Secure',
    ]">
        @foreach ($sites['sites'] as $site)
            <x-table.sites-detail-table-data :site="$site" />
        @endforeach
    </x-table.table>
@endsection
