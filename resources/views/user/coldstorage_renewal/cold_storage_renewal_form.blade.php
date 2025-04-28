<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>PMC || Application for Cold Storage Renewal License</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/') }}/assets/images/PMC-logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('/') }}/assets/images/PMC-logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/') }}/assets/images/PMC-logo.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="content">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/userend/assets/vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/userend/assets/vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/userend/assets/vendors/styles/style.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/userend/assets/src/plugins/jquery-steps/jquery.steps.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>

    <!-- Toaster Message -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</head>

<style>
    .error {
        color: red;
    }
</style>

<body>

    <div class="col-12" style="padding-top:20px; padding-bottom:20px;">
        <div class="align-items-center">

            <div class="min-height-200px">
                <div class="page-header" style="border: 1px solid #000000;">
                    <div class="row">

                        <div class="col-sm-2 col-xs-12 text-right d-flex justify-content-center d-block d-sm-none mb-4">
                            <div class="user-info-dropdown">
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <span class="user-icon">
                                            <img src="{{ url('/') }}/assets/images/PMC-logo.png" alt="">
                                        </span>
                                        @if (Auth::guard('meatregistereduser')->check())
                                            <span class="user-name">
                                                {{ Auth::guard('meatregistereduser')->user()->name }}
                                            </span>
                                        @elseif(Auth::guard('web')->check())
                                            <span class="user-name">
                                                {{ Auth::user()->name }}
                                            </span>
                                        @else
                                            <span class="user-name">

                                            </span>
                                        @endif
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="{{ url('/user/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            <i class="dw dw-logout"></i> Log Out
                                        </a>
                                        <form id="logout-form" action="{{ url('/user/logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-10 col-xs-12 d-flex flex-column align-items-center align-items-sm-start">
                            <div class="title">
                                <h4>Application for Cold Storage Renewal License</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                                    <!--<li class="breadcrumb-item"><a href="javascript:;">Documentation</a></li>-->
                                    <li class="breadcrumb-item active" aria-current="page">Application for Cold Storage Renewal License</li>
                                </ol>
                            </nav>
                        </div>

                        <div class="col-sm-2 col-xs-12 text-right d-none d-sm-block">
                            <div class="user-info-dropdown">
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <span class="user-icon">
                                            <img src="{{ url('/') }}/assets/images/PMC-logo.png" alt="">
                                        </span>
                                        @if (Auth::guard('meatregistereduser')->check())
                                            <span class="user-name">
                                                {{ Auth::guard('meatregistereduser')->user()->name }}
                                            </span>
                                        @elseif(Auth::guard('web')->check())
                                            <span class="user-name">
                                                {{ Auth::user()->name }}
                                            </span>
                                        @else
                                            <span class="user-name">

                                            </span>
                                        @endif

                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="{{ url('/user/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            <i class="dw dw-logout"></i> Log Out
                                        </a>
                                        <form id="logout-form" action="{{ url('/user/logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-30">
                        <div class="card-box height-100-p overflow-hidden" style="border: 1px solid #000000;">
                            <div class="profile-tab height-100-p">
                                <form method="POST" action="{{ url("/user/cold_storage_renewal_form/{$id}/{$user_type}/store") }}" enctype="multipart/form-data">
                                    @csrf

                                    @if (Auth::guard('meatregistereduser')->check())
                                        <input type="hidden" name="user_id" id="user_id" class="form-control" value="{{ Auth::guard('meatregistereduser')->user()->id }}">
                                    @elseif(Auth::guard('web')->check())
                                        <input type="hidden" name="admin_id" id="admin_id" class="form-control" value="{{ Auth::user()->id }}">
                                    @endif

                                    <input type="hidden" name="coldstorage_regi_id" id="coldstorage_regi_id" value="{{ $data->id }}">
                                    <input type="hidden" name="renwal_liceans_no" id="renwal_liceans_no" value="{{ $data->cold_storage_aplication_no }}">
                                    <input type="hidden" name="register_table_id" id="register_table_id" class="form-control" value="{{ $data->registration_id }}">

                                    <div class="tab height-100-p">
                                        <ul class="nav nav-tabs customtab" role="tablist">
                                            <li class="nav-item active">
                                                <a class="nav-link active basic_information" data-toggle="tab" href="#basic_information" role="tab">Basic Information <br> ( मुलभूत माहिती ) </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link pet_details" data-toggle="tab" href="#pet_details" role="tab">Business Details <br> ( व्यवसाय तपशील ) </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link other_document" data-toggle="tab" href="#other_document" role="tab">Upload Documents <br> ( दस्तऐवज अपलोड करा ) </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">

                                            <!-- Basic Details Tab start -->
                                            <div class="tab-pane fade show active height-100-p" id="basic_information" role="tabpanel">
                                                <div class="profile-setting">
                                                    <div class="col-12 p-4">
                                                        <h4 class="text-blue h5 mb-20">Basic Information <br> ( मुलभूत माहिती ) </h4>
                                                        <br>


                                                        <strong class="pb-1">Name of Applicant / <br> ( अर्जदाराचे नाव ) : <span style="color:red;">*</span> </strong>
                                                        <div class="form-group row" style="padding-left:03px;">
                                                            <!--<label class="col-sm-1"><strong>Title : <span style="color:red;">*</span></strong></label>-->

                                                            <div class="col-sm-3 col-md-3 p-2">
                                                                <select class="form-control  @error('applicant_title_id') is-invalid @enderror" name="applicant_title_id" id="applicant_title_id"
                                                                    style="width: 100%; height: 38px;>
                                                                    <option value=" ">Select Applicant Title</option>
                                                                    <option value="1" {{ $data->applicant_title_id == '1' ? 'selected' : '' }}>Kum.</option>
                                                                    <option value="2" {{ $data->applicant_title_id == '2' ? 'selected' : '' }}>M/s</option>
                                                                    <option value="3" {{ $data->applicant_title_id == '3' ? 'selected' : '' }}>Smt.</option>
                                                                    <option value="4" {{ $data->applicant_title_id == '4' ? 'selected' : '' }}>Ms.</option>
                                                                    <option value="5" {{ $data->applicant_title_id == '5' ? 'selected' : '' }}>Mr.</option>
                                                                    <option value="6" {{ $data->applicant_title_id == '6' ? 'selected' : '' }}>MrS.</option>
                                                                    <option value="7" {{ $data->applicant_title_id == '7' ? 'selected' : '' }}>Dr.</option>
                                                                </select>
                                                                @error('applicant_title_id')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>


                                                            <!--<label class="col-sm-1"><strong>First Name : <span style="color:red;">*</span></strong></label>-->

                                                            <div class="col-sm-3 col-md-3 p-2">
                                                                <input type="text" name="applicant_fname" id="inputTextBox" class="form-control @error('applicant_fname') is-invalid @enderror" value="{{ $data->applicant_fname }}"
                                                                    placeholder="Applicant First Name.">
                                                                @error('applicant_fname')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror

                                                            </div>

                                                            <div class="col-sm-3 col-md-3 p-2">
                                                                <input type="text" name="applicant_mname" id="inputTextBox" class="form-control @error('applicant_mname') is-invalid @enderror" value="{{ $data->applicant_mname }}"
                                                                    placeholder="Applicant Middle Name." >
                                                                @error('applicant_mname')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <!--<label class="col-sm-1"><strong>Last Name : <span style="color:red;">*</span></strong></label>-->
                                                            <div class="col-sm-3 col-md-3 p-2">
                                                                <input type="text" name="applicant_lname" id="inputTextBox" class="form-control @error('applicant_lname') is-invalid @enderror" value="{{ $data->applicant_lname }}"
                                                                    placeholder="Applicant Last Name." >
                                                                @error('applicant_lname')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong>Mobile Number / (मोबाईल नंबर) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input type="text" name="mobile_number" id="mobile_number" maxlength="10"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                    class="form-control @error('mobile_number') is-invalid @enderror" value="{{ $data->mobile_number }}" placeholder="Mobile Number / (मोबाईल नंबर)">
                                                                @error('mobile_number')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <label class="col-sm-2"><strong>Email Id / (ई - मेल आयडी) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"  value="{{ $data->email }}"
                                                                    placeholder="Email Id / (ई - मेल आयडी)">
                                                                @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <label class="col-sm-2"><strong>Aadhar Number / (आधार क्रमांक) :</strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input type="text" name="aadhar_number" id="aadhar_number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="12"
                                                                    class="form-control" value="{{ $data->aadhar_number }}"  placeholder="Aadhar Number / (आधार क्रमांक)">
                                                                <!--@error('aadhar_number')
    -->
                                                                    <!--    <span class="invalid-feedback" role="alert">-->
                                                                    <!--        <strong>{{ $message }}</strong>-->
                                                                    <!--    </span>-->
                                                                    <!--
@enderror-->
                                                            </div>
                                                        </div>

                                                        <strong class="pt-2 text-primary">
                                                            Residential Address of Applicant / ( अर्जदाराचा निवासी पत्ता )
                                                        </strong>
                                                        <hr>

                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong>House Number / (घर क्रमांक) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input type="text" name="house_number" id="house_number" class="form-control @error('house_number') is-invalid @enderror" value="{{ $data->house_number }}"
                                                                    placeholder="House Number / (घर क्रमांक)">
                                                                @error('house_number')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <label class="col-sm-2"><strong>House Name / (घराचे नाव) :</strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input type="text" name="house_name" id="house_name" class="form-control @error('house_name') is-invalid @enderror" value="{{ $data->house_name }}"
                                                                    placeholder="House Name / (घराचे नाव)">
                                                                @error('house_name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong>Street 1 / <br> ( रस्ता १ ): <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input type="text" name="street_1" id="street_1" class="form-control @error('street_1') is-invalid @enderror" value="{{ $data->street_1 }}"
                                                                    placeholder="Street 1 / (रस्ता १)">
                                                                @error('street_1')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror


                                                            </div>

                                                            <label class="col-sm-2"><strong>Street 2 / <br> ( रस्ता 2 ) : </strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input class="form-control " name="street_2" id="street_2" value="{{ $data->street_2 }}" >
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong>Area 1 / ( क्षेत्र १ ) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input type="text" name="area_1" id="area_1" class="form-control @error('area_1') is-invalid @enderror"  value="{{ $data->area_1 }}"
                                                                    placeholder="Area 1 / (क्षेत्र १)">
                                                                @error('area_1')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror

                                                            </div>

                                                            <label class="col-sm-2"><strong>Area 2 / <br> ( क्षेत्र २ ) : </strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input class="form-control " name="area_2" id="area_2" value="{{ $data->area_2 }}" >
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <?php
                                                            $country_id = '';

                                                            if ($data->country_id == 1) {
                                                                $country_id = 'India';
                                                            }

                                                            ?>
                                                            <label class="col-sm-2"><strong>Country / <br> ( देश ) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <select class="form-control @error('country_id') is-invalid @enderror" name="country_id" id="country_id" style="width: 100%; height: 38px;">
                                                                    <option value=" ">Select Country / (देश) </option>
                                                                    <option value="1" {{ $data->country_id == '1' ? 'selected' : '' }}>India</option>
                                                                </select>
                                                                @error('country_id')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>


                                                            <label class="col-sm-2"><strong>State / ( राज्य ) <span style="color:red;">*</span>: </strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <select class="form-control @error('state_id') is-invalid @enderror" name="state_id" id="state_id" style="width: 100%; height: 38px;">
                                                                    <option value=" ">Select State / (राज्य) </option>
                                                                    <option value="1" {{ $data->state_id == '1' ? 'selected' : '' }}>Maharashtra</option>
                                                                </select>
                                                                @error('state_id')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror

                                                            </div>
                                                        </div>

                                                        <?php
                                $mst_dist = DB::select('SELECT
                                                            `mst_dist`.`id`, `mst_dist`.`dist_name`
                                                        FROM `mst_dist`
                                                        WHERE `mst_dist`.`deleted_at` is NULL
                                                        ORDER BY `mst_dist`.`id` DESC
                                                        ');

                                                        // dd($data);
                                $mst_taluka = DB::select('SELECT
                                                                `mst_taluka`.`id`, `mst_taluka`.`taluka_name`
                                                            FROM `mst_taluka`
                                                            WHERE
                                                            `mst_taluka`.`dist_id` = '.$data->district_id.' AND
                                                            `mst_taluka`.`deleted_at` is NULL

                                                            ORDER BY `mst_taluka`.`id` DESC
                                                        ');
                            ?>
                                <div class="form-group row">
                                    <label class="col-sm-2"><strong>जिल्हा / <br> District : </strong></label>
                                    <div class="col-sm-4 col-md-4 p-2">
                                        <select class="form-control custom-select2 @error('district_id') is-invalid @enderror"  name="district_id" id="district_id" style="width: 100%; height: 38px;">
                                            <option value=" ">Select District / ( जिल्हा )</option>
                                            @foreach ($mst_dist as $key => $value)
                                                <option value="{{ $value->id }}" {{ $data->district_id == $value->id ? 'selected' : '' }}>{{ $value->dist_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('district_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                           @enderror
                                    </div>
                                    <label class="col-sm-2"><strong>तालुका / <br> Taluka  : </strong></label>
                                    <div class="col-sm-4 col-md-4 p-2">
                                        <select class="form-control custom-select2 @error('taluka_id') is-invalid @enderror"  name="taluka_id" id="taluka_id" style="width: 100%; height: 38px;">
                                            @foreach ($mst_taluka as $key => $value)
                                                <option value="{{ $value->id }}" {{ $data->taluka_id == $value->id ? 'selected' : '' }}> {{ $value->taluka_name }}</option>
                                            @endforeach

                                        </select>
                                        @error('taluka_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>



                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong>Zip Code / <br> ( पिनकोड ): <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">

                                                                <input type="text" name="zipcode" id="zipcode" maxlength="6" class="form-control @error('zipcode') is-invalid @enderror" value="{{ $data->zipcode }}"
                                                                    placeholder="Zip Code / पिनकोड ">
                                                                @error('zipcode')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror


                                                            </div>


                                                        </div>

                                                        <div class="form-group row mt-4">
                                                            <!-- Back button aligned left -->
                                                            <div class="col-md-6 text-left">
                                                                <button type="button" class="btn btn-danger" data-toggle="tab">
                                                                    Back
                                                                </button>
                                                            </div>

                                                            <!-- Save and Next button aligned right -->
                                                            <div class="col-md-6 text-right">
                                                                <button type="button" class="btn btn-primary" data-toggle="tab" href="#pet_details"
                                                                    onclick="changetab(this, '.basic_information', '.pet_details')">
                                                                    Save and Next
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <!-- <a class="btn btn-primary btnNext" >Next</a>  -->
                                                    </div>
                                                </div>


                                            </div>
                                            <!-- Basic Details Tab End -->

                                            <!-- PET Details Tab start -->
                                            <div class="tab-pane fade height-100-p" id="pet_details" role="tabpanel">
                                                <div class="profile-setting">
                                                    <div class="col-12 p-4">
                                                        <strong class="pt-2 text-primary">
                                                            Business Details / ( व्यवसाय तपशील )
                                                        </strong>
                                                        <hr>

                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong>Name of the business / (व्यवसायाचे नाव) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input type="text" name="business_name" id="business_name" class="form-control @error('business_name') is-invalid @enderror"  value="{{ $data->business_name }}"
                                                                    placeholder="Name of the business / व्यवसायाचे नाव">
                                                                @error('business_name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror


                                                            </div>

                                                            <label class="col-sm-2"><strong>Meat Type / (मांसाचा प्रकार) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <select class="form-control custom-select2 @error('meat_type') is-invalid @enderror" name="meat_type[]" id="meat_type" multiple style="width: 100%; height: 50px;">
                                                                    <option value=" ">Select Meat Type / (मांसाचा प्रकार)</option>
                                                                    @php
                                                                        $arrayMeat = explode(",", $data->meat_type);
                                                                    @endphp
                                                                    @foreach ($meattype_mst as $key => $value)
                                                                    <option value="{{ $key }}" {{ in_array($key, $arrayMeat) ? 'selected' : '' }}>{{ $value }}</option>
                                                                    @endforeach
                                                                </select>
                                                                {{-- @dump($meattype_mst) --}}
                                                                @error('meat_type')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">


                                                            <label class="col-sm-2"><strong>Per Day Capacity / (प्रतिदिन क्षमता) : <span style="color:red;">*</span> </strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input type="text" name="per_day_capacity" id="per_day_capacity" class="form-control @error('per_day_capacity') is-invalid @enderror" value="{{ $data->per_day_capacity }}"
                                                                     placeholder="Per Day Capacity / प्रतिदिन क्षमता">
                                                                @error('per_day_capacity')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror

                                                            </div>

                                                            <label class="col-sm-2"><strong>Unit / (युनिट) :<span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <select class="form-control custom-select2 @error('unit') is-invalid @enderror" name="unit" id="unit" style="width: 100%; height: 38px;">
                                                                    <option value="">Select Unit / (युनिट) </option>
                                                                    @foreach ($unit_Meat_Type as $item)
                                                                        <option value="{{ $item->id }}" {{ (old('unit') ?? $data->unit) == $item->id ? 'selected' : '' }}>
                                                                            {{ $item->unit_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>

                                                                @error('meat_type')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror


                                                            </div>


                                                        </div>

                                                        <div class="form-group row">

                                                            <label class="col-sm-2"><strong>Provision of water / (पाण्याची व्यवस्था आहे का ?) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <select class="form-control @error('provision_water') is-invalid @enderror" name="provision_water" id="provision_water" style="width: 100%; height: 38px;">
                                                                    <option value=" ">Select Provision of water / (पाण्याची व्यवस्था आहे का ?) </option>
                                                                    <option value="1" {{ $data->provision_water == '1' ? 'selected' : '' }}>Yes</option>
                                                                    <option value="2" {{ $data->provision_water == '2' ? 'selected' : '' }}>No</option>
                                                                </select>

                                                                @error('provision_water')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror


                                                            </div>

                                                            <label class="col-sm-2"><strong>Provision of electricity / (विजेची व्यवस्था आहे का ? ) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <select class="form-control  @error('provision_electricty') is-invalid @enderror" name="provision_electricty" id="provision_electricty"
                                                                    style="width: 100%; height: 38px;">
                                                                    <option value=" ">Select Provision of electricity / (विजेची व्यवस्था आहे का ?) </option>
                                                                    <option value="1" {{ $data->provision_electricty == '1' ? 'selected' : '' }}>Yes</option>
                                                                    <option value="2" {{ $data->provision_electricty == '2' ? 'selected' : '' }}>No</option>
                                                                </select>

                                                                @error('provision_electricty')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror


                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong>Address of the business / (व्यवसायाचा पत्ता) : <span style="color:red;">*</span> </strong></label>
                                                            <div class="col-sm-12 col-md-12 p-2">
                                                                <textarea type="text" name="business_address" id="business_address" class="form-control @error('business_address') is-invalid @enderror" value="{{ $data->business_address }}"
                                                                    placeholder="Address of the business / (व्यवसायाचा पत्ता)" style="height:120px;">{{ $data->business_address }} </textarea>
                                                                @error('business_address')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror



                                                            </div>
                                                        </div>

                                                        <div class="form-group row">

                                                            <label class="col-sm-2"><strong>Provision of sewerage for disposing effluent / (सांडपाण्याची भूमिगत गटाराची व्यवस्था आहे का ?) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <select class="form-control  @error('sewerage_disposing') is-invalid @enderror" name="sewerage_disposing" id="sewerage_disposing"
                                                                    style="width: 100%; height: 38px;">
                                                                    <option value=" ">Select Provision of sewerage for disposing effluent / (सांडपाण्याची भूमिगत गटाराची व्यवस्था आहे का ?) </option>
                                                                    <option value="1" {{ $data->sewerage_disposing == '1' ? 'selected' : '' }}>Yes</option>
                                                                    <option value="2" {{ $data->sewerage_disposing == '2' ? 'selected' : '' }}>No</option>
                                                                </select>

                                                                @error('sewerage_disposing')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>

                                                            <label class="col-sm-2"><strong>If not explain provision to dispose effluent / (नसल्यास सांडपाण्याची विल्हेवाट कशी लावली जाते ) : </strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <textarea type="text" name="prcision_dispose_id" id="prcision_dispose_id" class="form-control @error('prcision_dispose_id') is-invalid @enderror"  value="{{ $data->prcision_dispose_id }}"
                                                                    placeholder="If not explain provision to dispose effluent /(नसल्यास सांडपाण्याची  विल्हेवाट कशी  लावली जाते ) " style="height:80px;">{{ $data->prcision_dispose_id }}</textarea>
                                                                @error('prcision_dispose_id')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror

                                                            </div>

                                                        </div>


                                                        <div class="form-group row">
                                                            <label class="col-sm-12">
                                                                <strong>Is place is located at least 50mt. away form <br> Place of worship / educational institute / hospital & clinic <br> (जागेपासून प्रार्थनास्थळे / शिक्षणसंस्था /इस्पितळे व दवाखाने
                                                                    कमीत कमी ५० मीटर पेक्षा जास्त अंतरावर आहेत का ? ) : <span style="color:red;">*</span></strong>
                                                            </label>
                                                            <div class="col-sm-12 col-md-12 ">
                                                                <select class="form-control @error('place_id') is-invalid @enderror" name="place_id" id="place_id" style="width: 100%; height: 38px;">
                                                                    <option value=" ">Select Is place is located at least 50mt. away form place of worship / educational institute / hospital & clinic </option>
                                                                    <option value="1" {{ $data->place_id == '1' ? 'selected' : '' }}>Yes</option>
                                                                    <option value="2" {{ $data->place_id == '2' ? 'selected' : '' }}>No</option>
                                                                </select>

                                                                @error('place_id')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>



                                                        <strong class="pt-2 text-primary">
                                                            Business registration details / ( व्यवसाय नोंदणी तपशील )
                                                        </strong>
                                                        <hr>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong> Registration authority name / (नोंदणी प्राधिकरणाचे नाव) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 ">

                                                                <input type="text" name="regi_authority_name" id="regi_authority_name" class="form-control @error('regi_authority_name') is-invalid @enderror"
                                                                    value="{{ $data->regi_authority_name }}"  placeholder="Registration authority name  / नोंदणी प्राधिकरणाच नाव">
                                                                @error('regi_authority_name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror


                                                            </div>

                                                            <label class="col-sm-2"><strong> Registration Number / (नोंदणी क्रमांक) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 ">

                                                                <input type="text" name="register_number" id="register_number" class="form-control @error('register_number') is-invalid @enderror" value="{{ $data->register_number }}"
                                                                     placeholder="Registration Number  / नोंदणी क्रमांक">
                                                                @error('register_number')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror


                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong> Valid till / (पर्यंत वैध) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4">
                                                                <input type="Date" name="valid_till" id="valid_till" class="form-control  @error('valid_till') is-invalid @enderror" value="{{ $data->valid_till }}"
                                                                    placeholder="valid till ">
                                                                @error('valid_till')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror

                                                            </div>
                                                        </div>

                                                        <strong class="pt-2 text-primary">
                                                            Details of business place / ( व्यवसायाच्या ठिकाणाचा तपशील )
                                                        </strong>
                                                        <hr>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong> Area of business place(sq/mtr) / (व्यवसायाच्या ठिकाणाचे क्षेत्रफळ (चौरस/मीटर) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input type="text" name="areaof_business_place" id="areaof_business_place" class="form-control @error('areaof_business_place') is-invalid @enderror"
                                                                    value="{{ $data->areaof_business_place }}"  placeholder="Area of business place(sq/mtr)  / (व्यवसायाच्या ठिकाणाचे क्षेत्रफळ (च नाव">
                                                                @error('areaof_business_place')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror

                                                            </div>

                                                            <label class="col-sm-2"><strong> Place / (ठिकाण) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">


                                                                <?php
                                                                $business_place = '';

                                                                if ($data->business_place == 1) {
                                                                    $business_place = 'महानगर पालिका बाजार/ Mahanagara Palika Bazar';
                                                                }
                                                                if ($data->business_place == 2) {
                                                                    $business_place = 'खाजगी जागा/ Private space';
                                                                }

                                                                ?>
<select class="form-control custom-select2 @error('business_place') is-invalid @enderror" name="business_place" id="business_place" style="width: 100%; height: 38px;">
    <option value="">Select place</option>

    <option value="1" {{ $data->business_place == '1' ? 'selected' : '' }}>महानगर पालिका बाजार/ Mahanagara Palika Bazar</option>
    <option value="2" {{$data->business_place == '2' ? 'selected' : '' }}>खाजगी जागा/ Private space</option>
</select>
@error('business_place')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror                                                            </div>

                                                        </div>

                                                        <div class="form-group row other_b" id="hidden_div" style="display:none">
                                                            <label class="col-sm-2"><strong> Other  : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4">
                                                                <input type="text" name="business_place_other" id="business_place_other" class="form-control  @error('business_place_other') is-invalid @enderror" value="{{ old('business_place_other') }}" placeholder="other ">
                                                                @error('business_place_other')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mt-4">
                                                            <!-- Back button on the left -->
                                                            <div class="col-md-6 text-left">
                                                                <button type="button" class="btn btn-danger" data-toggle="tab" href="#basic_information"
                                                                    onclick="changetab(this,'.pet_details' , '.basic_information')">
                                                                    Back
                                                                </button>
                                                            </div>

                                                            <!-- Save and Next button on the right -->
                                                            <div class="col-md-6 text-right">
                                                                <button type="button" class="btn btn-primary" data-toggle="tab" href="#other_document"
                                                                    onclick="changetab(this, '.pet_details', '.other_document')">
                                                                    Save and Next
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- PET Details Tab End -->

                                            <!-- Documents Tab start -->
                                            <div class="tab-pane fade height-100-p" id="other_document" role="tabpanel">
                                                <div class="profile-setting">
                                                    <div class="col-12 p-4">
                                                        <strong class="pt-2 text-primary">
                                                            Upload Document / ( दस्तऐवज अपलोड करा )
                                                        </strong>
                                                        <br>
                                                        <br>
                                                        <strong class="text-danger text-justify ">
                                                            Note :- please attach attested photocopies of document
                                                        </strong><br>
                                                        <strong class="text-danger text-justify ">
                                                            टीप :- कृपया छायांकित प्रती प्रमाणित करून सादर करणे
                                                        </strong>
                                                        <hr>

                                                        <div id="div2" style="display: none;">

                                                            <div class="form-group row">

                                                             <label class="col-sm-2"><strong>Upload ID proof (Adharcard) of the applicant  <br> (अर्जदाराचा आयडी पुरावा (आधारकार्ड) अपलोड करा ) : <span style="color:red;">*</span></strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">
                                                                   <input type="file" name="adharcard_doc" id="adharcard_doc" accept=".png, .jpg, .jpeg, .pdf" class="form-control @error('adharcard_doc') is-invalid @enderror" value="{{ old('$data->adharcard_doc') }}" placeholder="Upload adharcard of applicant">
                                                                   <input type="hidden" name="old_adharcard_doc" value="{{ $data->old_adharcard_doc ?? '' }}">
                                                                   <small class="text-secondary text-justify "> Note : The file should be less than 10MB .</small>
                                                                   <br>
                                                                   <small class="text-secondary text-justify "> Note : Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .</small>
                                                                   <br>
                                                                   @error('adharcard_doc')
                                                                       <span class="invalid-feedback" role="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                       </span>
                                                                   @enderror

                                                                   <?php
                                                                   // Check if the adharcard document exists
                                                                   if(!empty($data->adharcard_doc)) {
                                                                       $document_path = $data->adharcard_doc;
                                                                       $filter_path = explode(".", $document_path);
                                                                       $size_of_array = count($filter_path);
                                                                       $filter_ext = $filter_path[$size_of_array - 1];

                                                                       // Check if the file is an image
                                                                       if ($filter_ext == 'jpg' || $filter_ext == 'jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                                           $filter_ext == 'JPG' || $filter_ext == 'JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF') {
                                                                           ?>
                                                                           <p class="mt-3 mb-0" id="image_div">
                                                                               <img src="{{ url('/') }}/PMC_Cold_Storage/meat_file/adharcard_doc/{{ $data->adharcard_doc }}" alt="image" class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                                                                           </p>
                                                                           <?php
                                                                       } else {
                                                                           // If the file is not an image, provide a download link
                                                                           ?>
                                                                           <a href="{{ url('/') }}/PMC_Cold_Storage/meat_file/adharcard_doc/{{ $data->adharcard_doc }}" target="_blank">
                                                                               <p class="mt-3 mb-0" id="image_div">
                                                                                   <button type="button" class="btn btn-info">View File</button>
                                                                               </p>
                                                                           </a>
                                                                           <?php
                                                                       }
                                                                   } else {
                                                                       // If no document is found
                                                                       ?>
                                                                       <p class="mt-3 mb-0 text-danger">No document found</p>
                                                                       <?php
                                                                   }
                                                                   ?>

                                                               </div>

                                                               <label class="col-sm-2"><strong>Upload Ration card, electricity / telephone bill. <br> ( रेशन कार्ड, वीज / टेलिफोन बिल अपलोड करा ) : <span style="color:red;">*</span></strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">
                                                                   <input type="file" name="residitional_proof_doc" id="residitional_proof_doc" accept=".png, .jpg, .jpeg, .pdf" class="form-control @error('residitional_proof_doc') is-invalid @enderror" value="{{ old('residitional_proof_doc') }}" placeholder="Upload residitional proof of applicat">
                                                                   <input type="hidden" name="old_residitional_proof_doc" value="{{ $data->residitional_proof_doc ?? '' }}">
                                                                   <small class="text-secondary text-justify "> Note : The file should be less than 10MB .</small>
                                                                   <br>
                                                                   <small class="text-secondary text-justify "> Note : Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .</small>
                                                                   <br>
                                                                   @error('residitional_proof_doc')
                                                                       <span class="invalid-feedback" role="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                       </span>
                                                                   @enderror
                                                                   <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/residitional_proof_doc/{{ $data->residitional_proof_doc }}" target="_blank">
                                                                    <div class="form-group">
                                                                        <?php $document_path = $data->residitional_proof_doc;
                                                                           $filter_path =  explode(".",$document_path);
                                                                           $size_of_array = count($filter_path);
                                                                           $filter_ext = $filter_path[$size_of_array - 1];

                                                                        if($filter_ext == 'jpg' || $filter_ext=='jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                                        $filter_ext == 'JPG' || $filter_ext=='JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF' )
                                                                           {?>
                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                            <img src="{{url('/')}}/PMC_Cold_Storage/meat_file/residitional_proof_doc/{{ $data->residitional_proof_doc }}" alt="image" class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                                                                        </p>
                                                                        <?php }
                                                                                elseif($filter_ext == 'pdf'){
                                                                                    ?>
                                                                                    <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/residitional_proof_doc/{{ $data->residitional_proof_doc }} " target="_blank">
                                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                                        <button type="button"class="btn btn-info">
                                                                                            View File
                                                                                        </button>
                                                                                        </p>
                                                                                    </a>
                                                                        <?php } else { ?><a href="#" class="text-danger">No document found</a><?php } ?>
                                                                    </div>
                                                                </a>

                                                               </div>



                                                           </div>


                                                           <div class="form-group row">
                                                               <label class="col-sm-2"><strong>Upload legal document of the business place <br> ( जागेचा अधिकृततेचा पुरावा अपलोड करा ) : <span style="color:red;">*</span></strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">
                                                                   <input type="file" name="legal_business_doc" id="legal_business_doc" accept=".png, .jpg, .jpeg, .pdf" class="form-control @error('legal_business_doc') is-invalid @enderror" value="{{ old('legal_business_doc') }}" placeholder="Upload legal document of the business place">
                                                                   <input type="hidden" name="old_legal_business_doc" value="{{ $data->legal_business_doc ?? '' }}">
                                                                   <small class="text-secondary text-justify "> Note : The file should be less than 10MB .</small>
                                                                   <br>
                                                                   <small class="text-secondary text-justify "> Note : Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .</small>
                                                                   <br>
                                                                   @error('legal_business_doc')
                                                                       <span class="invalid-feedback" role="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                       </span>
                                                                   @enderror
                                                                   <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/legal_business_doc/{{ $data->legal_business_doc }}" target="_blank">
                                                                    <div class="form-group">
                                                                        <?php $document_path = $data->legal_business_doc;
                                                                           $filter_path =  explode(".",$document_path);
                                                                           $size_of_array = count($filter_path);
                                                                           $filter_ext = $filter_path[$size_of_array - 1];

                                                                        if($filter_ext == 'jpg' || $filter_ext=='jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                                        $filter_ext == 'JPG' || $filter_ext=='JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF' )
                                                                           {?>
                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                            <img src="{{url('/')}}/PMC_Cold_Storage/meat_file/legal_business_doc/{{ $data->legal_business_doc }} " alt="image" class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                                                                        </p>
                                                                        <?php }
                                                                                elseif($filter_ext == 'pdf'){
                                                                                    ?>
                                                                                    <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/legal_business_doc/{{ $data->legal_business_doc }}" target="_blank">
                                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                                        <button type="button"class="btn btn-info">
                                                                                            View File
                                                                                        </button>
                                                                                        </p>
                                                                                    </a>
                                                                        <?php } else { ?><a href="#" class="text-danger">No document found</a><?php } ?>
                                                                    </div>
                                                                </a>
                                                    </div>

                                                               <label class="col-sm-2"><strong>Upload business registration certificate <br> ( व्यवसाय नोंदणी प्रमाणपत्र अपलोड करा ) : </strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">
                                                                    <input type="file" name="business_registration_doc" id="business_registration_doc" accept=".png, .jpg, .jpeg, .pdf" class="form-control @error('business_registration_doc') is-invalid @enderror" value="{{ old('business_registration_doc') }}" placeholder="Upload business registration certificate">
                                                                    <input type="hidden" name="old_business_registration_doc" value="{{ $data->business_registration_doc ?? '' }}">
                                                                    <small class="text-secondary text-justify "> Note : The file should be less than 10MB .</small>
                                                                   <br>
                                                                   <small class="text-secondary text-justify "> Note : Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .</small>
                                                                   <br>

                                                                   @error('business_registration_doc')
                                                                       <span class="invalid-feedback" role="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                       </span>
                                                                   @enderror
                                                                   <div class="form-group">
                                                                    <?php
                                                                    // Check if the business registration document exists
                                                                    if(!empty($data->business_registration_doc)) {
                                                                        $document_path = $data->business_registration_doc;
                                                                        $filter_path = explode(".", $document_path);
                                                                        $size_of_array = count($filter_path);
                                                                        $filter_ext = strtolower($filter_path[$size_of_array - 1]); // Convert extension to lowercase

                                                                        // Check if the file is an image
                                                                        if ($filter_ext == 'jpg' || $filter_ext == 'jpeg' || $filter_ext == 'png' || $filter_ext == 'gif') {
                                                                            ?>
                                                                            <p class="mt-3 mb-0" id="image_div">
                                                                                <img src="{{ url('/') }}/PMC_Cold_Storage/meat_file/business_registration_doc/{{ $data->business_registration_doc }}" alt="image" class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                                                                            </p>
                                                                            <?php
                                                                        } else {
                                                                            // If the file is not an image, you can choose to do nothing or display a message.
                                                                            ?>


                                                                                                                                    <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/business_registration_doc/{{ $data->business_registration_doc }}" target="_blank">
                                                                                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                                                                                        <button type="button"class="btn btn-info">
                                                                                                                                            View File
                                                                                                                                        </button>
                                                                                                                                        </p>
                                                                                                                                    </a>
                                                                            <?php
                                                                        }
                                                                    } else {
                                                                        // If no document is found
                                                                        ?>
                                                                        <p class="mt-3 mb-0 text-danger">No document found</p>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>

                                                               </div>

                                                           </div>
                                                            <div class="form-group row">
                                                               <label class="col-sm-2"><strong>Upload receipt of recently paid property tax <br> ( मालमत्ता कर भरल्याचा पुरावा अपलोड करा ): </strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">
                                                                   <input type="file" name="property_tax_doc" id="property_tax_doc" accept=".png, .jpg, .jpeg, .pdf" class="form-control @error('property_tax_doc') is-invalid @enderror" value="{{ old('property_tax_doc') }}" placeholder="Upload receipt of recently paid property tax">
                                                                   <input type="hidden" name="old_property_tax_doc" value="{{ $data->property_tax_doc ?? '' }}">
                                                                   <small class="text-secondary text-justify "> Note : The file should be less than 10MB .</small>
                                                                   <br>
                                                                   <small class="text-secondary text-justify "> Note : Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .</small>
                                                                   <br>
                                                                   @error('property_tax_doc')
                                                                       <span class="invalid-feedback" role="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                       </span>
                                                                   @enderror
                                                                   <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/property_tax_doc/{{ $data->property_tax_doc }}" target="_blank">
                                                                    <div class="form-group">
                                                                        <?php $document_path = $data->property_tax_doc;
                                                                           $filter_path =  explode(".",$document_path);
                                                                           $size_of_array = count($filter_path);
                                                                           $filter_ext = $filter_path[$size_of_array - 1];

                                                                        if($filter_ext == 'jpg' || $filter_ext=='jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                                        $filter_ext == 'JPG' || $filter_ext=='JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF' )
                                                                           {?>
                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                            <img src="{{url('/')}}/PMC_Cold_Storage/meat_file/property_tax_doc/{{ $data->property_tax_doc }}" alt="image" class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                                                                        </p>
                                                                        <?php }
                                                                                elseif($filter_ext == 'pdf'){
                                                                                    ?>
                                                                                    <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/property_tax_doc/{{ $data->property_tax_doc }}" target="_blank">
                                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                                        <button type="button"class="btn btn-info">
                                                                                            View File
                                                                                        </button>
                                                                                        </p>
                                                                                    </a>
                                                                        <?php } else { ?> <a href="#" class="text-danger">No document found</a> <?php } ?>
                                                                    </div>
                                                                </a>
                                                               </div>

                                                               <label class="col-sm-2"><strong>Upload receipt of recently paid water ( पानी पट्टी पावती अपलोड करा ) : </strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">
                                                                   <input type="file" name="paid_water_doc" id="paid_water_doc" accept=".png, .jpg, .jpeg, .pdf"  class="form-control @error('paid_water_doc') is-invalid @enderror" value="{{ old('paid_water_doc') }}" placeholder="Upload receipt of recently paid water">
                                                                   <input type="hidden" name="old_paid_water_doc" value="{{ $data->paid_water_doc ?? '' }}">
                                                                   <small class="text-secondary text-justify "> Note : The file should be less than 10MB .</small>
                                                                   <br>
                                                                   <small class="text-secondary text-justify "> Note : Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .</small>
                                                                   <br>
                                                                   @error('paid_water_doc')
                                                                       <span class="invalid-feedback" role="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                       </span>
                                                                   @enderror
                                                                   <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/paid_water_doc/{{ $data->paid_water_doc }}" target="_blank">
                                                                    <div class="form-group">
                                                                        <?php $document_path = $data->paid_water_doc;
                                                                           $filter_path =  explode(".",$document_path);
                                                                           $size_of_array = count($filter_path);
                                                                           $filter_ext = $filter_path[$size_of_array - 1];

                                                                        if($filter_ext == 'jpg' || $filter_ext=='jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                                        $filter_ext == 'JPG' || $filter_ext=='JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF' )
                                                                           {?>
                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                            <img src="{{url('/')}}/PMC_Cold_Storage/meat_file/paid_water_doc/{{ $data->paid_water_doc }}" alt="image" class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                                                                        </p>
                                                                        <?php }
                                                                                elseif($filter_ext == 'pdf'){
                                                                                    ?>
                                                                                    <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/paid_water_doc/{{ $data->paid_water_doc }}" target="_blank">
                                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                                        <button type="button"class="btn btn-info">
                                                                                            View File
                                                                                        </button>
                                                                                        </p>
                                                                                    </a>
                                                                        <?php } else { ?> <a href="#" class="text-danger">No document found</a> <?php } ?>
                                                                    </div>
                                                                </a>
                                                               </div>
                                                           </div>

                                                           <div class="form-group row">


                                                                 <label class="col-sm-2"><strong>Upload details & authority letter from authorized slaughter house / poultry form & authority letter <br>( अधिकृत कुक्कुट पालन करणाऱ्या संस्थेचे व कत्तलखाण्याची माहिती ई संमातीपत्र अपलोड करा ) : </strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">
                                                                   <input type="file" name="slaughter_letter_doc" id="slaughter_letter_doc" accept=".png, .jpg, .jpeg, .pdf" class="form-control @error('slaughter_letter_doc') is-invalid @enderror" value="{{ old('slaughter_letter_doc') }}" placeholder="Upload details & authority letter from authorized slaughter house / poultry form & authority letter">
                                                                   <input type="hidden" name="old_slaughter_letter_doc" value="{{ $data->slaughter_letter_doc ?? '' }}">
                                                                   <small class="text-secondary text-justify "> Note : The file should be less than 10MB .</small>
                                                                   <br>
                                                                   <small class="text-secondary text-justify "> Note : Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .</small>
                                                                   <br>
                                                                   @error('slaughter_letter_doc')
                                                                       <span class="invalid-feedback" role="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                       </span>
                                                                   @enderror

                                          <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/slaughter_letter_doc/{{ $data->slaughter_letter_doc }}" target="_blank">
                                            <div class="form-group">
                                                <?php $document_path = $data->slaughter_letter_doc;
                                                   $filter_path =  explode(".",$document_path);
                                                   $size_of_array = count($filter_path);
                                                   $filter_ext = $filter_path[$size_of_array - 1];

                                                if($filter_ext == 'jpg' || $filter_ext=='jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                $filter_ext == 'JPG' || $filter_ext=='JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF' )
                                                   {?>
                                                <p class="mt-3 mb-0" id="image_div">
                                                    <img src="{{url('/')}}/PMC_Cold_Storage/meat_file/slaughter_letter_doc/{{ $data->slaughter_letter_doc }}" alt="image" class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                                                </p>
                                                <?php }
                                                        elseif($filter_ext == 'pdf'){
                                                            ?>
                                                            <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/slaughter_letter_doc/{{ $data->slaughter_letter_doc }}" target="_blank">
                                                                <p class="mt-3 mb-0" id="image_div">
                                                                <button type="button"class="btn btn-info">
                                                                    View File
                                                                </button>
                                                                </p>
                                                            </a>
                                                <?php } else { ?> <a href="#" class="text-danger">No document found</a> <?php } ?>
                                            </div>
                                        </a>
                                                               </div>

                                                               <label class="col-sm-2"><strong>Upload pest control treatment certificate issued from authorized agency <br> ( नोंदणीकृत  संस्थेकडून  कीटनाशक फवारणी केल्याचे प्रमाणपत्र अपलोड करा ): </strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">
                                                                   <input type="file" name="treatment_authorized_doc" id="treatment_authorized_doc" accept=".png, .jpg, .jpeg, .pdf" class="form-control @error('treatment_authorized_doc') is-invalid @enderror" value="{{ old('treatment_authorized_doc') }}" placeholder="Upload pest control treatment certificate issued from authorized agency">
                                                                   <input type="hidden" name="old_treatment_authorized_doc" value="{{ $data->treatment_authorized_doc ?? '' }}">
                                                                   <small class="text-secondary text-justify "> Note : The file should be less than 10MB .</small>
                                                                   <br>
                                                                   <small class="text-secondary text-justify "> Note : Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .</small>
                                                                   <br>
                                                                   @error('treatment_authorized_doc')
                                                                       <span class="invalid-feedback" role="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                       </span>
                                                                   @enderror
                                                                   <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/treatment_authorized_doc/{{ $data->treatment_authorized_doc }}" target="_blank">
                                                                    <div class="form-group">
                                                                        <?php $document_path = $data->treatment_authorized_doc;
                                                                           $filter_path =  explode(".",$document_path);
                                                                           $size_of_array = count($filter_path);
                                                                           $filter_ext = $filter_path[$size_of_array - 1];

                                                                        if($filter_ext == 'jpg' || $filter_ext=='jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                                        $filter_ext == 'JPG' || $filter_ext=='JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF' )
                                                                           {?>
                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                            <img src="{{url('/')}}/PMC_Cold_Storage/meat_file/treatment_authorized_doc/{{ $data->treatment_authorized_doc }}" alt="image" class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                                                                        </p>
                                                                        <?php }
                                                                                elseif($filter_ext == 'pdf'){
                                                                                    ?>
                                                                                    <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/treatment_authorized_doc/{{ $data->treatment_authorized_doc }}" target="_blank">
                                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                                        <button type="button"class="btn btn-info">
                                                                                            View File
                                                                                        </button>
                                                                                        </p>
                                                                                    </a>
                                                                        <?php } else { ?> <a href="#" class="text-danger">No document found</a> <?php } ?>
                                                                    </div>
                                                                </a>
                                                               </div>
                                                           </div>


                                                           <div class="form-group row">
                                                               <label class="col-sm-2"><strong>Upload medical fitness certificate of workers
                            issued by registered  general practitioner <br> (  कामगारांचे वैद्यकीय फिटनेस प्रमाणपत्र अपलोड करा नोंदणीकृत जनरल प्रॅक्टिशनरने जारी केले आहे ):</strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">
                                                                   <input type="file" name="fitness_certificate_doc" id="fitness_certificate_doc" accept=".png, .jpg, .jpeg, .pdf" class="form-control @error('fitness_certificate_doc') is-invalid @enderror" value="{{ old('fitness_certificate_doc') }}" placeholder="Upload medical fitness certificate issued by Municipal hospital">
                                                                   <input type="hidden" name="old_fitness_certificate_doc" value="{{ $data->fitness_certificate_doc ?? '' }}">
                                                                   <small class="text-secondary text-justify "> Note : The file should be less than 10MB .</small>
                                                                   <br>
                                                                   <small class="text-secondary text-justify "> Note : Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .</small>
                                                                   <br>
                                                                   @error('fitness_certificate_doc')
                                                                       <span class="invalid-feedback" role="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                       </span>
                                                                   @enderror
                                                                   <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/fitness_certificate_doc/{{ $data->fitness_certificate_doc }}" target="_blank">
                                                                    <div class="form-group">
                                                                        <?php $document_path = $data->fitness_certificate_doc;
                                                                           $filter_path =  explode(".",$document_path);
                                                                           $size_of_array = count($filter_path);
                                                                           $filter_ext = $filter_path[$size_of_array - 1];

                                                                        if($filter_ext == 'jpg' || $filter_ext=='jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                                        $filter_ext == 'JPG' || $filter_ext=='JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF' )
                                                                           {?>
                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                            <img src="{{url('/')}}/PMC_Cold_Storage/meat_file/fitness_certificate_doc/{{ $data->fitness_certificate_doc }}" alt="image" class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                                                                        </p>
                                                                        <?php }
                                                                                elseif($filter_ext == 'pdf'){
                                                                                    ?>
                                                                                    <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/fitness_certificate_doc/{{ $data->fitness_certificate_doc }}" target="_blank">
                                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                                        <button type="button"class="btn btn-info">
                                                                                            View File
                                                                                        </button>
                                                                                        </p>
                                                                                    </a>
                                                                        <?php } else { ?> <a href="#" class="text-danger">No document found</a> <?php } ?>
                                                                    </div>
                                                                </a>
                                                               </div>

                                                               {{-- <label class="col-sm-2"><strong>Upload Factory registration and license to operate the factory <br> (कारखाना नोंदणी व कारखाना चालवण्याचा परवाना ): </strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">
                                                                   <input type="file" name="Factory_reg_and_license_doc" id="Factory_reg_and_license_doc" accept=".png, .jpg, .jpeg, .pdf" class="form-control @error('Factory_reg_and_license_doc') is-invalid @enderror" value="{{ old('Factory_reg_and_license_doc') }}" placeholder="Upload Factory registration and license to operate the factory">
                                                                   <input type="hidden" name="old_Factory_reg_and_license_doc" value="{{ $data->Factory_reg_and_license_doc ?? '' }}">
                                                                   <small class="text-secondary text-justify "> Note : The file should be less than 10MB .</small>
                                                                   <br>
                                                                   <small class="text-secondary text-justify "> Note : Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .</small>
                                                                   <br>
                                                                   @error('fitness_certificate_doc')
                                                                       <span class="invalid-feedback" role="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                       </span>
                                                                   @enderror
                                                                   <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/Factory_reg_and_license_doc/{{ $data->Factory_reg_and_license_doc}}" target="_blank">
                                                                    <div class="form-group">
                                                                        <?php $document_path = $data->Factory_reg_and_license_doc;
                                                                           $filter_path =  explode(".",$document_path);
                                                                           $size_of_array = count($filter_path);
                                                                           $filter_ext = $filter_path[$size_of_array - 1];

                                                                        if($filter_ext == 'jpg' || $filter_ext=='jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                                        $filter_ext == 'JPG' || $filter_ext=='JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF' )
                                                                           {?>
                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                            <img src="{{url('/')}}/PMC_Cold_Storage/meat_file/Factory_reg_and_license_doc/{{ $data->Factory_reg_and_license_doc}} " alt="image" class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                                                                        </p>
                                                                        <?php }
                                                                                elseif($filter_ext == 'pdf'){
                                                                                    ?>
                                                                                    <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/Factory_reg_and_license_doc/{{ $data->Factory_reg_and_license_doc}}" target="_blank">
                                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                                        <button type="button"class="btn btn-info">
                                                                                            View File
                                                                                        </button>
                                                                                        </p>
                                                                                    </a>
                                                                        <?php } else { ?> <a href="#" class="text-danger">No document found</a> <?php } ?>
                                                                    </div>
                                                                </a>
                                                               </div> --}}

                                                                <label class="col-sm-2"><strong>Upload FSSAI Registration Certificate  <br> (FSSAI नोंदणी प्रमाणपत्र अपलोड करा ) : <span style="color:red;">*</span></strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">
                                                                   <input type="file" name="issued_doc" id="issued_doc" accept=".png, .jpg, .jpeg, .pdf" class="form-control @error('issued_doc') is-invalid @enderror" value="{{ old('issued_doc') }}" placeholder="Upload document issued by APEDA, MPCB(ETP), FSSAI">
                                                                   <input type="hidden" name="old_issued_doc" value="{{ $data->issued_doc ?? '' }}">
                                                                   <small class="text-secondary text-justify "> Note : The file should be less than 10MB .</small>
                                                                   <br>
                                                                   <small class="text-secondary text-justify "> Note : Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .</small>
                                                                   <br>
                                                                    @error('issued_doc')
                                                                       <span class="invalid-feedback" role="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                       </span>
                                                                   @enderror
                                                                   <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/issued_doc/{{ $data->issued_doc }}" target="_blank">
                                                                    <div class="form-group">
                                                                        <?php $document_path = $data->issued_doc;
                                                                           $filter_path =  explode(".",$document_path);
                                                                           $size_of_array = count($filter_path);
                                                                           $filter_ext = $filter_path[$size_of_array - 1];

                                                                        if($filter_ext == 'jpg' || $filter_ext=='jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                                        $filter_ext == 'JPG' || $filter_ext=='JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF' )
                                                                           {?>
                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                            <img src="{{url('/')}}/PMC_Cold_Storage/meat_file/issued_doc/{{ $data->issued_doc }} " alt="image" class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                                                                        </p>
                                                                        <?php }
                                                                                elseif($filter_ext == 'pdf'){
                                                                                    ?>
                                                                                    <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/issued_doc/{{ $data->issued_doc }}" target="_blank">
                                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                                        <button type="button"class="btn btn-info">
                                                                                            View File
                                                                                        </button>
                                                                                        </p>
                                                                                    </a>
                                                                        <?php } else { ?> <a href="#" class="text-danger">No document found</a> <?php } ?>
                                                                    </div>
                                                                </a>
                                                               </div>
                                                           </div>
                                                           <div class="form-group row">
                                                               <label class="col-sm-2"><strong>Upload applicant signature / ( अर्जदाराची स्वाक्षरी अपलोड करा ) : <span style="color:red;">*</span></strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">
                                                                   <input type="file" name="applicant_signature" id="applicant_signature" accept=".png, .jpg, .jpeg, .pdf" class="form-control @error('applicant_signature') is-invalid @enderror" value="{{ old('applicant_signature') }}" placeholder="Upload applicant signature">
                                                                   <input type="hidden" name="old_applicant_signature" value="{{ $data->applicant_signature ?? '' }}">
                                                                   <small class="text-secondary text-justify "> Note : The file should be less than 10MB .</small>
                                                                   <br>
                                                                   <small class="text-secondary text-justify "> Note : Only files in .jpg, .jpeg, .png format can be uploaded .</small>
                                                                   <br>
                                                                   @error('applicant_signature')
                                                                       <span class="invalid-feedback" role="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                       </span>
                                                                   @enderror

                                          <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/applicant_signature/{{ $data->applicant_signature }}" target="_blank">
                                            <div class="form-group">
                                                <?php $document_path = $data->applicant_signature;
                                                   $filter_path =  explode(".",$document_path);
                                                   $size_of_array = count($filter_path);
                                                   $filter_ext = $filter_path[$size_of_array - 1];

                                                if($filter_ext == 'jpg' || $filter_ext=='jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                $filter_ext == 'JPG' || $filter_ext=='JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF' )
                                                   {?>
                                                <p class="mt-3 mb-0" id="image_div">
                                                    <img src="{{url('/')}}/PMC_Cold_Storage/meat_file/applicant_signature/{{ $data->applicant_signature }} " alt="image" class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                                                </p>
                                                <?php }
                                                        elseif($filter_ext == 'pdf'){
                                                            ?>
                                                            <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/applicant_signature/{{ $data->applicant_signature }}" target="_blank">
                                                                <p class="mt-3 mb-0" id="image_div">
                                                                <button type="button"class="btn btn-info">
                                                                    View File
                                                                </button>
                                                                </p>
                                                            </a>
                                                <?php } else { ?> <a href="#" class="text-danger">No document found</a> <?php } ?>
                                            </div>
                                        </a>
                                                               </div>

                                                               <label class="col-sm-2"><strong>Upload applicant profile photo / ( अर्जदाराचा प्रोफाइल फोटो अपलोड करा ): <span style="color:red;">*</span></strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">
                                                                   <input type="file" name="profile_photo" id="profile_photo" accept=".png, .jpg, .jpeg, .pdf"  class="form-control @error('profile_photo') is-invalid @enderror" value="{{ old('profile_photo') }}" placeholder="Upload applicant profile photo">
                                                                   <input type="hidden" name="old_profile_photo" value="{{ $data->profile_photo ?? '' }}">
                                                                   <small class="text-secondary text-justify "> Note : The file should be less than 10MB .</small>
                                                                   <br>
                                                                   <small class="text-secondary text-justify "> Note : Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .</small>
                                                                   <br>
                                                                   @error('profile_photo')
                                                                       <span class="invalid-feedback" role="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                       </span>
                                                                   @enderror
                                                                   <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/profile_photo/{{ $data->profile_photo }}" target="_blank">
                                                                    <div class="form-group">
                                                                        <?php $document_path = $data->profile_photo;
                                                                           $filter_path =  explode(".",$document_path);
                                                                           $size_of_array = count($filter_path);
                                                                           $filter_ext = $filter_path[$size_of_array - 1];

                                                                        if($filter_ext == 'jpg' || $filter_ext=='jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                                        $filter_ext == 'JPG' || $filter_ext=='JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF' )
                                                                           {?>
                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                            <img src="{{url('/')}}/PMC_Cold_Storage/meat_file/profile_photo/{{ $data->profile_photo }} " alt="image" class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                                                                        </p>
                                                                        <?php }
                                                                               elseif($filter_ext == 'pdf'){
                                                                                    ?>
                                                                                    <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/profile_photo/{{ $data->profile_photo }}" target="_blank">
                                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                                        <button type="button"class="btn btn-info">
                                                                                            View File
                                                                                        </button>
                                                                                        </p>
                                                                                    </a>
                                                                        <?php } else { ?> <a href="#" class="text-danger">No document found</a> <?php } ?>
                                                                    </div>
                                                                </a>
                                                               </div>
                                                           </div>

                                                           </div>
                                                           <div id="div1" style="display: none;">
                                                                <div class="form-group row">

                                                             <label class="col-sm-2"><strong>Upload Municipal Corporation Permission Letter <br> (महापालिकेचे परवानगी पत्र करा ) : <span style="color:red;">*</span></strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">
                                                                   <input type="file" name="municipal_corpor_doc" id="municipal_corpor_doc" accept=".png, .jpg, .jpeg, .pdf" class="form-control @error('municipal_corpor_doc') is-invalid @enderror" value="{{ old('municipal_corpor_doc') }}" placeholder="Upload municipal corpor doc of applicant">
                                                                   <input type="hidden" name="old_municipal_corpor_doc" value="{{ $data->municipal_corpor_doc ?? '' }}">
                                                                   <small class="text-secondary text-justify "> Note : The file should be less than 10MB .</small>
                                                                   <br>
                                                                   <small class="text-secondary text-justify "> Note : Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .</small>
                                                                   <br>
                                                                   @error('adharcard_doc')
                                                                       <span class="invalid-feedback" role="alert">
                                                                           <strong>{{ $message }}</strong>
                                                                       </span>
                                                                   @enderror
                                                                   <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/municipal_corpor_doc/{{ $data->municipal_corpor_doc }}" target="_blank">
                                                                    <div class="form-group">
                                                                        <?php $document_path = $data->municipal_corpor_doc;
                                                                           $filter_path =  explode(".",$document_path);
                                                                           $size_of_array = count($filter_path);
                                                                           $filter_ext = $filter_path[$size_of_array - 1];

                                                                        if($filter_ext == 'jpg' || $filter_ext=='jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                                        $filter_ext == 'JPG' || $filter_ext=='JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF' )
                                                                           {?>
                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                            <img src="{{url('/')}}/PMC_Cold_Storage/meat_file/municipal_corpor_doc/{{ $data->municipal_corpor_doc}} " alt="image" class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                                                                        </p>
                                                                        <?php }
                                                                               elseif($filter_ext == 'pdf'){
                                                                                    ?>
                                                                                    <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/municipal_corpor_doc/{{ $data->municipal_corpor_doc}}" target="_blank">
                                                                                        <p class="mt-3 mb-0" id="image_div">
                                                                                        <button type="button"class="btn btn-info">
                                                                                            View File
                                                                                        </button>
                                                                                        </p>
                                                                                    </a>
                                                                        <?php } else { ?> <a href="#" class="text-danger">No document found</a> <?php } ?>
                                                                    </div>
                                                                </a>
                                                               </div>



                                                           </div>

                                                            <div class="form-group row">
                                                                <label class="col-sm-2"><strong>Upload previous year licence copy / ( मागील वर्षाच्या परवान्याची प्रत अपलोड करा ) : <span style="color:red;">*</span></strong></label>
                                                                <div class="col-sm-4 col-md-4 p-2">
                                                                    <input type="hidden" name="old_old_licence" value="{{ $data->old_licence ?? '' }}">
                                                                    <input type="file" name="old_licence" id="old_licence" accept=".png, .jpg, .jpeg, .pdf" class="form-control @error('old_licence') is-invalid @enderror"
                                                                        value="{{ !empty($data->old_licence) ? $data->old_licence : '' }}" placeholder="Upload applicant signature">
                                                                    <small class="text-secondary text-justify "> Note : The file should be less than 2MB .</small>
                                                                    <br>
                                                                    <small class="text-secondary text-justify "> Note : Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .</small>
                                                                    <br>
                                                                    @error('old_licence')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>


                                                            </div>
                                                        </div>

                                                        <div class="form-group row mt-4">
                                                            <!-- Back button on the left -->
                                                            <div class="col-md-6" style="display: flex; justify-content: start;">
                                                                <button type="button" class="btn btn-danger" data-toggle="tab"
                                                                href="#pet_details" onclick="changetab(this, '.other_document', '.pet_details')">
                                                                    Back
                                                                </button>
                                                            </div>

                                                            <!-- Cancel and Save buttons on the right -->
                                                            <div class="col-md-6" style="display: flex; justify-content: end;">
                                                                <label class="col-md-3"></label>
                                                                        <div class="col-md-9" style="display: flex; justify-content: flex-end;">
                                                                            <a href="{{ url('/') }}" class="btn btn-danger">Cancel</a>&nbsp;&nbsp;
                                                                            <button type="submit" class="btn btn-success">Submit</button>
                                                                        </div>
                                                                    </div>
                                                        </div>

                                                    </div>
                                                </div>



                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Documents Tab End -->

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- js -->
    <script src="{{ url('/') }}/userend/assets/vendors/scripts/core.js"></script>
    <script src="{{ url('/') }}/userend/assets/vendors/scripts/script.min.js"></script>
    <script src="{{ url('/') }}/userend/assets/vendors/scripts/process.js"></script>
    <script src="{{ url('/') }}/userend/assets/vendors/scripts/layout-settings.js"></script>
    <script src="{{ url('/') }}/userend/assets/src/plugins/jquery-steps/jquery.steps.js"></script>
    <script src="{{ url('/') }}/userend/assets/vendors/scripts/steps-setting.js"></script>

    <script>
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>

    <!-- Get Ward List -->
    <script>
        $(document).ready(function() {

            $('#ward_id').on('change', function() {
                var idCountry = this.value;
                $("#dept_id").html('');
                $.ajax({
                    url: "{{ url('department_list') }}",
                    type: "POST",
                    data: {
                        ward_id: idCountry,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#dept_id').html('<option value="">Select Ward / ( प्रभाग )</option>');
                        $.each(result.departmentlist, function(key, value) {
                            $("#dept_id").append('<option value="' + value
                                .id + '">' + value.dept_name + '</option>');
                        });

                    }
                });
            });

        });
    </script>

    <!-- Get Taluka List -->
    <script>
        $(document).ready(function () {

            $('#district_id').on('change', function () {
                var idCountry = this.value;
                $("#taluka_id").html('');
                $.ajax({
                    url: "{{url('taluka_list')}}",
                    type: "POST",
                    data: {
                        district_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#taluka_id').html('<option value="">Select Taluka / ( तालुका ) </option>');
                        $.each(result.talukalist, function (key, value) {
                            $("#taluka_id").append('<option value="' + value
                                .id + '">' + value.taluka_name + '</option>');
                        });
                        // $('#taluka_id').html('<option value=""></option>');
                    }
                });
            });

        });
    </script>

    <!-- Future Date Disable -->
    <script>
        $(document).ready(function() {
            var today = new Date();
            $('.date-picker').datepicker({
                format: 'mm-dd-yyyy',
                autoclose: true,
                endDate: "today",
                maxDate: today
            }).on('changeDate', function(ev) {
                $(this).datepicker('hide');
            });


            $('.date-picker').keyup(function() {
                if (this.value.match(/[^0-9]/g)) {
                    this.value = this.value.replace(/[^0-9^-]/g, '');
                }
            });
        });
    </script>

    <script>
        $(document).on('keypress', '#inputTextBox', function(event) {
            var regex = new RegExp("^[a-zA-Z ]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });
    </script>


    <!-- Same as the Name of Applicant. (Jquary) -->
    <script>
        $("#customCheck1").click(function() {

            if ($("#customCheck1").prop('checked') == true) {

                var applicant_title_id = $('#applicant_title_id').val();
                var applicant_fname = $('#applicant_fname').val();
                var applicant_mname = $('#applicant_mname').val();
                var applicant_lname = $('#applicant_lname').val();

                $('#owner_fname').val(applicant_fname);
                $('#owner_mname').val(applicant_mname);
                $('#owner_lname').val(applicant_lname);

                //$('select[name^="owner_title_id"] option[value="'+applicant_title_id+'"]').attr("selected","selected");
                $('#owner_title_id').val(applicant_title_id).change();
            } else {

                $('#owner_fname').val('');
                $('#owner_mname').val('');
                $('#owner_lname').val('');
            }

        });
    </script>

    {{-- <script>
        var input = document.getElementById('age');
        input.onkeydown = function(e) {
            var k = e.which;

            if ((k < 48 || k > 57) && (k < 96 || k > 105) && k != 8) {
                e.preventDefault();
                return false;
            }
        };
    </script> --}}

    {{-- <script>
        var input = document.getElementById('month');
        input.onkeydown = function(e) {
            var k = e.which;

            if ((k < 48 || k > 57) && (k < 96 || k > 105) && k != 8) {
                e.preventDefault();
                return false;
            }
        };

        $('.btnNext').click(function() {
            $('.nav-tabs > .active').next('li').find('a').trigger('click');
        });

        $('.btnPrevious').click(function() {
            $('.nav-tabs > .active').prev('li').find('a').trigger('click');
        });
    </script> --}}

    <script>
        function showRelevantDiv() {
            debugger
            var div1 = document.getElementById('div1');
            var div2 = document.getElementById('div2');
            var businessPlaceInput = $('#business_place').val();

            // Check if the input value exists
            if (businessPlaceInput === undefined || businessPlaceInput === null) {
                console.error('The value of #business_place is undefined or null.');
                return;
            }


            var selectedValue = businessPlaceInput.trim();

            // Hide both divs initially
            div1.style.display = 'none';
            div2.style.display = 'none';

            // Show the relevant div based on the selected option
            if (selectedValue==1) {
                div1.style.display = 'block';
            } else if (selectedValue == 2) {
                div2.style.display = 'block';
            }
        }

        // Run the function when the page loads
        $(document).ready(function() {
            showRelevantDiv();
        });

        $('#business_place').on('change', function() {
        showRelevantDiv();
    });
    </script>


<script>
    function changetab(current_button, current_tab, next_tab) {
        // alert(1)
        $(current_button).removeClass('active');
        $(current_tab).removeClass('active');
        $(next_tab).addClass('active');
    }
</script>
</body>

</html>
