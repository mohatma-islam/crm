@extends('layout')
@section('content')
    <x-card-grid>

        <x-form.client-contact-form :session_client_id="$session_client_id"
         :clientContact="$clientContact"
         :client_show_url="$client_show_url"
         :clientContact_url="$clientContact_url"/>

    </x-card-grid>
@endsection
