<?php
if(isset($_REQUEST['edit'])){
	if(is_numeric($_REQUEST['id'])){
		$UNIINF = getInfo('users_locations',"loc_id=$_REQUEST[id]");
		$_REQUEST['compid']=$UNIINF['com_id'];
		$_REQUEST['location']=$UNIINF['location'];
 		
	}
}

/*
if(isset($_POST['submit_locinfo']))
{
	print_r($_POST);
}*/
?> 
           <section class="retracted scrollable">
<div class="row">
  <div class="col-md-12">
    <div class="report-sec">
      <div class="panel panel-default panel-block">
         <div class="page-section-title">
                    <h2 class="box_head">
        <?=(isset($_REQUEST['id']))?'Edit':'Add'?> Locations
        </h2>
        </div>
        <div class="panel panel-default panel-block">
                        <div class="list-group">
                            <div class="list-group-item">
                            
                            
                            
                                <form name="loc_info" method="post" id="locinfoform">
   <input type="hidden" name="addeditsec" value="<?php if(isset($_REQUEST['compid']))
								{echo "editsec";}else{echo "addsec";}
								?>"  />
                            <?php
                            if(isset($_REQUEST['id']))
							{
							?>    
 							<input type="hidden" name="locid" value="<?php echo $_REQUEST['id'];?>"  />
                             <?php
                            }
							?>
                               <div class="form-group">
                                    <label for="uni">Select Company:</label>
                                   
                                    <div>
                                <select class="select_box form-control" name="com_id" required>
													<option value="">--Select Company--</option>
                        <?php
						$companys = $db->select("company","*","1=1 ORDER BY name ASC");
						if(mysql_num_rows($companys)>0){
							while($company = mysql_fetch_array($companys)){ ?>
                        		<option value="<?php echo $company['id']; ?>" 
									<?php if(isset($_REQUEST['compid'])) if($company['id']==$_REQUEST['compid']) echo 'selected="selected"'; ?>>
									<?php echo $company['name']; ?>
                                </option>
                        <?php }
						} ?>
												</select>	
                                  
                                  </div>
                                
                                </div>
                                
                                <div class="form-group">
                                    <label for="uni">Location:</label>
                                    <div>
                                    <input class="req input etitle form-control" title="Input Location" type="text" name="location" value="<?=$_REQUEST['location']?>" required >
                                    </div>
                                </div>
                                
                                 <div class="button_bar clearfix">
                                <button type="submit" class="btn btn-success has_text" style="float:right;" name="submit_locinfo" >
                                <span><?=(isset($_REQUEST['id']))?'Save':'Add'?> Location</span>
                                </button>
                                </div>
                                </form>
        		</div>
            </div>
        </div>
        </div>
        </div>
    </div>
    
</div>
</section>    
    
           <section class="retracted scrollable">
<div class="row">
  <div class="col-md-12">
    <div class="report-sec">
      <div class="panel panel-default panel-block">
         <div class="page-section-title">
                    <h2 class="box_head">Locations Listing</h2>
                    </div>
      <div class="panel panel-default panel-block">
                    
                             

                          <table class="table table-bordered table-striped" id="tableSortable">
                          <thead>
                            <tr>
                              <th>Company Name</th>
                              <th>Location</th>
                               <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                                    //$unies = $db->select("users_locations","*","1=1 ORDER BY loc_id DESC");
                                 $tabl = "company comp INNER JOIN users_locations comploc ON comp.id=comploc.com_id ";
								 
								$unies = $db->select($tabl,"*",'1=1 ORDER BY comploc.loc_id DESC');   
									
									if(mysql_num_rows($unies)>0){
                                        while($uni = mysql_fetch_array($unies)){ ?>
                            <tr class="gradeX rem_<?=$uni['loc_id']?>">
                              <td><?=$uni['name']?> </td>
                              <td><?=$uni['location']?></td>
                               <td><i  onclick="submitLink('id=<?=$uni['loc_id']?>&edit')"  class="icon-edit"  title="Edit" ></i>
                                <a href="#" onclick="deleteItem(<?=$uni['loc_id']?>)" title="Delete">X</a>

                               </td>
                            </tr>
                            <?php 	}}?>
                          </tbody>
                        </table>
                      
		</div>
	</div>
</div>
</div>
</div>
</section>
                    <script src="scripts/proton/tables.js"></script>
<?php //include("include_pages/pager_inc.php"); ?>
<script>

function deleteItem(locid) {
    if (confirm("Are you sure you want to delete?")) {
 var locid = locid;
//alert(myTextField);
$.ajax({    
    type: "POST",
    url: "actions.php",
    data: "action=ePage&ePage=add_rating&deleteloccomp=1&locid="+locid,
  
    success: function(response){
		
	$(".rem_"+locid).remove();
    alert(response);    
 }
});
 	   
    }
    return false;
}
</script>