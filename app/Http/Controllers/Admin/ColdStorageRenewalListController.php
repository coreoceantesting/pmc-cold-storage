<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ColdStorageRenewalLicense_Model;

use App\Models\ApproverenewalAdmin_Model;

use App\Models\ApproveAdmin_Model;
use App\Models\MeatRegisteredUser;
use App\Models\MeatType_Master;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ColdStorageRenewalListController extends Controller
{

	public function ColdStorageRenewalList(request $request, $status)
    {
        // Display All Meat Registration Form ( Status - 0 )
        $meat_renewal_list =  DB::table('coldstorage_renewal_license_tbl AS t1')
                                        ->select('t1.*', 't2.dist_name','t3.taluka_name', 't4.meat_name')
                                        ->leftJoin('mst_dist AS t2', 't2.id', '=', 't1.district_id')
                                        ->leftJoin('mst_taluka AS t3', 't3.id', '=', 't1.taluka_id')
                                        ->leftJoin('meat_type_mst AS t4', 't4.id', '=', 't1.meat_type')

                                        ->where('t1.status', '=', $status)
                                        // ->where('t1.id', '=', $id)
                                        ->where('t1.re_hod_status', '=', 1)
                                        ->whereNull('t1.deleted_at')
                                        ->whereNull('t2.deleted_at')
                                        ->whereNull('t3.deleted_at')
                                        ->whereNull('t4.deleted_at')
                                        ->orderBy('t1.id', 'DESC')
                                        ->get();
        // return $meat_registration_list;

        return view('admin.cold_storage_renewal.grid', compact('meat_renewal_list', 'status'));
    }


     public function ColdStorageView(request $request, $id, $status)
    {
       
         $meat_renewal_view = DB::table('coldstorage_renewal_license_tbl AS t1')
                                        ->select('t1.*', 't2.dist_name','t3.taluka_name', 't4.meat_name','t5.adharcard_doc as regi_adharcard_doc','t5.residitional_proof_doc as regi_residitional_proof_doc','t5.authority_letter_doc as regi_authority_letter_doc','t5.legal_business_doc as regi_legal_business_doc','t5.business_registration_doc as regi_business_registration_doc','t5.agreement_owner_doc as agreement_owner_renewal','t5.noc_owner_doc as doc_owner','t5.property_tax_doc as property_doc','t5.paid_water_doc as paid_water','t5.paid_receipt_doc as receipt_doc','t5.treatment_authorized_doc as tre_authority_doc','t5.fitness_certificate_doc as fitness_doc','t5.issued_doc as regi_issued_doc','t5.registration_doc as regi_doc','t5.slaughter_letter_doc as letter_doc','t5.profile_photo as regi_profile_photo','t5.applicant_signature as regi_app_sign')
                                        ->leftJoin('mst_dist AS t2', 't2.id', '=', 't1.district_id')
                                        ->leftJoin('mst_taluka AS t3', 't3.id', '=', 't1.taluka_id')
                                        ->leftJoin('meat_type_mst AS t4', 't4.id', '=', 't1.meat_type')
                                        ->leftJoin('coldstorage_registration_tbl AS t5', 't5.id', '=', 't1.coldstorage_regi_id')
                                        ->where('t1.status', '=', $status)
                                        ->where('t1.id', '=', $id)
                                        ->whereNull('t1.deleted_at')
                                        ->whereNull('t2.deleted_at')
                                        ->whereNull('t3.deleted_at')
                                        ->whereNull('t4.deleted_at')
                                        ->orderBy('t1.id', 'DESC')
                                        ->first();
          //dd($meat_renewal_view);

        return view('admin.cold_storage_renewal.view', compact('meat_renewal_view'));
    }
    
    //Cold_renewal_invoice
    public function coldRenewalInvoice(request $request, $id, $status)
    {
         $invoice =  DB::table('coldstorage_renewal_license_tbl AS t1')
                        ->select('t1.*')
                        ->where('t1.status', '=', $status)
                        ->where('t1.id', '=', $id)
                        ->orderBy('t1.id', 'DESC')
                        ->first();
        return view('admin.cold_storage_renewal.invoice',compact('invoice'));
    }
    

      public function ApproveColdStoragerenewal(request $request, $id)
    {
        
        //  $data = new ApproverenewalAdmin_Model();

        // $data->meat_pplication_id = $request->id;
        // $data->total_recived_tax = $request->get('total_recived_tax');
        // $data->mobile_number = $request->get('mobile_number');
        // $data->receipt_no = $request->get('receipt_no');
        // $data->date_of_receipt = (!empty($request->date_of_receipt) ? date("d-m-Y", strtotime($request->date_of_receipt)) : NULL);
        // $data->license_number = $request->get('license_number');
        // $data->date_of_license_obtain = (!empty($request->date_of_license_obtain) ? date("d-m-Y", strtotime($request->date_of_license_obtain)) : NULL);
        // $data->date = (!empty($request->date) ? date("d-m-Y", strtotime($request->date)) : NULL);
        // $data->inserted_dt = date("Y-m-d H:i:s");
        // $data->inserted_by = Auth::user()->id;
        // // $data->status = 1; //Rejected
        // $data->save();
        
         $update = [
            'status' => 1,
            'approve_date' => date("Y-m-d H:i:s"),
            'approve_by' => Auth::user()->id,
        ];
        
       $data = ColdStorageRenewalLicense_Model::where('id', $id)->first();

        // $app_no = $request->get('license_number');
        // $scheme = 'Cold Storage Registration Form';
        // //$domain = "https://".$_SERVER['HTTP_HOST'];

        // //print_r($data->mobile_number);exit; 
        // //$project_folder = 'PMC_MeatRegistration';
        
        // $msg = "Your application no:- $app_no for $scheme is Approved Successfully.";

        // $tempID= '1207167447455213113';
        // $this->sendsms($msg,$data->mobile_number,$tempID);
        
        $renewal_list=ColdStorageRenewalLicense_Model::where('id', $id)->update($update);

        $unique_id = $data->renwal_liceans_no;
        //  dd($unique_id);
        $user_id=$data->inserted_by;
        $user = MeatRegisteredUser::where('id',$user_id)->first();
        $mob_number=$data->mobile_number;
        //  dd($data->mobile_number);
        $schema="Cold Storage";
        $domain = "cold-storagee.smartpmc.co.in/";
    	$sms = "Your application no: " . $unique_id . " for ".$schema." has been approved by the PMC office successfully. Please visit the PMC office for further processes, including document verification and certificate issuance. You can also check your license status on " . $domain . " CORE OCEAN.";
    	$templateid = "1207171576775741291";
        $senderid = "CoreOC";
        $route = 1;
        Log::info('Preparing to send SMS to: ' . $mob_number);

        
        $this->sendsmsnew($sms,$mob_number,$templateid);
        // dd($this);

        return redirect('/cold_storage_renewal_list/1')->with('message', 'Cold Storage Renewal Form Approved Successfully'); //Redirect user somewhere
    }


    public function sendsmsnew($sms,$mob_number,$templateid)
    {

        $key = "kbf8IN83hIxNTVgs";
        $mbl=$mob_number;   /*or $mbl="XXXXXXXXXX,XXXXXXXXXX";*/
        $message=$sms;
        $message_content=urlencode($message);
        $tempID= $templateid;
        $senderid="CoreOC";
        $route= 1;
        $url = "http://sms.adityahost.com/vb/apikey.php?apikey=$key&senderid=$senderid&number=$mbl&message=$message_content&templateid=$tempID";

        $output = file_get_contents($url);  /*default function for push any url*/

    }

     public function RejectColdStoragerenewal(request $request, $id){
        
       $update = [
            'status' => 2,
            'reject_resion' => $request->get('reject_resion'),
            'reject_date' => date("Y-m-d H:i:s"),
            'reject_by' => Auth::user()->id,
        ];
        
        ColdStorageRenewalLicense_Model::where('id', $id)->update($update);
        
        $app_no = $request->get('meat_pplication_no');
        $resion = $request->get('reject_resion');
         $mobile = $request->get('mobile_number');
        //$domain = "https://".$_SERVER['HTTP_HOST'];

        //print_r($data->mobile_number);exit; 
        //$project_folder = 'PMC_MeatRegistration';
        
        $msg = "Your application no:- $app_no is Rejected Resion For :- $resion .";

        $tempID= '1207167447455213113';
        $this->sendsms($msg,$mobile,$tempID);
        
      

        return redirect('/cold_storage_renewal_list/2')->with('message', 'Cold Storage Renewal Form Rejected Successfully'); //Redirect user somewhere
    }


    public function EnglishGenerateColdStoragerenewal(request $request, $id, $status)
      {
        
           $meat_renewal_pdf =  DB::table('coldstorage_renewal_license_tbl AS t1')
                                        ->select('t1.*', 't2.dist_name','t3.taluka_name', 't4.meat_name','t5.cold_storage_aplication_no as licence_no','t5.adharcard_doc','t5.residitional_proof_doc','t5.legal_business_doc','t5.business_registration_doc','t5.property_tax_doc','t5.paid_water_doc','t5.slaughter_letter_doc','t5.treatment_authorized_doc','t5.fitness_certificate_doc','t5.issued_doc','t5.applicant_signature','t5.inserted_by','t6.id as approve_id', 't6.meat_pplication_id as approve_PET_UniqueID','t6.date_of_license_obtain as approve_date_of_license_obtain')
                                        ->leftJoin('mst_dist AS t2', 't2.id', '=', 't1.district_id')
                                        ->leftJoin('mst_taluka AS t3', 't3.id', '=', 't1.taluka_id')
                                        ->leftJoin('meat_type_mst AS t4', 't4.id', '=', 't1.meat_type')
                                        ->leftJoin('coldstorage_registration_tbl AS t5', 't5.id', '=', 't1.coldstorage_regi_id')
                                        ->leftJoin('approve_by_admin_renewal_license_tbl AS t6', 't6.meat_pplication_id', '=', 't1.id')
                                        ->where('t1.status', '=', $status)
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
                                   
        return view('admin.cold_storage_renewal.generate_english_coldstorage_renewal_pdf', compact('meat_renewal_pdf','fiscalYear'));
      }
    

     public function MarathiGenerateColdStoragerenewal(request $request, $id, $status)
      {
        
           $meat_renewal_pdf =  DB::table('coldstorage_renewal_license_tbl AS t1')
                                        ->select('t1.*', 't2.dist_name','t3.taluka_name', 't4.meat_name','t5.cold_storage_aplication_no as licence_no','t5.adharcard_doc','t5.residitional_proof_doc','t5.legal_business_doc','t5.business_registration_doc','t5.property_tax_doc','t5.paid_water_doc','t5.slaughter_letter_doc','t5.treatment_authorized_doc','t5.fitness_certificate_doc','t5.issued_doc','t5.applicant_signature','t5.inserted_by','t6.id as approve_id', 't6.meat_pplication_id as approve_PET_UniqueID','t6.date_of_license_obtain as approve_date_of_license_obtain')
                                        ->leftJoin('mst_dist AS t2', 't2.id', '=', 't1.district_id')
                                        ->leftJoin('mst_taluka AS t3', 't3.id', '=', 't1.taluka_id')
                                        ->leftJoin('meat_type_mst AS t4', 't4.id', '=', 't1.meat_type')
                                        ->leftJoin('coldstorage_registration_tbl AS t5', 't5.id', '=', 't1.coldstorage_regi_id')
                                        ->leftJoin('approve_by_admin_renewal_license_tbl AS t6', 't6.meat_pplication_id', '=', 't1.id')
                                        ->where('t1.status', '=', $status)
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
                                   
                                   
        return view('admin.cold_storage_renewal.generate_marathi_coldstorage_renewal_pdf', compact('meat_renewal_pdf','fiscalYear'));
      }


       public function GeneraterenewalaffidavitPdf(request $request, $id, $status)
    {
        
           $meat_registration_pdf =  DB::table('coldstorage_renewal_license_tbl AS t1')
                                        ->select('t1.*', 't2.dist_name','t3.taluka_name', 't4.meat_name','t5.adharcard_doc','t5.residitional_proof_doc','t5.legal_business_doc','t5.business_registration_doc','t5.property_tax_doc','t5.paid_water_doc','t5.slaughter_letter_doc','t5.treatment_authorized_doc','t5.fitness_certificate_doc','t5.issued_doc','t5.applicant_signature','t5.inserted_by','t6.id as approve_id', 't6.meat_pplication_id as approve_PET_UniqueID','t6.date_of_license_obtain as approve_date_of_license_obtain')
                                        ->leftJoin('mst_dist AS t2', 't2.id', '=', 't1.district_id')
                                        ->leftJoin('mst_taluka AS t3', 't3.id', '=', 't1.taluka_id')
                                        ->leftJoin('meat_type_mst AS t4', 't4.id', '=', 't1.meat_type')
                                        ->leftJoin('coldstorage_registration_tbl AS t5', 't5.id', '=', 't1.coldstorage_regi_id')
                                        ->leftJoin('approve_by_admin_renewal_license_tbl AS t6', 't6.meat_pplication_id', '=', 't1.id')
                                        ->where('t1.status', '=', $status)
                                        ->where('t1.id', '=', $id)
                                        ->whereNull('t1.deleted_at')
                                        ->whereNull('t2.deleted_at')
                                        ->whereNull('t3.deleted_at')
                                        ->whereNull('t4.deleted_at')
                                        ->whereNull('t5.deleted_at')
                                        ->whereNull('t6.deleted_at')
                                        ->orderBy('t1.id', 'DESC')
                                        ->first();
      
            //dd($meat_registration_pdf);
                                        
        return view('admin.cold_storage_renewal.renewal_affidavit', compact('meat_registration_pdf'));
    }
    
    

    





         public function sendsms($sms,$mobile_number,$tempID) 
    { 
        
        $user = "mohit";
        $password = "123456";
        $sender_id = 'CoreOc';
        
        $sender = $mobile_number;
        $priority = "ndnd";
    

        $key= 'Ef96BBH3ZZPSXoz6';
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
    
    


}