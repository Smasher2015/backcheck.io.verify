<?php 
$tcheck = array();

$selChecks = $db->select("ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id","*","user_id=262 AND as_status!='Close' AND as_vstatus!='QC' AND is_skipped=0");
if(mysql_num_rows($selChecks)>0){
	$_REQUEST="";
	$c=0;
while($rsChecks = mysql_fetch_assoc($selChecks)){
	$c++;
	$_REQUEST['case'] = $rsChecks['v_id'];
	$_REQUEST['ascase']= $rsChecks['as_id'];

	//$tcheck = checkAction(0,$_REQUEST);
	$tcheck['t_id']=36;
	$tcheck['t_title']="Case Information";
	$tcheck['t_name']="checksub";
	
	
	$csSts = strtolower(trim($rsChecks['as_status']));
	$as_qastatus = strtolower(trim($rsChecks['as_qastatus']));
	$csrmk = strtolower(trim($rsChecks['as_remarks']));
	if(is_array($tcheck)){
		$fields = actionFields($tcheck['t_id'],9); 
		if(mysql_num_rows($fields)>0){ 
		if($c==1){?>
<!-- this is upper section !-->
 <section class="retracted"  >
  <div class="row">
    <div class="col-md-12">
	
	<?php include("include_pages/nadra_basic_info_inc.php");?>
	
	
	
      <div class="report-sec">
        <div class="panel panel-default panel-block">
          <div class="page-section-title">
            <h2 class="box_head">
              <?php  echo '  '.$tcheck['t_title'].' '; ?>
            </h2>
          </div>
          <div class="list-group-item">
            <form method="post" enctype="multipart/form-data" name="dataForm" >
              <?php while($field = mysql_fetch_array($fields)){ 
                            if($field['fl_key']!='multy'){
                                if($field['is_multy']==1) $is_multy=$field['fl_title'];
                                $tFld = renderFields($field);
                                if($tFld){ ?>
              <fieldset class="label_side" style="padding:10px; border-bottom:1px solid #eee;">
                
                <label style="float:left; margin-right:15px;">
                  <?=$field['fl_title']?>
                  :</label>
                  <?=$tFld?>
                </fieldset>
              <?php } }else{ ?>
              <table class="static">
                <thead>
                  <tr>
                    <th><b>Information Title</b></th>
                    <th><b>Information Provided</b></th>
                    <th><b>Information Verified</b></th>
                  </tr>
                </thead>
                <?php for($i=1;$i<=8;$i++){
                                            $data = getData($rsChecks['as_id'],$field['fl_key']," AND d_num=$i");
                                            $data = mysql_fetch_array($data); ?>
                <tr >
                  <td><input class="text" type="text" name="mtt<?php echo $i;?>" value="<?php echo $data['d_mtitle'];?>" /></td>
                  <td><input class="text" type="text" name="stt<?php echo $i;?>" value="<?php echo $data['d_stitle'];?>" /></td>
                  <td><input class="text" type="text" name="val<?php echo $i;?>" value="<?php echo $data['d_value'];?>" /></td>
                </tr>
                <?php } ?>
              </table>
              <?php  }}?>
			  
			  
			  
			  <fieldset class="label_side">
                  <label>Country :<span>Please Select Country</span></label>
                  <div class="form-group">
                    <select name="country" class="form-control" onchange="updatecity(this)">
                      <option value="0" >--Select Country--</option>
                      <?php 
                                        $countries = $db->select("country","country_id,printable_name");
                                        while($country = mysql_fetch_assoc($countries)){ ?>
                      <option value="<?=$country['country_id']?>" <?=($rsChecks['country_id']==$country['country_id'])?'selected="selected"':''?> >
                      <?=$country['printable_name']?>
                      </option>
                      <?php } ?>
                    </select>
                  </div>
                </fieldset>
                <fieldset class="label_side">
                  <label>City/State :<span>Please Select City / State</span></label>
                  <div id="updatecity">
                    <?php
                                    $_REQUEST['cntid'] = $rsChecks['country_id'];
                                    include("include_pages/getcity_inc.php");                            
                                ?>
								
								
								
                  </div>
				   <input type="hidden" name="ascase" value="<?=$rsChecks['as_id']?>"  />
                  <input type="hidden"  name="addctyctry" value="Add Information"> 
                </fieldset>
                
			  <fieldset class="label_side">
                  <label>Proof's Title :<span>Please type proof's title</span></label>
                  <div>
                    <input class="input form-control" type="text" name="ftitle" value="<?=(isset($_REQUEST['ftitle']))?$_REQUEST['ftitle']:"Verification Proof"?>" >
                  </div>
                </fieldset>
                <fieldset class="label_side">
                  <label>Attach Proofs :<span>Please attach proofs</span></label>
                  <div>
                    <div id="uniform-fileupload">
                      <input type="file" class="uniform" id="file" name="file" size="21" >
                    </div>
                  </div>
				  <input type="hidden"  name="uploadFile" value="Upload Proof">
                </fieldset>
                
			  
			  
			  
              <div class="button_bar clearfix">
			  <button type="submit" class="btnright img_icon has_text" name="closeCase"><span>Submit to QC</span></button>
                <input type="hidden"  name="<?php echo $tcheck['t_name']; ?>" value="<?php echo $tcheck['t_btn']; ?>">
                <?php
                        if($tcheck['as_vstatus']!=''){?>
                <input type="hidden" value="<?php echo $tcheck['as_vstatus']; ?>" name="vStatusN" />
                <?php } ?>
                <div class="clear" ></div>
              </div>
            </form>
			
			<form name="skip_check" id="skip_check" method="post" >
			 <div class="button_bar clearfix" style="margin-top:30px; float:left;">
			  <a   class="btnright img_icon has_text btn-danger" onclick="submitSkipForm();"><span>Skip This Check</span></a>
                <input type="hidden" name="skipCheck" value="1"  />
				<input type="hidden" name="as_id" value="<?=$rsChecks['as_id']?>"  />
                
                <input type="hidden" value="1" name="is_skipped" />
                
                <div class="clear" ></div>
              </div>
			  </form>
            <?php if($verCheck['t_check']>0){ ?>
            <div class="button_bar clearfix">
              <form method="post" enctype="multipart/form-data">
                <?php if(isset($is_multy)){?>
                <input type="hidden" value="1" name="isMulty" />
                <button type="submit" class="btnright img_icon has_text" name="nextface"> <span>Close [ <?php echo $tcheck['t_title']; ?> ] &gt;&gt;</span> </button>
                <?php } ?>
                <button type="submit" class="btnright img_icon has_text" name="prvsface"><span><< Back</span></button>
                <input type="hidden" value="<?=($verCheck['t_check']-1)?>" name="pBack"  />
              </form>
            </div>
            <?php } ?>
          <div class="clear"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- this is upper section !-->
<?php }
	}
	}
		


}
}else{ ?>

<section class="retracted">
  <div class="row">
    <div class="col-md-12">
      <div class="report-sec">
        <div class="panel panel-default panel-block">
          <div class="page-section-title">
            <h2 class="box_head">
              Nadra Checks Submission
            </h2>
          </div>
		 </div>
		 <p>No checks available.</p>
	  </div>
	</div>
  </div>
</section>
 

<?php } ?>






<SCRIPT language='JavaScript'>
 function submitSkipForm(){
if(confirm("Are you sure want to skip this check ?")){
    document.skip_check.action = '<?php echo SURL.'?action='.$_REQUEST['action'];?>';
    document.skip_check.method = 'post';
    document.skip_check.submit() ;
	}
    }
    
</SCRIPT>

