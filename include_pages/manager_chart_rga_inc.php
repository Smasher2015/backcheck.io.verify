<section class="retracted scrollable">
<div class="row">

<div class="col-md-12">
 <div class="manager-report-sec">
         <div class="page-section-title">
        <h2 class="box_head"><?=$PTITLE?></h2>
        </div>
       <div class="panel panel-default panel-block"> 
<div class="list-group">
            <div class="list-group-item">
                <div class="section">
                
                    
                    <div id="rgaCases" style="width:100%;margin: 0 auto;height:400px;"></div>
                    
                    <div id="rgaTbl" style="display:block; width:100%;">
                        <table class="display static" >
                            <thead>
                                <tr>
                                    <th>Green</th>
                                    <th>Amber</th> 
                                    <th>Red</th>  
                                </tr>
                            </thead>
                            <tbody>
                            
                    <?php  	$rgaGraphca='';
							$chk="";
							if(isset($_POST['sdate']) && isset($_POST['edate'])){
								$col="vd.v_rlevel";
								$sdate=changDate($_POST['sdate']);
								$edate=changDate($_POST['edate'],1);
								$chk=" AND vd.v_date between '$sdate' and '$edate' and com_id=".$_POST['com_select'];
							}
							echo $_REQUEST['com_check'];
							if(is_numeric($_REQUEST['com_check'])){
								$chk="AND vc.checks_id=$_REQUEST[com_check]";
								$col="vc.as_vstatus";
								$cktitl=$db->select("checks","checks_title","checks_id=$_REQUEST[com_check]");
								$cktitl=mysql_fetch_assoc($cktitl); $cktitl = $cktitl['checks_title'];	
							}else{
								$col="vd.v_rlevel";
								 $cktitl='Cases';
							}
							                                 
                                    $tGrn = countCases("($col='verified' OR $col='satisfactory' OR $col='no match found' OR $col='no record found' OR $col='positive match found') $chk");
                                    $tRed = countCases("($col='negative' OR $col='match found' OR $col='record found') $chk");
                                    $tAmb = countCases("($col='unable to verify' OR $col='discrepancy') $chk");
                                    $totl = $tGrn+$tRed+$tAmb;
                                    $tGrn=  @round(($tGrn/$totl)*100,2);
                                    $tRed=  @round(($tRed/$totl)*100,2);
                                    $tAmb=	@round(($tAmb/$totl)*100,2);								
                                    $dcaGraph="'',$tGrn,$tRed,$tAmb";
                                    if($rgaGraphca=='') $rgaGraphca = $dcaGraph;?>
                                    <tr >
                                        <td><?=$tGrn?>%</td>
                                        <td><?=$tAmb?>%</td>
                                        <td><?=$tRed?>%</td>
                                    </tr>                    
                            </tbody>
                        </table>
                    </div>

				<script type="text/javascript">	
                    function rgaGraph(name,green,red,amber){
                        var chart;
                        chart = new Highcharts.Chart({
                            chart: {
                                renderTo: 'rgaCases',
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false
                            },
                            title: {
                                text: name+' Data Visualization [ <?=$cktitl?> ]'
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
                                name: name+' Data Visualization [ <?=$cktitl?> ]',
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
                    rgaGraph(<?=$rgaGraphca?>);
                </script>
                 </div>
       		</div>
            </div>
            </div>
    </div>
</div>
</div>
</section>