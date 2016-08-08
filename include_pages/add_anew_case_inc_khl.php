<?php
	$add=true;$edit=false;

	if(is_numeric($_REQUEST['case'])){
		$vdta = getVerdata($_REQUEST['case']);
		if($vdta) $add=false;
	}
	
	if(is_numeric($_REQUEST['id'])){

		$vdta = getVerdata($_REQUEST['id']);	

		if($vdta){

			$edit=true;

			$_REQUEST['vname'] = $vdta['v_name'];
			
			$_REQUEST['sid'] = $vdta['v_id'];

			$_REQUEST['vid']   = $vdta['emp_id'];

			$_REQUEST['refid']   = $vdta['v_refid'];

			$_REQUEST['vfname'] = $vdta['v_ftname'];

			$_REQUEST['vnic'] = $vdta['v_nic'];

			$_REQUEST['comId'] = $vdta['com_id'];

			if($vdta['v_dob']!='0000-00-00'){

				$_REQUEST['day']  = date("d",strtotime($vdta['v_dob']));

				$_REQUEST['month']= date("m",strtotime($vdta['v_dob']));

				$_REQUEST['year']= date("Y",strtotime($vdta['v_dob']));

			}else {$_REQUEST['day']='';$_REQUEST['month']='';$_REQUEST['year']='';}

			

			if($vdta['v_recdate']!='0000-00-00'){

				$_REQUEST['rcday']  = date("d",strtotime($vdta['v_recdate']));

				$_REQUEST['rcmonth']= date("m",strtotime($vdta['v_recdate']));

				$_REQUEST['rcyear']= date("Y",strtotime($vdta['v_recdate']));

			}else {$_REQUEST['rcday']='';$_REQUEST['rcmonth']='';$_REQUEST['rcyear']='';}			

		}
	
	}
$disabled = 'disabled="disabled"';
?>
<script src="scripts/vendor/fileinput.js"></script>
<script type="text/javascript">
	function get_orderid(ths){
		var cid = ths.options[ths.selectedIndex].value;
		if(cid!=''){
			/*var icallBack = function(){
				$( ".content_accordion" ).accordion({
					collapsible: true,
					active:false,
					header: 'h3.bar',
					autoHeight:false,
					event: 'mousedown',
					icons:false,
					animated: true
				});

				$(".box").animate({
						opacity: 1
						}, function(){
							$(".block").animate({
							opacity: 1
						});
				});
			};*/
			
			var callBack = function (){
					ajaxServices("actions.php",'action=get_orderchecks&cid='+cid,'components');
			};
			
			ajaxServices("actions.php",'action=get_orderid&cid='+cid,'sorder',callBack);
		}
	}
	
 <?php if($_REQUEST['action']=='add' && $_REQUEST['atype']=='newcase' && $_REQUEST['case']!='' ){ //=add&atype=newcase	?>
	/*jslint unparam: true, regexp: true */
/*global window, $ */
$(function () {
$('.fileupload').each(function(id)
    {
// "<div class='uploadBox' id='fileDiv_" + file.name + "'><div class='leftEle'><a href='#' id='link_" + index + "' class='removeFile'>Remove</a></div><div class='midEle'>" + file.name + "</div></div>"
    var url = 'file_upload.php';			
    $(this).fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png|docx|doc|pdf)$/i,
        maxFileSize: 5000000, // 5 MB
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files_'+id);
        $.each(data.files, function (index, file) {
            var node = $('<p/>').append($('<span/>').text(''));
		
            node.appendTo(data.context);
			data.submit();
        });
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress_'+id+' .custom_cls_'+id).show().css(
            'width',
            progress + '%'
        );
		
		
		
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
			
            if (file.url) {
				 
				var param = 'fedit=1&addattachedfile=1&file_name='+file.name+'&case_id='+$('#case_id').val()+'&checks_id='+$('#checks_id_'+id).val();

				$.ajax({url: 'actions.php', data:param, method:'post', success: function(result){
					
				var last_id =  result;
				
				
				if (last_id) {
				
                var input = $('<input>')
                    .attr('type', 'hidden')
					 .attr('name', 'url')
                    .attr('value', file.url);
                $("#files_"+id).append(input);

                var input1 = $('<input>')
                    .attr('type', 'hidden')
                    .attr('name','thum')
					.attr('value', file.thumbnailUrl);
                $("#files_"+id).append(input1);

                var input2 = $('<input>')
                    .attr('type', 'hidden')
                    .attr('name','name')
					.attr('value', file.name);
                $("#files_"+id).append(input1);

          var span = $('<span>').html("<div class='uploadBox' id='fileDiv_" + last_id + "'><div class='leftEle'><a href='#' id='link_" + index + "' class='removeFile' onclick='removeAttachedFile(" + last_id + ",\"" + file.name + "\")' title='Remove'><i class='icon-remove'></i></a></div><div class='midEle'>" + file.name + "</div></div>");
                $("#files_"+id).append(span);
				
				
				}else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
				}});												
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
		setInterval(function(){
			
		$('#progress_'+id+' .custom_cls_'+id).fadeOut( "slow" ).css('width',0);

		}, 7000);
		
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    })
});

});

		
		
		
function removeAttachedFile(att_id,file_url){

if(confirm("Are you sure want to remove this image !")){
 var param = 'fedit=1&removeattachedfile=1&att_id='+att_id+'&file_url='+file_url;
 ajaxServices('actions.php',param,'');
 $("#fileDiv_"+att_id).remove();
}
 	
}
 <?php } ?>	
</script>
                                    
<form method="post" enctype="multipart/form-data" class="label_side" >

                <div class="detail-report-sec">
                    <div class="panel panel-default panel-block">
                    	<div class="page-section-title">
                    		<?php include('include_pages/pages_breadcrumb_inc.php'); ?>
                    	</div>
                        <div class="list-group">
						
						

	                        <div class="list-group-item">
                        		<div class="bulk-form-sec-left">
                                 
                                    <div class="user-profile-area-new-page">
                                	<div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput">
										
										
										
										<?php if($vdta['image']!=''){ ?>
										
                                                <img src="<?php echo $vdta['image'];?>" alt="photo" >
										<?php } else{?>
												<img src="images/user-pro.png" alt="photo" >
										<?php } ?>
                                          </div>
										  <?php if($add){ ?>
                                        <div id="progress" class="progress" style="display:none">
                                            <div class="progress-bar progress-bar-success"></div>
                                        </div>                                          
                                        <div class="thumbnail_btn">
                                          <div id="files" class="files"></div>
                                            <span class="btn btn-primary btn-file user-pro-btn">
                                            	<span class="fileinput-new">Select image</span>
                                                <input type="file" name="v_image" id="v_image"  class="user_images">
                                                </span>
                                          </div>
										  <?php } ?>
                                        </div>
                                	</div>
                                   
                                </div>
							               
                            <fieldset class="label_side">

                                <label>Employee Name <?php if($add){ ?><span class="text-danger">*</span><?php }?>:</label>

                                <div>

                              

                                <input id="basic-input" class="form-control" placeholder="Employee Name " title="Input Candidate Name"  type="text" name="vname"   <?=(!$add)?'value="'.$vdta['v_name'].'"'.$disabled:'value="'.$_REQUEST['vname'].'"'?> >

                              

                                </div>

                            </fieldset>
							
                            <fieldset class="label_side">

                                <label>Father's Name<?php if($add){ ?><span class="text-danger">*</span><?php }?>:</label>

                                <div>

                                   

                                    <input id="basic-input" class="form-control" placeholder="Father's Name" title="Input Candidate Father's Name" type="text" name="vfname" <?=(!$add)?'value="'.$vdta['v_ftname'].'"'.$disabled:'value="'.$_REQUEST['vfname'].'"'?> >

                                   

                                </div>

                            </fieldset>
                            
                            <fieldset class="label_side">

                                <label>N.I.C<?php if($add){ ?><span class="text-danger">*</span><?php }?>:</label>

                                <div>

                                

                                <input id="basic-input" class="form-control" placeholder="N.I.C" title="Input Candidate N.I.C" type="text" name="vnic"  <?=(!$add)?'value="'.$vdta['v_nic'].'"'.$disabled:'value="'.$_REQUEST['vnic'].'"'?> >

                                

                                </div>

                            </fieldset>
                            
                            
							 <fieldset class="label_side">

                                <label>Date of Birth:</label>

                                <div>

                                

                                <input   class="form-control datetimepicker-month1" placeholder="Date of Birth" title="Input Candidate Date of Birth" type="text" name="v_dob" <?=(!$add)?'value="'.$vdta['v_dob'].'"'.$disabled:'value="'.$_REQUEST['v_dob'].'"'?> >
							 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
											  
                                              <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
                                                <script type="text/javascript">
												$(function () {
												$( ".datetimepicker-month1").datepicker({
												dateFormat: 'yy-mm-dd',
												changeMonth: true,
												changeYear: true,
												yearRange: "1980:2015"
												});
												});
												</script>
                                

                                </div>

                            </fieldset>
					         <?php if($add){ ?>
                                <?php }else{ ?>
                                    <fieldset class="label_side">
                                        <label>Tracking#:</label>
                                        <div>
										 <input class="form-control" placeholder="Tracking#"  type="text"   value="<?=bcplcode($vdta['v_id'])?>" <?=(!$add)?$disabled:''?> >
                                             
                                        </div>
                                    </fieldset>                                      
								<?php }?>

							
                          

                            

                           
							
                            

						 <?php if(!$add){ ?>  

                            <fieldset class="label_side">

                                <label>RISK LEVEL:</label>
								 
										<div>
										 <input class="form-control"   type="text"   value="<?=$vdta['v_rlevel'].' [ '.$vdta['v_status'].' ]'; ?>" <?=(!$add)?$disabled:''?> >
                                             
                                        </div>
                                <div></div>

                            </fieldset>

                        <?php }?>                                    

                    

                       

						<?php if($add){ ?>

                        <div class="button_bar clearfix">

                            <?php if($edit){?>

                            <input type="hidden" name="id" value="<?=$_REQUEST['id']?>" >

                            <input type="hidden" name="edit" value="" >
							
							

                            <?php } ?>
						<footer class="panel-footer text-right">
														 
														 <input type="hidden" name="addcasebyclient" value="yes" >
													<button type="submit" class=" btnright div_icon has_text btn btn-success" name="" >

														<span><?=($edit)?'Save':'Add'?> Case </span>

													</button> 
						</footer>
                        </div>

                        <?php } ?>



					 <?php if(isset($_REQUEST['case'])){ 
					 
						$user_id = $_SESSION['user_id'];
						$user_info = getUserInfo($user_id);
						$user_com_id = $user_info['com_id'];
						echo get_client_orderchecks($user_com_id);
						?>
					<input type="hidden" id="case_id"  value="<?=$_REQUEST['case']?>" />
					
					<footer class="panel-footer text-right">
														 
														 
													<button onclick="document.location='?action=add&atype=newcase'" type="button" class=" btnright div_icon has_text btn btn-success" name="">

														<span> Finish &amp; Add New</span>

													</button> 
						</footer>
					
						<?php
					 }
					?>
					
							
                             
	                        </div>
                        </div>
                    </div>
                </div>



</form>





