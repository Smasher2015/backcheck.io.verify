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
<form enctype="multipart/form-data" method="post">
   <?php
	if(isset($_FILES['bulk_file'])){
		$uID = $_SESSION['user_id'];
		
	
		if ($_FILES["bulk_file"]["error"] <= 0){

			$len = strlen($_FILES["bulk_file"]["name"]);
			$ext = strtolower(substr($_FILES["bulk_file"]["name"],($len-3)));
			if($ext=='csv'){
		
			$fp = fopen($_FILES["bulk_file"]["tmp_name"],'r');
			
			$lCount = 0;
			while($csv_line = fgetcsv($fp,1024)) {
				$values='';
				$lCount = $lCount+1;
				if($lCount==1) continue;
				for ($i = 0, $j = 3; $i <= $j; $i++) {
					$csv_line[$i] = addslashes($csv_line[$i]);
				} ?>
							<div class="case_data">
                            	<div class="bulk-form-sec-left">
                                 
                                    <div class="user-profile-area">
                                	<div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                                <img src="images/user-pro.png" alt="photo" >
                                          </div>
                                        <div id="progress<?=($lCount-1)?>" class="progress" style="display:none">
                                            <div class="progress-bar progress-bar-success"></div>
                                        </div>                                          
                                        <div class="thumbnail_btn">
                                          <div id="files<?=($lCount-1)?>" class="files"></div>
                                            <span class="btn btn-primary btn-file user-pro-btn">
                                            	<span class="fileinput-new">Select image</span>
                                                <input type="file" name="files[]" id="v_image<?=($lCount-1)?>" data-id="<?=($lCount-1)?>" class="user_images">
                                                </span>
                                          </div>
                                        </div>
                                	</div>
                                   
                                </div>
                                <div class="bulk-form-sec-right">
                                	<div class="sub-bulk-right-sec">
                                        <fieldset>
                                            <div class="form-group mrg-bottom">
                                                <input name="ename<?=($lCount-1)?>" class="form-control custom-input float-left" placeholder="Employee Name" value="<?=$csv_line[0]?>">
                                            </div>
                                            <div class="form-group mrg-bottom">
                                                <input name="fname<?=($lCount-1)?>" class="form-control custom-input float-left" placeholder="Father Name" value="<?=$csv_line[1]?>">
                                            </div>
                                            <div class="clearFix"></div>
                                        </fieldset>
                                        <fieldset>
                                            <div class="form-group mrg-bottom">
                                                <input name="cnic<?=($lCount-1)?>" class="form-control custom-input float-left" placeholder="CNIC Numbers" value="<?=$csv_line[2]?>">
                                            </div>
                                            <div class="form-group mrg-bottom">
                                                <input  name="dob<?=($lCount-1)?>" type="date"  class="form-control custom-input float-left" placeholder="Date of Birth" value="<?=$csv_line[3]?>">
                                            </div>
                                            <div class="clearFix"></div>
                                        </fieldset>
                                        <fieldset>
                                            <div class="form-group float-left free-margin">
                                            <div>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                  
                                                  <span class="fileinput-filename"></span>
                                                  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                </div>
                                            </div>
                                            
                                            </div>
                                            <div class="clearFix"></div>
                                        </fieldset>
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
                                            </h4>
                                        <div>
                                        <div>
                                        <div id="dprogress<?=($lCount-1)?><?=$num_check?>" class="progress bulk-upload-prgs" style="width:70%">
                                        <div class="progress-bar progress-bar-success"></div>
                                        </div>
                                        <span style="float:right;" class="btn btn-primary btn-file"><span class="fileinput-new">Select file</span>
                                        <input type="hidden" value="<?=$check['checks_id']?>" name="checks<?=($lCount-1)?>[]"  />
                                        <input type="file" name="files[]" id="docs<?=($lCount-1)?><?=$num_check?>" multiple="multiple" class="docs_files" data-id="<?=$num_check?>" data-check="<?=$check['checks_id']?>" data-count="<?=($lCount-1)?>" /></span>
                                        </div>
                                        <div style="clear:both"></div>
                                        <div id="docs_file<?=($lCount-1)?><?=$num_check?>" class="files"></div>
                                        	
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
                <?php } ?>
            
				<button type="submit" class="btn btn-success float-left" name="submit_bulk">Submit</button>
			<?php
			fclose($fp);			
			}else{ 
				msg('err',"Invalid file type please upload correct file!");
				?>
                <div class="list-group-item">

                                <div class="form-group">
                                    <label>Please Upload CSV File</label>
                                    <div>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                          <div class="input-group">
                                            <div class="form-control uneditable-input span3" data-trigger="fileinput"><i class="icon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                            <span class="input-group-addon btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="bulk_file"></span>
                                            <a href="#" class="input-group-addon btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                

                                							<!--<input type="file" name="bulk_file" />-->
							<input type="submit" class="btn btn-success" name="upload_bulk" value="Submit"  />		

                            </div>
                <?php
			}
		}else{
			msg('err',"Please select a csv file to upload!");
			?>
            <div class="list-group-item">

                                <div class="form-group">
                                    <label>Please Upload CSV File</label>
                                    <div>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                          <div class="input-group">
                                            <div class="form-control uneditable-input span3" data-trigger="fileinput"><i class="icon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                            <span class="input-group-addon btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="bulk_file"></span>
                                            <a href="#" class="input-group-addon btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                

                                							<!--<input type="file" name="bulk_file" />-->
							<input type="submit" class="btn btn-success" name="upload_bulk" value="Submit"  />		

                            </div>
            <?php
		}
	}else{ ?>      
    			      <div class="list-group-item">

                                <div class="form-group">
                                    <label>Please Upload CSV File</label>
                                    <div>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                          <div class="input-group">
                                            <div class="form-control uneditable-input span3" data-trigger="fileinput"><i class="icon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                            <span class="input-group-addon btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="bulk_file"></span>
                                            <a href="#" class="input-group-addon btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                                

                                							<!--<input type="file" name="bulk_file" />-->
							<input type="submit" class="btn btn-success" name="upload_bulk" value="Submit"  />		

                            </div>
		<?php
	}
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
				acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
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
		
						var span = $('<span class="doxc-style">').html(file.name);
						$("#files"+id).append(span);
																		
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

		function set_docs(id,count){
			$(function () {
		
			var url = 'file_upload.php';
						
			$('#docs'+count+id).fileupload({
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
							 .attr('name', 'docxs'+count+id+'[]')
							.attr('value', file.url);
						$(newp).append(input);
		
		
						var input2 = $('<input>')
							.attr('type', 'hidden')
							.attr('name','docxs_name'+count+id+'[]')
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
            set_docs($(this).data('id'),$(this).data('count'));
        });
</script>
<script src="scripts/vendor/bootstrap-datetimepicker.js"></script>

<script src="scripts/vendor/fileinput.js"></script>
            
            

   
     