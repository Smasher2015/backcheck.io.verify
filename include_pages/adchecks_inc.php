 <?php
if(isset($_REQUEST['edur'])){
	if(is_numeric($_REQUEST['check'])){
		enabdisb("checks","checks_id=$_REQUEST[check]");
	}
}
if(isset($_REQUEST['edit'])){
	if(is_numeric($_REQUEST['check'])){
		$data = getInfo('checks',"checks_id=$_REQUEST[check]");
		$_REQUEST['ckds'] =$data['checks_desc'];
		$_REQUEST['cktl'] =$data['checks_title'];
		$_REQUEST['amnt'] =$data['checks_amt'];	
		$_REQUEST['wdays']=$data['checks_wdays'];
		$_REQUEST['group_id']=$data['group_id'];
		if($data['is_multi']==1) $_REQUEST['imty'] = 1;
		//if($data['is_attachment']==0){$_REQUEST['isattach'] = 0;} 
		$_REQUEST['isattach']=$data['is_attachment'];
	}
}
?>
<section class="retracted scrollable">
<div class="row">
  <div class="col-md-12">
    <div class="manager-report-sec">
    <div class="page-section-title">
            <h2 class="box_head">
              <?=isset($_REQUEST['check'])?'Edit':'Add'?>
              Check</h2>
          </div>
      <div class="panel panel-default panel-block">
        <div class="list-group-item">
          
          <div class="toggle_container" <?php if(isset($_REQUEST['edit'])){}else{ echo 'style="display:block;"';} ?>>
            <form class="cstm" action="" name="" method="post" >
              <fieldset class="label_side form-group">
                <label>Check Title:</label>
               
                  <input class="form-control" type="text" name="cktl" value="<?=$_REQUEST['cktl']?>" >
                
              </fieldset>
              <fieldset class="form-group">
	    <label>Bitrix Workgroup:</label>
		<select class="select_box form-control" name="group_id" id="group_id">
               <option value="">Please Select Work Group For Bitrix Automation</option>
           <?php    $groups_arr=getworkgroup();
		   			if($groups_arr){
					  foreach($groups_arr as $key => $group){?>
                       <option value="<?=$key?>" <?=$_REQUEST['group_id']==$key?'selected':''?>><?=$group?></option>
						  <?php 
					  }
				  }
		   ?>
        </select>
									
																					</fieldset>
              <fieldset class="label_side form-group">
                <label>Amount:</label>
                <div>
                  <input class="form-control" type="text" name="amnt" value="<?=$_REQUEST['amnt']?>" >
                </div>
              </fieldset>
              <fieldset class="label_side form-group">
                <label>Working Days:</label>
                <div>
                  <input class="form-control" type="text" name="wdays" value="<?=$_REQUEST['wdays']?>" >
                </div>
              </fieldset>
              <fieldset class="label_side form-group">
                <label>Check Description:</label>
                <div>
                  <textarea class="form-control"  name="ckds" rows="5" ><?=$_REQUEST['ckds']?>
</textarea>
                </div>
              </fieldset>
              <fieldset class="label_side form-group">
               
                <div class="uniform inline clearfix">
                  <label for="imty">
                    <input type="checkbox" name="imty" id="imty"/>
                    Treat this check as a multi Checks</label>
                </div>
              </fieldset>
              
              
              <fieldset class="label_side form-group">
               
                <div class="uniform inline clearfix">
                  <label for="isattach">
                    <input type="checkbox" name="isattach" id="isattach" <?php if(($_REQUEST['isattach'] != "") && ($_REQUEST['isattach'] == 0)){echo 'checked';} ?> />
                    Is attachment required?</label>
                </div>
              </fieldset>
              
              <fieldset class="form-group">
              <button type="submit" class=" btn btn-success dropdown-toggle" style="float:right;" name="addadCheck" > <span>
              <?=isset($_REQUEST['check'])?'Edit':'Add'?>
              Check</span> </button>
              <?php 	if(isset($_REQUEST['check'])){ ?>
              <input type="hidden" name="check" value="<?=$_REQUEST['check']?>" >
              <?php	} ?>
              </fieldset>
            </form>
          </div>
        </div>
       
        <div><div class="list-group-item">
          <h2 class="box_head">Checks Listing</h2>
          <table class="table table-bordered table-striped" id="tableSortable">
            <thead>
              <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Working Days</th>
                <th width="60">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php	
			   $checks=$db->select("checks","*","1=1");
			if(mysql_num_rows($checks)>0){
			while($check = mysql_fetch_array($checks)){ ?>
              <tr>
                <td><?=mb_convert_encoding($check['checks_title'], 'HTML-ENTITIES','UTF-8');?></td>
                <td style="text-align:left"><?=$check['checks_desc']?></td>
                <td><?=$check['checks_wdays']?></td>
                <td align="center"><?php  if($check['is_active']==1) {
                                               $img="accept.png";
                                    $tit="Disable"; 
                                }else{
                                     $img="cog_3.png";
                                     $tit="Enable";
                                } 
                                $link="check=$check[checks_id]";
                        ?>
                  <a href="javascript:void(0)" ><img onclick="submitLink('<?=$link?>&edur')" src="images/icons/small/grey/<?=$img?>" class="edits" title="<?=$tit?>"  /> </a> <a href="javascript:void(0)" ><img onclick="submitLink('<?=$link?>&edit')" src="images/icons/small/grey/pencil.png"  class="edits" title="Edit"  /> </a>
          <a href="<?php echo SURL; ?>?action=formbuilder&atype=checks&checkid=<?php echo base64_encode($check[checks_id]); ?>" >Modify Fields</a>
                  
                  </td>
              </tr>
              <?php }}else{ ?>
              <tr>
                <td colspan="3"><h2 align="center">No Checks</h2></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div></div>
      </div>
    </div>   
  </div>
</div>
