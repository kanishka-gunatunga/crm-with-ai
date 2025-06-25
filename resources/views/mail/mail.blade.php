@extends('master')

@section('content')

<!-- Scrollable Content -->
<div class="main-scrollable">
    <div class="page-container">
        <div class="page-title-container">
            <div class="d-flex justify-content-between">
                <h3 class="page-title">
                    Mails
                </h3>
                <div class="d-flex gap-3">



                    <a href="{{ url('compose-email') }}" class="text-decoration-none">
                        <button class="create-btn">
                            <div class="icon-container">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.625 9.375H4.5V8.625H8.625V4.5H9.375V8.625H13.5V9.375H9.375V13.5H8.625V9.375Z" fill="white" />
                                </svg>

                            </div>

                            <span class="button-text">Compose</span>


                        </button>
                    </a>
                </div>


            </div>

        </div>

        <div class="col-12 mt-4">
            <div class="card-container">
                <!-- <div class="card card-default mb-4">
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-12 col-md-4">
                                        <label for="field1" class="form-label">Terms and Conditions</label>
                                        <input type="text" class="form-control" id="field1" placeholder="Change your T&C from here">
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="field2" class="form-label">Quote Logo</label>
                                        <input type="file" class="form-control" id="field2" placeholder="Pipeline">
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <img src="../images/d6af22486fc0ee1005bfcdbe7e596b125bc8e316.png" width="222px" height="118px" alt="" style="object-fit: cover;">
                                    </div>
                                </div>
                            </div>
                        </div> -->


                <div class="card card-default">
                    <div class="card-body">
                        <div class="d-flex gap-3 mb-4 justify-content-between align-items-center">
                            <div>
                                <h3 class="card-title">Mails</h3>
                            </div>
                            <div>
                                <button class="btn white-btn">
                                    <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.63754 13.119L9.00004 11.694L11.3625 13.1377L10.7438 10.4377L12.825 8.63772L10.0875 8.39397L9.00004 5.84397L7.91254 8.37522L5.17504 8.61897L7.25629 10.4377L6.63754 13.119ZM5.49379 14.6925L6.42379 10.7077L3.33154 8.02872L7.40479 7.67622L9.00004 3.91797L10.5953 7.67547L14.6678 8.02797L11.5755 10.707L12.5063 14.6917L9.00004 12.5767L5.49379 14.6925Z" fill="black" />
                                    </svg>


                                    Favorite


                                </button>

                                <button class="btn white-btn">
                                    <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.625 10.481V6.96425L7.05 8.53925L6.519 8L9 5.519L11.481 8L10.95 8.54L9.375 6.965V10.481H8.625ZM4.212 15.5C3.8665 15.5 3.57825 15.3845 3.34725 15.1535C3.11625 14.9225 3.0005 14.634 3 14.288V4.712C3 4.3665 3.11575 4.07825 3.34725 3.84725C3.57875 3.61625 3.867 3.5005 4.212 3.5H13.7887C14.1337 3.5 14.422 3.61575 14.6535 3.84725C14.885 4.07875 15.0005 4.367 15 4.712V14.2887C15 14.6337 14.8845 14.922 14.6535 15.1535C14.4225 15.385 14.134 15.5005 13.788 15.5H4.212ZM4.212 14.75H13.7887C13.9233 14.75 14.0337 14.7067 14.1202 14.6202C14.2067 14.5337 14.25 14.4233 14.25 14.2887V12.2113H11.5673C11.2888 12.6862 10.9238 13.0553 10.4722 13.3182C10.0208 13.5812 9.53 13.7125 9 13.712C8.47 13.7115 7.97925 13.5802 7.52775 13.3182C7.07625 13.0562 6.71125 12.6875 6.43275 12.212H3.75V14.2887C3.75 14.4233 3.79325 14.5337 3.87975 14.6202C3.96625 14.7067 4.077 14.75 4.212 14.75ZM9 12.962C9.475 12.962 9.90625 12.8245 10.2938 12.5495C10.6813 12.2745 10.95 11.912 11.1 11.462H14.25V4.712C14.25 4.577 14.2067 4.46625 14.1202 4.37975C14.0337 4.29325 13.9233 4.25 13.7887 4.25H4.21125C4.07675 4.25 3.96625 4.29325 3.87975 4.37975C3.79325 4.46625 3.75 4.577 3.75 4.712V11.462H6.9C7.05 11.912 7.31875 12.2745 7.70625 12.5495C8.09375 12.8245 8.525 12.962 9 12.962ZM4.212 14.75H3.75H14.25H4.212Z" fill="black" />
                                    </svg>


                                    Outbox

                                </button>
                            </div>



                        </div>
                        <div class="row g-4">
                            <form id="bulk-delete-form" method="POST"
                                    action="{{ url('delete-selected-emails') }}">
                                    @csrf
                            <div class="table-responsive">
                                <table class="table new-table" id="newTable">

                                    <thead>
                                        <tr>
                                           <th class="corner-left"><input type="checkbox" id="select-all"></th>
                                            <th>Subject</th>
                                            <th>Content</th>
                                            <th>Date</th>
                                            <th class="corner-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($sent_emails as $sent_email)
                                            <tr>
                                                <td><input type="checkbox" name="selected_emails[]" value="{{ $sent_email->id }}"></td>
                                                <td>{{ $sent_email->subject }}</td>
                                                <td><?php echo \Illuminate\Support\Str::limit(strip_tags($sent_email->body), 150) ?></td>
                                                <td>{{ \Carbon\Carbon::parse($sent_email->created_at)->format('M j, Y') }}</td>
                                                <td class="action-icons d-flex gx-3">
                                                    <a href="{{ url('delete-email/' . $sent_email->id) }}" class="delete-link-confirm">
                                                    <div class="text-muted" type="button">
                                                        <svg width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="18" height="18" rx="2.90323" fill="#FFE9E5" />
                                                            <path d="M6.9431 12.7013C6.71689 12.7013 6.52331 12.6208 6.36236 12.4599C6.20141 12.2989 6.12079 12.1052 6.12052 11.8787V6.53197H5.70923V5.70939H7.76568V5.2981H10.2334V5.70939H12.2899V6.53197H11.8786V11.8787C11.8786 12.105 11.7981 12.2987 11.6372 12.4599C11.4762 12.6211 11.2825 12.7016 11.056 12.7013H6.9431ZM11.056 6.53197H6.9431V11.8787H11.056V6.53197ZM7.76568 11.0562H8.58826V7.35455H7.76568V11.0562ZM9.41084 11.0562H10.2334V7.35455H9.41084V11.0562Z" fill="#ED2227" />
                                                        </svg>
                                                    </div>
                                                    </a>
                                                    <a target="_blank"
                                                            href="{{ url('view-email/' . $sent_email->uid) }}">
                                                            <div class="text-muted" type="button">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                    height="18" viewBox="0 0 18 18" fill="none">
                                                                    <rect width="18" height="18" rx="2.90323"
                                                                        fill="#DAFFE1" />
                                                                    <path
                                                                        d="M9.06445 6.43457C11.8438 6.43457 13.127 9.0002 13.127 9.0002C13.127 9.0002 11.8438 11.5658 9.06445 11.5658C6.28508 11.5658 5.00195 9.0002 5.00195 9.0002C5.00195 9.0002 6.28508 6.43457 9.06445 6.43457Z"
                                                                        stroke="#0AC900" stroke-width="0.580625"
                                                                        stroke-linejoin="round" />
                                                                    <path
                                                                        d="M10.277 9C10.2808 9.16646 10.2512 9.33199 10.1901 9.48687C10.1289 9.64175 10.0375 9.78285 9.92105 9.9019C9.80464 10.0209 9.66562 10.1155 9.51215 10.1801C9.35868 10.2447 9.19385 10.2779 9.02734 10.2779C8.86084 10.2779 8.69601 10.2447 8.54254 10.1801C8.38907 10.1155 8.25005 10.0209 8.13363 9.9019C8.01722 9.78285 7.92576 9.64175 7.86463 9.48687C7.8035 9.33199 7.77393 9.16646 7.77766 9C7.77766 8.66848 7.90935 8.35054 8.14377 8.11612C8.37819 7.8817 8.69614 7.75 9.02766 7.75C9.35918 7.75 9.67712 7.8817 9.91154 8.11612C10.146 8.35054 10.2777 8.66848 10.2777 9H10.277Z"
                                                                        stroke="#0AC900" stroke-width="0.580625"
                                                                        stroke-linejoin="round" />
                                                                </svg>
                                                            </div>
                                                        </a>
                                                </td>
                                            </tr>
                                      @endforeach



                                    </tbody>
                                </table>
                            </div>
  <button type="submit" class="btn btn-danger btn-sm mb-2 delete-form-confirm">Delete
                                        Selected</button>
                                </form>
                        </div>

                        <!--<nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center mt-5">
                                                <li class="page-item disabled">
                                                    <a class="page-link">Prev</a>
                                                </li>
                                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                <li class="page-item next">
                                                    <a class="page-link" href="#">Next</a>
                                                </li>
                                            </ul>
                                        </nav>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
        document.getElementById('select-all').addEventListener('click', function(event) {
            let checkboxes = document.querySelectorAll('input[name="selected_emails[]"]');
            checkboxes.forEach(cb => cb.checked = event.target.checked);
        });
    </script>
@endsection