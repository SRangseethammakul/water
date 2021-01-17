<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เข้าสู่ระบบ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-form-label">{{ __('Password') }}</label>

                        <div class="col-md-12">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>

                </form>

                <hr>

                <div class="container">
                    <div class="row">
                      <div class="col align-self-center">
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
                        {{-- <a href="{{ url('auth/facebook') }}">
                            <button type="button" class="btn btn-outline-info btn-block ml-2 mt-2" style="padding: 12px 16px"><i
                                    class="fa fa-facebook ml-2" style="margin:5px 15px 5px 5px" aria-hidden="true"></i>Login
                                with Facebook</button>
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
                        {{-- <a href="{{ url('auth/google') }}">
                            <button type="button" class="btn btn-outline-success btn-block ml-2 mt-2" style="padding: 12px 16px"><i
                                    class="fa fa-google ml-2" style="margin:5px 15px 5px 5px" aria-hidden="true"></i>Login
                                with Google</button>
                        </a> --}}
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
