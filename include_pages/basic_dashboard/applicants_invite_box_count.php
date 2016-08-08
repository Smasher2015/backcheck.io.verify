		<?php 
		 $applicans = count(getApplicants($company_id));
		 $pending_applicans = count(getApplicants($company_id,"is_responed=0"));
		 $Remained = (int) $applicans-$pending_applicans;
		 $RemainedPer = getPercentage($applicans,$Remained);
		 ?>
			<p class="value">
				<a href="?action=invited&atype=applicants&is_responed=0"><?php echo $pending_applicans;?></a> <span> / <?php echo $applicans;?></span>
	        </p>
	    
			<p class="description">
				<strong>Applicants Invite / Join</strong>
									Your <span><a href="?action=invited&atype=applicants&is_responed=0"><?php echo $pending_applicans;?></a></span> Pending applicants to join out of all <span><a href="?action=invited&atype=applicants"><?php echo $applicans;?></a></span> total applicants.
							</p>
			
						
			<div class="bar">
            <span><?php echo $RemainedPer;?>%</span>
				<div style="width:<?php echo $RemainedPer;?>%" class="progress"></div>
			</div>