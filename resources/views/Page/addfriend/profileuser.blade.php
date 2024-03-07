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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                                        src="{{ asset('image/' . $users->profile) }}" alt="User profile picture">
                                @else
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('DefaultImage/profil.jpeg') }}" alt="User profile picture">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ $users->name }}</h3>

                            <p class="text-muted text-center">{{ $users->username }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <a href="javascript:;" class="text-dark"><b>Friends</b> <span class="float-right"><i
                                            class="fa fa-user"></i>
                                        {{ count($countfriends) }}</span></a>
                            </ul>

                            @if ($friend->id_addto == Auth::user()->id)
                                <a href="javscript:;" class="btn btn-primary btn-block"><b><i
                                            class="fas fa-user-check"></i></b></a>
                            @else
                                <form action="{{ url('addfriend') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-block"><i
                                            class="fas fa-user-plus"></i></button>
                                    <input type="hidden" name="id_addto" value="{{ $add->id }}">
                                </form>
                            @endif
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
                                        data-toggle="tab">Activity</a></li>
                                <li class="nav-item"><a class="nav-link" href="#gallery" data-toggle="tab">Gallery</a>
                                    {{-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                </li> --}}
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    @foreach ($galery as $data)
                                        <div class="post">
                                            <div class="user-block">
                                                @if ($data->profile)
                                                    <img class="img-circle img-bordered-sm"
                                                        src="{{ asset('image/' . $data->profile) }}" alt="user image">
                                                @else
                                                    <img class="img-circle img-bordered-sm"
                                                        src="{{ asset('DefaultImage/profil.jpeg') }}" alt="user image">
                                                @endif
                                                <span class="username">
                                                    <a href="#">{{ $data->username }}</a>
                                                </span>
                                                <span class="description">{{ $data->created_at->diffForHumans() }}</span>
                                            </div>
                                            <!-- /.user-block -->
                                            @if ($data->foto)
                                                <div class="row py-3">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4">
                                                        <a href="{{ url('image/' . $data->foto) }}" data-toggle="lightbox"
                                                            data-title="{{ $data->foto }}" data-gallery="gallery"
                                                            data-footer="<a href='{{ asset('image/' . $data->foto) }}' class='btn btn-warning' download><i class='fa fa-download'></i></a>">
                                                            <img src="{{ asset('image/' . $data->foto) }}"
                                                                class="img-fluid" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="col-md-4"></div>
                                                </div>
                                            @endif
                                            <h3>{{ $data->judul }}</h3>
                                            <p>
                                                {{ $data->deskripsi }}
                                            </p>
                                            <p>
                                                <a href="#" class="link-black text-sm mr-2"><i
                                                        class="fas fa-share mr-1"></i> Share</a>
                                                <a href="#" class="link-black text-sm text-primary"><i
                                                        class="far fa-thumbs-up mr-1"></i> Like</a>
                                                <span class="float-right">
                                                    <a href="#" class="link-black text-sm">
                                                        <i class="far fa-comments mr-1"></i> Comments (5)
                                                    </a>
                                                </span>
                                            </p>

                                            <form action="">
                                                <input class="form-control form-control-sm" type="text"
                                                    placeholder="Type a comment">
                                            </form>
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
                                                        @foreach ($galery as $image)
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
