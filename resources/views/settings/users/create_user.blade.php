@extends('master')

@section('content')


<!-- Scrollable Content -->
<div class="main-scrollable">
    <div class="page-container">
        <div class="page-title-container mb-0">
            <div class="d-flex justify-content-between">
                <div>
                    <h3 class="page-title">
                        Create User
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Settings</a></li>
                            <li class="breadcrumb-item"><a href="#">Users</a></li>
                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">Create User</li>
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
                                    <label for="field1" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Title">
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Submit Button Lable</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Submit Button Lable">
                                </div>


                                <div class="col-12 col-md-4">
                                    <label for="field3" class="form-label">Submit Success Action</label>

                                    <select class="myDropdown form-control">
                                        <option value="1">All</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                    </select>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Display a Custom Message</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Redirect to a URL</label>
                                    </div>
                                </div>
                                <!-- <div class="col-12 col-md-4">
                                                    <label for="date_start" class="form-label">Description</label>
                                                    <input type="text" class="form-control" id="date_start" placeholder="Date Start">
                                                </div> -->

                            </div>
                        </form>
                    </div>
                </div>


                <div class="card card-default mb-4">

                    <div class="card-body">
                        <form>
                            <div class="row g-4">

                                <div class="col-12">
                                    <label for="field5" class="form-label">Description</label>
                                    <textarea class="form-control" placeholder="Description" id="field5" rows="5"></textarea>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>


                <div class="card card-default mb-4">

                    <div class="card-body">
                        <form>
                            <div class="row g-4">
                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Background Color</label>
                                    <div class="form-control color-input position-relative">
                                        <span id="color-code-text">#fffff</span>
                                        <input type="color" class=" color-input absolute-color" id="background-color">
                                    </div>
                                    <!-- <input type="color" class="form-control color-input" placeholder="Form Submit Button Color"> -->
                                </div>



                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Form Background Color</label>
                                    <div class="form-control color-input position-relative">
                                        <span id="color-code-text">#fffff</span>
                                        <input type="color" class=" color-input absolute-color" id="form-background-color">
                                    </div>
                                    <!-- <input type="color" class="form-control color-input" placeholder="Form Submit Button Color"> -->
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Form Title Color</label>
                                    <div class="form-control color-input position-relative">
                                        <span id="color-code-text">#fffff</span>
                                        <input type="color" class=" color-input absolute-color" id="form-title-color">
                                    </div>
                                    <!-- <input type="color" class="form-control color-input" placeholder="Form Submit Button Color"> -->
                                </div>


                            </div>


                            <div class="row g-4">
                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Form Submit Button Color</label>
                                    <div class="form-control color-input position-relative">
                                        <span id="color-code-text">#fffff</span>
                                        <input type="color" class=" color-input absolute-color" id="form-submit-button-color">
                                    </div>
                                    <!-- <input type="color" class="form-control color-input" placeholder="Form Submit Button Color"> -->
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Attribute Label Color</label>
                                    <div class="form-control color-input position-relative">
                                        <span id="color-code-text">#fffff</span>
                                        <input type="color" class=" color-input absolute-color" id="attribute-label-color">
                                    </div>
                                    <!-- <input type="color" class="form-control color-input" placeholder="Form Submit Button Color"> -->
                                </div>





                            </div>
                        </form>
                    </div>
                </div>



                <div class="card card-default mb-4">

                    <div class="card-body">
                        <form>

                            <input id="checkbox" type="checkbox" class="form-check-input">
                            <span class="span-text">Create new lead with contact</span>


                            <div class="row g-4 mt-1">
                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Field Label</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Field Label">
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Field Placeholder</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Field Placeholder">
                                </div>
                                <div class="mt-0 pt-2">
                                    <input id="checkbox" type="checkbox" class="form-check-input"> <span class="form-label">Required</span>
                                </div>

                            </div>

                            <div class="row g-4 mt-1">
                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Field Label</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Field Label">
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Field Placeholder</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Field Placeholder">
                                </div>
                                <div class="mt-0 pt-2">
                                    <div class="checkbox-container">
                                        <input id="checkbox" type="checkbox" class="form-check-input"> <span class="form-label">Required</span>
                                    </div>


                                    <div class="checkbox-container">
                                        <input id="checkbox" type="checkbox" class="form-check-input"> <span class="form-label">Description</span>
                                    </div>

                                    <div class="checkbox-container">
                                        <input id="checkbox" type="checkbox" class="form-check-input"> <span class="form-label">Source</span>
                                    </div>

                                    <div class="checkbox-container">
                                        <input id="checkbox" type="checkbox" class="form-check-input"> <span class="form-label">Type</span>
                                    </div>
                                    <div class="checkbox-container">
                                        <input id="checkbox" type="checkbox" class="form-check-input"> <span class="form-label">Sales Owner</span>
                                    </div>


                                    <div class="checkbox-container">
                                        <input id="checkbox" type="checkbox" class="form-check-input"> <span class="form-label">Expected Close Date</span>
                                    </div>

                                </div>

                            </div>



                            <div class="row g-4 mt-1">
                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Field Label</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Field Label">
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Field Placeholder</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Field Placeholder">
                                </div>
                                <div class="mt-0 pt-2">
                                    <div class="checkbox-container">
                                        <input id="checkbox" type="checkbox" class="form-check-input"> <span class="form-label">Required</span>
                                    </div>



                                </div>

                            </div>


                            <div class="row g-4 mt-1">
                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Field Label</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Field Label">
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Field Placeholder</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Field Placeholder">
                                </div>
                                <div class="mt-0 pt-2">
                                    <div class="checkbox-container">
                                        <input id="checkbox" type="checkbox" class="form-check-input"> <span class="form-label">Required</span>
                                    </div>
                                    <div class="checkbox-container">
                                        <input id="checkbox" type="checkbox" class="form-check-input"> <span class="form-label">Phone Number</span>
                                    </div>

                                    <div class="checkbox-container">
                                        <input id="checkbox" type="checkbox" class="form-check-input"> <span class="form-label">Organization</span>
                                    </div>


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
            <button type="submit" class="btn cancel-btn">Cancel</button>
        </div>

    </div>

</div>


@endsection