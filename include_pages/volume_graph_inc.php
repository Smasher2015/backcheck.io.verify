    <?php 
 
 
 	$vcols = "COUNT(as_id) AS nums ,DATE_FORMAT(as_addate,'%b-%y') AS mmyy, DATE_FORMAT(as_addate,'%m') AS vmonth, DATE_FORMAT(as_addate,'%m-%y') AS addate,DATE_FORMAT(as_addate,'%y') AS vyear ";
	$vtble = "`ver_data` AS vd INNER JOIN `ver_checks` AS vc ON vd.v_id = vc.v_id";
	$volume_data = $db->select($vtble ,$vcols,"vd.com_id=$COMINF[id] AND DATE_FORMAT(as_addate,'%y') = 15 GROUP BY addate ORDER BY vmonth ASC");
	$loopV = '';
	$vdate = '';
	while($v_data = mysql_fetch_assoc($volume_data)){
		
		$vdate .= "'".$v_data['mmyy']." '" . ",";
		$loopV .= $v_data['nums'] . ',';
			//echo $vcount . ',';

	}
	$loopV = rtrim($loopV,',');
	$vdate = rtrim($vdate,',');
	//print_r($loopV);
	//print_r($vdate);die;
 
 ?>   
   
    <script type="text/javascript">
    
    
    $(function () {
    $('#container_vo').highcharts({
		credits: {
      		enabled: false
	  	},
        title: {
            text: '',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: [<?php echo $vdate;?>]
        },
        yAxis: {
            title: {
                text: 'Monthly Volume'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' Check(s)'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0,
			enabled : false,
        },
        series: [
		{
            name: 'This Month',
            data: [<?php echo $loopV;?>]
        }
		]
    });
});
    
    </script>
    <div id="container_vo" style="min-width: 280px; height: 250px; margin: 0 auto"></div>