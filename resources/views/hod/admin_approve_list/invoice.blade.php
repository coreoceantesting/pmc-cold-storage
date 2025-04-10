@include('common.header')

<section class="content">
    <div class="body_scroll">
        <div class="block-header" id="hide-print">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Cold Storage Application</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/admin/dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item active">Cold Storage Application</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button">
                        <i class="zmdi zmdi-sort-amount-desc"></i>
                    </button>
                </div>
                
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button">
                        <i class="zmdi zmdi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <!-- Print Button -->
                            <button class="btn btn-primary printBtn" onclick="printDiv('printableArea');">Print</button>
                            
                            <!-- Container for printable content -->
                            <div id="printableArea">
                                <!-- Table Start -->
                                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; table-layout: fixed;">
                                    <tr>
                                        <td colspan="16" style="text-align: center;">
                                            <h4>पनवेल महानगरपालिका</h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="16" style="text-align: center;">
                                            <h5>पशुसंवर्धन विभाग</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="16">
                                            <hr style="border-top: 1px dashed black;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="text-align: left;">जा.क्र. पमपा / पशुवैद्यकीय सेवा /</td>
                                        <td colspan="4" style="text-align: center;">/सन 2024-25</td>
                                        <td colspan="2" style="text-align: right;">दि- {{ date('d-m-Y') }}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="16" style="height: 15pt;"></td>
                                    </tr>
                                    <tr>
                                        <td>प्रति,</td>
                                        <td colspan="15" style="text-align: right;">Application no - {{$invoice->cold_storage_aplication_no}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><strong>{{$invoice->applicant_fname.' '.$invoice->applicant_mname.' '.$invoice->applicant_lname}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="16" style="height: 15pt;"></td>
                                    </tr>
                                   <tr>
    <td style="text-align: right;" colspan="12">
        विषय - शीतगृह नवीन नोंदणी शुल्क / शीतगृह पुनर्नोंदणी शुल्क जमा करणेबाबत.
    </td>
</tr>
<tr>
    <td style="text-align: right;" colspan="10">
        संदर्भ - आपला दिनांक {{ date('d-m-Y', strtotime($invoice->inserted_dt)) }} चा अर्ज
    </td>
</tr>

                                    <tr>
                                        <td colspan="16" style="height: 15pt;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="16">
                                            उपरोक्त संदर्भिय विषयान्वये, आपण शीतगृह नोंदणी / पुनर्नोंदणी शुल्कासाठी सादर केलेल्यर शुल्क / पुनर्नोंदणी २५००० रु अक्षरी (twenty-five thousand) इतक्या रकमेचा Demand draft द्वारे हा लेखा विभाग, पनवेल महानगरपालिका यांचेकडे जमा करावे व जमा पावतीची प्रत या कार्यालयाकडे सादर करावी. (H/P)
                                        </td>
                                    </tr>
                                    <tr>
    <td colspan="16" style="height: 20pt;"></td> <!-- Adding empty row for space -->
</tr>
                                    <tr>
					    <td colspan="9">Demand Draft Number ---------------------</td>
					    <td colspan="7" style="white-space: nowrap;">Account no -</td> <!-- Adjust colspan and add white-space: nowrap; -->
					</tr>
					<tr>
					    <td colspan="9">Demand Draft Amount ---------------------</td>
					</tr>

                                    <tr>
    <td colspan="16" style="height: 40pt;"></td> <!-- Adding empty row for space -->
</tr>
                                    <tr>
    <td colspan="16" style="text-align: right;">पशुधन विकास अधिकारी</td>
    
</tr>
<tr>
<td colspan="16" style="text-align: right;"><h5>पनवेल महानगरपालिका</h5></td> 
</tr>


                                </table>
                                <!-- Table End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('common.footer')

<!-- Print JavaScript -->
<script>
function printDiv(divId) {
    // Create a new window
    var printWindow = window.open('', '_blank', 'width=800,height=600');
    var content = document.getElementById(divId).innerHTML;

    // Style for printing
    printWindow.document.write(`
        <html>
            <head>
                <title>Print</title>
                <style>
                    @media print {
                        body { -webkit-print-color-adjust: exact; }
                    }
                </style>
            </head>
            <body onload="window.print();">
                ${content}
            </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.focus();
}
</script>
