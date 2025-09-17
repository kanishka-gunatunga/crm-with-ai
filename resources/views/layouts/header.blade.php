
 <?php
use App\Models\Configuration;
use App\Models\UserDetails;
$config = Configuration::first();

$user = UserDetails::where('user_id', Auth::id())->first();
?>
<header class="main-header">
        <nav class="mobile-nav">
            <button class="hamburger" id="hamburgerBtn" aria-label="Open sidebar">
                &#9776;
            </button>
            <img src="{{ asset('uploads/'.$config->logo) }}" alt="Infinity CRM Logo" style="height: 40px; margin-right: 10px;">
        </nav>
        <nav class="header-nav">
            <div class="logo-and-search">
            <div class="logo-section" >
                <img src="{{ asset('uploads/'.$config->logo) }}" alt="Infinity CRM Logo" style="height: 40px; margin-right: 10px;">

             </div>
            <div class="search-section">
                <form class="search-form" role="search">
                    <div class="search-input-wrapper">
                        <svg
                            width="15"
                            height="15"
                            viewBox="0 0 15 15"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="search-icon"
                            aria-hidden="true">
                            <path
                                d="M10.5581 10.575L12.4831 12.5M11.875 7.1875C11.875 8.4307 11.3811 9.62298 10.5021 10.5021C9.62299 11.3811 8.4307 11.875 7.1875 11.875C5.9443 11.875 4.75201 11.3811 3.87294 10.5021C2.99386 9.62298 2.5 8.4307 2.5 7.1875C2.5 5.9443 2.99386 4.75201 3.87294 3.87294C4.75201 2.99386 5.9443 2.5 7.1875 2.5C8.4307 2.5 9.62299 2.99386 10.5021 3.87294C11.3811 4.75201 11.875 5.9443 11.875 7.1875Z"
                                stroke="#556476"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <input type="search" placeholder="Search" class="search-input" aria-label="Search">
                    </div>
                </form>
            </div>
            </div>
            <div class="user-actions">
                <div class="notification-wrapper" style="position: relative;">
                <button class="notification-button" aria-label="Notifications" onclick="toggleDropdown('notification-dropdown')" style="background: none; border: none;">
                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 19V10C6 8.4087 6.63214 6.88258 7.75736 5.75736C8.88258 4.63214 10.4087 4 12 4C13.5913 4 15.1174 4.63214 16.2426 5.75736C17.3679 6.88258 18 8.4087 18 10V19M6 19H18M6 19H4M18 19H20M11 22H13" stroke="#556476" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="17.5" cy="5.5" r="3.25" fill="#ED2227" stroke="white" stroke-width="0.5"/>
                    </svg>
                </button>
                <div id="notification-dropdown" class="dropdown-menu" style="display: none; position: absolute; right: 0; top: 35px; background: white; border: 1px solid #ccc; padding: 10px; border-radius: 8px; min-width: 200px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); z-index: 999;">
                    <p>No new notifications</p>
                </div>
                </div>
                
                <div class="user-profile"  onclick="toggleDropdown('user-dropdown')" style="cursor:pointer;">
                    <img
                        src="https://cdn.builder.io/api/v1/image/assets/TEMP/ff47f92652fd0ea04e7b5613333c3cc085fa3036?placeholderIfAbsent=true"
                        alt=""
                        class="user-avatar" />
                    <span class="user-name">{{ $user->name }}</span>
                    
                    <button class="dropdown-button" aria-label="User menu" >
                        <svg
                            width="10"
                            height="10"
                            viewBox="0 0 10 10"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                            class="dropdown-icon"
                            aria-hidden="true">
                            <path
                                fill-rule="evenodd"
                                clip-rule="evenodd"
                                d="M5.29464 6.54464C5.21651 6.62276 5.11055 6.66664 5.00006 6.66664C4.88958 6.66664 4.78361 6.62276 4.70548 6.54464L2.34839 4.18756C2.3086 4.14913 2.27686 4.10315 2.25502 4.05231C2.23318 4.00148 2.22169 3.9468 2.22121 3.89148C2.22073 3.83615 2.23127 3.78129 2.25222 3.73008C2.27317 3.67887 2.30411 3.63235 2.34323 3.59323C2.38235 3.55411 2.42887 3.52317 2.48008 3.50222C2.53129 3.48127 2.58615 3.47073 2.64148 3.47121C2.6968 3.47169 2.75148 3.48318 2.80231 3.50502C2.85315 3.52686 2.89913 3.5586 2.93756 3.59839L5.00006 5.66089L7.06256 3.59839C7.14115 3.5225 7.2464 3.4805 7.35564 3.48145C7.46489 3.4824 7.5694 3.52622 7.64665 3.60347C7.72391 3.68072 7.76773 3.78523 7.76867 3.89448C7.76962 4.00373 7.72763 4.10898 7.65173 4.18756L5.29464 6.54464Z"
                                fill="#556476" />
                        </svg>
                    </button>
                </div>
                <div id="user-dropdown" class="dropdown-menu">
                    <a href="{{ url('edit-user/'.Auth::user()->id) }}" style="display: block; padding: 5px;"><i class="fa-solid fa-user mx-2"></i> Profile</a>
                    
                    <a href="{{ url('logout') }}" style="display: block; padding: 5px;"><i class="fa-solid fa-arrow-right-from-bracket mx-2"></i> Logout</a>
                </div>
            </div>
        </nav>
    </header>