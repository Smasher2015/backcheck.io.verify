<?php
	$coInfo = companyInfo($_SESSION['user_id']);
	$where="(com_id=$coInfo[id])";
	switch($action){
		case'ordercloses':
			$where .=" AND (v_status='Close' AND v_sent=4)";
			$title="Close";
		break;
		case'saveorders':
			$where .=" AND v_save=1";
			$title="Saved";
		break;		
		default:
			$title="Order History";
			$where .=" AND v_save=0";
		break;				
	}
	if(is_numeric($_REQUEST['case'])){
		if(isset($_REQUEST['addchecks'])){			
			echo addChecks($_REQUEST,$LEVEL);	
		}
	}	
?>
<div class="innerdiv">
     <h2 class="head-alt"><?php echo $title;?> Case(s)</h2>
        <div class="innercontent">
            <table style="width:100%">
                <thead>
                    <tr>
                        <th >&nbsp;</th>
                        <th><a href="javascript:void(0);" >Candidate Name</a></th>
                        <th><a href="javascript:void(0);" >Father's Name</a></th>
                        <th><a href="javascript:void(0);" >N.I.C</a></th>
                        <th><a href="javascript:void(0);" >Check(s)</a></th>
                        <th><a href="javascript:void(0);" >Verification Status</a></th>  
                    </tr>
                </thead>
                <tbody>
                <?php 
                if($coInfo!==false && isset($where)){
                    $username = $_SESSION['username'];
                    $db_count = $db->select("ver_data","COUNT(v_id) as cnt",$where);
                    $db_count = mysql_fetch_array($db_count);
                    $db_count = $db_count['cnt'];
                }else $db_count=0;
                
                if($db_count>0){
                    include("include_pages/pagination_inc.php");
                    $data = $db->select("ver_data","*","$where $sort $pages->limit");
                    while($re = mysql_fetch_array($data)) { ?>
                    <tr class="shover" >
                        <td >
                        	<a href="javascript:void(0)">
                            	<img onClick="showChecks(<?php echo $re['v_id']; ?>,'<?php echo $action; ?>',this)" src="img/plusIcon.gif" >
                        	</a>
                        </td>
                        <td style="text-align:left"><?php echo $re['v_name']; ?></td>
                        <td><?php echo $re['v_ftname']; ?></td>
                        <td><?php echo $re['v_nic']; ?></td>
                        <td><?php echo counChecks($re['v_id']); ?></td>
                        <td>
							<?php 
								echo $re['v_rlevel'].' [ '.$re['v_status'].' ]';
								if(($LEVEL==4 && $re['v_sent']==4)){ ?>
                                	<a href="javascript:void(0)" onclick="downloadPDF('pdf.php?pg=case&vrID=<?php echo $re['v_id']; ?>')" >
                                        <img title="Generate PDF" style="float:right;margin-right:10px;" src="img/pdf_icon.png">
                                    </a>
                			<?php } ?>
                        </td>
                    </tr>
                    <tr><td style="display:none;" class="inTD" colspan="6" id="v<?php echo $re['v_id']; ?>"></td></tr>
                    <tr><td style="display:none;" colspan="6"></td></tr>
                <?php }}else{ ?>
                    <tr>
                    	<td colspan="6" >
                    		<h1 align="center">No Case Found</h1>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
<?php include("include_pages/pager_inc.php"); ?>
			<div class="clear"></div>
		</div>
        <div class="clear"></div>
</div>