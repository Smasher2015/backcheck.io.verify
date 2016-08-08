

<?php //print_r($verCheck);
	//echo $verCheck['t_check'];
	$tcheck = checkAction($verCheck['t_check'],$_REQUEST);
	
	$csSts = strtolower(trim($verCheck['as_status']));
	$as_qastatus = strtolower(trim($verCheck['as_qastatus']));
	$csrmk = strtolower(trim($verCheck['as_remarks']));
	if(is_array($tcheck)){ 
		$fields = actionFields($tcheck['t_id'],$_REQUEST['check']);
	if(is_check_sufficiency($verCheck['as_id'])){	
		if(mysql_num_rows($fields)>0){  ?>
<!-- this is upper section !-->
 <section class="retracted">
  <div class="row">
    <div class="col-md-12">
      <div class="report-sec">
        <div class="panel panel-default panel-block">
          <div class="page-section-title">
            <h2 class="box_head">Step
              <?php  echo ($verCheck['t_check']+1).' [ '.$tcheck['t_title'].' ]'; ?>
            </h2>
          </div>
          <div class="list-group-item">
            <form method="post" class="labelside_check" enctype="multipart/form-data" name="dataForm" >
              <?php 
			  
			  while($field = mysql_fetch_array($fields)){
				 // print_r($field); 
                            if($field['fl_key']!='multy'){
                                if($field['is_multy']==1) $is_multy=$field['fl_title'];
                                $tFld = renderFields($field);
                                if($tFld){ ?>
              <fieldset class="label_side" style="padding:10px;">
                
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
                                            $data = getData($_REQUEST['ascase'],$field['fl_key']," AND d_num=$i");
                                            $data = mysql_fetch_array($data); ?>
                <tr >
                  <td><input class="text" type="text" name="mtt<?php echo $i;?>" value="<?php echo $data['d_mtitle'];?>" /></td>
                  <td><input class="text" type="text" name="stt<?php echo $i;?>" value="<?php echo $data['d_stitle'];?>" /></td>
                  <td><input class="text" type="text" name="val<?php echo $i;?>" value="<?php echo $data['d_value'];?>" /></td>
                </tr>
                <?php } ?>
              </table>
              <?php  }}?>
              <div class="button_bar clearfix">
                <button type="submit" class="btn btn-success" name="<?php echo $tcheck['t_name']; ?>"> <span><?php echo $tcheck['t_btn']; ?></span> </button>
                <?php
                        if($tcheck['as_vstatus']!=''){?>
                <input type="hidden" value="<?php echo $tcheck['as_vstatus']; ?>" name="vStatusN" />
                <?php } ?>
                <div class="clear" ></div>
              </div>
            </form>
            <?php 
			
			if($verCheck['t_check']>0){ ?>
            <div class="button_bar clearfix">
              <form method="post" enctype="multipart/form-data">
                <?php if(isset($is_multy)){?>
                <input type="hidden" value="1" name="isMulty" />
                <button type="submit" class="btnright img_icon has_text btn btn-info" name="nextface"> <span>Close [ <?php echo $tcheck['t_title']; ?> ] &gt;&gt;</span> </button>
                <?php } ?>
                <button type="submit" class="btnright img_icon has_text btn btn-danger" name="prvsface"><span><< Back</span></button>
                <input type="hidden" value="<?=($verCheck['t_check']>0)?($verCheck['t_check']-1):$verCheck['t_check'];?>" name="pBack"  />
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
	}else{?>
<section class="retracted">
  <div class="row">
    <div class="col-md-12">
      <div class="report-sec">
        <div class="panel panel-default panel-block">
		 <div class="list-group-item">
            <div class="block">
          <div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered col-md-12">To start verfication clear insufficiency first. 
		  <form id="confirmsuff" name="confirmsuff" onsubmit="confirmSufficient(); return false;" method="post">
			 
                <button class="btnright btn btn-success float-right" type="submit" id="for_insuff_cleared" >
                	<span>Please confirm insufficiency is cleared.</span>
                </button>
				<input type="hidden" name="confirm_check_suff" value="1">
				<input type="hidden" name="com_name" value="<?php echo $conInf['name'];?>">
				<input type="hidden" name="app_name" value="<?php echo $verCheck['v_name'];?>">
				<input type="hidden" name="chk_name" value="<?php echo $verCheck['checks_title'];?>">
				<input type="hidden" name="v_id" value="<?php echo $verCheck['v_id'];?>">
				<input type="hidden" name="as_id" value="<?php echo $verCheck['as_id'];?>">
           
			</form></div>
			</div>
			<div class="clear"></div>
		</div>
		</div>
      </div>
    </div>
  </div>
</section>
	<?php }
	} elseif($verCheck['citystate_id']==0 || $verCheck['country_id']==0){ ?>
     
<section class="retracted">

  <div class="row">
    <div class="col-md-12">
      <div class="manager-report-sec">
        <div class="panel panel-default panel-block">
          <div class="page-section-title">
            <h2 class="box_head">Add Country and City</h2>
          </div>
          <div class="list-group-item">
            <div class="block">
              <form action="" class="labelside_check" method="post" enctype="multipart/form-data">
                <fieldset class="label_side" style="padding:10px;">
                  <label>Country :<span>Please Select Country</span></label>
                  <div class="form-group">
                  
                    <select name="country" class="form-control" onchange="updatecity(this)">
                      <option value="0" >--Select Country--</option>
                      <?php 
                                        $countries = $db->select("country","country_id,printable_name");
                                        while($country = mysql_fetch_assoc($countries)){ ?>
                      <option value="<?=$country['country_id']?>" <?=($verCheck['country_id']==$country['country_id'])?'selected="selected"':''?> >
                      <?=$country['printable_name']?>
                      </option>
                      <?php } ?>
                    </select>
                  </div>
                </fieldset>
                <fieldset class="label_side" style="padding:10px;">
                  <label>City/State :<span>Please Select City / State</span></label>
                  <div id="updatecity">
                    <?php
                                    $_REQUEST['cntid'] = $verCheck['country_id'];
                                    include("include_pages/getcity_inc.php");                            
                                ?>
                  </div>
                </fieldset>
                <div class="button_bar clearfix">
                  <input type="hidden" name="ascase" value="<?=$_REQUEST['ascase']?>"  />
                  <button type="submit" class="btnright img_icon has_text btn btn-success" name="addctyctry"> <span>Add Information</span> </button>
                </div>
              </form>
            </div>
            <div class="clear"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php }

else

{ 

if($csSts=='open' || ($as_qastatus=='rejected' && $csSts=='close'))
{ ?>
<section class="retracted">
  <div class="row">
    <div class="col-md-12">
      <div class="manager-report-sec">
        <div class="panel panel-default panel-block">
        <div class="page-section-title">
          <h2 class="box_head">Attach Proof(s)</h2>
        </div>
          <div class="toggle_container">
            <div class="block">
              <form action="" class="labelside_check" method="post" enctype="multipart/form-data">
                <fieldset class="label_side" style="padding:10px;">
                  <label>Proof's Title :<span>Please type proof's title</span></label>
                  <div>
                    <input class="input form-control" type="text" name="ftitle" value="<?=$_REQUEST['ftitle']?>" >
                  </div>
                </fieldset>
                <fieldset class="label_side" style="padding:10px;">
                  <label>Attach Proofs :<span>Please attach proofs</span></label>
                  <div>
                    <div id="uniform-fileupload">
                      <input type="file" class="uniform" id="file" name="file" size="21" >
                    </div>
                  </div>
                </fieldset>
                <div class="button_bar clearfix">
                  <input type="hidden" name="ascase" value="<?=$_REQUEST['ascase']?>"  />
                  <button type="submit" class="btnright img_icon has_text btn btn-info" name="uploadFile"> <span>Upload Proof</span> </button>
                </div>
              </form>
              <form enctype="multipart/form-data" method="post">
			  <div class="button_bar clearfix">
                  <div>
				  <?php if($LEVEL==2){?>  
				  <?php /* <label><input  type="checkbox"  id="selecctall">Select All</label><br> */ ?>
				  <?php }
				  
				  
				  $qc_check_lists = getQCCheckList($verCheck['checks_id']);
				  if(!empty($qc_check_lists)){
					  $closeDiabled = "disabled='disabled'";
					  $clsbtn = "btn-default";
					  $msgClsBtn = '"';
					  $c=0;
				  foreach($qc_check_lists as $chk_lst){
					  $c++; ?>
                   <label for="chk_lst<?php echo $c;?>"><input id="chk_lst<?php echo $c;?>" type="checkbox"  class="check_list"> <?php echo $c.". ".$chk_lst['check_list'];?></label><br>
				  <?php }
				  }else{
					  $closeDiabled = "";
					  $clsbtn = "";
					  $msgClsBtn = 'style="display:none"';
				  }				  ?>
                   
                  </div>
                </div>
                <div class="button_bar clearfix">
                  <div>
				 <?php 
				 $asvstatuss = array('work in process','work in progress');
				
				 $negtiveStatus = array('negative','match found','record found','unsatisfactory','positive match found');
				
				 if((in_array(strtolower($verCheck['as_vstatus']),$asvstatuss)) ||  ($verCheck['as_vstatus']=='0')   ){?>
                   <button class="btn btnright img_icon has_text btn-danger" disabled  ><span>Selected verification status is <span class="label bg-grey-300"><?php echo $verCheck['as_vstatus']?></span>. Please select correct verification status to close this check.</span></button> 
				 <?php }else{ 
				 if(in_array(strtolower($verCheck['as_vstatus']),$negtiveStatus)){
					 
				 if(in_array('file',$Fileds)){
					 
				?>
				<span class="text-danger text-semibold msgClsBtn" <?php echo $msgClsBtn;?>>Select all the checklist above to activate Close button</span>
				 <button type="submit" class="btn btn-success btnright img_icon has_text closebtn <?php echo  $clsbtn;?>" name="closeCase" <?php echo $closeDiabled;?>><span>Close [ Check ]</span></button>
				
				<?php
				
				 }else{
					$closeDiabled = "disabled='disabled'";
					$clsbtn = "btn-default";
					 $profReqMsg= 'Proof is required for '.$verCheck['as_vstatus'].' status.';
				?>
				 <button class="btn btnright img_icon has_text btn-danger" disabled  ><?php echo $profReqMsg;?></button> 
				 <?php }
				 }else{?>
				 <span class="text-danger text-semibold msgClsBtn"  <?php echo $msgClsBtn;?>>Select all the checklist above to activate Close button</span>
				  <button type="submit" class="btn btn-success btnright img_icon has_text closebtn <?php echo  $clsbtn;?>" name="closeCase" <?php echo $closeDiabled;?>><span>Close [ Check ]</span></button>
				 <?php }  } ?>
                    <?php if($verCheck['t_check']>0){ ?>
                    <button type="submit" class="btn btnright img_icon has_text  btn-danger" name="prvsface"><span><< Back</span></button>
                    <input type="hidden" value="<?=($verCheck['t_check']>0)?($verCheck['t_check']-1):$verCheck['t_check'];?>" name="pBack"  />
                    <?php } ?>
                  </div>
                </div>
              </form>
            </div>
            <div class="clear"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php }

}
		

		
if($LEVEL==2 && ($verCheck['as_adcls']==0 && $csSts=='close') && $verCheck['as_qastatus']=='Approved')
{ ?>
<section class="retracted">
  <div class="row">
    <div class="col-md-12">
      <div class="manager-report-sec">
        <div class="panel panel-default panel-block">
          <div class="page-section-title">
            <h2 class="box_head">Manager's Remarks</h2>
          </div>
          <div class="list-group-item">
            <div class="block">
              <form action="" method="post" enctype="multipart/form-data">
                <fieldset class="label_side">
                  <label>Case Status :<span>Please select case status</span></label>
                  <div class="form-group">
                    <select class="select_box form-control" name="vStatus" >
                      <option value="">--Select Verification Status--</option>
                      <option value="Verified" <?php echo ($vmSts=='verified')?'selected="selected"':''; ?> >Verified</option>
                      <option value="Negative" <?php echo ($vmSts=='negative')?'selected="selected"':''; ?> >Negative</option>
                      <option value="Discrepancy" <?php echo ($vmSts=='discrepancy')?'selected="selected"':''; ?>>Discrepancy</option>
                      <!-- <option value="Unable to Verify" <?php //echo ($vmSts=='unable to verify')?'selected="selected"':''; ?>>Unable to Verify</option>-->
                      <option value="Not Verified By Source" <?php echo ($vmSts=='not Verified By Source')?'selected="selected"':''; ?>>Not Verified By Source</option>
                      <option value="Addition Information Not Provided By Client" <?php echo ($vmSts=='addition Information Not Provided By Client')?'selected="selected"':''; ?>>Addition Information Not Provided By Client</option>
                      <option value="Partially Verified" <?php echo ($vmSts=='partially Verified')?'selected="selected"':''; ?>>Partially Verified</option>
                      <option value="Objection by Source" <?php echo ($vmSts=='objection by Source')?'selected="selected"':''; ?>>Objection by Source</option>
                      <option value="Processed But Cancelled By Client" <?php echo ($vmSts=='processed But Cancelled By Client')?'selected="selected"':''; ?>>Processed But Cancelled By Client</option>
                      <option value="Insufficient" <?php echo ($vmSts=='insufficient')?'selected="selected"':''; ?>>Insufficient</option>
                      <option value="original required" <?php echo ($vmSts=='original required')?'selected="selected"':''; ?>>Original Required</option>
                    </select>
                  </div>
                </fieldset>
                <fieldset class="label_side">
                  <label>Remark :<span>Please type Remarks for
                    <?=$verCheck['checks_title']?>
                    </span></label>
                  <div>
                    <textarea class="form-control" rows="5" name="remarks"></textarea>
                  </div>
                </fieldset>
                <div class="button_bar clearfix">
                  <input type="hidden" value="<?php echo $_REQUEST['ascase']; ?>" name="ascase"  />
                  <button type="submit"  class="btnright btn btn-success" name="sbremarks"> <span>Submit [ Remarks ] & Send to [ Ready Check(s) ]</span> </button>
                  <div class="clear"></div>
                </div>
              </form>
            </div>
            <div class="clear"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php } ?>

 <?php if($verCheck['as_adcls']==0 && $verCheck['as_qastatus'] != 'Work In Progress' ){


										 	//if($check['as_vstatus'] != 'Not Initiated'){
											
										 
										 	 switch($verCheck['as_qastatus']){
												 	case  "Approved":
													$color = '#8DC655';
													break;
													case  "Rejected":
													$color = '#e8511a';
													break;
													case  "QA":
													$color = '#00b9f7';
													break;

												}
													if(isset($_REQUEST['bitiframe']) && $_REQUEST['bitiframe']==1){
					if($_REQUEST['qa']==1){$qa=1;}else{$qa=0;}
				}else{
					$qa=1;
				}
										 ?>
										 
<section class="retracted">
  <div class="row">
    <div class="col-md-12">
      <div class="manager-report-sec">
        <div class="panel panel-default panel-block">
          <div class="page-section-title">
          <?php if($qa==1){ ?>
            <h2 class="box_head">QC</h2><?php } ?>
          </div>	
              <!--<div class="left-data-sec">Check Status</div>-->
              
              <?php $user_analyst =  $verCheck['user_id']; ?>
              <?php 
			  
			  if($LEVEL == 3 ){?>
			  <div class="list-group-item">
            <div class="block">
              <form  method="post">
                <input type="hidden" name="chck_qa" value="QA"  />
                <input type="hidden" name="as_id" value="<?=$verCheck['as_id']?>"  />
                <input type="hidden" name="analyst_id" value="<?=$user_analyst?>"  />
				
				
				<fieldset class="label_side">
                  <label>Analyst Comments</label>
                  <div>
				   <textarea id="basic-text-area" rows="5" name="qa_comments"  class="form-control"></textarea>
                  
                  </div>
                </fieldset>
				
				<div class="button_bar clearfix">
                
                  <button type="submit"  class="btnright btn btn-success" name="check_sumb_qa"> <span>Submit</span> </button>
                  <div class="clear"></div>
                </div>
				
				
                
               
              </form>
			   </div>
            <div class="clear"></div>
          </div>
              <?php }
			    // $_SESSION[user_id]=21 591 Zara's bit id temporary show only in portal 2 529 bit id sharjeel
				// for bitrix setting ($LEVEL == 2 && ($_REQUEST['quid']==591 || $_REQUEST['quid']==529))
				
				if($LEVEL == 2 && ($_SESSION['user_id']==21 || $_SESSION['user_id']==201 || isset($_REQUEST['bitiframe']))){
					//if($LEVEL == 2 ){
			  ?>
         <div class="list-group-item">
            <div class="block">
              <form  method="post">
                
                <input type="hidden" name="as_id" value="<?=$verCheck['as_id']?>"  />
                <input type="hidden" name="analyst_id" value="<?=$user_analyst?>"  />
                
				
				<fieldset class="label_side">
                  <label>QC Comments</label>
                  <div>
				 <textarea id="basic-text-area" rows="5" name="app_comments"  class="form-control"></textarea>
                  
                  </div>
                </fieldset>
				
				
					<div class="button_bar clearfix">
                 <?php if($verCheck['as_qastatus']=='Approved'){?>
                  <button type="button"  class="btnright btn btn-success"  disabled> <span>Approved</span> </button>
				 <?php }else{?>
				 <button type="submit"  class="btnright btn btn-success" name="check_approve"> <span>Approved</span> </button>
				 <?php } ?>
				 
				  <?php if($verCheck['as_qastatus']=='Rejected'){?>
                   <button type="button"  class="btnright btn btn-danger" disabled> <span>Rejected</span> </button>
				 <?php }else{?>
				 <button type="submit"  class="btnright btn btn-danger" name="check_reject"> <span>Reject</span> </button>
				 <?php } ?>
				 
                  <div class="clear"></div>
                </div>
		
              </form>
			   </div>
            <div class="clear"></div>
          </div> 
		  
		   
              <?php //} 
				} ?>
              <div style="margin-top:10px;">
                <?php 
				$whr = "_id = $verCheck[as_id] and com_type='qa' ORDER BY com_id DESC";
				$qa_comments = $db->select("comments","*",$whr); 
				$qa_data = mysql_num_rows($qa_comments);
				if(count($qa_data)>0){
						
				while($qrow = mysql_fetch_assoc($qa_comments)){
				$CommmentUInfo = getUserInfo($qrow['user_id']);
				?>
                <div class="comment-data-sec">
                  <div class="comment-left-data-sec"> <img src="<?=$CommmentUInfo['uimg']?>" title="<?="$CommmentUInfo[first_name] $CommmentUInfo[last_name]"?>"> </div>
                  <div class="comment-right-data-sec"> <strong><?php echo $qrow['com_title']; ?></strong>
                    <p><?php echo $qrow['com_text']; ?></p>
                    <span><?php echo ($qrow['user_id'] != 0) ? 'Posted by '.  trim($CommmentUInfo['first_name'].' '.$CommmentUInfo['last_name']) : '';?> <?php echo time_ago(strtotime($qrow['com_date'])); ?></span> </div>
                  <div class="clearFix"></div>
                </div>
                <div class="clearFix"></div>
                <?php }
														}
														?>
              </div>
           
            
			</div>
      </div>
    </div>
  </div>
</section>
			
			
            <?php } 
// back to 1st step button 522=Zubair Bitrix id
if($LEVEL==2 && $verCheck['is_sufficient']==1 && ($csSts!='close') && ($_REQUEST['quid']==522))
{ ?>
			<form  method="post" name="moveto1ststep" id="moveto1ststep">
                <div class="button_bar clearfix">
                  <input type="hidden" value="<?php echo $_REQUEST['ascase']; ?>" name="ascase"  />
                  <button type="submit"  class="btnright btn btn-danger" onclick="return moveto1st();" name="move_to_1st_step"><span>Move to 1st Step to mark insufficiency</span></button>
                  <div class="clear"></div>
                </div>
             </form>

			  
<?php } 


?>
<script>
function moveto1st(){
	//alert("here");
	if(confirm('Are you sure want to move this check to 1st step?')){
		document.moveto1ststep.submit();
	}else{
		return false;
	}
}
  $(window).on('load', function(){
	
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.check_list').each(function() { //loop through each checkbox
			
                this.checked = true;  //select all checkboxes with class "checkbox1" 
			if ($('.check_list:checked').length == $('.check_list').length) {
			 $(".closebtn").removeAttr('disabled');
			 $(".closebtn").removeClass('btn-default');
			 $(".msgClsBtn").hide();		
			 
			 
			}else{
			$(".closebtn").attr('disabled','disabled');	
			$(".closebtn").addClass('btn-default');
			$(".msgClsBtn").hide();
			}	
            });
        }else{
            $('.check_list').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1" 
			$(".closebtn").attr('disabled','disabled');	
			$(".closebtn").addClass('btn-default');	
			$(".msgClsBtn").show();	
            });         
        }
    });
	
	
	
	$("input.check_list").each(function(index, element){
	$(this).change(function(){
	if ($('.check_list:checked').length == $('.check_list').length) {
     $(".closebtn").removeAttr('disabled');
	 $(".closebtn").removeClass('btn-default');
	  $(".msgClsBtn").hide();
	 
	 
    }else{
	$(".closebtn").attr('disabled','disabled');	
	$(".closebtn").addClass('btn-default');
	 $(".msgClsBtn").show();
	 
	}
	});
	});
	
	
	$("select[name=as_vstatus]").change(function(index, element){
	var arr = [ 'negative', 'match found', 'positive match found', 'unsatisfactory' ];
	var as_vst = $(this).val().toLowerCase();
	if(as_vst=='negative' || as_vst=='match found' || as_vst=='positive match found' || as_vst=='unsatisfactory') {
	
	$("button[name=closeCase]").attr('disabled','disabled');
	$("button[name=closeCase]").next().html( '<span class="text-danger extSpan">Proof is required for '+$(this).val()+' status.</span>' );
	}else{
		
	$("button[name=closeCase]").removeAttr('disabled');	
	$(".extSpan").remove();	
	}
	//alert($(this).val());
	});
    
});


</script>