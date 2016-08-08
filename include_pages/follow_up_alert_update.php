    <section class="retracted scrollable">
        <div class="row">
            <div class="col-md-12">
                <div class="manager-report-sec">
                    
                
                    <?php                        
                      $data_table = 
						'<table width="100%" border="1" style="border-collapse: collapse; border:1px solid #cccccc; border-color: #cccccc;">
                            <thead>
                                <tr>
                                    <th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">ID #</th>
                                    <th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Candidate Name</th>
                                    <th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Analyst</th>
                                    <th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Check Title</th>
                                    <th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Last Process Date</th>
                                    <th width="30%" align="left" bgcolor="#cccccc" style="font-size:12px; padding:5px;">Status</th>
                                </tr>
                            </thead>
                            <tbody>';
                    ?>
								<?php 		
                                $cols = "vc.user_id,vd.v_id,vd.emp_id,vd.v_name,cc.checks_title,vc.as_status, IF(ISNULL(vc.as_pdate),vc.as_date,vc.as_pdate) AS pdate";
                                $tbls = "ver_checks vc INNER JOIN ver_data vd ON vc.v_id=vd.v_id INNER JOIN checks cc ON cc.checks_id=vc.checks_id";
                                $where = "vc.as_status!='close' AND vc.as_status!='Not Assign' AND vc.as_isdlt=0 AND vd.v_isdlt=0 AND vd.v_status!='close' AND DATEDIFF(NOW(),IF(ISNULL(vc.as_pdate),vc.as_date,vc.as_pdate))>2";
                                if($LEVEL==3) $where = $where." AND vc.user_id='". $USERID ."'";
                                $data = $db->select($tbls,$cols,$where);
                                while($re = mysql_fetch_array($data)) {
									$userInfo = getUserInfo($re['user_id']);
									$data_table .= '
												<tr>
													<td>'.$re['emp_id'].'</td>
													<td><a href="'.SURL.'?action=details&case='.$re['v_id'].'">'.$re['v_name'].'</a></td>
													<td> '.trim($userInfo['first_name'].' '.$userInfo['last_name']).'</td>
													<td>'.$re['checks_title'].'</td>
													<td>'.date("j-M-Y",strtotime($re['pdate'])).'</td>
													<td>'.$re['as_status'].'</td>
												</tr>  
												';      
                                }?>
                          <?php  $data_table .= ' </tbody>
                        		</table>';
						echo $data_table;
						
						$user_info = $db->select("users ","*","level_id=2");   
						$email_arr = array();
							while($uemail = mysql_fetch_assoc($user_info)){
								$email_arr[] = $uemail['email'];
							}
						$to 	= implode(';',$email_arr);
						//echo 'Case ID'.$case_id;
						echo 	$to;
						
						$email_title = 'Follow Up Update Alert ['. date("d M Y").']';
						echo emailTmp( $data_table, $email_title,'ayaz@xcluesiv.com');
						?>
                </div>
            </div>
        </div>
    </section>