<?php 
if(isset($_REQUEST['edit'])){
	if(is_numeric($_REQUEST['check'])){
		$data = getInfo('savvion_check',"id=$_REQUEST[check]");
		$_REQUEST['SubBarcode'] 			=$data['SubBarcode'];
		$_REQUEST['ClientName'] 			=$data['ClientName'];
		$_REQUEST['ClientRefNo'] 			=$data['ClientRefNo'];	
		$_REQUEST['DateOfBirth']			=$data['DateOfBirth'];
		$_REQUEST['PassportNo'] 			=$data['PassportNo'];
		$_REQUEST['AKAName'] 				=$data['AKAName'];
		$_REQUEST['Gender'] 				=$data['Gender'];	
		$_REQUEST['Nationality']			=$data['Nationality'];
		$_REQUEST['ArabicName'] 			=$data['ArabicName'];
		$_REQUEST['_UNBOUND_textArea3'] 	=$data['_UNBOUND_textArea3'];
		$_REQUEST['HistoryRemarks'] 		=$data['HistoryRemarks'];	
		$_REQUEST['_UNBOUND_historyNew']	=$data['_UNBOUND_historyNew'];
		
		
		/*$_REQUEST['Education_UniversityName']		=$data['Education_UniversityName'];
		$_REQUEST['Education_UniversityAddress']	=$data['Education_UniversityAddress'];
		$_REQUEST['Education_City']					=$data['Education_City'];
		$_REQUEST['Education_Country']				=$data['Education_Country'];
		$_REQUEST['Education_Telephone']			=$data['Education_Telephone'];
		$_REQUEST['IA_Name']						=$data['IA_Name'];
		$_REQUEST['IA_Address']						=$data['IA_Address'];
		$_REQUEST['IA_City']						=$data['IA_City'];
		$_REQUEST['IA_Country']						=$data['IA_Country'];
		$_REQUEST['IA_Fax']							=$data['IA_Fax'];
		$_REQUEST['IA_Email']						=$data['IA_Email'];
		$_REQUEST['IA_WebAddress']					=$data['IA_WebAddress'];
		$_REQUEST['IA_IsFake']						=$data['IA_IsFake'];
		$_REQUEST['IA_IsOnline']					=$data['IA_IsOnline'];
		$_REQUEST['IA_Telephone']					=$data['IA_Telephone'];
		$_REQUEST['Employment_CompanyName']			=$data['Employment_CompanyName'];
		$_REQUEST['Employment_CompanyAddress']		=$data['Employment_CompanyAddress'];
		$_REQUEST['Employment_City']				=$data['Employment_City'];
		$_REQUEST['Employment_Country']				=$data['Employment_Country'];
		$_REQUEST['Employment_Telephone']			=$data['Employment_Telephone'];
		$_REQUEST['Employment_WebAddress']			=$data['Employment_WebAddress'];
		$_REQUEST['IA_ContactPerson']				=$data['IA_ContactPerson'];
		$_REQUEST['HltLicense_AuthorityName']		=$data['HltLicense_AuthorityName'];
		$_REQUEST['HltLicense_AuthorityAddress']	=$data['HltLicense_AuthorityAddress'];
		$_REQUEST['HltLicense_City']				=$data['HltLicense_City'];
		$_REQUEST['HltLicense_Country']				=$data['HltLicense_Country'];
		$_REQUEST['HltLicense_Telephone']			=$data['HltLicense_Telephone'];
		$_REQUEST['HltLicense_WebAddress']			=$data['HltLicense_WebAddress'];*/

		
		
		if (preg_match('/ED/',$_REQUEST['SubBarcode'])){
			$tab_value = 1;
			$savv_checkId = $data['id'];
		}
		if (preg_match('/EM/',$_REQUEST['SubBarcode'])){
			$tab_value = 2;
			$savv_checkId = $data['id'];
		}
		if (preg_match('/HL/',$_REQUEST['SubBarcode'])){
			$tab_value = 3;
			$savv_checkId = $data['id'];
		}

	}
}
?>

<section class="retracted scrollable">
    <div class="row">
        <div class="col-md-12">
            <div class="manager-report-sec">
                
                 <div>
                     <div class="list-group-item">
                      <h2 class="box_head">Assign Savvion Checks</h2>
                      <form class="table-form" action="" method="post" name="assignSavvion">
                      <table class="table table-bordered table-striped" id="tableSortable">
                        <thead>
                          <tr>
                          	<th>&nbsp;</th>
                            <th>Reference No</th>
                            <th>Client Name</th>
                            <th>Client Reference No</th>
                            <th width="60">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php	
						$checks = $db->select("savvion_check","*","user_id=0 OR user_id!=0");
                        if(mysql_num_rows($checks)>0){
                        while($check = mysql_fetch_array($checks)){ ?>
                          <tr>
                          	<td><input type="checkbox" name="record[]" value="<?=$check['id']?>"></td>
                            <td><?=mb_convert_encoding($check['SubBarcode'], 'HTML-ENTITIES','UTF-8');?></td>
                            <td style="text-align:left"><?=$check['ClientName']?></td>
                            <td><?=$check['ClientRefNo']?></td>
                            <td align="center"><?php  if($check['is_active']==1) {
                                                           $img="accept.png";
                                                $tit="Disable"; 
                                            }else{
                                                 $img="cog_3.png";
                                                 $tit="Enable";
                                            } 
                                            $link="check=$check[id]";
                                    ?>
                              <?php /*?><a href="javascript:void(0)" ><img onclick="submitLink('<?=$link?>&edur')" src="images/icons/small/grey/<?=$img?>" class="edits" title="<?=$tit?>"  /> </a><?php */?> <a href="javascript:void(0)" ><img onclick="submitLink('<?=$link?>&edit')" src="images/icons/small/grey/pencil.png"  class="edits" title="Edit"  /> </a></td>
                          </tr>
                          <?php }}else{ ?>
                          <tr>
                           <td></td><td></td><td ><h2 align="center">No Checks</h2></td><td></td><td></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                      		<div class="form-group">
                                    <label>Savvion Team Lead :</label>
                                    <select class="form-control" id="source" name="team_lead_id">
                                    	<option value="">Please Select</option>
                                    <?php $team_lead = $db->select("users","*","level_id = 13 and is_active = 1");
											if(mysql_num_rows($team_lead)>0){
											while($tlead = mysql_fetch_array($team_lead)){ 
											?>
                                            <option value="<?=$tlead['user_id']?>"><?=ucwords($tlead['first_name'])?></option>
										<?php 	}
										}
									?>
                                            
                                    </select>
                                </div>
                     		 <button type="submit" class=" btn btn-success dropdown-toggle" style="float:right;" name="assignSavvionChecks" > <span>Assign Check</span> </button>
                      </form>
                    </div>
        		</div>
                
                
            </div>
        
        
        
        	
        
        </div>
        
        
    </div>
<script>

function getFormData(CheckId,savv_check_id){
	
	if(typeof savv_check_id == "undefined"){ //no errors
		$.ajax({
			url: "actions.php",
			data:'ePage=add_rating&getcheckname='+CheckId,
			type: "POST",
			success: function(res){
		   
				$('.resultDiv').html(res);
			}
			});
	
	}else{
				$.ajax({
			url: "actions.php",
			data:'ePage=add_rating&getcheckname='+CheckId+'&savv_check_id='+savv_check_id,
			type: "POST",
			success: function(res){
		   
				$('.resultDiv').html(res);
			}
			});

		
	}
}



$(document).ready(function(){
    var tab_value = '<?php echo $tab_value; ?>';
	var savv_checkId = '<?php echo $savv_checkId;?>';
	if(tab_value != 0 ){
		if(tab_value == 1){
			getFormData(1,savv_checkId);
		}
		if(tab_value == 2){
			getFormData(2,savv_checkId);
		}
		if(tab_value == 3){
			getFormData(3,savv_checkId);
		}
	}else{		
		getFormData(1);
	}
	//alert(tab_value);
	/*if(tab_value){
		switch(tab_value){
			case 1:
			getFormData(1);
			break;
			case 2:
			getFormData(2);
			break;
			case 3:
			getFormData(3);
			break;
			
		}
	}*/

});
</script>