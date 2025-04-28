<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title> PMC Cold Storage Application</title>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>

</head>

<style>
    .error {
        color: red;
    }

    .wizard-content .wizard>.steps>ul>li.current>a {
        color: #1b00ff;
        font-size: 18px;
        cursor: default;
        font-weight: bolder;
    }

    .wizard-content .wizard>.steps>ul>li.current .step {
        border-color: #1b00ff;
        background-color: #fff;
        color: #1b00ff;
    }

    .wizard-content .wizard>.actions>ul>li>a {
        background: #1b00ff;
        color: #fff;
        display: block;
        padding: 7px 12px;
        border-radius: 4px;
        border: 1px solid transparent;
        min-width: 100px;
        text-align: center;
    }

    .wizard-content .wizard>.actions>ul>li>a[href="#previous"] {
        background-color: #fff;
        color: #1b00ff;
        border: 1px solid #1b00ff;
    }

    .wizard-content .wizard>.steps>ul>li.done .step {
        background-color: #1b00ff;
        border-color: #1b00ff;
        color: #fff;
    }

    .wizard-content .wizard.wizard-circle>.steps>ul>li:after,
    .wizard-content .wizard.wizard-circle>.steps>ul>li:before {
        top: 45px;
        width: 50%;
        height: 3px;
        background-color: #1b00ff;
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
                                <h4>Cold Storage view Application</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>

                                    <li class="breadcrumb-item active" aria-current="page">Cold Storage view Application</li>
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



                <section class="content">
                    <div class="body_scroll">
                        <!--<div class="block-header">-->
                        <!--    <div class="row">-->
                        <!--        <div class="col-lg-7 col-md-6 col-sm-12">-->
                        <!--            <h2>Cold Storage Application</h2>-->
                        <!--            <ul class="breadcrumb">-->
                        <!--                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>-->
                        <!--<li class="breadcrumb-item"><a href="{{ url('/#') }}">PET Application</a></li>-->
                        <!--                <li class="breadcrumb-item active">Cold Storage Application</li>-->
                        <!--            </ul>-->
                        <!--            <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>-->
                        <!--        </div>-->

                        <!--        <div class="col-lg-5 col-md-6 col-sm-12">-->
                        <!--            <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->

                        <div class="container-fluid">
                            <!-- Vertical Layout -->
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="body" style="padding: 25px;">
                                            <form method="post" action="{{ url('#') }}" class="form-horizontal" enctype="multipart/form-data">
                                                @csrf

                                                <div class="pd-20 card-box mb-30">
                                                    <section class="pt-3">
                                                        <strong class="pt-2 text-primary">
                                                            Basic Details / ( मूलभूत तपशील )
                                                        </strong>
                                                        <hr>
                                                        <?php //print_r($meat_registration_view);exit;
                                                        ?>

                                                        <strong class="pb-1">Name of Applicant / ( अर्जदाराचे नाव ) : <span style="color:red;">*</span> </strong>
                                                        <div class="form-group row">
                                                            <?php
                                                            $applicant_title_id = '';

                                                            if ($meat_registration_view->applicant_title_id == 1) {
                                                                $applicant_title_id = 'Kum.';
                                                            } elseif ($meat_registration_view->applicant_title_id == 2) {
                                                                $applicant_title_id = 'M/s';
                                                            } elseif ($meat_registration_view->applicant_title_id == 3) {
                                                                $applicant_title_id = 'Smt.';
                                                            } elseif ($meat_registration_view->applicant_title_id == 4) {
                                                                $applicant_title_id = 'Ms.';
                                                            } elseif ($meat_registration_view->applicant_title_id == 5) {
                                                                $applicant_title_id = 'Mr.';
                                                            } elseif ($meat_registration_view->applicant_title_id == 6) {
                                                                $applicant_title_id = 'MrS.';
                                                            } elseif ($meat_registration_view->applicant_title_id == 7) {
                                                                $applicant_title_id = 'Dr.';
                                                            }

                                                            ?>


                                                            <div class="col-sm-3 col-md-3 p-2">
                                                                <input class="form-control " value="{{ $applicant_title_id }}" readonly>
                                                            </div>


                                                            <div class="col-sm-3 col-md-3 p-2">
                                                                <input class="form-control " value="{{ $meat_registration_view->applicant_fname }}" readonly>
                                                            </div>


                                                            <div class="col-sm-3 col-md-3 p-2">
                                                                <input class="form-control " value="{{ $meat_registration_view->applicant_mname }}" readonly>
                                                            </div>


                                                            <div class="col-sm-3 col-md-3 p-2">
                                                                <input class="form-control " value="{{ $meat_registration_view->applicant_lname }}" readonly>
                                                            </div>
                                                        </div>


                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong>Mobile Number / (मोबाईल नंबर) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input class="form-control " value="{{ $meat_registration_view->mobile_number }}" readonly>

                                                            </div>

                                                            <label class="col-sm-2"><strong>Email Id / (ई - मेल आयडी) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input class="form-control " value="{{ $meat_registration_view->email }}" readonly>
                                                            </div>

                                                            <label class="col-sm-2"><strong>Aadhar Number / (आधार क्रमांक) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input class="form-control " value="{{ $meat_registration_view->aadhar_number }}" readonly>
                                                            </div>
                                                        </div>

                                                        <strong class="pt-2 text-primary">
                                                            Residential Address of Applicant / ( अर्जदाराचा निवासी पत्ता )
                                                        </strong>
                                                        <hr>

                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong>House/Flat Number / <br> (घर/फ्लॅट क्रमांक) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input class="form-control " value="{{ $meat_registration_view->house_number }}" readonly>
                                                            </div>

                                                            <label class="col-sm-2"><strong>House/Building Name / <br> ( घर/इमारतीचे नाव ) :  </strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input class="form-control " value="{{ $meat_registration_view->house_name }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong>Line 1 / <br> ( ओळ १ ): <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input class="form-control " value="{{ $meat_registration_view->street_1 }}" readonly>
                                                            </div>

                                                            <label class="col-sm-2"><strong>Line 2 / <br> ( ओळ २ ) :  </strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input class="form-control " value="{{ $meat_registration_view->street_2 }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong>Area 1 / ( क्षेत्र १ ) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input class="form-control " value="{{ $meat_registration_view->area_1 }}" readonly>
                                                            </div>

                                                            <label class="col-sm-2"><strong>Area 2 / <br> ( क्षेत्र २ ) : </strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input class="form-control " value="{{ $meat_registration_view->area_2 }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <?php
                                                            $country_id = '';

                                                            if ($meat_registration_view->country_id == 1) {
                                                                $country_id = 'India';
                                                            }

                                                            ?>
                                                            <label class="col-sm-2"><strong>Country / <br> ( देश ) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input class="form-control " value="{{ $country_id }}" readonly>
                                                            </div>

                                                            <?php
                                                            $state_id = '';

                                                            if ($meat_registration_view->state_id == 1) {
                                                                $state_id = 'Maharashtra';
                                                            }

                                                            ?>
                                                            <label class="col-sm-2"><strong>State / ( राज्य ) <span style="color:red;">*</span>: </strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input class="form-control " value="{{ $state_id }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong>District / <br> ( जिल्हा ) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input class="form-control " value="{{ $meat_registration_view->dist_name }}" readonly>
                                                            </div>

                                                            <label class="col-sm-2"><strong>Taluka / <br> ( तालुका ) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input class="form-control " value="{{ $meat_registration_view->taluka_name }}" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong>Zip Code / <br> ( पिनकोड ): <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input class="form-control " value="{{ $meat_registration_view->zipcode }}" readonly>
                                                            </div>


                                                        </div>

                                                        <strong class="pt-2 text-primary">
                                                            Business Details / ( व्यवसाय तपशील )
                                                        </strong>
                                                        <hr>

                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong>Name of the business / (व्यवसायाचे नाव) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input class="form-control " value="{{ $meat_registration_view->business_name }}" readonly>
                                                            </div>
                                                            <label class="col-sm-2"><strong>Meat Type / (मांसाचा प्रकार) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <!--<input readonly class="form-control " value="{{ $commaSeparatedMeatNames }}">-->
                                                                <p>{{ $commaSeparatedMeatNames }}</p>
                                                            </div>
                                                            <label class="col-sm-2"><strong>Per Day Capacity / (प्रतिदिन क्षमता) : <span style="color:red;">*</span> </strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input readonly class="form-control" value="{{ $meat_registration_view->per_day_capacity }}">
                                                            </div>

                                                            <label class="col-sm-2"><strong>Unit / (युनिट) :<span style="color:red;">*</span> </strong></label>
                                                            <!--<div class="col-sm-4 col-md-4 p-2">-->
                                                            <!--    <input readonly class="form-control" value="{{ $meat_registration_view->unit }}">-->
                                                            <!--</div>-->
                                                             <div class="col-sm-4 col-md-4 p-2">
                                                            <select class="form-control custom-select2 @error('unit') is-invalid @enderror"
                                                                    name="unit"
                                                                    id="meat_type"
                                                                    style="width: 100%; height: 38px;">
                                                                <option value="">Select Unit / (युनिट)</option>
                                                                @foreach ($unit_Meat_Type as $item)
                                                                    <option disabled value="{{ $item->id }}"
                                                                        {{ (old('unit') ?? $meat_registration_view->unit) == $item->id ? 'selected' : '' }}>
                                                                        {{ $item->unit_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                            @error('unit') <!-- Updated error checking to match the correct field name -->
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>





                                                        </div>
                                                        <div class="form-group row">

                                                        </div>

                                                        <div class="form-group row">
                                                            <?php
                                                            $provision_water = '';

                                                            if ($meat_registration_view->provision_water == 1) {
                                                                $provision_water = 'Yes';
                                                            }
                                                            if ($meat_registration_view->provision_water == 2) {
                                                                $provision_water = 'No';
                                                            }
                                                            ?>
                                                            <label class="col-sm-2"><strong>Provision of water / (पाण्याची व्यवस्था आहे का ?) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input readonly class="form-control" value="{{ $provision_water }}">
                                                            </div>

                                                            <?php
                                                            $provision_electricty = '';

                                                            if ($meat_registration_view->provision_electricty == 1) {
                                                                $provision_electricty = 'Yes';
                                                            }
                                                            if ($meat_registration_view->provision_electricty == 2) {
                                                                $provision_electricty = 'No';
                                                            }
                                                            ?>
                                                            <label class="col-sm-2"><strong>Provision of electricity / (विजेची व्यवस्था आहे का ? ) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input readonly class="form-control" value="{{ $provision_electricty }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="col-sm-12"><strong>Address of the business / (व्यवसायाचा पत्ता) : <span style="color:red;">*</span> </strong></label>
                                                            <div class="col-sm-12 col-md-12 p-2">
                                                                <textarea readonly class="form-control" value="{{ $meat_registration_view->business_address }}" style="height:120px;">{{ $meat_registration_view->business_address }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <?php
                                                            $sewerage_disposing = '';

                                                            if ($meat_registration_view->sewerage_disposing == 1) {
                                                                $sewerage_disposing = 'Yes';
                                                            }
                                                            if ($meat_registration_view->sewerage_disposing == 2) {
                                                                $sewerage_disposing = 'No';
                                                            }
                                                            ?>
                                                            <label class="col-sm-2"><strong>Provision of sewerage for disposing effluent / (सांडपाण्याची भूमिगत गटाराची व्यवस्था आहे का ?) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">
                                                                <input readonly class="form-control" value="{{ $sewerage_disposing }}">
                                                            </div>

                                                            @if (isset($meat_registration_view->prcision_dispose_id))
                                                                <label class="col-sm-2"><strong>If not explain provision to dispose effluent / (नसल्यास सांडपाण्याची विल्हेवाट कशी लावली जाते ) : </strong></label>
                                                                <div class="col-sm-4 col-md-4 p-2">
                                                                    <textarea readonly class="form-control " value="{{ $meat_registration_view->prcision_dispose_id }}" style="height:80px;">{{ $meat_registration_view->prcision_dispose_id }}</textarea>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <?php
                                                        $place = '';

                                                        if ($meat_registration_view->place_id == 1) {
                                                            $place = 'Yes';
                                                        }
                                                        if ($meat_registration_view->place_id == 2) {
                                                            $place = 'No';
                                                        }
                                                        ?>

                                                        <div class="form-group row">
                                                            <label class="col-sm-12">
                                                                <strong>Is place is located at least 50mt. away form <br> Place of worship / educational institute / hospital & clinic <br> (जागेपासून प्रार्थनास्थळे / शिक्षणसंस्था /इस्पितळे व दवाखाने
                                                                    कमीत कमी ५० मीटर पेक्षा जास्त अंतरावर आहेत का ? ) : <span style="color:red;">*</span></strong>
                                                            </label>
                                                            <div class="col-sm-12 col-md-12 ">
                                                                <input readonly class="form-control " value="{{ $place }}">
                                                            </div>
                                                        </div>



                                                        <strong class="pt-2 text-primary">
                                                            Business registration details / ( व्यवसाय नोंदणी तपशील )
                                                        </strong>
                                                        <hr>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong> Registration authority name / (नोंदणी प्राधिकरणाचे नाव) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">

                                                                <input readonly class="form-control" value="{{ $meat_registration_view->regi_authority_name }}">
                                                            </div>

                                                            <label class="col-sm-2"><strong> Registration Number / (नोंदणी क्रमांक) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">

                                                                <input readonly class="form-control" value="{{ $meat_registration_view->register_number }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong> Valid till / (पर्यंत वैध) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4">
                                                                <?php
                                                                $originalDate = $meat_registration_view->valid_till;
                                                                $newDate = date('d-m-Y', strtotime($originalDate));

                                                                ?>
                                                                <input readonly class="form-control" value="{{ $newDate }}">
                                                            </div>
                                                        </div>

                                                        <strong class="pt-2 text-primary">
                                                            Details of business place / ( व्यवसायाच्या ठिकाणाचा तपशील )
                                                        </strong>
                                                        <hr>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2"><strong> Area of business place(sq/mtr) / (व्यवसायाच्या ठिकाणाचे क्षेत्रफळ (चौरस/मीटर) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">

                                                                <input readonly class="form-control" value="{{ $meat_registration_view->areaof_business_place }}">
                                                            </div>

                                                            <label class="col-sm-2"><strong> Place / (ठिकाण) : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4 p-2">


                                                                <?php
                                                                $business_place = '';

                                                                if ($meat_registration_view->business_place == 1) {
                                                                    $business_place = 'महानगर पालिका बाजार/ Mahanagara Palika Bazar';
                                                                }
                                                                if ($meat_registration_view->business_place == 2) {
                                                                    $business_place = 'खाजगी जागा/ Private space';
                                                                }

                                                                ?>
                                                                <input readonly class="form-control" id="business_place" value="{{ $business_place }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row other_b" id="hidden_div" style="display:none">
                                                            <label class="col-sm-2"><strong> Other : <span style="color:red;">*</span></strong></label>
                                                            <div class="col-sm-4 col-md-4">

                                                                <input readonly class="form-control" value="{{ $meat_registration_view->business_place_other }}">
                                                            </div>
                                                        </div>

                                                        <strong class="pt-2 text-primary">
                                                            Upload Document / ( दस्तऐवज अपलोड करा )
                                                        </strong>
                                                        <br>
                                                        <!--<br>-->
                                                        <!--<strong class="text-danger text-justify "> -->
                                                        <!--    Note :- please attach attested photocopies of document-->
                                                        <!--</strong><br>-->
                                                        <!--<strong class="text-danger text-justify ">-->
                                                        <!--    टीप :- कृपया दस्तऐवजाच्या साक्षांकित छायाप्रती संलग्न करा  -->
                                                        <!--</strong>-->
                                                        <hr>
                                                        <div id="div2" style="display: none;">
                                                            <div class="form-group row">

                                                                <label class="col-sm-2"><strong>Upload ID proof (Adharcard) of the applicant <br> (अर्जदाराचा आयडी पुरावा (आधारकार्ड) अपलोड करा ) : <span style="color:red;">*</span></strong></label>
                                                                <div class="col-sm-4 col-md-4 p-2">
                                                                    <a href="{{ url('/') }}/PMC_Cold_Storage/meat_file/adharcard_doc/{{ $meat_registration_view->adharcard_doc }}" target="_blank">
                                                                        <div class="form-group">
                                                                            <?php $document_path = $meat_registration_view->adharcard_doc;
                                                           $filter_path =  explode(".",$document_path);
                                                           $size_of_array = count($filter_path);
                                                           $filter_ext = $filter_path[$size_of_array - 1];

                                                        if($filter_ext == 'jpg' || $filter_ext=='jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                        $filter_ext == 'JPG' || $filter_ext=='JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF' )
                                                           {?>
                                                                            <p class="mt-3 mb-0" id="image_div">
                                                                                <img src="{{ url('/') }}/PMC_Cold_Storage/meat_file/adharcard_doc/{{ $meat_registration_view->adharcard_doc }}  " alt="image" class="img-fluid rounded"
                                                                                    width="200" height="100" style="max-height:150px;">
                                                                            </p>
                                                                            <?php }
                                                                else{
                                                                    ?>
                                                                            <a href="{{ url('/') }}/PMC_Cold_Storage/meat_file/adharcard_doc/{{ $meat_registration_view->adharcard_doc }}" target="_blank">
                                                                                <p class="mt-3 mb-0" id="image_div">
                                                                                    <button type="button"class="btn btn-info">
                                                                                        View File
                                                                                    </button>
                                                                                </p>
                                                                            </a>
                                                                            <?php }?>
                                                                        </div>
                                                                    </a>

                                                                </div>

                                                                <label class="col-sm-2"><strong>Upload Ration card, electricity / telephone bill. <br> ( रेशन कार्ड, वीज / टेलिफोन बिल अपलोड करा ) : <span style="color:red;">*</span></strong></label>
                                                                <div class="col-sm-4 col-md-4 p-2">

                                                                    <a href="{{ url('/') }}/PMC_Cold_Storage/meat_file/residitional_proof_doc/{{ $meat_registration_view->residitional_proof_doc }}" target="_blank">
                                                                        <div class="form-group">
                                                                            <?php $document_path = $meat_registration_view->residitional_proof_doc;
                                                           $filter_path =  explode(".",$document_path);
                                                           $size_of_array = count($filter_path);
                                                           $filter_ext = $filter_path[$size_of_array - 1];

                                                        if($filter_ext == 'jpg' || $filter_ext=='jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                        $filter_ext == 'JPG' || $filter_ext=='JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF' )
                                                           {?>
                                                                            <p class="mt-3 mb-0" id="image_div">
                                                                                <img src="{{ url('/') }}/PMC_Cold_Storage/meat_file/residitional_proof_doc/{{ $meat_registration_view->residitional_proof_doc }}" alt="image"
                                                                                    class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                                                                            </p>
                                                                            <?php }
                                                                else{
                                                                    ?>
                                                                            <a href="{{ url('/') }}/PMC_Cold_Storage/meat_file/residitional_proof_doc/{{ $meat_registration_view->residitional_proof_doc }} " target="_blank">
                                                                                <p class="mt-3 mb-0" id="image_div">
                                                                                    <button type="button"class="btn btn-info">
                                                                                        View File
                                                                                    </button>
                                                                                </p>
                                                                            </a>
                                                                            <?php }?>
                                                                        </div>
                                                                    </a>
                                                                </div>

                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2"><strong>Upload legal document of the business place <br> ( व्यवसायाच्या ठिकाणाचे कायदेशीर दस्तऐवज अपलोड करा ) : <span
                                                                            style="color:red;">*</span></strong></label>
                                                                <div class="col-sm-4 col-md-4 p-2">

                                                                    <a href="{{ url('/') }}/PMC_Cold_Storage/meat_file/legal_business_doc/{{ $meat_registration_view->legal_business_doc }}" target="_blank">
                                                                        <div class="form-group">
                                                                            <?php $document_path = $meat_registration_view->legal_business_doc;
                                                           $filter_path =  explode(".",$document_path);
                                                           $size_of_array = count($filter_path);
                                                           $filter_ext = $filter_path[$size_of_array - 1];

                                                        if($filter_ext == 'jpg' || $filter_ext=='jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                        $filter_ext == 'JPG' || $filter_ext=='JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF' )
                                                           {?>
                                                                            <p class="mt-3 mb-0" id="image_div">
                                                                                <img src="{{ url('/') }}/PMC_Cold_Storage/meat_file/legal_business_doc/{{ $meat_registration_view->legal_business_doc }} " alt="image"
                                                                                    class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                                                                            </p>
                                                                            <?php }
                                                                else{
                                                                    ?>
                                                                            <a href="{{ url('/') }}/PMC_Cold_Storage/meat_file/legal_business_doc/{{ $meat_registration_view->legal_business_doc }}" target="_blank">
                                                                                <p class="mt-3 mb-0" id="image_div">
                                                                                    <button type="button"class="btn btn-info">
                                                                                        View File
                                                                                    </button>
                                                                                </p>
                                                                            </a>
                                                                            <?php }?>
                                                                        </div>
                                                                    </a>
                                                                </div>

                                                                <label class="col-sm-2"><strong>Upload business registration certificate <br> ( व्यवसाय नोंदणी प्रमाणपत्र अपलोड करा ) : </strong></label>

                                                        <div class="col-sm-4 col-md-4 p-2">
    <div class="form-group">
        <?php
        // Check if the business registration document exists
        if (!empty($meat_registration_view->business_registration_doc)) {
            $document_path = $meat_registration_view->business_registration_doc;
            $filter_path = explode(".", $document_path);
            $size_of_array = count($filter_path);
            $filter_ext = strtolower($filter_path[$size_of_array - 1]); // Convert extension to lowercase

            // Check if the file is an image
            if ($filter_ext == 'jpg' || $filter_ext == 'jpeg' || $filter_ext == 'png' || $filter_ext == 'gif') {
                ?>
                <p class="mt-3 mb-0" id="image_div">
                    <img src="{{ url('/') }}/PMC_Cold_Storage/meat_file/business_registration_doc/{{ $meat_registration_view->business_registration_doc }}" alt="image"
                        class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                </p>
                <?php
            } else {
                // If the file is not an image, you can display a message
                ?>
                <!--<p class="mt-3 mb-0 text-warning">File format not supported for preview.</p>-->
                <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/business_registration_doc/{{ $meat_registration_view->business_registration_doc }}" target="_blank">
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
                                                                <label class="col-sm-2"><strong>Upload receipt of recently paid property tax <br> ( नुकत्याच भरलेल्या मालमत्ता कराची पावती अपलोड करा ): </strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">
    <div class="form-group">
        <?php
        // Check if the property tax document exists
        if (!empty($meat_registration_view->property_tax_doc)) {
            $document_path = $meat_registration_view->property_tax_doc;
            $filter_path = explode(".", $document_path);
            $size_of_array = count($filter_path);
            $filter_ext = strtolower($filter_path[$size_of_array - 1]); // Convert extension to lowercase

            // Check if the file is an image
            if ($filter_ext == 'jpg' || $filter_ext == 'jpeg' || $filter_ext == 'png' || $filter_ext == 'gif') {
                ?>
                <p class="mt-3 mb-0" id="image_div">
                    <img src="{{ url('/') }}/PMC_Cold_Storage/meat_file/property_tax_doc/{{ $meat_registration_view->property_tax_doc }}" alt="image"
                        class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                </p>
                <?php
            } else {
                // If the file is not an image, display a message
                ?>
                <!--<p class="mt-3 mb-0 text-warning">File format not supported for preview.</p>-->
                <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/property_tax_doc/{{ $meat_registration_view->property_tax_doc }}" target="_blank">
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


                                                                <label class="col-sm-2"><strong>Upload receipt of recently paid water ( पानी पट्टी पावती अपलोड करा ) : </strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">
    <div class="form-group">
        <?php
        // Check if the paid water document exists
        if (!empty($meat_registration_view->paid_water_doc)) {
            $document_path = $meat_registration_view->paid_water_doc;
            $filter_path = explode(".", $document_path);
            $size_of_array = count($filter_path);
            $filter_ext = strtolower($filter_path[$size_of_array - 1]); // Convert extension to lowercase

            // Check if the file is an image
            if ($filter_ext == 'jpg' || $filter_ext == 'jpeg' || $filter_ext == 'png' || $filter_ext == 'gif') {
                ?>
                <p class="mt-3 mb-0" id="image_div">
                    <img src="{{ url('/') }}/PMC_Cold_Storage/meat_file/paid_water_doc/{{ $meat_registration_view->paid_water_doc }}" alt="image"
                        class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                </p>
                <?php
            } else {
                // If the file is not an image, display a message
                ?>
                <!--<p class="mt-3 mb-0 text-warning">File format not supported for preview.</p>-->
                <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/paid_water_doc/{{ $meat_registration_view->paid_water_doc }}" target="_blank">
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

                                                                <label class="col-sm-2"><strong>Upload details & authority letter from authorized slaughter house / poultry form & authority letter <br>( अधिकृत कुक्कुट पालन करणाऱ्या संस्थेचे व
                                                                        कत्तलखाण्याची माहिती ई संमातीपत्र अपलोड करा ) : </strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">
    <div class="form-group">
        <?php
        // Check if the slaughter letter document exists
        if (!empty($meat_registration_view->slaughter_letter_doc)) {
            $document_path = $meat_registration_view->slaughter_letter_doc;
            $filter_path = explode(".", $document_path);
            $size_of_array = count($filter_path);
            $filter_ext = strtolower($filter_path[$size_of_array - 1]); // Convert extension to lowercase

            // Check if the file is an image
            if ($filter_ext == 'jpg' || $filter_ext == 'jpeg' || $filter_ext == 'png' || $filter_ext == 'gif') {
                ?>
                <p class="mt-3 mb-0" id="image_div">
                    <img src="{{ url('/') }}/PMC_Cold_Storage/meat_file/slaughter_letter_doc/{{ $meat_registration_view->slaughter_letter_doc }}" alt="image"
                        class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                </p>
                <?php
            } else {
                // If the file is not an image, display a message
                ?>
                <!--<p class="mt-3 mb-0 text-warning">File format not supported for preview.</p>-->
                <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/slaughter_letter_doc/{{ $meat_registration_view->slaughter_letter_doc }}" target="_blank">
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


                                                                <label class="col-sm-2"><strong>Upload pest control treatment certificate issued from authorized agency <br> ( नोंदणीकृत संस्थेकडून कीटनाशक फवारणी केल्याचे प्रमाणपत्र अपलोड करा ): <span
                                                                            style="color:red;"></span></strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">
    <div class="form-group">
        <?php
        // Check if the treatment authorized document exists
        if (!empty($meat_registration_view->treatment_authorized_doc)) {
            $document_path = $meat_registration_view->treatment_authorized_doc;
            $filter_path = explode(".", $document_path);
            $size_of_array = count($filter_path);
            $filter_ext = strtolower($filter_path[$size_of_array - 1]); // Convert extension to lowercase

            // Check if the file is an image
            if ($filter_ext == 'jpg' || $filter_ext == 'jpeg' || $filter_ext == 'png' || $filter_ext == 'gif') {
                ?>
                <p class="mt-3 mb-0" id="image_div">
                    <img src="{{ url('/') }}/PMC_Cold_Storage/meat_file/treatment_authorized_doc/{{ $meat_registration_view->treatment_authorized_doc }}" alt="image"
                        class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                </p>
                <?php
            } else {
                // If the file is not an image, display a message
                ?>
                <!--<p class="mt-3 mb-0 text-warning">File format not supported for preview.</p>-->
                <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/treatment_authorized_doc/{{ $meat_registration_view->treatment_authorized_doc }}" target="_blank">
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
                                                                <label class="col-sm-2"><strong>Upload medical fitness certificate of workers
                                                                        issued by registered general practitioner <br> ( कामगारांचे वैद्यकीय फिटनेस प्रमाणपत्र अपलोड करा नोंदणीकृत जनरल प्रॅक्टिशनरने): </strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">
    <div class="form-group">
        <?php
        // Check if the fitness certificate document exists
        if (!empty($meat_registration_view->fitness_certificate_doc)) {
            $document_path = $meat_registration_view->fitness_certificate_doc;
            $filter_path = explode(".", $document_path);
            $size_of_array = count($filter_path);
            $filter_ext = strtolower($filter_path[$size_of_array - 1]); // Convert extension to lowercase

            // Check if the file is an image
            if ($filter_ext == 'jpg' || $filter_ext == 'jpeg' || $filter_ext == 'png' || $filter_ext == 'gif') {
                ?>
                <p class="mt-3 mb-0" id="image_div">
                    <img src="{{ url('/') }}/PMC_Cold_Storage/meat_file/fitness_certificate_doc/{{ $meat_registration_view->fitness_certificate_doc }}" alt="image"
                        class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                </p>
                <?php
            } else {
                // If the file is not an image, display a message
                ?>
                <!--<p class="mt-3 mb-0 text-warning">File format not supported for preview.</p>-->
                <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/fitness_certificate_doc/{{ $meat_registration_view->fitness_certificate_doc }}" target="_blank">
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




                                                                <label class="col-sm-2"><strong>Upload Factory registration and license to operate the factory <br> (कारखाना नोंदणी व कारखाना चालवण्याचा परवाना ): </strong></label>
                                                              <div class="col-sm-4 col-md-4 p-2">
    <div class="form-group">
        <?php
        // Check if the Factory registration and license document exists
        if (!empty($meat_registration_view->Factory_reg_and_license_doc)) {
            $document_path = $meat_registration_view->Factory_reg_and_license_doc;
            $filter_path = explode(".", $document_path);
            $size_of_array = count($filter_path);
            $filter_ext = strtolower($filter_path[$size_of_array - 1]); // Convert extension to lowercase

            // Check if the file is an image
            if ($filter_ext == 'jpg' || $filter_ext == 'jpeg' || $filter_ext == 'png' || $filter_ext == 'gif') {
                ?>
                <p class="mt-3 mb-0" id="image_div">
                    <img src="{{ url('/') }}/PMC_Cold_Storage/meat_file/Factory_reg_and_license_doc/{{ $meat_registration_view->Factory_reg_and_license_doc }}" alt="image"
                        class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                </p>
                <?php
            } else {
                // If the file is not an image, display a message
                ?>
                <!--<p class="mt-3 mb-0 text-warning">File format not supported for preview.</p>-->
                <a href="{{url('/')}}/PMC_Cold_Storage/meat_file/Factory_reg_and_license_doc/{{ $meat_registration_view->Factory_reg_and_license_doc }}" target="_blank">
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


                                                                <label class="col-sm-2"><strong>Upload FSSAI Registration Certificate <br> (FSSAI नोंदणी प्रमाणपत्र अपलोड करा ) : <span
                                                                            style="color:red;"></span></strong></label>
                                                               <div class="col-sm-4 col-md-4 p-2">

    <a href="{{ url('/') }}/PMC_Cold_Storage/meat_file/issued_doc/{{ $meat_registration_view->issued_doc }}" target="_blank">
                                                                        <div class="form-group">
                                                                            <?php $document_path = $meat_registration_view->issued_doc;
                                                                            $filter_path =  explode(".",$document_path);
                                                                            $size_of_array = count($filter_path);
                                                                            $filter_ext = $filter_path[$size_of_array - 1];

                                                                            if($filter_ext == 'jpg' || $filter_ext=='jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                                            $filter_ext == 'JPG' || $filter_ext=='JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF' )
                                                                            {?>
                                                                            <p class="mt-3 mb-0" id="image_div">
                                                                                <img src="{{ url('/') }}/PMC_Cold_Storage/meat_file/issued_doc/{{ $meat_registration_view->issued_doc }} " alt="image"
                                                                                    class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                                                                            </p>
                                                                            <?php }
                                                                else{
                                                                    ?>
                                                                            <a href="{{ url('/') }}/PMC_Cold_Storage/meat_file/issued_doc/{{ $meat_registration_view->issued_doc }}" target="_blank">
                                                                                <p class="mt-3 mb-0" id="image_div">
                                                                                    <button type="button"class="btn btn-info">
                                                                                        View File
                                                                                    </button>
                                                                                </p>
                                                                            </a>
                                                                            <?php }?>
                                                                        </div>
                                                                    </a>
</div>

                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2"><strong>Upload applicant signature / ( अर्जदाराची स्वाक्षरी अपलोड करा ) : <span style="color:red;">*</span></strong></label>
                                                                <div class="col-sm-4 col-md-4 p-2">

                                                                    <a href="{{ url('/') }}/PMC_Cold_Storage/meat_file/applicant_signature/{{ $meat_registration_view->applicant_signature }}" target="_blank">
                                                                        <div class="form-group">
                                                                            <?php $document_path = $meat_registration_view->applicant_signature;
                                                           $filter_path =  explode(".",$document_path);
                                                           $size_of_array = count($filter_path);
                                                           $filter_ext = $filter_path[$size_of_array - 1];

                                                        if($filter_ext == 'jpg' || $filter_ext=='jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                        $filter_ext == 'JPG' || $filter_ext=='JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF' )
                                                           {?>
                                                                            <p class="mt-3 mb-0" id="image_div">
                                                                                <img src="{{ url('/') }}/PMC_Cold_Storage/meat_file/applicant_signature/{{ $meat_registration_view->applicant_signature }} " alt="image"
                                                                                    class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                                                                            </p>
                                                                            <?php }
                                                                else{
                                                                    ?>
                                                                            <a href="{{ url('/') }}/PMC_Cold_Storage/meat_file/applicant_signature/{{ $meat_registration_view->applicant_signature }}" target="_blank">
                                                                                <p class="mt-3 mb-0" id="image_div">
                                                                                    <button type="button"class="btn btn-info">
                                                                                        View File
                                                                                    </button>
                                                                                </p>
                                                                            </a>
                                                                            <?php }?>
                                                                        </div>
                                                                    </a>
                                                                </div>

                                                                <label class="col-sm-2"><strong>Upload applicant profile photo / ( अर्जदाराचा प्रोफाइल फोटो अपलोड करा ): <span style="color:red;">*</span></strong></label>
                                                                <div class="col-sm-4 col-md-4 p-2">

                                                                    <a href="{{ url('/') }}/PMC_Cold_Storage/meat_file/profile_photo/{{ $meat_registration_view->profile_photo }}" target="_blank">
                                                                        <div class="form-group">
                                                                            <?php $document_path = $meat_registration_view->profile_photo;
                                                           $filter_path =  explode(".",$document_path);
                                                           $size_of_array = count($filter_path);
                                                           $filter_ext = $filter_path[$size_of_array - 1];

                                                        if($filter_ext == 'jpg' || $filter_ext=='jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                        $filter_ext == 'JPG' || $filter_ext=='JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF' )
                                                           {?>
                                                                            <p class="mt-3 mb-0" id="image_div">
                                                                                <img src="{{ url('/') }}/PMC_Cold_Storage/meat_file/profile_photo/{{ $meat_registration_view->profile_photo }} " alt="image" class="img-fluid rounded"
                                                                                    width="200" height="100" style="max-height:150px;">
                                                                            </p>
                                                                            <?php }
                                                                else{
                                                                    ?>
                                                                            <a href="{{ url('/') }}/PMC_Cold_Storage/meat_file/profile_photo/{{ $meat_registration_view->profile_photo }}" target="_blank">
                                                                                <p class="mt-3 mb-0" id="image_div">
                                                                                    <button type="button"class="btn btn-info">
                                                                                        View File
                                                                                    </button>
                                                                                </p>
                                                                            </a>
                                                                            <?php }?>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="div1" style="display: none;">
                                                            <div class="form-group row">
                                                                <label class="col-sm-2"><strong>Upload Municipal Corporation Permission Letter <br> (महापालिकेचे परवानगी पत्र करा ) : <span style="color:red;">*</span></strong></label>
                                                                <div class="col-sm-4 col-md-4 p-2">

                                                                    <a href="{{ url('/') }}/PMC_Cold_Storage/meat_file/municipal_corpor_doc/{{ $meat_registration_view->municipal_corpor_doc }}" target="_blank">
                                                                        <div class="form-group">
                                                                            <?php $document_path = $meat_registration_view->municipal_corpor_doc;
                                                           $filter_path =  explode(".",$document_path);
                                                           $size_of_array = count($filter_path);
                                                           $filter_ext = $filter_path[$size_of_array - 1];

                                                            if($filter_ext == 'jpg' || $filter_ext=='jpeg' || $filter_ext == 'png' || $filter_ext == 'gif' ||
                                                            $filter_ext == 'JPG' || $filter_ext=='JPEG' || $filter_ext == 'PNG' || $filter_ext == 'GIF' )
                                                            {?>
                                                                            <p class="mt-3 mb-0" id="image_div">
                                                                                <img src="{{ url('/') }}/PMC_Cold_Storage/meat_file/municipal_corpor_doc/{{ $meat_registration_view->municipal_corpor_doc }} " alt="image"
                                                                                    class="img-fluid rounded" width="200" height="100" style="max-height:150px;">
                                                                            </p>
                                                                            <?php }
                                                                else{
                                                                    ?>
                                                                            <a href="{{ url('/') }}/PMC_Cold_Storage/meat_file/municipal_corpor_doc/{{ $meat_registration_view->municipal_corpor_doc }}" target="_blank">
                                                                                <p class="mt-3 mb-0" id="image_div">
                                                                                    <button type="button"class="btn btn-info">
                                                                                        View File
                                                                                    </button>
                                                                                </p>
                                                                            </a>
                                                                            <?php }?>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            </div>
                                                            <div class="form-group row mt-4">
                                                                <label class="col-md-3"></label>
                                                                <div class="col-md-9" style="display: flex; justify-content: flex-end;">
                                                                    <a href="{{ url('/user/appli_form/') }}"><button type="button" class="btn btn-danger">Cancel</button></a>&nbsp;&nbsp;


                                                                </div>
                                                        </div>
                                                    </section>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


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
        function printDiv(divName) {
            $("#print").css("display", "none");
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            $("#print").css("display", "block");
            // location.reload();

        }
    </script>
    <script>
        function showRelevantDiv() {
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
            if (selectedValue.includes('महानगर पालिका बाजार')) {
                div1.style.display = 'block';
            } else if (selectedValue.includes('खाजगी जागा')) {
                div2.style.display = 'block';
            }
        }

        // Run the function when the page loads
        $(document).ready(function() {
            showRelevantDiv();
        });
    </script>

</body>

</html>
