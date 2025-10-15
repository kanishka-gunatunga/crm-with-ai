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
                                        {{ __('app.settings.roles.create-title') }}
                                    </h3>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ url('settings') }}">Settings</a></li>
                                            <li class="breadcrumb-item"><a href="{{ url('roles') }}">
                                                    {{ __('app.settings.roles.title') }}</a></li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">
                                                {{ __('app.settings.roles.create-title') }}</li>
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
                                                    name="name" value="{{ old('name') }}" required>
                                            </div>


                                            <div class="col-12 col-md-4">
                                                <label for="field3" class="form-label">Permission Type</label>

                                                <select class="myDropdown form-control" id="pipeline-select"
                                                    name="permission_type" required>
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
                                                    name="description" required></textarea>
                                            </div>

                                            <div id="permission-container"></div>




                                            {{-- <div class="col-md-12" style="display:none;" id="permissions-col">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox" id="dashboard"
                                                                value="dashboard" name="permissions[]">
                                                            <label class="form-check-label" for="dashboard">
                                                                Dashboard
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox" id="Leads"
                                                                data-group="leads" value="leads" name="permissions[]">
                                                            <label class="form-check-label" for="Leads">
                                                                Leads
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox" id="leadCreate"
                                                                value="lead-create" name="permissions[]"
                                                                data-parent="leads">
                                                            <label class="form-check-label" for="leadCreate">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox" id="leadView"
                                                                value="lead-view" name="permissions[]" data-parent="leads">
                                                            <label class="form-check-label" for="leadView">
                                                                View
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox" id="leadEdit"
                                                                value="lead-edit" name="permissions[]" data-parent="leads">
                                                            <label class="form-check-label" for="leadEdit">
                                                                Edit
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="leadDelete" value="lead-delete" name="permissions[]"
                                                                data-parent="leads">
                                                            <label class="form-check-label" for="leadDelete">
                                                                Delete
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Quotes" data-group="quotes" value="quotes"
                                                                name="permissions[]">
                                                            <label class="form-check-label" for="Quotes">
                                                                Quotes
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="QuotesCreate" value="quote-create"
                                                                name="permissions[]" data-parent="quotes">
                                                            <label class="form-check-label" for="QuotesCreate">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="QuotesEdit" value="quote-edit" name="permissions[]"
                                                                data-parent="quotes">
                                                            <label class="form-check-label" for="QuotesEdit">
                                                                Edit
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="QuotesDelete" value="quote-delete"
                                                                name="permissions[]" data-parent="quotes">
                                                            <label class="form-check-label" for="QuotesDelete">
                                                                Delete
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Activities" data-group="activities"
                                                                value="activities" name="permissions[]">
                                                            <label class="form-check-label" for="Activities">
                                                                Activities
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="ActivitiesCreate" value="activity-create"
                                                                name="permissions[]" data-parent="activities">
                                                            <label class="form-check-label" for="ActivitiesCreate">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="ActivitiesEdit" value="activity-edit"
                                                                name="permissions[]" data-parent="activities">
                                                            <label class="form-check-label" for="ActivitiesEdit">
                                                                Edit
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="ActivitiesDelete" value="activity-delete"
                                                                name="permissions[]" data-parent="activities">
                                                            <label class="form-check-label" for="ActivitiesDelete">
                                                                Delete
                                                            </label>
                                                        </div>

                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Contacts" data-group="contacts" value="contacts"
                                                                name="permissions[]">
                                                            <label class="form-check-label" for="Contacts">
                                                                Contacts
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3  mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Persons" data-group="persons"
                                                                data-parent="contacts" value="persons"
                                                                name="permissions[]">
                                                            <label class="form-check-label" for="Persons">
                                                                Persons
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="PersonsCreate" value="person-create"
                                                                name="permissions[]" data-parent="persons">
                                                            <label class="form-check-label" for="PersonsCreate">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="PersonsEdit" value="person-edit" name="permissions[]"
                                                                data-parent="persons">
                                                            <label class="form-check-label" for="PersonsEdit">
                                                                Edit
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="PersonsDelete" value="person-delete"
                                                                name="permissions[]" data-parent="persons">
                                                            <label class="form-check-label" for="PersonsDelete">
                                                                Delete
                                                            </label>
                                                        </div>

                                                        <div class="form-check mb-3  mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Organizations" data-group="organizations"
                                                                data-parent="contacts" value="organizations"
                                                                name="permissions[]">
                                                            <label class="form-check-label" for="Organizations">
                                                                Organizations
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="OrganizationsCreate" value="organization-create"
                                                                name="permissions[]" data-parent="organizations">
                                                            <label class="form-check-label" for="OrganizationsCreate">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="OrganizationsEdit" value="organization-edit"
                                                                name="permissions[]" data-parent="organizations">
                                                            <label class="form-check-label" for="OrganizationsEdit">
                                                                Edit
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="OrganizationsDelete" value="organization-delete"
                                                                name="permissions[]" data-parent="organizations">
                                                            <label class="form-check-label" for="OrganizationsDelete">
                                                                Delete
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Products" data-group="products" value="products"
                                                                name="permissions[]">
                                                            <label class="form-check-label" for="Products">
                                                                Products
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="ProductsCreate" value="product-create"
                                                                name="permissions[]" data-parent="products">
                                                            <label class="form-check-label" for="ProductsCreate">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="ProductsEdit" value="product-edit"
                                                                name="permissions[]" data-parent="products">
                                                            <label class="form-check-label" for="ProductsEdit">
                                                                Edit
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="ProductsDelete" value="product-delete"
                                                                name="permissions[]" data-parent="products">
                                                            <label class="form-check-label" for="ProductsDelete">
                                                                Delete
                                                            </label>
                                                        </div>

                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Services" data-group="services" value="services"
                                                                name="permissions[]">
                                                            <label class="form-check-label" for="Services">
                                                                Services
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="ServicesCreate" value="service-create"
                                                                name="permissions[]" data-parent="services">
                                                            <label class="form-check-label" for="ServicesCreate">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="ServicesEdit" value="service-edit"
                                                                name="permissions[]" data-parent="services">
                                                            <label class="form-check-label" for="ServicesEdit">
                                                                Edit
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="ServicesDelete" value="service-delete"
                                                                name="permissions[]" data-parent="services">
                                                            <label class="form-check-label" for="ServicesDelete">
                                                                Delete
                                                            </label>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-3">

                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Settings" data-group="settings" value="settings"
                                                                name="permissions[]">
                                                            <label class="form-check-label" for="Settings">
                                                                Settings
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3  mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Groups" data-group="groups" data-parent="settings"
                                                                value="groups" name="permissions[]">
                                                            <label class="form-check-label" for="Groups">
                                                                Groups
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="GroupsCreate" value="group-create"
                                                                name="permissions[]" data-parent="groups">
                                                            <label class="form-check-label" for="GroupsCreate">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="GroupsEdit" value="group-edit" name="permissions[]"
                                                                data-parent="groups">
                                                            <label class="form-check-label" for="GroupsEdit">
                                                                Edit
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="GroupsDelete" value="group-delete"
                                                                name="permissions[]" data-parent="groups">
                                                            <label class="form-check-label" for="GroupsDelete">
                                                                Delete
                                                            </label>
                                                        </div>

                                                        <div class="form-check mb-3  mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Roles" data-group="roles" data-parent="settings"
                                                                value="roles" name="permissions[]">
                                                            <label class="form-check-label" for="Roles">
                                                                Roles
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="RolesCreate" value="role-create" name="permissions[]"
                                                                data-parent="roles">
                                                            <label class="form-check-label" for="RolesCreate">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="RolesEdit" value="role-edit" name="permissions[]"
                                                                data-parent="roles">
                                                            <label class="form-check-label" for="RolesEdit">
                                                                Edit
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="RolesDelete" value="role-delete" name="permissions[]"
                                                                data-parent="roles">
                                                            <label class="form-check-label" for="RolesDelete">
                                                                Delete
                                                            </label>
                                                        </div>

                                                        <div class="form-check mb-3  mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Users" data-group="users" data-parent="settings"
                                                                value="users" name="permissions[]">
                                                            <label class="form-check-label" for="Users">
                                                                Users
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="UsersCreate" value="user-create" name="permissions[]"
                                                                data-parent="users">
                                                            <label class="form-check-label" for="UsersCreate">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="UsersEdit" value="user-edit" name="permissions[]"
                                                                data-parent="users">
                                                            <label class="form-check-label" for="UsersEdit">
                                                                Edit
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="UsersDelete" value="user-delete" name="permissions[]"
                                                                data-parent="users">
                                                            <label class="form-check-label" for="UsersDelete">
                                                                Delete
                                                            </label>
                                                        </div>

                                                        <div class="form-check mb-3  mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Pipelines" data-group="pipelines"
                                                                data-parent="settings" value="pipelines"
                                                                name="permissions[]">
                                                            <label class="form-check-label" for="Pipelines">
                                                                Pipelines
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="PipelinesCreate" value="pipeline-create"
                                                                name="permissions[]" data-parent="pipelines">
                                                            <label class="form-check-label" for="PipelinesCreate">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="PipelinesEdit" value="pipeline-edit"
                                                                name="permissions[]" data-parent="pipelines">
                                                            <label class="form-check-label" for="PipelinesEdit">
                                                                Edit
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="PipelinesDelete" value="pipeline-delete"
                                                                name="permissions[]" data-parent="pipelines">
                                                            <label class="form-check-label" for="PipelinesDelete">
                                                                Delete
                                                            </label>
                                                        </div>

                                                        <div class="form-check mb-3  mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Sources" data-group="sources"
                                                                data-parent="settings" value="sources"
                                                                name="permissions[]">
                                                            <label class="form-check-label" for="Sources">
                                                                Sources
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="SourcesCreate" value="source-create"
                                                                name="permissions[]" data-parent="sources">
                                                            <label class="form-check-label" for="SourcesCreate">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="SourcesEdit" value="source-edit" name="permissions[]"
                                                                data-parent="sources">
                                                            <label class="form-check-label" for="SourcesEdit">
                                                                Edit
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="SourcesDelete" value="source-delete"
                                                                name="permissions[]" data-parent="sources">
                                                            <label class="form-check-label" for="SourcesDelete">
                                                                Delete
                                                            </label>
                                                        </div>

                                                        <div class="form-check mb-3  mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Types" data-group="types" data-parent="settings"
                                                                value="types" name="permissions[]">
                                                            <label class="form-check-label" for="Types">
                                                                Types
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="TypesCreate" value="type-create" name="permissions[]"
                                                                data-parent="types">
                                                            <label class="form-check-label" for="TypesCreate">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="TypesEdit" value="type-edit" name="permissions[]"
                                                                data-parent="types">
                                                            <label class="form-check-label" for="TypesEdit">
                                                                Edit
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="TypesDelete" value="type-delete" name="permissions[]"
                                                                data-parent="types">
                                                            <label class="form-check-label" for="TypesDelete">
                                                                Delete
                                                            </label>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-3">


                                                        <div class="form-check mb-3  ">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Attributes" data-group="attributes"
                                                                data-parent="settings" value="attributes"
                                                                name="permissions[]">
                                                            <label class="form-check-label" for="Attributes">
                                                                Attributes
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="AttributesCreate" value="attribute-create"
                                                                name="permissions[]" data-parent="attributes">
                                                            <label class="form-check-label" for="AttributesCreate">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="AttributesEdit" value="attribute-edit"
                                                                name="permissions[]" data-parent="attributes">
                                                            <label class="form-check-label" for="AttributesEdit">
                                                                Edit
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="AttributesDelete" value="attribute-delete"
                                                                name="permissions[]" data-parent="attributes">
                                                            <label class="form-check-label" for="AttributesDelete">
                                                                Delete
                                                            </label>
                                                        </div>

                                                        <div class="form-check mb-3  ">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Workflows" data-group="workflows"
                                                                data-parent="settings" value="workflows"
                                                                name="permissions[]">
                                                            <label class="form-check-label" for="Workflows">
                                                                Workflows
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="WorkflowsCreate" value="workflow-create"
                                                                name="permissions[]" data-parent="workflows">
                                                            <label class="form-check-label" for="WorkflowsCreate">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="WorkflowsEdit" value="workflow-edit"
                                                                name="permissions[]" data-parent="workflows">
                                                            <label class="form-check-label" for="WorkflowsEdit">
                                                                Edit
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="WorkflowsDelete" value="workflow-delete"
                                                                name="permissions[]" data-parent="workflows">
                                                            <label class="form-check-label" for="WorkflowsDelete">
                                                                Delete
                                                            </label>
                                                        </div>

                                                        <div class="form-check mb-3  ">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="EmailTemplates" data-group="emailTemplates"
                                                                data-parent="settings" value="email-templates"
                                                                name="permissions[]">
                                                            <label class="form-check-label" for="EmailTemplates">
                                                                Email Templates
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="EmailTempCreate" value="email-temp-create"
                                                                name="permissions[]" data-parent="emailTemplates">
                                                            <label class="form-check-label" for="EmailTempCreate">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="EmailTempEdit" value="email-temp-edit"
                                                                name="permissions[]" data-parent="emailTemplates">
                                                            <label class="form-check-label" for="EmailTempEdit">
                                                                Edit
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="EmailTempDelete" value="email-temp-delete"
                                                                name="permissions[]" data-parent="emailTemplates">
                                                            <label class="form-check-label" for="EmailTempDelete">
                                                                Delete
                                                            </label>
                                                        </div>

                                                        <div class="form-check mb-3  ">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="WebForms" data-group="webForms"
                                                                data-parent="settings" value="web-forms"
                                                                name="permissions[]">
                                                            <label class="form-check-label" for="WebForms">
                                                                Web Forms
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="WebFormsCreate" value="webForms-create"
                                                                name="permissions[]" data-parent="webForms">
                                                            <label class="form-check-label" for="WebFormsCreate">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="WebFormsEdit" value="webForms-edit"
                                                                name="permissions[]" data-parent="webForms">
                                                            <label class="form-check-label" for="WebFormsEdit">
                                                                Edit
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="WebFormsDelete" value="webForms-delete"
                                                                name="permissions[]" data-parent="webForms">
                                                            <label class="form-check-label" for="WebFormsDelete">
                                                                Delete
                                                            </label>
                                                        </div>

                                                        <div class="form-check mb-3  ">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Tags" data-group="tags" data-parent="settings"
                                                                value="tags" name="permissions[]">
                                                            <label class="form-check-label" for="Tags">
                                                                Tags
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="TagsCreate" value="tag-create" name="permissions[]"
                                                                data-parent="tags">
                                                            <label class="form-check-label" for="TagsCreate">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="TagsEdit" value="tag-edit" name="permissions[]"
                                                                data-parent="tags">
                                                            <label class="form-check-label" for="TagsEdit">
                                                                Edit
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="TagsDelete" value="tag-delete" name="permissions[]"
                                                                data-parent="tags">
                                                            <label class="form-check-label" for="TagsDelete">
                                                                Delete
                                                            </label>
                                                        </div>

                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Configuration" value="configuration"
                                                                name="permissions[]">
                                                            <label class="form-check-label" for="Configuration">
                                                                Configuration
                                                            </label>
                                                        </div>

                                                         <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="Mails" data-group="mails" value="mails"
                                                                name="permissions[]">
                                                            <label class="form-check-label" for="mails">
                                                                Mails
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="MailsCreate" value="mail-create"
                                                                name="permissions[]" data-parent="mails">
                                                            <label class="form-check-label" for="MailsCreate">
                                                                Create
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="MailsEdit" value="mail-edit"
                                                                name="permissions[]" data-parent="mails">
                                                            <label class="form-check-label" for="MailsEdit">
                                                                Edit
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-3 mx-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="MailsDelete" value="mail-delete"
                                                                name="permissions[]" data-parent="mails">
                                                            <label class="form-check-label" for="MailsDelete">
                                                                Delete
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div> --}}
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


            $('#pipeline-select').on('change', function() {
                if ($(this).val() === 'custom') {
                    $('#permissions-col').show();
                } else {
                    $('#permissions-col').hide();
                }
            });
        });
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-group]').forEach(function(parentCheckbox) {
                parentCheckbox.addEventListener('change', function() {
                    const group = parentCheckbox.getAttribute('data-group');
                    const children = document.querySelectorAll('[data-parent="' + group + '"]');
                    children.forEach(function(childCheckbox) {
                        childCheckbox.checked = parentCheckbox.checked;
                        childCheckbox.dispatchEvent(new Event('change'));
                    });
                });
            });

            document.querySelectorAll('[data-parent]').forEach(function(childCheckbox) {
                childCheckbox.addEventListener('change', function() {
                    const group = childCheckbox.getAttribute('data-parent');
                    const parent = document.querySelector('[data-group="' + group + '"]');
                    const children = document.querySelectorAll('[data-parent="' + group + '"]');

                    const anyChecked = Array.from(children).some(child => child.checked);
                    parent.checked = anyChecked;
                });
            });

        });
    </script> --}}














    <script>
        /*
            Permission data structure:
            - label: shown text
            - value: id/value
            - type: 'checkbox' or 'radio'
            - group: radio group name (optional, required for radios so they are exclusive)
            - children: nested items
        */
        const permissions = [{

                // Leads
                label: "Leads",
                value: "leads",
                type: "checkbox",
                children: [{
                        label: "Create Lead",
                        value: "lead-create",
                        type: "checkbox"
                    },
                    {
                        label: "View Lead",
                        value: "lead-view",
                        type: "checkbox",
                        children: [{
                                label: "View Own Leads",
                                value: "lead-view-own",
                                type: "radio",
                                group: "lead-view-type"
                            },
                            {
                                label: "View All Leads",
                                value: "lead-view-all",
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
                        label: "Sales owner showing tooltip",
                        value: "lead-owner-showing-tooltip",
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

                            },
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
                                label: "View Own Quotes",
                                value: "quotes-view-own",
                                type: "radio",
                                group: "quotes-view-type"
                            },
                            {
                                label: "View All Quotes",
                                value: "quotes-view-all",
                                type: "radio",
                                group: "quotes-view-type"
                            }
                        ]
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
                                label: "Show Own Activities",
                                value: "show-own-activities",
                                type: "radio",
                                group: "show-activities"

                            },

                            {
                                label: "Show All Activities",
                                value: "show-all-activities",
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



            // mail

            {
                label: "Mails",
                value: "mails",
                type: "checkbox",
                children: [{
                        label: "Show Mails",
                        value: "show-mails",
                        type: "checkbox",
                        children: [{
                                label: "Show Own Mails",
                                value: "show-own-mails",
                                type: "radio",
                                group: 'show-mails-by-type'
                            },


                            {
                                label: "Show All Mails",
                                value: "show-all-mails",
                                type: "radio",
                                group: 'show-mails-by-type'
                            },
                        ]

                    },
                    {
                        label: "Edit Mails",
                        value: "edit-mails",
                        type: "checkbox",
                    },
                    {
                        label: "Compose Mails",
                        value: "compose-mails",
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


        ];

        // generate DOM elements recursively
        function createPermissionElement(item, level = 0, parentValue = null) {
            const wrapper = document.createElement('div');
            wrapper.className = level === 0 ? 'mb-2' : `mb-2 ms-4`;

            // container for single input+label (Bootstrap form-check)
            const formCheck = document.createElement('div');
            formCheck.className = 'form-check';

            const input = document.createElement('input');
            input.className = 'form-check-input';
            input.type = item.type;
            input.id = item.value;
            input.value = item.value;

            // radio group name or permissions[] for checkboxes
            if (item.type === 'radio') {
                input.name = item.group || (item.value + '-group');
            } else {
                input.name = 'permissions[]';
            }

            // data-parent for child -> its parent value
            if (parentValue) input.setAttribute('data-parent', parentValue);

            // if item has children make it a data-group (so it acts as parent)
            if (Array.isArray(item.children) && item.children.length > 0) {
                input.setAttribute('data-group', item.value);
            }

            const label = document.createElement('label');
            label.className = 'form-check-label';
            label.setAttribute('for', item.value);
            label.textContent = item.label;
            if (level === 0) label.classList.add('fw-bold');

            formCheck.appendChild(input);
            formCheck.appendChild(label);
            wrapper.appendChild(formCheck);

            // add children recursively
            if (item.children && item.children.length) {
                const childBox = document.createElement('div');
                childBox.className = `mt-2`;
                item.children.forEach(child => {
                    childBox.appendChild(createPermissionElement(child, level + 1, item.value));
                });
                wrapper.appendChild(childBox);
            }

            return wrapper;
        }

        // mount to DOM
        const root = document.getElementById('permission-container');
        permissions.forEach(p => root.appendChild(createPermissionElement(p)));


        // Utility functions for behavior

        // get children of a parent (data-parent === parentValue)
        function getChildrenOf(parentValue) {
            return Array.from(document.querySelectorAll('[data-parent="' + parentValue + '"]'));
        }

        // get parent input element (data-group === parentValue)
        function getParentOf(childInput) {
            const parentValue = childInput.getAttribute('data-parent');
            if (!parentValue) return null;
            return document.querySelector('[data-group="' + parentValue + '"]') || document.querySelector('#' +
                parentValue);
        }

        // recursively update upward parents (when child changes)
        function updateParentsRecursively(childInput) {
            const parent = getParentOf(childInput);
            if (!parent) return;

            // find all children of this parent
            const children = getChildrenOf(parent.id || parent.value || parent.getAttribute('data-group') || parent.name);
            // determine if any child is "selected"
            let anySelected = false;
            for (const c of children) {
                if (c.type === 'checkbox' && c.checked) {
                    anySelected = true;
                    break;
                }
                if (c.type === 'radio') {
                    // radios: consider selected if any radio with same name is checked
                    const radios = document.getElementsByName(c.name);
                    if (Array.from(radios).some(r => r.checked)) {
                        anySelected = true;
                        break;
                    }
                }
            }

            parent.checked = anySelected;
            // continue upwards
            updateParentsRecursively(parent);
        }

        // when a parent checkbox changes, set children accordingly
        function updateChildrenOnParentChange(parentInput) {
            const parentValue = parentInput.id || parentInput.value;
            const children = getChildrenOf(parentValue);

            children.forEach(child => {
                if (child.type === 'checkbox') {
                    child.checked = parentInput.checked;
                    child.disabled =
                        false; // always enabled if parent is checked; we'll set disabled below if parent unchecked
                    // if child has its own children, handle enabling/disabling recursively
                    if (child.hasAttribute('data-group')) {
                        updateChildrenOnParentChange(child);
                    }
                }
                if (child.type === 'radio') {
                    // For radios: when parent is checked -> enable radios; when unchecked -> disable and uncheck
                    child.disabled = !parentInput.checked;
                    if (!parentInput.checked) {
                        child.checked = false;
                    }
                }
            });

            // If child radios exist and parent is checked, ensure one radio is checked by default
            // find unique radio groups among children
            const radioGroups = [...new Set(children.filter(c => c.type === 'radio').map(r => r.name))];
            radioGroups.forEach(groupName => {
                const radios = Array.from(document.getElementsByName(groupName));
                if (parentInput.checked) {
                    // enable all radios in this group that are direct children (some radios could belong purposefully)
                    radios.forEach(r => r.disabled = false);
                    // if none selected, check first enabled one
                    if (!radios.some(r => r.checked)) {
                        const firstEnabled = radios.find(r => !r.disabled);
                        if (firstEnabled) firstEnabled.checked = true;
                    }
                } else {
                    radios.forEach(r => {
                        r.disabled = true;
                        r.checked = false;
                    });
                }
            });
        }


        // Add event listeners to all inputs (delegation-like via loop)
        function addListeners() {
            const allInputs = Array.from(document.querySelectorAll('input.form-check-input'));

            allInputs.forEach(input => {
                // on change
                input.addEventListener('change', function(e) {
                    // if this input is a parent (has data-group), update its children
                    if (input.hasAttribute('data-group')) {
                        // Only check/uncheck children if this is a checkbox parent. If a parent is radio (rare), treat similarly.
                        if (input.type === 'checkbox') {
                            updateChildrenOnParentChange(input);
                        }
                    }

                    // if this input is a child, update its immediate parent and propagate upwards
                    if (input.hasAttribute('data-parent')) {
                        // If this child is a checkbox and it has its own children, and it was unchecked,
                        // ensure its children get disabled/unchecked
                        if (input.type === 'checkbox' && input.hasAttribute('data-group')) {
                            updateChildrenOnParentChange(input);
                        }

                        // if child is a radio, checking it should set its parent checked
                        // same logic for checkbox child
                        updateParentsRecursively(input);
                    }

                    // Edge case: if we toggled a radio, we also want to ensure its radio-group children behavior
                    if (input.type === 'radio') {
                        // find parent of this radio (data-parent)
                        const parent = getParentOf(input);
                        if (parent) {
                            parent.checked = true;
                            updateParentsRecursively(parent);
                        }
                    }
                });

                // when page loads, set initial disabled states for radios if parent missing/unchecked
                if (input.type === 'radio') {
                    const parent = getParentOf(input);
                    if (!parent || !parent.checked) {
                        input.disabled = true;
                        input.checked = false;
                    }
                }
            });
        }

        // initial setup after DOM built
        function initializeStates() {
            // For any parent with children, if it is checked ensure children get set properly
            const parents = Array.from(document.querySelectorAll('[data-group]'));
            parents.forEach(p => {
                if (p.type === 'checkbox') {
                    updateChildrenOnParentChange(p);
                }
            });

            // For radios under unchecked parents, ensure they are disabled; for checked parents make sure one radio is selected
            parents.forEach(p => {
                const children = getChildrenOf(p.id || p.value);
                const radioGroups = [...new Set(children.filter(c => c.type === 'radio').map(r => r.name))];
                radioGroups.forEach(groupName => {
                    const radios = Array.from(document.getElementsByName(groupName));
                    if (p.checked) {
                        radios.forEach(r => r.disabled = false);
                        if (!radios.some(r => r.checked)) {
                            const first = radios.find(r => !r.disabled);
                            if (first) first.checked = true;
                        }
                    } else {
                        radios.forEach(r => {
                            r.disabled = true;
                            r.checked = false;
                        });
                    }
                });
            });
        }

        // run listeners and init
        addListeners();
        initializeStates();
    </script>
@endsection
