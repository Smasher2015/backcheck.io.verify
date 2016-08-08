<?php

if(isset($_POST['addfields'])){
		if(!isset($_POST['ismlt'])) $_POST['ismlt'] = 0;
		if(!isset($_POST['ireq'])) $_POST['ireq'] = 0;
		$cols = "t_id,checks_id,in_id,fl_title,fl_key,fl_face,is_multy,is_req";
		$values = "$_POST[ititle],$_POST[check],$_POST[itype],'$_POST[ifield]','$_POST[ikey]',$_POST[ifasc],$_POST[ismlt],$_POST[ireq]";
		$isIncUp = $db->insert($cols,$values,"fields_maping");
		$mstit = 'insert';	
		if($isIncUp){
			$mstit=$mstit.'ed';
			echo msg('sec',"Field $mstit [$_POST[ifield]] Successfully...");
		}else{
			$mstit=$mstit.'ion';
			echo msg('err',"Field $mstit [$_POST[ifield]] Error!");
		}
}

if(isset($_REQUEST['check']) && is_numeric($_REQUEST['check'])){ ?>
        <form class="cstm" action="" name="fields" method="post" >
            <table>
                <tr>
                    <td>Field Type:</td>
                    <td>
                        <select class="input" name="itype">
                                <option value="0" >--Select Field--</option>                        
                            <?php
                             $inputs = $db->select("inputs","*");
                             while($input = mysql_fetch_array($inputs)){?>
                                <option value="<?php echo $input['in_id']; ?>" >
                                    <?php echo $input['in_type']; ?>
                                </option>
                            <?php } ?>  	
                        </select>
                   </td>
                </tr>                                
                <tr>
                    <td>Select Title:</td>
                    <td>
                        <select class="input" name="ititle">
                                <option value="0" >--Select Title--</option>                        
                            <?php
                             $titles = $db->select("titles","*","checks_id='$_REQUEST[check]'");
                             while($title = mysql_fetch_array($titles)){ ?>
                                <option value="<?php echo $title['t_id']; ?>" >
                                    <?php echo $title['t_title']; ?>
                                </option>
                            <?php } ?>  	
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Field Title:</td>
                    <td>
                        <input class="input" type="text" name="ifield" value="">
                    </td>
                </tr>
                <tr>
                    <td>Field Key:</td>
                    <td>
                        <input class="input" type="text" name="ikey" value="">
                    </td>
                </tr>        
                <tr>
                    <td>Field Description:</td>
                    <td>
                        <textarea class="input"  name="idesc" rows="5" ></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <fieldset>
                            <legend>Field level</legend>
                            <div class="fld">
                                <input type="checkbox" value="4" name="ifasc" > Displayed on Clent Side 
                            </div>
                            <div class="fld">
                                <input type="checkbox" value="0" name="ifasc" > Displayed on Analyst Side 
                            </div>
                            <div class="fld">
                                <input type="checkbox" checked="checked" value="2" name="ifasc" > Displayed on Both Side 
                            </div>     
                            <div class="fld">
                                <input type="checkbox" value="1" name="ismlt" > This Field is multiple 
                            </div> 
                            <div class="fld">
                                <input type="checkbox" value="1" name="ireq" > This Field is Required 
                            </div>              
                        </fieldset>                
                    </td>
                </tr>                             
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="check" value="<?php echo $_REQUEST['check']; ?>"  />
                        <input class="button" style="float:right;" type="submit" name="addfields" value="Add Field >>" >
                    </td>
                </tr>                                           
            </table>		
        </form> 
<?php }else{ ?>
		<form class="cstm" method="post" enctype="multipart/form-data">
        	<table>
            	<tr>
                    <td>Select Check:</td>
                    <td>
                        <select class="input" name="check">
                                <option value="0" >--Select Check--</option>                        
                            <?php
                             $checks = $db->select("checks");
                             while($check = mysql_fetch_array($checks)){ ?>
                                <option value="<?php echo $check['checks_id']; ?>" >
                                    <?php echo $check['checks_title']; ?>
                                </option>
                            <?php } ?>  	
                        </select>
                    </td>
                </tr>
				<tr>
                    <td colspan="2">
                        <input class="button" style="float:right;" type="submit" name="addCheck" value="Go >>" >
                    </td>
                </tr>                
            </table>	
        </form>	
<?php } ?>


