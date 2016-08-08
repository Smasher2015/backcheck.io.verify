<?php
if(isset($_REQUEST['op'])){
	if(is_numeric($_REQUEST['uid'])){
		switch($_REQUEST['op']){
			case'0':
				$isIncUp = $db->update("is_active=0","users","user_id=".$_REQUEST['uid']);	
			break;
			case'1':
				$isIncUp = $db->update("is_active=1","users","user_id=".$_REQUEST['uid']);
			break;
		}
	}
}
 

?>
<div class="subUH" style="margin-top:0;margin-bottom:0">
    <h1 align="center" class="subHd">
    Add Users
    </h1>
</div> 
    <form class="cstm" action="" name="" method="post" >
        <table>
        <tbody>
        	<tr>
                <td>User Level:</td>
                <td>
                	<select class="input" name="ulevel" onchange="setFields(this)">
                    	<option value="0" <?php if(!isset($_REQUEST['ulevel'])) echo 'selected="selected"'; ?> >--Select Level--</option>
                        <?php
						$levels= $db->select("levels","*");
						if(mysql_num_rows($levels)>0){
							while($level = mysql_fetch_array($levels)){ ?>
                        		<option value="<?php echo $level['level_id']; ?>" 
									<?php if(isset($_REQUEST['ulevel'])) if($level['level_id']==$_REQUEST['ulevel']) echo 'selected="selected"'; ?>>
									<?php echo $level['level_name']; ?>
                                </option>
                        <?php }
						} ?>
                    </select>
                </td>
            </tr>
            <tr id="fld0" >
            	<td style="display:none">Client Type:</td>
                <td style="display:none">
					<select class="input"  name="utype" >
                        <option value="0" >--Select--</option>
                        <option value="1" >Corporate</option>
                        <option value="2" >Individual</option>
                    </select>                
                </td>
            </tr>
            <tr id="fld1" >
            	<td style="display:none">Company:</td>
                <td style="display:none">
                	<select class="input" name="com_id">
                    	<option value="0" <?php if(!isset($_REQUEST['com_id'])) echo 'selected="selected"'; ?> >--Select Company--</option>
                        <?php
						$companys = $db->select("company","*");
						if(mysql_num_rows($companys)>0){
							while($company = mysql_fetch_array($companys)){ ?>
                        		<option value="<?php echo $company['id']; ?>" 
									<?php if(isset($_REQUEST['com_id'])) if($company['id']==$_REQUEST['com_id']) echo 'selected="selected"'; ?>>
									<?php echo $company['name']; ?>
                                </option>
                        <?php }
						} ?>
                    </select>               
                </td>
            </tr>
            <tr>
                <td>First Name:</td>
                <td><input class="input" type="text" name="fname" value="<?=$_REQUEST['fname']?>" ></td>
            </tr>
            <tr>
                <td>Last Name:</td>
                <td><input class="input" type="text" name="lname" value="<?=$_REQUEST['lname']?>" ></td>
            </tr>
            <tr>
                <td>Email Address:</td>
                <td><input class="input" type="text" name="email" value="<?=$_REQUEST['email']?>" ></td>
            </tr> 
            <tr>
                <td>Password:</td>
                <td><input class="input" type="password" name="passa" value="" ></td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td><input class="input" type="password" name="passb" value="" ></td>
            </tr>                                                                                 
            <tr>
                <td colspan="2">
                	<input class="button" style="float:right;" type="submit" name="register" value="Add User" >
                </td>
            </tr>
            </tbody>	    
        </table>
    </form>


<table style="margin-top:20px;"> 
    <thead>
        <tr>
            <th>User Name</th>
            <th>Email</th>
            <th>User Type</th>
            <th>Country</th>
             <th>Actions</th>
        </tr>
    </thead>
    <tbody>
<?php	$users= $db->select("users","*");
        if(mysql_num_rows($users)>0){
        while($user = mysql_fetch_array($users)){ ?>
            <tr>
                <td><?=trim($user['first_name']." ".$user['last_name'])?></td>
                <td style="text-align:left"><?=$user['email']?></td>
                <td><?php 
                        $levelInf = $db->select("levels","*","level_id=$user[level_id]");
                        $levelInf = mysql_fetch_array($levelInf);
                        echo $levelInf['level_name'];
                    ?>    
                </td>
                <td><?=$user['country']?></td>
                <td>
                    <?php if($user['is_active']==1){?>
                    <a href="?action=users&atype=list&op=0&uid=<?=$user['user_id']?>">
                        <img src="img/tick.png"  class="dico" title="Disable"  />	
                    </a>
                    <?php }else{?>
                    <a href="?action=users&atype=list&op=1&uid=<?=$user['user_id']?>">
                        <img src="img/disable.png"  class="dico" title="Enable"  />	
                    </a>                        
                    <?php } ?>	
                </td>
            </tr>	    
    <?php }}else{ ?>
        <tr>
            <td colspan="5"><h2 align="center">No User Found</h2></td>
        </tr>
    <?php } ?>
    </tbody>
</table>