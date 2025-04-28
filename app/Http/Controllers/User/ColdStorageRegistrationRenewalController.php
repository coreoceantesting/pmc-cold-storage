<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ColdStorageRegistration_Model;
use App\Models\ColdStorageRenewalLicense_Model;
use App\Models\MeatType_Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ColdStorageRegistrationRenewalController extends Controller
{


  public function create(Request $request,$id,$user_type)
    {

      $unit_Meat_Type = DB::table('unit_Meat_Type')->get();
      if (Auth::guard('meatregistereduser')->check()) {

      $meattype_mst = MeatType_Master::orderBy('id','desc')->pluck('meat_name', 'id')->whereNull('deleted_at');

      $mainid = Auth::guard('meatregistereduser')->user()->id;
    //   dd($mainid);
      $data =   DB::table('coldstorage_registration_tbl AS t1')
                            ->select('t1.*', 't2.meat_name','t3.dist_name','t4.taluka_name',
                                    't5.*','t1.id as registration_id')
                             ->leftJoin('coldstorage_renewal_license_tbl AS t5','t5.register_table_id','=', 't1.id')
                            ->leftJoin('meat_type_mst AS t2', 't2.id', '=', 't1.meat_type')
                            ->leftJoin('mst_dist AS t3', 't3.id', '=', 't1.district_id')
                            ->leftJoin('mst_taluka AS t4', 't4.id', '=', 't1.taluka_id')

                            ->where('t5.id', '=', $id)
                            ->whereNull('t1.deleted_at')
                            ->whereNull('t2.deleted_at')
                            ->whereNull('t3.deleted_at')
                            ->whereNull('t4.deleted_at')
                            ->orderBy('t1.id', 'DESC')
                            ->first();
           if(empty($data)) {

                                return redirect('/')->with('warning','Apply For Cold Storage Registration License First');

                            }elseif($data->approve_date == ""){

                                return redirect('/')->with('warning','Your Application status is still Pending');


                            }else {
            // dd($data);
            //  $approve_date = $data->approve_date;



            // $newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($approve_date)) . " + 1 year"));

            // $currentDate = date('Y-m-d');


            // $timestamp1 = strtotime($currentDate);
            // $timestamp2 = strtotime($newEndingDate);


            // if($timestamp1 > $timestamp2) {



            return view('user.coldstorage_renewal.cold_storage_renewal_form', compact('data','meattype_mst','unit_Meat_Type','id','user_type'));

            // }else{

            //       $diff = $timestamp1 -$timestamp2 ;
            //       $x = abs(floor($diff / (60 * 60 * 24))) ;

            //      return redirect('/')->with('message','Your license has not yet expired. '  .$x.' days Remaining');

            // }
             }
            } else {
            return redirect('/user/login');
        }


    }


     public function store(Request $request)
     {
        //   dd($request->all());
        $mainid = Auth::guard('meatregistereduser')->user()->id;
//  dd($mainid);
      $check =  DB::table('coldstorage_renewal_license_tbl AS t1')
                                        ->select('*')
                                        ->where('t1.register_table_id', '=', $mainid)
                                        ->whereNull('t1.deleted_at')
                                        ->orderBy('t1.id', 'DESC')
                                        // ->whereMonth('inserted_dt', Carbon::now()->month)
                                        ->count();


      if($check > 0){

        return redirect('/')->with('message','You Have already apply this Form.');

      }else{


      $this->validate($request, [

            // Basic Details
            // 'applicant_title_id' => 'required|numeric',
            // 'applicant_fname' => 'required|string',
            // 'applicant_mname' => 'required|string',
            // 'applicant_lname' => 'required|string',

            // 'mobile_number' => 'required|string',
            // 'email' => 'required|string',
            // // 'gender' => 'required|string',
            // 'aadhar_number' => 'required|string',

            // Residential Address of Applicant
            // 'house_number' => 'required|string',
            // 'house_name' => 'required|string',
            // 'street_1' => 'required|string',
            // 'street_2' => 'required|string',
            // 'area_1' => 'required|string',
            // 'area_2' => 'required|string',
            // 'country_id' => 'required|string',
            // 'state_id' => 'required|string',
            // 'district_id' => 'required|string',
            // 'taluka_id' => 'required|string',
            // 'zipcode' => 'required|string',

            // Business Details
            // 'business_name' => 'required|string',
            // 'business_type' => 'required|numeric',
            // 'meat_type' => 'required|string',
            // 'per_day_capacity' => 'required|string',
            // 'provision_water' => 'required|numeric',
            // 'provision_electricty' => 'required|numeric',
            // 'business_address' => 'required|string',
            // 'sewerage_disposing' => 'required|numeric',
            // 'prcision_dispose_id' => 'required|string',
            // 'place_id' => 'required|numeric',

            // 'regi_authority_name' => 'required|string',
            // 'register_number' => 'required|string',
            // 'valid_till' => 'required|string',

            //  'areaof_business_place' => 'required|string',
            //  'business_place' => 'required|numeric',
            //  'property_tax_doc'=> 'required|mimes:jpeg,png,jpg,pdf|max:2048',
            // 'paid_water_doc' =>'required|mimes:jpeg,png,jpg,pdf|max:2048',
            // 'treatment_authorized_doc'=>'required|mimes:jpeg,png,jpg,pdf|max:2048',
            // 'fitness_certificate_doc'=>'required|mimes:jpeg,png,jpg,pdf|max:2048',
            // 'old_licence' => 'required|mimes:jpeg,png,jpg,pdf|max:2048',

         ],[
              // Basic Details
              'applicant_title_id.required' => 'Applicant Title is required',
              'applicant_fname.required' => 'Applicant First Name is required',
              'applicant_mname.required' => 'Applicant Middle Name is required',
              'applicant_lname.required' => 'Applicant Last Name is required',
            //   'appl_dob.required' => 'Date of Birth is required',
            //   'appl_age.required' => 'Age is required',
              'mobile_number.required' => 'Mobile Number is required',
              'email.required' => 'Email Id is required',
            //   'gender.required' => 'Gender is required',
              'aadhar_number.required' => 'Aadhar Number is required',

              // Residential Address of Applicant
              'house_number.required' => 'House Number is required',

              'street_1.required' => 'Street 1 is required',
              'area_1.required' => 'Area 1 is required',
              'country_id.required' => 'Country is required',
              'state_id.required' => 'State is required',
              'district_id.required' => 'District is required',
              'taluka_id.required' => 'Taluka is required',
              'zipcode.required' => 'Zip Code is required',

              // Business Details
              'business_name.required' => 'Name of the business is required',
              'business_type.required' => 'Kind of Business is required',
              'meat_type.required' => 'Meat Type is required',
              'per_day_capacity.required' => 'Per Day Capacity is required',
              'provision_water.required' => 'Provision of water is required',
              'provision_electricty.required' => 'Provision of electricity is required',
              'business_address.required' => 'Address of the business is required',
              'sewerage_disposing.required' => 'Provision of sewerage for disposing effluent is required',

              'place_id.required' => 'Is place is located at least 50mt. away form place of worship / educational institute / hospital & clinic is required',

              'regi_authority_name.required' => 'Registration authority name is required',

              'regi_authority_name.required' => 'Registration authority name is required',
              'register_number.required' => 'Registration nuber is required',
              'valid_till.required' =>     'valid till Date is required',
              'areaof_business_place.required' => 'area of business place is required',

               'business_place.required' => 'business place is required',


              // Upload Document


              // 'adharcard_doc.required' => 'applicant Adharcard is required',
              // 'adharcard_doc.max' => 'The file size should be less than 2MB.',
              // 'adharcard_doc.mimes' => ' Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .',

              // 'residitional_proof_doc.required' => 'Ration card, electricity / telephone bill. is required',
              // 'residitional_proof_doc.max' => 'The file size should be less than 2MB.',
              // 'residitional_proof_doc.mimes' => ' Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .',

              // 'legal_business_doc.required' => 'legal document of the business place is required',
              // 'legal_business_doc.max' => 'The file size should be less than 2MB.',
              // 'legal_business_doc.mimes' => 'Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .',

              // 'business_registration_doc.required' => 'Business registration certificate is required',
              // 'business_registration_doc.max' => 'The file size should be less than 2MB.',
              // 'business_registration_doc.mimes' => ' Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .',



               'property_tax_doc.required' => 'Receipt of recently paid property tax is required',
               'property_tax_doc.max' => 'The file size should be less than 2MB.',
               'property_tax_doc.mimes' => ' Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .',

               'paid_water_doc.required' => 'Receipt of recently paid water is required',
               'paid_water_doc.max' => 'The file size should be less than 2MB.',
               'paid_water_doc.mimes' => ' Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .',


               'treatment_authorized_doc.required' => 'Pest control treatment certificate issued from authorized agency is required',
               'treatment_authorized_doc.max' => 'The file size should be less than 2MB.',
               'treatment_authorized_doc.mimes' => ' Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .',

               'fitness_certificate_doc.required' => 'Medical fitness certificate issued by Municipal hospital is required',
               'fitness_certificate_doc.max' => 'The file size should be less than 2MB.',
               'fitness_certificate_doc.mimes' => ' Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .',

              // 'issued_doc.required' => 'Document issued by APEDA, MPCB(ETP), FSSAI  is required',
              // 'issued_doc.max' => 'The file size should be less than 2MB.',
              // 'issued_doc.mimes' => ' Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .',

              // 'rabies_vaccination_certificate_doc.required' => 'Registration documents of all vehicles is required',
              // 'rabies_vaccination_certificate_doc.max' => 'The file size should be less than 2MB.',
              // 'rabies_vaccination_certificate_doc.mimes' => ' Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .',

              // 'slaughter_letter_doc.required' => 'Details & authority letter from authorized slaughter house / poultry form & authority letter is required',
              // 'slaughter_letter_doc.max' => 'The file size should be less than 2MB.',
              // 'slaughter_letter_doc.mimes' => ' Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .',

              // 'applicant_signature.required' => 'Applicant signature is required',
              // 'applicant_signature.max' => 'The file size should be less than 2MB.',
              // 'applicant_signature.mimes' => ' Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .',

              // 'profile_photo.required' => 'Applicant profile photo is required',
              // 'profile_photo.max' => 'The file size should be less than 2MB.',
              // 'profile_photo.mimes' => ' Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .',

              'old_licence.required' => 'Applicant old licence Copy is required',
              'old_licence.max' => 'The file size should be less than 2MB.',
              'old_licence.mimes' => ' Only files in .jpg, .jpeg, .png, .pdf format can be uploaded .',

             ]);

        $data = new ColdStorageRenewalLicense_Model();

        //  dd($data);

        if ($request->hasFile('adharcard_doc')) {
            $aadharcardFile = $request->file('adharcard_doc');
            $aadharcardName = time() . '_' . $aadharcardFile->getClientOriginalName();
            $aadharcardFile->move(public_path('PMC_Cold_Storage/meat_file/adharcard_doc'), $aadharcardName);
        } else {
            $aadharcardName = $request->input('old_adharcard_doc'); // Use old file
        }

        if ($request->hasFile('residitional_proof_doc')) {
            $residitionalproofFile = $request->file('residitional_proof_doc');
            $residitionalproofName = time() . '_' . $residitionalproofFile->getClientOriginalName();
            $residitionalproofFile->move(public_path('PMC_Cold_Storage/meat_file/residitional_proof_doc'), $residitionalproofName);
        } else {
            $residitionalproofName = $request->input('old_residitional_proof_doc'); // Use old file
        }

        if ($request->hasFile('legal_business_doc')) {
            $legalbusinessFile = $request->file('legal_business_doc');
            $legalbusinessName = time() . '_' . $legalbusinessFile->getClientOriginalName();
            $legalbusinessFile->move(public_path('PMC_Cold_Storage/meat_file/legal_business_doc'), $legalbusinessName);
        } else {
            $legalbusinessName = $request->input('old_legal_business_doc'); // Use old file
        }

        if ($request->hasFile('business_registration_doc')) {
            $businessregiFile = $request->file('business_registration_doc');
            $businessregiName = time() . '_' . $businessregiFile->getClientOriginalName();
            $businessregiFile->move(public_path('PMC_Cold_Storage/meat_file/business_registration_doc'), $businessregiName);
        } else {
            $businessregiName = $request->input('old_business_registration_doc'); // Use old file
        }

        if ($request->hasFile('property_tax_doc')) {
            $propertytaxFile = $request->file('property_tax_doc');
            $propertytaxName = time() . '_' . $propertytaxFile->getClientOriginalName();
            $propertytaxFile->move(public_path('PMC_Cold_Storage/meat_file/property_tax_doc'), $propertytaxName);
        } else {
            $propertytaxName = $request->input('old_property_tax_doc'); // Use old file
        }

        if ($request->hasFile('paid_water_doc')) {
            $paidwaterFile = $request->file('paid_water_doc');
            $paidwaterName = time() . '_' . $paidwaterFile->getClientOriginalName();
            $paidwaterFile->move(public_path('PMC_Cold_Storage/meat_file/paid_water_doc'), $paidwaterName);
        } else {
            $propertytaxName = $request->input('old_paid_water_doc'); // Use old file
        }
        // dd($propertytaxName);


        if ($request->hasFile('slaughter_letter_doc')) {
            $slugletterFile = $request->file('slaughter_letter_doc');
            $slugletterName = time() . '_' . $slugletterFile->getClientOriginalName();
            $slugletterFile->move(public_path('PMC_Cold_Storage/meat_file/slaughter_letter_doc'), $slugletterName);
        } else {
            $slugletterName = $request->input('old_slaughter_letter_doc'); // Use old file
        }
        if ($request->hasFile('treatment_authorized_doc')) {
            $authorizedFile = $request->file('treatment_authorized_doc');
            $authorizedName = time() . '_' . $authorizedFile->getClientOriginalName();
            $authorizedFile->move(public_path('PMC_Cold_Storage/meat_file/treatment_authorized_doc'), $authorizedName);
        } else {
            $authorizedName = $request->input('old_treatment_authorized_doc'); // Use old file
        }
        if ($request->hasFile('fitness_certificate_doc')) {
            $fitnessFile = $request->file('fitness_certificate_doc');
            $fitnessName = time() . '_' . $fitnessFile->getClientOriginalName();
            $fitnessFile->move(public_path('PMC_Cold_Storage/meat_file/fitness_certificate_doc'), $fitnessName);
        } else {
            $fitnessName = $request->input('old_fitness_certificate_doc'); // Use old file
        }
        // if ($request->hasFile('Factory_reg_and_license_doc')) {
        //     $factoryregFile = $request->file('Factory_reg_and_license_doc');
        //     $factoryregName = time() . '_' . $factoryregFile->getClientOriginalName();
        //     $factoryregFile->move(public_path('PMC_Cold_Storage/meat_file/Factory_reg_and_license_doc'), $factoryregName);
        // } else {
        //     $factoryregName = $request->input('old_Factory_reg_and_license_doc'); // Use old file
        // }
        if ($request->hasFile('issued_doc')) {
            $issueddocFile = $request->file('issued_doc');
            $issueddocName = time() . '_' . $issueddocFile->getClientOriginalName();
            $issueddocFile->move(public_path('PMC_Cold_Storage/meat_file/issued_doc'), $issueddocName);
        } else {
            $issueddocName = $request->input('old_issued_doc'); // Use old file
        }

        if ($request->hasFile('applicant_signature')) {
            $appsignatureFile = $request->file('applicant_signature');
            $appsignatureName = time() . '_' . $appsignatureFile->getClientOriginalName();
            $appsignatureFile->move(public_path('PMC_Cold_Storage/meat_file/applicant_signature'), $appsignatureName);
        } else {
            $appsignatureName = $request->input('old_applicant_signature'); // Use old file
        }

        if ($request->hasFile('profile_photo')) {
            $profilephotoFile = $request->file('profile_photo');
            $profilephotoName = time() . '_' . $profilephotoFile->getClientOriginalName();
            $profilephotoFile->move(public_path('PMC_Cold_Storage/meat_file/profile_photo'), $profilephotoName);
        } else {
            $profilephotoName = $request->input('old_profile_photo'); // Use old file
        }


        if ($request->hasFile('municipal_corpor_doc')) {
            $muncipalcorporFile = $request->file('municipal_corpor_doc');
            $muncipalcorporName = time() . '_' . $muncipalcorporFile->getClientOriginalName();
            $muncipalcorporFile->move(public_path('PMC_Cold_Storage/meat_file/municipal_corpor_doc'), $muncipalcorporName);
        } else {
            $muncipalcorporName = $request->input('old_municipal_corpor_doc'); // Use old file
        }
        if ($request->hasFile('old_licence')) {
            $oldlicenceFile = $request->file('old_licence');
            $oldlicenceName = time() . '_' . $oldlicenceFile->getClientOriginalName();
            $oldlicenceFile->move(public_path('PMC_Cold_Storage/meat_file/old_licence'), $oldlicenceName);
        } else {
            $oldlicenceName = $request->input('old_old_licence'); // Use old file
        }
    //    dd($legalbusinessName);
        // if(!empty($request->hasFile('adharcard_doc'))){
        //     $image1 = $request->file('adharcard_doc');
        //     $image_name1 = $image1->getClientOriginalName();
        //     $extension1 = $image1->getClientOriginalExtension();
        //     $new_name1 = time().rand(10,999).'.'.$extension1;
        //     $image1->move(public_path('/PMC_Cold_Storage/meat_file/adharcard_doc'),$new_name1);

        //     $image_path1 = "/PMC_Cold_Storage/meat_file/adharcard_doc" . $image_name1;
        //     $data->adharcard_doc = $new_name1;
        // }



        // if(!empty($request->hasFile('residitional_proof_doc'))){
        //     $image2 = $request->file('residitional_proof_doc');
        //     $image_name2 = $image2->getClientOriginalName();
        //     $extension2 = $image2->getClientOriginalExtension();
        //     $new_name2 = time().rand(10,999).'.'.$extension2;
        //     $image2->move(public_path('/PMC_Cold_Storage/meat_file/residitional_proof_doc'),$new_name2);
        //     $image_path2 = "/PMC_Cold_Storage/meat_file/residitional_proof_doc" . $image_name2;
        //     $data->residitional_proof_doc = $new_name2;
        // }

        // if(!empty($request->hasFile('legal_business_doc'))){
        //     $image3 = $request->file('legal_business_doc');
        //     $image_name3 = $image3->getClientOriginalName();
        //     $extension3 = $image3->getClientOriginalExtension();
        //     $new_name3 = time().rand(10,999).'.'.$extension3;
        //     $image3->move(public_path('/PMC_Cold_Storage/meat_file/legal_business_doc'),$new_name3);

        //     $image_path3 = "/PMC_Cold_Storage/meat_file/legal_business_doc" . $image_name3;
        //     $data->legal_business_doc = $new_name3;
        // }

        // if(!empty($request->hasFile('business_registration_doc'))){
        //     $image4 = $request->file('business_registration_doc');
        //     $image_name4 = $image4->getClientOriginalName();
        //     $extension4 = $image4->getClientOriginalExtension();
        //     $new_name4 = time().rand(10,999).'.'.$extension4;
        //     $image4->move(public_path('/PMC_Cold_Storage/meat_file/business_registration_doc'),$new_name4);

        //     $image_path4 = "/PMC_Cold_Storage/meat_file/business_registration_doc" . $image_name4;
        //     $data->business_registration_doc = $new_name4;
        // }



        // if(!empty($request->hasFile('property_tax_doc'))){
        //     $image5 = $request->file('property_tax_doc');
        //     $image_name5 = $image5->getClientOriginalName();
        //     $extension5 = $image5->getClientOriginalExtension();
        //     $new_name5 = time().rand(10,999).'.'.$extension5;
        //     $image5->move(public_path('/PMC_Cold_Storage/meat_file/property_tax_doc'),$new_name5);

        //     $image_path5 = "/PMC_Cold_Storage/meat_file/property_tax_doc" . $image_name5;
        //     $data->property_tax_doc = $new_name5;
        // }


        // if(!empty($request->hasFile('paid_water_doc'))){
        //     $image6 = $request->file('paid_water_doc');
        //     $image_name6 = $image6->getClientOriginalName();
        //     $extension6 = $image6->getClientOriginalExtension();
        //     $new_name6 = time().rand(10,999).'.'.$extension6;
        //     $image6->move(public_path('/PMC_Cold_Storage/meat_file/paid_water_doc'),$new_name6);

        //     $image_path6 = "/PMC_Cold_Storage/meat_file/paid_water_doc" . $image_name6;
        //     $data->paid_water_doc = $new_name6;
        // }

        // if(!empty($request->hasFile('paid_receipt_doc'))){
        //     $image = $request->file('paid_receipt_doc');
        //     $image_name = $image->getClientOriginalName();
        //     $extension = $image->getClientOriginalExtension();
        //     $new_name = time().rand(10,999).'.'.$extension;
        //     $image->move(public_path('/PMC_PET_Registration/meat_file/paid_receipt_doc'),$new_name);

        //     $image_path = "/PMC_PET_Registration/meat_file/paid_receipt_doc" . $image_name;
        //     $data->paid_receipt_doc = $new_name;
        // }

        // if(!empty($request->hasFile('treatment_authorized_doc'))){
        //     $image7 = $request->file('treatment_authorized_doc');
        //     $image_name7 = $image7->getClientOriginalName();
        //     $extension7 = $image7->getClientOriginalExtension();
        //     $new_name7 = time().rand(10,999).'.'.$extension7;
        //     $image7->move(public_path('/PMC_Cold_Storage/meat_file/treatment_authorized_doc'),$new_name7);

        //     $image_path7 = "/PMC_Cold_Storage/meat_file/treatment_authorized_doc" . $image_name7;
        //     $data->treatment_authorized_doc = $new_name7;
        // }



        // if(!empty($request->hasFile('fitness_certificate_doc'))){
        //     $image8 = $request->file('fitness_certificate_doc');
        //     $image_name8 = $image8->getClientOriginalName();
        //     $extension8 = $image8->getClientOriginalExtension();
        //     $new_name8 = time().rand(10,999).'.'.$extension8;
        //     $image8->move(public_path('/PMC_Cold_Storage/meat_file/fitness_certificate_doc'),$new_name8);

        //     $image_path8 = "/PMC_Cold_Storage/meat_file/fitness_certificate_doc" . $image_name8;
        //     $data->fitness_certificate_doc = $new_name8;
        // }


        // if(!empty($request->hasFile('issued_doc'))){
        //     $image9 = $request->file('issued_doc');
        //     $image_name9 = $image9->getClientOriginalName();
        //     $extension9 = $image9->getClientOriginalExtension();
        //     $new_name9 = time().rand(10,999).'.'.$extension9;
        //     $image9->move(public_path('/PMC_Cold_Storage/meat_file/issued_doc'),$new_name9);

        //     $image_path9 = "/PMC_Cold_Storage/meat_file/issued_doc" . $image_name9;
        //     $data->issued_doc = $new_name9;
        // }



        // if(!empty($request->hasFile('slaughter_letter_doc'))){
        //     $image10 = $request->file('slaughter_letter_doc');
        //     $image_name10 = $image10->getClientOriginalName();
        //     $extension10 = $image10->getClientOriginalExtension();
        //     $new_name10 = time().rand(10,999).'.'.$extension10;
        //     $image10->move(public_path('/PMC_Cold_Storage/meat_file/slaughter_letter_doc'),$new_name10);

        //     $image_path10 = "/PMC_Cold_Storage/meat_file/slaughter_letter_doc" . $image_name10;
        //     $data->slaughter_letter_doc = $new_name10;
        // }

        // if(!empty($request->hasFile('applicant_signature'))){
        //     $image11 = $request->file('applicant_signature');
        //     $image_name11 = $image11->getClientOriginalName();
        //     $extension11 = $image11->getClientOriginalExtension();
        //     $new_name11 = time().rand(10,999).'.'.$extension11;
        //     $image11->move(public_path('/PMC_Cold_Storage/meat_file/applicant_signature'),$new_name11);

        //     $image_path11 = "/PMC_Cold_Storage/meat_file/applicant_signature" . $image_name11;
        //     $data->applicant_signature = $new_name11;
        // }

        // if(!empty($request->hasFile('profile_photo'))){
        //     $image12 = $request->file('profile_photo');
        //     $image_name12 = $image12->getClientOriginalName();
        //     $extension12 = $image12->getClientOriginalExtension();
        //     $new_name12 = time().rand(10,999).'.'.$extension12;
        //     $image12->move(public_path('/PMC_Cold_Storage/meat_file/profile_photo'),$new_name12);

        //     $image_path12 = "/PMC_Cold_Storage/meat_file/profile_photo" . $image_name12;
        //     $data->profile_photo = $new_name12;
        // }


        // dd($data->applicant_signature); die;
        //  if(!empty($request->hasFile('old_licence'))){
        //     $image = $request->file('old_licence');
        //     $image_name = $image->getClientOriginalName();
        //     $extension = $image->getClientOriginalExtension();
        //     $new_name = time().rand(10,999).'.'.$extension;
        //     $image->move(public_path('/PMC_Cold_Storage/meat_file/old_licence'),$new_name);

        //     $image_path = "/PMC_Cold_Storage/meat_file/old_licence" . $image_name;
        //     $data->old_licence = $new_name;
        // }
        // Basic Details

        $data->coldstorage_regi_id = $request->get('coldstorage_regi_id');
        // dd($data->place_id = $request);
        // $data->renwal_liceans_no = $request->get('renwal_liceans_no');
        $data->applicant_title_id = $request->get('applicant_title_id');
        // dd($request->get('applicant_title_id'));
        $data->applicant_fname = $request->get('applicant_fname');
        $data->applicant_mname = $request->get('applicant_mname');
        $data->applicant_lname = $request->get('applicant_lname');
        // $data->appl_dob = date('d-m-Y', strtotime($request->get('appl_dob')));
        // $data->appl_age = $request->get('appl_age');
        $data->mobile_number = $request->get('mobile_number');
        $data->email = $request->get('email');
        // $data->gender = $request->get('gender');
        $data->aadhar_number = $request->get('aadhar_number');

        // Residential Address of Applicant
        $data->house_number = $request->get('house_number');
        $data->house_name = $request->get('house_name');
        $data ->is_renewal = 1;
        $data->street_1 = $request->get('street_1');
        $data->street_2 = $request->get('street_2');
        $data->area_1 = $request->get('area_1');
        $data->area_2 = $request->get('area_2');

        $data->country_id = $request->get('country_id');
        $data->state_id = $request->get('state_id');
        $data->district_id = $request->get('district_id');
        $data->taluka_id = $request->get('taluka_id');
        $data->zipcode = $request->get('zipcode');

        // Business Details
        $data->business_name = $request->get('business_name');
        $data->business_type = $request->get('business_type');
        $data->meat_type = implode(",", $request->get('meat_type'));
        // dd($request->get('meat_type'));
        $data->unit = $request->get('unit');
        // dd($data->unit);
        $data->per_day_capacity = $request->get('per_day_capacity');
        $data->provision_water = $request->get('provision_water');
        $data->provision_electricty = $request->get('provision_electricty');
        $data->business_address = $request->get('business_address');
        $data->sewerage_disposing = $request->get('sewerage_disposing');
        $data->prcision_dispose_id = $request->get('prcision_dispose_id');
        $data->place_id = $request->get('place_id');
        $data->regi_authority_name = $request->get('regi_authority_name');
        $data->register_number = $request->get('register_number');
        $data->valid_till = $request->get('valid_till');

        $data->areaof_business_place = $request->get('areaof_business_place');
        $data->business_place = $request->get('business_place');
        $data->business_place_other = $request->get('business_place_other');
        $data->adharcard_doc =$aadharcardName;
        $data->residitional_proof_doc=$residitionalproofName;
        $data->legal_business_doc=$legalbusinessName;
        $data->registration_doc=$businessregiName;
        $data->property_tax_doc=$propertytaxName;
        $data->paid_water_doc=$propertytaxName;
        $data->slaughter_letter_doc=$slugletterName;
        $data->treatment_authorized_doc=$authorizedName;
        $data->fitness_certificate_doc=$fitnessName;
        // $data->Factory_reg_and_license_doc=$factoryregName;
        $data->issued_doc=$issueddocName;
        $data->applicant_signature=$appsignatureName;
        $data->profile_photo=$profilephotoName;
        $data->municipal_corpor_doc=$muncipalcorporName;
        $data->old_licence=$oldlicenceName;
        $data->register_table_id =$request->get('register_table_id');
        $data->is_renewal=1;
        $data->inserted_dt = date("Y-m-d H:i:s");
        $data->inserted_by = Auth::guard('meatregistereduser')->user()->id;
        //  dd($request->get('register_table_id'));
        ColdStorageRenewalLicense_Model::where("register_table_id",$request->get('register_table_id'))->update(['is_renewal' =>0]);


        $unique_id ="PMC-COLD-".rand(1000,10000000);

        $data->renwal_liceans_no = $unique_id;
        $data->save();
    //  dd($data);
        // ColdStorageRegistration_Model::where('id',$request->get('register_table_id'))->update(['is_renewal' =>0]);

        // dd($data->register_table_id);
        //  dd($data);
        // $update = [
        //     'renwal_liceans_no' => $unique_id.$data->id ,
        //     // 'inserted_by' => $data->id,
        // ];

        // dd($unique_id);
        ColdStorageRegistration_Model::where('id',$request->get('register_table_id'))->update(['is_renewal' =>0]);

        // ColdStorageRenewalLicense_Model::where('id', $data->id)->update($update);

        // $app_no = $unique_id;
        // $scheme = 'Cold Storage Registration Form';
        // $domain = "https://".$_SERVER['HTTP_HOST'];
        // $project_folder = 'PMC_Cold_Storage';

        // $msg = "Your application no:- $app_no for $scheme is received at PMC office. You can also track your application on $domain / PMC.";
        // $tempID= '1207167447455213113';

        $app_no = $unique_id;
        $scheme = 'Cold Storage Renewal Form';
        $mobile_number = $request->get('mobile_number');
        // dd($mobile_number);
        $domain = 'cold-storagee.smartpmc.co.in/';
        $senderid = "CoreOC";
        $project_folder = 'PMC_Pet_Registration';
        $route = 1;
        $key= 'kbf8IN83hIxNTVgs';
        $msg = " Your application no:- $app_no for $scheme is received at PMC office. You can also track your application on $domain CORE OCEAN.";
        $tempID = '1207171688071309898';

        $this->sendsms($msg,$mobile_number,$tempID);
// dd($this);

        return redirect('/user/appli_form')->with('message','Your License Renawal Record Added Successfully.');

        // return redirect('/')->with('message','Your Record Added Successfully.');

     }

    }


//Cold_renewal_invoice
    public function coldRenewalInvoice(Request $request, $application_id, $user_type)
    {
         $invoice =  DB::table('coldstorage_renewal_license_tbl AS t1')
                        ->select('t1.*')
                       ->where('t1.id', '=', $application_id)
                        ->orderBy('t1.id', 'DESC')
                        ->first();
        return view('user.coldstorage_renewal.invoice',compact('invoice'));
    }


    public function User_coldStorageRenewalForm_View(Request $request, $application_id, $user_type)
    {

         $meattype_mst = MeatType_Master::orderBy('id','desc')->pluck('meat_name', 'id')->whereNull('deleted_at');
         $unit_Meat_Type = DB::table('unit_Meat_Type')->get();
        if($user_type == 'Cold_Storage')
        {
            $data =   DB::table('coldstorage_renewal_license_tbl AS t1')
                            ->select('t1.*', 't2.meat_name','t3.dist_name','t4.taluka_name','t5.adharcard_doc as regi_adharcard_doc','t5.residitional_proof_doc as regi_residitional_proof_doc','t5.authority_letter_doc as regi_authority_letter_doc','t5.legal_business_doc as regi_legal_business_doc','t5.business_registration_doc as regi_business_registration_doc','t5.agreement_owner_doc as agreement_owner_renewal','t5.noc_owner_doc as doc_owner','t5.property_tax_doc as property_doc','t5.paid_water_doc as paid_water','t5.paid_receipt_doc as receipt_doc','t5.treatment_authorized_doc as tre_authority_doc','t5.fitness_certificate_doc as fitness_doc','t5.issued_doc as regi_issued_doc','t5.registration_doc as regi_doc','t5.slaughter_letter_doc as letter_doc','t5.profile_photo as regi_profile_photo','t5.applicant_signature as app_sign'
                                    )

                            ->leftJoin('meat_type_mst AS t2', 't2.id', '=', 't1.meat_type')

                            ->leftJoin('mst_dist AS t3', 't3.id', '=', 't1.district_id')
                            ->leftJoin('mst_taluka AS t4', 't4.id', '=', 't1.taluka_id')
                            ->leftJoin('coldstorage_registration_tbl AS t5', 't5.id', '=', 't1.coldstorage_regi_id')

                            ->where('t1.id', '=', $application_id)
                            ->whereNull('t1.deleted_at')
                            ->whereNull('t2.deleted_at')
                            ->whereNull('t3.deleted_at')
                            ->whereNull('t4.deleted_at')
                            ->whereNull('t5.deleted_at')
                            // ->whereNull('t6.deleted_at')
                            ->orderBy('t1.id', 'DESC')
                            ->first();

            // return $data;
             $mainid = Auth::guard('meatregistereduser')->user()->id;

            $data_registraion =   DB::table('coldstorage_registration_tbl AS t1')
                            ->select('t1.*', 't2.meat_name','t3.dist_name','t4.taluka_name'
                                    )
                            ->leftJoin('meat_type_mst AS t2', 't2.id', '=', 't1.meat_type')
                            ->leftJoin('mst_dist AS t3', 't3.id', '=', 't1.district_id')
                            ->leftJoin('mst_taluka AS t4', 't4.id', '=', 't1.taluka_id')

                            ->where('t1.inserted_by', '=', $mainid)
                            ->whereNull('t1.deleted_at')
                            ->whereNull('t2.deleted_at')
                            ->whereNull('t3.deleted_at')
                            ->whereNull('t4.deleted_at')
                            ->orderBy('t1.id', 'DESC')
                            ->first();

          return view('user.coldstorage_renewal.user_renewal_applicant_form_view', compact('data','unit_Meat_Type', 'user_type','meattype_mst','data_registraion'));
        }

    }


    public function UpdateColdStorageRenewal(Request $request, $id)
    {
        $this->validate($request, [

            // Basic Details
            'applicant_title_id' => 'required|numeric',
            'applicant_fname' => 'required|string',
            'applicant_mname' => 'required|string',
            'applicant_lname' => 'required|string',

            'mobile_number' => 'required|string',
            'email' => 'required|string',

            'aadhar_number' => 'required|string',

            // Residential Address of Applicant
            'house_number' => 'required|string',

            'street_1' => 'required|string',

            'area_1' => 'required|string',

            'country_id' => 'required|string',
            'state_id' => 'required|string',
            'district_id' => 'required|string',
            'taluka_id' => 'required|string',
            'zipcode' => 'required|string',

            // Business Details
            'business_name' => 'required|string',
            'business_type' => 'required|numeric',
            'meat_type' => 'required|string',
            'per_day_capacity' => 'required|string',
            'provision_water' => 'required|numeric',
            'provision_electricty' => 'required|numeric',
            'business_address' => 'required|string',
            'sewerage_disposing' => 'required|numeric',

            'place_id' => 'required|numeric',

            'regi_authority_name' => 'required|string',
            'register_number' => 'required|string',
            'valid_till' => 'required|string',

             'areaof_business_place' => 'required|string',
             'business_place' => 'required|numeric',



         ],[
              // Basic Details
              'applicant_title_id.required' => 'Applicant Title is required',
              'applicant_fname.required' => 'Applicant First Name is required',
              'applicant_mname.required' => 'Applicant Middle Name is required',
              'applicant_lname.required' => 'Applicant Last Name is required',

              'mobile_number.required' => 'Mobile Number is required',
              'email.required' => 'Email Id is required',

              'aadhar_number.required' => 'Aadhar Number is required',

              // Residential Address of Applicant
              'house_number.required' => 'House Number is required',

              'street_1.required' => 'Street 1 is required',
              'area_1.required' => 'Area 1 is required',
              'country_id.required' => 'Country is required',
              'state_id.required' => 'State is required',
              'district_id.required' => 'District is required',
              'taluka_id.required' => 'Taluka is required',
              'zipcode.required' => 'Zip Code is required',

              // Business Details
              'business_name.required' => 'Name of the business is required',
              'business_type.required' => 'Kind of Business is required',
              'meat_type.required' => 'Meat Type is required',
              'per_day_capacity.required' => 'Per Day Capacity is required',
              'provision_water.required' => 'Provision of water is required',
              'provision_electricty.required' => 'Provision of electricity is required',
              'business_address.required' => 'Address of the business is required',
              'sewerage_disposing.required' => 'Provision of sewerage for disposing effluent is required',

              'place_id.required' => 'Is place is located at least 50mt. away form place of worship / educational institute / hospital & clinic is required',

              'regi_authority_name.required' => 'Registration authority name is required',

              'regi_authority_name.required' => 'Registration authority name is required',
              'register_number.required' => 'Registration nuber is required',
              'valid_till.required' =>     'valid till Date is required',
              'areaof_business_place.required' => 'area of business place is required',

              'business_place.required' => 'business place is required',


             ]);

        //$data = new ColdStorageRegistration_Model();

         $data = ColdStorageRenewalLicense_Model::find($id);

       // print_r($request->get('regi_adharcard_doc'));exit;

          if(!empty($request->hasFile('adharcard_doc'))){
            $image1 = $request->file('adharcard_doc');
            $image_name1 = $image1->getClientOriginalName();
            $extension1 = $image1->getClientOriginalExtension();
            $new_name1 = time().rand(10,999).'.'.$extension1;
            $image1->move(public_path('/PMC_Cold_Storage/meat_file/adharcard_doc'),$new_name1);

            $image_path1 = "/PMC_Cold_Storage/meat_file/adharcard_doc" . $image_name1;
            $data->adharcard_doc = $new_name1;
        }



        if(!empty($request->hasFile('residitional_proof_doc'))){
            $image2 = $request->file('residitional_proof_doc');
            $image_name2 = $image2->getClientOriginalName();
            $extension2 = $image2->getClientOriginalExtension();
            $new_name2 = time().rand(10,999).'.'.$extension2;
            $image2->move(public_path('/PMC_Cold_Storage/meat_file/residitional_proof_doc'),$new_name2);
            $image_path2 = "/PMC_Cold_Storage/meat_file/residitional_proof_doc" . $image_name2;
            $data->residitional_proof_doc = $new_name2;
        }

        if(!empty($request->hasFile('legal_business_doc'))){
            $image3 = $request->file('legal_business_doc');
            $image_name3 = $image3->getClientOriginalName();
            $extension3 = $image3->getClientOriginalExtension();
            $new_name3 = time().rand(10,999).'.'.$extension3;
            $image3->move(public_path('/PMC_Cold_Storage/meat_file/legal_business_doc'),$new_name3);

            $image_path3 = "/PMC_Cold_Storage/meat_file/legal_business_doc" . $image_name3;
            $data->legal_business_doc = $new_name3;
        }

        if(!empty($request->hasFile('business_registration_doc'))){
            $image4 = $request->file('business_registration_doc');
            $image_name4 = $image4->getClientOriginalName();
            $extension4 = $image4->getClientOriginalExtension();
            $new_name4 = time().rand(10,999).'.'.$extension4;
            $image4->move(public_path('/PMC_Cold_Storage/meat_file/business_registration_doc'),$new_name4);

            $image_path4 = "/PMC_Cold_Storage/meat_file/business_registration_doc" . $image_name4;
            $data->business_registration_doc = $new_name4;
        }



        if(!empty($request->hasFile('property_tax_doc'))){
            $image5 = $request->file('property_tax_doc');
            $image_name5 = $image5->getClientOriginalName();
            $extension5 = $image5->getClientOriginalExtension();
            $new_name5 = time().rand(10,999).'.'.$extension5;
            $image5->move(public_path('/PMC_Cold_Storage/meat_file/property_tax_doc'),$new_name5);

            $image_path5 = "/PMC_Cold_Storage/meat_file/property_tax_doc" . $image_name5;
            $data->property_tax_doc = $new_name5;
        }


        if(!empty($request->hasFile('paid_water_doc'))){
            $image6 = $request->file('paid_water_doc');
            $image_name6 = $image6->getClientOriginalName();
            $extension6 = $image6->getClientOriginalExtension();
            $new_name6 = time().rand(10,999).'.'.$extension6;
            $image6->move(public_path('/PMC_Cold_Storage/meat_file/paid_water_doc'),$new_name6);

            $image_path6 = "/PMC_Cold_Storage/meat_file/paid_water_doc" . $image_name6;
            $data->paid_water_doc = $new_name6;
        }

        // if(!empty($request->hasFile('paid_receipt_doc'))){
        //     $image = $request->file('paid_receipt_doc');
        //     $image_name = $image->getClientOriginalName();
        //     $extension = $image->getClientOriginalExtension();
        //     $new_name = time().rand(10,999).'.'.$extension;
        //     $image->move(public_path('/PMC_PET_Registration/meat_file/paid_receipt_doc'),$new_name);

        //     $image_path = "/PMC_PET_Registration/meat_file/paid_receipt_doc" . $image_name;
        //     $data->paid_receipt_doc = $new_name;
        // }

        if(!empty($request->hasFile('treatment_authorized_doc'))){
            $image7 = $request->file('treatment_authorized_doc');
            $image_name7 = $image7->getClientOriginalName();
            $extension7 = $image7->getClientOriginalExtension();
            $new_name7 = time().rand(10,999).'.'.$extension7;
            $image7->move(public_path('/PMC_Cold_Storage/meat_file/treatment_authorized_doc'),$new_name7);

            $image_path7 = "/PMC_Cold_Storage/meat_file/treatment_authorized_doc" . $image_name7;
            $data->treatment_authorized_doc = $new_name7;
        }



        if(!empty($request->hasFile('fitness_certificate_doc'))){
            $image8 = $request->file('fitness_certificate_doc');
            $image_name8 = $image8->getClientOriginalName();
            $extension8 = $image8->getClientOriginalExtension();
            $new_name8 = time().rand(10,999).'.'.$extension8;
            $image8->move(public_path('/PMC_Cold_Storage/meat_file/fitness_certificate_doc'),$new_name8);

            $image_path8 = "/PMC_Cold_Storage/meat_file/fitness_certificate_doc" . $image_name8;
            $data->fitness_certificate_doc = $new_name8;
        }


        if(!empty($request->hasFile('issued_doc'))){
            $image9 = $request->file('issued_doc');
            $image_name9 = $image9->getClientOriginalName();
            $extension9 = $image9->getClientOriginalExtension();
            $new_name9 = time().rand(10,999).'.'.$extension9;
            $image9->move(public_path('/PMC_Cold_Storage/meat_file/issued_doc'),$new_name9);

            $image_path9 = "/PMC_Cold_Storage/meat_file/issued_doc" . $image_name9;
            $data->issued_doc = $new_name9;
        }



        if(!empty($request->hasFile('slaughter_letter_doc'))){
            $image10 = $request->file('slaughter_letter_doc');
            $image_name10 = $image10->getClientOriginalName();
            $extension10 = $image10->getClientOriginalExtension();
            $new_name10 = time().rand(10,999).'.'.$extension10;
            $image10->move(public_path('/PMC_Cold_Storage/meat_file/slaughter_letter_doc'),$new_name10);

            $image_path10 = "/PMC_Cold_Storage/meat_file/slaughter_letter_doc" . $image_name10;
            $data->slaughter_letter_doc = $new_name10;
        }

        if(!empty($request->hasFile('applicant_signature'))){
            $image11 = $request->file('applicant_signature');
            $image_name11 = $image11->getClientOriginalName();
            $extension11 = $image11->getClientOriginalExtension();
            $new_name11 = time().rand(10,999).'.'.$extension11;
            $image11->move(public_path('/PMC_Cold_Storage/meat_file/applicant_signature'),$new_name11);

            $image_path11 = "/PMC_Cold_Storage/meat_file/applicant_signature" . $image_name;
            $data->applicant_signature = $new_name11;
        }

        if(!empty($request->hasFile('profile_photo'))){
            $image12 = $request->file('profile_photo');
            $image_name12 = $image12->getClientOriginalName();
            $extension12 = $image12->getClientOriginalExtension();
            $new_name12 = time().rand(10,999).'.'.$extension12;
            $image->move(public_path('/PMC_Cold_Storage/meat_file/profile_photo'),$new_name12);

            $image_path12 = "/PMC_Cold_Storage/meat_file/profile_photo" . $image_name12;
            $data->profile_photo = $new_name12;
        }

         if(!empty($request->hasFile('old_licence'))){
            $image = $request->file('old_licence');
            $image_name = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $new_name = time().rand(10,999).'.'.$extension;
            $image->move(public_path('/PMC_Cold_Storage/meat_file/old_licence'),$new_name);

            $image_path = "/PMC_Cold_Storage/meat_file/old_licence" . $image_name;
            $data->old_licence = $new_name;
        }

        // Basic Details
        $data->applicant_title_id = $request->get('applicant_title_id');
        $data->applicant_fname = $request->get('applicant_fname');
        $data->applicant_mname = $request->get('applicant_mname');
        $data->applicant_lname = $request->get('applicant_lname');

        $data->mobile_number = $request->get('mobile_number');
        $data->email = $request->get('email');

        $data->aadhar_number = $request->get('aadhar_number');

        // Residential Address of Applicant
        $data->house_number = $request->get('house_number');
        $data->house_name = $request->get('house_name');
        $data->street_1 = $request->get('street_1');
        $data->street_2 = $request->get('street_2');
        $data->area_1 = $request->get('area_1');
        $data->area_2 = $request->get('area_2');
        $data->country_id = $request->get('country_id');
        $data->state_id = $request->get('state_id');
        $data->district_id = $request->get('district_id');
        $data->taluka_id = $request->get('taluka_id');
        $data->zipcode = $request->get('zipcode');

        // Business Details
        $data->business_name = $request->get('business_name');
        $data->business_type = $request->get('business_type');
        $data->meat_type = $request->get('meat_type');
        $data->per_day_capacity = $request->get('per_day_capacity');
        $data->provision_water = $request->get('provision_water');
        $data->provision_electricty = $request->get('provision_electricty');
        $data->business_address = $request->get('business_address');
        $data->sewerage_disposing = $request->get('sewerage_disposing');
        $data->prcision_dispose_id = $request->get('prcision_dispose_id');
        $data->place_id = $request->get('place_id');

        $data->regi_authority_name = $request->get('regi_authority_name');
        $data->register_number = $request->get('register_number');
        $data->valid_till = $request->get('valid_till');

        $data->areaof_business_place = $request->get('areaof_business_place');
        $data->business_place = $request->get('business_place');
        $data->business_place_other = $request->get('business_place_other');

         if($data->status=1 && $data->re_hod_status == 2 && $data->re_final_approve =2){
            $data->re_hod_status = 0;
            $data->status = 0;
            $data->re_final_approve = 0;
       }

       if($data->status=1 && $data->re_hod_status == 1 && $data->re_final_approve =2){
           $data->re_hod_status = 0;
            $data->status = 0;
            $data->re_final_approve = 0;
       }

       if($data->status=2 && $data->re_hod_status == 1 && $data->re_final_approve =1){
           $data->re_hod_status = 0;
            $data->status = 0;
            $data->re_final_approve = 0;
       }

       if($data->status=1 && $data->re_hod_status == 2 && $data->re_final_approve =1){
           $data->re_hod_status = 0;
            $data->status = 0;
            $data->re_final_approve = 0;
       }

       if($data->status=2 && $data->re_hod_status == 2 && $data->re_final_approve =2){
           $data->re_hod_status = 0;
            $data->status = 0;
            $data->re_final_approve = 0;
       }



        $data->modified_dt = date("Y-m-d H:i:s");
        $data->modified_by = Auth::guard('meatregistereduser')->user()->id;

        $data->save();
            // 'inserted_by' => $data->id,



        // ColdStorageRegistration_Model::where('id', $data->id)->update($update);

        // $app_no = $unique_id.$data->id;
        // $scheme = 'Meat Registration Form';
        // $domain = "https://".$_SERVER['HTTP_HOST'];
        // $project_folder = 'PMC_Cold_Storage';

        // $msg = "Your application no:- $app_no for $scheme is received at PMC office. You can also track your application on $domain/$project_folder/ PMC.";
        // $tempID= '1207167447455213113';
        // $this->sendsms($msg,$request->mobile_number,$tempID);

        return redirect('/user/appli_form')->with('message','Your Renewal Record Updated Successfully.');




        // return redirect()->route('taluka_master.index')->with('message','Your Record Updated Successfully.');
    }

    public function self_affadevit_renewal_pdf(request $request,$id)
    {




        // $mainid = Auth::guard('meatregistereduser')->user()->id;
        $meat_registration_pdf =  DB::table('coldstorage_renewal_license_tbl AS t1')
                                       ->select('t1.*', 't2.meat_name','t3.dist_name','t4.taluka_name','t5.adharcard_doc as regi_adharcard_doc','t5.residitional_proof_doc as regi_residitional_proof_doc','t5.authority_letter_doc as regi_authority_letter_doc','t5.legal_business_doc as regi_legal_business_doc','t5.business_registration_doc as regi_business_registration_doc','t5.agreement_owner_doc as agreement_owner_renewal','t5.noc_owner_doc as doc_owner','t5.property_tax_doc as property_doc','t5.paid_water_doc as paid_water','t5.paid_receipt_doc as receipt_doc','t5.treatment_authorized_doc as tre_authority_doc','t5.fitness_certificate_doc as fitness_doc','t5.issued_doc as regi_issued_doc','t5.registration_doc as regi_doc','t5.slaughter_letter_doc as letter_doc','t5.profile_photo as regi_profile_photo','t5.applicant_signature as app_sign'
                                    )

                            ->leftJoin('meat_type_mst AS t2', 't2.id', '=', 't1.meat_type')

                            ->leftJoin('mst_dist AS t3', 't3.id', '=', 't1.district_id')
                            ->leftJoin('mst_taluka AS t4', 't4.id', '=', 't1.taluka_id')
                            ->leftJoin('coldstorage_registration_tbl AS t5', 't5.id', '=', 't1.coldstorage_regi_id')

                                        ->where('t1.id', '=', $id)

                                        ->whereNull('t1.deleted_at')
                                        ->whereNull('t2.deleted_at')
                                        ->whereNull('t3.deleted_at')
                                        ->whereNull('t4.deleted_at')
                                         ->whereNull('t5.deleted_at')
                                        ->orderBy('t1.id', 'DESC')
                                        ->first();

        // return $meat_registration_view;


        // $data =   DB::table('coldstorage_registration_tbl AS t1')
        //                     ->select('t1.*', 't2.meat_name','t3.dist_name','t4.taluka_name'
        //                             )
        //                     ->leftJoin('meat_type_mst AS t2', 't2.id', '=', 't1.meat_type')
        //                     ->leftJoin('mst_dist AS t3', 't3.id', '=', 't1.district_id')
        //                     ->leftJoin('mst_taluka AS t4', 't4.id', '=', 't1.taluka_id')

        //                     ->where('t1.inserted_by', '=', $mainid)
        //                     ->whereNull('t1.deleted_at')
        //                     ->whereNull('t2.deleted_at')
        //                     ->whereNull('t3.deleted_at')
        //                     ->whereNull('t4.deleted_at')
        //                     ->orderBy('t1.id', 'DESC')
        //                     ->first();

         $mainid = Auth::guard('meatregistereduser')->user()->id;

            $data_registraion =   DB::table('coldstorage_registration_tbl AS t1')
                            ->select('t1.*', 't2.meat_name','t3.dist_name','t4.taluka_name'
                                    )
                            ->leftJoin('meat_type_mst AS t2', 't2.id', '=', 't1.meat_type')
                            ->leftJoin('mst_dist AS t3', 't3.id', '=', 't1.district_id')
                            ->leftJoin('mst_taluka AS t4', 't4.id', '=', 't1.taluka_id')

                            ->where('t1.inserted_by', '=', $mainid)
                            ->whereNull('t1.deleted_at')
                            ->whereNull('t2.deleted_at')
                            ->whereNull('t3.deleted_at')
                            ->whereNull('t4.deleted_at')
                            ->orderBy('t1.id', 'DESC')
                            ->first();

        return view('user.coldstorage_renewal.self_affadevit_renewal_pdf', compact('meat_registration_pdf', 'data_registraion'));
       }

    public function GenerateenglishrenewalLicensepdf(request $request, $id)
    {

           $meat_renewal_pdf =  DB::table('coldstorage_renewal_license_tbl AS t1')
                                        ->select('t1.*', 't2.dist_name','t3.taluka_name', 't4.meat_name','t5.cold_storage_aplication_no as licence_no',
                                        't5.adharcard_doc','t5.residitional_proof_doc','t5.legal_business_doc','t5.business_registration_doc',
                                        't5.property_tax_doc','t5.paid_water_doc','t5.slaughter_letter_doc','t5.treatment_authorized_doc','t5.fitness_certificate_doc',
                                        't5.issued_doc','t5.applicant_signature','t5.inserted_by','t6.id as approve_id',
                                        't6.meat_pplication_id as approve_PET_UniqueID','t6.date_of_license_obtain as approve_date_of_license_obtain', 't6.re_hod_sign')
                                        ->leftJoin('mst_dist AS t2', 't2.id', '=', 't1.district_id')
                                        ->leftJoin('mst_taluka AS t3', 't3.id', '=', 't1.taluka_id')
                                        ->leftJoin('meat_type_mst AS t4', 't4.id', '=', 't1.meat_type')
                                        ->leftJoin('coldstorage_registration_tbl AS t5', 't5.id', '=', 't1.coldstorage_regi_id')
                                        ->leftJoin('approve_by_admin_renewal_license_tbl AS t6', 't6.meat_pplication_id', '=', 't1.id')
                                        // ->where('t1.status', '=', $status)
                                        ->where('t1.id', '=', $id)
                                        ->whereNull('t1.deleted_at')
                                        ->whereNull('t2.deleted_at')
                                        ->whereNull('t3.deleted_at')
                                        ->whereNull('t4.deleted_at')
                                        ->whereNull('t5.deleted_at')
                                        ->whereNull('t6.deleted_at')
                                        ->orderBy('t1.id', 'DESC')
                                        ->first();

        $current_date = $meat_renewal_pdf->inserted_dt;
        // dd($current_date);

        $current_m = date('m', strtotime($current_date));
        $currentMonth = Carbon::today($current_m)->format('m');
        // dd($currentMonth);
        $fiscalYear = '';

        $fiscalYear = $currentMonth > 3 ? Carbon::createFromFormat('d-m-Y', '31-03-'.date('Y'))->addYear()->toDateString() : Carbon::createFromFormat('d-m-Y', '31-03-'.date('Y'))->toDateString();

        return view('user.coldstorage_renewal.generate_english_coldstorage_renewal_pdf', compact('meat_renewal_pdf','fiscalYear'));
      }

    public function GenerateMarathirenewalLicensepdf(request $request, $id)
    {

           $meat_renewal_pdf =  DB::table('coldstorage_renewal_license_tbl AS t1')
                                        ->select('t1.*', 't2.dist_name','t3.taluka_name', 't4.meat_name','t5.cold_storage_aplication_no as licence_no',
                                        't5.adharcard_doc','t5.residitional_proof_doc','t5.legal_business_doc','t5.business_registration_doc',
                                        't5.property_tax_doc','t5.paid_water_doc','t5.slaughter_letter_doc','t5.treatment_authorized_doc',
                                        't5.fitness_certificate_doc','t5.issued_doc','t5.applicant_signature','t5.inserted_by','t6.id as approve_id',
                                        't6.meat_pplication_id as approve_PET_UniqueID','t6.date_of_license_obtain as approve_date_of_license_obtain', 't6.re_hod_sign')
                                        ->leftJoin('mst_dist AS t2', 't2.id', '=', 't1.district_id')
                                        ->leftJoin('mst_taluka AS t3', 't3.id', '=', 't1.taluka_id')
                                        ->leftJoin('meat_type_mst AS t4', 't4.id', '=', 't1.meat_type')
                                        ->leftJoin('coldstorage_registration_tbl AS t5', 't5.id', '=', 't1.coldstorage_regi_id')
                                        ->leftJoin('approve_by_admin_renewal_license_tbl AS t6', 't6.meat_pplication_id', '=', 't1.id')
                                        // ->where('t1.status', '=', $status)
                                        ->where('t1.id', '=', $id)
                                        ->whereNull('t1.deleted_at')
                                        ->whereNull('t2.deleted_at')
                                        ->whereNull('t3.deleted_at')
                                        ->whereNull('t4.deleted_at')
                                        ->whereNull('t5.deleted_at')
                                        ->whereNull('t6.deleted_at')
                                        ->orderBy('t1.id', 'DESC')
                                        ->first();

         $current_date = $meat_renewal_pdf->inserted_dt;
        // dd($current_date);

        $current_m = date('m', strtotime($current_date));
        $currentMonth = Carbon::today($current_m)->format('m');
        // dd($currentMonth);
        $fiscalYear = '';

        $fiscalYear = $currentMonth > 3 ? Carbon::createFromFormat('d-m-Y', '31-03-'.date('Y'))->addYear()->toDateString() : Carbon::createFromFormat('d-m-Y', '31-03-'.date('Y'))->toDateString();


        return view('user.coldstorage_renewal.generate_marathi_coldstorage_renewal_pdf', compact('meat_renewal_pdf','fiscalYear'));
      }

    public function coldStorageRenewalForm_View(Request $request, $application_id, $user_type)
    {

        $unit_Meat_Type = DB::table('unit_Meat_Type')->get();

         $meat_renewal_view = DB::table('coldstorage_renewal_license_tbl AS t1')
                                        ->select('t1.*', 't2.dist_name','t3.taluka_name', 't4.meat_name','t5.adharcard_doc as regi_adharcard_doc','t5.residitional_proof_doc as regi_residitional_proof_doc','t5.authority_letter_doc as regi_authority_letter_doc','t5.legal_business_doc as regi_legal_business_doc','t5.business_registration_doc as regi_business_registration_doc','t5.agreement_owner_doc as agreement_owner_renewal','t5.noc_owner_doc as doc_owner','t5.property_tax_doc as property_doc','t5.paid_water_doc as paid_water','t5.paid_receipt_doc as receipt_doc','t5.treatment_authorized_doc as tre_authority_doc','t5.fitness_certificate_doc as fitness_doc','t5.issued_doc as regi_issued_doc','t5.registration_doc as regi_doc','t5.slaughter_letter_doc as letter_doc','t5.profile_photo as regi_profile_photo','t5.applicant_signature as regi_app_sign')
                                        ->leftJoin('mst_dist AS t2', 't2.id', '=', 't1.district_id')
                                        ->leftJoin('mst_taluka AS t3', 't3.id', '=', 't1.taluka_id')
                                        ->leftJoin('meat_type_mst AS t4', 't4.id', '=', 't1.meat_type')
                                        ->leftJoin('coldstorage_registration_tbl AS t5', 't5.id', '=', 't1.coldstorage_regi_id')
                                        // ->where('t1.status', '=', $status)
                                        ->where('t1.id', '=', $application_id)
                                        ->whereNull('t1.deleted_at')
                                        ->whereNull('t2.deleted_at')
                                        ->whereNull('t3.deleted_at')
                                        ->whereNull('t4.deleted_at')
                                        ->orderBy('t1.id', 'DESC')
                                        ->first();
          //dd($meat_renewal_view);
          $array = explode(",",$meat_renewal_view->meat_type);
          $meatNames = DB::table('meat_type_mst')
          ->whereIn('id', $array)
          ->pluck('meat_name');
          $commaSeparatedMeatNames = $meatNames->implode(', ');
        return view('user.coldstorage_renewal.view_renewal', compact('meat_renewal_view','commaSeparatedMeatNames','unit_Meat_Type'));
    }


    public function sendsms($sms,$mobile_number,$tempID) {

        $user = "mohit";
		$password = "123456";
		$sender_id = 'CoreOc';

		$sender = $mobile_number;
		$priority = "ndnd";


        $key= 'kbf8IN83hIxNTVgs';
		$route= 2;


		$sms_type = "normal";
		$message = $sms;


		$data = array('apikey'=>$key,'unicode'=>$route,'senderid'=>$sender_id,'number'=>$sender,'message'=>$message,'templateid'=>$tempID);

		$ch = curl_init('http://sms.seqtech.in/api/smsapi?');
        $ch = curl_init('http://sms.adityahost.com/vb/apikey.php?');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		try
		{
			$response = curl_exec($ch);
			curl_close($ch);
            return $response;
		}
		catch(Exception $e)
		{
			return 0;
			echo 'Message: ' .$e->getMessage();

		}


    }

    public function renewal_list()

    {
        if (Auth::guard('meatregistereduser')->check()) {
            $user_id = Auth::guard('meatregistereduser')->user()->id;


                            $renewal_list =  DB::table('coldstorage_renewal_license_tbl AS t1')
                            ->select('t1.*', 't2.meat_name','t3.dist_name','t4.taluka_name'
                                    )

                            ->leftJoin('meat_type_mst AS t2', 't2.id', '=', 't1.meat_type')

                            ->leftJoin('mst_dist AS t3', 't3.id', '=', 't1.district_id')
                            ->leftJoin('mst_taluka AS t4', 't4.id', '=', 't1.taluka_id')


                            ->where('t1.inserted_by', '=',$user_id)
                            ->whereNull('t1.deleted_at')
                            ->whereNull('t2.deleted_at')
                            ->whereNull('t3.deleted_at')
                            ->whereNull('t4.deleted_at')

                            ->orderBy('t1.id', 'DESC')
                            ->get();

                    $meats_renewal_license_status =  DB::table('coldstorage_renewal_license_tbl AS t1')
                                        ->select('t1.id', 't1.status')
                                        ->where('t1.inserted_by', '=',$user_id)
                                        ->orderBy('t1.id', 'DESC')
                                        ->whereNull('t1.deleted_at')
                                        ->first();
                    $meatrenewal_license_status  = $meats_renewal_license_status ? $meats_renewal_license_status->status : 0;

                    if (isset($user_list)){

                    return view('user.cold_storage.user_applicant_form', compact('user_list','renewal_list','meat_license_status','meatrenewal_license_status'));
                    }else{
                    return redirect('/');
                    }
                    } else {
                    return redirect('/user/login');
                    }

                    }

     public function form_list(Request $request)
    {
        if (Auth::guard('meatregistereduser')->check()) {
            $user_id = Auth::guard('meatregistereduser')->user()->id;
            // return $user_id;

            $user_list =  DB::table('coldstorage_registration_tbl AS t1')
                            ->select('t1.*', 't2.meat_name','t3.dist_name','t4.taluka_name'
                                    )

                            ->leftJoin('meat_type_mst AS t2', 't2.id', '=', 't1.meat_type')

                            ->leftJoin('mst_dist AS t3', 't3.id', '=', 't1.district_id')
                            ->leftJoin('mst_taluka AS t4', 't4.id', '=', 't1.taluka_id')

                            ->where('t1.is_renewal', '=',1)
                            ->where('t1.final_approve', '=', 1)
                            ->where('t1.inserted_dt', '<=', \Carbon\Carbon::now()->subMinute())
                            ->where('t1.inserted_by', '=',$user_id)
                            ->whereNull('t1.deleted_at')
                            ->whereNull('t2.deleted_at')
                            ->whereNull('t3.deleted_at')
                            ->whereNull('t4.deleted_at')

                            ->orderBy('t1.id', 'DESC')
                            ->get();

              $meats_license_status =  DB::table('coldstorage_registration_tbl AS t1')
                                        ->select('t1.id', 't1.status')
                                        ->where('t1.inserted_by', '=',$user_id)
                                        ->orderBy('t1.id', 'DESC')
                                        ->whereNull('t1.deleted_at')
                                        ->first();
            $meat_license_status  = $meats_license_status ? $meats_license_status->status : 0;


            //  dd($user_list);
            $renewal_list =  DB::table('coldstorage_renewal_license_tbl AS t1')
                            ->select('t1.*', 't2.meat_name','t3.dist_name','t4.taluka_name'
                                    )

                            ->leftJoin('meat_type_mst AS t2', 't2.id', '=', 't1.meat_type')
                            ->leftJoin('coldstorage_registration_tbl AS t5','t5.id','=','t1.register_table_id')
                            ->leftJoin('mst_dist AS t3', 't3.id', '=', 't1.district_id')
                            ->leftJoin('mst_taluka AS t4', 't4.id', '=', 't1.taluka_id')

                            ->where('t1.re_final_approve', '=', 1)
                            ->where('t1.is_renewal', '=',1)
                            ->where('t1.inserted_dt', '<=', \Carbon\Carbon::now()->subMinute())
                            ->where('t1.inserted_by', '=',$user_id)
                            ->whereNull('t1.deleted_at')
                            ->whereNull('t2.deleted_at')
                            ->whereNull('t3.deleted_at')
                            ->whereNull('t4.deleted_at')

                            ->orderBy('t1.id', 'DESC')
                            ->get();
            //   dd($renewal_list);
            $meats_renewal_license_status =  DB::table('coldstorage_renewal_license_tbl AS t1')
                                        ->select('t1.id', 't1.status')
                                        ->where('t1.inserted_by', '=',$user_id)
                                        ->orderBy('t1.id', 'DESC')
                                        ->whereNull('t1.deleted_at')
                                        ->first();
            $meatrenewal_license_status  = $meats_renewal_license_status ? $meats_renewal_license_status->status : 0;

           if (isset($user_list)){

            return view('user.coldstorage_renewal.user_applicant_form_renewal', compact('user_list','renewal_list','meat_license_status','meatrenewal_license_status'));
            }else{
                 return redirect('/');
            }
        } else {
            return redirect('/user/login');
        }

    }


    public function New_renewal(Request $request,$id,$user_type)
    {

        // dd($request->all());
        $meattype_mst = MeatType_Master::orderBy('id','desc')->pluck('meat_name', 'id')->whereNull('deleted_at');
          $unit_Meat_Type = DB::table('unit_Meat_Type')->get();
          if (Auth::guard('meatregistereduser')->check()) {

        //   $meattype_mst = MeatType_Master::orderBy('id','desc')->pluck('meat_name', 'id')->whereNull('deleted_at');

          $mainid = Auth::guard('meatregistereduser')->user()->id;
        //   dd($mainid);
          $data =   DB::table('coldstorage_registration_tbl AS t1')
                                ->select('t1.*','t1.id AS registration_id', 't2.meat_name','t3.dist_name','t4.taluka_name')
                                 ->leftJoin('coldstorage_renewal_license_tbl AS t5','t5.register_table_id','=', 't1.id')
                                ->leftJoin('meat_type_mst AS t2', 't2.id', '=', 't1.meat_type')
                                ->leftJoin('mst_dist AS t3', 't3.id', '=', 't1.district_id')
                                ->leftJoin('mst_taluka AS t4', 't4.id', '=', 't1.taluka_id')

                                ->where('t1.id', '=', $id)
                                ->whereNull('t1.deleted_at')
                                ->whereNull('t2.deleted_at')
                                ->whereNull('t3.deleted_at')
                                ->whereNull('t4.deleted_at')
                                ->orderBy('t1.id', 'DESC')
                                ->first();

                    //   dd($data);
               if(empty($data)) {

                                    return redirect('/')->with('warning','Apply For Cold Storage Registration License First');

                                }elseif($data->approve_date == ""){

                                    return redirect('/')->with('warning','Your Application status is still Pending');


                                }else {
                // dd($data);
                //  $approve_date = $data->approve_date;



                // $newEndingDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($approve_date)) . " + 1 year"));

                // $currentDate = date('Y-m-d');


                // $timestamp1 = strtotime($currentDate);
                // $timestamp2 = strtotime($newEndingDate);


                // if($timestamp1 > $timestamp2) {
                //     $meatTypeIds = explode(',', $data->meat_type);
                // $selectedMeatTypes =  $meatTypeIds->pluck('id')->toArray();
                //                 dd($selectedMeatTypes);
                return view('user.coldstorage_renewal.cold_storage_renewal_form', compact('data','unit_Meat_Type','id','user_type','meattype_mst'));

                // }else{

                //       $diff = $timestamp1 -$timestamp2 ;
                //       $x = abs(floor($diff / (60 * 60 * 24))) ;

                //      return redirect('/')->with('message','Your license has not yet expired. '  .$x.' days Remaining');

                // }
                 }
                } else {
                return redirect('/user/login');
            }



    }

}
