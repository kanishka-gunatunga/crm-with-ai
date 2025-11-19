@extends('master')

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
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Reports</a></li>
                            </ol>
                        </nav>
                    </div>

                </div>

            </div>

            <div class="col-12">
                <div class="card-container">

                    <div class="card card-default">
                        <div class="card-body">



                            <div class="row g-3">
                                <div class="col-12 col-md-4">
                                    <label for="field3" class="form-label">Report Type</label>

                                    <select class="myDropdown form-control" name="report_type" required>
                                        <option value="leads">Leads</option>

                                    </select>
                                </div>


                                <div class="col-12 col-md-4">
                                    <label for="field3" class="form-label">Pipeline</label>

                                    <select class="myDropdown form-control" name="pipeline" required>
                                        <option value="dummy_pipeline">Dummy Pipeline</option>

                                    </select>
                                </div>


                                <div class="col-12 col-md-4">
                                    <label for="field3" class="form-label">Pipeline Stage</label>

                                    <select class="myDropdown form-control" name="pipeline_stage" required>
                                        <option value="new">New</option>

                                    </select>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="field3" class="form-label">Time Period</label>

                                    <select class="myDropdown form-control" name="time_period" required>
                                        <option value="leads">Leads</option>

                                    </select>
                                </div>
                            </div>
                            

                        </div>

                    </div>





                </div>
            </div>

        </div>
    </div>
@endsection
