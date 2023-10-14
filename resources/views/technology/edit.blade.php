@extends('layout')
@section('content')
    <x-card-grid>

     <x-form.technology-form
     :technology="$technology"
     :technology_lookups="$technology_lookups"
     :website_show_url="$website_show_url"
     :technolog_url="$technolog_url" />

    </x-card-grid>
@endsection
