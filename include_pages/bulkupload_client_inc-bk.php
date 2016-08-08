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
				}
				print_r($csv_line);
				echo "<br/>";
			}
			fclose($fp);			
			}else{ 
				msg('err',"Invalid file type please upload correct file!");
			}
		}else{
			msg('err',"Please select a csv file to upload!");
		}
	}


   ?>        
   		<form enctype="multipart/form-data" method="post">
        	<input type="file" name="bulk_file" />
        	<input type="submit" name="upload_bulk" value="Submit"  />
        </form>
            <div class="row">
                <div class="col-md-12">
                  	<div class="report-sec-bulk">
                    <h4 class="section-title">Bulk Upload</h4>
                    <!-- Bulk Upload Section Start -->
                    	<div class="bulk-dev">

                        	<form>
                            	<div class="bulk-form-sec-left">
                                    <div class="user-profile-area">
                                	<div class="fileinput fileinput-new" data-provides="fileinput">
                                          <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                                <img src="images/user-pro.png" alt="photo" >
                                          </div>
                                          <div class="thumbnail_btn">
                                            <span class="btn btn-primary btn-file user-pro-btn"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="v_file" id="v_file"></span>
                                            
                                          </div>
                                        </div>
                                        
                                        
                                       
                                </div>
                                </div>
                                <div class="bulk-form-sec-right">
                                	<div class="sub-bulk-right-sec">
                                        <fieldset>
                                            <div class="form-group mrg-bottom">
                                                <input  class="form-control custom-input float-left" placeholder="Employee Name">
                                            </div>
                                            <div class="form-group mrg-bottom">
                                                <input class="form-control custom-input float-left" placeholder="Father Name">
                                            </div>
                                            <div class="clearFix"></div>
                                        </fieldset>
                                        <fieldset>
                                            <div class="form-group mrg-bottom">
                                                <input  class="form-control custom-input float-left" placeholder="CNIC Numbers">
                                            </div>
                                            <div class="form-group mrg-bottom">
                                                <input type="date"  class="form-control custom-input float-left" placeholder="CNIC Numbers">
                                            </div>
                                            <div class="clearFix"></div>
                                        </fieldset>
                                        <fieldset>
                                            <div class="form-group float-left free-margin">
                                            <div>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                  <span class="btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="..."></span>
                                                  <span class="fileinput-filename"></span>
                                                  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                                </div>
                                            </div>
                                            
                                            </div>
                                            <button type="submit" class="btn btn-success float-left">Upload</button>
                                            <div class="clearFix"></div>
                                        </fieldset>
                                        <div class="clearFix"></div>
                                    </div>
                                </div>
                                  
                             </form>
                             <div class="clearFix"></div>
                             <div class="progress-bar-parent">
                             	<h4 class="section-title">Education <a href="javascript:;"><i class="icon-plus"></i></a></h4>
                             	<div class="form-group float-left">
                                        <div>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                              <span class="btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="..."></span>
                                              <span class="fileinput-filename"></span>
                                              <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                            </div>
                                        </div>
                                        
                                    </div>
                             	<div class="bulk-progress-bar">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%" data-original-title="" title="">
                                        <span class="sr-only">40% Complete (success)</span>
                                    </div>
                                </div>
                             </div>
                             	<div class="doxc-style">
                                    <span>employee_educational_info.doc</span>
                                    <a href="javascript:;"><i class="icon-remove"></i></a>
                                </div>
                             		
                                <div class="clearFix"></div>
                             </div>
                             <div class="progress-bar-parent">
                             	<h4 class="section-title">Local Area Police Records Check  <a href="javascript:;"><i class="icon-plus"></i></a></h4>
                             	<div class="form-group float-left">
                                        <div>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                              <span class="btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="..."></span>
                                              <span class="fileinput-filename"></span>
                                              <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                            </div>
                                        </div>
                                        
                                    </div>
                             	<div class="bulk-progress-bar">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%" data-original-title="" title="">
                                        <span class="sr-only">40% Complete (success)</span>
                                    </div>
                                </div>
                             </div>
                             	<div class="doxc-style">
                                    <span>employee_educational_info.doc</span>
                                    <a href="javascript:;"><i class="icon-remove"></i></a>
                                </div>
                             		
                                <div class="clearFix"></div>
                             </div>
                            <div class="add-row-bulk">
                         		<a href="javascript:;"><i class="icon-plus"></i></a>
                         	</div>
                            <div></div>
                        </div>
                    	<div class="clearFix"></div>
                    <!-- Bulk Upload Section End -->
                    <!-- Bulk Upload Section Extra Duplicate Start  -->
                     	<!-- <div class="bulk-dev">
                        	<span class="add-row-bulk">
                         	<a href="javascript:;"><i class="icon-plus"></i></a>
                         	</span>
                        	<form>
     
                                <div class="form-group">
                                    <input  class="form-control custom-input" placeholder="Employee Name">
                                </div>
                                <div class="form-group">
                                    <input class="form-control custom-input" placeholder="CNIC Number">
                                </div>
                                <div class="form-group">
                                    <div>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                          <span class="btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="..."></span>
                                          <span class="fileinput-filename"></span>
                                          <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                        </div>
                                    </div>
                                    
                                </div>
                               <button type="submit" class="btn btn-success add-row-submit">Upload</button>
                                  
                                  
                             </form>
                             <div class="clearFix"></div>
                             <div class="progress-bar-parent">
                             	<div class="bulk-progress-bar">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%" data-original-title="" title="">
                                        <span class="sr-only">40% Complete (success)</span>
                                    </div>
                                </div>
                             </div>
                             	<div class="form-group">
                                    <input class="form-control custom-input" placeholder="File Name">
                                </div>
                                <div class="clearFix"></div>
                             </div>
                             <span class="close-row-bulk">
                             	<a href="javascript:;"><i class="icon-remove"></i></a>
                             </span>
                        </div>
                    	<div class="clearFix"></div>-->
					<!-- Bulk Upload Section Extra Duplicate End  -->
                    
                    </div>
                </div>
            </div>
        
        </section>
        
            <script src="scripts/vendor/bootstrap-datetimepicker.js"></script>

            <script src="scripts/vendor/fileinput.js"></script>
            
            
            
        
     