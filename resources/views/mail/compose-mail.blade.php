@extends('master')

@section('content')


<!-- Scrollable Content -->
<div class="main-scrollable">
    <div class="page-container">
        <div class="page-title-container">
            <div class="d-flex justify-content-between">
                <div>
                    <h3 class="page-title">
                        Compose Mail
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Mail</a></li>
                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">Compose mail</li>
                        </ol>
                    </nav>
                </div>




            </div>

        </div>

        <div class="col-12">
            <div class="card-container">
                <form>
                    <div class="card card-default">
                        <div class="card-body">


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


                        </div>

                    </div>
                    <div class="card card-default mt-3">
                        <div class="card-body">
                            <div class="col-12">
                                <label for="field5" class="form-label">Description</label>
                                <div id="summernote"></div>
                            </div>
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
            <button type="submit" class="btn cancel-btn">Cancel</button>
        </div>

    </div>

</div>


@endsection