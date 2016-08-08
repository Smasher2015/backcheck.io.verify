<style>
.hover{
	cursor:pointer;
}
</style>
 <div class="box grid_16 tabs">
                     <ul id="touch_sort" class="tab_header clearfix">
							<li><a href="javascript:void(0)" onclick="tabSwitch('caPTb,ckPTb','caPDv,ckPDv','caPTb,caPDv',callbackca)" id="caPTb" class="current">Cases Graph</a></li>
							<li><a href="javascript:void(0)" onclick="tabSwitch('caPTb,ckPTb','caPDv,ckPDv','ckPTb,ckPDv',callbackch)" id="ckPTb" class="normal" >Checks Graph</a></li>
</ul>
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">				
									<div class="section">										   
                                
                                <div class="chartMain topNone">
                                            
                                    <div id="cntDCases" style="width:100%;height:400px;margin: 0 auto;"></div>
                                       
                                    <div id="caPDv" style="display:block;">    
                                        <table class="display static">
                                        <thead>
                                            <tr>
                                                <th style="width:400px;">Client's Name</th>
                                                <th>Assigned Cases</th>
                                                <th>WIP Cases</th>
                                                <th>Close Cases</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
										   		if($_SESSION['user_id']==50 || $_SESSION['user_id']==83){
													$dWhere="id=20";
												}else $dWhere="is_active=1";
                                                $tComs = $db->select("company","*",$dWhere);
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
                                    
                                    <div id="ckPDv" style="display:none;">
                                        <table class="display static">
                                        <thead>
                                            <tr>
                                                <th style="width:200px;">Client's Name</th>
                                                <th>Assigned Checks</th>
                                                <th>WIP Checks</th>
                                                <th>Close Checks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
										   		if($_SESSION['user_id']==50 || $_SESSION['user_id']==83){
													$dWhere="id=20";
												}else $dWhere="is_active=1";										   
                                                $tComs = $db->select("company","*",$dWhere);
                                                $defutGraphch='';
                                                if(mysql_num_rows($tComs)>0){
                                                while($tCom = mysql_fetch_array($tComs)){
                                                    $ttChecks = countChecks("vd.com_id=$tCom[id] AND as_status<>'Not Assign'");
                                                    $tcChecks = countChecks("vc.as_status='Close' AND vd.com_id=$tCom[id]");
                                                    $dGraph="'$tCom[name]',$ttChecks,$tcChecks,'Checks'";
                                                    if($defutGraphch=='') $defutGraphch = $dGraph; ?>
                                                    <tr class="hover" onclick="showGraph(<?=$dGraph?>)">
                                                        <td><?=$tCom['name']?></td>
                                                        <td><?=$ttChecks?></td>
                                                        <td><?=($ttChecks-$tcChecks)?></td>
                                                        <td><?=$tcChecks?></td>
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
    var tDataca= new Array(<?=$defutGraphca?>);
	var tDatach= new Array(<?=$defutGraphch?>);
    
	function showGraph(name,tCount,cCount,type){
		if(type=='Cases'){
			tDataca= new Array(name,tCount,cCount,type);
		}else{
			tDatach= new Array(name,tCount,cCount,type);
		}
		createGraph(name,tCount,cCount,type);
    }
    
    function callbackca(){
        if(tDataca[0]!==undefined){
            createGraph(tDataca[0],tDataca[1]  ,tDataca[2],'Cases');
        }
    }
	
    function callbackch(){
        if(tDatach[0]!==undefined){
            createGraph(tDatach[0],tDatach[1]  ,tDatach[2],'Checks');
        }
    }
    
    function createGraph(name,tCount,cCount,type){
        var chart;
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'cntDCases',
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
                        name: 'Assigned '+type,
                        y:tCount,
                        color:'#039'
                    },
                    {
                        name: 'Closed '+type,
                        y:cCount,
                        sliced: true,
                        selected: true,						
                        color:'#006600'
                    },
                    {
                        name: 'WIP '+type,    
                        y:(tCount-cCount),
                        color:'#F93'
                    }
                ]
            }]
        });	
    }
    <?php if($defutGraphca!=''){?>
             createGraph(<?=$defutGraphca?>,'Cases');
    <?php }?>
    </script>	