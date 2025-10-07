@extends('master')

@section('content')
    <?php
    use App\Models\Lead;
    use App\Models\Person;
    
    ?>


    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <style>
        #sortable {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 60%;
        }

        #sortable li {
            margin: 0 3px 3px 3px;
            padding: 0.4em;
            padding-left: 1.5em;
            font-size: 1.4em;
            height: 18px;
        }

        #sortable li span {
            position: absolute;
            margin-left: -1.3em;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>



    <div class="container">
        <div class="main-scrollable">
            <div class="page-container">
                <div class="page-title-container">
                    <div class="d-flex justify-content-between">
                        <h3 class="page-title">
                            Leads
                        </h3>
                        <div class="d-flex gap-3">

                            <button class="import-leads-button">
                                <div class="icon-container">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13.9999 14L11.1046 11.1047M11.1046 11.1047C11.5998 10.6094 11.9927 10.0215 12.2607 9.37436C12.5287 8.72728 12.6667 8.03373 12.6667 7.33333C12.6667 6.63293 12.5287 5.93939 12.2607 5.2923C11.9927 4.64522 11.5998 4.05726 11.1046 3.562C10.6093 3.06674 10.0213 2.67388 9.37426 2.40585C8.72717 2.13782 8.03363 1.99986 7.33323 1.99986C6.63283 1.99986 5.93928 2.13782 5.2922 2.40585C4.64511 2.67388 4.05715 3.06674 3.56189 3.562C2.56167 4.56222 1.99976 5.91881 1.99976 7.33333C1.99976 8.74786 2.56167 10.1044 3.56189 11.1047C4.56211 12.1049 5.9187 12.6668 7.33323 12.6668C8.74775 12.6668 10.1043 12.1049 11.1046 11.1047Z"
                                            stroke="#556476" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>



                                </div>



                                <select class="pipeline-selection tagselect" id="pipeline-select" name="state" required>
                                    @foreach ($pipelines as $pipe)
                                        <option value="{{ $pipe->id }}"
                                            {{ $pipeline->id == $pipe->id ? 'selected' : '' }}>
                                            {{ $pipe->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </button>


                            {{-- import lead button --}}
                            <button class="import-leads-button" data-bs-toggle="modal" data-bs-target=".importLeads">
                                <div class="icon-container">
                                    <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.04372 7.04375C9.08664 6.9977 9.13839 6.96076 9.19589 6.93514C9.25339 6.90952 9.31546 6.89574 9.3784 6.89463C9.44134 6.89352 9.50386 6.9051 9.56222 6.92867C9.62059 6.95225 9.67361 6.98734 9.71812 7.03185C9.76263 7.07636 9.79773 7.12938 9.8213 7.18775C9.84488 7.24612 9.85645 7.30864 9.85534 7.37158C9.85423 7.43452 9.84046 7.49659 9.81484 7.55409C9.78922 7.61159 9.75228 7.66334 9.70622 7.70625L7.83122 9.58125C7.74333 9.66903 7.62419 9.71834 7.49997 9.71834C7.37576 9.71834 7.25662 9.66903 7.16872 9.58125L5.29372 7.70625C5.24767 7.66334 5.21073 7.61159 5.18511 7.55409C5.15949 7.49659 5.14571 7.43452 5.1446 7.37158C5.14349 7.30864 5.15507 7.24612 5.17865 7.18775C5.20222 7.12938 5.23731 7.07636 5.28183 7.03185C5.32634 6.98734 5.37936 6.95225 5.43773 6.92867C5.49609 6.9051 5.55861 6.89352 5.62155 6.89463C5.68449 6.89574 5.74656 6.90952 5.80406 6.93514C5.86156 6.96076 5.91331 6.9977 5.95622 7.04375L7.03122 8.11875V3C7.03122 2.87568 7.08061 2.75645 7.16852 2.66854C7.25643 2.58064 7.37565 2.53125 7.49997 2.53125C7.62429 2.53125 7.74352 2.58064 7.83143 2.66854C7.91934 2.75645 7.96872 2.87568 7.96872 3V8.11875L9.04372 7.04375Z"
                                            fill="#556476" />
                                        <path
                                            d="M12.9688 8C12.9688 7.87568 12.9194 7.75645 12.8315 7.66854C12.7435 7.58064 12.6243 7.53125 12.5 7.53125C12.3757 7.53125 12.2565 7.58064 12.1685 7.66854C12.0806 7.75645 12.0312 7.87568 12.0312 8C12.0312 8.59505 11.914 9.18428 11.6863 9.73403C11.4586 10.2838 11.1248 10.7833 10.7041 11.2041C10.2833 11.6248 9.78379 11.9586 9.23403 12.1863C8.68428 12.414 8.09505 12.5312 7.5 12.5312C6.90495 12.5312 6.31572 12.414 5.76597 12.1863C5.21621 11.9586 4.71669 11.6248 4.29592 11.2041C3.87516 10.7833 3.54139 10.2838 3.31367 9.73403C3.08595 9.18428 2.96875 8.59505 2.96875 8C2.96875 7.87568 2.91936 7.75645 2.83146 7.66854C2.74355 7.58064 2.62432 7.53125 2.5 7.53125C2.37568 7.53125 2.25645 7.58064 2.16854 7.66854C2.08064 7.75645 2.03125 7.87568 2.03125 8C2.03125 9.4504 2.60742 10.8414 3.63301 11.867C4.6586 12.8926 6.0496 13.4688 7.5 13.4688C8.9504 13.4688 10.3414 12.8926 11.367 11.867C12.3926 10.8414 12.9688 9.4504 12.9688 8Z"
                                            fill="#556476" />
                                    </svg>


                                </div>
                                <span class="button-text white-btn-text">Import leads</span>
                            </button>

                            {{-- export lead button --}}
                            {{-- <button class="import-leads-button" data-bs-toggle="modal" data-bs-target=".exportTypes"> --}}



                            <div class="position-relative">

                                <button class="import-leads-button" data-bs-toggle="collapse"
                                    data-bs-target="#exportCollapse" aria-expanded="false" aria-controls="exportCollapse">
                                    <div class="icon-container">
                                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.04378 5.20625C9.08669 5.2523 9.13844 5.28924 9.19594 5.31486C9.25344 5.34048 9.31551 5.35426 9.37845 5.35537C9.44139 5.35648 9.50391 5.3449 9.56227 5.32133C9.62064 5.29775 9.67366 5.26266 9.71817 5.21815C9.76269 5.17364 9.79778 5.12062 9.82135 5.06225C9.84493 5.00388 9.85651 4.94136 9.8554 4.87842C9.85429 4.81548 9.84051 4.75341 9.81489 4.69591C9.78927 4.63841 9.75233 4.58666 9.70628 4.54375L7.83128 2.66875C7.74339 2.58097 7.62425 2.53166 7.50003 2.53166C7.37581 2.53166 7.25667 2.58097 7.16878 2.66875L5.29378 4.54375C5.21098 4.63261 5.1659 4.75014 5.16804 4.87158C5.17018 4.99301 5.21938 5.10888 5.30526 5.19476C5.39115 5.28065 5.50701 5.32984 5.62845 5.33198C5.74989 5.33413 5.86742 5.28905 5.95628 5.20625L7.03128 4.13125V9.25C7.03128 9.37432 7.08066 9.49355 7.16857 9.58146C7.25648 9.66936 7.37571 9.71875 7.50003 9.71875C7.62435 9.71875 7.74357 9.66936 7.83148 9.58146C7.91939 9.49355 7.96878 9.37432 7.96878 9.25V4.13125L9.04378 5.20625Z"
                                                fill="#556476" />
                                            <path
                                                d="M12.9688 8C12.9688 7.87568 12.9194 7.75645 12.8315 7.66854C12.7435 7.58064 12.6243 7.53125 12.5 7.53125C12.3757 7.53125 12.2565 7.58064 12.1685 7.66854C12.0806 7.75645 12.0312 7.87568 12.0312 8C12.0312 8.59505 11.914 9.18428 11.6863 9.73403C11.4586 10.2838 11.1248 10.7833 10.7041 11.2041C10.2833 11.6248 9.78379 11.9586 9.23403 12.1863C8.68428 12.414 8.09505 12.5312 7.5 12.5312C6.90495 12.5312 6.31572 12.414 5.76597 12.1863C5.21621 11.9586 4.71669 11.6248 4.29592 11.2041C3.87516 10.7833 3.54139 10.2838 3.31367 9.73403C3.08595 9.18428 2.96875 8.59505 2.96875 8C2.96875 7.87568 2.91936 7.75645 2.83146 7.66854C2.74355 7.58064 2.62432 7.53125 2.5 7.53125C2.37568 7.53125 2.25645 7.58064 2.16854 7.66854C2.08064 7.75645 2.03125 7.87568 2.03125 8C2.03125 9.4504 2.60742 10.8414 3.63301 11.867C4.6586 12.8926 6.0496 13.4688 7.5 13.4688C8.9504 13.4688 10.3414 12.8926 11.367 11.867C12.3926 10.8414 12.9688 9.4504 12.9688 8Z"
                                                fill="#556476" />
                                        </svg>


                                    </div>
                                    <span class="button-text white-btn-text">{{ __('app.leads.export-leads') }}</span>

                                </button>
                                <div class="collapse exportCollapseDiv position-absolute" id="exportCollapse">
                                    <div class="col-md-12 text-end">
                                        <div class="mb-3 card card-default export-card">
                                            <div class="card-body">
                                                <ul class="export-list list-unstyled">
                                                    <li class="export-item">
                                                        <a href="{{ url('export-leads/excel') }}">
                                                            <svg width="18" height="18" viewBox="0 0 12 12"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M9.31279 1.05611L8.63904 0.308105H3.33319C2.95039 0.308105 2.80244 0.591906 2.80244 0.813555V2.81006H3.54659V1.21726C3.54659 1.13256 3.61809 1.06106 3.70059 1.06106H7.49724C7.58084 1.06106 7.62264 1.07591 7.62264 1.14466V3.79566H10.3248C10.4309 3.79566 10.4722 3.85066 10.4722 3.93096V10.4045C10.4722 10.5398 10.4172 10.5601 10.3347 10.5601H3.70059C3.65968 10.5591 3.62076 10.5423 3.59203 10.5131C3.5633 10.484 3.54701 10.4448 3.54659 10.4039V9.81211H2.80739V10.7444C2.79749 11.0744 2.97349 11.3081 3.33319 11.3081H10.7021C11.0871 11.3081 11.2185 11.0293 11.2185 10.7752V3.16096L11.026 2.95196L9.31279 1.05611ZM8.37889 1.14411L8.59174 1.38281L10.0195 2.95196L10.0982 3.04711H8.63904C8.52904 3.04711 8.45938 3.02877 8.43004 2.99211C8.40071 2.95617 8.38366 2.89879 8.37889 2.81996V1.14411ZM7.77939 6.17496H10.2967V6.90866H7.77884L7.77939 6.17496ZM7.77939 4.70866H10.2967V5.44181H7.77884L7.77939 4.70866ZM7.77939 7.64181H10.2967V8.37551H7.77884L7.77939 7.64181ZM1.31909 3.40241V9.26926H7.07484V3.40241H1.31909ZM4.19724 6.81461L3.84524 7.35251H4.19724V8.00811H2.42789L3.71159 6.07761L2.57419 4.34181H3.52459L4.19779 5.35161L4.87044 4.34181H5.82029L4.68069 6.07761L5.96604 8.00811H4.97989L4.19724 6.81461Z"
                                                                    fill="#556476" />
                                                            </svg>


                                                            Excel</a>
                                                    </li>
                                                    <li class="export-item">
                                                        <a href="{{ url('export-leads/csv') }}">

                                                            <svg width="18" height="18" viewBox="0 0 13 13"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M3.64404 7.66846H5.14404V6.91846H3.89404V5.41846H5.14404V4.66846H3.64404C3.50238 4.66846 3.38371 4.71646 3.28804 4.81246C3.19238 4.90846 3.14438 5.02712 3.14404 5.16846V7.16846C3.14404 7.31012 3.19204 7.42896 3.28804 7.52496C3.38404 7.62096 3.50271 7.66879 3.64404 7.66846ZM5.59404 7.66846H7.09404C7.23571 7.66846 7.35454 7.62046 7.45054 7.52446C7.54654 7.42846 7.59438 7.30979 7.59404 7.16846V6.41846C7.59404 6.27679 7.54604 6.14546 7.45004 6.02446C7.35404 5.90346 7.23538 5.84312 7.09404 5.84346H6.34404V5.41846H7.59404V4.66846H6.09404C5.95238 4.66846 5.83371 4.71646 5.73804 4.81246C5.64238 4.90846 5.59438 5.02712 5.59404 5.16846V5.91846C5.59404 6.06012 5.64204 6.18729 5.73804 6.29996C5.83404 6.41262 5.95271 6.46879 6.09404 6.46846H6.84404V6.91846H5.59404V7.66846ZM8.89404 7.66846H9.64404L10.519 4.66846H9.76904L9.26904 6.39346L8.76904 4.66846H8.01904L8.89404 7.66846ZM2.76904 10.1685C2.49404 10.1685 2.25871 10.0706 2.06304 9.87496C1.86738 9.67929 1.76938 9.44379 1.76904 9.16846V3.16846C1.76904 2.89346 1.86704 2.65812 2.06304 2.46246C2.25904 2.26679 2.49438 2.16879 2.76904 2.16846H10.769C11.044 2.16846 11.2795 2.26646 11.4755 2.46246C11.6715 2.65846 11.7694 2.89379 11.769 3.16846V9.16846C11.769 9.44346 11.6712 9.67896 11.4755 9.87496C11.2799 10.071 11.0444 10.1688 10.769 10.1685H2.76904ZM2.76904 9.16846H10.769V3.16846H2.76904V9.16846Z"
                                                                    fill="#556476" />
                                                            </svg>

                                                            CSV</a>
                                                    </li>
                                                </ul>
                                            </div>

                                            {{-- <a href="{{ url('export-leads/excel') }}"><button type="button"
                                                    class="btn btn-primary">Excel</button></a>
                                            <a href="{{ url('export-leads/csv') }}"><button type="button"
                                                    class="btn btn-primary">CSV</button></a> --}}
                                        </div>


                                    </div>
                                </div>
                            </div>




                            {{-- create lead button --}}
                            <a href="{{ url('create-lead') }}">
                                <button class="create-btn">
                                    <div class="icon-container">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.625 9.375H4.5V8.625H8.625V4.5H9.375V8.625H13.5V9.375H9.375V13.5H8.625V9.375Z"
                                                fill="white" />
                                        </svg>

                                    </div>
                                    <span class="button-text">{{ __('app.leads.create-title') }}</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>




                <div class="col-12">
                    <div class="d-flex card-container gap-1 leads-container">
                        <?php
                $orderedStages = collect($stages)->sortBy(function ($stage) {
                    if ($stage->name == 'New') {
                        return 1;
                    } elseif ($stage->name == 'Won') {
                        return 9999;
                    } elseif ($stage->name == 'Lost') {
                        return 10000;
                    }
                    return 500;
                })->values();
                $userRoleId = auth()->user()->role;
                $currentUserId = auth()->user()->id ?? auth()->id();

                // $currentUser = auth()->user();
                // $userRoleId = $currentUser ? $currentUser->role_id : 2;
                // $currentUserId = $currentUser ? $currentUser->id : 0;
                
                // Debug output - you can see this in the page source
                echo "<!-- Debug: User Role ID: " . $userRoleId . " -->";
                echo "<!-- Debug: Current User ID: " . $currentUserId . " -->";

                


                // foreach ($orderedStages as $stage) {
                //     $stage_value = 0;
                //     $leads = $leadsGroupedByStage->get($stage->id, collect());
                foreach ($orderedStages as $stage) {
                $stage_value = 0;

                if ($userRoleId == 2) {
                    // Admin - show all leads for the stage
                    $leads = $leadsGroupedByStage->get($stage->id, collect());
                } elseif ($userRoleId == 3) {
                    // Sales
                    if ($stage->name == 'New') {
                        
                       
                        $allLeadsFromAllStages = collect();
                        
                        foreach ($leadsGroupedByStage as $stageId => $stageLeads) {
                            $allLeadsFromAllStages = $allLeadsFromAllStages->merge($stageLeads);
                        }
                        $leads = $allLeadsFromAllStages->filter(function($lead) use ($currentUserId, $stage) {
                            
                            return (is_null($lead->sales_owner) || ($lead->sales_owner == 1) || $lead->sales_owner == $currentUserId) && ($lead->stage == $stage->id) ;
                        
                        });

                       

                        
                    } else {
                        // Other stages: only leads owned by current user
                        $stageLeads = $leadsGroupedByStage->get($stage->id, collect());
                        $leads = $stageLeads->filter(function($lead) use ($currentUserId) {
                            return $lead->sales_owner == $currentUserId;
                        });
                    }
                } else {
                    // Other roles: show no leads
                    $leads = collect();
                }

                    $stage_value = $leads->sum('lead_value');


                            ?>
                        <div class="col-md-3">
                            <div class="card card-default lead-card ">
                                <div class="card-body">
                                    <div class="notification-container my-3">
                                        <article class="notification-card">
                                            <div class="notification-content new w-100">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="notification-label">{{ $stage->name }} </span>


                                                    <span class="notification-badge"
                                                        id="stage-count-{{ $stage->id }}">{{ $leads->where('stage', $stage->id)->count() }}</span>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="notification-badge" id="stage-value-{{ $stage->id }}">
                                                        ${{ number_format($stage_value) }}</span>
                                                </div>
                                            </div>
                                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/903c68d6b1d1c328194d6567f5964162e88d96a3?placeholderIfAbsent=true&apiKey=58cf9ebae01449cda017611d277ef437"
                                                alt="Notification icon" class="notification-icon" />
                                        </article>
                                    </div>
                                    <div id="stage-{{ $stage->id }}" data-status="{{ $stage->id }}"
                                        class="task-list connectedSortable">
                                        <?php foreach ($leads as $lead) {
                                        $person_name = Person::where('id', $lead->person)->value('name');
                                    ?>
                                        <article class="task-card" data-lead-id="{{ $lead->id }}"
                                            data-value="{{ $lead->lead_value }}">
                                            <header class="task-header">
                                                <div class="date-section">
                                                    <svg width="12" height="12" viewBox="0 0 12 12"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M5.25 3.625C5.1837 3.625 5.12011 3.65134 5.07322 3.69822C5.02634 3.74511 5 3.8087 5 3.875C5 3.9413 5.02634 4.00489 5.07322 4.05178C5.12011 4.09866 5.1837 4.125 5.25 4.125H6.75C6.8163 4.125 6.87989 4.09866 6.92678 4.05178C6.97366 4.00489 7 3.9413 7 3.875C7 3.8087 6.97366 3.74511 6.92678 3.69822C6.87989 3.65134 6.8163 3.625 6.75 3.625H5.25ZM4.75 6.375C4.75 6.50761 4.69732 6.63479 4.60355 6.72855C4.50979 6.82232 4.38261 6.875 4.25 6.875C4.11739 6.875 3.99021 6.82232 3.89645 6.72855C3.80268 6.63479 3.75 6.50761 3.75 6.375C3.75 6.24239 3.80268 6.11521 3.89645 6.02145C3.99021 5.92768 4.11739 5.875 4.25 5.875C4.38261 5.875 4.50979 5.92768 4.60355 6.02145C4.69732 6.11521 4.75 6.24239 4.75 6.375ZM4.75 8.125C4.75 8.25761 4.69732 8.38479 4.60355 8.47855C4.50979 8.57232 4.38261 8.625 4.25 8.625C4.11739 8.625 3.99021 8.57232 3.89645 8.47855C3.80268 8.38479 3.75 8.25761 3.75 8.125C3.75 7.99239 3.80268 7.86521 3.89645 7.77145C3.99021 7.67768 4.11739 7.625 4.25 7.625C4.38261 7.625 4.50979 7.67768 4.60355 7.77145C4.69732 7.86521 4.75 7.99239 4.75 8.125ZM6 6.875C6.13261 6.875 6.25979 6.82232 6.35355 6.72855C6.44732 6.63479 6.5 6.50761 6.5 6.375C6.5 6.24239 6.44732 6.11521 6.35355 6.02145C6.25979 5.92768 6.13261 5.875 6 5.875C5.86739 5.875 5.74021 5.92768 5.64645 6.02145C5.55268 6.11521 5.5 6.24239 5.5 6.375C5.5 6.50761 5.55268 6.63479 5.64645 6.72855C5.74021 6.82232 5.86739 6.875 6 6.875ZM6.5 8.125C6.5 8.25761 6.44732 8.38479 6.35355 8.47855C6.25979 8.57232 6.13261 8.625 6 8.625C5.86739 8.625 5.74021 8.57232 5.64645 8.47855C5.55268 8.38479 5.5 8.25761 5.5 8.125C5.5 7.99239 5.55268 7.86521 5.64645 7.77145C5.74021 7.67768 5.86739 7.625 6 7.625C6.13261 7.625 6.25979 7.67768 6.35355 7.77145C6.44732 7.86521 6.5 7.99239 6.5 8.125ZM7.75 6.875C7.88261 6.875 8.00979 6.82232 8.10355 6.72855C8.19732 6.63479 8.25 6.50761 8.25 6.375C8.25 6.24239 8.19732 6.11521 8.10355 6.02145C8.00979 5.92768 7.88261 5.875 7.75 5.875C7.61739 5.875 7.49021 5.92768 7.39645 6.02145C7.30268 6.11521 7.25 6.24239 7.25 6.375C7.25 6.50761 7.30268 6.63479 7.39645 6.72855C7.49021 6.82232 7.61739 6.875 7.75 6.875Z"
                                                            fill="#556476" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M4 1.75C4.0663 1.75 4.12989 1.77634 4.17678 1.82322C4.22366 1.87011 4.25 1.9337 4.25 2V2.5H7.75V2C7.75 1.9337 7.77634 1.87011 7.82322 1.82322C7.87011 1.77634 7.9337 1.75 8 1.75C8.0663 1.75 8.12989 1.77634 8.17678 1.82322C8.22366 1.87011 8.25 1.9337 8.25 2V2.5015C8.37233 2.5025 8.48133 2.50683 8.577 2.5145C8.7595 2.5295 8.9195 2.561 9.0675 2.636C9.30264 2.75595 9.49377 2.94725 9.6135 3.1825C9.689 3.3305 9.7205 3.4905 9.7355 3.6725C9.75 3.85 9.75 4.0685 9.75 4.3395V8.1605C9.75 8.4315 9.75 8.6505 9.7355 8.827C9.7205 9.0095 9.689 9.1695 9.6135 9.3175C9.49368 9.55256 9.30256 9.74368 9.0675 9.8635C8.9195 9.939 8.7595 9.9705 8.5775 9.9855C8.4 10 8.1815 10 7.911 10H4.0895C3.8185 10 3.5995 10 3.423 9.9855C3.2405 9.9705 3.0805 9.939 2.9325 9.8635C2.69725 9.74377 2.50595 9.55264 2.386 9.3175C2.311 9.1695 2.2795 9.0095 2.2645 8.8275C2.25 8.65 2.25 8.431 2.25 8.16V4.34C2.25 4.1025 2.25 3.906 2.26 3.7415L2.2645 3.6735C2.2795 3.491 2.311 3.331 2.386 3.183C2.50586 2.94768 2.69718 2.75636 2.9325 2.6365C3.0805 2.5615 3.2405 2.53 3.4225 2.515C3.51883 2.50733 3.628 2.503 3.75 2.502V2C3.75 1.9337 3.77634 1.87011 3.82322 1.82322C3.87011 1.77634 3.9337 1.75 4 1.75ZM3.75 3.25V3.0015C3.6544 3.00229 3.55885 3.00612 3.4635 3.013C3.3125 3.025 3.2255 3.048 3.1595 3.0815C3.01825 3.15343 2.90343 3.26825 2.8315 3.4095C2.798 3.4755 2.775 3.5625 2.763 3.7135C2.75 3.868 2.75 4.066 2.75 4.35V4.625H9.25V4.35C9.25 4.066 9.25 3.868 9.237 3.7135C9.225 3.5625 9.202 3.4755 9.1685 3.4095C9.09657 3.26825 8.98175 3.15343 8.8405 3.0815C8.7745 3.048 8.6875 3.025 8.5365 3.013C8.44115 3.00612 8.3456 3.00229 8.25 3.0015V3.25C8.25 3.3163 8.22366 3.37989 8.17678 3.42678C8.12989 3.47366 8.0663 3.5 8 3.5C7.9337 3.5 7.87011 3.47366 7.82322 3.42678C7.77634 3.37989 7.75 3.3163 7.75 3.25V3H4.25V3.25C4.25 3.3163 4.22366 3.37989 4.17678 3.42678C4.12989 3.47366 4.0663 3.5 4 3.5C3.9337 3.5 3.87011 3.47366 3.82322 3.42678C3.77634 3.37989 3.75 3.3163 3.75 3.25ZM9.25 5.125H2.75V8.15C2.75 8.434 2.75 8.6325 2.763 8.7865C2.775 8.9375 2.798 9.0245 2.8315 9.0905C2.90343 9.23175 3.01825 9.34657 3.1595 9.4185C3.2255 9.452 3.3125 9.475 3.4635 9.487C3.618 9.5 3.816 9.5 4.1 9.5H7.9C8.184 9.5 8.3825 9.5 8.5365 9.487C8.6875 9.475 8.7745 9.452 8.8405 9.4185C8.98175 9.34657 9.09657 9.23175 9.1685 9.0905C9.202 9.0245 9.225 8.9375 9.237 8.7865C9.25 8.6325 9.25 8.434 9.25 8.15V5.125Z"
                                                            fill="#556476" />
                                                    </svg>

                                                    <time class="due-date">{{ $lead->closing_date }}</time>
                                                </div>


                                                <div class="priority-section d-flex align-items-center gap-2">
                                                    @if (auth()->user()->role == 2)
                                                   
                                                        @if ($lead->salesOwner)
                                                           
                                                            <div class="assigned-wrapper"
                                                                data-sales-owner="{{ $lead->salesOwner->name }}">
                                                                <img src="{{ asset('images/assigned.svg') }}"
                                                                    alt="assigned" class="assigned-icon" tabindex="0">
                                                            </div>
                                                        @endif
                                                    @elseif ($stage->name == 'New' && $lead->sales_owner == auth()->user()->id)
                                                        <div>
                                                            <img src="{{ asset('images/assigned.svg') }}" alt="">
                                                        </div>
                                                    @endif



                                                    <div>
                                                        <?php if ($lead->priority == 'Low') { ?>
                                                        <span class="priority-badge low">Low</span>
                                                        <?php } elseif ($lead->priority == 'Medium') { ?>
                                                        <span class="priority-badge medium">Medium</span>
                                                        <?php } elseif ($lead->priority == 'High') { ?>
                                                        <span class="priority-badge high">High</span>
                                                        <?php } else { ?>
                                                        <span class="priority-badge urgent">Urgent</span>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                            </header>

                                            <main class="task-content">
                                                <a href="{{ url('view-lead/' . $lead->id) }}">
                                                    <h2 class="task-title">{{ $lead->title }}</h2>
                                                </a>
                                                <p class="company-name">
                                                    {{ \App\Models\Organization::where(
                                                        'id',
                                                        \App\Models\Person::where('id', $lead->person)->value('organization'),
                                                    )->value('name') ?? 'N/A' }}
                                                </p>
                                            </main>
                                            <div class="divider"></div>
                                            <footer class="task-footer">
                                                <div class="assignee-info">
                                                    @php
                                                        $personPicture = \App\Models\Person::where(
                                                            'id',
                                                            $lead->person,
                                                        )->value('picture');
                                                        $avatarSrc = $personPicture
                                                            ? asset('uploads/persons/pictures/' . $personPicture)
                                                            : asset('images/avatar.png');
                                                    @endphp
                                                    <img class="avatar" src="{{ $avatarSrc }}"
                                                        alt="Assignee Picture">



                                                    <a href="{{ url('persons?id=' . $lead->person) }}">
                                                        <span class="assignee-name">{{ $person_name }}</span>
                                                    </a>
                                                </div>
                                                <div class="action-buttons">
                                                    <button class="action-btn favorite-btn" aria-label="Add to favorites">
                                                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/268cebf93bfa072c8615343d386f71417a021f51?placeholderIfAbsent=true&apiKey=58cf9ebae01449cda017611d277ef437"
                                                            class="action-icon" alt="Favorite" />
                                                    </button>
                                                    <button class="action-btn more-btn" aria-label="More options">
                                                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/912cec917361569cb1ed6faba7bd9c7d04d9247d?placeholderIfAbsent=true&apiKey=58cf9ebae01449cda017611d277ef437"
                                                            class="action-icon" alt="More options" />
                                                    </button>
                                                </div>
                                            </footer>
                                        </article>
                                        <?php } ?>
                                    </div>
                                    <div class="add-card-wrapper">
                                        <a
                                            href="{{ url('create-lead') . '?pipeline=' . session('pipeline_id') . '&stage=' . $stage->id }}">
                                            <div class="add-card-container">
                                                <div class="add-card-button">
                                                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/7594641fe0b0bf04f82d99ec52410440ee0f61f1?placeholderIfAbsent=true&apiKey=58cf9ebae01449cda017611d277ef437"
                                                        class="add-card-icon" alt="Add icon" />
                                                    <span class="add-card-text">Add Card</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>






    </div>
    <!--end row-->
    </div>

    </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade importLeads" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <form method="POST" action="{{ url('import-leads') }}" enctype="multipart/form-data" data-parsley-validate>
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Import Leads</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="firstNameinput" class="form-label">Select File (CSV, Excel)</label>
                                    <input type="file" class="form-control" name="leads" value="" required>
                                    @if ($errors->has('leads'))
                                        <div class="alert alert-danger mt-2">{{ $errors->first('leads') }}</li>
                                        </div>
                                    @endif
                                    <a href="{{ asset('uploads/import_templates/Leads Import Template.xlsx') }}"
                                        download>Download Template</a>
                                </div>
                            </div>

                        </div>
                        <!--end row-->
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:void(0);" class="btn btn-link link-success fw-medium shadow-none"
                            data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                        <button type="submit" class="btn btn-primary ">Import</button>
                    </div>

                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div>
    <script>
        $(document).ready(function() {

            $('#pipeline-select').on('change', function() {
                const selectedPipelineId = $(this).val();
                console.log("Selected Pipeline ID:", selectedPipelineId);
                $.ajax({
                    url: '{{ url('update-pipline-session') }}',
                    method: 'POST',
                    data: {
                        pipeline_id: selectedPipelineId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Optional: reload the page to load the selected pipeline's stages
                        location.reload();
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });

            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @endif

            @if (Session::has('fail'))
                toastr.error("{{ Session::get('fail') }}");
            @endif
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.task-list').forEach(function(stage) {
                // Check if this stage is "New" by looking at the stage name in the notification-label
                const stageCard = stage.closest('.lead-card');
                const stageNameElement = stageCard.querySelector('.notification-label');
                const stageName = stageNameElement ? stageNameElement.textContent.trim() : '';
                const isNewStage = stageName === 'New';

                new Sortable(stage, {
                    group: 'leads', // This allows dragging between lists
                    animation: 150,
                    disabled: isNewStage, // Disable sorting for New stage
                    onStart: function(evt) {
                        // Additional check: prevent dragging items FROM New stage
                        const fromStageCard = evt.from.closest('.lead-card');
                        const fromStageNameElement = fromStageCard.querySelector(
                            '.notification-label');
                        const fromStageName = fromStageNameElement ? fromStageNameElement
                            .textContent.trim() : '';

                        if (fromStageName === 'New') {
                            return false; // Cancel the drag
                        }
                    },
                    onEnd: function(evt) {
                        console.log("Sort ended");

                        // Safety: log evt structure
                        console.log("evt.from:", evt.from);
                        console.log("evt.to:", evt.to);

                        var leadId = evt.item.getAttribute('data-lead-id');
                        var leadValue = parseFloat(evt.item.getAttribute('data-value'));

                        // Safe fallback method to get data-status from parent .task-list
                        var oldStage = evt.from?.getAttribute('data-status');
                        var newStage = evt.to?.getAttribute('data-status');

                        console.log("leadId:", leadId);
                        console.log("leadValue:", leadValue);
                        console.log("oldStage:", oldStage);
                        console.log("newStage:", newStage);

                        // Check if these values exist
                        if (!leadId || !oldStage || !newStage) {
                            console.error("One or more required values are missing");
                            return;
                        }

                        // Only update if the stage actually changed
                        if (oldStage !== newStage) {
                            updateLeadStage(leadId, newStage, leadValue, oldStage);
                        } else {
                            console.log("Item moved within the same stage - no update needed");
                        }
                    }
                });
            });
        });

        function updateLeadStage(leadId, newStage, leadValue, oldStage) {
            console.log("leadId:", leadId);
            console.log("newStage:", newStage);
            console.log("leadValue:", leadValue);
            console.log("oldStage:", oldStage);
            var csrfToken = "{{ csrf_token() }}";

            $.ajax({
                url: "{{ url('update-lead-stage') }}",
                method: "POST",
                data: {
                    _token: csrfToken,
                    lead_id: leadId,
                    new_stage_id: newStage
                },
                success: function(response) {
                    var oldStageValueElement = document.getElementById('stage-value-' + oldStage);
                    var newStageValueElement = document.getElementById('stage-value-' + newStage);

                    var oldStageValue = parseFloat(oldStageValueElement.innerText.replace('$', '').replace(',',
                        ''));
                    var newStageValue = parseFloat(newStageValueElement.innerText.replace('$', '').replace(',',
                        ''));

                    oldStageValueElement.innerText = "$" + (oldStageValue - leadValue).toLocaleString();
                    newStageValueElement.innerText = "$" + (newStageValue + leadValue).toLocaleString();

                    let oldStageList = document.querySelector(`[data-status="${oldStage}"]`);
                    let newStageList = document.querySelector(`[data-status="${newStage}"]`);

                    let oldStageCount = oldStageList.querySelectorAll('.task-card').length;
                    let newStageCount = newStageList.querySelectorAll('.task-card').length;

                    document.getElementById('stage-count-' + oldStage).innerText = oldStageCount;
                    document.getElementById('stage-count-' + newStage).innerText = newStageCount;

                    toastr.success("Lead stage updated successfully");
                },
                error: function(xhr, status, error) {
                    toastr.error("Error updating lead stage");
                }
            });

        }



        // const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        // const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // create one tooltip element used for all icons
            const tooltip = document.createElement('div');
            tooltip.className = 'assigned-tooltip';
            tooltip.setAttribute('role', 'tooltip');
            document.body.appendChild(tooltip);

            // attach listeners
            document.querySelectorAll('.assigned-wrapper').forEach(wrapper => {
                const img = wrapper.querySelector('.assigned-icon');
                const name = (wrapper.dataset.salesOwner || '').trim();

                if (!img) return;

                function show() {
                    if (!name || name === 'N/A') return; // optional: don't show for N/A
                    tooltip.textContent = name;
                    tooltip.classList.add('show');

                    // position tooltip above the icon, centered
                    const rect = img.getBoundingClientRect();
                    const top = window.scrollY + rect.top - tooltip.offsetHeight - 8;
                    let left = rect.left + rect.width / 2 - tooltip.offsetWidth / 2;

                    // keep inside viewport with small margin
                    left = Math.max(8, Math.min(left, window.innerWidth - tooltip.offsetWidth - 8));

                    tooltip.style.left = left + 'px';
                    tooltip.style.top = top + 'px';
                }

                function hide() {
                    tooltip.classList.remove('show');
                }

                img.addEventListener('mouseenter', show);
                img.addEventListener('mouseleave', hide);
                // keyboard accessible
                img.addEventListener('focus', show);
                img.addEventListener('blur', hide);

                // hide tooltip on scroll to avoid wrong position
                window.addEventListener('scroll', hide, {
                    passive: true
                });
                window.addEventListener('resize', hide);
            });
        });
    </script>



@endsection
