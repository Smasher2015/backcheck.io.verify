<?php
$_REQUEST['ERR']='';
$_REQUEST['SCS']='';
$_REQUEST['CNT']=0;

$_REQUEST['TERR']=array();
$_REQUEST['TSCS']=array();

//new

function client_checks_info($owhere,$limit='',$bycase=false){
	global $db,$COMINF;
	global $LEVEL;
	$where = "$owhere AND v_isdlt=0 AND com_id=$COMINF[id]";
	$tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN checks ck ON c.checks_id=ck.checks_id";
	if($bycase) $GROUPBY = "GROUP BY d.v_id"; else $GROUPBY="GROUP BY c.as_id";
	$cols = "d.image,d.v_name,ck.checks_title,c.as_stdate,d.v_id,c.as_id,c.as_status,c.as_vstatus,c.as_remarks,c.as_pdate";
	
	//echo "select $cols from $tbls where $where  $GROUPBY ORDER BY c.as_id DESC $limit";
	$data = $db->select($tbls,$cols,"$where $GROUPBY ORDER BY c.as_id DESC $limit");	
	
	if(mysql_num_rows($data)>0){
		return $data;	
	}else{
		return false;	
	}
}	

function client_case_info($twhere=''){
	global $db,$COMINF;
	global $LEVEL;	
	$data['data'] = array();
	$where="$twhere v_isdlt=0 AND com_id=$COMINF[id]";
	
	$cols = "COUNT(d.v_id) AS cnt,d.v_crd,d.v_stdate,d.v_date,d.v_cldate,d.emp_id";

	$cols ="$cols,d.v_id,.d.v_name,d.v_nic,d.com_id,d.v_ftname,d.v_status,d.v_rlevel,d.v_sent,v_bmk,v_refid";

	$tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id"; 

		$cases = $db->select($tbls,$cols,"$where GROUP BY d.v_id ORDER BY d.v_id DESC");

		$dCount = mysql_num_rows($cases); 
		$count = 0;
		while($re = mysql_fetch_assoc($cases)) { 

						$data['data'][$count] = $re;
						 
						$tnt = countChecks("vc.v_id=$re[v_id] AND as_isdlt=0");

						$cnt = countChecks("vc.as_status='close' AND vc.v_id=$re[v_id] AND as_isdlt=0");
						
						$data['data'][$count]['progress'] = @($cnt/($tnt))*100;
						
						$red = "(as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found')";

						$red = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $red AND as_isdlt=0");
						$red =	mysql_fetch_assoc($red);
						
						$data['data'][$count]['red'] = $red['cnt'];
						
						$disp="(as_vstatus='unable to verify' OR as_vstatus='discrepancy' OR as_vstatus='original required')";

						$disp = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $disp AND as_isdlt=0");
						$disp = mysql_fetch_assoc($disp);
						
						$data['data'][$count]['discrepancy'] = $disp['cnt'];
								
						$count = $count+1;	
		}
		return $data;
	
}

function send_json($data,$is_array=false) {
	        @header( 'Content-Type: application/json; charset=UTF-8');
	        $response['data']='';
			if(!$is_array){
				$count = 0;
				while($row = mysql_fetch_assoc($data)){
					$response['data'][$count]= $row;
					$count++;
				}	
			}else $response=$data;
			echo json_encode( $response );
	        die;
}
	
function encode_json(){
	
	
	json_encode($data);
}

function sort_checks_info(){
	global $db,$COMINF;
	$where = "v_isdlt=0 AND com_id=$COMINF[id]";
	$tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN checks ck ON c.checks_id=ck.checks_id";
	$cols = "DISTINCT ck.checks_id,ck.checks_title";
	$data = $db->select($tbls,$cols,"$where ORDER BY ck.checks_title DESC");	
	if(mysql_num_rows($data)>0){
		return $data;	
	}else{
		return false;	
	}
}	

//end new
					
function getDDStatus($status){
		global $LEVEL;
		switch($status){
		case 0:
			return 'Drafted';
		case 1:
			if($LEVEL==6)return "Pending"; return 'Send to Finance';
		case 2:
			return 'Payid';
		case 3:
			return 'Rejected';			
		}
}


function ddChange(){
	
	if(is_numeric($_POST['ddid']) && is_numeric($_POST['status'])){
		$db = new DB();
		$uCls = "dd_status=$_POST[status]";
		if($db->update($uCls,"dd_data","dd_id=$_POST[ddid]")){
			sentDDEmail();
			msg("sec","Status Updated successfully...");
		}else{
			msg('err',"DD Updation error, please try again!");
		}
	}
}


function ddDelete(){
	
	if(is_numeric($_POST['ddid'])){
		$db = new DB();
		$uCls = "dd_active=0";
		if($db->update($uCls,"dd_data","dd_id=$_POST[ddid]")){
			msg("sec","DD delete successfully...");
		}else{
			msg('err',"DD deletion error, please try again!");
		}
	}
}

function vendorDelete(){
	
	if(is_numeric($_POST['vdid'])){
		$db = new DB();
		$uCls = "vd_active=0";
		if($db->update($uCls,"vendors","vd_id=$_POST[vdid]")){
			msg("sec","Vendor delete successfully...");
		}else{
			msg('err',"Vendor deletion error, please try again!");
		}
	}
}

function addvendor(){
		$db = new DB();
	
		if(trim($_POST['company'])=="") msg('err',"Please input name!");
		if(!is_numeric($_POST['vfee'])) msg('err',"Please input valid fee amount!");
	
		$uID = $_SESSION['user_id'];
		
		if($_REQUEST['ERR']==''){				
				
			if(isset($_POST['edit'])){
				
			$uCls ="vd_fee=$_POST[vfee],vd_name='$_POST[company]',vd_email='$_POST[cemail]',vd_adress='$_POST[address]',vd_cperson='$_POST[cperson]'";
				$uCls ="$uCls,vd_contact='$_POST[cphone]',vd_mobile='$_POST[cmobile]',vd_uuser=$uID";
								
				$uCls ="$uCls,vd_bankname='$_POST[vdbankname]',vd_acctitle='$_POST[vdacctitle]',vd_accnumber='$_POST[vdaccnumber]'";
				$uCls = "$uCls,vd_branchname='$_POST[vdbranchname]',vd_branchcode='$_POST[vdbranchcode]',vd_swiftcode='$_POST[vdswiftcode]'";
				
				$uCls ="$uCls,vd_cnicnumber='$_POST[cnicnumber]',vd_remarks='$_POST[vdremarks]',vd_area='$_POST[carea]'";
				$uCls = "$uCls,vd_city='$_POST[ccity]',vd_udate=CURRENT_TIMESTAMP";
								
				if($db->update($uCls,"vendors","vd_id=$_POST[edit]")){
					msg("sec","Vendor Updated successfully...");
				}else{
					msg('err',"Vendor updation error, please try again!");
				}			
			}else{
				
				$cols ="vd_fee,vd_name,vd_email,vd_adress,vd_cperson,vd_contact,vd_mobile,vd_cuser";
				$cols ="$cols,vd_bankname,vd_acctitle,vd_accnumber,vd_branchname,vd_branchcode";
				$cols ="$cols,vd_swiftcode,vd_cnicnumber,vd_remarks,vd_area,vd_city,vd_cdate";
				
				$vals = "$_POST[vfee],'$_POST[company]','$_POST[cemail]','$_POST[address]','$_POST[cperson]','$_POST[cphone]','$_POST[cmobile]',$uID";
				
				$vals = "$vals,'$_POST[vdbankname]','$_POST[vdacctitle]','$_POST[vdaccnumber]','$_POST[vdbranchname]','$_POST[vdbranchcode]'";
				
				$vals = "$vals,'$_POST[vdswiftcode]','$_POST[cnicnumber]','$_POST[vdremarks]','$_POST[carea]','$_POST[ccity]',CURRENT_TIMESTAMP";
				
				if($db->insert($cols,$vals,'vendors')){
					msg("sec","Vendor added successfully...");
				}else{
					msg('err',"Vendor adding error, please try again!");
				}
			}
		}				
}
	
function setPost($parys,$table,$where){
		$db = new DB();
		$data = $db->select($table,"*",$where);
		//echo $db->query;
		if(mysql_num_rows($data)>0){
			$tdata = mysql_fetch_assoc($data);
			foreach($parys as $key=>$value){
				$_POST[$value] = $tdata[$key];
			}
		}else{
			foreach($parys as $key=>$value){
				$_POST[$value] = "";
			}				
		}
		return false;
}

function ddChecks($DDID){
		$db = new DB();
		$db->update("dc_active=0","dd_checks","dd_id=$DDID");
		if(isset($_REQUEST['tcheck'])){
			foreach($_REQUEST['tcheck'] as $check){
				if(is_numeric($check)){
					$ddcheck = $db->select("dd_checks","*","dd_id=$DDID AND as_id=$check");
					if(mysql_num_rows($ddcheck)>0){
						$db->update("dc_active=1","dd_checks","dd_id=$DDID AND as_id=$check");
					}else{
						$cols="dd_id,as_id,dc_cdate";
						$values="$DDID,$check,CURRENT_TIMESTAMP";
						if(!$db->insert($cols,$values,"dd_checks")) msg('err',"Check insertion error!, please try again");
					}
					$db->update("as_update=1","ver_checks","as_id=$check");	
				}
			}	
			
			$ddchecks = $db->select("dd_checks","*","dd_id=$DDID AND dc_active=0");
			while($ddcheck = mysql_fetch_assoc($ddchecks)){
					$db->update("as_update=0","ver_checks","as_id=$ddcheck[as_id]");
			}
		}
}

				
function sentDDEmail(){
	$db = new DB();
	                   
	$DDID = $_REQUEST['ddid'];
	$sEmail="";
	switch($_REQUEST['status']){
		case 1:
			$sEmail="jawaid@riskdiscovered.com";
			if(isset($_REQUEST['dataflow'])){
				$cMail="hassan@riskdiscovered.com";
			}else{
				$cMail="saima@riskdiscovered.com,sadia@riskdiscovered.com,mursaleen@riskdiscovered.com";
			}
		break;
		case 2:
		case 3:
			if(isset($_REQUEST['dataflow'])){
				$sEmail="hassan@riskdiscovered.com";
				$cMail="jawaid@riskdiscovered.com";
			}else{
				$sEmail="mursaleen@riskdiscovered.com";
				$cMail="saima@riskdiscovered.com,sadia@riskdiscovered.com,jawaid@riskdiscovered.com";
			}
		break;		
	}
	if(is_numeric($DDID) && $sEmail!=''){
		       
                $tbls = "dd_data";
                $data = $db->select($tbls,"*","dd_active=1 AND dd_id=$DDID");
                $re = mysql_fetch_array($data);
				$userInfo = getUserInfo($re['dd_user']);
				$total = $re['dd_fee']*$re['dd_units'];
				
				$status = getDDStatus($re['dd_status']);
				
				$uni = $db->select("uni_info","*","uni_id=$re[dd_uni]");
				$uni =  mysql_fetch_assoc($uni);
								
				$table = "<table style=\"width:100%\">";
				$table = "$table<tr><td colspan=\"2\"><h1>Submitted by: $userInfo[first_name] $userInfo[last_name]</h1></td></tr>";
				$table = "$table<tr>
									<td><strong>Unit(s):</strong></td>
									<td>$re[dd_units]</td>
							     </tr>";

				$table = "$table<tr>
									<td><strong>Fee Amount:</strong></td>
									<td>$re[dd_fee]</td>
							     </tr>";
				$table = "$table<tr>
									<td><strong>Total Amount:</strong></td>
									<td>$total</td>
							     </tr>";							 				
				$table = "$table<tr>
									<td><strong>Status:</strong></td>
									<td>$status</td>
							     </tr>";				

				$table = "$table<tr>
									<td><strong>Verifying Authoritys,Beneficiary:</strong></td>
									<td>$uni[uni_Name],$re[dd_bene]</td>
							     </tr>";

				$table = "$table<tr>
									<td><strong>Detail Page:</strong></td>
									<td><a href=\"https://backgroundcheck365.com/dashboard/?action=demanddraft&atype=details&ddid=$DDID\">Detail</a></td>
							     </tr>";
								 		 				
				$table = "$table</table>";
				$title = "#00$DDID DD Request ($status)";
				$fEmial = "";

				emailTmp($table,$title,$sEmail,$fEmial,$cMail);
	
	}
}

function dskipDD(){
	if(isset($_REQUEST['checks']) && is_array($_REQUEST['checks'])){
		$db = new DB();
		foreach($_REQUEST['checks'] as $check){
			    $success = true;
				$db->update("as_update=1","ver_checks","as_id=$check");	
		}
	}else{
		 msg('err','Please select any check to skip!');	
	}	
	if(isset($success)) msg('sec',"Demand draft skip successfully...");
}

function count_pending_dd(){
				$dWhere = "";
				$db = new DB();
				global $LEVEL;
				if($LEVEL==3) $dWhere = "c.user_id=$_SESSION[user_id] AND ";

                $tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN uni_info u ON u.uni_id=c.as_uni";
                $DCOUNT = $db->select($tbls,"COUNT(c.as_id) cnt","$dWhere c.as_update=0 AND d.v_isdlt=0 AND c.as_isdlt=0 AND c.as_uni<>0 AND c.checks_id=1 AND c.as_status<>'Problem' AND c.as_status<>'Close' AND u.uni_ddr=1 AND u.uni_nfe=0 AND u.uni_region!='' AND u.uni_city!=''");
				$DCOUNT = mysql_fetch_assoc($DCOUNT);
				
				return $DCOUNT['cnt'];
}

function requestddraft(){
	if(isset($_REQUEST['checks']) && is_array($_REQUEST['checks'])){
		$db = new DB();
		$uID = $_SESSION['user_id'];
		$srn = 1;
		$trs='';
		foreach($_REQUEST['checks'] as $check){
			if(is_numeric($_REQUEST["cost$check"])){
				$fee = $_REQUEST["cost$check"];
				$uni = $_REQUEST["uni$check"];
				$ben = $_REQUEST["benf$check"];
				$attch='';
				$fname='';
				$vcost=0;
				if ($_FILES["file$check"]["error"] <= 0){
					$fname = $_FILES["file$check"]["name"];
					$attch = fileUpload("file$check",'ddrequest','dd/');
				}

						
				$cols = "dd_vdcost,dd_uni,dd_bene,dd_fee,dd_units,dd_cdate,dd_status,dd_user,dd_att1,dd_tit1";
				$vals = "$vcost,$uni,'$ben',$fee,1,CURRENT_TIMESTAMP,1,$uID,'$attch','$fname'";
	
				$isInsrt = $db->insert($cols,$vals,'dd_data');
	
				$DDID=$db->insertedID;						
				if($isInsrt){
					$user_info=getUserInfo($uID);
					$success= true;
					$sdate = date("j-M-Y",time());
					$benf = $_REQUEST["benf$check"];
					$unm = $_REQUEST["unm$check"];
					$cnm = $_REQUEST["cnm$check"];
					$tfee = $fee+$vcost;
					$trs .= "<tr>
						<td>$srn</td>
						<td>$user_info[first_name] $user_info[last_name]</td>	
						<td>$sdate</td>
						<td>$benf / $unm</td>
						<td>1</td>
						<td>$tfee</td>
						<td>$tfee</td>
						<td>$cnm</td>
					</tr>";
					$srn++;
					$ddcheck = $db->select("dd_checks","*","dd_id=$DDID AND as_id=$check");
					if(mysql_num_rows($ddcheck)>0){
						$db->update("dc_active=1","dd_checks","dd_id=$DDID AND as_id=$check");
					}else{
						$cols="dd_id,as_id,dc_cdate";
						$values="$DDID,$check,CURRENT_TIMESTAMP";
						$db->insert($cols,$values,"dd_checks");
					}
					$db->update("as_update=1","ver_checks","as_id=$check");	
					
					//$_REQUEST['ddid'] = $DDID;
					//sentDDEmail();
						
				}else{
					msg('err',"Demand draft sending error!");
				}
			
			}else{
				 msg('err','Please input valid fee amount');	
			}
		}
	}else{
		 msg('err','Please select any check for DD request');	
	}	
	
	if(isset($success)){
		 msg('sec',"Demand draft request sent successfully...");
		 
		 $msg = "<table>
		 			<thead>
		 			<tr>
						<th>Sr #</th>
						<th>Submitted by</th>	
						<th>Request Date</th>
						<th>Beneficiary Name/ Name of Verifying Authority</th>
						<th>Units</th>
						<th>Fees</th>
						<th>Total Amount</th>
						<th>Client Name</th>
					</tr>
					</thead>
					<tbody>
					$trs
					</tbody>
				</table>";
		 
		 	$sEmail="jawaid@riskdiscovered.com";
			$cMail="saima@riskdiscovered.com,sadia@riskdiscovered.com,mursaleen@riskdiscovered.com";
			$title = "#00$DDID DD Request ($status)";
			$fEmial = "";
			emailTmp($msg,$title,$sEmail,$fEmial,$cMail);
				
				
	}
	
}


function adddemanddraft(){
	
	$db = new DB();
	if(!is_numeric($_POST['verifying']))  msg('err','Please input verifying authoritys');	
	if(!is_numeric($_POST['units']))  msg('err','Please input unit(s)');
	if(!is_numeric($_POST['famount']))  msg('err','Please input fee amount');
	if(!is_numeric($_POST['vdcost'])) $_POST['vdcost']=0;
	
	$uID = $_SESSION['user_id'];
	
	if($_REQUEST['ERR']==''){
		if(isset($_POST['edit'])){
			$uCls = "dd_vdcost=$_POST[vdcost],dd_bcode='$_POST[bcode]',dd_uni=$_POST[verifying],dd_bene='$_POST[beneficiary]',dd_fee=$_POST[famount]";
			$uCls = "$uCls,dd_units=$_POST[units],dd_cdate=CURRENT_TIMESTAMP,dd_status=$_POST[status],dd_user=$uID";


			if ($_FILES["att1"]["error"] <= 0){
				$att1 = fileUpload('att1','ddrequest','dd/');
				if($att1){
						$name = $_FILES["att1"]["name"];
						$uCls = "$uCls,dd_att1='$att1',dd_tit1='$name'";	
				}
			}
	
			if ($_FILES["att2"]["error"] <= 0){
				$att2 = fileUpload('att2','ddrequest','dd/');
				if($att2){
						$name = $_FILES["att2"]["name"];
						$uCls = "$uCls,dd_att2='$att2',dd_tit2='$name'";	
				}
			}			

			if ($_FILES["att3"]["error"] <= 0){
				$att3 = fileUpload('att3','ddrequest','dd/');
				if($att3){
						$name = $_FILES["att3"]["name"];
						$uCls = "$uCls,dd_att3='$att3',dd_tit3='$name'";	
				}
			}	
						
			if($db->update($uCls,"dd_data","dd_id=$_POST[edit]")){
				ddChecks($_POST['edit']);
				$_REQUEST['ddid'] = $_POST['edit'];
				sentDDEmail();
				msg("sec","Demand draft updated successfully...");
			}else{
				msg('err',"Demand draft updation error, please try again!");
			}
							
		}else{
			$cols = "dd_vdcost,dd_bcode,dd_uni,dd_bene,dd_fee,dd_units,dd_cdate,dd_status,dd_user";
			$vals = "$_POST[vdcost],'$_POST[bcode]',$_POST[verifying],'$_POST[beneficiary]',$_POST[famount]";
			$vals = "$vals,$_POST[units],CURRENT_TIMESTAMP,$_POST[status],$uID";
			
			if ($_FILES["att1"]["error"] <= 0){
				$att1 = fileUpload('att1','ddrequest','dd/');
				if($att1){
						$name = $_FILES["att1"]["name"];
						$cols = "$cols,dd_att1,dd_tit1";
						$vals = "$vals,'$att1','$name'";	
				}
			}
	
			if ($_FILES["att2"]["error"] <= 0){
				$att2 = fileUpload('att2','ddrequest','dd/');
				if($att2){
						$name = $_FILES["att2"]["name"];
						$cols = "$cols,dd_att2,dd_tit2";
						$vals = "$vals,'$att2','$name'";	
				}
			}
			
			
			if ($_FILES["att3"]["error"] <= 0){
				$att3 = fileUpload('att3','ddrequest','dd/');
				if($att3){
						$name = $_FILES["att3"]["name"];
						$cols = "$cols,dd_att3,dd_tit3";
						$vals = "$vals,'$att3','$name'";	
				}
			}
			
			if(isset($_POST['dataflow'])){
				$cols = "$cols,dd_dataflow";
				$vals = "$vals,1";
			}
			
			$isInsrt = $db->insert($cols,$vals,'dd_data');
			$DDID=$db->insertedID;						
			if($isInsrt){
				ddChecks($DDID);
				$_REQUEST['ddid'] = $DDID;
				sentDDEmail();
				msg('sec',"Demand Draft Added Successfully...");	
			}else{
				msg('err',"Demand Draft Adding Error!");
			}	
		}
	} 
}

function update_str($cols,$vals){
		$str = '';
		$cols = explode(',',$cols);
		$vals = explode(',',$vals);
		foreach($cols as $key=>$col){
			$str .=	(($str!='')?',':'').$col.'='.$vals[$key];
		}
		return 	$str;		
}
	
function csvbulkupload(){
	
	$db = new DB();
	if(isset($_FILES['bulk'])){
		$uID = $_SESSION['user_id'];
		$recdate = $_POST['rcyear'].'-'.$_POST['rcmonth'].'-'.$_POST['rcday'];
		if(!is_numeric($_REQUEST['comId'])) msg('err',"Please select client name!");

		if(count($_REQUEST['checks'])==0) msg('err',"Please select/add check(s)!");
		if($_REQUEST['ERR']==''){
		if ($_FILES["bulk"]["error"] <= 0){
				if($cid!='0'){
				$len = strlen($_FILES["bulk"]["name"]);
				$ext = strtolower(substr($_FILES["bulk"]["name"],($len-3)));
				if($ext=='csv'){
		
			$fp = fopen($_FILES["bulk"]["tmp_name"],'r');
			
			$err_msg='';
			$alRedy='';
			$lCount = 0;
			while($csv_line = fgetcsv($fp,1024)) {
				$values='';
				$lCount = $lCount+1;
				if($lCount==1) continue;
				for ($i = 0, $j = 3; $i <= $j; $i++) {
					$csv_line[$i] = addslashes($csv_line[$i]);
					$values .= (($values!='')?',':'')."'".trim($csv_line[$i])."'";
				}
				
				if(is_numeric($csv_line[0])){
					$data = $db->select("ver_data","emp_id","emp_id=$csv_line[0] AND com_id=$_REQUEST[comId]");
					
					if(mysql_num_rows($data)==0){
						$bCode = cBCode($_REQUEST['comId'],'01');
						$cols="emp_id,v_name,v_ftname,v_nic,com_id,v_recdate,v_bcode,v_uadd";
						$values="$csv_line[0],'$csv_line[1]','$csv_line[2]','$csv_line[3]',$_REQUEST[comId],'$recdate','$bCode',$uID";
						$isInserted = $db->insert($cols,$values,"ver_data");
						$VID=$db->insertedID;
						if($isInserted){					
								foreach($_REQUEST['checks'] as $check){
									$bCode = cBCode(0,0,$VID,$check);
									$cols="as_bcode,v_id,checks_id,as_uadd,as_addate";
									$values="'$bCode',$VID,$check,$uID,CURRENT_TIMESTAMP";
									if(!$db->insert($cols,$values,"ver_checks")) msg('err',"Check insertion error! record ID [ $csv_line[0] ]!");
								}	
						}else{
							 msg('err',"Insertion error! record ID [ $csv_line[0] ]!");
							 
						}
					}else{
						msg('err',"Record is already exist [ $csv_line[0] ]!");
					}

				}else{
					msg('err',"Insertion frror! record ID [ ".$csv_line[0]." ]");
				}
				}
			fclose($fp);
			if(isset($isInserted)){
				if($isInserted) msg('sec',"File uploaded successfully...");
			}
				
			}else{ 
				msg('err',"Invalid file type please upload correct file!");
			}
				}else{
					msg('err',"Please select company name!");
				}
		}else{
			msg('err',"Please select a csv file to upload!");
		}
		}
	}

}

function getExts($type='',$bth=0){
	$db  = new DB();
	$exs = array();
	if(isset($_REQUEST['fFile'])){
		$exs[0] = $_REQUEST['fFile'];
	}else{
		if($type!='') $where="fil_type='$type'"; else $where='';
		$extensions = $db->select("extension","*",$where);
		while($extension = mysql_fetch_assoc($extensions)){
			if($bth==0) $imgs="$extension[fil_edoc]$extension[file_eimg]"; 
			elseif($bth==1) $imgs=$extension['fil_edoc']; else $imgs=$extension['file_eimg']; 
			$tar = explode(',',$imgs);
			if(count($tar)>0) $exs = array_merge($tar,$exs);
		}
	}
	return $exs;	
}

function fileUpload($key,$exs,$path='',$sname='',$exnm=true){
	$fName=$_FILES[$key]['name'];
	$fary  = explode('.',$fName);
	if($sname==''){
		$sname = preg_replace('/[^a-zA-Z0-9\-_]/','',ucwords(strtolower($fary[0])));
	}
	if(count($fary)>0) $ex = $fary[count($fary)-1]; else $ex = 'NA';
	$exs = getExts($exs,0);
	if(in_array($ex,$exs)){
		$indx=strtoupper(get_rand_val(6));
		if($exnm){
			 $fPath = $path."$sname-$indx.$ex";
		}else{
			 $fPath = $path."$sname.$ex";
		}
		if(move_uploaded_file($_FILES[$key]['tmp_name'],$fPath)){
			return $fPath;
		}
	}else{
		$exs = implode(',',$exs);
		msg('err',"$ex File type is not allowed!, Please Upload the following types [ $exs ] !");
	}
	return false;
}

function getClUser($clientID){

	$db = new DB();

	$cInfo = $db->select("users","*","com_id=$clientID");

	if(mysql_num_rows($cInfo)>0){

		return $cInfo;

	}

	return false;

}



function srChecks(){

	global $aType;

	if($aType=='ready') $sVal=4; else $sVal=0;

	$db = new DB();

	if(isset($_REQUEST['record'])){

		foreach($_REQUEST['record'] as $term){

				$uCls = "v_sent=$sVal,v_cdnld=0,v_stdate=CURRENT_TIMESTAMP";

				$isUpdate = $db->update($uCls,"ver_data","v_id=$term AND v_status='Close'");

				if($isUpdate){

					$isUpdate = $db->update("as_sent=$sVal,as_stdate=CURRENT_TIMESTAMP","ver_checks","v_id=$term AND as_status='Close'");

					if($sVal==4){

						//$vCheck = getCheck(0,0,$vcheck);

						//$tCheck = getCheck($vCheck['checks_id'],0,0);

					

						$vData  = getVerdata($term);

						$comInfo = getcompany($vData['com_id']);

						$comInfo = mysql_fetch_array($comInfo);

						if($comInfo['sentmail']==1){

							$vData['logo']=$comInfo['logo'];

							$clUsers = getClUser($vData['com_id']);

							if($clUsers){

								while($clUser = mysql_fetch_assoc($clUsers)){

										sentEmail($vData,true,$clUser['username'],$clUser['email']);

								}

							}

						}

					}

				}

				if(!$isUpdate) msg('err',"Case Sending Error!");

		}

	}else if(isset($_REQUEST['vchecks'])){

		foreach($_REQUEST['vchecks'] as $term){

			$isUpdate = $db->update("as_sent=$sVal,as_stdate=CURRENT_TIMESTAMP","ver_checks","as_id=$term AND as_status='Close'");

			if($isUpdate){

					if($sVal==4){

						$vCheck = getCheck(0,0,$term);

						$tCheck = getCheck($vCheck['checks_id'],0,0);

						$vData  = getVerdata($vCheck['v_id']);

						$comInfo = getcompany($vData['com_id']);

						$comInfo = mysql_fetch_array($comInfo);

						if($comInfo['sentmail']==1){

							$vData['logo']=$comInfo['logo'];

							$vData['checks_title']=$tCheck['checks_title'];

							$vData['as_id']=$term;

							$clUsers = getClUser($vData['com_id']);

							if($clUsers){

								while($clUser = mysql_fetch_assoc($clUsers)){

										sentCheckEmail($vData,false,$clUser['username'],$clUser['email']);

								}

							}

						}

					}				 

			}else{

				msg('err',"Check Sending Error!");

			}

		}

	}else{

		msg('err',"Please Checkout any Case/check to Sent");

	}	

}



function sentCheckEmail($verData,$report,$userName,$toEamil){

	$dLink = "?action=download&emp=$verData[emp_id]&user=$userName";

	if($report){

		$dLink = "$dLink&report=$verData[v_id]";

		$title = "Report";

	}else{

		$dLink = "$dLink&check=$verData[as_id]";

		$title = $verData['checks_title'];

	}

	$esub = "$verData[v_name]";

	$etxt = "<table><tr><td style=\"vertical-align:middle\">The partial $title  Report for the #$verData[emp_id]-$verData[v_name] of candidate has been completed on the system and is ready for download</td>

	<td></td></tr>

	<tr><td colspan=\"2\">

	<br/><br/><div style=\"text-align:center;\">Please <a href=\"".SURL."$dLink\"

	style=\"background-color: #e31c23;	

    background-image: -webkit-gradient(linear, left top, left bottom, from(#e31c23), to(#b40911)); /* Saf4+, Chrome */

	background-image: -webkit-linear-gradient(top, #e31c23, #b40911); /* Chrome 10+, Saf5.1+, iOS 5+ */

	background-image:    -moz-linear-gradient(top, #e31c23, #b40911); /* FF3.6 */

	background-image:     -ms-linear-gradient(top, #e31c23, #b40911); /* IE10 */

	background-image:      -o-linear-gradient(top, #e31c23, #b40911); /* Opera 11.10+ */

	background-image:         linear-gradient(top, #e31c23, #b40911);

	border-radius:6px;

    -moz-border-radius:6px;

    -webkit-border-radius:6px;

    -o-border-radius:6px;

	font-weight:bold;

	border-color: #b40911;

	color: white;

	border: 1px solid #000;

	text-shadow: 0 1px 0 #000;

	padding:5px 10px;

    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3);

    transition: background 5000ms ease-in;\"

	>download</a>.</div></td></tr></table>";

	emailTmp($etxt,$esub,$toEamil);	

}

function sentEmail($verData,$report,$userName,$toEamil){

	$dLink = "?action=download&emp=$verData[emp_id]&user=$userName";

	if($report){

		$dLink = "$dLink&report=$verData[v_id]";

		$title = "Report";

	}else{

		$dLink = "$dLink&check=$verData[as_id]";

		$title = $verData['checks_title'];

	}

	$esub = "The $title on #$verData[emp_id] $verData[v_name] has been completed";

	$etxt = "<table><tr><td style=\"vertical-align:middle\">The $title for the #$verData[emp_id] $verData[v_name] has been completed on the system and is ready for download.</td>

	<td><img src=\"".SURL."$verData[logo]\" width=\"200px\" /></td></tr>

	<tr><td colspan=\"2\">

	<br/><br/><div style=\"text-align:center;\">Please <a href=\"".SURL."$dLink\"

	style=\"background-color: #e31c23;	

    background-image: -webkit-gradient(linear, left top, left bottom, from(#e31c23), to(#b40911)); /* Saf4+, Chrome */

	background-image: -webkit-linear-gradient(top, #e31c23, #b40911); /* Chrome 10+, Saf5.1+, iOS 5+ */

	background-image:    -moz-linear-gradient(top, #e31c23, #b40911); /* FF3.6 */

	background-image:     -ms-linear-gradient(top, #e31c23, #b40911); /* IE10 */

	background-image:      -o-linear-gradient(top, #e31c23, #b40911); /* Opera 11.10+ */

	background-image:         linear-gradient(top, #e31c23, #b40911);

	border-radius:6px;

    -moz-border-radius:6px;

    -webkit-border-radius:6px;

    -o-border-radius:6px;

	font-weight:bold;

	border-color: #b40911;

	color: white;

	border: 1px solid #000;

	text-shadow: 0 1px 0 #000;

	padding:5px 10px;

    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3);

    transition: background 5000ms ease-in;\"

	>download</a> report.</div></td></tr></table>";

	emailTmp($etxt,$esub,$toEamil);	

}



function checkParms(){

		$db = new DB();

		if(trim($_REQUEST['user'])!="" && is_numeric($_REQUEST['emp']) && (is_numeric($_REQUEST['report']) || is_numeric($_REQUEST['check']))){

			$uInfo = $db->select("users","*","username='$_REQUEST[user]'");

			if(mysql_num_rows($uInfo)==1){

				$uInfo = mysql_fetch_array($uInfo);

				if(is_numeric($_REQUEST['check'])){

					$where = "vd.emp_id=$_REQUEST[emp] AND vc.as_id=$_REQUEST[check] AND vd.com_id=$uInfo[com_id]";

				}else{

					$where = "vd.emp_id=$_REQUEST[emp] AND vd.v_id=$_REQUEST[report] AND vd.com_id=$uInfo[com_id]";

				}

				$case = $db->select("ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id","*",$where);

				if(mysql_num_rows($case)>0) return $uInfo['user_id'];

			}

		}

		return false;

}

	

function editFields(){

	$_REQUEST['val'] = str_replace('||','&',$_REQUEST['val']);

	$iVal = htmlspecialchars(trim($_REQUEST['val']));

	$cols="$_REQUEST[key]='$iVal'";



	switch($_REQUEST['typ']){

		case 'date':

			$eVal = date("j-F-Y",strtotime($iVal));

		break;

		case 'multy':

			$_REQUEST['mtt1'] = str_replace('||','&',$_REQUEST['mtt1']);

			$_REQUEST['stt1'] = str_replace('||','&',$_REQUEST['stt1']);

			$mtt1 = htmlspecialchars(trim($_REQUEST['mtt1']));

			$stt1 = htmlspecialchars(trim($_REQUEST['stt1']));

			$cols=$cols.",d_stitle='$stt1',d_mtitle='$mtt1'";

			$eVal = "$mtt1||$stt1||$iVal";

		break;	

		default:

			$eVal= $iVal;

		break;

	}



	if(isset($_REQUEST['data'])){

		if(edData($_REQUEST['data'],'edit',$cols)){

			echo $eVal;

		}else echo "u error";

		exit();		

	}else if(isset($_REQUEST['ascase'])){

		if(updateCheck($_REQUEST['ascase'],$cols)){

			echo $eVal;

		}else echo "u error";

		exit();		

	}else if(isset($_REQUEST['case'])){

		if(updateData($_REQUEST['case'],$cols)){

			echo $eVal;

		}else echo "u error";

		exit();		

	}	

} 



function changePass(){

	if(!isset($_SESSION[user_id])) return false;

	if((($_POST['npass']!='') && ($_POST['cpass']!='')) && ($_POST['npass']==$_POST['cpass'])){

		$db = new DB();

		$uInfo = $db->select("users","*","user_id=$_SESSION[user_id]");

		$uInfo = mysql_fetch_array($uInfo);

		$oPass = md5(md5($_POST['opass']).md5($uInfo['salt']));

		if($oPass==$uInfo['password']){

			$nPass = md5(md5($_POST['npass']).md5($uInfo['salt']));

			$isInup = $db->update("password='$nPass'","users","user_id=$_SESSION[user_id]");

			if($isInup){

				 msg('sec',"Password Updated Successfully...");

			}else msg('err','Password rest Error!, Plase try Again');

		}else msg('err',"Please Input a Valid Password!");

	}

}



function resetPass(){

	if(validateEmail($_POST['email'])){

		$db = new DB();

		$uinfo = $db->select("users","*","email='$_POST[email]'");

		if(mysql_num_rows($uinfo)==1){

			$uinfo = mysql_fetch_assoc($uinfo);

			$sysps = get_rand_val(8);	  			

			$pass = md5(md5($sysps).md5($uinfo['salt']));	

			$isUpdate = $db->update("password='$pass'","users","user_id=$uinfo[user_id]");

			if($isUpdate){

				msg('sec',"Your Password have been reset Successfully, Please Check Your Email");

				$message="$uinfo[first_name] $uinfo[last_name]"."\r\n";

				$message.="<table>

							<tr>

								<td>User Name:</td>

								<td>$uinfo[username]</td>

							</tr>

							<tr>

								<td>Password:</td>

								<td>$sysps</td>

							</tr>

							<tr>

								<td>Login URL:</td>

								<td><a href=\"".SURL."?action=login\"".">".PORTAL."</a></td>

							</tr>												

				</table>";




			   $mail             = new PHPMailer();
			   $mail->IsSMTP(); // telling the class to use SMTP
			   $mail->SMTPAuth   = true;                  // enable SMTP authentication
			   $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			   $mail->Host       = "pop.gmail.com";      // sets GMAIL as the SMTP server
			   $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
			   $mail->Username   = "noreply@backgroundcheck365.com";  // GMAIL username
			   $mail->Password   = "&rd8V6tL";            // GMAIL password
			   $mail->SetFrom('noreply@backgroundcheck365.com');
			   
			  
			   
			   $mail->Subject    = "Login Detail";
			   $mail->MsgHTML($message);
			   $mail->AddAddress($uinfo['email']);
			   $mail->Send();


				return true;

			}else msg('err','Password rest Error!, Plase try Again');

		}

	}

		 msg('err','Please Input Valid Email Address!');	

}



function subcontactus(){

	$db = new DB();

	if($_POST['name']=='')  msg('err','Please Input Full Name');	

	if(!validateEmail($_POST['email'])) msg('err','Please Input Valid Email Address!');

	if($_POST['comtit']=='')  msg('err','Please Input Subject!');	

	if($_POST['comtxt']=='')  msg('err','Please Input Message');

	

	if($_REQUEST['ERR']==''){

		$package = $db->select("contactus","*","cnp_email='$_POST[email]' AND cnp_title LIKE '$_POST[comtit]'");

		if(mysql_num_rows($package)==0){

			$uid = (isset($_SESSION['user_id']))?$_SESSION['user_id']:0;

			$cols = "cnp_name,cnp_email,cnp_title,cnp_msg,user_id";

			$vals = "'$_POST[name]','$_POST[email]','$_POST[comtit]','$_POST[comtxt]',$uid";

			$isInsrt = $db->insert($cols,$vals,'contactus');

			if($isInsrt){

				msg('sec',"Contact Detail [ $_POST[comtit] ] is Sent Successfully...");	

			}else{

				msg('err',"Contact Detail [ $_POST[comtit] ] Sending Error!");

			}			

		}else{

			msg('err',"Contact Detail [ $_POST[comtit] ] is Already Sent!");

		}

	} 

}



function caseWizard(){

	$db = new DB();

	if(is_numeric($_POST['pkg'])){

		$package = $db->select("packages","*","pkg_id=$_POST[pkg]");

		if(mysql_num_rows($package)>0) $_POST['step']=2; else{

			 msg('err',"Please Select Valid Package!");

			 $_POST['step']=1;

		}

		$_POST['step']=2;

		if(isset($_POST['type_data'])){

			$_POST['step']=3;

		}

		if(isset($_POST['uoptn'])){

			switch($_POST['uoptn']){

				case 'applicant':

					quickInvitation();

				return 0;

				case 'upload':

					subinvitation();

				return 0;

				case 'bulk':

					bulkUpload();

				return 0;									

			}				

		}

	} else{

		msg('err',"Please Select a Package!");

		$_POST['step']=1;

	}

}



function addinvitation(){

	$db = new DB();

	$iinfo = $db->select("invitation","*","(inv_hash='$_REQUEST[invitation]')");

	if(mysql_num_rows($iinfo)>0){

		$iinfo = mysql_fetch_assoc($iinfo);

		global $COMINF;

		$COMINF['id']     = $iinfo['com_id'];

		$_POST['v_name']  = $iinfo['name'];

		$_POST['inv_id']  = $iinfo['inv_id'];

		$_POST['inv_hash']  = $iinfo['inv_hash'];

		$_POST['email'] = $iinfo['email'];

		$_POST['pkg']     = $iinfo['pkg_id'];

		if($iinfo['inv_status']==0){

			addApplicant();

		}else{

			subinvitation();

		}

	}

}



function addApplicant(){

	$db = new DB();global $COMINF;

	if($_POST['passa']==$_POST['passb']){

		if($_POST['passa']=='')   msg('err','Please Input Password!');	

	}else{

		 msg('err','Password Mismatch, Please Input Correct Passwords!');	

	}

	

	if($_REQUEST['ERR']==''){		

		$uinfo = $db->select("users","*","username='$_POST[email]'");

		if(mysql_num_rows($uinfo)==0){

			$name = explode(" ", $_POST['v_name']);

			$fname = $name[0];

			$lname='';

			for($i=1;$i<count($name);$i++){

				$lname = trim("$lname $name[$i]");

			}

			$salt = get_rand_val(8);	  			

			$pass = md5(md5($_POST['passa']).md5($salt));

			$cols ="first_name,last_name,email,username,password,salt,level_id,validation,address,com_id,pass,is_active";

			$vals = "'$fname','$lname','$_POST[email]','$_POST[email]','$pass','$salt',5,'$_POST[inv_hash]','$_POST[address]'";

			$vals = "$vals,$COMINF[id],'$_POST[passa]',0";

			$isRegister = $db->insert($cols,$vals,'users');

			if($isRegister){

				msg('sec',"$_POST[v_name] Registered Successfully...");

				$isUpdate = $db->update("inv_status=1","invitation","inv_id=$_POST[inv_id]");

				return true;

			}else{

				msg('err','Registration Error!');	

			}

		}			

	}

	return false;			

}



function subinvitation(){

	$db = new DB();

	global $COMINF;

	if($_POST['v_ftname']=='') msg('err','Please Input Applicant Fathers Name');

	if($_POST['v_dob']=='')    msg('err','Please Input Applicant Date Of Birth');	

	if($_POST['v_nic']=='')    msg('err','Please Input Applicant NIC');	

	

	if($_REQUEST['ERR']==''){

		$case=$db->select("ver_data","com_id","com_id=$COMINF[id] AND v_nic='$_POST[v_nic]'");

		if(mysql_num_rows($case)>0) {

				$_POST['step']=3;

				msg('err',"Applicant NIC [ $_POST[v_nic] ] is Already Exist!");

				return false;

		}

		$dCols = 'v_name,v_nic,v_ftname,v_dob,v_save,qt_id,com_id,v_uadd';

		$uid = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;

		if(is_numeric($_POST['inv_id'])){

			$where = "validation='$_POST[inv_hash]' AND level_id=5";

			$uinfo = $db->select("users","*",$where);

			if(mysql_num_rows($uinfo)>0){

				$uinfo = mysql_fetch_assoc($uinfo);

				$uid = $uinfo['user_id'];

			}

		}		

		$vdate=changDate($_POST['v_dob']);

		$dVals="'$_POST[v_name]','$_POST[v_nic]','$_POST[v_ftname]','$vdate','0',$_POST[pkg],$COMINF[id],$uid";

		$isInsUp = $db->insert($dCols,$dVals,"ver_data");

		

		if($isInsUp){

			$lID=$db->insertedID;

			$_REQUEST['case'] = $lID;

		

			$bcode = cBCode($COMINF['id'],'01',$lID);

			$db->update("v_bcode='$bcode'","ver_data","v_id=$lID");



			$checks=$db->select("package_items","checks_id","pkg_id=$_POST[pkg]");

			while($check=mysql_fetch_array($checks)){

				$cudp = $db->insert("v_id,checks_id,as_uadd","$lID,$check[checks_id],$uid","ver_checks");

				if($cudp){

					$CID=$db->insertedID;

					$ccode = cBCode($COMINF['id'],'01',$lID,$CID);	

					$db->update("as_bcode='$ccode'","ver_checks","as_id=$CID");

				}

			}

		}else{

			msg('err','Case Insertion Error!');

			return false;

		}

		

		if(is_numeric($_POST['inv_id'])){

			$where = "validation='$_POST[inv_hash]' AND level_id=5";

			$uinfo = $db->select("users","*",$where);

			$isUpdate = $db->update("is_active=1","users",$where);

			$uinfo = mysql_fetch_assoc($uinfo);

			$_POST['username'] = $uinfo['username']; 

			$_POST['password'] = $uinfo['pass'];

			$message="$uinfo[first_name] $uinfo[last_name]"."\r\n";

			$message.="<table>

						<tr>

							<td>User Name:</td>

							<td>$uinfo[username]</td>

						</tr>

						<tr>

							<td>Password:</td>

							<td>$uinfo[pass]</td>

						</tr>

						<tr>

							<td>Login URL:</td>

							<td><a href=\"".SURL."?action=login\"".">".PORTAL."</a></td>

						</tr>												

			</table>";



			   $mail             = new PHPMailer();
			   $mail->IsSMTP(); // telling the class to use SMTP
			   $mail->SMTPAuth   = true;                  // enable SMTP authentication
			   $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			   $mail->Host       = "pop.gmail.com";      // sets GMAIL as the SMTP server
			   $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
			   $mail->Username   = "noreply@backgroundcheck365.com";  // GMAIL username
			   $mail->Password   = "&rd8V6tL";            // GMAIL password
			   $mail->SetFrom('noreply@backgroundcheck365.com');
		   
		   
		   $mail->Subject    = "Login Detail";
		   $mail->MsgHTML($message);
		   $mail->AddAddress($uinfo['email']);
		   $mail->Send();
   

			if(doLogin()){

				header("location:".SURL."?action=dashboard");

				exit();

			}

		}

		$_POST['step']=4;

	}

		

}



function quickInvitation(){

	$db = new DB();

	global $COMINF;

		if(is_numeric($_POST['pkg'])){

			for($i=0;$i<=count($_POST['email']);$i++){

				$email=$_POST['email'][$i];

				$name =$_POST['name'][$i];

				if($email!='' && $name!=''){

					if(validateEmail($email)){

						$iinfo = $db->select("users","*","email='$email'");

						if(mysql_num_rows($iinfo)==0){	

							$iinfo = $db->select("invitation","*","email='$email' AND com_id=$COMINF[id]");

							if(mysql_num_rows($iinfo)==0){

							$hash = md5(md5($email).md5($COMINF['id']));

							$cols = "name,com_id,user_id,email,pkg_id,inv_hash";

							$vals = "'$name',$COMINF[id],$_SESSION[user_id],'$email',$_POST[pkg],'$hash'";

							$isInvite = $db->insert($cols,$vals,'invitation');

							if($isInvite){

							   	   $message=$name."\r\n";

							   	$message.="Invitation URl: ".SURL."?invitation=$hash";

								   $mail             = new PHPMailer();
								   $mail->IsSMTP(); // telling the class to use SMTP
								   $mail->SMTPAuth   = true;                  // enable SMTP authentication
								   $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
								   $mail->Host       = "pop.gmail.com";      // sets GMAIL as the SMTP server
								   $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
								   $mail->Username   = "noreply@backgroundcheck365.com";  // GMAIL username
								   $mail->Password   = "&rd8V6tL";            // GMAIL password
								   $mail->SetFrom('noreply@backgroundcheck365.com');
								   
								   
								   $mail->Subject    = "Invitation URL";
								   $mail->MsgHTML($message);
								   $mail->AddAddress($email);
								   $mail->Send();
		   						

								msg('sec',"Invitation Sent Successfully to [ $email ] ...");

							}else{

								msg('err',"Invitation Sending Error [ $email ]!");							

							}

						}else{

							msg('err',"Invitation to [ $email ] is Already Sent!");

						}

						}else{

							msg('err',"Eamil $email is Already in Use!");	

						}

					}else{

						msg('err',"Please type valid email address [ $email ]!");	

					}

				}

			}

			$_POST['step']=4;

		}else{

			msg('err',"Please Select a  Package!");	

		}

}



function bulkUpload(){

	$db = new DB();

	global $COMINF;

	if(isset($_FILES["bulkfile"])){

		if ($_FILES["bulkfile"]["error"] <= 0){

			$fName = $_FILES["bulkfile"]["name"];

			$len = strlen($fName);

			$ext = strtolower(substr($_FILES["bulkfile"]["name"],($len-3)));

			if($ext=='zip'){

				$indx=rand(100,999).strtoupper(get_rand_val(10)).rand(100,999);

				$fPath = "upload/$indx.zip";

				if(move_uploaded_file($_FILES["bulkfile"]["tmp_name"], $fPath)){

					$db->insert("bulk_name,bulk_path,com_id,user_id","'$fName','$fPath',$COMINF[id],$_SESSION[user_id]","bulk_upload");

					$to="kzahid@dataflowgroup.com,mtalal16@yahoo.com";

					$subject="File Upload";

					$message.="File Path: ".SURL.$fPath;

					$headers = "From:noreply@backgroundcheck365.com\r\n";

					$headers .= "Content-type: text/html\r\n";

					//mail($to, $subject, $message, $headers);	

				}

			}else{

				msg('err',"Only zip File is allowed! [ $fName ]"); 

				return false;	

			}

		}

	}else{

		msg('err',"Please Upload zip File!");	

		return false;

	}

	$_POST['step']=4;

}



function docStatus($vid){

	$docs = array();

	$docs['tdcs'] = 0;

	$docs['docs'] = 0;

	$db = new DB();

	$checks = $db->select("ver_checks","*","v_id=$vid");

	if(mysql_num_rows($checks)>0){

		while($check = mysql_fetch_array($checks)){

			$flds = $db->select("fields_maping","*","checks_id=$check[checks_id] AND fl_key<>'file' AND in_id=5");

			while($fld = mysql_fetch_array($flds)){

				$docs['tdcs']=$docs['tdcs']+1;

				$doc = $db->select("add_data","*","as_id=$check[as_id] AND d_type='$fld[fl_key]' AND d_isdlt=0");

				if(mysql_num_rows($doc)>0) $docs['docs']=$docs['docs']+1;

			}

		}

	}

	return $docs;

}



function addctyctry(){

	$db = new DB();

	if(is_numeric($_REQUEST['ascase']) && is_numeric($_POST['country']) && is_numeric($_POST['city'])){

		$isUpdate = $db->update("country_id=$_POST[country],citystate_id=$_POST[city]","ver_checks","as_id=$_REQUEST[ascase]");

		if(!$isUpdate){

			msg('err',"Information Updation Error!");	

		}

	}else{

			msg('err',"Please Input Valid Information!");		

	}

}



function bookmark(){

	$db = new DB();

	if(is_numeric($_REQUEST['case'])){

		$info = $db->select("ver_data","v_bmk","v_id=$_REQUEST[case]");

		$info = mysql_fetch_array($info);

		if($info['v_bmk']==0) $info['v_bmk']=1; else $info['v_bmk']=0; 

		$isIncUp = $db->update("v_bmk=$info[v_bmk]","ver_data","v_id=$_REQUEST[case]"); 

		if($isIncUp){

			if($info['v_bmk']==1){

				echo 'bmarked';	

			}else{

				 echo 'umarked';

			}	

		}

	}

}



function changDate($date,$dif=0){

	$montharray = array (

        '01' => 'Jan',

        '02' => 'Feb',

        '03' => 'Mar',

        '04' => 'Apr',

        '05' => 'May',

        '06' => 'Jun',

        '07' => 'Jul',

        '08' => 'Aug',

        '09' => 'Sep',

        '10' => 'Oct',

        '11' => 'Nov',

        '12' => 'Dec' );

	$explode = explode(' ',$date);

	foreach($montharray as $key => $val){

		if(strtolower($explode[1]) == strtolower($val)){

			$explode[1] = $key; 

			break;

		}

	}	

	if(strlen($explode[0])==1) $explode[0] = '0'.$explode[0];

	$date = $explode[2].'-'.$explode[1].'-'.$explode[0];

	

	$date=strtotime($date)+(86400*$dif);

	$date = date("Y-m-d",$date);

	return $date;

}	



function editProfile(){

$db = new DB();

$para = "name='$_REQUEST[name]',email='$_REQUEST[email]',title='$_REQUEST[title]',address='$_REQUEST[address]',pagetitle='$_REQUEST[pagetitle]',pagesolgan='$_REQUEST[pagesolgan]',pagedesc='$_REQUEST[pagedesc]'

,agreement='$_REQUEST[agreement]'";

$isIncUp = $db->update($para,"company","id=$_REQUEST[id]");

if(isset($_FILES['logo']) && $_FILES['logo']['name']!=''){	

			$FPATH =$_SERVER['DOCUMENT_ROOT']."/";

			$fileName =$_FILES['logo']['name'];

			$ext = explode('.',$fileName);

			$ext = strtolower($ext[(count($ext)-1)]);

			$extIAy = array('jpg','gif','png');

			if(in_array($ext,$extIAy)){

				$time = date("j-M-y_H:i:s",time());

				$rval = rand(100,999);

				$fPath = "logos/$fileName-$time.$ext";

				$tID = $_REQUEST['task'];

				if(move_uploaded_file($_FILES["logo"]["tmp_name"],$fPath)){

					$isIncUp = $db->update("logo='$fPath'","company","id=$_REQUEST[id]");

					if(!$isIncUp) msg('err',"File Uploading Error !");					

				}else 	msg('err',"File Uploading Error !");	

							

			}else msg('err',"$ext File Type is not Allowed [ $fileName ]"); 	

		}

if($isIncUp){

				msg('sec',"Profile Edited Successfully...");					

				return true;	

			} 	msg('err',"Profile Editing Error !");



}



function editPackage(){

	$db = new DB();

	$db->delete("package_items","pkg_id=$_REQUEST[pkg_id]");

	if(is_array($_POST['checks'])){

		$error='No';

	foreach($_POST['checks'] as $checks)

		{

			$isInsUp = $db->insert('pkg_id,checks_id',"$_REQUEST[pkg_id],$checks","package_items");

			if($isInsUp ){

				$success='Package Edited Successfully';

				}

		}

	}else{

			$error='Please select at least one check';

			}

	

}

function search($TABLE,$FIELDS){

	$SSTR='';

	global $action;

	if(isset($_REQUEST['search_str'])){

		if($_REQUEST['search_str']!=''){

				$FIELDS = explode(',',$FIELDS);

				foreach($FIELDS as $FIELD){

					$SSTR = (($SSTR!='')?"$SSTR OR ":'')." $FIELD LIKE '%$_REQUEST[search_str]%'";

				}

				if($SSTR!='') $SSTR = "AND ($SSTR)";

		}

	}	

	return $SSTR;

}



function create_pkg(){

		$db = new DB();

	$error='No';

	$cols='pk_name,pkg_type,user_id';

	$values="'$_POST[pname]',1,$_SESSION[user_id]";

	if($_POST['pname']!=''){

	$isInsUp = $db->insert($cols,$values,"packages");

	$insert_id=mysql_insert_id();

	if(is_array($_POST['checks'])){

	foreach($_POST['checks'] as $checks)

		{

			$isInsUp = $db->insert('pkg_id,checks_id',"$insert_id,$checks","package_items");

			

		}

		

	$_POST['pkg']=$insert_id;

		}else{

		//$error='Please select at least one check';

		 msg('err',"Please select at least one check!");	

		}

	}

	else{

		 // $error = "Please Insert Package name"; 

		  msg('err',"Please Insert Package name!");	

		}

	

}



function register_(){

		$db = new DB();

		if($_POST['passa'] != $_POST['passb']){

			msg('err',"You have to type the same password for control!");			

		}else{

			$_POST['email'] = addslashes($_POST['email']);

			

			if($_POST['fname'] == NULL) msg('err',"Please Enter First Name!");

			

			if($_POST['lname'] == NULL) msg('err',"Please Enter Last Name!");		

			

			if($_POST['ulevel'] == 4){

					if($_POST['com_id'] == NULL || $_POST['com_id'] == 0) msg('err',"Please Select Company!");

			}else{

				if($_POST['ulevel'] == NULL || $_POST['ulevel'] == 0) msg('err',"Please Select User Level!");

			}

			

			if(!validateEmail($_POST['email'])){

				msg('err',"Please Enter Valid Email!");

			}else{

				$_POST['email'] = addslashes($_POST['email']);

				if(!isset($_POST['uid'])){

					$userInfo = $db->select('users','user_id',"username='$_POST[email]'");	

					if(mysql_num_rows($userInfo) > 0) msg('err',"This email account is already registered!");					

				}

			}

			

			if($_POST['passa'] == NULL) msg('err',"Please Enter Password!");

			

			if($_POST['ulevel']== 0) msg('err',"Please Select User Level!");

									

			if($_REQUEST['ERR']==''){

				$cols ="first_name,last_name,email,username,password,salt,level_id";

				if(isset($_POST['com_id'])) $cols ="$cols,com_id,u_type";

				$salt = get_rand_val(8);

				$pass = md5(md5($_POST['passa']).md5($salt));

				$vals = "'$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[email]','$pass','$salt',$_POST[ulevel]";

				if(isset($_POST['com_id'])) $vals ="$vals,$_POST[com_id],1";

				if(isset($_POST['uid'])){

					$isRegister = $db->updateCol($cols,$vals,'users',"user_id=$_POST[uid]");

					$title="Edited";

				}else{

					$isRegister = $db->insert($cols,$vals,'users');

					$title="Registered";

				}

				if($isRegister){

					msg('sec',"User $title [ $_POST[fname] $_POST[lname] ] Successfully...");					

					return true;	

				}else{

					msg('err',"User $title [ $_POST[fname] $_POST[lname] ] Error!");					 

					return false;

				} 						 

			}

		} return false;	

}







function addsubuser_(){

		$db = new DB();

		if($_POST['passa'] != $_POST['passb']){

			msg('err',"You have to type the same password for control!");			

		}else{

			$_POST['email'] = addslashes($_POST['email']);

			

			if($_POST['fname'] == NULL) msg('err',"Please Enter First Name!");

			

			if($_POST['lname'] == NULL) msg('err',"Please Enter Last Name!");	

			if($_POST['country'] == NULL) msg('err',"Please Enter Country!");		

			

			

			if(!validateEmail($_POST['email'])){

				msg('err',"Please Enter Valid Email!");

			}else{

				$_POST['email'] = addslashes($_POST['email']);

				if(!isset($_POST['uid'])){

					$userInfo = $db->select('users','user_id',"username='$_POST[email]'");	

					if(mysql_num_rows($userInfo) > 0) msg('err',"This email account is already registered!");					

				}

			}

			

			if($_POST['passa'] == NULL){

				if(!isset($_POST['uid'])){

				 		msg('err',"Please Enter Password!");

				}

			}

					

			if($_REQUEST['ERR']==''){

				$cols ="country,first_name,last_name,email,username,level_id,is_subuser,no_rights,puser_id,com_id,u_type";

				if(isset($_POST['comid'])) $cols ="$cols,com_id";

				

				$salt = get_rand_val(8);

				$pass = md5(md5($_POST['passa']).md5($salt));

				

				if(isset($_POST['no_rights'])) $no_rights = implode('|',$_POST['no_rights']); else $no_rights='';

				$no_rights .= (($no_rights!='')?'|':'').'48';

				$comInfo = companyInfo($_SESSION['user_id']);

				$uID = $comInfo['id'];							

				$vals = "'$_POST[country]','$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[email]',4,1,'$no_rights',$_SESSION[user_id],$uID,1";

				if(isset($_POST['comid'])) $vals ="$vals,$_POST[comid]";

				if(isset($_POST['uid'])){

					if($_POST['passa'] != NULL){

						$cols ="$cols,password,salt";

						$vals = "$vals,'$pass','$salt'";

					}

					$isRegister = $db->updateCol($cols,$vals,'users',"user_id=$_POST[uid]");

					$title="Edited";

				}else{

					$cols ="$cols,password,salt";

					$vals = "$vals,'$pass','$salt'";

					$isRegister = $db->insert($cols,$vals,'users');

					$title="Registered";

				}

				if($isRegister){

					msg('sec',"User $title [ $_POST[fname] $_POST[lname] ] Successfully...!");					

					return true;	

				}else{

					msg('err',"User $title [ $_POST[fname] $_POST[lname] ] Error!");					 

					return false;

				} 						 

			}

		} return false;	

}





function enabdisb($tbl,$where,$msg=''){

		global $db;

		$data = $db->select($tbl,'is_active',$where);

		if(mysql_num_rows($data)>0){

			$data = mysql_fetch_assoc($data);

			if($data['is_active']==1){

				$tx = "Disabl";

				$uVal=0;

			}else{

				$tx = "Enabl";

				$uVal=1;

			}

			$isUpdate = $db->update("is_active=$uVal",$tbl,$where);

			if($isUpdate){

				msg('sec',$tx."ed $msg Successfully...");	

			}else{

				msg('err',$tx."ing $msg Error!");

			}

		}

}



function bindArray($dataAry,$c=0){

	$data= array();$row=0;

	if(is_array($c)){ $row=count($c); $data= $c; }

	if(mysql_num_rows($dataAry)>0){

		while($darys = mysql_fetch_assoc($dataAry)){

				foreach($darys as $key=>$m){

					$data[$row][$key] = $darys[$key];

				} $row=$row+1;

		} return $data;

	} if($c!=0) return $c; else return false;	

}



function shortLinks(){

	global $db; global $LEVEL; global $CPAGE; global $IPAGE;	

	$sLinkAry= array(); $cnt=0;

	$mLink = $db->select("menus","*","m_id=$IPAGE[m_id]");

	if(mysql_num_rows($mLink)==1){

		$slAry = bindArray($mLink);

		if($slAry){

			$isP = $slAry[0]['m_pid'];

			while($isP!=0){

				$mLink = $db->select("menus","*","m_id=$isP");

					$slAry = bindArray($mLink,$slAry);

				if(!$slAry) $isP=0;else $isP = $slAry[(count($slAry)-1)]['m_pid'];

				if($cnt>10) return false;

				$cnt=$cnt+1;

			} 

			$CPAGE=$slAry[(count($slAry)-1)]['m_id'];

		}

	}

	if($slAry){

		if(is_numeric($_REQUEST['_pid'])){

			$mLink = $db->select("menus","*","m_id=$_REQUEST[_pid]");

			$slAry = bindArray($mLink,$slAry);

		}

	}

	return $slAry;

}





function addpage(){

	global $db;	

	$uID = $_SESSION['user_id'];

	if(is_numeric($_POST['pid'])){

		$dCunt=0;

	}else{

		$data= $db->select("menus","*","m_action LIKE '$_POST[aname]' AND m_atype LIKE '$_POST[actyp]'");

		$dCunt = mysql_num_rows($data);

	}

	if(!is_numeric($_POST['search'])) $_POST['search']=0;

	if($dCunt==0){

			$cols="s_id,m_action,m_atype,m_actitle,m_attitle,m_include,m_mdesc,m_mkeyw,m_lrb,m_pid,m_odr,user_id";

			$vals="$_POST[search],'$_POST[aname]','$_POST[actyp]','$_POST[atitl]','$_POST[ttitl]','$_POST[ifile]'";

			$vals="$vals,'$_POST[mdisc]','$_POST[mkeyw]',$_POST[doptn],$_POST[ppage],$_POST[dodr],$uID";

			if(is_numeric($_POST['pid'])){

				$isAddEdit = $db->updateCol($cols,$vals,'menus',"m_id=$_POST[pid]");

				$title='Edit';

			}else{

				$isAddEdit = $db->insert($cols,$vals,'menus');

				$title='Add';

			}

			if($isAddEdit){

				msg('sec',"Page [ $_POST[atitl] ] ".$title."ed Successfully...");					

				return true;	

			} 	msg('err',"Page [ $_POST[atitl] ] ".$title."ing Error !");

	}else{

		msg('err',"Page [ $_POST[atitl] ] is Already Added !");				

	} return false;

}



function addsearch(){

	global $db;	

	$uID = $_SESSION['user_id'];

	if(is_numeric($_POST['s_id'])){

		$dCunt=0;

	}else{

		$data= $db->select("search","*","s_table LIKE '$_POST[s_table]' AND s_fields LIKE '$_POST[s_fields]'");

		$dCunt = mysql_num_rows($data);

	}

	if($dCunt==0){

			$cols="s_table,s_fields,s_title";

			$vals="'$_POST[s_table]','$_POST[s_fields]','$_POST[s_title]'";

			if(is_numeric($_POST['s_id'])){

				$isAddEdit = $db->updateCol($cols,$vals,'search',"s_id=$_POST[s_id]");

				$title='Edit';

			}else{

				$isAddEdit = $db->insert($cols,$vals,'search');

				$title='Add';

			}

			if($isAddEdit){

				msg('sec',"Page [ $_POST[s_table] ] ".$title."ed Successfully...");					

				return true;	

			} 	msg('err',"Page [ $_POST[s_table] ] ".$title."ing Error !");

	}else{

		msg('err',"Page [ $_POST[s_table] ] is Already Added !");				

	} return false;

}





function adUpRights(){

	global $db;

	$ids = explode('|',$_REQUEST['right']);

	if(is_numeric($ids[0]) && is_numeric($ids[1])){

		$data= $db->select("access","level_id","level_id=$ids[1] AND m_id=$ids[0]");

		if(mysql_num_rows($data)==0){

			$cols="level_id,m_id";

			$vals="$ids[1],$ids[0]";

			$isAddEdit = $db->insert($cols,$vals,'access');

			$title='Add';

		}else{

			$isAddEdit = $db->delete('access',"level_id=$ids[1] AND m_id=$ids[0]");

			$title='Delet';	

		}

		

		if($isAddEdit){

			msg('sec',"Right ".$title."ed Successfully...");

		}else{

			msg('err',"Right ".$title."ing Error !");

		}		

	}

}



function getRrights(){

	global $LEVEL;global $USER;

	//$rrights= array(26);

	$ewhere='';

	if($LEVEL==4){

		if($USER['is_subuser']==1){

			$USER['no_rights']= str_replace('|',',',$USER['no_rights']);

			//$surght = $db->select("subuser_rights","m_id","sr_id IN($USER[no_rights]) AND m_id<>0");

			$ewhere = "AND mn.m_id NOT IN($USER[no_rights])";

		}	

	}	

	return $ewhere;

}



function getSubMenus($id){

	global $db; global $LEVEL;

	$aMenu= array();$row=0;	

	global $USERID;

	 

	 

	$tbl="menus mn INNER JOIN access ac ON mn.m_id=ac.m_id";

	$where="(ac.level_id=$LEVEL OR ac.user_id=$USERID) AND mn.m_lrb<>-1 AND mn.m_pid=$id";

	$menues = $db->select($tbl,"DISTINCT *","$where ORDER BY mn.m_odr ASC");

	if(mysql_num_rows($menues)>0){

		return $menues;

	}

	return false;

}



function getMenus(){

	global $db; global $LEVEL;

	global $USERID;

	$aMenu= array();$row=0;

	$tbl="menus mn INNER JOIN access ac ON mn.m_id=ac.m_id";

	$where="(ac.level_id=$LEVEL OR ac.user_id=$USERID) AND mn.m_lrb<>-1 AND mn.m_pid=0";

	$menues = $db->select($tbl,"DISTINCT *","$where ORDER BY mn.m_odr ASC");

	return bindArray($menues);

}



function getPage(){

	global $db;

	global $ACTION; global $ATYPE; global $LEVEL;

	global $USERID;

	

	$tbl="menus mn INNER JOIN access ac ON mn.m_id=ac.m_id";

	$where= "m_action='$ACTION' AND (m_atype='$ATYPE' OR m_atype IS NULL) AND (ac.level_id=$LEVEL OR ac.user_id=$USERID) $ewhere";	

	$iPage = $db->select($tbl,"DISTINCT *",$where);

	if(mysql_num_rows($iPage)>0){

		$iPage = mysql_fetch_assoc($iPage);

		if(file_exists("include_pages/$iPage[m_include]")) return $iPage;

	} return false;

}



function getSrch($sID){

	if(is_numeric($sID)){ 

		global $db;

		$tbl = "search sr INNER JOIN menus mn ON sr.s_id=mn.s_id";

		$cls = "mn.m_action,mn.m_atype,sr.s_fields,sr.s_title";

		$iSrch = $db->select($tbl,$cls,"sr.s_id=$sID");

		if(mysql_num_rows($iSrch)>0) return mysql_fetch_assoc($iSrch);

	} return false;

}



function subArchive(){

	$db = new DB();

	if(isset($_POST['acase'])){

		foreach($_POST['acase'] as $case){

			if(is_numeric($case)){

				$isUpdate = $db->update("v_archvi=1","ver_data","v_id=$case");

			}

		}

	}else{

		msg('err',"Please Select Any Case to Archived!");

			

	}

}



function ordCertif(){

	$db = new DB();

	if(isset($_POST['acase'])){

		foreach($_POST['acase'] as $case){

			if(is_numeric($case)){

				$isUpdate = $db->update("is_certif=1","ver_data","v_id=$case");

			}

		}

		msg('sec',"Certificate Ordered Succefully...");

	}else{

		msg('err',"Please Select Any Case to Order Certificate!");

			

	}

}

			

function bcplcode($num){

	for($ind=strlen($num);$ind<5;$ind++){

		$num = '0'.$num;

	}

	return 'BCPL-'.$num;

}


function orderCode($comID){

		global $db;
		if(is_numeric($comID)){
			$sname = $db->select("company","id","id=$comID");
			$sname = mysql_fetch_assoc($sname);
			$sname = $sname['id'];
			if(strlen($sname)==1) $sname = "0$sname";
			$orders = $db->select("ver_data","COUNT(v_id) cnt","com_id=$comID AND  YEAR(v_date)=YEAR(CURDATE())");
			$orders = mysql_fetch_assoc($orders);
			$cnt = ($orders['cnt']==0)?1:$orders['cnt']+1;		

			if($cnt<100){
				if($cnt<10) $cnt = (string)"00$cnt"; else $cnt = (string)"0$cnt";
			}

			return "$sname".date("my")."$cnt";

		}
}

function cBCode($comID,$prj,$vID='',$cID=''){

		global $db;

		if(is_numeric($vID) && is_numeric($cID)){

			$cBcode = $db->select("ver_data","v_bcode","v_id=$vID");

			$cBcode = mysql_fetch_assoc($cBcode);

			$cBcode = $cBcode['v_bcode'];

			

			$CName = $db->select("checks","checks_sname","checks_id=$cID");

			$CName = mysql_fetch_assoc($CName);	

			$CName = $CName['checks_sname'];			

			

			$cnt = $db->select("ver_checks","COUNT(as_id) cnt","checks_id=$cID AND v_id=$vID");

			$cnt = mysql_fetch_assoc($cnt);

			$cnt = ($cnt['cnt']==0)?1:$cnt['cnt'];

			

			if($cnt<100){

				if($cnt<10) $cnt = (string)"00$cnt"; else $cnt = (string)"0$cnt";

			}

			return "$cBcode-"."$CName".$cnt;

		}

		

		$comSname = $db->select("company","sname","id=$comID");

		$comSname = mysql_fetch_assoc($comSname);

		$comSname = $comSname['sname'];

		$sDate = date("Y-m",time());

		$cnt = $db->select("ver_data","COUNT(com_id) cnt","com_id=$comID AND v_date LIKE '$sDate%'");

		$cnt = mysql_fetch_assoc($cnt);

		$cnt = ($cnt['cnt']==0)?1:$cnt['cnt'];

		if($cnt<100){

			if($cnt<10) $cnt = (string)"00$cnt"; else $cnt = (string)"0$cnt";

		}

		return "$comSname$prj-".date("my",strtotime($sDate))."-$cnt";	

}

	

function result_link($out){

    $pr = array('">', '<img', '"', ',', ';', ')');

    $pa = array('', '', '', '', '', '');

    foreach ($out as $out){

        foreach ($out as $out){

            if ($out == 'http://'){

            }else{

                $a[] = str_replace($pr, $pa, $out);

            }

        }

    }

    if (is_array($a)){

        return array_unique($a);

    }

}



function get_filter_link($a, $text){

    foreach ($a as $b){

        $ree = array("<br>", "<Br>", "<Br />", " ");

        $url = str_replace($ree, "", $b);

        if ($url == 'http://' or $url == 'https://' or $url == 'www.'){

        }else{

            if (strlen($b) > 55)

                $b = substr($b, 0, 55) . "...";

            $olda = "#((https?://)[^\s]+)#i";

            if (preg_match($olda, $url)){

                $text = str_replace($url, "<a href=\"$url\" target=\"_blank\" title=\"$url\">$b</a>", $text);

            }else{

                $text = str_replace($url, "<a href=\"http://$url\" target=\"_blank\" title=\"$url\">$b</a>", $text);

            }

        }

    }

    return $text;

}



function change_url_in_text($text){

    if(validateEmail($text)){

		return '<a href="mailto:'.$text.'">'.$text.'</a>';

	}

	

	if (preg_match("/href=/i", $text)){

        return $text;

    }else{

        $old = "#((https?://|www.)[^\s]+)#i";

        if (preg_match($old, $text)){

            preg_match_all($old, $text, $out);

            $a = result_link($out);

            return get_filter_link($a, $text);

        }else{

            return $text;

        }

    }

}



function notifiMsgs($verCheck){

	global $LEVEL;

	$csSts = strtolower($verCheck['as_status']);

	if($LEVEL==2){

		switch($csSts){

			case'close':

				$eNot=($verCheck['as_adcls']==1)?(($verCheck['as_sent']==4)?'Sent':'Ready for Send'):"Ready for Remark";

				return "-".$eNot;

			default:

				return "-".$verCheck['as_vstatus'];

		}

	}

	return '';

}



function addUnie(){

	$db = new DB();

	$uID = $_SESSION['user_id'];
	if(!is_numeric($_POST['ufee'])) msg('err',"Please input valid fee amount!");
	$rgn = htmlspecialchars(trim($_REQUEST['rgn']));

	$cty = htmlspecialchars(trim($_REQUEST['cty']));

	$uni = htmlspecialchars(trim($_REQUEST['uni']));
	
	$beneficiary = htmlspecialchars(trim($_REQUEST['beneficiary']));

	$url = trim($_REQUEST['url']);

	$vendor = htmlspecialchars(trim($_REQUEST['vendor']));
	$charges = is_numeric(trim($_REQUEST['charges']))?trim($_REQUEST['charges']):0;
	
	$acd = trim($_REQUEST['acd']);
	$ddreq = (isset($_REQUEST['ddreq']))?1:0;
	$nfee = (isset($_REQUEST['nfee']))?1:0;
	
	$inf = htmlspecialchars(trim($_REQUEST['inf']));	
	if(is_numeric($_POST['ufee'])){
	if(!isset($_REQUEST['id'])){

		$values = "'$beneficiary',$_POST[ufee],'$rgn','$cty','$uni','$url','$acd','$inf',$uID,CURRENT_TIMESTAMP,'$vendor',$charges,$ddreq,$nfee";	

		$cols="uni_ben,uni_fee,uni_region,uni_city,uni_Name,uni_url,uni_ac_url,uni_var,uni_uadd,uni_addate,uni_vendor,uni_vchar,uni_ddr,uni_nfe";

		$uniInfo = $db->select("uni_info","uni_id,uni_Name","uni_Name LIKE '$uni'");		
		
		
		if(mysql_num_rows($uniInfo) == 0){

			$isInsUp = $db->insert($cols,$values,"uni_info");	
			
			if($isInsUp){

				addActivity('uni',"$uni",$LEVEL,'','',$db->insertedID,'add');

				msg('sec',"Inseted Successfully  [ $uni ]...");

			}else{

				msg('err',"Insertion Error  [ $uni ]!");

			}

		}else{

			msg('err',"$uni is already there");

			$uniInfo = mysql_fetch_array($uniInfo);

			$_REQUEST['id']	= $uniInfo['uni_id'];

		}		

	}else{

		if($uni!=''){

			$id = $_REQUEST['id'];

			$values ="uni_ben='$beneficiary',uni_fee=$_POST[ufee],uni_region='$rgn',uni_city='$cty',uni_Name='$uni',";

			$values .="uni_url='$url',uni_ac_url='$acd',uni_var='$inf',";
			
			$values .="uni_vendor='$vendor',uni_vchar=$charges,uni_ddr=$ddreq,uni_nfe=$nfee";

			$isUpdate = $db->update($values,"uni_info","uni_id=$id");

			if($isUpdate){

				addActivity('uni',"$uni",$LEVEL,'','',$id,'edit');

				msg('sec',"Updated Successfully  [ $uni ]...");	

			}else{

				msg('err',"Updatation Error [ $uni ]!");	

			}

		}else{

				msg('err',"Please Input/Select Required Fields!");	

		}

	}
	}

}



function removeOpenCs(){

	if(isset($_REQUEST['opencasck']) || isset($_REQUEST['delecasck'])){

		global $LEVEL;$db = new DB();

		if(isset($_REQUEST['delecasck'])) $atype="Remov"; else $atype="Open";

		if(isset($_REQUEST['vchecks'])){

			foreach($_REQUEST['vchecks'] as $vcheck){

				$vCheck = getCheck(0,0,$vcheck);

				$vData  = getVerdata($vCheck['v_id']);

				$tCheck = getCheck($vCheck['checks_id'],0,0);

				if(isset($_REQUEST['delecasck'])){

					$uCols="as_isdlt=1";

				}else{

					$uCols="as_status='Open',as_sent=0,as_adcls=0,as_cdnld=0";

				}

				$isUpdate = $db->update($uCols,"ver_checks","as_id=$vcheck");

				if($isUpdate){

					addActivity('check',"",$LEVEL,'',$vCheck['v_id'],$vcheck,$atype.'ed');

					 msg('sec',"$tCheck[checks_title] ".$atype."ed Successfully...");

				}else{

					 msg('err',"$tCheck[checks_title] ".$atype."ing Error!");

				}

			}

		}elseif(isset($_REQUEST['record'])){ 

			foreach($_REQUEST['record'] as $term){

				$vData  = getVerdata($term);

				$uInfo = getUserInfo($uID);	

				if(isset($_REQUEST['delecasck'])){

					$uCols="v_isdlt=1";

				}else{

					$uCols="v_status='Open',v_sent=0,v_mdnld=0,v_cdnld=0";

				}							

				$isUpdate = $db->update($uCols,"ver_data","v_id=$term");

				if($isUpdate){

					addActivity('case',"",$LEVEL,'',$term,'',$atype.'ed');

					msg('sec',"$vData[v_name] ".$atype."ed Successfully ...");

				}else{

					msg('err',"$vData[v_name] ".$atype."ing Error!");

				}

			}

		}else{

			 msg('err',"Please Checkout any Case / Check to $atype");

		}	

	}

}



function assignChecks(){

	$uID  = $_REQUEST['uid']; global $LEVEL;

	$db = new DB();

	if($uID!='0'){

		if(isset($_REQUEST['rassigncases'])){

			$uWhere="";

			$acTp ='reassign';

		}else{

			$uWhere="AND ISNULL(user_id)";

			$acTp ='assign';

		}

		

		if(isset($_REQUEST['vchecks'])){

			foreach($_REQUEST['vchecks'] as $vcheck){

				$vCheck = getCheck(0,0,$vcheck);

				$vData  = getVerdata($vCheck['v_id']);

				$tCheck = getCheck($vCheck['checks_id'],0,0);

				$uInfo  = getUserInfo($uID);

				$uCols="user_id=$uID,as_status='Open',as_date=CURRENT_TIMESTAMP,as_pdate=CURRENT_TIMESTAMP";

				$isUpdate = $db->update($uCols,"ver_checks","as_id=$vcheck $uWhere");

				if($isUpdate){

					addActivity('check',"$vData[v_name] Assigned to [ $uInfo[first_name] ]",$LEVEL,'',$vCheck['v_id'],$vcheck,$acTp);

					$isUpdate = $db->update("v_status='Open'","ver_data","v_id=$vCheck[v_id]");

					 msg('sec',"$tCheck[checks_title] on $vData[v_name] Assigned to [ $uInfo[first_name] ] Successfully ...");

				}else{

					msg('err',"$tCheck[checks_title] on $vData[v_name] Assigning Error! to [ $uInfo[first_name] ]");

				}

			}

		}else if(isset($_REQUEST['record'])){ 

			foreach($_REQUEST['record'] as $term){

				$vData  = getVerdata($term);

				$uInfo = getUserInfo($uID);				

				$isUpdate = $db->update("user_id=$uID,as_status='Open',as_date=CURRENT_TIMESTAMP","ver_checks","v_id=$term $uWhere");

				if($isUpdate){

					addActivity('case',"$vData[v_name] Assigned to [ $uInfo[first_name] ]",$LEVEL,'',$term,'',$acTp);

					$isUpdate = $db->update("v_status='Open'","ver_data","v_id=$term");

					msg('sec',"Check(s) on $vData[v_name] Assigned to [ $uInfo[first_name] ] Successfully ...");

				}else{

					msg('err',"Check(s) on $vData[v_name] Assigning Error! to [ $uInfo[first_name] ]");

				}

			}

			

		}else{

			 msg('err',"Please Checkout Any Case to Assign");

			 

		}

	}else{

		 msg('err',"Please Select Any User to Assign Case(s)");

		 

	}

}



function vs_Status($vStatus){

		switch($vStatus){

			case 'verified':

			case 'satisfactory':

			case 'no match found':

			case 'no record found':

			case 'positive match found':

				$vSts = 'Green';	

			break;

			case 'negative':

			case 'match found':

			case 'record found':

			case 'unsatisfactory':

				$vSts = 'Red';

			break;

			case 'insufficient':					

				$vSts = 'sYellow';	

			break;

			case 'unable to verify':

			case 'discrepancy':

			case 'original required':

				$vSts = 'Amber';

			break;							

		}	

		return $vSts;

}



function countChecks($where='',$lvl=true,$page=""){

	$db = new DB();

	global $LEVEL, $ATYPE;
	
	if($LEVEL==4){

		global $COMINF;

		$where.=(($where!='')?' AND ':'')."vd.com_id=$COMINF[id]";

	}else if($LEVEL==3){

		if($page!='assign'){

			$where.=(($where!='')?' AND ':'')."vc.user_id=$_SESSION[user_id]";

		}

	}

	if($_SESSION['user_id']==83){

		$where.=(($where!='')?' AND ':'')."vd.com_id=20";

	}	

	if($where=='') $where="vc.as_isdlt=0"; else $where="$where AND vc.as_isdlt=0";

	$cCnt = $db->select("ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id","COUNT(DISTINCT vc.as_id) cnt",$where);
	if($cCnt && mysql_num_rows($cCnt)>0){
		$cCnt = mysql_fetch_array($cCnt);
	}else{
		$cCnt['cnt'] = 0;	
	}

	return $cCnt['cnt'];

}



function countCases($where='',$lvl=true,$atype=''){

	$db = new DB();

	global $LEVEL;

	if($atype=='ddrequest'){
		return count_pending_dd();
	}
	
	if($LEVEL==4){

		global $COMINF;

		$where.=(($where!='')?' AND ':'')."vd.com_id=$COMINF[id]";

	}else if($LEVEL==3){

		$where.=(($where!='')?' AND ':'')."vc.user_id=$_SESSION[user_id]";

	}

	

	if($_SESSION['user_id']==83){

		$where.=(($where!='')?' AND ':'')."vd.com_id=20";

	}

		

	if($where=='') $where="vd.v_isdlt=0"; else $where="$where AND vd.v_isdlt=0";

	$qCnt = $db->select("ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id","COUNT(DISTINCT vd.v_id) cnt",$where);

	//echo $db->query;

	$qCnt = mysql_fetch_array($qCnt);

	return $qCnt['cnt'];

}



function checkQuote($where){

	$db = new DB();

	$cCnt = $db->select("quotes","COUNT(qt_id) cnt",$where);

	$cCnt = mysql_fetch_array($cCnt);

	return $cCnt['cnt'];

}



function froofLbl($nos){

	switch($nos){

		case 0:

			return 'a';	

		case 1:

			return 'b';

		case 2:

			return 'c';

		case 3:

			return 'd';

		case 4:

			return 'e';

		case 5:

			return 'f';

		case 6:

			return 'g';																		

	}	

}





function addQPrice(){

	if(is_numeric($_REQUEST['price'])){

		$db = new DB();

		$isIncUp = $db->update("qt_price=$_REQUEST[price],qt_sent=1","quotes","qt_id=$_REQUEST[qId]");

		if($isIncUp){

			echo msg('sec',"Ouote price submitted Successfully...");

		}else{

			echo msg('err',"Ouote price submittion Error!");	

		}

	}else{

		echo msg('err',"Invalid price, please input number only !");	

	}	

}





function subPackage(){

	$db = new DB();

	$comInfo = companyInfo($_SESSION['user_id']);

	$uID = $comInfo['id'];

	$values= "$_REQUEST[screening],$uID";

	$isIncUp = $db->insert("sc_id,com_id",$values,"quotes");

	$qID = $db->insertedID;

	if($isIncUp){

		foreach($_REQUEST['checks'] as $check){

			if(is_numeric($check)){

				$values = "$check,$qID";

				$isIncUp = $db->insert("checks_id,qt_id",$values,"qt_maping");

				$cInf = getCheck($check);

				if($isIncUp){

					echo msg('sec',"Check[ $cInf[checks_title] ] added Successfully...");

				}else{

					echo msg('err',"Check[ $cInf[checks_title] ] added Error!");

				}

			}

		}

	}

	return $isIncUp;

}





function browserInf(){

	$browser = strtolower($_SERVER['HTTP_USER_AGENT']);

	if(strpos($browser,'firefox') !== false) define('BR','FF');

	if(strpos($browser,'safari') !== false) define('BR','SF');

	if(strpos($browser,'chrome') !== false) define('BR','GC');

	if(strpos($browser,'msie') !== false){

		$brInfo = explode(';',$browser);

		foreach($brInfo as $inf){

			$inf = trim($inf);

			if(strpos($inf,'msie') !== false){

					$vr = explode(' ',$inf);

					define('VRT',$vr[1]);

					$vr  = (int)$vr[1];

					define('VR',$vr);

			}

		}

		define('BR','IE');

	} 

	if(strpos($browser,'opera') !== false) define('BR','OP');

	return BR;	

}

function addreply(){

	$db = new DB();

	$_REQUEST['reply'] = ($_REQUEST['reply']);	

	$comnts = $db->select("comments","com_id","_id=$_REQUEST[comID] AND com_text LIKE '$_REQUEST[reply]'");

	if(mysql_num_rows($comnts)==0){

		$uID = $_SESSION['user_id']; 

		$cols = "p_id,com_text,user_id";

		$vals = "$_REQUEST[comID],'$_REQUEST[reply]',$uID";

		$isInc = $db->insert($cols,$vals,'comments');

		if($isInc){

			msg('sec',"Reply inserted Successfully...");

			

		}else{

			msg('err',"Reply insertion Error!");

			

		}	

	}

}





function addProject(){

	$db = new DB();

	if(is_numeric($_REQUEST['com_id'])){

		if(trim($_REQUEST['prname'])!=''){	

				$pCnts = $db->select("projects","COUNT(com_id) cnt","com_id=$_REQUEST[com_id]");

				$pCnts = mysql_fetch_assoc($pCnts);

				$pCnts = $pCnts['cnt']+1;

				if($pCnts<10) $pCnts = (string)"0$pCnts"; else $pCnts = (string)"$pCnts";				

				$project = $db->select("projects","com_id","com_id=$_REQUEST[com_id] AND pro_name='$_REQUEST[prname]'");

				if(mysql_num_rows($project)==0){

					$cols   ="com_id,pro_lid,pro_name,pro_cperson,pro_contact,pro_panlst,pro_sanlst,pro_note";

					$values = "$_REQUEST[com_id],'$pCnts','$_REQUEST[prname]','$_REQUEST[poname]','$_REQUEST[pocont]'";

					$values = "$values,'$_REQUEST[priran]','$_REQUEST[secran]','$_REQUEST[notes]'";

					$isIncUp = $db->insert($cols,$values,"projects");

					if($isIncUp){		

						msg('sec',"Projects [$_REQUEST[prname]] Added Successfully...");

						

						return true;			

					}else{

						msg('err',"Projects Adding Error!");

									

						return false;

					}					

				}else{

					msg('err',"Projects [$_REQUEST[prname]] is Already Added...");

						

					return false;			

				}	

		}

	}else{

		msg('err',"Please Select Company Name!");

				

	}

}



function add_client_checks($clid){
	$db = new DB();
	
	$db->update("clt_active=0","clients_checks","com_id=$clid");
	
	if(isset($_POST['checks']) && is_array($_POST['checks'])){
		foreach($_POST['checks'] as $key=>$check){
		$cost = trim($_POST["cost$check"]);
		$units = trim($_POST["units$check"]);
		
		if(is_numeric($check)){
			if(!is_numeric($cost)) $cost=0;
			if(!is_numeric($units)) $units=1;
			
			$record = $db->select("clients_checks","*","com_id=$clid AND checks_id=$check");
			if(mysql_num_rows($record)>0){
				$db->update("clt_active=1,clt_cost=$cost,clt_units=$units","clients_checks","com_id=$clid AND checks_id=$check");
				
			}else{
				$db->insert("clt_cost,com_id,checks_id,clt_units","$cost,$clid,$check,$units","clients_checks");
				
			}
		}
	}
	}
}

function add_Company(){

		$db = new DB();
		
		
		if(trim($_REQUEST['cName'])=='') msg('err',"Please input company name!");
		if(trim($_REQUEST['cerp'])=='') msg('err',"Please input client ERP ID!");
		$paid = 1;
		if(trim($_REQUEST['cType'])=='Test' && isset($_REQUEST['paid'])){
			$paid = $_REQUEST['paid'];
		}
		
		if(trim($_REQUEST['cType'])=='Individual') $_REQUEST['ind'] = 0;
		if(isset($_REQUEST['disabled_id'])){$disabled_id= 1;
		}else{$disabled_id= 0;}
	    
	if($_REQUEST['ERR']==''){	


	foreach ($_FILES["attch"]["error"] as $key => $error) {

	   if ($error == UPLOAD_ERR_OK){
			$ext = pathinfo($_FILES["attch"]["name"][$key], PATHINFO_EXTENSION);	
			$extAry =array('doc','docx','xls','xlsx','pdf','jpg','jpeg','png','bmp');

			if(in_array($ext,$extAry)){

				$indx = time().strtoupper(get_rand_val(10)).rand(10,99);
				$fPath = "attach/$indx.$ext";
				if(move_uploaded_file($_FILES["attch"]['tmp_name'][$key],$fPath)){
					$attachs['title'][]	= $_POST['title'][$key];
					$attachs['names'][] = $_FILES['attch']['name'][$key];
					$attachs['paths'][] = $fPath;
				}
			}else{
				msg('err',"$ext File type is not Allowed [ $fileName ]");
				return false;
			}
	   }
	}
				

		if(is_numeric($_REQUEST['comid'])){



				$para = "name='$_REQUEST[cName]',email='$_REQUEST[cEmail]',ind_id=$_REQUEST[ind],paid=$paid,`disabled_id`=$disabled_id";
				
				$para = "$para,type='$_REQUEST[cType]',location=$_REQUEST[location],erpid='$_REQUEST[cerp]'";
				
				$para = "$para,pname='$_REQUEST[pname]',phone='$_REQUEST[phone]',pymterm='$_REQUEST[pterm]',comment='$_REQUEST[comments]'";

				
				if(trim($_REQUEST['sdate'])!='') $para = "$para,agsdate='$_REQUEST[sdate]'";
				if(trim($_REQUEST['edate'])!='') $para = "$para,agedate='$_REQUEST[edate]'";
				if(isset($attachs['title'])){
					foreach($attachs['title'] as $key=>$attach){
						$title = $attachs['title'][$key];
						$name =$attachs['names'][$key];
						$path =$attachs['paths'][$key];
						$para = "$para,title$key='$title',attach$key='$path',file$key='$name'";
					}
				}
					
					
					
				$isIncUp = $db->update($para,"company","id=$_REQUEST[comid]");
				add_client_checks($_REQUEST['comid']);
				
				$typ = 'Updat';			

		}else{	

			$company = $db->select("company","id","name LIKE '$_REQUEST[cName]'");

			if(mysql_num_rows($company)==0){

				$values = "'$_REQUEST[cName]','$_REQUEST[cEmail]',$_REQUEST[ind],'$_REQUEST[cType]',$_REQUEST[location]";
				$values = "$values, '$_REQUEST[pterm]','$_REQUEST[comments]','$_REQUEST[pname]','$_REQUEST[phone]','$_REQUEST[cerp]',$paid";
				$cols   = "name,email,ind_id,type,location,pymterm,comment,pname,phone,erpid,paid";
				
				if(trim($_REQUEST['sdate'])!='') $values = "$values,'$_REQUEST[sdate]'";
				if(trim($_REQUEST['edate'])!='') $values = "$values,'$_REQUEST[edate]'";
								
				
				if(trim($_REQUEST['sdate'])!='') $cols = "$cols,agsdate";
				if(trim($_REQUEST['edate'])!='') $cols = "$cols,agedate";
				if(isset($attachs['title'])){
					foreach($attachs['title'] as $key=>$attach){
						$title = $attachs['title'][$key];
						$name =$attachs['names'][$key];
						$path =$attachs['paths'][$key];
						$values = "$values,'$title','$path','$name'";
						$cols = "$cols,title$key,attach$key,file$key";
					}
				}
				
				$sname='';
				$nameary = explode(' ',$_REQUEST['cName']);
				if(count($nameary)>1){
					
					foreach($nameary as $key=>$tname){
						if($key<3) $sname = $sname.strtoupper($tname[0]);
						if(count($nameary)==2 && strlen($sname)==1) $sname = $sname.strtoupper($tname[1]);
					}
					
				}else{
					if(strlen($_REQUEST['cName'])<=3) $sname =strtoupper($_REQUEST['cName']); else{
						$sname = strtoupper($_REQUEST['cName'][0].$_REQUEST['cName'][1].$_REQUEST['cName'][2]);
					}
				}
				
				$cols = "$cols,sname,`disabled_id`";
				$values = "$values,'$sname',$disabled_id";
				
				$isIncUp = $db->insert($cols,$values,"company");
				$lID = $db->insertedID;
				if($isIncUp) add_client_checks($lID);
				$typ = 'insert';

			}else{

				msg('err',"Client [$_REQUEST[cName]] already exist!");

					

				return false;			

			}

		}


		
		if($isIncUp){

			$DirNm = preg_replace('/[^a-zA-Z0-9\-_]/', '',$_REQUEST['cName']);

			if(is_dir("attach/$DirNm")) $DirNm="$DirNm-".rand(1,9);

			if(@mkdir("attach/$DirNm",0777)){	

				if(@mkdir("attach/$DirNm/proof",0777)){

					$isIncUp = $db->update("path='attach/$DirNm/'","company","id=$lID");

				}

			}			

			$typ=$typ.'ed';

			msg('sec',"Client [$_REQUEST[cName]] $typ Successfully...");

						

			return $lID;

		}else{

			$typ=$typ.'ion';

			msg('err',"Company $typ Error!");

						

			return false;

		}	

	}
}



function add_Check(){

	$db = new DB();

	if(trim($_REQUEST['cktl'])!=''){	

		if(isset($_REQUEST['check'])){

			if(is_numeric($_REQUEST['check'])){

				$para = "checks_title='$_REQUEST[cktl]',checks_desc='$_REQUEST[ckds]',checks_amt=$_REQUEST[amnt],checks_wdays='$_REQUEST[wdays]'";

				$isIncUp = $db->update($para,"checks","checks_id=$_REQUEST[check]");

				$typ = 'Updat';			

			}

		}else{	

			$checks = $db->select("checks","checks_id","checks_title LIKE '$_REQUEST[cktl]'");

			if(mysql_num_rows($checks)==0){

				$values = "'$_REQUEST[cktl]','$_REQUEST[ckds]',$_SESSION[user_id],$_REQUEST[amnt],'$_REQUEST[wdays]'";

				$isIncUp = $db->insert("checks_title,checks_desc,checks_owner,checks_amt,checks_wdays",$values,"checks");

				$lID = $db->insertedID;

				$typ = 'insert';

			}else{

				msg('err',"Check [$_REQUEST[cktl]] already there...");

					

				return false;			

			}

		}

		if($isIncUp){

			$typ=$typ.'ed';

			msg('sec',"Check [$_REQUEST[cktl]] $typ Successfully...");

						

			return $lID;

		}else{

			$typ=$typ.'ion';

			msg('err',"Check $typ Error!");

						

			return false;

		}	

	}else{

		msg('err',"Please Input Check's Title!");

				

	}

}



function addComments($cType="case",$cID=0){

	$db = new DB();

	$_REQUEST['comTit'] = trim($_REQUEST['comTit']);

	$_REQUEST['comTxt'] = trim($_REQUEST['comTxt']);

	if($_REQUEST['comTxt']!='' &&  $_REQUEST['comTit']!=''){

		$where="com_title LIKE '$_REQUEST[comTit]' AND com_text LIKE '$_REQUEST[comTxt]' AND com_type='$cType' AND clent_id=$cID";	

		$comnts = $db->select("comments","_id",$where);

		if(mysql_num_rows($comnts)==0){

			if(isset($_SESSION['user_id'])){

				$uID = $_SESSION['user_id']; 

			}else $uID = 0;

			$case = $db->select("ver_checks","*","as_id=$_REQUEST[_id]");

			$case = mysql_fetch_assoc($case);

			$case = $case['v_id'];

			$cols = "_mid,_id,com_title,com_text,user_id,com_type,clent_id";

			$vals = "$case,$_REQUEST[_id],'$_REQUEST[comTit]','$_REQUEST[comTxt]',$uID,'$cType',$cID";

			if(isset($_REQUEST['email'])){

				$cols = "$cols,com_email";

				$_REQUEST['email'] = ($_REQUEST['email']);

				$vals = "$vals,'$_REQUEST[email]'";

			}

			$isInc = $db->insert($cols,$vals,'comments');

			if($isInc){

				msg('sec',"Comments inserted Successfully [ $_REQUEST[comTit] ]...");

					

				if(isset($_REQUEST['adprob'])){

					caseStatus($_REQUEST['ascase'],"Problem");

				}

			}else{

				msg('err',"Comments insertion Error! [ $_REQUEST[comTit] ]");

				

			}	

		}

	}else{

				msg('err',"Please Input Comments!");

						

	}

}



function getComments($comPID,$asID){

	$db = new DB();

	if($comPID!=0) $where = "p_id=$comPID"; else $where="_id=$asID";

	$comnts = $db->select("comments","*","$where ORDER BY com_date DESC");

	if(mysql_num_rows($comnts)>0) return $comnts;

	return false;

}



function data_uri($file, $mime) {  

  $contents = file_get_contents($file);

  $base64   = base64_encode($contents); 

  return ('data:' . $mime . ';base64,' . $base64);

}





function addCategory(){

	$db = new DB();

	if($_REQUEST['category']!=''){

		$isThere = $db->select("categorys","*","cat_name LIKE '$_REQUEST[category]'");

		if(mysql_num_rows($isThere)==0){

			$isInc = $db->insert('cat_name',"'$_REQUEST[category]'",'categorys');

			if($isInc) echo msg('sec',"Category Added Successfully [ $_REQUEST[category] ]..."); 

			else echo msg('err',"Category Adding Error! [ $_REQUEST[category] ]");

		}

	}		

}



function getScreening($scr=''){

	$db = new DB();

	if(is_numeric($scr)){

		$screening = $db->select("screenings","*","sc_id=$scr");

		return mysql_fetch_array($screening);

	}

	return  $db->select("screenings","*");

}



function addScreening(){

	$db = new DB();

	$scr  = $_REQUEST['screening'];

	$desc = $_REQUEST['scdesc'];

	if(isset($_REQUEST['scid'])){

		$isIncUp = $db->update("sc_name='$scr',sc_desc='$desc'","screenings","sc_id=".$_REQUEST['scid']);

		if($isIncUp){

			echo msg('sec',"Screening Edited Successfully [ $scr ]..."); 

			return $_REQUEST['scid'];

		}else echo msg('err',"Screening Editing Error! [ $scr ]");		

	}else{

		$cols="sc_name,sc_desc";

		$isThere = $db->select("screenings","*","sc_name LIKE '$scr'");

		if(mysql_num_rows($isThere)==0){

			$vals="'$scr','$desc'";

			$isInc = $db->insert($cols,$vals,'screenings');

			$lID = $db->insertedID;

			if($isInc){

				echo msg('sec',"Screening Added Successfully [ $scr ]..."); 

				return $lID;

			}else echo msg('err',"Screening Adding Error! [ $scr ]");

		}

	}

	return false;

}



function addPackage(){

	$db = new DB();

	$cols="sc_id,checks_id";

	$scr = $_REQUEST['screening'];

	$chk = $_REQUEST['check'];

	if(is_numeric($scr) && is_numeric($chk)){

		$isThere = $db->select("packages","*","sc_id=$scr AND checks_id=$chk");

		if(mysql_num_rows($isThere)==0){

			$vals="$scr,$chk";

			$isInc = $db->insert($cols,$vals,'packages');

			if($isInc) echo msg('sec',"Package Added Successfully ..."); 

			else echo msg('err',"Package Adding Error!");

		}

	}

}



function getPackage($scr=0){

	$db = new DB();

	if($scr!=0){

	 	 	$where="sc_id=$scr";

	} else  $where="";

	$tQury="packages pkg INNER JOIN checks chk ON pkg.checks_id= chk.checks_id INNER JOIN screenings sc ON pkg.sc_id= sc.sc_id ORDER BY sc.sc_name,chk.checks_title";

	$packages = $db->select($tQury,"*",$where);

	if(mysql_num_rows($packages)>0){

		return $packages;

	}

	return false;

}





function addPCheck(){

	$db = new DB();

	$cols="pkg_id,checks_id";

	$pkg = $_REQUEST['pkg'];

	$scr = $_REQUEST['scr'];

	$cols="pkg_id,sc_id,checks_id";

	foreach($_REQUEST['checks'] as $check){

		if(is_numeric($check)){

			$isThere = $db->select("pkg_items","*","(pkg_id=$pkg AND sc_id=$scr)  AND checks_id=$check");

			if(mysql_num_rows($isThere)==0){

				$chechInfo = getCheck($check);

				$vals="$pkg,$scr,$check";

				$isInc = $db->insert($cols,$vals,'pkg_items');

				if($isInc) echo msg('sec',"Check Added Successfully [ $chechInfo[checks_title] ]..."); 

				else echo msg('err',"Check Adding Error! [ $chechInfo[checks_title] ]");

			}

		}

	}

}



function addDCheck($pID,$cID,$action){

	$db = new DB();

	$uID = $_SESSION['user_id'];

	$isThere = $db->select("default_pkg","*","user_id=$uID AND pkg_id=$pID AND checks_id=$cID");

	$chechInfo = getCheck($cID);

	if(mysql_num_rows($isThere)==0 && $action=='in'){

		$cols="user_id,pkg_id,checks_id";

		$vals="$uID,$pID,$cID";		

		$isInc = $db->insert($cols,$vals,'default_pkg');

		if($isInc){

			echo msg('sec',"Check Added Successfully [ $chechInfo[checks_title] ]...");

		}else{

			echo msg('err',"Check Adding Error! [ $chechInfo[checks_title] ]");

		}

	}else{

		$isdlt = $db->delete('default_pkg',"user_id=$uID AND pkg_id=$pID AND checks_id=$cID");

		if($isdlt){

			echo msg('sec',"Check Removed Successfully [ $chechInfo[checks_title] ]...");

		}else{

			echo msg('err',"Check Removing Error! [ $chechInfo[checks_title] ]");

		}

	}

}



function getTitle($cID,$type=''){

	$db = new DB();

	if($type!='') $type = " AND t_key='$type'";

	return $db->select("add_data","*","checks_id=$cID AND d_isdlt=0 $type");

}



function getData($asID,$type='',$eCol=''){

	$db = new DB();

	if($type!='') $type = " AND d_type='$type'";

	return $db->select("add_data","*","as_id=$asID AND d_isdlt=0 $type$eCol");

}



function getVerdata($vID){

	$db = new DB();

	$verData = $db->select("ver_data","*","v_id=$vID");

	if(mysql_num_rows($verData)>0) return mysql_fetch_array($verData);

	return false;

}



function checkAcs($action){

		$db = new DB();

		if(!isset($action) || $action=='') return true;

		$isAcs = $db->select("access","COUNT(acs_name) cnt","acs_key='$action' AND is_active=1");

		$isAcs = mysql_fetch_array($isAcs);

		if($isAcs['cnt']>0) return true;

		return false;

}



function time_ago($date,$granularity=2) {

    $difference = time() - $date;

	$periods = array('decade' => 315360000,

        'year' => 31536000,

        'month' => 2628000,

        'week' => 604800, 

        'day' => 86400,

        'hour' => 3600,

        'minute' => 60,

        'second' => 1);

    foreach ($periods as $key => $value) {

		if ($difference >= $value) {

            $time = floor($difference/$value);

            $difference %= $value;

            $retval .= ($retval ? ' ' : '').$time.' ';

            $retval .= (($time > 1) ? $key.'s' : $key);

            $granularity--;

        }

		

        if ($granularity == '0') break;

    }

	if(!isset($retval) || ($retval=='')) $retval = '1 second';

    return '  '.$retval.' ago';      

}



function getActivity($level){

	if(isset($_SESSION['user_id'])){

		$db = new DB();

		$uID = $_SESSION['user_id'];

		$activity = $db->select("activity","*","user_id=$uID AND level=$level ORDER BY a_id DESC");

		return $activity; 

	}

	return false;

}



function check_entity($name){

	$db = new DB();

	$entitys = $db->select("medicalstaff","COUNT(Company) cnt","Company='$name'");

	$entitys = mysql_fetch_array($entitys);

	return $entitys['cnt'];

}



function geCrmlInfo($cID='',$cRN=''){

	$db = new DB();

	if($cRN!=''){

		$crmlInfo = $db->select("medicalstaff","*","CRN='$cRN'");

		return $crmlInfo;

	}else if($cID!=''){

		$crmlInfo = $db->select("medicalstaff","*","id=$cID");

		if(mysql_num_rows($crmlInfo)>0) 

		return mysql_fetch_array($crmlInfo);

	}

	return false;

}



function information(){

	$db = new DB();

	$cols="user_id,pkg_id,sc_id,at_title,at_desc";

	$uID = $_SESSION['user_id'];

	$vals="$uID,'$_POST[package]','$_POST[screening]','$_POST[ititl]','$_POST[idesc]'";

	$isInc = $db->insert($cols,$vals,'attachments');

	$id = $db->insertedID;

	if($isInc){

		$filUpMsg = addFile($id);

		$msg=msg('sec',"Information Inserted Successfully...");

		if($filUpMsg!==true) $msg.=$filUpMsg;

		return $msg;

	}else{

		return msg('err',"Information Insertion Error!");

	}

}



function addFile($id){

	$path = "attach/temp/";

	$uID = $_SESSION['user_id'];

	$filesErr='';

	$db = new DB();

	foreach ($_FILES["files"]["error"] as $key => $error) {

	   if ($error == UPLOAD_ERR_OK){

			$len = strlen($_FILES["files"]["name"][$key]);

			$ext = strtolower(substr($_FILES["files"]["name"][$key],($len-3)));

			$extAry =array('doc','docx','xls','xlsx','pdf','jpg');

			if(in_array($ext,$extAry)){

				$indx=rand(10,99).strtoupper(get_rand_val(10)).rand(10,99);

				$fPath = $path."$uID-$indx.$ext";

				$fileName =$_FILES['files']['name'][$key];

				if(move_uploaded_file($_FILES["files"]["tmp_name"][$key],$fPath)){

					$isInc = $db->insert("at_id,file_name,file_path","$id,'$fileName','$fPath'",'files');

					if(!$isInc) $filesErr.=(($filesErr!='')?'<br/>':'')."File Uploading Error";

				}else{

					$filesErr.=(($filesErr!='')?'<br/>':'')."File Uploading Error [ $fileName ]";   

				}				

			}else{

				$filesErr.=(($filesErr!='')?'<br/>':'')."$ext File Type is not Allowed [ $fileName ]"; 

			}			

	   }

	}	

	return ($filesErr!='')?msg('err',$filesErr):true;	

}



function getInvoice($uID=''){

	$db = new DB();

	if($uID=='') $uID = $_SESSION['user_id'];

	$invoice = $db->select("invoice","*","user_id=$uID");

	return mysql_fetch_array($invoice);

}





function updateProfile(){

	$db = new DB();

	$uID = $_SESSION['user_id'];

	$mail = addslashes($_POST['email']); 

	$cols="first_name='$_POST[fname]', last_name='$_POST[lname]',username='$mail', email='$mail',address='$_POST[adrs]'";

	$cols.=",city='$_POST[city]',cell_no='$_POST[mfon]',fone_no='$_POST[sfon]',designation='$_POST[desig]'";

	

	$isInup = $db->update($cols,"users","user_id=$uID");				

	if($isInup){

			updateComp();

			return msg('sec',"Profile Updated Successfully...");	

	}else{

			return msg('err',"Profile Updation Error!");

	}

}



function updateComp(){

	$db = new DB();

	$uID = $_SESSION['user_id'];

	if($_POST['comp']!=''){

		$comp = $db->select("company","*","user_id=$uID");

		if(mysql_num_rows($comp)==0){

			$path="attach/".strtolower(str_replace(' ','_',$_POST['comp']));

			if(!is_dir($path)) mkdir($path);

			if(!is_dir($path.'/proof')) mkdir($path.'/proof');

			if(!is_dir($path.'/files')) mkdir($path.'/files');

			$cols="user_id,`name`,address,path";

			$vals="$uID,'$_POST[comp]','$_POST[adrs]','$path'";

			$isInup = $db->insert($cols,$vals,'company');		

		}else{

			$cols="`name`='$_POST[comp]',address='$_POST[adrs]'";

			$isInup = $db->update($cols,"company","user_id=$uID");			

		}

		

		if($isInup)	return true; else return false;

	}

}



function updateInvoice(){

	$db = new DB();

	$uID = $_SESSION['user_id'];

	$invoice = $db->select("invoice","*","user_id=$uID");

	if(mysql_num_rows($invoice)==0){

		$cols="user_id,inv_fname,inv_lname,inv_email,inv_comp,inv_adrs,inv_twn,inv_fax,inv_mbl,inv_fon,inv_zcod";

		$vals="$uID,'$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[comp]','$_POST[adrs]','$_POST[town]','$_POST[fax]'";

		$vals.=",'$_POST[mfon]','$_POST[sfon]','$_POST[zcod]'";

		$isInup = $db->insert($cols,$vals,'invoice');		

	}else{

		$cols="inv_fname='$_POST[fname]',inv_lname='$_POST[lname]',inv_email='$_POST[email]'";

		$cols.=",inv_comp='$_POST[comp]',inv_adrs='$_POST[adrs]',inv_twn='$_POST[town]'";

		$cols.=",inv_fax='$_POST[fax]',inv_mbl='$_POST[mfon]',inv_fon='$_POST[sfon]',inv_zcod='$_POST[zcod]'";

		$isInup = $db->update($cols,"invoice","user_id=$uID");			

	}

	

	if($isInup){

			return msg('sec',"Invoice Updated Successfully...");	

	}else{

			return msg('err',"Invoice Updation Error!");

	}

}



function tCecks(){

	$db = new DB();

	$checks = $db->select("checks","COUNT(checks_id) cnt");

	$checks = mysql_fetch_array($checks);

	return $checks['cnt'];

}





function subBsEdt(){

	$db = new DB();

	$date = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];

	$recdate = $_POST['rcyear'].'-'.$_POST['rcmonth'].'-'.$_POST['rcday'];

	$uCols="v_recdate='$recdate',emp_id=$_POST[vid],v_name='$_POST[vname]',v_nic='$_POST[vnic]',v_ftname='$_POST[vfname]'";

	$uCols.=",v_dob='$date',com_id=$_REQUEST[comId],v_refid='$_POST[refid]',v_imp=$_REQUEST[imp]";	

	$isUps = $db->update($uCols,"ver_data","v_id=$_POST[id]");

	if($isUps){

		addActivity('case',"$_POST[vname]",$LEVEL,'',$_POST['id'],'','edit');

		msg('sec',"Updated [ $_POST[vname] ] Successfully...");

		return true;	

	}

	 msg('err',"Upddation [ $_POST[vname] ] Error!");

		

	return false;

}

function get_orderchecks(){
		if(isset($_REQUEST['cid']) && is_numeric($_REQUEST['cid'])){
			$db = new DB();
			$checks = $db->select("checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id","*","cc.com_id=$_REQUEST[cid] AND ck.is_active=1");?>
			
          <div class="">
						<ul class="block content_accordion ui-accordion ui-widget ui-helper-reset" style="opacity:1">
			<?php
                if(mysql_num_rows($checks)>0){
                    while($check = mysql_fetch_assoc($checks)){ ?>
						<li class="ui-accordion-li-fix">
                            <h3 class="bar ui-accordion-header ui-helper-reset ui-state-active ui-corner-top">
                                <input type="checkbox" name="checks[]" value="<?=$check['checks_id']?>" checked="checked" />
                                <input class="input" type="hidden" name="cost<?=$check['checks_id']?>" value="<?=$check['clt_cost']?>" />
                                <?=$check['checks_title']?>
                            </h3>
                            <?php if($check['checks_id']==1){?>
                            	<div  style="padding:2px;">
                               <div>
                                    <fieldset class="label_side">
        
                                        <label>Insufficient:</label>
        
                                        <div><input type="checkbox" name="status<?=$check['checks_id']?>" /></div>
        
                                    </fieldset>
                                    
                                    <fieldset class="label_side">
                                            <label>University:</label>
                                            <div>
                                                <select name="univ" class="select_box etitle" title="Select university">
                                                    <option value="0" >--Select University--</option>
													<?php							
                                                    $unies = $db->select("uni_info","*","1=1 ORDER BY uni_Name"); 
                                                    if(!isset($_REQUEST['univ'])) $_REQUEST['univ']='';          
                                                    while($uni =mysql_fetch_array($unies)){ ?>
                                                        <option value="<?=$uni['uni_id']?>" <?=($_REQUEST['univ']==$uni['uni_id'])?'selected="selected"':''?>>
                                                        <?=trim($uni['uni_Name'])?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </fieldset>                                                           
                               		
                               		
                               </div>
                              
                            </div>
                            <?php }?>
                        </li>          
              <?php }
                }else{ ?>
                    <li>
                    	<h3 class="bar">No Component Found</h3>
                   </li>
			 <?php	} ?>
  						</ul>
            </div>
			<?php
		}
}

function get_case_id(){
	if(isset($_REQUEST['cid']) && is_numeric($_REQUEST['cid'])){
		return  orderCode($_REQUEST['cid'],'01');
	}
}

function add_check_case($VID){
	$db = new DB();
	$uID = $_SESSION['user_id'];
	if(isset($_REQUEST['checks']) && is_array($_REQUEST['checks'])){
		foreach($_REQUEST['checks'] as $check){
			if(is_numeric($check)){
				$cost = (isset($_REQUEST["cost$check"]))?trim($_REQUEST["cost$check"]):0;
				if(!is_numeric($cost)) $cost = 0;
				$location = (isset($_REQUEST["location$check"]))?trim($_REQUEST["location$check"]):171; 
				if(!is_numeric($location)) $location = 171;
				
				$bCode = cBCode(0,0,$VID,$check);
				$cols  ="as_bcode,v_id,checks_id,as_uadd,as_addate,as_cost,country_id";
				$values="'$bCode',$VID,$check,$uID,CURRENT_TIMESTAMP,$cost,$location";
				
				if($check==1){
					if(isset($_REQUEST["status$check"])){
						$cols  ="$cols,as_status";
						$values="$values,'Problem'";
					}
					
					if(is_numeric($_REQUEST["univ"])){
						$cols  ="$cols,as_uni";
						$values="$values,$_REQUEST[univ]";
					}
				}
				if(!$db->insert($cols,$values,"ver_checks")) msg('err',"Check insertion error!");
				
			}
		}
	}
									
}

function subBasic(){
	
	$db = new DB();

	$uID = $_SESSION['user_id'];

	$_REQUEST['imp'] = isset($_REQUEST['imp'])?1:0;
	
	if(is_numeric($_REQUEST['comId'])){

		if(is_numeric($_REQUEST['id'])){

			return subBsEdt();

		}

		if(!is_numeric($_REQUEST['vid'])){
			 msg('err',"Please input valid employ ID!");
			return false;
		}		

		$comID = $_REQUEST['comId'];

		$_POST['vnic'] = trim($_POST['vnic']);

		if($_POST['vnic']=='' || $_POST['vnic']=='NA' || $_POST['vnic']=='N/A'){ 
			$where = "com_id=$comID AND emp_id=$_POST[vid]";
		}else{
			$where = "com_id=$comID AND (v_nic='$_POST[vnic]' OR emp_id=$_POST[vid])";
		}

		$uInfo = $db->select("ver_data","COUNT(v_id) cnt",$where);

		$uInfo = mysql_fetch_array($uInfo);

		if($uInfo['cnt']==0){

			$date = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];

			$recdate = $_POST['rcyear'].'-'.$_POST['rcmonth'].'-'.$_POST['rcday'];

			$_POST['vid'] = ($_POST['vid']=='')?'(NULL)':$_POST['vid'];

			$cols="v_recdate,v_bcode,emp_id,v_name,v_nic,v_ftname,v_dob,com_id,v_uadd,v_refid,v_imp";

			$bCode = orderCode($comID);

			$vals="'$recdate','$bCode',$_POST[vid],'$_POST[vname]','$_POST[vnic]','$_POST[vfname]','$date',$comID,$uID,'$_POST[refid]',$_REQUEST[imp]";

			$isIns = $db->insert($cols,$vals,'ver_data');

			if($isIns){

				global $LEVEL;

				$vID = $db->insertedID;
				
				add_check_case($vID);
				
				msg('sec',"Case added [ $_POST[vname] ] Successfully...");

				addActivity('case',"$_POST[vname]",$LEVEL,'',$vID,'','add');
				
				header("location:".SURL."?action=case&atype=add/edit&case=$vID");
				exit();
				return $vID;

			}else{

				 msg('err',"Case adding [ $_POST[vname] ] Error!");

				

			}

		}else{

			 msg('err',"This candidate is already exist [ $_POST[vname] ]!");

			

		}

	}else{

		 msg('err',"Please Select a Company Name !");

		

	}

	return false;

}



function addActivity($aType,$aInfo,$level,$aURL='',$vID='',$asID='',$action=''){

	if(isset($_SESSION['user_id'])){

		$db = new DB();

		$aInfo = addslashes($aInfo);

		$uID = $_SESSION['user_id'];

		$cols = 'user_id,a_type,a_info,level,a_actn';

		$vals = "$uID,'$aType','$aInfo',$level,'$action'";

		if($aURL!='') {$cols = $cols.',a_url';  $vals="$vals,'$aURL'";}

		if($vID!='') {$cols = $cols.',v_id';  $vals="$vals,$vID";}

		if($asID!=''){$cols = $cols.',ext_id'; $vals="$vals,$asID";}

		$db->insert($cols,$vals,'activity');

	}

}



function logout(){

	if(isset($_SESSION['user_id'])){

		$db = new DB();

		$uID = $_SESSION['user_id'];

		$db->insert('user_id,type',"$uID,'logout'",'activity');

		session_destroy();

	}

}



function case_access($level){

	$db = new DB();

	if(is_numeric($_REQUEST['case'])){

		$tbl = "ver_checks";

		switch($level){

			case 2:

				if(!isset($_REQUEST['ascase'])) $tbl = "ver_data";

				$where = "v_id=$_REQUEST[case]";	

			break;

			case 3:

				$where = "(v_id=$_REQUEST[case] AND user_id=$_SESSION[user_id]) AND user_id IS NOT NULL";

				if($_REQUEST['action']=='case' || $_REQUEST['ePage']=='addchecks'){

					$where = "v_id=$_REQUEST[case]";

					$tbl = "ver_data";

				}

			break;

			case 4:

				$coInfo = companyInfo($_SESSION['user_id']);

				$where = "(v_id=$_REQUEST[case] AND com_id=$coInfo[id])";

				$tbl = "ver_data";

			break;

			case 5:

				$cas_no=$db->select("ver_data","v_id","v_uadd=$_SESSION[user_id]");	

				$cas_number=mysql_fetch_array($cas_no);

				if($cas_number['v_id']==$_REQUEST['case']){

					$where = "v_id=$_REQUEST[case]";

					$tbl = "ver_data";

				}else return false;

			break;			

		}

		

		

		if(isset($where)){

			$verChecks = $db->select($tbl,"COUNT(v_id) cnt",$where);

			$verChecks = mysql_fetch_array($verChecks);

			if($verChecks['cnt']>0) return true;

		}

	}

	return false;

}



function  edData($verData,$action,$uCols=''){

	$db = new DB();	

	$data = $db->select("add_data","*","d_id=$verData AND d_isdlt=0");

	$data = mysql_fetch_array($data);

	if($data['d_stitle']!='') $title=$data['d_stitle']; else $title=$data['d_mtitle'];

	switch($action){

		case 'delete':

				$isdlt = $db->update("d_isdlt=1","add_data","d_id=$verData AND d_isdlt=0");

		 		if($isdlt){

					if(isFile($data['d_type'])){

						msg('sec',"File Deleted [ $title ] Successfully...");

						

					}else{

						msg('sec',"Field Deleted Successfully...");

						

					}

					addActivity('data',$title,0,'',$verData,$data['as_id'],'delete');

				}else{

					msg('sec',"Field Deleted Successfully...");	

					

				}

		return $isdlt;

		case 'edit':

				if($uCols!=''){

					$uVals="d_mtitle='$data[d_mtitle]',d_stitle='$data[d_stitle]',d_value='$data[d_value]'";

					$isUp =  $db->update($uCols,"add_data","d_id=$verData AND d_isdlt=0");

					if($isUp){

						addActivity('data',$uVals,0,'',$verData,$data['as_id'],'edit');

						msg('sec',"Field Updated Successfully...");	

											

					}

					return $isUp;

				}

		break;		

	}

}



function isFile($key){

	$db = new DB();

	$data = $db->select("fields_maping","in_id","fl_key='$key'");

	$data = mysql_fetch_array($data);

	if($data['in_id']==5){

		return true;	

	}

	return false;

}



function updateCheck($verID,$uCols){

	$db = new DB();

	$isUp =  $db->update($uCols,"ver_checks","as_id=$verID");

	if(!$isUp){

		msg('err',"Updation Error!");

		

		return false;	

	} 

	return true;	

}



function updateData($vID,$uCols){

	$db = new DB();

	$isUp = $db->update($uCols,"ver_data","v_id=$vID");

	if(!$isUp){

		$_REQUEST['ERR']= msg('err',"Updation Error!");

		

		return false;	

	} 

	return true;

}





function insertFile($vid,$asid,$stitle,$aType,$sdir='proof/'){

	if ($_FILES[$aType]["error"] <= 0){

		$len = strlen($_FILES[$aType]["name"]);

		$ext = strtolower(substr($_FILES[$aType]["name"],($len-3)));

		if($ext=='jpg'){

			$db = new DB();

			$comid = $db->select("ver_data","com_id","v_id=$vid");

			$comid = mysql_fetch_array($comid);

			$comid = $comid['com_id'];

			$path = $db->select("company","path","id=$comid");

			$path = mysql_fetch_array($path);

			$path = $path['path'];

			$indx=rand(10,99).strtoupper(get_rand_val(10)).rand(10,99);

			$fPath = $path.$sdir.$vid."-$indx.jpg";

			$fName = $_FILES[$aType]["name"];

			if(move_uploaded_file($_FILES[$aType]["tmp_name"], $fPath)){

				if(attachment($asid,$fName,$stitle,$aType,$fPath)){

					msg('sec',"File Uploaded Successfully [ $fName ]...");

					return true;

				}

			}

		}else{

			msg('err',"Only jpg File is allowed! [ $fName ]");

			return false;	

		}

	}

}



function attachment($asid,$fname,$stitle,$aType,$path){

	$db = new DB();

	$uID = $_SESSION['user_id'];

	$stitle = htmlspecialchars(trim($stitle));

	return $db->insert("as_id,d_mtitle,d_stitle,d_type,d_value,user_id","$asid,'$fname','$stitle','$aType','$path',$uID","add_data");

}



function vStatus($asCase,$vstatus){

	$db = new DB();

	$isInsUpd = $db->update("as_vstatus='$vstatus'","ver_checks","as_id=$asCase");

}



function caseStatus($asCase,$CaseStatus){

	$db = new DB();

	$isInsUpd = $db->update("as_status='$CaseStatus'","ver_checks","as_id=$asCase");

	return $isInsUpd;

}



function check_login(){

	$db = new DB();

	if(isset($_SESSION['user_id'])){

		$where = "user_id=".$_SESSION['user_id'];

		$UserLevel= $db->select("users","*",$where);

		if(mysql_num_rows($UserLevel)>0){

			return true;

		}

	}

	return false;

}



function get_level(){

	if(isset($_SESSION['user_id'])){

		$db = new DB();

		$UserLevel= $db->select("users","level_id","user_id=".$_SESSION['user_id']);

		$UserLevel = mysql_fetch_array($UserLevel);

		return $UserLevel['level_id'];

	}

	return false;

}



function adddata($face=0,$nStp=true,$sdir=''){

	$db = new DB();

	$isInsUpd=false;

	$uID = $_SESSION['user_id'];

	$checkInf = getCheck(0,0,$_REQUEST['ascase']);

	if(is_array($checkInf)){

		$tcheck = checkAction($checkInf['t_check']);

		if(is_array($tcheck)){

			if($face!=0) $tcheck['t_id']='';

			$fields = actionFields($tcheck['t_id'],$_REQUEST['check'],$face);	

			if(mysql_num_rows($fields)>0){

				$db->update("v_itdate=CURRENT_TIMESTAMP","ver_data","v_id=$_REQUEST[case] AND v_itdate IS NULL");

				while($field = mysql_fetch_array($fields)){

					

					if(strtolower($field['fl_key'])=="followup") $db->update("v_fdate=CURRENT_TIMESTAMP","ver_data","v_id=$_REQUEST[case] AND v_fdate IS NULL");

					

					if($field['fl_key']=='multy'){

						for($i=1;$i<=8;$i++){

							$ida="val$i";

							$idb="mtt$i";

							$idc="stt$i";

							$_REQUEST[$ida] = htmlspecialchars(trim($_REQUEST[$ida]));

							$_REQUEST[$idb] = htmlspecialchars(trim($_REQUEST[$idb]));

							$_REQUEST[$idc] = htmlspecialchars(trim($_REQUEST[$idc]));

							if(isset($_REQUEST[$idb])){

								if($_REQUEST[$idb]!=''){

									$where = "as_id=$checkInf[as_id] AND d_type='$field[fl_key]' AND d_num=$i";

									$data = $db->select("add_data","*","$where AND d_isdlt=0");

									if(mysql_num_rows($data)>0){

										$data = mysql_fetch_array($data);

										$uCols = "d_value='$_REQUEST[$ida]',d_mtitle='$_REQUEST[$idb]',d_stitle='$_REQUEST[$idc]'";

										$isInsUpd = $db->update($uCols,"add_data","$where AND d_isdlt=0");

										if($isInsUpd){

											$uVals="d_mtitle='$data[d_mtitle]',d_stitle='$data[d_stitle]',d_value='$data[d_value]'";

											addActivity('data',$uVals,0,'',$verData,$data['as_id'],'edit');

										}

										if(!$isInsUpd){

											msg('err','Updation Error [ $_REQUEST[val$i] ]!');

											

										}else $next=true;

									}else{

										$cols = "as_id,d_type,d_mtitle,d_stitle,d_value,d_num,user_id";

										$vals = "$checkInf[as_id],'$field[fl_key]','$_REQUEST[$idb]','$_REQUEST[$idc]','$_REQUEST[$ida]',$i,$uID";

										$isInsUpd = $db->insert($cols,$vals,"add_data");

										if(!$isInsUpd){

											msg('err','Insertion Error [ $_REQUEST[$ida] ]!');

											

										}

										$next=$isInsUpd;

									}

								}

							}

						}

					}

					

					if($field['in_id']==5){

						if(isset($_FILES[$field['fl_key']])){

							$_REQUEST['stitle']=isset($_REQUEST['stitle'])?$_REQUEST['stitle']:$field['fl_title'];

							insertFile($_REQUEST['case'],$checkInf['as_id'],"$_REQUEST[stitle]",$field['fl_key'],$sdir);

						}

					}

					

					if(isset($_REQUEST[$field['fl_key']])){

						$value =  htmlspecialchars(trim($_REQUEST[$field['fl_key']]));

						if($value!=''){

							$dCnt=0;

							if($field['fl_type']=='s'){

							if($field['is_multy']==0){

								$where = "as_id=$checkInf[as_id] AND d_type='$field[fl_key]'";

								$data = $db->select("add_data","*","$where AND d_isdlt=0");	

								$dCnt = mysql_num_rows($data);

								if($dCnt>0){

									$data = mysql_fetch_array($data);

									$isInsUpd = $db->update("d_value='$value'","add_data","$where AND d_isdlt=0");

									if($isInsUpd){

										$uVals="d_mtitle='$data[d_mtitle]',d_stitle='$data[d_stitle]',d_value='$data[d_value]'";

										addActivity('data',$uVals,0,'',$verData,$data['as_id'],'edit');

									}

									if(!$isInsUpd){

										msg('err','Updation Error [ $value ]!');

										

									}else $next=true;							

								}

							}

							if($dCnt == 0){						

								$isInsUpd = $db->insert("as_id,d_type,d_value,user_id","$checkInf[as_id],'$field[fl_key]','$value',$uID","add_data");

								if(!$isInsUpd){

									msg('err','Insertion Error! [ $checkInf[as_id] ]');

									

								}else{

									if($field['is_multy']==0) $next=true; else $next=false;

								}

							}

						}else{

							$isInsUpd = $db->update("$field[fl_key]='$value'","ver_checks","as_id=$checkInf[as_id]");	

						}

						}

					}

				}

				

				if($isInsUpd && $next && $nStp){

					npCheck($checkInf['as_id']);

				}

			}

		}

	}

}



function npCheck($asid,$pm='p'){

	$db = new DB();

	$tchk = getCheck(0,0,$asid);

	$tchk['t_check'] = ($pm=='p')?($tchk['t_check']+1):($tchk['t_check']-1);

	$isInsUpd = $db->update("t_check=$tchk[t_check],as_pdate=CURRENT_TIMESTAMP","ver_checks","as_id=$asid");

	return $isInsUpd;

}



function addExtCols($asID,$cols,$colAry,$eCols='',$eVals=''){

	$db = new DB();

	$isInserted = false;

	if($eVals!='') $eVals = ','.htmlspecialchars(trim($eVals));

	if($eCols!='') $eCols = ','.$eCols;

	$cols  = explode(',',$cols);

	foreach($cols as $col){

		$value = htmlspecialchars(trim($colAry[$col]));

		if($value!=''){

			$isInserted = $db->insert("as_id,d_type,d_value $eCols","$asID,'$col','$value' $eVals","add_data"); 

		}

	}

	return $isInserted;

}



function renderEdit($asId,$did){

	

}



function renderFields($field,$asID=''){

		$db = new DB();

		$input = $db->select("inputs","*","in_id=$field[in_id]" );

		$isReq = ($field['is_req']!=0)?" req $field[fl_cls]":'';

		if(mysql_num_rows($input)>0){

			$input = mysql_fetch_array($input);

			$chd='';

			if($field['is_multy']==0){

				if($field['fl_key']=='as_vstatus'){

					$data = getCheck(0,0,$_REQUEST['ascase']); $col='as_vstatus';	

				}else{				

					$data = getData($_REQUEST['ascase'],$field['fl_key']); $col='d_value';

					$data = mysql_fetch_array($data);

				}

				if($data[$col]!=''){

					$field['fl_dval']=$data[$col];

					if($input['in_type']=='checkbox'){

						//$chd='checked="checked"';

						return false;

					}

				}

			}

			

			switch($input['in_name']){

				case'input':

					return "<input title=\"$field[fl_title]\" class=\"uniform $isReq\" type=\"$input[in_type]\" name=\"$field[fl_key]$asID\" value=\"$field[fl_dval]\" $chd />";

				case'textarea':

					return "<textarea title=\"$field[fl_title]\" rows=\"5\" class=\"input $isReq\" name=\"$field[fl_key]$asID\">$field[fl_dval]</textarea>";

				case'select':

						$clkOp='';
						
						if($field['fl_op']==5){
							if(!isset($_REQUEST['ascase'])) $_REQUEST['ascase']=0;
							$options = $db->select("uni_info ORDER BY op_val","uni_Name op_val,uni_ac_url,uni_var,uni_url");

							$clkOp="onchange=\"showAdCheck(this,$_REQUEST[ascase])\"";

						}else{

							$options = $db->select("fldoptions","*","fl_key='$field[fl_key]' AND fl_op=$field[fl_op]" );
							//echo "fl_key='$field[fl_key]' AND fl_op=$field[fl_op]";
						}

						$select = "<select $clkOp title=\"$field[fl_title]\" class=\"input $isReq\" name=\"$field[fl_key]$asID\" >";

								$select .="<option value=\"0\" >--Select $field[fl_title]--</option>";

							while($option = mysql_fetch_array($options)){

								$sld='';

								if($field['fl_dval']==$option['op_val']) $sld= 'selected="selected"';

								$select .="<option value=\"$option[op_val]\" $sld >$option[op_val]</option>";		

							}		

						$select .= "</select>";

						

					return $select;

			}	

		}

		return false;

}



function actionFields($tid='',$checkid,$face=0){

	$db = new DB();

	$checkid = getcheckP($checkid);

	if($tid!=''){

		$where = "(checks_id=$checkid AND t_id=$tid) AND fl_face=$face ORDER BY fl_ord";

	}else{

		$where = "(checks_id=$checkid AND fl_face=$face) ORDER BY fl_ord";		

	}

	$Fields = $db->select("fields_maping","*",$where);

	return $Fields;

}



function getcheckP($check){

	$tchInfo = getCheck($check,0,0);

	if($tchInfo['checks_pid']!=0){

		return $tchInfo['checks_pid'];

	}	

	return $check;

}



function checkAction($tcheck){

	$db = new DB();

	$check = getcheckP($_REQUEST['check']);

	$checkAction = $db->select("titles","*","checks_id=$check AND t_check=$tcheck");

	if(mysql_num_rows($checkAction)>0){

		return mysql_fetch_array($checkAction);		

	}

	return false;

}



function checkDetails($vid,$checkid='',$exCol=''){

	$db = new DB();

	$where='';

	if($checkid!=''){

		$where= "(checks_id=$checkid AND v_id=$vid)";

	}else{

		$where= "vd.v_id=$vid";

	}

	if($exCol!='') $where .= (($where!='')?" AND ":"").$exCol;

	$tbls="ver_checks vc INNER JOIN checks ck ON ck.checks_id=vc.checks_id INNER JOIN ver_data vd ON vd.v_id=vc.v_id";

	$checksInfo = $db->select($tbls,"DISTINCT *","$where AND as_isdlt=0 ORDER BY checks_title");

	return $checksInfo;

}



function mkValues($colAry,$cols){

	$vals[0]='';

	$vals[1]='';

	$cols  = explode(',',$cols);

	foreach($cols as $col){

		if($colAry[$col]!=''){

			$vals[0] .= (($vals[0]!='')?',':'')."'".$colAry[$col]."'";

			$vals[1] .= (($vals[1]!='')?',':'').$col;

		}

	}

	return $vals;

}



function addChecks($level=''){

	$db = new DB();

	$uID = $_SESSION['user_id'];

	$vid = $_REQUEST['case'];



		$cols="v_id,as_uadd,as_addate,checks_id";

		$vals="$vid,$uID,CURRENT_TIMESTAMP,";

		if(is_numeric($_REQUEST['uid']) && $_REQUEST['uid']!=0){

			$isThere = $db->select("ver_data","v_status","v_id=$vid AND v_status='Not Assign'");

			if(mysql_num_rows($isThere)>0){

				$cols= "user_id,as_date,$cols";

				$vals= "$_REQUEST[uid],CURRENT_TIMESTAMP,$vals";	

				$isInsUpd = $db->update("v_status='Open'","ver_data","v_id=$vid");			

			}else{

				$cols= "user_id,as_status,as_date,$cols";

				$vals= "$_REQUEST[uid],'Open',CURRENT_TIMESTAMP,$vals";

			}

		}

		foreach($_REQUEST['checks'] as $check){

			$checkInfo = getCheck($check);

			if($checkInfo['is_multi']==0){

				$isThere = $db->select("ver_checks","COUNT(checks_id) cnt","checks_id=$check AND v_id=$vid");

				$isThere = mysql_fetch_array($isThere);

			} else{

				 unset($isThere);

				 $isThere['cnt'] = 0;

			}

			if($isThere['cnt']<=0){

				$bCode = cBCode(0,0,$vid,$check);

				$isInserted = $db->insert("as_bcode,$cols","'$bCode',$vals".$check,"ver_checks");

				if($isInserted ){

					$isInsUpd = $db->update("v_sent=2","ver_data","v_id=$vid AND v_status='Close'");

					msg('sec',"Checks Inserted [ $checkInfo[checks_title] ] Successfully...");

				}else{

					msg('err',"Check Insertion Error! [ $checkInfo[checks_title] ]");

				} 

			}else{

					msg('err',"The Check [ $checkInfo[checks_title] ] is already added to this case!");

			}

		}	

}



function isMcheck($cID){

	$db = new DB();

	$check = $db->select("checks","is_multi","checks_id=$cID");

	$check = mysql_fetch_array($check);

	if($check['is_multi']==1) return true;

	return false;

}



function counChecks($vid){

	$db = new DB();

	$counChecks = $db->select("ver_checks","COUNT(checks_id) cnt","v_id=$vid");

	$counCheck = mysql_fetch_array($counChecks);

	return $counCheck['cnt'];

}



function getFields($checkID,$vid){

		$db = new DB();

		$tbls= "fields_maping fm INNER JOIN `fields` fl ON fm.fl_id=fl.fl_id";

		$cols = "fl.fl_key,fl.fl_title,fl.fl_fcs";

		$fieldsInfo = $db->select($tbls,$cols,"checks_id=$checkID");

		$cols='';

		if(mysql_num_rows($fieldsInfo)>0){

			while($field = mysql_fetch_array($fieldsInfo)){	

				$cols.=(($fields!='')?',':'').$field['fl_key'];

				

			}

			$data = $db->select("ver_data",$cols,"v_id=$vid");

			$data = mysql_fetch_array($data);

		echo $data;

		die;				

		}	

}



function getCheck($checkID=0,$vid=0,$asID=0){

		$db = new DB();

		if($asID!=0){

			$verChecks = $db->select("ver_checks","*","as_id=$asID");

			if(mysql_num_rows($verChecks)>0){

				return	mysql_fetch_array($verChecks);

			}

		}else if($vid!=0 && $checkID!=0){

			$verChecks = $db->select("ver_checks","*","v_id=$vid AND checks_id=$checkID");

			if(mysql_num_rows($verChecks)>0){

				return	$verChecks;

			}

		}else if($vid!=0){

			$verChecks = $db->select("ver_checks","*","v_id=$vid");

			if(mysql_num_rows($verChecks)>0){

				return	$verChecks;

			}

		}else if(is_numeric($checkID)){

			$check = $db->select('checks','*',"checks_id=$checkID");

			if(mysql_num_rows($check)>0){

				return	mysql_fetch_array($check);

			}

		}

		return false;

}



function doLogin(){

		$db = new DB();

		$user = addslashes($_POST['username']); 

		$pass = md5(md5($_POST['password'])); 

		

		$salt = $db->select('users','salt', "username='".$user."'");

		$salt = mysql_fetch_array($salt);

		$pass = md5(md5($_POST['password']).md5($salt['salt'])); 

		$userInfo = $db->select('users','*', "username='".$user."' AND password='".$pass."'");
		if(mysql_num_rows($userInfo) > 0){

			$userInfo = mysql_fetch_array($userInfo);

				if($userInfo['is_active'] == 1){ 
					if(is_numeric($userInfo['com_id'])){
						$clientInfo = $db->select('company','disabled_id', "id='".$userInfo['com_id']."' AND disabled_id='1'");
						if(mysql_num_rows($clientInfo) > 0){
							return msg('err','Systems access temporary disabled due to non payment!');
						}
					}
					$_SESSION['username'] = $userInfo['username'];

					$_SESSION['user_id'] = $userInfo['user_id'];

					$_SESSION['email'] = $userInfo['email'];

					$_SESSION['first_name'] = $userInfo['first_name'];

					$_SESSION['fname'] = $userInfo['first_name']." ".$userInfo['middle_name']." ".$userInfo['last_name'];

					$db->insert('user_id,a_type',"$userInfo[user_id],'login'",'activity');

					return true;

				}else{

					return msg('err','Your Account Has Been Blocked, Please Contact Admin!');	

				} 				

		}else{

			return msg('err','Invalid User Name or Password!');

		}

		return false;

}



function aplRegister(){

		$db = new DB();

		

		if($_POST['date'] == NULL){

			msg('err',"Please Enter Your Date of Birth!");

			

		}

		

		if($_POST['name'] == NULL){

			msg('err',"Please Enter Your Full Name!");

			

		}else{

			$name = explode($_POST['name']);

			$_POST['fname'] = $name[0];

			$_POST['lname'] = '';

			for($i=1;$i<count($name);$i++){$_POST['lname'] = trim("$_POST[lname] $name[$i]");}

		}

		

		if(!validateEmail($_POST['email'])){

			msg('err',"Please Enter Valid Email!");

			

		}else{

			$_POST['email'] = addslashes($_POST['email']);

			$userInfo = $db->select('users','user_id',"username='$_POST[email]'");	

			if(mysql_num_rows($userInfo) > 0){

				msg('err',"This email account is already registered!");

									

			}

		}

				



		if($_POST['address'] == NULL){

				$_POST['address']='';

		}



		if($_POST['nic'] == NULL){

				$_POST['nic']='';

		}			

			

			

		if($_REQUEST['ERR']==''){

			$cols ="first_name,last_name,email,username,password,salt,level_id,dofb,address";

			$_POST['passa'] = get_rand_val(8);

			$salt = get_rand_val(8);

			$pass = md5(md5($_POST['passa']).md5($salt));

			$vals = "'$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[email]','$pass','$salt',6,'$_POST[date]','$_POST[address]','$_POST[nic]'";

			$isRegister = $db->insert($cols,$vals,'users');

			if($isRegister){

				msg('sec',"User Registered [ $_POST[fname] $_POST[lname] ] Successfully...!");

									

				 return true;	

			}else{

				msg('err',"User Registration [ $_POST[fname] $_POST[lname] ] Error!");

									 

				return false;

			} 						 

		}

		return false;	

}





function doRegister(){

		$db = new DB();

		if($_POST['passa'] != $_POST['passb']){

			msg('err',"You have to type the same password for control!");

						

		}else{

			$_POST['email'] = addslashes($_POST['email']);

			

			if($_POST['fname'] == NULL){

				msg('err',"Please Enter First Name!");

				

			}

			

			if($_POST['lname'] == NULL){

				msg('err',"Please Enter Last Name!");

				

			}			

			

			if(!validateEmail($_POST['email'])){

				msg('err',"Please Enter Valid Email!");

				

			}else{

				$_POST['email'] = addslashes($_POST['email']);

				$userInfo = $db->select('users','user_id',"username='$_POST[email]'");	

				if(mysql_num_rows($userInfo) > 0){

					msg('err',"This email account is already registered!");

										

				}

			}

			

			if($_POST['passa'] == NULL){

					msg('err',"Please Enter Password!");

					

			}

			

			if($_POST['ulevel']== 0){

					msg('err',"Please Select User Level!");

					

			}

			$eCols=""; $eVals="";

			if($_POST['ulevel'] == 4){

				if($_POST['utype']== 0){

						msg('err',"Please Select Client Type!");

						

				}	

				if($_POST['com_id']== 0){

						msg('err',"Please Select Company!");

						

				}

				$eCols=",com_id,u_type";

				$eVals=",$_POST[com_id],$_POST[utype]";							

			}

			

			if($_REQUEST['ERR']==''){

				$cols ="first_name,last_name,email,username,password,salt,level_id$eCols";

				$salt = get_rand_val(8);

				$pass = md5(md5($_POST['passa']).md5($salt));

				$vals = "'$_POST[fname]','$_POST[lname]','$_POST[email]','$_POST[email]','$pass','$salt',$_POST[ulevel]$eVals";

				$isRegister = $db->insert($cols,$vals,'users');

				if($isRegister){

					msg('sec',"User Registered [ $_POST[fname] $_POST[lname] ] Successfully...!");

										

					 return true;	

				}else{

					msg('err',"User Registration [ $_POST[fname] $_POST[lname] ] Error!");

										 

					return false;

				} 						 

			}

		}

		return false;	

}



function getInfo($table,$where){

	$db = new DB();

	$data= $db->select($table,"*",$where);

	if(mysql_num_rows($data) >0){

			return mysql_fetch_array($data);

	}

	return false;

}



function getUserInfo($id='',$sec=''){

	$db = new DB();

	if($id!=''){

		$where = "user_id=$id";

	}else if($sec!=''){

		$where = "validation='$sec'";	

	}

	

	if(isset($where)){

		$user= $db->select("users","*",$where);

		if(mysql_num_rows($user) >0){

			return mysql_fetch_array($user);

		}

	}

	return false;

}



function addlevel(){

	global $db;	

	$uID = $_SESSION['user_id'];

	if(is_numeric($_POST['lid'])){

		$dCunt=0;

	}else{

		$data= $db->select("levels","*","level_name LIKE '$_POST[level]'");

		$dCunt = mysql_num_rows($data);

	}

	if($dCunt==0){

		if($_POST['level']!=''){

			$cols="level_name,level_desc,create_date,user_id";

			$vals="'$_POST[level]','$_POST[desc]',CURRENT_TIMESTAMP,$uID";

			if(is_numeric($_POST['lid'])){

				$isAddEdit = $db->updateCol($cols,$vals,'levels',"level_id=$_POST[lid]");

				$title='Edit';

			}else{

				$isAddEdit = $db->insert($cols,$vals,'levels');

				$title='Add';

			}

			if($isAddEdit){

				msg('sec',"Level [ $_POST[level] ] ".$title."ed Successfully...");					

				return true;	

			} 	msg('err',"Level [ $_POST[level] ] ".$title."ing Error !");

		}else{

			msg('err',"Please Input a Level Name !");				

		}

	}else{

		msg('err',"Level [ $_POST[level] ] is Already Added !");				

	} return false;

}



function getLevel($id){

	global $db;	

	$data= $db->select("levels","*","level_id=$id");

	if(mysql_num_rows($data) >0){

		return mysql_fetch_array($data);

	}	return false;	

}



function getLevelInfo($id){

	$db = new DB();

	$db->open();

	$user= $db->select("levels","*","level_id=$id");

	$user_info=mysql_fetch_assoc($user);

	return $user_info;

	

}





function msg($type,$strMsg){

	$msg='';

	switch($type){

		case 'sec':

			$msg .= '<div class="notification success">';

			$msg .= '<a class="close-notification" href="javascript:void(0)" onclick="closeMsg(this)" >x</a>';

			$msg .= '<p>'.$strMsg.'</p></div>';

			$_REQUEST['TSCS'][count($_REQUEST['TSCS'])]=$strMsg;

			$_REQUEST['SCS']=$_REQUEST['SCS'].$msg;

			$_REQUEST['CNT']=$_REQUEST['CNT']+1;

		break;

		case 'err':

			$msg .= '<div class="notification error">';

			$msg .= '<a class="close-notification" href="javascript:void(0)" onclick="closeMsg(this)">x</a>';

			$msg .= '<p>'.$strMsg.'</p></div>';

			$_REQUEST['TERR'][count($_REQUEST['TERR'])]=$strMsg;

			$_REQUEST['ERR']=$_REQUEST['ERR'].$msg;

			$_REQUEST['CNT']=$_REQUEST['CNT']+1;

		break;		

	}

}



function companyInfo($id){

		$db = new DB();

		$uInfo = $db->select("users","*","user_id=$id");

		if(mysql_num_rows($uInfo)>0){

			$uInfo = mysql_fetch_array($uInfo);

			if($uInfo['u_type']==1){

				$comInfo = getcompany($uInfo['com_id']);

				if(mysql_num_rows($comInfo)>0){

					return mysql_fetch_array($comInfo);

				}

			}else if($uInfo['u_type']==2){

					$uInfo['name']= trim("$uInfo[first_name] $uInfo[last_name]");

					$uInfo['id']= $uInfo['user_id'];

					return $uInfo;		

			}

		}

		return "N/A";

}



function getcompany($id){

	if($id == 0 or $id == NULL ){

		return 'N/A';

	}else{

		$db = new DB();

		$db->open();

		$com = $db->select("company","*","id=$id");

		return  $com;

	}

}



function emailTmp($table,$title,$sEmail,$fEmial='',$cMail=''){

  	if($fEmial=='') $fEmial=DEMAIL;

	$message="<div>

    <div style=\"width:600px;font-size:12px;font-family:Arial;color:#4a4a4a; padding-top:20px;\">

			 <div style=\"background:#ffffff;border:1px solid #999; margin:auto; width:600px;margin-top:10px;text-align:left;\">

				<div style=\"border-bottom:solid #e11b22 3px\"> 

					 <div style=\"border-bottom:15px solid #026f3c; padding-bottom:4px;\">  

					  <table width=\"100%\">

						<tr><td>

					  <div style=\"float:left; \">

						  <a href=\"".SURL."\">

							  <img src=\"".SURL."/images/adminica_logo_red-trans.png\" border=\"0\" />

						  </a>

					  </div>

					  </td><td>

					  <div style=\"float:right;font-weight:bold; padding:0px 15px 0px 0px;margin-top:15px;\">
						".SITENM. " <br/>A fully automated Background Verification system.
					 </div>
					 </td></tr>
					 </table>
						 <div style=\"clear:both;\"></div>
					</div>
				</div>
				<div style=\"border-radius:5px;width:90%;margin-left:10px;background:#efefef;padding:10px;clear:both;margin-top:15px;height:auto;border-top:1px solid #dedede;border-bottom:1px solid #dedede;\">$title</div>
				<div style=\"margin:15px;clear:both;border-bottom:1px dashed #cccccc;\">
					<p style=\"margin:8px auto;\">$table</p>
				</div>
			 </div>
		 <div style=\"clear:both;\"></div>
		</div>
	  </div>";



			   $mail             = new PHPMailer();
			   $mail->IsSMTP(); // telling the class to use SMTP
			   $mail->SMTPAuth   = true;                  // enable SMTP authentication
			   $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			   $mail->Host       = "pop.gmail.com";      // sets GMAIL as the SMTP server
			   $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
			   $mail->Username   = "noreply@backgroundcheck365.com";  // GMAIL username
			   $mail->Password   = "&rd8V6tL";            // GMAIL password
			   $mail->SetFrom('noreply@backgroundcheck365.com');
   
   
   if($cMail!=''){
	    $cces = explode(',',$cMail);
		foreach($cces as $cc){
			$mail->AddBCC($cc);
		}
	}
   
   $mail->Subject    = $title;
   $mail->MsgHTML($message);
   $mail->AddAddress($sEmail);
   $mail->Send();
  
}





function time_dif( $start, $end ){

    $uts['start']      =    strtotime( $start );

    $uts['end']        =    strtotime( $end );

    if( $uts['start']!==-1 && $uts['end']!==-1 ){

        if( $uts['end'] >= $uts['start'] ){

            $diff    =    $uts['end'] - $uts['start'];

            if( $days=intval((floor($diff/86400))) )

                $diff = $diff % 86400;

            if( $hours=intval((floor($diff/3600))) )

                $diff = $diff % 3600;

            if( $minutes=intval((floor($diff/60))) )

                $diff = $diff % 60;

            $diff    =    intval( $diff );      

			if($hours<9) $hours = "0".$hours;

			if($minutes<9) $minutes = "0".$minutes;

			if($diff<9) $diff = "0".$diff;

				   

            return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff) );

        }else{

            trigger_error( "Ending date/time is earlier than the start date/time", E_USER_WARNING );

        }

    }else{

        trigger_error( "Invalid date/time data detected", E_USER_WARNING );

    }

    return( false );

}	



function validateEmail($email){

    // First, we check that there's one @ symbol,

    // and that the lengths are right.

    if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)){

        // Email invalid because wrong number of characters

        // in one section or wrong number of @ symbols.

        return false;

    }

    // Split it into sections to make life easier

    $email_array = explode("@", $email);

    $local_array = explode(".", $email_array[0]);

    for ($i = 0; $i < sizeof($local_array); $i++){

        if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])){

            return false;

        }

    }

    // Check if domain is IP. If not,

    // it should be valid domain name

    if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])){

        $domain_array = explode(".", $email_array[1]);

        if (sizeof($domain_array) < 2){

            return false; // Not enough parts to domain

        }

        for ($i = 0; $i < sizeof($domain_array); $i++){

            if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])){

                return false;

            }

        }

    }

    return true;

}



function get_rand_val($length){

  if($length>0){ 

  $rand_id="";

   for($i=1; $i<=$length; $i++){

   mt_srand((double)microtime() * 1000000);

   $num = mt_rand(1,8);

	   switch($num) {

			case "1":

			  	$rand_id.= "a";

			break;

			case "2":

			 	$rand_id.= "b";

			break;

			case "3":

			 	$rand_id.= "c";

			break;

			case "4":

			 	$rand_id.= "d";

			break;

			case "5":

			 	$rand_id.= "e";

			break;

			case "6":

			 	$rand_id.= "f";

			break;

			case "7":

			 	$rand_id.= "g";

			break;

			case "8":

			 	$rand_id.= "h";

			break;

	  }

   }

  }

return $rand_id;

}







?>