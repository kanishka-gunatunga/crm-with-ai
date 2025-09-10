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
                                        {{ __('app.settings.pipelines.create-title') }}
                                    </h3>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a
                                                    href="{{ url('pipelines') }}">{{ __('app.settings.pipelines.title') }}</a></li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">
                                                {{ __('app.settings.pipelines.create-title') }}</li>
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
                                                <label for="field1"
                                                    class="form-label">{{ __('app.settings.pipelines.name') }}</label>
                                                <input type="text" class="form-control" id="field1" placeholder="Name"
                                                    name="name" value="{{ old('name') }}" required>
                                                @if ($errors->has('name'))
                                                    <div class="alert alert-danger mt-2">{{ $errors->first('name') }}</li>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <label for="field1"
                                                    class="form-label">{{ __('app.settings.pipelines.rotting-days') }}</label>
                                                <input type="number" class="form-control" id="field1"
                                                    placeholder="Rotten Days" name="rotting_days"
                                                    value="{{ old('phone') ?? 30 }}" required>
                                                @if ($errors->has('rotting_days'))
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $errors->first('rotting_days') }}</li>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="formCheck2"
                                                        name="is_default">
                                                    <label class="form-check-label" for="formCheck2">
                                                        {{ __('app.settings.pipelines.is-default') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="card card-default mb-4">

                                    <div class="card-body">
                                        <table class="table table-nowrap mt-4">
                                            <thead>
                                                <tr>
                                                    <th scope="col">{{ __('app.settings.pipelines.name') }}</th>
                                                    <!--<th scope="col">{{ __('app.settings.pipelines.probability') }}</th>-->
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input type="text" class="form-control" name="stages[]"
                                                            value="New" readonly required></td>
                                                    <!--<td><input type="number" step="any" class="form-control"-->
                                                    <!--        name="probabilities[]" value="100" readonly required></td>-->
                                                    <td></td>
                                                </tr>
                                                <!--<tr>-->
                                                <!--    <td><input type="text" class="form-control" name="stages[]" >-->
                                                <!--    </td>-->
                                                <!--    <td><input type="number" step="any" class="form-control"-->
                                                <!--            name="probabilities[]" required></td>-->
                                                <!--    <td>-->
                                                <!--        <i-->
                                                <!--            class="fa-solid fa-trash delete-stage remove-append-item mx-2"></i>-->

                                                <!--    </td>-->
                                                <!--</tr>-->
                                                <tr>
                                                    <td><input type="text" class="form-control" name="stages[]"
                                                            value="Won" readonly required></td>
                                                    <!--<td><input type="number" step="any" class="form-control"-->
                                                    <!--        name="probabilities[]" value="100" readonly required></td>-->
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="text" class="form-control" name="stages[]"
                                                            value="Lost" readonly ></td>
                                                    <!--<td><input type="number" step="any" class="form-control"-->
                                                    <!--        name="probabilities[]" value="0" readonly required></td>-->
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <button type="button" class="btn add-more-button mx-1 p-0" id="add_stage">
                                            <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M2.13574 12.8162C2.13574 6.91793 6.91695 2.13672 12.8152 2.13672C18.7135 2.13672 23.4947 6.91793 23.4947 12.8162C23.4947 18.7145 18.7135 23.4957 12.8152 23.4957C6.91695 23.4957 2.13574 18.7145 2.13574 12.8162ZM12.8152 4.27262C10.5493 4.27262 8.37623 5.17274 6.774 6.77498C5.17177 8.37721 4.27164 10.5503 4.27164 12.8162C4.27164 15.0821 5.17177 17.2552 6.774 18.8574C8.37623 20.4597 10.5493 21.3598 12.8152 21.3598C15.0811 21.3598 17.2542 20.4597 18.8565 18.8574C20.4587 17.2552 21.3588 15.0821 21.3588 12.8162C21.3588 10.5503 20.4587 8.37721 18.8565 6.77498C17.2542 5.17274 15.0811 4.27262 12.8152 4.27262Z"
                                                    fill="#4A58EC" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M13.8834 7.47518C13.8834 7.19194 13.7708 6.9203 13.5706 6.72002C13.3703 6.51974 13.0986 6.40723 12.8154 6.40723C12.5322 6.40723 12.2605 6.51974 12.0603 6.72002C11.86 6.9203 11.7475 7.19194 11.7475 7.47518V11.747H7.47566C7.19243 11.747 6.92079 11.8595 6.72051 12.0598C6.52023 12.26 6.40771 12.5317 6.40771 12.8149C6.40771 13.0982 6.52023 13.3698 6.72051 13.5701C6.92079 13.7704 7.19243 13.8829 7.47566 13.8829H11.7475V18.1547C11.7475 18.4379 11.86 18.7095 12.0603 18.9098C12.2605 19.1101 12.5322 19.2226 12.8154 19.2226C13.0986 19.2226 13.3703 19.1101 13.5706 18.9098C13.7708 18.7095 13.8834 18.4379 13.8834 18.1547V13.8829H18.1552C18.4384 13.8829 18.71 13.7704 18.9103 13.5701C19.1106 13.3698 19.2231 13.0982 19.2231 12.8149C19.2231 12.5317 19.1106 12.26 18.9103 12.0598C18.71 11.8595 18.4384 11.747 18.1552 11.747H13.8834V7.47518Z"
                                                    fill="#4A58EC" />
                                            </svg>
                                            <span
                                                class="lg-button-text">{{ __('app.settings.pipelines.add-stage-btn-title') }}</span>
                                        </button>

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
                        <a href=""><button type="button" class="btn clear-all-btn">Clear
                                All</button></a>
                    </div>
                    <div>
                        <button type="submit" class="btn save-btn">Save</button>
                        <a href="{{ url('pipelines') }}"><button type="button"
                                class="btn cancel-btn">Cancel</button></a>
                    </div>

                </div>

            </div>
        </div>
    </form>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("add_stage").addEventListener("click", function() {
                let tableBody = document.querySelector("table tbody");
                let winRow = tableBody.querySelector("tr:nth-last-child(2)");

                let newRow = document.createElement("tr");
        //         newRow.innerHTML = `
        //     <td><input type="text" class="form-control" name="stages[]" required ></td>
        //     <td><input type="number" step="any" class="form-control" name="probabilities[]" required></td>
        //     <td><i class="fa-solid fa-trash delete-stage remove-append-item mx-2"></i></td>
        // `;
         newRow.innerHTML = `
            <td><input type="text" class="form-control" name="stages[]" required ></td>
            <td><i class="fa-solid fa-trash delete-stage remove-append-item mx-2"></i></td>
        `;

                tableBody.insertBefore(newRow, winRow);
            });

            document.querySelector("table tbody").addEventListener("click", function(event) {
                if (event.target.classList.contains("delete-stage")) {
                    event.target.closest("tr").remove();
                }
            });
        });
    </script>
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
