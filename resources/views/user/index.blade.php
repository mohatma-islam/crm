@extends('layout')
@section('content')

        <div class="row mt-5 pt-5">

            <div class="col-12 col-sm-7 col-md-7 col-lg-3 mx-auto">

                <div class="card border-0 shadow">
                    <div class="card-body">


                        <div class="text-center my-3">
                            <span> <img height="80" width="150" src="{{ URL('images/fifteen_logo.png') }}" alt="" class="rounded">
                            </span>
                        </div>

                        <x-alert />

                        <form method="POST" action="/login">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input type="email" class="form-control" name="user_email"
                                    value="{{ old('user_email') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            <button type="submit" class="btn btn-primary mt-2 w-100">Sign In</button> <br> <br>

                            <a href="{{ route('google-auth') }}" class="btn btn-light border w-100">
                                <img height="15" width="20"
                                    src="https://aid-frontend.prod.atl-paas.net/atlassian-id/front-end/5.0.427/static/media/google-logo.e086107b.svg"
                                    alt="">
                                Sign In with Google </a>

                        </form>
                    </div>
                </div>

            </div>

        </div>

@endsection
