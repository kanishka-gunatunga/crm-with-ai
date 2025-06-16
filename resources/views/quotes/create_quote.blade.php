
@extends('master')

@section('content')


  <!-- Scrollable Content -->
                <div class="main-scrollable">
                    <div class="page-container">
                        <div class="page-title-container mb-0">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="page-title">
                                        Create Quote
                                    </h3>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#">Quotes</a></li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">Create Quote</li>
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
                                                    <label for="assign_user" class="form-label">Lead</label>
                                                    <select class="myDropdown form-control  ">
                                                        <option value="1">Option 1</option>
                                                        <option value="2">Option 2</option>
                                                        <option value="3">Option 3</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="assign_user" class="form-label">Sales Owner</label>
                                                    <select class="myDropdown form-control  ">
                                                        <option value="1">Option 1</option>
                                                        <option value="2">Option 2</option>
                                                        <option value="3">Option 3</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="assign_user" class="form-label">Subject</label>
                                                    <select class="myDropdown form-control">
                                                        <option value="1">Option 1</option>
                                                        <option value="2">Option 2</option>
                                                        <option value="3">Option 3</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="expired_at" class="form-label">Expired At</label>
                                                    <div class="input-group">
                                                        <input type="date" class="form-control" id="expired_at" placeholder="Expired At">

                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="terms" class="form-label">Person</label>
                                                    <select class="myDropdown form-control">
                                                        <option value="1">Option 1</option>
                                                        <option value="2">Option 2</option>
                                                        <option value="3">Option 3</option>
                                                    </select>
                                                </div>

                                                <div class="col-12 col-md-4">
                                                    <label for="date_start" class="form-label">Description</label>
                                                    <input type="text" class="form-control" id="date_start" placeholder="Date Start">
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Billing Address Card -->
                                <div class="card card-default mb-4">

                                    <div class="card-body">
                                        <h5 class="mb-3 card-title">Billing Address</h5>
                                        <div class="row g-4">
                                            <div class="col-12 col-md-4">
                                                <label for="No" class="form-label">No.</label>
                                                <input type="text" class="form-control" id="No" placeholder="No">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="Province" class="form-label">Province</label>
                                                <input type="text" class="form-control" id="Province" placeholder="Province">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="Country" class="form-label">Country</label>
                                                <input type="text" class="form-control" id="Country" placeholder="Country">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="City" class="form-label">City</label>
                                                <input type="text" class="form-control" id="City" placeholder="City">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="Postal Code" class="form-label">Postal Code</label>
                                                <input type="text" class="form-control" id="Postal Code" placeholder="Postal Code">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Shipping Address Card -->
                                <div class="card card-default mb-4">

                                    <div class="card-body">
                                        <h5 class="mb-3 card-title">Shipping Address</h5>
                                        <div class="row g-4">
                                            <div class="col-12 col-md-4">
                                                <label for="No" class="form-label">No.</label>
                                                <input type="text" class="form-control" id="No" placeholder="No">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="Province" class="form-label">Province</label>
                                                <input type="text" class="form-control" id="Province" placeholder="Province">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="Country" class="form-label">Country</label>
                                                <input type="text" class="form-control" id="Country" placeholder="Country">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="City" class="form-label">City</label>
                                                <input type="text" class="form-control" id="City" placeholder="City">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="Postal Code" class="form-label">Postal Code</label>
                                                <input type="text" class="form-control" id="Postal Code" placeholder="Postal Code">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card card-default">
                                    <div class="card-body">
                                        <div class="row g-4">
                                            <div class="table-responsive">
                                                <div class="d-flex justify-content-between align-items-center mb-5">
                                                    <h5 class="card-title">Quotes</h5>
                                                    <button class="import-leads-button">
                                                        <div class="icon-container">
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8.625 9.375H4.5V8.625H8.625V4.5H9.375V8.625H13.5V9.375H9.375V13.5H8.625V9.375Z" fill="white" />
                                                            </svg>

                                                        </div>
                                                        <span class="button-text">Add Item</span>
                                                    </button>

                                                </div>
                                                <table class="table new-table">
                                                    <thead>
                                                        <tr>

                                                            <th class="corner-left">Name</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <th>Amount</th>
                                                            <th>Discount (%)</th>
                                                            <th>Tax (%)</th>
                                                            <th>Total</th>

                                                            <th class="corner-right">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php for ($i = 0; $i < 10; $i++): ?>
                                                            <tr>

                                                                <td>Infinity CRM</td>
                                                                <td>1</td>
                                                                <td>$1345</td>
                                                                <td>$766</td>
                                                                <td>

                                                                    <select id="terms" class="form-control dropdown">
                                                                        <option value="1">Option 1</option>
                                                                        <option value="2">Option 2</option>
                                                                        <option value="3">Option 3</option>

                                                                    </select>
                                                                </td>

                                                                <td>$120</td>
                                                                <td>$545</td>

                                                                <td class="action-icons d-flex gx-3">
                                                                    <div class="text-muted" type="button">
                                                                        <svg width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <rect width="18" height="18" rx="2.90323" fill="#FFE9E5" />
                                                                            <path d="M6.9431 12.7013C6.71689 12.7013 6.52331 12.6208 6.36236 12.4599C6.20141 12.2989 6.12079 12.1052 6.12052 11.8787V6.53197H5.70923V5.70939H7.76568V5.2981H10.2334V5.70939H12.2899V6.53197H11.8786V11.8787C11.8786 12.105 11.7981 12.2987 11.6372 12.4599C11.4762 12.6211 11.2825 12.7016 11.056 12.7013H6.9431ZM11.056 6.53197H6.9431V11.8787H11.056V6.53197ZM7.76568 11.0562H8.58826V7.35455H7.76568V11.0562ZM9.41084 11.0562H10.2334V7.35455H9.41084V11.0562Z" fill="#ED2227" />
                                                                        </svg>
                                                                    </div>

                                                                </td>
                                                            </tr>
                                                        <?php endfor; ?>



                                                    </tbody>

                                                </table>
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



