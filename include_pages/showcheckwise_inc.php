<div style="border-bottom:#EF3C42 solid 5px;">
<table class="static">
            <thead>
                <tr>
                	<th width="60px;">&nbsp;</th>
                    <th>Check Title</th>
                    <th>No. of Checks</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $cols = "k.checks_title,COUNT(k.checks_id) AS `checks`";
                $tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN checks k ON c.checks_id=k.checks_id";
                $wher = "com_id=$_POST[client] AND c.as_date LIKE '$_POST[date]%' AND c.as_isdlt=0 AND d.v_isdlt=0 GROUP BY k.checks_title ORDER BY k.checks_title";
                $data = $db->select($tbls,$cols,"$wher");
				
                while($re = mysql_fetch_array($data)) { ?>
                    <tr>
                    	<td>&nbsp;</td>
                        <td ><?=$re['checks_title']?></td>
                        <td ><?=$re['checks']?></td>
                    </tr>    
        <?php  } ?>
            </tbody>
</table>
</div>