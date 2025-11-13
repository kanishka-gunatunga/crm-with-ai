@extends('master')

@section('content')
    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate>
        @csrf
        <!-- Scrollable Content -->
        <div class="d-flex flex-column min-vh-100">
            <div class="flex-grow-1">
                <div class="main-scrollable ">

                    <div class="page-container">

                        <div class="page-title-container mb-0">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="page-title">
                                        {{ __('app.products.create-title') }}
                                    </h3>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ url('products') }}">Products</a></li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">
                                                Library</li>
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
                                                    name="name" value="{{ old('name') }}" required>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">SKU</label>
                                                <input type="text" class="form-control" id="field1" placeholder="SKU"
                                                    name="sku" value="{{ old('sku') }}" required>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">Quantity</label>
                                                <input type="number" class="form-control" id="field1"
                                                    placeholder="Quantity" step="any" name="quantity"
                                                    value="{{ old('quantity') }}" required>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="field1" class="form-label">Unit Cost</label>
                                                <input type="number" step="any" class="form-control" name="cost"
                                                    value="{{ old('cost') }}" required>
                                            </div>

                                        </div>


                                    </div>

                                </div>
                                <div class="card card-default mt-3">
                                    <div class="card-body">
                                        <div class="col-12">
                                            <label for="field5" class="form-label">Description</label>
                                            <textarea class="form-control description-form-control" placeholder="Description" id="field5" rows="5"
                                                name="description">{{ old('description') }}</textarea>

                                        </div>
                                    </div>
                                </div>
                                @if ($productAttributes->isNotEmpty())
                                    <div class="card card-default mt-3">
                                        <div class="card-body">
                                            @foreach ($productAttributes as $attribute)
                                                <div class="form-group mb-3">
                                                    <label class="form-label"
                                                        for="{{ $attribute->code }}">{{ $attribute->name }}</label>

                                                    @switch($attribute->type)
                                                        @case('text')
                                                            <input type="text" class="form-control" name="{{ $attribute->code }}"
                                                                {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                        @break

                                                        @case('textarea')
                                                            <textarea class="form-control" name="{{ $attribute->code }}" rows="3"
                                                                {{ $attribute->is_required == 'yes' ? 'required' : '' }}></textarea>
                                                        @break

                                                        @case('email')
                                                            <input type="email" class="form-control"
                                                                name="{{ $attribute->code }}"
                                                                {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                        @break

                                                        @case('price')
                                                            <input type="number" step="0.01" class="form-control"
                                                                name="{{ $attribute->code }}"
                                                                {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                        @break

                                                        @case('boolean')
                                                            <select name="{{ $attribute->code }}" class="form-select">
                                                                <option value="1">Yes</option>
                                                                <option value="0">No</option>
                                                            </select>
                                                        @break

                                                        @case('select')
                                                            @php
                                                                $options = [];
                                                                if ($attribute->options) {
                                                                    $options = json_decode($attribute->options, true);
                                                                }
                                                            @endphp
                                                            <select name="{{ $attribute->code }}" class="form-select"
                                                                {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                                <option value="">Select</option>
                                                                @foreach ($options as $opt)
                                                                    <option value="{{ $opt }}">{{ $opt }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        @break

                                                        @case('multiselect')
                                                            @php
                                                                $value = $customValues[$attribute->code] ?? [];
                                                                $options = [];

                                                                if ($attribute->option_type == 'lookups') {
                                                                    $options = $lookupOptions[$attribute->code] ?? [];
                                                                } else {
                                                                    if ($attribute->options) {
                                                                        $options = is_array($attribute->options)
                                                                            ? $attribute->options
                                                                            : json_decode($attribute->options, true);
                                                                    }
                                                                }
                                                            @endphp

                                                            <select name="{{ $attribute->code }}[]" multiple
                                                                class="form-select tagselect"
                                                                {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                                @foreach ($options as $id => $label)
                                                                    <option value="{{ $id }}"
                                                                        @if (is_array($value) && in_array($label, $value)) selected @endif>
                                                                        {{ $label }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        @break

                                                        @case('checkbox')
                                                            @php
                                                                $options = [];
                                                                if ($attribute->options) {
                                                                    $options = is_array($attribute->options)
                                                                        ? $attribute->options
                                                                        : json_decode($attribute->options, true);
                                                                }
                                                            @endphp
                                                            <div>
                                                                @foreach ($options as $opt)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="{{ $attribute->code }}[]"
                                                                            value="{{ $opt }}">
                                                                        <label
                                                                            class="form-check-label">{{ $opt }}</label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @break

                                                        @case('lookup')
                                                            @php
                                                                // Get lookup options prepared in the controller
                                                                $options = $lookupOptions[$attribute->code] ?? [];

                                                                // If editing, prefill the saved value
                                                                $value = $customValues[$attribute->code] ?? '';
                                                            @endphp

                                                            <select name="{{ $attribute->code }}" class="form-select"
                                                                {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                                <option value="">Select</option>



                                                                @foreach ($options as $name => $label)
                                                                    <option value="{{ $name }}"
                                                                        {{ (string) $value === (string) $name ? 'selected' : '' }}>
                                                                        {{ $label }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        @break

                                                        @case('date')
                                                            <input type="date" class="form-control"
                                                                name="{{ $attribute->code }}"
                                                                {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                        @break

                                                        @case('datetime')
                                                            <input type="datetime-local" class="form-control"
                                                                name="{{ $attribute->code }}"
                                                                {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                        @break

                                                        @case('file')
                                                            <input type="file" class="form-control"
                                                                name="{{ $attribute->code }}"
                                                                {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                        @break

                                                        @case('image')
                                                            <input type="file" accept="image/*" class="form-control"
                                                                name="{{ $attribute->code }}"
                                                                {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                        @break

                                                        @case('phone')
                                                            <input type="tel" class="form-control"
                                                                name="{{ $attribute->code }}"
                                                                {{ $attribute->is_required == 'yes' ? 'required' : '' }}>
                                                        @break

                                                        @default
                                                            <input type="text" class="form-control"
                                                                name="{{ $attribute->code }}">
                                                    @endswitch

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
                        <a href=""><button type="button" class="btn clear-all-btn">Clear
                                All</button></a>
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
