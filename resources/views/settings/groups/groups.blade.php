@extends('master')

@section('content')


<!-- Scrollable Content -->
<div class="main-scrollable">
    <div class="page-container">
        <div class="page-title-container">
            <div class="d-flex justify-content-between">
                <h3 class="page-title">
                    Groups
                </h3>
                <div class="d-flex gap-3">


                    <a href="{{url('create-group')}}">
                        <button class="import-leads-button">
                            <div class="icon-container">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.625 9.375H4.5V8.625H8.625V4.5H9.375V8.625H13.5V9.375H9.375V13.5H8.625V9.375Z" fill="white" />
                                </svg>


                            </div>

                            <span class="button-text">Group</span>


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
                                <h3 class="card-title">Groups</h3>
                            </div>
                            <div>


                                <button class="btn white-btn">
                                    <svg width="18" height="18" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.33333 2.25H11.6667C11.8214 2.25 11.9697 2.31146 12.0791 2.42085C12.1885 2.53025 12.25 2.67862 12.25 2.83333V3.7585C12.25 3.9132 12.1885 4.06155 12.0791 4.17092L8.33758 7.91242C8.22818 8.02179 8.1667 8.17014 8.16667 8.32483V12.0027C8.16666 12.0914 8.14645 12.1789 8.10755 12.2586C8.06866 12.3383 8.01211 12.4081 7.94221 12.4626C7.8723 12.5172 7.79088 12.5551 7.70414 12.5734C7.61739 12.5918 7.5276 12.5901 7.44158 12.5686L6.27492 12.2769C6.14877 12.2453 6.03681 12.1725 5.9568 12.07C5.87679 11.9674 5.83334 11.8411 5.83333 11.7111V8.32483C5.8333 8.17014 5.77182 8.02179 5.66242 7.91242L1.92092 4.17092C1.81151 4.06155 1.75003 3.9132 1.75 3.7585V2.83333C1.75 2.67862 1.81146 2.53025 1.92085 2.42085C2.03025 2.31146 2.17862 2.25 2.33333 2.25Z" stroke="#172635" stroke-width="0.875" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    Filter

                                </button>
                            </div>



                        </div>
                        <div class="row g-4">
                            <div class="table-responsive">
                                <table class="table new-table">

                                    <thead>
                                        <tr>
                                            <th class="corner-left"><input type="checkbox"></th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Created Date</th>
                                            <th class="corner-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 0; $i < 10; $i++): ?>
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td>David Johnson</td>
                                                <td>David Johnson</td>
                                                <td>May 26, 2025</td>
                                                <td>David Johnson</td>

                                                <td class="action-icons d-flex gx-3">
                                                    <div class="text-muted" type="button">
                                                        <svg width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="18" height="18" rx="2.90323" fill="#FFE9E5" />
                                                            <path d="M6.9431 12.7013C6.71689 12.7013 6.52331 12.6208 6.36236 12.4599C6.20141 12.2989 6.12079 12.1052 6.12052 11.8787V6.53197H5.70923V5.70939H7.76568V5.2981H10.2334V5.70939H12.2899V6.53197H11.8786V11.8787C11.8786 12.105 11.7981 12.2987 11.6372 12.4599C11.4762 12.6211 11.2825 12.7016 11.056 12.7013H6.9431ZM11.056 6.53197H6.9431V11.8787H11.056V6.53197ZM7.76568 11.0562H8.58826V7.35455H7.76568V11.0562ZM9.41084 11.0562H10.2334V7.35455H9.41084V11.0562Z" fill="#ED2227" />
                                                        </svg>
                                                    </div>
                                                    <div class="text-muted" type="button">
                                                        <svg width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="18" height="18" rx="2.90323" fill="#E7E9FD" />
                                                            <path d="M6.1206 11.8786H6.70663L10.7266 7.85862L10.1406 7.27258L6.1206 11.2926V11.8786ZM5.70935 12.7011C5.59282 12.7011 5.49522 12.6616 5.41654 12.5826C5.33785 12.5037 5.29837 12.4061 5.2981 12.2898V11.2926C5.2981 11.1829 5.31866 11.0783 5.35978 10.9788C5.40091 10.8792 5.45917 10.7919 5.53456 10.7168L10.7266 5.53505C10.8088 5.45966 10.8997 5.4014 10.9993 5.36027C11.0988 5.31915 11.2032 5.29858 11.3126 5.29858C11.422 5.29858 11.5283 5.31915 11.6313 5.36027C11.7344 5.4014 11.8235 5.46308 11.8987 5.54533L12.4641 6.12108C12.5464 6.19648 12.6063 6.28558 12.6438 6.3884C12.6814 6.49121 12.7003 6.59402 12.7006 6.69683C12.7006 6.8065 12.6817 6.9111 12.6438 7.01062C12.606 7.11014 12.5461 7.20089 12.4641 7.28287L7.28238 12.4646C7.20698 12.54 7.11952 12.5983 7.02 12.6394C6.92048 12.6805 6.81602 12.7011 6.70663 12.7011H5.70935ZM10.4284 7.57074L10.1406 7.27258L10.7266 7.85862L10.4284 7.57074Z" fill="#4A58EC" />
                                                        </svg>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endfor; ?>

                                    </tbody>
                                </table>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection