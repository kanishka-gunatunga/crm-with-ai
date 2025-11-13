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
                                        {{ __('app.products.edit-title') }}
                                    </h3>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ url('products') }}">Products</a></li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">
                                                Edit Product</li>
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
                                                <input type="text" class="form-control" id="field1" placeholder="Name"
                                                    name="name" value="{{ $product->name }}" required>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">SKU</label>
                                                <input type="text" class="form-control" id="field1" placeholder="SKU"
                                                    name="sku" value="{{ $product->sku }}" required>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">Quantity</label>
                                                <input type="number" class="form-control" id="field1"
                                                    placeholder="Quantity" step="any" name="quantity"
                                                    value="{{ $product->quantity }}" required>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">Unit Cost</label>
                                                <input type="number" step="any" class="form-control" name="cost"
                                                    value="{{ $product->cost }}" required>
                                            </div>

                                        </div>


                                    </div>

                                </div>
                                <div class="card card-default mt-3">
                                    <div class="card-body">
                                        <div class="col-12">
                                            <label for="field5" class="form-label">Description</label>
                                            <textarea class="form-control description-form-control" placeholder="Description" id="field5" rows="5"
                                                name="description">{{ $product->description }}</textarea>

                                        </div>
                                    </div>
                                </div>


                                @if ($productAttributes->isNotEmpty())
                                    <div class="card card-default mt-3">
                                        <div class="card-body">
                                            @foreach ($productAttributes as $attribute)
                                                <div class="mb-3">
                                                    <label>{{ $attribute->name }}</label>

                                                    @php
                                                        $value =
                                                            $customValues[$attribute->code] ??
                                                            ($customValues[$attribute->name] ?? '');
                                                        if ($attribute->options) {
                                                            $options = is_array($attribute->options)
                                                                ? $attribute->options
                                                                : json_decode($attribute->options, true);
                                                        }
                                                    @endphp

                                                    @if ($attribute->type == 'text')
                                                        <input type="text" name="{{ $attribute->code }}"
                                                            class="form-control" value="{{ $value }}"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                    @elseif ($attribute->type == 'email')
                                                        <input type="email" name="{{ $attribute->code }}"
                                                            class="form-control" value="{{ $value }}"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                    @elseif ($attribute->type == 'textarea')
                                                        <textarea name="{{ $attribute->code }}" class="form-control" {{ $attribute->is_required == 'yes' ? 'required' : '' }}>{{ $value }}</textarea>
                                                    @elseif ($attribute->type == 'number' || $attribute->type == 'price')
                                                        <input type="number" step="0.01" name="{{ $attribute->code }}"
                                                            class="form-control" value="{{ $value }}"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                    @elseif ($attribute->type == 'boolean')
                                                        <select name="{{ $attribute->code }}" class="form-select"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                            <option value="1" {{ $value == '1' ? 'selected' : '' }}>
                                                                Yes
                                                            </option>
                                                            <option value="0" {{ $value == '0' ? 'selected' : '' }}>
                                                                No
                                                            </option>
                                                        </select>
                                                    @elseif ($attribute->type == 'select')
                                                        <select name="{{ $attribute->code }}" class="form-select"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                            <option value="">Select</option>
                                                            @foreach ($options as $opt)
                                                                <option value="{{ $opt }}"
                                                                    {{ $value == $opt ? 'selected' : '' }}>
                                                                    {{ $opt }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @elseif ($attribute->type == 'multiselect')
                                                        @php
                                                            $value = $customValues[$attribute->code] ?? [];
                                                            $options = [];
                                                            if ($attribute->option_type === 'lookups') {
                                                                $options = $lookupOptions[$attribute->code] ?? [];
                                                            } else {
                                                                if ($attribute->options) {
                                                                    $options = is_array($attribute->options)
                                                                        ? $attribute->options
                                                                        : json_decode($attribute->options, true);
                                                                }
                                                            }

                                                            // Make sure value is always an array
                                                            if (!is_array($value)) {
                                                                $value = [$value];
                                                            }
                                                        @endphp

                                                        <select name="{{ $attribute->code }}[]" multiple
                                                            class="form-select tagselect"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>


                                                            @foreach ($options as $id => $label)
                                                                @php
                                                                    // The saved value may contain names or IDs depending on how it was stored.
                                                                    $isSelected =
                                                                        in_array($label, $value, true) ||
                                                                        in_array($id, $value, true);
                                                                @endphp
                                                                <option value="{{ $id }}"
                                                                    {{ $isSelected ? 'selected' : '' }}>
                                                                    {{ $label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @elseif ($attribute->type == 'checkbox')
                                                        @foreach ($options as $opt)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="{{ $attribute->code }}[]"
                                                                    value="{{ $opt }}"
                                                                    @if (is_array($value) && in_array($opt, $value)) checked @endif>
                                                                <label
                                                                    class="form-check-label">{{ $opt }}</label>
                                                            </div>
                                                        @endforeach
                                                    @elseif ($attribute->type == 'lookup')
                                                        @php
                                                            // Retrieve lookup options for this attribute
                                                            $options = $lookupOptions[$attribute->code] ?? [];

                                                            // Get the saved value (the name, e.g., 'Facebook')
                                                            $value =
                                                                $customValues[$attribute->code] ??
                                                                ($customValues[$attribute->name] ?? '');
                                                        @endphp

                                                        <select name="{{ $attribute->code }}" class="form-select"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                            <option value="">Select</option>


                                                            @foreach ($options as $id => $label)
                                                                <option value="{{ $id }}"
                                                                    {{ $label === $value ? 'selected' : '' }}>
                                                                    {{ $label }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @elseif ($attribute->type == 'date')
                                                        <input type="date" name="{{ $attribute->code }}"
                                                            class="form-control" value="{{ $value }}"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                    @elseif ($attribute->type == 'datetime')
                                                        <input type="datetime-local" name="{{ $attribute->code }}"
                                                            class="form-control" value="{{ $value }}"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                    @elseif ($attribute->type == 'file')
                                                        <input type="file" name="{{ $attribute->code }}"
                                                            class="form-control"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                        @if ($value)
                                                            <p class="mt-2">Current file: <a
                                                                    href="{{ asset('uploads/' . $value) }}"
                                                                    target="_blank">{{ $value }}</a></p>
                                                        @endif
                                                    @elseif ($attribute->type == 'image')
                                                        <input type="file" accept="image/*"
                                                            name="{{ $attribute->code }}" class="form-control"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                        @if ($value)
                                                            <div class="mt-2">
                                                                <img src="{{ asset('uploads/' . $value) }}"
                                                                    alt="Uploaded Image" width="100">
                                                            </div>
                                                        @endif
                                                    @elseif ($attribute->type == 'phone')
                                                        <input type="tel" name="{{ $attribute->code }}"
                                                            class="form-control" value="{{ $value }}"
                                                            {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                    @else
                                                        <input type="text" name="{{ $attribute->code }}"
                                                            class="form-control" value="{{ $value }}">
                                                    @endif

                                                    @error($attribute->code)
                                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif





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
                        <a href="{{ url('products') }}"><button type="button"
                                class="btn cancel-btn">Cancel</button></a>
                    </div>

                </div>
            </div>
        </div>
    </form>
    <!-- Bottom Action Buttons -->


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
