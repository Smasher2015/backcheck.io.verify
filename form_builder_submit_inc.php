<?php
 //include("http://backgroundcheck.global/verify/functions/functions.php");
 include("include/config.php");
   // print_r($_REQUEST);
$data =$_GET;
 $fields = count($_REQUEST['fields']);
 $db = new DB();
 $inc = 1;
  //$checkID = $_REQUEST['fields'][0]['checkID'];
  $checkID = $_REQUEST['checkid'];
 
 
			////////////////////////// DELETE SECTION START FROM HERE //////////////////////////
 
  
 $query = mysql_query("SELECT fl_id FROM fields_maping where (checks_id=".$checkID." ) ORDER BY  fl_ord ASC ");
$asd = mysql_num_rows($query);
$items = array();
 while($dataassssss =  mysql_fetch_array($query))
 {
   $items[] = $dataassssss['fl_id'];
  
} 
 $items2 = array();

foreach($_REQUEST['fields'] as $result)
 {
    $items2[] = $result['field_id'];
  
 }
  $result=array_diff($items,$items2);
 foreach($result as $records)
	{
		 $query = mysql_query("SELECT * FROM fields_maping where (checks_id=".$checkID." and fl_id=".$records." ) ORDER BY  fl_ord ASC ");
 if(mysql_num_rows($query) > 0)
 {
 $data = mysql_fetch_array($query);
		
		// DELETING FROM FIELD OPTIONS TABLE.
 		
		if($data['in_id'] == 8) // THIS CONDITION IS FOR SELECT DROPDOWN
		{
			if($data['fl_title'] != "Verification Result" && $data['fl_key'] != "as_vstatus" )
			{
				  mysql_query("DELETE FROM fldoptions WHERE fl_key = '".$data['fl_key']."'");
 			}
			else
			{
				echo "Sorry, You can not delete ".$data['fl_title']." because its compulsory.";
			}

		}
		if($data['in_id'] == 7) // THIS CONDITION IS FOR RADIO BUTTONS.
		{
			  mysql_query("DELETE FROM fldoptions WHERE fl_key = '".$data['fl_key']."'");
				echo "You have successfully deleted ".$data['fl_title']."";
			  
  		}

		// NOW DELETING FROM FIELD MAPING TABLE.



		if($data['in_id'] == 5 && $data['fl_title'] == "Proof(s)" && $data['fl_key'] == "file" )
				{
					echo "you can not delete this ".$data['fl_title'];
				}
		else if($data['in_id'] == 8 && $data['fl_title'] == "Verification Result" && $data['fl_key'] == "as_vstatus" )
				{
					echo "you can not delete this ".$data['fl_title'];
				}
		else
		{
			  mysql_query("DELETE FROM fields_maping WHERE fl_id = '".$data['fl_id']."'");
		}
 	}
	}
 
  
					////////////////////////// DELETE SECTION END HERE //////////////////////////
  
  
			 ////////////////////////// INSERT AND UPDATE SECTION START FROM HERE //////////////////////////
  
  
foreach($_REQUEST['fields'] as $result)
{
    $label = $result['label'];
	$field_id = $result['field_id'];
	$field_type = $result['field_type'];
	$fl_show = $result['visibleinreport'];
	$is_multy = $result['is_multy'];
	$required = $result['required'];
	
 

/* if($inc <= 1)
{$t_id = 1;}
if($field_type == "section_break")
{$t_id = 2;}
*/
 
		$options = $result['field_options']['options'];
		$total_options = count($options);
 	   
	if($required == "true")
	{
		$set_req = 1;
	}
	else
	{
		$set_req = 0;
	} 

	if($fl_show == "true")
	{
		$set_fl_show = 1;
	}
	else
	{
		$set_fl_show = 0;
	} 

	if($is_multy == "true")
	{
		$set_is_multy = 1;
	}
	else
	{
		$set_is_multy = 0;
	} 
 	$fl_ord = $inc-1;
	

		$fl_key_raw = strtolower($label);
		$fl_key = str_replace(" ","_",$fl_key_raw);



	$where = "in_type='".$field_type."' ";
	$Q = $db->select("inputs","in_id",$where); 
 	$inputs = mysql_fetch_assoc($Q);
	$inputid = $inputs['in_id'];
 	
	
	
	$where = "fl_id='".$field_id."' ";
	$fl_id = $db->select("fields_maping","*",$where); 
 	$flop = mysql_fetch_assoc($fl_id);
	$flop_specific = $flop['fl_op'];
	$fl_title_specific = $flop['fl_title'];
	$fl_key_specific = $flop['fl_key'];
	if($fl_title_specific == "Proof(s)" && $fl_key_specific == "file")
	{
		$fl_ord = "101";
		$fl_key = "file";
 	}	
	if($flop_specific == 3 && $fl_key_specific == "as_vstatus" && $fl_title_specific == "Verification Result")
	{
		$formanage_s_and_p = ",fl_type='p'";
		$fl_ord = "100";
		$fl_key = "as_vstatus";
 	}	
	else
	{
		$formanage_s_and_p = "";
	}




// echo $titles_insertedID;
		if($field_id)
		{
			if($field_type == "select" || $field_type == "radio")
			{
				for($i=0; $total_options > $i; $i++)
				{
						if($options[$i]['fl_op'] == 5)
						{
						}
						else
						{
							if(isset($options[$i]['optionid']))
							{  
							 
								/*mysql_query("UPDATE fldoptions SET op_val = '".$options[$i]['label']."',
								fl_key = '".$fl_key."' 
								 WHERE op_id=".$options[$i]['optionid']."");*/
								 
		 $db->update("op_val='".$options[$i]['label']."',fl_key='".$fl_key."'","fldoptions","op_id=".$options[$i]['optionid']."");
								 
							}
							else if(!isset($options[$i]['optionid']))
							{ 
							  
								$cols="fl_op,fl_key,op_val";
								
								$values="'1','".$fl_key."','".$options[$i]['label']."'";
					 
								  $db->insert($cols,$values,"fldoptions");
								  $CID=$db->insertedID;
	
							
							}
							else
							{
							}
						}  
				}
			
			}
			
		if($field_type == "submit")
		{
			  	 
		$description = $result['field_options']['description'];
					
		/*mysql_query("UPDATE titles SET t_title = '$label', t_btn = '$description' 
			 WHERE t_id=$field_id");	*/
		
		 $db->update("t_title='".$label."',t_btn='".$description."'","titles","t_id=".$field_id."");
		
 		}
			
			
		if($field_type != "section_break" && $field_type != "hidden" && $field_type != "submit")
			{  
	//$fl_ord = $inc-1;
 
 	//print_r($flop);

	

/*mysql_query("UPDATE fields_maping SET fl_title = '$label', fl_key = '$fl_key', fl_ord = '$fl_ord', is_multy = '$set_is_multy', is_req = '$set_req',fl_show = '$set_fl_show' 
			 WHERE fl_id=$field_id");	
*/		
		
	 $db->update("fl_title='".$label."',fl_key='".$fl_key."'$formanage_s_and_p,fl_ord='$fl_ord',is_multy='$set_is_multy',is_req='$set_req',fl_show='$set_fl_show'","fields_maping","fl_id=".$field_id."");

 			}
 		 
	
 		 



		}
		
		
		
		else
		{
			
		if($field_type == "submit")
		{ $description = $result['field_options']['description'];
			   	$cols="checks_id,t_check,t_title,t_btn,t_name, as_vstatus, t_pos, t_key, is_dsp, t_show ";
				
			   	$values="'".$checkID."','0','$label','$description', 'checksub','Followup','1','N/A','1','0' ";
				 
				   // $db->insert($cols,$values,"titles");
				   // $titles_insertedID=$db->insertedID;
  		}
		 
		if($titles_insertedID != "")
			{
				$t_id = $titles_insertedID;
			}
			else
			{
				 $titles = $db->select("titles","*","checks_id=".$checkID."");
 				// $titles = mysql_query("select * from titles where checks_id=".$checkID."");
				 $data = mysql_fetch_array($titles);
				//print_r($data);
				 $t_id = $data['t_id'];
			}
 			 	
			if($field_type != "section_break" && $field_type != "hidden" && $field_type != "submit")
			{ 
/*  echo $label	 ;
 echo $inc-1;
	  echo $t_id." td";
	 echo $field_type." xxx";
*/
				$cols="t_id,checks_id,in_id,fl_op,fl_title, fl_desc, fl_algn, fl_dval, fl_key, fl_type
				, fl_cls, fl_date, fl_ord, fl_face, is_multy, is_req, fl_show ";
				
			 	$values="'$t_id','".$checkID."','$inputid','1', '".$label."','','algleft','','".$fl_key."','s','','','$fl_ord','0','$set_is_multy','$set_req','$set_fl_show'";
				 
				    $db->insert($cols,$values,"fields_maping");
				    $CID=$db->insertedID;
	
				
					if($field_type == "select" || $field_type == "radio")
					{
						for($i=0; $total_options > $i; $i++)
						{
							//echo $options[$i]['label'];
						$cols="fl_op,fl_key,op_val";
						 
						$values="'1','".$fl_key."','".$options[$i]['label']."'";
								//echo $fl_key.$options[$i]['label'];				
		 			        $db->insert($cols,$values,"fldoptions");
						    $CID=$db->insertedID;
		 				}
					
					}
			
			}	
							
		}  // $CID; 
 
 
  if($field_type != "section_break")
 {
 
 $inc++;
 
 } 

 
 //$inc++;
 } // end foreach 

 ?>