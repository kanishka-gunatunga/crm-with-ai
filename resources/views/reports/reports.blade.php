@extends('master')
<?php
$permissions = session('user_permissions');
?>
@section('content')
    <!-- Scrollable Content -->
    <div class="main-scrollable">
        <div class="page-container">
            <div class="page-title-container">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="page-title">
                            Reports
                        </h3>
                        {{-- <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Reports</a></li>
                            </ol>
                        </nav> --}}
                    </div>

                </div>

            </div>

            <div class="col-12">
                <div class="card-container">

                    <div class="card card-default">
                        <form method="POST" action="{{ url('/generate-report') }}">
                            <div class="card-body">
                                @csrf


                                <div class="row g-3">
                                    <div class="col-12 col-md-4">
                                        <label for="field3" class="form-label">Report Type</label>

                                        <select class="myDropdown form-control" name="report_type" required>
                                            @if (in_array(strtolower('lead-view-own'), array_map('strtolower', $permissions)) ||
                                                    in_array(strtolower('lead-view-all'), array_map('strtolower', $permissions)))
                                                <option value="leads">Leads</option>
                                            @else
                                                <option value="" disabled>You do not have permission to view Leads</option>    
                                            @endif
                                        </select>
                                    </div>


                                    <div class="col-12 col-md-4">
                                        <label for="field3" class="form-label">Pipeline</label>

                                        <select class="myDropdown form-control" name="pipeline" required
                                            id="pipelineSelectionDropdown">
                                             @if (in_array(strtolower('show-pipelines'), array_map('strtolower', $permissions)))
                                                <option>Select Pipeline</option>
                                                @foreach ($pipelines as $pipeline)
                                                    <option value="{{ $pipeline->id }}">{{ $pipeline->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="" disabled>You do not have permission to view Pipelines</option>
                                            @endif
                                        </select>
                                    </div>


                                    <div class="col-12 col-md-4">
                                        <label for="field3" class="form-label">Pipeline Stage</label>

                                        <select class="myDropdown form-control" name="pipeline_stage" required
                                            id="pipelineStagesDropdown">

                                            <!-- Options will be populated dynamically based on selected pipeline -->

                                        </select>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <label for="field3" class="form-label">Time Period</label>

                                        <select class="myDropdown form-control" name="time_period" required>
                                            <option value="last_month">Last Month</option>
                                            <option value="last_3_months">Last 3 Months</option>
                                            <option value="last_6_months">Last 6 Months</option>
                                            <option value="all_time">All Time</option>
                                        </select>
                                    </div>
                                </div>



                                <button type="submit" class="btn save-btn mt-4">Generate Report</button>

                            </div>
                        </form>
                    </div>


                    {{-- <div class="card card-default mt-4">
                        <div class="card-body">
                            <button class="btn white-btn export-toggle ">
                                <svg width="18" height="18" viewBox="0 0 14 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.44091 4.89252C8.48096 4.93551 8.52926 4.96998 8.58293 4.99389C8.63659 5.01781 8.69453 5.03066 8.75327 5.0317C8.81201 5.03274 8.87036 5.02193 8.92484 4.99993C8.97932 4.97792 9.0288 4.94517 9.07035 4.90363C9.11189 4.86208 9.14464 4.8126 9.16665 4.75812C9.18865 4.70364 9.19946 4.64529 9.19842 4.58655C9.19738 4.52781 9.18452 4.46987 9.16061 4.41621C9.1367 4.36254 9.10222 4.31424 9.05924 4.27419L7.30924 2.52419C7.22721 2.44226 7.11601 2.39624 7.00007 2.39624C6.88414 2.39624 6.77294 2.44226 6.69091 2.52419L4.94091 4.27419C4.86363 4.35712 4.82155 4.46682 4.82355 4.58016C4.82555 4.6935 4.87147 4.80164 4.95163 4.8818C5.03179 4.96196 5.13993 5.00787 5.25327 5.00987C5.36661 5.01187 5.4763 4.9698 5.55924 4.89252L6.56257 3.88919V8.66669C6.56257 8.78272 6.60867 8.894 6.69071 8.97605C6.77276 9.05809 6.88404 9.10419 7.00007 9.10419C7.11611 9.10419 7.22739 9.05809 7.30943 8.97605C7.39148 8.894 7.43757 8.78272 7.43757 8.66669V3.88919L8.44091 4.89252Z"
                                        fill="#172635" />
                                    <path
                                        d="M12.1041 7.5C12.1041 7.38397 12.058 7.27269 11.9759 7.19064C11.8939 7.10859 11.7826 7.0625 11.6666 7.0625C11.5506 7.0625 11.4393 7.10859 11.3572 7.19064C11.2752 7.27269 11.2291 7.38397 11.2291 7.5C11.2291 8.05538 11.1197 8.60533 10.9072 9.11843C10.6946 9.63154 10.3831 10.0978 9.99039 10.4905C9.59768 10.8832 9.13146 11.1947 8.61835 11.4072C8.10524 11.6198 7.5553 11.7292 6.99992 11.7292C6.44454 11.7292 5.89459 11.6198 5.38149 11.4072C4.86838 11.1947 4.40216 10.8832 4.00945 10.4905C3.61673 10.0978 3.30521 9.63154 3.09268 9.11843C2.88014 8.60533 2.77075 8.05538 2.77075 7.5C2.77075 7.38397 2.72466 7.27269 2.64261 7.19064C2.56056 7.10859 2.44928 7.0625 2.33325 7.0625C2.21722 7.0625 2.10594 7.10859 2.02389 7.19064C1.94185 7.27269 1.89575 7.38397 1.89575 7.5C1.89575 8.85371 2.43351 10.152 3.39073 11.1092C4.34794 12.0664 5.64621 12.6042 6.99992 12.6042C8.35363 12.6042 9.65189 12.0664 10.6091 11.1092C11.5663 10.152 12.1041 8.85371 12.1041 7.5Z"
                                        fill="#172635" />
                                </svg>
                                Export
                            </button>

                            <div class="table-responsive">
                                <table class="table new-table data-table-export" data-export-title="Roles"
                                    data-export-filename="Roles">

                                    <thead>
                                        <tr>
                                            
                                            <th>Lead title</th>
                                            <th>Lead Value</th>
                                            <th>3</th>
                                            <th>4</th>
                                            <th>5</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr class="odd gradeX">
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                            <td class=""></td>
                                        </tr>
                            </div>
                        </div>
                    </div> --}}
                </div>

            </div>
        </div>







        <script>
            $('#pipelineSelectionDropdown').on('change', function() {
                let pipelineId = $(this).val(); // get selected pipeline id

                $.ajax({
                    url: '/get-pipeline-stages/' + pipelineId,
                    type: 'GET',
                    success: function(response) {
                        $('#pipelineStagesDropdown').empty(); // clear old options

                        // add new options
                        $.each(response, function(index, stage) {
                            $('#pipelineStagesDropdown').append(
                                '<option value="' + stage.id + '">' + stage.name + '</option>'
                            );
                        });
                    }
                });
            });
        </script>
    @endsection
