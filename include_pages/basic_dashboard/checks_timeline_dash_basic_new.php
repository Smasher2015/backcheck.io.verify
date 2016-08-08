<div class="timeline timeline-center content-group">
						<div class="timeline-container">
                        
                        	<!-- Messages -->
			<?php 
			function getTimelineSteps($as_id,$step){
			global $db;
			$data = array();
			$asInfo = getCheck(0,0,$as_id);
			if($asInfo['checks_id']==1){
			if($step==1){
			$selData = getData($as_id,'vuni');
			while($rs = @mysql_fetch_assoc($selData)){
			$data[] = $rs;			
			}
			}
			if($step==2){	
			$selData = getData($as_id,'followup');
			while($rs = @mysql_fetch_assoc($selData)){
			$data[] = $rs;
			}
			}
			}
			
			return $data;
			}
			
			$tbls = "ver_checks vc 
			INNER JOIN ver_data vd ON vc.v_id=vd.v_id 
			INNER JOIN checks c ON vc.checks_id=c.checks_id ";
			$cols = "vc.v_id,v_date,v_name,as_id,as_uadd,DATE(as_addate) AS as_addate,as_status,as_vstatus,as_uni,t_check,v_status,vc.user_id,DATE(as_pdate) AS as_pdate,checks_title,vc.checks_id";
			$whr = "v_isdlt=0 AND as_isdlt=0 AND com_id='$company_id' AND vc.checks_id IN (1,2) ORDER BY v_date DESC LIMIT 5";
			//echo "SELECT $cols FROM $tbls WHERE  $whr";
			$latestCases = $db->select($tbls,$cols,$whr);
			$c=0;
			$data=array();
			while($rsCase = @mysql_fetch_assoc($latestCases)){
			$Att = $db->select("attachments","att_insuff,DATE(att_insuff_date) AS att_insuff_date","checks_id=$rsCase[as_id] AND att_active=1 AND att_insuff=1 ORDER BY att_insuff_date ASC");
			$InsuffCount = @mysql_num_rows($Att);
			while($rsAtt = @mysql_fetch_assoc($Att)){
			$InsuffDate = $rsAtt['att_insuff_date'];
			}
			
			$add_data = $db->select("add_data","*","as_id=$rsCase[as_id] AND d_isdlt=0");
			$add_data_cnt = @mysql_num_rows($add_data);
			
			
			$checks_id = $rsCase['checks_id'];
			$count = ($checks_id==1)?4:3;
			$cc=-1;
			for($i=1; $i<=$count; $i++){
			$cc++;	
			$clss2 = ($rsCase['as_status']=='Close')?"bg-success":"bg-red";
			$clss1 = "";
			$c++;
			if($c==2){
			$c=0;
			}
			if($c==0){
			$clss1 = "post-even";
			$clss2 = ($rsCase['as_status']=='Close')?"bg-success":"bg-info-400";
			}
			$workedBy = getUserInfo($rsCase[user_id]);
			$addedBy = getUserInfo($rsCase[as_uadd]);
			$addedByfullname = $addedBy[first_name].' '.$addedBy[last_name];
			$workedByfullname = $workedBy[first_name].' '.$workedBy[last_name];
			$addedByfullnameLink = "<a href='#' >$addedByfullname</a>";
			$workedByfullnameLnik = "<a href='#' >$workedByfullname</a>";
			
			
			
			
			if($checks_id==1){
			$data['edu_0_'.$rsCase[as_id]][cls1] = "btn bg-red btn-rounded btn-icon btn-xs";
			$data['edu_0_'.$rsCase[as_id]][cls2] = "icon-user-plus";
			$data['edu_0_'.$rsCase[as_id]][title] = "Check added by $addedByfullnameLink";
			$data['edu_0_'.$rsCase[as_id]][date_] = dateTimeExe($rsCase['as_addate']);
			$show1 = false;
			if($rsCase['as_status']=='Insufficient'){
				
			$Insuf_Init = "Check marked as Insufficient.";	
			$totalInsuff = $InsuffCount;
			$Insuf_Init_Date = $InsuffDate;
			$show1 = true;
			$step1 = 1;
			$data['edu_'.$step1.'_'.$rsCase[as_id]][cls1] = "btn bg-info-400 btn-rounded btn-icon btn-xs";
			$data['edu_'.$step1.'_'.$rsCase[as_id]][cls2] = "icon-play4";
			$data['edu_'.$step1.'_'.$rsCase[as_id]][title] = $Insuf_Init;
			$data['edu_'.$step1.'_'.$rsCase[as_id]][date_] = dateTimeExe($Insuf_Init_Date);	
			
			}
			else if($rsCase['as_vstatus']=='Not Initiated'){
			
			$Insuf_Init = "Check not initiated yet.";
			$Insuf_Init_Date = $rsCase['as_addate'];
			$show1 = true;
			$step1 = 1;
			$data['edu_'.$step1.'_'.$rsCase[as_id]][cls1] = "btn bg-info-400 btn-rounded btn-icon btn-xs";
			$data['edu_'.$step1.'_'.$rsCase[as_id]][cls2] = "icon-play4";
			$data['edu_'.$step1.'_'.$rsCase[as_id]][title] = $Insuf_Init;
			$data['edu_'.$step1.'_'.$rsCase[as_id]][date_] = dateTimeExe($Insuf_Init_Date);
		
			}
			else if($rsCase['as_vstatus']!='Not Initiated'){
			$cF =0;
			$cFEMAIL =0;
			$cFPHONE =0;
			$display=false;
			$followupData='';
			while($rsAddata = @mysql_fetch_assoc($add_data)){
			
			if($rsAddata['d_type']=='vuni'){
			$uniTitle = $rsAddata['d_value'];
			$data_date = $rsAddata['data_date'];	
			$Insuf_Init_Date = $data_date;
			$uniTitle = $uniTitle;
			$Unilinks = "<a href='#' >$uniTitle</a>";
			$Insuf_Init = "Check initiated and send to issueing authority $Unilinks.";	
			$show1 = true;
			$step1 = 1;
			$data['edu_'.$step1.'_'.$rsCase[as_id]][cls1] = "btn bg-yellow btn-rounded btn-icon btn-xs";
			$data['edu_'.$step1.'_'.$rsCase[as_id]][cls2] = "icon-paperplane";
			$data['edu_'.$step1.'_'.$rsCase[as_id]][title] = $Insuf_Init;
			$data['edu_'.$step1.'_'.$rsCase[as_id]][date_] = dateTimeExe($Insuf_Init_Date);	
			}
			if($rsAddata['d_type']=='followup'){
				
			//$uniTitle = $rsAddata['d_value'];
			$cF++;
			$data_date = $rsAddata['data_date'];
			$Insuf_Init = "$cF Follow up by $workedByfullnameLnik";	
			$Insuf_Init_Date = $data_date;
			$show1 = true;
			$step1 = 2;
			$data['edu_'.$step1.'_'.$rsCase[as_id]][cls1] = "btn bg-purpal btn-rounded btn-icon btn-xs";
			$data['edu_'.$step1.'_'.$rsCase[as_id]][cls2] = "icon-collaboration";
			$data['edu_'.$step1.'_'.$rsCase[as_id]][title] = $Insuf_Init;
			$data['edu_'.$step1.'_'.$rsCase[as_id]][date_] = dateTimeExe($Insuf_Init_Date);
			$data['edu_follow_'.$step1.'_'.$rsCase[as_id]][follow] = 1;
			if($rsAddata['d_mtitle']=='Call'){
			$display=true;
			$cFPHONE++;	
			$clss = 'icon-phone2';
			$data['edu_follow_'.$step1.'_'.$rsCase[as_id]][follow_data] .= '<li class="media">
						<div class="media-left">
							<a href="#" class="btn bg-success btn-rounded btn-icon btn-xs"><i class="'.$clss.'"></i></a>
						</div>

						<div class="media-body">
							<div class="media-content">Followup by Call with issueing authority agaist case <a href="'.SURL.'"?action=details&case='.$rsCase[v_id].'&_pid=183#check_tab_'.$rsCase[as_id].'" target="_blank">'.$rsCase[v_name].'</a></div>
							<span class="media-annotation display-block mt-10">'.dateTimeExe($rsAddata['data_date']).'<a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
						</div>
					</li>';			
			}
			else if($rsAddata['d_mtitle']=='' || $rsAddata['d_mtitle']=='Email'){
			$display=true;
				
			$clss = 'icon-envelop';
			$cFEMAIL++;
			$data['edu_follow_'.$step1.'_'.$rsCase[as_id]][follow_data] .= '<li class="media">
						<div class="media-left">
							<a href="#" class="btn bg-greend btn-rounded btn-icon btn-xs"><i class="'.$clss.'"></i></a>
						</div>

						<div class="media-body">
							<div class="media-content">Followup by Email with issueing authority agaist case <a href="'.SURL.'"?action=details&case='.$rsCase[v_id].'&_pid=183#check_tab_'.$rsCase[as_id].'" target="_blank">'.$rsCase[v_name].'</a></div>
							<span class="media-annotation display-block mt-10">'.dateTimeExe($rsAddata['data_date']).'<a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
						</div>
					</li>';
			}
			//echo $followupData;
			
			}
			}
			}
			
						
			
			
			
						
			if($rsCase['as_status']=='Close' &&  $rsCase['as_status']!='Rejected'){
			$step1 = 3;
			$Insuf_Init = "Check has been closed and ready for download.";	
			$Insuf_Init_Date = $rsCase['as_cldate'];
			$show1 = true;
			$data['edu_'.$step1.'_'.$rsCase[as_id]][cls1] = "btn bg-yellow btn-rounded btn-icon btn-xs";
			$data['edu_'.$step1.'_'.$rsCase[as_id]][cls2] = "icon-paperplane";
			$data['edu_'.$step1.'_'.$rsCase[as_id]][title] = $Insuf_Init;
			$data['edu_'.$step1.'_'.$rsCase[as_id]][date_] = dateTimeExe($Insuf_Init_Date);
			}
			
			
			
			}
			if($checks_id==2){
			$data['emp_0_'.$rsCase[as_id]][cls1] = "btn bg-red btn-rounded btn-icon btn-xs";
			$data['emp_0_'.$rsCase[as_id]][cls2] = "icon-user-plus";
			$data['emp_0_'.$rsCase[as_id]][title] = "Check added by $addedByfullnameLink";
			$data['emp_0_'.$rsCase[as_id]][date_] = dateTimeExe($rsCase['as_addate']);
			$show1 = false;
			if($rsCase['as_status']=='Insufficient'){
				
			$Insuf_Init = "Check marked as Insufficient.";	
			$totalInsuff = $InsuffCount;
			$Insuf_Init_Date = $InsuffDate;
			$show1 = true;
			$step1 = 1;
			$data['emp_'.$step1.'_'.$rsCase[as_id]][cls1] = "btn bg-info-400 btn-rounded btn-icon btn-xs";
			$data['emp_'.$step1.'_'.$rsCase[as_id]][cls2] = "icon-play4";
			$data['emp_'.$step1.'_'.$rsCase[as_id]][title] = $Insuf_Init;
			$data['emp_'.$step1.'_'.$rsCase[as_id]][date_] = dateTimeExe($Insuf_Init_Date);	
			
			}
			else if($rsCase['as_vstatus']=='Not Initiated'){
			
			$Insuf_Init = "Check not initiated yet.";
			$Insuf_Init_Date = $rsCase['as_addate'];
			$show1 = true;
			$step1 = 1;
			$data['emp_'.$step1.'_'.$rsCase[as_id]][cls1] = "btn bg-info-400 btn-rounded btn-icon btn-xs";
			$data['emp_'.$step1.'_'.$rsCase[as_id]][cls2] = "icon-play4";
			$data['emp_'.$step1.'_'.$rsCase[as_id]][title] = $Insuf_Init;
			$data['emp_'.$step1.'_'.$rsCase[as_id]][date_] = dateTimeExe($Insuf_Init_Date);
		
			}
			else if($rsCase['as_vstatus']!='Not Initiated'){
			$cF =0;

			while($rsAddata = @mysql_fetch_assoc($add_data)){
			
			if($rsAddata['d_type']=='dmain'){
			$uniTitle = $rsAddata['d_value'];
			$data_date = $rsAddata['data_date'];	
			$Insuf_Init_Date = $data_date;
			$uniTitle = $uniTitle;
			$Unilinks = "<a href='#' >$uniTitle</a>";
			$Insuf_Init = "Check initiated and send to issueing authority $Unilinks.";	
			$show1 = true;
			$step1 = 1;
			$data['emp_'.$step1.'_'.$rsCase[as_id]][cls1] = "btn bg-yellow btn-rounded btn-icon btn-xs";
			$data['emp_'.$step1.'_'.$rsCase[as_id]][cls2] = "icon-paperplane";
			$data['emp_'.$step1.'_'.$rsCase[as_id]][title] = $Insuf_Init;
			$data['emp_'.$step1.'_'.$rsCase[as_id]][date_] = dateTimeExe($Insuf_Init_Date);	
			}
			if($rsAddata['d_type']=='followup'){
			//$uniTitle = $rsAddata['d_value'];
			$cF++;
			$data_date = $rsAddata['data_date'];
			$Insuf_Init = "$cF Follow up by $workedByfullnameLnik";	
			$Insuf_Init_Date = $data_date;
			$show1 = true;
			$step1 = 2;
			$data['emp_'.$step1.'_'.$rsCase[as_id]][cls1] = "btn bg-purpal btn-rounded btn-icon btn-xs";
			$data['emp_'.$step1.'_'.$rsCase[as_id]][cls2] = "icon-collaboration";
			$data['emp_'.$step1.'_'.$rsCase[as_id]][title] = $Insuf_Init;
			$data['emp_'.$step1.'_'.$rsCase[as_id]][date_] = dateTimeExe($Insuf_Init_Date);
			$data['edu_follow_'.$step1.'_'.$rsCase[as_id]][follow] = 1;			
			
			if($rsAddata['d_mtitle']=='Call'){
			$display=true;
			$cFPHONE++;	
			$clss = 'icon-phone2';
			$data['emp_follow_'.$step1.'_'.$rsCase[as_id]][follow_data] .= '<li class="media">
						<div class="media-left">
							<a href="#" class="btn bg-success btn-rounded btn-icon btn-xs"><i class="'.$clss.'"></i></a>
						</div>

						<div class="media-body">
							<div class="media-content">Followup by Call with issueing authority agaist case <a href="'.SURL.'"?action=details&case='.$rsCase[v_id].'&_pid=183#check_tab_'.$rsCase[as_id].'" target="_blank">'.$rsCase[v_name].'</a></div>
							<span class="media-annotation display-block mt-10">'.dateTimeExe($rsAddata['data_date']).'<a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
						</div>
					</li>';			
			}else if($rsAddata['d_mtitle']=='' || $rsAddata['d_mtitle']=='Email'){
			$display=true;
				
			$clss = 'icon-envelop';
			$cFEMAIL++;
			$data['emp_follow_'.$step1.'_'.$rsCase[as_id]][follow_data] .= '<li class="media">
						<div class="media-left">
							<a href="#" class="btn bg-greend btn-rounded btn-icon btn-xs"><i class="'.$clss.'"></i></a>
						</div>

						<div class="media-body">
							<div class="media-content">Followup by Email with issueing authority agaist case <a href="'.SURL.'"?action=details&case='.$rsCase[v_id].'&_pid=183#check_tab_'.$rsCase[as_id].'" target="_blank">'.$rsCase[v_name].'</a></div>
							<span class="media-annotation display-block mt-10">'.dateTimeExe($rsAddata['data_date']).'<a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
						</div>
					</li>';
			}
			}
			}
			}
						
			
			
						
			if($rsCase['as_status']=='Close' &&  $rsCase['as_status']!='Rejected'){
			$step1 = 3;
			$Insuf_Init = "Check has been closed and ready for download.";	
			$Insuf_Init_Date = $rsCase['as_cldate'];
			$show1 = true;
			$data['emp_'.$step1.'_'.$rsCase[as_id]][cls1] = "btn bg-yellow btn-rounded btn-icon btn-xs";
			$data['emp_'.$step1.'_'.$rsCase[as_id]][cls2] = "icon-paperplane";
			$data['emp_'.$step1.'_'.$rsCase[as_id]][title] = $Insuf_Init;
			$data['emp_'.$step1.'_'.$rsCase[as_id]][date_] = dateTimeExe($Insuf_Init_Date);
			}	
			}
		if($checks_id==2){
			if(array_key_exists('emp_'.$cc.'_'.$rsCase[as_id],$data)){
					//var_dump($data);
			?>
							<div class="timeline-row <?php echo $clss1;?>">
								<div class="timeline-icon">
									<div class="<?php echo $clss2;?>">
										<i class="icon-library2"></i>
									</div>
								</div>

								<div class="timeline-time">
									<a href="<?php echo SURL."?action=details&case=$rsCase[v_id]&_pid=183";?>" target="_blank"><?php echo $rsCase['v_name']; //echo "Counter: ".$cc;?></a> 
									<span class="text-muted"><?php echo dateTimeExe($rsCase['v_date']);?></span>
								</div>
								<div class="timeline-content">
                               
                                <div class="panel panel-flat">
									<div class="panel-heading">
										<h6 class="panel-title"><a href="<?php echo SURL."?action=details&case=$rsCase[v_id]&_pid=183#check_tab_$rsCase[as_id]";?>" target="_blank"><?php echo $rsCase['checks_title'];?></a></h6>
										<div class="heading-elements">
											<ul class="icons-list">
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
														<i class="icon-circle-down2"></i>
													</a>

													<ul class="dropdown-menu dropdown-menu-right">
														<li><a href="#"><i class="icon-user-lock"></i> Hide user posts</a></li>
														<li><a href="#"><i class="icon-user-block"></i> Block user</a></li>
														<li><a href="#"><i class="icon-user-minus"></i> Unfollow user</a></li>
													</ul>
												</li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>

									<div class="panel-body">
										<ul class="media-list chat-list content-group">
											

											<li class="media">
												<div class="media-left">
                                                    <a href="#" class="<?php echo $data['emp_'.$cc.'_'.$rsCase[as_id]][cls1];?>"><i class="<?php echo $data['emp_'.$cc.'_'.$rsCase[as_id]][cls2];?>"></i></a>
												</div>
											

												<div class="media-body">
													<div class="media-content"><?php echo $data['emp_'.$cc.'_'.$rsCase[as_id]][title];?></div>
													<span class="media-annotation display-block mt-10"><?php echo $data['emp_'.$cc.'_'.$rsCase[as_id]][date_];?><a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
												</div>
											</li>
											<?php  
											
											if($data['emp_follow_'.$cc.'_'.$rsCase[as_id]][follow]==1) { 
											echo $data['emp_follow_'.$cc.'_'.$rsCase[as_id]][follow_data];
											}?>
											
														</ul>
				                    	
									</div>
								</div>
                                                     
                                
                                </div>
							</div>
			<?php 
			}
		}
		if($checks_id==1){ 
		if(array_key_exists('edu_'.$cc.'_'.$rsCase[as_id],$data)){
		?>
			
			<div class="timeline-row <?php echo $clss1;?>">
								<div class="timeline-icon">
									<div class="<?php echo $clss2;?>">
										<i class="icon-library2"></i>
									</div>
								</div>

								<div class="timeline-time">
									<a href="<?php echo SURL."?action=details&case=$rsCase[v_id]&_pid=183";?>" target="_blank"><?php echo $rsCase['v_name']; //echo "Counter: ".$cc;?></a> 
									<span class="text-muted"><?php echo dateTimeExe($rsCase['v_date']);?></span>
								</div>
								<div class="timeline-content">
                               
                                <div class="panel panel-flat">
									<div class="panel-heading">
										<h6 class="panel-title"><a href="<?php echo SURL."?action=details&case=$rsCase[v_id]&_pid=183#check_tab_$rsCase[as_id]";?>" target="_blank"><?php echo $rsCase['checks_title'];?></a></h6>
										<div class="heading-elements">
											<ul class="icons-list">
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
														<i class="icon-circle-down2"></i>
													</a>

													<ul class="dropdown-menu dropdown-menu-right">
														<li><a href="#"><i class="icon-user-lock"></i> Hide user posts</a></li>
														<li><a href="#"><i class="icon-user-block"></i> Block user</a></li>
														<li><a href="#"><i class="icon-user-minus"></i> Unfollow user</a></li>
													</ul>
												</li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>

									<div class="panel-body">
										<ul class="media-list chat-list content-group">
											

											<li class="media">
												<div class="media-left">
                                                    <a href="#" class="<?php echo $data['edu_'.$cc.'_'.$rsCase[as_id]][cls1];?>"><i class="<?php echo $data['edu_'.$cc.'_'.$rsCase[as_id]][cls2];?>"></i></a>
												</div>
											

												<div class="media-body">
													<div class="media-content"><?php echo $data['edu_'.$cc.'_'.$rsCase[as_id]][title];?></div>
													<span class="media-annotation display-block mt-10"><?php echo $data['edu_'.$cc.'_'.$rsCase[as_id]][date_];?><a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
												</div>
											</li>
											
											<?php  
											
											if($data['edu_follow_'.$cc.'_'.$rsCase[as_id]][follow]==1) { 
											echo $data['edu_follow_'.$cc.'_'.$rsCase[as_id]][follow_data];
											}?>
														</ul>
				                    	
									</div>
								</div>
                                                     
                                
                                </div>
							</div>
		<?php }
			}
			} //for loop
			
			} ?>
							                    
							


							<!-- Schedule -->
							
							<!-- /schedule -->

						</div>
				    </div>