<?php 
if(isset($_REQUEST['edit'])){
	if(is_numeric($_REQUEST['check'])){
		$data = getInfo('savvion_check',"id=$_REQUEST[check]");
		$_REQUEST['ApplicantName'] 			=$data['ApplicantName'];
		$_REQUEST['Barcode'] 				= $data['Barcode'];
		$_REQUEST['SubBarcode'] 			=$data['SubBarcode'];
		$_REQUEST['ClientName'] 			=$data['ClientName'];
		$_REQUEST['ClientRefNo'] 			=$data['ClientRefNo'];	
		$_REQUEST['DateOfBirth']			=$data['DateOfBirth'];
		$_REQUEST['PassportNo'] 			=$data['PassportNo'];
		$_REQUEST['AKAName'] 				=$data['AKAName'];
		$_REQUEST['Gender'] 				=$data['Gender'];	
		$_REQUEST['Nationality']			=$data['Nationality'];
		$_REQUEST['ArabicName'] 			=$data['ArabicName'];
		$_REQUEST['_UNBOUND_textArea3'] 	=$data['_UNBOUND_textArea3'];
		$_REQUEST['HistoryRemarks'] 		=$data['HistoryRemarks'];	
		$_REQUEST['_UNBOUND_historyNew']	=$data['_UNBOUND_historyNew'];
		
						

		
		/*$_REQUEST['Education_UniversityName']		=$data['Education_UniversityName'];
		$_REQUEST['Education_UniversityAddress']	=$data['Education_UniversityAddress'];
		$_REQUEST['Education_City']					=$data['Education_City'];
		$_REQUEST['Education_Country']				=$data['Education_Country'];
		$_REQUEST['Education_Telephone']			=$data['Education_Telephone'];
		$_REQUEST['IA_Name']						=$data['IA_Name'];
		$_REQUEST['IA_Address']						=$data['IA_Address'];
		$_REQUEST['IA_City']						=$data['IA_City'];
		$_REQUEST['IA_Country']						=$data['IA_Country'];
		$_REQUEST['IA_Fax']							=$data['IA_Fax'];
		$_REQUEST['IA_Email']						=$data['IA_Email'];
		$_REQUEST['IA_WebAddress']					=$data['IA_WebAddress'];
		$_REQUEST['IA_IsFake']						=$data['IA_IsFake'];
		$_REQUEST['IA_IsOnline']					=$data['IA_IsOnline'];
		$_REQUEST['IA_Telephone']					=$data['IA_Telephone'];
		$_REQUEST['Employment_CompanyName']			=$data['Employment_CompanyName'];
		$_REQUEST['Employment_CompanyAddress']		=$data['Employment_CompanyAddress'];
		$_REQUEST['Employment_City']				=$data['Employment_City'];
		$_REQUEST['Employment_Country']				=$data['Employment_Country'];
		$_REQUEST['Employment_Telephone']			=$data['Employment_Telephone'];
		$_REQUEST['Employment_WebAddress']			=$data['Employment_WebAddress'];
		$_REQUEST['IA_ContactPerson']				=$data['IA_ContactPerson'];
		$_REQUEST['HltLicense_AuthorityName']		=$data['HltLicense_AuthorityName'];
		$_REQUEST['HltLicense_AuthorityAddress']	=$data['HltLicense_AuthorityAddress'];
		$_REQUEST['HltLicense_City']				=$data['HltLicense_City'];
		$_REQUEST['HltLicense_Country']				=$data['HltLicense_Country'];
		$_REQUEST['HltLicense_Telephone']			=$data['HltLicense_Telephone'];
		$_REQUEST['HltLicense_WebAddress']			=$data['HltLicense_WebAddress'];*/

		
		
		if (preg_match('/ED/',$_REQUEST['SubBarcode'])){
			$tab_value = 1;
			$savv_checkId = $data['id'];
		}
		if (preg_match('/EM/',$_REQUEST['SubBarcode'])){
			$tab_value = 2;
			$savv_checkId = $data['id'];
		}
		if (preg_match('/HL/',$_REQUEST['SubBarcode'])){
			$tab_value = 3;
			$savv_checkId = $data['id'];
		}

	}
}
?>


<style>
.addsavvioncheck-section
{
    padding: 20px 0;
    margin: 0 -15px;
}
.addsavvioncheck-section .form-group
{
	width: 16.66%;
	float: left;
	padding: 0 8px;
	margin: 0 0 0 0;
	font-size: 12px;
}
.addsavvioncheck-section-first
{
    border-bottom: 1px solid #eee;
    margin: 0px 15px 30px 15px;
    border: 1px solid #eee;
    padding: 15px 0;
    background-color: rgba(238, 238, 238, 0.26);
}
.addsavvioncheck-section .list-group-item
{
	border: 0;
	margin: 0;
	padding: 0;
}
.addsavvioncheck-section .section-title
{
    padding-bottom: 20px;
    margin: 0;
    border-bottom: 0;	
	clear: both;
	padding-left: 15px;
}
.addsavvioncheck-section #eduction .section-title:nth-child(1), .addsavvioncheck-section #pre-employment .section-title:nth-child(1), .addsavvioncheck-section #health-legislation .section-title:nth-child(1)
{
    background-color: #333;
    margin: 0 15px 20px 15px;
    padding: 12px 16px;
    color: #fff;	
}
.addsavvioncheck-section .form-control
{
	margin-bottom: 15px;
	font-size: 12px;
}
.addsavvioncheck-section textarea.form-control
{
    height: 107px;
}
.paddsavvioncheck-tab
{
	background-color: #eee;
    margin: 0 15px 30px 15px;
}
.paddsavvioncheck-tab li a
{
	font-size: 16px;
	text-transform: uppercase;
	padding: 15px 20px;
	color: #000;
	background-color: transparent;	
}
.paddsavvioncheck-tab li.active a, .paddsavvioncheck-tab li.active a:focus, .paddsavvioncheck-tab li a:hover, .paddsavvioncheck-tab li.active a
{
	-webkit-box-shadow: inset 0 -3px 0 0 #C31E24 !important;
	box-shadow: inset 0 -3px 0 0 #C31E24 !important;
}
.addsavvioncheck-section .checkbox-inline input[type="checkbox"]
{
    margin-left: 0;	
}
.addsavvioncheck-section2
{
	margin: 10px 15px;
	border: 1px solid #eee;
	padding: 15px 0;
	background-color: rgba(238, 238, 238, 0.26);
}
.addsavvioncheck-section2 .form-group
{
	width:20%;	
}
.addsavvioncheck-section2 textarea.form-control {
    height: 60px;
}
.addsavvioncheck-section2 .checkbox-inline
{
    padding-left: 0;
    padding-bottom: 10px;
}
.Is_Error_Comments
{
	display:none;	
}
.addsavvioncheck-section2 .checkbox-inline input[type="checkbox"]
{
    margin-right: 10px;	
}
.addsavvioncheck-section2 a.crm-remarks-btn, .addsavvioncheck-section3 a.verification-stu-btn, .addsavvioncheck-section4 a.add_field_button
{
    background-color: #C31E24;
    color: #fff;
    padding: 8px 15px;
    display: inline-block;
    margin: 0 15px 0px 0px;
    float: right;	
}
.addsavvioncheck-section2 a.crm-remarks-btn:after, .addsavvioncheck-section3 a.verification-stu-btn:after,  .addsavvioncheck-section4 a.add_field_button:after
{
	font-family: 'FontAwesome';
	content: "\f067";
	margin-left: 10px;
	font-size: 12px;
}
.addsavvioncheck-section2 a.crm-remarks-btn.active:after, .addsavvioncheck-section3 a.verification-stu-btn.active:after
{
	content: "\f068";
}
.crm-remarks
{
	padding-top:15px;
	display:none;
}
.addsavvioncheck-section3
{
	margin: 10px 15px;
	border: 1px solid #eee;
	padding: 15px 0;
	background-color: rgba(238, 238, 238, 0.26);
}
.verification-stu
{
	padding-top:15px;
	display:none;
}
.addsavvioncheck-section3 textarea.form-control {
    height: 70px;
}
.addsavvioncheck-section4
{
	margin: 10px 15px;
	border: 1px solid #eee;
	padding: 15px 0;
	background-color: rgba(238, 238, 238, 0.26);
}
.addsavvioncheck-section4 .form-group
{
	width: 50%;
}
.addsavvioncheck-section4 .fileinput, .addsavvioncheck-section4 .form-control
{
	margin-bottom: 0;
}
.fileinput-new .input-group .btn-file
{
    color: #fff;	
}
.addsavvioncheck-section-btn
{
	margin:20px 15px 0 15px;
}
.addsavvioncheck-section-btn .form-group
{
	width: 100%;
	float:none;
	padding: 0;
}
.savvion-eduction-box1, .savvion-eduction-box2, .savvion-eduction-box3
{
	border-bottom: 1px solid #eee;
	margin: 0px 15px 30px 15px;
	border: 1px solid #eee;
	padding: 0px;
	background-color: rgba(238, 238, 238, 0.26);
}
.savvion-eduction-box1 h5, .savvion-eduction-box2 h5, .savvion-eduction-box3 h5
{
    padding: 10px 8px;
    margin: 0;
    border-bottom: 1px solid #eee;
    background-color: #eee;	
	text-transform: uppercase;
}
.savvion-eduction-box1 h5 span, .savvion-eduction-box2 h5 span, .savvion-eduction-box3 h5 span
{
    float: right;
    text-transform: capitalize;
    font-size: 12px;
    background-color: #333;
    color: #fff;
    padding: 3px 5px;
    line-height: 1;
    position: relative;
    top: -1px;
    cursor: pointer;	
}
.savvion-eduction-box1 h5 span:after, .savvion-eduction-box2 h5 span:after, .savvion-eduction-box3 h5 span:after
{
    font-family: 'FontAwesome';
    content: "\f067";
    margin-left: 6px;
    font-size: 9px;
}
.savvion-eduction-box1 h5.active span:after, .savvion-eduction-box2 h5.active span:after, .savvion-eduction-box3 h5.active span:after
{
	content: "\f068";
}
.savvion-eduction-box1-1, .savvion-eduction-box2-1, .savvion-eduction-box3-1
{
	padding-top:15px;	
}
.savvion-eduction-box2-1, .savvion-eduction-box3-1
{
	display:none;
}
.savvion-eduction-box1-1 .form-group, .savvion-eduction-box2-1 .form-group
{
	width: 20%;
}
.savvion-eduction-box3-1 .form-group
{
	width: 100%;
}
.savvion-eduction-box3-1 .form-group .txt
{
	float: left;
	width: 35%;
	text-align: center;
	font-size: 15px;
	padding-bottom: 10px;	
}
.savvion-eduction-box3-1 .form-group label
{
	width: 20%;
	float: left;
}
.savvion-eduction-box3-1 .form-group .form-control
{
	width: 35%;
	float: left;
}
.savvion-eduction-box3-1 .form-group .btn_move
{
    float: left;
    width: 10%;
    min-height: 1px;
    text-align: center;
    font-size: 14px;
    margin-top: 1px;
}
.savvion-eduction-box3-1 .form-group .btn_move i
{
    width: 30px;
    height: 30px;
    border: 1px solid #C31E24;
    display: inline-block;
    line-height: 30px;
    cursor: pointer;
    color: #C31E24;
}
.savvion-eduction-box1-1 textarea.form-control
{
	height: 70px;	
}
.savvion-employment-box1, .savvion-employment-box2, .savvion-employment-box3
{
	border-bottom: 1px solid #eee;
	margin: 0px 15px 30px 15px;
	border: 1px solid #eee;
	padding: 0px;
	background-color: rgba(238, 238, 238, 0.26);
}
.savvion-employment-box1 h5, .savvion-employment-box2 h5, .savvion-employment-box3 h5
{
    padding: 10px 8px;
    margin: 0;
    border-bottom: 1px solid #eee;
    background-color: #eee;	
	text-transform: uppercase;
}
.savvion-employment-box1 h5 span, .savvion-employment-box2 h5 span, .savvion-employment-box3 h5 span
{
    float: right;
    text-transform: capitalize;
    font-size: 12px;
    background-color: #333;
    color: #fff;
    padding: 3px 5px;
    line-height: 1;
    position: relative;
    top: -1px;
    cursor: pointer;	
}
.savvion-employment-box1 h5 span:after, .savvion-employment-box2 h5 span:after, .savvion-employment-box3 h5 span:after
{
    font-family: 'FontAwesome';
    content: "\f067";
    margin-left: 6px;
    font-size: 9px;
}
.savvion-employment-box1 h5.active span:after, .savvion-employment-box2 h5.active span:after, .savvion-employment-box3 h5.active span:after
{
	content: "\f068";
}
.savvion-employment-box1-1, .savvion-employment-box2-1, .savvion-employment-box3-1
{
	padding-top:15px;	
}
.savvion-employment-box2-1, .savvion-employment-box3-1
{
	display:none;
}

.savvion-employment-box3-1 .form-group
{
	width: 100%;
}
.savvion-employment-box3-1 .form-group .txt
{
	float: left;
	width: 35%;
	text-align: center;
	font-size: 15px;
	padding-bottom: 10px;	
}
.savvion-employment-box3-1 .form-group label
{
	width: 20%;
	float: left;
}
.savvion-employment-box3-1 .form-group .form-control
{
	width: 35%;
	float: left;
}
.savvion-employment-box3-1 .form-group .btn_move
{
    float: left;
    width: 10%;
    min-height: 1px;
    text-align: center;
    font-size: 14px;
    margin-top: 1px;
}
.savvion-employment-box3-1 .form-group .btn_move i
{
    width: 30px;
    height: 30px;
    border: 1px solid #C31E24;
    display: inline-block;
    line-height: 30px;
    cursor: pointer;
    color: #C31E24;
}

.savvion-employment-box2-1 .form-group
{
	width: 20%;
}
.savvion-employment-box1-1 textarea.form-control
{
	height: 70px;	
}


.savvion-health-box1, .savvion-health-box2
{
	border-bottom: 1px solid #eee;
	margin: 0px 15px 30px 15px;
	border: 1px solid #eee;
	padding: 0px;
	background-color: rgba(238, 238, 238, 0.26);
}
.savvion-health-box1 h5, .savvion-health-box2 h5
{
    padding: 10px 8px;
    margin: 0;
    border-bottom: 1px solid #eee;
    background-color: #eee;	
	text-transform: uppercase;
}
.savvion-health-box1 h5 span, .savvion-health-box2 h5 span
{
    float: right;
    text-transform: capitalize;
    font-size: 12px;
    background-color: #333;
    color: #fff;
    padding: 3px 5px;
    line-height: 1;
    position: relative;
    top: -1px;
    cursor: pointer;	
}
.savvion-health-box1 h5 span:after, .savvion-health-box2 h5 span:after
{
    font-family: 'FontAwesome';
    content: "\f067";
    margin-left: 6px;
    font-size: 9px;
}
.savvion-health-box1 h5.active span:after, .savvion-health-box2 h5.active span:after
{
	content: "\f068";
}
.savvion-health-box1-1, .savvion-health-box2-1
{
	padding-top:15px;	
}
.savvion-health-box2-1
{
	display:none;
}
.savvion-health-box1-1 .form-group
{
	width:14.25%;
}

.savvion-health-box2-1 .form-group
{
	width: 100%;
}
.savvion-health-box2-1 .form-group .txt
{
	float: left;
	width: 35%;
	text-align: center;
	font-size: 15px;
	padding-bottom: 10px;	
}
.savvion-health-box2-1 .form-group label
{
	width: 20%;
	float: left;
}
.savvion-health-box2-1 .form-group .form-control
{
	width: 35%;
	float: left;
}
.savvion-health-box2-1 .form-group .btn_move
{
    float: left;
    width: 10%;
    min-height: 1px;
    text-align: center;
    font-size: 14px;
    margin-top: 1px;
}
.savvion-health-box2-1 .form-group .btn_move i
{
    width: 30px;
    height: 30px;
    border: 1px solid #C31E24;
    display: inline-block;
    line-height: 30px;
    cursor: pointer;
    color: #C31E24;
}
.Verification_Fee, .Verification_Fee_yes, .Verification_Status, .payment-Credit, .payment-Debit, .payment-Demand, .payment-Wire, .payment-Other,
.Beyond_DLV_Scope_Stop_Case, .Force_Majeure, .Inaccessible_for_verification, .Insufficient_Information_Close_Case, .Not_Initiated, .Out_of_scope_Stop_Case, .Partially_Verified, .Pending_for_Authorization, .Pending_for_Reply, .Record_Not_Available, .Refused_to_verify, .Unable_to_Verify, .Verified_Clear, .Verified_Negative, .Verified_Major_Negative, .Verified_Minor_Discrepancy, .Work_in_Progress
{
	display:none;	
}
@media (min-width: 480px)
{
	.scrollable
	{
		height: inherit;
	}
}
</style>



<section class="retracted scrollable">
    <div class="row">
        <div class="col-md-12">
            <div class="manager-report-sec">
                <div class="panel panel-default panel-block">
                    <div class="list-group-item">
                    	 <?php 
						$editValue = $_REQUEST['check'];
						$uID = $_SESSION['user_id']; 
							if($uID == 261 || $editValue !=0){
						?>
                    
                        <div class="page-section-title">
                            <h2 class="box_head">
                            <?=isset($_REQUEST['check'])?'Edit':'Add'?>
                            Check</h2>
                        </div>
                        
                       <div class="addsavvioncheck-section">
                       
                        	<form class="cstm" action="" name="" method="post" enctype="multipart/form-data" >
                            <div class="addsavvioncheck-section-first">
                                <div class="form-group">
                                    <label for="Barcode">Barcode: </label>
                                    <input type="text" name="Barcode" id="Barcode" class="form-control" value="<?=$data['Barcode']?>" placeholder="Barcode">
                                </div>
                                <div class="form-group">
                                    <label for="ApplicantName">ApplicantName: </label>
                                    <input type="text" name="ApplicantName" id="ApplicantName" class="form-control" value="<?=$data['ApplicantName']?>" placeholder="ApplicantName">
                                </div>
                                <div class="form-group">
                                    <label for="SubBarcode">Reference No: </label>
                                    <input type="text" name="SubBarcode" id="SubBarcode" class="form-control" value="<?=$data['SubBarcode']?>" placeholder="Reference No">
                                </div>
                                <div class="form-group">
                                    <label for="ClientName">Client Name: </label>
                                    <input type="text" name="ClientName" id="ClientName" class="form-control" value="<?=$data['ClientName']?>" placeholder="Client Name">
                                </div>
                                <div class="form-group">
                                    <label for="ClientRefNo">Client Reference No:  </label>
                                    <input type="text" name="ClientRefNo" id="ClientRefNo" class="form-control" value="<?=$data['ClientRefNo']?>" placeholder="Client Reference No">
                                </div>
                                <div class="form-group">
                                    <label for="DateOfBirth">Date Of Birth:  </label>
                                    <input type="text" name="DateOfBirth" id="DateOfBirth" class="datetimepicker-month form-control" value="<?=$data['DateOfBirth']?>" placeholder="Date Of Birth">
                                </div>
                                <div class="form-group">
                                    <label for="PassportNo">Passport No:  </label>
                                    <input type="text" name="PassportNo" id="PassportNo" class="datetimepicker-month form-control" value="<?=$data['PassportNo']?>" placeholder="Passport No">
                                </div>
                                <div class="form-group">
                                    <label for="AKAName">AKAName:  </label>
                                    <input type="text" name="AKAName" id="AKAName" class="datetimepicker-month form-control" value="<?=$data['AKAName']?>" placeholder="AKAName">
                                </div>
                                <div class="form-group">
                                    <label for="Gender">Gender:  </label>
                                    <input type="text" name="Gender" id="Gender" class="datetimepicker-month form-control" value="<?=$data['Gender']?>" placeholder="Gender">
                                </div>
                                <div class="form-group">
                                    <label for="Nationality">Nationality:  </label>
                                    <input type="text" name="Nationality" id="Nationality" class="datetimepicker-month form-control" value="<?=$data['Nationality']?>" placeholder="Nationality">
                                </div>
                                <div class="form-group">
                                    <label for="ArabicName">Arabic Name:  </label>
                                    <input type="text" name="ArabicName" id="ArabicName" class="datetimepicker-month form-control" value="<?=$data['ArabicName']?>" placeholder="Arabic Name">
                                </div>
                                
                                 <div class="clearfix"></div>
                            </div>
                            
                           
                            <!-- ACCORDION -->
                            <div>
                            <?php if(!is_numeric($_REQUEST['check'])){ ?>
                            <ul class="nav nav-tabs paddsavvioncheck-tab">
                            <li class="active"><a href="#eduction" data-toggle="tab" onclick="getFormData(1)">Education</a></li>
                            <li><a href="#pre-employment" data-toggle="tab" onclick="getFormData(2)" >Pre Employment</a></li>
                            <li><a href="#health-legislation" data-toggle="tab" onclick="getFormData(3)">Health Legislation</a></li>
                            
                            </ul> <?php } ?>
                            <div class="resultDiv"></div>
                           
                            
                            </div>
                            
                            <div class="clearfix"></div>
                             <!-- ACCORDION -->
                             
                             <div class="addsavvioncheck-section2">
                             
                             	<a class="crm-remarks-btn" href="javascript:void(0);">Remarks</a>
                                <div class="clearfix"></div>
                                <div class="crm-remarks">
                                    <div class="form-group">
                                        <label for="_UNBOUND_textArea3">CRM Remarks: </label>
                                        <textarea name="_UNBOUND_textArea3" class="form-control parsley-validated" rows="4" data-parsley-minwords="4" data-parsley-required="true" placeholder="CRM Remarks"><?=$data['_UNBOUND_textArea3']?> </textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="HistoryRemarks">History Remarks: </label>
                                        <textarea name="HistoryRemarks" class="form-control parsley-validated" rows="4" data-parsley-minwords="4" data-parsley-required="true" placeholder="History Remarks"><?=$data['HistoryRemarks']?></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="_UNBOUND_historyNew">Notes Input Box: </label>
                                        <textarea name="_UNBOUND_historyNew" class="form-control parsley-validated" rows="4" data-parsley-minwords="4" data-parsley-required="true" placeholder="Notes Input Box"> <?=$data['_UNBOUND_historyNew']?> </textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="is_duplicate">Is Duplicate: </label>
                                        <textarea name="is_duplicate" class="form-control parsley-validated" rows="4" data-parsley-minwords="4" data-parsley-required="true" placeholder="Is Duplicate"><?=$data['is_duplicate']?> </textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                            <div class="Is_Error_Label"><label class="checkbox-inline">
                                            <?php $isError =  ($data['is_error']==1) ? 'checked' : ''; ?>
                                                <input type="checkbox" value="1" class="isErrorBox" id="isError" onchange="valueChanged()" name="is_error" <?php echo $isError; ?> />
                                                Is Error?
                                            </label></div>
                                            
                                            <div class="Is_Error_Comments"><label for="text-area-no-resize">Comments For ECT: </label>
                                            <textarea name="CommentsForECT" id="text-area-no-resize" rows="3" class="form-control no-resize"> <?=$data['CommentsForECT']?></textarea></div>
                                           
                                     </div>
                                     
                                 </div>
                                 <div class="clearfix"></div>
                             </div>  
                             
							<!--<div class="isError"></div>-->
                            <div class="clearfix"></div>
                            
                            <div class="addsavvioncheck-section3">
                            	<a class="verification-stu-btn" href="javascript:void(0);">Verification Status</a>
                                <div class="clearfix"></div>
                                
                                <div class="verification-stu">
                                <div class="form-group">
                                	<label for="SpokeTo">Spoke To:   </label>
                                	<input type="text"  name="SpokeTo" id="SpokeTo" class="form-control" value="<?=$data['SpokeTo']?>" placeholder="Spoke To">
                                </div>
                                <div class="form-group">
                                	<label for="Designation">Job Title:   </label>
                                	<input type="text" name="Designation" id="Designation" class="form-control" value="<?=$data['Designation']?>" placeholder="Job Title">
                                </div>
                                <div class="form-group">
                                	<label for="Department">Department:   </label>
                                	<input type="text" name="Department" id="Department" class="form-control" value="<?=$data['Department']?>" placeholder="Department">
                                </div>

								<div class="form-group">
                                    <label>Verification Status:</label>
                                    <select name="VStatus" id="VStatus" class="form-control">
                                        <option value="Phraseology_Select">Select</option>
                                        <option value="Verification_Status" <?php echo ($data['VStatus']=='Additional Information Required - UTV') ? 'selected="selected"' :''; ?> >Additional Information Required - UTV</option>
                                        <option value="Verification_Status" <?php echo ($data['VStatus']=='Additional Information required') ? 'selected="selected"' :''; ?>>Additional Information required</option>
                                        <option value="Beyond_DLV_Scope_Stop_Case" <?php echo ($data['VStatus']=='Beyond DLV Scope-Stop Case') ? 'selected="selected"' :''; ?>>Beyond DLV Scope-Stop Case</option>
                                        <option value="Force_Majeure" <?php echo ($data['VStatus']=='Force Majeure') ? 'selected="selected"' :''; ?>>Force Majeure</option>
                                        <option value="Inaccessible_for_verification" <?php echo ($data['VStatus']=='Inaccessible for verification') ? 'selected="selected"' :''; ?>>Inaccessible for verification</option>
                                        <option value="Insufficient_Information_Close_Case" <?php echo ($data['VStatus']=='Insufficient Information - Close Case') ? 'selected="selected"' :''; ?>>Insufficient Information - Close Case</option>
                                        <option value="Not_Initiated" <?php echo ($data['VStatus']=='Not Initiated') ? 'selected="selected"' :''; ?>>Not Initiated</option>
                                        <option value="Out_of_scope_Stop_Case" <?php echo ($data['VStatus']=='Out of scope-Stop Case') ? 'selected="selected"' :''; ?>>Out of scope-Stop Case</option>
                                        <option value="Partially_Verified" <?php echo ($data['VStatus']=='Partially Verified') ? 'selected="selected"' :''; ?>>Partially Verified</option>
                                        <option value="Pending_for_Authorization" <?php echo ($data['VStatus']=='Pending for Authorization') ? 'selected="selected"' :''; ?>>Pending for Authorization</option>
                                        <option value="Pending_for_Reply" <?php echo ($data['VStatus']=='Pending for Reply') ? 'selected="selected"' :''; ?>>Pending for Reply</option>
                                        <option value="Record_Not_Available" <?php echo ($data['VStatus']=='Record Not Available') ? 'selected="selected"' :''; ?>>Record Not Available</option>
                                        <option value="Refused_to_verify" <?php echo ($data['VStatus']=='Refused to verify') ? 'selected="selected"' :''; ?>>Refused to verify</option>
                                        <option value="Unable_to_Verify" <?php echo ($data['VStatus']=='Unable to Verify') ? 'selected="selected"' :''; ?>>Unable to Verify</option>
                                        <option value="Verified_Clear" <?php echo ($data['VStatus']=='Verified Clear') ? 'selected="selected"' :''; ?>>Verified Clear</option>
                                        <option value="Verified_Negative" <?php echo ($data['VStatus']=='Verified Negative') ? 'selected="selected"' :''; ?>>Verified Negative</option>
                                        <option value="Verified_Major_Negative" <?php echo ($data['VStatus']=='Verified-Major Discrepancy') ? 'selected="selected"' :''; ?>>Verified-Major Discrepancy</option>
                                        
                                        <option value="Verified_Minor_Discrepancy" <?php echo ($data['VStatus']=='Verified-Minor Discrepancy') ? 'selected="selected"' :''; ?>>Verified-Minor Discrepancy</option>
                                        <option value="Work_in_Progress" <?php echo ($data['VStatus']=='Work in Progress') ? 'selected="selected"' :''; ?>>Work in Progress</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                  <label>Phraseology:</label>
                                  
                                  <div class="Phraseology_Select" id="Phraseology_Select">
                                      <select name="Phraseology" class="form-control" >
                                        <option value="0">Select</option>
                                      </select>
                                  </div>
                                  
                                  <div class="Verification_Status" id="Verification_Status">
                                      <select name="Phraseology" class="form-control" id="Phraseology" onChange = "VStatusP1(this);" >
                                        <option value="0">Select</option>
                                        <option value="VT023"  <?php echo ($data['Phraseology']=='VT023') ? 'selected="selected"' :''; ?>>VT023</option>
                                        <option value="VT024" <?php echo ($data['Phraseology']=='VT024') ? 'selected="selected"' :''; ?>>VT024</option>
                                        <option value="VT025" <?php echo ($data['Phraseology']=='VT025') ? 'selected="selected"' :''; ?>>VT025</option>
                                        <option value="VT026" <?php echo ($data['Phraseology']=='VT026') ? 'selected="selected"' :''; ?>>VT026</option>
                                        <option value="VT027" <?php echo ($data['Phraseology']=='VT027') ? 'selected="selected"' :''; ?>>VT027</option>
                                        <option value="VT028" <?php echo ($data['Phraseology']=='VT028') ? 'selected="selected"' :''; ?>>VT028</option>
                                      </select>
                                  </div>
                                  
                                  
                                  <div class="Beyond_DLV_Scope_Stop_Case" id="Beyond_DLV_Scope_Stop_Case">
                                      <select name="Phraseology" class="form-control" onChange = "VStatusP2(this);" >
                                        <option value="0">Select</option>
                                        <option value="VT021"  <?php echo ($data['Phraseology']=='VT021') ? 'selected="selected"' :''; ?>>VT021</option>
                                      </select>
                                  </div>
                                  
                                  <div class="Force_Majeure" id="Force_Majeure">
                                      <select name="Phraseology" class="form-control" onChange = "VStatusP3(this);" >
                                        <option value="0">Select</option>
                                        <option value="VT033"  <?php echo ($data['Phraseology']=='VT033') ? 'selected="selected"' :''; ?>>VT033</option>
                                        <option value="VT034"  <?php echo ($data['Phraseology']=='VT034') ? 'selected="selected"' :''; ?>>VT034</option>
                                        <option value="VT035"  <?php echo ($data['Phraseology']=='VT035') ? 'selected="selected"' :''; ?>>VT035</option>
                                        <option value="VT036"  <?php echo ($data['Phraseology']=='VT036') ? 'selected="selected"' :''; ?>>VT036</option>
                                        <option value="VT037"  <?php echo ($data['Phraseology']=='VT037') ? 'selected="selected"' :''; ?>>VT037</option>
                                      </select>
                                  </div>
                                  
                                  <div class="Inaccessible_for_verification" id="Inaccessible_for_verification">
                                      <select name="Phraseology" class="form-control" >
                                        <option value="0">Select</option>
                                      </select>
                                  </div>
                                  
                                  <div class="Insufficient_Information_Close_Case" id="Insufficient_Information_Close_Case">
                                      <select name="Phraseology" class="form-control" onChange = "VStatusP4(this);" >
                                        <option value="0">Select</option>
                                        <option value="VT022"  <?php echo ($data['Phraseology']=='VT022') ? 'selected="selected"' :''; ?>>VT022</option>
                                      </select>
                                  </div>
                                  
                                  <div class="Not_Initiated" id="Not_Initiated">
                                      <select name="Phraseology" class="form-control" >
                                        <option value="0">Select</option>
                                      </select>
                                  </div>
                                  
                                  <div class="Out_of_scope_Stop_Case" id="Out_of_scope_Stop_Case">
                                      <select name="Phraseology" class="form-control" onChange = "VStatusP5(this);"  >
                                        <option value="0">Select</option>
                                        <option value="VT020"  <?php echo ($data['Phraseology']=='VT020') ? 'selected="selected"' :''; ?>>VT020</option>
                                      </select>
                                  </div>
                                  
                                  <div class="Partially_Verified" id="Partially_Verified">
                                      <select name="Phraseology" class="form-control" onChange = "VStatusP6(this);" >
                                        <option value="0">Select</option>
                                        <option value="VT012"  <?php echo ($data['Phraseology']=='VT012') ? 'selected="selected"' :''; ?>>VT012</option>
                                      </select>
                                  </div>
                                  
                                  <div class="Pending_for_Authorization" id="Pending_for_Authorization">
                                      <select name="Phraseology" class="form-control" >
                                        <option value="0">Select</option>
                                      </select>
                                  </div>
                                  
                                  <div class="Pending_for_Reply" id="Pending_for_Reply">
                                      <select name="Phraseology" class="form-control" >
                                        <option value="0">Select</option>
                                      </select>
                                  </div>
                                  
                                  <div class="Record_Not_Available" id="Record_Not_Available">
                                      <select name="Phraseology" class="form-control" onChange = "VStatusP7(this);" >
                                        <option value="0">Select</option>
                                        <option value="VT013"  <?php echo ($data['Phraseology']=='VT013') ? 'selected="selected"' :''; ?>>VT013</option>
                                      </select>
                                  </div>
                                  
                                  <div class="Refused_to_verify" id="Refused_to_verify">
                                      <select name="Phraseology" class="form-control" onChange = "VStatusP8(this);" >
                                        <option value="0">Select</option>
                                        <option value="VT006"  <?php echo ($data['Phraseology']=='VT006') ? 'selected="selected"' :''; ?>>VT006</option>
                                        <option value="VT029"  <?php echo ($data['Phraseology']=='VT029') ? 'selected="selected"' :''; ?>>VT029</option>
                                      </select>
                                  </div>
                                  
                                  <div class="Unable_to_Verify" id="Unable_to_Verify">
                                      <select name="Phraseology" class="form-control" onChange = "VStatusP9(this);" >
                                        <option value="0">Select</option>
                                        <option value="VT003"  <?php echo ($data['Phraseology']=='VT003') ? 'selected="selected"' :''; ?>>VT003</option>
                                        <option value="VT004"  <?php echo ($data['Phraseology']=='VT004') ? 'selected="selected"' :''; ?>>VT004</option>
                                        <option value="VT005"  <?php echo ($data['Phraseology']=='VT005') ? 'selected="selected"' :''; ?>>VT005</option>
                                        <option value="VT014"  <?php echo ($data['Phraseology']=='VT014') ? 'selected="selected"' :''; ?>>VT014</option>
                                        <option value="VT015"  <?php echo ($data['Phraseology']=='VT015') ? 'selected="selected"' :''; ?>>VT015</option>
                                        <option value="VT016"  <?php echo ($data['Phraseology']=='VT016') ? 'selected="selected"' :''; ?>>VT016</option>
                                      </select>
                                  </div>
                                  
                                  <div class="Verified_Clear" id="Verified_Clear">
                                      <select name="Phraseology" class="form-control" onChange = "VStatusP10(this);" >
                                        <option value="0">Select</option>
                                        <option value="VT001"  <?php echo ($data['Phraseology']=='VT001') ? 'selected="selected"' :''; ?>>VT001</option>
                                        <option value="VT038"  <?php echo ($data['Phraseology']=='VT038') ? 'selected="selected"' :''; ?>>VT038</option>
                                        <option value="VT039"  <?php echo ($data['Phraseology']=='VT039') ? 'selected="selected"' :''; ?>>VT039</option>
                                      </select>
                                  </div>
                                  
                                  <div class="Verified_Negative" id="Verified_Negative">
                                      <select name="Phraseology" class="form-control" onChange = "VStatusP11(this);" >
                                        <option value="0">Select</option>
                                        <option value="VT007"  <?php echo ($data['Phraseology']=='VT007') ? 'selected="selected"' :''; ?>>VT007</option>
                                        <option value="VT008"  <?php echo ($data['Phraseology']=='VT008') ? 'selected="selected"' :''; ?>>VT008</option>
                                        <option value="VT009"  <?php echo ($data['Phraseology']=='VT009') ? 'selected="selected"' :''; ?>>VT009</option>
                                        <option value="VT010"  <?php echo ($data['Phraseology']=='VT010') ? 'selected="selected"' :''; ?>>VT010</option>
                                        <option value="VT030"  <?php echo ($data['Phraseology']=='VT030') ? 'selected="selected"' :''; ?>>VT030</option>
                                      </select>
                                  </div>
                                  
                                  <div class="Verified_Major_Negative" id="Verified_Major_Negative">
                                      <select name="Phraseology" class="form-control" onChange = "VStatusP12(this);" >
                                        <option value="0">Select</option>
                                        <option value="VT011"  <?php echo ($data['Phraseology']=='VT011') ? 'selected="selected"' :''; ?>>VT011</option>
                                      </select>
                                  </div>
                                  
                                  <div class="Verified_Minor_Discrepancy" id="Verified_Minor_Discrepancy">
                                      <select name="Phraseology" class="form-control" onChange = "VStatusP13(this);" >
                                        <option value="0">Select</option>
                                        <option value="VT002"  <?php echo ($data['Phraseology']=='VT002') ? 'selected="selected"' :''; ?>>VT002</option>
                                      </select>
                                  </div>
                                  
                                  <div class="Work_in_Progress" id="Work_in_Progress">
                                      <select name="Phraseology" class="form-control" >
                                        <option value="0">Select</option>
                                      </select>
                                  </div>
                                  
                                </div>
                                
                                
                                
                                
                                
                                <div class="form-group">
                                  <label>Verification Language:</label>
                                  <select name="VerificationLanguage" class="form-control" id="comboBox1" >
                                    <option value="0">Select</option>
                                    <option value="Arabic" <?php echo ($data['VerificationLanguage']=='Arabic') ? 'selected="selected"' :''; ?>>Arabic</option>
                                    <option value="Assamese" <?php echo ($data['VerificationLanguage']=='Assamese') ? 'selected="selected"' :''; ?>>Assamese</option>
                                    <option value="Bengali"<?php echo ($data['VerificationLanguage']=='Bengali') ? 'selected="selected"' :''; ?>>Bengali</option>
                                    <option value="English" <?php echo ($data['VerificationLanguage']=='English') ? 'selected="selected"' :''; ?>>English</option>
                                    <option value="French" <?php echo ($data['VerificationLanguage']=='French') ? 'selected="selected"' :''; ?>>French</option>
                                    <option value="German" <?php echo ($data['VerificationLanguage']=='German') ? 'selected="selected"' :''; ?>>German</option>
                                    <option value="Gujarati" <?php echo ($data['VerificationLanguage']=='Gujarati') ? 'selected="selected"' :''; ?>>Gujarati</option>
                                    <option value="Hindi" <?php echo ($data['VerificationLanguage']=='Hindi') ? 'selected="selected"' :''; ?>>Hindi</option>
                                    <option value="Japanese" <?php echo ($data['VerificationLanguage']=='Japanese') ? 'selected="selected"' :''; ?>>Japanese</option>
                                    <option value="Kannada" <?php echo ($data['VerificationLanguage']=='Kannada') ? 'selected="selected"' :''; ?>>Kannada</option>
                                    <option value="Kashmiri" <?php echo ($data['VerificationLanguage']=='Kashmiri') ? 'selected="selected"' :''; ?>>Kashmiri</option>
                                    <option value="Konkani" <?php echo ($data['VerificationLanguage']=='Konkani') ? 'selected="selected"' :''; ?>>Konkani</option>
                                    <option value="Malayalam" <?php echo ($data['VerificationLanguage']=='Malayalam') ? 'selected="selected"' :''; ?>>Malayalam</option>
                                    <option value="Mandarin Chinese" <?php echo ($data['VerificationLanguage']=='Mandarin Chinese') ? 'selected="selected"' :''; ?>>Mandarin Chinese</option>
                                    <option value="Manipuri" <?php echo ($data['VerificationLanguage']=='Manipuri') ? 'selected="selected"' :''; ?>>Manipuri</option>
                                    <option value="Marathi" <?php echo ($data['VerificationLanguage']=='Marathi') ? 'selected="selected"' :''; ?>>Marathi</option>
                                    <option value="Nepali" <?php echo ($data['VerificationLanguage']=='Nepali') ? 'selected="selected"' :''; ?>>Nepali</option>
                                    <option value="Oriya" <?php echo ($data['VerificationLanguage']=='Oriya') ? 'selected="selected"' :''; ?>>Oriya</option>
                                    <option value="Portuguese" <?php echo ($data['VerificationLanguage']=='Portuguese') ? 'selected="selected"' :''; ?>>Portuguese</option>
                                    <option value="Punjabi" <?php echo ($data['VerificationLanguage']=='Punjabi') ? 'selected="selected"' :''; ?>>Punjabi</option>
                                    <option value="Russian" <?php echo ($data['VerificationLanguage']=='Russian') ? 'selected="selected"' :''; ?>>Russian</option>
                                    <option value="Sanskrit" <?php echo ($data['VerificationLanguage']=='Sanskrit') ? 'selected="selected"' :''; ?>>Sanskrit</option>
                                    <option vale="Sindhi" <?php echo ($data['VerificationLanguage']=='Sindhi') ? 'selected="selected"' :''; ?>>Sindhi</option>
                                    <option value="Spanish" <?php echo ($data['VerificationLanguage']=='Spanish') ? 'selected="selected"' :''; ?>>Spanish</option>
                                    <option value="Tamil" <?php echo ($data['VerificationLanguage']=='Tamil') ? 'selected="selected"' :''; ?>>Tamil</option>
                                    <option value="Telugu" <?php echo ($data['VerificationLanguage']=='Telugu') ? 'selected="selected"' :''; ?>>Telugu</option>
                                    <option value="Urdu" <?php echo ($data['VerificationLanguage']=='Urdu') ? 'selected="selected"' :''; ?>>Urdu</option>
                                  </select>
                                </div>
                                
                                
                                <div class="form-group">
                                  <label>Mode Of Verification: </label>
                                  <select name="ModeOfVerification" class="form-control" id="modevt" >
                                    <option value="0">Select</option>
                                    <option value="EMail" <?php echo ($data['ModeOfVerification']=='EMail') ? 'selected="selected"' :''; ?>>EMail</option>
                                    <option value="Fax" <?php echo ($data['ModeOfVerification']=='Fax') ? 'selected="selected"' :''; ?>>Fax</option>
                                    <option value="Online" <?php echo ($data['ModeOfVerification']=='Online') ? 'selected="selected"' :''; ?>>Online</option>
                                    <option value="Post/Letter" <?php echo ($data['ModeOfVerification']=='Post/Letter') ? 'selected="selected"' :''; ?>>Post/Letter</option>
                                    <option value="Site Visit– Written" <?php echo ($data['ModeOfVerification']=='Site Visit– Written') ? 'selected="selected"' :''; ?>>Site Visit– Written</option>
                                    <option value="Site visit– Verbal" <?php echo ($data['ModeOfVerification']=='Site visit– Verbal') ? 'selected="selected"' :''; ?>>Site visit– Verbal</option>
                                    <option value="Verbal" <?php echo ($data['ModeOfVerification']=='Verbal') ? 'selected="selected"' :''; ?>>Verbal</option>
                                  </select>
                                </div>
                                
                                
                                <div class="form-group">
                                  <label>Initiated by: </label>
                                  <select name="initiatedByName" class="form-control" id="initiatedById">
                                    <option value="0" selected="">Select</option>
                                    <option value="Verification_Fee" <?php echo ($data['initiatedByName']=='1') ? 'selected="selected"' :''; ?>>In-house</option>
                                    <option value="Verification_Fee" <?php echo ($data['initiatedByName']=='2') ? 'selected="selected"' :''; ?>>Vendor</option>
                                  </select>
                                </div>
                                
                                <div class="Verification_Fee" id="Verification_Fee">
                                    <div class="form-group">
                                      <label>Verification Fee: </label>
                                      <select name="VerificationFee" class="form-control" id="vfTxt">
                                        <option value="Select" selected="">Select</option>
                                        <option value="Yes" <?php echo ($data['VerificationFee']=='Yes') ? 'selected="selected"' :''; ?>>Yes</option>
                                        <option value="No" <?php echo ($data['VerificationFee']=='No') ? 'selected="selected"' :''; ?>>No</option>
                                      </select>
                                    </div>
                                
                                <!--PAYMENT SECTION-->
                                    <div class="Verification_Fee_yes" id="Yes">
                                    <div class="form-group">
                                            <label>Payment Date : </label>
                                            <input type="date" name="PaymentDate"  value="<?=$data['PaymentDate']?>" class="datetimepicker-default form-control">
                                    </div>
                                    <div class="form-group">
                                            <label>Payment Approval Date  : </label>
                                            <input type="date" name="PaymentApprovalDate" value="<?=$data['PaymentApprovalDate']?>" class="datetimepicker-default form-control">
                                    </div>
                                    <div class="form-group">
                                            <label>Payment In Favour of  : </label>
                                            <input type="text" name="PaymentInFavourof"  value="<?=$data['PaymentInFavourof']?>"class="form-control">
                                    </div>
                                    <div class="form-group">
                                            <label>Transaction ID   : </label>
                                            <input type="text" name="TransactionID" value="<?=$data['TransactionID']?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label> Payment Mode: </label>
                                      <select name="paymentModTypeID" class="form-control" id="paymentModTypeID">
                                        <option value="0" >Select</option>
                                        <option value="1" <?php echo ($data['paymentModTypeID']=='1') ? 'selected="selected"' :''; ?>>Cash</option>
                                        <option value="payment-Credit" <?php echo ($data['paymentModTypeID']=='2') ? 'selected="selected"' :''; ?>>Credit Card</option>
                                        <option value="payment-Debit" <?php echo ($data['paymentModTypeID']=='3') ? 'selected="selected"' :''; ?>>Debit Card</option>
                                        <option value="payment-Demand" <?php echo ($data['paymentModTypeID']=='4') ? 'selected="selected"' :''; ?>>Demand Draft</option>
                                        <option value="payment-Wire" <?php echo ($data['paymentModTypeID']=='5') ? 'selected="selected"' :''; ?>>Wire Transfer</option>
                                        <option value="payment-Other" <?php echo ($data['paymentModTypeID']=='6') ? 'selected="selected"' :''; ?>>Other</option>
                                      </select>
                                    </div>
                                    
    								<div class="payment-Credit" id="payment-Credit">                             
	                                    <div class="form-group">
                                            <label>Credit Card Number</label>
                                            <input type="text" name="otherCardNam" value="<?=$data['otherCardNam']?>" class="form-control">
                                    	</div>
                                    </div>
                                    
                                    <div class="payment-Debit" id="payment-Debit">                             
	                                    <div class="form-group">
                                            <label>Debit Card Number</label>
                                            <input type="text" name="otherCardNam" value="<?=$data['otherCardNam']?>" class="form-control">
                                    	</div>
                                    </div>
                                    
                                    <div class="payment-Demand" id="payment-Demand">                             
	                                    <div class="form-group">
                                            <label>Demand Draft Number</label>
                                            <input type="text" name="otherCardNam" value="<?=$data['otherCardNam']?>" class="form-control">
                                    	</div>
                                    </div>
                                    
                                    <div class="payment-Wire" id="payment-Wire">                             
	                                    <div class="form-group">
                                            <label>Wire Transfer Number</label>
                                            <input type="text" name="otherCardNam" value="<?=$data['otherCardNam']?>" class="form-control">
                                    	</div>
                                    </div>
                                    
                                    <div class="payment-Other" id="payment-Other">                             
	                                    <div class="form-group">
                                            <label>Other Mode:</label>
                                            <input type="text" name="otherCardNam" value="<?=$data['otherCardNam']?>" class="form-control">
                                    	</div>
                                        <div class="form-group">
                                            <label>Mode Number:</label>
                                            <input type="text" name="otherCardNam" value="<?=$data['otherCardNam']?>" class="form-control">
                                    	</div>
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <div class="form-group">
                                      <label> Transaction Currency:  </label>
                                      <select name="Currency" class="form-control" id="Currency">
                                            <option value="Select">Select</option>
                                            <option value="INR" <?php echo ($data['Currency']=='INR') ? 'selected="selected"' :''; ?>>INR - Indian Rupee</option>
                                            <option value="USD" <?php echo ($data['Currency']=='USD') ? 'selected="selected"' :''; ?>>USD - US Dollar</option>
                                            <option value="AUD" <?php echo ($data['Currency']=='AUD') ? 'selected="selected"' :''; ?>>AUD - Australian Dollar</option>
                                            <option value="EUR" <?php echo ($data['Currency']=='EUR') ? 'selected="selected"' :''; ?>>EUR - Euro</option>
                                            <option value="ZAR" <?php echo ($data['Currency']=='ZAR') ? 'selected="selected"' :''; ?>>ZAR - South African Rand</option>
                                            <option value="GBP" <?php echo ($data['Currency']=='GBP') ? 'selected="selected"' :''; ?>>GBP - British Pound</option>
                                            <option value="PHP" <?php echo ($data['Currency']=='PHP') ? 'selected="selected"' :''; ?>>PHP - Philippine Peso</option>
                                            <option value="MYR" <?php echo ($data['Currency']=='MYR') ? 'selected="selected"' :''; ?>>MYR - Malaysian Ringgit</option>
                                            <option value="AED" <?php echo ($data['Currency']=='AED') ? 'selected="selected"' :''; ?>>AED - Emirati Dirham</option>
                                            <option value="CAD" <?php echo ($data['Currency']=='CAD') ? 'selected="selected"' :''; ?>>CAD - Canadian Dollar</option>
                                            <option value="CHF" <?php echo ($data['Currency']=='CHF') ? 'selected="selected"' :''; ?>>CHF - Swiss Franc</option>
                                            <option value="CNY" <?php echo ($data['Currency']=='CNY') ? 'selected="selected"' :''; ?>>CNY - Chinese Yuan Renminbi</option>
                                            <option value="THB" <?php echo ($data['Currency']=='THB') ? 'selected="selected"' :''; ?>>THB - Thai Baht</option>
                                            <option value="SAR" <?php echo ($data['Currency']=='SAR') ? 'selected="selected"' :''; ?>>SAR - Saudi Arabian Riyal</option>
                                            <option value="NZD" <?php echo ($data['Currency']=='NZD') ? 'selected="selected"' :''; ?>>NZD - New Zealand Dollar</option>
                                            <option value="JPY" <?php echo ($data['Currency']=='JPY') ? 'selected="selected"' :''; ?>>JPY - Japanese Yen</option>
                                            <option value="SGD" <?php echo ($data['Currency']=='SGD') ? 'selected="selected"' :''; ?>>SGD - Singapore Dollar</option>
                                            <option value="TRY" <?php echo ($data['Currency']=='TRY') ? 'selected="selected"' :''; ?>>TRY - Turkish Lira</option>
                                            <option value="HKD" <?php echo ($data['Currency']=='HKD') ? 'selected="selected"' :''; ?>>HKD - Hong Kong Dollar</option>
                                            <option value="IDR" <?php echo ($data['Currency']=='IDR') ? 'selected="selected"' :''; ?>>IDR - Indonesian Rupiah</option>
                                            <option value="MXN" <?php echo ($data['Currency']=='MXN') ? 'selected="selected"' :''; ?>>MXN - Mexican Peso</option>
                                            <option value="SEK" <?php echo ($data['Currency']=='SEK') ? 'selected="selected"' :''; ?>>SEK - Swedish Krona</option>
                                            <option value="BRL" <?php echo ($data['Currency']=='BRL') ? 'selected="selected"' :''; ?>>BRL - Brazilian Real</option>
                                            <option value="HUF" <?php echo ($data['Currency']=='HUF') ? 'selected="selected"' :''; ?>>HUF - Hungarian Forint</option>
                                            <option value="PKR" <?php echo ($data['Currency']=='PKR') ? 'selected="selected"' :''; ?>>PKR - Pakistani Rupee</option>
                                            <option value="QAR" <?php echo ($data['Currency']=='QAR') ? 'selected="selected"' :''; ?>>QAR - Qatari Riyal</option>
                                            <option value="OMR" <?php echo ($data['Currency']=='OMR') ? 'selected="selected"' :''; ?>>OMR - Omani Rial</option>
                                            <option value="KWD" <?php echo ($data['Currency']=='KWD') ? 'selected="selected"' :''; ?>>KWD - Kuwaiti Dinar</option>
                                            <option value="DKK" <?php echo ($data['Currency']=='DKK') ? 'selected="selected"' :''; ?>>DKK - Danish Krone</option>
                                            <option value="NOK" <?php echo ($data['Currency']=='NOK') ? 'selected="selected"' :''; ?>>NOK - Norwegian Krone</option>
                                            <option value="RUB" <?php echo ($data['Currency']=='RUB') ? 'selected="selected"' :''; ?>>RUB - Russian Ruble</option>
                                            <option value="EGP" <?php echo ($data['Currency']=='EGP') ? 'selected="selected"' :''; ?>>EGP - Egyptian Pound</option>
                                            <option value="KRW" <?php echo ($data['Currency']=='KRW') ? 'selected="selected"' :''; ?>>KRW - South Korean Won</option>
                                            <option value="PLN" <?php echo ($data['Currency']=='PLN') ? 'selected="selected"' :''; ?>>PLN - Polish Zloty</option>
                                            <option value="COP" <?php echo ($data['Currency']=='COP') ? 'selected="selected"' :''; ?>>COP - Colombian Peso</option>
                                            <option value="CZK" <?php echo ($data['Currency']=='CZK') ? 'selected="selected"' :''; ?>>CZK - Czech Koruna</option>
                                            <option value="ILS" <?php echo ($data['Currency']=='ILS') ? 'selected="selected"' :''; ?>>ILS - Israeli Shekel</option>
                                            <option value="IQD" <?php echo ($data['Currency']=='IQD') ? 'selected="selected"' :''; ?>>IQD - Iraqi Dinar</option>
                                            <option value="NGN" <?php echo ($data['Currency']=='NGN') ? 'selected="selected"' :''; ?>>NGN - Nigerian Naira</option>
                                            <option value="MAD" <?php echo ($data['Currency']=='MAD') ? 'selected="selected"' :''; ?>>MAD - Moroccan Dirham</option>
                                            <option value="ARS" <?php echo ($data['Currency']=='ARS') ? 'selected="selected"' :''; ?>>ARS - Argentine Peso</option>
                                            <option value="LKR" <?php echo ($data['Currency']=='LKR') ? 'selected="selected"' :''; ?>>LKR - Sri Lankan Rupee</option>
                                            <option value="TWD" <?php echo ($data['Currency']=='TWD') ? 'selected="selected"' :''; ?>>TWD - Taiwan New Dollar</option>
                                            <option value="BDT" <?php echo ($data['Currency']=='BDT') ? 'selected="selected"' :''; ?>>BDT - Bangladeshi Taka</option>
                                            <option value="BHD" <?php echo ($data['Currency']=='BHD') ? 'selected="selected"' :''; ?>>BHD - Bahraini Dinar</option>
                                            <option value="VND" <?php echo ($data['Currency']=='VND') ? 'selected="selected"' :''; ?>>VND - Vietnamese Dong</option>
                                            <option value="CLP" <?php echo ($data['Currency']=='CLP') ? 'selected="selected"' :''; ?>>CLP - Chilean Peso</option>
                                            <option value="KES" <?php echo ($data['Currency']=='KES') ? 'selected="selected"' :''; ?>>KES - Kenyan Shilling</option>
                                            <option value="TND" <?php echo ($data['Currency']=='TND') ? 'selected="selected"' :''; ?>>TND - Tunisian Dinar</option>
                                            <option value="XOF" <?php echo ($data['Currency']=='XOF') ? 'selected="selected"' :''; ?>>XOF - CFA Franc</option>
                                            <option value="JOD" <?php echo ($data['Currency']=='JOD') ? 'selected="selected"' :''; ?>>JOD - Jordanian Dinar</option>
                                            <option value="GHS" <?php echo ($data['Currency']=='GHS') ? 'selected="selected"' :''; ?>>GHS - Ghanaian Cedi</option>
                                            <option value="HRK" <?php echo ($data['Currency']=='HRK') ? 'selected="selected"' :''; ?>>HRK - Croatian Kuna</option>
                                            <option value="BGN" <?php echo ($data['Currency']=='BGN') ? 'selected="selected"' :''; ?>>BGN - Bulgarian Lev</option>
                                            <option value="RON" <?php echo ($data['Currency']=='RON') ? 'selected="selected"' :''; ?>>RON - Romanian New Leu</option>
                                            <option value="PEN" <?php echo ($data['Currency']=='PEN') ? 'selected="selected"' :''; ?>>PEN - Peruvian Nuevo Sol</option>
                                            <option value="DZD" <?php echo ($data['Currency']=='DZD') ? 'selected="selected"' :''; ?>>DZD - Algerian Dinar</option>
                                            <option value="NPR" <?php echo ($data['Currency']=='NPR') ? 'selected="selected"' :''; ?>>NPR - Nepalese Rupee</option>
                                            <option value="XAF" <?php echo ($data['Currency']=='XAF') ? 'selected="selected"' :''; ?>>XAF - Central African CFA Franc BEAC</option>
                                            <option value="ISK" <?php echo ($data['Currency']=='ISK') ? 'selected="selected"' :''; ?>>ISK - Icelandic Krona</option>
                                            <option value="UAH" <?php echo ($data['Currency']=='UAH') ? 'selected="selected"' :''; ?>>UAH - Ukrainian Hryvna</option>
                                            <option value="FJD" <?php echo ($data['Currency']=='FJD') ? 'selected="selected"' :''; ?>>FJD - Fijian Dollar</option>
                                            <option value="DOP" <?php echo ($data['Currency']=='DOP') ? 'selected="selected"' :''; ?>>DOP - Dominican Peso</option>
                                            <option value="XPF" <?php echo ($data['Currency']=='XPF') ? 'selected="selected"' :''; ?>>XPF - CFP Franc</option>
                                            <option value="MUR" <?php echo ($data['Currency']=='MUR') ? 'selected="selected"' :''; ?>>MUR - Mauritian Rupee</option>
                                            <option value="AZN" <?php echo ($data['Currency']=='AZN') ? 'selected="selected"' :''; ?>>AZN - Azerbaijani New Manat</option>
                                            <option value="BAM" <?php echo ($data['Currency']=='BAM') ? 'selected="selected"' :''; ?>>BAM - Bosnian Convertible Marka</option>
                                            <option value="XAU" <?php echo ($data['Currency']=='XAU') ? 'selected="selected"' :''; ?>>XAU - Gold Ounce</option>
                                            <option value="IRR" <?php echo ($data['Currency']=='IRR') ? 'selected="selected"' :''; ?>>IRR - Iranian Rial</option>
                                            <option value="RSD" <?php echo ($data['Currency']=='RSD') ? 'selected="selected"' :''; ?>>RSD - Serbian Dinar</option>
                                            <option value="LTL" <?php echo ($data['Currency']=='LTL') ? 'selected="selected"' :''; ?>>LTL - Lithuanian Litas</option>
                                            <option value="BND" <?php echo ($data['Currency']=='BND') ? 'selected="selected"' :''; ?>>BND - Bruneian Dollar</option>
                                            <option value="ETB" <?php echo ($data['Currency']=='ETB') ? 'selected="selected"' :''; ?>>ETB - Ethiopian Birr</option>
                                            <option value="CRC" <?php echo ($data['Currency']=='CRC') ? 'selected="selected"' :''; ?>>CRC - Costa Rican Colon</option>
                                            <option value="VEF" <?php echo ($data['Currency']=='VEF') ? 'selected="selected"' :''; ?>>VEF - Venezuelan Bolivar</option>
                                            <option value="AFN" <?php echo ($data['Currency']=='AFN') ? 'selected="selected"' :''; ?>>AFN - Afghan Afghani</option>
                                            <option value="TZS" <?php echo ($data['Currency']=='TZS') ? 'selected="selected"' :''; ?>>TZS - Tanzanian Shilling</option>
                                            <option value="UGX" <?php echo ($data['Currency']=='UGX') ? 'selected="selected"' :''; ?>>UGX - Ugandan Shilling</option>
                                            <option value="JMD" <?php echo ($data['Currency']=='JMD') ? 'selected="selected"' :''; ?>>JMD - Jamaican Dollar</option>
                                            <option value="GEL" <?php echo ($data['Currency']=='GEL') ? 'selected="selected"' :''; ?>>GEL - Georgian Lari</option>
                                            <option value="LVL" <?php echo ($data['Currency']=='LVL') ? 'selected="selected"' :''; ?>>LVL - Latvian Lat</option>
                                            <option value="ZWD" <?php echo ($data['Currency']=='ZWD') ? 'selected="selected"' :''; ?>>ZWD - Zimbabwean Dollar</option>
                                            <option value="BWP" <?php echo ($data['Currency']=='BWP') ? 'selected="selected"' :''; ?>>BWP - Botswana Pula</option>
                                            <option value="CUC" <?php echo ($data['Currency']=='CUC') ? 'selected="selected"' :''; ?>>CUC - Cuban Convertible Peso</option>
                                            <option value="ZMW" <?php echo ($data['Currency']=='ZMW') ? 'selected="selected"' :''; ?>>ZMW - Zambian Kwacha</option>
                                            <option value="MMK" <?php echo ($data['Currency']=='MMK') ? 'selected="selected"' :''; ?>>MMK - Burmese Kyat</option>
                                            <option value="GTQ" <?php echo ($data['Currency']=='GTQ') ? 'selected="selected"' :''; ?>>GTQ - Guatemalan Quetzal</option>
                                            <option value="XCD" <?php echo ($data['Currency']=='XCD') ? 'selected="selected"' :''; ?>>XCD - East Caribbean Dollar</option>
                                            <option value="LYD" <?php echo ($data['Currency']=='LYD') ? 'selected="selected"' :''; ?>>LYD - Libyan Dinar</option>
                                            <option value="MKD" <?php echo ($data['Currency']=='MKD') ? 'selected="selected"' :''; ?>>MKD - Macedonian Denar</option>
                                            <option value="TTD" <?php echo ($data['Currency']=='TTD') ? 'selected="selected"' :''; ?>>TTD - Trinidadian Dollar</option>
                                            <option value="MZN" <?php echo ($data['Currency']=='MZN') ? 'selected="selected"' :''; ?>>MZN - Mozambican Metical</option>
                                            <option value="ALL" <?php echo ($data['Currency']=='ALL') ? 'selected="selected"' :''; ?>>ALL - Albanian Lek</option>
                                            <option value="BOB" <?php echo ($data['Currency']=='BOB') ? 'selected="selected"' :''; ?>>BOB - Bolivian Boliviano</option>
                                            <option value="KZT" <?php echo ($data['Currency']=='KZT') ? 'selected="selected"' :''; ?>>KZT - Kazakhstani Tenge</option>
                                            <option value="BBD" <?php echo ($data['Currency']=='BBD') ? 'selected="selected"' :''; ?>>BBD - Barbadian or Bajan Dollar</option>
                                            <option value="AOA" <?php echo ($data['Currency']=='AOA') ? 'selected="selected"' :''; ?>>AOA - Angolan Kwanza</option>
                                            <option value="KHR" <?php echo ($data['Currency']=='KHR') ? 'selected="selected"' :''; ?>>KHR - Cambodian Riel</option>
                                            <option value="XAG" <?php echo ($data['Currency']=='XAG') ? 'selected="selected"' :''; ?>>XAG - Silver Ounce</option>
                                            <option value="AMD" <?php echo ($data['Currency']=='AMD') ? 'selected="selected"' :''; ?>>AMD - Armenian Dram</option>
                                            <option value="UYU" <?php echo ($data['Currency']=='UYU') ? 'selected="selected"' :''; ?>>UYU - Uruguayan Peso</option>
                                            <option value="MOP" <?php echo ($data['Currency']=='MOP') ? 'selected="selected"' :''; ?>>MOP - Macau Pataca</option>
                                            <option value="NAD" <?php echo ($data['Currency']=='NAD') ? 'selected="selected"' :''; ?>>NAD - Namibian Dollar</option>
                                            <option value="LBP" <?php echo ($data['Currency']=='LBP') ? 'selected="selected"' :''; ?>>LBP - Lebanese Pound</option>
                                            <option value="LAK" <?php echo ($data['Currency']=='LAK') ? 'selected="selected"' :''; ?>>LAK - Lao or Laotian Kip</option>
                                            <option value="BYR" <?php echo ($data['Currency']=='BYR') ? 'selected="selected"' :''; ?>>BYR - Belarusian Ruble</option>
                                            <option value="MGA" <?php echo ($data['Currency']=='MGA') ? 'selected="selected"' :''; ?>>MGA - Malagasy Ariary</option>
                                            <option value="SYP" <?php echo ($data['Currency']=='SYP') ? 'selected="selected"' :''; ?>>SYP - Syrian Pound</option>
                                            <option value="VUV" <?php echo ($data['Currency']=='VUV') ? 'selected="selected"' :''; ?>>VUV - Ni-Vanuatu Vatu</option>
                                            <option value="PGK" <?php echo ($data['Currency']=='PGK') ? 'selected="selected"' :''; ?>>PGK - Papua New Guinean Kina</option>
                                            <option value="MNT" <?php echo ($data['Currency']=='MNT') ? 'selected="selected"' :''; ?>>MNT - Mongolian Tughrik</option>
                                            <option value="SDG" <?php echo ($data['Currency']=='SDG') ? 'selected="selected"' :''; ?>>SDG - Sudanese Pound</option>
                                            <option value="ANG" <?php echo ($data['Currency']=='ANG') ? 'selected="selected"' :''; ?>>ANG - Dutch Guilder</option>
                                            <option value="MWK" <?php echo ($data['Currency']=='MWK') ? 'selected="selected"' :''; ?>>MWK - Malawian Kwacha</option>
                                            <option value="GMD" <?php echo ($data['Currency']=='GMD') ? 'selected="selected"' :''; ?>>GMD - Gambian Dalasi</option>
                                            <option value="CUP" <?php echo ($data['Currency']=='CUP') ? 'selected="selected"' :''; ?>>CUP - Cuban Peso</option>
                                            <option value="RWF" <?php echo ($data['Currency']=='RWF') ? 'selected="selected"' :''; ?>>RWF - Rwandan Franc</option>
                                            <option value="MVR" <?php echo ($data['Currency']=='MVR') ? 'selected="selected"' :''; ?>>MVR - Maldivian Rufiyaa</option>
                                            <option value="BTN" <?php echo ($data['Currency']=='BTN') ? 'selected="selected"' :''; ?>>BTN - Bhutanese Ngultrum</option>
                                            <option value="SCR" <?php echo ($data['Currency']=='SCR') ? 'selected="selected"' :''; ?>>SCR - Seychellois Rupee</option>
                                            <option value="HNL" <?php echo ($data['Currency']=='HNL') ? 'selected="selected"' :''; ?>>HNL - Honduran Lempira</option>
                                            <option value="KPW" <?php echo ($data['Currency']=='KPW') ? 'selected="selected"' :''; ?>>KPW - North Korean Won</option>
                                            <option value="PYG" <?php echo ($data['Currency']=='PYG') ? 'selected="selected"' :''; ?>>PYG - Paraguayan Guarani</option>
                                            <option value="DJF" <?php echo ($data['Currency']=='DJF') ? 'selected="selected"' :''; ?>>DJF - Djiboutian Franc</option>
                                            <option value="XBT" <?php echo ($data['Currency']=='XBT') ? 'selected="selected"' :''; ?>>XBT - Bitcoin</option>
                                            <option value="YER" <?php echo ($data['Currency']=='YER') ? 'selected="selected"' :''; ?>>YER - Yemeni Rial</option>
                                            <option value="CDF" <?php echo ($data['Currency']=='CDF') ? 'selected="selected"' :''; ?>>CDF - Congolese Franc</option>
                                            <option value="WST" <?php echo ($data['Currency']=='WST') ? 'selected="selected"' :''; ?>>WST - Samoan Tala</option>
                                            <option value="GYD" <?php echo ($data['Currency']=='GYD') ? 'selected="selected"' :''; ?>>GYD - Guyanese Dollar</option>
                                            <option value="AWG" <?php echo ($data['Currency']=='AWG') ? 'selected="selected"' :''; ?>>AWG - Aruban or Dutch Guilder</option>
                                            <option value="MDL" <?php echo ($data['Currency']=='MDL') ? 'selected="selected"' :''; ?>>MDL - Moldovan Leu</option>
                                            <option value="BZD" <?php echo ($data['Currency']=='BZD') ? 'selected="selected"' :''; ?>>BZD - Belizean Dollar</option>
                                            <option value="HTG" <?php echo ($data['Currency']=='HTG') ? 'selected="selected"' :''; ?>>HTG - Haitian Gourde</option>
                                            <option value="KGS" <?php echo ($data['Currency']=='KGS') ? 'selected="selected"' :''; ?>>KGS - Kyrgyzstani Som</option>
                                            <option value="NIO" <?php echo ($data['Currency']=='NIO') ? 'selected="selected"' :''; ?>>NIO - Nicaraguan Cordoba</option>
                                            <option value="CVE" <?php echo ($data['Currency']=='CVE') ? 'selected="selected"' :''; ?>>CVE - Cape Verdean Escudo</option>
                                            <option value="KYD" <?php echo ($data['Currency']=='KYD') ? 'selected="selected"' :''; ?>>KYD - Caymanian Dollar</option>
                                            <option value="GNF" <?php echo ($data['Currency']=='GNF') ? 'selected="selected"' :''; ?>>GNF - Guinean Franc</option>
                                            <option value="BSD" <?php echo ($data['Currency']=='BSD') ? 'selected="selected"' :''; ?>>BSD - Bahamian Dollar</option>
                                            <option value="BIF" <?php echo ($data['Currency']=='BIF') ? 'selected="selected"' :''; ?>>BIF - Burundian Franc</option>
                                            <option value="SLL" <?php echo ($data['Currency']=='SLL') ? 'selected="selected"' :''; ?>>SLL - Sierra Leonean Leone</option>
                                            <option value="MRO" <?php echo ($data['Currency']=='MRO') ? 'selected="selected"' :''; ?>>MRO - Mauritanian Ouguiya</option>
                                            <option value="TOP" <?php echo ($data['Currency']=='TOP') ? 'selected="selected"' :''; ?>>TOP - Tongan Pa'anga</option>
                                            <option value="BMD" <?php echo ($data['Currency']=='BMD') ? 'selected="selected"' :''; ?>>BMD - Bermudian Dollar</option>
                                            <option value="SBD" <?php echo ($data['Currency']=='SBD') ? 'selected="selected"' :''; ?>>SBD - Solomon Islander Dollar</option>
                                            <option value="UZS" <?php echo ($data['Currency']=='UZS') ? 'selected="selected"' :''; ?>>UZS - Uzbekistani Som</option>
                                            <option value="SOS" <?php echo ($data['Currency']=='SOS') ? 'selected="selected"' :''; ?>>SOS - Somali Shilling</option>
                                            <option value="PAB" <?php echo ($data['Currency']=='PAB') ? 'selected="selected"' :''; ?>>PAB - Panamanian Balboa</option>
                                            <option value="SRD" <?php echo ($data['Currency']=='SRD') ? 'selected="selected"' :''; ?>>SRD - Surinamese Dollar</option>
                                            <option value="XDR" <?php echo ($data['Currency']=='XDR') ? 'selected="selected"' :''; ?>>XDR - IMF Special Drawing Rights</option>
                                            <option value="SZL" <?php echo ($data['Currency']=='SZL') ? 'selected="selected"' :''; ?>>SZL - Swazi Lilangeni</option>
                                            <option value="ERN" <?php echo ($data['Currency']=='ERN') ? 'selected="selected"' :''; ?>>ERN - Eritrean Nakfa</option>
                                            <option value="LRD" <?php echo ($data['Currency']=='LRD') ? 'selected="selected"' :''; ?>>LRD - Liberian Dollar</option>
                                            <option value="TJS" <?php echo ($data['Currency']=='TJS') ? 'selected="selected"' :''; ?>>TJS - Tajikistani Somoni</option>
                                            <option value="TMT" <?php echo ($data['Currency']=='TMT') ? 'selected="selected"' :''; ?>>TMT - Turkmenistani Manat</option>
                                            <option value="GIP" <?php echo ($data['Currency']=='GIP') ? 'selected="selected"' :''; ?>>GIP - Gibraltar Pound</option>
                                            <option value="LSL" <?php echo ($data['Currency']=='LSL') ? 'selected="selected"' :''; ?>>LSL - Basotho Loti</option>
                                            <option value="KMF" <?php echo ($data['Currency']=='KMF') ? 'selected="selected"' :''; ?>>KMF - Comoran Franc</option>
                                            <option value="SVC" <?php echo ($data['Currency']=='SVC') ? 'selected="selected"' :''; ?>>SVC - Salvadoran Colon</option>
                                            <option value="GGP" <?php echo ($data['Currency']=='GGP') ? 'selected="selected"' :''; ?>>GGP - Guernsey Pound</option>
                                            <option value="XPT" <?php echo ($data['Currency']=='XPT') ? 'selected="selected"' :''; ?>>XPT - Platinum Ounce</option>
                                            <option value="STD" <?php echo ($data['Currency']=='STD') ? 'selected="selected"' :''; ?>>STD - Sao Tomean Dobra</option>
                                            <option value="IMP" <?php echo ($data['Currency']=='IMP') ? 'selected="selected"' :''; ?>>IMP - Isle of Man Pound</option>
                                            <option value="FKP" <?php echo ($data['Currency']=='FKP') ? 'selected="selected"' :''; ?>>FKP - Falkland Island Pound</option>
                                            <option value="XPD" <?php echo ($data['Currency']=='XPD') ? 'selected="selected"' :''; ?>>XPD - Palladium Ounce</option>
                                            <option value="JEP" <?php echo ($data['Currency']=='JEP') ? 'selected="selected"' :''; ?>>JEP - Jersey Pound</option>
                                            <option value="SHP" <?php echo ($data['Currency']=='SHP') ? 'selected="selected"' :''; ?>>SHP - Saint Helenian Pound</option>
                                            <option value="SPL" <?php echo ($data['Currency']=='SPL') ? 'selected="selected"' :''; ?>>SPL - Seborgan Luigino</option>
                                            <option value="TVD" <?php echo ($data['Currency']=='TVD') ? 'selected="selected"' :''; ?>>TVD - Tuvaluan Dollar</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                            <label>Transaction Amount : </label>
                                            <input type="text"  value="<?=$data['transactionAmt']?>" name="transactionAmt" class="form-control">
                                    </div>
                                    
                                    </div>
                                </div>
                                
                                
                                
                                <!--PAYMENT SECTION-->
                                
                                <div class="Verified_Negative2" id="Verified_Negative2">
                                    <div class="form-group">
                                      <label>Category:  </label>
                                      <select name="checkCategory" class="form-control">
                                      <option value="0">Select</option>
                                      <option value="1" <?php echo ($data['checkCategory']=='1') ? 'selected="selected"' :''; ?>>Education</option>
                                      <option value="2" <?php echo ($data['checkCategory']=='2') ? 'selected="selected"' :''; ?>>Employment</option>
                                      <option value="3" <?php echo ($data['checkCategory']=='3') ? 'selected="selected"' :''; ?>>Health License</option>
                                      <option value="5" <?php echo ($data['checkCategory']=='5') ? 'selected="selected"' :''; ?>>Birth Certificate</option>
                                      <option value="6" <?php echo ($data['checkCategory']=='6') ? 'selected="selected"' :''; ?>>Marriage Certificate</option>
                                      <option value="7" <?php echo ($data['checkCategory']=='7') ? 'selected="selected"' :''; ?>>Property Deed</option>
                                      <option value="8" <?php echo ($data['checkCategory']=='8') ? 'selected="selected"' :''; ?>>Directorship Check</option>
                                      <option value="9" <?php echo ($data['checkCategory']=='9') ? 'selected="selected"' :''; ?>>Death Certificate</option>
                                      <option value="10" <?php echo ($data['checkCategory']=='10') ? 'selected="selected"' :''; ?>>Criminal Check</option>
                                      <option value="11" <?php echo ($data['checkCategory']=='11') ? 'selected="selected"' :''; ?>>Credit Check</option>
                                      <option value="12" <?php echo ($data['checkCategory']=='12') ? 'selected="selected"' :''; ?>>Database Check</option>
                                      <option value="13" <?php echo ($data['checkCategory']=='13') ? 'selected="selected"' :''; ?>>Reference Check</option>
                                      <option value="14" <?php echo ($data['checkCategory']=='14') ? 'selected="selected"' :''; ?>>Identity Validation</option>
                                      <option value="15" <?php echo ($data['checkCategory']=='15') ? 'selected="selected"' :''; ?>>Address Check</option>
                                      <option value="16" <?php echo ($data['checkCategory']=='16') ? 'selected="selected"' :''; ?>>Media Check</option>
                                      <option value="17" <?php echo ($data['checkCategory']=='17') ? 'selected="selected"' :''; ?>>Professional Qualification Check</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>Sub-Category:  </label>
                                      <select name="checkSubCategory" class="form-control">
                                          <option value="0">Select</option>
                                          <option value="1" <?php echo ($data['checkSubCategory']=='1') ? 'selected="selected"' :''; ?>>Fake IA/IA does not exist</option>
                                          <option value="2"<?php echo ($data['checkSubCategory']=='2') ? 'selected="selected"' :''; ?>>IA is a degree mill</option>
                                          <option value="3" <?php echo ($data['checkSubCategory']=='3') ? 'selected="selected"' :''; ?>>Suspected Unaccredited Body</option>
                                          <option value="4"<?php echo ($data['checkSubCategory']=='4') ? 'selected="selected"' :''; ?>>IA issues fake certificates</option>
                                          <option value="7" <?php echo ($data['checkSubCategory']=='7') ? 'selected="selected"' :''; ?>>Applicant provided false information</option>
                                          <option value="8" <?php echo ($data['checkSubCategory']=='8') ? 'selected="selected"' :''; ?>>Applicant provided false certificate</option>
                                          <option value="9" <?php echo ($data['checkSubCategory']=='9') ? 'selected="selected"' :''; ?>>Negative Feedback for Applicant</option>
                                          <option value="10" <?php echo ($data['checkSubCategory']=='10') ? 'selected="selected"' :''; ?>>IA is not recognized by statutory government body</option>
                                          <option value="11" <?php echo ($data['checkSubCategory']=='11') ? 'selected="selected"' :''; ?>>Adverse records found against the Applicant</option>
                                          <option value="12" <?php echo ($data['checkSubCategory']=='12') ? 'selected="selected"' :''; ?>>Certification / Membership currently not valid</option>
                                          <option value="13" <?php echo ($data['checkSubCategory']=='13') ? 'selected="selected"' :''; ?>>Others</option>
                                      </select>
                                    </div>
                                    
                                    <div class="form-group" style="width: 33.33%;">
                                      <label for="basic-text-area">Comments (If Any): </label>
                                      <textarea name="VerificationComment" id="basic-text-if-any" rows="2" class="form-control"><?=$data['VerificationComment']?></textarea>
                                    </div>
                                </div>
                                
                                <div class="Verified_Major_Negative2" id="Verified_Major_Negative2">
                                    <div class="form-group">
                                      <label>Category:  </label>
                                      <select name="checkCategory" class="form-control">
                                      <option value="0">Select</option>
                                      <option value="1" <?php echo ($data['checkCategory']=='1') ? 'selected="selected"' :''; ?>>Education</option>
                                      <option value="2" <?php echo ($data['checkCategory']=='2') ? 'selected="selected"' :''; ?>>Employment</option>
                                      <option value="3" <?php echo ($data['checkCategory']=='3') ? 'selected="selected"' :''; ?>>Health License</option>
                                      <option value="5" <?php echo ($data['checkCategory']=='5') ? 'selected="selected"' :''; ?>>Birth Certificate</option>
                                      <option value="6" <?php echo ($data['checkCategory']=='6') ? 'selected="selected"' :''; ?>>Marriage Certificate</option>
                                      <option value="7" <?php echo ($data['checkCategory']=='7') ? 'selected="selected"' :''; ?>>Property Deed</option>
                                      <option value="8" <?php echo ($data['checkCategory']=='8') ? 'selected="selected"' :''; ?>>Directorship Check</option>
                                      <option value="9" <?php echo ($data['checkCategory']=='9') ? 'selected="selected"' :''; ?>>Death Certificate</option>
                                      <option value="10" <?php echo ($data['checkCategory']=='10') ? 'selected="selected"' :''; ?>>Criminal Check</option>
                                      <option value="11" <?php echo ($data['checkCategory']=='11') ? 'selected="selected"' :''; ?>>Credit Check</option>
                                      <option value="12" <?php echo ($data['checkCategory']=='12') ? 'selected="selected"' :''; ?>>Database Check</option>
                                      <option value="13" <?php echo ($data['checkCategory']=='13') ? 'selected="selected"' :''; ?>>Reference Check</option>
                                      <option value="14" <?php echo ($data['checkCategory']=='14') ? 'selected="selected"' :''; ?>>Identity Validation</option>
                                      <option value="15" <?php echo ($data['checkCategory']=='15') ? 'selected="selected"' :''; ?>>Address Check</option>
                                      <option value="16" <?php echo ($data['checkCategory']=='16') ? 'selected="selected"' :''; ?>>Media Check</option>
                                      <option value="17" <?php echo ($data['checkCategory']=='17') ? 'selected="selected"' :''; ?>>Professional Qualification Check</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>Sub-Category:  </label>
                                      <select name="checkSubCategory" class="form-control">
                                          <option value="0">Select</option>
                                          <option value="1" <?php echo ($data['checkSubCategory']=='1') ? 'selected="selected"' :''; ?>>Fake IA/IA does not exist</option>
                                          <option value="2"<?php echo ($data['checkSubCategory']=='2') ? 'selected="selected"' :''; ?>>IA is a degree mill</option>
                                          <option value="3" <?php echo ($data['checkSubCategory']=='3') ? 'selected="selected"' :''; ?>>Suspected Unaccredited Body</option>
                                          <option value="4"<?php echo ($data['checkSubCategory']=='4') ? 'selected="selected"' :''; ?>>IA issues fake certificates</option>
                                          <option value="7" <?php echo ($data['checkSubCategory']=='7') ? 'selected="selected"' :''; ?>>Applicant provided false information</option>
                                          <option value="8" <?php echo ($data['checkSubCategory']=='8') ? 'selected="selected"' :''; ?>>Applicant provided false certificate</option>
                                          <option value="9" <?php echo ($data['checkSubCategory']=='9') ? 'selected="selected"' :''; ?>>Negative Feedback for Applicant</option>
                                          <option value="10" <?php echo ($data['checkSubCategory']=='10') ? 'selected="selected"' :''; ?>>IA is not recognized by statutory government body</option>
                                          <option value="11" <?php echo ($data['checkSubCategory']=='11') ? 'selected="selected"' :''; ?>>Adverse records found against the Applicant</option>
                                          <option value="12" <?php echo ($data['checkSubCategory']=='12') ? 'selected="selected"' :''; ?>>Certification / Membership currently not valid</option>
                                          <option value="13" <?php echo ($data['checkSubCategory']=='13') ? 'selected="selected"' :''; ?>>Others</option>
                                      </select>
                                    </div>
                                    <div class="form-group" style="width: 33.33%;">
                                      <label for="basic-text-area">Comments (If Any): </label>
                                      <textarea name="VerificationComment" id="basic-text-if-any" rows="2" class="form-control"><?=$data['VerificationComment']?></textarea>
                                    </div>
                                </div>
                                
                                <div class="Verification_Status2" id="Verification_Status2">
                                
                                <div class="form-group">
                                  <label>Phraseology :   </label>
                                  <select name="inDivPhraseology" class="form-control" id="inDivPhraseology" onChange = "inDivPhraseologi(this);">
                                  	<option value="0" >Select</option>
                                      <option value="inDivPhraseology_1" <?php echo ($data['inDivPhraseology']=='Contact details for the employer cannot be located. Applicant is request to provide this information') ? 'selected="selected"' :''; ?>>Contact details</option>
                                      <option value="inDivPhraseology_2" <?php echo ($data['inDivPhraseology']=='User entered comments') ? 'selected="selected"' :''; ?>>Custom</option>
                                      <option value="inDivPhraseology_3" <?php echo ($data['inDivPhraseology']=='Employee number is required by the company officials to verify employment') ? 'selected="selected"' :''; ?>>Employee number</option>
                                      <option value="inDivPhraseology_4" <?php echo ($data['inDivPhraseology']=='The letter of Authorization is not clear, not signed or has not been submitted') ? 'selected="selected"' :''; ?>>LOA</option>
                                      <option value="inDivPhraseology_5" <?php echo ($data['inDivPhraseology']=='Applicant is request to submit last 3 months pay slips') ? 'selected="selected"' :''; ?>>Pay slip</option>
                                      <option value="inDivPhraseology_6" <?php echo ($data['inDivPhraseology']=='Applicant is requeste to submit his relieving letter') ? 'selected="selected"' :''; ?>>Relieving letter</option>
                                      <option value="inDivPhraseology_7" <?php echo ($data['inDivPhraseology']=='Insufficient Information to process: Applicant is requested to contact IA directly to obtain the verification.') ? 'selected="selected"' :''; ?>>UTV</option>
                                  </select>
                                </div>
                                <div class="form-group" style="width: 33.33%;">
                                  <label for="basic-text-area">Insufficiency Comment:  </label>
                                  <textarea name="InsufficiencyComment" id="basic-text-area" rows="4" class="form-control InsufficiencyComment"><?=$data['InsufficiencyComment']?></textarea>
                                </div>
								
                                </div>
                                
                                <div class="clearfix"></div>
                                <div class="form-group" style="width: 50%;">
                                  <label for="basic-text-area">Verification Comment: </label>
                                  <textarea name="VerificationComment" id="basic-text-main" rows="2" class="form-control"><?=$data['VerificationComment']?></textarea>
                                </div>
                                <div class="clearfix"></div>
                                </div>
                                
                                   <div class="clearfix"></div>
                            </div>
                             

                            
                            <div class="clearfix"></div>
                            
                            <!--Attachment Section-->
                             <?php 	if(isset($_REQUEST['check'])){ 
									$savvion_attach = $db->select("savvion_attach","*","sv_id=$_REQUEST[check]");
									if(mysql_num_rows($savvion_attach)>0){
									$count = 0;
							 ?>
                                <div class="list-group-item preview-container">
                                	<h4 class="section-title">Attachments</h4>
                                    <div class="form-group">
                                        <div class="gallery-container">
                                        	<?php while($img=mysql_fetch_assoc($savvion_attach)){
													$count++;
												?>
                                                <div class="dz-preview dz-file-preview">
                                                    <div class="dz-details">
                                                        <img data-dz-thumbnail src="files/savvionAttachments/<?=$img['at_attachment']?>"/>
                                                        <div class="overlay">
                                                            <div class="dz-filename"><span data-dz-name>Attachments -<?=$count?></span></div>
                                                            <!-- <div class="dz-size" data-dz-size></div> -->
                                                            <div class="status">
                                                                <a class="dz-error-mark remove-item" href="javascript:;"><i class="icon-remove-sign"></i></a>
                                                                <div class="dz-error-message">Error: <span data-dz-errormessage></span></div>
                                                            </div>
                                                            <div class="controls clearfix">
                                                            	<a class="trash-item" href="javascript:;" onclick="delAttach(<?=$img['at_id']?>);"><i class="icon-trash"></i></a>
																<?php /*?><input type="hidden" name="at_id" value="<?=$img['at_id']?>" >
                                                                <button type="submit" name="deleteImage" class="btn btn-xs btn-danger " >Delete</button>
                                                                <?php */?>                                                            
															</div>
                                                            <div class="controls confirm-removal clearfix">
                                                                <a class="remove-item" href="javascript:;">YES</a>
                                                                <a class="remove-cancel" href="javascript:;">NO</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                                                </div>   
                                           <?php }// end while?>
                                  
                                        </div>                       
                                    </div>
                                </div>
                            <?php 
									}// end if	
								}
							?>
                            
                            <div class="clearfix"></div>
                            <div class="addsavvioncheck-section4">
                            	<div class="attachment-sec">
                                
                                
                                     <a class="add_field_button" href="javascript:void(0);">Add Attachment</a>
										
                                         <div class="clearfix"></div>
                                         
                                     <div class="form-group">
                                        <label>Attachment</label>
                                        <div>
                                            <div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
                                              <div class="input-group">
                                                <div class="form-control uneditable-input span3" data-trigger="fileinput"><i class="icon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                                <span class="input-group-addon btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="sp_attachment[]" ></span>
                                                <a href="#" class="input-group-addon btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                              </div>
                                            </div>
                                            <input type="hidden" name="ids[]" value="1">
                                        </div>
                                    </div>
                                     
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <!--//Attachment Section-->
                            <div class="addsavvioncheck-section-btn">
                            	<fieldset class="form-group">
                            <?php if($uID == 261 ){ ?>
                                <button type="submit" class=" btn btn-success dropdown-toggle" style="float:right; display:<?php echo $buttonDisplay?>;" name="addsavvioncheck" > <span>
                                <?=isset($_REQUEST['check'])?'Edit':'Add'?>
                                Check</span> </button>
							<?php }else{?>
                            	<?php 
									$buttonDisplay = ($savv_checkId !=0 &&  $LEVEL==10 ) ? 'block' : 'none';
								
								?>
                                <button type="submit" class=" btn btn-success dropdown-toggle" style="float:right; display:<?php echo $buttonDisplay?>;margin-right:10px;" name="addsavvioncheck" > <span>
                                <?=isset($_REQUEST['check'])?'Edit':'Add'?>
                                Check</span> </button>
                                <?php } ?>
                                <button type="submit" class=" btn btn-success dropdown-toggle" value="sentaddsavvioncheck" style="float:right; margin-right:10px; display:<?php echo $buttonDisplay?>;" name="sentaddsavvioncheck" > <span>
                                <?=isset($_REQUEST['check'])?'Edit':'Add'?>
                                Check And Send To QA</span> </button>
                                <button type="submit" class=" btn btn-success dropdown-toggle" value="insufficientCheck" style="float:right; margin-right:10px; display:<?php echo $buttonDisplay?>;" name="insufficientCheck" > <span>
                               Insufficient Check</span> </button>
                               <input type="hidden" name="ins_savvion_check_id" value="<?=$_REQUEST['check']?>" >
                                
                                <?php if(isset($_REQUEST['check']) && $LEVEL == 11 ){ ?>
                                    <button type="button" class=" btn btn-success dropdown-toggle" style="float:right; margin-right:10px;" data-toggle="modal" data-target="#myModal" name="approvesavvion" > <span>
                                    Approve</span> </button>
                                    <input type="hidden" name="appsavvion_check_id" value="<?=$_REQUEST['check']?>" >
                                    <button type="submit" class=" btn btn-success dropdown-toggle" style="float:right; margin-right:10px;" name="rejectsavvion" > <span>
                                    Send Back To Analyst</span> </button>
                                    <input type="hidden" name="rejsavvion_check_id" value="<?=$_REQUEST['check']?>" >
                                <?php }?>
                                
                               <?php /*?> <input type="hidden" name="addsavvioncheck" value="addsavvioncheck" ><?php */?>
                                <?php 	if(isset($_REQUEST['check'])){ ?>
                                <input type="hidden" name="savvion_check_id" value="<?=$_REQUEST['check']?>" >
                                <?php	} ?>
                            </fieldset>
                            </div>
                            
                            <input type="hidden" value="<?=(isset($_REQUEST['SubBarcode'])?$_REQUEST['SubBarcode']:'')?>" name="inserted_id" />
                            <div class="container">
  <!-- Trigger the modal with a button -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Training Video</h4>
        </div>
        <div class="modal-body">
        	<div class="form-group">
                <label class="checkbox-inline">
                	<input type="checkbox" class="chk"  value="xyz">
                	Option Disabled
                </label>  
            </div>
        	<div class="form-group">
                <label class="checkbox-inline">
                	<input type="checkbox" class="chk"  value="ad">
                	Option Disabled
                </label>  
            </div>
        	<div class="form-group">
                <label class="checkbox-inline">
                	<input type="checkbox" class="chk"  value="qwwe">
                	Option Disabled
                </label>  
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success disable" disabled name="approvesavvion" >Submit</button>
           <button type="button" class="btn btn-lg btn-primary close"  data-dismiss="modal">Cancel</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
                        </form>
                       </div>
                        
                        <?php }?>
                    </div>
                
                </div>
                
                 <div>
                     <div class="list-group-item">
                      <h2 class="box_head">Checks Listing</h2>
                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                          <th>ID</th>
                            <th>Reference No</th>
                            <th>Client Name</th>
                            <th>Client Reference No</th>
                            <th width="60">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php	
						  
						  
						  
						if($LEVEL == 11 ){
							$checks = $db->select("savvion_check","*","`status` = 2 AND is_active=1 ORDER BY id DESC");
						}
						elseif($LEVEL == 10 || $LEVEL == 3){
							
							$checks = $db->select("savvion_check","*","(`status` = 1 || `status` = 2) AND is_active=1 AND user_id='$uID'  ORDER BY id DESC");
						}elseif($LEVEL == 13 ){
							$checks = $db->select("savvion_check","*","`status` = 1 AND is_active=1 AND team_lead_id='$uID'  ORDER BY id DESC");
						}else{
								$checks = $db->select("savvion_check","*"," is_active=1 ORDER BY id DESC");
						}
                        if(mysql_num_rows($checks)>0){
                        while($check = mysql_fetch_array($checks)){ ?>
                          <tr>
                           <td><?=$check['id'];?></td>
                            <td><?=mb_convert_encoding($check['SubBarcode'], 'HTML-ENTITIES','UTF-8');?></td>
                            <td style="text-align:left"><?=$check['ClientName']?></td>
                            <td><?=$check['ClientRefNo']?></td>
                            <td align="center"><?php  if($check['is_active']==1) {
                                                           $img="accept.png";
                                                $tit="Disable"; 
                                            }else{
                                                 $img="cog_3.png";
                                                 $tit="Enable";
                                            } 
                                            $link="check=$check[id]";
                                    ?>
                              <?php /*?><a href="javascript:void(0)" ><img onclick="submitLink('<?=$link?>&edur')" src="images/icons/small/grey/<?=$img?>" class="edits" title="<?=$tit?>"  /> </a><?php */?> <a href="javascript:void(0)" ><img onclick="submitLink('<?=$link?>&edit')" src="images/icons/small/grey/pencil.png"  class="edits" title="Edit"  /> </a></td>
                          </tr>
                          <?php }}else{ ?>
                          <tr>
                                <td></td>
                                <td></td>
                                <td colspan="3"><h2 align="center">No Checks</h2></td>
                                <td></td>
                                <td></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
        		</div>
                
                
            </div>
        
        
        
        	
        
        </div>
        
        
    </div>
    
    <?php 
		if($LEVEL==10 || $LEVEL==3){
			$inputSecurity = 1;
		}
		
	?>
  
<script>
function delAttach(delRecord){
	
	if(confirm('Are you sure want to remove this attachment?')){
		document.location='?action=addsavvioncheck&atype=add/edit&deleteImage=1&at_id='+delRecord;
	}
	
}
function getFormData(CheckId,savv_check_id){
	
	if(typeof savv_check_id == "undefined"){ //no errors
		$.ajax({
			url: "actions.php",
			data:'ePage=add_rating&getcheckname='+CheckId,
			type: "POST",
			success: function(res){
		   
				$('.resultDiv').html(res);
			}
			});
	
	}else{
				$.ajax({
			url: "actions.php",
			data:'ePage=add_rating&getcheckname='+CheckId+'&savv_check_id='+savv_check_id,
			type: "POST",
			success: function(res){
		   
				$('.resultDiv').html(res);
			}
			});

		
	}
}

$(document).ready(function(){
	
	

	
	
<?php if(is_numeric($_REQUEST['check']) && is_numeric($savv_checkId)){?>
	getFormData('<?php echo $tab_value;?>','<?php echo $_REQUEST['check'];?>');
<?php }else{?>
	getFormData(1);
<?php } ?>


$(".chk").change(function () {
	//alert('yess');
	if ($('.chk:checked').length == $('.chk').length) {
		//alert('yes');
		$('.disable').prop('disabled', false);
	}else{
		$('.disable').prop('disabled', true);
	}       
});

    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".attachment-sec"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
	/* Multi Attachment */
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="form-group"><label>Attachment</label><div><div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden"><div class="input-group"><div class="form-control uneditable-input span3" data-trigger="fileinput"><i class="icon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div><span class="input-group-addon btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="sp_attachment[]" ></span><a href="#" class="input-group-addon btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a></div></div></div><a href="#" class="remove_field">Remove</a></div><input type="hidden" name="ids[]" value="'+x+'">'
							); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });
	/* Multi Attachment */


/*var items = $('#isError');

items.on('change', function(){
  
  wrapper.empty();
  var appendData = '';
  
  $.each(items, function(i, item)
    {
      if ($(item).prop('checked'))
        {
          $(wrapper).append('<div class="form-group"><label for="text-area-no-resize">Comments For ECT: </label><div><textarea name="CommentsForECT" id="text-area-no-resize" rows="3" class="form-control no-resize"> <?=$data['CommentsForECT']?></textarea></div></div>'
							);
        }
    });
  
    wrapper.append(appendData);
            
});*/
	/*var DefaultForm = '<div class="form-group"><label>Phraseology:</label><select name="Phraseology" class="form-control" id="textField50" ><option value="0">Select</option></select></div><div class="form-group"><label>Verification Language:</label><select name="VerificationLanguage" class="form-control" id="comboBox1" ><option value="0">Select</option><option value="Arabic">Arabic</option><option value="Assamese">Assamese</option><option value="Bengali">Bengali</option><option value="English">English</option><option value="French">French</option><option value="German">German</option><option value="Gujarati">Gujarati</option><option value="Hindi">Hindi</option><option value="Japanese">Japanese</option><option value="Kannada">Kannada</option><option value="Kashmiri">Kashmiri</option><option value="Konkani">Konkani</option><option value="Malayalam">Malayalam</option><option value="Mandarin Chinese">Mandarin Chinese</option><option value="Manipuri">Manipuri</option><option value="Marathi">Marathi</option><option value="Nepali">Nepali</option><option value="Oriya">Oriya</option><option value="Portuguese">Portuguese</option><option value="Punjabi">Punjabi</option><option value="Russian">Russian</option><option value="Sanskrit">Sanskrit</option><option vale="Sindhi">Sindhi</option><option value="Spanish">Spanish</option><option value="Tamil">Tamil</option><option value="Telugu">Telugu</option><option value="Urdu">Urdu</option></select></div><div class="form-group"><label>Mode Of Verification: </label><select name="ModeOfVerification" class="form-control" id="modevt" ><option value="0">Select</option><option value="EMail">EMail</option><option value="Fax">Fax</option><option value="Online">Online</option><option value="Post/Letter">Post/Letter</option><option value="Site Visit– Written">Site Visit– Written</option><option value="Site visit– Verbal">Site visit– Verbal</option><option value="Verbal">Verbal</option></select></div><div class="form-group"><label>Initiated by: </label><select name="initiatedByName" class="form-control" id="initiatedById"><option value="0" selected="">Select</option><option value="1">In-house</option><option value="2">Vendor</option></select></div><div class="form-group"><label>Verification Fee:  </label><select name="VerificationFee" class="form-control" id="vfTxt"><option value="Select" selected="">Select</option><option value="Yes">Yes</option><option value="No">No</option></select></div><div class="fee"></div><div class="form-group"><label for="basic-text-area">Verification Comment: </label><textarea name="VerificationComment" id="basic-text-area" rows="2" class="form-control"></textarea></div>';
	
	 $("#Status").change(function () {
        var end = this.value;
		verificationDiv.empty();
		
		//alert(end);
		if(end != ''){
			switch(end){
				case '0':
					$(verificationDiv).append(DefaultForm);
				break;
			
			}
		}else{
					$(verificationDiv).append(DefaultForm);
		}
		 //$(verificationDiv).append('<div class="form-group">Two</div>'
							//);
        //var firstDropVal = $('#pick').val();
    });*/
/*	$("#vfTxt").change(function () {
		alert('sadasd');
        var feeVal = this.value;
		
		fee.empty();
		
		
		if(feeVal == 'Yes'){
			$(fee).append('Yes Payment');
		}else{
			$(fee).append('');
		}
		 //$(verificationDiv).append('<div class="form-group">Two</div>'
							//);
        //var firstDropVal = $('#pick').val();
    });*/
	// When QC reviewing Check Analyst will not be able to Edit Form
	/*if(savv_checkId != 0 && inputSecurity == 1 ){
		$('input[type="text"]').prop('readonly', true);
	}*/
	//alert(tab_value);
	/*if(tab_value){
		switch(tab_value){
			case 1:
			getFormData(1);
			break;
			case 2:
			getFormData(2);
			break;
			case 3:
			getFormData(3);
			break;
			
		}
	}*/
	$("a.crm-remarks-btn").click(function(){
		$(".crm-remarks").slideToggle(700);
		$("a.crm-remarks-btn").toggleClass("active");
	});
	$("a.verification-stu-btn").click(function(){
		$(".verification-stu").slideToggle(700);
		$("a.verification-stu-btn").toggleClass("active");
	});
	
	$("#VStatus").change(function(){
		$(".Verification_Status2").show("fast")[ ($(this).val() == 'Verification_Status') ? 'show' : 'hide' ]();
		$(".Verified_Negative2").show("fast")[ ($(this).val() == 'Verified_Negative') ? 'show' : 'hide' ]();
		$(".Verified_Major_Negative2").show("fast")[ ($(this).val() == 'Verified_Major_Negative') ? 'show' : 'hide' ]();
	});
	$("#VStatus").change();
            
	 
});

function valueChanged()
{
    if($('.isErrorBox').is(":checked"))   
        $(".Is_Error_Comments").slideToggle(700);
    else
        $(".Is_Error_Comments").slideToggle(700);
}

$(function() {
	$('#initiatedById').change(function(){
		$('.Verification_Fee').hide();
		$('#' + $(this).val()).show();
	});
});
$(function() {
	$('#vfTxt').change(function(){
		$('.Verification_Fee_yes').hide();
		$('#' + $(this).val()).show();
	});
});
$(function() {
	$('#VStatus').change(function(){
		$('.Verification_Status').hide();
		$('#' + $(this).val()).show();
	});
});

$(function() {
	$('#paymentModTypeID').change(function(){
		$('.payment-Credit').hide();
		$('#' + $(this).val()).show();
	});
});
$(function() {
	$('#paymentModTypeID').change(function(){
		$('.payment-Debit').hide();
		$('#' + $(this).val()).show();
	});
});
$(function() {
	$('#paymentModTypeID').change(function(){
		$('.payment-Demand').hide();
		$('#' + $(this).val()).show();
	});
});
$(function() {
	$('#paymentModTypeID').change(function(){
		$('.payment-Wire').hide();
		$('#' + $(this).val()).show();
	});
});
$(function() {
	$('#paymentModTypeID').change(function(){
		$('.payment-Other').hide();
		$('#' + $(this).val()).show();
	});
});

$(function() {
	$('#VStatus').change(function(){
		$('.Phraseology_Select').hide();
		$('#' + $(this).val()).show();
	});
});

$(function() {
	$('#VStatus').change(function(){
		$('.Beyond_DLV_Scope_Stop_Case').hide();
		$('#' + $(this).val()).show();
	});
});

$(function() {
	$('#VStatus').change(function(){
		$('.Force_Majeure').hide();
		$('#' + $(this).val()).show();
	});
});

$(function() {
	$('#VStatus').change(function(){
		$('.Inaccessible_for_verification').hide();
		$('#' + $(this).val()).show();
	});
});

$(function() {
	$('#VStatus').change(function(){
		$('.Insufficient_Information_Close_Case').hide();
		$('#' + $(this).val()).show();
	});
});


$(function() {
	$('#VStatus').change(function(){
		$('.Not_Initiated').hide();
		$('#' + $(this).val()).show();
	});
});

$(function() {
	$('#VStatus').change(function(){
		$('.Out_of_scope_Stop_Case').hide();
		$('#' + $(this).val()).show();
	});
});

$(function() {
	$('#VStatus').change(function(){
		$('.Partially_Verified').hide();
		$('#' + $(this).val()).show();
	});
});

$(function() {
	$('#VStatus').change(function(){
		$('.Pending_for_Authorization').hide();
		$('#' + $(this).val()).show();
	});
});

$(function() {
	$('#VStatus').change(function(){
		$('.Pending_for_Reply').hide();
		$('#' + $(this).val()).show();
	});
});

$(function() {
	$('#VStatus').change(function(){
		$('.Record_Not_Available').hide();
		$('#' + $(this).val()).show();
	});
});

$(function() {
	$('#VStatus').change(function(){
		$('.Refused_to_verify').hide();
		$('#' + $(this).val()).show();
	});
});

$(function() {
	$('#VStatus').change(function(){
		$('.Unable_to_Verify').hide();
		$('#' + $(this).val()).show();
	});
});

$(function() {
	$('#VStatus').change(function(){
		$('.Verified_Clear').hide();
		$('#' + $(this).val()).show();
	});
});

$(function() {
	$('#VStatus').change(function(){
		$('.Verified_Negative').hide();
		$('#' + $(this).val()).show();
	});
});

$(function() {
	$('#VStatus').change(function(){
		$('.Verified_Major_Negative').hide();
		$('#' + $(this).val()).show();
	});
});

$(function() {
	$('#VStatus').change(function(){
		$('.Verified_Minor_Discrepancy').hide();
		$('#' + $(this).val()).show();
	});
});

$(function() {
	$('#VStatus').change(function(){
		$('.Work_in_Progress').hide();
		$('#' + $(this).val()).show();
	});
});


$(function() {
	$('#VStatus' + $('').val()).change(function(){
		$('.Work_in_Progress').show();
		$('#' + $(this).val()).hide();
	});
});





VT0blank = "";
VStatusP1_1 = "The name appearing on the degree certificate/ marks sheet does not match with that on the passport. Applicant is requested to provide a marriage certificate or other evidence of legal name change.";
VStatusP1_2 = "The applicant has changed his University during the course of his education. A photocopy of the transfer certificate indicating the transfer to another University would be required to facilitate the verification process.";
VStatusP1_3 = "The applicant has not attached the photocopies of his transcript or marks sheet or the same is not readable.";
VStatusP1_4 = "Applicant has not submitted a copy of his passport or the same is not readable.";
VStatusP1_5 = "Application sent for Error Review.";
VStatusP1_6 = "Applicant has not signed the Letter of Authorization and not attached a copy of the Degree certificate/passport/Transcript. The application form submitted is incomplete or handwritten or a Arabic language form and UAE correspondence address with PO Box No not mentioned.";
function VStatusP1(t) {
	var otionValue = t.value;
	if (otionValue == "0") {
	  document.getElementById('basic-text-main').innerHTML = VT0blank;
	} else if (otionValue == "VT023")
	  document.getElementById('basic-text-main').innerHTML = VStatusP1_1;
	else if (otionValue == "VT024")
	  document.getElementById('basic-text-main').innerHTML = VStatusP1_2;
	else if (otionValue == "VT025")
	  document.getElementById('basic-text-main').innerHTML = VStatusP1_3;
	else if (otionValue == "VT026")
	  document.getElementById('basic-text-main').innerHTML = VStatusP1_4;
	else if (otionValue == "VT027")
	  document.getElementById('basic-text-main').innerHTML = VStatusP1_5;
	else if (otionValue == "VT028")
	  document.getElementById('basic-text-main').innerHTML = VStatusP1_6;
};


inDivPhraseologi_0 = "";
inDivPhraseologi_1 = "Contact details for the employer cannot be located. Applicant is request to provide this information";
inDivPhraseologi_2 = "User entered comments";
inDivPhraseologi_3 = "Employee number is required by the company officials to verify employment";
inDivPhraseologi_4 = "The letter of Authorization is not clear, not signed or has not been submitted";
inDivPhraseologi_5 = "Applicant is request to submit last 3 months pay slips";
inDivPhraseologi_6 = "Applicant is requeste to submit his relieving letter";
inDivPhraseologi_7 = "Insufficient Information to process: Applicant is requested to contact IA directly to obtain the verification.";
function inDivPhraseologi(t) {
	var otionValue = t.value;
	if (otionValue == "inDivPhraseology_0") {
	  document.getElementById('basic-text-area').innerHTML = inDivPhraseologi_0;
	}
	else if (otionValue == "inDivPhraseology_1")
	  document.getElementById('basic-text-area').innerHTML = inDivPhraseologi_1;
	else if (otionValue == "inDivPhraseology_2")
	  document.getElementById('basic-text-area').innerHTML = inDivPhraseologi_2;
	else if (otionValue == "inDivPhraseology_3")
	  document.getElementById('basic-text-area').innerHTML = inDivPhraseologi_3;
	else if (otionValue == "inDivPhraseology_4")
	  document.getElementById('basic-text-area').innerHTML = inDivPhraseologi_4;
	else if (otionValue == "inDivPhraseology_5")
	  document.getElementById('basic-text-area').innerHTML = inDivPhraseologi_5;
	else if (otionValue == "inDivPhraseology_6")
	  document.getElementById('basic-text-area').innerHTML = inDivPhraseologi_6;
	else if (otionValue == "inDivPhraseology_7")
	  document.getElementById('basic-text-area').innerHTML = inDivPhraseologi_7;
}; 


VT0blank2 = "";
VStatusP2_1 = "The License provided is not covered under the Driving License Verification Program of the Ministry of Labour, United Arab Emirates. The verification cannot be processed and the application has been closed.";
function VStatusP2(t) {
	var otionValue = t.value;
	if (otionValue == "0") {
	  document.getElementById('basic-text-main').innerHTML = VT0blank2;
	} else if (otionValue == "VT021")
	  document.getElementById('basic-text-main').innerHTML = VStatusP2_1;
};

VT0blank3 = "";
VStatusP3_1 = "Disturbed areas";
VStatusP3_2 = "Vacations";
VStatusP3_3 = "Lack of infrastructure";
VStatusP3_4 = "Natural Calamity";
VStatusP3_5 = "Others";
function VStatusP3(t) {
	var otionValue = t.value;
	if (otionValue == "0") {
	  document.getElementById('basic-text-main').innerHTML = VT0blank3;
	} else if (otionValue == "VT033")
	  document.getElementById('basic-text-main').innerHTML = VStatusP3_1;
	else if (otionValue == "VT034")
	  document.getElementById('basic-text-main').innerHTML = VStatusP3_2;
	else if (otionValue == "VT035")
	  document.getElementById('basic-text-main').innerHTML = VStatusP3_3;
	else if (otionValue == "VT036")
	  document.getElementById('basic-text-main').innerHTML = VStatusP3_4;
	else if (otionValue == "VT037")
	  document.getElementById('basic-text-main').innerHTML = VStatusP3_5;
};

VT0blank4 = "";
VStatusP4_1 = "The case needs to be closed as insufficient information - close case";
function VStatusP4(t) {
	var otionValue = t.value;
	if (otionValue == "0") {
	  document.getElementById('basic-text-main').innerHTML = VT0blank4;
	} else if (otionValue == "VT022")
	  document.getElementById('basic-text-main').innerHTML = VStatusP4_1;
};

VT0blank5 = "";
VStatusP5_1 = "This is out of scope application due to which the application need to be stopped";
function VStatusP5(t) {
	var otionValue = t.value;
	if (otionValue == "0") {
	  document.getElementById('basic-text-main').innerHTML = VT0blank5;
	} else if (otionValue == "VT020")
	  document.getElementById('basic-text-main').innerHTML = VStatusP5_1;
};

VT0blank6 = "";
VStatusP6_1 = "Partially Verified - Information provided by Applicant has been partially verified. Unable to verify, please enter components";
function VStatusP6(t) {
	var otionValue = t.value;
	if (otionValue == "0") {
	  document.getElementById('basic-text-main').innerHTML = VT0blank6;
	} else if (otionValue == "VT012")
	  document.getElementById('basic-text-main').innerHTML = VStatusP6_1;
};

VT0blank7 = "";
VStatusP7_1 = "NULL";
function VStatusP7(t) {
	var otionValue = t.value;
	if (otionValue == "0") {
	  document.getElementById('basic-text-main').innerHTML = VT0blank7;
	} else if (otionValue == "VT013")
	  document.getElementById('basic-text-main').innerHTML = VStatusP7_1;
};

VT0blank8 = "";
VStatusP8_1 = "Non-Cooperative Issuing Authority - Issuing Authority refuse to cooperate with the verification process and have declined all requests for verification of the applicant’s qualification";
VStatusP8_2 = "Miscellaneous: University refuses to provide any verification as the applicant has outstanding dues with the university.";
function VStatusP8(t) {
	var otionValue = t.value;
	if (otionValue == "0") {
	  document.getElementById('basic-text-main').innerHTML = VT0blank8;
	} else if (otionValue == "VT006")
	  document.getElementById('basic-text-main').innerHTML = VStatusP8_1;
	else if (otionValue == "VT029")
	  document.getElementById('basic-text-main').innerHTML = VStatusP8_2;
};

VT0blank9 = "";
VStatusP9_1 = "Problem countries- Issuing Authority Exists but cannot be contacted due to present circumstances. (To be elaborated Eg. Civil war, records burned etc.";
VStatusP9_2 = "Records not available- Issuing Authority only maintains records from the year XXXX. The applicant claims to have been awarded the submitted document prior to this date and as such it is not possible to verify the degree certificate";
VStatusP9_3 = "Records not available- The Issuing Authority could not be located, detailed research conducted revealed that the Issuing Authority has been closed down and there are no records available for verification";
VStatusP9_4 = "The issuing authority is located in an inaccessible/remote area and hence could not be contacted for verification";
VStatusP9_5 = "Insufficient information to process. Required documents/information not supplied by the applicant";
VStatusP9_6 = "Unable to Verify";
function VStatusP9(t) {
	var otionValue = t.value;
	if (otionValue == "0") {
	  document.getElementById('basic-text-main').innerHTML = VT0blank9;
	} else if (otionValue == "VT003")
	  document.getElementById('basic-text-main').innerHTML = VStatusP9_1;
	  else if (otionValue == "VT004")
	  document.getElementById('basic-text-main').innerHTML = VStatusP9_2;
	  else if (otionValue == "VT005")
	  document.getElementById('basic-text-main').innerHTML = VStatusP9_3;
	  else if (otionValue == "VT014")
	  document.getElementById('basic-text-main').innerHTML = VStatusP9_4;
	  else if (otionValue == "VT015")
	  document.getElementById('basic-text-main').innerHTML = VStatusP9_5;
	  else if (otionValue == "VT016")
	  document.getElementById('basic-text-main').innerHTML = VStatusP9_6;
};

VT0blank10 = "";
VStatusP10_1 = "Education has been verified by Name, Title of Issuing Authority Name on Date";
VStatusP10_2 = "Employment has been verified by Name, Title of Issuing Authority Name on Date";
VStatusP10_3 = "Health License has been verified by Name, Title of Issuing Authority Name on Date";
function VStatusP10(t) {
	var otionValue = t.value;
	if (otionValue == "0") {
	  document.getElementById('basic-text-main').innerHTML = VT0blank10;
	} else if (otionValue == "VT001")
	  document.getElementById('basic-text-main').innerHTML = VStatusP10_1;
	  else if (otionValue == "VT038")
	  document.getElementById('basic-text-main').innerHTML = VStatusP10_2;
	  else if (otionValue == "VT039")
	  document.getElementById('basic-text-main').innerHTML = VStatusP10_3;
};

VT0blank11 = "";
VStatusP11_1 = "Unaccredited Issuing Authority (Type 1) - Detailed checks conducted indicated that the Issuing Authority is not accredited by an accreditation agency recognized by the (Client name)";
VStatusP11_2 = "Misrepresented Documents / Details(Type 2) - Issuing Authority stated that they have no records of any individual with the name and/or details of the applicant in the year stated in the application form";
VStatusP11_3 = "This is verification comments2Beyond Verification Scope (Type 3) - The Documents/certificate provided is not covered under the Document Verification Program of the (Client Name). The verification cannot be processed and the application has been closed";
VStatusP11_4 = "Verified Negative";
VStatusP11_5 = "Under investigation by Authorities";
function VStatusP11(t) {
	var otionValue = t.value;
	if (otionValue == "0") {
	  document.getElementById('basic-text-main').innerHTML = VT0blank11;
	} else if (otionValue == "VT007")
	  document.getElementById('basic-text-main').innerHTML = VStatusP11_1;
	  else if (otionValue == "VT008")
	  document.getElementById('basic-text-main').innerHTML = VStatusP11_2;
	  else if (otionValue == "VT009")
	  document.getElementById('basic-text-main').innerHTML = VStatusP11_3;
	  else if (otionValue == "VT010")
	  document.getElementById('basic-text-main').innerHTML = VStatusP11_4;
	  else if (otionValue == "VT030")
	  document.getElementById('basic-text-main').innerHTML = VStatusP11_5;
};

VT0blank12 = "";
VStatusP12_1 = "Information verified by Name, Title, of “issuing authority name” with major discrepancy found in Dates of employment/Designation/Salary Information.";
function VStatusP12(t) {
	var otionValue = t.value;
	if (otionValue == "0") {
	  document.getElementById('basic-text-main').innerHTML = VT0blank12;
	} else if (otionValue == "VT011")
	  document.getElementById('basic-text-main').innerHTML = VStatusP12_1;
};

VT0blank13 = "";
VStatusP13_1 = "Information verified by Name, Title, of [issuing authority name] with minor discrepancy found in the dates of employment/ Designation/ Salary information";
function VStatusP13(t) {
	var otionValue = t.value;
	if (otionValue == "0") {
	  document.getElementById('basic-text-main').innerHTML = VT0blank13;
	} else if (otionValue == "VT002")
	  document.getElementById('basic-text-main').innerHTML = VStatusP13_1;
};


</script>
    <script src="scripts/vendor/fileinput.js"></script>