@extends('layouts.loging')

@section('content')
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{ __('Register to use the application') }}</p>

            <form action="{{ route('dashboard.register') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" id="name" value="{{ old('name') }}" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="{{ __('Name') }}" autocomplete="name" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('name')
                    <span id="name-error" style=""
                          class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="email" id="email" value="{{ old('email') }}" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="{{ __('Email') }}" autocomplete="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-at"></span>
                        </div>
                    </div>
                    @error('email')
                    <span id="email-error" style=""
                          class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="password" value="{{ old('password') }}"
                           placeholder="{{ __('Password') }}"
                           class="form-control @error('password') is-invalid @enderror" name="password"
                           autocomplete="new-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span id="password-error" style=""
                          class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="password-confirmation" name="password_confirmation"
                           class="form-control" placeholder="{{ __('Confirmation Password') }}"
                           autocomplete="new-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>

            <p class="mb-1">
                <a href="forgot-password.html">I forgot my password</a>
            </p>
            <p class="mb-0">
                <a href="/" class="text-center">I have an account</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
@endsection
