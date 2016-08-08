		<?php // Pending Actions box count 
		  
		  //$allOpenChecks = count(getAllOpenChecks("com_id='$company_id'"));
		  $allOpenChecks = str_replace(",","",count_Checks_By_Client($company_id,"DATE(as_addate) BETWEEN '$oneMonth' AND '$today'"));
		 
		  $cntInsuff = countInsuffDocsByClient($company_id);
		   //var_dump($cntInsuff);
		  $Remained = (int) $allOpenChecks-$cntInsuff;
		  $RemainedPer = getPercentage($allOpenChecks,$Remained);
		  ?>
			<p class="value">
				<a href="?action=insufficient&atype=list"><?php echo $cntInsuff;?></a> <span> / <?php echo $allOpenChecks;?></span>
	        </p>
	    
			<p class="description">
				<strong>Pending Actions</strong>
									You have <span><a href="?action=insufficient&atype=list"><?php echo $cntInsuff;?></a></span> outstanding pending checks out of all <span><a href="<?php echo $oneMonthUrl;?>"><?php echo $allOpenChecks;?></a></span> total checks within <span>one month</span>.
							</p>
			
						
			<div class="bar others2">
            <span><?php echo $RemainedPer;?>%</span>
				<div style="width:<?php echo $RemainedPer;?>%" class="progress"></div>
			</div>