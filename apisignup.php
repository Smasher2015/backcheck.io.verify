<?php 
include ('/home/backglob/public_html/verify/include/config.php');
$id = $_GET['auth_code'];
global $db;
  //echo SURL;
//echo "select * from users where auth_code = '".base64_decode($id)."' ";
/*echo "Thanks For Registeration.";
sleep(4);*/
//$username = $_GET['username'];
//echo "select * from users where auth_code = '".base64_decode($id)."' ";exit;
$sql = mysql_query("select * from users where auth_code = '".base64_decode($id)."' ");
if(mysql_num_rows($sql))
{//UPDATE `users` SET first_name='Ata123' WHERE user_id = 441
	
	


$userInfo = mysql_fetch_assoc($sql);

$updatedx = $db->update("is_active = '1'","users","user_id=".$userInfo['user_id']." ");
//exit;
if($_SESSION['username'] != "" && $_SESSION['user_id'] != "")
{}
else
{echo "Thanks For Registeration.";
 
 					$_SESSION['username'] = $userInfo['username'];

					$_SESSION['user_id'] = $userInfo['user_id'];

					$_SESSION['email'] = $userInfo['email'];

					$_SESSION['first_name'] = $userInfo['first_name'];

					$_SESSION['fname'] = $userInfo['first_name']." ".$userInfo['middle_name']." ".$userInfo['last_name'];
//print_r($_SESSION);
					// $db->insert('user_id,a_type',"$userInfo[user_id],'login'",'activity');
//echo 'afterssss';
}
?>
<script>

 

 window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = "<?=SURL?>?action=getstarted&atype=view";

    }, 2000);


</script>
<?php
}
else
{
	echo "Sorry, No user found.";
}
 ?>