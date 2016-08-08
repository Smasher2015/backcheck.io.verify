<?php
	if(isset($_REQUEST['qPrice'])){
		addQPrice($_REQUEST);	
	}
	switch($aType){
		case 'requested':
			$eWhere="qt.qt_sent=0";
			$title ="Requested";
		break;
		case 'done':
			$eWhere="qt.qt_sent=1";
			$title ="Ordered";
		break;
		default:
			$eWhere="";
		break;
	}
?>
<h3 class="clearfix"><?php echo $title; ?> Quote(s)</h3>
<table>
	<thead>
    	<tr>
        	<th >&nbsp;</th>
        	<th >Screenings</th>
            <th >Client / Company Name</th>
             <th >Prices</th>
            <th >Date</th>
        </tr>
    </thead>
    <tbody>
<?php		
		$quotes = $db->select("quotes qt INNER JOIN screenings sc ON sc.sc_id=qt.sc_id","DISTINCT *","$eWhere");
		if(mysql_num_rows($quotes)>0){
		while($quote = mysql_fetch_array($quotes)){ ?>
    		<tr class="shover">
            	<td style="text-align:center;" >
                    <a href="javascript:void(0)">
                    	<?php 
							$param="action=page&page=quotesinfo&qid=$quote[qt_id]&type=$_REQUEST[type]";
							$dId  = "v$quote[qt_id]";
						?>
                        <img onClick="showData(this,'<?php echo $param; ?>','<?php echo $dId;?>')" src="img/plusIcon.gif" >
                    </a>                   
                </td>
                <td style="text-align:left;"><?php echo $quote['sc_name']; ?></td>
            	<td style="text-align:left;">
					<?php
					 	$comInfo = getcompany($quote['com_id']);
						$comInfo = mysql_fetch_array($comInfo);
						echo $comInfo['name'];
					 ?>
                </td>
                <td style="text-align:left;">
					<?php echo ($quote['qt_price']!='' && $quote['qt_price']!=0)?$quote['qt_price']:'N/A'; ?>
                </td>
                <td><?php echo date("j-F-Y",strtotime($quote['qt_date'])); ?></td>                
            </tr> 
            <tr style="display:none;">
                <td colspan="5"></td>
            </tr>
            <tr >
                <td class="inTD" colspan="5" style="display:none;" id="v<?php echo $quote['qt_id']; ?>"></td>
            </tr>               
<?php 	} 
		}else{ ?>
        	<tr>
            	<td colspan="5"><h1 align="center">No Recod Found</h1></td>
            </tr>
        <?php }?>
	</tbody>
</table>