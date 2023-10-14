@extends('layout')
@section('content')
    <x-card-grid>
      
        <x-form.service-level-form
        :serviceLevel="$serviceLevel"
        :serviceLevel_lookups="$serviceLevel_lookups"
        :serviceLevelMaintenance_lookups="$serviceLevelMaintenance_lookups"
        :website_show_url="$website_show_url"
        :serviceLevel_url="$serviceLevel_url" />
    
    </x-card-grid>
@endsection
