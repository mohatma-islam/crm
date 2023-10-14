@extends('layout')
@section('content')
    <x-card-grid>

        <x-form.transaction-form 
         :session_client_id="$session_client_id"
         :transaction="$transaction"
         :clients="$clients"
         :client_show_url="$client_show_url"
         :transaction_url="$transaction_url"
         />

    </x-card-grid>
@endsection