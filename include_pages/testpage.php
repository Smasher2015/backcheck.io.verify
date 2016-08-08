<table>
<thead>
	<tr>
    	<td>v_id</td>
        <td>as_id</td>
        <td>com_id</td>
        <td>as_cost</td>
        <td>clt_cost</td>
        <td>e</td>
    </tr>
</thead>
<?php
$regions = $db->select("`ver_data` vd INNER JOIN ver_checks vc ON vd.`v_id`=vc.`v_id`","DISTINCT vd.`v_id`,vc.`as_id`, vc.`checks_id`, vc.`as_cost`, vd.`com_id`, 
(SELECT clt_cost FROM `clients_checks` WHERE checks_id=vc.`checks_id` AND com_id=vd.`com_id` AND clt_active=1) AS clt_cost","YEAR(v_date)=2015");
						while($region = mysql_fetch_array($regions)){?>
            <tr>
                <td><?=$region['v_id']?></td>
                <td><?=$region['as_id']?></td>
                <td><?=$region['com_id']?></td>
                <td><?=$region['as_cost']?></td>
                <td><?=$region['clt_cost']?></td>
        		 <td>
				<?php
                if(is_numeric($region['clt_cost'])){
/*					$isInup = $db->update("as_cost=$region[clt_cost]","ver_checks","as_id=$region[as_id] AND v_id=$region[v_id]");
					echo $db->query;
					if(!$isInup){ echo "error";
					die;
					}*/
						
				}
				?>
                </td>
            </tr>
<?php }?>
</table>