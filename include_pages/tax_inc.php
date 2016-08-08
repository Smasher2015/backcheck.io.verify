<?php 
$db = new DB();

if(isset($_REQUEST['edit'])){
	if(is_numeric($_REQUEST['taxid'])){
		$title = "Update";
		$act = "updatetax";
		$data = $db->select('checks_tax','*',"id=$_REQUEST[taxid]");
		$rs = mysql_fetch_assoc($data);
		$tax  = $rs['tax'];
		$country_id  =$rs['country_id'];
		$state_province_id  =$rs['state_province_id'];
	}
	
}else{
	$title = "Add";
	$act = "addtax";
}

if(isset($_REQUEST['addtax'])){
	$title = "Add";
	$act = "addtax";
	if(is_numeric($_REQUEST['tax'])){
		if($_REQUEST['city']==0 || $_REQUEST['city']==''){
		msg('err',"Please select City/State");		
		}else if($_REQUEST['country_id']==0 || $_REQUEST['country_id']==''){
		msg('err',"Please select Country");	
		}else{
		$cols = "tax,country_id,state_province_id";
		$values = "'".$_REQUEST['tax']."', '".$_REQUEST['country_id']."', '".$_REQUEST['city']."'";
		
		if(mysql_num_rows($db->select("checks_tax","id","country_id=$_REQUEST[country_id] AND state_province_id=$_REQUEST[city]"))>0){
		msg('err',"This country and state already exists");	
		}else{
		
		
		
		$db->insert($cols,$values,"checks_tax");
		$_REQUEST['taxid'] = $db->insertedID;
		msg('sec',"Tax inserted succesfully.");	
		}
		}
	
	}else{
		msg('err',"Please type tax value only numeric.");
	}
	
}

if(isset($_REQUEST['updatetax'])){
	$title = "Update";
	$act = "updatetax";
	if(is_numeric($_REQUEST['taxid'])){
		if($_REQUEST['city']==0){
		msg('err',"Please select City/State");		
		}else if($_REQUEST['country_id']==0){
		msg('err',"Please select Country");	
		}else{
		$values = "tax='".$_REQUEST['tax']."', country_id='".$_REQUEST['country_id']."', state_province_id='".$_REQUEST['city']."'";
		$where = "id=$_REQUEST[taxid]";
		
		$db->update($values,"checks_tax",$where);
		
		$data = $db->select('checks_tax','*',"id=$_REQUEST[taxid]");
		$rs = mysql_fetch_assoc($data);
		$tax  = $rs['tax'];
		$country_id  =$rs['country_id'];
		$state_province_id  =$rs['state_province_id'];
		
		msg('sec',"Tax updated succesfully.");	
		
	}
	}
	
}

?>
<section class="retracted scrollable">
  <div class="row">
    <div class="col-md-12">
      <div class="manager-report-sec">
      <div class="page-section-title">
              <h2 class="box_head"><?php echo $title;?> Tax</h2>
            </div>
        <div id="filters" class="section" >
          <div class="list-group-item" >
            
			<?php if($msg){ ?>
				<div class="alert alert-dismissable alert-success fade in "><button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-remove"></i></button><span class="title"><i class="icon-check-sign"></i> SUCCESS</span> Tax <?php echo $msg;?> successfully.</div>
				
			<?php } ?>
			
			
            <div style="margin-bottom:30px;">
            <form action="<?="?action=$action&atype=$aType"?>" class="table-form" method="post">
              
			  <div class="content" style="padding:2px;">
                <div class="row">
                    <div class="col-md-3">
			  <div class="form-group">
             
                    <label for="basic-input">Tax in Percentage:(%) </label>
                 
				<?php  
											
				$Qur = $db->select("checks_tax","tax", "id=1");
				$rsTax = mysql_fetch_assoc($Qur);
				?>
			<input type="number" id="tax" name="tax" class="form-control" placeholder="Type Tax" value="<?php echo  $tax;?>" required > 
                      
                  </div>
				  </div>
				  
				  
				  
				  <div class="col-md-3">
			  <div class="form-group">
             
                    <label for="basic-input">Select Country </label>
                 				
					<select name="country_id" class="form-control" title="Select Country"  required onchange="updatecity(this)">
					<option value="" >Select Country</option>
					<?php $countries = getCountry();
					
					foreach($countries as $country){?>
					<option value="<?php echo $country['country_id'];?>" <?=($country['country_id']==$country_id)?'selected':''?>><?php echo $country['printable_name'];?></option>
					<?php } ?>
					
					
					</select>
                      
                  </div>
				  </div>
				  
				   <div class="col-md-3">
			  <div class="form-group">
             
                    <label for="basic-input">City/State</label>
                 				
					 <div id="updatecity">
					 
                    <?php
                                    $_REQUEST['cntid'] = $country_id;
                                    $_REQUEST['state_province_id'] = $state_province_id ;
                                    include("include_pages/getcity_inc.php");                            
                                ?>
                  </div>
                      
                  </div>
				  </div>
         
              </div>
			  </div>
             
            
              <div  class="form-group">
			 <input type="hidden" name="taxid" value="<?=$_REQUEST['taxid']?>" >
             <input type="hidden" name="<?php echo (isset($_REQUEST['edit']))?'edit':'add';?>" value="" >
                <button class="btn btn-success"  type="submit"  name="<?php echo (isset($_REQUEST['edit']))?'updatetax':'addtax';?>"> <span><?php echo $title;?> Tax</span> </button>
              </div>
               
            </form>
            </div>
             <div style="clear:both; margin-bottom:30px;"></div>
             
             
               </div>
            </div>
          </div>
        </div>
      </div>
  <div class="clear"></div>
</section>


<section class="retracted scrollable">
	<div class="row">
    <div class="col-md-12">
    	<div class="manager-report-sec">
                   
<div class="panel panel-default panel-block">
 <div class="page-section-title">
                   <h2 class="box-head">Tax Country Wise</h2>
                    </div>
       <table class="table table-bordered table-striped" id="tableSortable">
          <thead>
            <tr>
              
              <th>Tax</th>
              <th>Country</th>
			  <th>State/Province</th>
              <th>Status</th>
             
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php	
			
			
			$taxes= $db->select("checks_tax","*"," 1=1 ORDER BY `id` DESC");
			if(mysql_num_rows($taxes)>0){
			while($tax = mysql_fetch_array($taxes)){ ?>
            <tr class="gradeX">
             
              <td><?=$tax['tax']?></td>
              <td><?php echo getCountry($tax['country_id'])[printable_name];?></td>
              <td><?php echo getSateProvice($tax['state_province_id'])[citystats];?></td>

              <td><?=($tax['status']==0)?'Active':'Inactive'?></td>
             
              <td align="center"><?php  if($tax['status']==0) {
                                    $img="accept.png";
                                    $tit="Active"; 
									$color="style='color:#0DAF0D;'";
                                }else{
									 $img="acces_denied_sign.png";
                                     $tit="Inactive";
									 
									 $color="style='color:#ff0000;'";
                                } 
                                $link="taxid=$tax[id]";
                        ?>
                <?php /* <a href="javascript:void(0)" >  <i onclick="submitLink('<?=$link?>&edur')" class="icon-ban-circle" title="<?=$tit?>" <?=$color?>></i></a> */ ?> 
				
				<a href="javascript:void(0)" > <i onclick="submitLink('<?=$link?>&edit')"  class="icon-pencil5"  title="Edit" ></i></a></td>
            </tr>
            <?php }} ?>
          </tbody>
        </table>
</div>
</div>
</div>
</div>
</section>

