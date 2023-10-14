@extends('layout')
@section('content')
    <x-content-between>

        <x-title>Whois</x-title>
        
        <x-button-back/>

    </x-content-between>

    @if($domain != '')

        <x-table.table :headers="[
            'Domain ID',
            'Domain Name',
            'Domain Owner',
            'Registrar',
            'Whois Server',
            'States',
            'Name Servers',
            'Created',
            'Expiration',
            'Updated',
        ]">

            <x-table.whois-table-data :domain="$domain" />

        </x-table.table>

    @else
        <div>
            No Data found, Please check the domain name correctly, it might not exists.
        </div>
    @endif

@endsection
