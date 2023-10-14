@extends('layout')
@section('content')
    <x-card-grid>

        @if (session('success_message'))
            <div class="alert alert-success" role="alert">
                {{ session('success_message') }}
            </div>
        @endif

        @if (auth()->user()->tokens->count())
            <div class="alert alert-primary ps-4" role="alert">
                <h4 class="alert-heading">List of Tokens:</h4>
                <hr>
                <ul>
                    @forelse (auth()->user()->tokens as $token)
                        <li>{{ $token->name }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/personal_access_tokens">
            @csrf

            <div class="mb-3">
                <label class="form-label">Token Name</label>
                <input type="text" class="form-control" name="token_name" value="{{ old('token_name') }}">
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>

    </x-card-grid>
@endsection
