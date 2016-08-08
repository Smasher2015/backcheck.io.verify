<div class="chartMain" style="display:block;">   
	
    <div id="rgaCases" style="width:100%;margin: 0 auto;height:400px;"></div>
	
    <div id="rgaTbl" style="display:block; width:100%;">
        <table >
            <thead>
                <tr>
                    <th style="width:200px;">Client's Name</th>
                    <th>Green</th>
                    <th>Amber</th> 
                    <th>Red</th>  
                </tr>
            </thead>
            <tbody>
	<?php           $rgaGraphca='';
					$col="vd.v_rlevel";
					$tGrn = countCases("($col='verified' OR $col='satisfactory' OR $col='no match found' OR $col='no record found' OR $col='positive match found')");
					$tRed = countCases("($col='negative' OR $col='match found' OR $col='record found')");
					$tAmb = countCases("($col='unable to verify' OR $col='discrepancy')");
					$totl = $tGrn+$tRed+$tAmb;
					$tGrn=  round(($tGrn/$totl)*100,2);
					$tRed=  round(($tRed/$totl)*100,2);
					$tAmb=	round(($tAmb/$totl)*100,2);								
					$dcaGraph="'$COMINF[name]',$tGrn,$tRed,$tAmb";
					if($rgaGraphca=='') $rgaGraphca = $dcaGraph;  ?>
					
					<tr class="shover">
						<td><?=$COMINF['name']?></td>
						<td><?=$tGrn?>%</td>
						<td><?=$tAmb?>%</td>
						<td><?=$tRed?>%</td>
					</tr>                    
            </tbody>
        </table>
    </div>
    
</div>

<div class="chartMain" style="display:block;">   
	
    <div id="cntvsCases" style="width:100%;margin: 0 auto;height:400px;"></div>
	
    <div id="casesTbl" style="display:block; width:100%;">
        <table >
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
	<?php           $defutvsGraphca='';
					$vcaWer="vd.v_rlevel='Verified' OR vd.v_rlevel='Satisfactory' OR vd.v_rlevel='Positive Match Found'";
					$tcaVerified = countCases("($vcaWer) AND vd.v_sent");
					$tcaNegative = countCases("vd.v_rlevel='Negative' AND vd.v_sent");
					$tcaDisrpncy = countCases("vd.v_rlevel='Discrepancy' AND vd.v_sent");
					$tcaUabltove = countCases("vd.v_rlevel='Unable to Verify' AND vd.v_sent");
					$tcaInsufint = countCases("vd.v_rlevel='Insufficient' AND vd.v_sent");
					
										
					$dcaGraph="'$COMINF[name]',$tcaVerified,$tcaNegative,$tcaDisrpncy,$tcaUabltove,$tcaInsufint,'Cases'";
					if($defutvsGraphca=='') $defutvsGraphca = $dcaGraph;  ?>
					
					<tr class="shover">
						<td><?=$COMINF['name']?></td>
						<td><?=$tcaVerified?></td>
						<td><?=$tcaNegative?></td>
						<td><?=$tcaDisrpncy?></td>
						<td><?=$tcaUabltove?></td>
						<td><?=$tcaInsufint?></td>
					</tr>                    
            </tbody>
        </table>
    </div>
    
</div>




<script type="text/javascript">	

	function rgaGraph(name,green,red,amber,type){
        var chart;
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'rgaCases',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: name+' Data Visualization [ Cases ]'
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
                name: name+' Data Visualization [ Cases ]',
                data: [
                    {
                        name: 'Green ',
                        y:green,
                        sliced: true,
                        selected: true,						
                        color:'#006600'
                    },
                    {
                        name: 'Amber ',
                        y:amber,
                        color:'#F93'
                    },
                    {
                        name: 'Red ',
                        y:red,
                        color:'#EF3C42'
                    }
                ]
            }]
        });	
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
                text: name+' Data Visualization [ Cases ]'
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
                name: name+' Data Visualization [ Cases ]',
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
        $(document).ready(function() {
                createvsGraph(<?=$defutvsGraphca?>,'Cases');
				rgaGraph(<?=$rgaGraphca?>,'Cases');
        });
    <?php }?>
    </script>



