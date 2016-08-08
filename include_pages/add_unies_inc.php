<?php
if(isset($_REQUEST['edit'])){
	if(is_numeric($_REQUEST['id'])){
		$UNIINF = getInfo('uni_info',"uni_id=$_REQUEST[id]");
		$_REQUEST['uni']=$UNIINF['uni_Name'];
		$_REQUEST['rgn']=$UNIINF['uni_region'];
		$_REQUEST['cty']=$UNIINF['uni_city'];
		$_REQUEST['url']=$UNIINF['uni_url'];
		$_REQUEST['acd']=$UNIINF['uni_ac_url'];
		$_REQUEST['inf']=$UNIINF['uni_var'];
		$_REQUEST['ufee']=$UNIINF['uni_fee'];
		$_REQUEST['beneficiary']=$UNIINF['uni_ben'];
		$_REQUEST['uni_req']=$UNIINF['uni_req'];
		$_REQUEST['letter_to_add']=$UNIINF['letter_to_add'];
		
		$_REQUEST['vendor']=$UNIINF['uni_vendor'];
		$_REQUEST['charges']=$UNIINF['uni_vchar'];
		$_REQUEST['ddreq']=$UNIINF['uni_ddr'];
		$_REQUEST['nfee']=$UNIINF['uni_nfe'];
		
	}
}
?> 
           <section class="retracted scrollable">
<div class="row">
  <div class="col-md-12">
    <div class="report-sec">
      <div class="panel panel-default panel-block">
         <div class="page-section-title">
                    <h2 class="box_head">
        <?=(isset($_REQUEST['id']))?'Edit':'Add'?> University
        </h2>
        </div>
        <div class="panel panel-default panel-block">
                        <div class="list-group">
                            <div class="list-group-item">
                                <form name="uni_info" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="uni">University:</label>
                                    <div>
                                    <input class="req input etitle form-control" title="Input University" type="text" name="uni" value="<?=$_REQUEST['uni']?>" >
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                <label for="beneficiary">Beneficiary:</label>
                                <div>
                                <input type="text" name="beneficiary" value="<?=$_REQUEST['beneficiary']?>" class="input form-control">
                                </div>
                                </div>
                                
                                
                                <div class="form-group">
                                <label for="ufee">Fee Amount:</label>
                                <div>
                                <input class="input form-control" type="text" name="ufee" value="<?=$_REQUEST['ufee']?>" >
                                </div>
                                </div>
                                
                                
                                <div class="form-group">
                                <label for="vendor">Vendor:</label>
                                <div>
                                <input class="input form-control" type="text" name="vendor" value="<?=$_REQUEST['vendor']?>" >
                                </div>
                                </div>
                                
                                
                                <div class="form-group">
                                <label for="charges">Vendor Charges:</label>
                                <div>
                                <input class="input form-control" type="text" name="charges" value="<?=$_REQUEST['charges']?>" >
                                </div>
                                </div>
                                
                                
                                <div class="form-group">
                                <label for="ddreq" class="checkbox-inline" >
                                	<input type="checkbox" name="ddreq" value="<?=$_REQUEST['ddreq']?>" <?=($_REQUEST['ddreq']==1)?'checked="checked"':''?> >
									DD Required:
                                </label>
                                </div>
                                
                                <div class="form-group">
                                <label for="nfee" class="checkbox-inline">
                                	<input type="checkbox" name="nfee" value="<?=$_REQUEST['nfee']?>" <?=($_REQUEST['nfee']==1)?'checked="checked"':''?> >
									No Fees:
                                </label>
                                </div>
                                
                                
                                <div class="form-group">
                                <label for="rgn">Region:</label>
                                <div>
                                <select name="rgn" class="select_box form-control" title="Select Region">
                                <option value="" >--Select Region--</option>
                                <?php
                                $regions = $db->select("uni_info","DISTINCT uni_region","uni_region<>'' ORDER BY uni_region");
                                while($region = mysql_fetch_array($regions)){ ?>
                                <option value="<?php echo $region['uni_region']; ?>" 
                                <?php 	if(isset($_REQUEST['rgn'])){
                                if($_REQUEST['rgn']==$region['uni_region']){
                                echo 'selected="selected"';	
                                }
                                }
                                ?>> <?php echo $region['uni_region']; ?> </option>
                                <?php } ?>
                                </select>
                                </div>
                                </div>
                                <div class="form-group">
                                <label for="cty">City:</label>
                                <div>
                                <select  name="cty" class="select_box form-control" title="Select City">
                                <option value="" selected="selected">--Select City--</option>
                                <?php
                                $cities = $db->select("cities ORDER BY c_city","DISTINCT c_city");
                                while($city = mysql_fetch_array($cities)){ ?>
                                <option value="<?php echo $city['c_city']; ?>"
                                <?php 	if(isset($_REQUEST['cty'])){
                                if($_REQUEST['cty']==$city['c_city']){
                                echo 'selected="selected"';	
                                }
                                }
                                ?>                            
                                ><?php echo $city['c_city']; ?></option>
                                <?php } ?>
                                </select>
                                </div>
                                </div>
                                <div class="form-group">
                                <label for="url">Web Site:</label>
                                <div>
                                <input class="input form-control" type="text" name="url" value="<?=$_REQUEST['url']?>" >
                                </div>
                                </div>
                                <div class="form-group">
                                <label for="acd">Accreditation:</label>
                                <div>
                                <input class="input form-control" type="text" name="acd" value="<?=$_REQUEST['acd']?>" >
                                </div>
                                </div>
                                <div class="form-group">
                                <label for="inf">Information:</label>
                                <div>
                                <textarea class="input form-control" name="inf" ><?=$_REQUEST['inf']?>
                                </textarea>
                                </div>
                                </div>
                                <div class="form-group">
                                <label for="inf">Documents Required:</label>
                                <div>
                                <input class="input form-control" type="text" name="uni_req" value="<?=$_REQUEST['uni_req']?>" >
                                
                                </div>
                                </div>
                                
                                <div class="form-group">
                                <label for="inf">Letter To Be Addressed To:</label>
                                <div>
                                <input class="input form-control" type="text" name="letter_to_add" value="<?=$_REQUEST['letter_to_add']?>" >
                                
                                </div>
                                </div>
                                <?php if(isset($_REQUEST['id'])){ ?>
                                <input type="hidden" value="<?=$_REQUEST['id']?>" name="id" >
                                <input type="hidden" name="edit" value="" >
                                <?php } ?>
                                <div class="button_bar clearfix">
                                <button type="submit" class="btn btn-success has_text" style="float:right;" name="submit_uniinfo" >
                                <span><?=(isset($_REQUEST['id']))?'Save':'Add'?> University</span>
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
                    <h2 class="box_head">Universities Listing</h2>
                    </div>
      <div class="panel panel-default panel-block">
                    
                             

                          <table class="table table-bordered table-striped" id="tableSortable">
                          <thead>
                            <tr>
                              <th>University, Beneficiary</th>
                              <th>Fee</th>
                              <th>Region</th>
                              <th>City</th>
                              <th>Web Site</th>
                             <?php /*?> <th>Accreditation</th><?php */?>
                              <th>Information</th>
                              <th>&nbsp;</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                                    $unies = $db->select("uni_info","*","1=1 $SSTR ORDER BY uni_id DESC");
                                    if(mysql_num_rows($unies)>0){
                                        while($uni = mysql_fetch_array($unies)){ ?>
                            <tr class="gradeX">
                              <td><?=$uni['uni_Name']?>, <?=$uni['uni_ben']?></td>
                              <td><?=$uni['uni_fee']?></td>
                              <td><?=$uni['uni_region']?></td>
                              <td><?=$uni['uni_city']?></td>
                              <td><?=$uni['uni_url']?></td>
                              <?php /*?><td><?=$uni['uni_ac_url']?></td><?php */?>
                              <td><?=$uni['uni_var']?></td>
                              <td><?php /*?><img class="edit" onclick="submitLink('id=<?=$uni['uni_id']?>&edit')" src="images/icons/small/grey/create_write.png" /><?php */?><i  onclick="submitLink('id=<?=$uni['uni_id']?>&edit')"  class="icon-edit"  title="Edit" ></i></td>
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
