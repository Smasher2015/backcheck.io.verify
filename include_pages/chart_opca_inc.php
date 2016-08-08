  <section class="retracted scrollable">
 <div class="box grid_16 tabs">

					<!--<h2 class="box_head">Month on Month SLA%</h2>-->
                     <ul id="touch_sort" class="tab_header clearfix">
							<li> <a href="javascript:void(0)" onclick="tabSwitch('caTb,ckTb','caDv,ckDv','caTb,caDv',clbckCase)" id="caTb" class="current">Cases Graph</a></li>
							<li><a href="javascript:void(0)" onclick="tabSwitch('caTb,ckTb','caDv,ckDv','ckTb,caDv',clbckChks)" id="ckTb" class="normal" >Checks Graph</a></li>
</ul>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						<!--<div class="block" style="height:235px; overflow:auto;">-->
							
									 <div class="row">
            <div class="col-md-12">
			<div class="manager-report-sec">										   
                                    <div class="chartMain topNone panel panel-default panel-block" style="display:block;">   
                                        <div id="caDv" style="display:block;">
                                            <div id="cntCases" style="width:100%;margin: 0 auto;height:400px;"></div>
                                        </div>
                                        <div id="ckDv" style="display:none;">
                                            
                                        </div>
                                        <?php 
                                            $CaseShow=true;
                                            include("include_pages/checks_counter_inc.php");
                                        ?> 
                                    
                                        <table class="display static table table-bordered table-striped" id="tableSortable_3">
                                            <thead>
                                                <tr>
                                                    <th>&nbsp;</th>
                                                  <?php if($LEVEL==2 || $LEVEL==5 || $LEVEL==1){?>
                                                        <th>Not Assign</th>
                                                  <?php } ?>
                                                    <th>Assigned</th>
                                                    <th>Work in Process</th>
                                                    <th>Completed</th>  
                                                  <?php if($LEVEL==2 || $LEVEL==5 || $LEVEL==1){?>
                                                    <th>Sent [ Client ]</th>
                                                  <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <tr class="hover" onclick="tabSwitch('caTb,ckTb','caDv,ckDv','caTb,caDv',clbckCase)">
                                                        <td >Total Cases</td>
                                                    <?php if($LEVEL==2 || $LEVEL==5 || $LEVEL==1){?>
                                                        <td ><?php echo $nAsgcas; ?></td>
                                                    <?php } ?>
                                                        <td ><?php echo $asgncas; ?></td>
                                                        <td ><?php echo $pendgcas; ?></td>
                                                        <td ><?php echo $closecas; ?></td>
                                                   <?php if($LEVEL==2 || $LEVEL==5 || $LEVEL==1){?>
                                                        <td ><?php echo $clSentcas; ?></td>        
                                                   <?php } ?>   
                                                    </tr>
                                                    <tr class="hover" onclick="tabSwitch('caTb,ckTb','caDv,ckDv','ckTb,caDv',clbckChks)">
                                                        <td >Total Checks</td>
                                                    <?php if($LEVEL==2 || $LEVEL==5  || $LEVEL==1){?>    
                                                        <td ><?php echo $nAsgchk; ?></td>
                                                    <?php } ?>
                                                        <td ><?php echo $asgnchk; ?></td>
                                                        <td ><?php echo $pendgchk; ?></td>
                                                        <td ><?php echo $closechk; ?></td>
                                                     <?php if($LEVEL==2 || $LEVEL==5 || $LEVEL==1){?>   
                                                        <td ><?php echo $clSentchk; ?></td>        
                                                     <?php } ?> 
                                                    </tr>                
                                            </tbody>
                                        </table>
                                        
                                        <table  id="datacases" style="display:none;">
                                            <thead>
                                                <tr>
                                                    <th>&nbsp;</th>
                                                    <?php if($LEVEL==2 || $LEVEL==5 || $LEVEL==1){?>
                                                        <th>Not Assign</th>
                                                    <?php } ?>
                                                    <th>Assigned</th>
                                                    <th>Work in Process</th>
                                                    <th>Closed</th>  
                                                  <?php if($LEVEL==2 || $LEVEL==5 || $LEVEL==1){?>
                                                    <th>Sent [ Client ]</th>
                                                   <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <tr><th >Cases</th>
                                                    <?php if($LEVEL==2 || $LEVEL==5 || $LEVEL==1){?>
                                                        <td ><?php echo $nAsgcas; ?></td>
                                                    <?php } ?>
                                                        <td ><?php echo $asgncas; ?></td>
                                                        <td ><?php echo $pendgcas; ?></td>
                                                        <td ><?php echo $closecas; ?></td>
                                                      <?php if($LEVEL==2 || $LEVEL==5 || $LEVEL==1){?>
                                                        <td ><?php echo $clSentcas; ?></td>         
                                                       <?php } ?>
                                                    </tr>                
                                            </tbody>
                                        </table>
                                        <table  id="dataChecks" style="display:none;">
                                            <thead>
                                                <tr>
                                                    <th>&nbsp;</th>
                                                  <?php if($LEVEL==2 || $LEVEL==5 || $LEVEL==1){?>
                                                        <th>Not Assign</th>
                                                  <?php } ?>
                                                    <th>Assigned</th>
                                                    <th>Work in Process</th>
                                                    <th>Closed</th>  
                                                  <?php if($LEVEL==2 || $LEVEL==5  || $LEVEL==1){?>    
                                                    <th>Sent [ Client ]</th>
                                                  <?php } ?> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <tr>
                                                        <th >Checks</th>
                                                    <?php if($LEVEL==2 || $LEVEL==5  || $LEVEL==1){?>    
                                                        <td ><?php echo $nAsgchk; ?></td>
                                                    <?php } ?>
                                                        <td ><?php echo $asgnchk; ?></td>
                                                        <td ><?php echo $pendgchk; ?></td>
                                                        <td ><?php echo $closechk; ?></td>
                                                    <?php if($LEVEL==2 || $LEVEL==5  || $LEVEL==1){?>   
                                                        <td ><?php echo $clSentchk; ?></td>         
                                                    <?php } ?> 
                                                   </tr>
                                            </tbody>
                                        </table>
                                    
                                    </div>
									</div>
									</div>
									</div>
                            
                           
						<!--</div>-->
					</div>
				</div>
				</section>


<script src="<?php echo SURL; ?>js/js_charts.js"></script>

<script type="text/javascript">
	function clbckCase(){
		CreateBarChart('datacases','Cases','cntCases');
	}
	
	function clbckChks(){
		CreateBarChart('dataChecks','Checks','cntCases');
	}

	CreateBarChart('datacases','Cases','cntCases');
	
	
	$(document).ready(function() {

  proton.tables = {

	build: function () {

		// Data Tables

		$('#tableSortable_3').dataTable(); 
	
		

		$('.dataTables_wrapper').find('input, select').addClass('form-control');

		$('.dataTables_wrapper').find('input').attr('placeholder', 'Quick Search');



		$('.dataTables_wrapper select').select2();

	}

}

});
</script>