<?php
$tWhere='';
if($action!='details'){
	switch($LEVEL){
		case 2:
		case 4:	
			$tWhere = "vc.as_id<>$_REQUEST[ascase]";
		break;
		case 3:
			$tWhere = "user_id=$_SESSION[user_id] AND vc.as_id<>$_REQUEST[ascase]";
		break;
	}
}
	$verChecks = checkDetails($_REQUEST['case'],'',$tWhere);
	$vint=false; $mRmk='';
	while($verCheck = mysql_fetch_array($verChecks)){ 
		$userInfo = getUserInfo($verCheck['user_id']);
		$csSts = strtolower($verCheck['as_status']);
		$isShow=true;
		if($LEVEL==4) $isShow = ($verCheck['as_sent']==4)?true:false;
		$vmSts = strtolower($verCheck['v_rlevel']);
		$mRmk =  $verCheck['v_wodr'];
		if($verCheck['v_int']==1) $vint=true;

		if($LEVEL==2){
			$dTitle='Analyst Name';
			if($userInfo){
				$vName = trim($userInfo['first_name'].' '.$userInfo['last_name']); 
			}else{
				$vName = "Not Assigned";
			}
		}else{
			$vName=$verCheck['as_vstatus'];
			$dTitle='Check VS Status';
		}

		$acPdf = $db->select("activity","COUNT(a_type) cnt","a_type='pdf' AND user_id=$USERID AND ext_id=$verCheck[as_id]");
		$acPdf = mysql_fetch_array($acPdf);
		if($acPdf['cnt']>0) $PdfIcon="pdf_icon-t.png"; else $PdfIcon="pdf_icon.png"; 		

		$herf="?action=start&ascase=$verCheck[as_id]";
		$rptLink = "showAuto('report','$verCheck[checks_title] [ $verCheck[v_name] ]','ascase=$verCheck[as_id]',20)";?>
    	<div class="subUH">
			<h1 align="center" class="subHd">
                    <a style="color:#FFF;" href="<?=$herf?>">
                         <?=$verCheck['checks_title']?>
                         [ <span style="color:#F00000;" title="<?=$dTitle?>"><?=$vName?></span> ]
                         [ <span style="color:#F00000;" title="Check Status"><?=$verCheck['as_status'].notifiMsgs($verCheck)?></span> ]
                    </a>
                    <div class="mainShrt">
                        <img id="img_<?=$verCheck['as_id']?>" onclick="LoadData(<?=$verCheck['as_id']?>)"
                        title="Maximize" src="img/<?=($verCheck['as_id']==$_REQUEST['ascase'])?'condense':'expand'?>.png" />
                		<?php if($csSts=='close' && $isShow){ 
                        $pdfLnk = "pdf.php?pg=case&ascase=$verCheck[as_id]"; ?>
                        <img title="Generate PDF" src="img/<?=$PdfIcon?>" onclick="downloadPDF('<?=$pdfLnk?>')" >
                        <img title="View Report"  src="img/report_view.gif" onclick="<?=$rptLink?>">                                 		
                		<?php } ?>  
            		</div>                  
        			<div class="clear"></div>          
            </h1>
            <div id="asck_<?=$verCheck['as_id']?>" style="display:<?=($verCheck['as_id']==$_REQUEST['ascase'])?'block':'none'?>;">
			<?php if($verCheck['as_id']==$_REQUEST['ascase']) include("include_pages/list_checks_inc.php"); ?>
            </div>
        </div>
<?php } ?>