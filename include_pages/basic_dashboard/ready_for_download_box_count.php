			<p class="value">
				<a href="<?php echo SURL;?>?action=advance&atype=search&from_dt=<?php echo  $oneMonth;?>&to_dt=<?php echo  $today;?>&search_status=1&client_id[]=<?php echo  $company_id;?>&check_status=close_dash" ><?php echo $cntClosedOneMonth;?></a> <span> / <?php echo $cntOverlAllOneMonth;?></span>
	        </p>
	    
			<p class="description">
				<strong>Completed Checks</strong>
									You have <span><a href="<?php echo SURL;?>?action=advance&atype=search&from_dt=<?php echo  $oneMonth;?>&to_dt=<?php echo  $today;?>&search_status=1&client_id[]=<?php echo  $company_id;?>&check_status=close_dash" ><?php echo $cntClosedOneMonth;?></a></span> completed checks out of all <span><a href="<?php echo $oneMonthUrl;?>"><?php echo $cntOverlAllOneMonth;?></a></span> total checks within <span>one month</span>.
							</p>
						
			<div class="bar others">
				<span><?php echo $RemainedPer;?>%</span>
                <div style="width:<?php echo $RemainedPer;?>%" class="progress"></div>
			</div>