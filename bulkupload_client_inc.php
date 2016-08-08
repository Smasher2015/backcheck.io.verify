<link rel="stylesheet" href="css/jquery.fileupload.css">

<script src="js/load-image.all.min.js"></script>
<script src="js/canvas-to-blob.min.js"></script>
<script src="js/jquery.iframe-transport.js"></script>
<script src="js/jquery.fileupload.js"></script>
<script src="js/jquery.fileupload-process.js"></script>
<script src="js/jquery.fileupload-image.js"></script>
<script src="js/jquery.fileupload-audio.js"></script>
<script src="js/jquery.fileupload-video.js"></script>
<script src="js/jquery.fileupload-validate.js"></script>

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
                    <h4 class="section-title">Bulk Upload</h4>
                    	
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
                                          <div class="thumbnail_btn">
                                            <span class="btn btn-primary btn-file user-pro-btn">
                                            
                                            <div id="progress<?=($lCount-1)?>" class="progress" style="display:none">
                                                <div class="progress-bar progress-bar-success"></div>
                                            </div>
    
    										<div id="files<?=($lCount-1)?>" class="files"></div>
                                            <span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                            <input type="file" name="v_image<?=($lCount-1)?>" id="v_image<?=($lCount-1)?>"  /></span>
											
											<script>
                                            
                                            $(function () {
                                            
                                                var url = 'file_upload.php';			
                                                $('#v_image<?=($lCount-1)?>').fileupload({
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
                                                    data.context = $('<div/>').appendTo('#files<?=($lCount-1)?>');
                                                    $.each(data.files, function (index, file) {
                                                        //var node = $('<p/>').append($('<span/>').text(file.name));
                                                        //node.appendTo(data.context);
                                                        //data.submit();
                                                    });
                                                }).on('fileuploadprogressall', function (e, data) {
                                                    var progress = parseInt(data.loaded / data.total * 100, 10);
													$('#progress<?=($lCount-1)?>').css('display','block');
                                                    $('#progress<?=($lCount-1)?> .progress-bar').css( 'width', progress + '%' );
                                                }).on('fileuploaddone', function (e, data) {
                                                    $.each(data.result.files, function (index, file) {
                                                        if (file.url) {
                                                            var input = $('<input>')
                                                                .attr('type', 'hidden')
                                                                 .attr('name', 'url')
                                                                .attr('value', file.url);
                                                            $("#files<?=($lCount-1)?>").append(input);
                                            
                                                            var input1 = $('<input>')
                                                                .attr('type', 'hidden')
                                                                .attr('name','thum')
                                                                .attr('value', file.thumbnailUrl);
                                                            $("#files<?=($lCount-1)?>").append(input1);
                                            
                                                            var input2 = $('<input>')
                                                                .attr('type', 'hidden')
                                                                .attr('name','name')
                                                                .attr('value', file.name);
                                                            $("#files<?=($lCount-1)?>").append(input1);
                                            
                                                            var span = $('<span>').html(file.name);
                                                            $("#files<?=($lCount-1)?>").append(span);
                                                                                                            
                                                        } else if (file.error) {
                                                            var error = $('<span class="text-danger"/>').text(file.error);
                                                            $(data.context.children()[index])
                                                                .append('<br>')
                                                                .append(error);
                                                        }
                                                    });
                                                }).on('fileuploadfail', function (e, data) {
                                                    $.each(data.files, function (index) {
                                                        var error = $('<span class="text-danger"/>').text('File upload failed.');
                                                        $(data.context.children()[index])
                                                            .append('<br>')
                                                            .append(error);
                                                    });
                                                })
                                            });
                                            </script> 
                                            
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
                    				while($check = mysql_fetch_assoc($checks)){?>
                             			<div class="progress-bar-parent">
                                        <h4 class="section-title"><?=$check['checks_title']?> 
                                            <?php if($check['is_multi']==1){?>
                                            	<a href="javascript:void(0);"><i class="icon-plus"></i></a> 
                                            <?php }?>
                                            <span style="float:right;" class="btn btn-primary btn-file"><span class="fileinput-new">Select file</span>
                                            <input type="file" name="file[]" id="docs_files<?=($lCount-1).$check['checks_id']?>"></span>
                                            
                                            <script>
                                            
                                            $(function () {
                                            
                                                var url = 'file_upload.php';			
                                                $('#docs_files<?=($lCount-1).$check['checks_id']?>').fileupload({
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
                                                    data.context = $('<div/>').appendTo('#docs<?=($lCount-1).$check['checks_id']?>');
                                                    $.each(data.files, function (index, file) {
                                                        var node = $('<p/>').append($('<span/>').text(file.name));
                                                    
                                                        node.appendTo(data.context);
                                                        //data.submit();
                                                    });
                                                }).on('fileuploadprogressall', function (e, data) {
                                                    var progress = parseInt(data.loaded / data.total * 100, 10);
													$('#docprogress<?=($lCount-1).$check['checks_id']?>').css('display','block');
                                                    $('#docprogress<?=($lCount-1).$check['checks_id']?> .progress-bar').css('width',progress+'%');
                                                }).on('fileuploaddone', function (e, data) {
                                                    $.each(data.result.files, function (index, file) {
                                                        if (file.url) {
                                                            var input = $('<input>')
                                                                .attr('type', 'hidden')
                                                                 .attr('name', 'url')
                                                                .attr('value', file.url);
                                                            $("#docs<?=($lCount-1).$check['checks_id']?>").append(input);
                                            
                                                            var input1 = $('<input>')
                                                                .attr('type', 'hidden')
                                                                .attr('name','thum')
                                                                .attr('value', file.thumbnailUrl);
                                                            $("#docs<?=($lCount-1).$check['checks_id']?>").append(input1);
                                            
                                                            var input2 = $('<input>')
                                                                .attr('type', 'hidden')
                                                                .attr('name','name')
                                                                .attr('value', file.name);
                                                            $("#docs<?=($lCount-1).$check['checks_id']?>").append(input1);
                                            
                                                            var span = $('<span class="doxc-style">').html(file.name);
                                                            $("#docs<?=($lCount-1).$check['checks_id']?>").append(span);
                                                                                                            
                                                        } else if (file.error) {
                                                            var error = $('<span class="text-danger"/>').text(file.error);
                                                            $(data.context.children()[index])
                                                                .append('<br>')
                                                                .append(error);
                                                        }
                                                    });
                                                }).on('fileuploadfail', function (e, data) {
                                                    $.each(data.files, function (index) {
                                                        var error = $('<span class="text-danger"/>').text('File upload failed.');
                                                        $(data.context.children()[index])
                                                            .append('<br>')
                                                            .append(error);
                                                    });
                                                })
                                            });
                                            </script>
                                            
                                        </h4>
                             	    	<div>
                             			  <div id="docprogress<?=($lCount-1).$check['checks_id']?>" class="progress" style="display:none">
                                                <div class="progress-bar progress-bar-success"></div>
                                            </div>
    
    										<div id="docs<?=($lCount-1).$check['checks_id']?>" class="files"></div>
                             			
                             			</div>
                                <div class="clearFix"></div>
                             </div>
                             			<div class="clearFix"></div>
                             		<?php   
									}
								}?>
                             </div>  
                             <div class="clearFix"></div>          
                <?php
			} ?>
            
				<button type="submit" class="btn btn-success float-left" name="submit_bulk">Submit</button>
			<?php
			fclose($fp);			
			}else{ 
				msg('err',"Invalid file type please upload correct file!");
			}
		}else{
			msg('err',"Please select a csv file to upload!");
		}
	}else{ ?>            
				<input type="file" name="bulk_file" />
				<input type="submit" name="upload_bulk" value="Submit"  />		
		<?php
	}
   ?>  	
                             </form>

<!--                            <div class="add-row-bulk">
                         		<a href="javascript:;"><i class="icon-plus"></i></a>
                         	</div>
                            <div></div>-->
                        </div>
                    	<div class="clearFix"></div>
                    
                    </div>
                </div>
            </div>
        
        </section>
        
            <script src="scripts/vendor/bootstrap-datetimepicker.js"></script>

            <script src="scripts/vendor/fileinput.js"></script>
            
            

   
     