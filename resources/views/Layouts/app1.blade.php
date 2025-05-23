<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Mecbill - @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="@yield('meta_keyword')" name="keywords">
    <meta content="@yield('meta_title')" name="title">
    <meta content="@yield('meta_description')" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('frontend/assets/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet">
    {{-- <link href="{{asset('frontend/assets/css/bootstrap.min.css')}}" rel="stylesheet"> --}}
</head>

<body>
@include('frontend.includes.navbar')
@yield('content')
@include('frontend.includes.footer')
     <!-- JavaScript Libraries -->
     <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
     <script src=" {{asset('frontend/assets/lib/easing/easing.min.js')}} "></script>
     <script src=" {{asset('frontend/assets/lib/owlcarousel/owl.carousel.min.js')}} "></script>

     <!-- Contact Javascript File -->
     <script src="{{asset('frontend/assets/mail/jqBootstrapValidation.min.js')}}"></script>
     <script src="{{asset('frontend/assets/mail/contact.js')}}"></script>

     <!-- Template Javascript -->
     <script src="{{asset('frontend/assets/js/main.js')}}"></script>
     {{-- <script src="{{asset('frontend/assets/js/bootstrap.bundle.min.js')}}"></script> --}}
</body>
</html>
