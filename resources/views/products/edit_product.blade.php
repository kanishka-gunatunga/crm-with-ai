@extends('master')

@section('content')


<!-- Scrollable Content -->

                <div class="main-scrollable">
              
                    <div class="page-container">
                    <form  action="" method="post" enctype="multipart/form-data" data-parsley-validate>
                    @csrf
                        <div class="page-title-container mb-0">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="page-title"> 
                                       {{ __('app.products.edit-title') }}
                                    </h3>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ url('products') }}">Products</a></li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">Library</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>

                        </div>

                        <div class="col-12">
                            <div class="card-container">
                            
                                    <div class="card card-default">
                                        <div class="card-body">


                                            <div class="row g-4">
                                                <div class="col-12 col-md-4">
                                                    <label for="field1" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="field1" placeholder="Name" name="name" value="{{ $product->name }}" required>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="field1" class="form-label">SKU</label>
                                                    <input type="text" class="form-control" id="field1" placeholder="SKU" name="sku" value="{{ $product->sku }}" required>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="field1" class="form-label">Quantity</label>
                                                    <input type="number" class="form-control" id="field1" placeholder="Quantity" step="any"  name="quantity" value="{{ $product->quantity }}" required>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="field1" class="form-label">Unit Cost</label>
                                                    <input type="number" step="any" class="form-control" name="cost" value="{{ $product->cost }}" required>
                                                </div>

                                            </div>


                                        </div>

                                    </div>
                                    <div class="card card-default mt-3">
                                        <div class="card-body">
                                            <div class="col-12">
                                                <label for="field5" class="form-label">Description</label>
                                                <textarea class="form-control" placeholder="Description" id="field5" rows="5" name="description">{{ $product->description }}</textarea>

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
                             <a href="{{url('products')}}"><button type="button" class="btn cancel-btn">Cancel</button></a>
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
@endsection
