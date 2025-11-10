@extends('master')

@section('content')
    <!-- Scrollable Content -->
    <div class="main-scrollable">
        <div class="page-container">
            <div class="page-title-container">
                <div class="d-flex justify-content-between">
                    <h3 class="page-title">
                        Mail
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

                <main class="email-container">
                    <div class="card card-default">
                        <div class="card-body">
                            <header class="email-header">
                                <h1 class="email-subject">

                                    {{ $mail->subject ?? 'Email Subject' }}
                                </h1>
                                <div class="category-badge-container">
                                    <div class="category-badge">
                                        <span class="category-label">Inbox</span>
                                        <a href="{{ url('emails') }}">
                                            <svg width="8" height="8" viewBox="0 0 8 8" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_542_1137)">
                                                    <path
                                                        d="M1.33333 0L0 1.33333L2.66667 4L0 6.66667L1.33333 8L4 5.33333L6.66667 8L8 6.66667L5.33333 4L8 1.33333L6.66667 0L4 2.66667L1.33333 0Z"
                                                        fill="black" fill-opacity="0.6" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_542_1137">
                                                        <rect width="8" height="8" fill="white"
                                                            transform="matrix(-1 0 0 -1 8 8)" />
                                                    </clipPath>
                                                </defs>
                                            </svg>

                                        </a>
                                    </div>
                                </div>
                            </header>

                            <section class="email-meta">
                                <div class="sender-info">
                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect width="40" height="40" rx="20" fill="black"
                                            fill-opacity="0.05" />
                                        <path
                                            d="M19.9998 19.9993C22.0257 19.9993 23.6665 18.3585 23.6665 16.3327C23.6665 14.3068 22.0257 12.666 19.9998 12.666C17.974 12.666 16.3332 14.3068 16.3332 16.3327C16.3332 18.3585 17.974 19.9993 19.9998 19.9993ZM19.9998 21.8327C17.5523 21.8327 12.6665 23.061 12.6665 25.4993V27.3327H27.3332V25.4993C27.3332 23.061 22.4473 21.8327 19.9998 21.8327Z"
                                            fill="black" fill-opacity="0.16" />
                                    </svg>

                                    <div class="sender-details">
                                        <div class="sender-name-row">
                                            <h2 class="sender-name">Michelle Rivera</h2>
                                            <div class="sender-email">
                                                <span class="bracket">&lt;</span>
                                                <span class="email-address">{{ $mail->to[0] ?? '' }}</span>
                                                <span class="bracket">&gt;</span>
                                            </div>
                                        </div>
                                        <div class="recipient-info">
                                            <span class="recipient-label">to</span>
                                            <div class="recipient-details">
                                                <span class="recipient-name">me</span>
                                                <a href="#" id="popoverLink" data-bs-toggle="popover"
                                                    data-bs-placement="bottom">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M4.66675 5.99967L8.00008 9.33301L11.3334 5.99967H4.66675Z"
                                                            fill="black" fill-opacity="0.6" />
                                                    </svg>
                                                </a>

                                                <!-- Popover content is stored here but will not be shown directly -->
                                                <div id="popover-content" style="display:none;">
                                                    <p>
                                                        To : {{ $mail->to[0] ?? '' }}
                                                    </p>

                                                    <p>
                                                        CC : {{ $mail->cc[0] ?? '' }}
                                                    </p>

                                                    <p>
                                                        BCC : {{ $mail->bcc[0] ?? '' }}
                                                    </p>

                                                    <p>
                                                        Date: {{ optional($mail->created_at)->format('Y-m-d H:i:s') ?? '' }}
                                                    </p>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="email-timestamp">
                                    <div class="timestamp-text">
                                        <time class="time">{{ optional($mail->created_at)->format('h:i A') ?? '' }}</time>
                                        <span
                                            class="time-ago">({{ optional($mail->created_at)->diffForHumans() ?? '' }})</span>
                                    </div>
                                    <button class="text-muted border-0 bg-transparent p-0"
                                        onclick="favouriteMail({{ $mail->id }})"
                                        id="favourite-button-{{ $mail->id }}">

                                        <!-- SVG Icon for Favourite Button -->
                                        <svg width="22" height="22" viewBox="0 0 22 22"
                                            xmlns="http://www.w3.org/2000/svg" id="favourite-icon-{{ $mail->id }}"
                                            @if ($mail->is_favourite) fill="yellow"
                                                stroke="yellow"
                                            @else
                                                fill="none"
                                                stroke="black"
                                                stroke-opacity="0.37" @endif>
                                            <path
                                                d="M12.8848 8.20312L13.0615 8.61914L13.5117 8.6582L18.3301 9.06641L14.6699 12.2383L14.3281 12.5352L14.4307 12.9756L15.5303 17.6885L11.3877 15.1885L11 14.9541L10.6123 15.1885L6.46875 17.6885L7.56836 12.9756L7.6709 12.5352L7.3291 12.2383L3.66797 9.06641L8.4873 8.6582L8.9375 8.61914L9.11426 8.20312L10.999 3.75488L12.8848 8.20312Z" />
                                        </svg>

                                    </button>


                                    <a href="">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_180_5436)">
                                                <path
                                                    d="M9.16667 8.24967V4.58301L2.75 10.9997L9.16667 17.4163V13.658C13.75 13.658 16.9583 15.1247 19.25 18.333C18.3333 13.7497 15.5833 9.16634 9.16667 8.24967Z"
                                                    fill="black" fill-opacity="0.37" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_180_5436">
                                                    <rect width="22" height="22" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </a>

                                    <a href="">
                                        <svg width="22" height="32" viewBox="0 0 22 32" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.0002 12.6663C11.9168 12.6663 12.6668 11.9163 12.6668 10.9997C12.6668 10.083 11.9168 9.33301 11.0002 9.33301C10.0835 9.33301 9.3335 10.083 9.3335 10.9997C9.3335 11.9163 10.0835 12.6663 11.0002 12.6663ZM11.0002 14.333C10.0835 14.333 9.3335 15.083 9.3335 15.9997C9.3335 16.9163 10.0835 17.6663 11.0002 17.6663C11.9168 17.6663 12.6668 16.9163 12.6668 15.9997C12.6668 15.083 11.9168 14.333 11.0002 14.333ZM11.0002 19.333C10.0835 19.333 9.3335 20.083 9.3335 20.9997C9.3335 21.9163 10.0835 22.6663 11.0002 22.6663C11.9168 22.6663 12.6668 21.9163 12.6668 20.9997C12.6668 20.083 11.9168 19.333 11.0002 19.333Z"
                                                fill="#767676" />
                                        </svg>
                                    </a>


                                </div>
                            </section>

                            <section class="email-content">
                                <input type="hidden" id="parent_id" value="{{ $mail->id ?? '' }}">
                                <p class="email-body">
                                    {!! $mail->body ?? 'Email Body' !!}
                                </p>

                               
                                   @php
    $attachment = $mail->attachments[0] ?? null;
@endphp

@if ($attachment)
    <a href="{{ asset('uploads/leads/email_attachments/' . $attachment) }}" target="_blank">
        {{ $attachment }}
    </a>
@endif

                            </section>


                        </div>

                    </div>
                </main>

            </div>
        </div>
    </div>



    <script>
        function favouriteMail(id) {
            $.ajax({
                url: "/toggle-favourite/" + id,
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    mail_id: id
                },
                success: function(response) {
                    console.log("AJAX success:", response);

                    let icon = document.getElementById("favourite-icon-" + id);

                    if (response.favourited) {
                        // If favourited → make star yellow
                        icon.setAttribute("fill", "yellow");
                        icon.setAttribute("stroke", "yellow");
                        icon.removeAttribute("stroke-opacity");
                    } else {
                        // If not favourited → reset to normal
                        icon.setAttribute("fill", "none");
                        icon.setAttribute("stroke", "black");
                        icon.setAttribute("stroke-opacity", "0.37");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX error:", error);
                    console.log("Data sent:", {
                        _token: "{{ csrf_token() }}",
                        mail_id: id
                    });
                }
            });

        }

        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))





        // Initialize the popover manually
        var popoverTrigger = new bootstrap.Popover(document.getElementById('popoverLink'), {
            html: true, // Allow HTML content in the popover
            content: function() {
                // Dynamically load content from the #popover-content div
                return document.getElementById('popover-content').innerHTML;
            }
        });
    </script>


    {{-- <script>
        $(document).on('click', '.reply-button', function() {
            let parent_id = document.getElementById('parent_id').value;
            let container = $("#reply-card");

           
            if (container.find('.reply-form').length === 0) {
                let replyCard = `
            <div class="card reply-card mt-3">
                <div class="card-body">
                    <form class="reply-form" action="/emails/reply/${parent_id}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control summernoteNormal" name="body"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Attachments</label>
                            <input class="form-control" type="file" name="attchments[]" multiple>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn save-btn">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        `;
                container.append(replyCard);

                // Init summernote
                container.find('.summernoteNormal').summernote({
                    tabsize: 2,
                    height: 200
                });
            }
        });

        // Handle reply submit
        $(document).on('submit', '.reply-form', function(e) {
            e.preventDefault();

            let form = $(this);
            let formData = new FormData(this);

            $.ajax({
                url: form.attr('action'),
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    // remove form
                    form.closest('.reply-card').remove();

                    // append reply to bottom of #reply-card
                    $("#reply-card").append(`
                            <div class="card mt-3 bg-light">
                                <div class="card-body">
                                    <p class="m-2"><strong>You replied:</strong></p>
                                    <div class="p-2 border rounded">${formData.get('body')}</div>
                                </div>
                            </div>
                        `);
                },
                error: function(err) {
                    alert("Something went wrong. Try again!");
                }
            });
        });
    </script> --}}
@endsection
