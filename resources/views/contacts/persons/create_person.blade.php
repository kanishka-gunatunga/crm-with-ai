@extends('master')

@section('content')
    <!-- Scrollable Content -->
    <!-- Scrollable Content -->
    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate>
        @csrf
        <div class="d-flex flex-column min-vh-100">
            <div class="flex-grow-1">
                <div class="main-scrollable">
                    <div class="page-container">

                        <div class="page-title-container mb-0">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="page-title">
                                        {{ __('app.contacts.persons.create-title') }}
                                    </h3>

                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ url('persons') }}">Perosons</a></li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">
                                                {{ __('app.contacts.persons.create-title') }}</li>
                                        </ol>
                                    </nav>

                                </div>

                            </div>

                        </div>

                        <div class="col-12">
                            <div class="card-container">
                                <div class="card card-default">
                                    <div class="card-body">
                                        <div class="row g-4" id="form-fields-container">
                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="field1" placeholder="Name"
                                                    name="name" value="{{ old('name') }}" required>
                                                @if ($errors->has('name'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="field3" class="form-label">Organization</label>
                                                <select class="myDropdown form-control" name="organization">
                                                    <?php foreach($organizations as $organization){ ?>
                                                    <option value="{{ $organization->id }}">{{ $organization->name }}
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                                @if ($errors->has('organization'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('organization') }}</div>
                                                @endif
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">Date of Birth</label>
                                                <input type="date" class="form-control" id="field1" placeholder="Name"
                                                    name="dob" value="{{ old('dob') }}" required>
                                                @if ($errors->has('dob'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('dob') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">Picture</label>
                                                <input type="file" class="form-control" id="Picture" name="picture"
                                                    value="{{ old('picture') }}">
                                                @if ($errors->has('picture'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('picture') }}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-12 col-md-4 email-fields-container">

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
                                                <input type="email" class="form-control" id="field4"
                                                    placeholder="Emails" name="emails[]" required>
                                            </div>



                                            <div class="col-12 col-md-4 contact-fields-container">

                                                <div class="d-flex align-items-center">
                                                    <label for="field4" class="form-label">Contact Numbers</label>
                                                    <div class="ms-3 mb-2">
                                                        <button class="btn add-more-button mx-1 p-0" id="add-emails"
                                                            onclick="addnumberField()" type="button">
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
                                                <input type="tel" class="form-control" id="field4"
                                                    placeholder="Contact Numbers" name="contact_numbers[]">
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
                        <a href="{{ url('persons') }}"><button type="button" class="btn cancel-btn">Cancel</button></a>
                    </div>

                </div>

            </div>
        </div>
    </form>

    <script>
        let emailCounter = 1;
        let numberCounter = 1;

        function addEmailField() {
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

        function addnumberField() {
            const contactContainer = document.querySelector('.contact-fields-container');

            const col = document.createElement('div');
            col.className = 'col-12 col-md-4';

            col.innerHTML = `
            <div class="d-flex align-items-center">
                <label for="field4" class="form-label">Contact Numbers</label>
                <div class="ms-3 mb-2">
                    <button class="btn add-more-button mx-1 p-0" id="add-emails"
                        onclick="addnumberField()" type="button">
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
                <input type="text" class="form-control" placeholder="Contact Numbers" name="contact_numbers[]" required>
                <i class="fa-solid fa-trash delete-stage remove-append-item mx-2" style="cursor:pointer;" onclick="removeField(this)"></i>
            </div>
            <div class="d-flex align-items-center mt-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="number_types[${numberCounter}]" id="number-work-${numberCounter}" checked value="work">
                    <label class="form-check-label" for="number-work-${numberCounter}">{{ __('app.common.work') }}</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="number_types[${numberCounter}]" id="number-home-${numberCounter}" value="home">
                    <label class="form-check-label" for="number-home-${numberCounter}">{{ __('app.common.home') }}</label>
                </div>

            </div>
        `;

            contactContainer.parentNode.insertBefore(col, contactContainer.nextSibling);
            numberCounter++;
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
