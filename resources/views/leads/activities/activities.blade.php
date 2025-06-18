
@extends('master')

@section('content')
<?php
use App\Models\Lead;
use App\Models\UserDetails;
?>

    <!-- Scrollable Content -->
    <div class="main-scrollable">
                    <div class="page-container">
                        <div class="page-title-container">
                            <div class="d-flex justify-content-between">
                                <h3 class="page-title">
                                    {{ __('app.activities.title') }}
                                </h3>
                                <!-- <div class="d-flex gap-3">





                            <a href="../leads/create-lead.php">
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

                                    <span class="button-text">New Quote</span>


                                </button>
                            </a>
                        </div> -->


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
                                                <h3 class="card-title">All Activities</h3>
                                            </div>
                                            <div class="d-md-flex d-block gap-1">
                                                <div class="nav nav-tabs gap-1 border-0" id="nav-tab" role="tablist">
                                                    <button class="btn white-btn tab-button active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1" aria-selected="true">
                                                        <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M4.50039 3.4998H10.0004M1.90039 3.3998L2.30039 3.7998L3.30039 2.7998M1.90039 6.39981L2.30039 6.79981L3.30039 5.79981M1.90039 9.3998L2.30039 9.79981L3.30039 8.79981M4.50039 6.49981H10.0004M4.50039 9.49981H10.0004" stroke="currentColor" stroke-width="0.603943" stroke-linecap="round" stroke-linejoin="round" fill="black" />
                                                        </svg>
                                                      {{ __('app.datagrid.all') }}
                                                    </button>

                                                    <button class="btn white-btn tab-button " id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab" aria-controls="tab2" aria-selected="false">
                                                        <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M2.33333 11.583H5.05925V6.91634H2.33333V11.583ZM5.64258 11.583H8.35742V3.41634H5.64258V11.583ZM8.94075 11.583H11.6667V8.08301H8.94075V11.583ZM1.75 11.2237V7.27567C1.75 7.01629 1.84236 6.79442 2.02708 6.61009C2.21181 6.42576 2.43347 6.3334 2.69208 6.33301H5.05925V3.77567C5.05925 3.51629 5.15161 3.29442 5.33633 3.11009C5.52106 2.92576 5.74272 2.8334 6.00133 2.83301H7.99867C8.25767 2.83301 8.47933 2.92537 8.66367 3.11009C8.848 3.29481 8.94036 3.51648 8.94075 3.77509V7.49967H11.3079C11.5669 7.49967 11.7886 7.59204 11.9729 7.77676C12.1572 7.96148 12.2496 8.18315 12.25 8.44176V11.2243C12.25 11.4833 12.1576 11.7049 11.9729 11.8893C11.7882 12.0736 11.5665 12.166 11.3079 12.1663H2.69208C2.43308 12.1663 2.21142 12.074 2.02708 11.8893C1.84275 11.7045 1.75039 11.4831 1.75 11.2248" fill="black" />
                                                        </svg>
                                                       {{ __('app.activities.call') }}
                                                    </button>

                                                    <button class="btn white-btn tab-button " id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab" aria-controls="tab3" aria-selected="false">
                                                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9.34375 6.5C9.66698 6.5 9.97698 6.6284 10.2055 6.85696C10.4341 7.08552 10.5625 7.39552 10.5625 7.71875V8.125C10.5625 9.72644 9.05125 11.375 6.5 11.375C3.94875 11.375 2.4375 9.72644 2.4375 8.125V7.71875C2.4375 7.39552 2.5659 7.08552 2.79446 6.85696C3.02302 6.6284 3.33302 6.5 3.65625 6.5H9.34375ZM9.34375 7.3125H3.65625C3.54851 7.3125 3.44517 7.3553 3.36899 7.43149C3.2928 7.50767 3.25 7.61101 3.25 7.71875V8.125C3.25 9.29338 4.4135 10.5625 6.5 10.5625C8.5865 10.5625 9.75 9.29338 9.75 8.125V7.71875C9.75 7.61101 9.7072 7.50767 9.63101 7.43149C9.55483 7.3553 9.45149 7.3125 9.34375 7.3125ZM6.5 1.21875C7.09259 1.21875 7.66092 1.45416 8.07994 1.87318C8.49897 2.29221 8.73438 2.86053 8.73438 3.45312C8.73438 4.04572 8.49897 4.61404 8.07994 5.03307C7.66092 5.45209 7.09259 5.6875 6.5 5.6875C5.90741 5.6875 5.33908 5.45209 4.92006 5.03307C4.50103 4.61404 4.26562 4.04572 4.26562 3.45312C4.26562 2.86053 4.50103 2.29221 4.92006 1.87318C5.33908 1.45416 5.90741 1.21875 6.5 1.21875ZM6.5 2.03125C6.1229 2.03125 5.76124 2.18105 5.49458 2.44771C5.22793 2.71436 5.07812 3.07602 5.07812 3.45312C5.07812 3.83023 5.22793 4.19189 5.49458 4.45854C5.76124 4.7252 6.1229 4.875 6.5 4.875C6.8771 4.875 7.23876 4.7252 7.50542 4.45854C7.77207 4.19189 7.92188 3.83023 7.92188 3.45312C7.92188 3.07602 7.77207 2.71436 7.50542 2.44771C7.23876 2.18105 6.8771 2.03125 6.5 2.03125Z" fill="#172635" />
                                                        </svg>
                                                        {{ __('app.activities.meeting') }}
                                                    </button>

                                                    <button class="btn white-btn tab-button " id="tab4-tab" data-bs-toggle="tab" data-bs-target="#tab4" type="button" role="tab" aria-controls="tab4" aria-selected="false">
                                                        <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6.99973 1.90041C6.47173 1.89832 5.96233 2.0952 5.57297 2.45183C5.18362 2.80847 4.9429 3.29868 4.89876 3.82483C4.85462 4.35098 5.0103 4.87445 5.33479 5.29098C5.65928 5.7075 6.12876 5.9865 6.64973 6.07241V7.15041H4.54973C4.27125 7.15041 4.00418 7.26103 3.80727 7.45794C3.61035 7.65486 3.49973 7.92193 3.49973 8.20041V8.92981C2.98035 9.01757 2.5129 9.29725 2.19 9.71341C1.86711 10.1296 1.71235 10.6519 1.75638 11.1768C1.80042 11.7017 2.04004 12.1909 2.42775 12.5474C2.81547 12.904 3.32299 13.1018 3.84973 13.1018C4.37647 13.1018 4.88399 12.904 5.2717 12.5474C5.65942 12.1909 5.89904 11.7017 5.94307 11.1768C5.98711 10.6519 5.83234 10.1296 5.50945 9.71341C5.18656 9.29725 4.7191 9.01757 4.19973 8.92981V8.20041C4.19973 8.10758 4.2366 8.01856 4.30224 7.95292C4.36788 7.88728 4.4569 7.85041 4.54973 7.85041H9.44973C9.54255 7.85041 9.63158 7.88728 9.69722 7.95292C9.76285 8.01856 9.79973 8.10758 9.79973 8.20041V8.92981C9.28035 9.01757 8.8129 9.29725 8.49 9.71341C8.16711 10.1296 8.01235 10.6519 8.05638 11.1768C8.10042 11.7017 8.34003 12.1909 8.72775 12.5474C9.11547 12.904 9.62299 13.1018 10.1497 13.1018C10.6765 13.1018 11.184 12.904 11.5717 12.5474C11.9594 12.1909 12.199 11.7017 12.2431 11.1768C12.2871 10.6519 12.1323 10.1296 11.8095 9.71341C11.4866 9.29725 11.0191 9.01757 10.4997 8.92981V8.20041C10.4997 7.92193 10.3891 7.65486 10.1922 7.45794C9.99528 7.26103 9.7282 7.15041 9.44973 7.15041H7.34973V6.07241C7.86906 5.9846 8.33645 5.7049 8.6593 5.28875C8.98214 4.8726 9.13688 4.35035 9.09285 3.82549C9.04882 3.30063 8.80923 2.81147 8.42156 2.45492C8.03389 2.09837 7.52643 1.90046 6.99973 1.90041ZM5.59973 4.00041C5.59973 3.6291 5.74723 3.27301 6.00978 3.01046C6.27233 2.74791 6.62842 2.60041 6.99973 2.60041C7.37103 2.60041 7.72713 2.74791 7.98968 3.01046C8.25223 3.27301 8.39973 3.6291 8.39973 4.00041C8.39973 4.37171 8.25223 4.72781 7.98968 4.99036C7.72713 5.25291 7.37103 5.40041 6.99973 5.40041C6.62842 5.40041 6.27233 5.25291 6.00978 4.99036C5.74723 4.72781 5.59973 4.37171 5.59973 4.00041ZM2.44973 11.0004C2.44973 10.629 2.59726 10.2728 2.85988 10.0102C3.1225 9.74759 3.47868 9.60006 3.85008 9.60006C4.22147 9.60006 4.57766 9.74759 4.84027 10.0102C5.10289 10.2728 5.25043 10.629 5.25043 11.0004C5.25043 11.3718 5.10289 11.728 4.84027 11.9906C4.57766 12.2532 4.22147 12.4008 3.85008 12.4008C3.47868 12.4008 3.1225 12.2532 2.85988 11.9906C2.59726 11.728 2.44973 11.3718 2.44973 11.0004ZM10.1497 9.60041C10.3336 9.60041 10.5157 9.63663 10.6856 9.707C10.8555 9.77738 11.0099 9.88053 11.1399 10.0106C11.27 10.1406 11.3731 10.295 11.4435 10.4649C11.5139 10.6348 11.5501 10.8169 11.5501 11.0008C11.5501 11.1847 11.5139 11.3667 11.4435 11.5366C11.3731 11.7065 11.27 11.8609 11.1399 11.991C11.0099 12.121 10.8555 12.2241 10.6856 12.2945C10.5157 12.3649 10.3336 12.4011 10.1497 12.4011C9.77833 12.4011 9.42215 12.2536 9.15953 11.991C8.89691 11.7283 8.74938 11.3722 8.74938 11.0008C8.74938 10.6294 8.89691 10.2732 9.15953 10.0106C9.42215 9.74794 9.77833 9.60041 10.1497 9.60041Z" fill="#172635" />
                                                        </svg>
                                                        {{ __('app.activities.lunch') }}
                                                    </button>

                                                   
                                                </div>
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
                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab" tabindex="0">
                                                    <form id="bulk-delete-form" method="POST" action="{{ url('delete-selected-activities') }}">
                                                    @csrf
                                                    <div class="table-responsive">
                                                        <table class="table new-table data-table-export" data-export-title="Attributes" data-export-filename="Attributes">

                                                            <thead>
                                                                <tr>
                                                                    <th><input type="checkbox" id="select-all"></th>
                                                                    <th>{{ __('app.leads.done') }}</th>
                                                                    <th>{{ __('app.activities.title-control') }}</th>
                                                                    <th>{{ __('app.datagrid.created_by') }}</th>
                                                                    <th>{{ __('app.datagrid.comment') }}</th>
                                                                    <th>{{ __('app.datagrid.lead') }}</th>
                                                                    <th>{{ __('app.datagrid.type') }}</th>
                                                                    <th>{{ __('app.datagrid.schedule_from') }}</th>
                                                                    <th>{{ __('app.datagrid.schedule_to') }}</th>
                                                                    <th>{{ __('app.datagrid.created_at') }}</th>
                                                                    <th>{{ __('app.leads.actions') }}</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                            <?php foreach($activities as $activity){
                                                            $lead = Lead::where('id', $activity->lead_id)->first();
                                                            $owner_name = UserDetails::where('id', $activity->created_by)->value('name');
                                                            ?>
                                                            <tr class="odd gradeX">
                                                                <td><input type="checkbox" name="selected_activities[]" value="{{ $activity->id }}"></td>
                                                                <td class="">
                                                                <input 
                                                                class="form-check-input activity-status" 
                                                                type="checkbox" 
                                                                name="flexCheckDefault{{ $activity->id }}" 
                                                                data-id="{{ $activity->id }}" 
                                                                {{ $activity->is_completed == 1 ? 'checked' : '' }}>
                                                                </td>
                                                                <td class="">{{$activity->title}} </td>
                                                                <td class=""><a href="{{url('users?id='.$activity->created_by)}}">{{$owner_name}}</a></td>
                                                                <td class="">{{$activity->description}}</td>
                                                                <td class=""><a href="{{url('view-lead/'.$activity->lead_id)}}">{{$lead->title}}</a></td>
                                                                <td class="">{{$activity->type}}</td>
                                                                <td class="">{{$activity->from}}</td>
                                                                <td class="">{{$activity->to}}</td>
                                                                <td class="">{{$activity->created_at}}</td>
                                             
                                                                 <td class="action-icons d-flex gx-3">
                                                                    <a href="{{ url('delete-activity/'.$activity->id) }}" class="delete-link-confirm">
                                                                        <div class="text-muted" type="button">
                                                                            <svg width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <rect width="18" height="18" rx="2.90323" fill="#FFE9E5" />
                                                                                <path d="M6.9431 12.7013C6.71689 12.7013 6.52331 12.6208 6.36236 12.4599C6.20141 12.2989 6.12079 12.1052 6.12052 11.8787V6.53197H5.70923V5.70939H7.76568V5.2981H10.2334V5.70939H12.2899V6.53197H11.8786V11.8787C11.8786 12.105 11.7981 12.2987 11.6372 12.4599C11.4762 12.6211 11.2825 12.7016 11.056 12.7013H6.9431ZM11.056 6.53197H6.9431V11.8787H11.056V6.53197ZM7.76568 11.0562H8.58826V7.35455H7.76568V11.0562ZM9.41084 11.0562H10.2334V7.35455H9.41084V11.0562Z" fill="#ED2227" />
                                                                            </svg>
                                                                        </div>
                                                                    </a>
                                                                    <a href="{{ url('edit-activity/'.$activity->id) }}">
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

                                                <div class="tab-pane fade show " id="tab2" role="tabpanel" aria-labelledby="tab2-tab" tabindex="0">
                                                    <form id="bulk-delete-form" method="POST" action="{{ url('delete-selected-activities') }}">
                                                    @csrf
                                                    <div class="table-responsive">
                                                        <table class="table new-table data-table-export" data-export-title="Attributes" data-export-filename="Attributes">

                                                            <thead>
                                                                <tr>
                                                                    <th><input type="checkbox" id="select-all"></th>
                                                                    <th>{{ __('app.leads.done') }}</th>
                                                                    <th>{{ __('app.activities.title-control') }}</th>
                                                                    <th>{{ __('app.datagrid.created_by') }}</th>
                                                                    <th>{{ __('app.datagrid.comment') }}</th>
                                                                    <th>{{ __('app.datagrid.lead') }}</th>
                                                                    <th>{{ __('app.datagrid.type') }}</th>
                                                                    <th>{{ __('app.datagrid.schedule_from') }}</th>
                                                                    <th>{{ __('app.datagrid.schedule_to') }}</th>
                                                                    <th>{{ __('app.datagrid.created_at') }}</th>
                                                                    <th>{{ __('app.leads.actions') }}</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                            <?php foreach($activities as $activity){
                                                            if($activity->type == 'Call'){
                                                            $lead = Lead::where('id', $activity->lead_id)->first();
                                                            $owner_name = UserDetails::where('id', $activity->created_by)->value('name');
                                                            ?>
                                                            <tr class="odd gradeX">
                                                                <td><input type="checkbox" name="selected_activities[]" value="{{ $activity->id }}"></td>
                                                                <td class="">
                                                                <input 
                                                                class="form-check-input activity-status" 
                                                                type="checkbox" 
                                                                name="flexCheckDefault{{ $activity->id }}" 
                                                                data-id="{{ $activity->id }}" 
                                                                {{ $activity->is_completed == 1 ? 'checked' : '' }}>
                                                                </td>
                                                                <td class="">{{$activity->title}} </td>
                                                                <td class=""><a href="{{url('users?id='.$activity->created_by)}}">{{$owner_name}}</a></td>
                                                                <td class="">{{$activity->description}}</td>
                                                                <td class=""><a href="{{url('view-lead/'.$activity->lead_id)}}">{{$lead->title}}</a></td>
                                                                <td class="">{{$activity->type}}</td>
                                                                <td class="">{{$activity->from}}</td>
                                                                <td class="">{{$activity->to}}</td>
                                                                <td class="">{{$activity->created_at}}</td>
                                                                <td class="action-icons d-flex gx-3">
                                                                    <a href="{{ url('delete-activity/'.$activity->id) }}" class="delete-link-confirm">
                                                                        <div class="text-muted" type="button">
                                                                            <svg width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <rect width="18" height="18" rx="2.90323" fill="#FFE9E5" />
                                                                                <path d="M6.9431 12.7013C6.71689 12.7013 6.52331 12.6208 6.36236 12.4599C6.20141 12.2989 6.12079 12.1052 6.12052 11.8787V6.53197H5.70923V5.70939H7.76568V5.2981H10.2334V5.70939H12.2899V6.53197H11.8786V11.8787C11.8786 12.105 11.7981 12.2987 11.6372 12.4599C11.4762 12.6211 11.2825 12.7016 11.056 12.7013H6.9431ZM11.056 6.53197H6.9431V11.8787H11.056V6.53197ZM7.76568 11.0562H8.58826V7.35455H7.76568V11.0562ZM9.41084 11.0562H10.2334V7.35455H9.41084V11.0562Z" fill="#ED2227" />
                                                                            </svg>
                                                                        </div>
                                                                    </a>
                                                                    <a href="{{ url('edit-activity/'.$activity->id) }}">
                                                                        <div class="text-muted" type="button">
                                                                            <svg width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <rect width="18" height="18" rx="2.90323" fill="#E7E9FD" />
                                                                                <path d="M6.1206 11.8786H6.70663L10.7266 7.85862L10.1406 7.27258L6.1206 11.2926V11.8786ZM5.70935 12.7011C5.59282 12.7011 5.49522 12.6616 5.41654 12.5826C5.33785 12.5037 5.29837 12.4061 5.2981 12.2898V11.2926C5.2981 11.1829 5.31866 11.0783 5.35978 10.9788C5.40091 10.8792 5.45917 10.7919 5.53456 10.7168L10.7266 5.53505C10.8088 5.45966 10.8997 5.4014 10.9993 5.36027C11.0988 5.31915 11.2032 5.29858 11.3126 5.29858C11.422 5.29858 11.5283 5.31915 11.6313 5.36027C11.7344 5.4014 11.8235 5.46308 11.8987 5.54533L12.4641 6.12108C12.5464 6.19648 12.6063 6.28558 12.6438 6.3884C12.6814 6.49121 12.7003 6.59402 12.7006 6.69683C12.7006 6.8065 12.6817 6.9111 12.6438 7.01062C12.606 7.11014 12.5461 7.20089 12.4641 7.28287L7.28238 12.4646C7.20698 12.54 7.11952 12.5983 7.02 12.6394C6.92048 12.6805 6.81602 12.7011 6.70663 12.7011H5.70935ZM10.4284 7.57074L10.1406 7.27258L10.7266 7.85862L10.4284 7.57074Z" fill="#4A58EC" />
                                                                            </svg>
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php }} ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <button type="submit" class="btn btn-danger btn-sm mb-2 delete-form-confirm" >Delete Selected</button>
                                                    </form>
                                                </div>

                                                <div class="tab-pane fade show " id="tab3" role="tabpanel" aria-labelledby="tab3-tab" tabindex="0">
                                                    <form id="bulk-delete-form" method="POST" action="{{ url('delete-selected-activities') }}">
                                                    @csrf
                                                    <div class="table-responsive">
                                                        <table class="table new-table data-table-export" data-export-title="Attributes" data-export-filename="Attributes">

                                                            <thead>
                                                                <tr>
                                                                    <th><input type="checkbox" id="select-all"></th>
                                                                    <th>{{ __('app.leads.done') }}</th>
                                                                    <th>{{ __('app.activities.title-control') }}</th>
                                                                    <th>{{ __('app.datagrid.created_by') }}</th>
                                                                    <th>{{ __('app.datagrid.comment') }}</th>
                                                                    <th>{{ __('app.datagrid.lead') }}</th>
                                                                    <th>{{ __('app.datagrid.type') }}</th>
                                                                    <th>{{ __('app.datagrid.schedule_from') }}</th>
                                                                    <th>{{ __('app.datagrid.schedule_to') }}</th>
                                                                    <th>{{ __('app.datagrid.created_at') }}</th>
                                                                    <th>{{ __('app.leads.actions') }}</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                            <?php foreach($activities as $activity){
                                                            if($activity->type == 'Meeting'){
                                                            $lead = Lead::where('id', $activity->lead_id)->first();
                                                            $owner_name = UserDetails::where('id', $activity->created_by)->value('name');
                                                            ?>
                                                            <tr class="odd gradeX">
                                                                <td><input type="checkbox" name="selected_activities[]" value="{{ $activity->id }}"></td>
                                                                <td class="">
                                                                <input 
                                                                class="form-check-input activity-status" 
                                                                type="checkbox" 
                                                                name="flexCheckDefault{{ $activity->id }}" 
                                                                data-id="{{ $activity->id }}" 
                                                                {{ $activity->is_completed == 1 ? 'checked' : '' }}>
                                                                </td>
                                                                <td class="">{{$activity->title}} </td>
                                                                <td class=""><a href="{{url('users?id='.$activity->created_by)}}">{{$owner_name}}</a></td>
                                                                <td class="">{{$activity->description}}</td>
                                                                <td class=""><a href="{{url('view-lead/'.$activity->lead_id)}}">{{$lead->title}}</a></td>
                                                                <td class="">{{$activity->type}}</td>
                                                                <td class="">{{$activity->from}}</td>
                                                                <td class="">{{$activity->to}}</td>
                                                                <td class="">{{$activity->created_at}}</td>
                                                                 <td class="action-icons d-flex gx-3">
                                                                    <a href="{{ url('delete-activity/'.$activity->id) }}" class="delete-link-confirm">
                                                                        <div class="text-muted" type="button">
                                                                            <svg width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <rect width="18" height="18" rx="2.90323" fill="#FFE9E5" />
                                                                                <path d="M6.9431 12.7013C6.71689 12.7013 6.52331 12.6208 6.36236 12.4599C6.20141 12.2989 6.12079 12.1052 6.12052 11.8787V6.53197H5.70923V5.70939H7.76568V5.2981H10.2334V5.70939H12.2899V6.53197H11.8786V11.8787C11.8786 12.105 11.7981 12.2987 11.6372 12.4599C11.4762 12.6211 11.2825 12.7016 11.056 12.7013H6.9431ZM11.056 6.53197H6.9431V11.8787H11.056V6.53197ZM7.76568 11.0562H8.58826V7.35455H7.76568V11.0562ZM9.41084 11.0562H10.2334V7.35455H9.41084V11.0562Z" fill="#ED2227" />
                                                                            </svg>
                                                                        </div>
                                                                    </a>
                                                                    <a href="{{ url('edit-activity/'.$activity->id) }}">
                                                                        <div class="text-muted" type="button">
                                                                            <svg width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <rect width="18" height="18" rx="2.90323" fill="#E7E9FD" />
                                                                                <path d="M6.1206 11.8786H6.70663L10.7266 7.85862L10.1406 7.27258L6.1206 11.2926V11.8786ZM5.70935 12.7011C5.59282 12.7011 5.49522 12.6616 5.41654 12.5826C5.33785 12.5037 5.29837 12.4061 5.2981 12.2898V11.2926C5.2981 11.1829 5.31866 11.0783 5.35978 10.9788C5.40091 10.8792 5.45917 10.7919 5.53456 10.7168L10.7266 5.53505C10.8088 5.45966 10.8997 5.4014 10.9993 5.36027C11.0988 5.31915 11.2032 5.29858 11.3126 5.29858C11.422 5.29858 11.5283 5.31915 11.6313 5.36027C11.7344 5.4014 11.8235 5.46308 11.8987 5.54533L12.4641 6.12108C12.5464 6.19648 12.6063 6.28558 12.6438 6.3884C12.6814 6.49121 12.7003 6.59402 12.7006 6.69683C12.7006 6.8065 12.6817 6.9111 12.6438 7.01062C12.606 7.11014 12.5461 7.20089 12.4641 7.28287L7.28238 12.4646C7.20698 12.54 7.11952 12.5983 7.02 12.6394C6.92048 12.6805 6.81602 12.7011 6.70663 12.7011H5.70935ZM10.4284 7.57074L10.1406 7.27258L10.7266 7.85862L10.4284 7.57074Z" fill="#4A58EC" />
                                                                            </svg>
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php }} ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <button type="submit" class="btn btn-danger btn-sm mb-2 delete-form-confirm" >Delete Selected</button>
                                                    </form>
                                                </div>


                                                <div class="tab-pane fade show " id="tab4" role="tabpanel" aria-labelledby="tab4-tab" tabindex="0">
                                                    <form id="bulk-delete-form" method="POST" action="{{ url('delete-selected-activities') }}">
                                                    @csrf
                                                    <div class="table-responsive">
                                                        <table class="table new-table data-table-export" data-export-title="Attributes" data-export-filename="Attributes">

                                                            <thead>
                                                                <tr>
                                                                    <th><input type="checkbox" id="select-all"></th>
                                                                    <th>{{ __('app.leads.done') }}</th>
                                                                    <th>{{ __('app.activities.title-control') }}</th>
                                                                    <th>{{ __('app.datagrid.created_by') }}</th>
                                                                    <th>{{ __('app.datagrid.comment') }}</th>
                                                                    <th>{{ __('app.datagrid.lead') }}</th>
                                                                    <th>{{ __('app.datagrid.type') }}</th>
                                                                    <th>{{ __('app.datagrid.schedule_from') }}</th>
                                                                    <th>{{ __('app.datagrid.schedule_to') }}</th>
                                                                    <th>{{ __('app.datagrid.created_at') }}</th>
                                                                    <th>{{ __('app.leads.actions') }}</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                            <?php foreach($activities as $activity){
                                                            if($activity->type == 'Lunch'){
                                                            $lead = Lead::where('id', $activity->lead_id)->first();
                                                            $owner_name = UserDetails::where('id', $activity->created_by)->value('name');
                                                            ?>
                                                            <tr class="odd gradeX">
                                                                <td><input type="checkbox" name="selected_activities[]" value="{{ $activity->id }}"></td>
                                                                <td class="">
                                                                <input 
                                                                class="form-check-input activity-status" 
                                                                type="checkbox" 
                                                                name="flexCheckDefault{{ $activity->id }}" 
                                                                data-id="{{ $activity->id }}" 
                                                                {{ $activity->is_completed == 1 ? 'checked' : '' }}>
                                                                </td>
                                                                <td class="">{{$activity->title}} </td>
                                                                <td class=""><a href="{{url('users?id='.$activity->created_by)}}">{{$owner_name}}</a></td>
                                                                <td class="">{{$activity->description}}</td>
                                                                <td class=""><a href="{{url('view-lead/'.$activity->lead_id)}}">{{$lead->title}}</a></td>
                                                                <td class="">{{$activity->type}}</td>
                                                                <td class="">{{$activity->from}}</td>
                                                                <td class="">{{$activity->to}}</td>
                                                                <td class="">{{$activity->created_at}}</td>
                                                                 <td class="action-icons d-flex gx-3">
                                                                    <a href="{{ url('delete-activity/'.$activity->id) }}" class="delete-link-confirm">
                                                                        <div class="text-muted" type="button">
                                                                            <svg width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <rect width="18" height="18" rx="2.90323" fill="#FFE9E5" />
                                                                                <path d="M6.9431 12.7013C6.71689 12.7013 6.52331 12.6208 6.36236 12.4599C6.20141 12.2989 6.12079 12.1052 6.12052 11.8787V6.53197H5.70923V5.70939H7.76568V5.2981H10.2334V5.70939H12.2899V6.53197H11.8786V11.8787C11.8786 12.105 11.7981 12.2987 11.6372 12.4599C11.4762 12.6211 11.2825 12.7016 11.056 12.7013H6.9431ZM11.056 6.53197H6.9431V11.8787H11.056V6.53197ZM7.76568 11.0562H8.58826V7.35455H7.76568V11.0562ZM9.41084 11.0562H10.2334V7.35455H9.41084V11.0562Z" fill="#ED2227" />
                                                                            </svg>
                                                                        </div>
                                                                    </a>
                                                                    <a href="{{ url('edit-activity/'.$activity->id) }}">
                                                                        <div class="text-muted" type="button">
                                                                            <svg width="20" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <rect width="18" height="18" rx="2.90323" fill="#E7E9FD" />
                                                                                <path d="M6.1206 11.8786H6.70663L10.7266 7.85862L10.1406 7.27258L6.1206 11.2926V11.8786ZM5.70935 12.7011C5.59282 12.7011 5.49522 12.6616 5.41654 12.5826C5.33785 12.5037 5.29837 12.4061 5.2981 12.2898V11.2926C5.2981 11.1829 5.31866 11.0783 5.35978 10.9788C5.40091 10.8792 5.45917 10.7919 5.53456 10.7168L10.7266 5.53505C10.8088 5.45966 10.8997 5.4014 10.9993 5.36027C11.0988 5.31915 11.2032 5.29858 11.3126 5.29858C11.422 5.29858 11.5283 5.31915 11.6313 5.36027C11.7344 5.4014 11.8235 5.46308 11.8987 5.54533L12.4641 6.12108C12.5464 6.19648 12.6063 6.28558 12.6438 6.3884C12.6814 6.49121 12.7003 6.59402 12.7006 6.69683C12.7006 6.8065 12.6817 6.9111 12.6438 7.01062C12.606 7.11014 12.5461 7.20089 12.4641 7.28287L7.28238 12.4646C7.20698 12.54 7.11952 12.5983 7.02 12.6394C6.92048 12.6805 6.81602 12.7011 6.70663 12.7011H5.70935ZM10.4284 7.57074L10.1406 7.27258L10.7266 7.85862L10.4284 7.57074Z" fill="#4A58EC" />
                                                                            </svg>
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php }} ?>
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
                    </div>
                </div>

    <!-- Bottom Action Buttons -->
    <!--   <div class="col-12 action-bar">
                    <div class="d-flex gap-2 justify-content-between">
                        <div>
                            <button type="submit" class="btn clear-all-btn">Clear All</button>
                        </div>
                        <div>
                            <button type="submit" class="btn save-btn">Save</button>
                           <button type="button" class="btn cancel-btn">Cancel</button>
                        </div>

                    </div>

                </div> -->


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
</script>

<script>
    document.getElementById('select-all').addEventListener('click', function(event) {
        let checkboxes = document.querySelectorAll('input[name="selected_activities[]"]');
        checkboxes.forEach(cb => cb.checked = event.target.checked);
    });

    $(document).ready(function() {

    $(document).on('change', '.activity-status', function() {
        var status = $(this).is(':checked') ? 1 : 0; 
        var activityId = $(this).data('id'); 

        $.ajax({
            url: "{{ url('update-activity-status') }}",  
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                activity_id: activityId,
                status: status
            },
            success: function(response) {
                if (response.success) {
                    toastr.success("Status updated successfully.");
                } else {
                    toastr.error("Failed to update status.");
                }
            },
            error: function() {
                toastr.error("An error occurred while updating the status.");
            }
        });
    });
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
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ request('title') }}">
        </div>
        <div class="col-md-12 mb-3">
            <label for="is_done" class="form-label">Is Done</label>
            <select class="form-control" name="is_done">
                <option value="">Select</option>
                <option value="1" {{ request('is_done') == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ request('is_done') == 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="col-md-12 mb-3">
            <label for="created_by" class="form-label">Created By</label>
            <select class="form-control" name="created_by">
                <option value="">Select</option>
                @foreach($owners as $owner)
                    <option value="{{ $owner->user_id }}" {{ request('created_by') == $owner->user_id ? 'selected' : '' }}>
                        {{ $owner->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12 mb-3">
            <label for="lead" class="form-label">Lead</label>
            <select class="form-control" name="lead">
                <option value="">Select</option>
                @foreach($leads as $lead)
                    <option value="{{ $lead->id }}" {{ request('lead') == $lead->id ? 'selected' : '' }}>
                        {{ $lead->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label for="shedule_start_date" class="form-label">Schedule Start</label>
            <input type="date" class="form-control" name="shedule_start_date" value="{{ request('shedule_start_date') }}">
        </div>

        <div class="col-md-6 mb-3">
            <label for="shedule_end_date" class="form-label">Schedule End</label>
            <input type="date" class="form-control" name="shedule_end_date" value="{{ request('shedule_end_date') }}">
        </div>

        <div class="col-md-6 mb-3">
            <label for="created_start_date" class="form-label">Create Start</label>
            <input type="date" class="form-control" name="created_start_date" value="{{ request('created_start_date') }}">
        </div>

        <div class="col-md-6 mb-3">
            <label for="created_end_date" class="form-label">Create End</label>
            <input type="date" class="form-control" name="created_end_date" value="{{ request('created_end_date') }}">
        </div>
    </div>

    <button type="submit" class="btn btn-info">Apply Filter</button>
    <a href="{{ url('activities') }}" class="btn btn-danger">Clear</a>
</form>


    </div>
   
</div>
@endsection



