<table>

	<thead>

    	<tr>

        	<th>Bar Code</th>

            <th>Client's name</th>

            <th>Applicant's Name</th>

            <th>Case Status</th>

            <th>Checks Done</th>

			<?php 

				$ewhere="";

				$betw='';$bcomp='';

				if(isset($_REQUEST['sdate']) && isset($_REQUEST['edate'])){

					$betw=" AND vd.v_date between '$_REQUEST[sdate]' AND '$_REQUEST[edate]'";

				}				

				switch($_REQUEST['name']){

					case 'data_wise':

						$ewhere="";
						
					break;	

					case 'risk_wise':

						$ewhere="AND vd.v_status='close'";

					break;	

					case 'component_wise':

						if(is_numeric($_REQUEST['check'])){

							$bcomp = "AND vc.checks_id=$_REQUEST[check]";	

						}

						$ewhere="AND vd.v_status='close'";

					break;									

				}

		

				$comID = (isset($_REQUEST['com_id']))?$_REQUEST['com_id']:0;

				$CHKA = array();

				$db = new DB();

				if($comID!=0) $comID =  "AND vd.com_id=$comID"; else $comID='';
				
               	$tbl="ver_checks vc INNER JOIN ver_data vd ON vd.v_id=vc.v_id INNER JOIN checks ck ON vc.checks_id=ck.checks_id";

                $twhere = "vd.v_isdlt=0 AND vc.as_isdlt=0 $comID $betw $bcomp $ewhere ORDER BY ck.checks_title";
				if($_REQUEST['status']!="") $twhere="as_vstatus='$_REQUEST[status]' AND $twhere";

                $ch=$db->select($tbl,"DISTINCT ck.checks_id,ck.checks_title",$twhere);        

				while($checks=mysql_fetch_array($ch)){ $CHKA[count($CHKA)]=$checks['checks_id'];?>

                      <th><?=mb_convert_encoding($checks['checks_title'], 'HTML-ENTITIES','UTF-8');?></th>

            <?php } ?>   

            <th>Date of Receiving</th>

            <th>Date of Submission</th>         

        </tr>

    </thead>

	<tbody>

    	<?php 

                

                $twhere = "vd.v_isdlt=0 $comID $ewhere $betw ORDER BY vd.v_date DESC";				

				$records = $db->select("ver_data vd","*",$twhere);

				while($record = mysql_fetch_assoc($records)){ ?>

					<tr>

                    	<td><?=$record['v_bcode']?></td>

                        <td><?php
                        	$company=$db->select('company','*',"id=$record[com_id]");
							$company= mysql_fetch_assoc($company);
							echo $company['name'];
						?></td>

                        <td><?=$record['v_name']?></td>

                        <td><?=$record['v_rlevel']?></td>

                        <td><?php

								$tnt = countChecks("vc.v_id=$record[v_id]");

								$cnt = countChecks("vc.as_status='close' AND vc.v_id=$record[v_id]");  

								echo "$cnt of $tnt";                      

						?></td>

						<?php foreach($CHKA as $chk){ 

									$checks = $db->select("ver_checks","*","checks_id=$chk AND v_id=$record[v_id]"); ?>

                                	<td><?php

										$cellv=""; $cnt=1;

                                    	$num = mysql_num_rows($checks);

										$isC = ($num>1)?true:false; 

										if($num>0){

											while($check = mysql_fetch_assoc($checks)){

												$cellv .=  (($cellv!='')?'

':'').(($isC)?"<strong>$cnt :</strong>":'').$check['as_vstatus'];	

												$cnt=$cnt+1;	

											}

											echo $cellv;

										}else echo '-----';

									?></td>

                        <?php } ?>                                

                        <td><?=date("j-M-Y",strtotime($record['v_date']))?></td>

                        <td><?php

                        		if($record['v_stdate']!=''){

									echo date("j-M-Y",strtotime($record['v_stdate']));

								}else echo 'N/A';

							?></td>

                    </tr>	

		<?php		} ?>

    </tbody>

</table>



