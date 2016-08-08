 <?php
if(isset($_REQUEST['edur'])){
	if(is_numeric($_REQUEST['lid'])){
		enabdisb("levels","level_id=$_REQUEST[lid]");
	}
}

if(isset($_REQUEST['edit'])){
	if(is_numeric($_REQUEST['lid'])){
		$level = getLevel($_REQUEST['lid']);
		$_REQUEST['level'] = $level['level_name'];
		$_REQUEST['desc']  = $level['level_desc'];
	}
}
?>
<section class="retracted scrollable">

   <div class="row">
       
                        
            <div class="col-md-12">
                <div class="manager-report-sec">
               
               <div class="panel panel-default panel-block">
               <div class="list-group-item">
                 <div class="page-section-title"><h2 class="box_head"><?=isset($_REQUEST['lid'])?'Edit':'Add'?> Level</h2></div>
                <div class="toggle_container" <?php if(isset($_REQUEST['edit'])){}else{ echo ''; } ?>>	
    <form class="cstm form-horizontal" action="" name="" method="post" >
    		<fieldset class="label_side form-group">
									<div class="col-lg-3 ">
                                    <label  for="input-horizontal" class=" control-label">Level Name:</label>
									</div>
                                    <div class="col-lg-9">
										<input class="input form-control" type="text" name="level" value="<?=$_REQUEST['level']?>" >
									</div>
								</fieldset>
							
								<fieldset class="label_side form-group">
									<div class="col-lg-3">
                                    <label  for="input-horizontal" class=" control-label">Description:</label></div>
									
										<div class="col-lg-9">
                                        <textarea class="input  form-control" name="desc" ><?=$_REQUEST['desc']?></textarea>
                                        </div>
									
								</fieldset>
                                <fieldset>
                           <div class="form-group container">  
					<?php if(is_numeric($_REQUEST['lid'])){ ?>
                        <input type="hidden" name="lid" value="<?=$_REQUEST['lid']?>"  />
                    <?php } ?>                
                	
                    <button type="submit" class="btn btn-success div_icon has_text" style="float:right;"  name="addlevel" >	    
                            <span><?=isset($_REQUEST['lid'])?'Edit':'Add'?> Level</span>
                            </button>

					</div>
                    </fieldset>
    </form>
</div>
				</div>
         <div style="clear:both;"></div>     
                    <div class="list-group-item">
                    <div class="page-section-title">
                    	<h2 class="box_head">Levels Listing</h2>
                    </div>
					
<table class="table table-bordered table-striped" id="tableSortable">
        <thead>
            <tr>
                <th>Level Name</th>
                <th>Description</th>
                 <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    <?php	$levels= $db->select("levels","*");
            if(mysql_num_rows($levels)>0){
            while($level = mysql_fetch_array($levels)){ ?>
                <tr>
                    <td><?=trim($level['level_name'])?></td>
                    <td><?=trim($level['level_desc'])?></td>
                    <td align="center">
						<?php  if($level['is_active']==1) {
      							           $img="icon-remove-circle";
                                    $tit="Disable"; 
                                }else{
                                     $img="icon-ok-circle";
                                     $tit="Enable";
                                } 
                                $link="lid=$level[level_id]";
                        ?>                    
<a href="javascript:void(0)" onclick="submitLink('<?=$link?>&edur')"  title="<?=$tit?>"><i class="<?php echo $img;?>"></i> <?=$tit?> </a>
        &nbsp;
		<a href="javascript:void(0)"   title="Edit" onclick="submitLink('<?=$link?>&edit')"><i class="icon-pencil"></i> Edit
			</a>
                    </td>
                </tr>	    
        <?php }} ?>
        </tbody>
    </table>

	</div>
	</div>
</div>
</div>
</div>
</section>