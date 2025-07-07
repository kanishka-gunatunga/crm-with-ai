<?php 
use App\Models\Organization;
use App\Models\Source;
use App\Models\Type;
use App\Models\UserDetails;
use App\Models\Configuration;
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>{{ $config->app_name ?? 'Xeroit CRM' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap Css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login-page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body style="background-color: {{$form->background_color ?? '#F7F8F9'}} !important; position: relative;">

<?php

$config = Configuration::first();
$person_attributes = is_array($form->person_attributes) ? $form->person_attributes : json_decode($form->person_attributes, true);
$lead_attributes = is_array($form->lead_attributes) ? $form->lead_attributes : json_decode($form->lead_attributes, true);
$personNameField = collect($person_attributes)->firstWhere('name', 'name');
$personEmailField = collect($person_attributes)->firstWhere('name', 'email');
$personPhoneField = collect($person_attributes)->firstWhere('name', 'phone');
$personOrganizationField = collect($person_attributes)->firstWhere('name', 'organization');
?>

    <main class="login-container">
        @if($config && !$config->logo == null)
        <div class="text-center mb-5">
            <img src="{{ asset('uploads/'.$config->logo) }}" alt="Logo" class="signuplogo" style="max-height: 60px;">
        </div>
        @endif
        <div class="login-card card card-default" style="background:{{$form->form_background_color ?? '#ffffff'}}">
            <h1 class="welcome-heading mb-4">
                <span class="brand-name" style="color:{{$form->title_color ?? '#263238'}}">{{$form->title}}</span>
            </h1>

            <!-- Display session error messages -->
            @if(Session::has('fail'))
            <div class="alert alert-danger mt-2">{{ Session::get('fail') }}</div>
            @endif

            <form action="{{ url('/web-form-submit/' . $form->uid) }}" method="POST" data-parsley-validate>
            @csrf
                <div class="form-fields">

                    @if($personNameField)
                        <div class="mb-3">
                            <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}} !important">
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
                        <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}} !important">
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
                        <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}} !important">
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
                        <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}} !important">
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
                        <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}} !important">
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
                        <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}} !important">
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
                        <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}} !important">
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
                        <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}} !important">
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
                        <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}} !important">
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
                        <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}} !important">
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
                        <label for="username" class="form-label" style="color:{{$form->lable_color ?? '#546e7a'}} !important">
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
                </div>

                <div>
                    <button type="submit" class="login-btn w-100 btn btn-info" style="width: 100%;background:{{$form->submit_btn_color ?? '#0e90d9'}}">{{$form->button_lable ?? 'Submit'}}</button>
                </div>


            </form>

           
        </div>
    </main>



    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/dist/parsley.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/src/parsley.min.css">
</body>

</html>