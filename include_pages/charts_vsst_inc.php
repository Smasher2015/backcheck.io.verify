<?php
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
?>

<section class="retracted scrollable">
  <div class="row">
    <div class="col-md-12">
      <div class="manager-report-sec">
        <div class="page-section-title">
          <h2 class="box_head">Month on Month Cases Status</h2>
        </div>
        <div class="panel panel-default panel-block">
          <div class="list-group">
            <div class="list-group-item">
              <div class="section">
                <div style="height:410px; margin: 0 2em; clear:both;min-width:600px" class="highcharts-container" id="container-ch"> 
                  <script type="text/javascript">
                    Highcharts.theme = { colors: ['#4572A7'] };// prevent errors in default theme
                    var highchartsOptions = Highcharts.getOptions(); 
                    </script> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
		var chart;
		chart = new Highcharts.Chart({
			chart: {
				renderTo: 'container-ch'
			},
			title: {
				text: 'Month on Month Cases Status'
			},			
			xAxis: {
				categories: [<?php foreach($tData as $mon=>$val){ echo (($t)?',':'')."'$mon'"; $t=true;}?>]
			},
			yAxis: {
						title: {
							text: 'Month On Month Cases Status'
						}
					},			
			tooltip: {
				formatter: function() {
					var s;
					if (this.point.name) { // the pie chart
						s = ''+
							this.point.name +': '+ this.y +' Cases';
					} else {
						s = ''+
							this.x  +': '+ this.y + ' Cases';
					}
					return s;
				}
			},
			labels: {
				items: [{
					html: 'Over All Status',
					style: {
						left: '40px',
						top: '8px',
						color: 'black'				
					}
				}]
			},
			series: [
				
			{
				type: 'column',
				name: 'Amber',
				data: [<?php $at=0;$n=0; foreach($tData as $mon=>$val){ echo (($n>0)?',':'')."$val[amber]"; $at+=$val['amber'];$n+=1;}?>],
				color:'#F93'
			}, {
				type: 'column',
				name: 'Red',
				data: [<?php $rt=0;$n=0; foreach($tData as $mon=>$val){ echo (($n>0)?',':'')."$val[red]"; $rt+=$val['red'];$n+=1;}?>],
				color:'#EF3C42'
			}, {
				type: 'column',
				name: 'Green',
				data: [<?php $gt=0;$n=0; foreach($tData as $mon=>$val){ echo (($n>0)?',':'')."$val[green]"; $gt+=$val['green'];$n+=1;}?>],
				color:'#006600'
			}, {
				type:'spline',
				name:'Total',
				data:[<?php foreach($mData as $val){ echo (($mt)?',':'')."$val"; $mt=true;}?>]
			}, {
				type: 'pie',
				name: 'Over All',
				data: [{
					name: 'Amber',
					y: <?=$at?>,
					color:'#F93'
				}, {
					name: 'Red',
					y: <?=$rt?>,
					color:'#EF3C42'
				}, {
					name: 'Green',
					y: <?=$gt?>,
					color:'#006600'
				}],
				center: [100, 80],
				size: 100,
				showInLegend: false,
				dataLabels: {
					enabled: false
				}
			}]
		});
</script> 
