@extends('master')

@section('content')



<!-- Scrollable Content -->
<div class="main-scrollable">
    <div class="page-container">
        <div class="page-title-container mb-0">
            <div class="d-flex justify-content-between">
                <div>
                    <h3 class="page-title">
                        Create Pipeline
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Pipelines</a></li>
                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">Create Pipeline</li>
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

                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Rotten Days</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Rotten Days">
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
                                    <label for="field1" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Name">
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Probability</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Probability">
                                </div>

                            </div>
                            <div class="row g-4 mt-1">
                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Name">
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Probability</label>
                                    <div class="d-flex gap-3">
                                        <input type="text" class="form-control" id="field1" placeholder="Probability">

                                    </div>

                                </div>

                                <div class="col-12 col-md-4 d-flex flex-column justify-content-end">
                                    <span class="d-flex align-items-center mb-1" type="button">

                                        <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="29" height="29" rx="4.67742" fill="#FFE9E5" />
                                            <path d="M11.1861 20.4636C10.8217 20.4636 10.5098 20.3339 10.2505 20.0746C9.99119 19.8153 9.86132 19.5032 9.86088 19.1383V10.524H9.19824V9.19877H12.5114V8.53613H16.4872V9.19877H19.8004V10.524H19.1378V19.1383C19.1378 19.5027 19.0081 19.8148 18.7488 20.0746C18.4895 20.3343 18.1774 20.464 17.8125 20.4636H11.1861ZM17.8125 10.524H11.1861V19.1383H17.8125V10.524ZM12.5114 17.813H13.8367V11.8493H12.5114V17.813ZM15.1619 17.813H16.4872V11.8493H15.1619V17.813Z" fill="#ED2227" />
                                        </svg>


                                    </span>
                                </div>
                            </div>


                            <div class="row g-4 mt-1">
                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Name">
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Probability</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Probability">
                                </div>

                            </div>


                            <div class="row g-4 mt-1">
                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Name">
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="field1" class="form-label">Probability</label>
                                    <input type="text" class="form-control" id="field1" placeholder="Probability">
                                </div>

                            </div>


                            <div class="row g-4 mt-1">
                                <div class="col-12 col-md-4">
                                    <button class="btn add-more-button p-0">
                                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.13574 12.8162C2.13574 6.91793 6.91695 2.13672 12.8152 2.13672C18.7135 2.13672 23.4947 6.91793 23.4947 12.8162C23.4947 18.7145 18.7135 23.4957 12.8152 23.4957C6.91695 23.4957 2.13574 18.7145 2.13574 12.8162ZM12.8152 4.27262C10.5493 4.27262 8.37623 5.17274 6.774 6.77498C5.17177 8.37721 4.27164 10.5503 4.27164 12.8162C4.27164 15.0821 5.17177 17.2552 6.774 18.8574C8.37623 20.4597 10.5493 21.3598 12.8152 21.3598C15.0811 21.3598 17.2542 20.4597 18.8565 18.8574C20.4587 17.2552 21.3588 15.0821 21.3588 12.8162C21.3588 10.5503 20.4587 8.37721 18.8565 6.77498C17.2542 5.17274 15.0811 4.27262 12.8152 4.27262Z" fill="#4A58EC" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.8834 7.47518C13.8834 7.19194 13.7708 6.9203 13.5706 6.72002C13.3703 6.51974 13.0986 6.40723 12.8154 6.40723C12.5322 6.40723 12.2605 6.51974 12.0603 6.72002C11.86 6.9203 11.7475 7.19194 11.7475 7.47518V11.747H7.47566C7.19243 11.747 6.92079 11.8595 6.72051 12.0598C6.52023 12.26 6.40771 12.5317 6.40771 12.8149C6.40771 13.0982 6.52023 13.3698 6.72051 13.5701C6.92079 13.7704 7.19243 13.8829 7.47566 13.8829H11.7475V18.1547C11.7475 18.4379 11.86 18.7095 12.0603 18.9098C12.2605 19.1101 12.5322 19.2226 12.8154 19.2226C13.0986 19.2226 13.3703 19.1101 13.5706 18.9098C13.7708 18.7095 13.8834 18.4379 13.8834 18.1547V13.8829H18.1552C18.4384 13.8829 18.71 13.7704 18.9103 13.5701C19.1106 13.3698 19.2231 13.0982 19.2231 12.8149C19.2231 12.5317 19.1106 12.26 18.9103 12.0598C18.71 11.8595 18.4384 11.747 18.1552 11.747H13.8834V7.47518Z" fill="#4A58EC" />
                                        </svg>


                                        <span class="lg-button-text">Add More</span>
                                    </button>
                                </div>


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
                                           <button type="button" class="btn cancel-btn">Cancel</button>
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
           <button type="button" class="btn cancel-btn">Cancel</button>
        </div>

    </div>

</div>
@endsection