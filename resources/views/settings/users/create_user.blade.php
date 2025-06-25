@extends('master')

@section('content')
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
                                        {{ __('app.settings.users.create-title') }}
                                    </h3>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ url('settings') }}">Settings</a></li>
                                            <li class="breadcrumb-item"><a
                                                    href="{{ url('users') }}">{{ __('app.settings.users.title') }}</a></li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">
                                                {{ __('app.settings.users.create-title') }}</li>
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
                                                    value="{{ old('name') }}" required>
                                                @if ($errors->has('name'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('name') }}</li>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label for="field1"
                                                    class="form-label">{{ __('app.settings.users.email') }}</label>
                                                <input type="email" class="form-control" id="field1" name="email"
                                                    value="{{ old('email') }}" required>
                                                @if ($errors->has('email'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('email') }}</li>
                                                    </div>
                                                @endif
                                            </div>


                                            <div class="col-12 col-md-4">
                                                <label for="field3"
                                                    class="form-label">{{ __('app.settings.users.role') }}</label>
                                                <select class="myDropdown form-control" name="role" required>
                                                    <option selected=""></option>
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
                                                <label for="field1"
                                                    class="form-label">{{ __('app.settings.users.password') }}</label>
                                                <input type="password" class="form-control " id="formGroupExampleInput3"
                                                    name="password" required>
                                                @if ($errors->has('password'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('password') }}
                                                        </li>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="field1"
                                                    class="form-label">{{ __('app.settings.users.confirm_password') }}</label>
                                                <input type="password" class="form-control " id="formGroupExampleInput3"
                                                    name="password_confirmation" required>
                                                @if ($errors->has('password_confirmation'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('password_confirmation') }}</li>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" id="TagsCreate"
                                                        value="active" name="status">
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
                        <a href=""><button type="button" class="btn clear-all-btn">Clear All</button></a>
                    </div>
                    <div>
                        <button type="submit" class="btn save-btn">Save</button>
                        <a href="{{ url('users') }}"><button type="button" class="btn cancel-btn">Cancel</button></a>
                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection
