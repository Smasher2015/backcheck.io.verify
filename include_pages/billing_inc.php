<div class="innerdiv">
     <h2 class="head-alt">Your Billing Information</h2>
        <div class="innercontent">
            <table >
                <thead>
                    <tr class="trhd">
                        <th>Screening</th>
                        <th>Package</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
            <?php	$uID = $_SESSION['user_id'];
                    $datas = $db->select("attachments","*","user_id=$uID");
                        while($data = mysql_fetch_array($datas)){ 
                            $pakg = $db->select("packages","*","pkg_id=$data[pkg_id]"); 
                            $pakg = mysql_fetch_array($pakg); ?>
                    <tr>
                        <td><?php 
                            $screening = $db->select("screenings","*","sc_id=".$pakg['sc_id']); 
                            $screening = mysql_fetch_array($screening); 
                        echo $screening['sc_name']; ?></td>
                        <td><?php echo $pakg['pkg_name']; ?></td>
                        <td>Rs <?php echo $pakg['pkg_amt']; ?>/-</td>
                        <td><?php echo date("j-F-Y",strtotime($data['at_date']));?></td>
                    </tr> 
                     <?php } ?> 
                </tbody>  
            </table>
	</div>
</div>