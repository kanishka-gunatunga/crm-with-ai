@extends('master')

@section('content')

<?php

use App\Models\Lead;
use App\Models\Person;
use App\Models\Source;
use App\Models\Type;
use App\Models\UserDetails;
use App\Models\Organization;
use App\Models\Product;
use App\Models\QuoteProduct;


$source_name = Source::where('id', $lead->source)->value('name');
$type_name = Type::where('id', $lead->type)->value('name');
$owner_name = UserDetails::where('id', $lead->sales_owner)->value('name');
$person = Person::where('id', $lead->person)->first();
?>
<!-- Scrollable Content -->
<div class="main-scrollable">
    <div class="page-container">
        <div class="page-title-container">
            <div class="d-flex justify-content-between">
                <div>
                    <h3 class="page-title">
                        {{$lead->title}}
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Stop & Shop</a></li>
                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">{{$lead->title}}</li>
                        </ol>
                    </nav>
                </div>

                <div class="d-flex gap-3">
                    <div class="shading-button">
                        

                        <?php if ($lead->category == 'low') { ?>
                            <button class="btn  low" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Low
                                <span>
                                    <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.99281 11.8847L13.1944 7.6842L12.4236 6.91235L8.99281 10.3431L5.56311 6.91235L4.79126 7.6842L8.99281 11.8847Z" fill="#4A58EC" />
                                    </svg>
                                </span>
                            </button>
                        <?php }elseif ($lead->category == 'medium') { ?>
                           <button class="btn  blue" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Medium
                                <span>
                                    <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.99281 11.8847L13.1944 7.6842L12.4236 6.91235L8.99281 10.3431L5.56311 6.91235L4.79126 7.6842L8.99281 11.8847Z" fill="#4A58EC" />
                                    </svg>
                                </span>
                            </button>
                        
                        <?php }elseif ($lead->category == 'high') { ?>
                           <button class="btn  orange" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                High
                                <span>
                                    <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.99281 11.8847L13.1944 7.6842L12.4236 6.91235L8.99281 10.3431L5.56311 6.91235L4.79126 7.6842L8.99281 11.8847Z" fill="#4A58EC" />
                                    </svg>
                                </span>
                            </button>
                        
                        <?php }elseif ($lead->category == 'urgent') { ?>
                           <button class="btn  red" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Urgent
                                <span>
                                    <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.99281 11.8847L13.1944 7.6842L12.4236 6.91235L8.99281 10.3431L5.56311 6.91235L4.79126 7.6842L8.99281 11.8847Z" fill="#4A58EC" />
                                    </svg>
                                </span>
                            </button>
                        <?php } ?>


                        <div class="dropdown">

                            <ul class="dropdown-menu p-0">
                                <li><a class="dropdown-item blue" href="#">New</a></li>
                                <li><a class="dropdown-item orange" href="#">in Review</a></li>
                                <li><a class="dropdown-item green" href="#">Won</a></li>
                                <li><a class="dropdown-item red" href="#">Lost</a></li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <button class="btn trash-icon-btn">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.44137 13.0221C4.1026 13.0221 3.81269 12.9016 3.57164 12.6606C3.3306 12.4195 3.20987 12.1294 3.20946 11.7902V3.78281H2.59351V2.55089H5.67329V1.93494H9.36902V2.55089H12.4488V3.78281H11.8328V11.7902C11.8328 12.129 11.7123 12.4191 11.4713 12.6606C11.2302 12.902 10.9401 13.0226 10.6009 13.0221H4.44137ZM10.6009 3.78281H4.44137V11.7902H10.6009V3.78281ZM5.67329 10.5583H6.9052V5.01472H5.67329V10.5583ZM8.13711 10.5583H9.36902V5.01472H8.13711V10.5583Z" fill="#ED2227" />
                            </svg>

                        </button>
                    </div>
                </div>



            </div>

        </div>

        <div class="col-12">
            <div class="card-container">

                <!-- basic details -->
                <div class="card card-default mb-4">
                    <div class="card-body col-12">
                        <!-- <article class="project-card"> -->
                        <!-- <div class="card-background"></div> -->
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="note-tab" role="tabpanel" aria-labelledby="note-tab-tab" tabindex="0">
                                <div class="d-flex justify-content-between align-items-center mb-3 position-relative">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <section class="primary-info">
                                            <div class="title-section">
                                                <h3 class="field-label">Title</h3>
                                                <p class="project-title">{{$lead->title}}</p>
                                            </div>

                                            <div class="status-section mb-3">
                                                <h3 class="field-label mb-0">Status</h3>
                                                <span class="priority-badge urgent">Urgent</span>
                                            </div>

                                            <div class="terms-section">
                                                <h3 class="field-label">Terms</h3>
                                                <p class="field-value">None</p>
                                            </div>

                                            <div class="start-date-section">
                                                <h3 class="field-label">Start Date</h3>
                                                <p class="field-value">May 26, 2025</p>
                                            </div>

                                            <div class="duration-section">
                                                <h3 class="field-label">Duration</h3>
                                                <p class="field-value">5 months</p>
                                            </div>
                                        </section>

                                    </div>

                                    <div class="col-12 col-md-6 col-lg-4">
                                        <section class="secondary-info">
                                            <div class="pipeline-section">
                                                <h3 class="field-label">Pipeline</h3>
                                                <p class="field-value">Stop &amp; Shop</p>
                                            </div>

                                            <div class="priority-section">
                                                <h3 class="field-label">Priority</h3>
                                                <p class="field-value">High</p>
                                            </div>

                                            <div class="reminders-section">
                                                <h3 class="field-label">Reminders</h3>
                                                <p class="field-value">None</p>
                                            </div>

                                            <div class="date-due-section">
                                                <h3 class="field-label">Date Due</h3>
                                                <p class="field-value">May 26, 2025</p>
                                            </div>
                                        </section>

                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="activity-tab" role="tabpanel" aria-labelledby="activity-tab-tab" tabindex="0">
                                <h3>Tab 2</h3>
                                <section class="primary-info">
                                    <div class="title-section">
                                        <h3 class="field-label">Title</h3>
                                        <p class="project-title">Design Dashboard Wireframe for Egoagri</p>
                                    </div>

                                    <div class="status-section mb-3">
                                        <h3 class="field-label mb-0">Status</h3>
                                        <span class="priority-badge urgent">Urgent</span>
                                    </div>

                                    <div class="terms-section">
                                        <h3 class="field-label">Terms</h3>
                                        <p class="field-value">None</p>
                                    </div>

                                    <div class="start-date-section">
                                        <h3 class="field-label">Start Date</h3>
                                        <p class="field-value">May 26, 2025</p>
                                    </div>

                                    <div class="duration-section">
                                        <h3 class="field-label">Duration</h3>
                                        <p class="field-value">5 months</p>
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane fade" id="email-tab" role="tabpanel" aria-labelledby="email-tab-tab" tabindex="0">
                                <h3>Tab 3</h3>
                                <section class="primary-info">
                                    <div class="title-section">
                                        <h3 class="field-label">Title</h3>
                                        <p class="project-title">Design Dashboard Wireframe for Egoagri</p>
                                    </div>

                                    <div class="status-section mb-3">
                                        <h3 class="field-label mb-0">Status</h3>
                                        <span class="priority-badge urgent">Urgent</span>
                                    </div>

                                    <div class="terms-section">
                                        <h3 class="field-label">Terms</h3>
                                        <p class="field-value">None</p>
                                    </div>

                                    <div class="start-date-section">
                                        <h3 class="field-label">Start Date</h3>
                                        <p class="field-value">May 26, 2025</p>
                                    </div>

                                    <div class="duration-section">
                                        <h3 class="field-label">Duration</h3>
                                        <p class="field-value">5 months</p>
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane fade" id="file-tab" role="tabpanel" aria-labelledby="file-tab-tab" tabindex="0">
                                <h3>Tab 4</h3>
                                <section class="primary-info">
                                    <div class="title-section">
                                        <h3 class="field-label">Title</h3>
                                        <p class="project-title">Design Dashboard Wireframe for Egoagri</p>
                                    </div>

                                    <div class="status-section mb-3">
                                        <h3 class="field-label mb-0">Status</h3>
                                        <span class="priority-badge urgent">Urgent</span>
                                    </div>

                                    <div class="terms-section">
                                        <h3 class="field-label">Terms</h3>
                                        <p class="field-value">None</p>
                                    </div>

                                    <div class="start-date-section">
                                        <h3 class="field-label">Start Date</h3>
                                        <p class="field-value">May 26, 2025</p>
                                    </div>

                                    <div class="duration-section">
                                        <h3 class="field-label">Duration</h3>
                                        <p class="field-value">5 months</p>
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane fade" id="quote-tab" role="tabpanel" aria-labelledby="quote-tab-tab" tabindex="0">
                                <h3>Tab 5</h3>
                                <section class="primary-info">
                                    <div class="title-section">
                                        <h3 class="field-label">Title</h3>
                                        <p class="project-title">Design Dashboard Wireframe for Egoagri</p>
                                    </div>

                                    <div class="status-section mb-3">
                                        <h3 class="field-label mb-0">Status</h3>
                                        <span class="priority-badge urgent">Urgent</span>
                                    </div>

                                    <div class="terms-section">
                                        <h3 class="field-label">Terms</h3>
                                        <p class="field-value">None</p>
                                    </div>

                                    <div class="start-date-section">
                                        <h3 class="field-label">Start Date</h3>
                                        <p class="field-value">May 26, 2025</p>
                                    </div>

                                    <div class="duration-section">
                                        <h3 class="field-label">Duration</h3>
                                        <p class="field-value">5 months</p>
                                    </div>
                                </section>
                            </div>
                        </div>






                        <div class="action-buttons position-absolute d-flex gap-2">
                            <button class="action-btn edit-btn" aria-label="Edit project" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                                <svg width="40" height="40" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="26" height="26" rx="5" fill="#E8E9EB" />
                                    <path d="M12.7292 13.2708H9.75V12.7292H12.7292V9.75H13.2708V12.7292H16.25V13.2708H13.2708V16.25H12.7292V13.2708Z" fill="black" />
                                </svg>

                            </button>

                            <button class="action-btn add-btn" aria-label="Add to project">
                                <svg width="40" height="40" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="26" height="26" rx="5" fill="#E8E9EB" />
                                    <path d="M9.20841 16.7916H9.80316L15.5979 10.9969L15.0032 10.4021L9.20841 16.1969V16.7916ZM8.66675 17.3333V15.9683L15.8059 8.82263C15.8619 8.77316 15.9233 8.73488 15.9901 8.7078C16.0569 8.68072 16.1268 8.667 16.1997 8.66663C16.2726 8.66627 16.3431 8.67783 16.411 8.7013C16.4796 8.72405 16.5428 8.76522 16.6005 8.8248L17.1785 9.40655C17.2381 9.46397 17.2789 9.52716 17.3009 9.59613C17.3226 9.66475 17.3334 9.73336 17.3334 9.80197C17.3334 9.87563 17.3211 9.94605 17.2966 10.0132C17.2717 10.08 17.2323 10.1412 17.1785 10.1968L10.0312 17.3333H8.66675ZM15.2957 10.7044L15.0032 10.4021L15.5979 10.9969L15.2957 10.7044Z" fill="#172635" />
                                </svg>

                            </button>


                            <div class="create-menu-container collapse " id="collapseWidthExample">
                                <nav class="create-menu">
                                    <header class="menu-header">CREATE</header>
                                    <section class="menu-content">
                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                            <li class="nav-item w-100" role="presentation">
                                                <button class="nav-link active filter-button" id="note-tab-tab" data-bs-toggle="pill" data-bs-target="#note-tab" type="button" role="tab" aria-controls="note-tab" aria-selected="true">
                                                    <div class="menu-item activity-item">
                                                        <div class="item-content">
                                                            <svg width="20" height="20" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M3.76904 11.1685C3.49404 11.1685 3.25871 11.0706 3.06304 10.875C2.86738 10.6793 2.76938 10.4438 2.76904 10.1685V2.16846C2.76904 1.89346 2.86704 1.65812 3.06304 1.46246C3.25904 1.26679 3.49438 1.16879 3.76904 1.16846H7.76904L10.769 4.16846V10.1685C10.769 10.4435 10.6712 10.679 10.4755 10.875C10.2799 11.071 10.0444 11.1688 9.76904 11.1685H3.76904ZM7.26904 4.66846V2.16846H3.76904V10.1685H9.76904V4.66846H7.26904Z" fill="#556476" />
                                                            </svg>


                                                            <span class="item-label">Note</span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </li>
                                            <li class="nav-item w-100" role="presentation">
                                                <button class="nav-link filter-button" id="activity-tab-tab" data-bs-toggle="pill" data-bs-target="#activity-tab" type="button" role="tab" aria-controls="activity-tab" aria-selected="false">
                                                    <div class="menu-item activity-item">
                                                        <div class="item-content">
                                                            <svg width="18" height="18" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M7.64404 4.85596C7.64404 4.77308 7.67697 4.69359 7.73557 4.63499C7.79418 4.57638 7.87366 4.54346 7.95654 4.54346H8.58154C8.66442 4.54346 8.74391 4.57638 8.80251 4.63499C8.86112 4.69359 8.89404 4.77308 8.89404 4.85596V5.48096C8.89404 5.56384 8.86112 5.64332 8.80251 5.70193C8.74391 5.76053 8.66442 5.79346 8.58154 5.79346H7.95654C7.87366 5.79346 7.79418 5.76053 7.73557 5.70193C7.67697 5.64332 7.64404 5.56384 7.64404 5.48096V4.85596Z" fill="#556476" />
                                                                <path d="M2.95654 0.168457C3.03942 0.168457 3.11891 0.201381 3.17751 0.259986C3.23612 0.318591 3.26904 0.398077 3.26904 0.480957V0.793457H8.26904V0.480957C8.26904 0.398077 8.30197 0.318591 8.36057 0.259986C8.41918 0.201381 8.49866 0.168457 8.58154 0.168457C8.66442 0.168457 8.74391 0.201381 8.80251 0.259986C8.86112 0.318591 8.89404 0.398077 8.89404 0.480957V0.793457H9.51904C9.85056 0.793457 10.1685 0.925153 10.4029 1.15957C10.6373 1.39399 10.769 1.71194 10.769 2.04346V8.91846C10.769 9.24998 10.6373 9.56792 10.4029 9.80234C10.1685 10.0368 9.85056 10.1685 9.51904 10.1685H2.01904C1.68752 10.1685 1.36958 10.0368 1.13516 9.80234C0.900739 9.56792 0.769043 9.24998 0.769043 8.91846V2.04346C0.769043 1.71194 0.900739 1.39399 1.13516 1.15957C1.36958 0.925153 1.68752 0.793457 2.01904 0.793457H2.64404V0.480957C2.64404 0.398077 2.67697 0.318591 2.73557 0.259986C2.79418 0.201381 2.87366 0.168457 2.95654 0.168457ZM2.01904 1.41846C1.85328 1.41846 1.69431 1.48431 1.5771 1.60152C1.45989 1.71873 1.39404 1.8777 1.39404 2.04346V8.91846C1.39404 9.08422 1.45989 9.24319 1.5771 9.3604C1.69431 9.47761 1.85328 9.54346 2.01904 9.54346H9.51904C9.6848 9.54346 9.84377 9.47761 9.96098 9.3604C10.0782 9.24319 10.144 9.08422 10.144 8.91846V2.04346C10.144 1.8777 10.0782 1.71873 9.96098 1.60152C9.84377 1.48431 9.6848 1.41846 9.51904 1.41846H2.01904Z" fill="#556476" />
                                                                <path d="M2.33154 2.66846C2.33154 2.58558 2.36447 2.50609 2.42307 2.44749C2.48168 2.38888 2.56116 2.35596 2.64404 2.35596H8.89404C8.97692 2.35596 9.05641 2.38888 9.11501 2.44749C9.17362 2.50609 9.20654 2.58558 9.20654 2.66846V3.29346C9.20654 3.37634 9.17362 3.45582 9.11501 3.51443C9.05641 3.57303 8.97692 3.60596 8.89404 3.60596H2.64404C2.56116 3.60596 2.48168 3.57303 2.42307 3.51443C2.36447 3.45582 2.33154 3.37634 2.33154 3.29346V2.66846Z" fill="#556476" />
                                                            </svg>

                                                            <span class="item-label">Activity</span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </li>
                                            <li class="nav-item w-100" role="presentation">
                                                <button class="nav-link filter-button" id="email-tab-tab" data-bs-toggle="pill" data-bs-target="#email-tab" type="button" role="tab" aria-controls="email-tab" aria-selected="false">
                                                    <div class="menu-item email-item">
                                                        <div class="item-content">
                                                            <svg width="20" height="20" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M2.76904 3.80798L5.82304 6.11398L5.82404 6.11498C6.16304 6.36348 6.33254 6.48798 6.51854 6.53598C6.68284 6.5785 6.85525 6.5785 7.01954 6.53598C7.20554 6.48798 7.37554 6.36348 7.71554 6.11398C7.71554 6.11398 9.67404 4.61098 10.769 3.80798M2.26904 8.70798V4.90798C2.26904 4.34798 2.26904 4.06798 2.37804 3.85398C2.47404 3.66548 2.62654 3.51298 2.81504 3.41698C3.02904 3.30798 3.30904 3.30798 3.86904 3.30798H9.66904C10.229 3.30798 10.509 3.30798 10.7225 3.41698C10.911 3.51298 11.064 3.66548 11.16 3.85398C11.269 4.06748 11.269 4.34748 11.269 4.90648V8.70998C11.269 9.26898 11.269 9.54798 11.16 9.76198C11.064 9.95021 10.9109 10.1032 10.7225 10.199C10.509 10.308 10.2295 10.308 9.67054 10.308H3.86754C3.30854 10.308 3.02854 10.308 2.81504 10.199C2.62689 10.1031 2.47391 9.95014 2.37804 9.76198C2.26904 9.54798 2.26904 9.26798 2.26904 8.70798Z" stroke="#556476" stroke-width="0.772298" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>

                                                            <span class="item-label">Email</span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </li>
                                            <li class="nav-item w-100" role="presentation">
                                                <button class="nav-link filter-button" id="file-tab-tab" data-bs-toggle="pill" data-bs-target="#file-tab" type="button" role="tab" aria-controls="file-tab" aria-selected="false">
                                                    <div class="menu-item quote-item">
                                                        <div class="item-content">
                                                            <svg width="22" height="22" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8.5414 5.36849L6.30782 7.55832C6.09548 7.76832 5.97882 8.05532 5.98348 8.35691C5.98985 8.662 6.11549 8.95245 6.33348 9.16599C6.55223 9.38241 6.84682 9.50666 7.1519 9.51191C7.30125 9.51505 7.44972 9.48828 7.58857 9.43319C7.72742 9.37809 7.85384 9.29577 7.9604 9.19107L10.1934 7.00124C10.4041 6.79284 10.5702 6.5438 10.6817 6.26925C10.7932 5.9947 10.8478 5.70035 10.8421 5.40407C10.8298 4.79386 10.5789 4.21274 10.1432 3.78533C9.70634 3.35299 9.11977 3.10545 8.50523 3.09408C8.20685 3.08812 7.91028 3.14169 7.63284 3.25167C7.3554 3.36164 7.10267 3.52581 6.8894 3.73458L4.65465 5.92499C4.3389 6.23775 4.0899 6.61134 3.92276 7.02315C3.75561 7.43495 3.67378 7.87639 3.68223 8.32074C3.70102 9.23584 4.07753 10.1072 4.73107 10.748C5.38607 11.3963 6.26546 11.7677 7.1869 11.7852C7.63465 11.7945 8.07975 11.7144 8.49614 11.5495C8.91253 11.3846 9.29183 11.1383 9.61182 10.825L11.8454 8.63399" stroke="#556476" stroke-width="0.683775" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>


                                                            <span class="item-label">File</span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </li>
                                            <li class="nav-item w-100" role="presentation">
                                                <button class="nav-link filter-button" id="quote-tab-tab" data-bs-toggle="pill" data-bs-target="#quote-tab" type="button" role="tab" aria-controls="quote-tab" aria-selected="false">
                                                    <div class="menu-item quote-item">
                                                        <div class="item-content">
                                                            <svg width="18" height="18" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10.7773 1.08716C10.2208 1.08716 9.76929 2.43016 9.76929 4.08716H10.7773C11.2633 4.08716 11.5058 4.08716 11.6563 3.91966C11.8063 3.75166 11.7803 3.53066 11.7283 3.08916C11.5893 1.92216 11.2163 1.08716 10.7773 1.08716Z" stroke="#556476" stroke-width="0.53418" stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M9.76904 4.11404V9.41004C9.76904 10.1655 9.76904 10.5435 9.53804 10.6925C9.16054 10.9355 8.57704 10.4255 8.28354 10.2405C8.04104 10.0875 7.92004 10.0115 7.78554 10.007C7.64004 10.002 7.51654 10.0755 7.25454 10.2405L6.29904 10.843C6.04104 11.0055 5.91254 11.087 5.76904 11.087C5.62554 11.087 5.49654 11.0055 5.23904 10.843L4.28404 10.2405C4.04104 10.0875 3.92004 10.0115 3.78554 10.007C3.64004 10.002 3.51654 10.0755 3.25454 10.2405C2.96104 10.4255 2.37754 10.9355 1.99954 10.6925C1.76904 10.5435 1.76904 10.166 1.76904 9.41004V4.11404C1.76904 2.68704 1.76904 1.97404 2.20854 1.53054C2.64754 1.08704 3.35504 1.08704 4.76904 1.08704H10.769" stroke="#556476" stroke-width="0.53418" stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M5.76929 4.08716C5.21679 4.08716 4.76929 4.42316 4.76929 4.83716C4.76929 5.25116 5.21679 5.58716 5.76929 5.58716C6.32179 5.58716 6.76929 5.92316 6.76929 6.33716C6.76929 6.75116 6.32179 7.08716 5.76929 7.08716M5.76929 4.08716C6.20429 4.08716 6.57529 4.29566 6.71229 4.58716M5.76929 4.08716V3.58716M5.76929 7.08716C5.33429 7.08716 4.96329 6.87866 4.82629 6.58716M5.76929 7.08716V7.58716" stroke="#556476" stroke-width="0.53418" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>

                                                            <span class="item-label">Quote</span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </li>
                                        </ul>
                                    </section>
                                </nav>
                            </div>
                        </div>
                        <!-- </article> -->
                        <!-- </div> -->
                    </div>








                    <!-- <div class="col-12 bottom-actions-bar">
                            <div class="d-flex gap-2 mt-3 justify-content-between">
                                <div>
                                    <button type="submit" class="btn clear-all-btn">Clear All</button>
                                </div>
                                <div>
                                    <button type="submit" class="btn save-btn">Save</button>
                                    <button type="submit" class="btn cancel-btn">Cancel</button>
                                </div>

                            </div>

                        </div> -->

                </div>













                <!-- Events -->
                <div class="card card-default mb-4">
                    <div class="card-body col-12">
                        <div>
                            <h5 class="mb-3 card-title">All Events</h5>

                        </div>
                        <!-- <article class="project-card"> -->
                        <!-- <div class="card-background"></div> -->
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="note-tab" role="tabpanel" aria-labelledby="note-tab-tab" tabindex="0">
                                <div class="col-12">
                                    <h5 class="section-title">
                                        Notes
                                    </h5>
                                    <div class="d-flex">
                                        <div class="col-5">
                                            <div class="d-flex gap-3 align-items-center mb-3">
                                                <img src="../images/59e667844c3a56e1c4259df1377aa6569decc3a1.png" class="rounded-circle object-fit-cover" alt="..." width="30" height="30">

                                                <p class="person-name">Robert Bacins</p>
                                            </div>
                                        </div>
                                        <div class="col-4 event-timestamp mb-3">
                                            <span>May 26, 2025 10:00</span>
                                            <span>></span>
                                            <span>Warranty Claimed</span>
                                        </div>
                                    </div>

                                    <div class="d-flex">
                                        <div class="col-5">
                                            <div class="d-flex gap-3 align-items-center mb-3">
                                                <img src="../images/59e667844c3a56e1c4259df1377aa6569decc3a1.png" class="rounded-circle object-fit-cover" alt="..." width="30" height="30">

                                                <p class="person-name">Robert Bacins</p>
                                            </div>
                                        </div>
                                        <div class="col-4 event-timestamp mb-3">
                                            <span>May 26, 2025 10:00</span>
                                            <span>></span>
                                            <span>Warranty Claimed</span>
                                        </div>
                                    </div>


                                </div>
                                <div class="d-flex align-items-center mb-3 position-relative mt-4">

                                    <div class="col-12 col-md-3 col-lg-6">
                                        <section class="primary-info">
                                            <h5 class="section-title">
                                                Calls
                                            </h5>
                                            <div class="title-section">
                                                <h3 class="field-label">Title</h3>
                                                <p class="project-title">Project 1</p>
                                            </div>

                                            <div class="terms-section">
                                                <h3 class="field-label">From</h3>
                                                <p class="field-value">User 1</p>
                                            </div>

                                            <div class="start-date-section">
                                                <h3 class="field-label">Participants</h3>
                                                <p class="field-value">User 1, User 2, User 3</p>
                                            </div>




                                        </section>

                                    </div>

                                    <div class="col-12 col-md-3 col-lg-4">
                                        <section class="secondary-info">
                                            <div class="terms-section">
                                                <h3 class="field-label">Location</h3>
                                                <p class="field-value">Havelock City Mall</p>
                                            </div>
                                            <div class="terms-section">
                                                <h3 class="field-label">To</h3>
                                                <p class="field-value">User 2</p>
                                            </div>
                                            <div class="start-date-section">
                                                <h3 class="field-label">Description</h3>
                                                <p class="field-value">{{$lead->description}}</p>
                                            </div>
                                        </section>

                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="activity-tab" role="tabpanel" aria-labelledby="activity-tab-tab" tabindex="0">
                                <h3>Tab 2</h3>
                                <section class="primary-info">
                                    <div class="title-section">
                                        <h3 class="field-label">Title</h3>
                                        <p class="project-title">Design Dashboard Wireframe for Egoagri</p>
                                    </div>

                                    <div class="status-section mb-3">
                                        <h3 class="field-label mb-0">Status</h3>
                                        <span class="priority-badge urgent">Urgent</span>
                                    </div>

                                    <div class="terms-section">
                                        <h3 class="field-label">Terms</h3>
                                        <p class="field-value">None</p>
                                    </div>

                                    <div class="start-date-section">
                                        <h3 class="field-label">Start Date</h3>
                                        <p class="field-value">May 26, 2025</p>
                                    </div>

                                    <div class="duration-section">
                                        <h3 class="field-label">Duration</h3>
                                        <p class="field-value">5 months</p>
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane fade" id="email-tab" role="tabpanel" aria-labelledby="email-tab-tab" tabindex="0">
                                <h3>Tab 3</h3>
                                <section class="primary-info">
                                    <div class="title-section">
                                        <h3 class="field-label">Title</h3>
                                        <p class="project-title">Design Dashboard Wireframe for Egoagri</p>
                                    </div>

                                    <div class="status-section mb-3">
                                        <h3 class="field-label mb-0">Status</h3>
                                        <span class="priority-badge urgent">Urgent</span>
                                    </div>

                                    <div class="terms-section">
                                        <h3 class="field-label">Terms</h3>
                                        <p class="field-value">None</p>
                                    </div>

                                    <div class="start-date-section">
                                        <h3 class="field-label">Start Date</h3>
                                        <p class="field-value">May 26, 2025</p>
                                    </div>

                                    <div class="duration-section">
                                        <h3 class="field-label">Duration</h3>
                                        <p class="field-value">5 months</p>
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane fade" id="file-tab" role="tabpanel" aria-labelledby="file-tab-tab" tabindex="0">
                                <h3>Tab 4</h3>
                                <section class="primary-info">
                                    <div class="title-section">
                                        <h3 class="field-label">Title</h3>
                                        <p class="project-title">Design Dashboard Wireframe for Egoagri</p>
                                    </div>

                                    <div class="status-section mb-3">
                                        <h3 class="field-label mb-0">Status</h3>
                                        <span class="priority-badge urgent">Urgent</span>
                                    </div>

                                    <div class="terms-section">
                                        <h3 class="field-label">Terms</h3>
                                        <p class="field-value">None</p>
                                    </div>

                                    <div class="start-date-section">
                                        <h3 class="field-label">Start Date</h3>
                                        <p class="field-value">May 26, 2025</p>
                                    </div>

                                    <div class="duration-section">
                                        <h3 class="field-label">Duration</h3>
                                        <p class="field-value">5 months</p>
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane fade" id="quote-tab" role="tabpanel" aria-labelledby="quote-tab-tab" tabindex="0">
                                <h3>Tab 5</h3>
                                <section class="primary-info">
                                    <div class="title-section">
                                        <h3 class="field-label">Title</h3>
                                        <p class="project-title">Design Dashboard Wireframe for Egoagri</p>
                                    </div>

                                    <div class="status-section mb-3">
                                        <h3 class="field-label mb-0">Status</h3>
                                        <span class="priority-badge urgent">Urgent</span>
                                    </div>

                                    <div class="terms-section">
                                        <h3 class="field-label">Terms</h3>
                                        <p class="field-value">None</p>
                                    </div>

                                    <div class="start-date-section">
                                        <h3 class="field-label">Start Date</h3>
                                        <p class="field-value">May 26, 2025</p>
                                    </div>

                                    <div class="duration-section">
                                        <h3 class="field-label">Duration</h3>
                                        <p class="field-value">5 months</p>
                                    </div>
                                </section>
                            </div>
                        </div>






                        <div class="action-buttons position-absolute d-flex gap-2">
                            <button class="action-btn edit-btn" aria-label="Edit project" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample2" aria-expanded="false" aria-controls="collapseWidthExample">
                                <svg width="40" height="40" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="26" height="26" rx="5" fill="#E8E9EB" />
                                    <path d="M14.1033 17.8408C14.0043 17.8408 13.9073 17.8136 13.8227 17.7623L12.0168 16.679C11.8136 16.5564 11.6454 16.3836 11.5284 16.1771C11.4114 15.9707 11.3496 15.7376 11.3489 15.5003V13.0493C11.3492 12.8763 11.2955 12.7075 11.1951 12.5666L8.67361 9.02304C8.61473 8.94124 8.57959 8.84476 8.57208 8.74425C8.56456 8.64374 8.58496 8.54311 8.63102 8.45346C8.67708 8.36381 8.74701 8.28862 8.83309 8.2362C8.91917 8.18378 9.01807 8.15615 9.11886 8.15638H16.8809C16.9818 8.15596 17.0808 8.18346 17.167 8.23584C17.2532 8.28822 17.3233 8.36344 17.3694 8.45316C17.4155 8.54288 17.4358 8.64361 17.4282 8.74419C17.4206 8.84478 17.3853 8.94129 17.3262 9.02304L14.8047 12.5666C14.7041 12.7074 14.6502 12.8762 14.6504 13.0493V17.2927C14.6502 17.4378 14.5926 17.577 14.49 17.6797C14.3875 17.7825 14.2484 17.8404 14.1033 17.8408ZM9.11886 8.70075L11.636 12.2525C11.8028 12.4845 11.8919 12.7634 11.8906 13.0493V15.4998C11.8908 15.6435 11.9281 15.7848 11.999 15.9099C12.0699 16.035 12.1719 16.1396 12.2952 16.2137L14.1011 17.297L14.1087 13.0487C14.1075 12.7628 14.1968 12.4839 14.3638 12.2519L16.8847 8.70834L9.11886 8.70075Z" fill="black" />
                                </svg>


                            </button>




                            <div class="create-menu-container collapse" id="collapseWidthExample2">
                                <nav class="create-menu">
                                    <header class="menu-header">FILTER</header>
                                    <section class="menu-content">
                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                            <li class="nav-item w-100" role="presentation">
                                                <button class="nav-link active filter-button" id="all-tab" data-bs-toggle="pill" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">
                                                    <div class="menu-item activity-item">
                                                        <div class="item-content">
                                                            <svg width="18" height="18" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M5.26919 3.41277H10.7692M2.66919 3.31277L3.06919 3.71277L4.06919 2.71277M2.66919 6.31277L3.06919 6.71277L4.06919 5.71277M2.66919 9.31277L3.06919 9.71277L4.06919 8.71277M5.26919 6.41277H10.7692M5.26919 9.41277H10.7692" stroke="#4A58EC" stroke-width="0.603943" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>



                                                            <span class="item-label">All</span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </li>
                                            <li class="nav-item w-100" role="presentation">
                                                <button class="nav-link filter-button" id="note2-tab" data-bs-toggle="pill" data-bs-target="#note2" type="button" role="tab" aria-controls="note2" aria-selected="true">
                                                    <div class="menu-item activity-item">
                                                        <div class="item-content">
                                                            <svg width="20" height="20" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M3.76904 11.1685C3.49404 11.1685 3.25871 11.0706 3.06304 10.875C2.86738 10.6793 2.76938 10.4438 2.76904 10.1685V2.16846C2.76904 1.89346 2.86704 1.65812 3.06304 1.46246C3.25904 1.26679 3.49438 1.16879 3.76904 1.16846H7.76904L10.769 4.16846V10.1685C10.769 10.4435 10.6712 10.679 10.4755 10.875C10.2799 11.071 10.0444 11.1688 9.76904 11.1685H3.76904ZM7.26904 4.66846V2.16846H3.76904V10.1685H9.76904V4.66846H7.26904Z" fill="#556476" />
                                                            </svg>


                                                            <span class="item-label">Note</span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </li>
                                            <li class="nav-item w-100" role="presentation">
                                                <button class="nav-link filter-button" id="calls-tab" data-bs-toggle="pill" data-bs-target="#calls" type="button" role="tab" aria-controls="calls" aria-selected="false">
                                                    <div class="menu-item activity-item">
                                                        <div class="item-content">
                                                            <svg width="18" height="18" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M3.55411 4.75147C3.41123 3.80872 4.07648 2.96047 5.09273 2.64922C5.27317 2.59399 5.46788 2.60968 5.63715 2.6931C5.80641 2.77651 5.93748 2.92136 6.00361 3.09809L6.32948 3.96809C6.38187 4.10804 6.39127 4.26045 6.35646 4.40577C6.32165 4.55109 6.24422 4.6827 6.13411 4.78372L5.16473 5.67284C5.11683 5.7167 5.08115 5.77224 5.06116 5.83403C5.04118 5.89582 5.03758 5.96175 5.05073 6.02534L5.05936 6.06434L5.08336 6.16222C5.10473 6.24472 5.13698 6.36097 5.18236 6.49972C5.27236 6.77534 5.41598 7.14584 5.62973 7.51597C5.84348 7.88609 6.09248 8.19584 6.28598 8.41147C6.38684 8.52366 6.49218 8.63175 6.60173 8.73547L6.63173 8.76322C6.68022 8.80616 6.739 8.83581 6.80235 8.84928C6.86571 8.86275 6.93147 8.85959 6.99323 8.84009L8.24798 8.44522C8.39054 8.4004 8.54324 8.3992 8.68649 8.44176C8.82975 8.48432 8.95702 8.56871 9.05198 8.68409L9.64561 9.40484C9.89311 9.70484 9.86386 10.1458 9.57923 10.411C8.80148 11.1358 7.73198 11.2847 6.98798 10.6862C6.07625 9.95047 5.30749 9.05345 4.71998 8.03984C4.12816 7.02659 3.73263 5.91124 3.55411 4.75147ZM5.83636 6.07447L6.64111 5.33647C6.86134 5.13443 7.01619 4.87121 7.08581 4.58057C7.15543 4.28992 7.13664 3.98511 7.03186 3.70522L6.70561 2.83522C6.57251 2.47977 6.30886 2.18845 5.96841 2.02067C5.62795 1.85288 5.23633 1.82125 4.87336 1.93222C3.61148 2.31884 2.59823 3.45022 2.81273 4.86359C3.00528 6.11681 3.43236 7.32249 4.07161 8.41747C4.70528 9.51053 5.53442 10.4778 6.51773 11.2712C7.63336 12.1675 9.12361 11.8618 10.0907 10.96C10.3676 10.7021 10.5357 10.3484 10.5605 9.97083C10.5854 9.59331 10.4653 9.22053 10.2246 8.92859L9.63098 8.20784C9.44102 7.977 9.18642 7.80818 8.89984 7.72306C8.61326 7.63793 8.30778 7.64038 8.02261 7.73009L6.98123 8.05784C6.93461 8.00991 6.88897 7.96103 6.84436 7.91122C6.63026 7.6745 6.4409 7.41654 6.27923 7.14134C6.12166 6.86369 5.99287 6.57067 5.89486 6.26684C5.87404 6.20325 5.85454 6.13924 5.83636 6.07484" fill="#556476" />
                                                            </svg>


                                                            <span class="item-label">Calls</span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </li>
                                            <li class="nav-item w-100" role="presentation">
                                                <button class="nav-link filter-button" id="meetings-tab" data-bs-toggle="pill" data-bs-target="#meetings" type="button" role="tab" aria-controls="meetings" aria-selected="false">
                                                    <div class="menu-item activity-item">
                                                        <div class="item-content">
                                                            <svg width="18" height="18" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M4.34504 2.63901L4.35254 2.63451L4.38704 2.61426C4.41754 2.59576 4.46379 2.57001 4.52579 2.53701C4.64954 2.47176 4.82954 2.38401 5.05229 2.29701C5.50154 2.11851 6.10979 1.94751 6.76904 1.94751C7.42829 1.94751 8.03654 2.12001 8.48579 2.29626C8.71472 2.38654 8.93702 2.4928 9.15104 2.61426C9.16654 2.62276 9.17779 2.62951 9.18479 2.63451L9.19229 2.63901H9.19304C9.27694 2.69006 9.37752 2.70616 9.47316 2.68385C9.56881 2.66154 9.65188 2.60259 9.70453 2.51969C9.75718 2.43679 9.7752 2.33653 9.75473 2.24048C9.73426 2.14443 9.67692 2.06024 9.59504 2.00601L9.59279 2.00451L9.58904 2.00226L9.57554 1.99401L9.52979 1.96626C9.28258 1.8257 9.02568 1.70289 8.76104 1.59876C8.25704 1.40001 7.55279 1.19751 6.76904 1.19751C5.98529 1.19751 5.28029 1.40001 4.77779 1.59876C4.5129 1.70285 4.25575 1.82566 4.00829 1.96626L3.96254 1.99401L3.94904 2.00151L3.94529 2.00451L3.94379 2.00526C3.85975 2.05847 3.80029 2.14288 3.77849 2.23993C3.75669 2.33698 3.77433 2.43872 3.82754 2.52276C3.88075 2.6068 3.96517 2.66626 4.06222 2.68806C4.15927 2.70986 4.261 2.69222 4.34504 2.63901ZM3.76904 3.44751C3.37122 3.44751 2.98969 3.60555 2.70838 3.88685C2.42708 4.16815 2.26904 4.54969 2.26904 4.94751V7.94751C2.26904 8.34533 2.42708 8.72687 2.70838 9.00817C2.98969 9.28947 3.37122 9.44751 3.76904 9.44751H7.14404C7.54187 9.44751 7.9234 9.28947 8.2047 9.00817C8.48601 8.72687 8.64404 8.34533 8.64404 7.94751V7.84401L10.708 9.02301C10.7651 9.05558 10.8296 9.07261 10.8953 9.07239C10.961 9.07217 11.0254 9.0547 11.0822 9.02175C11.139 8.98879 11.1862 8.94149 11.219 8.88459C11.2518 8.82769 11.269 8.76318 11.269 8.69751V4.19751C11.269 4.13184 11.2518 4.06733 11.219 4.01043C11.1862 3.95353 11.139 3.90623 11.0822 3.87327C11.0254 3.84032 10.961 3.82285 10.8953 3.82263C10.8296 3.82241 10.7651 3.83944 10.708 3.87201L8.64404 5.05101V4.94751C8.64404 4.54969 8.48601 4.16815 8.2047 3.88685C7.9234 3.60555 7.54187 3.44751 7.14404 3.44751H3.76904ZM8.64404 5.91501L10.519 4.84401V8.05101L8.64404 6.98001V5.91501ZM3.01904 4.94751C3.01904 4.7486 3.09806 4.55783 3.23871 4.41718C3.37937 4.27653 3.57013 4.19751 3.76904 4.19751H7.14404C7.34296 4.19751 7.53372 4.27653 7.67437 4.41718C7.81503 4.55783 7.89404 4.7486 7.89404 4.94751V7.94751C7.89404 8.14642 7.81503 8.33719 7.67437 8.47784C7.53372 8.61849 7.34296 8.69751 7.14404 8.69751H3.76904C3.57013 8.69751 3.37937 8.61849 3.23871 8.47784C3.09806 8.33719 3.01904 8.14642 3.01904 7.94751V4.94751ZM4.34579 10.2568L4.34504 10.256C4.26114 10.205 4.16057 10.1889 4.06492 10.2112C3.96928 10.2335 3.88621 10.2924 3.83356 10.3753C3.78091 10.4582 3.76288 10.5585 3.78335 10.6545C3.80383 10.7506 3.86116 10.8348 3.94304 10.889L3.94529 10.8905L3.94904 10.8928L3.96254 10.901C3.97304 10.908 3.98829 10.9173 4.00829 10.9288C4.04829 10.9518 4.10429 10.9828 4.17629 11.0218C4.31954 11.0968 4.52504 11.1965 4.77779 11.2963C5.28029 11.4943 5.98529 11.6975 6.76904 11.6975C7.55354 11.6975 8.25779 11.495 8.76029 11.2963C9.02518 11.1922 9.28233 11.0694 9.52979 10.9288L9.57554 10.901L9.58904 10.8935L9.59279 10.8905L9.59429 10.8898C9.67833 10.8365 9.73851 10.7519 9.76024 10.6548C9.78197 10.5577 9.76423 10.4559 9.71092 10.3719C9.65761 10.2878 9.5731 10.2284 9.47598 10.2067C9.37886 10.185 9.27708 10.2027 9.19304 10.256L9.18554 10.2613L9.15104 10.2808C9.12054 10.2993 9.07429 10.325 9.01229 10.358C8.84134 10.4476 8.66557 10.5277 8.48579 10.598C8.03654 10.7765 7.42829 10.9475 6.76904 10.9475C6.10979 10.9475 5.50154 10.775 5.05229 10.5988C4.82336 10.5085 4.60107 10.4022 4.38704 10.2808L4.35329 10.2605L4.34579 10.2568Z" fill="#556476" />
                                                            </svg>


                                                            <span class="item-label">Meetings</span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </li>
                                            <li class="nav-item w-100" role="presentation">
                                                <button class="nav-link filter-button" id="lunches-tab" data-bs-toggle="pill" data-bs-target="#lunches" type="button" role="tab" aria-controls="lunches" aria-selected="false">
                                                    <div class="menu-item activity-item">
                                                        <div class="item-content">
                                                            <svg width="18" height="18" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.769 7.09054H2.80604V7.09104H2.26904C2.13643 7.09104 2.00926 7.14372 1.91549 7.23749C1.82172 7.33126 1.76904 7.45843 1.76904 7.59104C1.76904 7.72365 1.82172 7.85083 1.91549 7.9446C2.00926 8.03836 2.13643 8.09104 2.26904 8.09104H2.80604C2.80657 8.75374 3.0702 9.38911 3.53898 9.85752C4.00777 10.3259 4.64335 10.589 5.30604 10.589H8.26904C8.93174 10.589 9.56732 10.3259 10.0361 9.85752C10.5049 9.38911 10.7685 8.75374 10.769 8.09104H11.269C11.4017 8.09104 11.5288 8.03836 11.6226 7.9446C11.7164 7.85083 11.769 7.72365 11.769 7.59104C11.769 7.45843 11.7164 7.33126 11.6226 7.23749C11.5288 7.14372 11.4017 7.09104 11.269 7.09104L10.769 7.09054ZM9.76904 8.09054H3.80604C3.80657 8.48802 3.96484 8.86904 4.24609 9.14991C4.52734 9.43078 4.90857 9.58854 5.30604 9.58854H8.26904C8.66652 9.58854 9.04775 9.43078 9.329 9.14991C9.61024 8.86904 9.76851 8.48802 9.76904 8.09054ZM7.23204 2.25554L7.02004 2.56454C6.80154 2.88354 6.78404 3.14204 6.81704 3.33304C6.85304 3.53704 6.95254 3.69554 7.01904 3.79204L7.03004 3.80754C7.11004 3.92204 7.27354 4.15754 7.33304 4.49254C7.39754 4.85554 7.33304 5.28854 7.03104 5.78554L6.83604 6.10554L6.19604 5.71654L6.39054 5.39604C6.61104 5.03304 6.62304 4.78304 6.59454 4.62304C6.56454 4.45254 6.48104 4.33204 6.40454 4.22104L6.40254 4.21904C6.31754 4.09604 6.14254 3.82904 6.07854 3.46154C6.01204 3.08154 6.07054 2.62354 6.40154 2.14054L6.61354 1.83154L7.23204 2.25554ZM4.83654 3.03404L4.62454 3.34304C4.47204 3.56554 4.46354 3.73804 4.48504 3.86004C4.50854 3.99554 4.57504 4.10304 4.62354 4.17304L4.63254 4.18554C4.69354 4.27354 4.82804 4.46654 4.87704 4.74054C4.93004 5.04054 4.87504 5.39204 4.63604 5.78554L4.44104 6.10554L3.80004 5.71654L3.99504 5.39604C4.15304 5.13604 4.15554 4.96854 4.13854 4.87104C4.11854 4.76254 4.06604 4.68504 4.00704 4.60004C3.8769 4.41764 3.78786 4.20918 3.74604 3.98904C3.69204 3.67704 3.74104 3.30554 4.00604 2.91904L4.21854 2.60954L4.83654 3.03404ZM9.62504 3.03404L9.41304 3.34304C9.26054 3.56554 9.25204 3.73804 9.27304 3.86004C9.29711 3.9781 9.34753 4.0892 9.42054 4.18504C9.48204 4.27354 9.61654 4.46654 9.66554 4.74004C9.71854 5.04054 9.66354 5.39204 9.42404 5.78504L9.22904 6.10604L8.58854 5.71604L8.78354 5.39604C8.94104 5.13604 8.94354 4.96854 8.92654 4.87104C8.90704 4.76254 8.85454 4.68504 8.79554 4.60004C8.6654 4.41764 8.57636 4.20918 8.53454 3.98904C8.48004 3.67704 8.52954 3.30554 8.79454 2.91904L9.00654 2.60954L9.62504 3.03404Z" fill="#556476" />
                                                            </svg>


                                                            <span class="item-label">Lunches</span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </li>
                                            <li class="nav-item w-100" role="presentation">
                                                <button class="nav-link filter-button" id="email2-tab" data-bs-toggle="pill" data-bs-target="#email2" type="button" role="tab" aria-controls="email2" aria-selected="false">
                                                    <div class="menu-item email-item">
                                                        <div class="item-content">
                                                            <svg width="20" height="20" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M2.76904 3.80798L5.82304 6.11398L5.82404 6.11498C6.16304 6.36348 6.33254 6.48798 6.51854 6.53598C6.68284 6.5785 6.85525 6.5785 7.01954 6.53598C7.20554 6.48798 7.37554 6.36348 7.71554 6.11398C7.71554 6.11398 9.67404 4.61098 10.769 3.80798M2.26904 8.70798V4.90798C2.26904 4.34798 2.26904 4.06798 2.37804 3.85398C2.47404 3.66548 2.62654 3.51298 2.81504 3.41698C3.02904 3.30798 3.30904 3.30798 3.86904 3.30798H9.66904C10.229 3.30798 10.509 3.30798 10.7225 3.41698C10.911 3.51298 11.064 3.66548 11.16 3.85398C11.269 4.06748 11.269 4.34748 11.269 4.90648V8.70998C11.269 9.26898 11.269 9.54798 11.16 9.76198C11.064 9.95021 10.9109 10.1032 10.7225 10.199C10.509 10.308 10.2295 10.308 9.67054 10.308H3.86754C3.30854 10.308 3.02854 10.308 2.81504 10.199C2.62689 10.1031 2.47391 9.95014 2.37804 9.76198C2.26904 9.54798 2.26904 9.26798 2.26904 8.70798Z" stroke="#556476" stroke-width="0.772298" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>

                                                            <span class="item-label">Email</span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </li>
                                            <li class="nav-item w-100" role="presentation">
                                                <button class="nav-link filter-button" id="file2-tab" data-bs-toggle="pill" data-bs-target="#file2" type="button" role="tab" aria-controls="file2" aria-selected="false">
                                                    <div class="menu-item quote-item">
                                                        <div class="item-content">
                                                            <svg width="22" height="22" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8.5414 5.36849L6.30782 7.55832C6.09548 7.76832 5.97882 8.05532 5.98348 8.35691C5.98985 8.662 6.11549 8.95245 6.33348 9.16599C6.55223 9.38241 6.84682 9.50666 7.1519 9.51191C7.30125 9.51505 7.44972 9.48828 7.58857 9.43319C7.72742 9.37809 7.85384 9.29577 7.9604 9.19107L10.1934 7.00124C10.4041 6.79284 10.5702 6.5438 10.6817 6.26925C10.7932 5.9947 10.8478 5.70035 10.8421 5.40407C10.8298 4.79386 10.5789 4.21274 10.1432 3.78533C9.70634 3.35299 9.11977 3.10545 8.50523 3.09408C8.20685 3.08812 7.91028 3.14169 7.63284 3.25167C7.3554 3.36164 7.10267 3.52581 6.8894 3.73458L4.65465 5.92499C4.3389 6.23775 4.0899 6.61134 3.92276 7.02315C3.75561 7.43495 3.67378 7.87639 3.68223 8.32074C3.70102 9.23584 4.07753 10.1072 4.73107 10.748C5.38607 11.3963 6.26546 11.7677 7.1869 11.7852C7.63465 11.7945 8.07975 11.7144 8.49614 11.5495C8.91253 11.3846 9.29183 11.1383 9.61182 10.825L11.8454 8.63399" stroke="#556476" stroke-width="0.683775" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>


                                                            <span class="item-label">File</span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </li>
                                            <li class="nav-item w-100" role="presentation">
                                                <button class="nav-link filter-button" id="quote2-tab" data-bs-toggle="pill" data-bs-target="#quote2" type="button" role="tab" aria-controls="quote2" aria-selected="false">
                                                    <div class="menu-item quote-item">
                                                        <div class="item-content">
                                                            <svg width="18" height="18" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10.7773 1.08716C10.2208 1.08716 9.76929 2.43016 9.76929 4.08716H10.7773C11.2633 4.08716 11.5058 4.08716 11.6563 3.91966C11.8063 3.75166 11.7803 3.53066 11.7283 3.08916C11.5893 1.92216 11.2163 1.08716 10.7773 1.08716Z" stroke="#556476" stroke-width="0.53418" stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M9.76904 4.11404V9.41004C9.76904 10.1655 9.76904 10.5435 9.53804 10.6925C9.16054 10.9355 8.57704 10.4255 8.28354 10.2405C8.04104 10.0875 7.92004 10.0115 7.78554 10.007C7.64004 10.002 7.51654 10.0755 7.25454 10.2405L6.29904 10.843C6.04104 11.0055 5.91254 11.087 5.76904 11.087C5.62554 11.087 5.49654 11.0055 5.23904 10.843L4.28404 10.2405C4.04104 10.0875 3.92004 10.0115 3.78554 10.007C3.64004 10.002 3.51654 10.0755 3.25454 10.2405C2.96104 10.4255 2.37754 10.9355 1.99954 10.6925C1.76904 10.5435 1.76904 10.166 1.76904 9.41004V4.11404C1.76904 2.68704 1.76904 1.97404 2.20854 1.53054C2.64754 1.08704 3.35504 1.08704 4.76904 1.08704H10.769" stroke="#556476" stroke-width="0.53418" stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M5.76929 4.08716C5.21679 4.08716 4.76929 4.42316 4.76929 4.83716C4.76929 5.25116 5.21679 5.58716 5.76929 5.58716C6.32179 5.58716 6.76929 5.92316 6.76929 6.33716C6.76929 6.75116 6.32179 7.08716 5.76929 7.08716M5.76929 4.08716C6.20429 4.08716 6.57529 4.29566 6.71229 4.58716M5.76929 4.08716V3.58716M5.76929 7.08716C5.33429 7.08716 4.96329 6.87866 4.82629 6.58716M5.76929 7.08716V7.58716" stroke="#556476" stroke-width="0.53418" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>

                                                            <span class="item-label">Quote</span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </li>
                                        </ul>
                                    </section>
                                </nav>
                            </div>
                        </div>
                        <!-- </article> -->
                        <!-- </div> -->
                    </div>

                </div>

                <div class="card card-default mb-4 ">
                    <div class="card-body col-12">
                        <div>
                            <h5 class="mb-3 card-title">Assigned User</h5>
                        </div>
                        <div class="d-flex">
                            <div class="col-5">
                                <div class="d-flex gap-3 align-items-center mb-3">
                                    <img src="../images/59e667844c3a56e1c4259df1377aa6569decc3a1.png" class="rounded-circle object-fit-cover" alt="..." width="30" height="30">

                                    <p class="person-name">Robert Bacins</p>
                                </div>
                            </div>
                            <div class="col-4 event-timestamp mb-3">
                                <span>May 26, 2025 10:00</span>
                                <span>></span>
                                <span>Warranty Claimed</span>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="col-5">
                                <div class="d-flex gap-3 align-items-center mb-3">
                                    <img src="../images/59e667844c3a56e1c4259df1377aa6569decc3a1.png" class="rounded-circle object-fit-cover" alt="..." width="30" height="30">

                                    <p class="person-name">Robert Bacins</p>
                                </div>
                            </div>
                            <div class="col-4 event-timestamp mb-3">
                                <span>May 26, 2025 10:00</span>
                                <span>></span>
                                <span>Warranty Claimed</span>
                            </div>
                        </div>
                    </div>


                    <div class="action-buttons position-absolute">
                        <button class="action-btn">
                            <svg width="40" height="40" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="26" height="26" rx="5" fill="#E8E9EB" />
                                <path d="M9.20841 16.7918H9.80316L15.5979 10.997L15.0032 10.4023L9.20841 16.197V16.7918ZM8.66675 17.3334V15.9684L15.8059 8.82276C15.8619 8.77328 15.9233 8.73501 15.9901 8.70792C16.0569 8.68084 16.1268 8.66712 16.1997 8.66676C16.2726 8.6664 16.3431 8.67795 16.411 8.70142C16.4796 8.72417 16.5428 8.76534 16.6005 8.82492L17.1785 9.40667C17.2381 9.46409 17.2789 9.52728 17.3009 9.59626C17.3226 9.66487 17.3334 9.73348 17.3334 9.80209C17.3334 9.87576 17.3211 9.94617 17.2966 10.0133C17.2717 10.0801 17.2323 10.1414 17.1785 10.197L10.0312 17.3334H8.66675ZM15.2957 10.7045L15.0032 10.4023L15.5979 10.997L15.2957 10.7045Z" fill="#172635" />
                            </svg>
                        </button>


                    </div>
                </div>



                <div class="card card-default mb-4">
                    <div class="card-body col-12">
                        <div>
                            <h5 class="mb-3 card-title">Activities</h5>
                        </div>
                        <div class="d-flex">
                            <div class="col-5">
                                <div class="d-flex gap-3 align-items-center mb-3">
                                    <img src="../images/59e667844c3a56e1c4259df1377aa6569decc3a1.png" class="rounded-circle object-fit-cover" alt="..." width="30" height="30">

                                    <p class="person-name">Robert Bacins</p>
                                </div>
                            </div>
                            <div class="col-4 event-timestamp mb-3">
                                <span>May 26, 2025 10:00</span>
                                <span>></span>
                                <span>Warranty Claimed</span>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="col-5">
                                <div class="d-flex gap-3 align-items-center mb-3">
                                    <img src="../images/59e667844c3a56e1c4259df1377aa6569decc3a1.png" class="rounded-circle object-fit-cover" alt="..." width="30" height="30">

                                    <p class="person-name">Robert Bacins</p>
                                </div>
                            </div>
                            <div class="col-4 event-timestamp mb-3">
                                <span>May 26, 2025 10:00</span>
                                <span>></span>
                                <span>Warranty Claimed</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>
</div>


@endsection