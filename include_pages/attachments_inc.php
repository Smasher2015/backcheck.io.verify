
<script>
<?php 
$data = (!empty($data))?$data:$verCheck;
//var_dump(' Data: ',$data ,' <br> verCheck',$verCheck); 
if($data['checks_id']==1){ ?>
$( "#checklist_resp" ).hide();
$('#for_insuff_cleared').attr("disabled","disabled");
<?php } ?>
function forunirequirments()
{
	var unilists = $("#unilists").val(); 
         $.ajax({
			type: 'POST',
            url: "actions.php",
            data: 'ePage=add_rating&uni_req_documents=yes&uni_id='+unilists,
            success: function(result){
				
				$( "#checklist_resp" ).show();
                  $( "#response_uni_req" ).html(result);
             }
			 
        });
 }
// $( document ).ready(function() {
//   if ($('#checklist_checked').is(':checked')) {
// alert("checklist_checked");
// }
//});
/* function valueChanged()
{
   if($('#checklist_checked').is(":checked"))   
      {   
 		  $("#for_insuff_cleared").prop("enable",true); 
		
	  }
	else
	{
       $("#for_insuff_cleared").prop("disable",true); 
	    alert("checklist_checked");

	}
	
	
	
}*/ $( document ).ready(function() {
 	$('#checklist_checked').click(function(){
     
    if($(this).is(":checked")){
		$('#for_insuff_cleared').removeAttr('disabled');
        
    }
    else {
          $('#for_insuff_cleared').attr("disabled","disabled");   
    }
});
});

</script>
<section>

<div class="row">
  <div class="col-md-12">
    <div class="report-sec">
      <div class="panel panel-default panel-block">
    		<div class="page-section-title">
            <h2 class="box_head">Attached Documents</h2>	
			</div>
            <?php /* if($data['checks_id']==1 && !is_check_sufficiency($data['as_id'])){ ?>
            <div class="form-group">
			<select name="unilists" id="unilists" class="select" onchange="forunirequirments();">
            <option value="">-- Select University --</option>
            <?php
           $Fields = $db->select("uni_info","*",'1=1');
		   
		   while($unis = mysql_fetch_array($Fields))
		   { 
		  		echo '<option value="'.$unis['uni_id'].'">'.$unis['uni_Name'].'</option>';
		   }
				?>
            </select>
            </div>
			<div id="response_uni_req"></div>
            <div id="checklist_resp" style="display:none"><input type="checkbox" id="checklist_checked" name="checklist_checked"  /></div>
            
			<?php } */  if(is_check_sufficiency($data['as_id'])){?>
			<div class="list-group-item">
			<div class="block">
			<div class="alert alert-info alert-styled-left alert-arrow-left alert-bordered col-md-12"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-remove"></i></button>The check's insufficiency marked as cleared.</div>
			</div>
			<div class="clear"></div>
			</div>
			<?php } ?>
          <div class="list-group-item">  
		  <form enctype="multipart/form-data" name="comments" method="post">
		  
		   <?php if($data['checks_id']==1 && !is_check_sufficiency($data['as_id'])){ 
		   $display_chkbox = "display:none";
			$ia_before_init = $data['ia_before_init'];
			if($ia_before_init!='' && $ia_before_init!=0){
			$getUniInfo = getUniInfo($ia_before_init);
			$uni_req = '<p>'.$getUniInfo['uni_req'].'</p>';
			$display_chkbox = "";
			} ?>
            <div class="form-group">
			<select name="unilists" id="unilists" class="select" onchange="forunirequirments();" required>
            <option value="">-- Select University --</option>
            <?php
			
           $Fields = $db->select("uni_info","*",'1=1');
		   
		   while($unis = mysql_fetch_array($Fields))
		   { 
		  		echo '<option value="'.$unis['uni_id'].'" '.chk_or_sel($unis['uni_id'],$ia_before_init,'selected').'>'.$unis['uni_Name'].'</option>';
		   }
				?>
            </select>
            </div>
			<div id="response_uni_req">
			<?php echo  $uni_req;?>
			</div>
            <div id="checklist_resp" style="<?php echo $display_chkbox;?>"><input type="checkbox" id="checklist_checked" name="checklist_checked"  /></div>
            
			<?php } ?>
		  
       <table class="table table-bordered table-striped" id="tableSortable">
            <tbody>
            
	   
			
              <?php 
			  
			  // Checks attachments
				$AttachWhere = "checks_id=".$_REQUEST['ascase']." AND case_id IS NOT NULL ";
										//echo $AttachWhere;
										$Attachments = getAttachments($AttachWhere);
				if($Attachments){ 
				$cc=0;
				while($attach = mysql_fetch_assoc($Attachments) ){
					$cc++;
				if($attach['att_file_path']){
					if($attach['att_insuff']==1){
					$btn = 'danger';	
					}else{
					$btn = 'success';		
					}
												
		 $ext =  		strtolower(pathinfo($attach['att_file_path'], PATHINFO_EXTENSION )); 
		 $exties = array('jpg','png','gif','bmp','jpeg','svg');
		
		
		 ?>
              <tr>
			  <td>
    <?php 
	
	 if(in_array($ext,$exties)){
	echo '<a href="javascript:void(0)"  data-toggle="modal" data-target="#myModal'.$cc.'"><strong>'.$cc.'.</strong> '.$attach['att_file_name'].'</a>
	<img src="'.$attach['att_file_path'].'" width="50"> ('.getSize(getcwd().'/files/'.basename($attach['att_file_path'])).')';
	 }else{
	echo '<a href="javascript:;" onclick="downloadAttachedFile(\''.basename($attach['att_file_path']).'\');" target="_blank" ><strong>'.$cc.'.</strong> '.$attach['att_file_name'].'</a>
	'.getFileIcon($ext).' ('.getSize(getcwd().'/files/'.basename($attach['att_file_path'])).')';	 
	 }		
		 ?> 
				
	                                
                                    
                                <!-- Modal -->
<div id="myModal<?php echo $cc;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"><i class="icon-attachment"></i><span><?=$attach['att_file_name']?></span></h4>
      </div>
      <div id="showDataimage" class="modal-body">
	  <?php if($attach['att_file_path']!=''){
		 $ext =  		pathinfo($attach['att_file_path'], PATHINFO_EXTENSION ); 
		
		  ?>
        <img class="" src="<?=$attach['att_file_path']?>" title="<?=$attach['att_file_name']?>" width="100%">
	  <?php }else{ 
		  echo "<h3>No Attachment available !</h3>";
	  } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
				
				
				
				
				
				
				
				
				
				
				</td>
                <td >
                  <a class="ctooltips" href="javascript:;" data-placement="top"><button type="button" class="btn btn-<?php echo $btn;?> btn-labeled pull-right" title=""     onclick="downloadAttachedFile('<?php echo basename($attach['att_file_path']);?>');"><b><i class="icon-cloud-download"></i></b> Download </button><span>Download Attachment</span></a>
                </td>
                <?php if(!is_check_sufficiency($data['as_id'])){?>
				<td><label> Is Insufficient?</label><br> 
				<input type="radio" name="att_insuff<?php echo $attach['att_id'];?>" id="<?php echo $attach['att_id'];?>_1" value="1" <?php echo chk_or_sel($attach['att_insuff'],1,'checked');?>> 
				<label for="<?php echo $attach['att_id'];?>_1"> Yes</label>
				
				<input type="radio" name="att_insuff<?php echo $attach['att_id'];?>" id="<?php echo $attach['att_id'];?>_2" value="0" <?php echo chk_or_sel($attach['att_insuff'],0,'checked');?>> 
				<label for="<?php echo $attach['att_id'];?>_2">No</label>
				<input type="hidden" name="att_id[]" value="<?php echo $attach['att_id'];?>">
				
                 <?php if($attach['att_comments'] != ""){?><br><span class="comments"><strong>Comment</strong> : <?=$attach['att_comments']?></span><?php } ?>
                
                <span id="commentdiv_<?=$cc?>" style="display:none"><textarea name="insuf_comm_<?=$attach['att_id']?>"><?=$attach['att_comments']?></textarea></span>
                 
                </td>
               
				<td><a href="javascript:;" onclick="delAttached('<?php echo base64_encode($attach['att_id']);?>');">Remove</a></td>
				<?php } ?>
              </tr>
			  
              
              
 <script type="text/javascript">
		
		$(document).ready(function(){
		$("#<?php echo $attach['att_id'];?>_1").click(function () {
		$('#commentdiv_<?=$cc?>').show();
		});


		$("#<?php echo $attach['att_id'];?>_2").click(function () {
		$('#commentdiv_<?=$cc?>').hide();
		});

		});



		</script>              
              
              
              
              
              
			 
              <?php }
			} // end while
			 if(!is_check_sufficiency($data['as_id'])){?>
			 <tr>
                <td  colspan="4"><div class="button_bar clearfix">
                <button class="btnright btn btn-success" type="submit" value="Update" name="insuff_docs" >
                	<span>Update</span>
                </button>
				<input type="hidden" name="com_name" value="<?php echo $conInf['name'];?>">
				<input type="hidden" name="app_name" value="<?php echo $data['v_name'];?>">
				<input type="hidden" name="chk_name" value="<?php echo $verCheck['checks_title'];?>">
				<input type="hidden" name="v_id" value="<?php echo $data['v_id'];?>">
				<input type="hidden" name="as_id" value="<?php echo $data['as_id'];?>">
            </div></td>
               
             </tr>
			 
			<?php
			 }
			}else{?>
             <tr>
                <td  colspan="3">No attachment added.</td>
               
             </tr>
              <?php } ?>
			  
          </tbody>
		  </table>
		  </form>
        </div>
     </div>
    </div>      
    
	
	
	<?php
	//echo "as_status: ".$data['as_status']." user_id:".$_SESSION['user_id'];
	if($data['as_status']!='Close'){
	?>
	<div class="report-sec">
      <div class="panel panel-default panel-block">
	  <div class="page-section-title">
            <h2 class="box_head">Attach More Documents</h2>	
			</div>
	<div class="more_attachemnts_<?php echo $data['as_id'];?> moreattachment" >
          <form enctype="multipart/form-data" method="post" data-parsley-namespace="data-parsley-" data-parsley-validate="" >
            <div class="progress-bar-parent mainDivchecks">
              <h4 class="section-title">
                <?=$data['checks_title']?>
              </h4>
              <div>
                <div>
                 
					
					<p class="text-muted ml-5" style="float:right;">
										<a class="ctooltips text-grey" href="#" title="" data-popup="tooltip" data-trigger="hover" data-container="body" data-placement="left" data-original-title="Allowed file types:(<?php echo FILE_TYPES_ALLOWED;?>)
										Max file size (<?php echo FILE_SIZE_ALLOWED;?>)"><i class="icon-info22"></i></a>
										
										</p>
					
					
					
					
					
					
					
					
					
					
					
                  <div id="dprogress1<?php echo $data['as_id'];?><?php echo $data['as_id'];?>" class="progress bulk-upload-prgs" style="width:70%">
                    <div class="progress-bar progress-bar-success"></div>
                  </div>
                  <span style="float:right;" class="btn btn-primary btn-file">
                  <span class="fileinput-new">Select file</span>
                  <input type="file" name="files[]" id="docs1<?php echo $data['as_id'];?><?php echo $data['as_id'];?>" multiple data-id="<?php echo $data['as_id'];?>" data-check="<?php echo $data['as_id'];?>" data-count="1" data-ccounter="_1" data-attchid="<?php echo $data['as_id'];?>" data-parsley-required="true" data-parsley-error-message="You must select a file !" class="docs_files parsley-validated parsley-error" />
                  </span> </div>
                <div style="clear:both"></div>
                <div id="docs_file1<?php echo $data['as_id'];?><?php echo $data['as_id'];?>" class="files checkAttached"></div>
                <input name="see_checks_<?=$data['checks_id']?>" value="1"  type="hidden" >
                <div class="clearFix"></div>
              </div>
              <div class="panel-footer text-right">
                <input type="hidden" name="addmore_attachments" value="1" >
                <input type="hidden" name="check_id" value="<?php echo $data['as_id'];?>" >
                <input type="hidden" name="case_id" value="<?php echo $data['v_id'];?>" >
                <button type="submit" class=" btnright div_icon has_text btn btn-success" name="submit_bulk" > <span> &nbsp;&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp; </span> </button>
                <input type="hidden"  id="attachment_counter" name="attachment_counter" value="0"  />
              </div>
            </div>
            <div class="clearFix"></div>
           
          </form>
        </div>
		</div>
		</div>
	<?php 
}	?>
	
	</div>
</div>
</section>
<script src="js/jquery.ui.widget.js"></script> 
<script src="js/jquery.iframe-transport.js"></script> 
<script src="js/jquery.fileupload.js"></script> 
<script src="js/jquery.fileupload-process.js"></script> 
<script src="js/jquery.fileupload-image.js"></script> 
<script src="js/jquery.fileupload-audio.js"></script> 
<script src="js/jquery.fileupload-video.js"></script> 
<script src="js/jquery.fileupload-validate.js"></script> 
        
<script src="scripts/vendor/fileinput.js"></script> 
<script src="scripts/vendor/parsley.min.js"></script> 
<script src="scripts/vendor/parsley.extend.min.js"></script> 

       
<script type="text/javascript">
 $(".docs_files").each(function(index, element) {
            set_docs($(this).data('id'),$(this).data('count'),$(this).data('check'),$(this).data('ccounter'),$(this).data('attchid'));
        });
function delAttached(delRecord){
	
	if(confirm('Are you sure want to remove this attachment?')){
		<?php if(isset($_GET['bitiframe'])){ ?>
		document.location='bt_edit_check.php?bitrixtid=<?php echo $_REQUEST['bitrixtid'];?>&bit_u_id=<?php echo $_REQUEST['bit_u_id'];?>&bitiframe=1&delatt=1&att_id='+delRecord;
		<?php }else{ ?>
		document.location='?action=<?php echo $_REQUEST['action'];?>&ascase=<?php echo $_REQUEST['ascase'];?>&_pid=<?php echo $_REQUEST['_pid'];?>&delatt=1&att_id='+delRecord;
		<?php } ?>
	}
	
}

function confirmSufficient(){
	//event.preventDefault();
	if(confirm('Are you sure isufficiency cleared successfuly?')){
			
		document.confirmsuff.submit();
		
		
	}
	return false;
	
}
</script>