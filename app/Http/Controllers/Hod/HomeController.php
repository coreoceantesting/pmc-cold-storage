<?php

namespace App\Http\Controllers\Hod;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    //
    public function Admin_Home(){

    //    echo "Hello";

    $total_pending_meat_register_hod_status =  DB::table('coldstorage_registration_tbl AS t1')
        ->select('t1.id')
       ->where('t1.hod_status', '=', 0)         
        ->whereNull('t1.deleted_at')
        ->orderBy('t1.id', 'DESC')
        // ->whereMonth('inserted_dt', Carbon::now()->month)
        ->count();

    $total_approve_meat_register_hod_status =  DB::table('coldstorage_registration_tbl AS t1')
        ->select('t1.id')
       ->where('t1.hod_status', '=', 1)         
        ->whereNull('t1.deleted_at')
        ->orderBy('t1.id', 'DESC')
        // ->whereMonth('inserted_dt', Carbon::now()->month)
        ->count();
        
    $total_rejected_meat_register_hod_status =  DB::table('coldstorage_registration_tbl AS t1')
        ->select('t1.id')
        ->where('t1.hod_status', '=', 2)         
        ->whereNull('t1.deleted_at')
        ->orderBy('t1.id', 'DESC')
        // ->whereMonth('inserted_dt', Carbon::now()->month)
        ->count();

    $total_pending_meat_register =  DB::table('coldstorage_registration_tbl AS t1')
    ->select('t1.id')
    ->where('t1.final_approve', 0)
   ->where('t1.hod_status', '=', 1)         
   ->where('t1.status', '=', 1)
    ->whereNull('t1.deleted_at')
    ->orderBy('t1.id', 'DESC')
    // ->whereMonth('inserted_dt', Carbon::now()->month)
    ->count();

// return $total_pending_meat_register;

$total_approve_meat_register =  DB::table('coldstorage_registration_tbl AS t1')
    ->select('t1.id')
    ->where('t1.final_approve', 1)
    ->where('t1.hod_status', 1)
    ->where('t1.status', 1)
    ->whereNull('t1.deleted_at')
    ->orderBy('t1.id', 'DESC')
    // ->whereMonth('inserted_dt', Carbon::now()->month)
    ->count();

// return $total_approve_meat_register;

$total_rejected_meat_register =  DB::table('coldstorage_registration_tbl AS t1')
    ->select('t1.id')
    ->where('t1.final_approve', 2)
    ->where('t1.hod_status', '=', 1)         
    ->where('t1.status', '=', 1)
    ->whereNull('t1.deleted_at')
    ->orderBy('t1.id', 'DESC')
    // ->whereMonth('inserted_dt', Carbon::now()->month)
    ->count();
    
 $total_pending_cold_renewal_register_re_hod_status =  DB::table('coldstorage_renewal_license_tbl AS t1')
    ->select('t1.id')
    ->where('t1.re_hod_status', 0)
    ->whereNull('t1.deleted_at')
    ->orderBy('t1.id', 'DESC')
    // ->whereMonth('inserted_dt', Carbon::now()->month)
    ->count();
    
 //   dd($total_pending_cold_renewal_register_re_hod_status); die;
    $total_approve_cold_renewal_register_re_hod_status =  DB::table('coldstorage_renewal_license_tbl AS t1')
    ->select('t1.id')
    ->where('t1.re_hod_status', 1)
    ->whereNull('t1.deleted_at')
    ->orderBy('t1.id', 'DESC')
    // ->whereMonth('inserted_dt', Carbon::now()->month)
    ->count();
    
    $total_rejected_cold_renewal_register_re_hod_status =  DB::table('coldstorage_renewal_license_tbl AS t1')
    ->select('t1.id')
    ->where('t1.re_hod_status', 2)
    ->whereNull('t1.deleted_at')
    ->orderBy('t1.id', 'DESC')
    // ->whereMonth('inserted_dt', Carbon::now()->month)
    ->count();
 
    
$total_pending_cold_renewal_register =  DB::table('coldstorage_renewal_license_tbl AS t1')
    ->select('t1.id')
    ->where('t1.re_final_approve', 0)
    ->where('t1.re_hod_status', 1)
    ->where('t1.status', '=', 1)
    ->whereNull('t1.deleted_at')
    ->orderBy('t1.id', 'DESC')
    // ->whereMonth('inserted_dt', Carbon::now()->month)
    ->count();

// return $total_pending_meat_register;

$total_approve_cold_renewal_register =  DB::table('coldstorage_renewal_license_tbl AS t1')
    ->select('t1.id')
    ->where('t1.re_final_approve', 1)
    ->where('t1.re_hod_status', 1)
    ->where('t1.status', '=', 1)
    ->whereNull('t1.deleted_at')
    ->orderBy('t1.id', 'DESC')
    // ->whereMonth('inserted_dt', Carbon::now()->month)
    ->count();

// return $total_approve_meat_register;

$total_rejected_cold_renewal_register =  DB::table('coldstorage_renewal_license_tbl AS t1')
    ->select('t1.id')
    ->where('t1.re_final_approve', 2)
    ->where('t1.re_hod_status', 1)
    ->where('t1.status', '=', 1)
    ->whereNull('t1.deleted_at')
    ->orderBy('t1.id', 'DESC')
    // ->whereMonth('inserted_dt', Carbon::now()->month)
    ->count();   

       return view('hod.admin_dashboard', compact('total_pending_meat_register', 'total_approve_meat_register', 'total_rejected_meat_register','total_pending_cold_renewal_register','total_approve_cold_renewal_register','total_rejected_cold_renewal_register',
       'total_pending_meat_register_hod_status', 'total_approve_meat_register_hod_status', 'total_rejected_meat_register_hod_status', 'total_pending_cold_renewal_register_re_hod_status', 'total_approve_cold_renewal_register_re_hod_status', 'total_rejected_cold_renewal_register_re_hod_status'));
    }
    
}
