@extends('login.main')
@section('container')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="/auth/images/undraw_remotely_2j6y.svg" alt="Image"
                class="img-fluid">
        </div>
        <div class="col-md-6 contents">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="mb-4">
                        <h3>Silahkan Login</h3>
                        @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button class="btn-close" data-bs-dismiss="alert" aria-label="close" type="button"></button>
                        </div>
                        @endif
                        @if(session()->has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('loginError') }}
                            <button class="btn-close" data-bs-dismiss="alert" aria-label="close" type="button"></button>
                        </div>
                        @endif
                    </div>
                    <form action="/login" method="post">
                        @csrf
                        <div class="form-group first">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" autofocus required value="{{ old('usernaname') }}">
                            @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group last mb-4">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <input type="submit" value="Log In" class="btn btn-block btn-primary">
                        <span class="d-block text-center my-4"><a href="/register">Register</a></span>
                        <span class="d-block text-center my-4 text-muted">&mdash; view dashboard &mdash;</span>

                        <div class="social-login text-center">
                            <a href="#" class="facebook">
                                <span class="icon-facebook mr-3"></span>
                            </a>
                            <a href="#" class="twitter">
                                <span class="icon-twitter mr-3"></span>
                            </a>
                            <a href="#" class="google">
                                <span class="icon-google mr-3"></span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection