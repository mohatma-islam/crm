@extends('layout')
@section('content')
    <x-card-grid>

        <x-form.website-form :session_client_id="$session_client_id"
         :website="$website"
         :client_show_url="$client_show_url"
         :website_url="$website_url"/>

    </x-card-grid>
@endsection
