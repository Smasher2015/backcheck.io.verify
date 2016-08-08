<?php if(!isset($_REQUEST['divid'])) $_REQUEST['divid']=0?>
<span class="rList">
    <fieldset class="label_side" >
        <label  for="required_field">Name<span>Please Input Applicant Name</span></label>
        <div>
         <input type="text" name="name[]" id="name" class="req text title" title="Input Applicant Name">
        </div>
    </fieldset>
    <fieldset class="label_side" >
        <label for="required_field">Email<span>Please Input Applicant Email</span></label>
        <div>
         <input type="text" name="email[]" id="email" class="req text title" title="Input Applicant Email" >
        </div>
    </fieldset>
</span>    
  
<div id="div-<?=$_REQUEST['divid']?>">
    <fieldset class="label_side">
        <label>&nbsp;</label>
        <div>
         	<button name="addmore" value="Add More" onclick="addMore(<?=$_REQUEST['divid']?>); return false;">Add More</button>
		<?php if($_REQUEST['divid']>0){ ?>
            <button name="addmore" id="remove"    onclick="remove1(<?=$_REQUEST['divid']?>); return false;">Remove</button>	
        <?php }?>
        </div>
    </fieldset>
</div>