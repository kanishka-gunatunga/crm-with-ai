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
                                                <textarea class="form-control" placeholder="Description" id="field5" rows="5" name="description" required>{{ $role->description }}</textarea>
                                            </div>
                                            <div class="col-md-12" style="display:none;" id="permissions-col">
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
    <script>
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
    </script>
@endsection
