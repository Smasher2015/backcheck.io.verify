<?php
if(isset($_REQUEST['op'])){
	if(is_numeric($_REQUEST['check'])){
		switch($_REQUEST['op']){
			case'0':
				$isIncUp = $db->update("is_active=0","checks","checks_id=".$_REQUEST['check']);	
			break;
			case'1':
				$isIncUp = $db->update("is_active=1","checks","checks_id=".$_REQUEST['check']);
			break;
		}
	}
}
 
if(($_REQUEST['atype']=='add')||($_REQUEST['atype']=='edit')){ 
	$_REQUEST['ckds']='';
	$_REQUEST['cktl']='';
	if($_REQUEST['atype']=='edit'){
		if(is_numeric($_REQUEST['check'])){
			$check= $db->select("checks","*","checks_id=".$_REQUEST['check']);
			if(mysql_num_rows($check)>0){
				$check = mysql_fetch_array($check);
				$_REQUEST['ckds'] =$check['checks_desc'];
				$_REQUEST['cktl'] =$check['checks_title'];
				$_REQUEST['amnt'] =$check['checks_amt'];	
				$_REQUEST['wdays']=$check['checks_wdays'];
				if($check['is_multi']==1) $_REQUEST['imty'] = 1;
				$_REQUEST['atype'] = 'Edit';
			}
		}
	}
}else{
	$_REQUEST['atype']='Add';	
}
?>

<div class="subUH" style="margin-top:0;margin-bottom:0">
    <h1 align="center" class="subHd">
    <?=ucwords($_REQUEST['atype'])?> Check
    </h1>
</div>

    <form class="cstm" action="" name="" method="post" >
        <table>
            <tr>
                <td><b>Check Title:</b></td>
                <td><input class="input" type="text" name="cktl" value="<?=$_REQUEST['cktl']?>" ></td>
            </tr>
            <tr>
                <td><b>Amount:</b></td>
                <td><input class="input" type="text" name="amnt" value="<?=$_REQUEST['amnt']?>" ></td>
            </tr>  
			<tr>
                <td><b>Working Days:</b></td>
                <td><input class="input" type="text" name="wdays" value="<?=$_REQUEST['wdays']?>" ></td>
            </tr>            
            <tr>
                <td><b>Check Description:</b></td>
                <td><textarea class="input"  name="ckds" rows="5" ><?=$_REQUEST['ckds']?></textarea></td>
            </tr>       
            <tr>
                <td colspan="2">
                	<input type="checkbox" name="imty" value="1" <?php if(isset($_REQUEST['imty'])) echo 'checked="checked"';?> /> Treat this check as a multi Checks
                </td>
            </tr>
            <tr>
                <td colspan="2"><input class="button" style="float:right;" type="submit" name="addadCheck" value="<?=ucwords($_REQUEST['atype'])?> Check" ></td>
            </tr>	    
        </table>
		<?php 	if(isset($_REQUEST['check'])){ ?>
                <input type="hidden" name="check" value="<?=$_REQUEST['check']?>" >		
        <?php	} ?>
    </form>


	<table style="margin-top:20px;">
    	<thead>
        	<tr>
            	<th>Title</th>
                <th>Description</th>
                <th>Working Days</th>
                <th>Actions</th>
            </tr>
        </thead>
    	<tbody>
	<?php	$checks= $db->select("checks","*");
			if(mysql_num_rows($checks)>0){
			while($check = mysql_fetch_array($checks)){ ?>
                <tr>
                    <td><?=$check['checks_title']?></td>
                    <td><?=$check['checks_desc']?></td>
                    <td><?=$check['checks_wdays']?></td>
                    <td>
                    	<?php if($check['is_active']==1){?>
                        <a href="?action=checks&atype=list&op=0&check=<?=$check['checks_id']?>">
                        	<img src="img/tick.png"  class="dico" title="Disable"  />	
                        </a>
                        <?php }else{?>
                        <a href="?action=checks&atype=list&op=1&check=<?=$check['checks_id']?>">
                        	<img src="img/disable.png"  class="dico" title="Enable"  />	
                        </a>                        
                        <?php } ?>
                        <a href="?action=checks&atype=edit&check=<?=$check['checks_id']?>">
                        	<img src="img/edit-icon.png" class="eico" title="Edit"  />
                        </a>	
                   	</td>
                </tr>	    
		<?php }}else{ ?>
        	<tr>
            	<td colspan="3"><h2 align="center">No Checks</h2></td>
            </tr>
		<?php } ?>
        </tbody>
	</table>