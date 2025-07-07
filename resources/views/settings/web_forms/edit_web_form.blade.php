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
                                        Edit Web form
                                    </h3>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ url('settings') }}">Settings</a></li>
                                            <li class="breadcrumb-item"><a href="{{ url('web-forms') }}">Web forms</a></li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">Edit
                                                Web form</li>
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

                                        <div class="d-md-flex d-block gap-1">
                                            <div class="nav nav-tabs gap-1 border-0" id="nav-tab" role="tablist">
                                                <button class="btn white-btn tab-button active" id="tab1-tab"
                                                    data-bs-toggle="tab" data-bs-target="#tab1" type="button"
                                                    role="tab" aria-controls="tab1" aria-selected="true">Edit</button>
                                                <button class="btn white-btn tab-button" id="tab2-tab" data-bs-toggle="tab"
                                                    data-bs-target="#tab2" type="button" role="tab"
                                                    aria-controls="tab2" aria-selected="false">Embed</button>
                                                <a class="btn white-btn tab-button" target="_blank"
                                                    href="http://127.0.0.1:8000/view-web-form/414f94db-b735-4bb7-bd6c-034eb307f83a">Preview</a>
                                            </div>
                                        </div>
                                        <div class="tab-content mt-4" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                                                aria-labelledby="tab1-tab">


                                                <div class="live-preview">


                                                    <div class="row">

                                                        <!--end col-->
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="firstNameinput" class="form-label">Title</label>
                                                                <input type="text" class="form-control" name="title"
                                                                    value="{{ $form->title }}" required>
                                                                @if ($errors->has('title'))
                                                                    <div class="alert alert-danger mt-2">
                                                                        {{ $errors->first('title') }}</li>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="firstNameinput" class="form-label">Submit Button
                                                                    Lable</label>
                                                                <input type="text" class="form-control"
                                                                    name="button_lable" value="{{ $form->button_lable }}"
                                                                    required>
                                                                @if ($errors->has('button_lable'))
                                                                    <div class="alert alert-danger mt-2">
                                                                        {{ $errors->first('button_lable') }}</li>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="firstNameinput" class="form-label">Submit
                                                                    Success Action</label>
                                                                <input type="text" class="form-control"
                                                                    name="success_action"
                                                                    value="{{ $form->success_action }}"
                                                                    placeholder="Enter message to display" required>
                                                                @if ($errors->has('description'))
                                                                    <div class="alert alert-danger mt-2">
                                                                        {{ $errors->first('description') }}</li>
                                                                    </div>
                                                                @endif
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="success_action_type" id="email-work-0"
                                                                        {{ $form->success_action_type == 'display_message' ? 'checked' : '' }}
                                                                        value="display_message">
                                                                    <label class="form-check-label"
                                                                        for="email-work-0">Display a custom message</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="success_action_type" id="email-home-0"
                                                                        {{ $form->success_action_type == 'redirect' ? 'checked' : '' }}
                                                                        value="redirect">
                                                                    <label class="form-check-label"
                                                                        for="email-home-0">Redirect to a URL</label>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="firstNameinput"
                                                                    class="form-label">Description</label>
                                                                <textarea class="form-control w-100" rows="5" name="description">{{ $form->description }}</textarea>
                                                                @if ($errors->has('description'))
                                                                    <div class="alert alert-danger mt-2">
                                                                        {{ $errors->first('description') }}</li>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>


                                                    </div>

                                                    <div class="row">

                                                        <!--end col-->
                                                        <div class="col-md-4 col-6">
                                                            <div class="mb-3">
                                                                <label for="firstNameinput" class="form-label">Background
                                                                    Color</label>
                                                                <div
                                                                    class="form-control color-input color-input-parent position-relative">
                                                                    <input type="text" class="hex-code form-control"
                                                                        style="width: 100px;"
                                                                        value="{{ $form->background_color }}">
                                                                    <input type="color"
                                                                        class="color-picker  color-input absolute-color"
                                                                        id="form-submit-button-color"
                                                                        value="{{ $form->background_color }}"
                                                                        name="submit_btn_color" required>
                                                                </div>
                                                                @if ($errors->has('background_color'))
                                                                    <div class="alert alert-danger mt-2">
                                                                        {{ $errors->first('background_color') }}</li>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-6">
                                                            <div class="mb-3">
                                                                <label for="firstNameinput" class="form-label">Form
                                                                    Background Color</label>
                                                                <div
                                                                    class="form-control color-input color-input-parent position-relative">
                                                                    <input type="text" class="hex-code form-control"
                                                                        style="width: 100px;"
                                                                        value="{{ $form->form_background_color }}">
                                                                    <input type="color"
                                                                        class="color-picker  color-input absolute-color"
                                                                        id="form-submit-button-color"
                                                                        name="form_background_color"
                                                                        value="{{ $form->form_background_color }}"
                                                                        required>
                                                                </div>
                                                                @if ($errors->has('form_background_color'))
                                                                    <div class="alert alert-danger mt-2">
                                                                        {{ $errors->first('form_background_color') }}</li>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-6">
                                                            <div class="mb-3">
                                                                <label for="firstNameinput" class="form-label">Form Title
                                                                    Color</label>
                                                                <div
                                                                    class="form-control color-input color-input-parent position-relative">
                                                                    <input type="text" class="hex-code form-control"
                                                                        style="width: 100px;"
                                                                        value="{{ $form->title_color }}">
                                                                    <input type="color"
                                                                        class="color-picker  color-input absolute-color"
                                                                        id="form-submit-button-color" name="title_color"
                                                                        value="{{ $form->title_color }}" required>
                                                                </div>
                                                                @if ($errors->has('title_color'))
                                                                    <div class="alert alert-danger mt-2">
                                                                        {{ $errors->first('title_color') }}</li>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-6">
                                                            <div class="mb-3">
                                                                <label for="firstNameinput" class="form-label">Form Submit
                                                                    Button Color</label>
                                                                <div
                                                                    class="form-control color-input color-input-parent position-relative">
                                                                    <input type="text" class="hex-code form-control"
                                                                        style="width: 100px;"
                                                                        value="{{ $form->submit_btn_color }}">
                                                                    <input type="color"
                                                                        class="color-picker  color-input absolute-color"
                                                                        id="form-submit-button-color"
                                                                        name="submit_btn_color"
                                                                        value="{{ $form->submit_btn_color }}" required>
                                                                </div>
                                                                @if ($errors->has('submit_btn_color'))
                                                                    <div class="alert alert-danger mt-2">
                                                                        {{ $errors->first('submit_btn_color') }}</li>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-6">
                                                            <div class="mb-3">
                                                                <label for="firstNameinput" class="form-label">Attribute
                                                                    Label Color</label>
                                                                <div
                                                                    class="form-control color-input color-input-parent position-relative">
                                                                    <input type="text" class="hex-code form-control"
                                                                        style="width: 100px;"
                                                                        value="{{ $form->lable_color }}">
                                                                    <input type="color"
                                                                        class="color-picker  color-input absolute-color"
                                                                        id="form-submit-button-color" name="lable_color"
                                                                        value="{{ $form->lable_color }}" required>
                                                                </div>
                                                                @if ($errors->has('lable_color'))
                                                                    <div class="alert alert-danger mt-2">
                                                                        {{ $errors->first('lable_color') }}</li>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>



                                                    <div class="form-check form-check-inline mt-2 mb-2">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="create_lead_enabled" id="create_lead_enabled"
                                                            {{ $form->create_lead_enabled == 'on' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="create_lead_enabled">Create
                                                            new lead with contact</label>
                                                    </div>

                                                    <div class="row">

                                                        <!--end col-->
                                                        <div class="col-md-6">
                                                            <h5 class="mt-2">Person Attributes</h5>
                                                            <div>
                                                                <div class="form-check form-check-inline mt-2">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="email-work-0" checked disabled>
                                                                    <label class="form-check-label"
                                                                        for="email-work-0">Name</label>
                                                                    <input class="form-check-input d-none" type="checkbox"
                                                                        name="person_attribute[]" checked value="name">
                                                                    <input type="hidden"
                                                                        name="person_attribute_checked[]" value="1">
                                                                    <input type="hidden" name="person_attribute_parent[]"
                                                                        value="person">
                                                                    <input type="hidden" name="person_attribute_type[]"
                                                                        value="system">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="firstNameinput"
                                                                            class="form-label">Field Lable</label>
                                                                        <input type="text" class="form-control"
                                                                            name="person_attribute_lable[]"
                                                                            value="Name">

                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="firstNameinput"
                                                                            class="form-label">Field Placeholder</label>
                                                                        <input type="text" class="form-control"
                                                                            name="person_attribute_placeholder[]"
                                                                            value="Name">
                                                                    </div>
                                                                </div>
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="person_name_required" checked disabled>
                                                                <label class="form-check-label"
                                                                    for="person_name_required">Required</label>
                                                                <input class="form-check-input d-none" type="checkbox"
                                                                    name="person_attribute_required[]" checked
                                                                    value="1">
                                                            </div>

                                                            <div>
                                                                <div class="form-check form-check-inline mt-4">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="person_email_enabled1" checked disabled>
                                                                    <label class="form-check-label"
                                                                        for="person_email_enabled1">Email</label>
                                                                    <input class="form-check-input d-none" type="checkbox"
                                                                        name="person_attribute[]" checked value="email">
                                                                    <input type="hidden"
                                                                        name="person_attribute_checked[]" value="1">
                                                                    <input type="hidden" name="person_attribute_parent[]"
                                                                        value="person">
                                                                    <input type="hidden" name="person_attribute_type[]"
                                                                        value="system">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="firstNameinput"
                                                                            class="form-label">Field Lable</label>
                                                                        <input type="text" class="form-control"
                                                                            name="person_attribute_lable[]"
                                                                            value="Email">

                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="firstNameinput"
                                                                            class="form-label">Field Placeholder</label>
                                                                        <input type="text" class="form-control"
                                                                            name="person_attribute_placeholder[]"
                                                                            value="Email">
                                                                    </div>
                                                                </div>
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="person_email_required"
                                                                    id="person_email_required" checked disabled>
                                                                <label class="form-check-label"
                                                                    for="person_email_required">Required</label>
                                                                <input class="form-check-input d-none" type="checkbox"
                                                                    name="person_attribute_required[]" checked
                                                                    value="1">
                                                            </div>


                                                            <div>
                                                                <div class="form-check form-check-inline mt-4">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="person_attribute[]"
                                                                        id="person_phone_enabled1" value="phone">
                                                                    <label class="form-check-label"
                                                                        for="person_phone_enabled1">Phone Number</label>
                                                                    <input type="hidden"
                                                                        name="person_attribute_checked[]" value="0">
                                                                    <input type="hidden" name="person_attribute_parent[]"
                                                                        value="person">
                                                                    <input type="hidden" name="person_attribute_type[]"
                                                                        value="system">
                                                                </div>
                                                                <div class="checkbox-inputs" style="display:none;">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Field Lable</label>
                                                                            <input type="text" class="form-control"
                                                                                name="person_attribute_lable[]"
                                                                                value="Phone">

                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Field
                                                                                Placeholder</label>
                                                                            <input type="text" class="form-control"
                                                                                name="person_attribute_placeholder[]"
                                                                                value="Phone">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="person_attribute_required[]"
                                                                        id="person_phone_required" value="1">
                                                                    <label class="form-check-label"
                                                                        for="person_phone_required">Required</label>
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <div class="form-check form-check-inline mt-4">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="person_attribute[]"
                                                                        id="person_organization_enabled1"
                                                                        value="organization">
                                                                    <label class="form-check-label"
                                                                        for="person_organization_enabled1">Organization</label>
                                                                    <input type="hidden"
                                                                        name="person_attribute_checked[]" value="0">
                                                                    <input type="hidden" name="person_attribute_parent[]"
                                                                        value="person">
                                                                    <input type="hidden" name="person_attribute_type[]"
                                                                        value="system">
                                                                </div>
                                                                <div class="checkbox-inputs" style="display:none;">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Field Lable</label>
                                                                            <input type="text" class="form-control"
                                                                                name="person_attribute_lable[]"
                                                                                value="Organization">

                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Field
                                                                                Placeholder</label>
                                                                            <input type="text" class="form-control"
                                                                                name="person_attribute_placeholder[]"
                                                                                value="Organization">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="person_attribute_required[]"
                                                                        id="person_organization_required" value="1">
                                                                    <label class="form-check-label"
                                                                        for="person_organization_required">Required</label>
                                                                </div>
                                                            </div>

                                                        </div>


                                                        <div class="col-md-6" id="lead-attributes-col"
                                                            style="display:none;">
                                                            <h5 class="mt-2">Lead Attributes</h5>
                                                            <div>
                                                                <div class="form-check form-check-inline mt-2">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="lead_title_enabled2" checked disabled>
                                                                    <label class="form-check-label"
                                                                        for="lead_title_enabled2">Title</label>
                                                                    <input class="form-check-input d-none" type="checkbox"
                                                                        name="lead_attribute[]" checked value="title">
                                                                    <input type="hidden" name="lead_attribute_checked[]"
                                                                        value="1">
                                                                    <input type="hidden" name="lead_attribute_parent[]"
                                                                        value="lead">
                                                                    <input type="hidden" name="lead_attribute_type[]"
                                                                        value="system">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="firstNameinput"
                                                                            class="form-label">Field Lable</label>
                                                                        <input type="text" class="form-control"
                                                                            name="lead_attribute_lable[]" value="Title">

                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="firstNameinput"
                                                                            class="form-label">Field Placeholder</label>
                                                                        <input type="text" class="form-control"
                                                                            name="lead_attribute_placeholder[]"
                                                                            value="Title">
                                                                    </div>
                                                                </div>
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="lead_title_required" checked disabled>
                                                                <label class="form-check-label"
                                                                    for="lead_title_required">Required</label>
                                                                <input class="form-check-input d-none" type="checkbox"
                                                                    name="lead_attribute_required[]" checked
                                                                    value="1">
                                                            </div>

                                                            <div>
                                                                <div class="form-check form-check-inline mt-4">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="lead_value_enabled2" checked disabled>
                                                                    <label class="form-check-label"
                                                                        for="lead_value_enabled2">Lead Value</label>
                                                                    <input class="form-check-input d-none" type="checkbox"
                                                                        name="lead_attribute[]" checked value="value">
                                                                    <input type="hidden" name="lead_attribute_checked[]"
                                                                        value="1">
                                                                    <input type="hidden" name="lead_attribute_parent[]"
                                                                        value="lead">
                                                                    <input type="hidden" name="lead_attribute_type[]"
                                                                        value="system">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="firstNameinput"
                                                                            class="form-label">Field Lable</label>
                                                                        <input type="text" class="form-control"
                                                                            name="lead_attribute_lable[]" value="Value">

                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label for="firstNameinput"
                                                                            class="form-label">Field Placeholder</label>
                                                                        <input type="text" class="form-control"
                                                                            name="lead_attribute_placeholder[]"
                                                                            value="Value">
                                                                    </div>
                                                                </div>
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="lead_value_required" checked disabled>
                                                                <label class="form-check-label"
                                                                    for="lead_value_required">Required</label>
                                                                <input class="form-check-input d-none" type="checkbox"
                                                                    name="lead_attribute_required[]" checked
                                                                    value="1">
                                                            </div>


                                                            <div>
                                                                <div class="form-check form-check-inline mt-4">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="lead_attribute[]"
                                                                        id="lead_description_enabled2"
                                                                        value="description">
                                                                    <label class="form-check-label"
                                                                        for="lead_description_enabled2">Description</label>
                                                                    <input type="hidden" name="lead_attribute_checked[]"
                                                                        value="0">
                                                                    <input type="hidden" name="lead_attribute_parent[]"
                                                                        value="lead">
                                                                    <input type="hidden" name="lead_attribute_type[]"
                                                                        value="system">
                                                                </div>
                                                                <div class="checkbox-inputs" style="display:none;">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Field Lable</label>
                                                                            <input type="text" class="form-control"
                                                                                name="lead_attribute_lable[]"
                                                                                value="Description">

                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Field
                                                                                Placeholder</label>
                                                                            <input type="text" class="form-control"
                                                                                name="lead_attribute_placeholder[]"
                                                                                value="Description">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="lead_attribute_required[]"
                                                                        id="lead_description_required" value="1">
                                                                    <label class="form-check-label"
                                                                        for="lead_description_required">Required</label>

                                                                </div>
                                                            </div>

                                                            <div>
                                                                <div class="form-check form-check-inline mt-4">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="lead_attribute[]" id="lead_source_enabled2"
                                                                        value="source">
                                                                    <label class="form-check-label"
                                                                        for="lead_source_enabled2">Source</label>
                                                                    <input type="hidden" name="lead_attribute_checked[]"
                                                                        value="0">
                                                                    <input type="hidden" name="lead_attribute_parent[]"
                                                                        value="lead">
                                                                    <input type="hidden" name="lead_attribute_type[]"
                                                                        value="system">
                                                                </div>
                                                                <div class="checkbox-inputs" style="display:none;">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Field Lable</label>
                                                                            <input type="text" class="form-control"
                                                                                name="lead_attribute_lable[]"
                                                                                value="Source">

                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Field
                                                                                Placeholder</label>
                                                                            <input type="text" class="form-control"
                                                                                name="lead_attribute_placeholder[]"
                                                                                value="Source">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="lead_source_required" checked disabled>
                                                                    <label class="form-check-label"
                                                                        for="lead_source_required">Required</label>
                                                                    <input class="form-check-input d-none" type="checkbox"
                                                                        name="lead_attribute_required[]" checked
                                                                        value="1">
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <div class="form-check form-check-inline mt-4">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="lead_attribute[]" id="lead_type_enabled2"
                                                                        value="type">
                                                                    <label class="form-check-label"
                                                                        for="lead_type_enabled2">Type</label>
                                                                    <input type="hidden" name="lead_attribute_checked[]"
                                                                        value="0">
                                                                    <input type="hidden" name="lead_attribute_parent[]"
                                                                        value="lead">
                                                                    <input type="hidden" name="lead_attribute_type[]"
                                                                        value="system">
                                                                </div>
                                                                <div class="checkbox-inputs" style="display:none;">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Field Lable</label>
                                                                            <input type="text" class="form-control"
                                                                                name="lead_attribute_lable[]"
                                                                                value="Type">

                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Field
                                                                                Placeholder</label>
                                                                            <input type="text" class="form-control"
                                                                                name="lead_attribute_placeholder[]"
                                                                                value="Type">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="lead_type_required" checked disabled>
                                                                    <label class="form-check-label"
                                                                        for="lead_type_required">Required</label>
                                                                    <input class="form-check-input d-none" type="checkbox"
                                                                        name="lead_attribute_required[]" checked
                                                                        value="1">
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <div class="form-check form-check-inline mt-4">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="lead_attribute[]" id="lead_owner_enabled2"
                                                                        value="owner">
                                                                    <label class="form-check-label"
                                                                        for="lead_owner_enabled2">Sales Owner</label>
                                                                    <input type="hidden" name="lead_attribute_checked[]"
                                                                        value="0">
                                                                    <input type="hidden" name="lead_attribute_parent[]"
                                                                        value="lead">
                                                                    <input type="hidden" name="lead_attribute_type[]"
                                                                        value="system">
                                                                </div>
                                                                <div class="checkbox-inputs" style="display:none;">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Field Lable</label>
                                                                            <input type="text" class="form-control"
                                                                                name="lead_attribute_lable[]"
                                                                                value="Sales Owner">

                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Field
                                                                                Placeholder</label>
                                                                            <input type="text" class="form-control"
                                                                                name="lead_attribute_placeholder[]"
                                                                                value="Sales Owner">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="lead_attribute_required[]"
                                                                        id="lead_owner_required" value="1">
                                                                    <label class="form-check-label"
                                                                        for="lead_owner_required">Required</label>
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <div class="form-check form-check-inline mt-4">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="lead_attribute[]" id="lead_closing_enabled2"
                                                                        value="closing">
                                                                    <label class="form-check-label"
                                                                        for="lead_closing_enabled2">Expected Close
                                                                        Date</label>
                                                                    <input type="hidden" name="lead_attribute_checked[]"
                                                                        value="0">
                                                                    <input type="hidden" name="lead_attribute_parent[]"
                                                                        value="lead">
                                                                    <input type="hidden" name="lead_attribute_type[]"
                                                                        value="system">
                                                                </div>
                                                                <div class="checkbox-inputs" style="display:none;">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Field Lable</label>
                                                                            <input type="text" class="form-control"
                                                                                name="lead_attribute_lable[]"
                                                                                value="Expected Close Date">

                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="firstNameinput"
                                                                                class="form-label">Field
                                                                                Placeholder</label>
                                                                            <input type="text" class="form-control"
                                                                                name="lead_attribute_placeholder[]"
                                                                                value="Expected Close Date">
                                                                        </div>
                                                                    </div>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="lead_attribute_required[]"
                                                                        id="lead_closing_required" value="1">
                                                                    <label class="form-check-label"
                                                                        for="lead_closing_required">Required</label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab2" role="tabpanel"
                                                aria-labelledby="tab2-tab">
                                                <div class="col-lg-12">
                                                    <label for="firstNameinput" class="form-label">Public URL</label>
                                                    <div class="input-group">
                                                        <input type="text" id="publicUrl" class="form-control"
                                                            value="{{ url('view-web-form/' . $form->uid) }}" readonly>
                                                        <button class="btn btn-primary" type="button"
                                                            onclick="copyToClipboard('publicUrl')">Copy</button>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <label for="firstNameinput" class="form-label">Code Fragment</label>
                                                    <div class="input-group">
                                                        <?php
                                                        $js_code = '<script src="' . url('embed/web-form/' . $form->uid) . '"></script>';
                                                        ?>
                                                        <input type="text" id="codeFragment" class="form-control"
                                                            value="{{ $js_code }}" readonly>
                                                        <button class="btn btn-primary" type="button"
                                                            onclick="copyToClipboard('codeFragment')">Copy</button>
                                                    </div>
                                                </div>

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
                            <a href="{{ url('web-forms') }}"><button type="button"
                                    class="btn cancel-btn">Cancel</button></a>
                        </div>

                    </div>
                </div>
            </div>
    </form>


    <script>
        $(document).ready(function() {
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ Session::get('success') }}",
                    confirmButtonColor: '#3085d6'
                });
            @endif

            @if (Session::has('fail'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{ Session::get('fail') }}",
                    confirmButtonColor: '#d33'
                });
            @endif


        });
    </script>
    <script>
        $(document).ready(function() {
            $('input[type="checkbox"][id$="_enabled1"]').change(function() {
                const isChecked = $(this).is(':checked');
                const target = $(this).closest('.form-check-inline').next('.checkbox-inputs');
                const hiddenCheckedInput = $(this).nextAll('input[name="person_attribute_checked[]"]')
                    .first();

                target.toggle(isChecked);

                // Set the value of the hidden 'attribute_checked[]' input
                if (isChecked) {
                    hiddenCheckedInput.val(1);
                } else {
                    hiddenCheckedInput.val(0);
                }
            });

            // Initialize the hidden input values on page load
            $('input[type="checkbox"][id$="_enabled1"]').each(function() {
                const isChecked = $(this).is(':checked');
                const hiddenCheckedInput = $(this).nextAll('input[name="person_attribute_checked[]"]')
                    .first();
                if (isChecked) {
                    hiddenCheckedInput.val(1);
                } else {
                    hiddenCheckedInput.val(0);
                }
            });


            $('input[type="checkbox"][id$="_enabled2"]').change(function() {
                const isChecked = $(this).is(':checked');
                const target = $(this).closest('.form-check-inline').next('.checkbox-inputs');
                const hiddenCheckedInput = $(this).nextAll('input[name="lead_attribute_checked[]"]')
                    .first();

                target.toggle(isChecked);

                // Set the value of the hidden 'attribute_checked[]' input
                if (isChecked) {
                    hiddenCheckedInput.val(1);
                } else {
                    hiddenCheckedInput.val(0);
                }
            });

            // Initialize the hidden input values on page load
            $('input[type="checkbox"][id$="_enabled2"]').each(function() {
                const isChecked = $(this).is(':checked');
                const hiddenCheckedInput = $(this).nextAll('input[name="lead_attribute_checked[]"]')
                    .first();
                if (isChecked) {
                    hiddenCheckedInput.val(1);
                } else {
                    hiddenCheckedInput.val(0);
                }
            });

            $('#create_lead_enabled').change(function() {
                const isChecked = $(this).is(':checked');
                const leadSection = $('#lead-attributes-col');

                leadSection.toggle(isChecked);

            });
        });
    </script>
    <script>
        function copyToClipboard(elementId) {
            const input = document.getElementById(elementId);
            input.select();
            input.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand("copy");

            // Optional: show a message
            // alert("Copied: " + input.value);
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const colorInputs = document.querySelectorAll(".color-input-parent");

            colorInputs.forEach(group => {
                const textInput = group.querySelector(".hex-code");
                const colorPicker = group.querySelector(".color-picker");

                // Color picker → Text input
                colorPicker.addEventListener("input", () => {
                    textInput.value = colorPicker.value.toUpperCase();
                });

                // Text input → Color picker
                textInput.addEventListener("input", () => {
                    let val = textInput.value.trim();
                    if (!val.startsWith("#")) val = "#" + val;

                    // Validate hex code before updating color picker
                    if (/^#[0-9A-Fa-f]{6}$/.test(val)) {
                        colorPicker.value = val;
                    }
                });
            });
        });
    </script>
@endsection
