@extends('layouts.backend.app')

@section('content')
<div id="auth">

    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-12 mx-auto">
                <div class="card pt-4">
                    <div class="card-body">
                        <div class="text-center mb-5">
                            <img src="{{ url('assets/images/web/logo.png') }}" height="48" class='mb-4 rounded-circle'>
                            <h3>Register</h3>
                            <p>Please register to continue to login.</p>
                        </div>
                        @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show d-flex" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16"
                                role="img" aria-label="Warning:">
                                <path
                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                            </svg>

                            {{ session('error')}}

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show d-flex" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16"
                                role="img" aria-label="Success:">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </svg>

                            {{ session('success')}}

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-group position-relative has-icon-left">
                                <label for="name">Nama lengkap</label>
                                <div class="position-relative">
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        value="{{ old('name') }}">
                                    <div class="form-control-icon">
                                        <i data-feather="user"></i>
                                    </div>
                                </div>
                                @error('name')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="form-group position-relative has-icon-left">
                                <label for="email">Email</label>
                                <div class="position-relative">
                                    <input type="text" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        value="{{ old('email') }}">
                                    <div class="form-control-icon">
                                        <i data-feather="mail"></i>
                                    </div>
                                </div>
                                @error('email')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="form-group position-relative has-icon-left">
                                <label for="password">Password</label>
                                <div class="position-relative">
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" id="password">
                                    <div class="form-control-icon">
                                        <i data-feather="lock"></i>
                                    </div>
                                </div>
                                @error('password')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <div class="form-group position-relative has-icon-left">
                                <label for="conf_pass">Konfirmasi password</label>
                                <div class="position-relative">
                                    <input type="password" name="conf_pass"
                                        class="form-control @error('conf_pass') is-invalid @enderror" id="conf_pass">
                                    <div class="form-control-icon">
                                        <i data-feather="lock"></i>
                                    </div>
                                </div>
                                @error('conf_pass')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>

                            <small>
                                <a href="{{ route('login') }}">Has been acount? back to login page</a>
                            </small>

                            <div class="clearfix">
                                <button class="btn btn-primary float-end" type="submit">Register</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection