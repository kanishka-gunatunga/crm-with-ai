@extends('master')

@section('content')
    <?php
    use App\Models\Person;
    use App\Models\UserDetails;
    use App\Models\Lead;
    ?>

    <!-- Scrollable Content -->
    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate>
        @csrf

        <div class="d-flex flex-column min-vh-100">
            <div class="flex-grow-1">
                <div class="main-scrollable">
                    <div class="main-scrollable">

                        <div class="page-container">

                            <div class="page-title-container mb-0">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3 class="page-title">
                                            {{ __('app.activities.edit-title') }}
                                        </h3>
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="{{ url('activities') }}">
                                                        {{ __('app.activities.title') }}</a></li>
                                                <li class="breadcrumb-item active current-breadcrumb" aria-current="page">
                                                    {{ __('app.activities.edit-title') }}</li>
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
                                                    <label for="field1"
                                                        class="form-label">{{ __('app.activities.lead') }}</label>
                                                    <select class="myDropdown form-control  " name="lead" required>
                                                        <option hidden selected value="{{ $activity->lead_id }}">
                                                            {{ Lead::where('id', $activity->lead_id)->value('title') }}
                                                        </option>
                                                        <?php foreach($leads as $lead){ ?>
                                                        <option value="{{ $lead->id }}">{{ $lead->title }}</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="field1"
                                                        class="form-label">{{ __('app.activities.title-control') }}</label>
                                                    <input type="text" class="form-control" name="title"
                                                        value="{{ $activity->title }}" required>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="field1"
                                                        class="form-label">{{ __('app.activities.type') }}</label>
                                                    <select class="myDropdown form-control  " name="type" required>
                                                        <option selected hidden value="{{ $activity->type }}">
                                                            {{ $activity->type }}
                                                        </option>
                                                        <option value="Call">Call</option>
                                                        <option value="Meeting">Meeting</option>
                                                        <option value="Lunch">Lunch</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="field1"
                                                        class="form-label">{{ __('app.activities.from') }}</label>
                                                    <input type="text" class="form-control dateTimePicker"
                                                        value="{{ $activity->from }}" name="from" required>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="field1"
                                                        class="form-label">{{ __('app.activities.to') }}</label>
                                                    <input type="text" class="form-control dateTimePicker"
                                                        value="{{ $activity->to }}" name="to" required>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="field1"
                                                        class="form-label">{{ __('app.activities.location') }}</label>
                                                    <input type="text" class="form-control" name="location"
                                                        value="{{ $activity->location }}" required>
                                                </div>
                                                <div class="col-12 col-md-4 participant-select-container">
                                                    <label for="field1"
                                                        class="form-label">{{ __('app.activities.participants') }}</label>
                                                    <select class="myDropdown form-control" name="participants[]" multiple
                                                        required>
                                                        {{-- Show existing participants as selected --}}
                                                        @foreach ($activity->participants as $participant)
                                                            @php
                                                                if ($participant['type'] == 'person') {
                                                                    $participant_name = Person::where(
                                                                        'id',
                                                                        $participant['id'],
                                                                    )->value('name');
                                                                } else {
                                                                    $participant_name = UserDetails::where(
                                                                        'id',
                                                                        $participant['id'],
                                                                    )->value('name');
                                                                }
                                                            @endphp
                                                            <option selected
                                                                value="{{ $participant['type'] }}||{{ $participant['id'] }}">
                                                                {{ $participant_name }}
                                                            </option>
                                                        @endforeach

                                                        {{-- Show all persons, excluding those already selected --}}
                                                        @php
                                                            $selectedPersonIds = collect($activity->participants)
                                                                ->where('type', 'person')
                                                                ->pluck('id')
                                                                ->toArray();
                                                        @endphp
                                                        @foreach ($persons as $person)
                                                            @if (!in_array($person->id, $selectedPersonIds))
                                                                <option value="person||{{ $person->id }}">
                                                                    {{ $person->name }}</option>
                                                            @endif
                                                        @endforeach

                                                        {{-- Show all owners, excluding those already selected --}}
                                                        @php
                                                            $selectedOwnerIds = collect($activity->participants)
                                                                ->where('type', 'owner')
                                                                ->pluck('id')
                                                                ->toArray();
                                                        @endphp
                                                        @foreach ($owners as $owner)
                                                            @if (!in_array($owner->user_id, $selectedOwnerIds))
                                                                <option value="owner||{{ $owner->user_id }}">
                                                                    {{ $owner->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                        </div>

                                    </div>

                                    <div class="card card-default mt-3">
                                        <div class="card-body">
                                            <div class="col-12">
                                                <label for="field5"
                                                    class="form-label">{{ __('app.activities.description') }}</label>
                                                <textarea class="form-control description-form-control" placeholder="Description" id="field5" rows="5"
                                                    name="description">{{ $activity->description }}</textarea>

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
                            <a href="{{ url('activities') }}"><button type="button"
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
        });
    </script>
@endsection
