@extends('master')

@section('content')
    <?php
    use App\Models\Role;
    use App\Models\Group;
    ?>
    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate>
        @csrf

        <div class="d-flex flex-column min-vh-100">
            <div class="flex-grow-1">
                <!-- Scrollable Content -->
                <div class="main-scrollable">
                    <div class="page-container">

                        <div class="page-title-container mb-0">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="page-title">
                                        {{ __('app.settings.users.edit-title') }}
                                    </h3>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ url('settings') }}">Settings</a></li>
                                            <li class="breadcrumb-item"><a
                                                    href="{{ url('users') }}">{{ __('app.settings.users.title') }}</a></li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">
                                                {{ __('app.settings.users.edit-title') }}</li>
                                        </ol>
                                    </nav>
                                </div>




                            </div>

                        </div>

                        <div class="col-12">
                            <div class="card-container">
                                <!-- Basic Details Card -->
                                <div class="card card-default mb-4">

                                    <div class="card-body">

                                        <div class="row g-4">
                                            <div class="col-12 col-md-4">
                                                <label for="field1"
                                                    class="form-label">{{ __('app.settings.users.name') }}</label>
                                                <input type="text" class="form-control" id="field1" name="name"
                                                    value="{{ $user_details->name }}" required>
                                                @if ($errors->has('name'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('name') }}</li>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label for="field1"
                                                    class="form-label">{{ __('app.settings.users.email') }}</label>
                                                <input type="email" class="form-control" id="field1" name="email"
                                                    value="{{ $user->email }}" required>
                                                @if ($errors->has('email'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('email') }}</li>
                                                    </div>
                                                @endif
                                            </div>


                                            <div class="col-12 col-md-4">
                                                <label for="field3"
                                                    class="form-label">{{ __('app.settings.users.role') }}</label>
                                                <select class="myDropdown form-control" name="role" required>
                                                    <option value="{{ $user->role }}" hidden selected="">
                                                        {{ Role::where('id', $user->role)->value('name') }}</option>
                                                    <?php foreach($roles as $role){ ?>
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    <?php } ?>
                                                </select>
                                                @if ($errors->has('role'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('role') }}</li>
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="field1"
                                                    class="form-label">{{ __('app.settings.users.groups') }}</label>
                                                <select class="myDropdown form-control" name="groups[]" required multiple>
                                                    <?php foreach($user_details->groups as $grp){ ?>
                                                    <option selected hidden value="{{ $grp }}">
                                                        {{ Group::where('id', $grp)->value('name') }}</option>
                                                    <?php }?>
                                                    <?php foreach($groups as $group){ ?>
                                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                                    <?php } ?>
                                                </select>
                                                @if ($errors->has('groups'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('groups') }}
                                                        </li>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="password-input"
                                                    class="form-label">{{ __('app.settings.users.password') }}</label>
                                                <div class="position-relative mb-3 auth-pass-inputgroup">
                                                    <input type="password"
                                                        class="form-control password-input password-field @error('password') is-invalid @enderror"
                                                        id="password-input" name="password" required>
                                                    <button
                                                        class="btn btn-link position-absolute text-decoration-none text-muted shadow-none password-addon"
                                                        type="button" id="password-addon" tabindex="-1"
                                                        style="top: 0.25rem; right: 0.5rem;">
                                                        <svg width="20" height="21" viewBox="0 0 20 21"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M2.40007 6.20001C3.78864 8.7843 6.6715 10.56 10.0001 10.56C13.3286 10.56 16.2115 8.7843 17.6029 6.20001M3.92864 8.18573L0.714355 10.8786M7.73721 10.2857L6.19007 14.1829M16.0715 8.18573L19.2858 10.8786M12.2572 10.2857L13.8044 14.1829"
                                                                stroke="#172635" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                @if ($errors->has('password'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('password') }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label for="password-confirmation-input"
                                                    class="form-label">{{ __('app.settings.users.confirm_password') }}</label>
                                                <div class="position-relative mb-3 auth-pass-inputgroup">
                                                    <input type="password"
                                                        class="form-control password-input password-field @error('password_confirmation') is-invalid @enderror"
                                                        id="password-confirmation-input" name="password_confirmation"
                                                        required>
                                                    <button
                                                        class="btn btn-link position-absolute text-decoration-none text-muted shadow-none password-addon"
                                                        type="button" id="password-confirmation-addon" tabindex="-1"
                                                        style="top: 0.25rem; right: 0.5rem;">
                                                        <svg width="20" height="21" viewBox="0 0 20 21"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M2.40007 6.20001C3.78864 8.7843 6.6715 10.56 10.0001 10.56C13.3286 10.56 16.2115 8.7843 17.6029 6.20001M3.92864 8.18573L0.714355 10.8786M7.73721 10.2857L6.19007 14.1829M16.0715 8.18573L19.2858 10.8786M12.2572 10.2857L13.8044 14.1829"
                                                                stroke="#172635" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                @if ($errors->has('password_confirmation'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('password_confirmation') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" id="TagsCreate"
                                                        value="active" name="status"
                                                        {{ $user->status == 'active' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="TagsCreate">
                                                        {{ __('app.settings.users.status') }}
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- <div class="col-12 col-md-4">
                                                                    <label for="date_start" class="form-label">Description</label>
                                                                    <input type="text" class="form-control" id="date_start" placeholder="Date Start">
                                                                </div> -->

                                        </div>

                                    </div>
                                </div>







                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 action-bar">
                <div class="d-flex gap-2 justify-content-between">
                    <div>
                        <a href=""><button type="button" class="btn clear-all-btn">Clear
                                All</button></a>
                    </div>
                    <div>
                        <button type="submit" class="btn save-btn">Save</button>
                        <a href="{{ url('users') }}"><button type="button" class="btn cancel-btn">Cancel</button></a>
                    </div>

                </div>

            </div>
        </div>

    </form>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password toggle visibility function
            function togglePasswordVisibility(inputId, addonId, iconId) {
                const passwordInput = document.getElementById(inputId);
                const passwordAddon = document.getElementById(addonId);
                const eyeIcon = document.getElementById(iconId);

                if (passwordInput && passwordAddon) {
                    passwordAddon.addEventListener('click', function() {
                        if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            eyeIcon.classList.remove('bi-eye-slash');
                            eyeIcon.classList.add('bi-eye');
                        } else {
                            passwordInput.type = 'password';
                            eyeIcon.classList.remove('bi-eye');
                            eyeIcon.classList.add('bi-eye-slash');
                        }
                    });
                }
            }

            // Apply the password visibility toggle for both fields
            togglePasswordVisibility('password-input', 'password-addon', 'eye-icon');
            togglePasswordVisibility('password-confirmation-input', 'password-confirmation-addon',
                'eye-icon-confirmation');
        });
    </script>
@endsection
