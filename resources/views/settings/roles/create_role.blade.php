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
                        <a href="">
                            <button type="button" class="btn clear-all-btn">Clear
                                All</button>
                        </a>
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
                    // {
                    //     label: "Lead Assignment to Own",
                    //     value: "lead-assignment",
                    //     type: "checkbox"
                    // },
                    

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

                            // {
                            //     label: "Activity",
                            //     value: "add-lead-activity",
                            //     type: "checkbox",

                            // },

                            // {
                            //     label: "Email",
                            //     value: "add-lead-email",
                            //     type: "checkbox",

                            // },
                            {
                                label: "File",
                                value: "add-lead-file",
                                type: "checkbox",

                            },
                            // {
                            //     label: "Quote",
                            //     value: "add-lead-quote",
                            //     type: "checkbox",

                            // }
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

                            // {
                            //     label: "Activity",
                            //     value: "show-lead-activity",
                            //     type: "checkbox",

                            // },

                            // {
                            //     label: "Email",
                            //     value: "show-lead-email",
                            //     type: "checkbox",

                            // },
                            {
                                label: "File",
                                value: "show-lead-file",
                                type: "checkbox",

                            },
                            // {
                            //     label: "Quote",
                            //     value: "show-lead-quote",
                            //     type: "checkbox",

                            // },
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

        // Generate unique ID from value
        function generateId(value) {
            return value.replace(/[^a-zA-Z0-9]/g, '_');
        }

        // Render permission item recursively
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

        // Render all permissions
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

            // Initialize dropdown after rendering
            initPermissionTypeDropdown();
        }

        // Get all child inputs for a parent
        function getChildInputs(parentValue) {
            return document.querySelectorAll(`[data-parent="${parentValue}"]`);
        }

        // Get parent input for a child
        function getParentInput(childInput) {
            const parentValue = childInput.getAttribute('data-parent');
            if (!parentValue) return null;
            return document.querySelector(`[data-value="${parentValue}"]`);
        }

        // Handle checkbox change
        function handleCheckboxChange(checkbox) {
            // Don't process if disabled (in "all" mode)
            if (checkbox.disabled) return;

            if (checkbox.checked) {
                // Check all children
                const children = getChildInputs(checkbox.dataset.value);
                children.forEach(child => {
                    if (child.type === 'checkbox') {
                        child.checked = true;
                        handleCheckboxChange(child);
                    } else if (child.type === 'radio') {
                        child.disabled = false;
                    }
                });

                // Select first radio if this has radio children
                if (checkbox.dataset.hasRadioChildren) {
                    const radios = Array.from(children).filter(c => c.type === 'radio');
                    if (radios.length > 0 && !radios.some(r => r.checked)) {
                        radios[0].checked = true;
                    }
                }

                // Check parent
                const parent = getParentInput(checkbox);
                if (parent && parent.type === 'checkbox' && !parent.checked && !parent.disabled) {
                    parent.checked = true;
                    handleCheckboxChange(parent);
                }
            } else {
                // Uncheck and disable all children
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

                // Check if parent should be unchecked
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

        // Handle radio change
        function handleRadioChange(radio) {
            const parent = getParentInput(radio);
            if (parent && parent.type === 'checkbox' && !parent.checked) {
                parent.checked = true;
                handleCheckboxChange(parent);
            }
        }

        // Attach event listeners
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
                // Initially disable all radios
                radio.disabled = true;
            });
        }

        // Handle permission type dropdown change
        function handlePermissionTypeChange(value) {
            const allCheckboxes = document.querySelectorAll('#permission-container input[type="checkbox"]');
            const allRadios = document.querySelectorAll('#permission-container input[type="radio"]');

            console.log('Handling permission type:', value);
            console.log('Found checkboxes:', allCheckboxes.length);
            console.log('Found radios:', allRadios.length);

            if (value === 'all') {
                // Check and disable all checkboxes
                allCheckboxes.forEach(checkbox => {
                    checkbox.checked = true;
                    checkbox.disabled = true;
                });

                // Enable and select first radio in each group
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
                        radio.checked = index === 0; // Select first radio in each group
                    });
                });

                console.log('All permissions enabled and disabled');
            } else {
                // Custom mode - enable all and uncheck all
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

        // Initialize permission type dropdown listener
        // Initialize permission type dropdown listener
        function initPermissionTypeDropdown() {
            const dropdown = document.getElementById('pipeline-select');
            if (!dropdown) {
                console.error('Permission type dropdown not found');
                return;
            }

            // Listen for Select2 changes
            $('#pipeline-select').on('select2:select', function(e) {
                console.log('Select2 dropdown changed to:', this.value);
                handlePermissionTypeChange(this.value);
            });

            // Also listen for regular change event as fallback
            $('#pipeline-select').on('change', function() {
                console.log('Dropdown changed to:', this.value);
                handlePermissionTypeChange(this.value);
            });

            // Set initial state based on current dropdown value
            handlePermissionTypeChange(dropdown.value);
        }

        // Collect selected permissions
        function collectPermissions() {
            const result = [];

            // Check if we're in "all" mode - if so, collect everything
            const permissionType = document.getElementById('pipeline-select');
            const isAllPermissions = permissionType && permissionType.value === 'all';

            if (isAllPermissions) {
                // Collect all checkboxes except those with radio children
                const allCheckboxes = document.querySelectorAll('#permission-container input[type="checkbox"]');
                allCheckboxes.forEach(checkbox => {
                    if (!checkbox.dataset.hasRadioChildren) {
                        result.push(checkbox.value);
                    }
                });

                // Collect all checked radios (first in each group)
                const allRadios = document.querySelectorAll('#permission-container input[type="radio"]:checked');
                allRadios.forEach(radio => {
                    result.push(radio.value);
                });

                return result;
            }

            // Custom mode - only collect checked items
            const checkboxes = document.querySelectorAll('#permission-container input[type="checkbox"]:checked');

            // Get all parent values of selected radios
            const radioParentValues = new Set();
            const radios = document.querySelectorAll('#permission-container input[type="radio"]:checked');
            radios.forEach(radio => {
                const parentValue = radio.getAttribute('data-parent');
                if (parentValue) {
                    radioParentValues.add(parentValue);
                }
            });

            checkboxes.forEach(checkbox => {
                // Skip if this checkbox has radio children
                if (checkbox.dataset.hasRadioChildren) {
                    return;
                }
                // Skip if this checkbox value is a parent of a selected radio
                if (radioParentValues.has(checkbox.value)) {
                    return;
                }
                result.push(checkbox.value);
            });

            // Add selected radio values
            radios.forEach(radio => {
                result.push(radio.value);
            });

            return result;
        }



        // Update hidden inputs before form submission
        function updatePermissionsBeforeSubmit(form) {
            // Remove all existing hidden permission inputs
            form.querySelectorAll('input[name="permissions[]"][type="hidden"]').forEach(input => {
                input.remove();
            });

            // Get the permission type
            const permissionType = document.getElementById('pipeline-select');
            const isAllPermissions = permissionType && permissionType.value === 'all';

            if (!isAllPermissions) {
                // Disable all visible permission inputs so they don't submit (custom mode only)
                form.querySelectorAll('#permission-container input[name="permissions[]"]').forEach(input => {
                    input.disabled = true;
                });
                form.querySelectorAll('#permission-container input[type="radio"]').forEach(input => {
                    input.disabled = true;
                });
            }

            // Get collected permissions
            const selectedPermissions = collectPermissions();

            // Create hidden inputs for each permission
            selectedPermissions.forEach(permission => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'permissions[]';
                hiddenInput.value = permission;
                form.appendChild(hiddenInput);
            });
        }

        // Attach to form submission
        document.addEventListener('DOMContentLoaded', function() {
            renderAllPermissions();

            // Find the form containing the permission container
            const permissionContainer = document.getElementById('permission-container');
            if (permissionContainer) {
                const form = permissionContainer.closest('form');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        updatePermissionsBeforeSubmit(this);
                        // Form will now submit with clean permissions[] array
                    });
                }
            }
        });

        // Export for manual use if needed
        window.getPermissions = collectPermissions;
    </script>
@endsection
