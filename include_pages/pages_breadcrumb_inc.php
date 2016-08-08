            	<!--<li class="first">
                	<a href="?action=dashboard">Dashboard</a>   
                </li>-->
				<?php 
				if($IPAGE){
				$sLinks = shortLinks();
                      if($sLinks){
                            for($ind=(count($sLinks)-1);0<=$ind;$ind--){ 
                                $sLink=$sLinks[$ind];
								if($sLink['m_brdm']=='0'){
                                $link="?action=$sLink[m_action]".(($sLink['m_atype']!='')?"&atype=$sLink[m_atype]":"");
								if($sLink['m_prm']!=''){
									$parms = explode('|',$sLink['m_prm']);
									foreach($parms as $parm){$link="$link&$parm=".$_REQUEST[$parm];}
								} //$isCur = (($ACTION==$sLink['m_action'] && $ATYPE==$sLink['m_atype']) && $SSTR==''); 
								if($LEVEL==4){ 
								$m_attitle = str_replace("Case",APPLICANT,$sLink['m_attitle']); 
								$m_actitle = str_replace("Case",APPLICANT,$sLink['m_actitle']); 
								} 
								else {  
								$m_attitle = $sLink['m_attitle']; 
								$m_actitle = $sLink['m_actitle']; 
								}
								?>
                                
                                    <a href="<?=$link?>">
                                    	<?=str_ireplace('/ Edit','',"$m_actitle $m_attitle ");?>
                                    </a>
                                
                <?php			}
							}			
                      }}?>
                <?php if(isset($_REQUEST['edit'])){?>
                      	
                            <a href="javascript:void()">
                                <?=ucwords("$action Edit")?>
                            </a>
                        
                <?php } ?>
                <?php if(is_numeric($_REQUEST['clntid'])){
						$company = getcompany($_REQUEST['clntid']);
						$company = mysql_fetch_assoc($company)?>
                      	
                            <a href="javascript:void()" onclick="submitLink('clntid=<?=$_REQUEST['clntid']?>')">
                                <?=$company['name']?>
                            </a>
                        
                <?php } ?>                
                <?php if(isset($_REQUEST['sstr']) && $_REQUEST['sstr']!='Search by Candidate Name / ID#'){?>
                      	
                            <a href="javascript:void()">
                                <?=$_REQUEST['sstr']?>
                            </a>
                        
                <?php } ?>                
 