<?php
		switch($aType){
			case 'requested':
				$eWhere="AND qt.qt_sent=0";
				$title = "Requested";
			break;
			case 'done':
				$eWhere="AND qt.qt_sent=1";
				$title = "Order";
			break;
			default:
				$eWhere="";
			break;
		}	
?>
<div class="innerdiv">
     <h2 class="head-alt"><?php echo $title;?> Quote(s)</h2>
        <div class="innercontent">
        <table>
            <thead>
                <tr>
                    <th >&nbsp;</th>
                    <th >Screenings</th>
                    <th >Prices</th>
                    <th >Date</th>
                </tr>
            </thead>
            <tbody>
        <?php	
                $comInfo = companyInfo($_SESSION['user_id']);
                $comID = $comInfo['id'];
                $quotes = $db->select("quotes qt INNER JOIN screenings sc ON sc.sc_id=qt.sc_id","DISTINCT *","com_id=$comID $eWhere");
                if(mysql_num_rows($quotes)>0){
                while($quote = mysql_fetch_array($quotes)){ ?>
                    <tr class="shover">
                        <td style="text-align:center;" >
                            <a href="javascript:void(0)">
                                <?php 
                                    $param="action=page&page=quotesinfo&qid=$quote[qt_id]&type=$aType";
                                    $dId  = "v$quote[qt_id]";
                                ?>
                                <img onClick="showData(this,'<?php echo $param; ?>','<?php echo $dId;?>')" src="img/plusIcon.gif" >
                            </a>                   
                        </td>
                        <td style="text-align:left;"><?php echo $quote['sc_name']; ?></td>
                        <td style="text-align:left;">
                            <?php echo ($quote['qt_price']!='' && $quote['qt_price']!=0)?$quote['qt_price']:'N/A'; ?>
                        </td>
                        <td><?php echo date("j-F-Y",strtotime($quote['qt_date'])); ?></td>                
                    </tr> 
                    <tr style="display:none;">
                        <td colspan="4"></td>
                    </tr>
                    <tr >
                        <td class="inTD" colspan="4" style="display:none;" id="v<?php echo $quote['qt_id']; ?>"></td>
                    </tr>               
        <?php 	} 
                }else{ ?>
                    <tr>
                        <td colspan="4"><h1 align="center">No Recod Found</h1></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
        </div>
        <div class="clear"></div>
</div>        