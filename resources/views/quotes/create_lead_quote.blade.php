
@extends('master')

@section('content')

<?php
use App\Models\Person;
use App\Models\UserDetails;
use App\Models\Organization;
use App\Models\Product;
use App\Models\Service;
$owner_name = UserDetails::where('id', $lead->sales_owner)->value('name');
$person = Person::where('id', $lead->person)->first();
$organization = Organization::where('id', $person->organization)->first();
?>
  <!-- Scrollable Content -->
                <div class="main-scrollable">
                    <div class="page-container">
                    <form  action="" method="post" enctype="multipart/form-data" data-parsley-validate>
                    @csrf
                        <div class="page-title-container mb-0">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="page-title">
                                     {{ __('app.quotes.create-title') }}
                                    </h3>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"> {{ __('app.quotes.title') }}</a></li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">{{ __('app.quotes.create-title') }}</li>
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
                                                    <label for="assign_user" class="form-label">{{ __('app.quotes.lead') }}</label>
                                                   <input type="text" class="form-control" name="lead" value="{{ $lead->title }}" readonly required>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="assign_user" class="form-label">Sales Owner</label>
                                                    <input type="text" class="form-control" name="owner" value="{{ $owner_name }}" readonly required>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="assign_user" class="form-label">Subject</label>
                                                    <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" required>
                                                    @if($errors->has("subject")) <div class="alert alert-danger mt-2">{{ $errors->first('subject') }}</li></div>@endif
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="expired_at" class="form-label">Expired At</label>
                                                    <div class="input-group">
                                                        <input type="date" class="form-control" id="expired_at" placeholder="Expired At" name="expired_at" value="{{ old('expired_at') }}" required>

                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="terms" class="form-label">Person</label>
                                                    <input type="text" class="form-control" name="person" value="{{ $person->name }}" readonly required>
                                                </div>

                                                <div class="col-12 col-md-4">
                                                    <label for="date_start" class="form-label" name="description">Description</label>
                                                    <input type="text" class="form-control" id="date_start" placeholder="Description" >
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
                                                <label for="No" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="No" placeholder="No" name="address" required value="{{$organization->address  ?? ''}}">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="Province" class="form-label">Province</label>
                                                <input type="text" class="form-control" id="Province" placeholder="Province" name="state" required value="{{$organization->state  ?? ''}}">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="Country" class="form-label">Country</label>
                                                <input type="text" class="form-control" id="Country" placeholder="Country" name="country" required value="{{$organization->country  ?? ''}}">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="City" class="form-label">City</label>
                                                <input type="text" class="form-control" id="City" name="city" placeholder="City" required value="{{$organization->city  ?? ''}}">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="Postal Code" class="form-label">Postal Code</label>
                                                <input type="text" class="form-control" id="Postal Code"  name="post_code" placeholder="Post Code"  required value="{{$organization->post_code  ?? ''}}">
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
                                                <label for="No" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="No" placeholder="No" name="shipping_address" required value="{{$organization->address  ?? ''}}">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="Province" class="form-label">Province</label>
                                                <input type="text" class="form-control" id="Province" placeholder="Province" name="shipping_state" required value="{{$organization->state  ?? ''}}">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="Country" class="form-label">Country</label>
                                                <input type="text" class="form-control" id="Country" placeholder="Country" name="shipping_country" required value="{{$organization->country  ?? ''}}">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="City" class="form-label">City</label>
                                                <input type="text" class="form-control" id="City" name="shipping_city" placeholder="City" required value="{{$organization->city  ?? ''}}">
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="Postal Code" class="form-label">Postal Code</label>
                                                <input type="text" class="form-control" id="Postal Code" name="shipping_post_code" placeholder="Post Code"  required value="{{$organization->post_code ?? ''}}">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card card-default">
                                    <div class="card-body">
                                        <div class="row g-4">
                                            <div class="table-responsive">
                                                <div class="d-flex justify-content-between align-items-center mb-5">
                                                    <h5 class="card-title">{{ __('app.quotes.quote-items') }}</h5>
                                                    <button class="import-leads-button" type="button" id="add-product">
                                                        <div class="icon-container">
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8.625 9.375H4.5V8.625H8.625V4.5H9.375V8.625H13.5V9.375H9.375V13.5H8.625V9.375Z" fill="white" />
                                                            </svg>

                                                        </div>
                                                        <span class="button-text" >{{ __('app.common.add_more') }}</span>
                                                    </button>

                                                </div>
                                                <table class="table new-table">
                                                    <thead>
                                                        <tr>

                                                            <th class="corner-left" style="width:400px;">Name</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <th>Amount</th>
                                                            <th>Discount (%)</th>
                                                            <th>Tax (%)</th>
                                                            <th>Total</th>

                                                            <th class="corner-right">Actions</th>
                                                        </tr>
                                                    </thead>
                                                     <tbody id="products-tbody">
                                                          <?php 
                                                          $product_total = 0;
                                                          foreach($lead_products as $lead_product){ 
                                                            $product_total = $product_total+$lead_product->amount;
                                                            if($lead_product->type == "product"){
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <select class="form-control product-select" name="products[]" required>
                                                                        <option hidden selected  value="product||{{$lead_product->product_id}}" data-price="{{$lead_product->price}}">{{Product::where('id',$lead_product->product_id)->value('name')}}</option>
                                                                        <?php foreach($products as $product){ ?> 
                                                                        <option value="product||{{$product->id}}" data-price="{{$product->cost}}">{{$product->name}}</option>
                                                                        <?php } ?>
                                                                        <?php foreach($services as $service){ ?> 
                                                                            <option value="service||{{$service->id}}" data-price="{{$service->cost}}">{{$service->name}}</option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <textarea class="form-contro w-100 mt-2" id="exampleFormControlTextarea5" rows="3" name="note[]" placeholder="Notes">{{$lead_product->note}}</textarea>
                                                                </td>
                                                                <td><input type="number" step="any" class="form-control" name="quantity[]" value="{{$lead_product->quantity}}" required></td>
                                                                <td><input type="number" step="any" class="form-control" name="price[]" value="{{$lead_product->price}}" required></td>
                                                                <td><input type="number" step="any" class="form-control" name="amount[]" value="{{$lead_product->amount}}" readonly required></td>
                                                                <td><input type="number" step="any" class="form-control" name="discount[]"></td>
                                                                <td><input type="number" step="any" class="form-control" name="tax[]"></td>
                                                                <td><input type="number" step="any" class="form-control" name="total[]" value="{{$lead_product->amount}}"  readonly></td>
                                                                <td><button type="button" class="btn btn-danger remove-product">-</button></td>
                                                            </tr>
                                                          <?php }else{ ?> 
                                                            <tr>
                                                                <td>
                                                                    <select class="form-control product-select" name="products[]" required>
                                                                        <option hidden selected  value="service||{{$lead_product->product_id}}" data-price="{{$lead_product->price}}">{{Service::where('id',$lead_product->product_id)->value('name')}}</option>
                                                                        <?php foreach($products as $product){ ?> 
                                                                        <option value="product||{{$product->id}}" data-price="{{$product->cost}}">{{$product->name}}</option>
                                                                        <?php } ?>
                                                                        <?php foreach($services as $service){ ?> 
                                                                            <option value="service||{{$service->id}}" data-price="{{$service->cost}}">{{$service->name}}</option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <textarea class="form-contro w-100 mt-2" id="exampleFormControlTextarea5" rows="3" name="note[]" placeholder="Notes">{{$lead_product->note}}</textarea>
                                                                </td>
                                                                <td><input type="number" step="any" class="form-control" name="quantity[]" value="{{$lead_product->quantity}}" required></td>
                                                                <td><input type="number" step="any" class="form-control" name="price[]" value="{{$lead_product->price}}" required></td>
                                                                <td><input type="number" step="any" class="form-control" name="amount[]" value="{{$lead_product->amount}}" readonly required></td>
                                                                <td><input type="number" step="any" class="form-control" name="discount[]"></td>
                                                                <td><input type="number" step="any" class="form-control" name="tax[]"></td>
                                                                <td><input type="number" step="any" class="form-control" name="total[]" value="{{$lead_product->amount}}"  readonly></td>
                                                                <td><button type="button" class="btn btn-danger remove-product">-</button></td>
                                                            </tr>
                                                            <?php }} ?>
                                                        </tbody>
                                                     <tfoot>
                                                            <tr>
                                                                <th colspan="6" style="text-align:right">{{ __('app.quotes.sub-total') }}</th>
                                                                <th id="sub-total">{{$product_total}}</th>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="6" style="text-align:right">{{ __('app.quotes.discount') }} -</th>
                                                                <th  id="discount-total"></th>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="6" style="text-align:right">{{ __('app.quotes.tax') }} +</th>
                                                                <th  id="tax-total"></th>
                                                            </tr>
                                                           
                                                            <tr>
                                                                <th colspan="6" style="text-align:right">{{ __('app.quotes.total') }}</th>
                                                                <th  id="order-total">{{$product_total}}</th>
                                                            </tr>
                                                        </tfoot> 
                                                </table>
                                            </div>

                                        </div>

                                        <input type="hidden" class="form-control" name="discount_total_amount" id="discount_total_amount" readonly value="0">
                                        <input type="hidden" class="form-control" name="tax_total_amount" id="tax_total_amount" readonly value="0">
                                        <input type="hidden" class="form-control" name="order_total_input" id="order_total_input" readonly  value="{{$product_total}}">
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
                                <a href="{{url('quotes')}}"><button type="button" class="btn cancel-btn">Cancel</button></a>
                            </div>

                        </div>

                    </div>        
                        </div>
                     
                    
                     </form>
                    </div>
                </div>

                <!-- Bottom Action Buttons -->
 <script>
    $(document).ready(function() {
        @if(Session::has('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ Session::get('success') }}",
                confirmButtonColor: '#3085d6'
            });
        @endif

        @if(Session::has('fail'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ Session::get('fail') }}",
                confirmButtonColor: '#d33'
            });
        @endif
    });
</script>
<script>
    $(document).ready(function () {

    function initializeSelect2() {
        $(".product-select").select2({
            placeholder: "Select a product",
            allowClear: true
        }).on('change', function () {
            let row = $(this).closest('tr');
            let price = $(this).find(':selected').data('price');
            row.find('input[name="price[]"]').val(price).trigger('input');
        });
    }

    initializeSelect2();

    function calculateRow(row) {
        let quantity = parseFloat(row.find('input[name="quantity[]"]').val()) || 0;
        let price = parseFloat(row.find('input[name="price[]"]').val()) || 0;
        let discount = parseFloat(row.find('input[name="discount[]"]').val()) || 0;
        let tax = parseFloat(row.find('input[name="tax[]"]').val()) || 0;

        let amount = quantity * price;
        let discountAmount = (amount * discount) / 100;
        let taxableAmount = amount - discountAmount;
        let taxAmount = (taxableAmount * tax) / 100;
        let total = taxableAmount + taxAmount;

        row.find('input[name="amount[]"]').val(amount.toFixed(2));
        row.find('input[name="total[]"]').val(total.toFixed(2));

        updateTotals();
    }

    function updateTotals() {
        let subtotal = 0, totalDiscount = 0, totalTax = 0, grandTotal = 0;

        $('#products-tbody tr').each(function () {
            let amount = parseFloat($(this).find('input[name="amount[]"]').val()) || 0;
            let discount = parseFloat($(this).find('input[name="discount[]"]').val()) || 0;
            let tax = parseFloat($(this).find('input[name="tax[]"]').val()) || 0;
            let total = parseFloat($(this).find('input[name="total[]"]').val()) || 0;

            subtotal += amount;
            totalDiscount += (amount * discount) / 100;
            totalTax += ((amount - (amount * discount) / 100) * tax) / 100;
            grandTotal += total;
        });

        $('#sub-total').text(subtotal.toFixed(2));
        $('#discount-total').text(totalDiscount.toFixed(2));
        $('#discount_total_amount').val(totalDiscount.toFixed(2));
        $('#tax-total').text(totalTax.toFixed(2));
        $('#tax_total_amount').val(totalTax.toFixed(2));
        $('#order-total').text(grandTotal.toFixed(2));
        $('#order_total_input').val(grandTotal.toFixed(2));
    }

    $('#products-tbody').on('input', 'input[name="quantity[]"], input[name="price[]"], input[name="discount[]"], input[name="tax[]"]', function () {
        calculateRow($(this).closest('tr'));
    });

    $('#products-tbody').on('click', '.remove-product', function () {
        $(this).closest('tr').remove();
        updateTotals(); 
    });

    $('#add-product').on('click', function () {
        let newRow = `
            <tr>
                <td>
                    <select class="form-control product-select" name="products[]" required>
                        <option hidden selected></option>
                        <?php foreach($products as $product){ ?> 
                        <option value="product||{{$product->id}}" data-price="{{$product->cost}}">{{$product->name}}</option>
                        <?php } ?>
                        <?php foreach($services as $service){ ?> 
                        <option value="service||{{$service->id}}" data-price="{{$service->cost}}">{{$service->name}}</option>
                        <?php } ?>
                    </select>
                    <textarea class="form-contro w-100 mt-2" id="exampleFormControlTextarea5" rows="3" name="note[]" placeholder="Notes"></textarea>
                </td>
                <td><input type="number" step="any" class="form-control" name="quantity[]" required></td>
                <td><input type="number" step="any" class="form-control" name="price[]" required></td>
                <td><input type="number" step="any" class="form-control" name="amount[]" readonly required></td>
                <td><input type="number" step="any" class="form-control" name="discount[]"></td>
                <td><input type="number" step="any" class="form-control" name="tax[]"></td>
                <td><input type="number" step="any" class="form-control" name="total[]" readonly></td>
                <td><button type="button" class="btn btn-danger remove-product">-</button></td>
            </tr>
        `;
        $('#products-tbody').append(newRow);
        initializeSelect2();
    });
});

</script>

@endsection



