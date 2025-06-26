<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>{{ $config->app_name ?? 'Xeroit CRM' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->


    <!-- Bootstrap Css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login-page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body style="background-color: #F6F6F8 !important; position: relative;">

    <?php
    
    use App\Models\Configuration;
    
    $config = Configuration::first();
    ?>

    <main class="login-container">

        <div class="card card-default">
            <div class="card-body p-4">
                <div class="auth-page-content">
                    <?php
                    use App\Models\Configuration;
                    $config = Configuration::first();
                    ?>
                    <img src="{{ asset('uploads/' . $config->logo) }}" alt="Sidebar Logo" class="signuplogo">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8 col-lg-6 col-xl-5">
                                <div class="card mt-4 custom-card">
                                    <div class="card-body p-4">
                                        <div class="text-center mt-2">
                                            <h5 class="custom-heading">{{ __('app.sessions.forgot-password.title') }}
                                            </h5>
                                            @if (Session::has('fail'))
                                                <div class="alert alert-danger mt-2">{{ Session::get('fail') }}</div>
                                            @endif
                                            @if (Session::has('success'))
                                                <div class="alert alert-success mt-2">{{ Session::get('success') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="p-2 mt-4">
                                            <form method="POST" action="">
                                                @csrf

                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="password-input">{{ __('app.sessions.reset-password.password') }}</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" class="form-control pe-5 password-input"
                                                            id="password-input" name="password">
                                                        <button
                                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted shadow-none password-addon"
                                                            type="button" id="password-addon"><i
                                                                class="ri-eye-fill align-middle"></i></button>
                                                        @if ($errors->has('password'))
                                                            <div class="alert alert-danger mt-2">
                                                                {{ $errors->first('password') }}</div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label"
                                                        for="password-input">{{ __('app.sessions.reset-password.confirm-password') }}</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" class="form-control pe-5 password-input"
                                                            id="password-input" name="password_confirmation">
                                                        <button
                                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted shadow-none password-addon"
                                                            type="button" id="password-addon"><i
                                                                class="ri-eye-fill align-middle"></i></button>
                                                        @if ($errors->has('password_confirmation'))
                                                            <div class="alert alert-danger mt-2">
                                                                {{ $errors->first('password_confirmation') }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <button class="mt-4 btn btn-primary" type="submit"
                                                        style="width: 100%;">{{ __('app.sessions.reset-password.reset-password') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end container -->
                </div>
            </div>
        </div>

    </main>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>

</body>

</html>
