@extends('ermtemplate.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Profil</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="vpasien">
                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="profile-user-img img-fluid img-circle"
                                            src="{{ asset('public/img/avatar4.png') }}" alt="User profile picture">
                                    </div>

                                    <h3 class="profile-username text-center">{{ $datauser[0]->nama }}</h3>

                                    <p class="text-muted text-center"> username : {{ $datauser[0]->username }}</p>

                                    <form action="{{ route('gantipassword') }}" method="post">
                                        @csrf
                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b>Ganti Password</b> <a class="float-right"></a>
                                            </li>
                                            <li hidden class="list-group-item">
                                                <b>Password Lama</b> <a class="float-right"><input type="text"
                                                        name="id" id="id" class="form-control" value="{{ $datauser[0]->id }}"></a>
                                            </li>
                                            <li hidden class="list-group-item">
                                                <b>Password Lama</b> <a class="float-right"><input type="password"
                                                        name="passwordlama" id="passwordlama" value="" class="form-control"></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Password Baru</b> <a class="float-right"><input type="password"
                                                        name="passwordbaru" id="passwordbaru" class="form-control"></a>
                                            </li>
                                        </ul>
                                        <button type="submit" class="btn btn-primary btn-block"><b>SIMPAN</b></button>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    @endsection
