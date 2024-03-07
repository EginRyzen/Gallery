@extends('admin')

@section('admin')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data User</li>
          </ol>
        </div>
        <div class="col-md-12 mt-3">
            @if (session('success'))
              <div class="alert alert-success">
                {{ Session('success') }}
              </div>
              @endif
            @if (session('alert'))
              <div class="alert alert-danger">
                {{ Session('alert') }}
              </div>
              @endif
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Table User</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Profile</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($data as $user)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-size-50 mr-3 img-circle" alt="User Image">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                               @if ($user->status == 1)
                               <a href="{{ url('status/'. $user->id) }}" class="btn btn-success btn-xs">Active</a>
                                @else
                                <a href="{{ url('status/'. $user->id) }}" class="btn btn-danger btn-xs">Deactive</a>
                               @endif
                            </td>
                            <td>
                                <a href="{{ url('admin/'. $user->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Unutk Di Hapus??')"><i class="fa fa-trash"></i></a>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
@endsection