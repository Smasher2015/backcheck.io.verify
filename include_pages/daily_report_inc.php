<div class="box grid_16 tabs">		
        <h2 class="box_head">Daily Report</h2>
        <a href="#" class="grabber">&nbsp;</a>
        <a href="#" class="toggle">&nbsp;</a>
        <div class="toggle_container">
            <div class="block">
             <div id="dt2">  
             <?php echo date("Y-m-d");?>
    <table class="display datatable">
    	<thead>
    		<tr>
        		<th>Client</th>
            	<th>Recieved</th>
                <th>Closed</th>
                <th>Open</th>
                <th>Insufficient</th>
                <th>Original Required</th>
                <th>Net Open</th>
                <th>Initiated</th>
                <th>Follow Up</th>
        	</tr>
        </thead>
        
        <tbody>
          <?php	$dreports= $db->select("company","*","is_active=1");
        if(mysql_num_rows($dreports)>0){
        while($dreport = mysql_fetch_array($dreports)){ ?>
            <tr>
                <td><?=$dreport['name']?></td>
                <td><?php
                	$data = $db->select("ver_data","COUNT(v_id) cnt","com_id=$dreport[id] AND v_isdlt=0 AND v_date LIKE \"2014-02-12%\"");
					$data = mysql_fetch_array($data);
					echo $data['cnt'];
				?></td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>	    
    	<?php }}?>
            </tr>
        </tbody>
        
    </table>
        </div>
            </div>
        </div>
    </div>
