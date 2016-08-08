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

<script type="text/javascript">
			var chart;
			window.onload = function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'containerchart',
						defaultSeriesType: 'column'
					},
					title: {
						text: 'Month On Month SLA% <?=$comName?>'
					},
					xAxis: {
						categories: [
							<?php 
							foreach($slaA as $key=>$val){
								$monts=((isset($monts))?"$monts,'$key'":"'$key'");
							}
							echo $monts;
							?>]
					},
					yAxis: {
						min: 0,
						max:100
						,
						title: {
							text: 'Month On Month SLA%'
						}
					},
					legend: {
						verticalAlign: 'bottom',
						backgroundColor: '#FFFFFF',
						borderColor: '#CCC',
						borderWidth: 1,
						shadow: false
					},
					tooltip: {
						formatter: function() {
							return '<b>'+ this.x +'</b><br/>'+
								 this.series.name +': '+ this.y + '%';
						}
					},
					plotOptions: {
						column: {
							stacking:'normal'
						}
					},
				    series: [ {
						name: 'After Due Date',
						data: [
							<?php 
							$taVal=0;
							foreach($slaA as $key=>$val){
								$tVa = @round(($val['adue']/($val['adue']+$val['bdue']))*100,2);
								$aVals=((isset($aVals))?"$aVals,$tVa":"$tVa");
								$taVal=$val['adue']+$taVal;
							}
							echo $aVals;
							?>						
						],
						color:'#F93'
					},
					{
						name:'Before Due Date',
						data: [
							<?php 
							$tbVal=0;
							foreach($slaA as $key=>$val){
								$tVa = @round(($val['bdue']/($val['adue']+$val['bdue']))*100,2);
								$bVals=((isset($bVals))?"$bVals,$tVa":"$tVa");
								$tbVal= $val['bdue']+$tbVal;
							}
							echo $bVals;
							?>						
						],
						color: '#006600'
					}
					]
				});	
				slaGraph(<?=@round(($tbVal/($tbVal+$taVal))*100,2)?>,<?=@round(($taVal/($tbVal+$taVal))*100,2)?>);
			}

      
    function slaGraph(bdue,adue){
        var chart;
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'slaCases',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text:'Overall SLA% <?=$comName?>'
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.point.name +'</b>: '+ this.y +'%';
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
                            return '<b>'+ this.point.name +'</b>: '+ this.y +'%';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name:'Overall SLA% <?=$comName?>',
                data: [
                    {
                        name: 'After Due Date',
                        y:adue,
                        sliced: true,
                        selected: true,						
                        color:'#F93'
                    },{
                        name: 'Before Due Date',    
                        y:bdue,
                        color:'#006600'
                    }
                ]
            }]
        });	
    }
</script>
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
        	
        <div class="chartMain" style="display:block;"> 
        	<form method="post" enctype="multipart/form-data" name="clientFrm" style="text-align:right">
                <select name="cId" class="input" onChange="javascript:clientFrm.submit()" >
                        <option value="">---All Clients---</option>
                <?php 	$coms = $db->select("company","*","is_active=1");
                        $coid = (isset($_REQUEST['cId']))?$_REQUEST['cId']:0;
                        while($com =mysql_fetch_array($coms)){  ?>
                            <option value="<?php echo $com['id']; ?>" <?php echo ($com['id']==$coid)?'selected="selected"':'';?>>
                                <?php echo $com['name'] ?>
                            </option>
                <?php	} ?>
                </select>
            </form>
            <div id="containerchart" style="width:100%; height:400px;margin: 0 auto"></div>
			<table>
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
            <div id="slaCases" style="width:100%;height:400px;margin: 0 auto"></div> 
			<table>
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