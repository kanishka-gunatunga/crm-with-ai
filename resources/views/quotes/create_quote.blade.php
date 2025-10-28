<?php
use App\Models\UserDetails;

?>

@extends('master')

@section('content')


    <form action="" method="post" enctype="multipart/form-data" data-parsley-validate>
        @csrf

        <div class="d-flex flex-column min-vh-100">
            <div class="flex-grow-1">
                <!-- Scrollable Content -->
                <div class="main-scrollable">
                    <div class="page-container">

                        <div class="page-title-container mb-0">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="page-title">
                                        {{ __('app.quotes.create-title') }}
                                    </h3>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ url('quotes') }}">
                                                    {{ __('app.quotes.title') }}</a>
                                            </li>
                                            <li class="breadcrumb-item active current-breadcrumb" aria-current="page">
                                                {{ __('app.quotes.create-title') }}</li>
                                        </ol>
                                    </nav>
                                </div>




                            </div>

                        </div>
                       
                        <div class="col-12">
                            <div class="card-container">
                                <!-- Basic Details Card -->
                                <div class="card card-default mb-4">

                                    <div class="card-body">
                                        <form>
                                            <div class="row g-4">



                                                @if (auth()->user()->role == 2)


                                                
                                                    <!-- Role 2: Can choose any sales owner -->
                                                    <div class="col-12 col-md-4">
                                                        <label for="assign_user" class="form-label">Sales Owner</label>
                                                        <select class="myDropdown form-control" name="sales_owner"
                                                            data-parsley-errors-container="#owner-errors" required>
                                                            {{-- <option value="" selected disabled>Select Sales Owner
                                                            </option> --}}
                                                            @foreach ($owners as $owner)
                                                                <option value="{{ $owner->user_id }}">{{ $owner->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        
                                                        <div id="owner-errors"></div>
                                                      
                                                        {{-- <input type="hidden" name="sales_owner"
                                                            value=" {{$owner->id}}"> --}}
                                                           
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <label for="assign_user"
                                                            class="form-label">{{ __('app.quotes.lead') }}</label>
                                                        <select class="myDropdown form-control" name="lead"
                                                            data-parsley-errors-container="#lead-errors" required>
                                                            <option value="" selected disabled>Select Lead</option>
                                                            {{-- Leads will be filled by AJAX after selecting owner --}}
                                                        </select>
                                                        <div id="lead-errors"></div>
                                                    </div>
                                                @elseif (auth()->user()->role == 3)
                                                    
                                                    <div class="col-12 col-md-4">
                                                        <label for="assign_user" class="form-label">Sales Owner</label>
                                                        <select class="form-control" name="sales_owner" required selected>
                                                            <option value="{{ $authenticatedUser->user_id }}" selected>
                                                                {{ $authenticatedUser->name }}
                                                            </option>
                                                        </select>
                                                       {{-- {{ $authenticatedUser->user_id }} --}}
                                                                {{-- <option value="{{ $authenticatedUser->id }}"
                                                                    {{ auth()->user()->id == $authenticatedUser->id ? 'selected' : '' }}>
                                                                    {{ $authenticatedUser->name }}

                                                                </option> --}}
                                                            

                                                            
                                                        {{-- </select> --}}
                                                        
                                                        {{-- <input type="hidden" name="sales_owner"
                                                            value=" {{$owner->id}}"> --}}

                                                            
                                                            
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <label for="assign_user"
                                                            class="form-label">{{ __('app.quotes.lead') }}</label>
                                                        <select id="leadDropdown" class="myDropdown form-control"
                                                            name="lead" data-parsley-errors-container="#lead-errors"
                                                            required>
                                                            <option value="" selected disabled>Select Lead</option>
                                                            @foreach ($leads as $lead)
                                                                <option value="{{ $lead->id }}">
                                                                    {{ $lead->title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div id="lead-errors"></div>
                                                    </div>
                                                @endif






                                                {{-- <div class="col-12 col-md-4">
                                                    <label for="assign_user" class="form-label">Sales Owner</label>
                                                    <select class="myDropdown form-control" name="owner"
                                                        data-parsley-errors-container="#owner-errors" required>
                                                        <option selected=""></option>
                                                        <?php foreach($owners as $owner){ ?>
                                                        <option value="{{ $owner->user_id }}">{{ $owner->name }}</option>
                                                        <?php } ?>
                                                    </select>
                                                    <div id="owner-errors"></div>
                                                </div>

                                                <div class="col-12 col-md-4">
                                                    <label for="assign_user"
                                                        class="form-label">{{ __('app.quotes.lead') }}</label>
                                                    <select class="myDropdown form-control " name="lead"
                                                        data-parsley-errors-container="#lead-errors" required>
                                                        <option selected=""></option>
                                                        <?php foreach($leads as $lead){ ?>
                                                        <option value="{{ $lead->id }}">{{ $lead->title }}</option>
                                                        <?php } ?>
                                                    </select>
                                                    <div id="lead-errors"></div>
                                                </div> --}}



                                                <div class="col-12 col-md-4">
                                                    <label for="assign_user" class="form-label">Subject</label>
                                                    <input type="text" class="form-control" name="subject"
                                                        value="{{ old('subject') }}" required>
                                                    @if ($errors->has('subject'))
                                                        <div class="alert alert-danger mt-2">
                                                            {{ $errors->first('subject') }}
                                                            </li>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="expired_at" class="form-label">Expired At</label>
                                                    <div class="input-group">
                                                        <input type="date" class="form-control" id="expired_at"
                                                            placeholder="Expired At" name="expired_at"
                                                            value="{{ old('expired_at') }}"
                                                            data-parsley-errors-container="#expired-at-errors" required>

                                                    </div>
                                                    <div id="expired-at-errors"></div>
                                                </div>
                                                <div class="col-12 col-md-4 selection-div">
                                                    <label for="terms" class="form-label">Person</label>
                                                    <select class="myDropdown form-control" name="person"
                                                        data-parsley-errors-container="#person-errors" required>
                                                        <option selected=""></option>
                                                        <?php foreach($persons as $person){ ?>
                                                        <option value="{{ $person->id }}">{{ $person->name }}</option>
                                                        <?php } ?>
                                                    </select>
                                                    <div id="person-errors"></div>
                                                </div>

                                                <div class="col-12 col-md-4">
                                                    <label for="date_start" class="form-label"
                                                        name="description">Description</label>
                                                    <input type="text" class="form-control" id="date_start"
                                                        placeholder="Description">
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Billing Address Card -->
                                <div class="card card-default mb-4">

                                    <div class="card-body">
                                        <h5 class="mb-3 card-title">Billing Address</h5>
                                        <div class="row g-4">
                                            <div class="col-12 col-md-4">
                                                <label for="No" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="No"
                                                    placeholder="No" name="address" required>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="Province" class="form-label">Province</label>
                                                <input type="text" class="form-control" id="Province"
                                                    placeholder="Province" name="state" required>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="assign_user" class="form-label">Country</label>
                                                <select class="myDropdown form-control" name="country"
                                                    data-parsley-errors-container="#country-errors" required>
                                                    <option selected=""></option>
                                                    <option value="Sri Lanka">Sri Lanka</option>


                                                    <option value="Afghanistan">Afghanistan</option>
                                                    <option value="Albania">Albania</option>
                                                    <option value="Algeria">Algeria</option>
                                                    <option value="Andorra">Andorra</option>
                                                    <option value="Angola">Angola</option>
                                                    <option value="Antigua&Deps">Antigua & Deps</option>
                                                    <option value="Argentina">Argentina</option>
                                                    <option value="Armenia">Armenia</option>
                                                    <option value="Australia">Australia</option>
                                                    <option value="Austria">Austria</option>
                                                    <option value="Azerbaijan">Azerbaijan</option>
                                                    <option value="Bahamas">Bahamas</option>
                                                    <option value="Bahrain">Bahrain</option>
                                                    <option value="Bangladesh">Bangladesh</option>
                                                    <option value="Barbados">Barbados</option>
                                                    <option value="Belarus">Belarus</option>
                                                    <option value="Belgium">Belgium</option>
                                                    <option value="Belize">Belize</option>
                                                    <option value="Benin">Benin</option>
                                                    <option value="Bermuda">Bermuda</option>
                                                    <option value="Bhutan">Bhutan</option>
                                                    <option value="Bolivia">Bolivia</option>
                                                    <option value="BosniaHerzegovina">Bosnia & Herzegovina</option>
                                                    <option value="Botswana">Botswana</option>
                                                    <option value="Brazil">Brazil</option>
                                                    <option value="Brunei">Brunei</option>
                                                    <option value="Bulgaria">Bulgaria</option>
                                                    <option value="Burkina">Burkina</option>
                                                    <option value="Burundi">Burundi</option>
                                                    <option value="Cambodia">Cambodia</option>
                                                    <option value="Cameroon">Cameroon</option>
                                                    <option value="Canada">Canada</option>
                                                    <option value="CapeVerde">Cape Verde</option>
                                                    <option value="CentralAfricanRep">Central African Rep</option>
                                                    <option value="Chad">Chad</option>
                                                    <option value="Chile">Chile</option>
                                                    <option value="China">China</option>
                                                    <option value="Colombia">Colombia</option>
                                                    <option value="Comoros">Comoros</option>
                                                    <option value="Congo">Congo</option>
                                                    <option value="Congo(DemocraticRep)">Congo (Democratic Rep)</option>
                                                    <option value="CostaRica">Costa Rica</option>
                                                    <option value="Croatia">Croatia</option>
                                                    <option value="Cuba">Cuba</option>
                                                    <option value="Cyprus">Cyprus</option>
                                                    <option value="CzechRepublic">Czech Republic</option>
                                                    <option value="Denmark">Denmark</option>
                                                    <option value="Djibouti">Djibouti</option>
                                                    <option value="Dominica">Dominica</option>
                                                    <option value="DominicanRepublic">Dominican Republic</option>
                                                    <option value="EastTimor">East Timor</option>
                                                    <option value="Ecuador">Ecuador</option>
                                                    <option value="Egypt">Egypt</option>
                                                    <option value="ElSalvador">El Salvador</option>
                                                    <option value="EquatorialGuinea">Equatorial Guinea</option>
                                                    <option value="Eritrea">Eritrea</option>
                                                    <option value="Estonia">Estonia</option>
                                                    <option value="Eswatini">Eswatini</option>
                                                    <option value="Ethiopia">Ethiopia</option>
                                                    <option value="Fiji">Fiji</option>
                                                    <option value="Finland">Finland</option>
                                                    <option value="France">France</option>
                                                    <option value="Gabon">Gabon</option>
                                                    <option value="Gambia">Gambia</option>
                                                    <option value="Georgia">Georgia</option>
                                                    <option value="Germany">Germany</option>
                                                    <option value="Ghana">Ghana</option>
                                                    <option value="Greece">Greece</option>
                                                    <option value="Grenada">Grenada</option>
                                                    <option value="Guatemala">Guatemala</option>
                                                    <option value="Guinea">Guinea</option>
                                                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                    <option value="Guyana">Guyana</option>
                                                    <option value="Haiti">Haiti</option>
                                                    <option value="Honduras">Honduras</option>
                                                    <option value="Hungary">Hungary</option>
                                                    <option value="Iceland">Iceland</option>
                                                    <option value="India">India</option>
                                                    <option value="Indonesia">Indonesia</option>
                                                    <option value="Iran">Iran</option>
                                                    <option value="Iraq">Iraq</option>
                                                    <option value="Ireland(Republic)">Ireland (Republic)</option>
                                                    <option value="Israel">Israel</option>
                                                    <option value="Italy">Italy</option>
                                                    <option value="IvoryCoast">Ivory Coast</option>
                                                    <option value="Jamaica">Jamaica</option>
                                                    <option value="Japan">Japan</option>
                                                    <option value="Jordan">Jordan</option>
                                                    <option value="Kazakhstan">Kazakhstan</option>
                                                    <option value="Kenya">Kenya</option>
                                                    <option value="Kiribati">Kiribati</option>
                                                    <option value="KoreaNorth">Korea North</option>
                                                    <option value="KoreaSouth">Korea South</option>
                                                    <option value="Kosovo">Kosovo</option>
                                                    <option value="Kuwait">Kuwait</option>
                                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                    <option value="Laos">Laos</option>
                                                    <option value="Latvia">Latvia</option>
                                                    <option value="Lebanon">Lebanon</option>
                                                    <option value="Lesotho">Lesotho</option>
                                                    <option value="Liberia">Liberia</option>
                                                    <option value="Libya">Libya</option>
                                                    <option value="Liechtenstein">Liechtenstein</option>
                                                    <option value="Lithuania">Lithuania</option>
                                                    <option value="Luxembourg">Luxembourg</option>
                                                    <option value="Macedonia">Macedonia</option>
                                                    <option value="Madagascar">Madagascar</option>
                                                    <option value="Malawi">Malawi</option>
                                                    <option value="Malaysia">Malaysia</option>
                                                    <option value="Maldives">Maldives</option>
                                                    <option value="Mali">Mali</option>
                                                    <option value="Malta">Malta</option>
                                                    <option value="MarshallIslands">Marshall Islands</option>
                                                    <option value="Mauritania">Mauritania</option>
                                                    <option value="Mauritius">Mauritius</option>
                                                    <option value="Mexico">Mexico</option>
                                                    <option value="Micronesia">Micronesia</option>
                                                    <option value="Moldova">Moldova</option>
                                                    <option value="Monaco">Monaco</option>
                                                    <option value="Mongolia">Mongolia</option>
                                                    <option value="Montenegro">Montenegro</option>
                                                    <option value="Morocco">Morocco</option>
                                                    <option value="Mozambique">Mozambique</option>
                                                    <option value="Myanmar">Myanmar</option>
                                                    <option value="Namibia">Namibia</option>
                                                    <option value="Nauru">Nauru</option>
                                                    <option value="Nepal">Nepal</option>
                                                    <option value="Netherlands">Netherlands</option>
                                                    <option value="NewZealand">New Zealand</option>
                                                    <option value="Nicaragua">Nicaragua</option>
                                                    <option value="Niger">Niger</option>
                                                    <option value="Nigeria">Nigeria</option>
                                                    <option value="Norway">Norway</option>
                                                    <option value="Oman">Oman</option>
                                                    <option value="Pakistan">Pakistan</option>
                                                    <option value="Palau">Palau</option>
                                                    <option value="Palestine">Palestine</option>
                                                    <option value="Panama">Panama</option>
                                                    <option value="PapuaNewGuinea">Papua New Guinea</option>
                                                    <option value="Paraguay">Paraguay</option>
                                                    <option value="Peru">Peru</option>
                                                    <option value="Philippines">Philippines</option>
                                                    <option value="Poland">Poland</option>
                                                    <option value="Portugal">Portugal</option>
                                                    <option value="Qatar">Qatar</option>
                                                    <option value="Romania">Romania</option>
                                                    <option value="RussianFederation">Russian Federation</option>
                                                    <option value="Rwanda">Rwanda</option>
                                                    <option value="StKitts&Nevis">St Kitts & Nevis</option>
                                                    <option value="StLucia">St Lucia</option>
                                                    <option value="SaintVincent&theGrenadines">Saint Vincent & the
                                                        Grenadines</option>
                                                    <option value="Samoa">Samoa</option>
                                                    <option value="SanMarino">San Marino</option>
                                                    <option value="SaoTome&Principe">Sao Tome & Principe</option>
                                                    <option value="SaudiArabia">Saudi Arabia</option>
                                                    <option value="Senegal">Senegal</option>
                                                    <option value="Serbia">Serbia</option>
                                                    <option value="Seychelles">Seychelles</option>
                                                    <option value="SierraLeone">Sierra Leone</option>
                                                    <option value="Singapore">Singapore</option>
                                                    <option value="Slovakia">Slovakia</option>
                                                    <option value="Slovenia">Slovenia</option>
                                                    <option value="SolomonIslands">Solomon Islands</option>
                                                    <option value="Somalia">Somalia</option>
                                                    <option value="SouthAfrica">South Africa</option>
                                                    <option value="SouthSudan">South Sudan</option>
                                                    <option value="Spain">Spain</option>
                                                    <option value="Sudan">Sudan</option>
                                                    <option value="Suriname">Suriname</option>
                                                    <option value="Sweden">Sweden</option>
                                                    <option value="Switzerland">Switzerland</option>
                                                    <option value="Syria">Syria</option>
                                                    <option value="Taiwan">Taiwan</option>
                                                    <option value="Tajikistan">Tajikistan</option>
                                                    <option value="Tanzania">Tanzania</option>
                                                    <option value="Thailand">Thailand</option>
                                                    <option value="Togo">Togo</option>
                                                    <option value="Tonga">Tonga</option>
                                                    <option value="Trinidad&Tobago">Trinidad & Tobago</option>
                                                    <option value="Tunisia">Tunisia</option>
                                                    <option value="Turkey">Turkey</option>
                                                    <option value="Turkmenistan">Turkmenistan</option>
                                                    <option value="Tuvalu">Tuvalu</option>
                                                    <option value="Uganda">Uganda</option>
                                                    <option value="Ukraine">Ukraine</option>
                                                    <option value="UnitedArabEmirates">United Arab Emirates</option>
                                                    <option value="UnitedKingdom">United Kingdom</option>
                                                    <option value="UnitedStates">United States</option>
                                                    <option value="Uruguay">Uruguay</option>
                                                    <option value="Uzbekistan">Uzbekistan</option>
                                                    <option value="Vanuatu">Vanuatu</option>
                                                    <option value="VaticanCity">Vatican City</option>
                                                    <option value="Venezuela">Venezuela</option>
                                                    <option value="Vietnam">Vietnam</option>
                                                    <option value="Yemen">Yemen</option>
                                                    <option value="Zambia">Zambia</option>
                                                    <option value="Zimbabwe">Zimbabwe</option>
                                                </select>
                                                <div id="country-errors"></div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="City" class="form-label">City</label>
                                                <input type="text" class="form-control" id="City" name="city"
                                                    placeholder="City" value="" required>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="Postal Code" class="form-label">Postal Code</label>
                                                <input type="text" class="form-control" id="Postal Code"
                                                    name="post_code" placeholder="Post Code" value="" required>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Shipping Address Card -->
                                <div class="card card-default mb-4">

                                    <div class="card-body">
                                        <h5 class="mb-3 card-title">Shipping Address</h5>
                                        <div class="row g-4">
                                            <div class="col-12 col-md-4">
                                                <label for="No" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="No"
                                                    placeholder="No" name="shipping_address" required>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="Province" class="form-label">Province</label>
                                                <input type="text" class="form-control" id="Province"
                                                    placeholder="Province" name="shipping_state" required>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="assign_user" class="form-label">Country</label>
                                                <select class="myDropdown form-control" name="shipping_country"
                                                    data-parsley-errors-container="#shipping-country-errors" required>
                                                    <option selected=""></option>
                                                    <option value="Sri Lanka">Sri Lanka</option>


                                                    <option value="Afghanistan">Afghanistan</option>
                                                    <option value="Albania">Albania</option>
                                                    <option value="Algeria">Algeria</option>
                                                    <option value="Andorra">Andorra</option>
                                                    <option value="Angola">Angola</option>
                                                    <option value="Antigua&Deps">Antigua & Deps</option>
                                                    <option value="Argentina">Argentina</option>
                                                    <option value="Armenia">Armenia</option>
                                                    <option value="Australia">Australia</option>
                                                    <option value="Austria">Austria</option>
                                                    <option value="Azerbaijan">Azerbaijan</option>
                                                    <option value="Bahamas">Bahamas</option>
                                                    <option value="Bahrain">Bahrain</option>
                                                    <option value="Bangladesh">Bangladesh</option>
                                                    <option value="Barbados">Barbados</option>
                                                    <option value="Belarus">Belarus</option>
                                                    <option value="Belgium">Belgium</option>
                                                    <option value="Belize">Belize</option>
                                                    <option value="Benin">Benin</option>
                                                    <option value="Bermuda">Bermuda</option>
                                                    <option value="Bhutan">Bhutan</option>
                                                    <option value="Bolivia">Bolivia</option>
                                                    <option value="BosniaHerzegovina">Bosnia & Herzegovina</option>
                                                    <option value="Botswana">Botswana</option>
                                                    <option value="Brazil">Brazil</option>
                                                    <option value="Brunei">Brunei</option>
                                                    <option value="Bulgaria">Bulgaria</option>
                                                    <option value="Burkina">Burkina</option>
                                                    <option value="Burundi">Burundi</option>
                                                    <option value="Cambodia">Cambodia</option>
                                                    <option value="Cameroon">Cameroon</option>
                                                    <option value="Canada">Canada</option>
                                                    <option value="CapeVerde">Cape Verde</option>
                                                    <option value="CentralAfricanRep">Central African Rep</option>
                                                    <option value="Chad">Chad</option>
                                                    <option value="Chile">Chile</option>
                                                    <option value="China">China</option>
                                                    <option value="Colombia">Colombia</option>
                                                    <option value="Comoros">Comoros</option>
                                                    <option value="Congo">Congo</option>
                                                    <option value="Congo(DemocraticRep)">Congo (Democratic Rep)</option>
                                                    <option value="CostaRica">Costa Rica</option>
                                                    <option value="Croatia">Croatia</option>
                                                    <option value="Cuba">Cuba</option>
                                                    <option value="Cyprus">Cyprus</option>
                                                    <option value="CzechRepublic">Czech Republic</option>
                                                    <option value="Denmark">Denmark</option>
                                                    <option value="Djibouti">Djibouti</option>
                                                    <option value="Dominica">Dominica</option>
                                                    <option value="DominicanRepublic">Dominican Republic</option>
                                                    <option value="EastTimor">East Timor</option>
                                                    <option value="Ecuador">Ecuador</option>
                                                    <option value="Egypt">Egypt</option>
                                                    <option value="ElSalvador">El Salvador</option>
                                                    <option value="EquatorialGuinea">Equatorial Guinea</option>
                                                    <option value="Eritrea">Eritrea</option>
                                                    <option value="Estonia">Estonia</option>
                                                    <option value="Eswatini">Eswatini</option>
                                                    <option value="Ethiopia">Ethiopia</option>
                                                    <option value="Fiji">Fiji</option>
                                                    <option value="Finland">Finland</option>
                                                    <option value="France">France</option>
                                                    <option value="Gabon">Gabon</option>
                                                    <option value="Gambia">Gambia</option>
                                                    <option value="Georgia">Georgia</option>
                                                    <option value="Germany">Germany</option>
                                                    <option value="Ghana">Ghana</option>
                                                    <option value="Greece">Greece</option>
                                                    <option value="Grenada">Grenada</option>
                                                    <option value="Guatemala">Guatemala</option>
                                                    <option value="Guinea">Guinea</option>
                                                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                    <option value="Guyana">Guyana</option>
                                                    <option value="Haiti">Haiti</option>
                                                    <option value="Honduras">Honduras</option>
                                                    <option value="Hungary">Hungary</option>
                                                    <option value="Iceland">Iceland</option>
                                                    <option value="India">India</option>
                                                    <option value="Indonesia">Indonesia</option>
                                                    <option value="Iran">Iran</option>
                                                    <option value="Iraq">Iraq</option>
                                                    <option value="Ireland(Republic)">Ireland (Republic)</option>
                                                    <option value="Israel">Israel</option>
                                                    <option value="Italy">Italy</option>
                                                    <option value="IvoryCoast">Ivory Coast</option>
                                                    <option value="Jamaica">Jamaica</option>
                                                    <option value="Japan">Japan</option>
                                                    <option value="Jordan">Jordan</option>
                                                    <option value="Kazakhstan">Kazakhstan</option>
                                                    <option value="Kenya">Kenya</option>
                                                    <option value="Kiribati">Kiribati</option>
                                                    <option value="KoreaNorth">Korea North</option>
                                                    <option value="KoreaSouth">Korea South</option>
                                                    <option value="Kosovo">Kosovo</option>
                                                    <option value="Kuwait">Kuwait</option>
                                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                    <option value="Laos">Laos</option>
                                                    <option value="Latvia">Latvia</option>
                                                    <option value="Lebanon">Lebanon</option>
                                                    <option value="Lesotho">Lesotho</option>
                                                    <option value="Liberia">Liberia</option>
                                                    <option value="Libya">Libya</option>
                                                    <option value="Liechtenstein">Liechtenstein</option>
                                                    <option value="Lithuania">Lithuania</option>
                                                    <option value="Luxembourg">Luxembourg</option>
                                                    <option value="Macedonia">Macedonia</option>
                                                    <option value="Madagascar">Madagascar</option>
                                                    <option value="Malawi">Malawi</option>
                                                    <option value="Malaysia">Malaysia</option>
                                                    <option value="Maldives">Maldives</option>
                                                    <option value="Mali">Mali</option>
                                                    <option value="Malta">Malta</option>
                                                    <option value="MarshallIslands">Marshall Islands</option>
                                                    <option value="Mauritania">Mauritania</option>
                                                    <option value="Mauritius">Mauritius</option>
                                                    <option value="Mexico">Mexico</option>
                                                    <option value="Micronesia">Micronesia</option>
                                                    <option value="Moldova">Moldova</option>
                                                    <option value="Monaco">Monaco</option>
                                                    <option value="Mongolia">Mongolia</option>
                                                    <option value="Montenegro">Montenegro</option>
                                                    <option value="Morocco">Morocco</option>
                                                    <option value="Mozambique">Mozambique</option>
                                                    <option value="Myanmar">Myanmar</option>
                                                    <option value="Namibia">Namibia</option>
                                                    <option value="Nauru">Nauru</option>
                                                    <option value="Nepal">Nepal</option>
                                                    <option value="Netherlands">Netherlands</option>
                                                    <option value="NewZealand">New Zealand</option>
                                                    <option value="Nicaragua">Nicaragua</option>
                                                    <option value="Niger">Niger</option>
                                                    <option value="Nigeria">Nigeria</option>
                                                    <option value="Norway">Norway</option>
                                                    <option value="Oman">Oman</option>
                                                    <option value="Pakistan">Pakistan</option>
                                                    <option value="Palau">Palau</option>
                                                    <option value="Palestine">Palestine</option>
                                                    <option value="Panama">Panama</option>
                                                    <option value="PapuaNewGuinea">Papua New Guinea</option>
                                                    <option value="Paraguay">Paraguay</option>
                                                    <option value="Peru">Peru</option>
                                                    <option value="Philippines">Philippines</option>
                                                    <option value="Poland">Poland</option>
                                                    <option value="Portugal">Portugal</option>
                                                    <option value="Qatar">Qatar</option>
                                                    <option value="Romania">Romania</option>
                                                    <option value="RussianFederation">Russian Federation</option>
                                                    <option value="Rwanda">Rwanda</option>
                                                    <option value="StKitts&Nevis">St Kitts & Nevis</option>
                                                    <option value="StLucia">St Lucia</option>
                                                    <option value="SaintVincent&theGrenadines">Saint Vincent & the
                                                        Grenadines</option>
                                                    <option value="Samoa">Samoa</option>
                                                    <option value="SanMarino">San Marino</option>
                                                    <option value="SaoTome&Principe">Sao Tome & Principe</option>
                                                    <option value="SaudiArabia">Saudi Arabia</option>
                                                    <option value="Senegal">Senegal</option>
                                                    <option value="Serbia">Serbia</option>
                                                    <option value="Seychelles">Seychelles</option>
                                                    <option value="SierraLeone">Sierra Leone</option>
                                                    <option value="Singapore">Singapore</option>
                                                    <option value="Slovakia">Slovakia</option>
                                                    <option value="Slovenia">Slovenia</option>
                                                    <option value="SolomonIslands">Solomon Islands</option>
                                                    <option value="Somalia">Somalia</option>
                                                    <option value="SouthAfrica">South Africa</option>
                                                    <option value="SouthSudan">South Sudan</option>
                                                    <option value="Spain">Spain</option>
                                                    <option value="Sudan">Sudan</option>
                                                    <option value="Suriname">Suriname</option>
                                                    <option value="Sweden">Sweden</option>
                                                    <option value="Switzerland">Switzerland</option>
                                                    <option value="Syria">Syria</option>
                                                    <option value="Taiwan">Taiwan</option>
                                                    <option value="Tajikistan">Tajikistan</option>
                                                    <option value="Tanzania">Tanzania</option>
                                                    <option value="Thailand">Thailand</option>
                                                    <option value="Togo">Togo</option>
                                                    <option value="Tonga">Tonga</option>
                                                    <option value="Trinidad&Tobago">Trinidad & Tobago</option>
                                                    <option value="Tunisia">Tunisia</option>
                                                    <option value="Turkey">Turkey</option>
                                                    <option value="Turkmenistan">Turkmenistan</option>
                                                    <option value="Tuvalu">Tuvalu</option>
                                                    <option value="Uganda">Uganda</option>
                                                    <option value="Ukraine">Ukraine</option>
                                                    <option value="UnitedArabEmirates">United Arab Emirates</option>
                                                    <option value="UnitedKingdom">United Kingdom</option>
                                                    <option value="UnitedStates">United States</option>
                                                    <option value="Uruguay">Uruguay</option>
                                                    <option value="Uzbekistan">Uzbekistan</option>
                                                    <option value="Vanuatu">Vanuatu</option>
                                                    <option value="VaticanCity">Vatican City</option>
                                                    <option value="Venezuela">Venezuela</option>
                                                    <option value="Vietnam">Vietnam</option>
                                                    <option value="Yemen">Yemen</option>
                                                    <option value="Zambia">Zambia</option>
                                                    <option value="Zimbabwe">Zimbabwe</option>
                                                </select>
                                                <div id="shipping-country-errors"></div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="City" class="form-label">City</label>
                                                <input type="text" class="form-control" id="City"
                                                    name="shipping_city" placeholder="City" value="" required>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label for="Postal Code" class="form-label">Postal Code</label>
                                                <input type="text" class="form-control" id="Postal Code"
                                                    name="shipping_post_code" placeholder="Post Code" value=""
                                                    required>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card card-default">
                                    <div class="card-body">
                                        <div class="row g-4">
                                            <div class="table-responsive">
                                                <div class="d-flex justify-content-between align-items-center mb-5">
                                                    <h5 class="card-title">{{ __('app.quotes.quote-items') }}</h5>
                                                    <button class="create-btn" type="button" id="add-product">
                                                        <div class="icon-container">
                                                            <svg width="20" height="20" viewBox="0 0 20 20"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.625 9.375H4.5V8.625H8.625V4.5H9.375V8.625H13.5V9.375H9.375V13.5H8.625V9.375Z"
                                                                    fill="white" />
                                                            </svg>

                                                        </div>
                                                        <span class="button-text">{{ __('app.common.add_more') }}</span>
                                                    </button>

                                                </div>
                                                <table class="table new-table">
                                                    <thead>
                                                        <tr>

                                                            <th class="corner-left" style="width:400px;">Name</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <th>Amount</th>
                                                            <th>Discount (%)</th>
                                                            <th>Tax (%)</th>
                                                            <th>Total</th>

                                                            <th class="corner-right">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="products-tbody">

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="6" style="text-align:right">
                                                                {{ __('app.quotes.sub-total') }}</th>
                                                            <th id="sub-total"></th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="6" style="text-align:right">
                                                                {{ __('app.quotes.discount') }} -</th>
                                                            <th id="discount-total"></th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="6" style="text-align:right">
                                                                {{ __('app.quotes.tax') }} +</th>
                                                            <th id="tax-total"></th>
                                                        </tr>

                                                        <tr>
                                                            <th colspan="6" style="text-align:right">
                                                                {{ __('app.quotes.total') }}</th>
                                                            <th id="order-total"></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                        </div>

                                        <input type="hidden" class="form-control" name="discount_total_amount"
                                            id="discount_total_amount" readonly value="0">
                                        <input type="hidden" class="form-control" name="tax_total_amount"
                                            id="tax_total_amount" readonly value="0">
                                        <input type="hidden" class="form-control" name="order_total_input"
                                            id="order_total_input" readonly value="0">
                                    </div>
                                </div>


                            </div>

                        </div>


                    </div>
                </div>
            </div>
            <div class="col-12 action-bar">
                <div class="d-flex gap-2 justify-content-between">
                    <div>
                        <a href=""><button type="button" class="btn clear-all-btn">Clear
                                All</button></a>
                    </div>
                    <div>
                        <button type="submit" class="btn save-btn" id="saveBtn">Save</button>
                        <a href="{{ url('quotes') }}"><button type="button" class="btn cancel-btn">Cancel</button></a>
                    </div>

                </div>

            </div>
        </div>
    </form>
    <!-- Bottom Action Buttons -->

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
    </script>
<script>
    $(document).ready(function() {
        const addProductBtn = document.getElementById('add-product');

        // Object to store product quantities from the database.
        let productStock = {}; 

        // Populate productStock from your backend
        const productData = <?php echo json_encode($products); ?>;
        const serviceData = <?php echo json_encode($services); ?>;
        
        productData.forEach(product => {
            productStock['product||' + product.id] = product.quantity;
        });

        serviceData.forEach(service => {
            productStock['service||' + service.id] = service.quantity;
        });

        function initializeSelect2() {
            // Destroy existing Select2 instances before reinitializing
            $(".product-select").each(function() {
                if ($(this).hasClass("select2-hidden-accessible")) {
                    $(this).select2('destroy');
                }
            });
            
            $(".product-select").select2({
                placeholder: "Select a product",
                allowClear: true
            }).off('change').on('change', function() {
                let row = $(this).closest('tr');
                let price = $(this).find(':selected').data('price');
                row.find('input[name="price[]"]').val(price);
                
                // Trigger calculation for the row
                calculateRow(row);
                
                // Validate after selection
                validateQuantities();
            });
        }

        initializeSelect2();

        function calculateRow(row) {
            let quantity = parseFloat(row.find('input[name="quantity[]"]').val()) || 0;
            let price = parseFloat(row.find('input[name="price[]"]').val()) || 0;
            let discount = parseFloat(row.find('input[name="discount[]"]').val()) || 0;
            let tax = parseFloat(row.find('input[name="tax[]"]').val()) || 0;

            let amount = quantity * price;
            let discountAmount = (amount * discount) / 100;
            let taxableAmount = amount - discountAmount;
            let taxAmount = (taxableAmount * tax) / 100;
            let total = taxableAmount + taxAmount;

            row.find('input[name="amount[]"]').val(amount.toFixed(2));
            row.find('input[name="total[]"]').val(total.toFixed(2));

            updateTotals();
            validateQuantities();
        }

        function updateTotals() {
            let subtotal = 0,
                totalDiscount = 0,
                totalTax = 0,
                grandTotal = 0;

            $('#products-tbody tr').each(function() {
                let amount = parseFloat($(this).find('input[name="amount[]"]').val()) || 0;
                let discount = parseFloat($(this).find('input[name="discount[]"]').val()) || 0;
                let tax = parseFloat($(this).find('input[name="tax[]"]').val()) || 0;
                let total = parseFloat($(this).find('input[name="total[]"]').val()) || 0;

                subtotal += amount;
                totalDiscount += (amount * discount) / 100;
                totalTax += ((amount - (amount * discount) / 100) * tax) / 100;
                grandTotal += total;
            });

            $('#sub-total').text(subtotal.toFixed(2));
            $('#discount-total').text(totalDiscount.toFixed(2));
            $('#discount_total_amount').val(totalDiscount.toFixed(2));
            $('#tax-total').text(totalTax.toFixed(2));
            $('#tax_total_amount').val(totalTax.toFixed(2));
            $('#order-total').text(grandTotal.toFixed(2));
            $('#order_total_input').val(grandTotal.toFixed(2));
        }

        function validateQuantities() {
            let isValid = true;
            $('#products-tbody tr').each(function() {
                const row = $(this);
                const productId = row.find('.product-select').val();
                const quantityInput = row.find('input[name="quantity[]"]');
                const requestedQuantity = parseFloat(quantityInput.val());
                const availableStock = productStock[productId];
                
                if (productId && !isNaN(requestedQuantity)) {
                    if (requestedQuantity > availableStock) {
                        isValid = false;
                        quantityInput.addClass('is-invalid');
                    } else {
                        quantityInput.removeClass('is-invalid');
                    }
                }
            });

            $('#saveBtn').prop('disabled', !isValid);
        }

        // Event listener for quantity and other inputs - using event delegation
        $('#products-tbody').on('input',
            'input[name="quantity[]"], input[name="price[]"], input[name="discount[]"], input[name="tax[]"]',
            function() {
                calculateRow($(this).closest('tr'));
            });

        // Event listener for removing a product row
        $('#products-tbody').on('click', '.remove-product', function() {
            $(this).closest('tr').remove();
            updateTotals();
            validateQuantities();
        });

        // Event listener for adding a new product row
        if (addProductBtn) {
            addProductBtn.addEventListener('click', function() {
                console.log("Add product button clicked");
                let newRow = `
                    <tr>
                        <td>
                            <select class="form-control product-select" name="products[]" required>
                                <option hidden selected></option>
                                <?php foreach($products as $product){ ?>
                                <option value="product||<?php echo $product->id; ?>" data-price="<?php echo $product->cost; ?>"><?php echo $product->name; ?></option>
                                <?php } ?>
                                <?php foreach($services as $service){ ?>
                                <option value="service||<?php echo $service->id; ?>" data-price="<?php echo $service->cost; ?>"><?php echo $service->name; ?></option>
                                <?php } ?>
                            </select>
                            <textarea class="form-control w-100 mt-2" rows="3" name="note[]" placeholder="Notes"></textarea>
                        </td>
                        <td><input type="number" step="any" class="form-control" name="quantity[]" value="0" required></td>
                        <td><input type="number" step="any" class="form-control" name="price[]" value="0" required></td>
                        <td><input type="number" step="any" class="form-control" name="amount[]" value="0" readonly required></td>
                        <td><input type="number" step="any" class="form-control" name="discount[]" value="0"></td>
                        <td><input type="number" step="any" class="form-control" name="tax[]" value="0"></td>
                        <td><input type="number" step="any" class="form-control" name="total[]" value="0" readonly></td>
                        <td><i class="fa-solid fa-trash remove-product remove-append-item mx-2" style="cursor: pointer;"></i></td>
                    </tr>
                `;
                $('#products-tbody').append(newRow);
                
                // Reinitialize Select2 for the new row
                initializeSelect2();
                
                // Update totals after adding a new row
                updateTotals();
            });
        }
        
        // Initial validation on page load
        validateQuantities();
    });
</script>

    <script>
        $(document).ready(function() {
            let userRole = "{{ auth()->user()->role }}";
            let userId = "{{ auth()->user()->id }}";

            console.log("User Role:", userRole);
            console.log("User ID:", userId);

            function loadLeads(salesOwnerId) {
                $.ajax({
                    url: "{{ route('get.leads') }}",
                    type: "GET",
                    data: {
                        sales_owner_id: salesOwnerId,
                        role: userRole,
                        user_id: userId
                    },
                    success: function(data) {
                        console.log("Leads loaded:", data);
                        // Corrected selector for the lead dropdown
                        let $leadDropdown = $('select[name="lead"]');
                        $leadDropdown.empty().append(
                            '<option value="" disabled selected>Select Lead</option>');

                        if (data.length > 0) {
                            data.forEach(function(lead) {
                                $leadDropdown.append('<option value="' + lead.id + '">' + lead
                                    .title + '</option>');
                            });
                        }
                    },
                    error: function(xhr) {
                        console.error("Error loading leads:", xhr.responseText);
                    }
                });
            }

            // If role = 3, load leads directly for the logged-in user
            if (userRole == 3) {
                loadLeads(userId);
            }

            // Corrected jQuery selector to target the dropdown with name="owner" for Role 2
            $('select[name="sales_owner"]').on('change', function() {
                let selectedOwnerId = $(this).val();
                loadLeads(selectedOwnerId);
            });
        });
    </script>

@endsection
