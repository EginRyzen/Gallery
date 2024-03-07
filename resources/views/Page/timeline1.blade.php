@extends('front')

@section('content')
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Timeline</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Timeline</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
  
          <!-- Timelime example  -->
          <div class="row">
            <div class="col-md-12">
              @if (session('alert'))
              <div class="alert alert-danger">
                {{ Session('alert') }}
              </div>
              @endif
              @if (session('success'))
              <div class="alert alert-success">
                {{ Session('success') }}
              </div>
              @endif
              <!-- The time line -->
              <div class="timeline">
                <!-- timeline item -->
                @foreach ($galery as $item)
                <div>
                <i class="fas fa-envelope bg-blue"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i>{{ $item->created_at->diffForHumans() }}</span>
                  {{-- <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3> --}}
                  <a href="{{ url('image/'. $item->foto) }}" data-toggle="lightbox" data-title="{{ $item->foto }}" data-gallery="gallery"
                    data-footer="<a href='{{ asset('image/'. $item->foto) }}' class='btn btn-warning' download><i class='fa fa-download'></i></a>"
                    >

                    <img src="{{ asset('image/'. $item->foto) }}" class="d-block m-auto py-5" height="500" alt="">
                  </a>
                  <div class="timeline-body">
                    <h3>{{ $item->judul }}</h3>
                    {{ $item->deskripsi }}
                  </div>
                  <div class="timeline-footer">
                    <a data-toggle="modal" data-target="#modal-update{{ $item->id }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="{{ url('timeline/'. $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Untuk Di Hapus??')">Delete</a>
                    <button type="button" class="btn btn-success swalDefaultSuccess" id="swalDefaultSuccess" style="display:none">
                      Launch Success Toast
                    </button>
                  </div>
                  <div class="modal fade" id="modal-update{{ $item->id }}">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Update Modal</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="{{ url('timeline/'.$item->id) }}" method="post" enctype="multipart/form-data">
                          @method('PUT')
                          @csrf
                          <div class="modal-body">
                            <div class="form-group">
                              <input type="text" required class="form-control" name="judul" value="{{ $item->judul }}" placeholder="Judul">
                            </div>
                            <div class="form-group">
                              <textarea name="deskripsi" required class="form-control" placeholder="Deskripsi" rows="5">{{ $item->deskripsi }}</textarea>
                            </div>
                            <div class="form-group">
                              <input type="file" name="foto" accept="image/*" id="updateImage{{ $item->id }}">
                            </div>
                            <div class="form-group">
                              @if ($item->foto)
                              <img src="{{ asset('image/'. $item->foto) }}" id="previewUpdate{{ $item->id }}" style="width: 100%; height:100%;max-width:150px;max-height:200px">
                              @else
                              <img id="previewUpdate{{ $item->id }}" style="width: 100%; height:100%;max-width:150px;max-height:200px">
                              @endif
                            </div>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                          </div>
                        </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                </div>
              </div>
                @endforeach
                <!-- END timeline item -->
                <!-- timeline time label -->
                <div>
                  <i class="fas fa-clock bg-gray"></i>
                </div>
              </div>
            </div>
            <!-- /.col -->
          </div>
        </div>
        <!-- /.timeline -->
  
      </section>
      <!-- /.content -->
@endsection