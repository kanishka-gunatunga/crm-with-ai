@include('layouts.header')
<style>
    .delete-stage{
        font-size:25px;
        color: red;
    }
    .delete-stage-link{
        font-size:25px;
        color: red;
    }
    table tbody tr {
    vertical-align: middle;
}
.message-list li .col-mail-1 .title {
    left: 0px;
}
.offcanvas.offcanvas-end {
    width: 600px;
}
</style>
<div class="main-content">

<div class="page-content">
                <div class="container-fluid">

                    <div class="email-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
                        <div class="email-menu-sidebar minimal-border">
                            <div class="p-4 d-flex flex-column h-100">
                                <div class="pb-4 border-bottom border-bottom-dashed">
                                    <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#composemodal"><i data-feather="plus-circle" class="icon-xs me-1 icon-dual-light"></i> Compose</button>
                                </div>

                                <div class="mx-n4 px-4 email-menu-sidebar-scroll" data-simplebar>
                                <div class="nav nav-pills flex-column nav-pills-tab custom-verti-nav-pills text-center" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active show" id="custom-v-pills-home-tab" data-bs-toggle="pill" href="#custom-v-pills-home" role="tab" aria-controls="custom-v-pills-home" aria-selected="true">
                                        <i class="ri-mail-fill me-3 align-middle fw-medium"></i> Inbox
                                    </a>
                                    <a class="nav-link" id="custom-v-pills-profile-tab" data-bs-toggle="pill" href="#custom-v-pills-profile" role="tab" aria-controls="custom-v-pills-profile" aria-selected="false" tabindex="-1">
                                        <i class="ri-inbox-archive-fill me-3 align-middle fw-medium"></i> Outbox
                                    </a>
                                   
                                </div>
                                </div>
                                
                              
                            </div>
                        </div>
                        <!-- end email-menu-sidebar -->

                        <div class="email-content minimal-border">
                            <div class="p-4 pb-0">
                                

                            <div class="tab-content text-muted mt-3 mt-lg-0">
                                <div class="tab-pane fade active show" id="custom-v-pills-home" role="tabpanel" aria-labelledby="custom-v-pills-home-tab">
                                    <ul class="message-list" id="mail-list">
                                        <li class="">
                                            <div class="col-mail col-mail-1">
                                                <a href="javascript: void(0);" class="title"><span class="title-name">Peter, me</span> </a>
                                            </div> 
                                            <div class="col-mail col-mail-2">
                                                <a href="javascript: void(0);" class="subject"><span class="subject-title">Hello</span> – <span class="teaser">
                                                    Trip home from Colombo has been arranged, then Jenna will come get me from Stockholm. :)</span>
                                                </a>
                                                <div class="date">Mar 7</div>  
                                            </div>    
                                        </li>
                                    </ul>
                                </div>
                                <!--end tab-pane-->
                                <div class="tab-pane fade" id="custom-v-pills-profile" role="tabpanel" aria-labelledby="custom-v-pills-profile-tab">
                                     <ul class="message-list" id="mail-list">
                                     @foreach($sent_emails as $sent_email)
                                        <li class="email-item" 
                                            data-bs-toggle="offcanvas" 
                                            data-bs-target="#offcanvasRight" 
                                            aria-controls="offcanvasRight"
                                            data-email='@json($sent_email)'
                                        >
                                            <div class="col-mail col-mail-1">
                                                <a href="javascript:void(0);" class="title">
                                                    <span class="title-name">{{ $sent_email->subject }}</span>
                                                </a>
                                            </div>
                                            <div class="col-mail col-mail-2">
                                                <a href="javascript:void(0);" class="subject">
                                                    <span class="subject-title">
                                                        {{ \Illuminate\Support\Str::limit(strip_tags($sent_email->body), 150) }}
                                                    </span>
                                                </a>
                                                <div class="date">{{ \Carbon\Carbon::parse($sent_email->created_at)->format('M j, Y') }}</div>
                                            </div>
                                        </li>
                                    @endforeach

                                    </ul>
                                </div>
                               
                            </div>
                            </div>
                        </div>
                        <!-- end email-content -->

                       
                        <!-- end email-detail-content -->
                    </div>
                    <!-- end email wrapper -->

                    
                    <!-- end email chat detail -->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
@include('layouts.footer')

<div class="modal fade" id="composemodal" tabindex="-1" role="dialog" aria-labelledby="composemodalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="composemodalTitle">New Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                    <form  action="{{url('compose-email')}}" method="post" enctype="multipart/form-data" data-parsley-validate>
                        @csrf
                        <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="firstNameinput" class="form-label">{{ __('app.leads.to') }}</label>
                            <input type="text"  data-choices data-choices-limit="Required Limit" data-choices-removeItem class="form-control" name="to[]" required>
                            <button type="button" class="btn btn-primary btn-sm cc-toggle">{{ __('app.leads.cc') }}</button>
                            <button type="button" class="btn btn-primary btn-sm bcc-toggle">{{ __('app.leads.bcc') }}</button>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="firstNameinput" class="form-label">{{ __('app.leads.cc') }}</label>
                            <input type="text"  data-choices data-choices-limit="Required Limit" data-choices-removeItem class="form-control" name="cc[]" >
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="firstNameinput" class="form-label">{{ __('app.leads.bcc') }}</label>
                            <input type="text"  data-choices data-choices-limit="Required Limit" data-choices-removeItem class="form-control" name="bcc[]" >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="firstNameinput" class="form-label">{{ __('app.leads.subject') }}</label>
                            <input type="text" class="form-control" name="subject" value="" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="firstNameinput" class="form-label">{{ __('app.datagrid.attachments') }}</label>
                            <input class="form-control" type="file" id="formFile" name="attchments[]" multiple>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="firstNameinput" class="form-label">{{ __('app.leads.description') }}</label>
                            <textarea class="form-contro w-100 snow-editor" id="body" rows="5" name="body" required></textarea>
                        </div>
                        </div>
                        <button type="submit" class="btn btn-info">{{ __('app.leads.save') }}</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost-danger" data-bs-dismiss="modal">Discard</button>

                   
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->

    <!-- removeItemModal -->
    

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Email Details</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-3 overflow-auto">
        <p><strong>To:</strong> <span id="email-to"></span></p>
        <p><strong>CC:</strong> <span id="email-cc"></span></p>
        <p><strong>BCC:</strong> <span id="email-bcc"></span></p>
        <p><strong>Subject:</strong> <span id="email-subject"></span></p>
        <p><strong>Date:</strong> <span id="email-date"></span></p>
        <div><strong>Body:</strong></div>
        <div id="email-body" class="border p-2 my-2 bg-light"></div>
        <div><strong>Attachments:</strong></div>
        <ul id="email-attachments"></ul>
    </div>
</div>
<script>
    $(document).ready(function() {
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if(Session::has('fail'))
            toastr.error("{{ Session::get('fail') }}");
        @endif
    });
</script>
<script>
    document.querySelectorAll('.email-item').forEach(item => {
    item.addEventListener('click', () => {
        const data = JSON.parse(item.dataset.email);

        const parseList = str => {
            try {
                return JSON.parse(str);
            } catch (e) {
                return [str]; // fallback if it's just a string
            }
        };

        document.getElementById('email-to').textContent = parseList(data.to).join(', ');
        document.getElementById('email-cc').textContent = parseList(data.cc).join(', ');
        document.getElementById('email-bcc').textContent = parseList(data.bcc).join(', ');
        document.getElementById('email-subject').textContent = data.subject;
        document.getElementById('email-date').textContent = new Date(data.created_at).toLocaleString();
        document.getElementById('email-body').innerHTML = data.body;

        // Attachments

        const attachments = parseList(data.attachments);
        const baseUrl = "{{ asset('uploads/leads/email_attachments') }}";

        const attachmentList = document.getElementById('email-attachments');
        attachmentList.innerHTML = '';

        attachments.forEach(file => {
            const li = document.createElement('li');
            li.innerHTML = `<a href="${baseUrl}/${file}" target="_blank">${file}</a>`;
            attachmentList.appendChild(li);
        });
    });
});

</script>

<script>

    $('#body').summernote({
        tabsize: 2,
        height: 200
      });
    document.addEventListener("DOMContentLoaded", function () {


    const ccButton = document.querySelector(".cc-toggle");
    const bccButton = document.querySelector(".bcc-toggle");


    const ccInputDiv = document.querySelector("input[name='cc[]']").closest('.col-md-12');
    const bccInputDiv = document.querySelector("input[name='bcc[]']").closest('.col-md-12');

    ccInputDiv.style.display = "none";
    bccInputDiv.style.display = "none";


    if (ccButton) {
        ccButton.addEventListener("click", function () {
            ccInputDiv.style.display = ccInputDiv.style.display === "none" ? "block" : "none";
        });
    }


    if (bccButton) {
        bccButton.addEventListener("click", function () {
            bccInputDiv.style.display = bccInputDiv.style.display === "none" ? "block" : "none";
        });
    }
});

</script>
<script>
    let toChoices, ccChoices, bccChoices;

    const initChoices = () => {
        if (toChoices) toChoices.destroy();
        if (ccChoices) ccChoices.destroy();
        if (bccChoices) bccChoices.destroy();

        document.querySelectorAll('[data-choices]').forEach((el) => {
            const name = el.getAttribute("name");

            const instance = new Choices(el, {
                removeItemButton: true,
                duplicateItemsAllowed: false,
            });

            if (name === "to[]") toChoices = instance;
            if (name === "cc[]") ccChoices = instance;
            if (name === "bcc[]") bccChoices = instance;
        });
    };

    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('composemodal');
        modal.addEventListener('shown.bs.modal', function () {
            initChoices();
        });
    });
</script>
