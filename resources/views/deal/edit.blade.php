@extends('layout')
@section('content')
    <x-card-grid>

     <x-form.deal-form
     :deal="$deal"
     :clients="$clients"
     :client_url="$client_url"
     :client_show_url="$client_show_url"
     :deal_url="$deal_url"
     :deal_stage_lookups="$deal_stage_lookups"
     />

    </x-card-grid>
@endsection