<?php
	$db = new DB();
	$vid = $_REQUEST['case'];
	$where="c.as_id=$_REQUEST[ascase]";

	$tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id ";
	$data = $db->select($tbls,"DISTINCT *",$where);
	$data = mysql_fetch_array($data);
	$csmSts = strtolower(trim($data['v_status']));
	$csrmk = strtolower(trim($data['v_wodr']));
	$ISEDIT = ($LEVEL==4)?false:(($csmSts=='close')?false:true);
				
	if($LEVEL==4) if($data['v_sent']!=4)$showRpt=false;	
	$chkInf = getCheck($data['checks_id'],0,0);
	$csmSts = strtolower(trim($data['as_status']));

?>

<div>
  <div>
    <div>
      <div class="panel panel-flat">
    		<div class="panel-heading">
            	<h5 class="panel-title">Candidate's Basic Infomation</h5>	
				
			</div>
            
          <div class="table-responsive">  
        <?php  $mPrm="case=$data[v_id]&key="; ?>
        <table class="table table-basic table-bordered" id="tableSortable">
            
            <tbody>
                <tr class="active">
                    	
					<td colspan="3" align="right">				  
           	   <?php if($data['v_status']=='Close'){?>
		   <a data-popup="tooltip" title="" data-placement="top" data-container="body" data-trigger="hover" data-original-title="Download Full Case Report" href="javascript:;"><button type="button"   class="btn bg-danger-400 btn-xs ml-5" title=""   onclick="downloadPDF('pdf.php?pg=case&case=<?php echo $data['v_id'];?>');"><i class="icon-cloud-download position-left"></i> Download Full Case Report</button></a>
		   <?php } 
			 if((strtolower($data['as_status'])=='close') &&  (strtolower($data['as_qastatus'])=='approved')) {  
			 $pdfClick = "downloadPDF('pdf.php?pg=case&ascase=$data[as_id]')"; ?>
                                                            
                  <a data-popup="tooltip" title="" data-placement="top" data-container="body" data-trigger="hover" data-original-title="Download Single Check Report" href="javascript:;"><button type="button"   class="btn bg-success-400 btn-xs" title=""      onclick="<?=$pdfClick?>"><i class="icon-cloud-download position-left"></i> Download Check Report</button></a>
                 
                <?php } ?>	
					
					</td>
					
					   
					
                </tr>
                
                <tr>
                    <td >Candidate Name:</td>
                    <td >
                        <span id="v_name"><?php echo $data['v_name']; ?></span>
                    </td>
                    <td><?php if($ISEDIT){?>
                            <?php /*?><img class="edit" onclick="showEdit('edit','Candidate Name','<?= $mPrm ?>v_name')" src="img/edit-icon.png"  /><?php */?>
                            <ul class="icons-list">
                                <li><a href="javascript:void(0)" onClick="showEdit('edit','Candidate Name','<?= $mPrm ?>v_name')" title="Edit"><i class="icon-pencil7"></i></a></li>
                            </ul>
                        <?php } ?>
                        	
                        </td>
                </tr>
				<tr>
                    <td >Barcode:</td>
                    <td >
                       <span class="barcodefont"><?=$data['as_bcode']?></span>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td >Tracking#:</td>
                    <td >
                        <span class="label label-success"><?=bcplcode($data['v_id'])?></span>
                    </td>
                    <td></td>
                </tr>                
                <tr>
                    <td >Candidate ID:</td>
                    <td >
                        <span id="emp_id"><?php echo $data['emp_id']; ?></span>
                    </td>
                    <td></td>
                </tr>        
                <tr>
                    <td>Father's Name:</td>
                    <td>
                        <span id="v_ftname"><?php echo $data['v_ftname']; ?></span>
                    </td>
                    <td> <?php if($ISEDIT){?>
                            <?php /*?><img class="edit" onclick="showEdit('edit','Fatder&lsquo;s Name','<?= $mPrm ?>v_ftname')" src="img/edit-icon.png"  /><?php */?>
                            <ul class="icons-list">
                              <li><a href="javascript:void(0)" onClick="showEdit('edit','Fatder&lsquo;s Name','<?= $mPrm ?>v_ftname')" title="Edit"><i class="icon-pencil7"></i></a></li>
                            </ul>
                             
                        <?php } ?></td>
                </tr>
                <tr>    
                    <td>N.I.C:</td>
                    <td >
                        <span id="v_nic"><?php echo $data['v_nic']; ?></span>
                        <?php if($ISEDIT){?>
                    </td>
                    <td> <?php /*?>  <img class="edit" onclick="showEdit('edit','N.I.C:','<?= $mPrm ?>v_nic')" src="img/edit-icon.png"  /><?php */?>
                            
                      <ul class="icons-list">
                              <li><a href="javascript:void(0)" onClick="showEdit('edit','N.I.C:','<?= $mPrm ?>v_nic')" title="Edit"><i class="icon-pencil7"></i></a></li>
                       </ul>
                        <?php } ?></td>
                </tr>
                <tr>    
                    <td>Date of Birth:</td>
                    <td >
                        <span id="v_dob"><?php 
						$v_dob = strtolower(str_replace(' ','',$data['v_dob']));
						echo ($v_dob!='0000-00-00' and $v_dob!='' and $v_dob!='n/a' and $v_dob!='na')?date("j-F-Y",strtotime($data['v_dob'])):'N/A'; ?></span>
                    </td>
                    <td><?php if($ISEDIT){?>
                           <?php /*?> <img class="edit" onclick="showEdit('edit','Date of Birth','<?= $mPrm ?>v_dob&typ=date',500,260)" src="img/edit-icon.png"  /><?php */?>
                            
                            <ul class="icons-list">
                              <li><a href="javascript:void(0)" onClick="showEdit('edit','Date of Birth','<?= $mPrm ?>v_dob&typ=date',500,260)" title="Edit"></i></a></li>
                       </ul>
                            
                        <?php } ?></td>
                </tr> 
				<tr>    
                    <td>Address:</td>
                    <td >
                        <span id="address"><?php echo ($data['v_address']!='')?$data['v_address']:'N/A'; ?></span>
                        <?php if($ISEDIT){?>
                    </td>
                    <td> 
                            
                      <ul class="icons-list">
                              <li><a href="javascript:void(0)" onClick="showEdit('edit','Address:','<?= $mPrm ?>v_address')" title="Edit"><i class="icon-pencil7"></i></a></li>
                       </ul>
                        <?php } ?></td>
                </tr>				
                <tr>    
                    <td>No. of Checks:</td>
                    <td ><?php echo counChecks($vid); ?></td>
                    <td></td>
                </tr>
                <tr>    
                    <td>Recieved Date:</td>
                    <td ><?php echo date("j-F-Y",strtotime($data['v_date'])); ?></td>
                    <td></td>
                </tr>                
                <tr>    
                    <td>Client's Name:</td>
                    <td ><?php 
                            $conInf = getcompany($data['com_id']);
                            $conInf = mysql_fetch_array($conInf);
                            echo $conInf['name'];
                         ?></td>
                         <td></td>
                </tr>
				<tr>    
                    <td>Added By:</td>
                    <td ><span class="label label-info"><?php 
                            $userInf = getUserInfo($data['as_uadd']);
                           
                            echo $userInf['first_name'].' '.$userInf['last_name'];
                         ?></span></td>
                         <td></td>
                </tr>
				<tr>    
                    <td>Analyst:</td>
                    <td ><span class="label label-info"><?php 
                            $userInf = getUserInfo($data['user_id']);
                         
                            echo $userInf['first_name'].' '.$userInf['last_name'];
                         ?></span></td>
                         <td></td>
                </tr>
                <tr>    
                    <td>RISK LEVEL [ Case ]:</td>
                    <td class="<?=vs_Status(strtolower($data['v_rlevel']))?>" >
                        <?php echo $data['v_rlevel'].' [ '.$data['v_status'].' ]'; ?>
                    </td>
                    <td></td>
                </tr>                
             </tbody>
          </table>
          </div>
     </div>
    </div>      
    </div>
</div>


