@extends('master')

@section('content')


<!-- Scrollable Content -->
<div class="main-scrollable">
    <div class="page-container">
        <div class="page-title-container mb-0">
            <div class="d-flex justify-content-between">
                <div>
                    <h3 class="page-title">
                        Create Type
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Settings</a></li>
                            <li class="breadcrumb-item"><a href="#">Types</a></li>
                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">Create Type</li>
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
                        <form>
                            <div class="row g-4">
                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Name">
                                </div>


                                <!-- <div class="col-12 col-md-4">
                                                    <label for="date_start" class="form-label">Description</label>
                                                    <input type="text" class="form-control" id="date_start" placeholder="Date Start">
                                                </div> -->

                            </div>
                        </form>
                    </div>
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
                </form>
            </div>
        </div>

    </div>
</div>

<!-- Bottom Action Buttons -->
<div class="col-12 action-bar">
    <div class="d-flex gap-2 justify-content-between">
        <div>
            <button type="submit" class="btn clear-all-btn">Clear All</button>
        </div>
        <div>
            <button type="submit" class="btn save-btn">Save</button>
            <button type="submit" class="btn cancel-btn">Cancel</button>
        </div>

    </div>

</div>
@endsection