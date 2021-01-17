<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">ลงทะเบียน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="name-register" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name-register" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email-register" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email-register" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-register" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-register" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm-register" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm-register" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('ลงทะเบียน') }}
                            </button>
                        </div>
                    </div>
                </form>

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
            </div>
        </div>
    </div>
</div>
