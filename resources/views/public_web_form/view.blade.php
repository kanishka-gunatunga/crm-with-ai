<?php 
use App\Models\Organization;
use App\Models\Source;
use App\Models\Type;
use App\Models\UserDetails;
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>Enterprise HRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom Css-->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
</head>

<body style="background:{{$form->background_color ?? '#F7F8F9'}}">

    <div class="auth-page-wrapper pt-5" >
        <!-- Auth page content -->
        <div class="auth-page-content">
            <?php
            use App\Models\Configuration;
            $config = Configuration::first();
            $person_attributes = is_array($form->person_attributes) ? $form->person_attributes : json_decode($form->person_attributes, true);
            $lead_attributes = is_array($form->lead_attributes) ? $form->lead_attributes : json_decode($form->lead_attributes, true);
            $personNameField = collect($person_attributes)->firstWhere('name', 'name');
            $personEmailField = collect($person_attributes)->firstWhere('name', 'email');
            $personPhoneField = collect($person_attributes)->firstWhere('name', 'phone');
            $personOrganizationField = collect($person_attributes)->firstWhere('name', 'organization');
            ?>
            <img src="{{ asset('uploads/'.$config->logo) }}" alt="Sidebar Logo" class="signuplogo">
            <h2 class="text-center mt-4" style="color:{{$form->title_color ?? '#263238'}}">{{$form->title}}</h2>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4 custom-card"  style="background:{{$form->form_background_color ?? '#ffffff'}}">
                            <div class="card-body p-0">
                                <div class="text-center mt-2">

                                </div>
                                <div class="p-2 mt-4">
                                <form action="{{ url('/web-form-submit/' . $form->uid) }}" method="POST" data-parsley-validate>
                                @csrf
                                    @if($personNameField)
                                        <div class="mb-3">
                                            <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}}">
                                                {{ $personNameField['label'] ?? 'Name' }}
                                            </label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="username" 
                                                placeholder="{{ $personNameField['placeholder'] ?? '' }}" 
                                                name="person_name"
                                                {{ !empty($personNameField['required']) ? 'required' : '' }}
                                            >
                                           
                                        </div>
                                    @endif

                                    @if($personEmailField)
                                        <div class="mb-3">
                                            <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}}">
                                                {{ $personEmailField['label'] ?? '' }}
                                            </label>
                                            <input 
                                                type="email" 
                                                class="form-control" 
                                                id="username" 
                                                placeholder="{{ $personEmailField['placeholder'] ?? '' }}" 
                                                name="person_email"
                                                {{ !empty($personEmailField['required']) ? 'required' : '' }}
                                            >
                                           
                                        </div>
                                    @endif

                                    @if($personPhoneField)
                                        <div class="mb-3">
                                            <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}}">
                                                {{ $personPhoneField['label'] ?? '' }}
                                            </label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="username" 
                                                placeholder="{{ $personPhoneField['placeholder'] ?? '' }}" 
                                                name="person_phone"
                                                {{ !empty($personPhoneField['required']) ? 'required' : '' }}
                                            >
                                           
                                        </div>
                                    @endif

                                    @if($personOrganizationField)
                                    <?php
                                     $organizations = Organization::get();
                                     ?>
                                        <div class="mb-3">
                                            <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}}">
                                                {{ $personOrganizationField['label'] ?? '' }}
                                            </label>
                                            <select class="form-select" name="person_organization" aria-label="Default select example" {{ !empty($personOrganizationField['required']) ? 'required' : '' }}>
                                                <option selected disabled hidden>{{ $personOrganizationField['placeholder'] ?? '' }}</option>
                                                <?php foreach($organizations as $organization){ ?> 
                                                    <option value="{{$organization->id}}">{{$organization->name}}</option>
                                                    <?php } ?>
                                            </select>
                                           
                                        </div>
                                    @endif

                                    @if($form->create_lead_enabled == 'on')
                                    <?php
                                     $leadTitleField = collect($lead_attributes)->firstWhere('name', 'title');
                                     $leadValueField = collect($lead_attributes)->firstWhere('name', 'value');
                                     $leadDescriptionField = collect($lead_attributes)->firstWhere('name', 'description');
                                     $leadSourceField = collect($lead_attributes)->firstWhere('name', 'source');
                                     $leadTypeField = collect($lead_attributes)->firstWhere('name', 'type');
                                     $leadOwnerField = collect($lead_attributes)->firstWhere('name', 'owner');
                                     $leadClosingField = collect($lead_attributes)->firstWhere('name', 'closing');
                                     ?>

                                    @if($leadTitleField)
                                        <div class="mb-3">
                                            <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}}">
                                                {{ $leadTitleField['label'] ?? '' }}
                                            </label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="username" 
                                                placeholder="{{ $leadTitleField['placeholder'] ?? '' }}" 
                                                name="lead_title"
                                                {{ !empty($leadTitleField['required']) ? 'required' : '' }}
                                            >
                                           
                                        </div>
                                    @endif
                                    @if($leadValueField)
                                        <div class="mb-3">
                                            <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}}">
                                                {{ $leadValueField['label'] ?? '' }}
                                            </label>
                                            <input 
                                                type="number" step="any" 
                                                class="form-control" 
                                                id="username" 
                                                placeholder="{{ $leadValueField['placeholder'] ?? '' }}" 
                                                name="lead_value"
                                                {{ !empty($leadValueField['required']) ? 'required' : '' }}
                                            >
                                           
                                        </div>
                                    @endif
                                    @if($leadDescriptionField)
                                        <div class="mb-3">
                                            <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}}">
                                                {{ $leadDescriptionField['label'] ?? '' }}
                                            </label>
                                            <textarea style="height:unset;" class="form-control" id="exampleFormControlTextarea1"  name="lead_description" rows="3" placeholder="{{ $leadDescriptionField['placeholder'] ?? '' }}" {{ !empty($leadDescriptionField['required']) ? 'required' : '' }}></textarea>
                                           
                                           
                                        </div>
                                    @endif
                                    @if($leadSourceField)
                                    <?php
                                     $sources = Source::get();
                                     ?>
                                        <div class="mb-3">
                                            <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}}">
                                                {{ $leadSourceField['label'] ?? '' }}
                                            </label>
                                            <select class="form-select" name="lead_source" aria-label="Default select example" {{ !empty($leadSourceField['required']) ? 'required' : '' }}>
                                                <option selected disabled hidden>{{ $leadSourceField['placeholder'] ?? '' }}</option>
                                                <?php foreach($sources as $source){ ?> 
                                                <option value="{{$source->id}}">{{$source->name}}</option>
                                                <?php } ?>
                                            </select>
                                           
                                        </div>
                                    @endif
                                    @if($leadTypeField)
                                    <?php
                                     $types = Type::get();
                                     ?>
                                        <div class="mb-3">
                                            <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}}">
                                                {{ $leadTypeField['label'] ?? '' }}
                                            </label>
                                            <select class="form-select" name="lead_type" aria-label="Default select example" {{ !empty($leadTypeField['required']) ? 'required' : '' }}>
                                                <option selected disabled hidden>{{ $leadTypeField['placeholder'] ?? '' }}</option>
                                                <?php foreach($types as $type){ ?> 
                                                <option value="{{$type->id}}">{{$type->name}}</option>
                                                <?php } ?>
                                            </select>
                                           
                                        </div>
                                    @endif
                                    @if($leadOwnerField)
                                    <?php
                                     $owners = UserDetails::get();
                                     ?>
                                        <div class="mb-3">
                                            <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}}">
                                                {{ $leadOwnerField['label'] ?? '' }}
                                            </label>
                                            <select class="form-select" name="lead_owner" aria-label="Default select example" {{ !empty($leadOwnerField['required']) ? 'required' : '' }}>
                                                <option selected disabled hidden>{{ $leadOwnerField['placeholder'] ?? '' }}</option>
                                                <?php foreach($owners as $owner){ ?> 
                                                <option value="{{$owner->user_id}}">{{$owner->name}}</option>
                                                <?php } ?>
                                            </select>
                                           
                                        </div>
                                    @endif
                                    @if($leadClosingField)
                                        <div class="mb-3">
                                            <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}}">
                                                {{ $leadClosingField['label'] ?? '' }}
                                            </label>
                                            <input 
                                                type="date" 
                                                class="form-control" 
                                                id="username" 
                                                placeholder="{{ $leadClosingField['placeholder'] ?? '' }}" 
                                                name="lead_closing_date"
                                                {{ !empty($leadClosingField['required']) ? 'required' : '' }}
                                            >
                                           
                                        </div>
                                    @endif
                                    @endif
                                        <div class="mt-4">
                                            <button class="mt-4 btn btn-info" type="submit" style="width: 100%;background:{{$form->submit_btn_color ?? '#0e90d9'}}">{{$form->button_lable ?? 'Submit'}}</button>
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
        <!-- end auth page content -->
    </div>
    <!-- end auth-page-wrapper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <!-- Password-addon init -->
    <script src="{{ asset('assets/js/pages/password-addon.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/dist/parsley.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/src/parsley.min.css">
</body>

</html>
