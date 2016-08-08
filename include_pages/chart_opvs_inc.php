<div class="box grid_16 tabs">

					<!--<h2 class="box_head">Month on Month SLA%</h2>-->
                     <ul id="touch_sort" class="tab_header clearfix">
							<li><a href="javascript:void(0)" onclick="tabSwitch('vscaTb,vsckTb','casesTbl,checksTbl','vscaTb,casesTbl',vsclbckCase)" id="vscaTb" class="current">Cases Graph</a></li>
							<li><a href="javascript:void(0)" onclick="tabSwitch('vscaTb,vsckTb','casesTbl,checksTbl','vsckTb,checksTbl',vsclbckChks)" id="vsckTb" class="normal" >Checks Graph</a></li>
</ul>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						<!--<div class="block" style="height:235px; overflow:auto;">-->
							
									<div class="section">										                               
<div class="chartMain topNone" style="display:block;">   
	
    <div id="cntvsCases" style="width:100%;margin: 0 auto;height:400px;"></div>
	
    <div id="casesTbl" style="display:block; width:100%;">
        <table class="display static">
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
    <div id="checksTbl" style="display:none;width:100%;"> 
        <table class="display static">
            <thead>
                <tr>
                    <th style="width:200px;">Client's Name</th>
                    <th>Verified Checks</th>
                    <th>Negative Checks</th> 
                    <th>Discrepancy Checks</th>
                    <th>UTV Checks</th> 
                    <th>Insufficient Checks</th>  
                </tr>
            </thead>
            <tbody>
               <?php 
                    $tComs = $db->select("company","*","is_active=1");
                    $defutvsGraphch='';
                    if(mysql_num_rows($tComs)>0){
                    while($tCom = mysql_fetch_array($tComs)){
                        $vchWer="vc.as_vstatus='Verified' OR vc.as_vstatus='Satisfactory' OR vc.as_vstatus='Positive Match Found'";
                        $tchVerified = countChecks("vd.com_id=$tCom[id] AND ($vchWer)");
                        $tchNegative = countChecks("vd.com_id=$tCom[id] AND vc.as_vstatus='Negative'");
                        $tchDisrpncy = countChecks("vd.com_id=$tCom[id] AND vc.as_vstatus='Discrepancy'");
                        $tchUabltove = countChecks("vd.com_id=$tCom[id] AND vc.as_vstatus='Unable to Verify'");
                        $tchInsufint = countChecks("vd.com_id=$tCom[id] AND vc.as_vstatus='Insufficient'");
                                            
                        $dchGraph="'$tCom[name]',$tchVerified,$tchNegative,$tchDisrpncy,$tchUabltove,$tchInsufint,'Checks'";
                        if($defutvsGraphch=='') $defutvsGraphch = $dchGraph; ?>
                        
                        <tr class="hover" onclick="showvsGraph(<?=$dchGraph?>)">
                            <td><?=$tCom['name']?></td>
                            <td><?=$tchVerified?></td>
                            <td><?=$tchNegative?></td>
                            <td><?=$tchDisrpncy?></td>
                            <td><?=$tchUabltove?></td>
                            <td><?=$tchInsufint?></td>
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
                            
                           
						<!--</div>-->
					</div>
				</div>

<script type="text/javascript">	
    var tcscaDatab =new Array( <?=$defutvsGraphca?>);
	var tcchkDatab =new Array( <?=$defutvsGraphch?>);
    function showvsGraph(name,tVs,cNs,tDis,tUtv,tIns,type){
		if(type=='Cases'){
			tcscaDatab = new Array(name,tVs,cNs,tDis,tUtv,tIns,type);			
		}else{
			tcchkDatab = new Array(name,tVs,cNs,tDis,tUtv,tIns,type);
		}
		createvsGraph(name,tVs,cNs,tDis,tUtv,tIns,type);
    }
    
     function vsclbckCase(){
        if(tcscaDatab[0]!==undefined){
            createvsGraph(tcscaDatab[0],tcscaDatab[1],tcscaDatab[2],tcscaDatab[3],tcscaDatab[4],tcscaDatab[5],'Cases');
        }
    }
   
     function vsclbckChks(){
        if(tcchkDatab[0]!==undefined){
            createvsGraph(tcchkDatab[0],tcchkDatab[1],tcchkDatab[2],tcchkDatab[3],tcchkDatab[4],tcchkDatab[5],'Checks');
        }
    }
	   
    function createvsGraph(name,tVs,cNs,tDis,tUtv,tIns,type){
        var chart;
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'cntvsCases',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: name+' Data Visualization [ '+type+' ]'
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.point.name +'</b>: '+ this.y +'';
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.y +'';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: name+' Data Visualization [ '+type+' ]',
                data: [
                    {
                        name: 'Verified '+type,
                        y:tVs,
                        sliced: true,
                        selected: true,						
                        color:'#006600'
                    },
                    {
                        name: 'Negative '+type,
                        y:cNs,
                        color:'#EF3C42'
                    },
                    {
                        name: 'Discrepancy '+type,
                        y:tDis,
                        color:'#F93'
                    },
                    {
                        name: 'UTV '+type,
                        y:tUtv,
                        color:'#039'
                    },										
                    {
                        name: 'Insufficient '+type,    
                        y:tIns,
                        color:'#999'
                    }
                ]
            }]
        });	
    }
    <?php if($defutvsGraphca!=''){?>
                createvsGraph(<?=$defutvsGraphca?>,'Checks');
    <?php }?>
    </script>



