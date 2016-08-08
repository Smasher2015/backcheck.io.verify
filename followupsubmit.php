<?php
 $AJAX=true;
include('include/config.php');


// FOR SINGLE CHECKS //

if($_REQUEST['individual'] == "yes")
{
	// for savvion
	if($_REQUEST['checknature'] == "savvion")
	{ 
		$primid = $_REQUEST['checkid'];
		$intcomment = $_REQUEST['intcomment'];
		$extcomment = $_REQUEST['extcomment'];
		$checkcomponent = $_REQUEST['checkcomponent'];
		//print_r($_REQUEST);
		 
		 
		$records = $db->select("records","".$checkcomponent."history","primid = $primid");

		$savvion = mysql_fetch_array($records);
		 	$savvion[$checkcomponent."history"];

			 $cols = $checkcomponent.'history';
		     $values = $savvion[$checkcomponent."history"]." [".date("M d,Y")."]-[".date("h:i:s A")."]-[".$_SESSION['fname']."]=>".$extcomment;
  			 
			 // $db->update("$cols='".$values."'","records","primid=$primid");
			//echo "Record Update Successfully.";
  	}
	// for local
	else if($_REQUEST['checknature'] == "local")
	{ 
		//print_r($_REQUEST);
		 $primid = $_REQUEST['checkid'];
		$intcomment = $_REQUEST['intcomment'];
		$extcomment = $_REQUEST['extcomment'];

			 //$cols = 'd_type';
			 //  $values = $extcomment;
  			$message = $extcomment;  
			$cols = "as_id,d_type,d_value,user_id";
			
			$vals = "$primid,'followup','$message','32323'";
			
			//$isInsUpd = $db->insert($cols,$vals,"add_data");	
			echo "Record Update Successfully.";
	}
	else
	{}
}

// FOR SINGLE CHECKS END //


// FOR MULTY CHECKS //
if($_REQUEST['bulkupdate'] == "yes")
{ 
	if($_REQUEST['checkbulk_sav'] == "yes")
	{
			$total = $_REQUEST['select'];
			for($i=0; count($total)>$i; $i++)
			{
				  $ids = $total[$i];			 
				  $cols = $_REQUEST['checkcomponent_'.$ids].'history';
				  $values = $_REQUEST['intrcmnt_'.$ids];
					if($_REQUEST['intrcmnt_'.$ids] != "")
					{
						$values_row = $_REQUEST['intrcmnt_'.$ids];
					}
					else
					{
						$values_row = $_REQUEST['commonmessage'];
						
					}
					 
		$records = $db->select("records","".$checkcomponent."history","primid = $ids");

		$savvion = mysql_fetch_array($records);
		 	$savvion[$checkcomponent."history"];

			 $cols = $checkcomponent.'history';
		    echo  $values = $savvion[$checkcomponent."history"]." [".date("M d,Y")."]-[".date("h:i:s A")."]-[".$_SESSION['fname']."]=>".$values_row;
  			 
			 // $db->update("$cols='".$values."'","records","primid=$primid");
					 
			}
			//echo "Record(s) Update Successfully.";
	}
	else if($_REQUEST['checkbulk_loc'] == "yes")
	{ 
			$total = $_REQUEST['select_loc'];
			for($i=0; count($total)>$i; $i++)
			{
				 $ids = $total[$i];			 
				 // $cols = $_REQUEST['checkcomponent_'.$ids].'history';
				if($_REQUEST['followups_ins_'.$ids] != "")
				{
					$values = $_REQUEST['followups_ins_'.$ids];
				}
				else
				{
					$values = $_REQUEST['commonmessage'];
					
				}
				  echo $values.' --- ';
/*					$cols = "as_id,d_type,d_mtitle,d_stitle,d_value,d_num,user_id";
					
					$vals = "$checkInf[as_id],'$field[fl_key]','$_REQUEST[$idb]','$_REQUEST[$idc]','$_REQUEST[$ida]',$i,$uID";
					
					$isInsUpd = $db->insert($cols,$vals,"add_data");				  
*/				 //$db->update("$cols='".$values."'","records","primid=$ids");
			}
			echo "Record(s) Update Successfully.";
	}
	else{}
	
	
}

 
// FOR MULTY CHECKS END //

 ?>