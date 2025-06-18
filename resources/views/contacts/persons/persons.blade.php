
@extends('master')

@section('content')

<?php
use App\Models\Organization;
?>
    <!-- Scrollable Content -->
    <!-- Scrollable Content -->
                <div class="main-scrollable">
                    <div class="page-container">
                        <div class="page-title-container">
                            <div class="d-flex justify-content-between">
                                <h3 class="page-title">
                                    {{ __('app.contacts.persons.title') }}
                                </h3>
                                <div class="d-flex gap-3">


                                   
                                        <button class="import-leads-button" data-bs-toggle="modal" data-bs-target=".importPersons">
                                            <div class="icon-container">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M10.8526 7.8525C10.9041 7.79723 10.9662 7.75291 11.0352 7.72216C11.1042 7.69142 11.1787 7.67489 11.2542 7.67356C11.3298 7.67222 11.4048 7.68612 11.4748 7.71441C11.5449 7.7427 11.6085 7.78481 11.6619 7.83822C11.7153 7.89164 11.7574 7.95526 11.7857 8.0253C11.814 8.09534 11.8279 8.17036 11.8266 8.24589C11.8252 8.32142 11.8087 8.3959 11.778 8.4649C11.7472 8.5339 11.7029 8.596 11.6476 8.6475L9.39761 10.8975C9.29215 11.0028 9.14918 11.062 9.00012 11.062C8.85105 11.062 8.70808 11.0028 8.60262 10.8975L6.35262 8.6475C6.29735 8.596 6.25302 8.5339 6.22228 8.4649C6.19154 8.3959 6.175 8.32142 6.17367 8.24589C6.17234 8.17036 6.18623 8.09534 6.21452 8.0253C6.24281 7.95526 6.28492 7.89164 6.33834 7.83822C6.39175 7.78481 6.45538 7.7427 6.52542 7.71441C6.59546 7.68612 6.67048 7.67222 6.74601 7.67356C6.82153 7.67489 6.89602 7.69142 6.96502 7.72216C7.03402 7.75291 7.09612 7.79723 7.14762 7.8525L8.43762 9.1425V3C8.43762 2.85082 8.49688 2.70774 8.60237 2.60225C8.70786 2.49676 8.85093 2.4375 9.00012 2.4375C9.1493 2.4375 9.29237 2.49676 9.39786 2.60225C9.50335 2.70774 9.56261 2.85082 9.56261 3V9.1425L10.8526 7.8525Z" fill="white" />
                                                    <path d="M15.5625 9C15.5625 8.85082 15.5032 8.70774 15.3977 8.60225C15.2923 8.49676 15.1492 8.4375 15 8.4375C14.8508 8.4375 14.7077 8.49676 14.6023 8.60225C14.4968 8.70774 14.4375 8.85082 14.4375 9C14.4375 9.71406 14.2969 10.4211 14.0236 11.0808C13.7503 11.7405 13.3498 12.34 12.8449 12.8449C12.34 13.3498 11.7405 13.7503 11.0808 14.0236C10.4211 14.2969 9.71406 14.4375 9 14.4375C8.28594 14.4375 7.57887 14.2969 6.91916 14.0236C6.25945 13.7503 5.66003 13.3498 5.15511 12.8449C4.65019 12.34 4.24966 11.7405 3.9764 11.0808C3.70314 10.4211 3.5625 9.71406 3.5625 9C3.5625 8.85082 3.50324 8.70774 3.39775 8.60225C3.29226 8.49676 3.14918 8.4375 3 8.4375C2.85082 8.4375 2.70774 8.49676 2.60225 8.60225C2.49676 8.70774 2.4375 8.85082 2.4375 9C2.4375 10.7405 3.1289 12.4097 4.35961 13.6404C5.59032 14.8711 7.25952 15.5625 9 15.5625C10.7405 15.5625 12.4097 14.8711 13.6404 13.6404C14.8711 12.4097 15.5625 10.7405 15.5625 9Z" fill="white" />
                                                </svg>

                                            </div>

                                            <span class="button-text">Import Persons</span>


                                        </button>
                                   


                                    <a href="{{url('create-person')}}">
                                        <button class="import-leads-button">
                                            <div class="icon-container">
                                                <svg
                                                    width="15"
                                                    height="16"
                                                    viewBox="0 0 15 16"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="import-icon">
                                                    <path
                                                        d="M9.04372 7.04375C9.08664 6.9977 9.13839 6.96076 9.19589 6.93514C9.25339 6.90952 9.31546 6.89574 9.3784 6.89463C9.44134 6.89352 9.50386 6.9051 9.56222 6.92867C9.62059 6.95225 9.67361 6.98734 9.71812 7.03185C9.76263 7.07636 9.79773 7.12938 9.8213 7.18775C9.84488 7.24612 9.85645 7.30864 9.85534 7.37158C9.85423 7.43452 9.84046 7.49659 9.81484 7.55409C9.78922 7.61159 9.75228 7.66334 9.70622 7.70625L7.83122 9.58125C7.74333 9.66903 7.62419 9.71834 7.49997 9.71834C7.37576 9.71834 7.25662 9.66903 7.16872 9.58125L5.29372 7.70625C5.24767 7.66334 5.21073 7.61159 5.18511 7.55409C5.15949 7.49659 5.14571 7.43452 5.1446 7.37158C5.14349 7.30864 5.15507 7.24612 5.17865 7.18775C5.20222 7.12938 5.23731 7.07636 5.28183 7.03185C5.32634 6.98734 5.37936 6.95225 5.43773 6.92867C5.49609 6.9051 5.55861 6.89352 5.62155 6.89463C5.68449 6.89574 5.74656 6.90952 5.80406 6.93514C5.86156 6.96076 5.91331 6.9977 5.95622 7.04375L7.03122 8.11875V3C7.03122 2.87568 7.08061 2.75645 7.16852 2.66854C7.25643 2.58064 7.37565 2.53125 7.49997 2.53125C7.62429 2.53125 7.74352 2.58064 7.83143 2.66854C7.91934 2.75645 7.96872 2.87568 7.96872 3V8.11875L9.04372 7.04375Z"
                                                        fill="white"></path>
                                                    <path
                                                        d="M12.9688 8C12.9688 7.87568 12.9194 7.75645 12.8315 7.66854C12.7435 7.58064 12.6243 7.53125 12.5 7.53125C12.3757 7.53125 12.2565 7.58064 12.1685 7.66854C12.0806 7.75645 12.0312 7.87568 12.0312 8C12.0312 8.59505 11.914 9.18428 11.6863 9.73403C11.4586 10.2838 11.1248 10.7833 10.7041 11.2041C10.2833 11.6248 9.78379 11.9586 9.23403 12.1863C8.68428 12.414 8.09505 12.5312 7.5 12.5312C6.90495 12.5312 6.31572 12.414 5.76597 12.1863C5.21621 11.9586 4.71669 11.6248 4.29592 11.2041C3.87516 10.7833 3.54139 10.2838 3.31367 9.73403C3.08595 9.18428 2.96875 8.59505 2.96875 8C2.96875 7.87568 2.91936 7.75645 2.83146 7.66854C2.74355 7.58064 2.62432 7.53125 2.5 7.53125C2.37568 7.53125 2.25645 7.58064 2.16854 7.66854C2.08064 7.75645 2.03125 7.87568 2.03125 8C2.03125 9.4504 2.60742 10.8414 3.63301 11.867C4.6586 12.8926 6.0496 13.4688 7.5 13.4688C8.9504 13.4688 10.3414 12.8926 11.367 11.867C12.3926 10.8414 12.9688 9.4504 12.9688 8Z"
                                                        fill="white"></path>
                                                </svg>
                                            </div>

                                            <span class="button-text">{{ __('app.contacts.persons.create-title') }}</span>


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
                                                <h3 class="card-title">Persons</h3>
                                            </div>
                                            <div>
                                                <button class="btn white-btn export-toggle">
                                                    <svg width="18" height="18" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M8.44091 4.89252C8.48096 4.93551 8.52926 4.96998 8.58293 4.99389C8.63659 5.01781 8.69453 5.03066 8.75327 5.0317C8.81201 5.03274 8.87036 5.02193 8.92484 4.99993C8.97932 4.97792 9.0288 4.94517 9.07035 4.90363C9.11189 4.86208 9.14464 4.8126 9.16665 4.75812C9.18865 4.70364 9.19946 4.64529 9.19842 4.58655C9.19738 4.52781 9.18452 4.46987 9.16061 4.41621C9.1367 4.36254 9.10222 4.31424 9.05924 4.27419L7.30924 2.52419C7.22721 2.44226 7.11601 2.39624 7.00007 2.39624C6.88414 2.39624 6.77294 2.44226 6.69091 2.52419L4.94091 4.27419C4.86363 4.35712 4.82155 4.46682 4.82355 4.58016C4.82555 4.6935 4.87147 4.80164 4.95163 4.8818C5.03179 4.96196 5.13993 5.00787 5.25327 5.00987C5.36661 5.01187 5.4763 4.9698 5.55924 4.89252L6.56257 3.88919V8.66669C6.56257 8.78272 6.60867 8.894 6.69071 8.97605C6.77276 9.05809 6.88404 9.10419 7.00007 9.10419C7.11611 9.10419 7.22739 9.05809 7.30943 8.97605C7.39148 8.894 7.43757 8.78272 7.43757 8.66669V3.88919L8.44091 4.89252Z" fill="#172635" />
                                                        <path d="M12.1041 7.5C12.1041 7.38397 12.058 7.27269 11.9759 7.19064C11.8939 7.10859 11.7826 7.0625 11.6666 7.0625C11.5506 7.0625 11.4393 7.10859 11.3572 7.19064C11.2752 7.27269 11.2291 7.38397 11.2291 7.5C11.2291 8.05538 11.1197 8.60533 10.9072 9.11843C10.6946 9.63154 10.3831 10.0978 9.99039 10.4905C9.59768 10.8832 9.13146 11.1947 8.61835 11.4072C8.10524 11.6198 7.5553 11.7292 6.99992 11.7292C6.44454 11.7292 5.89459 11.6198 5.38149 11.4072C4.86838 11.1947 4.40216 10.8832 4.00945 10.4905C3.61673 10.0978 3.30521 9.63154 3.09268 9.11843C2.88014 8.60533 2.77075 8.05538 2.77075 7.5C2.77075 7.38397 2.72466 7.27269 2.64261 7.19064C2.56056 7.10859 2.44928 7.0625 2.33325 7.0625C2.21722 7.0625 2.10594 7.10859 2.02389 7.19064C1.94185 7.27269 1.89575 7.38397 1.89575 7.5C1.89575 8.85371 2.43351 10.152 3.39073 11.1092C4.34794 12.0664 5.64621 12.6042 6.99992 12.6042C8.35363 12.6042 9.65189 12.0664 10.6091 11.1092C11.5663 10.152 12.1041 8.85371 12.1041 7.5Z" fill="#172635" />
                                                    </svg>

                                                    Export


                                                </button>

                                                <button class="btn white-btn" data-bs-toggle="offcanvas" data-bs-target="#offFilter" aria-controls="offcanvasRight">
                                                    <svg width="18" height="18" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M2.33333 2.25H11.6667C11.8214 2.25 11.9697 2.31146 12.0791 2.42085C12.1885 2.53025 12.25 2.67862 12.25 2.83333V3.7585C12.25 3.9132 12.1885 4.06155 12.0791 4.17092L8.33758 7.91242C8.22818 8.02179 8.1667 8.17014 8.16667 8.32483V12.0027C8.16666 12.0914 8.14645 12.1789 8.10755 12.2586C8.06866 12.3383 8.01211 12.4081 7.94221 12.4626C7.8723 12.5172 7.79088 12.5551 7.70414 12.5734C7.61739 12.5918 7.5276 12.5901 7.44158 12.5686L6.27492 12.2769C6.14877 12.2453 6.03681 12.1725 5.9568 12.07C5.87679 11.9674 5.83334 11.8411 5.83333 11.7111V8.32483C5.8333 8.17014 5.77182 8.02179 5.66242 7.91242L1.92092 4.17092C1.81151 4.06155 1.75003 3.9132 1.75 3.7585V2.83333C1.75 2.67862 1.81146 2.53025 1.92085 2.42085C2.03025 2.31146 2.17862 2.25 2.33333 2.25Z" stroke="#172635" stroke-width="0.875" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>

                                                    Filter

                                                </button>
                                            </div>



                                        </div>
                                        <div class="row g-4">
                                            <form id="bulk-delete-form" method="POST" action="{{ url('delete-selected-persons') }}">
                                            @csrf
                                            <div class="table-responsive">
                                                <table class="table new-table data-table-export" data-export-title="Persons" data-export-filename="Persons">

                                                    <thead>
                                                        <tr>
                                                            <th class="corner-left"><input type="checkbox" id="select-all"></th>
                                                            <th>{{ __('app.datagrid.id') }}</th>
                                                            <th>{{ __('app.datagrid.name') }}</th>
                                                            <th>{{ __('app.datagrid.email') }}</th>
                                                            <th>{{ __('app.datagrid.contact_numbers') }}</th>
                                                            <th>{{ __('app.datagrid.organization_name') }}</th>
                                                            <th>{{ __('app.leads.actions') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($persons as $person){
                                                        ?>
                                                                <tr class="odd gradeX">
                                                                <td><input type="checkbox" name="selected_persons[]" value="{{ $person->id }}"></td>
                                                                    <td class="">{{$person->id}} </td>
                                                                    <td class="">{{$person->name}} </td>
                                                                    <td class="">
                                                                    @if($person->emails)
                                                                        @php
                                                                            $emails = is_string($person->emails) ? json_decode($person->emails, true) : $person->emails;
                                                                        @endphp


                                                                        @foreach($emails as $email)
                                                                            {{ $email['value'] }} ({{ $email['label'] }})<br>
                                                                        @endforeach
                                                                    @endif
                                                                    </td>
                                                                    <td class="">
                                                                    @if($person->contact_numbers)
                                                                        @php
                                                                            $contactNumbers = is_string($person->contact_numbers) ? json_decode($person->contact_numbers, true) : $person->contact_numbers;
                                                                        @endphp

                                                                        @foreach($contactNumbers as $contactNumber)
                                                                            {{ $contactNumber['value'] }} ({{ $contactNumber['label'] }})<br>
                                                                        @endforeach
                                                                    @endif
                                                                    </td>
                                                                    <td class=""><a href="{{url('organizations?id='.$person->organization)}}">
                                                                        {{Organization::where('id', $person->organization)->value('name') ?? '-'}}</a></td>
                            
                                                                    <td class="action-icons d-flex gx-3">
                                                                        
                                                                        <a href="{{ url('delete-person/'.$person->id) }}" class="delete-link-confirm">
                                                                        <div class="text-muted" type="button">
                                                                            <svg width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <rect width="18" height="18" rx="2.90323" fill="#FFE9E5" />
                                                                                <path d="M6.9431 12.7013C6.71689 12.7013 6.52331 12.6208 6.36236 12.4599C6.20141 12.2989 6.12079 12.1052 6.12052 11.8787V6.53197H5.70923V5.70939H7.76568V5.2981H10.2334V5.70939H12.2899V6.53197H11.8786V11.8787C11.8786 12.105 11.7981 12.2987 11.6372 12.4599C11.4762 12.6211 11.2825 12.7016 11.056 12.7013H6.9431ZM11.056 6.53197H6.9431V11.8787H11.056V6.53197ZM7.76568 11.0562H8.58826V7.35455H7.76568V11.0562ZM9.41084 11.0562H10.2334V7.35455H9.41084V11.0562Z" fill="#ED2227" />
                                                                            </svg>
                                                                        </div>
                                                                        </a>
                                                                        <a href="{{ url('edit-person/'.$person->id) }}">
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
                                        <button type="submit" class="btn btn-danger mb-2 btn-sm delete-form-confirm">Delete Selected</button>
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
        let checkboxes = document.querySelectorAll('input[name="selected_persons[]"]');
        checkboxes.forEach(cb => cb.checked = event.target.checked);
    });
</script>


<div class="offcanvas offcanvas-end" tabindex="-1" id="offFilter" aria-labelledby="offFiltertLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="offFilterLabel">Filter</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-4 overflow-hidden">
    <form action="" method="get" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" class="form-control" name="id" value="{{ request('id', $filters['id'] ?? '') }}">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ request('name', $filters['name'] ?? '') }}">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" value="{{ request('email', $filters['email'] ?? '') }}">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="contact_number" class="form-label">Contact Number</label>
                    <input type="text" class="form-control" name="contact_number" value="{{ request('contact_number', $filters['contact_number'] ?? '') }}">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="organization" class="form-label">Organization</label>
                    <select class="form-control" name="organization">
                        <option value="">Select</option>
                        @foreach($organizations as $organization)
                            <option value="{{ $organization->id }}" {{ request('organization', $filters['organization'] ?? '') == $organization->id ? 'selected' : '' }}>
                                {{ $organization->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-info">Apply Filter</button>
            <a href="{{ url('persons') }}" class="btn btn-danger">Clear</a>
        </form>


    </div>
   
</div>


<div class="modal fade importPersons" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
        <form method="POST" action="{{ url('import-persons') }}" enctype="multipart/form-data" data-parsley-validate>
                @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Import Persons</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">

                <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="firstNameinput" class="form-label">Select File (CSV, Excel)</label>
                <input type="file" class="form-control" name="persons" value="" required>
                @if($errors->has("persons")) <div class="alert alert-danger mt-2">{{ $errors->first('persons') }}</li></div>@endif
                <a href="{{ asset('uploads/import_templates/Persons Import Template.xlsx') }}" download>Download Template</a>
            </div>
        </div>

    </div>
    <!--end row-->
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" class="btn btn-link link-success fw-medium shadow-none" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                    <button type="submit" class="btn btn-primary ">Import</button>
                </div>

            </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div>
@endsection



