<?php

if(!empty($_POST["rating"]) && !empty($_POST["case"])) {

addRating($_POST["case"],$_POST["rating"]); exit;

}

if(!empty($_POST["cnic"]) && ($_POST["chk"]=='nic')) {

checkCnic($_POST["cnic"],0,$_POST["com_id"]); exit;

}
if(!empty($_POST["emp_id"]) && ($_POST["chk"]=='emp')) {

checkEmpId($_POST["emp_id"],0,$_POST["com_id"]); exit;

}

if(!empty($_POST["filter_what"]) && !empty($_POST["filter_by"])) {

saveFilter($_POST["filter_what"],$_POST["filter_by"],$_POST["com_id"]); exit;

}

if(!empty($_POST["rating"]) && !empty($_POST["check_id"])) {

addRatingOnCheck($_POST["check_id"],$_POST["rating"]); exit;

}

if( !empty($_POST["sub_inv"])) {

addInvoiceNumbers($_POST["checks"],$_POST["cost"],$_POST["invoice_number"],$_POST["is_tax"],$_POST["invoice_date"]);

}

if( !empty($_POST["getcheckname"])) {

getcheckname($_POST["getcheckname"],$_POST["savv_check_id"]);

}

if( (!empty($_POST["inv_id"])) && $_POST["upd"]==1) {

updatePaid($_POST["inv_id"],$_POST["com_id"],$_POST["paid"]);

}

if( (!empty($_POST["com_id"])) && $_POST["comupd"]==1) {

updateClientStatus($_POST["com_id"],$_POST["com_stauts"]);

}

if($_REQUEST["autosave_applicant"]==1) {

autoSaveApplicant($_POST);

}

if($_REQUEST["getclusers"]==1) {
$com_id = (int) $_REQUEST['com_id'];
getClUsersInDropDown($com_id);

}


if($_REQUEST["getlocusers"]==2) {
$com_id = (int) $_REQUEST['com_id'];
getClLocationInDropDown($com_id);

}

if( !empty($_POST["sub_req"])) {
$ids = (int)$_POST['uni_id'];

function getUnireq($ids){
	$sql = "SELECT * FROM `uni_degree` WHERE uni_id='".$ids."'";
	$data = mysql_query($sql);
	while($rows = mysql_fetch_array($data)){
	 $test =  '<option value="'.$rows['uni_id'].'">'.$rows['requirements'].'</option>';
	} 
		 echo $test;
}
	
echo getUnireq($ids);	
	
}

if($_REQUEST["getcredits"]==1 && $_REQUEST["com_id"]) {

echo getCredits($_REQUEST["com_id"]); exit;

}
 
if($_REQUEST["deleteloccomp"]==1) {
 //echo $_REQUEST['locid'];
 	 $db->delete("users_locations","loc_id=$_REQUEST[locid]");
		echo "Record Delete Successfully";
  exit;


}


if($_REQUEST['addnewcheckssingle'] == 'yes')
{ print_r($_REQUEST);
	 
	exit;
}



if($_REQUEST['caseactstream'] == 'yes')
{
	$activityquery = $db->select("activity","*","v_id = $_REQUEST[case]  order by a_date DESC LIMIT $_REQUEST[paginations]");	
	if(mysql_num_rows($activityquery))
	{
	while($rec = mysql_fetch_array($activityquery))
	{
		
   $getVerdata = getVerdata($rec['v_id']);
  $getCheck = getCheck('',$rec['v_id'],$rec['ext_id']); 
    if($rec['ext_id']){
	$checks = $db->select("checks","*","checks_id = $getCheck[checks_id]");
	$check =  mysql_fetch_assoc($checks);	
	$checkName = $check['checks_title'];
		if($rec['a_actn'] == 'remark')
		{
			$detail = "Manager Remarks On ".$checkName.".";
			$class = "icon-user-tie";
		}
		else if($rec['a_actn'] == 'close')
		{
			if($rec['a_type'] == 'case')
			{
				$detail = $getVerdata['v_name']." Case Close.";
			}
			else
			{
				$detail = $checkName." check Close.";
			}
			$class = "icon-user-tie";
		}
		else if($rec['a_actn'] == 'edit')
		{
			$detail = $checkName." Work in progress.";
			$class = "icon-info3";
		}
		else if($rec['a_type'] == 'pdf')
		{
			$detail = $checkName." Case Report Download.";
			$class = "icon-file-pdf";
		}
		else if($rec['a_type'] == 'notification')
		{
			$detail =  str_replace("id ".$rec['v_id'],$getVerdata['v_name'],$rec['a_info']);
			$class = "icon-googleplus5";
		}
		else if($rec['a_type'] == 'qastatus')
		{
			$detail = $rec['a_info'];
			$class = "icon-search4";
		} 
		else if($rec['a_type'] == 'insufficient')
		{
			$detail = $rec['a_info'];
			$class = "icon-accessibility";
		} 
		else
		{ 
			$detail = "";
			$class = "icon-checkmark4";
		}
 
		$time_diff = time_ago(strtotime($rec['a_date']));
	?>
    
        <li class="media">                
            <div class="media-left media-middle">
                <a href="#" class="btn bg-success-400 btn-rounded btn-icon btn-xs">
                <i class=" <?=$class?>"></i>
                </a>
            </div>
            
            <div class="media-body">
                <a href="#">
                <?=$checkName?>
                <span class="media-annotation pull-right"><?=$time_diff?></span>
                </a>
                <span class="display-block text-muted"><?php echo $detail; ?></span>
            </div>
        
        </li>
    
	<?php
 	}
	}
	}
	else
	{
		echo '<li class="media">No More Result</li>';
	}
	 

 }


function annouce_list(){
	    $limit=$_REQUEST['limit'];
		$postfields["action"] = "getannouncements";
		$postfields["limitstart"] =$limit-3;
		$postfields["limitnum"] = $limit;
		$xml=whmcs_api(WHMCS_APIURL,$postfields);
		$arr=whmcsapi_xml_parser($xml);
		$announcements=$arr['WHMCSAPI']['ANNOUNCEMENTS'];
		if($arr['WHMCSAPI']['TOTALRESULTS']>0){
		if(is_array($announcements)){
		foreach($announcements as $announcement){?>
		
       <div class="panel panel-body stack-media-on-mobile">
						<div class="media-left">
							<a href="http://backcheckgroup.com/support/announcements.php?id=<?=$announcement['ID']?>" class="btn btn-link btn-icon text-teal">
								<i class="icon-megaphone icon-2x no-edge-top"></i>
							</a>
						</div>

						<div class="media-body media-middle">
							<h6 class="media-heading text-semibold"><a href="http://backcheckgroup.com/support/announcements.php?id=<?=$announcement['ID']?>" target="_blank" class="text-default display-inline-block"><?=$announcement['TITLE']?></a></h6>
							<?=$announcement['ANNOUNCEMENT']?>
                            <div class="display-block"><?=date("d-M-Y H:i:s A",strtotime($announcement['DATE']))?></div>
						</div>

						<div class="media-right media-middle">
							<a href="http://backcheckgroup.com/support/announcements.php?id=<?=$announcement['ID']?>" class="btn bg-warning-400 btn-lg"><i class="icon-file-text position-left"></i> View Detail</a>
						</div>
					</div>
        
	<?php }}}
}




function activities_list_ajax()
	{ global $db,$LEVEL; 
		  				if($LEVEL==4)
						{ 
						$forclient = "$COMINF[id]"; 
						}
						else 
						{
							if($_REQUEST['compid'] != "")
							{
							$company_id = $_REQUEST['compid'];
							$forclient = "$company_id";
							 if($LEVEL==4){
							$for_subuser = "act.user_id=$_SESSION[user_id] AND ";} 
							}
							else{$forclient = "1";}
						}
						if(isset($_REQUEST['a_type']) && ($_REQUEST['a_type'] != '0'))
						{
							$particular_activity = "a_type = '$_REQUEST[a_type]' AND";
						}
						else{$particular_activity = "";}
if($_REQUEST['locid'] != '' && $_REQUEST['locid'] != '0')
{
$allids = getUseridsByLocationId($_REQUEST['locid'],$_REQUEST['comid']);
if(count($allids)>0){
$user_loc_ids = implode(",",$allids);
$as_uadd = " and vc.as_uadd IN ($user_loc_ids)";
$for_subuser = ""; 
}
}
						$tbls = "activity as act INNER JOIN ver_data as vd ON act.v_id=vd.v_id INNER JOIN ver_checks as vc ON act.v_id=vc.v_id";$cols = "*";
						$whre = "vd.com_id=$forclient AND $for_subuser $particular_activity act.ext_id <> '' and act.a_type <> 'login' AND vd.v_isdlt=0 AND vc.as_isdlt=0 $as_uadd $whr order by act.a_date DESC LIMIT $_REQUEST[limit],50";
						$activityquery = $db->select($tbls,$cols,$whre); 
						if(@mysql_num_rows($activityquery)>0){
						$count = 1;	
                        while($rec = mysql_fetch_array($activityquery))
                        {  
                      $getVerdata = getVerdata($rec['v_id']);
                      $getCheck = getCheck('',$rec['v_id'],$rec['ext_id']); 
                       $checks = $db->select("checks","*","checks_id = $getCheck[checks_id]");
                        $check =  mysql_fetch_assoc($checks);	
                        $checkName = $check['checks_title'];
                            if($rec['a_actn'] == 'remark')
                            {
                                $detail = "Manager Remarks On ".$checkName.".";
								$icon_class = "icon-user-tie";
								$icon_class_bg = "bg-indigo-300";
                            }
                            else if($rec['a_actn'] == 'close')
                            {
                                if($rec['a_type'] == 'case')
                                {
                                    $detail = $getVerdata['v_name']." Case Close.";
                                }
                                else
                                {
                                    $detail = $checkName." check Close.";
                                }
								$icon_class = "icon-user-tie";
								$icon_class_bg = "bg-success-300";
                            }
                            else if($rec['a_actn'] == 'edit')
                            {
                                $detail = $checkName." Work in progress.";
								$icon_class = "icon-info3";
								$icon_class_bg = "bg-slate-300";
                            }
                            else if($rec['a_type'] == 'pdf')
                            {
                                $detail = $checkName." Case Report Download.";
								$icon_class = "icon-file-pdf";
								$icon_class_bg = "bg-teal-300";
                            }
                            else if($rec['a_type'] == 'notification')
                            {
                                $detail =  str_replace("id ".$rec['v_id'],$getVerdata['v_name'],$rec['a_info']);
								$icon_class = "icon-googleplus5";
								$icon_class_bg = "bg-brown-300";
                            }
                            else if($rec['a_type'] == 'qastatus')
                            {
                                $detail = $rec['a_info'];
								$icon_class = "icon-search4";
								$icon_class_bg = "bg-pink-300";
                            }
							else if($rec['a_type'] == 'insufficient')
                            {
                                $detail = $rec['a_info'];
								$icon_class = "icon-search4";
								$icon_class_bg = "bg-warning-300";
                            }
                            else
                            { 
                                $detail = "No Content Available";
								$icon_class = "icon-checkmark4";
								$icon_class_bg = "bg-info-300";
                            }
                     $time_diff = time_ago(strtotime($rec['a_date']));
						if ($count % 2 == 0)
						{$odd_even_class = "post-even";}
						else{$odd_even_class = "";}	
						?>
                         <div class="timeline-row <?=$odd_even_class?>">
								<div class="timeline-icon">
									<div class="<?=$icon_class_bg?>">
										<i class="<?=$icon_class?>"></i>
									</div>
								</div>
								<div class="timeline-time">
									<a href="?action=details&case=<?php echo $rec['v_id'].'&_pid=81#check_tab_'.$rec['ext_id'];?>" target="_blank"><?=$checkName?></a>  
									<span class="text-muted"><?=$time_diff?></span>
								</div>
                                <div class="panel panel-flat timeline-content <?=$icon_class_bg?>">
									<div class="panel-heading">
										<span class="panel-title"><?=$detail?></span>
									</div>									
								</div>
							</div>
                            <div class="timeline-date text-muted"><?php
$timestamp = date("Y.m.d H:i",strtotime($rec['a_date']));

$today = new DateTime(); // This object represents current date/time
$today->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison

$match_date = DateTime::createFromFormat( "Y.m.d H:i", $timestamp );
$match_date->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison

$diff = $today->diff( $match_date );
$diffDays = (integer)$diff->format( "%R%a" ); // Extract days count in interval

switch( $diffDays ) {
    case 0:
        echo "Today";
        break;
    case -1:
        echo "Yesterday";
        break;
    /*case +1:
        echo "//Tomorrow";
        break;*/
    default:
        echo $timestamp;
}

?>   </div>
                        <?php
                        $count++;
						}
 		 			}
						if($LEVEL==2)
						{  
							if($_REQUEST['comid'] != "")
							{
							$company_id = $_REQUEST['comid'];
							}
							else{
								$company_id = "1";
							}
							$forcom_or_user = "u.com_id = $company_id";
						 }
						else
						{
							$forcom_or_user = "act.user_id = $_SESSION[user_id]";
						}
						$tbls_login = "activity as act INNER JOIN users as u ON act.user_id=u.user_id";
						$cols_login = "*"; 
						$whre_login = "act.a_type = 'login' and $forcom_or_user order by a_date DESC LIMIT $_REQUEST[limitlogin],20";
						$activityquery_login = $db->select($tbls_login,$cols_login,$whre_login);
						// echo "SELECT * FROM $tbls_login where $whre_login";
						 if(@mysql_num_rows($activityquery_login)>0){
						$counts = 1;	
                        while($rec = mysql_fetch_array($activityquery_login))
                        {  
						 $time_diff = time_ago(strtotime($rec['a_date']));
						 
                                $detail = "Login at".$time_diff;
								$icon_class = "icon-checkmark4";
								$icon_class_bg = "bg-info-300";
                         if ($counts % 2 == 0)
						{$odd_even_class = "post-even";}
						else{$odd_even_class = "";}	
						?>
                         <div class="timeline-row <?=$odd_even_class?>">
								<div class="timeline-icon">
									<div class="<?=$icon_class_bg?>">
										<i class="<?=$icon_class?>"></i>
									</div>
								</div>
									<div class="timeline-time">
									<a href="javascript:void(0);"><?=$rec['first_name'].' '.$rec['first_name']?></a>  
									<span class="text-muted"><?=$time_diff?></span>
								</div>

								<div class="panel panel-flat timeline-content <?=$icon_class_bg?>">
									<div class="panel-heading">
										<span class="panel-title"><?=$detail?></span>
									</div>									
								</div>
							</div>
                            <div class="timeline-date text-muted"><?php
$timestamp = date("Y.m.d H:i",strtotime($rec['a_date']));

$today = new DateTime(); // This object represents current date/time
$today->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison

$match_date = DateTime::createFromFormat( "Y.m.d H:i", $timestamp );
$match_date->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison

$diff = $today->diff( $match_date );
$diffDays = (integer)$diff->format( "%R%a" ); // Extract days count in interval

switch( $diffDays ) {
    case 0:
        echo "Today";
        break;
    case -1:
        echo "Yesterday";
        break;
    /*case +1:
        echo "//Tomorrow";
        break;*/
    default:
        echo $timestamp;
}

?>   </div>
                        <?php
                        $counts++;
						}
 		 			}
		}







if($_REQUEST['followup_listing_savv'] == 'yes')
{
	followup_listing_savv();
}


if($_REQUEST['followup_listing_loc'] == 'yes')
{
	followup_listing_loc();
}





function followup_listing_savv(){  
	global $db,$LEVEL;
	 
	$limit = $_REQUEST['limit']-10;

	$searchfield = urlencode($_REQUEST['searchword']);
	$searchby = $_REQUEST['searchby'];
	
	// echo "select * from records where 1=1 LIMIT $limit,10";
	if($searchfield != "nosearch" && $searchby == "noby")
	{
		//$searchfield = urlencode($_REQUEST['searchword']);
		 $where = "and subbarcode LIKE '%".$searchfield."%' OR EMP_IA_Name LIKE '%".$searchfield."%'  
 OR HLT_ia_name LIKE '%".$searchfield."%'  OR EDU_ia_name LIKE '%".$searchfield."%' OR applicantname LIKE '%".$searchfield."%'";
 	}
	else if($searchfield != "nosearch" && $searchby != "noby")
	{

	if($searchby == "subbarcode")
	{
	$where = "and subbarcode LIKE '%".$searchfield."%'";
	
	}
	else if($searchby == "ianame")
	{
	$where = "and EMP_IA_Name LIKE '%".$searchfield."%' OR HLT_ia_name LIKE '%".$searchfield."%'  OR EDU_ia_name LIKE '%".$searchfield."%'";
	}
	else if($searchby == "applicantname")
	{
	$where = "and applicantname LIKE '%".$searchfield."%'";
	}

			 
	}	
	else
	{
		$where = "";
 	}
	
	$records = $db->select("records","*","1=1 $where LIMIT $limit,10");
// echo "select * from records where 1=1 $where LIMIT $limit,10";
 	$inc = $limit+1;
	if(mysql_num_rows($records) > 0)
	{
    while($savvion = mysql_fetch_array($records))
	{
			switch($savvion['component']){
				case "education":
				$ia_name = urldecode($savvion['EDU_ia_name']);
				$qualification = urldecode($savvion['EDU_QualificationSelect_Ver']); 
				$history = urldecode($savvion['EDU_history']); 
				$component = "EDU_"; 
				break;
				case  "employment":
				$ia_name = urldecode($savvion['EMP_IA_Name']);
				$qualification = "-"; 
				$history = urldecode($savvion['EMP_history']); 
				$component = "EMP_"; 
				break;
				case "healthlicense":
				$ia_name = urldecode($savvion['HLT_ia_name']);
				$qualification = "-";
				$history = urldecode($savvion['HLT_history']);
				$component = "HLT_"; 
				break;
				default:
				$ia_name = "";
				$qualification = "-"; 
				$history = "-"; 
				$component = ""; 
			}
		
	?>
	<tr>
    	<td id="record_list_<?=$savvion['primid']?>">
        <input type="checkbox" name="select[]" id="checkid[]" class="cheks savchecks checksingle_sav_<?=$savvion['primid']?>" value="<?=$savvion['primid']?>"/>
        </td>
    	<td><?=$inc?></td>
    	<td><?=$savvion['subbarcode']?></td>
    	<td><?=$ia_name?></td>
    	<td><?=urldecode($savvion['applicantname'])?></td>
        <td><?=$qualification?></td>
    	<td><?=date("d-m-Y",strtotime($savvion['Timestamp']))?></td>
        <td><textarea readonly="readonly"><?php if($history != "" && $history != '-'){echo $history;}else{echo '-';}?></textarea></td>
        <td><textarea id="intrcmnt_<?=$savvion['primid']?>" name="intrcmnt_<?=$savvion['primid']?>"><?=$savvion['InsufficiencyComment']?></textarea>
        </td>
        <td><textarea readonly="readonly"><?php if($history != "" && $history != '-'){echo $history;}else{echo '-';}?></textarea></td>
     	<td><textarea name="extrnlcmnt_<?=$savvion['primid']?>" id="extrnlcmnt_<?=$savvion['primid']?>"><?=$savvion['extra_qc_comments']?></textarea></td>
    	<td>
        <input type="hidden" name="checkcomponent_<?=$savvion['primid']?>" id="check_comp_<?=$savvion['primid']?>" value="<?=$component?>"  />
        <input type="button" onclick="submitsinglerecord(<?=$savvion['primid']?>,'savv_sing');" name="singleupdate" value="Submit" /></td>
    </tr>
	<?php
	$inc++;
	}
	}
	else
	{
		echo '';
	}
	 
	 

}



function followup_listing_loc(){  
	global $db,$LEVEL;
	 
	$limit = $_REQUEST['limit']-10;

	$searchfield_loc = urlencode($_REQUEST['searchword']);
 	
	// echo "select * from records where 1=1 LIMIT $limit,10";
	if($searchfield_loc != "nosearch")
	{
 		 $where = "and vc.as_bcode LIKE '%".$searchfield_loc."%' OR ui.uni_Name LIKE '%".$searchfield_loc."%'";
 	}
 	else
	{
		$where = "";
 	}
	
		$tabl = "ver_checks vc INNER JOIN add_data ad ON vc.as_id=ad.as_id INNER JOIN ver_data vd ON vc.v_id=vd.v_id INNER JOIN uni_info ui ON vc.as_uni=ui.uni_id";
		$cols = "*";
		$selRoles = $db->select($tabl,$cols,"vc.as_vstatus='Followup' $where AND vc.checks_id=1 AND vc.as_uni <> 0 AND vc.as_isdlt = 0 AND vd.v_isdlt = 0 AND vc.as_status <> 'Close' GROUP BY vc.as_id ORDER BY vc.as_addate DESC LIMIT $limit,10");
  /*echo "select * from ver_checks vc INNER JOIN add_data ad ON vc.as_id=ad.as_id INNER JOIN ver_data vd ON vc.v_id=vd.v_id INNER JOIN uni_info ui ON vc.as_uni=ui.uni_id where vc.as_vstatus='Followup' $where AND vc.checks_id=1 AND vc.as_uni <> 0 AND vc.as_isdlt = 0 AND vd.v_isdlt = 0 GROUP BY vc.as_id ORDER BY vc.as_id DESC LIMIT $limit,10";*/
 	$inc = $limit+1;
	if(mysql_num_rows($selRoles) > 0)
	{

    while($savvion = mysql_fetch_array($selRoles))
	{ 
$add_data = $db->select("add_data","*","as_id = ".$savvion['as_id']." and d_type='followup'");	
$flw_ups = mysql_fetch_array($add_data);
 	
	?>
	<tr>
    	<td id="record_list_<?=$savvion['as_id']?>">
        <input type="checkbox" name="select_loc[]" id="checkid[]" class="cheks locchecks checksingle_loc_<?=$savvion['as_id']?>" value="<?=$savvion['as_id']?>"/>
        </td>
    	<td><?=$inc?></td>
    	<td><?=$savvion['as_bcode']?></td>
    	<td><?=$savvion['uni_Name']?></td>
        <td><?=getDaysFromDates(date("Y-m-d"),$savvion['as_addate'],$savvion['com_id']);?></td>
        <td><?=urldecode($savvion['as_vstatus'])?></td>
    	<td><textarea readonly="readonly"><?=$flw_ups['d_value']?></textarea></td>
    	<td><textarea name="followups_ins_<?=$savvion['as_id']?>"></textarea></td>

    	
        
    	<td><?=date("m-d-Y",strtotime($savvion['as_addate']))?></td>
        
        
    	<td><input type="button" onclick="submitsinglerecord(<?=$savvion['as_id']?>,'loc_sing');" name="singleupdate" value="Submit" /></td>
    </tr>
	<?php
	$inc++;
	}


	}
	else
	{
		echo '';
	}
	 
	 

}



if($_REQUEST['annouce_list'] == 'yes')
{
	annouce_list();
}


if($_REQUEST['ticket_list'] == 'yes')
{
	ticket_list();
}


if($_REQUEST['activities_list'] == 'yes')
{
	activities_list_ajax();
}


if($_REQUEST['dashactstream'] == 'yes')
{
	$todate = $_REQUEST['todate'];
	$dayname = $_REQUEST['dayname'];
	$com_id = $_REQUEST['comid'];
	$cnt = $_REQUEST['cnt'];
	$paginations = $_REQUEST['paginations'];
	$apd = $_REQUEST['apd'];
	
	echo getLiveUpdates($com_id,$todate,$dayname,$cnt,$paginations,$apd); exit;

}


if($_REQUEST['add_opentickets']=='yes')
{
	//print_r($_REQUEST); die;
 // OPEN TICKET  STRAT //
   $getUserInfo = getUserInfo($_SESSION['user_id']); 

	$ticketsubject = $_REQUEST['ticketsub'];
	$inputpriority = $_REQUEST['inputpriority'];
	$ticketmessage = $_REQUEST['ticketmessage'];
 	
$postdata = array(
    'action' => 'OpenTicket',
    'clientid' => $getUserInfo['whmcs_clid'],
    'deptid' => '1',
    'subject' => $ticketsubject,
    'message' => $ticketmessage,
    'priority' => $inputpriority,
);
  $URL= WHMCS_APIURL;

$xml=whmcs_api($URL,$postdata);
$arr = whmcsapi_xml_parser($xml);
//print_r($arr);

	if($arr['WHMCSAPI']['RESULT'] == "success")
	{
		echo '<div class="alert alert-success"><strong>Success!</strong> Ticket Add Successfully.</div>';
		msg('sec',"Ticket Add Successfully.");
	}
	else	
	{
		echo '<div class="alert  alert-danger"><strong>Error! </strong> Failed to Add Ticket.</div>';
		msg('err',"Failed to Ticket Add.");
	}	
  
 
 // OPEN TICKET  END //
 
 
 
	
}
// by ata 
if($_REQUEST['uni_req_documents']=='yes')
{
	$activityquery = $db->select("uni_info","uni_req","uni_id='$_REQUEST[uni_id]'"); 
	$data = mysql_fetch_array($activityquery);
	echo '<p>'.$data['uni_req'].'</p>';
}

// by khl 

if($_REQUEST['get_dashboard_data']==1 && $_REQUEST['com_id']!="" ){
	
	$company_id = (int) $_REQUEST['com_id'];
	
	$act = $_REQUEST['act'];
	
	function campaignDonut($company_id){
	$data = array();
	$eduCheks = str_replace(',','',count_Checks_By_Client($company_id,$whr="checks_id=1"));
	$empCheks = str_replace(',','',count_Checks_By_Client($company_id,$whr="checks_id=2"));
	$dbCheks = str_replace(',','',count_Checks_By_Client($company_id,$whr="checks_id NOT IN (1,2)"));
	$opnCase = str_replace(',','',count_Case_By_Client($company_id,$whr="v_status!='Close'"));
	$cmpCase = str_replace(',','',count_Case_By_Client($company_id,$whr="v_status='Close'"));
	//$empChekscls = str_replace(',','',count_Checks_By_Client($company_id,$whr="checks_id=2 AND as_status='Close'"));
	//$dbChekscls = str_replace(',','',count_Checks_By_Client($company_id,$whr="checks_id NOT IN (1,2) AND as_status='Close'"));
	$data['ttl'][] = array(
	
                "browser"=> "Education Checks",
                "icon" => "<i class='icon-database-check position-left'></i>",
                "value" => $eduCheks,
                "color" => "#66BB6A"
				);
	$data['ttl'][] = array(
	
                "browser" => "Employment Checks",
                "icon" => "<i class='icon-database-check position-left'></i>",
                "value" => $empCheks,
                "color" => "#9575CD"
				);
	$data['ttl'][] = array(
	
                "browser" => "Database Checks",
                "icon" => "<i class='icon-database-check position-left'></i>",
                "value" => $dbCheks,
                "color" => "#FF7043"
				);
				
	$data['dif'][] = array(
	            "status" => "Pending Applicants",
                "icon" => "<span class='status-mark border-blue-300 position-left'></span>",
                "value" => $opnCase,
                "color" => "#29B6F6"
				);
				
	$data['dif'][] = array(
	
                "status" => "Completed Applicants",
                "icon" => "<span class='status-mark border-blue-300 position-left'></span>",
                "value" => $cmpCase,
                "color" => "#81C784"
				);	
               
           	
	echo  json_encode($data); exit;
	}
	if(	$act == 'campaignDonut'){
	campaignDonut($company_id);
	}
}

if(isset($_REQUEST['loadmore_timeline_dash'])){
	
	loadmore_timeline_dash();
}



