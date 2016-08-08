<?php include ('include/config.php');
include ('include/config_actions.php');

//$v_id = 11492;
//$_REQUEST['ascase'] = $_REQUEST['ascase'];
//$_REQUEST['case'] = $v_id;

include ('include_pages/boxex_inc.php');
$IPAGE['m_where'] = "v_isdlt=0 AND as_isdlt=0 AND com_id NOT IN (20,81,82,92)";
$IPAGE['m_id'] = 1;
$IPAGE['m_where'];
$action='assigned';
$atype='case';
$ATYPE = 'case';
$buid = (int) $_REQUEST['buid'];
$special_id_for_delete_checks = 522; // zubair bitrix id	
//company/personal/user/484/tasks/task/view/40701/
?>
		

	<link href="<?php echo SITE_URL; ?>dashboard/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SITE_URL; ?>dashboard/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SITE_URL; ?>dashboard/assets/css/core.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SITE_URL; ?>dashboard/assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo SITE_URL; ?>dashboard/assets/css/colors.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="styles/jquery.mCustomScrollbar.min.css">
    <link href="styles/proton.css" rel="stylesheet" type="text/css">
	<link href="styles/bt_chcks.css" rel="stylesheet" type="text/css">
	<script> var SURL = "<?php echo SURL;?>";</script>
 <script type="text/javascript" src="http://backcheckgroup.com/support/modules/livehelp/scripts/jquery-latest.js"></script>
 
<script type="text/javascript" src="<?php echo SURL; ?>dashboard/assets/js/core/libraries/bootstrap.min.js"></script>
  <script src="<?php echo SURL; ?>scripts/vendor/modernizr.js"></script>
	<script src="<?php echo SITE_URL; ?>js/ajax_script-2.js?ver=3.4"></script>
    <script src="<?php echo SITE_URL; ?>js/js_functions-2.js?ver=3.4"></script>
    <script src="<?php echo SITE_URL; ?>js/encoder.js?ver=3.4"></script>
	
        <!-- Common Scripts: -->
        <script> var SURL = "http://backcheck.io/verify/";</script>
      
	   
            	 
<div id="main_container" class="main_container container_16 clearfix">
      <?php			
		if(is_numeric($_REQUEST['clntid'])){
			$SSTR.= " AND p.id=$_REQUEST[clntid]";
		}
		
		if(is_numeric($_REQUEST['s_checks_id'])){
			$SSTR.= " AND c.checks_id=$_REQUEST[s_checks_id]";
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
		if(($LEVEL==3 || $LEVEL==12) && $action!='assign') $where= (($where!='')?"$where AND ":"")."c.user_id=$_SESSION[user_id]";
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
                    <th><a href="<?=$PAGE?>vst">Status</a></th>
                    <th><a href="<?=$PAGE?>emp">Done</a></th>
                    <th><a href="<?=$PAGE?>cln">Client Name</a></th>
                    <th><a href="<?=$PAGE?>vst">Verification Status</a></th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
			$cols = "d.v_stdate,d.v_date,d.v_cldate,d.emp_id, d.v_id,.d.v_name,d.v_nic,d.com_id,d.v_ftname,d.v_status,d.v_rlevel,p.name,p.id,d.v_sent,bitrixlid";
        	$tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN company p ON p.id=d.com_id";
			//echo "select $cols from $tbls where ($where $SSTR)";
        	$db_count = $db->select($tbls,"COUNT(DISTINCT d.v_id) as cnt","($where $SSTR)");
			$db_count =  mysql_fetch_array($db_count);
			$db_count = $db_count['cnt'];
			if($db_count>0){
			include("include_pages/pagination_inc.php");
			if(!isset($sort)) $sort = "ORDER BY d.v_id DESC";
            $data = $db->select($tbls,$cols,"($where $SSTR) GROUP BY d.v_id $sort $pages->limit");
			//echo "SELECT $cols FROM $tbls ($where $SSTR) GROUP BY d.v_id $sort $pages->limit $orderby $limit";
            while($re = mysql_fetch_array($data)) { 
			$bitrixlid = (int) $re[bitrixlid];
			if(is_numeric($bitrixlid) && $bitrixlid!=0){
			$onClick="http://my.backcheck.io/crm/lead/show/$bitrixlid/";
			}else{
			$onClick=SITE_URL."?action=details&case=$re[v_id]&_pid=$IPAGE[m_id]";	
			}
			
            $showChk  ="showData(this,'ePage=checksinfo&case=$re[v_id]&action=$action&atype=$aType&buid=$buid','v$re[v_id]')";
            $pdfClick = "downloadPDF('pdf.php?pg=case&case=$re[v_id]')";
            
			$certClick = "downloadPDF('pdf.php?pg=certificate&id=$re[v_id]&name=$re[v_name]')";
            
			$acPdf = $db->select("activity","COUNT(a_type) cnt","a_type='pdf' AND user_id=$USERID AND v_id=$re[v_id] AND ISNULL(ext_id)");
            $acPdf = mysql_fetch_array($acPdf);
			
            if($acPdf['cnt']>0) $PdfIcon="pdf_icn.png"; else $PdfIcon="PDF_download_icn.png"; 
            $csSts = strtolower($re['v_status']);
            ?>
                  <tr>
                    <td><img style="cursor:pointer;float:left;margin-top:18px;"  onClick="<?=$showChk?>" src="img/<?=($db_count==1)?'minusIcon.gif':'plusIcon.gif';?>" >
                      <?php if(($action=='notin' && $LEVEL==2 && $buid==$special_id_for_delete_checks) || ($action=='assign' && $LEVEL==3) || ($action=='assign' && $LEVEL==1) || (($LEVEL==2) && ($aType=='ready' || $aType=='send' || $action=='assign' || $action=='assigned' || $action=='problem'))){?>
                      <input style="margin-bottom:2px;float:right;" type="checkbox" name="record[]" value="<?=$re['v_id']?>">
                      <?php } ?></td>
                    <td><?=$re['emp_id']?></td>
                    <td style="text-align:left"><a href="<?=$onClick?>" target="_blank">
                      <?=$re['v_name']?>
                      </a></td>
                    <td ><?=date("j-M-Y",strtotime($re['v_date']))?></td>
                    <td><?php
                $tnt = countChecks("vc.v_id=$re[v_id]");
                $cnt = countChecks("vc.as_status='close' AND vc.v_id=$re[v_id]");
                $pbr = @($cnt/($tnt))*100;									
                
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
                  <?php } ?>
                </tbody>
              </table>
			  <div class="clearfix"></div>
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <?php 
	if($db_count>0){ 
		if(($LEVEL==2 && ($action=='close' || $action=='assigned')) && ($aType=='case' || $aType=='ready' || $aType=='send')){ ?>
		<?php if ($buid==$special_id_for_delete_checks){ 
					?>	
                    <input type="hidden" name="atype" value="<?=$aType?>"  />
                    <?php if($aType=='ready') $acBtn="Sent to"; else $acBtn="Remove from";?>
                     <?php /* <div class="col-md-3"><button class="btn filebtn btn-success btnright div_icon has_text text_only" type="submit" name="sentto" ><span>
                    <?=$acBtn?>
                    Client</span></button></div> */ ?>
					
								
        			 <div class="col-md-3"><button class="btn filebtn btn-success btnright div_icon has_text text_only" style="float:left;" type="submit" name="opencasck"> <span>Re-Open If Cases / Checks Closed</span> </button></div>
					 <div class="col-md-3">
                   
                      
                     <?php /*  <button class="btn filebtn btn-success btnright div_icon has_text text_only" style="float:right;" type="submit" name="delecasck"> <span>Remove Cases / Checks</span> </button> */ ?>
                   
                  </div>
				  
					<?php } ?>
                    <?php 	} ?>
 </div>					
		<?php /* if(($action=='notin' && $LEVEL==2 && $buid==$special_id_for_delete_checks) || ($action=='assign' && $LEVEL==1) || ($action=='assign' && $LEVEL==3) || ($LEVEL==2  && ($action=='assign' || $action=='assigned' || $action=='problem'))){
				
			?>				
        		
                 
				
                 
				<?php    if ($buid!=$special_id_for_delete_checks){   
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
                    <button class="btn filebtn btn-success"  type="submit" name="<?=($action=='assigned')?'r':''?>assigncases"> <span>
                    <?=($action=='assigned')?'Re-':''?>
                    Assign Cases / Checks</span> </button>
                  </div>
					<?php } ?>
                </div>
                <?php }  ?>
                <?php	} */
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

</section></div>
		

		<script src="<?php echo SITE_URL; ?>scripts/main.js"></script>
        <script src="<?php echo SITE_URL; ?>scripts/proton/common.js"></script>
         
        <!-- Page-specific scripts: -->
      	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

        <script src="<?php echo SITE_URL; ?>scripts/proton/dashboard.js"></script>
        <script src="<?php echo SITE_URL; ?>scripts/proton/dashdemo.js"></script>
               
        <!-- Notifications -->
        <!-- http://pinesframework.org/pnotify/ -->
        <script src="<?php echo SITE_URL; ?>scripts/vendor/jquery.pnotify.min.js"></script>
     
<script type="text/javascript">
		
		 
			<?php if($_REQUEST['CNT']>0){
					if($_REQUEST['TERR']!='') { 
					foreach($_REQUEST['TERR'] as $ERR){?>
					   proton.dashboard.alerts('<?=$ERR?>','Error!','error');
			<?php 	}}
					if($_REQUEST['TSCS']!='') { 
					foreach($_REQUEST['TSCS'] as $SCS){?>
						 proton.dashboard.alerts('<?=$SCS?>','Success','success');
			<?php 	}}		
				   } ?>
				   
</script>
	
	