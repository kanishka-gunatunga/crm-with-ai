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
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.625 9.375H4.5V8.625H8.625V4.5H9.375V8.625H13.5V9.375H9.375V13.5H8.625V9.375Z"
                                            fill="white" />
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
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="d-flex gap-3 mb-4 justify-content-between align-items-center">
                                <div>
                                    <h3 class="card-title">Mails</h3>
                                </div>
                                <div>
                                    <button class="btn white-btn inbox active" data-bs-toggle="tab"
                                        data-bs-target="#inbox-tab-content">
                                        <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.012 2.3915C2.03668 2.28047 2.09848 2.18117 2.1872 2.10999C2.27592 2.03882 2.38626 2.00002 2.5 2H9.5C9.61374 2.00002 9.72408 2.03882 9.8128 2.10999C9.90152 2.18117 9.96332 2.28047 9.988 2.3915L10.988 6.8915C10.996 6.92717 11 6.96333 11 7V10.5C11 10.6326 10.9473 10.7598 10.8536 10.8536C10.7598 10.9473 10.6326 11 10.5 11H1.5C1.36739 11 1.24021 10.9473 1.14645 10.8536C1.05268 10.7598 1 10.6326 1 10.5V7C1.00003 6.9635 1.00405 6.92712 1.012 6.8915L2.012 2.3915ZM2.901 3L2.1235 6.5H4.5C4.5 6.89782 4.65804 7.27936 4.93934 7.56066C5.22064 7.84196 5.60218 8 6 8C6.39782 8 6.77936 7.84196 7.06066 7.56066C7.34196 7.27936 7.5 6.89782 7.5 6.5H9.8765L9.099 3H2.901ZM8.292 7.5C8.09745 7.94607 7.77697 8.32568 7.36985 8.59228C6.96272 8.85888 6.48665 9.00088 6 9.00088C5.51335 9.00088 5.03728 8.85888 4.63015 8.59228C4.22303 8.32568 3.90255 7.94607 3.708 7.5H2V10H10V7.5H8.292Z"
                                                fill="black" />
                                        </svg>

                                        Outbox
                                    </button>

                                    <button class="btn white-btn favourite" data-bs-toggle="tab"
                                        data-bs-target="#favourite-tab-content">
                                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6.63754 13.119L9.00004 11.694L11.3625 13.1377L10.7438 10.4377L12.825 8.63772L10.0875 8.39397L9.00004 5.84397L7.91254 8.37522L5.17504 8.61897L7.25629 10.4377L6.63754 13.119ZM5.49379 14.6925L6.42379 10.7077L3.33154 8.02872L7.40479 7.67622L9.00004 3.91797L10.5953 7.67547L14.6678 8.02797L11.5755 10.707L12.5063 14.6917L9.00004 12.5767L5.49379 14.6925Z"
                                                fill="black" />
                                        </svg>
                                        Favourite
                                    </button>

                                    {{-- <button class="btn white-btn outbox" data-bs-toggle="tab"
                                        data-bs-target="#outbox-tab-content">
                                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M13.2345 10.0636L3.84825 14.0161C3.64625 14.0961 3.45425 14.0788 3.27225 13.9643C3.09075 13.8493 3 13.6833 3 13.4663V5.53356C3 5.31606 3.091 5.14981 3.273 5.03481C3.4545 4.91981 3.64625 4.90281 3.84825 4.98381L13.2345 8.93556C13.4795 9.04456 13.602 9.23256 13.602 9.49956C13.602 9.76656 13.4795 9.95456 13.2345 10.0636ZM3.75 13.2496L12.6375 9.49956L3.75 5.74956V8.66331L7.3845 9.49956L3.75 10.3366V13.2496Z"
                                                fill="black" />
                                        </svg>

                                        Sent
                                    </button> --}}
                                </div>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="inbox-tab-content">
                                    <div class="row g-4">
                                        <!-- Inbox content goes here -->
                                        <form id="bulk-delete-form" method="get"
                                            action="{{ url('delete-selected-emails') }}">
                                            @csrf
                                            <div class="table-responsive">
                                                <table class="table new-table data-table-export">

                                                    <thead>
                                                        <tr>
                                                            <th class="corner-left"><input type="checkbox" id="select-all">
                                                            </th>
                                                            <th>Subject</th>
                                                            <th>Content</th>
                                                            <th>Date</th>
                                                            <th>Sent By</th>
                                                            <th class="corner-right">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($sent_emails as $sent_email)
                                                            <tr>
                                                                <td><input type="checkbox" name="selected_emails[]"
                                                                        value="{{ $sent_email->id }}"></td>
                                                                <td>{{ $sent_email->subject }}</td>
                                                                <td><?php echo \Illuminate\Support\Str::limit(strip_tags($sent_email->body), 150); ?></td>
                                                                <td>{{ \Carbon\Carbon::parse($sent_email->created_at)->format('M j, Y') }}
                                                                </td>
                                                                <td>
                                                                    {{-- {{ $sent_email->sender ? $sent_email->sender->name : 'N/A' }}  --}}
                                                                    {{ $sent_email->user->userDetails->name ?? 'N/A' }}
                                                                </td>
                                                                <td class="action-icons d-flex gx-3">
                                                                    <a href="{{ url('delete-emails/' . $sent_email->id) }}"
                                                                        class="delete-link-confirm">
                                                                        <div class="text-muted" type="button">
                                                                            <svg width="20" height="20"
                                                                                viewBox="0 0 18 18" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <rect width="18" height="18"
                                                                                    rx="2.90323" fill="#FFE9E5" />
                                                                                <path
                                                                                    d="M6.9431 12.7013C6.71689 12.7013 6.52331 12.6208 6.36236 12.4599C6.20141 12.2989 6.12079 12.1052 6.12052 11.8787V6.53197H5.70923V5.70939H7.76568V5.2981H10.2334V5.70939H12.2899V6.53197H11.8786V11.8787C11.8786 12.105 11.7981 12.2987 11.6372 12.4599C11.4762 12.6211 11.2825 12.7016 11.056 12.7013H6.9431ZM11.056 6.53197H6.9431V11.8787H11.056V6.53197ZM7.76568 11.0562H8.58826V7.35455H7.76568V11.0562ZM9.41084 11.0562H10.2334V7.35455H9.41084V11.0562Z"
                                                                                    fill="#ED2227" />
                                                                            </svg>
                                                                        </div>
                                                                    </a>
                                                                    <a target="_blank"
                                                                        href="{{ url('view-email/' . $sent_email->id) }}">
                                                                        <div class="text-muted" type="button">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="18" height="18"
                                                                                viewBox="0 0 18 18" fill="none">
                                                                                <rect width="18" height="18"
                                                                                    rx="2.90323" fill="#DAFFE1" />
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
                                            <button type="submit"
                                                class="btn btn-danger btn-sm mb-2 delete-form-confirm">Delete
                                                Selected</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="outbox-tab-content">
                                    <div class="text-center py-5 text-muted"> outbox emails to show.</div>
                                    <form id="bulk-delete-form" method="get" action="{{ url('delete-selected-emails') }}">
                                        @csrf
                                        <div class="table-responsive">


                                        </div>
                                        <button type="submit"
                                            class="btn btn-danger btn-sm mb-2 delete-form-confirm">Delete
                                            Selected</button>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="favourite-tab-content" role="tabpanel"
                                    aria-labelledby="favourite-tab-button">
                                    <form id="bulk-delete-form" method="get"
                                        action="{{ url('delete-selected-emails') }}">
                                        @csrf
                                        <div class="table-responsive">
                                            <table class="table new-table data-table-export" id="favouriteTable">

                                                <thead>
                                                    <tr>
                                                        <th class="corner-left"><input type="checkbox" id="select-all">
                                                        </th>
                                                        <th>Subject</th>
                                                        <th>Content</th>
                                                        <th>Date</th>
                                                        <th class="corner-right">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="favourite-table-body">

                                                </tbody>
                                            </table>

                                        </div>
                                        <button type="submit"
                                            class="btn btn-danger btn-sm mb-2 delete-form-confirm">Delete
                                            Selected</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        // Simple tab switching for buttons (if not using Bootstrap JS)
                        document.querySelectorAll('.btn.white-btn').forEach(btn => {
                            btn.addEventListener('click', function() {
                                document.querySelectorAll('.btn.white-btn').forEach(b => b.classList.remove('active'));
                                this.classList.add('active');
                                document.querySelectorAll('.tab-pane').forEach(tab => tab.classList.remove('show',
                                    'active'));
                                const target = this.getAttribute('data-bs-target');
                                if (target) {
                                    document.querySelector(target).classList.add('show', 'active');
                                }
                            });
                        });
                    </script>
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


    <script>
        $(document).ready(function() {
            // Fetch favourite emails and populate the table
            function fetchFavouriteEmails() {
                $.ajax({
                    url: '{{ url('favourite-emails') }}',
                    method: 'GET',
                    success: function(data) {
                        let tbody = $('#favourite-table-body');
                        tbody.empty(); // Clear existing rows
                        console.log(data); // Log the fetched data for debugging

                        const deleteUrl = `{{ url('delete-emails') }}/${email.id}`;
                        const viewUrl = `{{ url('view-email') }}/${email.id}`;


                        data.forEach(email => {
                            tbody.append(`
                                <tr>
                                    <td><input type="checkbox" name="selected_emails[]" value="${email.id}"></td>
                                    <td>${email.subject}</td>
                                    <td>${email.body.substring(0, 150)}</td>
                                    <td>${new Date(email.created_at).toLocaleDateString()}</td>
                                    <td class="action-icons d-flex gx-3">
                                        <a href="${deleteUrl}"
                                            class="delete-link-confirm">
                                            <div class="text-muted" type="button">
                                                <svg width="20" height="20"
                                                    viewBox="0 0 18 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="18" height="18"
                                                        rx="2.90323" fill="#FFE9E5" />
                                                    <path
                                                        d="M6.9431 12.7013C6.71689 12.7013 6.52331 12.6208 6.36236 12.4599C6.20141 12.2989 6.12079 12.1052 6.12052 11.8787V6.53197H5.70923V5.70939H7.76568V5.2981H10.2334V5.70939H12.2899V6.53197H11.8786V11.8787C11.8786 12.105 11.7981 12.2987 11.6372 12.4599C11.4762 12.6211 11.2825 12.7016 11.056 12.7013H6.9431ZM11.056 6.53197H6.9431V11.8787H11.056V6.53197ZM7.76568 11.0562H8.58826V7.35455H7.76568V11.0562ZM9.41084 11.0562H10.2334V7.35455H9.41084V11.0562Z"
                                                        fill="#ED2227" />
                                                </svg>
                                            </div>
                                        </a>
                                        <a target="_blank"
                                            href="${viewUrl}">
                                            <div class="text-muted" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    width="18" height="18"
                                                    viewBox="0 0 18 18" fill="none">
                                                    <rect width="18" height="18"
                                                        rx="2.90323" fill="#DAFFE1" />
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
                            `);
                        });
                    }
                });
            }

            fetchFavouriteEmails();
        });
    </script>
@endsection
