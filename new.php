<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Highcharts Demo Gallery</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<!--  meta http-equiv="X-UA-Compatible" content="chrome=1" -->

<link href="../favicon.ico" rel="shortcut icon">


<script src="js/jquery.min.js" type="text/javascript"></script>


<script type="text/javascript">
	jQuery.noConflict();
</script>

<script src="js/highcharts.js" type="text/javascript"></script>
<script src="js/exporting.js" type="text/javascript"></script>

<script type="text/javascript">
	Highcharts.theme = { colors: ['#4572A7'] };// prevent errors in default theme
	var highchartsOptions = Highcharts.getOptions(); 
</script>




<script type="text/javascript">

		var chart;
		jQuery(document).ready(function() {
			chart = new Highcharts.Chart({
				chart: {
					renderTo: 'container'
				},
				title: {
					text: 'Combination chart'
				},
				xAxis: {
					categories: ['Apples', 'Oranges', 'Pears', 'Bananas', 'Plums']
				},
				tooltip: {
					formatter: function() {
						var s;
						if (this.point.name) { // the pie chart
							s = ''+
								this.point.name +': '+ this.y +' fruits';
						} else {
							s = ''+
								this.x  +': '+ this.y;
						}
						return s;
					}
				},
				labels: {
					items: [{
						html: 'Total fruit consumption',
						style: {
							left: '40px',
							top: '8px',
							color: 'black'				
						}
					}]
				},
				series: [{
					type: 'column',
					name: 'Jane',
					data: [3, 2, 1, 3, 4]
				}, {
					type: 'column',
					name: 'John',
					data: [2, 3, 5, 7, 6]
				}, {
					type: 'column',
					name: 'Joe',
					data: [4, 3, 3, 9, 0]
				}, {
					type: 'spline',
					name: 'Average',
					data: [3, 2.67, 3, 6.33, 3.33]
				}, {
					type: 'pie',
					name: 'Total consumption',
					data: [{
						name: 'Jane',
						y: 13,
						color: highchartsOptions.colors[0] // Jane's color
					}, {
						name: 'John',
						y: 23,
						color: highchartsOptions.colors[1] // John's color
					}, {
						name: 'Joe',
						y: 19,
						color: highchartsOptions.colors[2] // Joe's color
					}],
					center: [100, 80],
					size: 100,
					showInLegend: false,
					dataLabels: {
						enabled: false
					}
				}]
			});
			
			
		});
	</script>


</head>

<body>

<div style="height:410px; margin: 0 2em; clear:both;min-width:600px" class="highcharts-container" id="container">
</div>



</body>
</html>