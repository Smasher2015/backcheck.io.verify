<?php
include ('/home/backglob/public_html/verify/include/config.php');
global $db;
function gettotalchecks($user_id){
	global $db;
	$followups=$db->select("add_data","*","d_type='followup' AND d_isdlt=0 AND user_id='".$user_id."'");
	return mysql_num_rows($followups);
}
$users=$db->select("users","first_name,last_name,user_id","level_id=3 and is_active=1");
?>
<table>
<thead>
	<tr>
    	<td>User</td><td>Follow Ups Done</td>
    </tr>
</thead>
<tbody>
<?php
	while($user=mysql_fetch_array($users)){?>
	<tr>
    	<td><?=$user['first_name']." ".$user['last_name']?></td>
        <td><?=gettotalchecks($user['user_id'])?></td>
    </tr>
    <?php } ?>
</tbody>
</table>