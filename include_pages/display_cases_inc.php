<?php	$special_id_for_delete_checks = 243; // erum		
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
		
		if($_SESSION['user_id']==83){
			$SSTR="AND p.id=20";
		}
									

		if($_REQUEST['o'] == 'a') $o = 'd'; else $o='a';
		if(is_numeric($_REQUEST['clntid'])) $ePrm="&clntid=$_REQUEST[clntid]";
		$PAGE ="?action=$action&atype=$aType$ePrm&o=$o&sort=";
	
?>

<section class="retracted scrollable">
  <div class="row">
    <div class="col-md-12">
      <?php include("include_pages/filters_inc.php"); ?>
      <div class="report-sec">
        <div class="page-section-title">
          <?php include('include_pages/pages_breadcrumb_inc.php'); ?>
        </div>
        <div class="panel panel-default panel-block"> 
          <!-- <h2 class="box_head"><?php //echo // $PTITLE?></h2> -->
          
          <div class="list-group">
            <div class="list-group-item">
            <div id="dt2" class="section">
            <form class="table-form" action="" method="post" name="assignTask" enctype="multipart/form-data">
              <table class="table table-bordered table-striped" id="tableSortable">
                <thead>
                  <tr>
                    <th>&nbsp;</th>
                    <th><a href="<?=$PAGE?>emp">ID#</a></th>
                    <th width="18%"><a href="<?=$PAGE?>enm">Candidate Name</a></th>
                    <th><a href="<?=$PAGE?>rdate" >Received Date</a></th>
                    <th width="15%"><a href="<?=$PAGE?>vst">Status</a></th>
                    <th><a href="<?=$PAGE?>emp">Done</a></th>
                    <th><a href="<?=$PAGE?>cln">Client Name</a></th>
                    <th><a href="<?=$PAGE?>vst">Verification Status</a></th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
			$cols = "d.v_stdate,d.v_date,d.v_cldate,d.emp_id, d.v_id,.d.v_name,d.v_nic,d.com_id,d.v_ftname,d.v_status,d.v_rlevel,p.name,p.id,d.v_sent";
        	$tbls = "ver_data d INNER JOIN company p ON p.id=d.com_id";
			//echo "select $cols from $tbls where ($where $SSTR)";
        	$db_count = $db->select($tbls,"COUNT(DISTINCT d.v_id) as cnt","($where $SSTR)");
			$db_count =  mysql_fetch_array($db_count);
			$db_count = $db_count['cnt'];
			if($db_count>0){
			include("include_pages/pagination_inc.php");
			if(!isset($sort)) $sort = "ORDER BY d.v_id DESC";
            $data = $db->select($tbls,$cols,"($where $SSTR) GROUP BY d.v_id $sort $pages->limit");
			//echo "SELECT $cols FROM $tbls ($where $SSTR) GROUP BY d.v_id $sort $pages->limit $orderby $limit";
			$countBlankCases = 0;
            while($re = mysql_fetch_array($data)) { 
			$onClick="?action=details&case=$re[v_id]&_pid=$IPAGE[m_id]";
            $showChk  ="showData(this,'ePage=checksinfo&case=$re[v_id]&action=$action&atype=$aType','v$re[v_id]')";
            $pdfClick = "downloadPDF('pdf.php?pg=case&case=$re[v_id]')";
            
			$certClick = "downloadPDF('pdf.php?pg=certificate&id=$re[v_id]&name=$re[v_name]')";
            
			$acPdf = $db->select("activity","COUNT(a_type) cnt","a_type='pdf' AND user_id=$USERID AND v_id=$re[v_id] AND ISNULL(ext_id)");
            $acPdf = mysql_fetch_array($acPdf);
			
            if($acPdf['cnt']>0) $PdfIcon="pdf_icn.png"; else $PdfIcon="PDF_download_icn.png"; 
            $csSts = strtolower($re['v_status']);
			$tnt = countChecks("vd.v_id=$re[v_id]");
			$cnt = countChecks("as_status='Close' AND vd.v_id=$re[v_id]");
			$pbr = @($cnt/($tnt))*100;
			if($tnt==0 && $cnt==0){
			$countBlankCases++;
			$not_assigned_bgclr = "style='background-color:#F2DCDB;'";
			}else{
			$not_assigned_bgclr = "";
			}
			
            ?>
                  <tr <?php echo $not_assigned_bgclr;?>> 
                    <td><img style="cursor:pointer;float:left;margin-top:18px;"  onClick="<?=$showChk?>" src="img/<?=($db_count==1)?'minusIcon.gif':'plusIcon.gif';?>" >
                      <?php if(($action=='notin' && $LEVEL==2 && $_SESSION['user_id']==$special_id_for_delete_checks) || ($action=='assign' && $LEVEL==3) || ($action=='assign' && $LEVEL==1) || (($LEVEL==2) && ($aType=='ready' || $aType=='send' || $action=='assign' || $action=='assigned' || $action=='problem'))){?>
                      <input style="margin-bottom:2px;float:right;" type="checkbox" name="record[]" value="<?=$re['v_id']?>">
                      <?php } ?></td>
                    <td><?=$re['emp_id']?></td>
                    <td style="text-align:left"><a href="<?=$onClick?>">
                      <?=$re['v_name']?>
                      </a></td>
                    <td ><?=date("j-M-Y",strtotime($re['v_date']))?></td>
                    <td><?php
               							
                
                $red="(as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found')";
                $red = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $red AND as_isdlt=0");
                $red = mysql_fetch_assoc($red);
								
				$disp = "(as_vstatus='unable to verify' OR as_vstatus='discrepancy' OR as_vstatus='original required')";
                $disp = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $disp AND as_isdlt=0");
                $disp = mysql_fetch_assoc($disp); ?>
                      <div class="progress_bar"> <span>
                        <?=round($pbr,2)?>
                        %</span>
                        <div class="bar <?=(($red['cnt']>0)?'red':(($disp['cnt']>0)?'yellow':'green'))?>" style="width:<?=$pbr?>%"></div>
                      </div></td>
                    <td ><?="$cnt of $tnt"?></td>
                    <td style="text-align:left" ><?=$re['name']?></td>
                    <td ><span class="f<?=vs_Status(strtolower($re['v_rlevel']))?>"> <?php echo $re['v_rlevel'].' [ '.$re['v_status'].' ]'; ?> </span></td>
                    <td class="shover"><?php if($csSts=='close' && false){ ?>
                      <div class="mainShrt"> <img style="cursor:pointer;width:35px;" onclick="<?=$pdfClick?>" title="Generate PDF" src="images/icons/<?=$PdfIcon?>">
                        <?php 
                            //$vSts = vs_Status(strtolower($re['v_rlevel']));
                            if(isset($_REQUEST['certificate']) && ($disp['cnt']==0 && $red['cnt']==0)){?>
                        <img style="cursor:pointer;width:35px;" onclick="<?=$certClick?>" title="Generate Certificate" src="images/certificate.png?>">
                        <?php }?>
                      </div>
                      <?php } ?></td>
                  </tr>
                  <tr style="display:none;">
                    <td colspan="9"></td>
                  </tr>
                  <tr>
                    <td class="inTD" colspan="9" style=" <?=($db_count==1)?'padding:0;':'display:none;';?>" id="v<?=$re['v_id']?>"><?php 
                    $_REQUEST['case'] = $re['v_id'];
                    if($db_count==1){
                        include("include_pages/checksinfo_inc.php");
                    }
                ?></td>
                  </tr>
                  <?php }}else{ ?>
                  <tr>
                    <td></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><strong>No Record Found</strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <?php } 
				  ?>
                </tbody>
              </table>
			
              <div class="container">
                <div class="row">
                  <div class="col-md-3">
                    <?php 
	if($db_count>0){ 
		if(($LEVEL==2 && $action=='close') && ($aType=='ready' || $aType=='send')){ ?>
                    <input type="hidden" name="atype" value="<?=$aType?>"  />
                    <?php if($aType=='ready') $acBtn="Sent to"; else $acBtn="Remove from";?>
                    <button class="btn filebtn btn-success btnright div_icon has_text text_only" type="submit" name="sentto" ><span>
                    <?=$acBtn?>
                    Client</span></button>
                    <?php 	}		
		if(($action=='notin' && $LEVEL==2 && $_SESSION['user_id']==$special_id_for_delete_checks) || ($action=='assign' && $LEVEL==1) || ($action=='assign' && $LEVEL==3) || ($LEVEL==2  && ($action=='assign' || $action=='assigned' || $action=='problem'))){
			
			if ($_SESSION['user_id']!=$special_id_for_delete_checks){ 
			?>				
        			<button class="btn filebtn btn-success btnright div_icon has_text text_only" style="float:left;" type="submit" name="opencasck"> <span>Open Cases / Checks</span> </button>
			<?php } ?>
                  </div>
				 <?php if ($LEVEL==1 || $_SESSION['user_id']==$special_id_for_delete_checks) {  
				   ?>
                  <div class="col-md-3">
                   
                      
                      <button class="btn filebtn btn-success btnright div_icon has_text text_only" style="float:right;" type="submit" name="delecasck"> <span>Remove Cases / Checks</span> </button>
                   
                  </div>
				<?php }  if ($_SESSION['user_id']!=$special_id_for_delete_checks){   
				  ?>
                  <div class="col-md-3">
                    <?php if($action!='problem'){?>
                    <div class="form-group ">
                    <select name="uid" id="uid"  class="form-control select_box full_width" >
                      <option value="0">Select Analyst</option>
                      <?php
					if($_SESSION['user_id']==83){
						$dWhere=" (level_id=3 OR level_id=12) AND user_id=50";
					}else $dWhere=" (level_id=3 OR level_id=12) ";
														
                	$users = $db->select("users","*","$dWhere AND is_active=1"); 
                	while($user =mysql_fetch_array($users)){ ?>
                      <option value="<?=$user['user_id']?>">
                      <?=trim($user['first_name'].' '.$user['last_name'])?>
					  <?php if($user['level_id']==12){ echo "(Team Lead)";}?>
                      </option>
                      <?php } ?>
                    </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <button class="btn filebtn btn-success btnright div_icon has_text text_only"  type="submit" name="<?=($action=='assigned')?'r':''?>assigncases"> <span>
                    <?=($action=='assigned')?'Re-':''?>
                    Assign Cases / Checks</span> </button>
                  </div>
					<?php } ?>
                </div>
                <?php }?>
                <?php	}
	}?>
              </div>
              </form>
              </div>
              </div>
            
            <?php include("include_pages/pager_inc.php"); ?>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
<script>
$(document).ready(function(){
	$(".load-count").text('<?php echo $countBlankCases;?>');
});

</script>
