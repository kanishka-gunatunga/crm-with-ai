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

<body style="background-color: #F6F6F8 !important; position: relative; height: 100vh;">

    <?php
    
    use App\Models\Configuration;
    
    $config = Configuration::first();
    ?>

    <main class="login-container">

        <!-- Display logo if available -->
        @if ($config && $config->logo)
            <div class="text-center mb-5">
                <!-- <img src="{{ asset('uploads/' . $config->logo) }}" alt="Logo" class="signuplogo" style="max-height: 60px;"> -->
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="signuplogo" style="max-height: 60px;">
            </div>
        @endif
        <div class="login-card card card-default">
            <h1 class="welcome-heading">
                {{ __('app.sessions.login.welcome') }}<br>
                <span class="brand-name">{{ $config->app_name ?? 'Infinity CRM' }}</span>
            </h1>

            <!-- Display session error messages -->
            @if (Session::has('fail'))
                <div class="alert alert-danger mt-2">{{ Session::get('fail') }}</div>
            @endif

            <form class="login-form" method="POST" action="">
                @csrf
                <div class="form-fields">
                    <!-- Email Field -->
                    <div class="mb-3">
                        <input type="email" class="input-field email-field @error('email') is-invalid @enderror"
                            placeholder="{{ __('app.sessions.login.email') }}" name="email" id="username"
                            value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <div class="alert alert-danger mt-2">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <!-- Password Field -->
                    <!-- <div class=" mb-3"> -->
                    <!-- <div class="position-relative  auth-pass-inputgroup"> -->
                    <div class="position-relative mb-3 auth-pass-inputgroup">
                        <input type="password"
                            class="password-input password-field password-input @error('password') is-invalid @enderror"
                            placeholder="{{ __('app.sessions.login.password') }}" name="password" id="password-input"
                            required>
                        <button
                            class="btn btn-link position-absolute text-decoration-none text-muted shadow-none password-addon"
                            type="button" id="password-addon">
                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.40007 6.20001C3.78864 8.7843 6.6715 10.56 10.0001 10.56C13.3286 10.56 16.2115 8.7843 17.6029 6.20001M3.92864 8.18573L0.714355 10.8786M7.73721 10.2857L6.19007 14.1829M16.0715 8.18573L19.2858 10.8786M12.2572 10.2857L13.8044 14.1829"
                                    stroke="#172635" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                        </button>
                    </div>

                    <!-- </div> -->
                    @if ($errors->has('password'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('password') }}</div>
                    @endif
                    <!-- </div> -->

                    <!-- Forgot Password Link -->
                    <div class="mb-3">
                        <a href="{{ url('forgot-password') }}"
                            class="forgot-link">{{ __('app.sessions.login.forgot-password') }}</a>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="login-btn w-100 btn btn-info">{{ __('app.sessions.login.login') }}</button>
                </div>

                <!-- Registration Link (if needed) -->
                <p class="register-text">
                    <span class="register-prompt">Don't have an account?</span>
                    <a href="#" class="register-link">Register</a>
                </p>
            </form>

            <footer class="copyright-text">
                <span>Copyright © {{ date('Y') }}
                    {{ $config->company_name ?? 'ClientIQ' }}</span><span>.</span><span> All Rights Reserved.</span>
            </footer>
        </div>
    </main>

    <!-- Decorative SVGs -->
    <div class="position-absolute top-0" style="right: -20px; z-index: -1;">
        <svg width="439" height="181" viewBox="0 0 439 181" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M182.979 -93.842C196.698 -108.343 216.782 -117.712 238.718 -117.712C267.225 -117.712 292.742 -101.209 306.173 -77.3385C317.751 -82.8397 330.894 -85.6246 344.612 -85.6246C396.771 -85.6246 438.997 -42.8224 438.997 9.91205C438.997 62.5779 396.702 105.366 344.324 105.366C338.041 105.366 331.744 104.584 325.681 103.432C313.896 124.874 291.384 139.155 265.305 139.155C254.303 139.155 244.151 136.371 235.151 132.296C223.079 160.515 195.065 180.243 162.415 180.243C128.406 180.243 99.323 158.883 88.3206 128.729C83.3956 129.799 78.4569 130.087 73.2438 130.087C32.9385 130.087 0 97.1489 0 55.993C0 28.5557 14.7887 4.68526 36.7248 -8.16911C32.0742 -18.5953 29.5774 -30.1738 29.5774 -41.9718C29.5774 -89.1365 68.017 -127 114.674 -127C142.688 -127 166.764 -114.132 182.691 -94.0615L182.979 -93.842Z"
                fill="#D5D8FB" />
        </svg>
    </div>

    <div class="position-absolute bottom-0 left-0">
        <svg width="352" height="168" viewBox="0 0 352 168" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M95.9792 33.158C109.698 18.6574 129.782 9.28752 151.718 9.28752C180.225 9.28752 205.742 25.791 219.173 49.6615C230.751 44.1603 243.894 41.3754 257.612 41.3754C309.771 41.3754 351.997 84.1776 351.997 136.912C351.997 189.578 309.702 232.366 257.324 232.366C251.041 232.366 244.744 231.584 238.681 230.432C226.896 251.874 204.384 266.155 178.305 266.155C167.303 266.155 157.151 263.371 148.151 259.296C136.079 287.515 108.065 307.243 75.415 307.243C41.4065 307.243 12.323 285.883 1.32063 255.729C-3.60436 256.799 -8.54308 257.087 -13.7562 257.087C-54.0615 257.087 -87 224.149 -87 182.993C-87 155.556 -72.2113 131.685 -50.2752 118.831C-54.9258 108.405 -57.4226 96.8262 -57.4226 85.0282C-57.4226 37.8635 -18.983 0 27.6741 0C55.6876 0 79.7638 12.8681 95.6912 32.9385L95.9792 33.158Z"
                fill="#D5D8FB" />
        </svg>
    </div>

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
