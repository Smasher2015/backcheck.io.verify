<?php if(is_numeric($_REQUEST['cntid'])){ ?>
            <select name="city" required class="input text form-control"   >
                <option value="" >--Select City/State--</option>
            <?php 
                    $ewhere = "";
                    if($_REQUEST['cntid']!=0) $ewhere = "country_id=$_REQUEST[cntid]";
                    $cities = $db->select("statescity","citystate_id,citystats",$ewhere);
                    while($city = mysql_fetch_assoc($cities)){ ?>
                        <option value="<?=$city['citystate_id']?>" <?php echo chk_or_sel($_REQUEST['state_province_id'],$city['citystate_id'],'selected');?>>
							<?=mb_convert_encoding($city['citystats'], 'HTML-ENTITIES','UTF-8')?>
                        </option>			
            <?php } ?>
            </select>
<?php } ?>