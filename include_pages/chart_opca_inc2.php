<div class="comTabs">
    <a href="javascript:void(0)" onclick="tabSwitch('caTb,ckTb','caDv,ckDv','caTb,caDv',clbckCase)" id="caTb" class="current">Cases Graph</a>
    <a href="javascript:void(0)" onclick="tabSwitch('caTb,ckTb','caDv,ckDv','ckTb,caDv',clbckChks)" id="ckTb" class="normal" >Checks Graph</a>
    <div class="clear"></div>
</div>
<div class="chartMain topNone" style="display:block;">   
	<div id="caDv" style="display:block;">
    	<div id="cntCases" style="width:100%;margin: 0 auto;height:400px;"></div>
	</div>
    <div id="ckDv" style="display:none;">
    	
	</div>
	<?php 
		$CaseShow=true;
		include("include_pages/checks_counter_inc.php");
	?> 

    <table >
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

<script src="<?php echo SURL; ?>js/js_charts.js"></script>

<script type="text/javascript">

	function clbckCase(){
		CreateBarChart('datacases','Cases','cntCases');
	}
	
	function clbckChks(){
		CreateBarChart('dataChecks','Checks','cntCases');
	}

	$(document).ready(function() {			
		CreateBarChart('datacases','Cases','cntCases');
	});
		
	
</script>
<div class="flat_area grid_16">
					<h2>Graphs and Charts</h2>
				</div>
				<div class="box grid_16">
					<h2 class="box_head">Line Graph</h2>
					<a href="#" class="grabber"></a>
					<a href="#" class="toggle"></a>
					<div class="toggle_container">					
						<div class="block">
							<div class="section">
								<div id="flot_line" class="flot"></div>
							</div>
				 		</div>
					</div>
				 </div>
				
				<div class="box grid_16">
					<h2 class="box_head">Point Graph with Pie chart</h2>
					<a href="#" class="grabber"></a>
					<a href="#" class="toggle"></a>
					<div class="toggle_container">					
						<div class="block">
							<div class="columns">
								<div class="col_66">
									<div class="section">
										<div id="flot_points" class="flot"></div>
									</div>								
								</div>
								<div class="col_33">
									<div class="section">
										<div id="flot_pie_1" class="flot"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="box grid_16">
					<h2 class="box_head">Bar Graph</h2>
					<a href="#" class="grabber"></a>
					<a href="#" class="toggle"></a>
					<div class="toggle_container">					
						<div class="block">
							<div class="section">
								<div id="flot_bar" class="flot"></div>
							</div>
						</div>
					</div>
				</div>        
                
<script type='text/javascript' src='scripts/flot/excanvas.min.js'></script>
<script type='text/javascript' src='scripts/flot/jquery.flot.min.js'></script>
<script type='text/javascript' src='scripts/flot/jquery.flot.resize.min.js'></script>		
<script type='text/javascript' src='scripts/flot/jquery.flot.pie.min.js'></script>
<script type='text/javascript' src='scripts/flot/jquery.flot.pie.resize_update.js'></script>

<script type="text/javascript" src="scripts/adminica/adminica_charts.js"></script>
