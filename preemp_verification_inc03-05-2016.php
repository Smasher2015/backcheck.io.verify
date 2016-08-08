<!DOCTYPE html>
<html lang="en">
<?php include ('include/config.php');
include ('include/config_actions.php');
?><head> <meta charset="utf-8">
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
 	<!-- Core JS files -->
	<!-- /core JS files -->

	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/loaders/blockui.min.js"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>    
    
    <script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/core/libraries/jasny_bootstrap.min.js"></script>
   
    

<script src="<?php echo SURL; ?>js/ajax_script-2.js?ver=3.4"></script>
<script src="<?php echo SURL; ?>js/js_functions-2.js?ver=3.4"></script>
<script src="<?php echo SURL; ?>js/encoder.js?ver=3.4"></script>
        
        
        </head>
<?php


include ('include_pages/boxex_inc.php');

//."preemp_verification_inc.php?id=".base64_encode($lastinsertedID_foremail)."
$as_id = base64_decode($_REQUEST['id']);


 
 
$data = $db->select("add_data","*","as_id = ".$as_id." and d_type='multy'");
$vCheck = getCheck(0,0,$as_id);
$vData  = getVerdata($vCheck['v_id']);
$comInfo = getInfo("company","id=$vData[com_id]");
$sel = getData($as_id,'dmain');
$rs = @mysql_fetch_assoc($sel);
$CompanyName = $rs[d_value];
$allData =array();
$selDt = $db->select("emp_survey_draft","*","as_id= $as_id");
$rsDt = @mysql_fetch_assoc($selDt);
$allData = @explode(',',$rsDt[saved_data]);	


//var_dump($allData);
$msg = "";
if(isset($_POST['saveDraft'])){
	 
	$totalfields = count($_POST);
	$mydata = array();
	for($i = 1; $totalfields > $i; $i++)
	{ 
	
	 
	$yesorno = $_POST['YesNo_'.$i];
	$reason = $_POST['reasons_'.$i];
	if($yesorno){
	$mydata[$i] = $yesorno;
	}
	if($reason){
	$mydata[$i] = $reason;
	}
	
	 
		//$db->update("d_id=".$d_id."","add_data","d_value=".$yesorno."");
	 	
	 
	 
	 if($yesorno == "yes")
	 {
		 $setaction = 'True';
	 }
	 else if($yesorno == "no" )
		{
		 $setaction = $reason;
		}
	 else
		{
		 $setaction = '';
		}
		
	

 		}
	
	if(@mysql_num_rows($selDt)>0){
		echo "UPDATE emp_survey_draft SET saved_data='".implode(",",$mydata)."',dated=CURRENT_TIMESTAMP WHERE as_id=$as_id";
	if($db->update("saved_data='".implode(",",$mydata)."',dated=CURRENT_TIMESTAMP","emp_survey_draft","as_id=$as_id")){
	$msg = "success";
	$showMsg = "Draft Saved successfully.";
	}else{
	$msg = "err";
	$showMsg = "Unable to save draft.";	
	}
	 }else{
		// echo "INSERT INTO emp_survey_draft SET (as_id,saved_dat,dated), values($_POST[id],'".implode(",",$mydata)."',CURRENT_TIMESTAMP)"; exit;
	if($db->insert("as_id,saved_data,dated","'$as_id','".implode(",",$mydata)."',CURRENT_TIMESTAMP","emp_survey_draft")){
	$msg = "success";
	$showMsg = "Draft Saved successfully.";
	}else{
	$msg = "err";
	$showMsg = "Unable to save draft.";	
	}	 
	 }
	 
$selDt2 = $db->select("emp_survey_draft","*","as_id= $as_id");
$rsDt2 = @mysql_fetch_assoc($selDt2);
$allData = @explode(',',$rsDt2[saved_data]);	
}


 ?>


<style type="text/css">
     .reasons {display:none}
</style>

<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
<body>

<div id="main_container" class="main_container container_16 clearfix">

<section class="content">
<div style="margin:0 auto; width:80%;">
  
  <div class="panel panel-flat">
  <?php if($msg=='success'){
	  echo '<div class="alert alert-success no-border">
			<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
			
			<span class="text-semibold">'.$showMsg.'			
			</div>';
	}if($msg=='err'){
		echo '<div class="alert alert-danger no-border">
			<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
			<span class="text-semibold">Error!</span> '.$showMsg.'
			</div>';
		
	}?>
  
    <div class="panel-heading">
    	<h5 class="panel-title">HR Form</h5>
    </div>
    <div class="panel-body">
    <p class="mb-20"> I am contacting you on behalf of my client <span class="label bg-grey-800"><?php echo $comInfo[name];?></span>, to request you to provide us with the verification of the <span class="label bg-grey-800"><?php echo $vData[v_name];?></span>,  as a part of pre-employment screening process. I would appreciate if you could take a few minutes out of your schedule to confirm his employment at  <span class="label bg-grey-800"><?php echo $CompanyName;?></span>. as your input is greatly valued. </p>
    
<form method="post" >
 <div class="table-responsive">
<table class="table table-striped table-hover table-lg">
 
 <thead>
 	<th width="30%">Title</th>
    <th width="30%">Detail</th>
    <th width="15%">Correct/Incorrect</th>
	<th width="25%">&nbsp;</th>
 </thead>
 
 
<?php
$inc = 1;
$i = -1;
	while($result = mysql_fetch_array($data))
	{
$i++;		
?>



<tr><td align="left">
<div style="padding:18px;"><?php echo $result['d_mtitle']; ?></div></td>
<td align="left"><div align="left"><?php echo $result['d_stitle']; ?></div></td>

 
<td align="left">

<label><input type="radio" class="styled showhide_<?php echo $inc; ?>" 
<?php if($result['d_value'] == "yes" || ($allData[$i]=='yes')){ echo "checked"; } ?> name="YesNo_<?php echo $inc; ?>" value="yes" checked />Yes</label>

<label><input type="radio" class="styled showhide_<?php echo $inc; ?>" 
<?php if($result['d_value'] == "no" || ($allData[$i]!='yes' && $allData[$i]!='')){ echo "checked"; } ?> name="YesNo_<?php echo $inc; ?>" value="no" />No</label>

 <input type="hidden" name="d_id_<?php echo $inc; ?>" value="<?php echo $result['d_id']; ?>" />
<input type="hidden" name="fieldname_<?php echo $inc; ?>" value="<?php echo $result['d_mtitle']; ?>" />
<input type="hidden" name="fieldvalue_<?php echo $inc; ?>" value="<?php echo $result['d_stitle']; ?>" />
<?php
if($result['d_mtitle'] == 'select_company')
{
?>
<input type="hidden" name="companyID" value="<?php echo $result['d_stitle']; ?>" />
<?php
}
?>
 <script type="text/javascript">
	$(document).ready(function(){
	$(".showhide_<?=$inc?>").click(function () {
	if($(this).val()  == 'no'){ $('#reasons<?=$inc?>').fadeIn('slow')}else{ $('#reasons<?=$inc?>').fadeOut('slow');$("textarea[name=reasons_<?php echo $inc; ?>]").val('');}
	});});
</script>



</td>
<td align="left"><div align="left" id="reasons<?php echo $inc; ?>"  <?php echo ($allData[$i]!='yes' && $allData[$i]!='')?'':'style="display:none;"';?> >
<textarea name="reasons_<?php echo $inc; ?>" class="form-control" placeholder="Reason"><?php echo ($allData[$i]!='yes' && $allData[$i]!='')?$allData[$i]:'';?></textarea></div>
</td>
	 </tr>

 
	<?php $inc++;
    }
	?>

<tr><td colspan="4">

 <input type="submit" name="saveDraft" value="Save as draft" class="btn bg-danger pull-right ml-5" ><input type="submit" name="submit" value="Confirm &amp; Send" class="btn bg-success pull-right" >
 <input type="hidden" name="id" value="<?php echo base64_encode($as_id); ?>" />
</td></tr>
</table></div>
</form>
 </div>
  <div style="clear:both"></div> </div>
  
  </div>
</section>
  </div>


<?php /*?><script type="text/javascript">
$(document).ready(function(){
    $('#yesorno_<?php echo $inc; ?>').click(function(){
     alert("asdasdasd");   if($(this).attr("value")=="Yes"){
             
            $(".reasons").show();
        }
        else if($(this).attr("value")=="No"){
            $(".reasons").hide();
        }
		else
		{
			alert("Select Yes Or No")
		}
        
    });
});
</script>
<?php */?>
</body>

</html>