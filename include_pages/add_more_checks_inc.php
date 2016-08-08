<?php
	$add=true;
	$edit=false;

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
			
			$_REQUEST['vfname'] = $vdta['v_ftname'];

			$_REQUEST['vnic'] = $vdta['v_nic'];
			
			$_REQUEST['v_dob'] = $vdta['v_dob'];
			

		}
	
	}
	//var_dump($vdta);
$disabled = 'disabled="disabled"';
?>


<link rel="stylesheet" href="css/jquery.fileupload.css">
<section class="retracted scrollable">
            <script>
                if (!($('body').is('.dashboard-page') || $('body').is('.login-page'))){
                    if ($.cookie('protonSidebar') == 'retracted') {
                        $('.wrapper').removeClass('retracted').addClass('extended');
                    }
                    if ($.cookie('protonSidebar') == 'extended') {
                        $('.wrapper').removeClass('extended').addClass('retracted');
                    }
                }
            </script>            
            <div class="row">
                <div class="col-md-12">
                  	<div class="report-sec-bulk">
                    <div class="page-section-title">
                    	<?php include('include_pages/pages_breadcrumb_inc.php'); ?>
                    </div>
             
<div class="bulk-dev">
<form enctype="multipart/form-data" method="post" data-parsley-namespace="data-parsley-" data-parsley-validate="">
   <?php
	
		$uID = $_SESSION['user_id'];
		
			
			
									?>
							<div class="case_data">
                            	<div class="bulk-form-sec-left">
                                 
                                    <div class="user-profile-area">
                                    <input type="hidden" name="case_id" value="<?php echo  $_REQUEST['case'];?>"   data-name="order" />
									<input type="hidden" name="addmore" value="1"   />
                                	<div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                               <?php if($vdta['image']!=''){ ?>
										
                                                <img src="<?php echo  $vdta['image'];?>" alt="photo" >
										<?php } else{?>
												<img src="images/user-pro.png" alt="photo" >
										<?php } ?>
                                          </div>
                                                                            
                                       
                                        </div>
                                	</div>
                                   
                                </div>
                                <div class="bulk-form-sec-right">
                                	<div class="sub-bulk-right-sec MoreTbl">
									
									<table cellspacing="5" cellpadding="5" width="100%" border="0">
									<tr><td class="txt_strong">Emaployee Name:</td><td><?php echo  $vdta['v_name'];?></td></tr>
									<tr><td class="txt_strong">Father's Name:</td><td><?php echo  $vdta['v_ftname'];?></td></tr>
									<tr><td class="txt_strong">CNIC:</td><td><?php echo  $vdta['v_nic'];?></td></tr>
									<tr><td class="txt_strong">Date of Birth:</td><td><?php echo  $vdta['v_dob'];?></td></tr>
									</table>
									
                                        
											
											
                                       
                                        
                                        <div class="clearFix"></div>
                                    </div>
                                </div>
                             	<div class="clearFix"></div>
                                <?php 
								$where = "cc.com_id=$COMINF[id] AND ck.is_active=1";
								$tabls = "checks ck INNER JOIN clients_checks cc ON ck.checks_id=cc.checks_id";
								$checks = $db->select($tabls,"*",$where);
								if(mysql_num_rows($checks)>0){
									$num_check = 100;
                    				while($check = mysql_fetch_assoc($checks)){?>
                                        <div class="progress-bar-parent">
                                            <h4 class="section-title"><?=$check['checks_title']?> 
                                            <?php if($check['is_multi']==1){?>
                                            <a href="javascript:void(0);"><i class="icon-plus"></i></a> 
                                            <?php }?>
                                            
                                            	<input style="float:right;" type="checkbox" name="ischeck1[]" data-parsley-required="true" data-parsley-error-message="You must select at least one check" class="parsley-validated parsley-error" value="<?=$check['checks_id']?>"   />
                                            </h4>
                                        <div>
                                        <div>
                                        <div id="dprogress1<?=$num_check?>" class="progress bulk-upload-prgs" style="width:70%">
                                        <div class="progress-bar progress-bar-success"></div>
                                        </div>
                                        <span style="float:right;" class="btn btn-primary btn-file"><span class="fileinput-new">Select file</span>
                                        <input type="hidden" value="<?=$check['checks_id']?>" name="checks1[]"  />
                                        <input type="file" name="files[]" id="docs1<?=$num_check?><?=$check['checks_id']?>" multiple="multiple" class="docs_files" data-id="<?=$num_check?>" data-check="<?=$check['checks_id']?>" data-count="1" /></span>
                                        </div>
                                        <div style="clear:both"></div>
                                        <div id="docs_file1<?=$num_check?>" class="files"></div>
                                        	
                                         <div class="clearFix"></div>
                                        </div>
                                       
                                        </div>
                             			<div class="clearFix"></div>
                             		<?php   
									$num_check++;
									}
								}?>
                             </div>  
                             <div class="clearFix"></div>        
                <?php 
				
			?>
          <button type="submit" class="btn btn-success float-left" name="submit_bulk">Submit</button>
			<?php
						
			
		
	
   ?>  	
                             </form>

<!--                            <div class="add-row-bulk">
                         		<a href="javascript:;"><i class="icon-plus"></i></a>
                         	</div>
                            <div></div>-->
                            <div class="clearFix"></div>
                        </div>
                    	<div class="clearFix"></div>
                    
                    </div>
                </div>
            </div>
        
        </section>
<script src="js/load-image.all.min.js"></script>
<script src="js/jquery.ui.widget.js"></script>
<script src="js/canvas-to-blob.min.js"></script>
<script src="js/jquery.iframe-transport.js"></script>
<script src="js/jquery.fileupload.js"></script>
<script src="js/jquery.fileupload-process.js"></script>
<script src="js/jquery.fileupload-image.js"></script>
<script src="js/jquery.fileupload-audio.js"></script>
<script src="js/jquery.fileupload-video.js"></script>
<script src="js/jquery.fileupload-validate.js"></script>
<script>

         function set_image(id){
			$(function () {
		
			var url = 'file_upload.php';
						
			$('#v_image'+id).fileupload({
				url: url,
				dataType: 'json',
				autoUpload: true,
				acceptFileTypes: /(\.|\/)(gif|jpg|jpeg|png)$/i,
				maxFileSize: 5000000, // 5 MB
				// Enable image resizing, except for Android and Opera,
				// which actually support image resizing, but fail to
				// send Blob objects via XHR requests:
				disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
				previewMaxWidth: 100,
				previewMaxHeight: 100,
				previewCrop: true
			}).on('fileuploadadd', function (e, data) {
				data.context = $('<div/>').appendTo('#files'+id);
				$.each(data.files, function (index, file) {
					//var node = $('<p/>').append($('<span/>').text(file.name));
					//node.appendTo(data.context);
					data.submit();
				});
			}).on('fileuploadprogressall', function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$('#progress'+id).css('display','block');
				$('#progress'+id+' .progress-bar').css('width',progress+'%');
			}).on('fileuploaddone', function (e, data) {
				$.each(data.result.files, function (index, file) {
					if (file.url) {
						var input = $('<input>')
							.attr('type', 'hidden')
							 .attr('name', 'image'+id)
							.attr('value', file.url);
						$("#files"+id).append(input);
		
						var input1 = $('<input>')
							.attr('type', 'hidden')
							.attr('name','thum'+id)
							.attr('value', file.thumbnailUrl);
						$("#files"+id).append(input1);
		
						var input2 = $('<input>')
							.attr('type', 'hidden')
							.attr('name','file'+id)
							.attr('value', file.name);
						$("#files"+id).append(input1);
		
						/*var span = $('<span class="doxc-style">').html(file.name);
						$("#files"+id).append(span);*/
						
						var span = $('<span class="doxc-style">').html(file.name);
						$('#progress'+id).find('.prg-profile').append(span);
																		
					} else if (file.error) {
						var error = $('<span class="text-danger"/>').text(file.error);
						$("#files"+id).append(error);
					}
				});
			}).on('fileuploadfail', function (e, data) {
				$.each(data.files, function (index) {
					var error = $('<span class="text-danger"/>').text('File upload failed.');
					$("#files"+id).append(error);
				});
			})
		});			
		}

		function set_docs(id,count,check){
			$(function () {
		
			var url = 'file_upload.php';
						
			$('#docs'+count+id+check).fileupload({
				url: url,
				dataType: 'json',
				autoUpload: true,
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
				//data.context = $('<div/>').appendTo('#files'+id);
				$.each(data.files, function (index, file) {
					//var node = $('<p/>').append($('<span/>').text(file.name));
					//node.appendTo(data.context);
					data.submit();
				});
			}).on('fileuploadprogressall', function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				
				$('#dprogress'+count+id).css('display','block');
				$('#dprogress'+count+id+' .progress-bar').css('width',progress+'%');
			}).on('fileuploaddone', function (e, data) {
				$.each(data.result.files, function (index, file) {
					if (file.url) {
						var new_div = $('<div class="attachments">');
					
						$("#docs_file"+count+id).append(new_div);
						
						var newp = $('#dprogress'+count+id).clone();
						$(newp).removeAttr('id');
						
						$(new_div).append(newp);
						var input = $('<input>')
							.attr('type', 'hidden')
							 .attr('name', 'docxs'+count+id+check+'[]')
							.attr('value', file.url);
						$(newp).append(input);
		
		
						var input2 = $('<input>')
							.attr('type', 'hidden')
							.attr('name','docxs_name'+count+id+check+'[]')
							.attr('value', file.name);
						$(newp).append(input2);
		
						var span = $('<span class="doxc-style">').html(file.name);
						$(newp).find('.progress-bar').append(span);

						var an = $('<a href="#" class="close fileinput-exists" data-dismiss="fileinput">').html('&times;');
						$(an).click(function(){
								$(this).parent().parent().parent().remove();	
						});
						$(newp).find('.progress-bar').append(an);
						
						$(new_div).append('<div style="clear:both"></div>');
													
					} else if (file.error) {
						var error = $('<span class="text-danger"/>').text(file.error);
						$("#docs_file"+id).append(error);
					}
				});
			}).on('fileuploadfail', function (e, data) {
				$.each(data.files, function (index) {
					var error = $('<span class="text-danger"/>').text('File upload failed.');
					$("#docs_file"+id).append(error);
				});
			})
		});			
		}
				
		$(".user_images").each(function(index, element) {
            set_image($(this).data('id'));
        });

		$(".docs_files").each(function(index, element) {
            set_docs($(this).data('id'),$(this).data('count'),$(this).data('check'));
        });
		function validateChecks(){
			$.validator.addMethod("roles", function(value, elem, param) {
    if($(".roles:checkbox:checked").length > 0){
       return true;
   }else {
       return false;
   }
},"You must select at least one!");
		}
</script>
<script src="scripts/vendor/bootstrap-datetimepicker.js"></script>

<script src="scripts/vendor/fileinput.js"></script>
<script src="scripts/vendor/parsley.min.js"></script>
<script src="scripts/vendor/parsley.extend.min.js"></script>
            
            

   
     