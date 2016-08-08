			<?php 
			$cntOverlAllOneMonth = str_replace(",","",count_Checks_By_Client($company_id,"DATE(as_addate) BETWEEN '$oneMonth' AND '$today'"));
			$cntClosedOneMonth = str_replace(",","",count_Checks_By_Client($company_id,"as_status='Close' 
								AND as_qastatus!='Rejected' AND DATE(as_addate) BETWEEN '$oneMonth' AND '$today'"));
			
			$Remained = (int) $cntOverlAllOneMonth-$cntClosedOneMonth;
			
			$RemainedPer = getPercentage($cntOverlAllOneMonth,$cntClosedOneMonth);
			?>
			<p class="value">
				<a href="<?php echo SURL;?>?action=advance&atype=search&from_dt=<?php echo  $oneMonth;?>&to_dt=<?php echo  $today;?>&search_status=1&client_id[]=<?php echo  $company_id;?>&check_status=open_dash" ><?php echo $Remained;?></a> <span> / <?php echo $cntOverlAllOneMonth;?></span>
	        </p>
	    
			<p class="description">
				<strong>To Be Completed</strong>
									 <span><a href="<?php echo SURL;?>?action=advance&atype=search&from_dt=<?php echo  $oneMonth;?>&to_dt=<?php echo  $today;?>&search_status=1&client_id[]=<?php echo  $company_id;?>&check_status=open_dash" ><?php echo $Remained;?></a></span> checks to be complete
									 out of all <span><a href="<?php echo $oneMonthUrl;?>"><?php echo $cntOverlAllOneMonth;?></a></span> total checks within <span>one month</span>.
							</p>
			<div class="bar">
            <span><?php echo $RemainedPer;?>%</span>
				<div style="width:<?php echo $RemainedPer;?>%" class="progress"></div>
			</div>
