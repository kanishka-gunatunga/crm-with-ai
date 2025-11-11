@extends('master')


<?php
    $permissions = session('user_permissions');
?>


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
                                        {{ __('app.settings.attributes.create-title') }}
                                    </h3>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ url('settings') }}">Settings</a></li>
                                            <li class="breadcrumb-item"><a href="{{ url('attributes') }}">
                                                    {{ __('app.settings.attributes.title') }}</a></li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">
                                                {{ __('app.settings.attributes.create-title') }}</li>
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
                                                    class="form-label">{{ __('app.settings.attributes.code') }}</label>
                                                <input type="text" class="form-control" id="field1" placeholder="Code"
                                                    name="code" value="{{ old('code') }}" required>
                                                @if ($errors->has('code'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('code') }}</li>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="field1"
                                                    class="form-label">{{ __('app.settings.attributes.name') }}</label>
                                                <input type="text" class="form-control" id="field1" placeholder="Name"
                                                    name="name" value="{{ old('name') }}" required>
                                                @if ($errors->has('name'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('name') }}</li>
                                                    </div>
                                                @endif
                                            </div>


                                            <div class="col-12 col-md-4">
                                                <label for="field3"
                                                    class="form-label">{{ __('app.settings.attributes.entity-type') }}</label>

                                                <select class="myDropdown form-control" name="entity_type" required>
                                                    <option value="">Select</option>
                                                    <option value="lead">Lead</option>
                                                    <option value="person">Person</option>
                                                    <option value="organization">Organization</option>
                                                    <option value="product">Product</option>
                                                    <option value="quote">Quote</option>
                                                </select>
                                                @if ($errors->has('entity_type'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('entity_type') }}</li>
                                                    </div>
                                                @endif
                                            </div>


                                        </div>
                                        <div class="row g-4 mt-1">

                                            <div class="col-12 col-md-4">
                                                <label for="field3"
                                                    class="form-label">{{ __('app.settings.attributes.type') }}</label>

                                                <select class="myDropdown form-control" name="type" id="type"
                                                    required>
                                                    <option value="">Select</option>
                                                    <option value="text">Text</option>
                                                    <option value="textarea">Textarea</option>
                                                    <option value="price">Price</option>
                                                    <option value="boolean">Boolean</option>
                                                    <option value="select">Select</option>
                                                    <option value="multiselect">Multiselect</option>
                                                    <option value="checkbox">Checkbox</option>
                                                    <option value="email">Email</option>
                                                    <option value="address">Address</option>
                                                    <option value="phone">Phone</option>
                                                    <option value="lookup">Lookup</option>
                                                    <option value="datetime">Datetime</option>
                                                    <option value="date">Date</option>
                                                    <option value="image">Image</option>
                                                    <option value="file">File</option>
                                                </select>
                                                @if ($errors->has('type'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('type') }}</li>
                                                    </div>
                                                @endif


                                                <div id="multi-options" class="mt-3" style="display:none;">
                                                    <div class="mb-3" id="option-types">
                                                        <label for="option_type"
                                                            class="form-label">{{ __('app.settings.attributes.options-type') }}</label>
                                                        <select class=" form-select" name="option_type" id="option_type">
                                                            <option value="lookups">Lookups</option>
                                                            <option value="options">Options</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3" id="lookups">
                                                        <label for="lookup_type"
                                                            class="form-label">{{ __('app.settings.attributes.lookup-type') }}</label>
                                                        <select class=" form-select" name="lookup_type" id="lookup_type">
                                                            <option value="">Select</option>
                                                            <option value="leads">Leads</option>
                                                            <option value="lead_sources">Lead Sources</option>
                                                            <option value="lead_types">Lead Types</option>
                                                            <option value="lead_pipelines">Lead Pipelines</option>
                                                            <option value="lead_pipeline_stages">Lead Pipeline Stages
                                                            </option>
                                                            <option value="users">Sales Owners</option>
                                                            <option value="organizations">Organizations</option>
                                                            <option value="persons">Persons</option>
                                                        </select>
                                                    </div>

                                                    <div class="mb-3" id="options-container" style="display:none;">
                                                        <label
                                                            class="form-label d-block">{{ __('app.settings.attributes.options') }}</label>
                                                        <button type="button" class="btn add-more-button mx-1 p-0"
                                                            id="add-option">
                                                            <svg width="26" height="26" viewBox="0 0 26 26"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M2.13574 12.8162C2.13574 6.91793 6.91695 2.13672 12.8152 2.13672C18.7135 2.13672 23.4947 6.91793 23.4947 12.8162C23.4947 18.7145 18.7135 23.4957 12.8152 23.4957C6.91695 23.4957 2.13574 18.7145 2.13574 12.8162ZM12.8152 4.27262C10.5493 4.27262 8.37623 5.17274 6.774 6.77498C5.17177 8.37721 4.27164 10.5503 4.27164 12.8162C4.27164 15.0821 5.17177 17.2552 6.774 18.8574C8.37623 20.4597 10.5493 21.3598 12.8152 21.3598C15.0811 21.3598 17.2542 20.4597 18.8565 18.8574C20.4587 17.2552 21.3588 15.0821 21.3588 12.8162C21.3588 10.5503 20.4587 8.37721 18.8565 6.77498C17.2542 5.17274 15.0811 4.27262 12.8152 4.27262Z"
                                                                    fill="#4A58EC" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M13.8834 7.47518C13.8834 7.19194 13.7708 6.9203 13.5706 6.72002C13.3703 6.51974 13.0986 6.40723 12.8154 6.40723C12.5322 6.40723 12.2605 6.51974 12.0603 6.72002C11.86 6.9203 11.7475 7.19194 11.7475 7.47518V11.747H7.47566C7.19243 11.747 6.92079 11.8595 6.72051 12.0598C6.52023 12.26 6.40771 12.5317 6.40771 12.8149C6.40771 13.0982 6.52023 13.3698 6.72051 13.5701C6.92079 13.7704 7.19243 13.8829 7.47566 13.8829H11.7475V18.1547C11.7475 18.4379 11.86 18.7095 12.0603 18.9098C12.2605 19.1101 12.5322 19.2226 12.8154 19.2226C13.0986 19.2226 13.3703 19.1101 13.5706 18.9098C13.7708 18.7095 13.8834 18.4379 13.8834 18.1547V13.8829H18.1552C18.4384 13.8829 18.71 13.7704 18.9103 13.5701C19.1106 13.3698 19.2231 13.0982 19.2231 12.8149C19.2231 12.5317 19.1106 12.26 18.9103 12.0598C18.71 11.8595 18.4384 11.747 18.1552 11.747H13.8834V7.47518Z"
                                                                    fill="#4A58EC" />
                                                            </svg>
                                                            <span
                                                                class="lg-button-text">{{ __('app.settings.attributes.add-option-btn-title') }}</span>
                                                        </button>
                                                        <div id="dynamic-options" class="mt-2"></div>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="col-12 col-md-4">
                                                <label for="field3"
                                                    class="form-label">{{ __('app.settings.attributes.is_required') }}</label>
                                                <select class="myDropdown form-control" name="is_required">
                                                    <option value="">Select</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                                @if ($errors->has('is_required'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('is_required') }}</li>
                                                    </div>
                                                @endif
                                            </div>


                                            <div class="col-12 col-md-4">
                                                <label for="field3"
                                                    class="form-label">{{ __('app.settings.attributes.is_unique') }}</label>

                                                <select class="myDropdown form-select" name="is_unique">
                                                    <option value="">Select</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                                @if ($errors->has('is_unique'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('is_unique') }}
                                                        </li>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-12 col-md-4" id="validation-col" style="display:none;">
                                                <label for="field3"
                                                    class="form-label">{{ __('app.settings.attributes.input_validation') }}</label>

                                                <select class=" form-select" name="input_validation">
                                                    <option value="">Select</option>
                                                    <option value="number">Number</option>
                                                    <option value="email">Email</option>
                                                    <option value="decimal">Decimal</option>
                                                    <option value="url">URL</option>
                                                </select>
                                                @if ($errors->has('input_validation'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('input_validation') }}</li>
                                                    </div>
                                                @endif
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
                        <a href=""><button type="button" class="btn clear-all-btn">Clear
                                All</button></a>
                    </div>
                    <div>
                        <button type="submit" class="btn save-btn">Save</button>
                        <a href="{{ url('attributes') }}"><button type="button"
                                class="btn cancel-btn">Cancel</button></a>
                    </div>

                </div>

            </div>
        </div>
    </form>
    <!-- Bottom Action Buttons -->

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

            $('#type').on('change', function() {
                const selectedType = $(this).val();

                if (selectedType === 'text') {
                    $('#validation-col').show();
                } else {
                    $('#validation-col').hide();
                }

                if (selectedType === 'lookup') {
                    $('#multi-options').show();
                    $('#option-types').hide();
                    $('#lookups').show();
                } else if (selectedType === 'select' || selectedType === 'multiselect' || selectedType ===
                    'checkbox') {
                    $('#multi-options').show();
                    $('#option-types').show();
                    $('#lookups').show();
                } else {
                    $('#multi-options').hide();
                    $('#option-types').hide();
                    $('#lookups').hide();
                }
            });
            $('#option_type').on('change', function() {
                const selectedType = $(this).val();

                if (selectedType === 'options') {
                    $('#lookups').hide();
                    $('#options-container').show();
                } else {
                    $('#lookups').show();
                    $('#options-container').hide();
                }


            });
        });
        $('#add-option').on('click', function() {
            let newRow = `
            <div class="row mb-2 align-items-center">
                <div class="col-md-10"><input type="text" class="form-control" name="options[]" required></div>
                <div class="col-md-2"><i class="fa-solid fa-trash delete-stage remove-append-item mx-2 remove-option"></i></div>
            </div>
        `;
            $('#dynamic-options').append(newRow);
        });

        $('#dynamic-options').on('click', '.remove-option', function() {
            $(this).closest('.row').remove();
        });
    </script>


@endsection
