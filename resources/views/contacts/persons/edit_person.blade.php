@extends('master')

@section('content')
    <?php
    use App\Models\Organization;
    ?>
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
                                        {{ __('app.contacts.persons.edit-title') }}
                                    </h3>

                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#">Contacts</a></li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">
                                                {{ __('app.contacts.persons.edit-title') }}</li>
                                        </ol>
                                    </nav>

                                </div>

                                <!-- <div class="d-flex gap-3">


                                <a href="../leads/create-lead.php">
                                    <button class="import-leads-button">
                                        <div class="icon-container">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.8526 7.8525C10.9041 7.79723 10.9662 7.75291 11.0352 7.72216C11.1042 7.69142 11.1787 7.67489 11.2542 7.67356C11.3298 7.67222 11.4048 7.68612 11.4748 7.71441C11.5449 7.7427 11.6085 7.78481 11.6619 7.83822C11.7153 7.89164 11.7574 7.95526 11.7857 8.0253C11.814 8.09534 11.8279 8.17036 11.8266 8.24589C11.8252 8.32142 11.8087 8.3959 11.778 8.4649C11.7472 8.5339 11.7029 8.596 11.6476 8.6475L9.39761 10.8975C9.29215 11.0028 9.14918 11.062 9.00012 11.062C8.85105 11.062 8.70808 11.0028 8.60262 10.8975L6.35262 8.6475C6.29735 8.596 6.25302 8.5339 6.22228 8.4649C6.19154 8.3959 6.175 8.32142 6.17367 8.24589C6.17234 8.17036 6.18623 8.09534 6.21452 8.0253C6.24281 7.95526 6.28492 7.89164 6.33834 7.83822C6.39175 7.78481 6.45538 7.7427 6.52542 7.71441C6.59546 7.68612 6.67048 7.67222 6.74601 7.67356C6.82153 7.67489 6.89602 7.69142 6.96502 7.72216C7.03402 7.75291 7.09612 7.79723 7.14762 7.8525L8.43762 9.1425V3C8.43762 2.85082 8.49688 2.70774 8.60237 2.60225C8.70786 2.49676 8.85093 2.4375 9.00012 2.4375C9.1493 2.4375 9.29237 2.49676 9.39786 2.60225C9.50335 2.70774 9.56261 2.85082 9.56261 3V9.1425L10.8526 7.8525Z" fill="white" />
                                                <path d="M15.5625 9C15.5625 8.85082 15.5032 8.70774 15.3977 8.60225C15.2923 8.49676 15.1492 8.4375 15 8.4375C14.8508 8.4375 14.7077 8.49676 14.6023 8.60225C14.4968 8.70774 14.4375 8.85082 14.4375 9C14.4375 9.71406 14.2969 10.4211 14.0236 11.0808C13.7503 11.7405 13.3498 12.34 12.8449 12.8449C12.34 13.3498 11.7405 13.7503 11.0808 14.0236C10.4211 14.2969 9.71406 14.4375 9 14.4375C8.28594 14.4375 7.57887 14.2969 6.91916 14.0236C6.25945 13.7503 5.66003 13.3498 5.15511 12.8449C4.65019 12.34 4.24966 11.7405 3.9764 11.0808C3.70314 10.4211 3.5625 9.71406 3.5625 9C3.5625 8.85082 3.50324 8.70774 3.39775 8.60225C3.29226 8.49676 3.14918 8.4375 3 8.4375C2.85082 8.4375 2.70774 8.49676 2.60225 8.60225C2.49676 8.70774 2.4375 8.85082 2.4375 9C2.4375 10.7405 3.1289 12.4097 4.35961 13.6404C5.59032 14.8711 7.25952 15.5625 9 15.5625C10.7405 15.5625 12.4097 14.8711 13.6404 13.6404C14.8711 12.4097 15.5625 10.7405 15.5625 9Z" fill="white" />
                                            </svg>

                                        </div>

                                        <span class="button-text">Import Persons</span>


                                    </button>
                                </a>


                                <a href="../leads/create-lead.php">
                                    <button class="import-leads-button">
                                        <div class="icon-container">
                                            <svg
                                                width="15"
                                                height="16"
                                                viewBox="0 0 15 16"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="import-icon">
                                                <path
                                                    d="M9.04372 7.04375C9.08664 6.9977 9.13839 6.96076 9.19589 6.93514C9.25339 6.90952 9.31546 6.89574 9.3784 6.89463C9.44134 6.89352 9.50386 6.9051 9.56222 6.92867C9.62059 6.95225 9.67361 6.98734 9.71812 7.03185C9.76263 7.07636 9.79773 7.12938 9.8213 7.18775C9.84488 7.24612 9.85645 7.30864 9.85534 7.37158C9.85423 7.43452 9.84046 7.49659 9.81484 7.55409C9.78922 7.61159 9.75228 7.66334 9.70622 7.70625L7.83122 9.58125C7.74333 9.66903 7.62419 9.71834 7.49997 9.71834C7.37576 9.71834 7.25662 9.66903 7.16872 9.58125L5.29372 7.70625C5.24767 7.66334 5.21073 7.61159 5.18511 7.55409C5.15949 7.49659 5.14571 7.43452 5.1446 7.37158C5.14349 7.30864 5.15507 7.24612 5.17865 7.18775C5.20222 7.12938 5.23731 7.07636 5.28183 7.03185C5.32634 6.98734 5.37936 6.95225 5.43773 6.92867C5.49609 6.9051 5.55861 6.89352 5.62155 6.89463C5.68449 6.89574 5.74656 6.90952 5.80406 6.93514C5.86156 6.96076 5.91331 6.9977 5.95622 7.04375L7.03122 8.11875V3C7.03122 2.87568 7.08061 2.75645 7.16852 2.66854C7.25643 2.58064 7.37565 2.53125 7.49997 2.53125C7.62429 2.53125 7.74352 2.58064 7.83143 2.66854C7.91934 2.75645 7.96872 2.87568 7.96872 3V8.11875L9.04372 7.04375Z"
                                                    fill="white"></path>
                                                <path
                                                    d="M12.9688 8C12.9688 7.87568 12.9194 7.75645 12.8315 7.66854C12.7435 7.58064 12.6243 7.53125 12.5 7.53125C12.3757 7.53125 12.2565 7.58064 12.1685 7.66854C12.0806 7.75645 12.0312 7.87568 12.0312 8C12.0312 8.59505 11.914 9.18428 11.6863 9.73403C11.4586 10.2838 11.1248 10.7833 10.7041 11.2041C10.2833 11.6248 9.78379 11.9586 9.23403 12.1863C8.68428 12.414 8.09505 12.5312 7.5 12.5312C6.90495 12.5312 6.31572 12.414 5.76597 12.1863C5.21621 11.9586 4.71669 11.6248 4.29592 11.2041C3.87516 10.7833 3.54139 10.2838 3.31367 9.73403C3.08595 9.18428 2.96875 8.59505 2.96875 8C2.96875 7.87568 2.91936 7.75645 2.83146 7.66854C2.74355 7.58064 2.62432 7.53125 2.5 7.53125C2.37568 7.53125 2.25645 7.58064 2.16854 7.66854C2.08064 7.75645 2.03125 7.87568 2.03125 8C2.03125 9.4504 2.60742 10.8414 3.63301 11.867C4.6586 12.8926 6.0496 13.4688 7.5 13.4688C8.9504 13.4688 10.3414 12.8926 11.367 11.867C12.3926 10.8414 12.9688 9.4504 12.9688 8Z"
                                                    fill="white"></path>
                                            </svg>
                                        </div>

                                        <span class="button-text">New Person</span>


                                    </button>
                                </a>
                            </div> -->


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
                                                    name="name" value="{{ $person->name }}" required>
                                                @if ($errors->has('name'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                            <!-- <div class="col-12 col-md-4">
                                                        <label for="field2" class="form-label">Organization</label>
                                                        <input type="text" class="form-control" id="field2" placeholder="Organization">
                                                    </div> -->

                                            <div class="col-12 col-md-4">
                                                <label for="field3" class="form-label">Organization</label>
                                                <select class="myDropdown form-control" name="organization">
                                                    <option value="{{ $person->organization }}">
                                                        {{ Organization::where('id', $person->organization)->value('name') ?? '' }}
                                                    </option>
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
                                                    name="dob" value="{{ $person->dob }}" required>
                                                @if ($errors->has('dob'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('dob') }}</div>
                                                @endif
                                            </div>       
                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">Picture</label>
                                                <input type="file" class="form-control" id="Picture" name="picture" value="{{ old('picture') }}" required>
                                                @if ($errors->has('picture'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('picture') }}</div>
                                                @endif
                                            </div>             
                                            <div class="col-12 col-md-6">
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
                                                <div id="email-fields">
                                                    @foreach ($person->emails as $key => $email)
                                                        <div class="email-field">
                                                            <div class="d-flex align-items-center mt-2">
                                                                <input type="email" class="form-control" id="field4"
                                                                    placeholder="Emails" value="{{ $email['value'] }}"
                                                                    required>
                                                                <i class="fa-solid fa-trash delete-stage remove-append-item mx-2"
                                                                    onclick="removeEmailField(this)"></i>
                                                            </div>
                                                            <div class="d-flex align-items-center mt-2">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="email_types[{{ $key }}]"
                                                                        id="email-work-{{ $key }}"
                                                                        value="work"
                                                                        {{ $email['label'] == 'work' ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="email-work-{{ $key }}">{{ __('app.common.work') }}</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="email_types[{{ $key }}]"
                                                                        id="email-home-{{ $key }}"
                                                                        value="home"
                                                                        {{ $email['label'] == 'home' ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="email-home-{{ $key }}">{{ __('app.common.home') }}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                            <div class="col-12 col-md-6 ">
                                                <div class="d-flex align-items-center">
                                                    <label for="field4" class="form-label">Contact Numbers</label>
                                                    <div class="ms-3 mb-2">
                                                        <button class="btn add-more-button mx-1 p-0" id="add-emails"
                                                            onclick="addNumberField()" type="button">
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
                                                <div id="number-fields">
                                                    @foreach ($person->contact_numbers as $key => $contactNumber)
                                                        <div class="number-field">
                                                            <div class="d-flex align-items-center mt-2">
                                                                <input type="text" class="form-control" id="field4"
                                                                    placeholder="Contact Numbers" name="contact_numbers[]"
                                                                    value="{{ $contactNumber['value'] }}">
                                                                <i class="fa-solid fa-trash delete-stage remove-append-item mx-2"
                                                                    onclick="removeNumberField(this)"></i>
                                                            </div>

                                                            <div class="d-flex align-items-center mt-2">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="number_types[{{ $key }}]"
                                                                        id="number-work-{{ $key }}"
                                                                        value="work"
                                                                        {{ $contactNumber['label'] == 'work' ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="number-work-{{ $key }}">{{ __('app.common.work') }}</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="number_types[{{ $key }}]"
                                                                        id="number-home-{{ $key }}"
                                                                        value="home"
                                                                        {{ $contactNumber['label'] == 'home' ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="number-home-{{ $key }}">{{ __('app.common.home') }}</label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endforeach
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
                        <a href="{{ url('persons') }}"><button type="button" class="btn cancel-btn">Cancel</button></a>
                    </div>

                </div>

            </div>
        </div>
    </form>

    <!-- Bottom Action Buttons -->




    <script>
        let emailCounter = 1;
        let numberCounter = 1;


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


        function addNumberField() {
            const numberFieldsContainer = document.getElementById('number-fields');
            const numberField = document.createElement('div');
            numberField.classList.add('number-field');
            numberField.innerHTML = `
            <div class="d-flex align-items-center mt-2">
                 <input type="text" class="form-control" id="field4" placeholder="Contact Numbers" name="contact_numbers[]">
                <i class="fa-solid fa-trash delete-stage remove-append-item mx-2" onclick="removeNumberField(this)"></i>
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
            numberFieldsContainer.appendChild(numberField);
            numberCounter++;
        }

        function removeNumberField(element) {
            const numberField = element.closest('.number-field');
            numberField.remove();
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
