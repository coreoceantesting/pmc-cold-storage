@include('common.header')



<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    @if ($status == 0)
                        <h2>Pending Cold Storage Renewal Application</h2>
                    @elseif ($status == 1)
                        <h2>Approve Cold Storage Renewal Application</h2>
                    @elseif ($status == 2)
                        <h2>Reject Cold Storage Renewal Application</h2>
                    @endif
                    
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/hod/dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                      
                        <li class="breadcrumb-item active">
                            @if ($status == 0)
                                Pending Cold Storage Renewal Application
                            @elseif ($status == 1)
                                Approve Cold Storage Renewal Application
                            @elseif ($status == 2)
                                Reject Cold Storage Renewal Application
                            @endif
                        </li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                @if ($status == 0)
                                    <strong style="text-transform: capitalize;">Pending Cold Storage Renewal Application</strong>
                                @elseif ($status == 1)
                                    <strong style="text-transform: capitalize;">Approve Cold Storage Renewal Application</strong>
                                @elseif ($status == 2)
                                    <strong style="text-transform: capitalize;">Reject Cold Storage Renewal Application</strong>
                                @endif
                                
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover data-table js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Cold Storage Renewal License no.</th>
                                            <th>Applicant Full Name</th>
                                            <th>District Name</th>
                                            <th>Taluka Name</th>
                                            <th>Business Name</th>
                                            <!--<th>Business Type</th>-->
                                            <th>Meat Name</th>
                                            <th>Per day capacity</th>
                                            @if (($status == 2))
                                             <th>Reasons for Rejection</th>
                                            
                                             @endif
                                            <th>View Details</th>
                                             <!-- @if ($status == 1)
                                             <th>Generate Certificate</th>
                                             <th>Affidavit </th>
                                            @endif
                                             @if (($status == 2))
                                             <th>Reasons for Rejection</th>
                                            
                                             @endif -->
        								</tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($meat_renewal_list as $key => $value)
                                            <tr>
                                                <td><b>{{ $key+1 }}</b></td>
                                                <td><b>{{ $value->renwal_liceans_no }}</b></td>
                                                <?php
                                                    $applicant_title_id = '';
                                                    
                                                    if($value->applicant_title_id == 1)
                                                    {
                                                        $applicant_title_id = 'Kum.';
                                                    }
                                                    else if($value->applicant_title_id == 2)
                                                    {
                                                        $applicant_title_id = 'M/s';
                                                    }
                                                    else if($value->applicant_title_id == 3)
                                                    {
                                                        $applicant_title_id = 'Smt.';
                                                    }
                                                    else if($value->applicant_title_id == 4)
                                                    {
                                                        $applicant_title_id = 'Ms.';
                                                    }
                                                    else if($value->applicant_title_id == 5)
                                                    {
                                                        $applicant_title_id = 'Mr.';
                                                    }
                                                    else if($value->applicant_title_id == 6)
                                                    {
                                                        $applicant_title_id = 'MrS.';
                                                    }
                                                    else if($value->applicant_title_id == 7)
                                                    {
                                                        $applicant_title_id = 'Dr.';
                                                    }
                                                ?>
                                                <td>{{ $applicant_title_id }} {{ $value->applicant_fname }} {{ $value->applicant_mname }} {{ $value->applicant_lname }}</td>
                                                <td>{{ $value->dist_name }}</td>
                                                <td>{{ $value->taluka_name }}</td>
                                                <td>{{ $value->business_name }}</td>
                                                <?php
                                                    $business_type = '';
                                                    
                                                    if($value->business_type == 1)
                                                    {
                                                        $business_type = 'Butcher Shop ( मांस  विक्री  केंद्र )';
                                                    }
                                                    else if($value->business_type == 2)
                                                    {
                                                        $business_type = 'Meat Processing Plant ( मांस  प्रक्रिया   केंद्र  )';
                                                    }
                                                    else if($value->business_type == 3)
                                                    {
                                                        $business_type = 'Transportation of Meat ( मांसाची  वाहतूक )';
                                                    }
                                                    else if($value->business_type == 4)
                                                    {
                                                        $business_type = 'Other ( इतर )';
                                                    }
                                                ?>
                                                <!--<td>{{ $business_type }}</td>-->
                                                <td>{{ $value->meat_name }}</td>
                                                <td>{{ $value->per_day_capacity }}</td>

                                                @if($value->re_hod_status == '2')
                								<td>{{ $value->reason_for_rejection_hod }}</td>
                								@endif 
            									<td>
                                                    <a href='{{ url("/hod_cold_storage_renewal_view/{$value->id}/{$value->re_hod_status}") }}' class="btn btn-info btn-sm text-light">
                                                        <i class="zmdi zmdi-eye"></i>
                                                    </a>
                                                </td>
                                               
                                                 <!-- <td>
                                                     
                                                    <a href='{{ url("/generate_english_coldstorage_renewal_pdf/{$value->id}/{$value->status}") }}'
                                                        class="btn btn-danger waves-effect waves-float btn-sm waves-green">
                                                        <i class="zmdi zmdi-file"></i> English
                                                    </a>
                                                    &nbsp;&nbsp;
                                                    <a href='{{ url("/generate_marathi_coldstorage_renewal_pdf/{$value->id}/{$value->status}") }}'
                                                        class="btn btn-danger waves-effect waves-float btn-sm waves-green">
                                                        <i class="zmdi zmdi-file"></i> Marathi
                                                    </a>
                                                     
                                                     
                                                     
                                                </td>
                                                <td>
                                                     
                                                      <a href='{{ url("/generate_renewal_affidavit_pdf/{$value->id}/{$value->status}") }}'
                                                        class="btn btn-primary waves-effect waves-float btn-sm waves-green">
                                                        <i class="zmdi zmdi-file"></i> Affidavit
                                                       </a>
                                                      
                                                </td> -->
                                                
                                               
                                                  <?php //if(($value->status == 2) ){ ?>
                                                      
                                                  <!-- <td>{{ $value->reject_resion }}</td>     -->
                                                      <?php  //  } ?>  
            								</tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@include('common.footer')  