<div class="chartMain" style="display:block;">   
	<div id="caDv" style="display:block;">
    	<div id="cntCases" style="width:100%;margin: 0 auto;height:400px;"></div>
	</div>
	<?php 

	?> 

    <table id="datacases">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th>History</th>
                <th>Ready </th>  
                <th>Downloaded </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th >Case(s)</th>
                <td ><?=$closecas?></td>
                <td ><?=$redyecas?></td>
                <td ><?=($closecas-$redyecas)?></td>
            </tr>                
        </tbody>
    </table>
    

</div>

<script src="<?php echo SURL; ?>js/js_charts.js"></script>

<script type="text/javascript">

	$(document).ready(function() {			
		CreateBarChart('datacases','Case(s)','cntCases');
	});
		
	
</script>


