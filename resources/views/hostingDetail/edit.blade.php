@extends('layout')
@section('content')
    <x-card-grid>

        <x-form.hosting-detail-form :hostingDetail="$hostingDetail"
        :serverDetails="$serverDetails" 
        :server_supplier_lookups="$server_supplier_lookups"
        :connection_type_lookups="$connection_type_lookups"
        :website_show_url="$website_show_url"
        :hostingDetail_url="$hostingDetail_url"/>

    </x-card-grid>
@endsection