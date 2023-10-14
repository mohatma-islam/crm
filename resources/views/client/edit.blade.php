@extends('layout')
@section('content')
    <x-card-grid>

        <x-form.client-form :client="$client" :client_url="$client_url"/>

    </x-card-grid>
@endsection
