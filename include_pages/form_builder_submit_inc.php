<?php
 //include("http://backgroundcheck.global/verify/functions/functions.php");
 include("include/config.php");
   // print_r($_REQUEST);
$data =$_GET;
 $fields = count($_REQUEST['fields']);
 $db = new DB();
 $inc = 1;
  $checkID = $_REQUEST['fields'][0]['checkID'];
  
 

 
foreach($_REQUEST['fields'] as $result)
{
    $label = $result['label'];
	$field_id = $result['field_id'];
	$field_type = $result['field_type'];
	$fl_show = $result['visibleinreport'];
	$is_multy = $result['is_multy'];
	$required = $result['required'];
	
 //	echo $inc."_td"; 
// if($field_type == "section_break")
// {
/* if($inc <= 1)
{$t_id = 1;}
if($field_type == "section_break")
{$t_id = 2;}
 if($t_id = 3)
{$t_id = 3;}
*/

/*$t_id = 1;
if($field_type == "section_break")
  {
  
 $t_id = $t_id+1;

}
*/
/*  if($t_id == 2 && $field_type == "section_break")
{
	$t_id = 3;

}



if($field_type == "section_break")
{$t_id = 2;}
*/ 

 if($inc <= 1)
{$t_id = 1;}
if($field_type == "section_break")
{$t_id = 2;}

/* if($inc <= 2)
{$t_id = 321;}

*/

/* if($t_id = 3)
{$t_id = 3;}
*/


   
// $inc++;
// $inc = 2;
 //} 
// echo $inc."_td";
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
 
	$where = "in_type='".$field_type."' ";
	$Q = $db->select("inputs","in_id",$where); 
 	$inputs = mysql_fetch_assoc($Q);
	$inputid = $inputs['in_id'];
 	
	
		$fl_key_raw = strtolower($label);
		$fl_key_created = str_replace(" ","_",$fl_key_raw);
		
		if($set_is_multy == 1)
		{
			$fl_key = "multy";
		}
		else
		{
			$fl_key = $fl_key_created;
		}

// echo $titles_insertedID;
		if($field_id)
		{
			if($field_type == "select")
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
							 
								mysql_query("UPDATE fldoptions SET op_val = '".$options[$i]['label']."',
								fl_key = '".$fl_key."' 
								 WHERE op_id=".$options[$i]['optionid']."");
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
			  	//$cols="checks_id,t_check,t_title,t_btn,t_name, as_vstatus, t_pos, t_key, is_dsp, t_show ";
				
			   //$values="'".$checkID."','0','$label','$label', 'checksub','Followup','1','N/A','1','0' ";
				 
				     //$db->insert($cols,$values,"titles");
				    //$titles_insertedID=$db->insertedID;
		$description = $result['field_options']['description'];
					
		mysql_query("UPDATE titles SET t_title = '$label', t_btn = '$description' 
			 WHERE t_id=$field_id");	
		
		
		
 		}
			
			
		if($field_type != "section_break" && $field_type != "hidden" && $field_type != "submit")
			{  
/* mysql_query("UPDATE fields_maping SET t_id = '$titles_insertedID', fl_title = '$label', fl_key = '$fl_key', fl_ord = '$inc-1', is_multy = '$set_is_multy', is_req = '$set_req',fl_show = '$set_fl_show' 
			 WHERE fl_id=$field_id");	
*/ mysql_query("UPDATE fields_maping SET fl_title = '$label', fl_key = '$fl_key', fl_ord = '$inc-1', is_multy = '$set_is_multy', is_req = '$set_req',fl_show = '$set_fl_show' 
			 WHERE fl_id=$field_id");	
	

/*  echo $label	 ;
  echo $inc-1;
  echo $t_id." td";
*/			}
 		 
	
 		 



		}
		
		
		
		else
		{
			
		if($field_type == "submit")
		{
			  	$cols="checks_id,t_check,t_title,t_btn,t_name, as_vstatus, t_pos, t_key, is_dsp, t_show ";
				
			   	$values="'".$checkID."','0','$label','$label', 'checksub','Followup','1','N/A','1','0' ";
				 
				    $db->insert($cols,$values,"titles");
				    $titles_insertedID=$db->insertedID;
  		}
		 
		if($titles_insertedID != "")
			{
				$t_id = $titles_insertedID;
			}
			else
			{
				 $titles = mysql_query("select * from titles where checks_id=".$checkID."");
				 $data = mysql_fetch_array($titles);
				//print_r($data);
				  $t_id = $data['t_id'];
			}
 			 
			//$getInputs = $db->select("inputs","*","in_type = ".$field_type."");
				//	print_r($getInputs);		
			if($field_type != "section_break" && $field_type != "hidden" && $field_type != "submit")
			{ 
/*  echo $label	 ;
 echo $inc-1;
	  echo $t_id." td";
	 echo $field_type." xxx";
*/
				$cols="t_id,checks_id,in_id,fl_op,fl_title, fl_desc, fl_algn, fl_dval, fl_key, fl_type
				, fl_cls, fl_date, fl_ord, fl_face, is_multy, is_req, fl_show ";
				
			 	$values="'$t_id','".$checkID."','$inputid','1', '".$label."','','algleft','','".$fl_key."','s','','','$inc-1','0','$set_is_multy','$set_req','$set_fl_show'";
				 
				   $db->insert($cols,$values,"fields_maping");
				    $CID=$db->insertedID;
	
				
					if($field_type == "select")
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