<?php
		$where = "v_status='Close'";
		if($_SESSION['user_id']==50 || $_SESSION['user_id']==83){
			$where = "$where AND com_id=20";
		}
		elseif($LEVEL==4) $where = "$where AND com_id=$COMINF[id]";

		$cols = "(SELECT DATE_FORMAT(v_date, '%b-%y') mnth,COUNT(v_rlevel) cnt,
				IF((v_rlevel='verified' || v_rlevel='satisfactory' || v_rlevel='no match found'
				|| v_rlevel='no record found' || v_rlevel='positive match found'), 'green',
				IF((v_rlevel='negative' || v_rlevel='match found' || v_rlevel='record found'),'red',
				IF((v_rlevel='unable to verify' || v_rlevel='discrepancy'),'amber','na'))) sts,v_date FROM ver_data";
		$cols ="$cols WHERE $where AND v_isdlt=0 GROUP BY mnth,sts ORDER BY v_date DESC LIMIT 12) DATA";
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

       
      
        
                <div class="section">
                    <div id="container_risk" style="min-width: 310px; height: 250px; margin: 0 auto"></div>
        </div>
    

<script type="text/javascript">
		

$(function () {
    $('#container_risk').highcharts({
        chart: {
            type: 'areaspline'
        },
        title: {
            text: ''
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 150,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        xAxis: {
            categories: [
               <?php foreach($tData as $mon=>$val){ echo (($t)?',':'')."'$mon'"; $t=true;}?>
            ],
            plotBands: [{ // visualize the weekend
                from: 4.5,
                to: 6.5,
                color: ''
            }]
        },
        yAxis: {
            title: {
                text: 'Number of checks'
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: ' Checks'
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            areaspline: {
                fillOpacity: 0.5
            }
        },
        series: [{
            name: 'Potential Risk',
            data: [<?php $at=0;$n=0; foreach($tData as $mon=>$val){ echo (($n>0)?',':'')."$val[amber]"; $at+=$val['amber'];$n+=1;}?>],
				color:'#F93'
        }, {
            name: 'High Risk',
            data: [<?php $rt=0;$n=0; foreach($tData as $mon=>$val){ echo (($n>0)?',':'')."$val[red]"; $rt+=$val['red'];$n+=1;}?>],
				color:'#EF3C42'
        },{
            name: 'No Risk',
            data: [<?php $gt=0;$n=0; foreach($tData as $mon=>$val){ echo (($n>0)?',':'')."$val[green]"; $gt+=$val['green'];$n+=1;}?>],
				color:'#006600'
        }]
    });
});
</script>
