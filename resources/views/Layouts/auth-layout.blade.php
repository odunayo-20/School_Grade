<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Mecbill - @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="@yield('meta_keyword')" name="keywords">
    <meta content="@yield('meta_title')" name="title">
    <meta content="@yield('meta_description')" name="description">

  <link rel="stylesheet" href="{{asset('admin/assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/css/app.min.css')}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('admin/assets/css/components.css')}}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{asset('admin/assets/css/custom.css')}}">


  <link rel="stylesheet" href="{{ asset('admin/assets/bundles/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/assets/bundles/codemirror/lib/codemirror.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/assets/bundles/codemirror/theme/duotone-dark.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/assets/bundles/jquery-selectric/selectric.css')}}">


  <link rel="stylesheet" href="{{asset('admin/assets/bundles/datatables/datatables.min.css')}} ">
  <link rel="stylesheet" href="{{asset('admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}} ">

  <link rel="stylesheet" href="{{asset('admin/assets/bundles/izitoast/css/iziToast.min.css')}}">

  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />

  @livewireStyle
</head>


<body>

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

@include('admin.includes.navbar')
@include('admin.includes.sidebar')
@yield('content')
{{-- <footer class="main-footer">
    <div class="footer-left">
      <a href="templateshub.net">Templateshub</a></a>
    </div>
    <div class="footer-right">
    </div>
</footer> --}}
</div>
</div>
</body>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script src="{{asset('admin/assets/js/app.min.js')}}"></script>
<!-- JS Libraies -->
<script src="{{asset('admin/assets/js/page/chart-apexcharts.js')}}"></script>
<!-- Page Specific JS File -->
<script src="{{asset('admin/assets/js/page/index.js')}}"></script>
<!-- Template JS File -->
<script src="{{asset('admin/assets/js/scripts.js')}}"></script>
<!-- Custom JS File -->
<script src="{{asset('admin/assets/js/custom.js')}}"></script>

<script src="{{asset('admin/assets/bundles/datatables/datatables.min.js')}}"></script>
<script src="{{asset('admin/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Page Specific JS File -->
<script src="{{asset('admin/assets/js/page/datatables.js')}}"></script>
<script src="{{asset('admin/assets/bundles/summernote/summernote-bs4.js')}}"></script>
  <script src="{{asset('admin/assets/bundles/codemirror/lib/codemirror.js')}}"></script>
  <script src="{{asset('admin/assets/bundles/codemirror/mode/javascript/javascript.js')}}"></script>
  <script src="{{asset('admin/assets/bundles/jquery-selectric/jquery.selectric.min.js')}}"></script>
  <script src="{{asset('admin/assets/bundles/ckeditor/ckeditor.js')}}"></script>
  <!-- Page Specific JS File -->
  <script src="{{asset('admin/assets/js/page/ckeditor.js')}}"></script>
<!-- index.html  21 Nov 2019 03:47:04 GMT -->
<script src="{{asset('admin/assets/bundles/izitoast/js/iziToast.min.js')}}"></script>
<!-- Page Specific JS File -->
<script src="{{asset('admin/assets/js/page/toastr.js')}}"></script>

<script src="{{asset('admin/assets/bundles/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<!-- JS Libraies -->
<script src="{{asset('admin/assets/bundles/jquery-steps/jquery.steps.min.js')}}"></script>
<!-- Page Specific JS File -->
<script src="{{asset('admin/assets/js/page/form-wizard.js')}}"></script>
<script src="{{ asset('admin/assets/js/tabs.js') }}"></script>
<script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>

@livewireScript
@stack('script')


</html>
