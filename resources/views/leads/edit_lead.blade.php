@extends('master')
<?php
$permissions = session('user_permissions');

?>
@section('content')
    <?php
    use App\Models\Lead;
    use App\Models\Person;
    use App\Models\Source;
    use App\Models\Type;
    use App\Models\UserDetails;
    use App\Models\Organization;
    use App\Models\Product;
    use App\Models\QuoteProduct;
    use App\Models\Service;
    
    $source_name = Source::where('id', $lead->source)->value('name');
    $type_name = Type::where('id', $lead->type)->value('name');
    $owner_name = UserDetails::where('user_id', $lead->sales_owner)->first();
    // var_dump($owner_name);
    $person = Person::where('id', $lead->person)->first();
    
    $organization = null;
    if ($person && $person->organization) {
        $organization = Organization::where('id', $person->organization)->first();
    }
    
    $userRoleId = auth()->user()->role;
    $currentUserId = auth()->user()->id;
    
    ?>
    <!-- Scrollable Content -->
    <!-- Scrollable Content -->
    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate class="lead-form">
        @csrf

        <div class="d-flex flex-column min-vh-100">
            <div class="flex-grow-1">
                <div class="main-scrollable">
                    <div class="page-container">
                        <div class="page-title-container mb-0">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="page-title">
                                        {{ __('app.leads.edit-title') }}
                                    </h3>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ url('leads') }}">Leads</a></li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">
                                                {{ __('app.leads.edit-title') }}</li>
                                        </ol>
                                    </nav>
                                </div>




                            </div>

                        </div>

                        <div class="col-12">
                            <div class="card-container">
                                <div class="card card-default">
                                    <div class="card-body">


                                        <div class="row g-4">
                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title"
                                                    value="{{ old('title', isset($lead) ? $lead->title : '') }}">
                                                @if ($errors->has('title'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('title') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="field2" class="form-label">Lead Value ($)</label>
                                                <input type="number" step="any" class="form-control" name="lead_value"
                                                    value="{{ old('lead_value', isset($lead) ? $lead->lead_value : '') }}">
                                                @if ($errors->has('lead_value'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('lead_value') }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label for="field2" class="form-label">Pipeline</label>
                                                <select class="form-control tagselect" name="pipeline">
                                                    <option value="">Select a pipeline</option>
                                                    <?php foreach($pipelines as $pipeline){ ?>
                                                    <option value="{{ $pipeline->id }}"
                                                        {{ $lead->pipeline == $pipeline->id ? 'selected' : '' }}>
                                                        {{ $pipeline->name }}</option>
                                                    <?php } ?>
                                                </select>
                                                @if ($errors->has('pipeline'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('pipeline') }}
                                                    </div>
                                                @endif
                                            </div>
                                            @php
                                                $selectedStage = $lead->stage;
                                            @endphp
                                            <div class="col-12 col-md-4">
                                                <label for="field2" class="form-label">Stage</label>
                                                <select class="form-control tagselect" name="stage">
                                                    <option value="">Select a stage</option>
                                                    <?php foreach($stages as $stage){ ?>
                                                    <option value="{{ $stage->id }}"
                                                        {{ $selectedStage == $stage->id ? 'selected' : '' }}>
                                                        {{ $stage->name }}
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                                @if ($errors->has('stage'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('stage') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="field2" class="form-label">Source</label>
                                                <select class="form-control tagselect" name="source"
                                                    data-parsley-errors-container="#source-value-errors">
                                                    <option selected hidden value="{{ $lead->source }}">
                                                        {{ $lead->source ? $source_name : '' }}
                                                    </option>
                                                    <?php foreach($sources as $source){ ?>
                                                    <option value="{{ $source->id }}">{{ $source->name }}</option>
                                                    <?php } ?>
                                                </select>
                                                <div id="source-value-errors"></div>
                                                {{-- @if ($errors->has('source'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('source') }}
                                                    </div>
                                                @endif --}}
                                            </div>


                                            <div class="col-12 col-md-4">
                                                <label for="field2" class="form-label">Type</label>
                                                <select class="form-control" data-choices id="choices-single-default"
                                                    name="type">
                                                    <?php foreach($types as $type){ ?>
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    <?php } ?>
                                                </select>
                                                @if ($errors->has('type'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('type') }}
                                                    </div>
                                                @endif
                                            </div>


                                            <div class="col-12 col-md-4">
                                                <label for="field2" class="form-label">Sales Owner</label>
                                                @if (in_array(strtolower('create-any-leads'), array_map('strtolower', $permissions)))
                                                    <select class="form-control" data-choices id="choices-single-default"
                                                        required name="sales_owner">
                                                        <!-- Show current owner as hidden selected option -->
                                                        <option selected value="{{ $lead->sales_owner }}">
                                                            {{ $owners->firstWhere('user_id', $lead->sales_owner)?->name ?? '' }}
                                                        </option>

                                                        <!-- List all owners -->
                                                        @foreach ($owners as $owner)
                                                            <option value="{{ $owner->user_id }}"
                                                                {{ $owner->user_id == $lead->sales_owner ? 'selected' : '' }}>
                                                                {{ $owner->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @elseif (in_array(strtolower('create-own-leads'), array_map('strtolower', $permissions)))
                                                    <select class="form-control" name="sales_owner" required>
                                                        <option value="{{ $currentUserId }}" selected>
                                                            {{ $owners->firstWhere('user_id', $currentUserId)?->name ?? '' }}
                                                        </option>
                                                    </select>
                                                    <input type="hidden" name="sales_owner" value="{{ $currentUserId }}">
                                                @endif

                                                @if ($errors->has('sales_owner'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('sales_owner') }}
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="field2" class="form-label">Priority</label>
                                                <select class="form-control" name="priority">

                                                    <option selected hidden value="{{ $lead->priority }}">
                                                        {{ $lead->priority }}
                                                    </option>
                                                    <option value="Urgent">Urgent</option>
                                                    <option value="High">High</option>
                                                    <option value="Medium">Medium</option>
                                                    <option value="Low">Low</option>
                                                </select>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label for="field2" class="form-label">Start Date</label>
                                                <input type="date" class="form-control" name="start_date"
                                                    value="{{ old('start_date', $lead->start_date ? \Carbon\Carbon::parse($lead->start_date)->format('Y-m-d') : '') }}">
                                                @if ($errors->has('start_date'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('start_date') }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label for="field2" class="form-label">Expected Closing
                                                    Date</label>
                                                <input type="date" class="form-control" name="closing_date"
                                                    value="{{ old('closing_date', $lead->closing_date ? \Carbon\Carbon::parse($lead->closing_date)->format('Y-m-d') : '') }}">
                                                @if ($errors->has('closing_date'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('closing_date') }}
                                                    </div>
                                                @endif
                                            </div>

                                        </div>


                                    </div>

                                </div>


                                <div class="card card-default mt-3">
                                    <div class="card-body">
                                        <div class="row g-4 input-fields-container" id="input-fields-container">
                                            <div class="col-12 col-md-4">
                                                <label for="field1"
                                                    class="form-label">{{ __('app.leads.name') }}</label>
                                                <select class="form-control stagselect" id="person-select" name="person"
                                                    data-parsley-errors-container="#person-value-errors">
                                                    <option hidden value="">Select Person</option>
                                                    <?php foreach($persons as $personItem){ ?>
                                                    <option value="{{ $personItem->id }}"
                                                        {{ ($lead->person ?? '') == $personItem->id ? 'selected' : '' }}>
                                                        {{ $personItem->name }}
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                                <div id="person-value-errors"></div>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label for="field1"
                                                    class="form-label">{{ __('app.leads.organization') }}</label>
                                                <input type="text" class="form-control mb-2" id="organization-display"
                                                    value="{{ $organization->name ?? '' }}" readonly>
                                                @if ($errors->has('organization'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('organization') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row g-4 mt-1">
                                            <div class="col-12 col-md-4" id="email-fields">
                                                <!-- Email fields will be populated here by JavaScript -->
                                            </div>

                                            <div class="col-12 col-md-4" id="number-fields">
                                                <!-- Contact number fields will be populated here by JavaScript -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-default mt-3">
                                    <div class="card-body">
                                        <div class="col-12">
                                            <label for="field5" class="form-label">Description</label>
                                            <textarea class="form-control w-100" id="exampleFormControlTextarea5" rows="5" name="description">{{ $lead->description }}</textarea>
                                            @if ($errors->has('description'))
                                                <div class="alert alert-danger mt-2">
                                                    {{ $errors->first('description') }}</li>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                               
                                @if ($leadAttributes->isNotEmpty())
                                    <div class="card card-default mt-3">
                                        <div class="card-body">
                                            @foreach ($leadAttributes as $attribute)
                                                <div class="mb-3">
                                                    <label>{{ $attribute->name }}</label>

                                                   @php
                                                        $value = $customValues[$attribute->code] ?? '';
                                                        if ($attribute->options) {
                                                            $options = is_array($attribute->options)
                                                                ? $attribute->options
                                                                : json_decode($attribute->options, true);
                                                        }
                                                    @endphp

                                                    @if ($attribute->type == 'text')
                                                        <input type="text" name="{{ $attribute->code }}"
                                                            class="form-control" value="{{ $value }}"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                    @elseif ($attribute->type == 'email')
                                                        <input type="email" name="{{ $attribute->code }}"
                                                            class="form-control" value="{{ $value }}"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                    @elseif ($attribute->type == 'textarea')
                                                        <textarea name="{{ $attribute->code }}" class="form-control"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>{{ $value }}</textarea>
                                                    @elseif ($attribute->type == 'number' || $attribute->type == 'price')
                                                        <input type="number" step="0.01"
                                                            name="{{ $attribute->code }}" class="form-control"
                                                            value="{{ $value }}"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                    @elseif ($attribute->type == 'boolean')
                                                        <select name="{{ $attribute->code }}" class="form-select"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                            <option value="1" {{ $value == '1' ? 'selected' : '' }}>
                                                                Yes
                                                            </option>
                                                            <option value="0" {{ $value == '0' ? 'selected' : '' }}>
                                                                No
                                                            </option>
                                                        </select>
                                                    @elseif ($attribute->type == 'select')
                                                        <select name="{{ $attribute->code }}" class="form-select"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                            <option value="">Select</option>
                                                            @foreach ($options as $opt)
                                                                <option value="{{ $opt }}"
                                                                    {{ $value == $opt ? 'selected' : '' }}>
                                                                    {{ $opt }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @elseif ($attribute->type == 'multiselect')
                                                        <select name="{{ $attribute->code }}[]" multiple
                                                            class="form-select"
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
                                                                    name="{{ $attribute->code }}[]"
                                                                    value="{{ $opt }}"
                                                                    @if (is_array($value) && in_array($opt, $value)) checked @endif>
                                                                <label
                                                                    class="form-check-label">{{ $opt }}</label>
                                                            </div>
                                                        @endforeach
                                                    @elseif ($attribute->type == 'date')
                                                        <input type="date" name="{{ $attribute->code }}"
                                                            class="form-control" value="{{ $value }}"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                    @elseif ($attribute->type == 'datetime')
                                                        <input type="datetime-local" name="{{ $attribute->code }}"
                                                            class="form-control" value="{{ $value }}"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                    @elseif ($attribute->type == 'file')
                                                        <input type="file" name="{{ $attribute->code }}"
                                                            class="form-control"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                        @if ($value)
                                                            <p class="mt-2">Current file: <a
                                                                    href="{{ asset('uploads/' . $value) }}"
                                                                    target="_blank">{{ $value }}</a></p>
                                                        @endif
                                                    @elseif ($attribute->type == 'image')
                                                        <input type="file" accept="image/*"
                                                            name="{{ $attribute->code }}" class="form-control"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                        @if ($value)
                                                            <div class="mt-2">
                                                                <img src="{{ asset('uploads/' . $value) }}"
                                                                    alt="Uploaded Image" width="100">
                                                            </div>
                                                        @endif
                                                    @elseif ($attribute->type == 'phone')
                                                        <input type="tel" name="{{ $attribute->code }}"
                                                            class="form-control" value="{{ $value }}"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                    @else
                                                        <input type="text" name="{{ $attribute->code }}"
                                                            class="form-control" value="{{ $value }}">
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





            <!-- Bottom Action Buttons -->
            <div class="col-12 action-bar">
                <div class="d-flex gap-2 justify-content-between">
                    <div>
                        <button type="submit" class="btn clear-all-btn">Clear All</button>
                    </div>
                    <div>
                        <button type="submit" class="btn save-btn">Save</button>
                        <button type="button" class="btn cancel-btn">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>



    {{-- <script>
        let emailCounter = 1;
        let numberCounter = 1;

        function addEmailField(email = '', type = 'work', index = emailCounter) {
            const inputFieldContainer = $('#input-fields-container');
            const emailField = `
                                <div class="col-12 col-md-4 email-field-${index} mt-1">
                                    <label for="field1" class="form-label">{{ __('app.leads.emails') }}</label>
                                    <input type="email" class="form-control" name="emails[]" value="${email}">
                                    
                                    <div class="mt-4 mt-lg-0">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="email_types[${index}]"
                                                id="email-work-${index}" ${type === 'work' ? 'checked' : ''} value="work">
                                            <label class="form-check-label" for="email-work-${index}">{{ __('app.common.work') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="email_types[${index}]"
                                                id="email-home-${index}" ${type === 'home' ? 'checked' : ''} value="home">
                                            <label class="form-check-label" for="email-home-${index}">{{ __('app.common.home') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <button class="btn trash-icon-btn " onclick="removeEmailField(this)">
                                                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M4.44137 13.0221C4.1026 13.0221 3.81269 12.9016 3.57164 12.6606C3.3306 12.4195 3.20987 12.1294 3.20946 11.7902V3.78281H2.59351V2.55089H5.67329V1.93494H9.36902V2.55089H12.4488V3.78281H11.8328V11.7902C11.8328 12.129 11.7123 12.4191 11.4713 12.6606C11.2302 12.902 10.9401 13.0226 10.6009 13.0221H4.44137ZM10.6009 3.78281H4.44137V11.7902H10.6009V3.78281ZM5.67329 10.5583H6.9052V5.01472H5.67329V10.5583ZM8.13711 10.5583H9.36902V5.01472H8.13711V10.5583Z"
                                                                        fill="#ED2227" />
                                                                </svg>

                                                            </button>
                                        </div>
                                    </div>
                                </div>`;

            inputFieldContainer.append(emailField);
            emailCounter++;
        }

        function addNumberField(number = '', type = 'work', index = numberCounter) {
            const inputFieldContainer = $('#input-fields-container');
            const numberField = `
                                <div class="col-12 col-md-4 number-field-${index} mt-1">
                                    <label for="field1" class="form-label">{{ __('app.leads.contact-numbers') }}</label>
                                    <input type="text" class="form-control" name="contact_numbers[]" value="${number}">
                                    
                                    <div class="mt-4 mt-lg-0">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="number_types[${index}]"
                                                id="number-work-${index}" ${type === 'work' ? 'checked' : ''} value="work">
                                            <label class="form-check-label" for="number-work-${index}">{{ __('app.common.work') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="number_types[${index}]"
                                                id="number-home-${index}" ${type === 'home' ? 'checked' : ''} value="home">
                                            <label class="form-check-label" for="number-home-${index}">{{ __('app.common.home') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                        <button class="btn trash-icon-btn " onclick="removeNumberField(this)">
                                                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M4.44137 13.0221C4.1026 13.0221 3.81269 12.9016 3.57164 12.6606C3.3306 12.4195 3.20987 12.1294 3.20946 11.7902V3.78281H2.59351V2.55089H5.67329V1.93494H9.36902V2.55089H12.4488V3.78281H11.8328V11.7902C11.8328 12.129 11.7123 12.4191 11.4713 12.6606C11.2302 12.902 10.9401 13.0226 10.6009 13.0221H4.44137ZM10.6009 3.78281H4.44137V11.7902H10.6009V3.78281ZM5.67329 10.5583H6.9052V5.01472H5.67329V10.5583ZM8.13711 10.5583H9.36902V5.01472H8.13711V10.5583Z"
                                                                        fill="#ED2227" />
                                                                </svg>

                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>`;

            inputFieldContainer.append(numberField);
            numberCounter++;
        }

        function removeEmailField(element) {
            $(element).closest('[class*="email-field-"]').remove();
        }

        function removeNumberField(element) {
            $(element).closest('[class*="number-field-"]').remove();
        }        
    </script> --}}




    {{--  --}}

    <script>
        $(document).ready(function() {
            let emailCounter = 0;
            let numberCounter = 0;
            let isExistingPerson = false;
            let isEditMode = {{ isset($lead->person) && $lead->person ? 'true' : 'false' }};
            let existingPersonId = {{ $lead->person ?? 'null' }};

            // Store initial data for edit mode
            let initialEmails = @json($person->emails ?? []);
            let initialNumbers = @json($person->contact_numbers ?? []);

            // Initialize the select2 with tags functionality
            $('#person-select').select2({
                allowClear: true,
                tags: true,
                tokenSeparators: [','],
                placeholder: "Select or type to add",
                createTag: function(params) {
                    var term = $.trim(params.term);
                    if (term === '') {
                        return null;
                    }
                    return {
                        id: term,
                        text: term,
                        newTag: true
                    };
                }
            });

            // Function to clear email and contact number fields
            function clearFields() {
                // Remove all fields (both static and dynamic)
                $('#email-fields').empty();
                $('#number-fields').empty();

                // Reset counters
                emailCounter = 0;
                numberCounter = 0;
            }

            // Function to show/hide add more buttons
            function toggleAddMoreButtons(show) {
                if (show) {
                    $('#email-fields .add-more-button').show();
                    $('#number-fields .add-more-button').show();
                } else {
                    $('#email-fields .add-more-button').hide();
                    $('#number-fields .add-more-button').hide();
                }
            }

            // Function to create initial empty fields
            function createEmptyFields() {
                let emailHtml = `
            <div class="email-field-static">
                <label for="email-0" class="form-label">{{ __('app.leads.emails') }}</label>
                <input type="email" class="form-control mb-2" name="emails[]" id="email-0" required>

                <div class="mt-4 mt-lg-0">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="email_types[0]" 
                               id="email-work-0" value="work" checked>
                        <label class="form-check-label" for="email-work-0">{{ __('app.common.work') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="email_types[0]" 
                               id="email-home-0" value="home">
                        <label class="form-check-label" for="email-home-0">{{ __('app.common.home') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <button type="button" class="btn add-more-button p-0" onclick="addEmailField()">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.1665 6.99984C1.1665 3.77809 3.77809 1.1665 6.99984 1.1665C10.2216 1.1665 12.8332 3.77809 12.8332 6.99984C12.8332 10.2216 10.2216 12.8332 6.99984 12.8332C3.77809 12.8332 1.1665 10.2216 1.1665 6.99984ZM6.99984 2.33317C5.76216 2.33317 4.57518 2.82484 3.70001 3.70001C2.82484 4.57518 2.33317 5.76216 2.33317 6.99984C2.33317 8.23751 2.82484 9.4245 3.70001 10.2997C4.57518 11.1748 5.76216 11.6665 6.99984 11.6665C8.23751 11.6665 9.4245 11.1748 10.2997 10.2997C11.1748 9.4245 11.6665 8.23751 11.6665 6.99984C11.6665 5.76216 11.1748 4.57518 10.2997 3.70001C9.4245 2.82484 8.23751 2.33317 6.99984 2.33317Z" fill="#4A58EC" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.58333 4.08333C7.58333 3.92862 7.52187 3.78025 7.41248 3.67085C7.30308 3.56146 7.15471 3.5 7 3.5C6.84529 3.5 6.69692 3.56146 6.58752 3.67085C6.47812 3.78025 6.41667 3.92862 6.41667 4.08333V6.41667H4.08333C3.92862 6.41667 3.78025 6.47812 3.67085 6.58752C3.56146 6.69692 3.5 6.84529 3.5 7C3.5 7.15471 3.56146 7.30308 3.67085 7.41248C3.78025 7.52187 3.92862 7.58333 4.08333 7.58333H6.41667V9.91667C6.41667 10.0714 6.47812 10.2197 6.58752 10.3291C6.69692 10.4385 6.84529 10.5 7 10.5C7.15471 10.5 7.30308 10.4385 7.41248 10.3291C7.52187 10.2197 7.58333 10.0714 7.58333 9.91667V7.58333H9.91667C10.0714 7.58333 10.2197 7.52187 10.3291 7.41248C10.4385 7.30308 10.5 7.15471 10.5 7C10.5 6.84529 10.4385 6.69692 10.3291 6.58752C10.2197 6.47812 10.0714 6.41667 9.91667 6.41667H7.58333V4.08333Z" fill="#4A58EC" />
                            </svg>
                            <span class="">{{ __('app.common.add_more') }}</span>
                        </button>
                    </div>
                </div>
            </div>
        `;

                let numberHtml = `
            <div class="number-field-static">
                <label for="number-0" class="form-label">{{ __('app.leads.contact-numbers') }}</label>
                <input type="text" class="form-control" name="contact_numbers[]" id="number-0">

                <div class="mt-4 mt-lg-0">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="number_types[0]" 
                               id="number-work-0" value="work" checked>
                        <label class="form-check-label" for="number-work-0">{{ __('app.common.work') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="number_types[0]" 
                               id="number-home-0" value="home">
                        <label class="form-check-label" for="number-home-0">{{ __('app.common.home') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <button type="button" class="btn add-more-button p-0" onclick="addNumberField()">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.1665 6.99984C1.1665 3.77809 3.77809 1.1665 6.99984 1.1665C10.2216 1.1665 12.8332 3.77809 12.8332 6.99984C12.8332 10.2216 10.2216 12.8332 6.99984 12.8332C3.77809 12.8332 1.1665 10.2216 1.1665 6.99984ZM6.99984 2.33317C5.76216 2.33317 4.57518 2.82484 3.70001 3.70001C2.82484 4.57518 2.33317 5.76216 2.33317 6.99984C2.33317 8.23751 2.82484 9.4245 3.70001 10.2997C4.57518 11.1748 5.76216 11.6665 6.99984 11.6665C8.23751 11.6665 9.4245 11.1748 10.2997 10.2997C11.1748 9.4245 11.6665 8.23751 11.6665 6.99984C11.6665 5.76216 11.1748 4.57518 10.2997 3.70001C9.4245 2.82484 8.23751 2.33317 6.99984 2.33317Z" fill="#4A58EC" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.58333 4.08333C7.58333 3.92862 7.52187 3.78025 7.41248 3.67085C7.30308 3.56146 7.15471 3.5 7 3.5C6.84529 3.5 6.69692 3.56146 6.58752 3.67085C6.47812 3.78025 6.41667 3.92862 6.41667 4.08333V6.41667H4.08333C3.92862 6.41667 3.78025 6.47812 3.67085 6.58752C3.56146 6.69692 3.5 6.84529 3.5 7C3.5 7.15471 3.56146 7.30308 3.67085 7.41248C3.78025 7.52187 3.92862 7.58333 4.08333 7.58333H6.41667V9.91667C6.41667 10.0714 6.47812 10.2197 6.58752 10.3291C6.69692 10.4385 6.84529 10.5 7 10.5C7.15471 10.5 7.30308 10.4385 7.41248 10.3291C7.52187 10.2197 7.58333 10.0714 7.58333 9.91667V7.58333H9.91667C10.0714 7.58333 10.2197 7.52187 10.3291 7.41248C10.4385 7.30308 10.5 7.15471 10.5 7C10.5 6.84529 10.4385 6.69692 10.3291 6.58752C10.2197 6.47812 10.0714 6.41667 9.91667 6.41667H7.58333V4.08333Z" fill="#4A58EC" />
                            </svg>
                            <span class="">{{ __('app.common.add_more') }}</span>
                        </button>
                    </div>
                </div>
            </div>
        `;

                $('#email-fields').html(emailHtml);
                $('#number-fields').html(numberHtml);
            }

            // Function to add email field dynamically (below existing ones)
            window.addEmailField = function() {
                emailCounter++;
                let emailHtml = `
            <div class="email-field-dynamic mt-3">
                <label for="email-${emailCounter}" class="form-label">{{ __('app.leads.emails') }}</label>
                <input type="email" class="form-control" name="emails[]" id="email-${emailCounter}">

                <div class="mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="email_types[${emailCounter}]" 
                               id="email-work-${emailCounter}" value="work" checked>
                        <label class="form-check-label" for="email-work-${emailCounter}">{{ __('app.common.work') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="email_types[${emailCounter}]" 
                               id="email-home-${emailCounter}" value="home">
                        <label class="form-check-label" for="email-home-${emailCounter}">{{ __('app.common.home') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <button type="button" class="btn trash-icon-btn mt-0 remove-email-field">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.44137 13.0221C4.1026 13.0221 3.81269 12.9016 3.57164 12.6606C3.3306 12.4195 3.20987 12.1294 3.20946 11.7902V3.78281H2.59351V2.55089H5.67329V1.93494H9.36902V2.55089H12.4488V3.78281H11.8328V11.7902C11.8328 12.129 11.7123 12.4191 11.4713 12.6606C11.2302 12.902 10.9401 13.0226 10.6009 13.0221H4.44137ZM10.6009 3.78281H4.44137V11.7902H10.6009V3.78281ZM5.67329 10.5583H6.9052V5.01472H5.67329V10.5583ZM8.13711 10.5583H9.36902V5.01472H8.13711V10.5583Z" fill="#ED2227" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        `;
                $('#email-fields').append(emailHtml);
            };

            // Function to add contact number field dynamically (below existing ones)
            window.addNumberField = function() {
                numberCounter++;
                let numberHtml = `
            <div class="number-field-dynamic mt-3">
                <label for="number-${numberCounter}" class="form-label">{{ __('app.leads.contact-numbers') }}</label>
                <input type="text" class="form-control" name="contact_numbers[]" id="number-${numberCounter}">

                <div class="mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="number_types[${numberCounter}]" 
                               id="number-work-${numberCounter}" value="work" checked>
                        <label class="form-check-label" for="number-work-${numberCounter}">{{ __('app.common.work') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="number_types[${numberCounter}]" 
                               id="number-home-${numberCounter}" value="home">
                        <label class="form-check-label" for="number-home-${numberCounter}">{{ __('app.common.home') }}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <button type="button" class="btn trash-icon-btn mt-0 remove-number-field">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.44137 13.0221C4.1026 13.0221 3.81269 12.9016 3.57164 12.6606C3.3306 12.4195 3.20987 12.1294 3.20946 11.7902V3.78281H2.59351V2.55089H5.67329V1.93494H9.36902V2.55089H12.4488V3.78281H11.8328V11.7902C11.8328 12.129 11.7123 12.4191 11.4713 12.6606C11.2302 12.902 10.9401 13.0226 10.6009 13.0221H4.44137ZM10.6009 3.78281H4.44137V11.7902H10.6009V3.78281ZM5.67329 10.5583H6.9052V5.01472H5.67329V10.5583ZM8.13711 10.5583H9.36902V5.01472H8.13711V10.5583Z" fill="#ED2227" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        `;
                $('#number-fields').append(numberHtml);
            };

            // Function to populate email fields from database
            function populateEmailFields(emails) {
                $('#email-fields').empty();

                if (emails.length > 0) {
                    emails.forEach((email, index) => {
                        let isFirst = index === 0;
                        let emailHtml = `
                    <div class="${isFirst ? 'email-field-static' : 'email-field-dynamic'} ${!isFirst ? 'mt-3' : ''}">
                        <label for="email-${index}" class="form-label">{{ __('app.leads.emails') }}</label>
                        <input type="email" class="form-control ${isFirst ? 'mb-2' : ''}" name="emails[]" id="email-${index}" 
                               value="${email.value}" disabled>

                        <div class="${isFirst ? 'mt-4 mt-lg-0' : 'mt-2'}">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="email_types[${index}]" 
                                       id="email-work-${index}" value="work" ${(email.label || 'work') === 'work' ? 'checked' : ''} disabled>
                                <label class="form-check-label" for="email-work-${index}">{{ __('app.common.work') }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="email_types[${index}]" 
                                       id="email-home-${index}" value="home" ${(email.label || 'work') === 'home' ? 'checked' : ''} disabled>
                                <label class="form-check-label" for="email-home-${index}">{{ __('app.common.home') }}</label>
                            </div>
                            ${isFirst ? `
                                                <div class="form-check form-check-inline" style="display: none;">
                                                    <button type="button" class="btn add-more-button p-0" onclick="addEmailField()">
                                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.1665 6.99984C1.1665 3.77809 3.77809 1.1665 6.99984 1.1665C10.2216 1.1665 12.8332 3.77809 12.8332 6.99984C12.8332 10.2216 10.2216 12.8332 6.99984 12.8332C3.77809 12.8332 1.1665 10.2216 1.1665 6.99984ZM6.99984 2.33317C5.76216 2.33317 4.57518 2.82484 3.70001 3.70001C2.82484 4.57518 2.33317 5.76216 2.33317 6.99984C2.33317 8.23751 2.82484 9.4245 3.70001 10.2997C4.57518 11.1748 5.76216 11.6665 6.99984 11.6665C8.23751 11.6665 9.4245 11.1748 10.2997 10.2997C11.1748 9.4245 11.6665 8.23751 11.6665 6.99984C11.6665 5.76216 11.1748 4.57518 10.2997 3.70001C9.4245 2.82484 8.23751 2.33317 6.99984 2.33317Z" fill="#4A58EC" />
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.58333 4.08333C7.58333 3.92862 7.52187 3.78025 7.41248 3.67085C7.30308 3.56146 7.15471 3.5 7 3.5C6.84529 3.5 6.69692 3.56146 6.58752 3.67085C6.47812 3.78025 6.41667 3.92862 6.41667 4.08333V6.41667H4.08333C3.92862 6.41667 3.78025 6.47812 3.67085 6.58752C3.56146 6.69692 3.5 6.84529 3.5 7C3.5 7.15471 3.56146 7.30308 3.67085 7.41248C3.78025 7.52187 3.92862 7.58333 4.08333 7.58333H6.41667V9.91667C6.41667 10.0714 6.47812 10.2197 6.58752 10.3291C6.69692 10.4385 6.84529 10.5 7 10.5C7.15471 10.5 7.30308 10.4385 7.41248 10.3291C7.52187 10.2197 7.58333 10.0714 7.58333 9.91667V7.58333H9.91667C10.0714 7.58333 10.2197 7.52187 10.3291 7.41248C10.4385 7.30308 10.5 7.15471 10.5 7C10.5 6.84529 10.4385 6.69692 10.3291 6.58752C10.2197 6.47812 10.0714 6.41667 9.91667 6.41667H7.58333V4.08333Z" fill="#4A58EC" />
                                                        </svg>
                                                        <span class="">{{ __('app.common.add_more') }}</span>
                                                    </button>
                                                </div>
                                                ` : ''}
                        </div>
                    </div>
                `;
                        $('#email-fields').append(emailHtml);
                        emailCounter = index;
                    });
                }
            }

            // Function to populate number fields from database
            function populateNumberFields(numbers) {
                $('#number-fields').empty();

                if (numbers.length > 0) {
                    numbers.forEach((number, index) => {
                        let isFirst = index === 0;
                        let numberHtml = `
                    <div class="${isFirst ? 'number-field-static' : 'number-field-dynamic'} ${!isFirst ? 'mt-3' : ''}">
                        <label for="number-${index}" class="form-label">{{ __('app.leads.contact-numbers') }}</label>
                        <input type="text" class="form-control" name="contact_numbers[]" id="number-${index}" 
                               value="${number.value}" disabled>

                        <div class="${isFirst ? 'mt-4 mt-lg-0' : 'mt-2'}">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="number_types[${index}]" 
                                       id="number-work-${index}" value="work" ${(number.label || 'work') === 'work' ? 'checked' : ''} disabled>
                                <label class="form-check-label" for="number-work-${index}">{{ __('app.common.work') }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="number_types[${index}]" 
                                       id="number-home-${index}" value="home" ${(number.label || 'work') === 'home' ? 'checked' : ''} disabled>
                                <label class="form-check-label" for="number-home-${index}">{{ __('app.common.home') }}</label>
                            </div>
                            ${isFirst ? `
                                                <div class="form-check form-check-inline" style="display: none;">
                                                    <button type="button" class="btn add-more-button p-0" onclick="addNumberField()">
                                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.1665 6.99984C1.1665 3.77809 3.77809 1.1665 6.99984 1.1665C10.2216 1.1665 12.8332 3.77809 12.8332 6.99984C12.8332 10.2216 10.2216 12.8332 6.99984 12.8332C3.77809 12.8332 1.1665 10.2216 1.1665 6.99984ZM6.99984 2.33317C5.76216 2.33317 4.57518 2.82484 3.70001 3.70001C2.82484 4.57518 2.33317 5.76216 2.33317 6.99984C2.33317 8.23751 2.82484 9.4245 3.70001 10.2997C4.57518 11.1748 5.76216 11.6665 6.99984 11.6665C8.23751 11.6665 9.4245 11.1748 10.2997 10.2997C11.1748 9.4245 11.6665 8.23751 11.6665 6.99984C11.6665 5.76216 11.1748 4.57518 10.2997 3.70001C9.4245 2.82484 8.23751 2.33317 6.99984 2.33317Z" fill="#4A58EC" />
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.58333 4.08333C7.58333 3.92862 7.52187 3.78025 7.41248 3.67085C7.30308 3.56146 7.15471 3.5 7 3.5C6.84529 3.5 6.69692 3.56146 6.58752 3.67085C6.47812 3.78025 6.41667 3.92862 6.41667 4.08333V6.41667H4.08333C3.92862 6.41667 3.78025 6.47812 3.67085 6.58752C3.56146 6.69692 3.5 6.84529 3.5 7C3.5 7.15471 3.56146 7.30308 3.67085 7.41248C3.78025 7.52187 3.92862 7.58333 4.08333 7.58333H6.41667V9.91667C6.41667 10.0714 6.47812 10.2197 6.58752 10.3291C6.69692 10.4385 6.84529 10.5 7 10.5C7.15471 10.5 7.30308 10.4385 7.41248 10.3291C7.52187 10.2197 7.58333 10.0714 7.58333 9.91667V7.58333H9.91667C10.0714 7.58333 10.2197 7.52187 10.3291 7.41248C10.4385 7.30308 10.5 7.15471 10.5 7C10.5C 6.84529 10.4385 6.69692 10.3291 6.58752C10.2197 6.47812 10.0714 6.41667 9.91667 6.41667H7.58333V4.08333Z" fill="#4A58EC" />
                                                        </svg>
                                                        <span class="">{{ __('app.common.add_more') }}</span>
                                                    </button>
                                                </div>
                                                ` : ''}
                        </div>
                    </div>
                `;
                        $('#number-fields').append(numberHtml);
                        numberCounter = index;
                    });
                }
            }

            // Event handler for the person select dropdown change
            $('#person-select').on('change', function() {
                let selectedData = $(this).select2('data')[0];
                let personId = $(this).val();

                // Clear the fields when a new person is selected
                clearFields();

                if (personId) {
                    // Check if this is a new tag (not from database)
                    if (selectedData && selectedData.newTag) {
                        // This is a new person being added
                        isExistingPerson = false;
                        createEmptyFields();
                        toggleAddMoreButtons(true);
                    } else {
                        // This is an existing person from database
                        isExistingPerson = true;

                        // Fetch person details from database
                        $.ajax({
                            url: '{{ url('get-contact-person-details') }}/' + personId,
                            type: 'GET',
                            success: function(response) {
                                console.log(response);

                                // Update organization display
                                if (response.organization_name) {
                                    $('#organization-display').val(response.organization_name);
                                } else {
                                    $('#organization-display').val('');
                                }

                                // Populate emails
                                if (response.emails && response.emails.length > 0) {
                                    populateEmailFields(response.emails);
                                } else {
                                    createEmptyFields();
                                    toggleAddMoreButtons(true);
                                }

                                // Populate contact numbers
                                if (response.contact_numbers && response.contact_numbers
                                    .length > 0) {
                                    populateNumberFields(response.contact_numbers);
                                } else {
                                    if (!response.emails || response.emails.length === 0) {
                                        createEmptyFields();
                                    }
                                    toggleAddMoreButtons(true);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching person details:', error);
                                createEmptyFields();
                                toggleAddMoreButtons(true);
                            }
                        });
                    }
                } else {
                    createEmptyFields();
                    toggleAddMoreButtons(true);
                }
            });

            // Handle the clear button click event
            $('#person-select').on('select2:clear', function() {
                clearFields();
                createEmptyFields();
                isExistingPerson = false;
                toggleAddMoreButtons(true);
                $('#organization-display').val('');
            });

            // Remove dynamically added email field
            $(document).on('click', '.remove-email-field', function() {
                $(this).closest('.email-field-dynamic').remove();
            });

            // Remove dynamically added number field
            $(document).on('click', '.remove-number-field', function() {
                $(this).closest('.number-field-dynamic').remove();
            });

            // Initialize on page load
            if (isEditMode && existingPersonId) {
                // Load existing data
                if (initialEmails.length > 0) {
                    populateEmailFields(initialEmails);
                } else {
                    createEmptyFields();
                }

                if (initialNumbers.length > 0) {
                    populateNumberFields(initialNumbers);
                } else {
                    if (initialEmails.length === 0) {
                        createEmptyFields();
                    }
                }

                toggleAddMoreButtons(false);
            } else {
                // Create empty fields for new entry
                createEmptyFields();
                toggleAddMoreButtons(true);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @endif

            @if (Session::has('fail'))
                toastr.error("{{ Session::get('fail') }}");
            @endif
        });
    </script>
@endsection
