<form action="" method="post" name="achecks" onsubmit="return addActions('ucheck','showContent');">
    <table class="static">
        <tbody>
        	
		<?php
			$vChecks = $db->select("ver_checks","DISTINCT checks_id","v_id=$_REQUEST[case] AND as_isdlt=0");
			if(mysql_num_rows($vChecks)>0){
				$tChk='';
				while($vCheck = mysql_fetch_array($vChecks)){
					$tChk .= (($tChk!='')?',':'').$vCheck['checks_id'];
				}
				$where = "(checks_id NOT IN ($tChk) OR is_multi=1) AND is_active=1";
			}else $where="is_active=1";
            $checks= $db->select("checks","*",$where);
			while($check = mysql_fetch_array($checks)){ ?>
            	<tr>
                	<td><input type="checkbox" name="checks[]" value="<?=$check ['checks_id']?>" style="margin:0;height:auto;" ></td>
					<td style="text-align:left; margin-left:30px;">
						<?php echo $check ['checks_title']; ?>
                    </td>
               </tr>
			<?php } ?>
        	  <tr>
              		<td colspan="2">
                        <div style="float:right; margin-right:5px;">
                            <?php if($LEVEL==2){?>
                                <select style="float:left; margin-right:10px;"name="uid" id="uid">
                                        <option value="0">Select Analyst</option>
                                    <?php
									if($_SESSION['user_id']==83){
										$dWhere="level_id=3 AND user_id=50";
									}else $dWhere="level_id=3";									
                                    $users = $db->select("users","*",$dWhere); 
                                    while($user =mysql_fetch_array($users)){ ?>
                                        <option value="<?php echo $user['user_id']; ?>"><?php echo trim($user['first_name'].' '.$user['last_name']); ?></option>
                                    <?php } ?>
                                </select>
                            <?php } ?>
                            <input type="hidden" value="<?php echo $_REQUEST['case']; ?>" name="case"  />
                            <input style="float:right;margin:0;" class="button" type="submit" name="addchecks" value="Add <?=($LEVEL==2)?'/ Assign':''?> Checks" >
                        </div>
                    </td>
              </tr>
    	</tbody>
    </table>
</form>