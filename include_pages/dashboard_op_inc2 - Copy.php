	<?php
		if(is_numeric($_REQUEST['cId'])){
			$com="AND com_id=$_REQUEST[cId]";
			$coms = $db->select("company","*","id=$_REQUEST[cId] AND is_active=1");
			$coms = mysql_fetch_assoc($coms);
			$comName = "For $coms[name]";
		}else{
			$com='';
			$comName='';
		}
		
		$cols="UCASE(DATE_FORMAT(v_date, '%b-%y')) `month`,IF(DATEDIFF(v_cldate,v_date)<25, 'bdue', 'adue') flg ,COUNT(DATEDIFF(v_cldate,v_date)) days";
		$slaMnth = $db->select("ver_data",$cols,"v_status='close' $com GROUP BY `month`,flg ORDER BY v_date");
		$slaA = array();
		if(mysql_num_rows($slaMnth)>0){	
			while($sla =mysql_fetch_assoc($slaMnth)){
				if($sla['flg']=='bdue'){
					$slaA[$sla['month']]['bdue'] = $sla['days'];
					if(!isset($slaA[$sla['month']]['adue'])) $slaA[$sla['month']]['adue']=0;	
				}else{
					$slaA[$sla['month']]['adue'] = $sla['days'];
					if(!isset($slaA[$sla['month']]['bdue'])) $slaA[$sla['month']]['bdue']=0;
				}
			}
		}else{
			$tMnths= strtoupper(date("M-y",time()));
			$slaA[$tMnths]['bdue'] = 0;
			$slaA[$tMnths]['adue'] = 0;	
		}?>
       
			

 <?php 
		$CaseShow=true;
		include("include_pages/checks_counter_inc.php");
		$slaAg = $slaA;
	?>   
               <!-- </div>
                <div id="main_container" class="main_container container_16 clearfix">-->
					
                <div class="box grid_8">
					<h2 class="box_head">Month on Month SLA%</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						<!--<div class="block" style="height:235px; overflow:auto;">-->
							
									<div class="section">
										<div id="flot_bar_1" class="flot"></div>
									</div>
                            
                           
						<!--</div>-->
					</div>
				</div>
                
                
                    <div class="box grid_8 tabs">
					<h2 class="box_head">Month on Month SLA%</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						<!--<div class="block" style="height:235px; overflow:auto;">-->
                     
            <div class="block">
             <div id="dt3">                        
<table class="display datatable">
                <thead>
                    <tr>
                        <th style="width:200px;" >&nbsp;</th>
							<?php foreach($slaA as $key=>$val){ ?>
                                    <th><?=$key?></th>
                            <?php } ?> 
                    </tr>
                </thead>
                <tbody>
                    <tr class="shover">
                        <th style="text-align:left" >Before Due Date</th>
                        <?php	foreach($slaA as $key=>$val){ ?>
                                    <td ><?=@round(($val['bdue']/($val['adue']+$val['bdue']))*100,2)?>%</td>
                        <?php	} ?>                            
                    </tr>   
                    <tr class="shover">
                        <th style="text-align:left" >After Due Date</th>
                        <?php	foreach($slaA as $key=>$val){ ?>
                                    <td ><?=@round(($val['adue']/($val['adue']+$val['bdue']))*100,2)?>%</td>
                        <?php	} ?>
                    </tr>             
                </tbody>
            </table>                      
	</div>
    </div>					
                        
                        <!--</div>-->
					</div>
				</div> 
                
                
   	        <div class="box grid_8 " style="display:none;">
					<h2 class="box_head">Bar Chart</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						<!--<div class="block" style="height:235px; overflow:auto;">-->
							
									<div class="section">
										<div id="flot_bar" class="flot"></div>
									</div>
                            
                           
						<!--</div>-->
					</div>
				</div>
                
                
            <div class="box grid_8 tabs" style="display:none;">
					<h2 class="box_head">Cases</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						<!--<div class="block" style="height:235px; overflow:auto;">-->
              <div class="block">
             <div id="dt3">                      
                        

    <table class="display datatable">
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
                	<th >Total Cases</th>
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
                	<th >Total Checks</th>
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
                           
	</div>
    </div>					<!--</div>-->
					</div>
				</div>
                	
				
                <div class="box grid_8">
					<h2 class="box_head">Overall SLA%</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						
							
									<div class="section">
										<div id="flot_pie_2" class="flot"></div>
									</div>
                            
                           
						
					</div>
				</div>
                
                <div class="box grid_8 tabs">
					<h2 class="box_head">Overall SLA%</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
                                <div class="block">
             <div id="dt3">   
		<table class="display datatable" >
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
    </div>
    </div>
					</div>
				</div>
                
                	
                <div class="box grid_8">
					<h2 class="box_head">Overall SLA%</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						<!--<div class="block" style="height:235px; overflow:auto;">-->
							
									<div class="section">
										<div id="flot_pie_1" class="flot"></div>
									</div>
                            
                           
						<!--</div>-->
					</div>
				</div>
                
                
                
 <?php 
							$taVal=0;
							foreach($slaA as $key=>$val){
								$tVa = @round(($val['adue']/($val['adue']+$val['bdue']))*100,2);
								$aVals=((isset($aVals))?"$aVals,$tVa":"$tVa");
								$taVal=$val['adue']+$taVal;
							}
							
							?>
                            <?php 
							$tbVal=0;
							foreach($slaA as $key=>$val){
								$tVa = @round(($val['bdue']/($val['adue']+$val['bdue']))*100,2);
								$bVals=((isset($bVals))?"$bVals,$tVa":"$tVa");
								$tbVal= $val['bdue']+$tbVal;
							}
							
							?>	               
                <div class="box grid_8 tabs">
					<h2 class="box_head">Overall SLA%</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
                                <div class="block">
<div id="dt3">   
							<table class="display datatable">
                <thead>
                    <tr>
                        <th style="width:200px;" >&nbsp;</th>
                        <th>Before Due Date</th>
                        <th>After Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="shover">
                        <th style="text-align:left" >Overall SLA%</th>
                        <td ><?=@round(($tbVal/($tbVal+$taVal))*100,2)?>%</td>
                        <td ><?=@round(($taVal/($tbVal+$taVal))*100,2)?>%</td>                        
                    </tr>                
                </tbody>
            </table>  
            </div>
            </div>      
				  </div>
			   </div>
                
                
                
                   <div class="box grid_8">
					<h2 class="box_head">Statistics Graph [Cases]</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
		            <div class="block">
             <div id="dt2">   				
							
									 <table class="display datatable">
        <thead>
            <tr>
                <th style="width:200px;">Client's Name</th>
                <th>Assigned Cases</th>
                <th>WIP Cases</th>
                <th>Close Cases</th>
            </tr>
        </thead>
        <tbody>
           <?php 
		   		$tComs = $db->select("company","*","is_active=1");
				$defutGraphca='';
				if(mysql_num_rows($tComs)>0){
				while($tCom = mysql_fetch_array($tComs)){
					$ttCases = countCases("vd.com_id=$tCom[id] AND v_status<>'Not Assign'");
					$tcCases = countCases("vd.v_status='Close' AND vd.com_id=$tCom[id]");
 					$dGraph="'$tCom[name]',$ttCases,$tcCases,'Cases'";
					if($defutGraphca=='') $defutGraphca = $dGraph; ?>
                    <tr class="hover" onclick="showGraph(<?=$dGraph?>)">
                        <td><?=$tCom['name']?></td>
                        <td><?=$ttCases?></td>
                        <td><?=($ttCases-$tcCases)?></td>
                        <td><?=$tcCases?></td>
                    </tr>
            <?php }}else{ ?>
            	<tr class="shover">
                	<h1 align="center">No Record Found</h1>
                </tr>
			<?php } ?>
        </tbody>
    </table>
          </div>
          </div>                 
						
					</div>
				</div>
                
                
                   <div class="box grid_8 tabs">
					<h2 class="box_head">Overall Cases</h2>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
				
		            <div class="block">
             <div id="dt2">   					
								<table  class="display datatable">
            <thead>
                <tr>
                    <th style="width:200px;">Client's Name</th>
                    <th>Verified Cases</th>
                    <th>Negative Cases</th> 
                    <th>Discrepancy Cases</th>
                    <th>UTV Cases</th> 
                    <th>Insufficient Cases</th>  
                </tr>
            </thead>
            <tbody>
               <?php 
                    $tComs = $db->select("company","*","is_active=1");
                    $defutvsGraphca='';
                    if(mysql_num_rows($tComs)>0){
                    while($tCom = mysql_fetch_array($tComs)){
                        $vcaWer="vd.v_rlevel='Verified' OR vd.v_rlevel='Satisfactory' OR vd.v_rlevel='Positive Match Found'";
                        $tcaVerified = countCases("vd.com_id=$tCom[id] AND ($vcaWer)");
                        $tcaNegative = countCases("vd.com_id=$tCom[id] AND vd.v_rlevel='Negative'");
                        $tcaDisrpncy = countCases("vd.com_id=$tCom[id] AND vd.v_rlevel='Discrepancy'");
                        $tcaUabltove = countCases("vd.com_id=$tCom[id] AND vd.v_rlevel='Unable to Verify'");
                        $tcaInsufint = countCases("vd.com_id=$tCom[id] AND vd.v_rlevel='Insufficient'");
                        
                                            
                        $dcaGraph="'$tCom[name]',$tcaVerified,$tcaNegative,$tcaDisrpncy,$tcaUabltove,$tcaInsufint,'Cases'";
                        if($defutvsGraphca=='') $defutvsGraphca = $dcaGraph;  ?>
                        
                        <tr class="hover" onclick="showvsGraph(<?=$dcaGraph?>)">
                            <td><?=$tCom['name']?></td>
                            <td><?=$tcaVerified?></td>
                            <td><?=$tcaNegative?></td>
                            <td><?=$tcaDisrpncy?></td>
                            <td><?=$tcaUabltove?></td>
                            <td><?=$tcaInsufint?></td>
                        </tr>                    
                <?php }}else{ ?>
                    <tr class="shover">
                        <h1 align="center">No Record Found</h1>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
          </div>
          </div>                 
						
					</div>
				</div>
                
                </div>
                
                

<script type='text/javascript' src='scripts/flot/excanvas.min.js'></script>
<script type='text/javascript' src='scripts/flot/jquery.flot.min.js'></script>
<script type='text/javascript' src='scripts/flot/jquery.flot.resize.min.js'></script>		

<script type='text/javascript' src='scripts/flot/jquery.flot.pie.min.js'></script>
<script type='text/javascript' src='scripts/flot/jquery.flot.pie.resize_update.js'></script>			
<!--<script type='text/javascript' src='scripts/adminica/adminica_charts.js'></script>-->		
<?php  include_once('scripts/adminica/adminica_charts.php');