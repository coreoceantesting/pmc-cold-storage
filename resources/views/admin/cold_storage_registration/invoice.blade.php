@include('common.header')

<style>
@media print {
  #hide-print{
      display: none;
   }

   .menu, .printBtn, .navbar-brand,.navbar-nav{
     display: none !important;
   }

   Header {
      display: none !important;
    }
    Footer {
      display: none !important;
    }
}
</style>



<section class="content">
    <div class="body_scroll">
        <div class="block-header" id="hide-print">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Cold Storage Application</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item active">Cold Storage Application</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

          <div class="container-fluid">
            <!-- Vertical Layout -->
               <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="card">
                              <div class="body">

                              
                                   <table border=0 cellpadding=0 cellspacing=0 width=1088 style='border-collapse:
                                   collapse;table-layout:fixed;width:816pt'>

                                   <button class="btn btn-primary printBtn" id="" onclick="window.print();">Print</button>

                                   <col width=64 span=17 style='width:48pt'>
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 width=64 style='height:15.0pt;width:48pt'></td>
                                        <td width=64 style='width:48pt'></td>
                                        <td width=64 style='width:48pt'></td>
                                        <td width=64 style='width:48pt'></td>
                                        <td width=64 style='width:48pt'></td>
                                        <td width=64 style='width:48pt'></td>
                                        <td width=64 style='width:48pt'></td>
                                        <td width=64 style='width:48pt'></td>
                                        <td width=64 style='width:48pt'></td>
                                        <td width=64 style='width:48pt'></td>
                                        <td width=64 style='width:48pt'></td>
                                        <td width=64 style='width:48pt'></td>
                                        <td width=64 style='width:48pt'></td>
                                        <td width=64 style='width:48pt'></td>
                                        <td width=64 style='width:48pt'></td>
                                        <td width=64 style='width:48pt'></td>
                                        <td width=64 style='width:48pt'></td>
                                   </tr>
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td class=xl65>&nbsp;</td>
                                        <td class=xl66>&nbsp;</td>
                                        <td class=xl66>&nbsp;</td>
                                        <td class=xl66>&nbsp;</td>
                                        <td class=xl66>&nbsp;</td>
                                        <td class=xl66>&nbsp;</td>
                                        <td class=xl66>&nbsp;</td>
                                        <td class=xl66>&nbsp;</td>
                                        <td class=xl66>&nbsp;</td>
                                        <td class=xl66>&nbsp;</td>
                                        <td class=xl66>&nbsp;</td>
                                        <td class=xl67>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                   </tr>
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td class=xl70>&nbsp;</td>
                                        <td class=xl71>&nbsp;</td>
                                        <td class=xl71>&nbsp;</td>
                                        <td class=xl71>&nbsp;</td>
                                        <td class=xl71 colspan=5 style='mso-ignore:colspan'>
                                             <h4>पनवेल महानगरपालिका  </h4>
                                        </td>
                                        <td class=xl71>&nbsp;</td>
                                        <td class=xl71>&nbsp;</td>
                                        <td class=xl71>&nbsp;</td>
                                        <td class=xl71>&nbsp;</td>
                                        <td class=xl71>&nbsp;</td>
                                        <td class=xl72>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                   </tr>
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td class=xl70>&nbsp;</td>
                                        <td class=xl71>&nbsp;</td>
                                        <td class=xl71>&nbsp;</td>
                                        <td class=xl71>&nbsp;</td>
                                        <td class=xl71>&nbsp;</td>
                                        <td class=xl71 colspan=2 style='mso-ignore:colspan'>
                                             पशुसंवर्धन विभाग   
                                        </td>
                                        <td class=xl71>&nbsp;</td>
                                        <td class=xl71>&nbsp;</td>
                                        <td class=xl71>&nbsp;</td>
                                        <td class=xl71>&nbsp;</td>
                                        <td class=xl72>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                   </tr>
                                   <tr height=20 style='height:15.0pt'>
                                        <td class=xl71 colspan=14 style='mso-ignore:colspan'>
                                             <hr style=" border-top: 1px dashed black;">
                                        </td>
                                   </tr>
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td colspan=3 style='mso-ignore:colspan'>
                                        जा.क्र. पमपा / पशुवैद्यकीय सेवा /   
                                        </td>
                                        <td></td>
                                        <td colspan=2 >/सन 2024-25</td>
                                        <td style='mso-ignore:colspan'></td>
                                        <td></td>
                                        <td colspan=2 > दि- {{ date('d-m-Y') }}</td>
                                        <td class=xl69>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                   </tr>
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td class=xl68>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class=xl69>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                   </tr>
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td class=xl68>प्रति,</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan=6 style='mso-ignore:colspan'>Application no - {{$invoice->cold_storage_aplication_no}}</td>
                                        <td></td>
                                        <td class=xl69>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                   </tr>
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td class=xl68 colspan="4"><b>{{$invoice->applicant_fname.' '.$invoice->applicant_mname.' '.$invoice->applicant_lname}}</b></td>
                                        <!-- <td></td> -->
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class=xl69>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                   </tr>
                                   
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td class=xl68 colspan="4"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class=xl69>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                   </tr>
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td class=xl68>&nbsp;</td>
                                        <td>  विषय  - </td>
                                        <td colspan=7 style='mso-ignore:colspan'>
                                        शीतगृह नवीन नोंदणी शुल्क /शीतगृह  पुनर्नोंदणी शुल्क जमा करणेबाबत.  
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td class=xl69>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                   </tr>
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td class=xl68>&nbsp;</td>
                                        <td>
                                             संदर्भ -
                                        </td>
                                        <td colspan=4 style='mso-ignore:colspan'>
                                             आपला दिनांक  {{date('d-m-Y', strtotime($invoice->inserted_dt))}}   चा अर्ज 
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class=xl69>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                   </tr>
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td class=xl68>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class=xl69>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                   </tr>
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td colspan=15 style='mso-ignore:colspan;'>
                                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                        उपरोक्त संदर्भिय विषयान्वये, आपण शीतगृह नोंदणी / पुनर्नोंदणी   शुल्कासाठी सादर केलेल्या अर्जानुसार शुल्क / पुनर्नोंदणी
                                             <br> २५०००  रु अक्षरी  (twenty-five thousand.)&nbsp;
                                             इतक्या रकमेचा   Demand draft द्वारे हा लेखा विभाग, पनवेल 
                                             महानगरपालिका
                                        </td>
                                        <td class=xl68>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                   </tr>
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td colspan=19 style='mso-ignore:colspan'>
                                             यांचेकडे जमा करावे    
                                             व जमा पावतीची प्रत  या कार्यालयाकडे सादर करावी. (H/P)  
                                        </td>
                                        <td class=xl68>&nbsp;</td>
                                        <td></td>
                                        <td class=xl69>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                   </tr>
                                   
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td class=xl68>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class=xl69>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="" style='mso-ignore:colspan'></td>
                                        <td></td>
                                   </tr>
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td colspan=9 style='mso-ignore:colspan'>
                                             Demand Draft Number ---------------------       &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Account no -           
                                        </td>
                                        <td class=xl68>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class=xl69>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                   </tr>
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td colspan=9 style='mso-ignore:colspan'>
                                             Demand Draft Amount ---------------------        
                                        </td>
                                        <td class=xl68>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class=xl69>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                   </tr>
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td class=xl68>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class=xl69>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="" style='mso-ignore:colspan'></td>
                                        <td></td>
                                   </tr>
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td class=xl68>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class=xl69>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="" style='mso-ignore:colspan'></td>
                                        <td></td>
                                   </tr>  
                                        <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td class=xl68>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class=xl69>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan=9 style='padding-left:8px;'>
                                             पशुधन विकास अधिकारी 
                                        </td>
                                        <td></td>
                                        </tr>
                                        
                                        
                                   <tr height=20 style='height:15.0pt'>
                                        <td height=20 style='height:15.0pt'></td>
                                        <td class=xl68>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="4"> <h5>पनवेल महानगरपालिका  </h5></td>
                                        <td></td>
                                        <td class=xl69>&nbsp;</td>
                                        <td></td>
                                   </tr>
                                   </table>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>
@include('common.footer') 

    