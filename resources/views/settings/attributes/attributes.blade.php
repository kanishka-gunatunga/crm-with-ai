@extends('master')

<?php
    $permissions = session('user_permissions');
?>

@section('content')
    <!-- Scrollable Content -->
    <div class="main-scrollable">
        <div class="page-container">
            <div class="page-title-container">
                <div class="d-flex justify-content-between">
                    <h3 class="page-title">
                        {{ __('app.settings.attributes.title') }}
                    </h3>
                    <div class="d-flex gap-3">


                        <a href="{{ url('create-attribute') }}">
                            <button class="create-btn">
                                <div class="icon-container">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.625 9.375H4.5V8.625H8.625V4.5H9.375V8.625H13.5V9.375H9.375V13.5H8.625V9.375Z"
                                            fill="white" />
                                    </svg>


                                </div>

                                <span class="button-text">{{ __('app.settings.attributes.create-title') }}</span>


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
                                    <h3 class="card-title">{{ __('app.settings.attributes.title') }}</h3>
                                </div>
                                <div class="d-md-flex d-block gap-1">
                                    <div class="nav nav-tabs gap-1 border-0" id="nav-tab" role="tablist">

                                        @if (in_array(strtolower('show-attributes-all'), array_map('strtolower', $permissions)))
                                            <button class="btn white-btn tab-button active" id="nav-all-tab"
                                                data-bs-toggle="tab" data-bs-target="#nav-all" type="button" role="tab"
                                                aria-controls="nav-all" aria-selected="true">
                                                <svg width="12" height="13" viewBox="0 0 12 13" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M4.50039 3.4998H10.0004M1.90039 3.3998L2.30039 3.7998L3.30039 2.7998M1.90039 6.39981L2.30039 6.79981L3.30039 5.79981M1.90039 9.3998L2.30039 9.79981L3.30039 8.79981M4.50039 6.49981H10.0004M4.50039 9.49981H10.0004"
                                                        stroke="currentColor" stroke-width="0.603943" stroke-linecap="round"
                                                        stroke-linejoin="round" fill="black" />
                                                </svg>


                                                {{ __('app.datagrid.all') }}
                                            </button>
                                        @endif



                                        @if (in_array(strtolower('show-attributes-leads'), array_map('strtolower', $permissions)))
                                            <button class="btn white-btn tab-button " id="nav-leads-tab"
                                                data-bs-toggle="tab" data-bs-target="#nav-leads" type="button"
                                                role="tab" aria-controls="nav-leads" aria-selected="false">
                                                <svg width="14" height="15" viewBox="0 0 14 15" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2.33333 11.583H5.05925V6.91634H2.33333V11.583ZM5.64258 11.583H8.35742V3.41634H5.64258V11.583ZM8.94075 11.583H11.6667V8.08301H8.94075V11.583ZM1.75 11.2237V7.27567C1.75 7.01629 1.84236 6.79442 2.02708 6.61009C2.21181 6.42576 2.43347 6.3334 2.69208 6.33301H5.05925V3.77567C5.05925 3.51629 5.15161 3.29442 5.33633 3.11009C5.52106 2.92576 5.74272 2.8334 6.00133 2.83301H7.99867C8.25767 2.83301 8.47933 2.92537 8.66367 3.11009C8.848 3.29481 8.94036 3.51648 8.94075 3.77509V7.49967H11.3079C11.5669 7.49967 11.7886 7.59204 11.9729 7.77676C12.1572 7.96148 12.2496 8.18315 12.25 8.44176V11.2243C12.25 11.4833 12.1576 11.7049 11.9729 11.8893C11.7882 12.0736 11.5665 12.166 11.3079 12.1663H2.69208C2.43308 12.1663 2.21142 12.074 2.02708 11.8893C1.84275 11.7045 1.75039 11.4831 1.75 11.2248"
                                                        fill="black" />
                                                </svg>


                                                {{ __('app.layouts.leads') }}
                                            </button>
                                        @endif

                                        @if (in_array(strtolower('show-attributes-persons'), array_map('strtolower', $permissions)))
                                            <button class="btn white-btn tab-button " id="nav-persons-tab"
                                                data-bs-toggle="tab" data-bs-target="#nav-persons" type="button"
                                                role="tab" aria-controls="nav-persons" aria-selected="false">
                                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M9.34375 6.5C9.66698 6.5 9.97698 6.6284 10.2055 6.85696C10.4341 7.08552 10.5625 7.39552 10.5625 7.71875V8.125C10.5625 9.72644 9.05125 11.375 6.5 11.375C3.94875 11.375 2.4375 9.72644 2.4375 8.125V7.71875C2.4375 7.39552 2.5659 7.08552 2.79446 6.85696C3.02302 6.6284 3.33302 6.5 3.65625 6.5H9.34375ZM9.34375 7.3125H3.65625C3.54851 7.3125 3.44517 7.3553 3.36899 7.43149C3.2928 7.50767 3.25 7.61101 3.25 7.71875V8.125C3.25 9.29338 4.4135 10.5625 6.5 10.5625C8.5865 10.5625 9.75 9.29338 9.75 8.125V7.71875C9.75 7.61101 9.7072 7.50767 9.63101 7.43149C9.55483 7.3553 9.45149 7.3125 9.34375 7.3125ZM6.5 1.21875C7.09259 1.21875 7.66092 1.45416 8.07994 1.87318C8.49897 2.29221 8.73438 2.86053 8.73438 3.45312C8.73438 4.04572 8.49897 4.61404 8.07994 5.03307C7.66092 5.45209 7.09259 5.6875 6.5 5.6875C5.90741 5.6875 5.33908 5.45209 4.92006 5.03307C4.50103 4.61404 4.26562 4.04572 4.26562 3.45312C4.26562 2.86053 4.50103 2.29221 4.92006 1.87318C5.33908 1.45416 5.90741 1.21875 6.5 1.21875ZM6.5 2.03125C6.1229 2.03125 5.76124 2.18105 5.49458 2.44771C5.22793 2.71436 5.07812 3.07602 5.07812 3.45312C5.07812 3.83023 5.22793 4.19189 5.49458 4.45854C5.76124 4.7252 6.1229 4.875 6.5 4.875C6.8771 4.875 7.23876 4.7252 7.50542 4.45854C7.77207 4.19189 7.92188 3.83023 7.92188 3.45312C7.92188 3.07602 7.77207 2.71436 7.50542 2.44771C7.23876 2.18105 6.8771 2.03125 6.5 2.03125Z"
                                                        fill="#172635" />
                                                </svg>


                                                {{ __('app.layouts.persons') }}

                                            </button>
                                        @endif


                                        @if (in_array(strtolower('show-attributes-organizations'), array_map('strtolower', $permissions)))
                                            <button class="btn white-btn tab-button " id="nav-organizations-tab"
                                                data-bs-toggle="tab" data-bs-target="#nav-organizations" type="button"
                                                role="tab" aria-controls="nav-organizations" aria-selected="false">
                                                <svg width="14" height="15" viewBox="0 0 14 15" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.99973 1.90041C6.47173 1.89832 5.96233 2.0952 5.57297 2.45183C5.18362 2.80847 4.9429 3.29868 4.89876 3.82483C4.85462 4.35098 5.0103 4.87445 5.33479 5.29098C5.65928 5.7075 6.12876 5.9865 6.64973 6.07241V7.15041H4.54973C4.27125 7.15041 4.00418 7.26103 3.80727 7.45794C3.61035 7.65486 3.49973 7.92193 3.49973 8.20041V8.92981C2.98035 9.01757 2.5129 9.29725 2.19 9.71341C1.86711 10.1296 1.71235 10.6519 1.75638 11.1768C1.80042 11.7017 2.04004 12.1909 2.42775 12.5474C2.81547 12.904 3.32299 13.1018 3.84973 13.1018C4.37647 13.1018 4.88399 12.904 5.2717 12.5474C5.65942 12.1909 5.89904 11.7017 5.94307 11.1768C5.98711 10.6519 5.83234 10.1296 5.50945 9.71341C5.18656 9.29725 4.7191 9.01757 4.19973 8.92981V8.20041C4.19973 8.10758 4.2366 8.01856 4.30224 7.95292C4.36788 7.88728 4.4569 7.85041 4.54973 7.85041H9.44973C9.54255 7.85041 9.63158 7.88728 9.69722 7.95292C9.76285 8.01856 9.79973 8.10758 9.79973 8.20041V8.92981C9.28035 9.01757 8.8129 9.29725 8.49 9.71341C8.16711 10.1296 8.01235 10.6519 8.05638 11.1768C8.10042 11.7017 8.34003 12.1909 8.72775 12.5474C9.11547 12.904 9.62299 13.1018 10.1497 13.1018C10.6765 13.1018 11.184 12.904 11.5717 12.5474C11.9594 12.1909 12.199 11.7017 12.2431 11.1768C12.2871 10.6519 12.1323 10.1296 11.8095 9.71341C11.4866 9.29725 11.0191 9.01757 10.4997 8.92981V8.20041C10.4997 7.92193 10.3891 7.65486 10.1922 7.45794C9.99528 7.26103 9.7282 7.15041 9.44973 7.15041H7.34973V6.07241C7.86906 5.9846 8.33645 5.7049 8.6593 5.28875C8.98214 4.8726 9.13688 4.35035 9.09285 3.82549C9.04882 3.30063 8.80923 2.81147 8.42156 2.45492C8.03389 2.09837 7.52643 1.90046 6.99973 1.90041ZM5.59973 4.00041C5.59973 3.6291 5.74723 3.27301 6.00978 3.01046C6.27233 2.74791 6.62842 2.60041 6.99973 2.60041C7.37103 2.60041 7.72713 2.74791 7.98968 3.01046C8.25223 3.27301 8.39973 3.6291 8.39973 4.00041C8.39973 4.37171 8.25223 4.72781 7.98968 4.99036C7.72713 5.25291 7.37103 5.40041 6.99973 5.40041C6.62842 5.40041 6.27233 5.25291 6.00978 4.99036C5.74723 4.72781 5.59973 4.37171 5.59973 4.00041ZM2.44973 11.0004C2.44973 10.629 2.59726 10.2728 2.85988 10.0102C3.1225 9.74759 3.47868 9.60006 3.85008 9.60006C4.22147 9.60006 4.57766 9.74759 4.84027 10.0102C5.10289 10.2728 5.25043 10.629 5.25043 11.0004C5.25043 11.3718 5.10289 11.728 4.84027 11.9906C4.57766 12.2532 4.22147 12.4008 3.85008 12.4008C3.47868 12.4008 3.1225 12.2532 2.85988 11.9906C2.59726 11.728 2.44973 11.3718 2.44973 11.0004ZM10.1497 9.60041C10.3336 9.60041 10.5157 9.63663 10.6856 9.707C10.8555 9.77738 11.0099 9.88053 11.1399 10.0106C11.27 10.1406 11.3731 10.295 11.4435 10.4649C11.5139 10.6348 11.5501 10.8169 11.5501 11.0008C11.5501 11.1847 11.5139 11.3667 11.4435 11.5366C11.3731 11.7065 11.27 11.8609 11.1399 11.991C11.0099 12.121 10.8555 12.2241 10.6856 12.2945C10.5157 12.3649 10.3336 12.4011 10.1497 12.4011C9.77833 12.4011 9.42215 12.2536 9.15953 11.991C8.89691 11.7283 8.74938 11.3722 8.74938 11.0008C8.74938 10.6294 8.89691 10.2732 9.15953 10.0106C9.42215 9.74794 9.77833 9.60041 10.1497 9.60041Z"
                                                        fill="#172635" />
                                                </svg>


                                                {{ __('app.layouts.organizations') }}
                                            </button>
                                        @endif

                                        @if (in_array(strtolower('show-attributes-quotes'), array_map('strtolower', $permissions)))
                                            <button class="btn white-btn tab-button " id="nav-quotes-tab"
                                                data-bs-toggle="tab" data-bs-target="#nav-quotes" type="button"
                                                role="tab" aria-controls="nav-quotes" aria-selected="false">
                                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M9.20866 2.70833H3.79199C3.64833 2.70833 3.51056 2.7654 3.40898 2.86698C3.30739 2.96857 3.25033 3.10634 3.25033 3.25V9.75C3.25033 9.89366 3.30739 10.0314 3.40898 10.133C3.51056 10.2346 3.64833 10.2917 3.79199 10.2917H9.20866C9.35232 10.2917 9.49009 10.2346 9.59167 10.133C9.69326 10.0314 9.75033 9.89366 9.75033 9.75V3.25C9.75033 3.10634 9.69326 2.96857 9.59167 2.86698C9.49009 2.7654 9.35232 2.70833 9.20866 2.70833ZM3.79199 1.625C3.36102 1.625 2.94769 1.7962 2.64294 2.10095C2.3382 2.4057 2.16699 2.81902 2.16699 3.25V9.75C2.16699 10.181 2.3382 10.5943 2.64294 10.899C2.94769 11.2038 3.36102 11.375 3.79199 11.375H9.20866C9.63964 11.375 10.053 11.2038 10.3577 10.899C10.6625 10.5943 10.8337 10.181 10.8337 9.75V3.25C10.8337 2.81902 10.6625 2.4057 10.3577 2.10095C10.053 1.7962 9.63964 1.625 9.20866 1.625H3.79199Z"
                                                        fill="#172635" />
                                                    <path
                                                        d="M4.33398 3.79199H8.66732V4.87533H4.33398V3.79199ZM4.33398 5.95866H8.66732V7.04199H4.33398V5.95866ZM4.33398 8.12533H7.04232V9.20866H4.33398V8.12533Z"
                                                        fill="#172635" />
                                                </svg>


                                                {{ __('app.layouts.quotes') }}
                                            </button>
                                        @endif
                                        @if (in_array(strtolower('show-attributes-products'), array_map('strtolower', $permissions)))
                                            <button class="btn white-btn tab-button " id="nav-products-tab"
                                                data-bs-toggle="tab" data-bs-target="#nav-products" type="button"
                                                role="tab" aria-controls="nav-products" aria-selected="false">
                                                <svg width="13" height="13" viewBox="0 0 13 13" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.5 6.34766V12.4351L6.09375 12.6382L0.8125 10.0039V3.40234L6.09375 0.761719L11.375 3.40234V8.125H10.5625V4.31641L6.5 6.34766ZM6.09375 1.67578L4.56396 2.4375L8.50586 4.43066L10.061 3.65625L6.09375 1.67578ZM5.6875 11.5273V6.34766L1.625 4.31641V9.49609L5.6875 11.5273ZM2.12646 3.65625L6.09375 5.63672L7.60449 4.8877L3.65625 2.89453L2.12646 3.65625ZM8.9375 11.375V10.5625H13V11.375H8.9375ZM8.9375 8.9375H13V9.75H8.9375V8.9375ZM7.3125 13V12.1875H8.125V13H7.3125ZM7.3125 9.75V8.9375H8.125V9.75H7.3125ZM7.3125 11.375V10.5625H8.125V11.375H7.3125ZM8.9375 13V12.1875H13V13H8.9375Z"
                                                        fill="#172635" />
                                                </svg>


                                                {{ __('app.layouts.products') }}
                                            </button>
                                        @endif
                                    </div>

                                    <button class="btn white-btn" data-bs-toggle="collapse" href="#collapseFilter">
                                        {{-- <button class="btn white-btn" data-bs-toggle="offcanvas" data-bs-target="#offFilter"
                                        aria-controls="offcanvasRight"> --}}
                                        <svg width="18" height="18" viewBox="0 0 14 15" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.33333 2.25H11.6667C11.8214 2.25 11.9697 2.31146 12.0791 2.42085C12.1885 2.53025 12.25 2.67862 12.25 2.83333V3.7585C12.25 3.9132 12.1885 4.06155 12.0791 4.17092L8.33758 7.91242C8.22818 8.02179 8.1667 8.17014 8.16667 8.32483V12.0027C8.16666 12.0914 8.14645 12.1789 8.10755 12.2586C8.06866 12.3383 8.01211 12.4081 7.94221 12.4626C7.8723 12.5172 7.79088 12.5551 7.70414 12.5734C7.61739 12.5918 7.5276 12.5901 7.44158 12.5686L6.27492 12.2769C6.14877 12.2453 6.03681 12.1725 5.9568 12.07C5.87679 11.9674 5.83334 11.8411 5.83333 11.7111V8.32483C5.8333 8.17014 5.77182 8.02179 5.66242 7.91242L1.92092 4.17092C1.81151 4.06155 1.75003 3.9132 1.75 3.7585V2.83333C1.75 2.67862 1.81146 2.53025 1.92085 2.42085C2.03025 2.31146 2.17862 2.25 2.33333 2.25Z"
                                                stroke="#172635" stroke-width="0.875" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>

                                        Filter

                                    </button>
                                </div>


                                <div class="col-md-3 col-12 position-absolute filter-search">
                                    <div class="collapse card card-default" id="collapseFilter">
                                        <div class="d-flex justify-content-between align-items-center mb-3 card-header">
                                            <span></span>
                                            <button type="button" class="btn-close" data-bs-toggle="collapse"
                                                data-bs-target="#collapseFilter" aria-label="Close"></button>
                                        </div>
                                        <div class="card-body">
                                            <div>

                                                <form action="" method="get" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-12 mb-3">
                                                            <label for="sku" class="form-label">ID</label>
                                                            <input type="text" class="form-control" name="id"
                                                                value="{{ request('id') }}">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="name" class="form-label">Code</label>
                                                            <input type="text" class="form-control" name="code"
                                                                value="{{ request('code') }}">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" class="form-control" name="name"
                                                                value="{{ request('name') }}">
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="name" class="form-label">Entity Type</label>
                                                            <select class="form-control" data-choices name="entity_type">
                                                                <option value="">Select</option>
                                                                <option value="lead"
                                                                    {{ request('entity_type') == 'lead' ? 'selected' : '' }}>
                                                                    Lead</option>
                                                                <option value="person"
                                                                    {{ request('entity_type') == 'person' ? 'selected' : '' }}>
                                                                    Person
                                                                </option>
                                                                <option value="organization"
                                                                    {{ request('entity_type') == 'organization' ? 'selected' : '' }}>
                                                                    Organization</option>
                                                                <option value="product"
                                                                    {{ request('entity_type') == 'product' ? 'selected' : '' }}>
                                                                    Product
                                                                </option>
                                                                <option value="quote"
                                                                    {{ request('entity_type') == 'quote' ? 'selected' : '' }}>
                                                                    Quote
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="name" class="form-label">Type</label>
                                                            <select class="form-control" data-choices name="type"
                                                                id="type">
                                                                <option value="">Select</option>
                                                                <option value="text"
                                                                    {{ request('type') == 'text' ? 'selected' : '' }}>Text
                                                                </option>
                                                                <option value="textarea"
                                                                    {{ request('type') == 'textarea' ? 'selected' : '' }}>
                                                                    Textarea
                                                                </option>
                                                                <option value="price"
                                                                    {{ request('type') == 'price' ? 'selected' : '' }}>
                                                                    Price</option>
                                                                <option value="boolean"
                                                                    {{ request('type') == 'boolean' ? 'selected' : '' }}>
                                                                    Boolean</option>
                                                                <option value="select"
                                                                    {{ request('type') == 'select' ? 'selected' : '' }}>
                                                                    Select</option>
                                                                <option value="multiselect"
                                                                    {{ request('type') == 'multiselect' ? 'selected' : '' }}>
                                                                    Multiselect</option>
                                                                <option value="checkbox"
                                                                    {{ request('type') == 'checkbox' ? 'selected' : '' }}>
                                                                    Checkbox
                                                                </option>
                                                                <option value="email"
                                                                    {{ request('type') == 'email' ? 'selected' : '' }}>
                                                                    Email</option>
                                                                <option value="address"
                                                                    {{ request('type') == 'address' ? 'selected' : '' }}>
                                                                    Address</option>
                                                                <option value="phone"
                                                                    {{ request('type') == 'phone' ? 'selected' : '' }}>
                                                                    Phone</option>
                                                                <option value="lookup"
                                                                    {{ request('type') == 'lookup' ? 'selected' : '' }}>
                                                                    Lookup</option>
                                                                <option value="datetime"
                                                                    {{ request('type') == 'datetime' ? 'selected' : '' }}>
                                                                    Datetime
                                                                </option>
                                                                <option value="date"
                                                                    {{ request('type') == 'date' ? 'selected' : '' }}>Date
                                                                </option>
                                                                <option value="image"
                                                                    {{ request('type') == 'image' ? 'selected' : '' }}>
                                                                    Image</option>
                                                                <option value="file"
                                                                    {{ request('type') == 'file' ? 'selected' : '' }}>File
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>



                                                    <div class="d-flex justify-content-center gap-3 align-items-center">
                                                        <button type="submit" class="btn save-btn">Apply Filter</button>
                                                        <a href="{{ url('attributes') }}"
                                                            class="btn clear-all-btn">Clear</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>





                            <div class="row g-4">
                                <div class="tab-content" id="nav-tabContent">
                                    @if (in_array(strtolower('show-attributes-all'), array_map('strtolower', $permissions)))
                                        <div class="tab-pane fade show active" id="nav-all" role="tabpanel"
                                            aria-labelledby="nav-all-tab" tabindex="0">
                                            <form id="bulk-delete-form" method="POST"
                                                action="{{ url('delete-selected-attributes') }}">
                                                @csrf
                                                <div class="table-responsive">
                                                    <table class="table new-table data-table-export"
                                                        data-export-title="Attributes" data-export-filename="Attributes">

                                                        <thead>
                                                            <tr>
                                                                <th><input type="checkbox" id="select-all"></th>
                                                                <th>{{ __('app.datagrid.id') }}</th>
                                                                <th>{{ __('app.datagrid.code') }}</th>
                                                                <th>{{ __('app.datagrid.name') }}</th>
                                                                <th>{{ __('app.datagrid.entity_type') }}</th>
                                                                <th>{{ __('app.datagrid.type') }}</th>
                                                                <th>{{ __('app.leads.actions') }}</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php foreach($attributes as $attribute){
                                                            ?>
                                                            <tr class="odd gradeX">
                                                                <td><input type="checkbox" name="selected_attributes[]"
                                                                        value="{{ $attribute->id }}"></td>
                                                                <td class="">{{ $attribute->id }} </td>
                                                                <td class="">{{ $attribute->code }} </td>
                                                                <td class="">{{ $attribute->name }} </td>
                                                                <td class="">{{ $attribute->entity_type }} </td>
                                                                <td class="">{{ $attribute->type }} </td>
                                                                <td class="action-icons d-flex gx-3">
                                                                    <a href="{{ url('delete-attribute/' . $attribute->id) }}"
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
                                                                    <a
                                                                        href="{{ url('edit-attribute/' . $attribute->id) }}">
                                                                        <div class="text-muted" type="button">
                                                                            <svg width="20" height="20"
                                                                                viewBox="0 0 18 18" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <rect width="18" height="18"
                                                                                    rx="2.90323" fill="#E7E9FD" />
                                                                                <path
                                                                                    d="M6.1206 11.8786H6.70663L10.7266 7.85862L10.1406 7.27258L6.1206 11.2926V11.8786ZM5.70935 12.7011C5.59282 12.7011 5.49522 12.6616 5.41654 12.5826C5.33785 12.5037 5.29837 12.4061 5.2981 12.2898V11.2926C5.2981 11.1829 5.31866 11.0783 5.35978 10.9788C5.40091 10.8792 5.45917 10.7919 5.53456 10.7168L10.7266 5.53505C10.8088 5.45966 10.8997 5.4014 10.9993 5.36027C11.0988 5.31915 11.2032 5.29858 11.3126 5.29858C11.422 5.29858 11.5283 5.31915 11.6313 5.36027C11.7344 5.4014 11.8235 5.46308 11.8987 5.54533L12.4641 6.12108C12.5464 6.19648 12.6063 6.28558 12.6438 6.3884C12.6814 6.49121 12.7003 6.59402 12.7006 6.69683C12.7006 6.8065 12.6817 6.9111 12.6438 7.01062C12.606 7.11014 12.5461 7.20089 12.4641 7.28287L7.28238 12.4646C7.20698 12.54 7.11952 12.5983 7.02 12.6394C6.92048 12.6805 6.81602 12.7011 6.70663 12.7011H5.70935ZM10.4284 7.57074L10.1406 7.27258L10.7266 7.85862L10.4284 7.57074Z"
                                                                                    fill="#4A58EC" />
                                                                            </svg>
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm mb-2 delete-form-confirm">Delete
                                                    Selected</button>
                                            </form>
                                        </div>
                                    @endif


                                    @if (in_array(strtolower('show-attributes-leads'), array_map('strtolower', $permissions)))
                                        <div class="tab-pane fade" id="nav-leads" role="tabpanel"
                                            aria-labelledby="nav-leads-tab" tabindex="0">
                                            <form id="bulk-delete-form" method="POST"
                                                action="{{ url('delete-selected-attributes') }}">
                                                @csrf
                                                <div class="table-responsive">
                                                    <table class="table new-table data-table-export"
                                                        data-export-title="Attributes" data-export-filename="Attributes">

                                                        <thead>
                                                            <tr>
                                                                <th><input type="checkbox" id="select-all"></th>
                                                                <th>{{ __('app.datagrid.id') }}</th>
                                                                <th>{{ __('app.datagrid.code') }}</th>
                                                                <th>{{ __('app.datagrid.name') }}</th>
                                                                <th>{{ __('app.datagrid.entity_type') }}</th>
                                                                <th>{{ __('app.datagrid.type') }}</th>
                                                                <th>{{ __('app.leads.actions') }}</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php foreach($attributes as $attribute){
                                                                if($attribute->entity_type == 'lead'){
                                                                ?>
                                                            <tr class="odd gradeX">
                                                                <td><input type="checkbox" name="selected_attributes[]"
                                                                        value="{{ $attribute->id }}"></td>
                                                                <td class="">{{ $attribute->id }} </td>
                                                                <td class="">{{ $attribute->code }} </td>
                                                                <td class="">{{ $attribute->name }} </td>
                                                                <td class="">{{ $attribute->entity_type }} </td>
                                                                <td class="">{{ $attribute->type }} </td>
                                                                <td class="action-icons d-flex gx-3">
                                                                    <a href="{{ url('delete-attribute/' . $attribute->id) }}"
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
                                                                    <a
                                                                        href="{{ url('edit-attribute/' . $attribute->id) }}">
                                                                        <div class="text-muted" type="button">
                                                                            <svg width="20" height="20"
                                                                                viewBox="0 0 18 18" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <rect width="18" height="18"
                                                                                    rx="2.90323" fill="#E7E9FD" />
                                                                                <path
                                                                                    d="M6.1206 11.8786H6.70663L10.7266 7.85862L10.1406 7.27258L6.1206 11.2926V11.8786ZM5.70935 12.7011C5.59282 12.7011 5.49522 12.6616 5.41654 12.5826C5.33785 12.5037 5.29837 12.4061 5.2981 12.2898V11.2926C5.2981 11.1829 5.31866 11.0783 5.35978 10.9788C5.40091 10.8792 5.45917 10.7919 5.53456 10.7168L10.7266 5.53505C10.8088 5.45966 10.8997 5.4014 10.9993 5.36027C11.0988 5.31915 11.2032 5.29858 11.3126 5.29858C11.422 5.29858 11.5283 5.31915 11.6313 5.36027C11.7344 5.4014 11.8235 5.46308 11.8987 5.54533L12.4641 6.12108C12.5464 6.19648 12.6063 6.28558 12.6438 6.3884C12.6814 6.49121 12.7003 6.59402 12.7006 6.69683C12.7006 6.8065 12.6817 6.9111 12.6438 7.01062C12.606 7.11014 12.5461 7.20089 12.4641 7.28287L7.28238 12.4646C7.20698 12.54 7.11952 12.5983 7.02 12.6394C6.92048 12.6805 6.81602 12.7011 6.70663 12.7011H5.70935ZM10.4284 7.57074L10.1406 7.27258L10.7266 7.85862L10.4284 7.57074Z"
                                                                                    fill="#4A58EC" />
                                                                            </svg>
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php }} ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm mb-2 delete-form-confirm">Delete
                                                    Selected</button>
                                            </form>
                                        </div>
                                    @endif

                                    @if (in_array(strtolower('show-attributes-persons'), array_map('strtolower', $permissions)))
                                        <div class="tab-pane fade" id="nav-persons" role="tabpanel"
                                            aria-labelledby="nav-persons-tab" tabindex="0">
                                            <form id="bulk-delete-form" method="POST"
                                                action="{{ url('delete-selected-attributes') }}">
                                                @csrf
                                                <div class="table-responsive">
                                                    <table class="table new-table data-table-export"
                                                        data-export-title="Attributes" data-export-filename="Attributes">

                                                        <thead>
                                                            <tr>
                                                                <th><input type="checkbox" id="select-all"></th>
                                                                <th>{{ __('app.datagrid.id') }}</th>
                                                                <th>{{ __('app.datagrid.code') }}</th>
                                                                <th>{{ __('app.datagrid.name') }}</th>
                                                                <th>{{ __('app.datagrid.entity_type') }}</th>
                                                                <th>{{ __('app.datagrid.type') }}</th>
                                                                <th>{{ __('app.leads.actions') }}</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php foreach($attributes as $attribute){
                                                                if($attribute->entity_type == 'person'){
                                                                ?>
                                                            <tr class="odd gradeX">
                                                                <td><input type="checkbox" name="selected_attributes[]"
                                                                        value="{{ $attribute->id }}"></td>
                                                                <td class="">{{ $attribute->id }} </td>
                                                                <td class="">{{ $attribute->code }} </td>
                                                                <td class="">{{ $attribute->name }} </td>
                                                                <td class="">{{ $attribute->entity_type }} </td>
                                                                <td class="">{{ $attribute->type }} </td>
                                                                <td class="action-icons d-flex gx-3">
                                                                    <a href="{{ url('delete-attribute/' . $attribute->id) }}"
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
                                                                    <a
                                                                        href="{{ url('edit-attribute/' . $attribute->id) }}">
                                                                        <div class="text-muted" type="button">
                                                                            <svg width="20" height="20"
                                                                                viewBox="0 0 18 18" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <rect width="18" height="18"
                                                                                    rx="2.90323" fill="#E7E9FD" />
                                                                                <path
                                                                                    d="M6.1206 11.8786H6.70663L10.7266 7.85862L10.1406 7.27258L6.1206 11.2926V11.8786ZM5.70935 12.7011C5.59282 12.7011 5.49522 12.6616 5.41654 12.5826C5.33785 12.5037 5.29837 12.4061 5.2981 12.2898V11.2926C5.2981 11.1829 5.31866 11.0783 5.35978 10.9788C5.40091 10.8792 5.45917 10.7919 5.53456 10.7168L10.7266 5.53505C10.8088 5.45966 10.8997 5.4014 10.9993 5.36027C11.0988 5.31915 11.2032 5.29858 11.3126 5.29858C11.422 5.29858 11.5283 5.31915 11.6313 5.36027C11.7344 5.4014 11.8235 5.46308 11.8987 5.54533L12.4641 6.12108C12.5464 6.19648 12.6063 6.28558 12.6438 6.3884C12.6814 6.49121 12.7003 6.59402 12.7006 6.69683C12.7006 6.8065 12.6817 6.9111 12.6438 7.01062C12.606 7.11014 12.5461 7.20089 12.4641 7.28287L7.28238 12.4646C7.20698 12.54 7.11952 12.5983 7.02 12.6394C6.92048 12.6805 6.81602 12.7011 6.70663 12.7011H5.70935ZM10.4284 7.57074L10.1406 7.27258L10.7266 7.85862L10.4284 7.57074Z"
                                                                                    fill="#4A58EC" />
                                                                            </svg>
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php }} ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm mb-2 delete-form-confirm">Delete
                                                    Selected</button>
                                            </form>
                                        </div>
                                    @endif

                                    @if (in_array(strtolower('show-attributes-organizations'), array_map('strtolower', $permissions)))
                                        <div class="tab-pane fade" id="nav-organizations" role="tabpanel"
                                            aria-labelledby="nav-organizations-tab" tabindex="0">
                                            <form id="bulk-delete-form" method="POST"
                                                action="{{ url('delete-selected-attributes') }}">
                                                @csrf
                                                <div class="table-responsive">
                                                    <table class="table new-table data-table-export"
                                                        data-export-title="Attributes" data-export-filename="Attributes">

                                                        <thead>
                                                            <tr>
                                                                <th><input type="checkbox" id="select-all"></th>
                                                                <th>{{ __('app.datagrid.id') }}</th>
                                                                <th>{{ __('app.datagrid.code') }}</th>
                                                                <th>{{ __('app.datagrid.name') }}</th>
                                                                <th>{{ __('app.datagrid.entity_type') }}</th>
                                                                <th>{{ __('app.datagrid.type') }}</th>
                                                                <th>{{ __('app.leads.actions') }}</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php foreach($attributes as $attribute){
                                                                if($attribute->entity_type == 'organization'){
                                                                ?>
                                                            <tr class="odd gradeX">
                                                                <td><input type="checkbox" name="selected_attributes[]"
                                                                        value="{{ $attribute->id }}"></td>
                                                                <td class="">{{ $attribute->id }} </td>
                                                                <td class="">{{ $attribute->code }} </td>
                                                                <td class="">{{ $attribute->name }} </td>
                                                                <td class="">{{ $attribute->entity_type }}
                                                                </td>
                                                                <td class="">{{ $attribute->type }} </td>
                                                                <td class="action-icons d-flex gx-3">
                                                                    <a href="{{ url('delete-attribute/' . $attribute->id) }}"
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
                                                                    <a
                                                                        href="{{ url('edit-attribute/' . $attribute->id) }}">
                                                                        <div class="text-muted" type="button">
                                                                            <svg width="20" height="20"
                                                                                viewBox="0 0 18 18" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <rect width="18" height="18"
                                                                                    rx="2.90323" fill="#E7E9FD" />
                                                                                <path
                                                                                    d="M6.1206 11.8786H6.70663L10.7266 7.85862L10.1406 7.27258L6.1206 11.2926V11.8786ZM5.70935 12.7011C5.59282 12.7011 5.49522 12.6616 5.41654 12.5826C5.33785 12.5037 5.29837 12.4061 5.2981 12.2898V11.2926C5.2981 11.1829 5.31866 11.0783 5.35978 10.9788C5.40091 10.8792 5.45917 10.7919 5.53456 10.7168L10.7266 5.53505C10.8088 5.45966 10.8997 5.4014 10.9993 5.36027C11.0988 5.31915 11.2032 5.29858 11.3126 5.29858C11.422 5.29858 11.5283 5.31915 11.6313 5.36027C11.7344 5.4014 11.8235 5.46308 11.8987 5.54533L12.4641 6.12108C12.5464 6.19648 12.6063 6.28558 12.6438 6.3884C12.6814 6.49121 12.7003 6.59402 12.7006 6.69683C12.7006 6.8065 12.6817 6.9111 12.6438 7.01062C12.606 7.11014 12.5461 7.20089 12.4641 7.28287L7.28238 12.4646C7.20698 12.54 7.11952 12.5983 7.02 12.6394C6.92048 12.6805 6.81602 12.7011 6.70663 12.7011H5.70935ZM10.4284 7.57074L10.1406 7.27258L10.7266 7.85862L10.4284 7.57074Z"
                                                                                    fill="#4A58EC" />
                                                                            </svg>
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php }} ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm mb-2 delete-form-confirm">Delete
                                                    Selected</button>
                                            </form>
                                        </div>
                                    @endif


                                    @if (in_array(strtolower('show-attributes-quotes'), array_map('strtolower', $permissions)))
                                        <div class="tab-pane fade" id="nav-quotes" role="tabpanel"
                                            aria-labelledby="nav-quotes-tab" tabindex="0">
                                            <form id="bulk-delete-form" method="POST"
                                                action="{{ url('delete-selected-attributes') }}">
                                                @csrf
                                                <div class="table-responsive">
                                                    <table class="table new-table data-table-export"
                                                        data-export-title="Attributes" data-export-filename="Attributes">

                                                        <thead>
                                                            <tr>
                                                                <th><input type="checkbox" id="select-all">
                                                                </th>
                                                                <th>{{ __('app.datagrid.id') }}</th>
                                                                <th>{{ __('app.datagrid.code') }}</th>
                                                                <th>{{ __('app.datagrid.name') }}</th>
                                                                <th>{{ __('app.datagrid.entity_type') }}</th>
                                                                <th>{{ __('app.datagrid.type') }}</th>
                                                                <th>{{ __('app.leads.actions') }}</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php foreach($attributes as $attribute){
                                                                if($attribute->entity_type == 'quote'){
                                                                ?>
                                                            <tr class="odd gradeX">
                                                                <td><input type="checkbox" name="selected_attributes[]"
                                                                        value="{{ $attribute->id }}"></td>
                                                                <td class="">{{ $attribute->id }} </td>
                                                                <td class="">{{ $attribute->code }}
                                                                </td>
                                                                <td class="">{{ $attribute->name }}
                                                                </td>
                                                                <td class="">
                                                                    {{ $attribute->entity_type }} </td>
                                                                <td class="">{{ $attribute->type }}
                                                                </td>
                                                                <td class="action-icons d-flex gx-3">
                                                                    <a href="{{ url('delete-attribute/' . $attribute->id) }}"
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
                                                                    <a
                                                                        href="{{ url('edit-attribute/' . $attribute->id) }}">
                                                                        <div class="text-muted" type="button">
                                                                            <svg width="20" height="20"
                                                                                viewBox="0 0 18 18" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <rect width="18" height="18"
                                                                                    rx="2.90323" fill="#E7E9FD" />
                                                                                <path
                                                                                    d="M6.1206 11.8786H6.70663L10.7266 7.85862L10.1406 7.27258L6.1206 11.2926V11.8786ZM5.70935 12.7011C5.59282 12.7011 5.49522 12.6616 5.41654 12.5826C5.33785 12.5037 5.29837 12.4061 5.2981 12.2898V11.2926C5.2981 11.1829 5.31866 11.0783 5.35978 10.9788C5.40091 10.8792 5.45917 10.7919 5.53456 10.7168L10.7266 5.53505C10.8088 5.45966 10.8997 5.4014 10.9993 5.36027C11.0988 5.31915 11.2032 5.29858 11.3126 5.29858C11.422 5.29858 11.5283 5.31915 11.6313 5.36027C11.7344 5.4014 11.8235 5.46308 11.8987 5.54533L12.4641 6.12108C12.5464 6.19648 12.6063 6.28558 12.6438 6.3884C12.6814 6.49121 12.7003 6.59402 12.7006 6.69683C12.7006 6.8065 12.6817 6.9111 12.6438 7.01062C12.606 7.11014 12.5461 7.20089 12.4641 7.28287L7.28238 12.4646C7.20698 12.54 7.11952 12.5983 7.02 12.6394C6.92048 12.6805 6.81602 12.7011 6.70663 12.7011H5.70935ZM10.4284 7.57074L10.1406 7.27258L10.7266 7.85862L10.4284 7.57074Z"
                                                                                    fill="#4A58EC" />
                                                                            </svg>
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php }} ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm mb-2 delete-form-confirm">Delete
                                                    Selected</button>
                                            </form>
                                        </div>
                                    @endif
                                    @if (in_array(strtolower('show-attributes-products'), array_map('strtolower', $permissions)))
                                        <div class="tab-pane fade" id="nav-products" role="tabpanel"
                                            aria-labelledby="nav-products-tab" tabindex="0">
                                            <form id="bulk-delete-form" method="POST"
                                                action="{{ url('delete-selected-attributes') }}">
                                                @csrf
                                                <div class="table-responsive">
                                                    <table class="table new-table data-table-export"
                                                        data-export-title="Attributes" data-export-filename="Attributes">

                                                        <thead>
                                                            <tr>
                                                                <th><input type="checkbox" id="select-all"></th>
                                                                <th>{{ __('app.datagrid.id') }}</th>
                                                                <th>{{ __('app.datagrid.code') }}</th>
                                                                <th>{{ __('app.datagrid.name') }}</th>
                                                                <th>{{ __('app.datagrid.entity_type') }}
                                                                </th>
                                                                <th>{{ __('app.datagrid.type') }}</th>
                                                                <th>{{ __('app.leads.actions') }}</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php foreach($attributes as $attribute){
                                                                if($attribute->entity_type == 'product'){
                                                                ?>
                                                            <tr class="odd gradeX">
                                                                <td><input type="checkbox" name="selected_attributes[]"
                                                                        value="{{ $attribute->id }}">
                                                                </td>
                                                                <td class="">{{ $attribute->id }}
                                                                </td>
                                                                <td class="">{{ $attribute->code }}
                                                                </td>
                                                                <td class="">{{ $attribute->name }}
                                                                </td>
                                                                <td class="">
                                                                    {{ $attribute->entity_type }} </td>
                                                                <td class="">{{ $attribute->type }}
                                                                </td>
                                                                <td class="action-icons d-flex gx-3">
                                                                    <a href="{{ url('delete-attribute/' . $attribute->id) }}"
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
                                                                    <a
                                                                        href="{{ url('edit-attribute/' . $attribute->id) }}">
                                                                        <div class="text-muted" type="button">
                                                                            <svg width="20" height="20"
                                                                                viewBox="0 0 18 18" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <rect width="18" height="18"
                                                                                    rx="2.90323" fill="#E7E9FD" />
                                                                                <path
                                                                                    d="M6.1206 11.8786H6.70663L10.7266 7.85862L10.1406 7.27258L6.1206 11.2926V11.8786ZM5.70935 12.7011C5.59282 12.7011 5.49522 12.6616 5.41654 12.5826C5.33785 12.5037 5.29837 12.4061 5.2981 12.2898V11.2926C5.2981 11.1829 5.31866 11.0783 5.35978 10.9788C5.40091 10.8792 5.45917 10.7919 5.53456 10.7168L10.7266 5.53505C10.8088 5.45966 10.8997 5.4014 10.9993 5.36027C11.0988 5.31915 11.2032 5.29858 11.3126 5.29858C11.422 5.29858 11.5283 5.31915 11.6313 5.36027C11.7344 5.4014 11.8235 5.46308 11.8987 5.54533L12.4641 6.12108C12.5464 6.19648 12.6063 6.28558 12.6438 6.3884C12.6814 6.49121 12.7003 6.59402 12.7006 6.69683C12.7006 6.8065 12.6817 6.9111 12.6438 7.01062C12.606 7.11014 12.5461 7.20089 12.4641 7.28287L7.28238 12.4646C7.20698 12.54 7.11952 12.5983 7.02 12.6394C6.92048 12.6805 6.81602 12.7011 6.70663 12.7011H5.70935ZM10.4284 7.57074L10.1406 7.27258L10.7266 7.85862L10.4284 7.57074Z"
                                                                                    fill="#4A58EC" />
                                                                            </svg>
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php }} ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm mb-2 delete-form-confirm">Delete
                                                    Selected</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>



                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Unauthorized',
                    text: '{{ session('error') }}',
                    confirmButtonText: 'OK'
                });
            @endif
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
            let checkboxes = document.querySelectorAll('input[name="selected_attributes[]"]');
            checkboxes.forEach(cb => cb.checked = event.target.checked);
        });
    </script>


    <div class="offcanvas offcanvas-end" tabindex="-1" id="offFilter" aria-labelledby="offFiltertLabel">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="offFilterLabel">Filter</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-4 overflow-hidden">



        </div>

    </div>
@endsection
