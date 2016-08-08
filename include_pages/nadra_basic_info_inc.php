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

<section class="retracted scrollable">
<div class="row">
  <div class="col-md-12">
    <div class="report-sec">
      <div class="panel panel-default panel-block">
    		<div class="page-section-title">
            <h2 class="box_head">Candidate's Basic Infomation</h2>	
			</div>
          <div class="list-group-item">  
        <?php  $mPrm="case=$data[v_id]&key="; ?>
        <table class="table table-bordered table-striped" id="tableSortable">
            <tbody>
                <tr class="shover">
                    <td >Candidate Name:</td>
                    <td >
                        <span id="v_name"><?php echo $data['v_name']; ?></span>
                        <?php /* if($ISEDIT){?>
                            <img class="edit" onclick="showEdit('edit','Candidate Name','<?= $mPrm ?>v_name')" src="img/edit-icon.png"  />
                        <?php } */ ?>
                    </td>
                </tr>
                <tr class="shover">
                    <td >Tracking#:</td>
                    <td >
                        <span id="emp_id"> <?=bcplcode($data['v_id'])?></span>
                    </td>
                </tr>                
                <tr class="shover">
                    <td >Candidate ID:</td>
                    <td >
                        <span id="emp_id"><?php echo $data['emp_id']; ?></span>
                    </td>
                </tr>        
                <tr class="shover">
                    <td>Father's Name:</td>
                    <td>
                        <span id="v_ftname"><?php echo $data['v_ftname']; ?></span>
                        <?php/*  if($ISEDIT){?>
                            <img class="edit" onclick="showEdit('edit','Fatder&lsquo;s Name','<?= $mPrm ?>v_ftname')" src="img/edit-icon.png"  />
                        <?php } */ ?>
                    </td>
                </tr>
                <tr class="shover">    
                    <td>N.I.C:</td>
                    <td >
                        <span id="v_nic"><?php echo $data['v_nic']; ?></span>
                        <?php /* if($ISEDIT){?>
                            <img class="edit" onclick="showEdit('edit','N.I.C:','<?= $mPrm ?>v_nic')" src="img/edit-icon.png"  />
                        <?php } */ ?>
                    </td>
                </tr>
                <tr class="shover">    
                    <td>Date of Birth:</td>
                    <td >
                        <span id="v_dob"><?php echo date("j-F-Y",strtotime($data['v_dob'])); ?></span>
                        <?php /* if($ISEDIT){?>
                            <img class="edit" onclick="showEdit('edit','Date of Birth','<?= $mPrm ?>v_dob&typ=date',500,260)" src="img/edit-icon.png"  />
                        <?php } */ ?>
                    </td>
                </tr>                
                <tr class="shover">    
                    <td>No. of Checks:</td>
                    <td ><?php echo counChecks($vid); ?></td>
                </tr>
                <tr class="shover">    
                    <td>Recieved Date:</td>
                    <td ><?php echo date("j-F-Y",strtotime($data['v_date'])); ?></td>
                </tr>                
                <tr class="shover">    
                    <td>Client's Name:</td>
                    <td ><?php 
                            $conInf = getcompany($data['com_id']);
                            $conInf = mysql_fetch_array($conInf);
                            echo $conInf['name'];
                         ?></td>
                </tr>
                <tr class="shover">    
                    <td>RISK LEVEL [ Case ]:</td>
                    <td class="<?=vs_Status(strtolower($data['v_rlevel']))?>" >
                        <?php echo $data['v_rlevel'].' [ '.$data['v_status'].' ]'; ?>
                    </td>
                </tr>  


				
                    
			<?php if($rsChecks['is_skipped']==1){?>
			<tr class="shover"> 
			<td colspan="2">			
				<form name="skip_check" id="skip_check" method="post" >
				<div class="button_bar clearfix" style="margin-top:30px;">
				<a   class="btnright img_icon has_text" onclick="submitSkipForm();"><span>Back to Quene</span></a>
                <input type="hidden" name="skipCheck" value="1"  />
				<input type="hidden" name="as_id" value="<?=$rsChecks['as_id']?>"  />
                
                <input type="hidden" value="0" name="is_skipped" />
                
                <div class="clear" ></div>
              </div>
			  </form>
			  </td>
                   
                </tr>
		  <?php } ?>

				
             </tbody>
          </table>
		 
          </div>
		  
     </div>
    </div>      
    </div>
</div>
</section>


   