@extends('front')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Profile</a></li>
                        <li class="breadcrumb-item active">Daftar Teman</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if ($users->profile)
                                    <img class="profile-user-img img-fluid img-circle"
                                        id="previewProfile{{ $users->id }}" src="{{ asset('image/' . $users->profile) }}"
                                        alt="User profile picture">
                                @else
                                    <img class="profile-user-img img-fluid img-circle"
                                        id="previewProfile{{ $users->id }}" src="{{ asset('DefaultImage/profil.jpeg') }}"
                                        alt="User profile picture">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ Auth::user()->username }}</h3>

                            <p class="text-muted text-center">{{ Auth::user()->name }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <a href="" class="text-dark"><b>Friends</b> <span class="float-right"><i
                                                class="fa fa-user"></i>
                                            {{ count($countfriends) }}</span></a>
                                </li>
                            </ul>

                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        {{-- <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                        data-toggle="tab">Activity</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header --> --}}
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="row">
                                    @foreach ($friend as $data)
                                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                            <div class="card bg-light d-flex flex-fill">
                                                <div class="card-header text-muted border-bottom-0">
                                                    {{ $data->username }}
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="lead"><b>{{ $data->name }}</b></h2>
                                                            {{-- <p class="text-muted text-sm"><b>About: </b> Web Designer / UX /
                                                                Graphic Artist / Coffee Lover </p> --}}
                                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                <li class="small mb-2"><span class="fa-li"><i
                                                                            class="fas fa-lg fa-building"></i></span>
                                                                    Address: Ponorogo</li>
                                                                <li class="small"><span class="fa-li"><i
                                                                            class="fas fa-lg fa-phone"></i></span> Phone :
                                                                    +6285156696153</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-5 text-center">
                                                            @if ($data->profile)
                                                                <img src="{{ asset('image/' . $data->profile) }}"
                                                                    alt="user-avatar" class="img-circle img-fluid">
                                                            @else
                                                                <img src="{{ asset('DefaultImage/profil.jpeg') }}"
                                                                    alt="user-avatar" class="img-circle img-fluid">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <div class="text-right">
                                                        <a href="{{ url('profileUser/' . $data->id) }}"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="fas fa-user"></i> View Profile
                                                        </a>
                                                        <a href="#" class="btn btn-sm bg-teal">
                                                            <i class="fas fa-comments"></i>
                                                        </a>
                                                        <div class="btn-group dropup">
                                                            <a href="#" class="btn btn-sm btn-success"
                                                                data-toggle="dropdown">
                                                                <i class="fas fa-user-check"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                                <a href="{{ url('unfriend/' . $data->id) }}"
                                                                    class="dropdown-item font-weight-bold"
                                                                    onclick="return confirm('Anda Yakin Untuk Menghapus Pertemanan??/')">
                                                                    <i class="fas fa-user-times"></i> Hapus Pertemanan
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- /.content -->
@endsection
