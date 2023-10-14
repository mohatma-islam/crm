@extends('layout')
@section('content')
    <x-card-grid>

     <x-form.transaction-form
     :transaction="$transaction"
     :clients="$clients"
     :client_show_url="$client_show_url"
     :transaction_url="$transaction_url"
     />

    </x-card-grid>
@endsection