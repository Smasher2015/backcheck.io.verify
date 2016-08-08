 <div class="chartMain">
	<script type="text/javascript">
    
        Highcharts.visualize = function(table, options) {
            // the categories
            options.xAxis.categories = [];
            $('tbody th', table).each( function(i) {
                options.xAxis.categories.push(this.innerHTML);
            });
            
            // the data series
            options.series = [];
            $('tr', table).each( function(i) {
                var tr = this;
                $('th, td', tr).each( function(j) {
                    if (j > 0) { // skip first column
                        if (i == 0) { // get the name and init the series
                            options.series[j - 1] = { 
                                name: this.innerHTML,
                                data: []
                            };
                        } else { // add values
                            options.series[j - 1].data.push(parseFloat(this.innerHTML));
                        }
                    }
                });
            });
            
            var chart = new Highcharts.Chart(options);
        }
            
        // On document ready, call visualize on the datatable.
        $(document).ready(function() {			
            var table = document.getElementById('dataChecks'),
            options = {
                   chart: {
                      renderTo: 'cntChecks',
                      defaultSeriesType: 'column'
                   },
                   title: {
                      text: 'Statistics Graph [ Check(s) ]'
                   },
                   xAxis: {
                   },
                   yAxis: {
                      title: {
                         text: 'Check(s)'
                      }
                   },
                   tooltip: {
                      formatter: function() {
                         return '<b>'+ this.series.name +'</b><br/>'+
                            this.y +' '+ this.x.toLowerCase();
                      }
                   }
                };
            
                                
            Highcharts.visualize(table, options);
        });
            
    </script>
		
	<div id="cntChecks" style="width:100%; height: 400px; margin: 0 auto"></div>
		
    <table  id="dataChecks">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <?php if($LEVEL==2 || $LEVEL==5 || $LEVEL==1){?>
                	<th>Not Assign</th>
                <?php } ?>
                <th>Assigned</th>
                <th>Pending</th>
                <th>Completed</th>  
                <th>Sent [ Admin ]</th>
                <th>Sent [ Client ]</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if($LEVEL==2 || $LEVEL==5 || $LEVEL==1){
			$nAsg  = countChecks("as_status='Not Assign'",false);
		}
            $asgn  = countChecks("(as_status='Open' OR as_status='Close' OR as_status='Problem')");
            $close = countChecks("as_status='Close'");
            $pendg = ($asgn-$close);
            $adSent= countChecks("as_sent=1");
            $clSent= countChecks("as_sent=4");
        ?>
                <tr><th >Check(s)</th>
                <?php if($LEVEL==2 || $LEVEL==5  || $LEVEL==1){?>    
                    <td ><?php echo $nAsg; ?></td>
               	<?php } ?>
                    <td ><?php echo $asgn; ?></td>
                    <td ><?php echo $pendg; ?></td>
                    <td ><?php echo $close; ?></td>
                    <td ><?php echo $adSent; ?></td>
                    <td ><?php echo $clSent; ?></td>         
                </tr>
        </tbody>
    </table>

</div>

