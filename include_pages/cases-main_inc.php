        
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
        
        

        <section class="wrapper retracted scrollable">
            
            <script>
                if (!($('body').is('.dashboard-page') || $('body').is('.login-page'))){
                    if ($.cookie('protonSidebar') == 'retracted') {
                        $('.wrapper').removeClass('retracted').addClass('extended');
                    }
                    if ($.cookie('protonSidebar') == 'extended') {
                        $('.wrapper').removeClass('extended').addClass('retracted');
                    }
                }
            </script>
            
           
            
            <div class="row">
                <div class="col-md-12">
                  	<div class="report-sec">
                     <div class="panel panel-default panel-block">
                    	<div id="data-table" class="panel-heading datatable-heading">
                            <h4 class="section-title">Data Table</h4>
                    	</div>
	                    <table class="table table-bordered table-striped" id="tableSortable">
                            <thead>
                                    <tr>
										<th></th>
                                        <th>Candidate Name</th>
                                        <th>Status</th>
                                        <th>Done</th>
                                        
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

                            //if($acPdf['cnt']>0) $PdfIcon="pdf_icon-t.png"; else $PdfIcon="pdf_icon.png"; 

                            $csSts = strtolower($re['v_status']);

                            $csSts = (($csSts=='close') && ($re['v_sent']==4))?'close':'';

                            ?>

                                    <tr class="gradeX">
                                    	
                                        <td >
                                        	<span  data-toggle="collapse" data-target=".row_<?=$re['v_id']?>" >+</span>
                                        </td>
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
                                            <?php /*?><div class="progress_bar">
                                            <span><?=round($pbr,2)?>%</span>
                                            <div class="bar <?=(($red['cnt']>0)?'red':(($disp['cnt']>0)?'yellow':'green'))?>" style="width:<?=$pbr?>%"></div>
                                            </div><?php */?>
                                            
                                                <div class="progress">
                                                <div class="progress-bar <?php echo ($pbr > 30 ) ? 'progress-bar-success':'progress-bar-danger'; ?> " role="progressbar" aria-valuenow="<?=$pbr?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=$pbr?>%" data-original-title="" title="">
                                                <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                                </div>
                                        </td>
                                        <td >
                                            <?="$cnt of $tnt"?>
                                        </td>
                                    
                                    </tr> 
                                    
                        <?php }?>

                        </tbody>
	                    </table>
		            </div>
                    </div>
                </div>
            </div>
        </section>

<script>
$(document).ready(function(e) {
    $('.collapse').on('show.bs.collapse', function (e) {
    $('.collapse.in').collapse('hide');
});
});
</script>
        

		


        <!-- Page-specific scripts: -->
       
        <script src="scripts/proton/tables.js"></script>
 
       
 