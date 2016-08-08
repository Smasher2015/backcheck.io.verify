<?php

	if(!isset($TWHERE)){	

		$betw= "";

		if(isset($_POST['sdate']) && isset($_POST['edate'])){

			$sdate=changDate($_POST['sdate']);

			$edate=changDate($_POST['edate'],1);

			$betw=" AND v_date between '$sdate' AND '$edate'";

		}	

		if(is_numeric($_REQUEST['com_check'])){

			$betw = "AND c.checks_id=$_REQUEST[com_check]";	

		}			

		if(!$COMINF) $COMINF['id']=0; 

		if($IPAGE['m_where']!='') $IPAGE['m_where'] = "$IPAGE[m_where] AND";

		$where="$IPAGE[m_where] com_id=$COMINF[id] $betw";

	}else{

		$where="$TWHERE AND v_isdlt=0 AND com_id=$COMINF[id]";

	}

?>

<div class="box grid_16 tabs">

    <h2 class="box_head"><?=$PTITLE?></h2>

    <a href="#" class="grabber">&nbsp;</a>

    <a href="#" class="toggle">&nbsp;</a>

    <div class="toggle_container">

        <div class="block">

            <div id="dt2">

                <form method="post" name="archiveCase" enctype="multipart/form-data">    

                   <table class="display datatable">

                        <thead>

                            <tr>

							<?php if($ACTION=='order' && $ATYPE=='certificate'){ ?> 

                                <th>&nbsp;</th>

                            <?php } ?>

                                <th>

                                    <div class="bmarked_icn">&nbsp;</div>

                                </th>

                                <?php  if($COMINF['id']==37){?>

                                <th>Reference ID</th>

                                 <?php } ?>

                                <th>Candidate Name</th>

                                <th>Status</th>

                                <th>Done</th>

                                <th><div class="comment_icn">&nbsp;</div></th>

                                <th><div class="alert_icn">&nbsp;</div></th>

                                <?php if($IPAGE['m_pdf']==1){?>    

                                    <th><div class="pdf_icn">&nbsp;</div></th>

                                <?php } ?>

                            

                            </tr>

                        </thead>

                        <tbody>

                        <?php 

                        $cols = "COUNT(d.v_id) AS cnt,d.v_crd,d.v_stdate,d.v_date,d.v_cldate,d.emp_id";

						$cols ="$cols,d.v_id,.d.v_name,d.v_nic,d.com_id,d.v_ftname,d.v_status,d.v_rlevel,p.name,p.id,d.v_sent,v_bmk,v_refid";

                        $tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN company p ON p.id=d.com_id"; 

                            $data = $db->select($tbls,$cols,"$where GROUP BY d.v_id ORDER BY d.v_id DESC");

                           	$dCount = mysql_num_rows($data); 

						    while($re = mysql_fetch_array($data)) { 

                            

                           $onClick="?action=details&case=$re[v_id]&_pid=$IPAGE[m_id]";

                            

                            $showChk="showData(this,'ePage=checksinfo&case=$re[v_id]&action=$action&atype=$aType','v$re[v_id]')";

                            $pdfClick = "downloadPDF('pdf.php?pg=case&case=$re[v_id]')";

                            

							$certClick = "downloadPDF('pdf.php?pg=certificate&id=$re[v_id]&name=$re[v_name]')";

							

                            $acPdf = $db->select("activity","COUNT(a_type) cnt","a_type='pdf' AND user_id=$USERID AND v_id=$re[v_id] AND ISNULL(ext_id)");

                            $acPdf = mysql_fetch_array($acPdf);

                            if($acPdf['cnt']>0) $PdfIcon="pdf_icon-t.png"; else $PdfIcon="pdf_icon.png"; 

                            $csSts = strtolower($re['v_status']);

                            $csSts = (($csSts=='close') && ($re['v_sent']==4))?'close':'';

                            ?>

                            <tr <?=($re['v_crd']==0)?'style="font-weight:bold"':''?> >

                               <?php if($ACTION=='order' && $ATYPE=='certificate'){ ?>   

                                    <td>

                                        <input type="checkbox" class="req"  name="acase[]" value="<?=$re['v_id']?>" />

                                    </td>

                               <?php }?>

                                <td align="center"  >

                                	<div onclick="bookmark(<?=$re['v_id']?>,this)">

                                    	 <span style="display:none"><?=$re['v_bmk']?></span>

                                   		 <img id="mk-<?=$re['v_id']?>" src="images/icons/<?=(($re['v_bmk']==1)?'bmarked':'umarked')?>.png"  style="cursor:pointer" />

                                    </div>

                                </td>

                                <?php  if($COMINF['id']==37){?>

                                <th><?=$re['v_refid']?></th>

                                 <?php } ?>

                                <td >

                                    <a style=" <?php echo $class; ?>" href="<?=$onClick?>">

                                    <?=$re['v_name']?>

                                    </a>

                                </td>

                                <td>

                                    <?php

                                    $tnt = countChecks("vc.v_id=$re[v_id] AND as_isdlt=0");

                                    $cnt = countChecks("vc.as_status='close' AND vc.v_id=$re[v_id] AND as_isdlt=0");

                                    $pbr = @($cnt/($tnt))*100;

									$red = "(as_vstatus='negative' OR as_vstatus='match found' OR as_vstatus='record found')";

									$red = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $red AND as_isdlt=0");

									$red = mysql_fetch_assoc($red);

									

                                    $disp="(as_vstatus='unable to verify' OR as_vstatus='discrepancy' OR as_vstatus='original required')";

                                    $disp = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND $disp AND as_isdlt=0");

                                    $disp = mysql_fetch_assoc($disp); ?>                

                                   <div class="progress_bar">

                                        <span><?=round($pbr,2)?>%</span>

                                        <div class="bar <?=(($red['cnt']>0)?'red':(($disp['cnt']>0)?'yellow':'green'))?>" style="width:<?=$pbr?>%"></div>

                                    </div>

                                </td>

                                <td >

                                    <?="$cnt of $tnt"?>

                                </td>

                                <td style="text-align:center">

                                    <?php 

                                    $cmts = $db->select("comments","COUNT(_mid) cnt","_mid=$re[v_id]");

                                    $cmts = mysql_fetch_assoc($cmts);

                                    if($cmts['cnt']>0) { ?>

                                    	<span style="display:none">1</span>

                                        <img src="images/icons/comment.png" title="You have Comments on this Check" />

                                    <?php } ?>                

                                </td>

                                <td style="text-align:center">

                                    <?php	

                                    $prbs = $db->select("ver_checks","COUNT(v_id) cnt","v_id=$re[v_id] AND as_status='problem'");

                                    $prbs = mysql_fetch_assoc($prbs);														

                                    if($prbs['cnt']>0){ ?>

                                    	<span style="display:none">1</span>

                                        <img src="images/icons/warning.png" title="You need to submit additional information" />

                                    <?php } ?>                 

                                </td>

                               <?php if($IPAGE['m_pdf']==1){?>    

                                    <td style="text-align:center">

                                       <?php if((strtolower($re['v_status'])=='close') && ($re['v_sent']==4)) { 

                                                    $pdfClick = "downloadPDF('pdf.php?pg=case&case=$re[v_id]')";

                                                    $tWhr = "a_type='pdf' AND user_id=$USERID AND v_id=$re[v_id] AND ext_id IS NULL";

                                                    $acPdf = $db->select("activity","COUNT(a_type) cnt",$tWhr);

                                                    $acPdf = mysql_fetch_array($acPdf);

                                                    if($acPdf['cnt']>0) $PdfIcon="pdf_icn.png"; else $PdfIcon="PDF_download_icn.png";?>	

                                       <img style="cursor:pointer;width:35px;" onclick="<?=$pdfClick?>" title="Generate PDF" class="imFri" src="images/icons/<?=$PdfIcon?>">

										<?php 

                                        $vSts = vs_Status(strtolower($re['v_rlevel']));

                                        if(isset($_REQUEST['certificate']) && ($disp['cnt']==0 && $red['cnt']==0)){?>

                                            <img style="cursor:pointer;width:35px;" onclick="<?=$certClick?>" title="Generate Certificate" src="images/certificate.png?>">	

                                        <?php }?> 

                                       <?php } ?>                    

                                    </td>

                                <?php } ?>

                            </tr>

                                    

                        <?php }?>

                        </tbody>

                    </table>

			<?php if($ACTION=='order' && $ATYPE=='certificate' && $dCount>0){ ?>

                    <div class="button_bar clearfix">

                        <button type="submit" class="btnright" name="ordCertif" />

                            <img src="images/icons/small/white/file_cabinet.png">

                        <span>Order Certificate</span>

                        </button>

                    </div>

           <?php } ?>

                </form>

            </div>

        </div>

    </div>

</div>

