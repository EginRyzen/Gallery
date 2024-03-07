@extends('front')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Galery</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Galery</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
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
                                                    @if ($data->id_user == Auth::user()->id)
                                                        <a href="{{ url('profile') }}">{{ $data->username }}</a>
                                                    @else
                                                        <a
                                                            href="{{ url('profileUser/' . $data->id_user) }}">{{ $data->username }}</a>
                                                    @endif
                                                    <a href="#" class="float-right btn-tool nav-link"
                                                        data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                                        <a href="#" class="dropdown-item" data-toggle="modal"
                                                            data-target="#modal-update{{ $data->id }}">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                        <a href="{{ url('timeline/' . $data->id) }}" class="dropdown-item"
                                                            onclick="return confirm('Yakin Untuk Di Hapus??/')">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </a>
                                                    </div>
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
                                            <div class="btn-group dropup">
                                                <a href="#" class="text-dark mr-2" data-toggle="dropdown"><span>
                                                        <i class="fas fa-share mr-1"></i></span> Share</a>
                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                    <a href="" class="dropdown-item font-weight-bold text-sm"
                                                        onclick="return confirm('Anda Yakin Untuk Menghapus Pertemanan??/')">
                                                        <i class="fab fa-whatsapp"></i> Kirim WhatsApp
                                                    </a>
                                                </div>
                                            </div>
                                            <a href="{{ url('like/' . $data->id) }}" class="text-dark"><span>
                                                    <i class="far fa-thumbs-up mr-1"></i></span> Like</a>
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
                                        <div class="modal fade" id="modal-update{{ $data->id }}">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Modal</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ url('timeline/' . $data->id) }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <input type="text" required class="form-control"
                                                                    name="judul" value="{{ $data->judul }}"
                                                                    placeholder="Judul">
                                                            </div>
                                                            <div class="form-group">
                                                                <textarea name="deskripsi" required class="form-control" placeholder="Deskripsi" rows="5">{{ $data->deskripsi }}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="file" name="foto" accept="image/*"
                                                                    id="updateImage{{ $data->id }}">
                                                            </div>
                                                            <div class="form-group">
                                                                @if ($data->foto)
                                                                    <img src="{{ asset('image/' . $data->foto) }}"
                                                                        id="previewUpdate{{ $data->id }}"
                                                                        style="width: 100%; height:100%;max-width:150px;max-height:200px">
                                                                @else
                                                                    <img id="previewUpdate{{ $data->id }}"
                                                                        style="width: 100%; height:100%;max-width:150px;max-height:200px">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    @endforeach
                                    <!-- /.post -->
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
