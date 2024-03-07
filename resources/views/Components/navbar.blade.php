<nav class="main-header navbar navbar-expand navbar-white navbar-light ml-0">
    {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button> --}}
    <!-- Left navbar links -->
    {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> --}}
    <ul class="navbar-nav">
        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li> --}}
        <li class="nav-item  d-sm-inline-block">
            <a href="{{ url('timeline') }}" class="nav-link">Home</a>
        </li>
        <li class="nav-item  d-sm-inline-block">
            <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-upload">Upload <i
                    class="fa fa-upload"></i></a>
        </li>
        <li class="nav-item  d-sm-inline-block">
            <a href="{{ url('addfriend') }}" class="nav-link"><i class="fas fa-user-plus"></i></a>
        </li>
    </ul>
    {{-- </div> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
                {{-- <span class="badge badge-danger navbar-badge">3</span> --}}
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="{{ url('profile') }}" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        @if (Auth::user()->profile)
                            <img src="{{ asset('image/' . Auth::user()->profile) }}" alt="User Avatar"
                                class="img-size-50 mr-3 img-circle">
                        @else
                            <img src="{{ asset('DefaultImage/profil.jpeg') }}" alt="User Avatar"
                                class="img-size-50 mr-3 img-circle">
                        @endif
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                {{ Auth::user()->username }}
                                <span class="float-right text-sm text-danger"><i class="fas fa-edit"></i></span>
                            </h3>
                            <p class="text-sm">{{ Auth::user()->name }}</p>
                            {{-- <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p> --}}
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ url('logout') }}" class="dropdown-item dropdown-footer"><i
                        class="fa fa-sign-out-alt"></i></a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>

<div class="modal fade" id="modal-upload">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('timeline') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" required class="form-control" name="judul" placeholder="Judul">
                    </div>
                    <div class="form-group">
                        <textarea name="deskripsi" required class="form-control" placeholder="Deskripsi" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="foto" accept="image/*" id="inputImage">
                    </div>
                    <div class="form-group">
                        <img id="previewImage" style="width: 100%; height:100%;max-width:150px;max-height:200px">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    {{-- <button type="button" class="btn btn-primary" onclick="clickSweet()">Save changes</button> --}}
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
