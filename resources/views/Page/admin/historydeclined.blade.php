@extends('admin')

@section('admin')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Notifikasi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Notifikasi</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Folders</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <ul class="nav nav-pills flex-column">
              <li class="nav-item">
                <a href="{{ url('persetujuan') }}" class="nav-link">
                  <i class="fas fa-inbox"></i> Inbox
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('historydeclined') }}" class="nav-link active">
                  <i class="far fa-trash-alt"></i> Declined
                </a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card">
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Persetujuan</h3>

            <div class="card-tools">
              <div class="input-group input-group-sm">
                <input type="text" class="form-control" placeholder="Search Mail">
                <div class="input-group-append">
                  <div class="btn btn-primary">
                    <i class="fas fa-search"></i>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <form action="{{ url('persetujuan') }}" method="POST">
            @csrf
            <div class="card-body p-0">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                  <i class="far fa-square"></i>
                </button>
                <!-- /.btn-group -->
                <a href="{{ url('persetujuan') }}" type="button" class="btn btn-default btn-sm">
                  <i class="fas fa-sync-alt"></i>
                </a>
                <div class="float-right">
                  <div class="btn-group">
                    <button type="submit" name="status" value="acc" class="btn btn-success btn-sm">
                      Accept
                    </button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  @foreach ($galerys as $data)
                  <tr>
                    <td>
                      <div class="icheck-primary">
                        <input type="checkbox" value="{{ $data->id }}" name="id[]" id="check{{ $data->id }}">
                        <label for="check{{ $data->id }}"></label>
                      </div>
                    </td>
                    <td class="mailbox-subject">
                      <img src="{{ asset('image/'. $data->foto) }}" height="80" alt="">
                    </td>
                    <td class="mailbox-name"><a href="read-mail.html">{{ $data->username }}</a></td>
                    <td class="mailbox-attachment">{{ $data->judul }}</td>
                    <td class="mailbox-date">{{ $data->created_at->diffForHumans() }}</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                  <i class="far fa-square"></i>
                </button>
                <!-- /.btn-group -->
                <a href="{{ url('persetujuan') }}" type="button" class="btn btn-default btn-sm">
                  <i class="fas fa-sync-alt"></i>
                </a>
                <div class="float-right">
                  <div class="btn-group">
                    <button type="submit" name="status" value="acc" class="btn btn-success btn-sm">
                      Accept
                    </button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
              </div>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
@endsection