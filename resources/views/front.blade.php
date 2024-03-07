<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Foto Galery</title>

  <!-- Google Font: Source Sans Pro -->
  {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- AdminLTE css -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- Ekko Lightbox -->
<link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">
</head>
<body>
<!-- Site wrapper -->
<div class="">
  <!-- Navbar -->
  @include('Components.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="container">
  @yield('content')
  </div>
  <!-- /.content-wrapper -->

  @include('Components.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Ekko Lightbox -->
<script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script>
  function clickSweet(){
    // e.preventDefault();
    var button = document.getElementById('swalDefaultSuccess');
    // setInterval(() => {
      button.click();
    // });
  }

  $(document).ready(function(){
    $('#inputImage').change(function(){
      // alert('hellooo')
      var input = this;
      var preview = $('#previewImage');
      // alert(preview)
      var reader = new FileReader();

      reader.onload = function(){
        preview.attr('src', reader.result);
      }

      if (input.files.length > 0) {
        reader.readAsDataURL(input.files[0]);
      }else{
        preview.attr('src','');
      }
    });
  });
  $('[id^="updateImage"]').change(function(){
      // alert('hellooo')
      var input = this;
      var itemId = input.id.replace('updateImage','')
      var preview = $('#previewUpdate' + itemId);
      // alert(preview)
      var reader = new FileReader();

      reader.onload = function(){
        preview.attr('src', reader.result);
      }

      if (input.files.length > 0) {
        reader.readAsDataURL(input.files[0]);
      }else{
        preview.attr('src','');
      }
  });
  $('[id^="inpurProfile"]').change(function(){
      // alert('hellooo')
      var input = this;
      var itemId = input.id.replace('inpurProfile','')
      var preview = $('#previewProfile' + itemId);
      // alert(preview)
      var reader = new FileReader();

      reader.onload = function(){
        preview.attr('src', reader.result);
      }

      if (input.files.length > 0) {
        reader.readAsDataURL(input.files[0]);
      }else{
        preview.attr('src','');
      }
  });
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });
  });
  $(function () {
  bsCustomFileInput.init();
  });
</script>
</body>
</html>
