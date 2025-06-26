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
                <div class="text-center mt-2">
                    <h5 class="custom-heading">{{ __('app.sessions.forgot-password.title') }}</h5>
                    @if (Session::has('fail'))
                        <div class="alert alert-danger mt-2">{{ Session::get('fail') }}</div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success mt-2">{{ Session::get('success') }}</div>
                    @endif
                </div>
                <div class="p-2 mt-4">
                    <form method="POST" action="">
                        @csrf
                        <div class="mb-3">
                            <label for="username"
                                class="form-label">{{ __('app.sessions.forgot-password.email') }}</label>
                            <input type="email" class="form-control" id="username" name="email">
                            @if ($errors->has('email'))
                                <div class="alert alert-danger mt-2">{{ $errors->first('email') }}</div>
                            @endif
                        </div>


                        <div class="mb-3">
                            <div class="">
                                <a href="{{ url('/') }}"
                                    class="text-muted">{{ __('app.sessions.forgot-password.back-to-login') }}</a>
                            </div>

                        </div>
                        <div class="mt-4">
                            <button class="mt-4 btn btn-primary" type="submit"
                                style="width: 100%;">{{ __('app.sessions.forgot-password.send-reset-password-email') }}</button>
                        </div>
                    </form>
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

    <!-- Password Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password-input');
            const passwordToggle = document.getElementById('password-addon');
            const toggleIcon = passwordToggle.querySelector('i');

            passwordToggle.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.className = 'ri-eye-off-fill align-middle';
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.className = 'ri-eye-fill align-middle';
                }
            });
        });
    </script>

    
</body>

</html>
