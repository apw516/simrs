@extends('login.main')
@section('container')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('public/auth/images/undraw_remotely_2j6y.svg')}}" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6 contents">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <h3>Silahkan Registrasi</h3>
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button class="btn-close" data-bs-dismiss="alert" aria-label="close"
                                        type="button"></button>
                                </div>
                            @endif
                            @if (session()->has('loginError'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('loginError') }}
                                    <button class="btn-close" data-bs-dismiss="alert" aria-label="close"
                                        type="button"></button>
                                </div>
                            @endif
                        </div>
                        <form action="{{ route('register')}}" method="post">
                            @csrf
                            <div class="form-group first mb-2">
                                <label for="username">Nama lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" autofocus required value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group first mb-2">
                                <label for="username">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" required value="{{ old('usernaname') }}">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group first">
                                {{-- <label for="exampleFormControlSelect1">Pilih Unit Kerja</label> --}}
                                <select class="form-control" style="background-color:rgb(234, 238, 243)" id="unit" name="unit">
                                  <option>Pilih Unit Kerja</option>
                                  @foreach ($unit as $u )
                                  <option value="{{ $u->kode_unit }}">{{ $u->nama_unit }}</option>
                                  @endforeach
                                </select>
                              </div>
                            <div class="form-group last mt-2 mb-4">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <input type="submit" value="REGISTRASI" class="btn btn-block btn-primary">
                            <span class="d-block text-center my-4"><a href="{{ route('login')}}">Login</a></span>
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
