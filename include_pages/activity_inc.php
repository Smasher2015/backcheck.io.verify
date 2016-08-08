<?php 
	$where = "";
	$SSTR = "AND as_pdate LIKE '2012-01-17%'";
?>
<form class="table-form" action="" method="post" name="assignTask" enctype="multipart/form-data">
<table>
    <thead>
        <tr>
        	<th>WIP No. of check(s)</th>
            <th>Initiated No. of check(s)</th>
            <th>Followedup No. of check(s)</th>           
            <th>Closed No. of check(s)</th>
        </tr>
    </thead>
    <tbody>
    <?php 	$tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id"; 
		
			$where = "as_vstatus<>'Not Initiated' AND as_status<>'Close'";
			$twip = $db->select($tbls,"*","($where $SSTR)");
			$where = "as_vstatus='Initiated'";
			$tInitit = $db->select($tbls,"*","($where $SSTR)");	
						
			$where = "as_vstatus='Followup'";
			$tFollow = $db->select($tbls,"*","($where $SSTR)");				

			$where = "as_status='Close'";
			$tClose = $db->select($tbls,"*","($where $SSTR)");
	?>
		<tr class="shover">
        	<td style="text-align:center"><?=mysql_num_rows($twip)?></td>
            <td><?=mysql_num_rows($tInitit)?></td>
            <td><?=mysql_num_rows($tFollow)?></td>
            <td><?=mysql_num_rows($tClose)?></td>
        </tr>        
        <tr >
        	<td>
            <?php if(mysql_num_rows($twip)>0){ 
				  	echo '<table">';               
				 	while($re = mysql_fetch_array($twip)) { ?>
                        <tr class="shover"><td><?=$re['v_name']?></td></tr>	
			<?php   }
					echo '</table>';	
				  }else{ ?>
        		   		<h1 align="center">No Record Found</h1>
    		<?php }?>
            </td>
            <td>
            <?php if(mysql_num_rows($tInitit)>0){ 
				  	echo '<table>';               
				 	while($re = mysql_fetch_array($tInitit)) { ?>
                        	<tr class="shover"><td><?=$re['v_name']?></td></tr>	
			<?php }
					echo '</table>';	
				  }else{ ?>
        		   		<h1 align="center">No Record Found</h1>
    		<?php }?>
            </td>
            <td>
            <?php if(mysql_num_rows($tFollow)>0){ 
				  	echo '<table>';               
				 	while($re = mysql_fetch_array($tFollow)) { ?>
                        	<tr class="shover"><td><?=$re['v_name']?></td></tr>	
			<?php }
					echo '</table>';	
				  }else{ ?>
        		   		<h1 align="center">No Record Found</h1>
    		<?php }?>            
            </td>           
            <td>
            <?php if(mysql_num_rows($tClose)>0){ 
				  	echo '<table>';               
				 	while($re = mysql_fetch_array($tClose)) { ?>
                        	<tr class="shover"><td><?=$re['v_name']?></td></tr>	
			<?php }
					echo '</table>';	
				  }else{ ?>
        		   		<h1 align="center">No Record Found</h1>
    		<?php }?>
            </td>
        </tr>        
   
    </tbody>
</table>
</form>
