<div class="box grid_16 tabs">		
    <ul class="tab_header clearfix">
        <li style="visibility:hidden"><a href="#tabs-1">Table Data</a></li>				
    </ul>	
    <a href="#" class="grabber"></a>
    <a href="#" class="toggle"></a>
    <div class="toggle_container">
        <div id="tabs-1" class="block">
            <div id="dt2">
<?php
include("include_pages/checks_acs_inc.php");

	if($_REQUEST['o'] == 'a') $o = 'd'; else $o='a';
	$PAGE ="?action=$action&atype=$aType&o=$o&sort="; 

function getDTitle($tp='t'){
		global $action;global $aType; global $LEVEL;
		if($LEVEL==4){
			if($tp=='t') return 'Received'; else return 's';
		}
		switch($action){
			case 'assigned':
				if($tp=='t') return 'Received'; else return 'r';
			case 'close':
				if($aType=='send'){
					if($tp=='t') return 'Sent'; else return 's';
				}else{
					if($tp=='t') return 'Closed'; else return 'c';
				}
			default:			
				if($tp=='t') return 'Received'; else return 'r';							 	
		}
} ?>

<table class="display datatable">
    <thead>
        <tr>
        	<th>EMP#</th>
            <th>Candidate Name</th>
            <th>Father's Name</th>
            <th><?=getDTitle()?> Date</th>
            <th>Checks</th>
            <th>Client Name</th>
            <th >Verification Status</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $cols = "COUNT(d.v_id) AS cnt,d.v_stdate,d.v_date,d.v_cldate,d.emp_id, d.v_id,.d.v_name,d.v_nic,d.com_id,d.v_ftname,d.v_status,d.v_rlevel,p.name,p.id,d.v_sent";
    $tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN company p ON p.id=d.com_id";
    $db_count = $db->select($tbls,"COUNT(DISTINCT d.v_id) as cnt","($where $SSTR)");
	
	$db_count = mysql_fetch_array($db_count);
    $db_count = $db_count['cnt'];
    include("include_pages/pagination_inc.php");
	if(!isset($sort)) $sort = "ORDER BY d.v_id DESC";
    if($db_count>0){
        $data = $db->select($tbls,$cols,"($where $SSTR) GROUP BY d.v_id $sort $pages->limit");
		
        while($re = mysql_fetch_array($data)) { 
		if($LEVEL==2 || $LEVEL==3 || $LEVEL==4){
			$onClick=" class=\"hover\" onclick=\"gotoLink('?action=details&case=$re[v_id]')\"";
		}else $onClick = " class=\"shover\" ";
		$showChk="showData(this,'ePage=checksinfo&case=$re[v_id]&action=$action&atype=$aType','v$re[v_id]')";
		$pdfClick = "downloadPDF('pdf.php?pg=case&case=$re[v_id]')";
		
		$acPdf = $db->select("activity","COUNT(a_type) cnt","a_type='pdf' AND user_id=$USERID AND v_id=$re[v_id] AND ISNULL(ext_id)");
		$acPdf = mysql_fetch_array($acPdf);
		if($acPdf['cnt']>0) $PdfIcon="pdf_icon-t.png"; else $PdfIcon="pdf_icon.png"; 
		$csSts = strtolower($re['v_status']);
		if($LEVEL==4) $csSts = (($csSts=='close') && ($re['v_sent']==4))?'close':'';
		?>
        <tr class="shover" >
            <td <?=$onClick?> >
				<?=$re['emp_id']?>
            </td>
            <td  <?=$onClick?>>
				<?=$re['v_name']?>
            </td>
            <td  <?=$onClick?> >
				<?=$re['v_ftname']?>
            </td>
            <td  <?=$onClick?> >
            	<?php  
					if($LEVEL==4){
						$tDate=$re['v_stdate'];
					}else{
						if($action=='close'){
							if($aType=='send') $tDate=$re['v_stdate']; else $tDate=$re['v_cldate'];
						}else $tDate=$re['v_date'];
					}
					if($tDate!=''){
						echo date("j-M-Y",strtotime($tDate));
					}else echo 'N/A';
				?>
            </td>
            <td <?=$onClick?> >
				<?=$re['cnt']." of ".counChecks($re['v_id'])?>
            </td>
            <td  <?=$onClick?> >
				<?=$re['name']?>
            </td>
            <td <?=$onClick?> >
            	<span class="f<?=vs_Status(strtolower($re['v_rlevel']))?>">
					<?php echo $re['v_rlevel'].' [ '.$re['v_status'].' ]'; ?>
                </span>
            </td>
            <td class="shover">
				<?php if($csSts=='close'){ ?>
                	<div class="mainShrt">
                    	<img onclick="<?=$pdfClick?>" title="Generate PDF" src="img/<?=$PdfIcon?>">
                    </div>
				<?php } ?>                                    
            </td>
        </tr>
                
    <?php }}?>
    </tbody>
</table>
            </div>
        </div>
    </div>
</div>
    