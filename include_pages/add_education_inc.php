<style type="text/css">
.modal .modal-dialog {
	width: 80%;
}
.modalwrapper {
	width: 90%;
	overflow: hidden;
	overflow-y: scroll;
	border: 1px solid #ccc;
	height: 500px;
	padding:10px;
}
input[type="text"]: disabled{
	background:#CCC;
	
	}
</style>
<section class="retracted scrollable">
  <div class="row">
    <div class="col-md-12">
      <div class="report-sec">
        <div class="panel panel-default panel-block">
          <div class="page-section-title">
            <?php include('include_pages/pages_breadcrumb_inc.php'); ?>
          </div>
          <div class="list-group">
            <div class="list-group-item">
              <div>
                <ul class="nav nav-tabs panel panel-default">
                  <li><a href="#verification" data-toggle="tab"><span>1</span>Verification</a></li>
                  <li><a href="#payment" data-toggle="tab"><span>2</span>Payment</a></li>
                  <li><a href="#confirmation" data-toggle="tab"><span>3</span>Confirmation</a></li>
                </ul>
                <div class="tab-content panel panel-default panel-block">
                  <div class="tab-pane  active" id="verification">
                    <div class="list-group-item" id="input-fields">
                      <form >
                        <div class="form-group">
                          <select id="universites" class="form-control" onchange="getRequirments(this.value)">
                          
                          	<option>Select Institution</option>
                            <?php
								
								 $dsql = $db->select('uni_info','*','uni_status=0');
								while($rows = mysql_fetch_assoc($dsql)){
										echo '<option value="'.$rows['uni_id'].'">'.$rows['uni_Name'].'</option>';
										
									} 
							?>
                          </select>
                          <script type="text/javascript">
									function getRequirments(uni_id){
									//$("#msg-inv").html('<img align="center" src="images/spinners/3.gif" />');
              						$.ajax({
									url: "actions.php",
										data:'ePage=add_rating&sub_req=1&uni_id='+uni_id,
										type:"POST",
										success: function(res){
										alert(res);
										}
									});
   								 	return res;
									}
						  </script>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <input type="file" class="form-control" />
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <select id="dtype" class="form-control">
                                <option>Document Type</option>
                                <option>document 2</option>
                                <option>document 3</option>
                                <option>document 4</option>
                                <option>document 5</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <div style="margin-top:12px; background:#eeeeee; padding:8px;"> <a href="#" class="btn btn-sm btn-info">Click to view</a>
                              <input type="submit"  class="btn btn-sm btn-primary" name="submit" value="Submit Check" />
                            </div>
                          </div>
                        </div>
                        <!-- modal-->
                        <div id="myModal" class="modal fade " role="dialog">
                          <div class="modal-dialog modal-wide"> 
                            
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
                              </div>
                              <div class="modal-body">
                                <div class="container">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="modalwrapper"> 
                                         <div class="form-group">
                                         	<input type="text" id="selectedUni" class="form-control" disabled="disabled" />
                                         </div>
                                         <div class="form-group">
                                         	<input id="documentType" type="text" class="form-control" disabled="disabled" placeholder="field name" />
                                         </div>
                                         <div class="form-group">
                                         	<input type="text" class="form-control" placeholder="field name" />
                                         </div>
                                         <div class="form-group">
                                         	<input type="text" class="form-control" placeholder="field name" />
                                         </div>
                                         <div class="form-group">
                                         	<input type="text" class="form-control" placeholder="field name" />
                                         </div>
                                         <div class="form-group">
                                         	<input type="text" class="form-control" placeholder="field name" />
                                         </div>
                                         <div class="form-group">
                                         	<input type="text" class="form-control" placeholder="field name" />
                                         </div>
                                         <div class="form-group">
                                         	<input type="text" class="form-control" placeholder="field name" />
                                         </div>
                                         <div class="form-group">
                                         	<input type="text" class="form-control" placeholder="field name" />
                                         </div>
                                      	 <div class="form-group">
                                         	<input type="text" class="form-control" placeholder="field name" />
                                         </div>	
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="modalwrapper">
                                      	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse bibendum, velit eu vestibulum ullamcorper, nisi nisi sodales leo, in aliquet erat ante ac metus. In quis dui eleifend, scelerisque massa sit amet, lobortis sem. Sed mattis nisl nulla, id mattis enim semper id.</p> 
                                        <p>Sed in fringilla ante. Ut eros erat, blandit at tempor et, cursus at arcu. Nullam porttitor laoreet risus, et volutpat sem posuere id. Vestibulum dignissim semper euismod. Integer ut diam est. Vestibulum pellentesque purus felis, rhoncus tristique ligula pulvinar sit amet.</p> <p>Ut pellentesque dui eget enim lacinia, vitae commodo nulla suscipit. Vestibulum quis facilisis nisl. Morbi quis mollis purus, eu lacinia metus. Morbi eros urna, feugiat at auctor in, facilisis a arcu. Sed vehicula mi vel faucibus ornare. Proin volutpat nunc sed dui rutrum auctor.</p>
                                          	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse bibendum, velit eu vestibulum ullamcorper, nisi nisi sodales leo, in aliquet erat ante ac metus. In quis dui eleifend, scelerisque massa sit amet, lobortis sem. Sed mattis nisl nulla, id mattis enim semper id.</p> 
                                        <p>Sed in fringilla ante. Ut eros erat, blandit at tempor et, cursus at arcu. Nullam porttitor laoreet risus, et volutpat sem posuere id. Vestibulum dignissim semper euismod. Integer ut diam est. Vestibulum pellentesque purus felis, rhoncus tristique ligula pulvinar sit amet.</p> <p>Ut pellentesque dui eget enim lacinia, vitae commodo nulla suscipit. Vestibulum quis facilisis nisl. Morbi quis mollis purus, eu lacinia metus. Morbi eros urna, feugiat at auctor in, facilisis a arcu. Sed vehicula mi vel faucibus ornare. Proin volutpat nunc sed dui rutrum auctor.</p>
                                        <p>Sed in fringilla ante. Ut eros erat, blandit at tempor et, cursus at arcu. Nullam porttitor laoreet risus, et volutpat sem posuere id. Vestibulum dignissim semper euismod. Integer ut diam est. Vestibulum pellentesque purus felis, rhoncus tristique ligula pulvinar sit amet.</p> <p>Ut pellentesque dui eget enim lacinia, vitae commodo nulla suscipit. Vestibulum quis facilisis nisl. Morbi quis mollis purus, eu lacinia metus. Morbi eros urna, feugiat at auctor in, facilisis a arcu. Sed vehicula mi vel faucibus ornare. Proin volutpat nunc sed dui rutrum auctor.</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <div style="text-align:center;">
                                  <label><input type="checkbox" id="iagree" value="" /> I Agree</label>
                                  </div>
      </div>
                                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--> 
                              </div>
                            </div>
                          </div>
                       
                        
                        <!--/Modal-->
                      </form>
                    </div>
                  </div>
                  <div  class="tab-pane"  id="payment">2</div>
                  <div  class="tab-pane"  id="confirmation">3</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--
<div class="list-group-item" id="input-fields">
                  	<div class="form-group">
                        <select class="form-control">
                        	<option>Univesit 1</option>
                            <option>Univesit 2</option>
                            <option>Univesit 3</option>
                            <option>Univesit 4</option>
                            <option>Univesit 5</option>
                        </select>
                      </div>
                    <div class="row">
                    <div class="col-md-4">
								<input type="file"  name="upload_image"/> 
                                    
                                  
                                </div>
                    <div class="col-md-8">
                    	<div class="row">
                    <div class="form-group col-md-6">
                    	<input type="text" class="form-control" name="" placeholder="Employee Name" />
                    </div>
                    <div class="form-group col-md-6">
                    	<input type="text" class="form-control" name="" placeholder="Father Name" />
                    </div>
                    </div>
                    	<div class="row">
                    <div class="form-group col-md-6">
                    	<input type="text" class="form-control" name="" placeholder="CNIC Number" />
                    </div>
                    <div class="form-group col-md-6">
                    	<input type="text" class="form-control" name="" placeholder="Date of Birth" />
                    </div>
                    </div>
                    	<div class="row">
                    <div class="form-group col-md-6">
                    	<input type="text" class="form-control" name="" placeholder="Employee Code" />
                    </div>
                     <div class="form-group col-md-6">
                    	document type
                    </div>
                    
                    </div>
                    <div>
                    	<input type="submit" value="Submit Check" />
                    </div>
                    </div>
                    </div>
                </div>--> 
<script type="text/javascript">
 jQuery(document).ready(function(e) {
 	var $uni = jQuery("select#universites");
	$uni.on('change', function() {
			var text = jQuery(this).find(":selected").text();
			jQuery("#selectedUni").val(text);
			});
			//alert(text);
	jQuery("select#dtype").on('change', function() {
		var dtype = jQuery(this).find(":selected").text();
		jQuery("#documentType").val(dtype);
		
	});
	jQuery("select#dtype").on('change', function() {
		jQuery('#myModal').modal('show');
		jQuery("#iagree").change(function(event){
		if (this.checked){
			jQuery('#myModal').modal('hide');
		}
		});

	});
});

 </script> 