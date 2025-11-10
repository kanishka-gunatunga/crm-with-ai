@extends('master')

@section('title', 'Home Page')

@section('content')

    <?php
    use Carbon\Carbon;
    use App\Models\Lead;
    use App\Models\Person;
    use App\Models\Organization;
    ?>
    <link rel="stylesheet" href="{{ asset('css/custom2.css') }}">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->

            <!-- end page title -->

            <!-- page-body -->
            <div class="">
                <div class="row align-items-center ">
                    <div class="col-md-2 mb-4 dashboard-top-col">
                        <div class="card card-default dashbboard-card">
                            <div class="card-body pb-0">
                                <div class="row ">
                                    <div class="col-md-9">
                                        <p class="stat-card-title">CUSTOMERS</p>
                                        <h5 class="stat-card-value">{{ number_format(count($all_customers)) }}</h5>
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-end">
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect width="25" height="25" rx="5" fill="#FFF4D5" />
                                            <path
                                                d="M10.5769 8.33125C10.7646 7.9849 11.0424 7.69569 11.3809 7.49415C11.7194 7.29261 12.106 7.18622 12.5 7.18622C12.8939 7.18622 13.2806 7.29261 13.6191 7.49415C13.9576 7.69569 14.2354 7.9849 14.4231 8.33125C14.6528 8.08745 14.9511 7.91922 15.2785 7.84886C15.606 7.7785 15.9471 7.80934 16.2566 7.93729C16.5661 8.06524 16.8294 8.28426 17.0116 8.56529C17.1938 8.84633 17.2863 9.1761 17.2768 9.51089C17.2672 9.84568 17.1561 10.1697 16.9583 10.4399C16.7604 10.7101 16.485 10.9138 16.1687 11.0239C15.8524 11.134 15.5101 11.1454 15.1872 11.0565C14.8643 10.9677 14.576 10.7827 14.3606 10.5262C14.1645 10.8432 13.8906 11.1047 13.5649 11.2861C13.2393 11.4675 12.8727 11.5626 12.5 11.5625C12.1274 11.5626 11.761 11.4675 11.4355 11.2862C11.11 11.105 10.8362 10.8436 10.64 10.5269C10.4245 10.7833 10.1363 10.9681 9.81336 11.0569C9.49046 11.1457 9.1482 11.1343 8.83195 11.0241C8.5157 10.914 8.2404 10.7103 8.04255 10.4401C7.84471 10.1699 7.73366 9.84592 7.72413 9.51117C7.7146 9.17642 7.80704 8.84668 7.9892 8.56566C8.17135 8.28465 8.43462 8.06564 8.74409 7.93766C9.05356 7.80969 9.39462 7.7788 9.72205 7.84909C10.0495 7.91938 10.3472 8.08753 10.5769 8.33125ZM10.9731 9.04375C11.0376 9.28858 11.0451 9.54494 10.995 9.79312C11.0865 10.1222 11.2833 10.4122 11.5553 10.6188C11.8272 10.8254 12.1594 10.9373 12.5009 10.9373C12.8425 10.9373 13.1746 10.8254 13.4466 10.6188C13.7185 10.4122 13.9153 10.1222 14.0069 9.79312C13.9567 9.54477 13.964 9.28824 14.0281 9.04312C13.9523 8.69433 13.7595 8.38197 13.4816 8.15797C13.2037 7.93397 12.8575 7.81182 12.5006 7.81182C12.1437 7.81182 11.7975 7.93397 11.5196 8.15797C11.2417 8.38197 11.0489 8.69495 10.9731 9.04375ZM10.3319 9.08812C10.2436 8.86312 10.0788 8.67647 9.86648 8.561C9.65415 8.44554 9.4079 8.40867 9.17107 8.45688C8.93424 8.50509 8.722 8.6353 8.57171 8.82458C8.42142 9.01386 8.34271 9.25009 8.34943 9.49168C8.35615 9.73328 8.44788 9.96476 8.60846 10.1454C8.76905 10.326 8.9882 10.4442 9.22735 10.4792C9.46649 10.5142 9.71031 10.4636 9.91589 10.3366C10.1215 10.2095 10.2756 10.0139 10.3512 9.78437C10.3076 9.55481 10.3011 9.31975 10.3319 9.08812ZM14.65 9.78375C14.7255 10.0135 14.8797 10.2093 15.0854 10.3366C15.2911 10.4639 15.5351 10.5145 15.7744 10.4796C16.0138 10.4447 16.2332 10.3264 16.3939 10.1457C16.5546 9.96492 16.6465 9.73325 16.6532 9.49146C16.6599 9.24967 16.5811 9.01325 16.4307 8.82383C16.2803 8.63442 16.0678 8.50414 15.8308 8.45595C15.5938 8.40776 15.3473 8.44474 15.1349 8.56037C14.9224 8.67601 14.7576 8.8629 14.6694 9.08812C14.7001 9.31955 14.6935 9.55439 14.65 9.78375ZM8.09436 11.4356C8.31124 11.3781 8.51624 11.4494 8.65749 11.5519C8.71374 11.5925 8.79124 11.6425 8.88561 11.6881C8.95786 11.7256 9.01266 11.7897 9.03836 11.8669C9.06405 11.9441 9.05861 12.0283 9.0232 12.1016C8.98779 12.1748 8.9252 12.2314 8.84873 12.2592C8.77227 12.2871 8.68796 12.284 8.61374 12.2506C8.50055 12.1961 8.39242 12.1317 8.29061 12.0581C8.28047 12.0509 8.26931 12.0452 8.25749 12.0412L8.25311 12.0406C8.16884 12.0631 8.08526 12.0881 8.00249 12.1156L7.57374 12.2556C7.41385 12.3077 7.26934 12.3985 7.15308 12.52C7.03683 12.6415 6.95246 12.7898 6.90749 12.9519L6.73061 14.2325C6.69561 14.4844 6.82874 14.6731 7.01811 14.7181C7.1577 14.7523 7.32707 14.7856 7.52624 14.8181C7.56678 14.8247 7.60564 14.8392 7.64059 14.8608C7.67553 14.8823 7.70589 14.9106 7.72991 14.9439C7.75394 14.9772 7.77117 15.0149 7.78062 15.0549C7.79007 15.0949 7.79155 15.1363 7.78499 15.1769C7.77842 15.2174 7.76393 15.2563 7.74235 15.2912C7.72077 15.3262 7.69252 15.3565 7.6592 15.3805C7.62589 15.4046 7.58817 15.4218 7.5482 15.4313C7.50823 15.4407 7.46678 15.4422 7.42624 15.4356C7.24077 15.4061 7.05647 15.3696 6.87374 15.3262C6.31436 15.1931 6.04061 14.6575 6.11124 14.1469L6.29374 12.8306L6.29749 12.8137C6.36593 12.5461 6.50096 12.3002 6.69001 12.0988C6.87906 11.8974 7.11599 11.7471 7.37874 11.6619L7.80686 11.5212C7.9027 11.49 7.99853 11.4615 8.09436 11.4356ZM16.9875 11.4356C16.891 11.412 16.7904 11.4102 16.6931 11.4303C16.5958 11.4504 16.5042 11.4919 16.425 11.5519C16.3687 11.5925 16.2912 11.6425 16.1969 11.6881C16.1246 11.7256 16.0698 11.7897 16.0441 11.8669C16.0184 11.9441 16.0239 12.0283 16.0593 12.1016C16.0947 12.1748 16.1573 12.2314 16.2337 12.2592C16.3102 12.2871 16.3945 12.284 16.4687 12.2506C16.5819 12.1961 16.6901 12.1317 16.7919 12.0581C16.802 12.0509 16.8132 12.0452 16.825 12.0412L16.8281 12.0406H16.8294C16.9139 12.0627 16.9975 12.0877 17.08 12.1156L17.5087 12.2556C17.8375 12.3637 18.0869 12.6269 18.175 12.9519L18.3519 14.2325C18.3869 14.4844 18.2544 14.6731 18.0644 14.7181C17.8963 14.7578 17.7268 14.7912 17.5562 14.8181C17.4744 14.8314 17.4011 14.8766 17.3526 14.9439C17.304 15.0112 17.2842 15.095 17.2975 15.1769C17.3107 15.2588 17.356 15.332 17.4233 15.3805C17.4906 15.4291 17.5744 15.4489 17.6562 15.4356C17.8696 15.4002 18.0537 15.3637 18.2087 15.3262C18.7681 15.1931 19.0419 14.6575 18.9712 14.1469L18.7887 12.8306L18.785 12.8137C18.7165 12.5461 18.5815 12.3002 18.3925 12.0988C18.2034 11.8974 17.9665 11.7471 17.7037 11.6619L17.2756 11.5212C17.1806 11.4902 17.0841 11.4616 16.9875 11.4356Z"
                                                fill="#F58A0B" />
                                            <path
                                                d="M13.6194 12.45C13.8437 12.3012 14.1569 12.1937 14.48 12.2844C14.5775 12.3119 14.6748 12.3417 14.7719 12.3737L15.3712 12.5706C15.719 12.6835 16.0326 12.8826 16.2828 13.1492C16.5331 13.4158 16.7118 13.7414 16.8025 14.0956L16.8069 14.1125L17.0606 15.9475C17.1525 16.61 16.7981 17.2912 16.0894 17.46C15.3706 17.6312 14.2069 17.8125 12.5 17.8125C10.7937 17.8125 9.62937 17.6312 8.91062 17.46C8.20187 17.2912 7.84749 16.61 7.93937 15.9475L8.19312 14.1125L8.19749 14.0956C8.28816 13.7414 8.46691 13.4158 8.71715 13.1492C8.96738 12.8826 9.28096 12.6835 9.62874 12.5706L10.2287 12.3737C10.3254 12.3417 10.4225 12.3119 10.52 12.2844C10.8431 12.1931 11.1562 12.3012 11.3806 12.45C11.62 12.6087 12.0137 12.8037 12.5 12.8037C12.9862 12.8037 13.3806 12.6087 13.6194 12.45ZM14.31 12.8856C14.2212 12.8606 14.0975 12.8831 13.965 12.9706C13.6669 13.1687 13.1525 13.4287 12.5 13.4287C11.8475 13.4287 11.3331 13.1687 11.035 12.9706C10.9031 12.8831 10.7787 12.8606 10.69 12.8856C10.6004 12.9106 10.5117 12.9377 10.4237 12.9669L9.82374 13.1644C9.57891 13.2441 9.35779 13.3835 9.18036 13.5701C9.00294 13.7567 8.87479 13.9846 8.80749 14.2331L8.55812 16.0331C8.50187 16.4375 8.71624 16.7706 9.05562 16.8519C9.72249 17.0112 10.8381 17.1875 12.5 17.1875C14.1619 17.1875 15.2775 17.0112 15.9444 16.8519C16.2837 16.7706 16.4975 16.4375 16.4419 16.0331L16.1925 14.2331C16.1252 13.9846 15.9971 13.7567 15.8196 13.5701C15.6422 13.3835 15.4211 13.2441 15.1762 13.1644L14.5762 12.9675C14.4883 12.9383 14.3996 12.9112 14.31 12.8862"
                                                fill="#F58A0B" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <span class="badge rounded-pill stat-badge-success">
                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 3.5V1H6.5" stroke="#00C500" stroke-width="0.75" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M9 1L6.5 3.5C6.0585 3.9415 5.838 4.162 5.5675 4.1865C5.5225 4.1905 5.4775 4.1905 5.4325 4.1865C5.162 4.1615 4.9415 3.9415 4.5 3.5C4.0585 3.0585 3.838 2.838 3.5675 2.8135C3.52259 2.80944 3.47741 2.80944 3.4325 2.8135C3.162 2.8385 2.9415 3.0585 2.5 3.5L1 5"
                                            stroke="#00C500" stroke-width="0.75" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>

                                    +{{ number_format(count($this_month_customers)) }}

                                </span>
                                <span class="stat-duration">From the last month</span>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2 mb-4 dashboard-top-col">
                        <div class="card card-default dashbboard-card">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-md-9">
                                        <p class="stat-card-title">PRODUCTS</p>
                                        <h5 class="stat-card-value">{{ number_format(count($all_products)) }}</h5>
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-end">
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect width="25" height="25" rx="5" fill="#EAF0FF" />
                                            <path
                                                d="M12.5 5.9375L19 9.1875V17.3125L12.5 20.5547L6 17.3125V9.1875L12.5 5.9375ZM17.3828 9.5L12.5 7.0625L10.6172 8L15.4688 10.4531L17.3828 9.5ZM12.5 11.9375L14.3594 11.0156L9.5 8.5625L7.61719 9.5L12.5 11.9375ZM7 10.3125V16.6875L12 19.1875V12.8125L7 10.3125ZM13 19.1875L18 16.6875V10.3125L13 12.8125V19.1875Z"
                                                fill="#4A58EC" />
                                        </svg>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <span class="badge rounded-pill stat-badge-success">
                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 3.5V1H6.5" stroke="#00C500" stroke-width="0.75" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M9 1L6.5 3.5C6.0585 3.9415 5.838 4.162 5.5675 4.1865C5.5225 4.1905 5.4775 4.1905 5.4325 4.1865C5.162 4.1615 4.9415 3.9415 4.5 3.5C4.0585 3.0585 3.838 2.838 3.5675 2.8135C3.52259 2.80944 3.47741 2.80944 3.4325 2.8135C3.162 2.8385 2.9415 3.0585 2.5 3.5L1 5"
                                            stroke="#00C500" stroke-width="0.75" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>

                                    +{{ number_format(count($this_month_products)) }}

                                </span>
                                <span class="stat-duration">From the last month</span>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2 mb-4 dashboard-top-col">
                        <div class="card card-default dashbboard-card">
                            <div class="card-body pb-0">
                                <div class="row ">
                                    <div class="col-md-9">
                                        <p class="stat-card-title">SERVICES</p>
                                        <h5 class="stat-card-value">{{ number_format(count($all_services)) }}</h5>
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-end">
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <rect width="25" height="25" rx="5" fill="#E7F7F2" />
                                            <rect x="4.5" y="4.5" width="16" height="16"
                                                fill="url(#pattern0_2_135)" />
                                            <defs>
                                                <pattern id="pattern0_2_135" patternContentUnits="objectBoundingBox"
                                                    width="1" height="1">
                                                    <use xlink:href="#image0_2_135" transform="scale(0.01)" />
                                                </pattern>
                                                <image id="image0_2_135" width="100" height="100"
                                                    preserveAspectRatio="none"
                                                    xlink:href="data:image/png;base64,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" />
                                            </defs>
                                        </svg>


                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <span class="badge rounded-pill stat-badge-success">
                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 3.5V1H6.5" stroke="#00C500" stroke-width="0.75"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M9 1L6.5 3.5C6.0585 3.9415 5.838 4.162 5.5675 4.1865C5.5225 4.1905 5.4775 4.1905 5.4325 4.1865C5.162 4.1615 4.9415 3.9415 4.5 3.5C4.0585 3.0585 3.838 2.838 3.5675 2.8135C3.52259 2.80944 3.47741 2.80944 3.4325 2.8135C3.162 2.8385 2.9415 3.0585 2.5 3.5L1 5"
                                            stroke="#00C500" stroke-width="0.75" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>

                                    +{{ number_format(count($this_month_services)) }}

                                </span>
                                <span class="stat-duration">From the last month</span>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2 mb-4 dashboard-top-col">
                        <div class="card card-default dashbboard-card">
                            <div class="card-body pb-0">
                                <div class="row ">
                                    <div class="col-md-9">
                                        <p class="stat-card-title">TOTAL LEADS</p>
                                        <h5 class="stat-card-value">{{ number_format(count($all_leads)) }}</h5>
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-end">
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect width="25" height="25" rx="5" fill="#F2ECFF" />
                                            <path
                                                d="M7.66671 17.6667H10.3334V12.3333H7.66671V17.6667ZM11.6667 17.6667H14.3334V8.33333H11.6667V17.6667ZM15.6667 17.6667H18.3334V13.6667H15.6667V17.6667ZM6.33337 17.6667V12.3333C6.33337 11.9667 6.46404 11.6529 6.72537 11.392C6.98671 11.1311 7.30049 11.0004 7.66671 11H10.3334V8.33333C10.3334 7.96667 10.464 7.65289 10.7254 7.392C10.9867 7.13111 11.3005 7.00044 11.6667 7H14.3334C14.7 7 15.014 7.13067 15.2754 7.392C15.5367 7.65333 15.6672 7.96711 15.6667 8.33333V12.3333H18.3334C18.7 12.3333 19.014 12.464 19.2754 12.7253C19.5367 12.9867 19.6672 13.3004 19.6667 13.6667V17.6667C19.6667 18.0333 19.5363 18.3473 19.2754 18.6087C19.0145 18.87 18.7005 19.0004 18.3334 19H7.66671C7.30004 19 6.98626 18.8696 6.72537 18.6087C6.46449 18.3478 6.33382 18.0338 6.33337 17.6667Z"
                                                fill="#7E42FF" />
                                        </svg>


                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <span class="badge rounded-pill stat-badge-danger">
                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 2.5V5H6.5" stroke="#ED2227" stroke-width="0.75"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M9 5L6.5 2.5C6.0585 2.0585 5.838 1.838 5.5675 1.8135C5.52259 1.80944 5.47741 1.80944 5.4325 1.8135C5.162 1.8385 4.9415 2.0585 4.5 2.5C4.0585 2.9415 3.838 3.162 3.5675 3.1865C3.5225 3.1905 3.4775 3.1905 3.4325 3.1865C3.162 3.1615 2.9415 2.9415 2.5 2.5L1 1"
                                            stroke="#ED2227" stroke-width="0.75" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>


                                    +{{ number_format(count($this_month_leads)) }}

                                </span>
                                <span class="stat-duration">From the last month</span>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-2 mb-4 dashboard-top-col">
                        <div class="card card-default dashbboard-card">
                            <div class="card-body pb-0">
                                <div class="row ">
                                    <div class="col-md-9">
                                        <p class="stat-card-title">ACTIVE LEADS</p>
                                        <h5 class="stat-card-value">{{ number_format(count($all_new_leads)) }}</h5>
                                    </div>
                                    <div class="col-md-3 d-flex justify-content-end">
                                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <rect width="25" height="25" rx="5" fill="#FFE5F9" />
                                            <rect x="5" y="5" width="16" height="16"
                                                fill="url(#pattern0_2_173)" />
                                            <defs>
                                                <pattern id="pattern0_2_173" patternContentUnits="objectBoundingBox"
                                                    width="1" height="1">
                                                    <use xlink:href="#image0_2_173" transform="scale(0.01)" />
                                                </pattern>
                                                <image id="image0_2_173" width="100" height="100"
                                                    preserveAspectRatio="none"
                                                    xlink:href="data:image/png;base64,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" />
                                            </defs>
                                        </svg>

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <span class="badge rounded-pill stat-badge-success">
                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 3.5V1H6.5" stroke="#00C500" stroke-width="0.75"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M9 1L6.5 3.5C6.0585 3.9415 5.838 4.162 5.5675 4.1865C5.5225 4.1905 5.4775 4.1905 5.4325 4.1865C5.162 4.1615 4.9415 3.9415 4.5 3.5C4.0585 3.0585 3.838 2.838 3.5675 2.8135C3.52259 2.80944 3.47741 2.80944 3.4325 2.8135C3.162 2.8385 2.9415 3.0585 2.5 3.5L1 5"
                                            stroke="#00C500" stroke-width="0.75" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>

                                    +{{ number_format(count($this_month_new_leads)) }}

                                </span>
                                <span class="stat-duration">From the last month</span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row mb-5">
                    <div class="col-md-8">
                        <div class="card card-default leadsOverview">


                            <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center">
                                <div
                                    class="d-md-none d-flex flex-column flex-md-row justify-content-md-between align-items-md-center w-100">
                                    <div>
                                        <h2 class="dashboard-card-heder text-center text-md-start mb-3 mb-md-0">Leads
                                            Overview</h2>
                                    </div>
                                    <div
                                        class="d-flex flex-column flex-md-row gap-3 gap-md-5 w-100 w-md-auto align-items-center justify-content-center justify-content-md-start">
                                        <div class="text-center text-md-start">
                                            <div class="stat-duration">Overall Success rate</div>
                                            <span class="badge rounded-pill stat-badge-success">
                                                <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9 3.5V1H6.5" stroke="#00C500" stroke-width="0.75"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M9 1L6.5 3.5C6.0585 3.9415 5.838 4.162 5.5675 4.1865C5.5225 4.1905 5.4775 4.1905 5.4325 4.1865C5.162 4.1615 4.9415 3.9415 4.5 3.5C4.0585 3.0585 3.838 2.838 3.5675 2.8135C3.52259 2.80944 3.47741 2.80944 3.4325 2.8135C3.162 2.8385 2.9415 3.0585 2.5 3.5L1 5"
                                                        stroke="#00C500" stroke-width="0.75" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                {{ number_format($overallSuccessRate) }}
                                            </span>
                                        </div>

                                        <div class="text-center text-md-start">
                                            <div class="stat-duration">Success Count</div>
                                            <span class="badge rounded-pill stat-badge-success">
                                                <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9 3.5V1H6.5" stroke="#00C500" stroke-width="0.75"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M9 1L6.5 3.5C6.0585 3.9415 5.838 4.162 5.5675 4.1865C5.5225 4.1905 5.4775 4.1905 5.4325 4.1865C5.162 4.1615 4.9415 3.9415 4.5 3.5C4.0585 3.0585 3.838 2.838 3.5675 2.8135C3.52259 2.80944 3.47741 2.80944 3.4325 2.8135C3.162 2.8385 2.9415 3.0585 2.5 3.5L1 5"
                                                        stroke="#00C500" stroke-width="0.75" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                {{ number_format($wonLeadsCount) }}
                                            </span>
                                        </div>
                                        <div class="time-duration-buttons dashboard-tabs w-100 w-md-auto">
                                            <ul class="nav nav-pills d-flex justify-content-around justify-content-md-start"
                                                id="pills-tab-mobile" role="tablist">
                                                <li class="nav-item flex-grow-1 flex-md-grow-0 text-center"
                                                    role="presentation">
                                                    <button class="nav-link active w-100 w-md-auto"
                                                        id="pills-weekly-tab-mobile" data-bs-toggle="pill"
                                                        data-bs-target="#pills-weekly" type="button" role="tab"
                                                        aria-controls="pills-weekly" aria-selected="true">Weekly</button>
                                                </li>
                                                <li class="nav-item flex-grow-1 flex-md-grow-0 text-center"
                                                    role="presentation">
                                                    <button class="nav-link w-100 w-md-auto" id="pills-monthly-tab-mobile"
                                                        data-bs-toggle="pill" data-bs-target="#pills-monthly"
                                                        type="button" role="tab" aria-controls="pills-monthly"
                                                        aria-selected="false">Monthly</button>
                                                </li>
                                                <li class="nav-item flex-grow-1 flex-md-grow-0 text-center"
                                                    role="presentation">
                                                    <button class="nav-link w-100 w-md-auto" id="pills-yearly-tab-mobile"
                                                        data-bs-toggle="pill" data-bs-target="#pills-yearly"
                                                        type="button" role="tab" aria-controls="pills-yearly"
                                                        aria-selected="false">Yearly</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-none d-md-flex justify-content-between w-100">
                                    <div>
                                        <h2 class="dashboard-card-heder">Leads Overview</h2>
                                    </div>
                                    <div class="d-flex gap-5">
                                        <div>
                                            <div class="stat-duration">Overall Success rate</div>
                                            <span class="badge rounded-pill stat-badge-success">
                                                <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9 3.5V1H6.5" stroke="#00C500" stroke-width="0.75"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M9 1L6.5 3.5C6.0585 3.9415 5.838 4.162 5.5675 4.1865C5.5225 4.1905 5.4775 4.1905 5.4325 4.1865C5.162 4.1615 4.9415 3.9415 4.5 3.5C4.0585 3.0585 3.838 2.838 3.5675 2.8135C3.52259 2.80944 3.47741 2.80944 3.4325 2.8135C3.162 2.8385 2.9415 3.0585 2.5 3.5L1 5"
                                                        stroke="#00C500" stroke-width="0.75" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                {{ number_format($overallSuccessRate) }}
                                            </span>
                                        </div>
                                        <div>
                                            <div class="stat-duration">Success Count</div>
                                            <span class="badge rounded-pill stat-badge-success">
                                                <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9 3.5V1H6.5" stroke="#00C500" stroke-width="0.75"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M9 1L6.5 3.5C6.0585 3.9415 5.838 4.162 5.5675 4.1865C5.5225 4.1905 5.4775 4.1905 5.4325 4.1865C5.162 4.1615 4.9415 3.9415 4.5 3.5C4.0585 3.0585 3.838 2.838 3.5675 2.8135C3.52259 2.80944 3.47741 2.80944 3.4325 2.8135C3.162 2.8385 2.9415 3.0585 2.5 3.5L1 5"
                                                        stroke="#00C500" stroke-width="0.75" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                {{ number_format($wonLeadsCount) }}
                                            </span>
                                        </div>
                                        <div class="time-duration-buttons dashboard-tabs">
                                            <ul class="nav nav-pills" id="pills-tab-desktop" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="pills-weekly-tab-desktop"
                                                        data-bs-toggle="pill" data-bs-target="#pills-weekly"
                                                        type="button" role="tab" aria-controls="pills-weekly"
                                                        aria-selected="true">Weekly</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="pills-monthly-tab-desktop"
                                                        data-bs-toggle="pill" data-bs-target="#pills-monthly"
                                                        type="button" role="tab" aria-controls="pills-monthly"
                                                        aria-selected="false">Monthly</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="pills-yearly-tab-desktop"
                                                        data-bs-toggle="pill" data-bs-target="#pills-yearly"
                                                        type="button" role="tab" aria-controls="pills-yearly"
                                                        aria-selected="false">Yearly</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-weekly" role="tabpanel"
                                        aria-labelledby="pills-weekly-tab">
                                        <canvas id="weeklyChart"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="pills-monthly" role="tabpanel"
                                        aria-labelledby="pills-monthly-tab">
                                        <canvas id="monthlyChart"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="pills-yearly" role="tabpanel"
                                        aria-labelledby="pills-yearly-tab">
                                        <canvas id="yearlyChart"></canvas>
                                    </div>
                                </div>
                            </div>


                        </div>


                        <div class="mt-4 ">
                            <div class="card card-default">

                                <div class="card-body">

                                    <div class="d-flex justify-content-between">
                                        <div>

                                            <h2 class="dashboard-card-heder">My Leads</h2>
                                        </div>
                                        <div class="mb-4">
                                            <button class="btn white-btn" data-bs-toggle="collapse"
                                                href="#collapseFilter-myLeads">
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


                                        <div class="col-5 position-absolute filter-search">
                                            <div class="collapse card card-default" id="collapseFilter-myLeads">
                                                <div
                                                    class="d-flex justify-content-between align-items-center mb-3 card-header">
                                                    <span></span>
                                                    <button type="button" class="btn-close" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseFilter-myLeads"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="card-body">
                                                    <div>

                                                        <form action="" method="get"
                                                            enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="col-md-12 mb-3">
                                                                    <label for="subject"
                                                                        class="form-label">Subject</label>
                                                                    <input type="text" class="form-control"
                                                                        name="subject" value="{{ request('subject') }}">
                                                                </div>

                                                                <div class="col-md-12 mb-3">
                                                                    <label for="owner" class="form-label">Sales
                                                                        Owner</label>
                                                                    <select class="form-control" name="owner">
                                                                        <option value="">Select Owner</option>
                                                                        {{-- @foreach ($owners as $owner)
                                                                            <option value="{{ $owner->user_id }}"
                                                                                {{ request('owner') == $owner->user_id ? 'selected' : '' }}>
                                                                                {{ $owner->name }}
                                                                            </option>
                                                                        @endforeach --}}
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-12 mb-3">
                                                                    <label for="person"
                                                                        class="form-label">Person</label>
                                                                    <select class="form-control" name="person">
                                                                        <option value="">Select Person</option>
                                                                        {{-- @foreach ($persons as $person)
                                                                            <option value="{{ $person->id }}"
                                                                                {{ request('person') == $person->id ? 'selected' : '' }}>
                                                                                {{ $person->name }}
                                                                            </option>
                                                                        @endforeach --}}
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label for="expire_start_date"
                                                                        class="form-label">Expire
                                                                        Start</label>
                                                                    <input type="date" class="form-control"
                                                                        name="expire_start_date"
                                                                        value="{{ request('expire_start_date') }}">
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label for="expire_end_date" class="form-label">Expire
                                                                        End</label>
                                                                    <input type="date" class="form-control"
                                                                        name="expire_end_date"
                                                                        value="{{ request('expire_end_date') }}">
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label for="created_start_date"
                                                                        class="form-label">Create
                                                                        Start</label>
                                                                    <input type="date" class="form-control"
                                                                        name="created_start_date"
                                                                        value="{{ request('created_start_date') }}">
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label for="created_end_date"
                                                                        class="form-label">Create
                                                                        End</label>
                                                                    <input type="date" class="form-control"
                                                                        name="created_end_date"
                                                                        value="{{ request('created_end_date') }}">
                                                                </div>
                                                            </div>


                                                            <div
                                                                class="d-flex justify-content-center gap-3 align-items-center">
                                                                <button type="submit" class="btn save-btn">Apply
                                                                    Filter</button>
                                                                <a href="{{ url('quotes') }}"
                                                                    class="btn clear-all-btn">Clear</a>
                                                            </div>


                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive my-leads-table">
                                        <table id="buttons-datatables" class="display table new-table bordered-table"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="corner-left">#</th>
                                                    <th>Lead Name</th>
                                                    <th>Client</th>
                                                    <th>Date</th>
                                                    <th class="corner-right">Priority</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    
                                                    $my_leads = $all_leads->take(10);
                                                    foreach ($my_leads as $my_lead) {
                                                        $person_name = Person::where('id', $my_lead->person)->value('name');
                                                        $closing_date = $my_lead->closing_date ? Carbon::parse($my_lead->closing_date) : null;
                                                        $is_within_week = $closing_date && $closing_date->isBetween(Carbon::now(), Carbon::now()->addWeek());
                                                ?>


                                                <tr>
                                                    <td>{{ $my_lead->id }}</td>
                                                    <td><a
                                                            href="{{ url('view-lead/' . $my_lead->id) }}">{{ $my_lead->title }}</a>
                                                    </td>
                                                    <td><a
                                                            href="{{ url('persons?id=' . $my_lead->person) }}">{{ $person_name }}</a>
                                                    </td>
                                                    <td class="successBakcgorund">
                                                        @if ($is_within_week)
                                                            <span class="badge rounded-pill stat-badge-danger px-4">
                                                                {{ $closing_date->format('F j, Y') }}
                                                            </span>
                                                        @else
                                                            <span class="badge rounded-pill stat-badge-success px-4">
                                                                {{ Carbon::parse($my_lead->created_at)->format('F j, Y') }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (is_null($my_lead->priority) || $my_lead->priority === '')
                                                            <select class="priority-select dashboard-priority"
                                                                data-lead-id="{{ $my_lead->id }}">
                                                                <option value="" selected disabled>Select Priority
                                                                </option>
                                                                <option value="High">High</option>
                                                                <option value="Medium">Medium</option>
                                                                <option value="Low">Low</option>
                                                            </select>
                                                        @else
                                                            <select class="priority-select dashboard-priority"
                                                                data-lead-id="{{ $my_lead->id }}">
                                                                <option value="High"
                                                                    {{ $my_lead->priority == 'High' ? 'selected' : '' }}>
                                                                    High</option>
                                                                <option value="Urgent"
                                                                    {{ $my_lead->priority == 'Urgent' ? 'selected' : '' }}>
                                                                    Urgent</option>
                                                                <option value="Medium"
                                                                    {{ $my_lead->priority == 'Medium' ? 'selected' : '' }}>
                                                                    Medium</option>
                                                                <option value="Low"
                                                                    {{ $my_lead->priority == 'Low' ? 'selected' : '' }}>Low
                                                                </option>
                                                            </select>
                                                        @endif

                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="mt-4">
                            <div class="card card-default leadsOverview">
                                <div
                                    class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center">
                                    <div
                                        class="d-md-none d-flex flex-column flex-md-row justify-content-md-between align-items-md-center w-100">
                                        <div>
                                            <h2 class="dashboard-card-heder text-center text-md-start mb-3 mb-md-0">Lead
                                                Status</h2>
                                        </div>
                                        <div
                                            class="d-flex flex-column flex-md-row gap-3 gap-md-5 w-100 w-md-auto align-items-center justify-content-center justify-content-md-start">
                                            <div class="text-center text-md-start">
                                                <div class="stat-duration">Average Time</div>
                                                <span class="badge rounded-pill stat-badge-success">
                                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9 3.5V1H6.5" stroke="#00C500" stroke-width="0.75"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path
                                                            d="M9 1L6.5 3.5C6.0585 3.9415 5.838 4.162 5.5675 4.1865C5.5225 4.1905 5.4775 4.1905 5.4325 4.1865C5.162 4.1615 4.9415 3.9415 4.5 3.5C4.0585 3.0585 3.838 2.838 3.5675 2.8135C3.52259 2.80944 3.47741 2.80944 3.4325 2.8135C3.162 2.8385 2.9415 3.0585 2.5 3.5L1 5"
                                                            stroke="#00C500" stroke-width="0.75" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    +15
                                                </span>
                                            </div>

                                            <div class="text-center text-md-start">
                                                <div class="stat-duration">Win</div>
                                                <span class="badge rounded-pill stat-badge-success">
                                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9 3.5V1H6.5" stroke="#00C500" stroke-width="0.75"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path
                                                            d="M9 1L6.5 3.5C6.0585 3.9415 5.838 4.162 5.5675 4.1865C5.5225 4.1905 5.4775 4.1905 5.4325 4.1865C5.162 4.1615 4.9415 3.9415 4.5 3.5C4.0585 3.0585 3.838 2.838 3.5675 2.8135C3.52259 2.80944 3.47741 2.80944 3.4325 2.8135C3.162 2.8385 2.9415 3.0585 2.5 3.5L1 5"
                                                            stroke="#00C500" stroke-width="0.75" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    +15
                                                </span>
                                            </div>
                                            <div class="time-duration-buttons dashboard-tabs w-100 w-md-auto">
                                                <ul class="nav nav-pills d-flex justify-content-around justify-content-md-start"
                                                    id="pills-tab-mobile-status" role="tablist">
                                                    <li class="nav-item flex-grow-1 flex-md-grow-0 text-center"
                                                        role="presentation">
                                                        <button class="nav-link active w-100 w-md-auto"
                                                            id="pills-weekly-status-tab-mobile" data-bs-toggle="pill"
                                                            data-bs-target="#pills-weekly-status" type="button"
                                                            role="tab" aria-controls="pills-weekly-status"
                                                            aria-selected="true">Weekly</button>
                                                    </li>
                                                    <li class="nav-item flex-grow-1 flex-md-grow-0 text-center"
                                                        role="presentation">
                                                        <button class="nav-link w-100 w-md-auto"
                                                            id="pills-monthly-status-tab-mobile" data-bs-toggle="pill"
                                                            data-bs-target="#pills-monthly-status" type="button"
                                                            role="tab" aria-controls="pills-monthly-status"
                                                            aria-selected="false">Monthly</button>
                                                    </li>
                                                    <li class="nav-item flex-grow-1 flex-md-grow-0 text-center"
                                                        role="presentation">
                                                        <button class="nav-link w-100 w-md-auto"
                                                            id="pills-yearly-status-tab-mobile" data-bs-toggle="pill"
                                                            data-bs-target="#pills-yearly-status" type="button"
                                                            role="tab" aria-controls="pills-yearly-status"
                                                            aria-selected="false">Yearly</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-none d-md-flex justify-content-between w-100">
                                        <div>
                                            <h2 class="dashboard-card-heder">Lead Status</h2>
                                        </div>
                                        <div class="d-flex gap-5">
                                            <div>
                                                <div class="stat-duration">Average Time</div>
                                                <span class="badge rounded-pill stat-badge-success">
                                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9 3.5V1H6.5" stroke="#00C500" stroke-width="0.75"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path
                                                            d="M9 1L6.5 3.5C6.0585 3.9415 5.838 4.162 5.5675 4.1865C5.5225 4.1905 5.4775 4.1905 5.4325 4.1865C5.162 4.1615 4.9415 3.9415 4.5 3.5C4.0585 3.0585 3.838 2.838 3.5675 2.8135C3.52259 2.80944 3.47741 2.80944 3.4325 2.8135C3.162 2.8385 2.9415 3.0585 2.5 3.5L1 5"
                                                            stroke="#00C500" stroke-width="0.75" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    +15
                                                </span>
                                            </div>
                                            <div>
                                                <div class="stat-duration">Win</div>
                                                <span class="badge rounded-pill stat-badge-success">
                                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9 3.5V1H6.5" stroke="#00C500" stroke-width="0.75"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path
                                                            d="M9 1L6.5 3.5C6.0585 3.9415 5.838 4.162 5.5675 4.1865C5.5225 4.1905 5.4775 4.1905 5.4325 4.1865C5.162 4.1615 4.9415 3.9415 4.5 3.5C4.0585 3.0585 3.838 2.838 3.5675 2.8135C3.52259 2.80944 3.47741 2.80944 3.4325 2.8135C3.162 2.8385 2.9415 3.0585 2.5 3.5L1 5"
                                                            stroke="#00C500" stroke-width="0.75" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    +15
                                                </span>
                                            </div>
                                            <div class="time-duration-buttons dashboard-tabs">
                                                <ul class="nav nav-pills" id="pills-tab-desktop-status" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active"
                                                            id="pills-weekly-status-tab-desktop" data-bs-toggle="pill"
                                                            data-bs-target="#pills-weekly-status" type="button"
                                                            role="tab" aria-controls="pills-weekly-status"
                                                            aria-selected="true">Weekly</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="pills-monthly-status-tab-desktop"
                                                            data-bs-toggle="pill" data-bs-target="#pills-monthly-status"
                                                            type="button" role="tab"
                                                            aria-controls="pills-monthly-status"
                                                            aria-selected="false">Monthly</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="pills-yearly-status-tab-desktop"
                                                            data-bs-toggle="pill" data-bs-target="#pills-yearly-status"
                                                            type="button" role="tab"
                                                            aria-controls="pills-yearly-status"
                                                            aria-selected="false">Yearly</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-weekly-status" role="tabpanel"
                                            aria-labelledby="pills-weekly-status-tab">
                                            <canvas id="statusWeeklyChart"></canvas>
                                        </div>
                                        <div class="tab-pane fade" id="pills-monthly-status" role="tabpanel"
                                            aria-labelledby="pills-monthly-status-tab">
                                            <canvas id="statusMonthlyChart"></canvas>
                                        </div>
                                        <div class="tab-pane fade" id="pills-yearly-status" role="tabpanel"
                                            aria-labelledby="pills-yearly-status-tab">
                                            <canvas id="statusYearlyChart"></canvas>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>


                        <div class="mt-4">
                            <div class="card card-default leadsOverview">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h2 class="dashboard-card-heder">Sources</h2>
                                    </div>
                                    <div class="d-flex gap-5">

                                        <div class="time-duration-buttons dashboard-tabs">
                                            <ul class="nav nav-pills " id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="pills-weekly-sources-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-weekly-sources"
                                                        type="button" role="tab"
                                                        aria-controls="pills-weekly-sources"
                                                        aria-selected="true">Weekly</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="pills-monthly-sources-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-monthly-sources"
                                                        type="button" role="tab"
                                                        aria-controls="pills-monthly-sources"
                                                        aria-selected="false">Monthly</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="pills-yearly-sources-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-yearly-sources"
                                                        type="button" role="tab"
                                                        aria-controls="pills-yearly-sources"
                                                        aria-selected="false">Yearly</button>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>


                                </div>

                                <div>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-weekly-sources" role="tabpanel"
                                            aria-labelledby="pills-weekly-sources-tab">
                                            <canvas id="sourcesWeeklyChart"></canvas>
                                        </div>
                                        <div class="tab-pane fade" id="pills-monthly-sources" role="tabpanel"
                                            aria-labelledby="pills-monthly-sources-tab">
                                            <canvas id="sourcesMonthlyChart"></canvas>
                                        </div>
                                        <div class="tab-pane fade" id="pills-yearly-sources" role="tabpanel"
                                            aria-labelledby="pills-yearly-sources-tab">
                                            <canvas id="sourcesYearlyChart"></canvas>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">


                        <div class="card card-default">
                            <div class="card-body">
                                <div class="calendar-container">
                                    <div class="calendar-header">
                                        <h2 id="calendar-month" class="dashboard-card-heder">January 2025</h2>
                                        <div class="nav-buttons">
                                            <button id="prev-week"><i class="fa-solid fa-angle-left"></i></button>
                                            <button id="next-week"><i class="fa-solid fa-angle-right"></i></button>
                                        </div>
                                    </div>

                                    <div class="calendar-weekdays mt-4">
                                        <div>Sun</div>
                                        <div>Mon</div>
                                        <div>Tue</div>
                                        <div>Wed</div>
                                        <div>Thu</div>
                                        <div>Fri</div>
                                        <div>Sat</div>
                                    </div>

                                    <div id="calendar-days" class="calendar-days mt-4">
                                        <!-- Dates will be injected here by JS -->
                                    </div>

                                    <div class="events-section">
                                        <h4>Upcoming Events</h4>
                                        <ul id="event-list" class="event-list mt-4">
                                            <!-- Events will be injected here -->
                                        </ul>
                                    </div>
                                </div>


                            </div>

                        </div>


                        <div class="mt-4 ">
                            <div class="card card-default">

                                <div class="card-body">

                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h2 class="dashboard-card-heder">Birthdays</h2>
                                        </div>
                                        {{-- <div class="mb-4">
                                            <button class="btn white-btn" data-bs-toggle="collapse"
                                                href="#collapseFilter">
                                               
                                                <svg width="18" height="18" viewBox="0 0 14 15" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2.33333 2.25H11.6667C11.8214 2.25 11.9697 2.31146 12.0791 2.42085C12.1885 2.53025 12.25 2.67862 12.25 2.83333V3.7585C12.25 3.9132 12.1885 4.06155 12.0791 4.17092L8.33758 7.91242C8.22818 8.02179 8.1667 8.17014 8.16667 8.32483V12.0027C8.16666 12.0914 8.14645 12.1789 8.10755 12.2586C8.06866 12.3383 8.01211 12.4081 7.94221 12.4626C7.8723 12.5172 7.79088 12.5551 7.70414 12.5734C7.61739 12.5918 7.5276 12.5901 7.44158 12.5686L6.27492 12.2769C6.14877 12.2453 6.03681 12.1725 5.9568 12.07C5.87679 11.9674 5.83334 11.8411 5.83333 11.7111V8.32483C5.8333 8.17014 5.77182 8.02179 5.66242 7.91242L1.92092 4.17092C1.81151 4.06155 1.75003 3.9132 1.75 3.7585V2.83333C1.75 2.67862 1.81146 2.53025 1.92085 2.42085C2.03025 2.31146 2.17862 2.25 2.33333 2.25Z"
                                                        stroke="#172635" stroke-width="0.875" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>

                                                Filter

                                            </button>
                                        </div> --}}


                                    </div>

                                    <div class="col-9 position-absolute filter-search">
                                        <div class="collapse card card-default" id="collapseFilter">
                                            <div
                                                class="d-flex justify-content-between align-items-center mb-3 card-header">
                                                <span></span>
                                                <button type="button" class="btn-close" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseFilter" aria-label="Close"></button>
                                            </div>
                                            <div class="card-body">
                                                <div>

                                                    <form action="" method="get" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-3">
                                                                <label for="subject" class="form-label">Subject</label>
                                                                <input type="text" class="form-control" name="subject"
                                                                    value="{{ request('subject') }}">
                                                            </div>

                                                            <div class="col-md-12 mb-3">
                                                                <label for="owner" class="form-label">Sales
                                                                    Owner</label>
                                                                <select class="form-control" name="owner">
                                                                    <option value="">Select Owner</option>
                                                                    {{-- @foreach ($owners as $owner)
                                                                            <option value="{{ $owner->user_id }}"
                                                                                {{ request('owner') == $owner->user_id ? 'selected' : '' }}>
                                                                                {{ $owner->name }}
                                                                            </option>
                                                                        @endforeach --}}
                                                                </select>
                                                            </div>

                                                            <div class="col-md-12 mb-3">
                                                                <label for="person" class="form-label">Person</label>
                                                                <select class="form-control" name="person">
                                                                    <option value="">Select Person</option>
                                                                    {{-- @foreach ($persons as $person)
                                                                            <option value="{{ $person->id }}"
                                                                                {{ request('person') == $person->id ? 'selected' : '' }}>
                                                                                {{ $person->name }}
                                                                            </option>
                                                                        @endforeach --}}
                                                                </select>
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label for="expire_start_date" class="form-label">Expire
                                                                    Start</label>
                                                                <input type="date" class="form-control"
                                                                    name="expire_start_date"
                                                                    value="{{ request('expire_start_date') }}">
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label for="expire_end_date" class="form-label">Expire
                                                                    End</label>
                                                                <input type="date" class="form-control"
                                                                    name="expire_end_date"
                                                                    value="{{ request('expire_end_date') }}">
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label for="created_start_date" class="form-label">Create
                                                                    Start</label>
                                                                <input type="date" class="form-control"
                                                                    name="created_start_date"
                                                                    value="{{ request('created_start_date') }}">
                                                            </div>

                                                            <div class="col-md-6 mb-3">
                                                                <label for="created_end_date" class="form-label">Create
                                                                    End</label>
                                                                <input type="date" class="form-control"
                                                                    name="created_end_date"
                                                                    value="{{ request('created_end_date') }}">
                                                            </div>
                                                        </div>


                                                        <div
                                                            class="d-flex justify-content-center gap-3 align-items-center">
                                                            <button type="submit" class="btn save-btn">Apply
                                                                Filter</button>
                                                            <a href="{{ url('quotes') }}"
                                                                class="btn clear-all-btn">Clear</a>
                                                        </div>


                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="buttons-datatables" class="display table new-table bordered-table"
                                            style="width:100%">

                                            <tbody>
                                                @foreach ($persons as $person)
                                                    @php
                                                        $organization = Organization::find($person->organization);
                                                        $dob = Carbon::parse($person->dob);
                                                        $age = $dob->age;
                                                        $todayFormatted = $dob->format('F d, Y');
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="{{ asset('images/cake.png') }}"
                                                                    alt="Cake Icon">
                                                                <div class="mx-2">
                                                                    <strong>{{ $person->name }}</strong><br>
                                                                    {{ $organization->name ?? '-' }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $todayFormatted }}</td>
                                                        <td>{{ $age }} Year{{ $age > 1 ? 's' : '' }} old</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="mt-4 ">
                            <div class="card card-default">
                                <div class="card-body p-0">
                                    <iframe style="width:100%;border-radius:10px;" height="315"
                                        src="https://www.youtube.com/embed/668nUCeBHyY?si=oiVBORx6zDLMBeyO"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>


                        <div class="mt-4 ">
                            <div class="card card-default">

                                <div class="card-body">

                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h2 class="dashboard-card-heder">Pipeline</h2>
                                        </div>

                                    </div>
                                    <div class="dashbaord-piechart-container">
                                        <canvas id="pipelinePieChart"></canvas>
                                        <div class="align-items-center justify-content-center text-center pie-chart-inner">

                                            <span class="pepeline-text">Total Pipelines</span>
                                            <span class="pepeline-count" id="totalPipelines">0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>



            </div>
        </div>
    </div>

    <style>
        .leadsOverview {
            /* width: 100%;
                                max-width: 900px; */
            /* margin: auto; */
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- chart for leeds overview --}}
    <script>
        const ctx = document.getElementById('weeklyChart').getContext('2d');
        const ctx2 = document.getElementById('monthlyChart').getContext('2d');
        const ctx3 = document.getElementById('yearlyChart').getContext('2d');

        const weeklyChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($weeklyLabels),
                datasets: [{
                        label: 'Leads',
                        data: @json($weeklyAllLeadsData),
                        backgroundColor: '#4A6CF7',
                        borderRadius: 6,
                        barThickness: 20,
                    },
                    {
                        label: 'Success',
                        data: @json($weeklyWonLeadsData),
                        backgroundColor: '#48D3FF',
                        borderRadius: 6,
                        barThickness: 20,
                    },

                ]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                    legend: {
                        display: true,
                        position: 'bottom',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        // max: 100,
                        ticks: {
                            stepSize: 20
                        },
                        grid: {
                            color: '#e0e0e0'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
        const monthlyChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: @json($monthlyLabels),
                datasets: [{
                        label: 'Leads',
                        data: @json($monthlyAllLeadsData),
                        backgroundColor: '#4A6CF7',
                        borderRadius: 6,
                        barThickness: 20,
                    },
                    {
                        label: 'Success',
                        data: @json($monthlyWonLeadsData),
                        backgroundColor: '#48D3FF',
                        borderRadius: 6,
                        barThickness: 20,
                    },

                ]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                    legend: {
                        display: true,
                        position: 'bottom',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        // max: 100,
                        ticks: {
                            stepSize: 20
                        },
                        grid: {
                            color: '#e0e0e0'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        const yearlyChart = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: @json($yearlyLabels),
                datasets: [{
                        label: 'Leads',
                        data: @json($yearlyAllLeadsData),
                        backgroundColor: '#4A6CF7',
                        borderRadius: 6,
                        barThickness: 20,
                    },
                    {
                        label: 'Success',
                        data: @json($yearlyWonLeadsData),
                        backgroundColor: '#48D3FF',
                        borderRadius: 6,
                        barThickness: 20,
                    },

                ]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                    legend: {
                        display: true,
                        position: 'bottom',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        // max: 100,
                        ticks: {
                            stepSize: 20
                        },
                        grid: {
                            color: '#e0e0e0'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
    {{-- chart for lead status --}}
    <script>
        const ctx4 = document.getElementById('statusWeeklyChart').getContext('2d');
        const ctx5 = document.getElementById('statusMonthlyChart').getContext('2d');
        const ctx6 = document.getElementById('statusYearlyChart').getContext('2d');

        const statusWeeklyChart = new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: @json($weeklyLabels),
                datasets: [{
                        label: 'Leads',
                        data: @json($weeklyAllLeadsData),
                        backgroundColor: '#4A58EC',
                        borderRadius: 6,
                        barThickness: 20,
                    },
                    {
                        label: 'New',
                        data: @json($weeklyNewLeadsData),
                        backgroundColor: '#48D3FF',
                        borderRadius: 6,
                        barThickness: 20,
                    },
                    {
                        label: 'Won',
                        data: @json($weeklyWonLeadsData),
                        backgroundColor: '#7265F9',
                        borderRadius: 6,
                        barThickness: 20,
                    },
                    {
                        label: 'Lost',
                        data: @json($weeklyLostLeadsData),
                        backgroundColor: '#B965F9',
                        borderRadius: 6,
                        barThickness: 20,
                    },

                ]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                    legend: {
                        display: true,
                        position: 'bottom',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        // max: 100,
                        ticks: {
                            stepSize: 20
                        },
                        grid: {
                            color: '#e0e0e0'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        const statusMonthlyChart = new Chart(ctx5, {
            type: 'bar',
            data: {
                labels: @json($monthlyLabels),
                datasets: [{
                        label: 'Leads',
                        data: @json($monthlyAllLeadsData),
                        backgroundColor: '#4A58EC',
                    },
                    {
                        label: 'New',
                        data: @json($monthlyNewLeadsData),
                        backgroundColor: '#48D3FF',
                    },
                    {
                        label: 'Won',
                        data: @json($monthlyWonLeadsData),
                        backgroundColor: '#7265F9',
                    },
                    {
                        label: 'Lost',
                        data: @json($monthlyLostLeadsData),
                        backgroundColor: '#B965F9',
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                    legend: {
                        display: true,
                        position: 'bottom',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        // max: 100,
                        ticks: {
                            stepSize: 20
                        },
                        grid: {
                            color: '#e0e0e0'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });


        const statusYearlyChart = new Chart(ctx6, {
            type: 'bar',
            data: {
                labels: @json($yearlyLabels),
                datasets: [{
                        label: 'Leads',
                        data: @json($yearlyAllLeadsData),
                        backgroundColor: '#4A58EC',
                    },
                    {
                        label: 'New',
                        data: @json($yearlyNewLeadsData),
                        backgroundColor: '#48D3FF',
                    },
                    {
                        label: 'Won',
                        data: @json($yearlyWonLeadsData),
                        backgroundColor: '#7265F9',
                    },
                    {
                        label: 'Lost',
                        data: @json($yearlyLostLeadsData),
                        backgroundColor: '#B965F9',
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                    legend: {
                        display: true,
                        position: 'bottom',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        // max: 100,
                        ticks: {
                            stepSize: 20
                        },
                        grid: {
                            color: '#e0e0e0'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
    @php
        $sourceColors = ['#4A58EC', '#34C759', '#FF9500', '#FF3B30', '#AF52DE', '#5AC8FA', '#FFCC00'];
        while (count($sourceColors) < $sourceLabels->count()) {
            $sourceColors[] = sprintf('#%06X', mt_rand(0, 0xffffff));
        }
    @endphp
    {{-- chart for sources --}}
    <script>
        const sourceLabels = @json($sourceLabels);
        const weeklySourceData = @json($weeklyData);
        const monthlySourceData = @json($monthlyData);
        const yearlySourceData = @json($yearlyData);
        const sourceColors = @json($sourceColors);

        const ctx7 = document.getElementById('sourcesWeeklyChart').getContext('2d');
        const ctx8 = document.getElementById('sourcesMonthlyChart').getContext('2d');
        const ctx9 = document.getElementById('sourcesYearlyChart').getContext('2d');

        const commonOptions = {
            responsive: true,
            indexAxis: 'y',
            plugins: {
                tooltip: {
                    mode: 'index',
                    intersect: false,
                },
                legend: {
                    display: false,
                    position: 'bottom',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1, // you can adjust this if needed
                    },
                    grid: {
                        color: '#e0e0e0'
                    }
                },
                x: {
                    ticks: {
                        callback: function(value) {
                            return Number.isInteger(value) ? value : '';
                        },
                        precision: 0, // Ensure Chart.js doesn't add decimals
                    },
                    grid: {
                        display: false
                    }
                }
            }
        };


        const sourcesWeeklyChart = new Chart(ctx7, {
            type: 'bar',
            data: {
                labels: sourceLabels,
                datasets: [{
                    label: 'Weekly Leads',
                    data: weeklySourceData,
                    backgroundColor: sourceColors,
                    borderRadius: 20,
                    barThickness: 40,
                }]
            },
            options: commonOptions
        });

        const sourcesMonthlyChart = new Chart(ctx8, {
            type: 'bar',
            data: {
                labels: sourceLabels,
                datasets: [{
                    label: 'Monthly Leads',
                    data: monthlySourceData,
                    backgroundColor: sourceColors,
                    borderRadius: 20,
                    barThickness: 40,
                }]
            },
            options: commonOptions
        });

        const sourcesYearlyChart = new Chart(ctx9, {
            type: 'bar',
            data: {
                labels: sourceLabels,
                datasets: [{
                    label: 'Yearly Leads',
                    data: yearlySourceData,
                    backgroundColor: sourceColors,
                    borderRadius: 20,
                    barThickness: 40,
                }]
            },
            options: commonOptions
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const pipelineChartData = @json($pieChartData);
            const ctx = document.getElementById('pipelinePieChart').getContext('2d');

            const data = {
                labels: pipelineChartData.labels,
                datasets: [{
                    data: pipelineChartData.data,
                    backgroundColor: [
                        '#EF4444',
                        '#60A5FA',
                        '#1D4ED8',
                        '#10B981',
                        '#F59E0B',
                        '#6366F1',
                        '#EC4899'
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            };

            const config = {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed !== null) {
                                        label += context.parsed;
                                    }
                                    return label;
                                }
                            }
                        }
                    }
                }
            };

            const pipelineChart = new Chart(ctx, config);

            const total = data.datasets[0].data.reduce((sum, value) => sum + value, 0);
            document.getElementById('totalPipelines').textContent = total;
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarDays = document.getElementById('calendar-days');
            const calendarMonth = document.getElementById('calendar-month');
            const prevWeekBtn = document.getElementById('prev-week');
            const nextWeekBtn = document.getElementById('next-week');
            const eventList = document.getElementById('event-list');

            let currentDate = new Date();

            function formatDate(date) {
                return date.toISOString().split('T')[0]; // YYYY-MM-DD
            }

            function renderWeek(date) {
                calendarDays.innerHTML = '';

                const startOfWeek = new Date(date);
                startOfWeek.setDate(date.getDate() - date.getDay()); // Sunday

                for (let i = 0; i < 7; i++) {
                    const day = new Date(startOfWeek);
                    day.setDate(startOfWeek.getDate() + i);

                    const dayDiv = document.createElement('div');
                    dayDiv.textContent = day.getDate();
                    dayDiv.dataset.date = formatDate(day);

                    // Highlight today
                    const today = new Date();
                    const isToday =
                        day.getDate() === today.getDate() &&
                        day.getMonth() === today.getMonth() &&
                        day.getFullYear() === today.getFullYear();

                    const isSelected =
                        day.getDate() === currentDate.getDate() &&
                        day.getMonth() === currentDate.getMonth() &&
                        day.getFullYear() === currentDate.getFullYear();

                    if (isToday) {
                        dayDiv.classList.add('today');
                    }
                    if (isSelected) {
                        dayDiv.classList.add('active');
                    }

                    dayDiv.addEventListener('click', function() {
                        document.querySelectorAll('#calendar-days div').forEach(el => el.classList.remove(
                            'active'));
                        this.classList.add('active');
                        fetchEvents(this.dataset.date);
                    });

                    calendarDays.appendChild(dayDiv);
                }

                // Update month heading
                const currentMonthName = startOfWeek.toLocaleString('default', {
                    month: 'long'
                });
                calendarMonth.textContent = `${currentMonthName} ${startOfWeek.getFullYear()}`;
            }

            function fetchEvents(date) {
                console.log(date);
                fetch(`{{ url('get-events') }}/${date}`, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(events => {
                        eventList.innerHTML = '';
                        if (events.length === 0) {
                            eventList.innerHTML = '<li>No events</li>';
                            return;
                        }
                        events.forEach(event => {
                            const li = document.createElement('li');
                            const colorClass = event.is_complete === 1 ? 'red' : 'green';
                            li.innerHTML =
                                `<span class="dot ${colorClass}"></span> ${event.time} – ${event.title}`;
                            eventList.appendChild(li);
                        });
                    })
                    .catch(err => {
                        console.error('Error fetching events', err);
                    });
            }

            prevWeekBtn.addEventListener('click', () => {
                currentDate.setDate(currentDate.getDate() - 7);
                renderWeek(currentDate);
            });

            nextWeekBtn.addEventListener('click', () => {
                currentDate.setDate(currentDate.getDate() + 7);
                renderWeek(currentDate);
            });

            renderWeek(currentDate);
            fetchEvents(formatDate(currentDate));
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.priority-select').on('change', function() {
                var leadId = $(this).data('lead-id');
                var newPriority = $(this).val();

                $.ajax({
                    url: '{{ url('/update-lead-priority') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        lead_id: leadId,
                        priority: newPriority
                    },
                    success: function(response) {
                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            title: 'Priority updated successfully',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            toast: true,
                            icon: 'error',
                            title: 'Failed to update priority',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        });
                    }
                });
            });
        });
    </script>

   
@endsection
