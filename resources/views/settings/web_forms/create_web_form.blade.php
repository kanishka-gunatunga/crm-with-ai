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
                                        Create Web form
                                    </h3>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#">Settings</a></li>
                                            <li class="breadcrumb-item"><a href="#">Web forms</a></li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">Create
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

                                        <div class="row g-4">
                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">Title</label>
                                                <input type="text" class="form-control" id="field1"
                                                    placeholder="Title" name="title" value="{{ old('title') }}" required>
                                                @if ($errors->has('title'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('title') }}</li>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">Submit Button Lable</label>
                                                <input type="text" class="form-control" id="field1"
                                                    placeholder="Submit Button Lable" name="button_lable"
                                                    value="{{ old('button_lable') }}" required>
                                                @if ($errors->has('button_lable'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('button_lable') }}</li>
                                                    </div>
                                                @endif
                                            </div>


                                            <div class="col-12 col-md-4">
                                                <label for="firstNameinput" class="form-label">Submit Success Action</label>
                                                <input type="text" class="form-control" name="success_action"
                                                    value="{{ old('success_action') }}"
                                                    placeholder="Enter message to display" required>
                                                @if ($errors->has('description'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('description') }}
                                                        </li>
                                                    </div>
                                                @endif
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="success_action_type" id="email-work-0" checked
                                                        value="display_message">
                                                    <label class="form-check-label" for="email-work-0">Display a custom
                                                        message</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="success_action_type" id="email-home-0" value="redirect">
                                                    <label class="form-check-label" for="email-home-0">Redirect to a
                                                        URL</label>
                                                </div>
                                            </div>
                                            <!-- <div class="col-12 col-md-4">
                                                        <label for="date_start" class="form-label">Description</label>
                                                        <input type="text" class="form-control" id="date_start" placeholder="Date Start">
                                                    </div> -->

                                        </div>

                                    </div>
                                </div>


                                <div class="card card-default mb-4">

                                    <div class="card-body">

                                        <div class="row g-4">

                                            <div class="col-12">
                                                <label for="field5" class="form-label">Description</label>
                                                <textarea class="form-control" placeholder="Description" id="field5" rows="5" name="description"
                                                    value="{{ old('description') }}"></textarea>

                                            </div>

                                        </div>

                                    </div>
                                </div>


                                <div class="card card-default mb-4">

                                    <div class="card-body">

                                        <div class="row g-4">
                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">Background Color</label>
                                                <div class="form-control color-input color-input-parent position-relative">
                                                    <input type="text" class="hex-code form-control"
                                                        style="width: 100px;" value="#F7F8F9">
                                                    <input type="color" class="color-picker color-input absolute-color"
                                                        id="background-color" value="#F7F8F9" name="background_color"
                                                        required>
                                                </div>
                                                <!-- <input type="color" class="form-control color-input" placeholder="Form Submit Button Color"> -->
                                            </div>



                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">Form Background Color</label>
                                                <div class="form-control color-input color-input-parent position-relative">
                                                    <input type="text" class="hex-code form-control"
                                                        style="width: 100px;" value="#ffffff">
                                                    <input type="color" class="color-picker color-input absolute-color"
                                                        id="form-background-color" value="#ffffff"
                                                        name="form_background_color" required>
                                                </div>
                                                <!-- <input type="color" class="form-control color-input" placeholder="Form Submit Button Color"> -->
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">Form Title Color</label>
                                                <div class="form-control color-input color-input-parent position-relative">
                                                    <input type="text" class="hex-code form-control"
                                                        style="width: 100px;" value="#263238">
                                                    <input type="color" class="color-picker color-input absolute-color"
                                                        id="form-title-color" value="#263238" name="title_color"
                                                        required>
                                                </div>
                                                <!-- <input type="color" class="form-control color-input" placeholder="Form Submit Button Color"> -->
                                            </div>


                                        </div>


                                        <div class="row g-4">
                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">Form Submit Button Color</label>
                                                <div class="form-control color-input color-input-parent position-relative">
                                                    <input type="text" class="hex-code form-control"
                                                        style="width: 100px;" value="#0E90D9">
                                                    <input type="color" class="color-picker color-input absolute-color"
                                                        id="form-submit-button-color" value="#0E90D9"
                                                        name="submit_btn_color" required>
                                                </div>
                                                <!-- <input type="color" class="form-control color-input" placeholder="Form Submit Button Color"> -->
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">Attribute Label Color</label>
                                                <div class="form-control color-input color-input-parent position-relative">
                                                    <input type="text" class="hex-code form-control"
                                                        style="width: 100px;" value="#546E7A">
                                                    <input type="color" class="color-picker color-input absolute-color"
                                                        id="attribute-label-color" value="#546E7A" name="lable_color"
                                                        required>
                                                </div>
                                                <!-- <input type="color" class="form-control color-input" placeholder="Form Submit Button Color"> -->
                                            </div>





                                        </div>

                                    </div>
                                </div>



                                <div class="card card-default mb-4">

                                    <div class="card-body">


                                        <div class="form-check form-check-inline mt-2 mb-2">
                                            <input class="form-check-input" type="checkbox" name="create_lead_enabled"
                                                id="create_lead_enabled">
                                            <label class="form-check-label" for="create_lead_enabled">Create new lead with
                                                contact</label>
                                        </div>


                                        <div class="row">

                                            <!--end col-->
                                            <div class="col-md-6">
                                                <h5 class="mt-2">Person Attributes</h5>
                                                <div>
                                                    <div class="form-check form-check-inline mt-2">
                                                        <input class="form-check-input" type="checkbox" id="email-work-0"
                                                            checked disabled>
                                                        <label class="form-check-label" for="email-work-0">Name</label>
                                                        <input class="form-check-input d-none" type="checkbox"
                                                            name="person_attribute[]" checked value="name">
                                                        <input type="hidden" name="person_attribute_checked[]"
                                                            value="1">
                                                        <input type="hidden" name="person_attribute_parent[]"
                                                            value="person">
                                                        <input type="hidden" name="person_attribute_type[]"
                                                            value="system">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="firstNameinput" class="form-label">Field
                                                                Lable</label>
                                                            <input type="text" class="form-control"
                                                                name="person_attribute_lable[]" value="Name">

                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="firstNameinput" class="form-label">Field
                                                                Placeholder</label>
                                                            <input type="text" class="form-control"
                                                                name="person_attribute_placeholder[]" value="Name">
                                                        </div>
                                                    </div>
                                                    <input class="form-check-input" type="checkbox"
                                                        id="person_name_required" checked disabled>
                                                    <label class="form-check-label"
                                                        for="person_name_required">Required</label>
                                                    <input class="form-check-input d-none" type="checkbox"
                                                        name="person_attribute_required[]" checked value="1">
                                                </div>

                                                <div>
                                                    <div class="form-check form-check-inline mt-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="person_email_enabled1" checked disabled>
                                                        <label class="form-check-label"
                                                            for="person_email_enabled1">Email</label>
                                                        <input class="form-check-input d-none" type="checkbox"
                                                            name="person_attribute[]" checked value="email">
                                                        <input type="hidden" name="person_attribute_checked[]"
                                                            value="1">
                                                        <input type="hidden" name="person_attribute_parent[]"
                                                            value="person">
                                                        <input type="hidden" name="person_attribute_type[]"
                                                            value="system">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="firstNameinput" class="form-label">Field
                                                                Lable</label>
                                                            <input type="text" class="form-control"
                                                                name="person_attribute_lable[]" value="Email">

                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="firstNameinput" class="form-label">Field
                                                                Placeholder</label>
                                                            <input type="text" class="form-control"
                                                                name="person_attribute_placeholder[]" value="Email">
                                                        </div>
                                                    </div>
                                                    <input class="form-check-input" type="checkbox"
                                                        name="person_email_required" id="person_email_required" checked
                                                        disabled>
                                                    <label class="form-check-label"
                                                        for="person_email_required">Required</label>
                                                    <input class="form-check-input d-none" type="checkbox"
                                                        name="person_attribute_required[]" checked value="1">
                                                </div>


                                                <div>
                                                    <div class="form-check form-check-inline mt-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="person_attribute[]" id="person_phone_enabled1"
                                                            value="phone">
                                                        <label class="form-check-label" for="person_phone_enabled1">Phone
                                                            Number</label>
                                                        <input type="hidden" name="person_attribute_checked[]"
                                                            value="0">
                                                        <input type="hidden" name="person_attribute_parent[]"
                                                            value="person">
                                                        <input type="hidden" name="person_attribute_type[]"
                                                            value="system">
                                                    </div>
                                                    <div class="checkbox-inputs" style="display:none;">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="firstNameinput" class="form-label">Field
                                                                    Lable</label>
                                                                <input type="text" class="form-control"
                                                                    name="person_attribute_lable[]" value="Phone">

                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="firstNameinput" class="form-label">Field
                                                                    Placeholder</label>
                                                                <input type="text" class="form-control"
                                                                    name="person_attribute_placeholder[]" value="Phone">
                                                            </div>
                                                        </div>
                                                        <input class="form-check-input" type="checkbox"
                                                            name="person_attribute_required[]" id="person_phone_required"
                                                            value="1">
                                                        <label class="form-check-label"
                                                            for="person_phone_required">Required</label>
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="form-check form-check-inline mt-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="person_attribute[]" id="person_organization_enabled1"
                                                            value="organization">
                                                        <label class="form-check-label"
                                                            for="person_organization_enabled1">Organization</label>
                                                        <input type="hidden" name="person_attribute_checked[]"
                                                            value="0">
                                                        <input type="hidden" name="person_attribute_parent[]"
                                                            value="person">
                                                        <input type="hidden" name="person_attribute_type[]"
                                                            value="system">
                                                    </div>
                                                    <div class="checkbox-inputs" style="display:none;">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="firstNameinput" class="form-label">Field
                                                                    Lable</label>
                                                                <input type="text" class="form-control"
                                                                    name="person_attribute_lable[]" value="Organization">

                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="firstNameinput" class="form-label">Field
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


                                            <div class="col-md-6" id="lead-attributes-col" style="display:none;">
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
                                                            <label for="firstNameinput" class="form-label">Field
                                                                Lable</label>
                                                            <input type="text" class="form-control"
                                                                name="lead_attribute_lable[]" value="Title">

                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="firstNameinput" class="form-label">Field
                                                                Placeholder</label>
                                                            <input type="text" class="form-control"
                                                                name="lead_attribute_placeholder[]" value="Title">
                                                        </div>
                                                    </div>
                                                    <input class="form-check-input" type="checkbox"
                                                        id="lead_title_required" checked disabled>
                                                    <label class="form-check-label"
                                                        for="lead_title_required">Required</label>
                                                    <input class="form-check-input d-none" type="checkbox"
                                                        name="lead_attribute_required[]" checked value="1">
                                                </div>

                                                <div>
                                                    <div class="form-check form-check-inline mt-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="lead_value_enabled2" checked disabled>
                                                        <label class="form-check-label" for="lead_value_enabled2">Lead
                                                            Value</label>
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
                                                            <label for="firstNameinput" class="form-label">Field
                                                                Lable</label>
                                                            <input type="text" class="form-control"
                                                                name="lead_attribute_lable[]" value="Value">

                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="firstNameinput" class="form-label">Field
                                                                Placeholder</label>
                                                            <input type="text" class="form-control"
                                                                name="lead_attribute_placeholder[]" value="Value">
                                                        </div>
                                                    </div>
                                                    <input class="form-check-input" type="checkbox"
                                                        id="lead_value_required" checked disabled>
                                                    <label class="form-check-label"
                                                        for="lead_value_required">Required</label>
                                                    <input class="form-check-input d-none" type="checkbox"
                                                        name="lead_attribute_required[]" checked value="1">
                                                </div>


                                                <div>
                                                    <div class="form-check form-check-inline mt-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="lead_attribute[]" id="lead_description_enabled2"
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
                                                                <label for="firstNameinput" class="form-label">Field
                                                                    Lable</label>
                                                                <input type="text" class="form-control"
                                                                    name="lead_attribute_lable[]" value="Description">

                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="firstNameinput" class="form-label">Field
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
                                                                <label for="firstNameinput" class="form-label">Field
                                                                    Lable</label>
                                                                <input type="text" class="form-control"
                                                                    name="lead_attribute_lable[]" value="Source">

                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="firstNameinput" class="form-label">Field
                                                                    Placeholder</label>
                                                                <input type="text" class="form-control"
                                                                    name="lead_attribute_placeholder[]" value="Source">
                                                            </div>
                                                        </div>
                                                        <input class="form-check-input" type="checkbox"
                                                            id="lead_source_required" checked disabled>
                                                        <label class="form-check-label"
                                                            for="lead_source_required">Required</label>
                                                        <input class="form-check-input d-none" type="checkbox"
                                                            name="lead_attribute_required[]" checked value="1">
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
                                                                <label for="firstNameinput" class="form-label">Field
                                                                    Lable</label>
                                                                <input type="text" class="form-control"
                                                                    name="lead_attribute_lable[]" value="Type">

                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="firstNameinput" class="form-label">Field
                                                                    Placeholder</label>
                                                                <input type="text" class="form-control"
                                                                    name="lead_attribute_placeholder[]" value="Type">
                                                            </div>
                                                        </div>
                                                        <input class="form-check-input" type="checkbox"
                                                            id="lead_type_required" checked disabled>
                                                        <label class="form-check-label"
                                                            for="lead_type_required">Required</label>
                                                        <input class="form-check-input d-none" type="checkbox"
                                                            name="lead_attribute_required[]" checked value="1">
                                                    </div>
                                                </div>

                                                <div>
                                                    <div class="form-check form-check-inline mt-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="lead_attribute[]" id="lead_owner_enabled2"
                                                            value="owner">
                                                        <label class="form-check-label" for="lead_owner_enabled2">Sales
                                                            Owner</label>
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
                                                                <label for="firstNameinput" class="form-label">Field
                                                                    Lable</label>
                                                                <input type="text" class="form-control"
                                                                    name="lead_attribute_lable[]" value="Sales Owner">

                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="firstNameinput" class="form-label">Field
                                                                    Placeholder</label>
                                                                <input type="text" class="form-control"
                                                                    name="lead_attribute_placeholder[]"
                                                                    value="Sales Owner">
                                                            </div>
                                                        </div>
                                                        <input class="form-check-input" type="checkbox"
                                                            name="lead_attribute_required[]" id="lead_owner_required"
                                                            value="1">
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
                                                            for="lead_closing_enabled2">Expected Close Date</label>
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
                                                                <label for="firstNameinput" class="form-label">Field
                                                                    Lable</label>
                                                                <input type="text" class="form-control"
                                                                    name="lead_attribute_lable[]"
                                                                    value="Expected Close Date">

                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="firstNameinput" class="form-label">Field
                                                                    Placeholder</label>
                                                                <input type="text" class="form-control"
                                                                    name="lead_attribute_placeholder[]"
                                                                    value="Expected Close Date">
                                                            </div>
                                                        </div>
                                                        <input class="form-check-input" type="checkbox"
                                                            name="lead_attribute_required[]" id="lead_closing_required"
                                                            value="1">
                                                        <label class="form-check-label"
                                                            for="lead_closing_required">Required</label>
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
