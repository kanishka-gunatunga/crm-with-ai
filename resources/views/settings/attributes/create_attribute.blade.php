@extends('master')

@section('content')


<!-- Scrollable Content -->
                <div class="main-scrollable">
                    <div class="page-container">
                        <div class="page-title-container mb-0">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="page-title">
                                        Create Attribute
                                    </h3>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#">Settings</a></li>
                                            <li class="breadcrumb-item"><a href="#">Attributes</a></li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">Create Attribute</li>
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
                                                    <label for="field1" class="form-label">Code</label>
                                                    <input type="text" class="form-control" id="field1" placeholder="Code">
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="field1" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="field1" placeholder="Name">
                                                </div>


                                                <div class="col-12 col-md-4">
                                                    <label for="field3" class="form-label">Entity Type</label>

                                                    <select class="myDropdown form-control">
                                                        <option value="1">Option 1</option>
                                                        <option value="2">Option 2</option>
                                                        <option value="3">Option 3</option>
                                                    </select>
                                                </div>


                                            </div>
                                            <div class="row g-4 mt-1">

                                                <div class="col-12 col-md-4">
                                                    <label for="field3" class="form-label">Type</label>

                                                    <select class="myDropdown form-control">
                                                        <option value="1">Option 1</option>
                                                        <option value="2">Option 2</option>
                                                        <option value="3">Option 3</option>
                                                    </select>
                                                </div>


                                                <div class="col-12 col-md-4">
                                                    <label for="field3" class="form-label">Is Required</label>

                                                    <select class="myDropdown form-control">
                                                        <option value="1">Option 1</option>
                                                        <option value="2">Option 2</option>
                                                        <option value="3">Option 3</option>
                                                    </select>
                                                </div>


                                                <div class="col-12 col-md-4">
                                                    <label for="field3" class="form-label">Is Unique</label>

                                                    <select class="myDropdown form-control">
                                                        <option value="1">Option 1</option>
                                                        <option value="2">Option 2</option>
                                                        <option value="3">Option 3</option>
                                                    </select>
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