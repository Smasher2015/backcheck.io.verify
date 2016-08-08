<?php
if(isset($_REQUEST['addScreening'])){
	$scid = addScreening($_REQUEST);
	if($scid){
		$_REQUEST['scid'] = $scid;	
	}
}

if(isset($_REQUEST['op'])){
	if(is_numeric($_REQUEST['scid'])){
		switch($_REQUEST['op']){
			case'0':
				$isIncUp = $db->update("is_active=0","screenings","sc_id=".$_REQUEST['scid']);	
			break;
			case'1':
				$isIncUp = $db->update("is_active=1","screenings","sc_id=".$_REQUEST['scid']);
			break;
		}
	}
}

if(($_REQUEST['atype']=='edit')){ 
	if(is_numeric($_REQUEST['scid'])){
		$screening= $db->select("screenings","*","sc_id=".$_REQUEST['scid']);
		if(mysql_num_rows($screening)>0){
			$screening = mysql_fetch_array($screening);
			$_REQUEST['screening']=$screening['sc_name'];
			$_REQUEST['scdesc']   =$screening['sc_desc'];
			$_REQUEST['atype'] = 'Edit';
		}
	}
}else $_REQUEST['atype']='Add';
	
?>

<h1>Screenings</h1>
<form enctype="multipart/form-data" method="post" class="cstm">
	<table>    	
        <tr>
        	<td><b>Screening:*</b></td>
	    	<td><input class="input req" type="text" name="screening" value="<?php echo $_REQUEST['screening']; ?>" /></td>
        </tr>
    	<tr>
        	<td><b>Description:</b></td>
	    	<td><textarea class="input" rows="5" cols="10" name="scdesc"><?php echo $_REQUEST['scdesc']; ?></textarea></td>
        </tr>
        <tr>
        	<td colspan="2">
            	<?php if(isset($_REQUEST['scid'])){ ?>
                	<input type="hidden" name="scid" value="<?php echo $_REQUEST['scid']; ?>"  />
                <?php }?>
      			<input class="button btnright" type="submit" name="addScreening" value="<?php echo $_REQUEST['atype'];?> Screening >>" >
            </td>
        </tr>        
   </table>
</form>

<table>
	<thead>
    	<tr>
        	<th style="width:300px;">Screening </th>
            <th>Description</th>
            <th style="width:100px;">Actions</th>
        </tr>
    </thead>
    <tbody>
<?php	$screenings = $db->select("screenings","*");
		while($screening = mysql_fetch_array($screenings)){ 
			if($screening['is_pkg']==1){
				$action = "?action=packages&scr=$screening[sc_id]";
			}else{
				$action = "?action=packages&pkg=0&scr=$screening[sc_id]";				
			}
		?>
    		<tr>
            	<td>
                    <a href="<?php echo $action; ?>">
                        <?php echo $screening['sc_name']; ?>
                    </a>
                </td>
            	<td style="text-align:left;">
                    <?php echo mb_convert_encoding($screening['sc_desc'], 'HTML-ENTITIES','UTF-8'); ?>
                </td>
                <td>
                    	<?php if($screening['is_active']==1){?>
                        <a href="?action=screening&atype=list&op=0&scid=<?php echo $screening['sc_id']?>">
                        	<img src="img/tick.png"  class="dico" title="Disable"  />	
                        </a>
                        <?php }else{?>
                        <a href="?action=screening&atype=list&op=1&scid=<?php echo $screening['sc_id']?>">
                        	<img src="img/disable.png"  class="dico" title="Enable"  />	
                        </a>                        
                        <?php } ?>
                        <a href="?action=screening&atype=edit&scid=<?php echo $screening['sc_id']?>">
                        	<img src="img/edit-icon.png" class="eico" title="Edit"  />
                        </a>	
                   	</td>                
            </tr> 
<?php 	} ?>
	</tbody>
</table>