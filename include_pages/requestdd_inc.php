
<section class="retracted scrollable">
  <div class="row">
    <div class="col-md-12">
      <div class="manager-report-sec">
      <div class="page-section-title">
       <h2 class="box_head">Pending DD</h2> </div>
 <div class="list-group" >
          <div class="list-group-item" >
<form method="post" enctype="multipart/form-data">
  <a href="#" class="grabber">&nbsp;</a> <a href="#" class="toggle">&nbsp;</a>
  <table class="table table-bordered table-striped" id="tableSortable">
    <thead>
      <tr>
        <th>&nbsp;</th>
        <th>ID#</th>
        <th>Client Name</th>
        <th>University</th>
        <th>Beneficiary</th>
        <th>Cost</th>
        <th>Attachment</th>
      </tr>
    </thead>
    <tbody>
      <?php 
            $dWhere = "";
            if($LEVEL==3) $dWhere = "c.user_id=$_SESSION[user_id] AND ";						
            
            $tbls = "ver_data d INNER JOIN company p ON p.id=d.com_id INNER JOIN ver_checks c ON d.v_id=c.v_id";
            $data = $db->select($tbls,"*","$dWhere c.as_update=0 AND d.v_isdlt=0 AND c.as_isdlt=0 AND c.as_uni<>0 AND c.checks_id=1 AND c.as_status<>'Problem' AND c.as_status<>'Close' $SSTR ORDER BY c.as_id DESC");
            
            while($re = mysql_fetch_array($data)) {
                $showdd = false;
                $uni = $db->select("uni_info","*","uni_id=$re[as_uni]");
                $uni =  mysql_fetch_assoc($uni);
                
                if(($uni['uni_ddr']==1 && $uni['uni_nfe']==0) || $uni['uni_ddr']==1 && $uni['uni_nfe']==1) $showdd = true;
                
                if(!empty($uni['uni_region']) && !empty($uni['uni_city']) && $showdd) {?>
      <tr class="gradeX">
        <td><input type="checkbox" name="checks[]" value="<?=$re['as_id']?>"  />
          <input type="hidden" name="uni<?=$re['as_id']?>" value="<?=$re['as_uni']?>"  />
		  <input type="hidden" name="as_bcode<?=$re['as_id']?>" value="<?=$re['as_bcode']?>" /></td>
        <td ><?=$re['emp_id']?></td>
        <td><?=$re['name']?>
          <input type="hidden" name="cnm<?=$re['as_id']?>" value="<?=$re['name']?>"  /></td>
        <td ><?=$uni['uni_Name']?>
          <input type="hidden" name="unm<?=$re['as_id']?>" value="<?=$uni['uni_Name']?>"  /></td>
        <td><input type="text" name="benf<?=$re['as_id']?>" value="<?=$uni['uni_ben']?>" /></td>
        <td><input type="text" name="cost<?=$re['as_id']?>" value="<?=$uni['uni_fee']?>" /></td>
        <td><input type="file" name="file<?=$re['as_id']?>"  /></td>
      </tr>
      <?php }
            }?>
    </tbody>
  </table>
 
  <div class="button_bar clearfix">
    <button name="drequestDD" type="submit" style="float:left;" class="btnright div_icon has_text text_only"> <span>Request DD</span> </button>
    <button name="dskipDD" type="submit" style="float:right;" class="btnright div_icon has_text text_only" onclick="return issubmit()"> <span>Skip DD</span> </button>
    <div class="clear"></div>
  </div>
</form>
</div>
</div>
 </div>
  </div>
  </div>
<script type="text/javascript">
	function issubmit(){
			if(confirm("Are you sure!, you want to skip DDs")){
				return true;
			}
			return false;
	}
	
</script>