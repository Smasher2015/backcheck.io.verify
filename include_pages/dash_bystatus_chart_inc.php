<script type="text/javascript">
		
				$(function () {
    Highcharts.data({
        csv: document.getElementById('tsv').innerHTML,
        itemDelimiter: '\t',
        parsed: function (columns) {

            var brands = {},
                brandsData = [],
                versions = {},
                drilldownSeries = [];

            // Parse percentage strings
            columns[1] = $.map(columns[1], function (value) {
                if (value.indexOf('%') === value.length - 1) {
                    value = parseInt(value);
                }
                return value;
            });

            $.each(columns[0], function (i, name) {
                var brand,
                    version;

                if (i > 0) {
					
                    // Remove special edition notes
                    name = name.split(' -')[0];

                    // Split into brand and version
                    version = name.match(/([0-9]+[\.0-9x]*)/);
                    if (version) {
                        version = version[0];
                    }
                    brand = name.replace(version, '');
					
                    // Create the main data
                    if (!brands[brand]) {
                        brands[brand] = columns[1][i];
                    } else {
                        brands[brand] += columns[1][i];
                    }

                    // Create the version data
                    if (version !== null) {
                        if (!versions[brand]) {
                            versions[brand] = [];
                        }
                        versions[brand].push(['v' + version, columns[1][i]]);
                    }
					
                }

            });

            $.each(brands, function (name, y) {
                brandsData.push({
                    name: name,
                    y: y,
                    drilldown: versions[name] ? name : null
                });
            });
            $.each(versions, function (key, value) {
                drilldownSeries.push({
                    name: key,
                    id: key,
                    data:  parseInt(value)

					
                });
            });

            // Create the chart
            $('#container_st').highcharts({
				credits: {
      				enabled: false
	  			},
                chart: {
                    type: 'column'
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
					allowDecimals: false,
                    type: 'category'
                },
                yAxis: {
					allowDecimals: false,
                    title: {
                        text: ''
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        }
                    }
                },
				colors: [
					'#0097A7',
					'#388E3C',
					'#F57C00',
					'#D32F2F'
				],

                tooltip: {
                    headerFormat: '<span style="font-size:11px"><b>{point.y:.0f}</b> {series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>'
                },

                series: [{
					
                    name: 'Check(s)',
                    colorByPoint: true,
                    data: brandsData
                }],
                drilldown: {
                    series: drilldownSeries
                }
            });
        }
    });
});


</script>

<div id="container_st"  style="min-width: 250px; height: 215px; margin: 0 auto"></div>
									<pre id="tsv" class="container_st" style="display:none"><!--Browser Version	Total Market Share-->
<?php 

	$selFilters = getFiltersBy('by_status','as_addate',$company_id);
	$selClose = getFiltersBy('by_status','as_cldate',$company_id);
	$addFilter = ($selFilters['filter_where'])?$selFilters['filter_where']:'';
	$addClose = ($selClose['filter_where'])?$selClose['filter_where']:'';
	$addFilter_all = str_replace('','',$addFilter);
	// For By Status Chart Checks
	$discrepancy_checks 	= countChecks("as_vstatus='Discrepancy' $addFilter $comWhere");
	$need_attention_checks 	= countChecks("as_status='problem' $addFilter $comWhere");
	$submitted_checks 		= countChecks("1=1 $addFilter $comWhere");
	$completed_checks 		= countChecks("as_status='Close' $addClose $comWhere" );
	$wipchecks   			= ($submitted_checks-$completed_checks);	

?>

Completed 	<?php echo $completed_checks; ?>%
In Progress 	<?php echo $wipchecks; ?>%
Need Attention 	<?php echo $need_attention_checks; ?>%
Discrepancy 	<?php echo $discrepancy_checks; ?>%
</pre>