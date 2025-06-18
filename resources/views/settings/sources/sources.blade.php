@extends('master')

@section('content')


<!-- Scrollable Content -->
<div class="main-scrollable">
    <div class="page-container">
        <div class="page-title-container">
            <div class="d-flex justify-content-between">
                <h3 class="page-title">
                    {{ __('app.settings.sources.title') }}
                </h3>
                <div class="d-flex gap-3">


                    <a href="{{ url('create-source') }}">
                        <button class="import-leads-button">
                            <div class="icon-container">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.625 9.375H4.5V8.625H8.625V4.5H9.375V8.625H13.5V9.375H9.375V13.5H8.625V9.375Z" fill="white" />
                                </svg>


                            </div>

                            <span class="button-text">{{ __('app.settings.sources.create-title') }}</span>


                        </button>
                    </a>
                </div>


            </div>

        </div>

        <div class="col-12 mt-4">
            <div class="card-container">



                <div class="card card-default">
                    <div class="card-body">
                        <div class="d-flex gap-3 mb-4 justify-content-between align-items-center">
                            <div>
                                <h3 class="card-title">{{ __('app.settings.sources.title') }}</h3>
                            </div>
                            <div>
                               
                               <button class="btn white-btn export-toggle">
                                    <svg width="18" height="18" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.44091 4.89252C8.48096 4.93551 8.52926 4.96998 8.58293 4.99389C8.63659 5.01781 8.69453 5.03066 8.75327 5.0317C8.81201 5.03274 8.87036 5.02193 8.92484 4.99993C8.97932 4.97792 9.0288 4.94517 9.07035 4.90363C9.11189 4.86208 9.14464 4.8126 9.16665 4.75812C9.18865 4.70364 9.19946 4.64529 9.19842 4.58655C9.19738 4.52781 9.18452 4.46987 9.16061 4.41621C9.1367 4.36254 9.10222 4.31424 9.05924 4.27419L7.30924 2.52419C7.22721 2.44226 7.11601 2.39624 7.00007 2.39624C6.88414 2.39624 6.77294 2.44226 6.69091 2.52419L4.94091 4.27419C4.86363 4.35712 4.82155 4.46682 4.82355 4.58016C4.82555 4.6935 4.87147 4.80164 4.95163 4.8818C5.03179 4.96196 5.13993 5.00787 5.25327 5.00987C5.36661 5.01187 5.4763 4.9698 5.55924 4.89252L6.56257 3.88919V8.66669C6.56257 8.78272 6.60867 8.894 6.69071 8.97605C6.77276 9.05809 6.88404 9.10419 7.00007 9.10419C7.11611 9.10419 7.22739 9.05809 7.30943 8.97605C7.39148 8.894 7.43757 8.78272 7.43757 8.66669V3.88919L8.44091 4.89252Z" fill="#172635" />
                                        <path d="M12.1041 7.5C12.1041 7.38397 12.058 7.27269 11.9759 7.19064C11.8939 7.10859 11.7826 7.0625 11.6666 7.0625C11.5506 7.0625 11.4393 7.10859 11.3572 7.19064C11.2752 7.27269 11.2291 7.38397 11.2291 7.5C11.2291 8.05538 11.1197 8.60533 10.9072 9.11843C10.6946 9.63154 10.3831 10.0978 9.99039 10.4905C9.59768 10.8832 9.13146 11.1947 8.61835 11.4072C8.10524 11.6198 7.5553 11.7292 6.99992 11.7292C6.44454 11.7292 5.89459 11.6198 5.38149 11.4072C4.86838 11.1947 4.40216 10.8832 4.00945 10.4905C3.61673 10.0978 3.30521 9.63154 3.09268 9.11843C2.88014 8.60533 2.77075 8.05538 2.77075 7.5C2.77075 7.38397 2.72466 7.27269 2.64261 7.19064C2.56056 7.10859 2.44928 7.0625 2.33325 7.0625C2.21722 7.0625 2.10594 7.10859 2.02389 7.19064C1.94185 7.27269 1.89575 7.38397 1.89575 7.5C1.89575 8.85371 2.43351 10.152 3.39073 11.1092C4.34794 12.0664 5.64621 12.6042 6.99992 12.6042C8.35363 12.6042 9.65189 12.0664 10.6091 11.1092C11.5663 10.152 12.1041 8.85371 12.1041 7.5Z" fill="#172635" />
                                    </svg>

                                    Export


                                </button>
                            </div>



                        </div>
                        <div class="row g-4">
                            <form id="bulk-delete-form" method="POST" action="{{ url('delete-selected-sources') }}">
                            @csrf
                            <div class="table-responsive">
                                <table class="table new-table data-table-export" data-export-title="Sources" data-export-filename="Sources">

                                    <thead>
                                        <tr>
                                            <th class="corner-left"><input type="checkbox" id="select-all"></th>
                                            <th>{{ __('app.datagrid.id') }}</th>
                                            <th>{{ __('app.datagrid.name') }}</th>
                                            <th>{{ __('app.leads.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php foreach($sources as $source){
                                        ?>
                                                <tr class="odd gradeX">
                                                    <td><input type="checkbox" name="selected_sources[]" value="{{ $source->id }}"></td>
                                                    <td class="">{{$source->id}} </td>
                                                    <td class="">{{$source->name}} </td>
                                                    <td class="action-icons d-flex gx-3">
                                                
                                                        <a href="{{ url('delete-source/'.$source->id) }}" class="delete-link-confirm">
                                                        <div class="text-muted" type="button">
                                                            <svg width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="18" height="18" rx="2.90323" fill="#FFE9E5" />
                                                                <path d="M6.9431 12.7013C6.71689 12.7013 6.52331 12.6208 6.36236 12.4599C6.20141 12.2989 6.12079 12.1052 6.12052 11.8787V6.53197H5.70923V5.70939H7.76568V5.2981H10.2334V5.70939H12.2899V6.53197H11.8786V11.8787C11.8786 12.105 11.7981 12.2987 11.6372 12.4599C11.4762 12.6211 11.2825 12.7016 11.056 12.7013H6.9431ZM11.056 6.53197H6.9431V11.8787H11.056V6.53197ZM7.76568 11.0562H8.58826V7.35455H7.76568V11.0562ZM9.41084 11.0562H10.2334V7.35455H9.41084V11.0562Z" fill="#ED2227" />
                                                            </svg>
                                                        </div>
                                                        </a>
                                                        <a href="{{ url('edit-source/'.$source->id) }}">
                                                        <div class="text-muted" type="button">
                                                            <svg width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="18" height="18" rx="2.90323" fill="#E7E9FD" />
                                                                <path d="M6.1206 11.8786H6.70663L10.7266 7.85862L10.1406 7.27258L6.1206 11.2926V11.8786ZM5.70935 12.7011C5.59282 12.7011 5.49522 12.6616 5.41654 12.5826C5.33785 12.5037 5.29837 12.4061 5.2981 12.2898V11.2926C5.2981 11.1829 5.31866 11.0783 5.35978 10.9788C5.40091 10.8792 5.45917 10.7919 5.53456 10.7168L10.7266 5.53505C10.8088 5.45966 10.8997 5.4014 10.9993 5.36027C11.0988 5.31915 11.2032 5.29858 11.3126 5.29858C11.422 5.29858 11.5283 5.31915 11.6313 5.36027C11.7344 5.4014 11.8235 5.46308 11.8987 5.54533L12.4641 6.12108C12.5464 6.19648 12.6063 6.28558 12.6438 6.3884C12.6814 6.49121 12.7003 6.59402 12.7006 6.69683C12.7006 6.8065 12.6817 6.9111 12.6438 7.01062C12.606 7.11014 12.5461 7.20089 12.4641 7.28287L7.28238 12.4646C7.20698 12.54 7.11952 12.5983 7.02 12.6394C6.92048 12.6805 6.81602 12.7011 6.70663 12.7011H5.70935ZM10.4284 7.57074L10.1406 7.27258L10.7266 7.85862L10.4284 7.57074Z" fill="#4A58EC" />
                                                            </svg>
                                                        </div>
                                                        </a>
                                                    </td>
                                                   
                                                </tr>
                                            <?php } ?>

                                    </tbody>
                                </table>
                            </div>
 <button type="submit" class="btn btn-danger btn-sm mb-2 delete-form-confirm" >Delete Selected</button>
                        </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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
    document.getElementById('select-all').addEventListener('click', function(event) {
        let checkboxes = document.querySelectorAll('input[name="selected_sources[]"]');
        checkboxes.forEach(cb => cb.checked = event.target.checked);
    });
</script>

@endsection