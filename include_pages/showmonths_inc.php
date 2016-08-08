<?php if(is_numeric($_POST['cntid'])){?>
       <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                     <label>Select Month:</label>
                  </div>
                  <div class="col-md-9">
                    <select name="clntid" class="select_box full_width form-control" onchange="showRates(this.value)" >
                    <option value=""> --------Select Month-------- </option>
                    <?php 				
                    $cols = "DISTINCT DATE_FORMAT(c.as_date,'%M-%Y') AS `date`, DATE_FORMAT(c.as_date,'%Y-%m') AS `value`";
                    $tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id";
                    $wher = "c.as_isdlt=0 AND d.v_isdlt=0 AND d.com_id=$_POST[cntid] ORDER BY c.as_date DESC";
                    $data = $db->select($tbls,$cols,$wher);
                    if(mysql_num_rows($data)){
                            while($re = mysql_fetch_array($data)) {?>
                                <option value="<?=$re['value']?>" ><?=$re['date']?></option>
                    <?php	} 
                    }?>
                </select>
                    
                  </div>
                </div>
              </div>
<?php }?>
