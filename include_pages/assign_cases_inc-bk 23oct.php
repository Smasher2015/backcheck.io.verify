<?php include("include_pages/filters_inc.php"); ?>
<?php			
		if(is_numeric($_REQUEST['clntid'])){
			$SSTR.= " AND p.id=$_REQUEST[clntid]";
		}
		
		if(isset($_REQUEST['sstr'])){
			$_REQUEST['sstr'] = trim($_REQUEST['sstr']);
			if(is_numeric($_REQUEST['sstr'])){
				$SSTR.= " AND d.emp_id=$_REQUEST[sstr]";
			}else{
				if($_REQUEST['sstr']!='' && $_REQUEST['sstr']!='Search by Candidate Name / ID#'){
					$SSTR.= " AND d.v_name LIKE '%$_REQUEST[sstr]%'";
				}
			}
		}
		
		$where="";
		if($IPAGE['m_where']!='') $where=$IPAGE['m_where'];
		if($LEVEL==3) $where= (($where!='')?"$where AND ":"")."c.user_id=$_SESSION[user_id]";

		if($_SESSION['user_id']==83){
			$SSTR="AND p.id=20";
		}
									

		if($_REQUEST['o'] == 'a') $o = 'd'; else $o='a';
		if(is_numeric($_REQUEST['clntid'])) $ePrm="&clntid=$_REQUEST[clntid]";
		$PAGE ="?action=$action&atype=$aType$ePrm&o=$o&sort=";
?>
<div class="box grid_16 tabs">		
        <h2 class="box_head"><?=$PTITLE?></h2>
        <a href="#" class="grabber">&nbsp;</a>
        <a href="#" class="toggle">&nbsp;</a>
        <div class="toggle_container">
            <div class="block">
             <div id="dt2">
				<form class="table-form" action="" method="post" name="assignTask" enctype="multipart/form-data">
    <table class="display static">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th><a href="<?=$PAGE?>emp">ID#</a></th>
                <th width="18%"><a href="<?=$PAGE?>enm">Candidate Name</a></th>
                <th><a href="<?=$PAGE?>rdate" >Received Date</a></th>
                <th width="15%"><a href="<?=$PAGE?>vst">Status</a></th>
                <th>Done</th>
                <th><a href="<?=$PAGE?>cln">Client Name</a></th>
                <th><a href="<?=$PAGE?>vst">Verification Status</a></th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        <?php 
			$cols = "d.v_stdate,d.v_date,d.v_cldate,d.emp_id, d.v_id,.d.v_name,d.v_nic,d.com_id,d.v_ftname,d.v_status,d.v_rlevel,p.name,p.id,d.v_sent";
        	$tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN company p ON p.id=d.com_id";
        	$db_count = $db->select($tbls,"COUNT(DISTINCT d.v_id) as cnt","($where $SSTR)");
			$db_count =  mysql_fetch_array($db_count);
			$db_count = $db_count['cnt'];
			if($db_count>0){
			include("include_pages/pagination_inc.php");
			if(!isset($sort)) $sort = "ORDER BY d.v_id DESC";
            $data = $db->select($tbls,$cols,"($where $SSTR) GROUP BY d.v_id $sort $pages->limit");
			
            while($re = mysql_fetch_array($data)) { 
			$onClick="?action=details&case=$re[v_id]&_pid=$IPAGE[m_id]";
            $showChk  ="showData(this,'ePage=checksinfo&case=$re[v_id]&action=$action&atype=$aType','v$re[v_id]')";
            $pdfClick = "downloadPDF('pdf.php?pg=case&case=$re[v_id]')";
            
            $acPdf = $db->select("activity","COUNT(a_type) cnt","a_type='pdf' AND user_id=$USERID AND v_id=$re[v_id] AND ISNULL(ext_id)");
            $acPdf = mysql_fetch_array($acPdf);
			
            if($acPdf['cnt']>0) $PdfIcon="pdf_icn.png"; else $PdfIcon="PDF_download_icn.png"; 
            $csSts = strtolower($re['v_status']);
            ?>
            <tr>
                <td>
                	<img style="cursor:pointer;float:left;margin-top:18px;"  onClick="<?=$showChk?>" src="img/<?=($db_count==1)?'minusIcon.gif':'plusIcon.gif';?>" >
				<?php if(($LEVEL==2) && ($aType=='ready' || $aType=='send' || $action=='assign' || $action=='assigned' || $action=='problem')){?>
                   	<input style="margin-bottom:2px;float:right;" type="checkbox" name="record[]" value="<?=$re['v_id']?>">
                <?php } ?>
                </td>
                <td><?=$re['emp_id']?></td>
                <td style="text-align:left">
                    <a href="<?=$onClick?>"><?=$re['v_name']?></a>
                </td>
                
                <td >
                    <?=date("j-M-Y",strtotime($re['v_date']))?>
                </td>
                <td>
				<?php
                $tnt = countChecks("vc.v_id=$re[v_id]");
                $cnt = countChecks("vc.as_status='close' AND vc.v_id=$re[v_id]");
                $pbr = @($cnt/($tnt))*100;									
                
                $red="(as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found')";
                $red = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $red AND as_isdlt=0");
                $red = mysql_fetch_assoc($red);
								
				$disp = "(as_vstatus='unable to verify' OR as_vstatus='discrepancy')";
                $disp = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $disp AND as_isdlt=0");
                $disp = mysql_fetch_assoc($disp); ?>
                
                    <div class="progress_bar">
                        <span><?=round($pbr,2)?>%</span>
                        <div class="bar <?=(($red['cnt']>0)?'red':(($disp['cnt']>0)?'yellow':'green'))?>" style="width:<?=$pbr?>%"></div>
                    </div>
                </td>
                <td ><?="$cnt of $tnt"?></td>
                <td style="text-align:left" >
                    <?=$re['name']?>
                </td>
                <td >
                    <span class="f<?=vs_Status(strtolower($re['v_rlevel']))?>">
                        <?php echo $re['v_rlevel'].' [ '.$re['v_status'].' ]'; ?>
                    </span>
                </td>
                <td class="shover">
                    <?php if($csSts=='close'){ ?>
                        <div class="mainShrt">
                            <img style="cursor:pointer" onclick="<?=$pdfClick?>" title="Generate PDF" src="images/icons/<?=$PdfIcon?>">
                        </div>
                    <?php } ?>                                    
                </td>
            </tr> 
            <tr style="display:none;">
            <td colspan="9"></td></tr>
            <tr>
                <td class="inTD" colspan="9" style=" <?=($db_count==1)?'padding:0;':'display:none;';?>" id="v<?=$re['v_id']?>">
                <?php 
                    $_REQUEST['case'] = $re['v_id'];
                    if($db_count==1){
                        include("include_pages/checksinfo_inc.php");
                    }
                ?>
                </td>
            </tr>       
        <?php }}else{ ?>
        	<tr><td colspan="9" align="center"><strong>No Record Found</strong></td></tr>
		<?php } ?>
        </tbody>
    </table>
    <div class="button_bar clearfix">    
<?php 
	if($db_count>0){ 
		if(($LEVEL==2 && $action=='close') && ($aType=='ready' || $aType=='send')){ ?>
            	<input type="hidden" name="atype" value="<?=$aType?>"  />
                <?php if($aType=='ready') $acBtn="Sent to"; else $acBtn="Remove from";?>
                <button class="btnright div_icon has_text text_only" type="submit" name="sentto" ><span><?=$acBtn?> Client</span></button>
<?php 	}		
		if($LEVEL==2 && ($action=='assign' || $action=='assigned' || $action=='problem')){?>
               <div style="float:left;width:400px;">
                <button class="btnright div_icon has_text text_only" style="float:left;" type="submit" name="opencasck">
                <span>Open Cases / Checks</span>
                </button> 
                <button class="btnright div_icon has_text text_only" style="float:right;" type="submit" name="delecasck">
                <span>Remove Cases / Checks</span>
                </button>               		
               </div>
        <?php if($action!='problem'){?>       
               <div style="float:right;">
               <div style="float:left;"> 
                <select name="uid" id="uid" style="margin-bottom:4px;" class="select_box" >
                    <option value="0">Select Analyst</option>
                	<?php
					if($_SESSION['user_id']==83){
						$dWhere="level_id=3 AND user_id=50";
					}else $dWhere="level_id=3";
														
                	$users = $db->select("users","*",$dWhere); 
                	while($user =mysql_fetch_array($users)){ ?>
                    	<option value="<?=$user['user_id']?>"><?=trim($user['first_name'].' '.$user['last_name'])?></option>
               		<?php } ?>
                </select> 
                </div>
                <button class="btnright div_icon has_text text_only" style="float:right;" type="submit" name="<?=($action=='assigned')?'r':''?>assigncases">
                <span><?=($action=='assigned')?'Re-':''?>Assign Cases / Checks</span>
                </button>
                </div>
        <?php }?>
<?php	}
	}?>
        <div class="clear"></div>
    </div>
    
</form>
				<?php include("include_pages/pager_inc.php"); ?>
            </div>
            </div>
        </div>
    </div>
