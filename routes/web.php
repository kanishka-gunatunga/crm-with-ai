<?php

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\PipelineController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PersonsController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\WebFormController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\EmailsController;
use Google\Service\BeyondCorp\Resource\V;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
Route::middleware(['locale'])->group(function () {
Route::match(['get', 'post'],'/', [MainController::class, 'index']);
Route::match(['get', 'post'],'forgot-password', [MainController::class, 'forgot_password']);
Route::match(['get', 'post'],'/reset-password/{id}/{email}', [MainController::class, 'reset_password']);
Route::get( '/logout', [MainController::class, 'logout']);
Route::get('/dashboard', [MainController::class, 'dashboard'])->middleware(['auth', 'permission:dashboard']);
Route::get('/get-events/{date}', [MainController::class, 'get_events'])->middleware(['auth', 'permission:dashboard']);


//Leads
Route::get( '/leads', [LeadController::class, 'leads'])->middleware(['auth', 'permission:leads']);
Route::match(['get', 'post'],'create-lead', [LeadController::class, 'create_lead'])->middleware(['auth', 'permission:lead-create']);
Route::match(['get', 'post'],'update-pipline-session', [LeadController::class, 'update_pipline_session'])->middleware(['auth']);
Route::match(['get', 'post'],'delete-lead/{id}', [LeadController::class, 'delete_lead'])->middleware(['auth', 'permission:lead-delete']);
Route::match(['get', 'post'],'edit-lead/{id}', [LeadController::class, 'edit_lead'])->middleware(['auth', 'permission:lead-edit']);
Route::get( '/delete-type/{id}', [TypeController::class, 'delete_type'])->middleware(['auth', 'permission:type-delete']);
Route::match(['get', 'post'],'edit-type/{id}', [TypeController::class, 'edit_type'])->middleware(['auth', 'permission:type-edit']);
Route::match(['get', 'post'],'get-contact-person-details/{id}', [LeadController::class, 'get_contact_person_details'])->middleware(['auth']);
Route::match(['get', 'post'],'update-lead-stage', [LeadController::class, 'update_lead_stage'])->middleware(['auth']);
Route::match(['get', 'post'],'view-lead/{id}', [LeadController::class, 'view_lead'])->middleware(['auth', 'permission:lead-view']);
Route::match(['get', 'post'],'add-lead-note/{id}', [LeadController::class, 'add_lead_note'])->middleware(['auth']);
Route::match(['get', 'post'],'edit-note/{id}', [LeadController::class, 'edit_note'])->middleware(['auth']);
Route::match(['get', 'post'],'delete-note/{id}', [LeadController::class, 'delete_note'])->middleware(['auth']);
Route::match(['get', 'post'],'add-lead-activity/{id}', [LeadController::class, 'add_lead_activity'])->middleware(['auth', 'permission:activity-create']);
Route::match(['get', 'post'],'edit-activity/{id}', [LeadController::class, 'edit_activity'])->middleware(['auth', 'permission:activity-edit']);
Route::match(['get', 'post'],'delete-activity/{id}', [LeadController::class, 'delete_activity'])->middleware(['auth', 'permission:activity-delete']);
Route::match(['get', 'post'],'complete-activity/{id}', [LeadController::class, 'complete_activity'])->middleware(['auth']);
Route::match(['get', 'post'],'add-lead-email/{id}', [LeadController::class, 'add_lead_email'])->middleware(['auth']);
Route::match(['get', 'post'],'delete-email/{id}', [LeadController::class, 'delete_email'])->middleware(['auth']);
Route::match(['get', 'post'],'add-lead-file/{id}', [LeadController::class, 'add_lead_file'])->middleware(['auth']);
Route::match(['get', 'post'],'edit-file/{id}', [LeadController::class, 'edit_file'])->middleware(['auth']);
Route::match(['get', 'post'],'delete-file/{id}', [LeadController::class, 'delete_file'])->middleware(['auth']);
Route::match(['get', 'post'],'create-lead-quote/{id}', [QuoteController::class, 'create_lead_quote'])->middleware(['auth', 'permission:quote-create']);
Route::match(['get', 'post'],'export-leads/{format}', [LeadController::class, 'export_leads'])->middleware(['auth']);
Route::match(['post'],'import-leads', [LeadController::class, 'import_leads'])->middleware(['auth']);

//Quotes
Route::match(['get', 'post'],'quotes', [QuoteController::class, 'quotes'])->middleware(['auth', 'permission:quotes']);
Route::get( '/delete-quote/{id}', [QuoteController::class, 'delete_quote'])->middleware(['auth', 'permission:quote-delete']);
Route::match(['get', 'post'],'create-quote', [QuoteController::class, 'create_quote'])->middleware(['auth', 'permission:quote-create']);
Route::match(['get', 'post'],'edit-quote/{id}', [QuoteController::class, 'edit_quote'])->middleware(['auth', 'permission:quote-edit']);
Route::post('/delete-selected-quotes', [QuoteController::class, 'delete_selected_quotes'])->middleware(['auth', 'permission:quote-delete']);

// Contact Persons
Route::get( '/persons', [PersonsController::class, 'persons'])->middleware(['auth', 'permission:persons']);
Route::match(['get', 'post'],'create-person', [PersonsController::class, 'create_person'])->middleware(['auth', 'permission:person-create']);
Route::get( '/delete-person/{id}', [PersonsController::class, 'delete_person'])->middleware(['auth', 'permission:person-delete']);
Route::match(['get', 'post'],'edit-person/{id}', [PersonsController::class, 'edit_person'])->middleware(['auth', 'permission:person-edit']);
Route::post('/delete-selected-persons', [PersonsController::class, 'delete_selected_persons'])->middleware(['auth', 'permission:person-delete']);
Route::match(['post'],'import-persons', [PersonsController::class, 'import_persons'])->middleware(['auth']);

// Contact Organizations
Route::get( '/organizations', [OrganizationsController::class, 'organizations'])->middleware(['auth', 'permission:organizations']);
Route::match(['get', 'post'],'create-organization', [OrganizationsController::class, 'create_organization'])->middleware(['auth', 'permission:organization-create']);
Route::get( '/delete-organization/{id}', [OrganizationsController::class, 'delete_organization'])->middleware(['auth', 'permission:organization-delete']);
Route::match(['get', 'post'],'edit-organization/{id}', [OrganizationsController::class, 'edit_organization'])->middleware(['auth', 'permission:organization-edit']);
Route::post('/delete-selected-organizations', [OrganizationsController::class, 'delete_selected_organizations'])->middleware(['auth', 'permission:organization-delete']);
Route::match(['post'],'import-organizations', [OrganizationsController::class, 'import_organizations'])->middleware(['auth']);

//Products
Route::get( '/products', [ProductsController::class, 'products'])->middleware(['auth', 'permission:products']);
Route::match(['get', 'post'],'create-product', [ProductsController::class, 'create_product'])->middleware(['auth', 'permission:product-create']);
Route::get( '/delete-product/{id}', [ProductsController::class, 'delete_product'])->middleware(['auth', 'permission:product-delete']);
Route::match(['get', 'post'],'edit-product/{id}', [ProductsController::class, 'edit_product'])->middleware(['auth', 'permission:product-edit']);
Route::post('/delete-selected-products', [ProductsController::class, 'delete_selected_products'])->middleware(['auth', 'permission:product-delete']);

//Services
Route::get( '/services', [ServicesController::class, 'services'])->middleware(['auth', 'permission:services']);
Route::match(['get', 'post'],'create-service', [ServicesController::class, 'create_service'])->middleware(['auth', 'permission:service-create']);
Route::get( '/delete-service/{id}', [ServicesController::class, 'delete_service'])->middleware(['auth', 'permission:service-delete']);
Route::match(['get', 'post'],'edit-service/{id}', [ServicesController::class, 'edit_service'])->middleware(['auth', 'permission:service-edit']);
Route::post('/delete-selected-services', [ServicesController::class, 'delete_selected_services'])->middleware(['auth', 'permission:service-delete']);

//Activties
Route::get( '/activities', [LeadController::class, 'activities'])->middleware(['auth', 'permission:activities']);
Route::post('/update-activity-status', [LeadController::class, 'update_activity_status'])->middleware(['auth']);
Route::post('/delete-selected-activities', [LeadController::class, 'delete_selected_activities'])->middleware(['auth', 'permission:activity-delete']);

//Configuration
Route::get( '/configuration', [ConfigurationController::class, 'configuration'])->middleware(['auth', 'permission:configuration']);
Route::post('/update-company-logo', [ConfigurationController::class, 'update_company_logo'])->middleware(['auth']);

//Settings
Route::get( '/settings', [SettingsController::class, 'settings'])->middleware(['auth', 'permission:settings']);



//Pipelines
Route::get( '/pipelines', [PipelineController::class, 'pipelines'])->middleware(['auth', 'permission:pipelines']);
Route::match(['get', 'post'],'create-pipeline', [PipelineController::class, 'create_pipeline'])->middleware(['auth', 'permission:pipeline-create']);
Route::get( '/delete-pipeline/{id}', [PipelineController::class, 'delete_pipeline'])->middleware(['auth', 'permission:pipeline-delete']);
Route::match(['get', 'post'],'edit-pipeline/{id}', [PipelineController::class, 'edit_pipeline'])->middleware(['auth', 'permission:pipeline-edit']);
Route::get( '/delete-stage/{id}', [PipelineController::class, 'delete_stage'])->middleware(['auth']);

//Sources
Route::get( '/sources', [SourceController::class, 'sources'])->middleware(['auth', 'permission:sources']);
Route::match(['get', 'post'],'create-source', [SourceController::class, 'create_source'])->middleware(['auth', 'permission:source-create']);
Route::get( '/delete-source/{id}', [SourceController::class, 'delete_source'])->middleware(['auth', 'permission:source-delete']);
Route::match(['get', 'post'],'edit-source/{id}', [SourceController::class, 'edit_source'])->middleware(['auth', 'permission:source-edit']);

//Types
Route::get( '/types', [TypeController::class, 'types'])->middleware(['auth', 'permission:types']);
Route::match(['get', 'post'],'create-type', [TypeController::class, 'create_type'])->middleware(['auth', 'permission:type-create']);
Route::get( '/delete-type/{id}', [TypeController::class, 'delete_type'])->middleware(['auth', 'permission:type-delete']);
Route::match(['get', 'post'],'edit-type/{id}', [TypeController::class, 'edit_type'])->middleware(['auth', 'permission:type-edit']);

//Groups
Route::get( '/groups', [GroupsController::class, 'groups'])->middleware(['auth', 'permission:groups']);
Route::match(['get', 'post'],'create-group', [GroupsController::class, 'create_group'])->middleware(['auth', 'permission:group-create']);
Route::get( '/delete-group/{id}', [GroupsController::class, 'delete_group'])->middleware(['auth', 'permission:group-delete']);
Route::match(['get', 'post'],'edit-group/{id}', [GroupsController::class, 'edit_group'])->middleware(['auth', 'permission:group-edit']);

//Roles
Route::get( '/roles', [RolesController::class, 'roles'])->middleware(['auth', 'permission:roles']);
Route::match(['get', 'post'],'create-role', [RolesController::class, 'create_role'])->middleware(['auth', 'permission:role-create']);
Route::get( '/delete-role/{id}', [RolesController::class, 'delete_role'])->middleware(['auth', 'permission:role-delete']);
Route::match(['get', 'post'],'edit-role/{id}', [RolesController::class, 'edit_role'])->middleware(['auth', 'permission:role-edit']);


//Users
Route::get( '/users', [UsersController::class, 'users'])->middleware(['auth', 'permission:users']);
Route::match(['get', 'post'],'create-user', [UsersController::class, 'create_user'])->middleware(['auth', 'permission:user-create']);
Route::get( '/delete-user/{id}', [UsersController::class, 'delete_user'])->middleware(['auth', 'permission:user-delete']);
Route::get( '/delete-selected-users', [UsersController::class, 'delete_selected_users'])->middleware(['auth', 'permission:user-delete']);
Route::match(['get', 'post'],'edit-user/{id}', [UsersController::class, 'edit_user'])->middleware(['auth', 'permission:user-edit']);

//Attributes
Route::get( '/attributes', [AttributeController::class, 'attributes'])->middleware(['auth', 'permission:attributes']);
Route::match(['get', 'post'],'create-attribute', [AttributeController::class, 'create_attribute'])->middleware(['auth', 'permission:attribute-create']);
Route::get( '/delete-attribute/{id}', [AttributeController::class, 'delete_attribute'])->middleware(['auth', 'permission:attribute-delete']);
Route::get( '/delete-selected-attributes', [AttributeController::class, 'delete_selected_attributes'])->middleware(['auth', 'permission:attribute-delete']);
Route::match(['get', 'post'],'edit-attribute/{id}', [AttributeController::class, 'edit_attribute'])->middleware(['auth', 'permission:attribute-edit']);

//Email Templates
Route::get( '/email-templates', [EmailTemplateController::class, 'email_templates'])->middleware(['auth', 'permission:groups']);
Route::match(['get', 'post'],'create-email-template', [EmailTemplateController::class, 'create_email_template'])->middleware(['auth', 'permission:group-create']);
Route::get( '/delete-email-template/{id}', [EmailTemplateController::class, 'delete_email_template'])->middleware(['auth', 'permission:group-delete']);
Route::match(['get', 'post'],'edit-email-template/{id}', [EmailTemplateController::class, 'edit_email_template'])->middleware(['auth', 'permission:group-edit']);

//Web Flows
Route::get( '/web-forms', [WebFormController::class, 'web_forms'])->middleware(['auth', 'permission:web-forms']);
Route::match(['get', 'post'],'create-web-form', [WebFormController::class, 'create_web_form'])->middleware(['auth', 'permission:webForms-create']);
Route::get( '/delete-web-form/{id}', [WebFormController::class, 'delete_web_form'])->middleware(['auth', 'permission:webForms-delete']);
Route::get( '/view-web-form/{uuid}', [WebFormController::class, 'view_web_form']);
Route::get('/embed/web-form/{uuid}', [WebFormController::class, 'serveEmbedScript']);
Route::post('web-form-submit/{uuid}', [WebFormController::class, 'web_form_submit']);
Route::match(['get', 'post'],'edit-web-form/{id}', [WebFormController::class, 'edit_web_form'])->middleware(['auth', 'permission:webForms-edit']);


//Emails
Route::get( '/emails', [EmailsController::class, 'emails'])->middleware(['auth']);
Route::match(['get', 'post'],'compose-email', [EmailsController::class, 'compose_email'])->middleware(['auth']);
});

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es', 'fa', 'tr', 'ar'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

// Route::get('/leadf', function () {
//     return View('leads.leads');
// });

// Route::get('/settings', function () {
//     return View('settings.settings');
// })->name('settings');


