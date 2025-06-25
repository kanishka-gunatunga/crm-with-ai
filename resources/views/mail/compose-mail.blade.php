@extends('master')

@section('content')
    <form action="{{ url('compose-email') }}" method="post" enctype="multipart/form-data" data-parsley-validate>
        @csrf
        <!-- Scrollable Content -->
        <div class="main-scrollable">
            <div class="page-container">
                <div class="page-title-container">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h3 class="page-title">
                                Compose Mail
                            </h3>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('emails') }}">Mail</a></li>
                                    <li class="breadcrumb-item active current-breadcrumb" aria-current="page">Compose mail
                                    </li>
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
                                    <div class="col-12 col-md-4 ">
                                        <label for="field1" class="form-label">{{ __('app.leads.to') }}</label>
                                        <div class="position-relative">
                                            <select class="form-control tagselectemail" name="to[]"
                                                                 multiple="multiple"></select>
                                            <button type="button"
                                                class="position-absolute email-sending-option-btn CC cc-toggle">{{ __('app.leads.cc') }}</button>
                                            <button type="button"
                                                class="position-absolute email-sending-option-btn BCC bcc-toggle">{{ __('app.leads.bcc') }}</button>
                                        </div>
                                    @if ($errors->has('to')) <div class="alert alert-danger mt-2"> {{ $errors->first('to') }} </div>  @endif
                                    </div>
                                    {{-- <div class="col-md-4 mb-3">
                                                    <label for="firstNameinput" class="form-label">ggg</label>
                                                    <select class="form-control tagselect" name="cc[]"
                                                        multiple="multiple"></select>
                                                </div> --}}



                                    <div class="col-md-4 mb-3 cc-input d-none">

                                        <label for="firstNameinput" class="form-label">{{ __('app.leads.cc') }}</label>

                                      <select class="form-control tagselectemail" name="cc[]"
                                                                 multiple="multiple"></select>
                                    </div>
                                    <div class="col-md-4 mb-3 bcc-input d-none">
                                        <label for="firstNameinput" class="form-label">{{ __('app.leads.bcc') }}</label>
                                        <select class="form-control tagselectemail" name="bcc[]"
                                                                 multiple="multiple"></select>
                                    </div>


                                    <div class="col-12 col-md-4">
                                        <label for="field1" class="form-label">{{ __('app.leads.subject') }}</label>
                                        <input type="text" class="form-control" id="field1" name="subject"
                                            placeholder="Subject">
                                            @if ($errors->has('subject')) <div class="alert alert-danger mt-2"> {{ $errors->first('subject') }} </div>  @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card card-default mt-3">
                            <div class="card-body">
                                <div class="col-10">
                                    <label for="field5" class="form-label">{{ __('app.leads.description') }}</label>

                                    <textarea class="summernoteNormal" id="summernote" name="body"></textarea>
                                    {{-- <div id="froala-editor" rows="5"
                                                        name="body" required></div> --}}
                                                        @if ($errors->has('body')) <div class="alert alert-danger mt-2"> {{ $errors->first('body') }} </div>  @endif
                                </div>


                                <div class="col-10 mt-3">
                                    <label for="firstNameinput"
                                        class="form-label">{{ __('app.datagrid.attachments') }}</label>
                                    <input class="form-control" type="file" id="formFile" name="attchments[]" multiple>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- Bottom Action Buttons -->
        <div class="col-12 action-bar">
            <div class="d-flex gap-2 justify-content-between">
                <div>
                    <a href=""><button type="button" class="btn clear-all-btn">Clear All</button></a>
                </div>
                <div>
                    <button type="submit" class="btn save-btn">Save</button>
                     <a href="{{ url('emails') }}"><button type="button" class="btn cancel-btn">Cancel</button></a>
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
        document.querySelectorAll('.email-item').forEach(item => {
            item.addEventListener('click', () => {
                const data = JSON.parse(item.dataset.email);

                const parseList = str => {
                    try {
                        return JSON.parse(str);
                    } catch (e) {
                        return [str]; // fallback if it's just a string
                    }
                };

                document.getElementById('email-to').textContent = parseList(data.to).join(', ');
                document.getElementById('email-cc').textContent = parseList(data.cc).join(', ');
                document.getElementById('email-bcc').textContent = parseList(data.bcc).join(', ');
                document.getElementById('email-subject').textContent = data.subject;
                document.getElementById('email-date').textContent = new Date(data.created_at)
                    .toLocaleString();
                document.getElementById('email-body').innerHTML = data.body;

                // Attachments

                const attachments = parseList(data.attachments);
                const baseUrl = "{{ asset('uploads/leads/email_attachments') }}";

                const attachmentList = document.getElementById('email-attachments');
                attachmentList.innerHTML = '';

                attachments.forEach(file => {
                    const li = document.createElement('li');
                    li.innerHTML = `<a href="${baseUrl}/${file}" target="_blank">${file}</a>`;
                    attachmentList.appendChild(li);
                });
            });
        });
    </script>
    <script>
        $('#body').summernote({
            tabsize: 2,
            height: 200
        });
        document.addEventListener("DOMContentLoaded", function() {


            const ccButton = document.querySelector(".cc-toggle");
            const bccButton = document.querySelector(".bcc-toggle");


            const ccInputDiv = document.querySelector("input[name='cc[]']").closest('.col-md-12');
            const bccInputDiv = document.querySelector("input[name='bcc[]']").closest('.col-md-12');

            ccInputDiv.style.display = "none";
            bccInputDiv.style.display = "none";


            if (ccButton) {
                ccButton.addEventListener("click", function() {
                    ccInputDiv.style.display = ccInputDiv.style.display === "none" ? "block" : "none";
                });
            }


            if (bccButton) {
                bccButton.addEventListener("click", function() {
                    bccInputDiv.style.display = bccInputDiv.style.display === "none" ? "block" : "none";
                });
            }
        });
    </script>
    <script>
        const ccButton = document.querySelector(".cc-toggle");
        const bccButton = document.querySelector(".bcc-toggle");

        if (ccButton) {
            ccButton.addEventListener("click", function() {
                const ccInputDiv = document.querySelector(".cc-input");
                ccInputDiv.classList.toggle("d-none");
            });
        }

        if (bccButton) {
            bccButton.addEventListener("click", function() {
                const bccInputDiv = document.querySelector(".bcc-input");
                bccInputDiv.classList.toggle("d-none");
            });
        }


        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.cancel-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const defaultTabTrigger = document.querySelector('#default-tab-tab');
                    if (defaultTabTrigger) {
                        const tab = new bootstrap.Tab(defaultTabTrigger);
                        tab.show();
                    }
                });
            });
        });
        let toChoices, ccChoices, bccChoices;

        const initChoices = () => {
            if (toChoices) toChoices.destroy();
            if (ccChoices) ccChoices.destroy();
            if (bccChoices) bccChoices.destroy();

            document.querySelectorAll('[data-choices]').forEach((el) => {
                const name = el.getAttribute("name");

                const instance = new Choices(el, {
                    removeItemButton: true,
                    duplicateItemsAllowed: false,
                });

                if (name === "to[]") toChoices = instance;
                if (name === "cc[]") ccChoices = instance;
                if (name === "bcc[]") bccChoices = instance;
            });
        };

        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('composemodal');
            modal.addEventListener('shown.bs.modal', function() {
                initChoices();
            });
        });
    </script>

    <script>
        $('.tagselectemail').select2({
    tags: true,
    tokenSeparators: [',', ' '],
    createTag: function (params) {
        var term = $.trim(params.term);

        // Simple email validation regex
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (emailRegex.test(term)) {
            return {
                id: term,
                text: term,
                newTag: true
            };
        }

        // Don't create the tag if not a valid email
        return null;
    },
    insertTag: function (data, tag) {
        // Only insert the tag if it's not null
        if (tag) {
            data.push(tag);
        }
    }
});


    </script>
@endsection
