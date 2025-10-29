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
                                        {{ __('app.settings.roles.edit-title') }}
                                    </h3>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ url('settings') }}">Settings</a></li>
                                            <li class="breadcrumb-item"><a href="{{ url('roles') }}">
                                                    {{ __('app.settings.roles.title') }}</a></li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">
                                                {{ __('app.settings.roles.edit-title') }}</li>
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
                                                <label for="field1" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="field1" placeholder="Name"
                                                    name="name" value="{{ $role->name }}" required>
                                            </div>


                                            <div class="col-12 col-md-4">
                                                <label for="field3" class="form-label">Permission Type</label>





                                                <select class="myDropdown form-control" id="pipeline-select"
                                                    name="permission_type" required>
                                                    <option selected hidden value="{{ $role->permission_type }}">
                                                        {{ $role->permission_type }}</option>

                                                    <option value="all">All</option>
                                                    <option value="custom">Custom</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card card-default mb-4">

                                    <div class="card-body">

                                        <div class="row g-4">


                                            <div class="col-12 ">
                                                <label for="date_start" class="form-label">Description</label>
                                                <textarea class="form-control description-form-control" placeholder="Description" id="field5" rows="5"
                                                    name="description" required>{{ $role->description }}</textarea>
                                            </div>


                                            <div id="permission-container"></div>

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
                        <a href="{{ url('roles') }}"><button type="button" class="btn cancel-btn">Cancel</button></a>
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


            // $('#pipeline-select').on('change', function() {
            //     if ($(this).val() === 'custom') {
            //         $('#permissions-col').show();
            //     } else {
            //         $('#permissions-col').hide();
            //     }
            // });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Initial check on page load
            const initialPermissionType = $('#pipeline-select').val();
            if (initialPermissionType !== 'all') {
                $('#permissions-col').show();
            }

            // Handle change event
            $('#pipeline-select').on('change', function() {
                if ($(this).val() !== 'all') {
                    $('#permissions-col').show();
                } else {
                    $('#permissions-col').hide();
                }
            });
        });
    </script>
    <script>
        const permissions = [{

                // Leads
                label: "Leads",
                value: "leads",
                type: "checkbox",
                children: [{
                        label: "Create Lead",
                        value: "lead-create",
                        type: "checkbox",
                        children: [
                            {
                                label: "Create Any Leads",
                                value: "create-any-leads",
                                type: "radio",
                                group: "create-leads",
                            },
                            {
                                label: "Create Own Leads",
                                value: "create-own-leads",
                                type: "radio",
                                group: "create-leads"
                            }
                        ]
                    },
                    {
                        label: "View Lead",
                        value: "lead-view",
                        type: "checkbox",
                        children: [{
                                label: "View All Leads",
                                value: "lead-view-all",
                                type: "radio",
                                group: "lead-view-type"
                            },
                            {
                                label: "View Own Leads",
                                value: "lead-view-own",
                                type: "radio",
                                group: "lead-view-type"
                            }

                        ]
                    },

                    {
                        label: "Import Lead",
                        value: "lead-import",
                        type: "checkbox"
                    },

                    {
                        label: "Edit Lead",
                        value: "edit-lead",
                        type: "checkbox"
                    },

                    {
                        label: "Export Lead",
                        value: "lead-export",
                        type: "checkbox"
                    },
                    {
                        label: "Lead stage Change",
                        value: "lead-stage-change",
                        type: "checkbox"
                    },
                    {
                        label: "Lead Assignment to Own",
                        value: "lead-assignment",
                        type: "checkbox"
                    },
                    

                    {
                        label: "Delete lead",
                        value: "lead-delete",
                        type: "checkbox"
                    },
                    {
                        label: "Add Events",
                        value: "lead-events-add",
                        type: "checkbox",
                        children: [{
                                label: "Note",
                                value: "add-lead-note",
                                type: "checkbox",

                            },

                            {
                                label: "Activity",
                                value: "add-lead-activity",
                                type: "checkbox",

                            },

                            {
                                label: "Email",
                                value: "add-lead-email",
                                type: "checkbox",

                            },
                            {
                                label: "File",
                                value: "add-lead-file",
                                type: "checkbox",

                            },
                            {
                                label: "Quote",
                                value: "add-lead-quote",
                                type: "checkbox",

                            }
                        ]
                    },
                    {
                        label: "Show Events",
                        value: "lead-events-show",
                        type: "checkbox",
                        children: [{
                                label: "Note",
                                value: "show-lead-note",
                                type: "checkbox",

                            },

                            {
                                label: "Activity",
                                value: "show-lead-activity",
                                type: "checkbox",

                            },

                            {
                                label: "Email",
                                value: "show-lead-email",
                                type: "checkbox",

                            },
                            {
                                label: "File",
                                value: "show-lead-file",
                                type: "checkbox",

                            },
                            {
                                label: "Quote",
                                value: "show-lead-quote",
                                type: "checkbox",

                            },
                        ]
                    },

                    {
                        label: "Delete Events",
                        value: "lead-events-delete",
                        type: "checkbox",
                        children: [{
                                label: "Note",
                                value: "delete-lead-note",
                                type: "checkbox",

                            },

                            {
                                label: "Activity",
                                value: "delete-lead-activity",
                                type: "checkbox",

                            },

                            {
                                label: "Email",
                                value: "delete-lead-email",
                                type: "checkbox",

                            },
                            {
                                label: "File",
                                value: "delete-lead-file",
                                type: "checkbox",

                            },
                        ]
                    },

                ]
            },

            // Quotes
            {
                label: "Quotes",
                value: "quotes",
                type: "checkbox",
                children: [{
                        label: "Terms and condition / Logo add",
                        value: "terms-logo-add",
                        type: "checkbox"
                    },
                    {
                        label: "View Quotes",
                        value: "contact-quotes",
                        type: "checkbox",
                        children: [{
                                label: "View All Quotes",
                                value: "quotes-view-all",
                                type: "radio",
                                group: "quotes-view-type"
                            },

                            {
                                label: "View Own Quotes",
                                value: "quotes-view-own",
                                type: "radio",
                                group: "quotes-view-type"
                            },

                        ]
                    },

                    {
                        label: "Create Quotes",
                        value: "create-quotes",
                        type: "checkbox"
                    },

                    {
                        label: "Edit Quotes",
                        value: "edit-quotes",
                        type: "checkbox"
                    },

                    {
                        label: "Delete Quotes",
                        value: "delete-quotes",
                        type: "checkbox"
                    },

                ]
            },


            // Activities

            {
                label: "Activities",
                value: "activities",
                type: "checkbox",
                children: [{
                        label: "Show activities",
                        value: "show-activities",
                        type: "checkbox",
                        children: [{
                                label: "Show All Activities",
                                value: "show-all-activities",
                                type: "radio",
                                group: "show-activities"

                            },
                            {
                                label: "Show Own Activities",
                                value: "show-own-activities",
                                type: "radio",
                                group: "show-activities"

                            },


                        ]
                    },
                    {
                        label: "Delete activities",
                        value: "delete-activities",
                        type: "checkbox",
                    },
                    {
                        label: "Edit activities",
                        value: "edit-activities",
                        type: "checkbox",
                    },
                    {
                        label: "Export activities",
                        value: "export-activities",
                        type: "checkbox",
                    },
                ]
            },

            // organizations

            {
                label: "Organizations",
                value: "organizations",
                type: "checkbox",
                children: [{
                        label: "Show Organizations",
                        value: "show-organizations",
                        type: "checkbox",

                    },
                    {
                        label: "Edit Organizations",
                        value: "edit-organizations",
                        type: "checkbox",
                    },
                    {
                        label: "Create Organizations",
                        value: "create-organizations",
                        type: "checkbox",
                    },
                    {
                        label: "Delete Organizations",
                        value: "delete-organizations",
                        type: "checkbox",
                    },

                    {
                        label: "Export Organizations",
                        value: "export-organizations",
                        type: "checkbox",
                    },
                    {
                        label: "Import Organizations",
                        value: "import-organizations",
                        type: "checkbox",
                    },
                ]
            },





            // Persons
            {
                label: "Persons",
                value: "persons",
                type: "checkbox",
                children: [{
                        label: "Show Persons",
                        value: "show-persons",
                        type: "checkbox",

                    },
                    {
                        label: "Edit Persons",
                        value: "edit-persons",
                        type: "checkbox",
                    },
                    {
                        label: "Create Persons",
                        value: "create-persons",
                        type: "checkbox",
                    },
                    {
                        label: "Delete Persons",
                        value: "delete-persons",
                        type: "checkbox",
                    },

                    {
                        label: "Export Persons",
                        value: "export-persons",
                        type: "checkbox",
                    },
                    {
                        label: "Import Persons",
                        value: "import-persons",
                        type: "checkbox",
                    },
                ]
            },


            // products
            {
                label: "Products",
                value: "products",
                type: "checkbox",
                children: [{
                        label: "Show Products",
                        value: "show-products",
                        type: "checkbox",

                    },
                    {
                        label: "Edit Products",
                        value: "edit-products",
                        type: "checkbox",
                    },
                    {
                        label: "Create Products",
                        value: "create-products",
                        type: "checkbox",
                    },
                    {
                        label: "Delete Products",
                        value: "delete-products",
                        type: "checkbox",
                    },

                    {
                        label: "Export Products",
                        value: "export-products",
                        type: "checkbox",
                    },

                ]
            },


            // service

            {
                label: "Services",
                value: "services",
                type: "checkbox",
                children: [{
                        label: "Show Services",
                        value: "show-services",
                        type: "checkbox",

                    },
                    {
                        label: "Edit Services",
                        value: "edit-services",
                        type: "checkbox",
                    },
                    {
                        label: "Create Services",
                        value: "create-services",
                        type: "checkbox",
                    },
                    {
                        label: "Delete Services",
                        value: "delete-services",
                        type: "checkbox",
                    },

                    {
                        label: "Export Services",
                        value: "export-services",
                        type: "checkbox",
                    },

                ]
            },


            // Email templates
            {
                label: "Email Templates",
                value: "email-templates",
                type: "checkbox",
                children: [{
                        label: "Show Email Templates",
                        value: "show-email-templates",
                        type: "checkbox",

                    },
                    {
                        label: "Edit Email Templates",
                        value: "edit-email-templates",
                        type: "checkbox",
                    },
                    {
                        label: "Create Email Templates",
                        value: "create-email-templates",
                        type: "checkbox",
                    },
                    {
                        label: "Delete Email Templates",
                        value: "delete-email-templates",
                        type: "checkbox",
                    },



                ]
            },



            // mail

            {
                label: "Mails",
                value: "mails",
                type: "checkbox",
                children: [{
                        label: "Show Mails",
                        value: "show-mails",
                        type: "checkbox",
                        children: [

                            {
                                label: "Show All Mails",
                                value: "show-all-mails",
                                type: "radio",
                                group: 'show-mails-by-type'
                            },
                            {
                                label: "Show Own Mails",
                                value: "show-own-mails",
                                type: "radio",
                                group: 'show-mails-by-type'
                            },



                        ]

                    },

                    {
                        label: "Compose Mails",
                        value: "compose-mails",
                        type: "checkbox",
                    },

                    {
                        label: "Delete Mails",
                        value: "delete-mails",
                        type: "checkbox",
                    },
                ]
            },


            // Groups

            {
                label: "Groups",
                value: "groups",
                type: "checkbox",
                children: [{
                        label: "Show Groups",
                        value: "show-groups",
                        type: "checkbox",

                    },
                    {
                        label: "Edit Groups",
                        value: "edit-groups",
                        type: "checkbox",
                    },
                    {
                        label: "Create Groups",
                        value: "create-groups",
                        type: "checkbox",
                    },
                    {
                        label: "Delete Groups",
                        value: "delete-groups",
                        type: "checkbox",
                    },
                     {
                        label: "Export Groups",
                        value: "export-groups",
                        type: "checkbox",
                    },


                ]
            },


            // Roles

            {
                label: "Roles",
                value: "roles",
                type: "checkbox",
                children: [{
                        label: "Show Roles",
                        value: "show-roles",
                        type: "checkbox",

                    },
                    {
                        label: "Edit Roles",
                        value: "edit-roles",
                        type: "checkbox",
                    },
                    {
                        label: "Create Roles",
                        value: "create-roles",
                        type: "checkbox",
                    },
                    {
                        label: "Delete Roles",
                        value: "delete-roles",
                        type: "checkbox",
                    },

                    {
                        label: "Export Roles",
                        value: "export-roles",
                        type: "checkbox",
                    },

                ]
            },





            // users

            {
                label: "Users",
                value: "users",
                type: "checkbox",
                children: [{
                        label: "Show Users",
                        value: "show-users",
                        type: "checkbox",

                    },
                    {
                        label: "Edit Users",
                        value: "edit-users",
                        type: "checkbox",
                    },
                    {
                        label: "Create Users",
                        value: "create-users",
                        type: "checkbox",
                    },
                    {
                        label: "Delete Users",
                        value: "delete-users",
                        type: "checkbox",
                    },

                    {
                        label: "Export Users",
                        value: "export-users",
                        type: "checkbox",
                    },

                ]
            },



            // pipelines
            {
                label: "Pipelines",
                value: "pipelines",
                type: "checkbox",
                children: [{
                        label: "Show Pipelines",
                        value: "show-pipelines",
                        type: "checkbox",

                    },
                    {
                        label: "Edit Pipelines",
                        value: "edit-pipelines",
                        type: "checkbox",
                    },
                    {
                        label: "Create Pipelines",
                        value: "create-pipelines",
                        type: "checkbox",
                    },
                    {
                        label: "Delete Pipelines",
                        value: "delete-pipelines",
                        type: "checkbox",
                    },

                    {
                        label: "Export Pipelines",
                        value: "export-pipelines",
                        type: "checkbox",
                    },

                ]
            },


            // sources
            {
                label: "Sources",
                value: "sources",
                type: "checkbox",
                children: [{
                        label: "Show Sources",
                        value: "show-sources",
                        type: "checkbox",

                    },
                    {
                        label: "Edit Sources",
                        value: "edit-sources",
                        type: "checkbox",
                    },
                    {
                        label: "Create Sources",
                        value: "create-sources",
                        type: "checkbox",
                    },
                    {
                        label: "Delete Sources",
                        value: "delete-sources",
                        type: "checkbox",
                    },

                    {
                        label: "Export Sources",
                        value: "export-sources",
                        type: "checkbox",
                    },

                ]
            },


            // types
            {
                label: "Types",
                value: "types",
                type: "checkbox",
                children: [{
                        label: "Show Types",
                        value: "show-types",
                        type: "checkbox",

                    },
                    {
                        label: "Edit Types",
                        value: "edit-types",
                        type: "checkbox",
                    },
                    {
                        label: "Create Types",
                        value: "create-types",
                        type: "checkbox",
                    },
                    {
                        label: "Delete Types",
                        value: "delete-types",
                        type: "checkbox",
                    },

                    {
                        label: "Export Types",
                        value: "export-types",
                        type: "checkbox",
                    },

                ]
            },



            // attributes
            {
                label: "Attributes",
                value: "attributes",
                type: "checkbox",
                children: [{
                        label: "Show Attributes",
                        value: "show-attributes",
                        type: "checkbox",
                        children: [{
                                label: "All",
                                value: "show-attributes-all",
                                type: "checkbox",
                            },

                            {
                                label: "Leads",
                                value: "show-attributes-leads",
                                type: "checkbox",
                            },
                            {
                                label: "Persons",
                                value: "show-attributes-persons",
                                type: "checkbox",
                            },

                            {
                                label: "Organizations",
                                value: "show-attributes-organizations",
                                type: "checkbox",
                            },
                            {
                                label: "Quotes",
                                value: "show-attributes-quotes",
                                type: "checkbox",
                            },
                            {
                                label: "Products",
                                value: "show-attributes-products",
                                type: "checkbox",
                            },
                        ]
                    },
                    {
                        label: "Edit Attributes",
                        value: "edit-attributes",
                        type: "checkbox",
                    },
                    {
                        label: "Create Attributes",
                        value: "create-attributes",
                        type: "checkbox",
                    },
                    {
                        label: "Delete Attributes",
                        value: "delete-attributes",
                        type: "checkbox",
                    },

                    {
                        label: "Export Attributes",
                        value: "export-attributes",
                        type: "checkbox",
                    },

                ]
            },



            // Web forms
            {
                label: "Web forms",
                value: "web-forms",
                type: "checkbox",
                children: [{
                        label: "Show Web forms",
                        value: "show-web-forms",
                        type: "checkbox",
                    },
                    {
                        label: "View Web forms",
                        value: "view-web-forms",
                        type: "checkbox",
                    },
                    {
                        label: "Edit Web forms",
                        value: "edit-web-forms",
                        type: "checkbox",
                    },
                    {
                        label: "Create Web forms",
                        value: "create-web-forms",
                        type: "checkbox",
                    },
                    {
                        label: "Delete Web forms",
                        value: "delete-web-forms",
                        type: "checkbox",
                    },
                    {
                        label: "Show Embeded Details",
                        value: "show-embeded-details",
                        type: "checkbox",
                    },
                    {
                        label: "Preview Web Forms",
                        value: "preview-web-forms",
                        type: "checkbox",
                    },
                ]
            },

        ];

        // Check if item has radio children
        function hasRadioChildren(item) {
    return item.children && item.children.some(child => child.type === 'radio');
}

function generateId(value) {
    return value.replace(/[^a-zA-Z0-9]/g, '_');
}

function renderPermission(item, level = 0, parentValue = null) {
    const indentClass = level === 1 ? 'mx-3' : level === 2 ? 'mx-5' : level === 3 ? 'mx-5' : '';
    const isRadio = item.type === 'radio';
    const inputType = isRadio ? 'radio' : 'checkbox';
    const name = isRadio ? item.group : 'permissions[]';
    const id = generateId(item.value);

    let html = `
        <div class="col-md-3">
            <div class="form-check mb-3 ${indentClass}">
                <input class="form-check-input" 
                    type="${inputType}" 
                    id="${id}" 
                    value="${item.value}" 
                    name="${name}"
                    data-value="${item.value}"
                    ${item.type === 'checkbox' && item.children ? `data-group="${item.value}"` : ''}
                    ${parentValue ? `data-parent="${parentValue}"` : ''}
                    ${hasRadioChildren(item) ? 'data-has-radio-children="true"' : ''}>
                <label class="form-check-label" for="${id}">
                    ${item.label}
                </label>
            </div>
        </div>`;

    if (item.children && item.children.length > 0) {
        item.children.forEach(child => {
            html += renderPermission(child, level + 1, item.value);
        });
    }

    return html;
}

function renderPermissionFromBackend() {
    const backendPermissions = @json($role->permissions ?? []);
    const permissionType = '{{ $role->permission_type }}';

    console.log('Backend Permissions:', backendPermissions);
    console.log('Permission Type:', permissionType);

    $('#pipeline-select').val(permissionType).trigger('change.select2');

    if (permissionType === 'all') {
        handlePermissionTypeChange('all');
        console.log('All permissions mode activated');
        return;
    }

    handlePermissionTypeChange('custom');

    setTimeout(() => {
        let checkedCount = 0;
        let notFoundCount = 0;

        backendPermissions.forEach(permission => {
            const input = document.querySelector(`[data-value="${permission}"]`);

            if (!input) {
                console.warn('❌ Permission input not found:', permission);
                notFoundCount++;
                return;
            }

            if (input.type === 'checkbox') {
                input.checked = true;
                checkedCount++;
                console.log('✅ Checked checkbox:', permission);
                handleCheckboxChange(input);
            } else if (input.type === 'radio') {
                input.checked = true;
                input.disabled = false;
                checkedCount++;
                console.log('✅ Selected radio:', permission);
                handleRadioChange(input);
            }
        });

        console.log(`✅ Successfully restored ${checkedCount} permissions`);
        if (notFoundCount > 0) {
            console.warn(`⚠️ ${notFoundCount} permissions not found in UI`);
        }
    }, 250);
}

function renderAllPermissions() {
    const container = document.getElementById('permission-container');
    if (!container) {
        console.error('Permission container not found');
        return;
    }

    let html = '';
    permissions.forEach(permission => {
        html += renderPermission(permission);
    });
    container.innerHTML = html;
    attachEventListeners();
    initPermissionTypeDropdown();
}

function getChildInputs(parentValue) {
    return document.querySelectorAll(`[data-parent="${parentValue}"]`);
}

function getParentInput(childInput) {
    const parentValue = childInput.getAttribute('data-parent');
    if (!parentValue) return null;
    return document.querySelector(`[data-value="${parentValue}"]`);
}

function handleCheckboxChange(checkbox) {
    if (checkbox.disabled) return;

    if (checkbox.checked) {
        const children = getChildInputs(checkbox.dataset.value);
        children.forEach(child => {
            if (child.type === 'checkbox') {
                child.checked = true;
                handleCheckboxChange(child);
            } else if (child.type === 'radio') {
                child.disabled = false;
            }
        });

        if (checkbox.dataset.hasRadioChildren) {
            const radios = Array.from(children).filter(c => c.type === 'radio');
            if (radios.length > 0 && !radios.some(r => r.checked)) {
                radios[0].checked = true;
            }
        }

        const parent = getParentInput(checkbox);
        if (parent && parent.type === 'checkbox' && !parent.checked && !parent.disabled) {
            parent.checked = true;
            handleCheckboxChange(parent);
        }
    } else {
        const children = getChildInputs(checkbox.dataset.value);
        children.forEach(child => {
            if (child.type === 'checkbox') {
                child.checked = false;
                handleCheckboxChange(child);
            } else if (child.type === 'radio') {
                child.checked = false;
                child.disabled = true;
            }
        });

        const parent = getParentInput(checkbox);
        if (parent && parent.type === 'checkbox' && !parent.disabled) {
            const siblings = getChildInputs(parent.dataset.value);
            const anyChecked = Array.from(siblings).some(s =>
                s.type === 'checkbox' && s.checked
            );
            if (!anyChecked) {
                parent.checked = false;
                handleCheckboxChange(parent);
            }
        }
    }
}

function handleRadioChange(radio) {
    const parent = getParentInput(radio);
    if (parent && parent.type === 'checkbox' && !parent.checked) {
        parent.checked = true;
        handleCheckboxChange(parent);
    }
}

function attachEventListeners() {
    document.querySelectorAll('#permission-container input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            handleCheckboxChange(this);
        });
    });

    document.querySelectorAll('#permission-container input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            handleRadioChange(this);
        });
        radio.disabled = true;
    });
}

function handlePermissionTypeChange(value) {
    const allCheckboxes = document.querySelectorAll('#permission-container input[type="checkbox"]');
    const allRadios = document.querySelectorAll('#permission-container input[type="radio"]');

    console.log('Handling permission type:', value);
    console.log('Found checkboxes:', allCheckboxes.length);
    console.log('Found radios:', allRadios.length);

    if (value === 'all') {
        allCheckboxes.forEach(checkbox => {
            checkbox.checked = true;
            checkbox.disabled = true;
        });

        const radioGroups = {};
        allRadios.forEach(radio => {
            const group = radio.name;
            if (!radioGroups[group]) {
                radioGroups[group] = [];
            }
            radioGroups[group].push(radio);
        });

        Object.values(radioGroups).forEach(radios => {
            radios.forEach((radio, index) => {
                radio.disabled = true;
                radio.checked = index === 0;
            });
        });

        console.log('All permissions enabled and disabled');
    } else {
        allCheckboxes.forEach(checkbox => {
            checkbox.disabled = false;
            checkbox.checked = false;
        });

        allRadios.forEach(radio => {
            radio.disabled = true;
            radio.checked = false;
        });

        console.log('Custom mode - all permissions cleared and enabled');
    }
}

function initPermissionTypeDropdown() {
    const dropdown = document.getElementById('pipeline-select');
    if (!dropdown) {
        console.error('Permission type dropdown not found');
        return;
    }

    $('#pipeline-select').on('select2:select', function(e) {
        console.log('Select2 dropdown changed to:', this.value);
        handlePermissionTypeChange(this.value);
    });

    $('#pipeline-select').on('change', function() {
        console.log('Dropdown changed to:', this.value);
        handlePermissionTypeChange(this.value);
    });

    handlePermissionTypeChange(dropdown.value);
}

function collectPermissions() {
    const result = [];
    const permissionType = document.getElementById('pipeline-select');
    const isAllPermissions = permissionType && permissionType.value === 'all';

    if (isAllPermissions) {
        const allCheckboxes = document.querySelectorAll('#permission-container input[type="checkbox"]');
        allCheckboxes.forEach(checkbox => {
            if (!checkbox.dataset.hasRadioChildren) {
                result.push(checkbox.value);
            }
        });

        const allRadios = document.querySelectorAll('#permission-container input[type="radio"]:checked');
        allRadios.forEach(radio => {
            result.push(radio.value);
        });

        return result;
    }

    const checkboxes = document.querySelectorAll('#permission-container input[type="checkbox"]:checked');
    const radioParentValues = new Set();
    const radios = document.querySelectorAll('#permission-container input[type="radio"]:checked');
    
    radios.forEach(radio => {
        const parentValue = radio.getAttribute('data-parent');
        if (parentValue) {
            radioParentValues.add(parentValue);
        }
    });

    checkboxes.forEach(checkbox => {
        if (checkbox.dataset.hasRadioChildren) {
            return;
        }
        if (radioParentValues.has(checkbox.value)) {
            return;
        }
        result.push(checkbox.value);
    });

    radios.forEach(radio => {
        result.push(radio.value);
    });

    return result;
}

// FIXED: This is the corrected function
function updatePermissionsBeforeSubmit(form) {
    console.log('Preparing permissions for submission...');
    
    // Remove all existing hidden permission inputs
    form.querySelectorAll('input[name="permissions[]"][type="hidden"]').forEach(input => {
        input.remove();
    });

    // ALWAYS disable visible inputs to prevent them from submitting
    // Disable checkboxes
    form.querySelectorAll('#permission-container input[type="checkbox"]').forEach(input => {
        input.disabled = true;
    });
    
    // Disable radios
    form.querySelectorAll('#permission-container input[type="radio"]').forEach(input => {
        input.disabled = true;
    });

    // Get collected permissions
    const selectedPermissions = collectPermissions();
    console.log('Collected permissions:', selectedPermissions);

    // Create hidden inputs for each permission
    selectedPermissions.forEach(permission => {
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'permissions[]';
        hiddenInput.value = permission;
        form.appendChild(hiddenInput);
    });
    
    console.log('Added', selectedPermissions.length, 'hidden permission inputs');
}

document.addEventListener('DOMContentLoaded', function() {
    renderAllPermissions();

    setTimeout(() => {
        renderPermissionFromBackend();
    }, 400);

    const permissionContainer = document.getElementById('permission-container');
    if (permissionContainer) {
        const form = permissionContainer.closest('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                updatePermissionsBeforeSubmit(this);
            });
        }
    }
});

window.getPermissions = collectPermissions;
window.renderPermissionFromBackend = renderPermissionFromBackend;
    </script>
@endsection
