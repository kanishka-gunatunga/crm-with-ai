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
                                        {{ __('app.contacts.organizations.edit-title') }}
                                    </h3>

                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a
                                                    href="{{ url('organizations') }}">{{ __('app.contacts.organizations.title') }}</a>
                                            </li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">
                                                {{ __('app.contacts.organizations.edit-title') }}</li>
                                        </ol>
                                    </nav>

                                </div>




                            </div>

                        </div>

                        <div class="col-12">
                            <div class="card-container">
                                <!-- <div class="card card-default mb-4">
                                                                <div class="card-body">
                                                                    <div class="row g-4">
                                                                        <div class="col-12 col-md-4">
                                                                            <label for="field1" class="form-label">Terms and Conditions</label>
                                                                            <input type="text" class="form-control" id="field1" placeholder="Change your T&C from here">
                                                                        </div>
                                                                        <div class="col-12 col-md-4">
                                                                            <label for="field2" class="form-label">Quote Logo</label>
                                                                            <input type="file" class="form-control" id="field2" placeholder="Pipeline">
                                                                        </div>

                                                                        <div class="col-12 col-md-4">
                                                                            <img src="../images/d6af22486fc0ee1005bfcdbe7e596b125bc8e316.png" width="222px" height="118px" alt="" style="object-fit: cover;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> -->


                                <div class="card card-default">
                                    <div class="card-body">

                                        <div class="row g-4">
                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="field1" placeholder="Name"
                                                    name="name" value="{{ $organization->name }}" required>
                                            </div>


                                            <div class="col-12 col-md-4">

                                                <label for="field4" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="field4"
                                                    placeholder="Address" name="address"
                                                    value="{{ $organization->address }}">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="field3" class="form-label">Country</label>
                                                <select class="myDropdown form-control" name="country">
                                                    <option value="{{ $organization->country }}" selected="" hidden>
                                                        {{ $organization->country }}</option>
                                                    {{-- <option value="Sri Lanka">Sri Lanka</option> --}}
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="field3" class="form-label">State</label>
                                                <input type="text" class="form-control" name="city" placeholder="City"
                                                    name="state" value="{{ $organization->state }}">
                                            </div>

                                            <div class="col-12 col-md-4">

                                                <label for="field4" class="form-label">City</label>
                                                <input type="text" class="form-control" id="field4" placeholder="City"
                                                    name="city" value="{{ $organization->city }}">
                                            </div>

                                            <div class="col-12 col-md-4">

                                                <label for="field4" class="form-label">Postal Code</label>
                                                <input type="text" class="form-control" id="field4"
                                                    placeholder="Postal Code" name="post_code"
                                                    value="{{ $organization->post_code }}">
                                            </div>
                                            {{-- <div class="col-12 col-md-6">
                                                <div class="d-flex align-items-center">
                                                    <label for="field4" class="form-label">Emails</label>
                                                    <div class="ms-3 mb-2">
                                                        <button class="btn add-more-button p-0 mx-1" id="add-emails"
                                                            onclick="addEmailField()" type="button">
                                                            <svg width="14" height="14" viewBox="0 0 14 14"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M1.1665 6.99984C1.1665 3.77809 3.77809 1.1665 6.99984 1.1665C10.2216 1.1665 12.8332 3.77809 12.8332 6.99984C12.8332 10.2216 10.2216 12.8332 6.99984 12.8332C3.77809 12.8332 1.1665 10.2216 1.1665 6.99984ZM6.99984 2.33317C5.76216 2.33317 4.57518 2.82484 3.70001 3.70001C2.82484 4.57518 2.33317 5.76216 2.33317 6.99984C2.33317 8.23751 2.82484 9.4245 3.70001 10.2997C4.57518 11.1748 5.76216 11.6665 6.99984 11.6665C8.23751 11.6665 9.4245 11.1748 10.2997 10.2997C11.1748 9.4245 11.6665 8.23751 11.6665 6.99984C11.6665 5.76216 11.1748 4.57518 10.2997 3.70001C9.4245 2.82484 8.23751 2.33317 6.99984 2.33317Z"
                                                                    fill="#4A58EC" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M7.58333 4.08333C7.58333 3.92862 7.52187 3.78025 7.41248 3.67085C7.30308 3.56146 7.15471 3.5 7 3.5C6.84529 3.5 6.69692 3.56146 6.58752 3.67085C6.47812 3.78025 6.41667 3.92862 6.41667 4.08333V6.41667H4.08333C3.92862 6.41667 3.78025 6.47812 3.67085 6.58752C3.56146 6.69692 3.5 6.84529 3.5 7C3.5 7.15471 3.56146 7.30308 3.67085 7.41248C3.78025 7.52187 3.92862 7.58333 4.08333 7.58333H6.41667V9.91667C6.41667 10.0714 6.47812 10.2197 6.58752 10.3291C6.69692 10.4385 6.84529 10.5 7 10.5C7.15471 10.5 7.30308 10.4385 7.41248 10.3291C7.52187 10.2197 7.58333 10.0714 7.58333 9.91667V7.58333H9.91667C10.0714 7.58333 10.2197 7.52187 10.3291 7.41248C10.4385 7.30308 10.5 7.15471 10.5 7C10.5 6.84529 10.4385 6.69692 10.3291 6.58752C10.2197 6.47812 10.0714 6.41667 9.91667 6.41667H7.58333V4.08333Z"
                                                                    fill="#4A58EC" />
                                                            </svg>

                                                            <span class="">{{ __('app.common.add_more') }}</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div id="email-fields"> --}}
                                            {{-- @if (!empty($organization->emails) && count($organization->emails) > 0) --}}
                                            @foreach ($organization->emails as $key => $email)
                                                <div class="col-12 col-md-4 email-fields-container">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <label class="form-label">Emails</label>
                                                        <button class="btn add-more-button mx-1 mb-1 p-0" id="add-emails"
                                                            onclick="addEmailField()" type="button">
                                                            <svg width="14" height="14" viewBox="0 0 14 14"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M1.1665 6.99984C1.1665 3.77809 3.77809 1.1665 6.99984 1.1665C10.2216 1.1665 12.8332 3.77809 12.8332 6.99984C12.8332 10.2216 10.2216 12.8332 6.99984 12.8332C3.77809 12.8332 1.1665 10.2216 1.1665 6.99984ZM6.99984 2.33317C5.76216 2.33317 4.57518 2.82484 3.70001 3.70001C2.82484 4.57518 2.33317 5.76216 2.33317 6.99984C2.33317 8.23751 2.82484 9.4245 3.70001 10.2997C4.57518 11.1748 5.76216 11.6665 6.99984 11.6665C8.23751 11.6665 9.4245 11.1748 10.2997 10.2997C11.1748 9.4245 11.6665 8.23751 11.6665 6.99984C11.6665 5.76216 11.1748 4.57518 10.2997 3.70001C9.4245 2.82484 8.23751 2.33317 6.99984 2.33317Z"
                                                                    fill="#4A58EC" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M7.58333 4.08333C7.58333 3.92862 7.52187 3.78025 7.41248 3.67085C7.30308 3.56146 7.15471 3.5 7 3.5C6.84529 3.5 6.69692 3.56146 6.58752 3.67085C6.47812 3.78025 6.41667 3.92862 6.41667 4.08333V6.41667H4.08333C3.92862 6.41667 3.78025 6.47812 3.67085 6.58752C3.56146 6.69692 3.5 6.84529 3.5 7C3.5 7.15471 3.56146 7.30308 3.67085 7.41248C3.78025 7.52187 3.92862 7.58333 4.08333 7.58333H6.41667V9.91667C6.41667 10.0714 6.47812 10.2197 6.58752 10.3291C6.69692 10.4385 6.84529 10.5 7 10.5C7.15471 10.5 7.30308 10.4385 7.41248 10.3291C7.52187 10.2197 7.58333 10.0714 7.58333 9.91667V7.58333H9.91667C10.0714 7.58333 10.2197 7.52187 10.3291 7.41248C10.4385 7.30308 10.5 7.15471 10.5 7C10.5 6.84529 10.4385 6.69692 10.3291 6.58752C10.2197 6.47812 10.0714 6.41667 9.91667 6.41667H7.58333V4.08333Z"
                                                                    fill="#4A58EC" />
                                                            </svg>
                                                            <span class="">{{ __('app.common.add_more') }}</span>
                                                        </button>
                                                    </div>


                                                    <div class="d-flex align-items-center">
                                                        <input type="email" class="form-control" name="emails[]"
                                                            value="{{ $email['value'] }}" required>
                                                        <i class="fa-solid fa-trash delete-stage remove-append-item mx-2"
                                                            onclick="removeField(this)"></i>
                                                    </div>
                                                    <div class="d-flex align-items-center mt-2">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="email_types[{{ $key }}]"
                                                                id="email-work-{{ $key }}" value="work"
                                                                {{ $email['label'] == 'work' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="email-work-{{ $key }}">{{ __('app.common.work') }}</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="email_types[{{ $key }}]"
                                                                id="email-home-{{ $key }}" value="home"
                                                                {{ $email['label'] == 'home' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="email-home-{{ $key }}">{{ __('app.common.home') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            {{-- @endif --}}
                                        </div>

                                        {{-- </div> --}}




                                        <!-- <div class="col-12 col-md-4">
                                                                                        <div>
                                                                                            <label for="field4" class="form-label">Emails</label>
                                                                                            <input type="text" class="form-control" id="field4" placeholder="Emails">
                                                                                        </div>

                                                                                        <div class="d-flex align-items-center mt-2">
                                                                                            <div class="form-check form-check-inline">
                                                                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                                                                <label class="form-check-label" for="inlineRadio1">Work</label>
                                                                                            </div>
                                                                                            <div class="form-check form-check-inline">
                                                                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                                                                <label class="form-check-label" for="inlineRadio2">Organizational</label>
                                                                                            </div>
                                                                                            <div class="ms-3">
                                                                                                <button class="btn add-more-button p-0">
                                                                                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.1665 6.99984C1.1665 3.77809 3.77809 1.1665 6.99984 1.1665C10.2216 1.1665 12.8332 3.77809 12.8332 6.99984C12.8332 10.2216 10.2216 12.8332 6.99984 12.8332C3.77809 12.8332 1.1665 10.2216 1.1665 6.99984ZM6.99984 2.33317C5.76216 2.33317 4.57518 2.82484 3.70001 3.70001C2.82484 4.57518 2.33317 5.76216 2.33317 6.99984C2.33317 8.23751 2.82484 9.4245 3.70001 10.2997C4.57518 11.1748 5.76216 11.6665 6.99984 11.6665C8.23751 11.6665 9.4245 11.1748 10.2997 10.2997C11.1748 9.4245 11.6665 8.23751 11.6665 6.99984C11.6665 5.76216 11.1748 4.57518 10.2997 3.70001C9.4245 2.82484 8.23751 2.33317 6.99984 2.33317Z" fill="#4A58EC" />
                                                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.58333 4.08333C7.58333 3.92862 7.52187 3.78025 7.41248 3.67085C7.30308 3.56146 7.15471 3.5 7 3.5C6.84529 3.5 6.69692 3.56146 6.58752 3.67085C6.47812 3.78025 6.41667 3.92862 6.41667 4.08333V6.41667H4.08333C3.92862 6.41667 3.78025 6.47812 3.67085 6.58752C3.56146 6.69692 3.5 6.84529 3.5 7C3.5 7.15471 3.56146 7.30308 3.67085 7.41248C3.78025 7.52187 3.92862 7.58333 4.08333 7.58333H6.41667V9.91667C6.41667 10.0714 6.47812 10.2197 6.58752 10.3291C6.69692 10.4385 6.84529 10.5 7 10.5C7.15471 10.5 7.30308 10.4385 7.41248 10.3291C7.52187 10.2197 7.58333 10.0714 7.58333 9.91667V7.58333H9.91667C10.0714 7.58333 10.2197 7.52187 10.3291 7.41248C10.4385 7.30308 10.5 7.15471 10.5 7C10.5 6.84529 10.4385 6.69692 10.3291 6.58752C10.2197 6.47812 10.0714 6.41667 9.91667 6.41667H7.58333V4.08333Z" fill="#4A58EC" />
                                                                                                    </svg>

                                                                                                    <span class="">Add More</span>
                                                                                                </button>
                                                                                            </div>


                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="col-12 col-md-4 mt-0">
                                                                                        <div>
                                                                                            <label for="field4" class="form-label">Contact Numbers</label>
                                                                                            <input type="text" class="form-control" id="field4" placeholder="Contact Numbers">
                                                                                        </div>

                                                                                        <div class="d-flex align-items-center mt-2">
                                                                                            <div class="form-check form-check-inline">
                                                                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                                                                <label class="form-check-label" for="inlineRadio1">Work</label>
                                                                                            </div>
                                                                                            <div class="form-check form-check-inline">
                                                                                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                                                                <label class="form-check-label" for="inlineRadio2">Organizational</label>
                                                                                            </div>
                                                                                            <div class="ms-3">
                                                                                                <button class="btn add-more-button p-0">
                                                                                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.1665 6.99984C1.1665 3.77809 3.77809 1.1665 6.99984 1.1665C10.2216 1.1665 12.8332 3.77809 12.8332 6.99984C12.8332 10.2216 10.2216 12.8332 6.99984 12.8332C3.77809 12.8332 1.1665 10.2216 1.1665 6.99984ZM6.99984 2.33317C5.76216 2.33317 4.57518 2.82484 3.70001 3.70001C2.82484 4.57518 2.33317 5.76216 2.33317 6.99984C2.33317 8.23751 2.82484 9.4245 3.70001 10.2997C4.57518 11.1748 5.76216 11.6665 6.99984 11.6665C8.23751 11.6665 9.4245 11.1748 10.2997 10.2997C11.1748 9.4245 11.6665 8.23751 11.6665 6.99984C11.6665 5.76216 11.1748 4.57518 10.2997 3.70001C9.4245 2.82484 8.23751 2.33317 6.99984 2.33317Z" fill="#4A58EC" />
                                                                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.58333 4.08333C7.58333 3.92862 7.52187 3.78025 7.41248 3.67085C7.30308 3.56146 7.15471 3.5 7 3.5C6.84529 3.5 6.69692 3.56146 6.58752 3.67085C6.47812 3.78025 6.41667 3.92862 6.41667 4.08333V6.41667H4.08333C3.92862 6.41667 3.78025 6.47812 3.67085 6.58752C3.56146 6.69692 3.5 6.84529 3.5 7C3.5 7.15471 3.56146 7.30308 3.67085 7.41248C3.78025 7.52187 3.92862 7.58333 4.08333 7.58333H6.41667V9.91667C6.41667 10.0714 6.47812 10.2197 6.58752 10.3291C6.69692 10.4385 6.84529 10.5 7 10.5C7.15471 10.5 7.30308 10.4385 7.41248 10.3291C7.52187 10.2197 7.58333 10.0714 7.58333 9.91667V7.58333H9.91667C10.0714 7.58333 10.2197 7.52187 10.3291 7.41248C10.4385 7.30308 10.5 7.15471 10.5 7C10.5 6.84529 10.4385 6.69692 10.3291 6.58752C10.2197 6.47812 10.0714 6.41667 9.91667 6.41667H7.58333V4.08333Z" fill="#4A58EC" />
                                                                                                    </svg>

                                                                                                    <span class="">Add More</span>
                                                                                                </button>
                                                                                            </div>


                                                                                        </div>

                                                                                    </div> -->
                                        <!-- <div class="col-12 col-md-4">
                                                                                <label for="field5" class="form-label">Reminders</label>
                                                                                <input type="text" class="form-control" id="field5" placeholder="Reminders">
                                                                            </div> -->

                                    </div>

                                </div>

                            </div>
                            
                            @if ($organizationAttributes->isNotEmpty())
                            <div class="card card-default mt-3">
                                <div class="card-body">
                                    @foreach ($organizationAttributes as $attribute)
                                        <div class="mb-3">
                                            <label>{{ $attribute->name }}</label>

                                            @php
                                                $value = $customAttributes[$attribute->code] ?? '';
                                                $options = $attribute->options
                                                    ? json_decode($attribute->options, true)
                                                    : [];
                                            @endphp

                                            @if ($attribute->type == 'text')
                                                <input type="text" name="{{ $attribute->code }}" class="form-control"
                                                    value="{{ $value }}"
                                                    {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                            @elseif ($attribute->type == 'email')
                                                <input type="email" name="{{ $attribute->code }}" class="form-control"
                                                    value="{{ $value }}"
                                                    {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                            @elseif ($attribute->type == 'textarea')
                                                <textarea name="{{ $attribute->code }}" class="form-control"
                                                    {{ $attribute->is_required == 'yes' ? 'required' : '' }}>{{ $value }}</textarea>
                                            @elseif ($attribute->type == 'number' || $attribute->type == 'price')
                                                <input type="number" step="0.01" name="{{ $attribute->code }}"
                                                    class="form-control" value="{{ $value }}"
                                                    {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                            @elseif ($attribute->type == 'boolean')
                                                <select name="{{ $attribute->code }}" class="form-select"
                                                    {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                    <option value="1" {{ $value == '1' ? 'selected' : '' }}>Yes
                                                    </option>
                                                    <option value="0" {{ $value == '0' ? 'selected' : '' }}>No
                                                    </option>
                                                </select>
                                            @elseif ($attribute->type == 'select')
                                                <select name="{{ $attribute->code }}" class="form-select"
                                                    {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                    <option value="">Select</option>
                                                    @foreach ($options as $opt)
                                                        <option value="{{ $opt }}"
                                                            {{ $value == $opt ? 'selected' : '' }}>{{ $opt }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @elseif ($attribute->type == 'multiselect')
                                                <select name="{{ $attribute->code }}[]" multiple class="form-select"
                                                    {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                    @foreach ($options as $opt)
                                                        <option value="{{ $opt }}"
                                                            @if (is_array($value) && in_array($opt, $value)) selected @endif>
                                                            {{ $opt }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @elseif ($attribute->type == 'checkbox')
                                                @foreach ($options as $opt)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="{{ $attribute->code }}[]" value="{{ $opt }}"
                                                            @if (is_array($value) && in_array($opt, $value)) checked @endif>
                                                        <label class="form-check-label">{{ $opt }}</label>
                                                    </div>
                                                @endforeach
                                            @elseif ($attribute->type == 'date')
                                                <input type="date" name="{{ $attribute->code }}" class="form-control"
                                                    value="{{ $value }}"
                                                    {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                            @elseif ($attribute->type == 'datetime')
                                                <input type="datetime-local" name="{{ $attribute->code }}"
                                                    class="form-control" value="{{ $value }}"
                                                    {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                            @elseif ($attribute->type == 'file')
                                                <input type="file" name="{{ $attribute->code }}" class="form-control"
                                                    {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                @if ($value)
                                                    <p class="mt-2">Current file: <a
                                                            href="{{ asset('uploads/' . $value) }}"
                                                            target="_blank">{{ $value }}</a></p>
                                                @endif
                                            @elseif ($attribute->type == 'image')
                                                <input type="file" accept="image/*" name="{{ $attribute->code }}"
                                                    class="form-control"
                                                    {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                @if ($value)
                                                    <div class="mt-2">
                                                        <img src="{{ asset('uploads/' . $value) }}" alt="Uploaded Image"
                                                            width="100">
                                                    </div>
                                                @endif
                                            @elseif ($attribute->type == 'phone')
                                                <input type="tel" name="{{ $attribute->code }}" class="form-control"
                                                    value="{{ $value }}"
                                                    {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                            @else
                                                <input type="text" name="{{ $attribute->code }}" class="form-control"
                                                    value="{{ $value }}">
                                            @endif

                                            @error($attribute->code)
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            @endif

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
                    <a href="{{ url('organizations') }}"><button type="button"
                            class="btn cancel-btn">Cancel</button></a>
                </div>

            </div>

        </div>
        </div>
    </form>
    <!-- Bottom Action Buttons -->


    {{-- <script>
        let emailCounter = 1;

        function addEmailField() {
            const emailFieldsContainer = document.getElementById('email-fields');
            const emailField = document.createElement('div');
            emailField.classList.add('email-field');
            emailField.innerHTML = `
            <div class="d-flex align-items-center mt-2">
                <input type="email" class="form-control" id="field4" placeholder="Emails" name="emails[]" required>
                 <i class="fa-solid fa-trash delete-stage remove-append-item mx-2" onclick="removeEmailField(this)"></i>
                 
            </div>
            <div class="d-flex align-items-center mt-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="email_types[${emailCounter}]" id="email-work-${emailCounter}" checked value="work">
                    <label class="form-check-label" for="email-work-${emailCounter}">{{ __('app.common.work') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="email_types[${emailCounter}]" id="email-home-${emailCounter}" value="home">
                    <label class="form-check-label" for="email-home-${emailCounter}">{{ __('app.common.home') }}</label>
                </div>
            </div>
            
        `;
            emailFieldsContainer.appendChild(emailField);
            emailCounter++;
        }


        function removeEmailField(element) {
            const emailField = element.closest('.email-field');
            emailField.remove();
        }
    </script> --}}
    <script>
        let emailCounter = 1;
        let numberCounter = 1;

        function addEmailField() {
            console.log('Adding email field');

            const emailContainer = document.querySelector('.email-fields-container');

            const col = document.createElement('div');
            col.className = 'col-12 col-md-4';

            col.innerHTML = `
            <div class="d-flex align-items-center">
                <label for="field4" class="form-label">Emails</label>
                <div class="ms-3 mb-2">
                    <button class="btn add-more-button mx-1 p-0" id="add-emails"
                        onclick="addEmailField()" type="button">
                        <svg width="14" height="14" viewBox="0 0 14 14"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M1.1665 6.99984C1.1665 3.77809 3.77809 1.1665 6.99984 1.1665C10.2216 1.1665 12.8332 3.77809 12.8332 6.99984C12.8332 10.2216 10.2216 12.8332 6.99984 12.8332C3.77809 12.8332 1.1665 10.2216 1.1665 6.99984ZM6.99984 2.33317C5.76216 2.33317 4.57518 2.82484 3.70001 3.70001C2.82484 4.57518 2.33317 5.76216 2.33317 6.99984C2.33317 8.23751 2.82484 9.4245 3.70001 10.2997C4.57518 11.1748 5.76216 11.6665 6.99984 11.6665C8.23751 11.6665 9.4245 11.1748 10.2997 10.2997C11.1748 9.4245 11.6665 8.23751 11.6665 6.99984C11.6665 5.76216 11.1748 4.57518 10.2997 3.70001C9.4245 2.82484 8.23751 2.33317 6.99984 2.33317Z"
                                fill="#4A58EC" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.58333 4.08333C7.58333 3.92862 7.52187 3.78025 7.41248 3.67085C7.30308 3.56146 7.15471 3.5 7 3.5C6.84529 3.5 6.69692 3.56146 6.58752 3.67085C6.47812 3.78025 6.41667 3.92862 6.41667 4.08333V6.41667H4.08333C3.92862 6.41667 3.78025 6.47812 3.67085 6.58752C3.56146 6.69692 3.5 6.84529 3.5 7C3.5 7.15471 3.56146 7.30308 3.67085 7.41248C3.78025 7.52187 3.92862 7.58333 4.08333 7.58333H6.41667V9.91667C6.41667 10.0714 6.47812 10.2197 6.58752 10.3291C6.69692 10.4385 6.84529 10.5 7 10.5C7.15471 10.5 7.30308 10.4385 7.41248 10.3291C7.52187 10.2197 7.58333 10.0714 7.58333 9.91667V7.58333H9.91667C10.0714 7.58333 10.2197 7.52187 10.3291 7.41248C10.4385 7.30308 10.5 7.15471 10.5 7C10.5 6.84529 10.4385 6.69692 10.3291 6.58752C10.2197 6.47812 10.0714 6.41667 9.91667 6.41667H7.58333V4.08333Z"
                                fill="#4A58EC" />
                        </svg>

                        <span class="">{{ __('app.common.add_more') }}</span>
                    </button>
                </div>


            </div>
           
            <div class="d-flex align-items-center">
                <input type="email" class="form-control" placeholder="Emails" name="emails[]" required>
                <i class="fa-solid fa-trash delete-stage remove-append-item mx-2" style="cursor:pointer;" onclick="removeField(this)"></i>
            </div>
            <div class="d-flex align-items-center mt-2">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="email_types[${emailCounter}]" id="email-work-${emailCounter}" checked value="work">
                <label class="form-check-label" for="email-work-${emailCounter}">{{ __('app.common.work') }}</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="email_types[${emailCounter}]" id="email-home-${emailCounter}" value="home">
                <label class="form-check-label" for="email-home-${emailCounter}">{{ __('app.common.home') }}</label>
            </div>
        </div>
        `;

            emailContainer.parentNode.insertBefore(col, emailContainer.nextSibling);
            emailCounter++;

        }


        function removeField(icon) {
            icon.closest('.col-12.col-md-4').remove();
        }
    </script>
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
@endsection
