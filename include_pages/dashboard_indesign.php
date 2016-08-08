<link rel="stylesheet" href="map/style.css" type="text/css">
<script src="map/amcharts.js" type="text/javascript"></script>
<script src="map/serial.js" type="text/javascript"></script>
<script src="map/pie.js" type="text/javascript"></script>
<script src="map/funnel.js"></script>
<script src="map/light.js" type="text/javascript"></script>


<script type="text/javascript">
var chart = AmCharts.makeChart( "Not_Initiated", {
  "type": "serial",
  
  "theme": "light",
  "dataProvider": [ 
 <?php 
 	$vcols = "COUNT(as_id) AS nums ,DATE_FORMAT(as_addate,'%b') AS mmyy, DATE_FORMAT(as_addate,'%m') AS vmonth, DATE_FORMAT(as_addate,'%m-%y') AS addate,DATE_FORMAT(as_addate,'%y') AS vyear ";
	$vtble = "`ver_data` AS vd INNER JOIN `ver_checks` AS vc ON vd.v_id = vc.v_id";
	$volume_data = $db->select($vtble ,$vcols,"vd.com_id=$COMINF[id] AND as_status='Not Assign' AND vc.as_isdlt=0 AND DATE_FORMAT(as_addate,'%y') = ".date('y')." GROUP BY addate ORDER BY vmonth ASC");
	$loopV = '';
	$vdate = '';
	while($v_data = mysql_fetch_assoc($volume_data)){
		
		// $vdate .= "'".$v_data['mmyy']." '" . ",";
		// $loopV .= $v_data['nums'] . ',';
			// $loopV = rtrim($loopV,',');
			// $vdate = rtrim($vdate,',');
?>
		{
		"Month": "<?php echo $v_data['mmyy'] ?>",
		"visits": "<?php echo $v_data['nums'] ?>"
		},	
<?php	
	}
 ?>
  ],
  "valueAxes": [ {
    "gridColor": "#333333",
    "gridAlpha": 0,
    "dashLength": 0
  } ],
  "gridAboveGraphs": false,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0,
    "type": "column",
    "valueField": "visits"
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "Month",
  "categoryAxis": {
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 0
  },
  "export": {
    "enabled": true
  }

} );

var chart = AmCharts.makeChart( "Work_in_Progress", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [ 
  <?php 
 	$vcols = "COUNT(as_id) AS nums ,DATE_FORMAT(as_addate,'%b') AS mmyy, DATE_FORMAT(as_addate,'%m') AS vmonth, DATE_FORMAT(as_addate,'%m-%y') AS addate,DATE_FORMAT(as_addate,'%y') AS vyear ";
	$vtble = "`ver_data` AS vd INNER JOIN `ver_checks` AS vc ON vd.v_id = vc.v_id";
	$volume_data = $db->select($vtble ,$vcols,"vd.com_id=$COMINF[id] AND as_status='Open' AND vc.as_isdlt=0 AND DATE_FORMAT(as_addate,'%y') = ".date('y')." GROUP BY addate ORDER BY vmonth ASC");
	$loopV = '';
	$vdate = '';
	while($v_data = mysql_fetch_assoc($volume_data)){
		
		// $vdate .= "'".$v_data['mmyy']." '" . ",";
		// $loopV .= $v_data['nums'] . ',';
			// $loopV = rtrim($loopV,',');
			// $vdate = rtrim($vdate,',');
?>
		{
		"Month": "<?php echo $v_data['mmyy'] ?>",
		"visits": "<?php echo $v_data['nums'] ?>"
		},	
<?php	
	}
 ?>
  ],
  "valueAxes": [ {
    "gridColor": "#333333",
    "gridAlpha": 0,
    "dashLength": 0
  } ],
  "gridAboveGraphs": false,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0,
    "type": "column",
    "valueField": "visits"
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "Month",
  "categoryAxis": {
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 0
  },
  "export": {
    "enabled": true
  }

} );


var chart = AmCharts.makeChart( "Insuficient", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [
<?php 
 	$vcols = "COUNT(as_id) AS nums ,DATE_FORMAT(as_addate,'%b') AS mmyy, DATE_FORMAT(as_addate,'%m') AS vmonth, DATE_FORMAT(as_addate,'%m-%y') AS addate,DATE_FORMAT(as_addate,'%y') AS vyear ";
	$vtble = "`ver_data` AS vd INNER JOIN `ver_checks` AS vc ON vd.v_id = vc.v_id";
	$volume_data = $db->select($vtble ,$vcols,"vd.com_id=$COMINF[id] AND as_status='problem' AND vc.as_isdlt=0 AND DATE_FORMAT(as_addate,'%y') = ".date('y')." GROUP BY addate ORDER BY vmonth ASC");
	$loopV = '';
	$vdate = '';
	while($v_data = mysql_fetch_assoc($volume_data)){
		
		// $vdate .= "'".$v_data['mmyy']." '" . ",";
		// $loopV .= $v_data['nums'] . ',';
			// $loopV = rtrim($loopV,',');
			// $vdate = rtrim($vdate,',');
?>
		{
		"Month": "<?php echo $v_data['mmyy'] ?>",
		"visits": "<?php echo $v_data['nums'] ?>"
		},	
<?php	
	}
 ?>
  ],
  "valueAxes": [ {
    "gridColor": "#333333",
    "gridAlpha": 0,
    "dashLength": 0
  } ],
  "gridAboveGraphs": false,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0,
    "type": "column",
    "valueField": "visits"
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "Month",
  "categoryAxis": {
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 0
  },
  "export": {
    "enabled": true
  }

} );

var chart = AmCharts.makeChart( "Submitted_to_QC", {
  "type": "serial",
  "theme": "light",
  "dataProvider": [
 <?php 
 	$vcols = "COUNT(as_id) AS nums ,DATE_FORMAT(as_addate,'%b') AS mmyy, DATE_FORMAT(as_addate,'%m') AS vmonth, DATE_FORMAT(as_addate,'%m-%y') AS addate,DATE_FORMAT(as_addate,'%y') AS vyear ";
	$vtble = "`ver_data` AS vd INNER JOIN `ver_checks` AS vc ON vd.v_id = vc.v_id";
	
	$volume_data = $db->select($vtble ,$vcols,"vd.com_id=$COMINF[id] AND vc.as_isdlt=0 AND DATE_FORMAT(as_addate,'%y') = ".date('y')." AND as_qastatus='QA' OR as_qastatus='Rejected' GROUP BY addate ORDER BY vmonth ASC");
	$loopV = '';
	$vdate = '';
	while($v_data = mysql_fetch_assoc($volume_data)){
		
		// $vdate .= "'".$v_data['mmyy']." '" . ",";
		// $loopV .= $v_data['nums'] . ',';
			// $loopV = rtrim($loopV,',');
			// $vdate = rtrim($vdate,',');
?>
		{
		"Month": "<?php echo $v_data['mmyy'] ?>",
		"visits": "<?php echo $v_data['nums'] ?>"
		},	
<?php	
	}
 ?>
  ],
  "valueAxes": [ {
    "gridColor": "#333333",
    "gridAlpha": 0,
    "dashLength": 0
  } ],
  "gridAboveGraphs": false,
  "startDuration": 1,
  "graphs": [ {
    "balloonText": "[[category]]: <b>[[value]]</b>",
    "fillAlphas": 0.8,
    "lineAlpha": 0,
    "type": "column",
    "valueField": "visits"
  } ],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "Month",
  "categoryAxis": {
    "gridPosition": "start",
    "gridAlpha": 0,
    "tickPosition": "start",
    "tickLength": 0
  },
  "export": {
    "enabled": true
  }

} );


var chart = AmCharts.makeChart( "Completed", {
	 <?php 
						$addFilter = ($selFilters['filter_where'])?$selFilters['filter_where']:''; 
						$addFilter_all = str_replace('AND','',$selAll['filter_where']);

						$submitted_checks 		= countChecks($addFilter_all);
						$completed_checks 		= countChecks("as_status='Close' $addFilter");	
						$pending_check  		= $submitted_checks - $completed_checks;
	?>
	
  "type": "pie",
  "outlineThickness": 0,
  "theme": "light",
  "dataProvider": [ {
    "title": "Completed",
    "value": <?php echo $completed_checks;?>
  }, {
    "title": "Pending",
    "value": <?php echo $pending_check ;?>
  } ],
  "colors": [
		"#20c2f3",
		"#808080",
	],
  "titleField": "title",
  "valueField": "value",
  "labelRadius": 5,

  "radius": "42%",
  "innerRadius": "60%",
  "labelText": "[[title]]",
  "export": {
    "enabled": true
  }
} );


<?php 

	$scols = "DATEDIFF(CURDATE(),STR_TO_DATE(vc.as_addate, '%Y-%m-%d')) AS DAYS, STR_TO_DATE(vc.as_addate, '%Y-%m-%d') AS cadd_date";
	$stble = "`ver_checks` AS vc LEFT JOIN `ver_data` AS vd ON vc.v_id = vd.v_id ";
	$sla_data = $db->select($stble ,$scols,"vc.as_status != 'Close' AND com_id = 33 LIMIT 0,10");
	$loopS = '';
	while($v_data = mysql_fetch_assoc($sla_data)){
		
		$sdate = $v_data['cadd_date'];
		$sdays = $v_data['DAYS'];
		$loopS  .= "{ date: $sdate, townName: 'Salt Lake City', townSize : 12, distance: $sdays, sales:20,  alpha:0.4  },";
	}
	$loopS .= rtrim($loopS,',');
?>



var chart = AmCharts.makeChart("my_dash_charttop", {
    "type": "serial",
    "theme": "light",
    "legend": {
        "equalWidths": false,
        "useGraphSettings": true,
        "valueAlign": "left",
        "valueWidth": 120
    },
    "dataProvider": [
	<?php //echo $loopS; ?>
	{
        "date": "2012-01-01",
        "distance": 227,
        "townName": "New York",
        "townName2": "New York",
        "townSize": 25,
        "sales": 408
    }, {
        "date": "2012-01-02",
        "distance": 371,
        "townName": "Washington",
        "townSize": 14,
        "sales": 482
    }, {
        "date": "2012-01-03",
        "distance": 433,
        "townName": "Wilmington",
        "townSize": 6,
        "sales": 562
    }, {
        "date": "2012-01-04",
        "distance": 345,
        "townName": "Jacksonville",
        "townSize": 7,
        "sales": 379
    }, {
        "date": "2012-01-05",
        "distance": 480,
        "townName": "Miami",
        "townName2": "Miami",
        "townSize": 10,
        "sales": 501
    }, {
        "date": "2012-01-06",
        "distance": 386,
        "townName": "Tallahassee",
        "townSize": 7,
        "sales": 443
    }, {
        "date": "2012-01-07",
        "distance": 348,
        "townName": "New Orleans",
        "townSize": 10,
        "sales": 405
    }, {
        "date": "2012-01-08",
        "distance": 238,
        "townName": "Houston",
        "townName2": "Houston",
        "townSize": 16,
        "sales": 309
    }, {
        "date": "2012-01-09",
        "distance": 218,
        "townName": "Dalas",
        "townSize": 17,
        "sales": 287
    }, {
        "date": "2012-03-10",
        "distance": 349,
        "townName": "Oklahoma City",
        "townSize": 11,
        "sales": 485
    }, {
        "date": "2012-01-11",
        "distance": 603,
        "townName": "Kansas City",
        "townSize": 10,
        "duration": 890
    }, {
        "date": "2012-02-12",
        "distance": 534,
        "townName": "Denver",
        "townName2": "Denver",
        "townSize": 18,
        "sales": 810
    }, {
        "date": "2012-01-13",
        "townName": "Salt Lake City",
        "townSize": 12,
        "distance": 425,
        "sales": 670,
        "dashLength": 8,
        "alpha": 0.4
    }
	],
    "valueAxes": [{
        "id": "distanceAxis",
        "axisAlpha": 0,
        "gridAlpha": 0,
        "position": "left",
        "title": "distance"
    }, {
        "id": "durationAxis",
        "duration": "mm",
        "durationUnits": {
            "hh": "h ",
            "mm": "min"
        },
        "axisAlpha": 0,
        "gridAlpha": 0,
        "inside": true,
        "position": "right",
        "title": "sales"
    }],
    "graphs": [{
        "alphaField": "alpha",
        "balloonText": "[[value]] miles",
        "dashLengthField": "dashLength",
        "fillAlphas": 0.7,
        "legendPeriodValueText": "total: [[value.sum]] mi",
        "legendValueText": "[[value]] mi",
        "title": "distance",
        "type": "column",
        "valueField": "distance",
        "valueAxis": "distanceAxis"
    }, {
        "bullet": "square",
        "bulletBorderAlpha": 1,
        "bulletBorderThickness": 1,
        "dashLengthField": "dashLength",
        "legendValueText": "[[value]]",
        "title": "sales",
        "fillAlphas": 0,
        "valueField": "sales",
        "valueAxis": "durationAxis"
    }],
    "chartCursor": {
        "categoryBalloonDateFormat": "DD",
        "cursorAlpha": 0.1,
        "cursorColor":"#000000",
         "fullWidth":true,
        "valueBalloonsEnabled": false,
        "zoomable": false
    },
    "dataDateFormat": "YYYY-MM-DD",
    "categoryField": "date",
    "categoryAxis": {
        "dateFormats": [{
            "period": "DD",
            "format": "DD"
        }, {
            "period": "WW",
            "format": "MMM DD"
        }, {
            "period": "MM",
            "format": "MMM"
        }, {
            "period": "YYYY",
            "format": "YYYY"
        }],
        "parseDates": true,
        "autoGridCount": false,
        "axisColor": "#555555",
        "gridAlpha": 0.1,
        "gridColor": "#FFFFFF",
        "gridCount": 50
    },
    "export": {
    	"enabled": true
     }
});


<?php
$selFilters = getFiltersBy('by_risk','as_cldate');
	$addFilter = ($selFilters['filter_where'])?$selFilters['filter_where']:'';
	
	$where = "as_status='Close'";
	if($_SESSION['user_id']==50 || $_SESSION['user_id']==83){
		$where = "$where AND com_id=20";
	}elseif($LEVEL==4) $where = "$where AND com_id=$COMINF[id]";

	$cols = "(SELECT DATE_FORMAT(as_date, '%b-%y') mnth,COUNT(as_vstatus) cnt,
			IF((as_vstatus='verified' || as_vstatus='satisfactory' || as_vstatus='no match found'
			|| as_vstatus='no record found' || as_vstatus='positive match found'), 'green',
			IF((as_vstatus='negative' || as_vstatus='match found' || as_vstatus='record found'),'red',
			IF((as_vstatus='unable to verify' || as_vstatus='discrepancy'),'amber','na'))) sts,as_date FROM ver_checks inner join ver_data on ver_checks.v_id=ver_data.v_id ";
	$cols ="$cols WHERE  $where AND as_isdlt=0 AND as_date!='0000-00-00 00:00:00' $addFilter  GROUP BY mnth,sts ORDER BY as_date DESC LIMIT 36) DATA";
	//echo $cols;
	$months = $db->select($cols,"*","1=1 ORDER BY as_date");

	$tData = array(); $mData = array();
	while($month = mysql_fetch_assoc($months)){
			if(!isset($tData[$month['mnth']]['red'])){
				$tData[$month['mnth']]['red']   = 0;
				$tData[$month['mnth']]['green'] = 0;
				$tData[$month['mnth']]['amber'] = 0;
				$mData[$month['mnth']] = 0;
			}
			$mData[$month['mnth']]          = $mData[$month['mnth']]+$month['cnt'];
			$tData[$month['mnth']][$month['sts']] = $month['cnt'];	 
	}
	$at=0; foreach($tData as $mon=>$val){ $at+=$val['amber'];}
	$rt=0; foreach($tData as $mon=>$val){ $rt+=$val['red'];}
	$gt=0; foreach($tData as $mon=>$val){ $gt+=$val['green'];}
 ?>
var chart = AmCharts.makeChart("By_Status",
{
    "type": "serial",
	"color": "#FFFFFF",
	"theme": "light",
    "dataProvider": [{
        "name": "No Risk",  
        "points": <?php echo $gt; ?>,
        "color": "#E7C400",
    }, {
        "name": "High Risk",
        "points": <?php echo $rt; ?>,
        "color": "#C90000",
    }, {
        "name": "Potential Risk",
        "points": <?php echo $at; ?>,
        "color": "#0AB596",
    }],
    "valueAxes": [{
        "maximum": <?php echo $submitted_checks ; ?>,
        "minimum": 0,
        "axisAlpha": 0,
        "dashLength": 4,
        "position": "left"
    }],
    "startDuration": 1,
    "graphs": [{
        "balloonText": "<span style='font-size:13px;'>[[category]]: <b>[[value]]</b></span>",
        "bulletOffset": 16,
        "bulletSize": 34,
        "colorField": "color",
        "cornerRadiusTop": 8,
        "customBulletField": "bullet",
        "fillAlphas": 0.8,
        "lineAlpha": 0,
        "type": "column",
        "valueField": "points"
    }],
    "marginTop": 0,
    "marginRight": 0,
    "marginLeft": 0,
    "marginBottom": 0,
    "autoMargins": false,
    "categoryField": "name",
    "categoryAxis": {
        "axisAlpha": 0,
        "gridAlpha": 0,
        "inside": true,
        "tickLength": 0
    },
    "export": {
    	"enabled": true
     }
});

<?php 
	$discrepancy_checks 	= countChecks("as_vstatus='Discrepancy'");
	$need_attention_checks 	= countChecks("as_status='problem'");
	$submitted_checks 		= countChecks();
	$completed_checks 		= countChecks("as_status='Close'");
	$wipchecks   			= ($submitted_checks-$completed_checks);

?>
var chart = AmCharts.makeChart( "By_Status_dash", {
  "type": "funnel",
  "theme": "light",
  "colors": [
		"#35C7F3",
		"#92C02D",
		"#FEA719",
		"#5CA2CF"
	],
  "dataProvider": [ {
    "title": "Completed",
    "value": <?php echo $completed_checks;?>,
  }, {
    "title": "In Progress",
    "value": <?php echo $wipchecks;?>
  }, {
    "title": "Need Attention",
    "value": <?php echo $need_attention_checks;?>
  },{
    "title": "Discrepancy",
    "value": <?php echo $discrepancy_checks;?>
  } ],
  "balloon": {
    "fixedPosition": true
  },
  "valueField": "value",
  "titleField": "title",
  "marginRight": 240,
  "marginLeft": 50,
  "startX": -500,
  "depth3D": 100,
  "angle": 40,
  "outlineAlpha": 0,
  "outlineColor": "#FFFFFF",
  "outlineThickness": 2,
  "labelPosition": "right",
  "balloonText": "[[title]]: [[value]]n[[description]]",
  "export": {
    "enabled": true
  }
} );
jQuery( '.chart-input' ).off().on( 'input change', function() {
  var property = jQuery( this ).data( 'property' );
  var target = chart;
  var value = Number( this.value );
  chart.startDuration = 0;

  if ( property == 'innerRadius' ) {
    value += "%";
  }

  target[ property ] = value;
  chart.validateNow();
} );

</script>



             <section class="widget-group myDashboard">
             
             	
           		
                <div class="my-right-bar">
				<?php 
					$addFilter = ($selFilters['filter_where'])?$selFilters['filter_where']:''; 
						$discrepancy_checks 	= countChecks("as_vstatus='Discrepancy' AND DATE_FORMAT(as_addate,'%y') = ".date('y'));
						$NeedAttension 	= countChecks("as_status='Problem' AND DATE_FORMAT(as_addate,'%y') = ".date('y'));
						$completed_checks 		= countChecks("as_status='Close' $addFilter");
						$open_checks 		= countChecks("as_status='Open' AND DATE_FORMAT(as_addate,'%y') = ".date('y'));
						$nassign_checks 		= countChecks("as_status='Not Assign' AND DATE_FORMAT(as_addate,'%y') = ".date('y'));
						$submited_to_qc_checks 		= countChecks("as_status='Close'  AND DATE_FORMAT(as_addate,'%y') = ".date('y')." AND as_qastatus='QA' OR as_qastatus='Rejected' ");
				
				?>
                	<ul class="charts">
                    	<li>
                        	<div class="txt"><span>Not Initiated</span><?php echo $nassign_checks ;?></div>
                        	<div class="charts" id="Not_Initiated"></div>
                        </li>
                        <li>
                        	<div class="txt"><span>Work in Progress</span><?php echo $open_checks ;?></div>
                        	<div class="charts" id="Work_in_Progress"></div>
                        </li>
                        <li>
                        	<div class="txt"><span>NeedAttension</span><?php echo $NeedAttension;?></div>
                        	<div class="charts" id="Insuficient"></div>
                        </li>
                        <li>
                        	<div class="txt"><span>Submitted to QC</span><?php echo $submited_to_qc_checks ;?></div>
                        	<div class="charts" id="Submitted_to_QC"></div>
                        </li>
                    </ul>
                    
                    <div class="com-charts">
					<?php 
						$addFilter = ($selFilters['filter_where'])?$selFilters['filter_where']:''; 	
						$completed_checks 		= countChecks("as_status='Close' $addFilter");	
					?>
                    	<div class="txt"><span>Completed<br/>Checks</span><?php echo $completed_checks; ?></div>
                    	<div id="Completed"></div>
                    </div>
                    
                    
                    <div class="my-progss">
                        <h4>Recent Cases Progress</h4>
						 <?php
  
							  $twhere="v_status!='Not Assign'";
							  $torder="v_date DESC LIMIT 5";
							  
							  $topcase = client_case_info($twhere,$torder);
							 $i=0;
							   foreach($topcase['data'] as $cases)
							   {
								   ?>
							<div class="my-progss-box">
								  <h5> <?php echo $cases["v_name"]; ?></h5>
								   
								 <?php  
								  $twhere='c.v_id='.$cases['v_id'];
								  
								   $tcheck = client_checks_info($twhere);

								  $color=array("progress-bar", "progress-bar progress-bar-success", "progress-bar progress-bar-info","progress-bar progress-bar-warning","progress-bar progress-bar-danger");
								  
								  
								$tnt = countChecks("vc.v_id=$cases[v_id]");
								$cnt = countChecks("vc.as_status='close' AND vc.v_id=$cases[v_id]");
								$pbr = @($cnt/($tnt))*100;
								if($pbr==0)
								{
									$pbr=5;
								}	   
							 ?>	
                                <div class="progress progress-striped active">
                                    
                                    <div class="<?php echo$color[$i] ?>" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo  round($pbr,0); ?>%;">
                                        <span><?php echo round($pbr,0); ?>%</span>
                                    </div>
                                </div>
                            </div>
			 <?php 
									$i=$i+1;
			 }
			 ?>
			    </div>
               
                    
                    
                     </div>
                     
                     
                
                <div class="my_dash">
                
                	
                    
                	<div class="my_dash_box">
                    
                    <div class="page-section-title2">
                    	<h2 class="box-head">Dashboard</h2>
                    </div>
                    
                    <div class="clearfix"></div>
                    
                    	<div class="my_dash_chart">
                        	<?php /* <div id="my_dash_charttop"></div>	 */?>
							 <?php include("include_pages/volume_graph_inc.php");?>
                		</div>
                        
                        
                        <div class="my_dash_chart_bot">
                        	<div class="my_dash_chart_bot_lft">
                                <div class="page-section-title"><h4><i class="icon-envelope"></i> Messages</h4></div>
                                <div class="my_messages">
                                        <ul class="list-group pending">
                                        <?php $messages = get_messages("com_type='case' AND","LIMIT 4"); 
                                                    if($messages){
                                                        while($message = mysql_fetch_assoc($messages)){
                                                            if(trim($message['uimg'])=='') $message['uimg'] = "images/default.png";?>                            
                                                        <li class="list-group-item" onclick="goto_case(<?=$message['v_id']?>,true)">
                                                            <i><img src="<?=$message['uimg']?>" title="<?="$message[first_name] $message[last_name]"?>"></i>
                                                            <div class="text-holder">
                                                                <span class="title-text"> <?=$message['com_title']?>  </span>
                                                                <span class="description-text"> <?=$message['com_text']?> </span>
                                                            </div>
                                                            <span class="stat-value"><?=time_ago(strtotime($message['com_date']))?></span>
                                                        </li>
                                           <?php 	}
                                                }?>
                                        </ul>
                				</div>
                
                            </div>
                        	<div class="my_dash_chart_bot_ryt">
                            	<div class="page-section-title"><h4><i class="icon-exchange"></i> By Status</h4></div>
                                <div id="By_Status_dash"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        
                        
                        <div class="my_dash_third">
                        	<div class="my_dash_third_left">
                            	
                            	<div class="proton-widget messages">
                                    <div class="panel panel-default back">
                                        <div class="panel-heading">
                                            <i class="icon-cog"></i>
                                            <span>Settings</span>
                                            <div class="toggle-widget-setup" onclick="saveFilter('ready_download',document.getElementById('filter_by_time_ready_download').value,'readyfordownload');">
                                                <i class="icon-ok"></i>
                                                <span>DONE</span>
                                            </div>
                                        </div>
                                        <ul class="list-group">
                                            <?php /* <li class="list-group-item">
                                                <div class="form-group">
                                                    <label>Filter by Checks</label>
                                                    <div>
                                                        <select class="select2">
                                                            <option value="All">All</option>
                                                            <?php $checks = sort_checks_info();
                                                                  while($check = mysql_fetch_assoc($checks)){ ?>
                                                                    <option value="<?=$check['checks_id']?>"><?=$check['checks_title']?></option>  
                                                            <?php
                                                                  }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </li> */
                                            $selFilters = getFiltersBy('ready_download','as_cldate');
                                         
                                            ?>
                                            <li class="list-group-item">
                                                <div class="form-group">
                                                    <label>Filter by Time</label>
                                                    <div>
                                                    <select class="select2" id="filter_by_time_ready_download" name="filter_by_time_ready_download">
                                                    <option value="all">All</option>
                                                    <option value="today" <?php echo ($selFilters['filter_by']=='today')?'selected="selected"':'';?>>Today</option>
                                                    <option value="this_week" <?php echo ($selFilters['filter_by']=='this_week')?'selected="selected"':'';?>>This Week</option>
                                                    <option value="this_month" <?php echo ($selFilters['filter_by']=='this_month')?'selected="selected"':'';?>>This Month</option>
                                                    <option value="this_year" <?php echo ($selFilters['filter_by']=='this_year')?'selected="selected"':'';?>>This Year</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="panel panel-success front">
											<div class="page-section-title"><h4><i class="icon-download-alt"></i> Ready for Download <i class="icon-cog toggle-widget-setup"></i></h4></div>
                                           
                                            <ul class="list-group pending readyfordownload">
                                                <?php
                                            
                                                
                                                $addFilter = ($selFilters['filter_where'])?$selFilters['filter_where']:''; 
                                                //echo $addFilter;
                                                $data = client_checks_info("as_sent=4 AND as_cdnld=0 AND as_status='Close' $addFilter","LIMIT 4");
                                                
                                                if($data){
                                                      while($row = mysql_fetch_assoc($data)){ ?>                            
                                                            <li class="list-group-item" onclick="downloadPDF('pdf.php?pg=case&ascase=<?=$row['as_id']?>')">
                                                                <i><img src="<?=$row['image']?>" alt="<?=$row['v_name']?>"></i>
                                                                <div class="text-holder">
                                                                    <span class="title-text">
                                                                         <?=$row['v_name']?>
                                                                    </span>
                                                                    <span class="description-text">
                                                                       Check: <?=$row['checks_title']?>
                                                                    </span>
                                                                </div>
                                                                <span class="stat-value">
                                                                     <?=time_ago(strtotime($row['as_stdate']))?>
                                                                </span>
                                                            </li>
                                                <?php }
                                                }else { ?>
                                                <li class="list-group-item">No record available !</li>
                                                <?php } ?>
                                            </ul>
                                    </div>
                				</div>
                            </div>
                            
                        	<div class="my_dash_third_center">
                            	<div class="page-section-title"><h4><i class="icon-external-link"></i>  Progress Overview</h4></div>
                                <div id="By_Status"></div>
                            </div>
                            <div class="my_dash_third_right">
                            	<div class="proton-widget messages">
                    <div class="panel panel-default back">
                        <div class="panel-heading">
                            <i class="icon-cog"></i>
                            <span>Settings</span>
                            <div class="toggle-widget-setup" onclick="saveFilter('work_in_progress',document.getElementById('filter_by_time_work_in_progress').value,'work_in_progress');">
                                <i class="icon-ok"></i>
                                <span>DONE</span>
                            </div>
                        </div>
                        <ul class="list-group">
                           <?php /*?> <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Location</label>
                                    <div>
                                        <select class="select2">
                                            <option selected="" value="Any">Any</option>
                                            <option value="Europe">Europe</option>
                                            <option value="Asia">Asia</option>
                                            <option value="North America">North America</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </li><?php */
							
							
                            $selFilters = getFiltersBy('work_in_progress','as_pdate');
						 
							?>
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label>Filter by Time</label>
                                    <div>
                                    <select class="select2" id="filter_by_time_work_in_progress" name="filter_by_time_work_in_progress">
                                    <option value="all">All</option>
                                    <option value="today" <?php echo ($selFilters['filter_by']=='today')?'selected="selected"':'';?>>Today</option>
                                    <option value="this_week" <?php echo ($selFilters['filter_by']=='this_week')?'selected="selected"':'';?>>This Week</option>
                                    <option value="this_month" <?php echo ($selFilters['filter_by']=='this_month')?'selected="selected"':'';?>>This Month</option>
                                    <option value="this_year" <?php echo ($selFilters['filter_by']=='this_year')?'selected="selected"':'';?>>This Year</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="panel panel-success front">
                    	 <div class="page-section-title"><h4><i class="icon-bar-chart"></i> Work in Progress<i class="icon-cog toggle-widget-setup"></i></h4></div>
                            

                            <ul class="list-group pending work_in_progress">
                            	<?php
								$addFilter = ($selFilters['filter_where'])?$selFilters['filter_where']:''; 
								//echo $addFilter;
								$data = client_checks_info("as_status!='close' AND as_sent!=4 AND v_isdlt=0 And c.as_pdate IS NOT NULL $addFilter","LIMIT 4");
								if($data){
									  while($row = mysql_fetch_assoc($data)){ 
									  ?> 
                                            <li class="list-group-item" onclick="goto_case(<?=$row['v_id']?>,false)">
                                            <i><img src="<?=$row['image']?>" alt="<?=$row['v_name']?>"></i>
                                            <div class="text-holder">
                                            <span class="title-text">
                                            	 <?=$row['v_name']?>
                                            </span>
                                            <span class="description-text">
                                            Check: <?=$row['checks_title']?>
                                            </span>
                                            </div>
                                            <span class="stat-value">
                                             <?=time_ago(strtotime($row['as_pdate']))?>
                                            </span>
                                            </li>
                                <?php }
								}else { ?>
								<li class="list-group-item">No record available !</li>
								<?php } ?>
                            </ul>
                    </div>
                </div>
                  <style type="text/css">
				  .cpllogos h2{ text-align:center;}
				  ul.cplLogos{ margin-top:25px;}
				  ul.cplLogos li{ display:inline-block; margin-right:3%;}
				  .cpl_inner {text-align:center; margin-top:32px;}
				  </style>
                  
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="page-section-title2"><div class="cpl_inner"><h2>Our Complaince</h2>
                        <ul class="cplLogos">
                            <li><img src="images/footer-icons/aicpa.png"  title="AICPA" /></li>
                            <li><img src="images/footer-icons/napbs.png"  title="NAPBS" /></li>
                            <li><img src="images/footer-icons/sgcukas.png"  title="ISO" /></li>
                            <li><img src="images/footer-icons/pcidss.png"  title="PCIDSS" /></li>
                            <div class="clearfix"></div>
                        </ul>
                        </div>
                        </div>
                    </div>
                    
                    
                
                </div>
                
                
                
                
                
                
                
                <?php // require("include_pages/progresbar_tk.php"); ?>	

           
            </section>
            <?php // include('include_pages/dash_charts_inc.php'); ?>
            <?php /*?><?php
				// For By Status Chart
				$closecas = countCases("(v_status='Close' AND v_sent=4)");
				$Submitted = countCases();
				$balrt="v_rlevel='negative' OR v_rlevel='match found' OR v_rlevel='record found' OR v_rlevel='unable to verify' OR v_rlevel='discrepancy'";
				$balrt="(($balrt) AND (as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found' OR as_vstatus='unable to verify' OR as_vstatus='discrepancy'))";		
				$discrepancy = countCases("(v_status='Close' AND v_sent=4) AND $balrt");
				$needatten = countCases("(v_status='Close' AND v_sent=4) AND vc.as_status='problem'");
				$wipcas   = ($Submitted-$closecas);	
				
				//For Progress
				$total = countCases("com_id = 33 AND as_isdlt = 0");
				$pending = $total - $closecas;
				$min = $closecas - $pending;
				$div = $min / $pending * 1000; 
				//echo $div;
				
				
				// For By Risk Chart
				$where = "v_status='Close'";
				if($_SESSION['user_id']==50 || $_SESSION['user_id']==83){
					$where = "$where AND com_id=20";
				}elseif($LEVEL==4) $where = "$where AND com_id=$COMINF[id]";
		
				$cols = "(SELECT DATE_FORMAT(v_date, '%b-%y') mnth,COUNT(v_rlevel) cnt,
						IF((v_rlevel='verified' || v_rlevel='satisfactory' || v_rlevel='no match found'
						|| v_rlevel='no record found' || v_rlevel='positive match found'), 'green',
						IF((v_rlevel='negative' || v_rlevel='match found' || v_rlevel='record found'),'red',
						IF((v_rlevel='unable to verify' || v_rlevel='discrepancy'),'amber','na'))) sts,v_date FROM ver_data";
				$cols ="$cols WHERE $where AND v_isdlt=0 GROUP BY mnth,sts ORDER BY v_date DESC LIMIT 36) DATA";
				$months = $db->select($cols,"*","1=1 ORDER BY v_date");
		
				$tData = array(); $mData = array();
				while($month = mysql_fetch_assoc($months)){
						if(!isset($tData[$month['mnth']]['red'])){
							$tData[$month['mnth']]['red']   = 0;
							$tData[$month['mnth']]['green'] = 0;
							$tData[$month['mnth']]['amber'] = 0;
							$mData[$month['mnth']] = 0;
						}
						$mData[$month['mnth']]          = $mData[$month['mnth']]+$month['cnt'];
						$tData[$month['mnth']][$month['sts']] = $month['cnt'];	 
				}
				$at=0; foreach($tData as $mon=>$val){ $at+=$val['amber'];}
				$rt=0; foreach($tData as $mon=>$val){ $rt+=$val['red'];}
				$gt=0; foreach($tData as $mon=>$val){ $gt+=$val['green'];}
 				
			?>
            <script type="text/javascript">
				// For By Status Chart
				var completed 		= <?=$closecas?>;
				var inprogress 		= <?=$wipcas?>;
				var needattention 	= <?=$needatten?>;
				var discrepancy 	= <?=$discrepancy?>;
				// For By Risk Chart
				var amber 		= <?=$at?>;
				var red 		= <?=$rt?>;
				var green 		= <?=$gt?>;
				$(document).ready(function(e) {
					proton.dashboard.drawByStatus(completed,inprogress,needattention,discrepancy);
					proton.dashboard.drawByRisk(amber,red,green);
				});
            </script><?php */?>
			<script type="text/javascript">
			
			function saveFilter(filter_what,filter_by,div_class){
				//alert(id);
				//images/spinners/3.gif
				 $("."+div_class).html('<li><img align="center" src="images/spinners/3.gif" /></li>');
				$.ajax({
	url: "actions.php",
	data:'ePage=add_rating&filter_what='+filter_what+'&filter_by='+filter_by,
	type: "POST",
	success: function(res){
    if(res=='inserted' || res=='updated'){
		
	$.ajax({
	url: "actions.php",
	data:'ePage=filtered_data&filter_what='+filter_what,
	type: "POST",
	success: function(rs){
	
	if(filter_what=='by_risk'){
		var myarr = rs.split(";");
		
		var amber 		= myarr[0];
		var red 		=  myarr[1];
		var green 		= myarr[2];
						
	proton.dashboard.drawByRisk(amber,red,green);

	}else{
	$("."+div_class).html(rs);	
	}	
		
	
	
	}
	
	
	});
	
	
	
	
	
	
		
	}else{
		$("."+div_class).html('');
		alert(res);
		
	}
	},
	error: function(){
    alert('failed to load request');
	}
	
	
	});
				
				
			}
			
			
			
			
			
			
			
			</script>