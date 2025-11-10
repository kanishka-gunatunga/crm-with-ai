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
                                        {{ __('app.settings.email-templates.edit-title') }}
                                    </h3>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#">Settings</a></li>
                                            <li class="breadcrumb-item"><a
                                                    href="#">{{ __('app.settings.email-templates.title') }}</a></li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">
                                                {{ __('app.settings.email-templates.edit-title') }}</li>
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
                                            <div class="col-12 col-md-4 ">
                                                <label for="field1"
                                                    class="form-label">{{ __('app.settings.email-templates.name') }}</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ $template->name }}" required>
                                                @if ($errors->has('name'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-12 col-md-8">
                                                <label for="exampleFormControlTextarea5"
                                                    class="form-label">{{ __('app.settings.email-templates.subject') }}</label>
                                                <div class="input-group">

                                                    <select class=" form-control" name="template_tags-dropdown"
                                                        id="template-tags-dropdown">
                                                        <optgroup label="Leads">
                                                            <option value="{%leads.title%}">
                                                                Title
                                                            </option>
                                                            <option value="{%leads.lead_value%}">
                                                                Lead Value
                                                            </option>
                                                            <option value="{%leads.lead_source_id%}">
                                                                Source
                                                            </option>
                                                            <option value="{%leads.lead_type_id%}">
                                                                Type
                                                            </option>
                                                            <option value="{%leads.user_id%}">
                                                                Sales Owner
                                                            </option>
                                                            <option value="{%leads.expected_close_date%}">
                                                                Expected Close Date
                                                            </option>
                                                            <option value="{%leads.lead_pipeline_stage_id%}">
                                                                Stage
                                                            </option>
                                                        </optgroup>
                                                        <optgroup label="Activities">
                                                            <option value="{%activities.title%}">
                                                                Title
                                                            </option>
                                                            <option value="{%activities.type%}">
                                                                Type
                                                            </option>
                                                            <option value="{%activities.location%}">
                                                                Location
                                                            </option>
                                                            <option value="{%activities.comment%}">
                                                                Comment
                                                            </option>
                                                            <option value="{%activities.schedule_from%}">
                                                                Schedule From
                                                            </option>
                                                            <option value="{%activities.schedule_to%}">
                                                                Schedule To
                                                            </option>
                                                            <option value="{%activities.user_id%}">
                                                                User
                                                            </option>
                                                            <option value="{%activities.participants%}">
                                                                Participants
                                                            </option>
                                                        </optgroup>
                                                        <optgroup label="Persons">
                                                            <option value="{%persons.name%}">
                                                                Name
                                                            </option>
                                                            <option value="{%persons.emails%}">
                                                                Emails
                                                            </option>
                                                            <option value="{%persons.contact_numbers%}">
                                                                Contact Numbers
                                                            </option>
                                                            <option value="{%persons.organization_id%}">
                                                                Organization
                                                            </option>
                                                        </optgroup>
                                                        <optgroup label="Quotes">
                                                            <option value="{%quotes.user_id%}">
                                                                Sales Owner
                                                            </option>
                                                            <option value="{%quotes.subject%}">
                                                                Subject
                                                            </option>
                                                            <option value="{%quotes.discount_percent%}">
                                                                Discount Percent
                                                            </option>
                                                            <option value="{%quotes.discount_amount%}">
                                                                Discount Amount
                                                            </option>
                                                            <option value="{%quotes.tax_amount%}">
                                                                Tax Amount
                                                            </option>
                                                            <option value="{%quotes.adjustment_amount%}">
                                                                Adjustment Amount
                                                            </option>
                                                            <option value="{%quotes.sub_total%}">
                                                                Sub Total
                                                            </option>
                                                            <option value="{%quotes.grand_total%}">
                                                                Grand Total
                                                            </option>
                                                            <option value="{%quotes.expired_at%}">
                                                                Expired At
                                                            </option>
                                                            <option value="{%quotes.person_id%}">
                                                                Person
                                                            </option>
                                                        </optgroup>
                                                    </select>

                                                    <input type="text" class="form-control" id="email-subject"
                                                        name="subject" placeholder="Enter email subject"
                                                        value="{{ $template->subject }}" required>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="card card-default mb-4">

                                    <div class="card-body">

                                        <div class="row g-4">


                                            <div class="col-12 ">
                                                <label for="summernote"
                                                    class="form-label">{{ __('app.settings.email-templates.content') }}</label>
                                                <textarea class="form-control w-100" id="summernote" rows="12" name="content" required><?php echo $template->content; ?></textarea>
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
                        <a href="{{ url('email-templates') }}"><button type="button"
                                class="btn cancel-btn">Cancel</button></a>
                    </div>

                </div>

            </div>
        </div>
    </form>


    <script>
        $(document).ready(function() {
            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @endif

            @if (Session::has('fail'))
                toastr.error("{{ Session::get('fail') }}");
            @endif
        });
        $('#summernote').summernote({
            placeholder: 'Type....',
            tabsize: 2,
            height: 250,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['custom', ['templateTag']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            buttons: {
                templateTag: function(context) {
                    const ui = $.summernote.ui;

                    const tagOptions = [
                        // Leads
                        {
                            label: 'Leads - Title',
                            value: '{%leads.title%}'
                        },
                        {
                            label: 'Leads - Lead Value',
                            value: '{%leads.lead_value%}'
                        },
                        {
                            label: 'Leads - Source',
                            value: '{%leads.lead_source_id%}'
                        },
                        {
                            label: 'Leads - Type',
                            value: '{%leads.lead_type_id%}'
                        },
                        {
                            label: 'Leads - Sales Owner',
                            value: '{%leads.user_id%}'
                        },
                        {
                            label: 'Leads - Expected Close Date',
                            value: '{%leads.expected_close_date%}'
                        },
                        {
                            label: 'Leads - Stage',
                            value: '{%leads.lead_pipeline_stage_id%}'
                        },

                        // Activities
                        {
                            label: 'Activities - Title',
                            value: '{%activities.title%}'
                        },
                        {
                            label: 'Activities - Type',
                            value: '{%activities.type%}'
                        },
                        {
                            label: 'Activities - Location',
                            value: '{%activities.location%}'
                        },
                        {
                            label: 'Activities - Comment',
                            value: '{%activities.comment%}'
                        },
                        {
                            label: 'Activities - Schedule From',
                            value: '{%activities.schedule_from%}'
                        },
                        {
                            label: 'Activities - Schedule To',
                            value: '{%activities.schedule_to%}'
                        },
                        {
                            label: 'Activities - User',
                            value: '{%activities.user_id%}'
                        },
                        {
                            label: 'Activities - Participants',
                            value: '{%activities.participants%}'
                        },

                        // Persons
                        {
                            label: 'Persons - Name',
                            value: '{%persons.name%}'
                        },
                        {
                            label: 'Persons - Emails',
                            value: '{%persons.emails%}'
                        },
                        {
                            label: 'Persons - Contact Numbers',
                            value: '{%persons.contact_numbers%}'
                        },
                        {
                            label: 'Persons - Organization',
                            value: '{%persons.organization_id%}'
                        },

                        // Quotes
                        {
                            label: 'Quotes - Sales Owner',
                            value: '{%quotes.user_id%}'
                        },
                        {
                            label: 'Quotes - Subject',
                            value: '{%quotes.subject%}'
                        },
                        {
                            label: 'Quotes - Discount Percent',
                            value: '{%quotes.discount_percent%}'
                        },
                        {
                            label: 'Quotes - Discount Amount',
                            value: '{%quotes.discount_amount%}'
                        },
                        {
                            label: 'Quotes - Tax Amount',
                            value: '{%quotes.tax_amount%}'
                        },
                        {
                            label: 'Quotes - Adjustment Amount',
                            value: '{%quotes.adjustment_amount%}'
                        },
                        {
                            label: 'Quotes - Sub Total',
                            value: '{%quotes.sub_total%}'
                        },
                        {
                            label: 'Quotes - Grand Total',
                            value: '{%quotes.grand_total%}'
                        },
                        {
                            label: 'Quotes - Expired At',
                            value: '{%quotes.expired_at%}'
                        },
                        {
                            label: 'Quotes - Person',
                            value: '{%quotes.person_id%}'
                        },
                    ];


                    // Create dropdown items
                    const itemList = tagOptions.map(tag => tag.label);

                    return ui.buttonGroup([
                        ui.button({
                            className: 'dropdown-toggle placeholder-btn',
                            contents: 'Placeholders <span class="caret"></span>',
                            tooltip: 'Insert a template tag',
                            data: {
                                toggle: 'dropdown'
                            }
                        }),
                        ui.dropdown({
                            className: 'dropdown-style placeholder-dropdown-menu',
                            items: itemList,
                            click: function(e) {
                                const label = $(e.target).text();
                                const selected = tagOptions.find(tag => tag.label === label);
                                if (selected) {
                                    context.invoke('editor.insertText', selected.value);
                                }
                            }
                        })
                    ]).render();
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            const subjectInput = document.getElementById('email-subject');

            // Initialize Select2
            $('#template-tags-dropdown').select2({
                allowClear: true,
                placeholder: 'Select a placeholder tag',
                allowClear: true,

            });

            // When a tag is selected
            $('#template-tags-dropdown').on('select2:select', function(e) {
                const selectedValue = e.params.data.id;

                if (!selectedValue) return;

                const cursorPos = subjectInput.selectionStart;
                const oldValue = subjectInput.value;
                const newValue =
                    oldValue.substring(0, cursorPos) +
                    selectedValue +
                    oldValue.substring(cursorPos);

                subjectInput.value = newValue;

                // Deselect selected item so dropdown remains usable
                setTimeout(() => {
                    $(this).val(null).trigger('change');
                    subjectInput.focus();
                    subjectInput.setSelectionRange(
                        cursorPos + selectedValue.length,
                        cursorPos + selectedValue.length
                    );
                }, 0);
            });
        });
    </script>
@endsection
