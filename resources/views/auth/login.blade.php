@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>

                        <hr>

                        <div class="container">
                            <div class="row">
                              <div class="col align-self-center">
                                <a href="{{ url('auth/github') }}" style="text-decoration: none;">
                                    <button type="button" class="btn btn-outline-secondary btn-block ml-2 mt-2" style="padding: 12px 16px">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-4">
                                                    <img src="{{ asset('images/github.png') }}" height="50" alt="github">
                                                </div>
                                                <div class="col-8">
                                                    <p class="text-center">ดำเนินการต่อด้วย GitHub</p>
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                </a>
                                {{-- <a href="{{ url('auth/github') }}">
                                    <button type="button" class="btn btn-outline-secondary btn-block ml-2" style="padding: 12px 16px"><i
                                            class="fa fa-github" style="margin:5px 15px 5px 5px" aria-hidden="true"></i> ดำเนินการต่อด้วย GitHub</button>
                                </a> --}}

                                {{-- <a href="{{ url('auth/facebook') }}">
                                    <button type="button" class="btn btn-outline-info btn-block ml-2 mt-2" style="padding: 12px 16px"><i
                                            class="fa fa-facebook ml-2" style="margin:5px 15px 5px 5px" aria-hidden="true"></i>ดำเนินการต่อด้วย Facebook</button>
                                </a> --}}
                                <a href="{{ url('auth/facebook') }}" style="text-decoration: none;">
                                    <button type="button" class="btn btn-outline-info btn-block ml-2 mt-2" style="padding: 12px 16px">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-4">
                                                    <img src="{{ asset('images/facebook.png') }}" height="50" alt="facebook">
                                                </div>
                                                <div class="col-8">
                                                    <p class="text-center">ดำเนินการต่อด้วย Facebook</p>
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                </a>
                                <a href="{{ url('auth/line') }}" style="text-decoration: none;">
                                    <button type="button" class="btn btn-outline-success btn-block ml-2 mt-2" style="padding: 12px 16px">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-4">
                                                    <img src="{{ asset('images/line.png') }}" height="50" alt="line">
                                                </div>
                                                <div class="col-8">
                                                    <p class="text-center">ดำเนินการต่อด้วย Line</p>
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                </a>
                              </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
