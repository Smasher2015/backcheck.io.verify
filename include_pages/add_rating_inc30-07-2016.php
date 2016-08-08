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

function ticket_list(){
	
	if($LEVEL == 4)
{
  $user_id = $_SESSION['user_id']; 
}
else
{
  $user_id =  $_REQUEST['userid']; 
}
  $getUserInfo = getUserInfo($user_id); 

	
	
 	    $limit=$_REQUEST['limit'];  
 		$postfields["action"] = "gettickets";
		$postfields["limitstart"] =$limit-10;
		$postfields["limitnum"] = 10;
		$postfields["clientid"] = $getUserInfo['whmcs_clid'];
		$postfields["email"] = $getUserInfo['email'];

		$xml=whmcs_api(WHMCS_APIURL,$postfields);
		$arr=whmcsapi_xml_parser($xml);
		//print_r($postfields);
		$tickets=$arr['WHMCSAPI']['TICKETS'];
		if($arr['WHMCSAPI']['TOTALRESULTS']>0){
		if(is_array($tickets)){
		foreach($tickets as $val){
//$time_diff = time_ago(strtotime($val['DATE']));
$time_diff = dateTimeExe($val['DATE']);

$tick_id = $val['ID'];
?> 
                                            
   								<tr>
									<td><h6 class="no-margin"><?=$time_diff?></h6></td>
					                <td>
                                    <div class="media-left media-middle">
														<a href="#" class="btn bg-teal-400 btn-rounded btn-icon btn-xs">
															<span class="letter-icon"><?=substr($val['NAME'],0,1)?></span>
														</a>
                                                        
													</div>
					                	<div class="text-semibold"> <a href="?action=singleticket&atype=view&ticketID=<?=$tick_id?>" target="_blank"><?=$val['SUBJECT']?></a>
                                        <div class="text-muted text-size-small">
                                
                             </div></div>
                                     
					                 
					                </td>
                                    <td>
					                	<div class="text-muted"><?=$val['PRIORITY']?></div>
				                	</td>
					                <td>
					                	 
					                	<div class="btn-group">
                                         <?php 
												
												if($val['STATUS'] == 'Answered'){
														$staus_color = 'bg-danger';
												}elseif($val['STATUS'] == 'Open'){
													$staus_color = 'bg-blue-400';
												}else{
													$staus_color = 'bg-success-400';
												}
												?>                                                
                                                <span class="label <?php echo $staus_color ?>"><?= $val['STATUS']?></span>
										</div>
					                </td>
					                
					                 
					                
					               
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu9"></i></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"  data-toggle="modal" data-target="#exampleModal<?=$tick_id?>" ><i class="icon-undo"></i> Quick reply</a></li>
												</ul>
											</li>
										</ul>
                                        
                                        
                                        
                                        <div class="modal fade" id="exampleModal<?=$tick_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Reply To <?=$val['NAME']?></h4>
      </div>
      <div class="modal-body">
        <form method="post">
           <input type="hidden" class="form-control" name="ticketid" value="<?=$tick_id?>" >
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" name="replymessage" required id="message-text"></textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="submitreply" class="btn btn-primary" value="Send message"> 
      </div>
        </form>
         
      </div>
     
    </div>
  </div>
</div>
                                        
									</td>
					            </tr>

                                  
 <?php
}}}else{echo '1';}
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
	
	if(	$act == 'campaignDonut'){
	campaignDonut($company_id);
	}
}

if(isset($_REQUEST['loadmore_timeline_dash'])){
	
	loadmore_timeline_dash();
}


if($_REQUEST['missystem'] == "yes")
{
	
	// add record 1st time enterred 
	if(isset($_REQUEST['add']) && ($_REQUEST['add'] == "yes")){
	$error_found = false;
		$array = array();
		//print_r($_REQUEST);
		$barcode = $_REQUEST['barcode'];
		$insertIDx = $_REQUEST['insertID'];
	 
		$receivdate = $_REQUEST['receivdate'];
		$checksource = $_REQUEST['checksource'];
		//$subcat_df = $_REQUEST['subcat_df'];
		//$subcat_local = $_REQUEST['subcat_local'];
		$barcode = $_REQUEST["barcode"]; 
		$clientname = $_REQUEST['clientname'];
		$candidatename = $_REQUEST['candidatename'];
		$componenets = $_REQUEST['componenets'];
		$status = $_REQUEST['status'];
		$age = $_REQUEST['age'];
		$ianame = $_REQUEST['ianame'];
		$qualification_detail = $_REQUEST['qualification_detail'];
		$fathername = $_REQUEST['fathername'];
		$cnicnum = $_REQUEST['cnicnum'];
		$closeddate = $_REQUEST['closeddate'];
		$closedtat = $_REQUEST['closedtat'];
		$rollnum = $_REQUEST['rollnum'];
		$ddamount = $_REQUEST['ddamount'];
		$ddnumber = $_REQUEST['ddnumber'];
		$letter_ref_num = $_REQUEST['letter_ref_num'];
		$sent_date = $_REQUEST['sent_date'];
		$followup1 = $_REQUEST['followup1'];
		$followup2 = $_REQUEST['followup2'];
		$followup3 = $_REQUEST['followup3'];
		$followup4 = $_REQUEST['followup4'];
		$followup5 = $_REQUEST['followup5'];
		$couriercompany = $_REQUEST['couriercompany'];
		$couriernumber = $_REQUEST['couriernumber'];
		$mdate = ($_REQUEST['mdate']!='0000-00-00 00:00:00' && $_REQUEST['mdate']!='')?$_REQUEST['mdate']:date('Y-m-d H:i:s');
		$mtime = ($_REQUEST['mtime']!='00:00:00' && $_REQUEST['mtime']!='')?$_REQUEST['mtime']:date('H:i:s');
	
	
	if($candidatename=='' || $candidatename=='-'){
	if(!empty(trim($barcode)) && trim($barcode)!='-'){
		
	 $sql_query = $db->select("`mis_management_system`","*"," barcode = '".$barcode."' AND is_dlt=0 ");
	  
		if(@mysql_num_rows($sql_query)>0){
		$array['err'] = 'This barcode already exists!';
		$error_found = true;
		echo json_encode($array); exit;		
		}else{
			
		if($checksource == "Savvion" || $checksource == "Veriflow" || $checksource == "DF-Offline")
		{
			// SAVVION CHECKS
			
			if (preg_match('/ED/',$barcode)){
 			$init = "EDU_ia_name";
 			}
			if (preg_match('/EM/',$barcode)){
 			$init = "EMP_IA_Name";
 			}
			if (preg_match('/HL/',$barcode)){
 			$init = "HLT_ia_name";
 			}	
			
	
	$as_bcode =  $db->select("`records`","applicantname AS 'v_name',clientname as 'Client',component AS 'checks_title', ".$init." as 'ia_name'"," subbarcode='".$barcode."' ");
	//echo "SELECT applicantname AS 'v_name',clientname as 'Client',component AS 'checks_title', ".$init." as 'ia_name' FROM `records` where subbarcode='".$barcode."' "; exit;
	$countbcode = @mysql_num_rows($as_bcode);
		if($countbcode > 0)
			{
		
				
				$mysql_fetch_array = @mysql_fetch_assoc($as_bcode);

		$ia_name = ucwords(strtolower(urldecode($mysql_fetch_array['ia_name'])));
		$array = array(
					"v_name" => urldecode($mysql_fetch_array['v_name']),
					"Client" => urldecode($mysql_fetch_array['Client']),
					"checks_title" => urldecode(ucwords($mysql_fetch_array['checks_title'])),
					"ia_name" => $ia_name,
					"v_nic" => "-",
					"v_ftname" => "-",
					"err" => "",
					"msg" => "Barcode found"
 					);
			}else{
			$array = array(
					"v_name" => 'N/A',
					"Client" => 'N/A',
					"checks_title" => 'N/A',
					"ia_name" => 'N/A',
					"v_nic" => "'N/A'",
					"v_ftname" => "'N/A'",
					"err" => "Barcode not found",
					"msg" => "Barcode not found"
 					);	
			}
		
		} 
		
		else if($checksource == "LO-Offline" || $checksource == "Bitrix")
		
		{
				
			// LOCAL CHECKS
	//$sql = "SELECT v_name,c.name as 'Client',checks_title,v_ftname,v_nic,uni_Name as 'ia_name' FROM `ver_checks` vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id INNER JOIN company c ON c.id=vd.com_id INNER JOIN checks cc ON cc.checks_id = vc.checks_id LEFT JOIN uni_info ui ON ui.uni_id = vc.as_uni	 WHERE as_bcode='".$barcode."'";
	 //echo $sql; exit;
	
	$as_bcode = $db->select("`ver_checks` vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id INNER JOIN company c ON c.id=vd.com_id INNER JOIN checks cc ON cc.checks_id = vc.checks_id 
	LEFT JOIN uni_info ui ON ui.uni_id = vc.as_uni","v_name,c.name as 'Client',checks_title,v_ftname,v_nic,uni_Name as 'ia_name'"," as_bcode='".$barcode."' ");
	
	$countbcode = @mysql_num_rows($as_bcode);
			if($countbcode > 0)
			{
				
				$mysql_fetch_array = @mysql_fetch_assoc($as_bcode);
						
					$clientname = $mysql_fetch_array['Client'];
					$candidatename = $mysql_fetch_array['v_name'];
					$componenets =  $mysql_fetch_array['checks_title'];
					$ianame =  $mysql_fetch_array['ia_name'];
					$cnicnum =  $mysql_fetch_array['v_nic'];
					$fathername=  $mysql_fetch_array['v_ftname'];
					$array = array(
					"v_name" => $candidatename,
					"Client" => $clientname,
					"checks_title" => $componenets,
					"ia_name" => $ianame,
					"v_nic" => $cnicnum,
					"v_ftname" => $fathername,
					"err" => "Barcode found",
					"msg" => "Barcode found"
					);
 			
			//echo json_encode($array);
			$error_found = false;	
				
			}
			else
			{
			$array = array(
					"v_name" => 'N/A',
					"Client" => 'N/A',
					"checks_title" => 'N/A',
					"ia_name" => 'N/A',
					"v_nic" => "'N/A'",
					"v_ftname" => "'N/A'",
					"err" => "Barcode not found",
					"msg" => "Barcode not found"
 					);	
			//echo json_encode($array);
			$error_found = false;
			
			}
			
		
			
		}
				
			
		
			
		}
		
		
	 
	 }
	
	}
	
	
		
	if(empty(trim($checksource)) || trim($checksource)=='-'){
	 $array['err'] = 'Select Check Source';
	 
	 $error_found = true;
	 echo json_encode($array); exit;
	 }  else if(empty(trim($barcode)) || trim($barcode)=='-'){
	 $array['err'] = 'Type barcode';
	 $error_found = true;
	 echo json_encode($array); exit;
	
	 } 
	 
	 else if(empty(trim($clientname)) || trim($clientname)=='-'){
	 $array['err'] = 'Type client name';
	 $error_found = true;
	  echo json_encode($array); exit;
	 } else if(empty(trim($candidatename)) || trim($candidatename)=='-'){
	 $array['err'] = 'Type candidate name';
	 $error_found = true;
	  echo json_encode($array); exit;
	 } else if(empty(trim($componenets)) || trim($componenets)=='-'){
	 $array['err'] = 'Select components';
	 $error_found = true;
	  echo json_encode($array); exit;
	 } else if(empty(trim($status)) || trim($status)=='-'){
	 $array['err'] = 'Select status';
	 $error_found = true;
	  echo json_encode($array); exit;
	 } else if(empty(trim($ianame)) || trim($ianame)=='-'){
	 $array['err'] = 'Select/Type  IA name';
	 $error_found = true;
	  echo json_encode($array); exit;
	 } else if(empty(trim($qualification_detail)) || trim($qualification_detail)=='-'){
	 $array['err'] = 'Type  qualification detail';
	 $error_found = true;
	  echo json_encode($array); exit;
	 } else {
		
	 if(!$error_found){
		 
 		$array['err'] = '';
		
		if($checksource == "Savvion" || $checksource == "Veriflow" || $checksource == "DF-Offline")
		{
			// SAVVION CHECKS
			
			if (preg_match('/ED/',$barcode)){
 			$init = "EDU_ia_name";
 			}
			if (preg_match('/EM/',$barcode)){
 			$init = "EMP_IA_Name";
 			}
			if (preg_match('/HL/',$barcode)){
 			$init = "HLT_ia_name";
 			}	
	
			
	$sql = "SELECT applicantname AS 'v_name',clientname as 'Client',component AS 'checks_title',".$init." as 'ia_name' FROM `records` WHERE subbarcode='".$barcode."'";
	$as_bcode = mysql_query($sql);
	$countbcode = mysql_num_rows($as_bcode);
			if($countbcode > 0)
			{
				$array2 = array("err" => "","msg" => "");
				$mysql_fetch_array = mysql_fetch_assoc($as_bcode);

		$ia_name = ucwords(strtolower(urldecode($mysql_fetch_array['ia_name'])));

					//if (preg_match('/OF/',$ia_name)){
 			$ia_name = str_replace("OF","of",$ia_name);
 			$ia_name = str_replace("Of","of",$ia_name);
 			//}


					$dd = array(
					"v_name" => urldecode($mysql_fetch_array['v_name']),
					"Client" => urldecode($mysql_fetch_array['Client']),
					"checks_title" => urldecode(ucwords($mysql_fetch_array['checks_title'])),
					"ia_name" => $ia_name,
					"v_nic" => "-",
					"v_ftname" => "-" 
 					);
					
					$clientname = $mysql_fetch_array['Client'];
					$candidatename = $mysql_fetch_array['v_name'];
					$componenets =  $mysql_fetch_array['checks_title'];
					$ianame =  $ia_name;
					


				$arraynewxx = array_merge($dd,$array2);
				//echo json_encode($arraynewxx);
			}
			
			$subcat_sou = "DF";
		} 
		else if($checksource == "LO-Offline" || $checksource == "Bitrix")
		{
			// LOCAL CHECKS
	$sql = "SELECT v_name,c.name as 'Client',checks_title,v_ftname,v_nic,uni_Name as 'ia_name' FROM `ver_checks` vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id INNER JOIN company c ON c.id=vd.com_id INNER JOIN checks cc ON cc.checks_id = vc.checks_id 
	LEFT JOIN uni_info ui ON ui.uni_id = vc.as_uni
	 WHERE as_bcode='".$barcode."'";
	 //echo $sql; exit;
	$as_bcode = mysql_query($sql);
	$countbcode = mysql_num_rows($as_bcode);
			if($countbcode > 0)
			{
				$array2 = array("err" => "Updated","msg" => "Updated");
				$mysql_fetch_array = mysql_fetch_assoc($as_bcode);
				$arraynewxx = array_merge($mysql_fetch_array,$array2);
				
			
					$clientname = $mysql_fetch_array['Client'];
					$candidatename = $mysql_fetch_array['v_name'];
					$componenets =  $mysql_fetch_array['checks_title'];
					$ianame =  $mysql_fetch_array['ia_name'];
					$cnicnum =  $mysql_fetch_array['v_nic'];
					$fathername=  $mysql_fetch_array['v_ftname'];
					
 			
				
				
			}
			
			$subcat_sou = "Local";
		}
		else
		{
			$subcat_sou = '-';
		}
		 	 
		 
			  
		if($insertIDx != "")
		{ 
		$sql = "SELECT * FROM `mis_management_system` where misID = '".$insertIDx."' ";
	
		//echo $sql; exit;
		$data = mysql_query($sql);
		if(mysql_num_rows($data) > 0)
		{
		
		$asd = mysql_fetch_assoc($data);
		
		$isIncUp = $db->update("receivingdate='$receivdate',checkSource='$checksource',sub_checkSource='$subcat_sou',clientname='$clientname',candidateName='$candidatename',components='$componenets',status='$status',age='$age',ianame='$ianame',qualification_detail='$qualification_detail',fatherName='$fathername',cnicno='$cnicnum',closedate='$closeddate',closedTAT='$closedtat',rollno='$rollnum',ddamount='$ddamount',ddnum='$ddnumber',letter_ref_num='$letter_ref_num',sent_date='$sent_date',update_date=CURRENT_TIMESTAMP,followup_1='$followup1',followup_2='$followup2',followup_3='$followup3',followup_4='$followup4',followup_5='$followup5',courier_company='$couriercompany',curier_num='$couriernumber',mdate='$mdate',mtime='$mtime'","mis_management_system","misID=".$asd['misID']);
		if($isIncUp){
		addMisLogs('updated');	
		}
					$dd = array(
					"v_name" => $asd['candidateName'],
					"Client" => $asd['clientname'],
					"checks_title" => $asd['components'],
					"ia_name" => $asd['ianame'],
					"v_nic" => $asd['cnicno'],
					"v_ftname" => $asd['fatherName'] 
 					);
					 
		$fieldID = $asd['misID'];
  		 $array3 = array("insertID" => $fieldID,"err" => "Updated","msg" => "Updated");
 		 $arraynew = array_merge($dd,$array3);
		
		
		} 
		
	 }else {
		 
 //var_dump($barcode); exit;	
				if($ianame!='' && $ianame!='-'){
					$cols="receivingdate,checkSource,sub_checkSource,barcode,clientname,candidateName,components,status
					,age,ianame,qualification_detail,fatherName,cnicno,closedate,closedTAT,rollno
					,ddamount,ddnum,letter_ref_num,sent_date,followup_1,followup_2,followup_3,followup_4
					,followup_5,courier_company,curier_num,mdate,mtime,created_by
					";
 					$values="'$receivdate','$checksource','$subcat_sou','$barcode','$clientname','$candidatename'
					,'$componenets','$status','$age','$ianame','$qualification_detail'
					,'$fathername','$cnicnum','$closeddate','$closedtat','$rollnum'
					,'$ddamount','$ddnumber','$letter_ref_num','$sent_date','$followup1'
					,'$followup2','$followup3','$followup4','$followup5','$couriercompany','$couriernumber'
					,'$mdate','$mtime','".$_SESSION['user_id']."'";
					
					 $sel_sql = $db->select("`mis_management_system`","*"," barcode = '".$barcode."' ");
					
					if($barcode !="" && $barcode !="-" && @mysql_num_rows($sel_sql)==0){
								
					$isInserted=$db->insert($cols,$values,"mis_management_system");
					$fieldID = $db->insertedID;
					if($isInserted){
					addMisLogs('inserted');	
					}
						}
						else
						{
							$fieldID = "";
						}
				

					
		 $arraynew2 = array("insertID" => $fieldID,"err" => "","msg" => "inserted");
 		  $arraynew = array_merge($arraynewxx,$arraynew2);
				}else{
			$arraynew2 = array("insertID" => '',"err" => "IA not selected","msg" => "IA not selected");
			$arraynew = $arraynew2;	
				}
					
		}
		
		 
 //print_r($arraynew);
	
	echo json_encode($arraynew);
	}else{
	
	echo json_encode($array);	
	}
	}
	}
	
	// edit existing record  
	else if(isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "yes")){
 	// print_r($_REQUEST);
	$misID = trim($_REQUEST['misID']);
	
	
   	$receivdate = $_REQUEST['receivdate_'.$misID];
  	$checksource = $_REQUEST['checksource_'.$misID];
  	$barcode = $_REQUEST["barcode_".$misID]; 
  	$clientname = $_REQUEST['clientname_'.$misID];
  	$candidatename = $_REQUEST['candidatename_'.$misID];
  	$componenets = $_REQUEST['componenets_'.$misID];
  	$status = $_REQUEST['status_'.$misID];
  	$age = $_REQUEST['age_'.$misID];
  	$ianame = $_REQUEST['ianame_'.$misID];
  	$qualification_detail = $_REQUEST['qualification_detail_'.$misID];
  	$fathername = $_REQUEST['fathername_'.$misID];
  	$cnicnum = $_REQUEST['cnicnum_'.$misID];
  	$closeddate = $_REQUEST['closeddate_'.$misID];
  	$closedtat = $_REQUEST['closedtat_'.$misID];
  	$rollnum = $_REQUEST['rollnum_'.$misID];
  	$ddamount = $_REQUEST['ddamount_'.$misID];
  	$ddnumber = $_REQUEST['ddnumber_'.$misID];
  	$letter_ref_num = $_REQUEST['letter_ref_num_'.$misID];
  	$sent_date = $_REQUEST['sent_date_'.$misID];
	$out_mail_courier_num = $_REQUEST['out_mail_courier_num_'.$misID];
	$out_mail_courier_company = $_REQUEST['out_mail_courier_company_'.$misID];
	$out_mail_status = $_REQUEST['out_mail_status_'.$misID];
  	$followup1 = $_REQUEST['followup1_'.$misID];
  	$followup2 = $_REQUEST['followup2_'.$misID];
  	$followup3 = $_REQUEST['followup3_'.$misID];
  	$followup4 = $_REQUEST['followup4_'.$misID];
  	$followup5 = $_REQUEST['followup5_'.$misID];
  	$couriercompany = $_REQUEST['couriercompany_'.$misID];
  	$couriernumber = $_REQUEST['couriernumber_'.$misID];
  	$mdate = $_REQUEST['mdate_'.$misID];
  	$mtime = $_REQUEST['mtime_'.$misID];
 	$mdate = ($_REQUEST['mdate_'.$misID]!='0000-00-00 00:00:00' && $_REQUEST['mdate_'.$misID]!='')?$_REQUEST['mdate_'.$misID]:date('Y-m-d H:i:s');
	$mtime = ($_REQUEST['mtime_'.$misID]!='00:00:00' && $_REQUEST['mtime_'.$misID]!='')?$_REQUEST['mtime_'.$misID]:date('H:i:s');
			

		$isIncUp = $db->update("status='$status',age='$age',qualification_detail='$qualification_detail',closedate='$closeddate',closedTAT='$closedtat',ddamount='$ddamount',ddnum='$ddnumber',letter_ref_num='$letter_ref_num',sent_date='$sent_date',out_mail_courier_num='$out_mail_courier_num',out_mail_courier_company='$out_mail_courier_company',out_mail_status='$out_mail_status',followup_1='$followup1',followup_2='$followup2',followup_3='$followup3',followup_4='$followup4',followup_5='$followup5',courier_company='$couriercompany',curier_num='$couriernumber',mdate='$mdate',mtime='$mtime',rollno='$rollnum',update_date=CURRENT_TIMESTAMP","mis_management_system","misID=".$misID);
	
					if($isIncUp){
					addMisLogs('updated');	
					}
	$update_query = "UPDATE mis_management_system SET status='$status',age='$age',qualification_detail='$qualification_detail',closedate='$closeddate',closedTAT='$closedtat',ddamount='$ddamount',ddnum='$ddnumber',letter_ref_num='$letter_ref_num',sent_date='$sent_date',out_mail_courier_num='$out_mail_courier_num',out_mail_courier_company='$out_mail_courier_company',out_mail_status='$out_mail_status',followup_1='$followup1',followup_2='$followup2',followup_3='$followup3',followup_4='$followup4',followup_5='$followup5',courier_company='$couriercompany',curier_num='$couriernumber',mdate='$mdate',mtime='$mtime',rollno='$rollnum',update_date=CURRENT_TIMESTAMP WHERE misID=".$misID; 
	
	
	//echo "xsx -".$barcode.' this...'.$misID;
			//$isIncUp = $db->update("receivingdate='$scr',sc_desc='$desc'","mis_management_system","misID=".$misID);
	$array = array("err" => "Record Updated Successfully.","update_query"=>$update_query);
	// print_r($_REQUEST);
	$barcode = $barcode;
	
	 
	echo json_encode($array);
 	}
	
	else {
		
	}

//print_r($_GET);exit;
 
}



if($_REQUEST['getfilex'] == "yes")
{
		header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment; Filename=SaveAsWordDoc.doc");

$asd = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
<title>Saves as a Word Doc</title>
</head>
<body>
<h1>Header</h1>
  This text can be seen in word
<ul>
<li>List  ss1</li>
<li>List 2</li>
</ul>
</body>
</html>';
 echo $asd;

}

if($_REQUEST['companysuggest'] == "yes")
{
	getSuggestData();
}



 
function getSuggestData(){
	$input = strtolower( $_REQUEST['compname'] );
	$len = strlen($input);
	$response=createsession();
$countryCode=$response->countryCode;
$createdAt=$response->createdAt;
$customerID=$response->customerID;
 $sessionID=$response->sessionID;
$userID=$response->userID;
//$params = array($sessionID);
   // $response1 = $soapclient->__call('getSessionInfo',$params);
	//print_r($response1);
	//$params = array();
 // $response1 = $soapclient->__call('getSupportedLanguages',$params);;
 //echo $sessionID;die;
 $lang="EN";
 $advanceSearchActive="1";
 $city="";
 $email="";
 $exact="";
 $houseNr="";
 $legalForm="";
 $phone="";
 $registerNr="";
 $registerType="";
 $searchNameGeneral="Siemens";
 $statisticalNr="";
 $street="";
 $vatNr="";
 $web="";
 $zipCode="";
 $searchRequest=array($advanceSearchActive,$city,$email,$exact,$houseNr,$legalForm,$phone,$registerNr,$registerType,
 $searchNameGeneral,$statisticalNr,$street,$vatNr,$web,$zipCode);
 $params = array($searchRequest,"1000",$lang,$sessionID,0,10);
 // print_r($params);die;
 $soapclient = new SoapClient("http://www.crefoport.co.uk/manager/cxf/ManagerService?wsdl");
  //$response1 = $soapclient->__call('searchCompanies',$params);
//print_r($response1);
    $xml='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service/">
	       <soapenv:Header/>
	       <soapenv:Body>
		  <ser:searchCompanies>
		     <searchRequest>
		        <advanceSearchActive>1</advanceSearchActive>
		        <city></city>
		        <email></email>
		        <exact></exact>
		        <houseNr></houseNr>
		        <legalForm></legalForm>
		        <phone></phone>
		        <registerNr></registerNr>
		        <registerType></registerType>
		        <searchNameGeneral>'.$input.'</searchNameGeneral>
		        <statisticalNr></statisticalNr>
		        <street></street>
		        <vatNr></vatNr>
		        <web></web>
		        <zipCode></zipCode>
		        <iD></iD>
		     </searchRequest>
		     <countryCode>1000</countryCode>
		     <langid>EN</langid>
		     <sessionId>'.$sessionID.'</sessionId>
		     <from>0</from>
		     <size>10</size>
		  </ser:searchCompanies>
	       </soapenv:Body>
	    </soapenv:Envelope>';
		
		$response=doXMLCurl("http://www.crefoport.co.uk/manager/cxf/ManagerService?wsdl",$xml);
		$xml = simplexml_load_string($response);
		$xml->registerXPathNamespace('soap', 'http://schemas.xmlsoap.org/soap/envelope/');
		closesession($sessionID);
		//print_r($xml);die;
		//@header("Content-Type: application/json");
			 // print_r($xml->xpath('//item'));die;
	  if(count($xml->xpath('//item'))){ 
	   
		//echo "{\"results\": [";
		//$arr = array();
		$recc = "";
		foreach ($xml->xpath('//item') as $item)
		{ 
			//$arr[] = "{\"id\": \"".$item->crefo."\", \"value\": \"".$item->name."\", \"info\": \"\"}";
			$recc .= "<span onclick=\"addhiddenfields('".trim($item->crefo)."')\">".$item->name."</span><br>";
		}
		//echo implode(", ", $arr);
		//echo "]}";
		echo $recc;
	  }
} 

if($_REQUEST['select_prods'] == "yes")
{	
	
	$agreement_confg = $db->select("checks","*","checks_id = ".$_REQUEST['prodid']." ");
	$data2 = mysql_fetch_assoc($agreement_confg);
	// $data2['checks_title'].
	
	if($_REQUEST['selected'] == "yes")
	{ 
	$arraynew = array("err" => "no","msg" => "Select in Product List");
 	echo json_encode($arraynew);
 	}
	else
	{
	$arraynew = array("err" => "yes","msg" => "Unselect in Product List");
 	echo json_encode($arraynew);
	}

}


if(isset($_REQUEST['misdel']) && $_REQUEST['misdel'] == 1)
{
	deleteMisRec($_REQUEST['misID']);
}


function deleteMisRec($misID){
	global $db;
	$uID = $_SESSION['user_id'];
	if(is_numeric($misID) && $misID!=0){
	
	$del = $db->update("is_dlt=1,deleted_by='$uID',dlt_date=CURRENT_TIMESTAMP","mis_management_system"," misID=$misID");
	
	if($del){
	
	$msg = "deleted";
	}else{
	$msg = "unable to delete!";	
	}
	}else{
	$msg = "unable to delete the record!";
	}
	echo $msg;
	
}



if(isset($_REQUEST['delete_from_list_instant']) && $_REQUEST['delete_from_list_instant'] == 1)
{
	delete_inst_prod_list($_REQUEST['ids']);
}


function delete_inst_prod_list($misID){
	global $db;
	 //print_r($_REQUEST);echo $misID.' ssssss ';exit;
	
	$agreement_confg = $db->select("search_history_instant","*","serID = ".$_REQUEST['lastinsertid']." ");
	$data2 = mysql_fetch_assoc($agreement_confg);
	$cross_check_resp = $data2['cross_check_resp'];
	$daaa = json_decode($cross_check_resp);
	
	
//$pos = array_search('4017793', $daaa);

//echo 'Linus Trovalds found at: ' . $pos;

 //unset($daaa[$pos]);

//print_r($daaa);	
foreach($daaa as $dddddddd)
{ 
	//print_r($dddddddd).'<br>';
	if($dddddddd->id != $_REQUEST['ids'])
	{
		$xxx[] = $dddddddd;
	}
	//$xxx[] = $dddddddd;
	
}
	$json_data = l($xxx);	//echo $json_data.' xxxxxx ';exit;			
	$updatedx = $db->update("cross_check_resp = '".$json_data."'","search_history_instant","serID=".$_REQUEST['lastinsertid']." ");
echo $updatedx;
 //print_r($xxx);
	/*$uID = $_SESSION['user_id'];
	if(is_numeric($misID) && $misID!=0){
	
	$del = $db->update("is_dlt=1,deleted_by=$uID,dlt_date=CURRENT_TIMESTAMP","mis_management_system"," misID=$misID");
	
	if($del){
	
	$msg = "deleted";
	}else{
	$msg = "unable to delete!";	
	}
	}else{
	$msg = "unable to delete!";
	}
	echo $msg;*/
	
}




if($_REQUEST['occr_rec_list_ajax'] == 'yes')
{
	occr_rec_list_ajax();
}

function occr_rec_list_ajax()
{
	 //echo $_REQUEST['limit']." ===== ".$_REQUEST['limit']-5;
	  
	 $data= get_occrp_data_api($_REQUEST['fullname'],5,$_REQUEST['limit']-5);
	//echo "https://data.occrp.org/api/1/query?limit=".$asd."&offset=".$asd."&q=".urlencode($_REQUEST['fullname']);
	if(count($data->results) > 0)
	{ 
	
	$inc2=$_REQUEST['limit']-4;		   
	$i=1;
	foreach($data->results as $val){
		 // print_r($val).'<br><br><br><br><br>';
	if($inc2 == 1)
	{
		$first_margine = "margin-top:0";
	}
	else
	{
		$first_margine = '';
	}	 
		
	if($inc2 % 2 == 0 )
	{
		$post_even = "post-even";
	}	 
	else
	{
		$post_even = "";
	}	
	
	
	
	
	
	
	//echo "https://data.occrp.org/api/1/documents/".$val->id."/pages/".$val->records->results[0]->page;
	
	
	//print_r($more_details);
	
	//echo $more_details->text;
	
	
	 
		
		?>                                                
    <div class="timeline-row <?=$post_even?>" style=" <?=$first_margine?>"  id="hidesec<?=$val->id?>">
<div class="timeline-icon" style="text-align: center;font-size: 22px;font-weight: 500;line-height: 37px;">
<div class="bg-info-400">
<?=substr($_REQUEST['fullname'],0,1)?>
</div>
</div>
 <div class="timeline-content">
     <div class="panel border-left-lg border-left-danger invoice-grid timeline-content">
<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<h6 class="text-semibold no-margin-top"><?=str_replace("&#65533;","",$val->title)//." = ".utf8_decode($val->title)?></h6>                        
<ul class="list list-unstyled">
<li><span class="text-semibold">Source Url:</span> <?=str_replace("&#65533;","",$val->source_url)?></li>
</ul>
 </div>
 </div>
</div>
 <div class="panel-footer">
<ul class="pull-right">
 
<li> <a href="#" data-toggle="modal" data-target="#single_record_occrp_<?=$val->id?>"><i class="icon-eye8 position-left"></i></a> </a></li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i> <span class="caret"></span></a>
<ul class="dropdown-menu dropdown-menu-right">
<li><a href="#" data-toggle="modal" data-target="#single_record_occrp_<?=$val->id?>"><i class="icon-eye8 position-left"></i> View Report</a></li>

<li><a href="#"  ><i class="icon-file-download2 position-left"></i>Report Download</a></li>

</ul>
</li>



  <div id="single_record_occrp_<?=$val->id?>" class="modal fade in">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h5 class="modal-title"><?=$_REQUEST['fullname']?> Full Report</h5>
        </div>
    
         <div class="modal-body" style="font-size:14px; width:100%; display:inline-block; background:transparent;">
    
                              
    <div class="col-md-3 prof-serc-img">
       <?php /*?> <?php
             if($PhotographUrl)
         {
            echo '<div class="form-group">
               <img src="'.$PhotographUrl.'" width="100px" height="100px"  />
                </div>';
         }else{
                ?><div class="form-group"><img src="https://backcheck.io/verify/images/avtr_case.png"></div><?php 
            }
        
        ?><?php */?>
        
       <?php /*?> <a href="<?=SURL?>?action=singlereport&atype=download&id=<?=$id?>" style="width:100%;" class="btn bg-info-400" target="_blank" >Report Download</a><?php */?>
    
    </div>
    
    
    <div class="col-md-8">
        <div class="table-responsive">
    
            <table class="table table-striped">
            <?php  //echo $val->id.' thisisdiddd';//print_r($singlerec)."<br><br><br>";
			//echo "https://data.occrp.org/api/1/documents/".$val->id."/pages/".$val->records->results[0]->page;
          $occrp_details = occrp_details($val->id,$val->records->results[0]->page);
	//print_r($asd);str_replace("&#65533;","",$val->title) utf8_decode($occrp_details->text)
             echo '<tr>
                 <td>'.str_replace("&#65533;","",$occrp_details->text).'</td>
                </tr>';
         	?>        
        </table>
    
        </div>	
    
    </div>
    
    
    
           </div>     
    </div>
    </div>
    </div>
<?php
 $inc++; 
 ?>


</ul>


</div>
</div>



</div>
</div>

                <?php $inc2++; $i++;  }
	
	}
	else
	{
		echo 'No More Record Found.';
		exit;
	}
}



if($_REQUEST['twitter_rec_list_ajax'] == 'yes')
{
	twitter_rec_list_ajax();
}

function twitter_rec_list_ajax()
{
print_r($_REQUEST);	
}





if($_REQUEST['cvuploader'] == 'yes')
{echo 'xxx';
	cvuploader();
}

function cvuploader()
{
print_r($_REQUEST);	
}


function addMisLogs($act_type,$edited_cols=''){
	global $db;
	$uID = $_SESSION['user_id'];
	$insert = $db->insert("user_id,log_act_type,log_column","'$uID','$act_type','$edited_cols'","mis_logs");
	if($insert){
	return true;
	}else{
	return false;	
	}
}





