<?php 
if(isset($cCheck)) $_REQUEST['ascase']=$cCheck; 
	if(is_numeric($_REQUEST['ascase'])){ 
		$check = $db->select("ver_checks","*","as_id=$_REQUEST[ascase]");
		if(mysql_num_rows($check)>0){
			$check = mysql_fetch_array($check);
			$checkid = getcheckP($check['checks_id']);
			$flds = $db->select("fields_maping","*","checks_id=$checkid AND fl_key<>'file' AND in_id=5");
			if(mysql_num_rows($flds)>0){
				$flds = mysql_fetch_array($flds);
				$eWhere = "AND (d_type='$flds[fl_key]' OR d_type='file')";
			}else{
				$flds = false;
				$eWhere="AND d_type='file'";
			}
		}
		$efields = $db->select("add_data","*","as_id=$_REQUEST[ascase] $eWhere AND d_isdlt=0");
		if(mysql_num_rows($efields)>0){
		while($efield = mysql_fetch_array($efields)){ ?>
        		<?php if($efield['d_stitle']!='') $title = $efield['d_stitle']; else $title = $efield['d_mtitle']; ?>
				<div class="checksSec" onclick="showAuto('showproof','<?=$title?>','attach=<?=$efield['d_value']?>')">
					<div style="float:left;color:#090;margin-top:3px" id="d_stitle<?=$efield['d_id']?>">
						<?=$title?>
					</div>
					<div style="float:right;">        
							<img class="edits" src="images/icons/small/grey/paperclip.png" title="View <?=$title?>" />
					</div>
					<div class="clear"></div>
				</div>
			<?php
		}}else{ ?>
			<div style="text-align:center">No Documents</div>	
<?php	}	
	
if($flds){ ?>
    <form method="post" enctype="multipart/form-data">
        <fieldset class="label_side">
            <label>Document Title<span>Please Type Document Title</span></label>
            <div>
            <input class="text req title" title="Type Document Title" type="text" name="ftitle" value="<?=$_REQUEST['ftitle']?>" >           
            </div>
        </fieldset>
    
        <fieldset class="label_side">
            <label>Upload Document<span>Please Upload Document</span></label>
            <div>
            <input class="input req" title="Upload Document" type="file" name="<?=$flds['fl_key']?>">           
            </div>
        </fieldset>
            <input type="hidden" name="ascase" value="<?=$_REQUEST['ascase']?>" >
            <div style="margin-top:5px;">
            <button class="btnright img_icon has_text text_only" type="submit" name="uploadFile" />
            <span>Upload Document</span>
            </button>
            <div class="clear"></div>
            </div>
    </form>

<?php }} ?>