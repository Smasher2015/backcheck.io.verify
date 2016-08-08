<?php 
	include("include_pages/checks_counter_inc.php");
?> 

<div class="chartMain" style="display:block;">   
	<div id="caDv" style="display:block;">
    	<div id="cntCases" style="width:100%;margin: 0 auto;height:400px;"></div>
	</div>
    <table id="datacases" style="display:none;">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th>Submitted</th>
                <th>In Progress</th> 
                <th>Not Yet Started</th> 
                <th>Completed</th>
                <th>Downloaded</th>
                <th>Need Attention</th>
            </tr>
        </thead>
        <tbody>
            <tr class="shover">
                <th >Cases</th>
                <td ><?=($closecas+$redyecas+$wipcas)?></td>
                <td ><?=$wipcas?></td>
                 <td ><?=20?></td>
                <td ><?=$redyecas?></td>
                <td ><?=$closecas?></td>
                <td ><?=15?></td>
            </tr>                
        </tbody>
    </table>
</div>
<script src="<?php echo SURL; ?>js/js_charts.js"></script>

<script type="text/javascript">

	$(document).ready(function() {			
		CreateBarChart('datacases','Cases','cntCases');
	});
		
	
</script>


