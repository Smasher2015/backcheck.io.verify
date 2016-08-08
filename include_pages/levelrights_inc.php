   <section class="retracted scrollable">

   <div class="row">
       
                        
            <div class="col-md-12">
                <div class="manager-report-sec">
               
               <div class="panel panel-default panel-block">
               <div class="list-group-item">
               <div class="page-section-title">
               
                        <h2 class="box_head">Level Rights</h2>
                        </div>
                        <div class="toggle_container">	
            <div class="block">
             <div id="dt2">
 <table class="table table-bordered table-striped" id="tableSortable">
        <thead>
            <tr>
                <th>Levels / Rights</th>
				<?php
					$levels= $db->select("levels ORDER BY level_name","*");
                    $lCount= mysql_num_rows($levels);
					if($lCount>0){
                        while($level = mysql_fetch_array($levels)){ ?>
                              <th><?=trim($level['level_name'])?></th>	    
               <?php }  } ?>
            </tr>
        </thead>
        <tbody>
    	<?php	
			$rights= $db->select("menus2","*");
            if(mysql_num_rows($rights)>0){
            	while($right = mysql_fetch_array($rights)){ ?>
                    <tr>
                        <td><?="$right[m_actitle] $right[m_attitle]"?></td>
						<?php
                            $levels= $db->select("levels ORDER BY level_name","*");
                            if(mysql_num_rows($levels)>0){
                                while($level = mysql_fetch_array($levels)){ 
									$access = $db->select("access2","as_id","m_id=$right[m_id] AND level_id=$level[level_id]");
									if(mysql_num_rows($access)>0) $checked=true; else $checked=false;?>
                                      <td>
									  	<input type="checkbox" value="<?="$right[m_id]|$level[level_id]"?>" name="right" <?=($checked)?'checked="checked"':''?> />
                                      </td>	    
                       <?php }  } ?>                        
                    </tr>	    
       <?php }}else{ ?>
                    <tr>
                        <td colspan="<?=$lCount?>">
                        	<h2 align="center">No Record Found</h2>
                        </td>
                    </tr>
        <?php }?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<script type="text/javascript">
	var inputs = document.getElementsByTagName('input');
	for(var ind=0;ind<inputs.length;ind++){
		if(inputs.item(ind).type=='checkbox'){
			inputs.item(ind).onclick = function(){
				UpdateRights(this);	
			}
		}
	}
</script>