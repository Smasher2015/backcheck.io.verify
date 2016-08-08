<div id="cpsCases" style="width:100%;margin: 0 auto;height:300px;"></div>
<?php
$trdy = countCases("(v_sent=4 OR v_sent=2) AND v_status='close' AND v_cdnld=0");
$tdld = countCases("(v_sent=4 OR v_sent=2) AND v_status='close' AND v_cdnld=1");
?>
<script type="text/javascript">	

	var chart;
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'cpsCases',
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false
		},
		title: {
			text: ''
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.point.name +'</b>: '+ this.y ;
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
						return '<b>'+ this.point.name +'</b>: '+ this.y;
					}
				}
			}
		},
		series: [{
			type: 'pie',
			name: '',
			data: [
				{
					name: 'Ready for Download',
					y:<?=$trdy?>,
					sliced: true,
					selected: true,						
				},
				{
					name: 'Downloaded',
					y:<?=$tdld?>,
				}
			],
			showInLegend: true,
			dataLabels: {
					enabled: false
				}
		}]
	});	
</script>