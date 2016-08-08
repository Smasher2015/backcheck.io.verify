<?php include ('include/config.php');
include ('include/config_actions.php');
$LEVEL=2;

$per_page = 2; 



  $url_raw = $_SERVER['REQUEST_URI'];
  $rr = str_replace("/verify/savvion_checks_listing.php?page=","",$url_raw);	
 $asdsa = str_replace("/","",$rr);
 
 if(isset($_POST['select_status']))
{
	$page_from_url = 1;
}
else
{
	$page_from_url = $asdsa;
}
 	
  $page = (int)(!isset($page_from_url) ? 1 : $page_from_url);
 if ($page <= 0) $page = 1;
 // Set how many records do you want to display per page.
 $startpoint = ($page * $per_page) - $per_page;
   
function paginationxxx($condition,$per_page=2,$page=1,$url='?'){   
global $db; 	
 
	$checks = $db->select("dataflow","*"," ".$condition." ORDER BY primid DESC");
	$total = mysql_num_rows($checks); 
     //$total = for_all_products_count();
     $adjacents = "2"; 
     $prevlabel = "&lsaquo; Prev";
     $nextlabel = "Next &rsaquo;";
     $lastlabel = "Last &rsaquo;&rsaquo;";
     $page = ($page == 0 ? 1 : $page);  
     $start = ($page - 1) * $per_page;                               
     $prev = $page - 1;                          
     $next = $page + 1;
     $lastpage = ceil($total/$per_page);
     $lpm1 = $lastpage - 1; // //last page minus 1
     $pagination = "";
     if($lastpage > 1){   
         $pagination .= "<ul class='pagination'>";
             if ($page > 1) $pagination.= "<li><a href='".SURL."savvion_checks_listing.php?page={$prev}'><i class='icon-arrow-left7'></i></a></li>";
         if ($lastpage < 7 + ($adjacents * 2)){   
             for ($counter = 1; $counter <= $lastpage; $counter++){
                 if ($counter == $page)
                     $pagination.= "<li><a class='current'>{$counter}</a></li>";
                 else
                     $pagination.= "<li><a href='".SURL."savvion_checks_listing.php?page={$counter}'>{$counter}</a></li>";                    
             }
         } elseif($lastpage > 5 + ($adjacents * 2)){
             if($page < 1 + ($adjacents * 2)) {
                 for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                     if ($counter == $page)
                         $pagination.= "<li><a class='current'>{$counter}</a></li>";
                     else
                         $pagination.= "<li><a href='".SURL."savvion_checks_listing.php?page={$counter}'>{$counter}</a></li>";                    
                 }
                 $pagination.= "<li class='dot'>...</li>";
                 $pagination.= "<li><a href='".SURL."savvion_checks_listing.php?page={$lpm1}'>{$lpm1}</a></li>";
 
            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                 $pagination.= "<li><a href='".SURL."savvion_checks_listing.php?page=1'>1</a></li>";
                 $pagination.= "<li><a href='".SURL."savvion_checks_listing.php?page=2'>2</a></li>";
                 $pagination.= "<li class='dot'>...</li>";
                 for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                     if ($counter == $page)
                         $pagination.= "<li><a class='current'>{$counter}</a></li>";
                     else
                         $pagination.= "<li><a href='".SURL."savvion_checks_listing.php?page={$counter}'>{$counter}</a></li>";                    
                 }
                 $pagination.= "<li class='dot'>..</li>";
                 $pagination.= "<li><a href='".SURL."savvion_checks_listing.php?page={$lpm1}'>{$lpm1}</a></li>";
             } else {
                 $pagination.= "<li><a href='".SURL."savvion_checks_listing.php?page=1'>1</a></li>";

                $pagination.= "<li><a href='".SURL."savvion_checks_listing.php?page=2'>2</a></li>";

                $pagination.= "<li class='dot'>..</li>";

                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {

                    if ($counter == $page)

                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                     else
                         $pagination.= "<li><a href='".SURL."savvion_checks_listing.php?page={$counter}'>{$counter}</a></li>";                    
                 }
             }
         }
             if ($page < $counter - 1) {
                 $pagination.= "<li><a href='".SURL."savvion_checks_listing.php?page={$next}'><i class='icon-arrow-right7'></i></a></li>";
             }

         $pagination.= "</ul>";        
     }
     return $pagination;
 } 


	if((isset($_REQUEST['select_status'])) && ($_REQUEST['select_status'] != ""))
	{
		$condition = "qa_status = ".$_REQUEST['select_status'];	
	}else{$condition = "1=1";}
 

 
?>

<head> <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="<?php echo SURL; ?>dashboard/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/core.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>dashboard/assets/css/colors.min.css" rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" href="<?php echo SURL; ?>styles/jquery.mCustomScrollbar.min.css">
    
    <link href="<?php echo SURL; ?>styles/proton.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SURL; ?>styles/bt_chcks.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
	<script> var SURL = "<?php echo SURL;?>";</script>
 <script type="text/javascript" src="<?php echo SURL;?>scripts/jquery-latest.js"></script>
 <script type="text/javascript" src="<?php echo SURL;?>js/jquery.scrollbar.min.js"></script>
 <script type="text/javascript">
jQuery(document).ready(function(){
   jQuery('.scrollbar-inner').scrollbar();
});
</script>
<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/loaders/blockui.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/core/libraries/jasny_bootstrap.min.js"></script>



<script src="<?php echo SURL; ?>js/ajax_script-2.js?ver=3.4"></script>
<script src="<?php echo SURL; ?>js/js_functions-2.js?ver=3.4"></script>
<script src="<?php echo SURL; ?>js/encoder.js?ver=3.4"></script>

<?php
if(isset($_REQUEST['edit'])){
	if(is_numeric($_REQUEST['check'])){
		$data = getInfo('dataflow',"id=$_REQUEST[check]");
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

						$editValue = $_REQUEST['check'];
						$uID = $_SESSION['user_id']; 

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
                
                
                 <div >
                     <div class="list-group-item">
                      <h2 class="box_head">Checks Listing</h2>
                      <form method="post">
                      <select name="select_status" id="select_status" onchange="this.form.submit()">
                      	<option value="">Select Status</option>
                      	<option value="0">New Checks</option>
                      	<option value="1">In Progress Checks</option>
                      	<option value="2">Completed Checks</option>
                      </select>
                      </form>
                      <script>$("#select_status").val(<?=$_REQUEST['select_status']?>);</script>
                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                          <th>ID</th>
                          <th>Component</th>
                            <th>Sub Barcode</th>
                            <th>Client Name</th>
                            <th>Applicant Name</th>
                            <th>Check Status</th>
                            <th>Scrap Date</th>
                            <th>Last Modify Date</th>
                             
                            <th width="60">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php	
						  
						  
						  
						/*if($LEVEL == 11 ){
							$checks = $db->select("dataflow","*","`status` = 2 AND is_active=1 ORDER BY id DESC");
						}
						elseif($LEVEL == 10 || $LEVEL == 3){
							
							$checks = $db->select("dataflow","*","(`status` = 1 || `status` = 2) AND is_active=1 AND user_id='$uID'  ORDER BY id DESC");
						}elseif($LEVEL == 13 ){
							$checks = $db->select("dataflow","*","`status` = 1 AND is_active=1 AND team_lead_id='$uID'  ORDER BY id DESC");
						}else{ */ 
						if((isset($_REQUEST['select_status'])) && ($_REQUEST['select_status'] != ""))
						{
							$condition = "qa_status = ".$_REQUEST['select_status'];
						}
						else
						{
							$condition = " 1=1";
						}
						//echo $condition.' conditionsxxx';
								$checks = $db->select("dataflow","*"," ".$condition." ORDER BY primid DESC LIMIT ".$startpoint.",".$per_page);// LIMIT 0,4");
						//}
                        if(mysql_num_rows($checks)>0){
                        while($check = mysql_fetch_array($checks)){ ?>
                           <tr>
                           <td><?=$check['primid'];?></td>
                           <td>
						   <?php
                           //$check['component'];
							if (preg_match('/ED/',$check['subbarcode'])){
								 
								$init = "Education";
								 
							}
							if (preg_match('/EM/',$check['subbarcode'])){
							 
							$init = "Employment";
							 
							}
							if (preg_match('/HL/',$check['subbarcode'])){
							 
							$init = "Health";
							 
							}
							echo $init;
						   
						   ?>
                           
                           </td>
                            <td><?=mb_convert_encoding($check['subbarcode'], 'HTML-ENTITIES','UTF-8');?></td>
                            <td style="text-align:left"><?=urlencode($check['clientname'])?></td>
                            <td><?=$check['applicantname']?></td>
                            <td><?php
							if($check['qa_status'] == 0){echo 'New Check';}
							else if($check['qa_status'] == 1){echo 'In Progress';}
							else if($check['qa_status'] == 2){echo 'Completed';}
							else {echo '-';}
							?></td>
                            <td><?=$check['scrapdate']?></td>
                            <td><?=$check['lastupdate']?></td>
                            <td align="center"><?php 
                                    ?>
                                    <a href="https://my.backcheck.io/workgroups/group/42/tasks/task/view/<?=$check['bitrixtid']?>" target="_blank" >View Task</a></td>
                          </tr>
                          <?php }}else{ ?>
                          <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td colspan="3"><h2 align="center">No Checks</h2></td>  <td></td><td></td><td></td>
                                 
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
        		</div>
                
                
            </div>
        
        
        
        	
        
        </div>
        
        <div class="pagination_area">
        	<?php echo paginationxxx($condition,$per_page,$page,$url='?');?>
        </div>
    </div>
</section>
     
    <?php 
		if($LEVEL==10 || $LEVEL==3){
			$inputSecurity = 1;
		}
		
	?>
  
  

 