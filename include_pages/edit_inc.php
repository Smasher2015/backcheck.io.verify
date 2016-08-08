<?php
	if(isset($_REQUEST['data'])){
		$caseInfo =	getData($_REQUEST['ascase'],$type=''," AND d_id=$_REQUEST[data]");
		$caseInfo = mysql_fetch_array($caseInfo);
	}else if(isset($_REQUEST['ascase'])){
		$caseInfo = getCheck(0,0,$_REQUEST['ascase']);
	}else if(isset($_REQUEST['case'])){
		$caseInfo = getVerdata($_REQUEST['case']);
	}
	
	$_REQUEST['typ'] = (isset($_REQUEST['typ']))?$_REQUEST['typ']:'';
	$_REQUEST['fkey'] = (isset($_REQUEST['fkey']))?$_REQUEST['fkey']:'';
	$_REQUEST['data'] = (isset($_REQUEST['data']))?$_REQUEST['data']:'0';
?>
<div class="cstm">
<form method="post" enctype="multipart/form-data" onsubmit="return updateData('updateEidt')" name="updateEidt">
    	<div style="margin-bottom:10px;">
        	<?php
			if($_REQUEST['typ']=='date'){
				$DATE = $caseInfo[$_REQUEST['key']];
				include("include_pages/date_inc.php");
			}else if($_REQUEST['typ']=='multy'){ ?>
            	
                <fieldset class="label_side">
                    <label>Information Title:</label>
                    <div>
                    	<input class="text" type="text" value="<?=$caseInfo['d_mtitle']?>" name="mtt1"  />
                    </div>
                </fieldset> 
                 
                <fieldset class="label_side">
                    <label>Information Provided:</label>
                    <div>
                    	<input class="text" type="text" value="<?=$caseInfo['d_stitle']?>" name="stt1"  />
                    </div>
                </fieldset>  
                <fieldset class="label_side">
                    <label>Information Verified:</label>
                    <div>
                    	<input class="text" type="text" value="<?=$caseInfo['d_value']?>" name="val1"  />
                    </div>
                </fieldset>                                              
			<?php }else{ ?>
                <fieldset class="label_side">
                    <label>Edit Info:</label>
                    <div>
                    	<textarea class="textarea" rows="5" name="keyVal"><?php echo $caseInfo[$_REQUEST['key']]; ?></textarea>
                    </div>
                </fieldset>             
        		
        	<?php } ?>
        </div>
        <div>
            <input type="hidden" value="<?php echo $_REQUEST['typ'];?>" name="typ"  />
            <input type="hidden" value="<?php echo $_REQUEST['key'];?>" name="fldKey"  />
            <input type="hidden" value="<?php echo $_REQUEST['fkey'];?>" name="fkey"  />
            <input type="hidden" value="<?php echo $_REQUEST['data'];?>" name="data"  />
        	<input type="hidden" value="<?php echo $_REQUEST['case'];?>" name="casev"  />
            <input type="hidden" value="<?php echo $_REQUEST['ascase'];?>" name="ascasev"  />
            <button type="submit" class="btnright img_icon has_text" name="editFields"><span>Edit</span></button>
        </div>
</form>
</div>