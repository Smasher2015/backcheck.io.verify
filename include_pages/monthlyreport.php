<div class="box grid_16 tabs">		
    <h2 class="box_head">Section Search Filters</h2>
    <a href="#" class="grabber">&nbsp;</a>
    <a href="#" class="toggle">&nbsp;</a>
    <div class="toggle_container">
        <div class="block">
            <div id="filters" class="section" >
                <div >
                    <form class="table-form" method="post">
							<div style="float:left; width:650px;">
                            	
                                <div style="float:right;width:300px;">	
                                    <select name="clntid" class="select_box full_width">
                                        <option value=""> ----------- Client [ All ] ----------- </option>
                                        <?php 	$db = new DB();
                                                if($_SESSION['user_id']==50 || $_SESSION['user_id']==83){
                                                    $dWhere="id=20";
                                                }else $dWhere="is_active=1";							
                                                $coms = $db->select("company","*",$dWhere);
                                                $coid = (isset($_REQUEST['clntid']))?$_REQUEST['clntid']:0;
                                                while($com =mysql_fetch_array($coms)){  ?>
                                                    <option value="<?=$com['id']?>" <?php echo ($com['id']==$coid)?'selected="selected"':'';?>>
                                                        <?=$com['name']?>
                                                    </option>
                                        <?php	} ?>
                                    </select>
                                </div>                                
                            </div>
                            <button class="btnright div_icon has_text text_only" style="float:left;" type="submit" name="Search_btn">
                                <span>Search</span>
                            </button>
                    </form>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<?php if(isset($_POST['clntid'])){?>
<div class="box grid_16 tabs">
  <h2 class="box_head"><?=$PTITLE?></h2>
  <a href="#" class="grabber">&nbsp;</a> <a href="#" class="toggle">&nbsp;</a>
  <div class="toggle_container" style="overflow:auto">
    <div class="block" style="overflow:auto">
        <table class="static" style="overflow:auto">
          <thead>
            <tr>
              <th>Company Name</th>
			  <th>Checks</th>
              <?php
              	$months = $db->select("ver_checks","DATE_FORMAT(as_addate,'%b-%Y') AS monthly,DATE(as_addate) AS updated_date","as_isdlt=0 GROUP BY monthly ORDER BY updated_date");
				$marray = array();
				while($month = mysql_fetch_assoc($months)){
					$marray[count($marray)]['month'] = $month['monthly']; 
				}
				
				foreach($marray as $month){ 
					if($month['month']!='') {  ?>
					<th><strong><?=$month['month']?></strong></th>
		  <?php 	} 
				}?>
            </tr>
          </thead>
          <tbody>
            <?php	
				if(is_numeric($_POST['clntid'])) $where="id=$_POST[clntid]"; else $where="";
				$companies= $db->select("company","*",$where);
			if(mysql_num_rows($companies)>0){
			while($company = mysql_fetch_array($companies)){ ?>
            <tr>
              <td colspan="<?=count($marray)+1?>" style="background-color:#03F;color:#FFF"><strong><?=$company['name']?></strong></td>
            </tr>
            
              <?php
              	$checks = $db->select("checks","*","is_active=1");
				while($check = mysql_fetch_array($checks)){ 

					$table = "`ver_data` vd INNER JOIN `ver_checks` vc ON vd.`v_id`=vc.`v_id`";
					$colms = "COUNT(vc.`checks_id`) checks";
					$where = "vd.`com_id`=$company[id] AND vd.v_isdlt=0 AND vc.`as_isdlt`=0 AND vc.`checks_id`=$check[checks_id]";
					$checkcount = $db->select($table,$colms,$where);
					$checkcount = mysql_fetch_assoc($checkcount); 
					if($checkcount['checks']>0){?>
                        <tr>
                              <td>&nbsp;</td>
                              <td><strong><?=$check['checks_title']?></strong></td>
                              <?php	
                                                          
                                    foreach($marray as $month){ 
                                        if($month['month']!='') {  
                                            $checkcount = $db->select($table,$colms,"$where AND DATE_FORMAT(vc.`as_addate`,'%b-%Y')='$month[month]'");
                                            $checkcount = mysql_fetch_assoc($checkcount);?>
                                            <td><?=$checkcount['checks']?></td>
                                <?php 	}
                                    } 
                                ?>
                      </tr>
			<?php	}
				}?>
            <tr>
              <td colspan="<?=count($marray)+1?>" style="background-color:#FFF;color:#FFF"><strong>&nbsp;</td>
            </tr>
            <?php }} ?>
          </tbody>
        </table>
    </div>
  </div>
</div>
<?php }?>