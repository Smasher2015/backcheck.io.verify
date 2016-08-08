<div class="col-md-12 edu-detail">
<?php 									
									//include('include/config.php');
									
									
									if(!is_numeric($_REQUEST['ascase'])) $_REQUEST['ascase']=0;
									if(is_numeric($_REQUEST['ascase']) && is_numeric($_REQUEST['case'])){
									$_REQUEST['plogid']= $_REQUEST['case'];
									$_REQUEST['id']    = $_REQUEST['ascase'];
									}
									
									if(is_numeric($_REQUEST['id']) && is_numeric($_REQUEST['plogid'])){
									$case = 	$_REQUEST['plogid'];
									//$ascase = $_REQUEST['id'];
									$ascase = $check['as_id'];
									$access=true;
									}else $access=false;


									if($access){
									$db = new DB();
									$varData = $db->select("ver_data","*","v_id=$case");
									if($ascase!=0){
									$asWhere = "v_id=$case AND as_id=$ascase AND as_status='Close'";
									}else{
									$asWhere = "v_id=$case AND as_status='Close' AND as_isdlt=0";
									}
									$asDatas = $db->select("ver_checks","*",$asWhere);
									if((mysql_num_rows($varData)>0) && (mysql_num_rows($asDatas)>0)){
									$varData = mysql_fetch_array($varData);
									$_REQUEST['certi']=1;
									?>

                                        
                                        
                                        
                                        
                                    <div class="col-md-3">
                                    	<div class="edu-in text-semibold">Name of Employee : <span class="text-normal"><?=$varData['v_name']?></span></div>
                                    </div>
									<?php
                                    $comInfo = $db->select("company","name,id","id=$varData[com_id]");
                                    $comInfo = mysql_fetch_array($comInfo);
                                    if($comInfo['id']==37){ ?>
                                     <div class="col-md-3">
                                    	<div class="edu-in text-semibold">Reference ID : <span class="text-normal"><?=$varData['v_refid']?></span></div>
                                        
                                    </div>
                                    <?php } ?>
                                    <div class="col-md-3">
                                    	<div class="edu-in text-semibold">Level of Screening : <span class="text-normal">
										<?php 
                                                if(mysql_num_rows($asDatas)==1){
                                                    $asData = mysql_fetch_array($asDatas);
                                                    $ascase = $asData['as_id']; 	
                                                }else $asData = mysql_fetch_array($asDatas);
                                                if($ascase!=0){
                                                    $check = getCheck($asData['checks_id']);
                                                    echo $check['checks_title'];
                                                }else{
                                                    echo 'LEVEL 1';
                                                }
                                                ?>      </span></div>
                                    </div>
                                     <div class="col-md-3">
                                    	<div class="edu-in text-semibold">Client's Name : <span class="text-normal"><?=$comInfo['name']?></span></div>
                                    </div>
                                     <div class="col-md-3">
                                    	<div class="edu-in text-semibold"> Risk Level : <span class="text-normal">
											<?php
											if($ascase!=0) $vStatus = $asData['as_vstatus']; else $vStatus =$varData['v_rlevel']; 
											$vStatus = strtolower(trim($vStatus));
											$vSts = vs_Status($vStatus);
											?>
                                            <span class="detail-report-check-status <?php echo strtolower($vSts).'-risk-sts';?>"><?php echo $vSts;?></span>
                                        </span></div>
                                    	
                                    </div>
                                 
									<?php
                                     
                                        $asDatas = $db->select("ver_checks vc INNER JOIN checks ck ON vc.checks_id=ck.checks_id","DISTINCT *","$asWhere ORDER BY checks_title");
                                        $numChkes = mysql_num_rows($asDatas);
                                        $fnos = 1;
                                        $cnts = 0;
                                        while($asData = mysql_fetch_array($asDatas)){ ?>
                                                <div class="col-md-6">
                                                <div class="edu-in text-semibold">
                                                    <?php if($ascase==0) echo "$fnos-"; echo $asData['checks_title'];?>
                                                    <?php 
                                                        $data = getData($asData['as_id'],"dmain");
                                                        if(mysql_num_rows($data)>0){
                                                        $data = mysql_fetch_array($data);
                                                        echo $data['d_value'];
                                                        }else{
                                                        $data = $db->select("fields_maping","fl_title","fl_key='dmain' AND checks_id=$asData[checks_id] AND t_id=-1");
                                                        $data = mysql_fetch_array($data);
                                                        echo $data['fl_title'];
                                                        }
                                                    ?>
                                                    <?php 
                                                        $vStatus = strtolower(trim($asData['as_vstatus']));
                                                        $vSts = vs_Status($vStatus);
                                                    ?>
                                               
                                                <span class="text-normal">
                                                    <?php /*?><span class="<?php echo "f$vSts"; ?>"><?php echo $asData['as_vstatus']; ?></span>    <?php */?>   
                                                     <?php echo $asData['as_vstatus']; ?>                        
                                                    <?php  
                                                    $nos=0;
													for($i=-1; $i<12; $i++){
														if($i==0){
													  $proofs = getData($asData['as_id'],"file");		
														}else{
													  $proofs = getData($asData['as_id'],"file$i");	
														}
                                                    
                                                    $pNums = mysql_num_rows($proofs);
                                                        if($pNums>0){ ?>                                
                                                        <p>Please refer to 
                                                     
                                                        Annexure-[ 
                                                            <?php  while($proof = mysql_fetch_array($proofs)){
                                                            if($ascase==0){
                                                            $tLbl = ($fnos).(($pNums>1)?froofLbl($nos):'');
                                                            }else $tLbl = ($fnos+$nos);
                                                            echo (($nos>0)?"-":"").$tLbl;
                                                            $FILES[$cnts]['proof'] = $proof['d_value'];
                                                            $FILES[$cnts]['title'] = $proof['d_stitle'];
                                                            $FILES[$cnts]['pno'] = $tLbl;
                                                            $nos=$nos+1;
                                                            $cnts = $cnts+1;
                                                            }
                                                            ?> 
                                                        ]                                
                                                         below.</p>
                                                    

                                                    <?php   }
													
													}
													?>
                                                    </span>
                                                </div>
                                                <div class="clearFix"></div>
                                                </div>
                                                
                                                <?php if($fnos==3) break;
                                                $fnos=$fnos+1;			
                                        } 
                                        
                                        /// Educational Details
                                    ?>
                                    
                                    
                                    
                                    
                             
                                    


<div class="clearFix"></div>

<div class="panel panel-qa">
                         <?php
//// Check further information Manager Remarks
$asDatas = $db->select("ver_checks vc INNER JOIN checks ck ON vc.checks_id=ck.checks_id","DISTINCT *","$asWhere ORDER BY checks_title");
$fnos = 1;
while($asData = mysql_fetch_array($asDatas)){ ?>
             
             <div class="panel-heading">
    	<h3 class="panel-title"><?php  if($ascase==0) echo "$fnos-"; echo $asData['checks_title']; ?></h3>
    </div>
           <div class="">

				<?php 
                        $vStatus = strtolower(trim($asData['as_vstatus']));
                        $vSts = vs_Status($vStatus);
                 ?>                 
                 
                <li>
                <div class="left-data-sec">Verification Status :</div>
                <div class="right-data-sec  <?="f$vSts"?>"> <?=$asData['as_vstatus']?> </div>
                <div class="clearFix"></div>
                </li>
                <li>
                <div class="left-data-sec">Manager Remarks :</div>
                <div class="right-data-sec"><?=$asData['as_remarks']?> </div>
                <div class="clearFix"></div>
                </li>
         <?php
            $pCheck = getcheckP($asData[checks_id]);
            $titles = $db->select("titles","t_id,t_title,t_show","checks_id=$pCheck AND is_dsp=1 ORDER BY t_pos");
            if(mysql_num_rows($titles)>0){
                while($title = mysql_fetch_array($titles)){
                    $fDatas = $db->select("fields_maping","fl_title,fl_key,fl_algn,is_multy","checks_id=$pCheck AND t_id=$title[t_id] AND fl_type='s' AND fl_show=1 ORDER BY fl_ord");
              ?> <?php /*?><?php       if($title['t_show']==1){ ?>
                     <div class="report-detail-section-title rpdc-green">
            			<h5>  <?php  echo $title['t_title']; ?></h5>
            		</div>
                    
        <?php			} ?><?php */?>
        
        <?php 
		$files = array();
		for($i=-1; $i<12; $i++){
			$files[] = 'file'.$i;
		}
                while($fData = mysql_fetch_array($fDatas)){ 
                    $datas = getData($asData['as_id'],$fData['fl_key']);
                    if($fData['fl_key']=='multy'){ ?>
                    			<div class="table-responsive">
                    				<table class="table table-striped table-hover table-condensed">
                                    <thead>
									<tr>
										<th>Information Title</th>
										<th>Information Provided</th>
										<th>Information Verified</th>
										
									</tr>
								</thead>
                                  <tbody>
										<?php while($data = mysql_fetch_array($datas)){ ?>                                        
                                        	<tr>
                                            	<td><?=$data['d_mtitle'];?> :</td>
                                                <td><?=$data['d_stitle'];?></td>
                                                <td><?=$data['d_value'];?></td>
                                            </tr>                                        
                                       <?php  } ?>    
                                	 </tbody>
                                    </table>
                                    
                                </div> 
              <?php  }else if($fData['fl_key']!='file' && (!in_array($fData['fl_key'],$files))){ ?>
              
              			    <div class="table-responsive">
                              <table class="table table-striped table-hover table-condensed">
                                <tbody>
                            	<tr>    
                                <td>
                                 <?php echo $fData['fl_title'];?> :
                                </td>
                          <td class="<?=($fData['is_multy']==1)?'mt':'nt'?>" >
						<?php	
                            if(mysql_num_rows($datas)>0){
								
                                while($data = mysql_fetch_array($datas)){ ?>
                                  
									<?php if($fData['fl_key']=='followup'){?>
                                    [ <?=date("j-F-Y",strtotime($data['data_date']))?> ] 
                                    <?php }?>
                                    <?=change_url_in_text(trim($data['d_value']))?>
                         <?php 	}
                             }else echo ($asData[checks_id]==41 || $asData[checks_id]==39)?'<li class="nt">No Match Found.</li>':'<li class="nt">---</li>';
                              ?>
                           
                            	</td>
                                </tr>
                            	</tbody>	
                            </table>
                            
                               <div class="clearFix"></div>
                            </div>
	
        <?php }
		
		} }
            }
        ?>

			<?php 
			/*if($asData['checks_sveri']==1){
                $analystInf = $db->select("users","*","user_id=$asData[user_id]");
                $analystInf = mysql_fetch_array($analystInf); ?>
				<div class="headline">
                	<span style="margin-left:20px;">Verifier Information</span>
             	</div>            
				<div class="tbl">
				<table width="890" border="0"  cellpadding="0" cellspacing="0">            
                    <tr>
                        <td class="tda">Name:</td>
                        <td class="tdb"><?=trim($analystInf['first_name']." ".$analystInf['middle_name']." ".$analystInf['last_name']);?></td>
                    </tr>  
                    <tr>
                        <td class="tda">Email:</td>
                        <td class="tdb"><a href="mailto:<?=$analystInf['email']?>"><?=$analystInf['email']?></a></td>
                    </tr>   
                    <tr>
                        <td class="tdc">Contact #</td>
                        <td class="tdd"><?=$analystInf['fone_no']?></td>
                    </tr>
            </table>
            	</div>
      <?php }*/ ?>
<?php /*?><div class="sdisclaimer">
 <?php 
	  if($asData['checks_scomt']==1 && isset($_REQUEST['t'])){?>
		<div class="ftxt" style="margin-bottom:15px;"><?=$asData['checks_commt']?></div> 
        <p>&nbsp;</p>    
<?php } 
	    
	  if($asData['checks_sdisc']==1 && isset($_REQUEST['t'])){?>
		<div class="ftxt"><strong>Disclaimer: </strong> <?=$asData['checks_discl']?></div>     
<?php } ?>
</div><?php */?>
</div>
<?php 
$fnos=$fnos + 1;
} 
	
//// Check further information Manager Remarks
?>

</div>








<?php 
	/// For Annexure

if(isset($FILES)){  
?>
<div class="row">
<div class="col-md-12">                    
    
	        <h6 class="text-semibold">Annexure</h6>


<?php 		foreach($FILES as $no=>$FILE){?>
        
        <div class="col-lg-4 col-md-6">
							<div class="thumbnail no-padding">
								<div class="thumb">
									<img style="width:100%;" src="<?php echo $FILE['proof'];  ?>"  />
									<div class="caption-overflow">
										<span>
											<a href="<?php echo $FILE['proof'];  ?>" class="btn bg-success-400 btn-icon btn-xs" data-popup="lightbox"><i class="icon-plus2"></i></a>
											<!--<a href="user_pages_profile.html" class="btn bg-success-400 btn-icon btn-xs"><i class="icon-link"></i></a>-->
										</span>
									</div>
								</div>
							
						    	<div class="caption text-center">
						    		<h6 class="text-semibold no-margin">Annexure-<?=$FILE['pno']?>  <small class="display-block"><?=$FILE['title']?></small></h6>
						    	</div>
					    	</div>
						</div>
       
<?php }
?>
</div>
</div> 
<?php

	} 

	/// For Annexure End
	?>

          
                                    
                             
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
									<?php }
                                    }else{ ?>
                                    <li>
                                    	<h4>No Further Detail Found!</h4>
                                    	<div class="clearFix"></div>
                                    </li>

                                    <?php } ?> 
</div>