@extends('master')

@section('content')
    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate>
        @csrf

        <div class="d-flex flex-column min-vh-100">
            <div class="flex-grow-1">
                <!-- Scrollable Content -->
                <div class="main-scrollable">
                    <div class="page-container">

                        <div class="page-title-container mb-0">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="page-title">
                                        {{ __('app.settings.groups.create-title') }}
                                    </h3>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ url('settings') }}">Settings</a></li>
                                            <li class="breadcrumb-item"><a href="{{ url('groups') }}">
                                                    {{ __('app.settings.groups.title') }}</a></li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">
                                                {{ __('app.settings.groups.create-title') }}</li>
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

                                        <div class="row g-4">
                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="field1" placeholder="Name"
                                                    name="name" value="" required>
                                            </div>


                                            <!-- <div class="col-12 col-md-4">
                                                        <label for="date_start" class="form-label">Description</label>
                                                        <input type="text" class="form-control" id="date_start" placeholder="Date Start">
                                                    </div> -->

                                        </div>

                                    </div>
                                </div>

                                <div class="card card-default mb-4">

                                    <div class="card-body">

                                        <div class="row g-4">


                                            <div class="col-12 ">
                                                <label for="date_start" class="form-label">Description</label>
                                                <textarea class="form-control description-form-control" placeholder="Description" id="field5" rows="5" name="description"></textarea>
                                            </div>

                                        </div>

                                    </div>
                                </div>



                                <!-- <div class="col-12 bottom-actions-bar">
                                        <div class="d-flex gap-2 mt-3 justify-content-between">
                                            <div>
                                                <button type="submit" class="btn clear-all-btn">Clear All</button>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn save-btn">Save</button>
                                               <button type="button" class="btn cancel-btn">Cancel</button>
                                            </div>

                                        </div>

                                    </div> -->

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 action-bar">
                <div class="d-flex gap-2 justify-content-between">
                    <div>
                        <a href=""><button type="button" class="btn clear-all-btn">Clear All</button></a>
                    </div>
                    <div>
                        <button type="submit" class="btn save-btn">Save</button>
                        <a href="{{ url('groups') }}"><button type="button" class="btn cancel-btn">Cancel</button></a>
                    </div>

                </div>

            </div>
        </div>
    </form>


    <script>
        $(document).ready(function() {
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ Session::get('success') }}",
                    confirmButtonColor: '#3085d6'
                });
            @endif

            @if (Session::has('fail'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{ Session::get('fail') }}",
                    confirmButtonColor: '#d33'
                });
            @endif
        });
    </script>
@endsection
