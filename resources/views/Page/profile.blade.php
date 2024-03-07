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
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
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
                                {{-- <li class="list-group-item">
                                    <b>Followers</b> <a class="float-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Following</b> <a class="float-right">543</a>
                                </li> --}}
                                <li class="list-group-item">
                                    <a href="{{ url('daftarteman') }}" class="text-dark"><b>Friends</b> <span
                                            class="float-right"><i class="fa fa-user"></i>
                                            {{ count($countfriends) }}</span></a>
                                </li>
                            </ul>

                            {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Penjelasan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {{-- <strong class="btn btn-succes btn-xs"><i class="fa fa-check"></i></strong> --}}
                            <a href="#" class="btn btn-success btn-xs mb-2"><i class="fa fa-check"></i></a>
                            <p class="text-muted">
                                Upload Sudah Di Acc
                            </p>

                            <hr>
                            <a href="#" class="btn btn-secondary btn-xs mb-2">-</a>
                            <p class="text-muted">
                                Upload Masih Menunggu Acc Dari Admin
                            </p>

                            <hr>
                            <a href="#" class="btn btn-danger btn-xs mb-2">X</a>
                            <p class="text-muted">
                                Upload Di Tolak Oleh Admin
                            </p>

                            <hr>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                        data-toggle="tab">Persetujuan</a></li>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#gallery" data-toggle="tab">Gallery</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#friend"
                                        data-toggle="tab">Friends({{ count($friends) }}) <i
                                            class="nav-icon fas fa-bell"></i></a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    @foreach ($galery as $data)
                                        <div class="post">
                                            <div class="user-block">
                                                @if ($users->profile)
                                                    <img class="img-circle img-bordered-sm"
                                                        src="{{ asset('image/' . $users->profile) }}" alt="user image">
                                                @else
                                                    <img class="img-circle img-bordered-sm"
                                                        src="{{ asset('DefaultImage/profil.jpeg') }}" alt="user image">
                                                @endif
                                                <span class="username">
                                                    <a href="#">{{ $users->username }}</a>
                                                    @if ($data->status == 'accept')
                                                        <a href="#" class="float-right btn btn-success btn-xs"><i
                                                                class="fa fa-check"></i></a>
                                                    @endif
                                                    @if ($data->status == 'declined')
                                                        <a href="#" class="float-right btn btn-danger btn-xs">X</a>
                                                    @endif
                                                    @if ($data->status == 'pending')
                                                        <a href="#" class="float-right btn btn-secondary btn-xs">-</a>
                                                    @endif
                                                </span>
                                                <span class="description">{{ $data->created_at->diffForHumans() }}</span>
                                            </div>
                                            <!-- /.user-block -->
                                            @if ($data->foto)
                                                <a href="{{ url('image/' . $data->foto) }}" data-toggle="lightbox"
                                                    data-title="{{ $data->foto }}" data-gallery="gallery"
                                                    data-footer="<a href='{{ asset('image/' . $data->foto) }}' class='btn btn-warning' download><i class='fa fa-download'></i></a>">
                                                    <img src="{{ asset('image/' . $data->foto) }}" height="200"
                                                        class="d-block m-auto py-4" alt="">
                                                </a>
                                            @endif
                                            <h3>{{ $data->judul }}</h3>
                                            <p>
                                                {{ $data->deskripsi }}
                                            </p>

                                        </div>
                                    @endforeach
                                    <!-- /.post -->
                                </div>

                                <div class="tab-pane" id="gallery">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h4 class="card-title">Foto Galery</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        @foreach ($fotos as $image)
                                                            @if ($image->foto)
                                                                <div class="col-sm-3">
                                                                    <a href="{{ asset('image/' . $image->foto) }}"
                                                                        data-toggle="lightbox"
                                                                        data-title="{{ $image->foto }}"
                                                                        data-gallery="gallery">
                                                                        <img src="{{ asset('image/' . $image->foto) }}"
                                                                            class="img-fluid mb-2" alt="white sample" />
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="settings">
                                    <form action="{{ url('/') }}" method="POST" class="form-horizontal"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" value="{{ $users->name }}"
                                                    name="name" placeholder="Name">
                                                <input type="hidden" class="form-control" value="{{ $users->id }}"
                                                    name="id" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"
                                                    value="{{ $users->username }}" name="username"
                                                    placeholder="Username">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail"
                                                    name="email" value="{{ $users->email }}" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <span class="text-muted">Masukan Password Jika Ingin Di Ganti</span>
                                                <input type="password" class="form-control" name="password"
                                                    minlength="4" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Profile</label>
                                            <div class="col-sm-10">
                                                <div class="custom-file">
                                                    <input type="file" accept="image/*" class="" name="profile"
                                                        id="inpurProfile{{ $users->id }}">
                                                    {{-- <label class="custom-file-label" for="customFile">Choose file</label> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> I agree to the
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="friend">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if (session('success'))
                                                <div class="alert alert-success">
                                                    {{ Session('success') }}
                                                </div>
                                            @endif
                                        </div>
                                        @foreach ($friends as $friend)
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="row py-3">
                                                        <div class="col-auto">
                                                            @if ($friend->profil)
                                                                <img class="profile-user-img img-fluid img-circle m-1"
                                                                    src="{{ asset('image/' . $friend->profil) }}"
                                                                    alt="user image">
                                                            @else
                                                                <img class="profile-user-img img-fluid img-circle m-1"
                                                                    src="{{ asset('DefaultImage/profil.jpeg') }}"
                                                                    alt="user image">
                                                            @endif
                                                        </div>
                                                        <div class="col px-3">
                                                            <div>
                                                                <h4>{{ $friend->name }}</h4>
                                                                <p class="mb-0 text-muted">{{ $friend->pin }}</p>
                                                                <a href="{{ url('addfriend/' . $friend->idfriend) }}"
                                                                    class="btn btn-primary btn-sm mt-1">Konfirmasi</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
