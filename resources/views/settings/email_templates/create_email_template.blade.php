@extends('master')

@section('content')


<!-- Scrollable Content -->
<div class="main-scrollable">
    <div class="page-container">
        <div class="page-title-container mb-0">
            <div class="d-flex justify-content-between">
                <div>
                    <h3 class="page-title">
                        Create Email Template
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Settings</a></li>
                            <li class="breadcrumb-item"><a href="#">Email Templates</a></li>
                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">Create Email Template</li>
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
                                <div class="col-12 col-md-4 ">
                                    <label for="field1" class="form-label">To</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control " id="field1" placeholder="To">
                                        <button type="button" class="position-absolute email-sending-option-btn CC">CC</button>
                                        <button type="button" class="position-absolute email-sending-option-btn BCC">BCC</button>
                                    </div>

                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Subject</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Subject">
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

                <div class="card card-default mb-4">

                    <div class="card-body">
                        <form>
                            <div class="row g-4">


                                <div class="col-12 ">
                                    <label for="date_start" class="form-label">Description</label>
                                    <div id="froala-editor"> </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>


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
           <button type="button" class="btn cancel-btn">Cancel</button>
        </div>

    </div>

</div>


@endsection