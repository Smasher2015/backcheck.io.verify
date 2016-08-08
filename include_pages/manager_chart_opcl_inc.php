<?php 

		if(isset($_POST['sdate']) && isset($_POST['edate'])){

			$sdate=changDate($_POST['sdate']);

			$edate=changDate($_POST['edate'],1);
			
			if(is_numeric($_POST['com_select'])){
				$betw=" AND v_date between '$sdate' and '$edate' and com_id=".$_POST['com_select'];
			}else{
				$betw=" AND v_date between '$sdate' and '$edate'";
			}

		}else $betw='';

		$Submitted =  countCases("1=1 $betw");

		$closecas =   countCases("v_status='Close' $betw");

		$downloaded = countCases("v_status='Close' AND v_cdnld=1 $betw");

		$needatten =  countCases("vc.as_status='problem' $betw");

		$wipcas   =   ($Submitted-$closecas);	

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

                <th>Completed</th>

                <th>Downloaded</th>

                <th>Need Attention</th>

            </tr>

        </thead>

        <tbody>

            <tr class="shover">

                <th >Cases</th>

                <td ><?=$Submitted?></td>

                <td ><?=$wipcas?></td>

                <td ><?=$closecas?></td>

                <td ><?=$downloaded?></td>

                <td ><?=$needatten?></td>

            </tr>                

        </tbody>

    </table>

</div>



<script src="<?php echo SURL; ?>js/js_charts.js"></script>

<script type="text/javascript">

		CreateBarChart('datacases','Cases','cntCases');

</script>