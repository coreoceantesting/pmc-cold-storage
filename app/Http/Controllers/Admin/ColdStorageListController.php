<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ColdStorageRegistration_Model;
use App\Models\ApproveAdmin_Model;
use App\Models\MeatType_Master;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ColdStorageListController extends Controller
{

	public function ColdStorageRegistrationList(request $request, $status)
    {
        // Display All Meat Registration Form ( Status - 0 )
        $meat_registration_list =  DB::table('coldstorage_registration_tbl AS t1')
                                        ->select('t1.*', 't2.dist_name','t3.taluka_name', 't4.meat_name')
                                        ->leftJoin('mst_dist AS t2', 't2.id', '=', 't1.district_id')
                                        ->leftJoin('mst_taluka AS t3', 't3.id', '=', 't1.taluka_id')
                                        ->leftJoin('meat_type_mst AS t4', 't4.id', '=', 't1.meat_type')

                                        ->where('t1.status', '=', $status)
                                        // ->where('t1.id', '=', $id)
                                        ->where('t1.hod_status', '=', 1)
                                        ->whereNull('t1.deleted_at')
                                        ->whereNull('t2.deleted_at')
                                        ->whereNull('t3.deleted_at')
                                        ->whereNull('t4.deleted_at')
                                        ->orderBy('t1.id', 'DESC')
                                        ->get();
        // return $meat_registration_list;

        return view('admin.cold_storage_registration.grid', compact('meat_registration_list', 'status'));
    }

      public function ColdStorageView(request $request, $id, $status)
    {
         $unit_Meat_Type = DB::table('unit_Meat_Type')->get();
        $meat_registration_view =  DB::table('coldstorage_registration_tbl AS t1')
                                        ->select('t1.*', 't2.dist_name','t3.taluka_name', 't4.meat_name')
                                        ->leftJoin('mst_dist AS t2', 't2.id', '=', 't1.district_id')
                                        ->leftJoin('mst_taluka AS t3', 't3.id', '=', 't1.taluka_id')
                                        ->leftJoin('meat_type_mst AS t4', 't4.id', '=', 't1.meat_type')

                                        ->where('t1.status', '=', $status)
                                        ->where('t1.id', '=', $id)
                                        ->whereNull('t1.deleted_at')
                                        ->whereNull('t2.deleted_at')
                                        ->whereNull('t3.deleted_at')
                                        ->whereNull('t4.deleted_at')
                                        ->orderBy('t1.id', 'DESC')
                                        ->first();
                                        
        // return $meat_registration_view;
        
        return view('admin.cold_storage_registration.view', compact('meat_registration_view','unit_Meat_Type'));
    }


 //Cold_registraion_invoice
    public function coldRegistrationInvoice(request $request, $id, $status)
    {
         $invoice =  DB::table('coldstorage_registration_tbl AS t1')
                        ->select('t1.*')
                        ->where('t1.status', '=', $status)
                        ->where('t1.id', '=', $id)
                        ->orderBy('t1.id', 'DESC')
                        ->first();
        return view('admin.cold_storage_registration.invoice',compact('invoice'));
    }
    
    

        // Approved Meat Registration Form ( Status - 1 )
     public function ApproveColdStorageRegistration(request $request, $id)
     {

        $data = ColdStorageRegistration_Model::where('id','=',$id)->firstOrFail();
        //print_r($request->get('mobile_number'));exit;
        // $data = new ApproveAdmin_Model();

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
            'approve_date' => date("Y-m-d"),
            'approve_by' => Auth::user()->id,
        ];
        
        ColdStorageRegistration_Model::where('id', $id)->update($update);
        
        // $mob_number = $data->mobile_number;
        $unique_id = $data->cold_storage_aplication_no;
        // $domain = "https://cold-storage.smartpmc.co.in/";
    	// $sms = "Your application no: " . $unique_id . " for cold storage licence has been approved by the PMC office successfully. Please visit the PMC office for further processes, including document verification and certificate issuance. You can also check your license status on " . $domain . " CORE OCEAN.";
    	// $this->sendsmsnew($sms,$mob_number);


        // $user_id=$data->inserted_by;
        // $user = PetRegisteredUser::where('id',$user_id)->first();
        $mob_number = $data->mobile_number;
        // dd($mob_number);
        $key= 'kbf8IN83hIxNTVgs';
        // $unique_id = $data->pet_pplication_no;
        $domain = "cold-storage.smartpmc.co.in";
    	$sms = "Your application no: " . $unique_id . " for cat registration has been approved by the PMC office successfully. Please visit the PMC office for further processes, including document verification and certificate issuance. You can also check your license status on " . $domain . " CORE OCEAN.";
    	$templateid = "1207171576775741291";
        $senderid = "CoreOC";
        $route = 1;

        $response = Http::get('http://sms.adityahost.com/vb/apikey.php',[
            'apikey'   => $key,
            'senderid' => $senderid,
            'number'   =>  $mob_number,
            'message'  => $sms,
            'route'    => $route,
            'templateid'  => $templateid
          ]);
        $this->sendsmsnew($sms,$mob_number,$templateid,$response->body());
        Log::info('SMS API Response: ', ['response' => $response->body()]);
        

        // $app_no = $request->get('license_number');
        // $scheme = 'Cold Storage Registration Form';
        //$domain = "https://".$_SERVER['HTTP_HOST'];

        //print_r($data->mobile_number);exit; 
        //$project_folder = 'PMC_MeatRegistration';
        
        // $msg = "Your application no:- $app_no for $scheme is Approved Successfully.";

        // $tempID= '1207167447455213113';
        // $this->sendsms($msg,$data->mobile_number,$tempID);

        return redirect('/cold_storage_list/1')->with('message', 'Cold Storage Registration Form Approved Successfully'); //Redirect user somewhere
  
    }

    public function RejectColdStorageRegistration(request $request, $id){
        
        $data = ColdStorageRegistration_Model::where('id','=',$id)->firstOrFail();
        $update = [
            'status' => 2,
            'reject_resion' => $request->get('reject_resion'),
            'reject_date' => date("Y-m-d H:i:s"),
            'reject_by' => Auth::user()->id,
        ];
        
        ColdStorageRegistration_Model::where('id', $id)->update($update);
        
        $mob_number = $data->mobile_number;
        $unique_id = $data->cold_storage_aplication_no;
        $reason = $request->get('reject_resion');
    	$sms = "Your application no:- " . $unique_id . " for cold storage licence is rejected, Reason for rejection: " . $reason . " CORE OCEAN.";
    	$this->sendsmsnew($sms,$mob_number);
        
        
        // $app_no = $request->get('meat_pplication_no');
        // $resion = $request->get('reject_resion');
        // $mobile = $request->get('mobile_number');
        // //$domain = "https://".$_SERVER['HTTP_HOST'];
        
        // $msg = "Your application no:- $app_no is Rejected Resion For  $resion .";

        // $tempID= '1207167447455213113';
        // $this->sendsms($msg,$mobile,$tempID);


        return redirect('/cold_storage_list/2')->with('message', 'Cold Storage Registration Form Rejected Successfully'); //Redirect user somewhere
    }

    public function EnglishGenerateColdStorageRegistration(request $request, $id, $status)
    {
        
           $meat_registration_pdf =  DB::table('coldstorage_registration_tbl AS t1')
                                         ->select('t1.*', 't2.dist_name','t3.taluka_name', 't4.meat_name','t5.id as approve_id', 't5.meat_pplication_id as approve_PET_UniqueID', 't5.total_recived_tax as approve_recived_tax', 't5.receipt_no as approve_receipt_no',
                                                  't5.date_of_receipt as approve_date_of_receipt', 't5.license_number as approve_license_number', 't5.date_of_license_obtain as approve_date_of_license_obtain',
                                                  't5.date as approve_date')
                                        ->leftJoin('mst_dist AS t2', 't2.id', '=', 't1.district_id')
                                        ->leftJoin('mst_taluka AS t3', 't3.id', '=', 't1.taluka_id')
                                        ->leftJoin('meat_type_mst AS t4', 't4.id', '=', 't1.meat_type')
                                        ->leftJoin('approve_by_admin_tbl AS t5', 't5.meat_pplication_id', '=', 't1.id')
                                        ->where('t1.status', '=', $status)
                                        ->where('t1.id', '=', $id)
                                        ->whereNull('t1.deleted_at')
                                        ->whereNull('t2.deleted_at')
                                        ->whereNull('t3.deleted_at')
                                        ->whereNull('t4.deleted_at')
                                        ->whereNull('t5.deleted_at')
                                        ->orderBy('t1.id', 'DESC')
                                        ->first();
                                        
        $current_date = $meat_registration_pdf->inserted_dt;
        // dd($current_date);
        
        $current_m = date('m', strtotime($current_date));
        $currentMonth = Carbon::today($current_m)->format('m');
        // dd($currentMonth);
        $fiscalYear = '';
        
        $fiscalYear = $currentMonth > 3 ? Carbon::createFromFormat('d-m-Y', '31-03-'.date('Y'))->addYear()->toDateString() : Carbon::createFromFormat('d-m-Y', '31-03-'.date('Y'))->toDateString();
        
        // dd($fiscalYear);
                                        
        return view('admin.cold_storage_registration.generate_english_coldstorage_registration_pdf', compact('meat_registration_pdf','fiscalYear'));
    }
    
     public function MarathiGenerateColdStorageRegistration(request $request, $id, $status)
     {
        // $meat_registration_pdf =  DB::table('dog_registration_tbl AS t1')
           $meat_registration_pdf =  DB::table('coldstorage_registration_tbl AS t1')
                                         ->select('t1.*', 't2.dist_name','t3.taluka_name', 't4.meat_name','t5.id as approve_id', 't5.meat_pplication_id as approve_PET_UniqueID', 't5.total_recived_tax as approve_recived_tax', 't5.receipt_no as approve_receipt_no',
                                                  't5.date_of_receipt as approve_date_of_receipt', 't5.license_number as approve_license_number', 't5.date_of_license_obtain as approve_date_of_license_obtain',
                                                  't5.date as approve_date')
                                        ->leftJoin('mst_dist AS t2', 't2.id', '=', 't1.district_id')
                                        ->leftJoin('mst_taluka AS t3', 't3.id', '=', 't1.taluka_id')
                                        ->leftJoin('meat_type_mst AS t4', 't4.id', '=', 't1.meat_type')
                                         ->leftJoin('approve_by_admin_tbl AS t5', 't5.meat_pplication_id', '=', 't1.id')
                                        ->where('t1.status', '=', $status)
                                        ->where('t1.id', '=', $id)
                                        ->whereNull('t1.deleted_at')
                                        ->whereNull('t2.deleted_at')
                                        ->whereNull('t3.deleted_at')
                                        ->whereNull('t4.deleted_at')
                                        ->whereNull('t5.deleted_at')
                                        ->orderBy('t1.id', 'DESC')
                                        ->first();
        // return $pet_registration_pdf;
        
        $current_date = $meat_registration_pdf->inserted_dt;
        // dd($current_date);
        
        $current_m = date('m', strtotime($current_date));
        $currentMonth = Carbon::today($current_m)->format('m');
        // dd($currentMonth);
        $fiscalYear = '';
        
        $fiscalYear = $currentMonth > 3 ? Carbon::createFromFormat('d-m-Y', '31-03-'.date('Y'))->addYear()->toDateString() : Carbon::createFromFormat('d-m-Y', '31-03-'.date('Y'))->toDateString();
        
        // dd($fiscalYear);
                                        
        return view('admin.cold_storage_registration.generate_marathi_coldstorage_registration_pdf', compact('meat_registration_pdf','fiscalYear'));
     }


       public function GenerateaffidavitPdf(request $request, $id, $status)
    {
        
           $meat_registration_pdf =  DB::table('coldstorage_registration_tbl AS t1')
                                        ->select('t1.*', 't2.dist_name','t3.taluka_name', 't4.meat_name','t5.id as approve_id', 't5.meat_pplication_id as approve_PET_UniqueID', 't5.total_recived_tax as approve_recived_tax', 't5.receipt_no as approve_receipt_no',
                                                  't5.date_of_receipt as approve_date_of_receipt', 't5.license_number as approve_license_number', 't5.date_of_license_obtain as approve_date_of_license_obtain',
                                                  't5.date as approve_date')
                                        ->leftJoin('mst_dist AS t2', 't2.id', '=', 't1.district_id')
                                        ->leftJoin('mst_taluka AS t3', 't3.id', '=', 't1.taluka_id')
                                        ->leftJoin('meat_type_mst AS t4', 't4.id', '=', 't1.meat_type')
                                        ->leftJoin('approve_by_admin_tbl AS t5', 't5.meat_pplication_id', '=', 't1.id')
                                        ->where('t1.status', '=', $status)
                                        ->where('t1.id', '=', $id)
                                        ->whereNull('t1.deleted_at')
                                        ->whereNull('t2.deleted_at')
                                        ->whereNull('t3.deleted_at')
                                        ->whereNull('t4.deleted_at')
                                        ->whereNull('t5.deleted_at')
                                        ->orderBy('t1.id', 'DESC')
                                        ->first();
        // return $pet_registration_pdf;
                                        
        return view('admin.cold_storage_registration.affidavit', compact('meat_registration_pdf'));
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
    
    public function sendsmsnew($sms,$mob_number) 
    { 

        $key = "kbf8IN83hIxNTVgs";  
        $mbl=$mob_number;   /*or $mbl="XXXXXXXXXX,XXXXXXXXXX";*/
        $message=$sms;
        $message_content=urlencode($message);
        
        $senderid="CoreOC"; $route= 1;
        $url = "http://sms.adityahost.com/vb/apikey.php?apikey=$key&senderid=$senderid&number=$mbl&message=$message_content";
                            
        $output = file_get_contents($url);  /*default function for push any url*/
        
    }

}