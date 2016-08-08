<?php
if(isset($_REQUEST['op'])){
	if(is_numeric($_REQUEST['comid'])){
		switch($_REQUEST['op']){
			case'0':
				$isIncUp = $db->update("is_active=0","company","id=".$_REQUEST['comid']);	
			break;
			case'1':
				$isIncUp = $db->update("is_active=1","company","id=".$_REQUEST['comid']);
			break;
		}
	}
}
 
if(($_REQUEST['atype']=='add')||($_REQUEST['atype']=='edit')){ 
	if($_REQUEST['atype']=='edit'){
		if(is_numeric($_REQUEST['comid'])){
			$company= $db->select("company","*","id=".$_REQUEST['comid']);
			if(mysql_num_rows($company)>0){
				$company = mysql_fetch_array($company);
				$_REQUEST['cName'] =$company['name'];
				$_REQUEST['cEmail'] =$company['email'];
				$_REQUEST['cDisc'] =$company['title'];	
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
        <?php echo ucwords($_REQUEST['atype']); ?> Company
        </h1>
    </div>

    <form class="cstm" action="" name="" method="post" >

            <fieldset class="label_side">
                <label>Company Name:</label>
                <div>
                    <input class="input" type="text" name="cName" value="<?=$_REQUEST['cName']?>" >
                </div>
            </fieldset>

            <fieldset class="label_side">
                <label>Email Address:</label>
                <div>
                    <input class="input" type="text" name="cEmail" value="<?=$_REQUEST['cEmail']?>" >
                </div>
            </fieldset>
            
           
 
             <fieldset class="label_side">
                <label>Description:</label>
                <div>
                    <textarea class="input"  name="cDisc" rows="5" ><?=$_REQUEST['cDisc']?></textarea>
                </div>
            </fieldset>
                                          
           <div class="button_bar clearfix">
                <input class="button" style="float:right;" type="submit" name="addCompany" value="<?=ucwords($_REQUEST['atype'])?> Company " >
           </div>	    
    
		<?php 	if(isset($_REQUEST['comid'])){ ?>
                <input type="hidden" name="check" value="<?=$_REQUEST['comid']?>" >		
        <?php	} ?>
    </form>

	<table style="margin-top:20px;">
    	<thead>
        	<tr>
            	<th>Company Name</th>
               	<th>Email Address</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
    	<tbody>
	<?php	$companies= $db->select("company","*");
			if(mysql_num_rows($companies)>0){
			while($company = mysql_fetch_array($companies)){ ?>
                <tr>
                    <td><?=$company['name']?></td>
                    <td><?=$company['email']?></td>
                    <td style="text-align:left;"><?=$company['title']?></td>
                    <td>
                    	<?php 
						
							if($company['is_active']==1){
								$link="op=0&comid=$company[id]";
								$img="tick.png";
								$title="Disable";
							}else{
								$link="op=1&comid=$company[id]";
								$img="disable.png";
								$title="Enable";
							}
						?>
                        <img onclick="submitLink('<?=$link?>')" src="img/<?=$img?>"  class="dico" title="<?=$title?>"/>
                        <img onclick="submitLink('atype=edit&comid=<?=$company['id']?>')" src="img/edit-icon.png" class="dico" title="Edit"/>	
                   	</td>
                </tr>	    
		<?php }}else{ ?>
        	<tr>
            	<td colspan="3"><h2 align="center">No Check Found</h2></td>
            </tr>
		<?php } ?>
        </tbody>
	</table>