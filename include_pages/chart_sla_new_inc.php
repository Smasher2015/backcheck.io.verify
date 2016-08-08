	<?php
		if(is_numeric($company_id)){
			$com="AND com_id=$company_id";
			$coms = $db->select("company","*","id=$company_id AND is_active=1");
			$coms = @mysql_fetch_assoc($coms);
			$comName = "For $coms[name]";
		}
		$selMonth = ($mnth!="")?" AND MONTH(as_addate)='".$mnth."'":" AND MONTH(as_addate)='".date("m")."'";
		$selYear = ($yr!="")?" AND YEAR(as_addate)='".$yr."'":" AND YEAR(as_addate)='".date("Y")."'";
		
		$tbl="(SELECT UCASE(DATE_FORMAT(as_addate, '%b-%y')) `month`,IF(DATEDIFF(as_cldate,as_addate)<15, 'bdue', 'adue') flg ,COUNT(DATEDIFF(as_cldate,as_addate)) days,as_addate";
		$tbl= "$tbl FROM ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id WHERE as_status='Close' $selMonth $selYear $com GROUP BY `month`,flg ORDER BY as_addate DESC LIMIT 24) tdata";
		//echo "Select * FROM $tbl WHERE 1=1 ORDER BY as_addate";
		$slaMnth = $db->select($tbl,"*","1=1 ORDER BY as_addate");

		$slaA = array();
		if(@mysql_num_rows($slaMnth)>0){	
			while($sla = @mysql_fetch_assoc($slaMnth)){
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
	
	function clbcksla(){
		var chart;
		chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container',
						defaultSeriesType: 'column'
					},
					title: {
						text: '<?php echo $Fmonth.', '.$yr; ?> SLA% <?=$comName?>'
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
							text: '<?php echo $Fmonth.', '.$yr; ?> SLA%'
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
						color:'#FF9800'
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
						color: '#388E3C'
					}
					]
				});	
	}	

</script>
<style type="text/css">
ul#touch_sort{padding:0;}
ul#touch_sort li{ list-style:none; display:inline-block;margin-right: 0px;float: left;width: 50%;}
ul#touch_sort li a{ background:#999;color:#ffffff; padding:7px 12px; width: 100%;text-align: center;display: inline-block;border-radius:0 3px 3px 0;}
ul#touch_sort li:first-child a{border-radius:3px 0 0 3px;}
ul#touch_sort li a.current{ background:#9CBE35; color:#ffffff; padding:7px 12px;}
</style>

<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-flat">
    <div class="panel-heading">
   			<h5 class="panel-title"><?php echo $Fmonth.', '.$yr; ?> SLA | Overall SLA</h5>
            
    </div>
     <div class="panel-body">
          
<div class="tabs">
                    <ul id="touch_sort" class="tab_header clearfix">
                        <li><a href="javascript:void(0)" onclick="tabSwitch('slaTb,oslTb','slaDv,oslDv','slaTb,slaDv',clbcksla)" id="slaTb" class=" current"><?php echo $Fmonth.', '.$yr; ?> SLA%</a></li>
                        <li><a href="javascript:void(0)" onclick="tabSwitch('slaTb,oslTb','slaDv,oslDv','oslTb,oslDv',clbckosla)" id="oslTb" class="normal" >Overall SLA%</a></li>
                    </ul>					
                    
					<a href="#" class="grabber">&nbsp;</a>
					<a href="#" class="toggle">&nbsp;</a>
					<div class="toggle_container">
						<!--<div class="block" style="height:235px; overflow:auto;">-->
							
									
            
			
										   	
        <div class="chartMain" style="display:block;"> 
        	
            
            <div id="slaDv" style="display:block;">
            	<div id="container" style="width:100%; height:400px;margin: 0 auto;"></div>
			<div class="table-responsive">	
                <table class="table table-bordered table-xxs">
                <thead>
                    <tr>
                        <th style="width:200px;" >&nbsp;</th>
                        <?php foreach($slaA as $key=>$val){ ?>
                                <th><?=$key?></th>
                        <?php } ?> 
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <td style="text-align:left" >Before Due Date</td>
                        <?php	foreach($slaA as $key=>$val){ ?>
                                    <td ><?=@round(($val['bdue']/($val['adue']+$val['bdue']))*100,2)?>%</td>
                        <?php	} ?>                            
                    </tr>   
                    <tr >
                        <td style="text-align:left" >After Due Date</td>
                        <?php	foreach($slaA as $key=>$val){ ?>
                                    <td ><?=@round(($val['adue']/($val['adue']+$val['bdue']))*100,2)?>%</td>
                        <?php	} ?>
                    </tr>             
                </tbody>
            </table>
            </div>
                        
            </div>
            <div id="oslDv" style="display:none;" class="table table-bordered table-striped">
            	<div id="slaCases" style="width:100%;height:400px;margin: 0 auto"></div> 
				<table class="display static">
                <thead>
                    <tr>
                        <th style="width:200px;" >&nbsp;</th>
                        <th>Before Due Date</th>
                        <th>After Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:left" >Overall SLA%</td>
                        <td ><?=@round(($tbVal/($tbVal+$taVal))*100,2)?>%</td>
                        <td ><?=@round(($taVal/($tbVal+$taVal))*100,2)?>%</td>                        
                    </tr>                
                </tbody>
            </table>   
            </div>                  
        </div>
       
									
									
									
                            
                           
						<!--</div>-->
					</div>
				</div>
          
          </div>      
				</div>
				</div>
				</div>

<script type="text/javascript" language="javascript" src="<?php echo SURL; ?>scripts/highchart/highcharts.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo SURL; ?>scripts/highchart/data.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo SURL; ?>scripts/highchart/drilldown.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo SURL; ?>scripts/highchart/exporting.js"></script>
      
<script type="text/javascript">



	function clbckosla(){
		slaGraph(<?=@round(($tbVal/($tbVal+$taVal))*100,2)?>,<?=@round(($taVal/($tbVal+$taVal))*100,2)?>);
	}
	clbcksla();
	
</script>