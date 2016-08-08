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
                                            
                                            <div id="progress<?=($lCount-1)?>" class="progress" >
                                                <div class="progress-bar progress-bar-success"></div>
                                            </div>
    
    										<div id="files<?=($lCount-1)?>" class="files"></div>
                                            <span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                            <input type="file" name="v_image<?=($lCount-1)?>" id="v_image<?=($lCount-1)?>"  /></span>
											
											 
                                            
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="js/jquery.fileupload.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script>
                                            
		$(function () {
			'use strict';
			var url = 'file_upload.php';
			
			
			    $('#v_image1').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo('#files1');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress1 .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
		
	
		});
</script>
<script src="scripts/vendor/bootstrap-datetimepicker.js"></script>

<script src="scripts/vendor/fileinput.js"></script>
            
            

   
     