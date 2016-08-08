<div style="margin:0; padding:5px;">
        <table>
            <tbody>
        <?php 
                switch($aType){
                    case 'requested':
                        $eWhere="AND qt.qt_sent=0";
                    break;
                    case 'done':
                        $eWhere="AND qt.qt_sent=1";
                    break;
                    default:
                        $eWhere="";
                    break;
                }
                $tbls="quotes qt INNER JOIN qt_maping qm ON qm.qt_id=qt.qt_id INNER JOIN checks ck ON ck.checks_id=qm.checks_id";
                $checks = $db->select("$tbls","DISTINCT *","qt.qt_id=$_REQUEST[qid] $eWhere");
                $qSnt=0;
                $cntChecks = mysql_num_rows($checks);
                if($cntChecks>0){
                while($check = mysql_fetch_array($checks)){
                     $qSnt =$check['qt_price']; ?>    
                <tr class="shover">
                    <td style="text-align:left;" >
                        <div>
                            <b><?php echo $check['checks_title'];?>:</b>
                            <div class="clear" ></div>
                        </div>  
                     </td>
                </tr>
        <?php 	}
                if(($qSnt==0 || $qSnt=='') && $LEVEL==5){?>
                <tr>
                    <td >
                        <div style="width:400px;float:right;">
                            <input class="req auto" type="text" title="Quote Price"  name="price" value="Quote Price" >
                            <input type="hidden" value="<?php echo $_REQUEST['qid']; ?>" name="qId" >
                            <input class="button btnright" type="submit" value="Submit [ Quote Price ] >>" name="qPrice" >
                            <div class="clear"></div>
                        </div>
                    </td>
                </tr>
        <?php 	}}else{?>
                <tr>
                    <td><h1 align="center">No Recod Found</h1></td>
                </tr>
        <?php 	}?>
            </tbody>
        </table>
        <div class="clear"></div>
</div>
