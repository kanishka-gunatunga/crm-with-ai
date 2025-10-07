@extends('master')

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
                                                @if ($userRoleId == 2)
                                                    <select class="form-control" data-choices id="choices-single-default"
                                                        name="sales_owner">
                                                        <!-- Show current owner as hidden selected option -->
                                                        <option selected value="{{ $lead->sales_owner }}">
                                                            {{ $owners->firstWhere('user_id', $lead->sales_owner)?->name ?? '' }}
                                                        </option>

                                                        <!-- List all owners -->
                                                        @foreach ($owners as $owner)
                                                            <option value="{{ $owner->id }}"
                                                                {{ $owner->id == $lead->sales_owner ? 'selected' : '' }}>
                                                                {{ $owner->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @elseif ($userRoleId == 3)
                                                    <select class="form-control" name="sales_owner">
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




                                            {{-- <div class="col-12 col-md-4">
                                                <label for="field2" class="form-label">Expected Closing
                                                    Date</label>
                                                <input type="date" class="form-control" name="closing_date"
                                                    value="{{ $lead->closing_date }}" required>
                                                @if ($errors->has('closing_date'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('closing_date') }}
                                                    </div>
                                                @endif
                                            </div> --}}
                                            {{-- <div class="col-12 col-md-4">
                                        <label for="field3" class="form-label">Assign User</label>

                                        <select class="myDropdown form-control  ">
                                            <option value="1">Option 1</option>
                                            <option value="2">Option 2</option>
                                            <option value="3">Option 3</option>
                                        </select>
                                    </div> --}}
                                            <!-- Select2 CSS -->


                                            {{-- <div class="col-12 col-md-4">
                                        <label for="field4" class="form-label">Status</label>
                                        <input type="text" class="form-control" id="field4" placeholder="Status">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="field5" class="form-label">Priority</label>
                                        <input type="text" class="form-control" id="field5" placeholder="Priority">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="field3" class="form-label">Terms</label>

                                        <select class="myDropdown2 form-control  ">
                                            <option value="1">Option 1</option>
                                            <option value="2">Option 2</option>
                                            <option value="3">Option 3</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="field5" class="form-label">Date start</label>
                                        <input type="text" class="form-control" id="field5" placeholder="Date start">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="field5" class="form-label">Date Due</label>
                                        <input type="text" class="form-control" id="field5" placeholder="Date Due">
                                    </div> --}}
                                            <!-- <div class="col-12 col-md-4">
                                                                                                                                                                        <label for="field5" class="form-label">Reminders</label>
                                                                                                                                                                        <input type="text" class="form-control" id="field5" placeholder="Reminders">
                                                                                                                                                                    </div> -->

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
                                                {{-- @if ($errors->has('person'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('person') }}
                                                    </div>
                                                @endif --}}
                                            </div>


                                            <div class="col-12 col-md-4">
                                                <label for="field1"
                                                    class="form-label">{{ __('app.leads.organization') }}</label>
                                                <select class="form-control stagselect" id="organization-select"
                                                    name="organization">
                                                    {{-- <option selected hidden value="{{ $person->organization ?? '' }}">
                                                        {{ $organization->name ?? '' }}</option> --}}
                                                    <?php foreach($organizations as $organization){ ?>
                                                    <option value="{{ $organization->id }}">{{ $organization->name }}
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                                @if ($errors->has('organization'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('organization') }}
                                                    </div>
                                                @endif
                                            </div>


                                            <div class="col-12 col-md-4" id="email-fields">
                                                <label for="field1"
                                                    class="form-label">{{ __('app.leads.emails') }}</label>
                                                <input type="email" class="form-control" name="emails[]">

                                                <div class="mt-4 mt-lg-0">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="email_types[0]" id="email-work-0" checked
                                                            value="work">
                                                        <label class="form-check-label"
                                                            for="email-work-0">{{ __('app.common.work') }}</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="email_types[0]" id="email-home-0" value="home">
                                                        <label class="form-check-label"
                                                            for="email-home-0">{{ __('app.common.home') }}</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <button class="btn add-more-button p-0" id="add-emails"
                                                            onclick="addEmailField()">
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
                                            </div>

                                            <div class="col-12 col-md-4 mt-1" id="number-fields">
                                                <label for="field1"
                                                    class="form-label">{{ __('app.leads.contact-numbers') }}</label>
                                                <input type="text" class="form-control" name="contact_numbers[]">

                                                <div class="mt-4 mt-lg-0">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="number_types[0]" id="number-work-0" checked
                                                            value="work">
                                                        <label class="form-check-label"
                                                            for="number-work-0">{{ __('app.common.work') }}</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="number_types[0]" id="number-home-0" value="home">
                                                        <label class="form-check-label"
                                                            for="number-home-0">{{ __('app.common.home') }}</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <button class="btn add-more-button p-0" id="add-emails"
                                                            onclick="addNumberField()">
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



                                {{-- <div class="col-md-12 p-4">
                                    <div class="d-flex gap-3 mb-3 align-items-center">
                                        <div>
                                            <p class="m-0">Attachments </p>
                                        </div>

                                        <div type="button" class="btn muted p-0">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M11.6667 0C12.7718 0 13.8316 0.438987 14.613 1.22039C15.3944 2.00179 15.8334 3.0616 15.8334 4.16667V14.1667C15.8334 14.9327 15.6825 15.6913 15.3894 16.399C15.0962 17.1067 14.6665 17.7498 14.1249 18.2915C13.5832 18.8331 12.9401 19.2628 12.2324 19.556C11.5247 19.8491 10.7661 20 10.0001 20C9.23404 20 8.47549 19.8491 7.76776 19.556C7.06003 19.2628 6.41697 18.8331 5.87529 18.2915C5.33362 17.7498 4.90394 17.1067 4.61078 16.399C4.31763 15.6913 4.16675 14.9327 4.16675 14.1667V7.5H5.83341V14.1667C5.83341 15.2717 6.2724 16.3315 7.0538 17.1129C7.8352 17.8943 8.89501 18.3333 10.0001 18.3333C11.1052 18.3333 12.165 17.8943 12.9464 17.1129C13.7278 16.3315 14.1667 15.2717 14.1667 14.1667V4.16667C14.1667 3.83836 14.1021 3.51327 13.9764 3.20996C13.8508 2.90664 13.6667 2.63105 13.4345 2.3989C13.2024 2.16675 12.9268 1.9826 12.6235 1.85697C12.3201 1.73133 11.9951 1.66667 11.6667 1.66667C11.3384 1.66667 11.0134 1.73133 10.71 1.85697C10.4067 1.9826 10.1311 2.16675 9.89898 2.3989C9.66683 2.63105 9.48269 2.90664 9.35705 3.20996C9.23141 3.51327 9.16675 3.83836 9.16675 4.16667V14.1667C9.16675 14.3877 9.25455 14.5996 9.41083 14.7559C9.56711 14.9122 9.77907 15 10.0001 15C10.2211 15 10.4331 14.9122 10.5893 14.7559C10.7456 14.5996 10.8334 14.3877 10.8334 14.1667V5H12.5001V14.1667C12.5001 14.8297 12.2367 15.4656 11.7678 15.9344C11.299 16.4033 10.6631 16.6667 10.0001 16.6667C9.33704 16.6667 8.70116 16.4033 8.23231 15.9344C7.76347 15.4656 7.50008 14.8297 7.50008 14.1667V4.16667C7.50008 3.0616 7.93907 2.00179 8.72047 1.22039C9.50187 0.438987 10.5617 0 11.6667 0Z"
                                                    fill="#172635" />
                                            </svg>

                                        </div>

                                        <div type="button" class="btn muted p-0">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M10.8333 4.99998L12.4999 3.33331C13.3333 2.49998 14.9999 2.49998 15.8333 3.33331L16.6666 4.16665C17.4999 4.99998 17.4999 6.66665 16.6666 7.49998L12.4999 11.6666C11.6666 12.5 9.99992 12.5 9.16659 11.6666M9.16659 15L7.49992 16.6666C6.66659 17.5 4.99992 17.5 4.16659 16.6666L3.33325 15.8333C2.49992 15 2.49992 13.3333 3.33325 12.5L7.49992 8.33331C8.33325 7.49998 9.99992 7.49998 10.8333 8.33331"
                                                    stroke="#172635" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>

                                        </div>

                                    </div>
                                </div> --}}


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
        </div>
    </form>



    <script>
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

        function addProductField() {
            const productFieldsContainer = $('#product-fields');
            const productField = `
    <div class="row align-items-center product-field">
    <div class="col-md-12">
            <div class="mb-3">
                <label for="firstNameinput" class="form-label">{{ __('app.leads.products') }}</label>
                <select class="form-control product-select" name="products[]" onchange="updatePrice(this)">
                    <option hidden selected></option>
                     <?php foreach($products as $product){ ?> 
                    <option value="product||{{ $product->id }}" data-price="{{ $product->cost }}">{{ $product->name }}</option>
                    <?php } ?>
                    <?php foreach($services as $service){ ?> 
                        <option value="service||{{ $service->id }}" data-price="{{ $service->cost }}">{{ $service->name }}</option>
                    <?php } ?>
                </select>
            </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="firstNameinput" class="form-label">{{ __('app.leads.price') }}</label>
            <input type="number" step="any" class="form-control price-input" name="prices[]"  oninput="calculateAmount(this)">
        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-3">
            <label for="firstNameinput" class="form-label">{{ __('app.leads.quantity') }}</label>
            <input type="number" step="any" class="form-control quantity-input" name="quantities[]"   oninput="calculateAmount(this)">
        </div>
    </div>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="firstNameinput" class="form-label">{{ __('app.leads.amount') }}</label>
            <input type="number" step="any" class="form-control amount-input" name="amounts[]" readonly  >
        </div>
    </div>
    <div class="col-md-1">
        <div class="mb-3">
        <button class="btn trash-icon-btn " onclick="removeProductField(this)">
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
            productFieldsContainer.append(productField);

            $(`.product-select`).select2({
                allowClear: true,
                width: '100%',
                placeholder: 'Select a product',
                allowClear: true
            });
        }

        function removeProductField(element) {
            const productField = element.closest('.product-field');
            productField.remove();
        }
    </script>
    <script>
        $(document).ready(function() {
            // Initialize select2 with tags functionality for person-select
            $('#person-select').select2({
                allowClear: true,
                tags: true,
                tokenSeparators: [','],
                placeholder: "Select or type to add",
                allowClear: true,
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

            // Initialize the second select2 (organization-select)
            $('#organization-select').select2({
                allowClear: true,
            });

            // Function to clear email and contact number fields
            function clearFields() {
                $('#email-fields').html('');
                $('#number-fields').html('');
            }

            // Function to add email input fields dynamically
            function addEmailField(emailValue = '', emailLabel = '', index = 0) {
                let emailHtml = `
                <div class="email-field">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="emails[${index}]" value="${emailValue}" placeholder="Email ${emailLabel}" class="form-control">
                </div>`;
                $('#email-fields').append(emailHtml);
            }

            // Function to add contact number input fields dynamically
            function addNumberField(numberValue = '', numberLabel = '', index = 0) {
                let numberHtml = `
                <div class="number-field">
                    <label for="contact" class="form-label">Contact Number</label>
                    <input type="text" name="contact_numbers[${index}]" value="${numberValue}" placeholder="Contact Number ${numberLabel}" class="form-control">
                </div>`;
                $('#number-fields').append(numberHtml);
            }

            // Event handler for person select dropdown change
            $('#person-select').on('change', function() {
                let personId = $(this).val();

                // Clear the fields when a new person is selected
                clearFields();

                if (personId) {
                    $.ajax({
                        url: '{{ url('get-contact-person-details') }}/' + personId,
                        type: 'GET',
                        success: function(response) {
                            console.log(response);

                            let organizationSelect = $('#organization-select');

                            // Handling organization selection
                            if (response.organization) {
                                organizationSelect.empty().trigger("change");
                                let newOption = new Option(response.organization_name, response
                                    .organization, true, true);
                                organizationSelect.append(newOption).trigger("change");
                            } else {
                                organizationSelect.val(null).trigger("change");
                            }

                            // Adding the emails
                            if (response.emails.length > 0) {
                                response.emails.forEach((email, index) => {
                                    addEmailField(email.value, email.label, index);
                                });
                            } else {
                                addEmailField();
                            }

                            // Adding the contact numbers
                            if (response.contact_numbers.length > 0) {
                                response.contact_numbers.forEach((number, index) => {
                                    addNumberField(number.value, number.label, index);
                                });
                            } else {
                                addNumberField();
                            }
                        }
                    });
                }
            });

            // Handle the close button click event (if any)
            $('#person-select').on('select2:clear', function() {
                clearFields(); // Clear the email and number fields when the selection is cleared
            });

            // Optional: Add remove button functionality for email and number fields
            $(document).on('click', '.remove-email', function() {
                $(this).parent().remove(); // Remove the email field
            });

            $(document).on('click', '.remove-number', function() {
                $(this).parent().remove(); // Remove the number field
            });
        });

        function removeProductField(element) {
            const productField = element.closest('.product-field');
            productField.remove();
        }

        function updatePrice(selectElement) {
            const selectedOption = $(selectElement).find('option:selected');
            const price = selectedOption.data('price');
            const priceInput = $(selectElement).closest('.product-field').find('.price-input');

            priceInput.val(price);

            calculateAmount(priceInput[0]);
        }

        function calculateAmount(inputElement) {
            const productField = $(inputElement).closest('.product-field');
            const price = parseFloat(productField.find('.price-input').val()) || 0;
            const quantity = parseInt(productField.find('.quantity-input').val()) || 0;
            const amount = price * quantity;

            productField.find('.amount-input').val(amount.toFixed(2));
        }
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
