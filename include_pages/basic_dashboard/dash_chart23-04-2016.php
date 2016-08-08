<?php 
		
		$cols = "(SELECT DATE_FORMAT(as_addate, '%b-%Y') mnth,COUNT(as_status) cnt, IF((as_status='Open' AND as_vstatus!='Not Initiated'), 'open', IF((as_status='Close'),'close', IF((as_status='Open' AND as_vstatus='Not Initiated'),'new','na'))) sts,as_addate 
		FROM ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id 
		WHERE com_id=$company_id AND as_isdlt=0 AND v_isdlt=0  $dateRange $location_users GROUP BY mnth,sts ORDER BY as_addate DESC LIMIT 12)DATA ";
		
		
		
		//echo "select * from $cols where 1=1 ORDER BY as_addate";
		$months = $db->select($cols,"*","1=1 ORDER BY as_addate");

		$tData = array(); $mData = array();
		while($month = mysql_fetch_assoc($months)){
				if(!isset($tData[$month['mnth']]['open'])){
					$tData[$month['mnth']]['open']   = 0;
					$tData[$month['mnth']]['close'] = 0;
					$tData[$month['mnth']]['new'] = 0;
					$mData[$month['mnth']] = 0;
				}
				$mData[$month['mnth']]  = $mData[$month['mnth']]+$month['cnt'];
				$tData[$month['mnth']][$month['sts']] = $month['cnt'];	 
		}
		
?>
 <script type="text/javascript">
$(function() {
	
 require.config({
        paths: {
            echarts: 'dashboard/assets/js/plugins/visualization/echarts'
        }
    });


    // Configuration
    // ------------------------------

    require(
        [
            'echarts',
            'echarts/theme/limitless',
			'echarts/chart/bar',
            'echarts/chart/line'
        ],
 // Charts setup
        function (ec, limitless) {



			 var basic_area = ec.init(document.getElementById('basic_area'), limitless);
			 
			 
			 
			 
			   //
            // Basic area options
            //

            basic_area_options = {

                // Setup grid
                grid: {
                    x: 40,
                    x2: 20,
                    y: 35,
                    y2: 25
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis'
                },

                // Add legend
                legend: {
                    data: ['New Checks','In progress','Closed Checks']
                },


                // Enable drag recalculate
                calculable: true,

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    data: [
                        <?php foreach($tData as $mon=>$val){ echo (($t)?',':'')."'$mon'"; $t=true;}?>
                    ]
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value'
                }],

                // Add series
                series: [
					{
                        name: 'New Checks',
                        type: 'line',
                        smooth: true,
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [<?php $gt=0;$n=0; foreach($tData as $mon=>$val){ echo (($n>0)?',':'')."$val[new]"; $gt+=$val['new'];$n+=1;}?>]
                    },
					{
                        name: 'In progress',
                        type: 'line',
                        smooth: true,
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [<?php $rt=0;$n=0; foreach($tData as $mon=>$val){ echo (($n>0)?',':'')."$val[open]"; $rt+=$val['open'];$n+=1;}?>]
                    },
                    {
                        name: 'Closed Checks',
                        type: 'line',
                        smooth: true,
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [<?php $at=0;$n=0; foreach($tData as $mon=>$val){ echo (($n>0)?',':'')."$val[close]"; $at+=$val['close'];$n+=1;}?>]
                    }
                   
                   
                ]
            };
 basic_area.setOption(basic_area_options);
 
 
            window.onresize = function () {
                setTimeout(function () {
                    basic_lines.resize();
                   
                    basic_area.resize();
                   
                }, 200);
            }

		  }
    );
});
	
	 
		
		
			
</script>