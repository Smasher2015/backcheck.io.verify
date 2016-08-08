<form method="post" enctype="multipart/form-data">
    <?php $checks = checkDetails($_REQUEST['case']);
    while($check = mysql_fetch_array($checks)){ 
        $chkSts = strtolower($check['as_status']);   
        $pCheck = getcheckP($check['checks_id']);
        $fields = $db->select("fields_maping","*","checks_id=$pCheck AND fl_face=4 AND in_id=5"); ?>
        <div class="box grid_16">
            <h2 class="box_head">
                <?=mb_convert_encoding($check['checks_title'], 'HTML-ENTITIES','UTF-8')?>
            </h2>
            <a href="#" class="grabber">&nbsp;</a>
            <a href="#" class="toggle">&nbsp;</a>
            <div class="toggle_container">	
                <div class="block">
                    <div class="section">
                    <?php if(mysql_num_rows($fields)>0){
							while($field = mysql_fetch_array($fields)){ ?>
                                <div class="section">
                                    <fieldset class="label_side">
                                            <label><?=$field['fl_title']?>:<span></span></label>
                                            <div>
                                                 <?=renderFields($field,$check['as_id'])?>
                                            </div>
                                    </fieldset>
                                    <fieldset class="label_side">
                                            <label>Document Title:<span></span></label>
                                            <div>
                                                   <input type="text" value="<?=$field['fl_dval']?>" name="stitle<?=$check['as_id']?>" />
                                            </div>
                                    </fieldset>
                                    <input type="hidden" name="casev[]" value="<?="$check[as_id]|$field[fl_key]"?>" />
                                    <div class="nstyle" >
                                <?php $attachments = getData($check['as_id'],$field['fl_key']);
                                            if(mysql_num_rows($attachments)>0){ ?>
                                                <fieldset class="label_side">
                                                    <label>Documents<span>Attached Documents</span></label>                                            
                                <?php           	while($att =mysql_fetch_array($attachments)){ 
                                                        if($att['d_stitle']!='') $title=$att['d_stitle']; else $title=$att['d_mtitle'];?>    
                                                            <div>
                                                            	<span><?=$title?></span>
                                                                <span style="float:right;">
                                                                <img class="edits" src="img/attachment.png" title="<?=$title?>"
                                                                onclick="showAuto('showproof','<?=$title?>','attach=<?=$att['d_value']?>')" />
                                                                </span>
                                                            </div>
                               <?php				} ?>
												</fieldset>
							   <?php		}  ?>  
                                    </div>    
                                 </div>                                 
                    <?php  } 
						  }else{?>
                          <h3 align="center">No Document Required</h3>
                    <?php }?>
                    </div>
                </div>
            </div>
        </div>
        
 <?php } ?>

<!-- Payment Method start-->

<div class="box grid_16" style="opacity: 1;">
            <h2 class="box_head">
               Payment Method           </h2>
            <a class="grabber" href="#">&nbsp;</a>
            <a class="toggle" href="#">&nbsp;</a>
            <div class="toggle_container">	
                <div class="block" style="opacity: 1;">
                    <div class="section">
                                                    <div class="section">
                                    <fieldset class="label_side">
                                            <label>Payment Method<span></span></label>
                                            <div>
                                                 
                                                 <select name="ddlPaymentMethod" id="ddlPaymentMethod" onchange="test();">
                                                  <option value="0">Select</option>
                                                 <option value="Easy Paisa">Easy Paisa</option>
                                                 <option value="Online Bank Deposit">Online Bank Deposit</option>
                                                 
                                                 
                                                 </select>
                                                 
                                                                                            </div>
                                    </fieldset>
                                    <fieldset class="label_side">
                                            <label>Transaction ID:<span></span></label>
                                            <div>
                                                   <input type="text" name="txtTransactionID" value="" class="text" id="txtTransactionID">
                                            </div>
                                    </fieldset>
                                    
                                    <!--<div class="nstyle">
                                                                                <fieldset class="label_side">
                                                    <label>Documents<span>Attached Documents</span></label>                                            
                                    
                                                            <div>
                                                            	<span>Job Letter</span>
                                                                <span style="float:right;">
                                                                <img onclick="showAuto('showproof','Job Letter','attach=attach/demo/5929-43DFBAEBDHGB81.jpg')" title="Job Letter" src="img/attachment.png" class="edits">
                                                                </span>
                                                            </div>
                               												</fieldset>
							     
                                    </div>-->    
                                 </div>                                 
                                        </div>
                </div>
            </div>
        </div>


<!-- Payment Method end-->


    <div class="button_bar clearfix">
    	<input type="hidden" name="case" value="<?=$_REQUEST['case']?>" />
        <button class="next_step green send_right" type="submit" name="addAttach">
            <img height="24" width="24" alt="Bended Arrow Right" src="images/icons/small/white/bended_arrow_right.png">
            <span>Submit [ Attachments ]</span>
        </button>
   </div>
</form>
<script type="text/javascript">

function test()
{
	
	var ddl_val=document.getElementById('ddlPaymentMethod');

	if(ddl_val.selectedIndex>0)
	{
		
		document.getElementById('txtTransactionID').value=Math.floor(Math.random() * (99999- 10000+ 1)) + 10000;
		
	
	}
	
}




</script>