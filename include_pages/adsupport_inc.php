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
		if($check['is_multi']==1) $_REQUEST['imty'] = 1;
	}
}

?>

<section class="retracted scrollable">
<div class="row">
  <div class="col-md-12">
    <div class="manager-report-sec">
      <div class="panel panel-default panel-block">
        <div class="list-group-item">
          <div class="page-section-title">
            <h2 class="box_head">System Support</h2>
          </div>
          <div class="toggle_container" <?php if(isset($_REQUEST['edit'])){}else{ echo 'style="display:block;"';} ?>>
            <form class="cstm" action="" name="" method="post" enctype="multipart/form-data" >
                <div class="form-group">
                    <label>Priority</label>
                    <select class="form-control" id="sp_priorty" name="sp_priorty">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ticket Dept :</label>
                    <select class="form-control" id="sp_department" name="sp_department">
                            <option value="operation" <?=(isset($_REQUEST['sp_department']) && $_REQUEST['sp_department']=='operation')?'selected="selected"':''?>>Operation</option>
							 <option value="it" <?=(isset($_REQUEST['sp_department']) && $_REQUEST['sp_department']=='it')?'selected="selected"':''?>>IT Department</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sp_title">Subject :<span class="text-danger">*</span></label>
                    <input id="sp_title" name="sp_title" class="form-control" value="<?=$_REQUEST['sp_title']?>" placeholder="Subject">
                </div>
                <div class="form-group">
                    <label>Message :<span class="text-danger">*</span></label>
                    <textarea name="sp_description" class="form-control parsley-validated" rows="8" data-parsley-minwords="8" data-parsley-required="true" placeholder="Type details here"><?=$_REQUEST['sp_description']?></textarea>
                </div>
                <div class="form-group">
                    <label>Attachment</label>
                    <div>
                        <div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">
                          <div class="input-group">
                            <div class="form-control uneditable-input span3" data-trigger="fileinput"><i class="icon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                            <span class="input-group-addon btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="sp_attachment" ></span>
                            <a href="#" class="input-group-addon btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a>
                          </div>
                        </div>
                    </div>
                </div>
              <fieldset class="form-group">
                  <button type="submit" class=" btn btn-success dropdown-toggle" style="float:right;" name="addticket" > <span>
                  <?=isset($_REQUEST['check'])?'Edit':'Add'?>
                  Ticket</span> </button>
                  <?php 	if(isset($_REQUEST['sp_id'])){ ?>
                  <input type="hidden" name="sp_id" value="<?=$_REQUEST['sp_id']?>" >
                  <?php	} ?>
                  <?php 	if(isset($_REQUEST['as_id'])){ ?>
                  <input type="hidden" name="as_id" value="<?=$_REQUEST['as_id']?>" >
                  <?php	} ?>
              </fieldset>
            </form>
          </div>
        </div>
       
        
      </div>
    </div>
   
    
        

    
  </div>
</div>

