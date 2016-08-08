		<?php 
		//Overdue checks box count
		$cntOverlOverDueoneMonths = str_replace(",","",count_Checks_By_Client($company_id,"DATE(as_addate) BETWEEN '$oneMonth' AND '$today'"));
		
		$whr = "com_id='$company_id' AND as_isdlt=0 AND v_isdlt=0  AND DATE(as_addate) BETWEEN '$oneMonth' AND '$today' $location_users";
		$sel = $db->select("ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id","as_id,DATE(as_addate) as as_addate,DATE(as_cldate) as as_cldate,as_status,as_sent,as_qastatus",$whr);
				
		$overDueCnt=0;
		while($rs = @mysql_fetch_assoc($sel)){
		$startdate = $rs['as_addate'];
		
		$dueDate = getdatedifference($startdate, TAT,$company_id);
		
		if($rs['as_status']=='Close' && $rs['as_qastatus']!='Rejected'){
		$closeDate = $rs['as_cldate'];
		
		if(strtotime($closeDate)>strtotime($dueDate)){
		
		$overDueCnt++;	
		
		}
		}else{
	
		if(strtotime($today)>strtotime($dueDate)){
		//echo "Opened overdue <br> ";
		$overDueCnt++;	
		}
		}

		
		}
		
		$Remained = (int) $cntOverlOverDueoneMonths-$overDueCnt;
		$RemainedPer = getPercentage($cntOverlOverDueoneMonths,$Remained);
						
		?>
			<p class="value">
				<?php  echo $overDueCnt;?> <span> / <?php echo  $cntOverlOverDueoneMonths;?></span>
	        </p>
	    
			<p class="description">
				<strong>Overdue Checks</strong>
									You have <span><?php  echo $overDueCnt;?></span> outstanding Overdue checks out of all <span><a href="<?php echo $oneMonthUrl;?>"><?php echo  $cntOverlOverDueoneMonths;?></a></span> total checks within <span>one month</span>.
							</p>
						
			<div class="bar others1">
            	<span><?php echo $RemainedPer;?>%</span>
				<div  style="width:<?php echo $RemainedPer;?>%" class="progress"></div>
			</div>