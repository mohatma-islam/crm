@extends('layout')
@section('content')
    <x-card-grid>

        <x-content-between>

            <x-title>Update Activity Record</x-title>

            <x-button-back/>

        </x-content-between>

        <x-alert />

        <x-form.activity-form :activity="$activity" :clients="$clients"/>

    </x-card-grid>
@endsection
