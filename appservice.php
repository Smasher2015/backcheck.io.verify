<?php 

mysql_connect("172.245.4.114","riskdisc_verif","HtfN{g(H&#3x");
mysql_select_db("riskdisc_verif");
 	// FOR LOGIN
	$id   = $_REQUEST['id'];
	$data = array(
		'err' => 0,
		'user_id' => 0,
		'email' => "",
		'msg' => "",
		'data' => array(),
	);

	if($id){
		$query_basic =  mysql_query("SELECT username,salt FROM users where email = '$id'");
		$row_basic = mysql_fetch_assoc($query_basic);
		$pass = md5(md5($_REQUEST['password']).md5($row_basic['salt']));
		//echo $pass;
		$query =  mysql_query("SELECT email,user_id,username FROM users where email = '$id' and password = '$pass' and level_id = 4 and is_active =1  ");
		if(mysql_num_rows($query)>0){
			$row=mysql_fetch_assoc($query);
			$data['err']=0;
			$data['msg']='login';
			$data['email']=$row['email'];
			print(json_encode($data));
		}else{
			$data['err']=1;
			$data['msg']='Wrong login credentials.';
			print(json_encode($data));
		}
		//print(json_encode($row));
	}
	// FOR LOGIN
	
	// FOR DETAILS
	$email   = $_REQUEST['email'];
	$details_data = array(
		'cname' => "",
		'checks' => 0
	);
	if($email){
		$details =  mysql_query("
					SELECT cm.`name` AS cname, COUNT(vc.`as_id`) AS checks FROM `users` us LEFT JOIN `company` cm ON us.`com_id`=cm.`id`
					LEFT JOIN `ver_data` vd ON vd.`com_id`=us.`com_id`
					LEFT JOIN `ver_checks` vc ON vd.`v_id`=vc.`v_id`
					WHERE us.`email` = '$email' AND vc.`as_isdlt`=0
					");
		if(mysql_num_rows($details)>0){
				$details_row=mysql_fetch_assoc($details);
				$details_data['cname']=$details_row['cname'];
				$details_data['checks']=$details_row['checks'];
				print(json_encode($details_data));
		}else{
			$details_data['cname']='Not Available';
			$details_data['checks']=0;
			print(json_encode($details_data));
		}
	}//end if
 
	   
mysql_close();

?>