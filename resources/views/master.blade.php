<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/src/parsley.min.css">
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/parsleyjs@2.9.2/dist/parsley.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js">
    </script>




</head>

<body>
    <div class="full-height-page container-fluid">

        <!-- Header -->
        <div>
            @include('layouts.header')
        </div>

        <!-- Body: Sidebar + Main -->
        <div class="page-content-wrapper">

            <!-- Sidebar -->
            <div class="sidebar">
                @include('layouts.sidebar')
            </div>

            <!-- Main Content Area -->
            <div class="main-content container">
                @yield('content')
            </div>

        </div>

    </div>
</body>
<script>
    new FroalaEditor("div#froala-editor", {

        toolbarButtons: {
            'moreText':

            {
                'buttons': ['underline', 'emoticons']
            },

            'moreRich': {
                'buttons': ['insertFile', 'insertLink', 'insertImage', ]
            },



        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.nav-link').forEach(function(link) {
            if (link.classList.contains('active')) {
                link.closest('..nav-item').style.backgroundColor = '#E7E9FD'; // or any color
            }
        });
    });
</script>

<script>
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    hamburgerBtn.addEventListener('click', function() {
        sidebar.classList.add('active');
        sidebarOverlay.classList.add('active');
    });

    sidebarOverlay.addEventListener('click', function() {
        sidebar.classList.remove('active');
        sidebarOverlay.classList.remove('active');
    });
</script>

<script>
    $(document).ready(function() {
        $('.myDropdown').select2({
            // placeholder: "Assign User",
            allowClear: true
        });
    });
    document.addEventListener('DOMContentLoaded', function() {

        const tablesToExport = document.querySelectorAll('.data-table-export');
        const exportToggleButtons = document.querySelectorAll('.export-toggle');

        tablesToExport.forEach(function(tableEl) {
            const exportTitle = tableEl.getAttribute('data-export-title') || 'Exported Table';
            const exportFilename = tableEl.getAttribute('data-export-filename') || 'exported_table';

            new DataTable(tableEl, {
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'csv',
                        title: exportTitle,
                        filename: exportFilename
                    },
                    {
                        extend: 'excel',
                        title: exportTitle,
                        filename: exportFilename
                    }
                ]
            });
        });

        exportToggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                let dtButtonsContainer = null;

                dtButtonsContainer = this.nextElementSibling;
                if (dtButtonsContainer && !dtButtonsContainer.classList.contains(
                        'dt-buttons')) {

                    dtButtonsContainer = this.parentNode.querySelector('.dt-buttons');
                }

                if (!dtButtonsContainer || !dtButtonsContainer.classList.contains(
                        'dt-buttons')) {
                    const commonAncestor = this.closest(
                        '.page-container, .main-scrollable, .table-controls-area'
                    ); // Add your relevant parent classes/IDs here
                    if (commonAncestor) {
                        dtButtonsContainer = commonAncestor.querySelector('.dt-buttons');
                    }
                }


                if (dtButtonsContainer && dtButtonsContainer.classList.contains('dt-buttons')) {
                    dtButtonsContainer.classList.toggle(
                        'd-none'); // Use a CSS class to toggle visibility
                } else {
                    console.warn(
                        "Could not find a corresponding '.dt-buttons' container for the clicked export toggle button.",
                        this);
                }
            });
        });
        const allDtButtons = document.querySelectorAll('.dt-buttons');
        allDtButtons.forEach(dtButton => {
            dtButton.classList.add('d-none');
        });
    });
</script>

</html>
