<?php 
	
		$closecas = countCases("(v_status='Close' AND v_sent=4)");
		$Submitted = countCases();
		$balrt="v_rlevel='negative' OR v_rlevel='match found' OR v_rlevel='record found' OR v_rlevel='unable to verify' OR v_rlevel='discrepancy'";
		$balrt="(($balrt) AND (as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found' OR as_vstatus='unable to verify' OR as_vstatus='discrepancy'))";		
		$discrepancy = countCases("(v_status='Close' AND v_sent=4) AND $balrt");
		$needatten = countCases("(v_status='Close' AND v_sent=4) AND vc.as_status='problem'");
		$wipcas   = ($Submitted-$closecas);	
?> 

<div id="cntCases" style="width:100%;margin: 0 auto;height:300px;"></div>

<table id="datacases" style="display:none;">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Completed</th>
            <th>In Progress</th>  
            <th>Need Attention</th>
            <th>Discrepancy</th>
            
        </tr>
    </thead>
    <tbody>
        <tr class="shover">
            <th >Cases</th>
            <td ><?=$closecas?></td>
            <td ><?=$wipcas?></td>
            <td ><?=$needatten?></td>
            <td ><?=$discrepancy?></td>
            
        </tr>                
    </tbody>
</table>

<script src="<?php echo SURL; ?>js/js_charts.js"></script>

<script type="text/javascript">
        CreateBarChart('datacases','Cases','cntCases');
</script>