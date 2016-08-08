<div style="margin:8px;">
<h2 align="left"><?php echo $check['checks_title']; ?></h2>
<table cellpadding="0" cellspacing="0">
        <tr>
         	<?php $_REQUEST['ascase']=$_REQUEST['id']; include("include_pages/tmp_inc.php");?>
        </tr>                                          
</table>


<?php 
	$analystInf = $db->select("users","*","user_id=$asData[user_id]");
	$analystInf = mysql_fetch_array($analystInf);
?>
<table style="margin-top:40px;" cellpadding="0" cellspacing="0">              
            <thead>
                <tr>
                    <th colspan="2" align="left">Verifier Information</th>
                </tr>
            </thead>
            <tr>
                <td align="left">Name:</td>
                <td ><?php echo trim($analystInf['first_name']." ".$analystInf['middle_name']." ".$analystInf['last_name']); ?></td>
            </tr>  
            <tr>
                <td align="left">Email:</td>
                <td><a href="mailto:<?php echo $analystInf['email']; ?>"><?php echo $analystInf['email']; ?></a></td>
            </tr>   
            <tr>
                <td align="left">Contact #</td>
                <td><?php echo $analystInf['fone_no']; ?></td>
            </tr>
    </table>

</div>