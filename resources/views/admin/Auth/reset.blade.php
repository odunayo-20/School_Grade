<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin - Login</title>
    <!-- General CSS Files -->

    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/app.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/custom.css') }}">

    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">

                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">

                            <div class="card-header" style="text-align: center;">
                                <h4 style="text-align:center;">ADMIN RESET PASSWORD</h4>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif

                                <form action="{{ route('admin.resetPasswordChange') }}" method="POST">
                                    @csrf
                                    <input name='email' type="hidden" value="{{ $admin->email }}">
                                    <input  name='token' type="hidden" value="{{ $admin->token }}">
                                    <div class="form-group">
                                        <label for="password">PASSWORD</label>
                                        <input id="text" type="password" class="form-control" name="password">
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="confirm-password" class="control-label">Confirm Password</label>
                                        </div>
                                        <input id="confirm_password" type="password" class="form-control" name="confirm_password">
                                        @error('confirm_password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            <span wire:loading.remove wire:target='login'>SUBMIT</span>
                                            <span wire:loading wire:target='login'>Loading...</span>
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->



    <script src="{{ asset('admin/assets/js/app.min.js') }}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('admin/assets/js/page/chart-apexcharts.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('admin/assets/js/page/index.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('admin/assets/js/custom.js') }}"></script>
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

</html>
