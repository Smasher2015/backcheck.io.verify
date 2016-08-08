<table >
<?php
if(isset($_REQUEST['name'])){
	$search= new SRC();
	$search->primaryKey="id";
	$search->limit=20;
	$search->tableName="medicalstaff";
	$search->srchField="FullName";
	$search->search_text = $_REQUEST['name'];
	
	switch($_REQUEST['type']){
		case'like':
			$search->groupBy="FullName";
			$search->fields="DISTINCT FullName,COUNT(FullName) cnt,id,OffenceDescription,Country1";
			$searchs = $search->getResults();
		break;
		 default:
			$search->fields="id,FullName,OffenceDescription,Country1";
			$searchs = $search->searchExact();		
		break;		
	}	
	if(!isset($_REQUEST['case'])){ ?>
<?php		
			if(count($searchs)>0){
				foreach($searchs as $search){  ?>
					<tr onclick="searchDetails(<?php echo $search['id']; ?>,'<?php echo isset($_SESSION['user_id'])?'true':'false'; ?>')" class="phover">	
    					<td width="5%">&nbsp;</td>
                        <td width="35%"><?php echo $search['FullName']; ?></td>
                        <td width="45%"><?php echo wordwrap($search['OffenceDescription'],30,'<br/>'); ?></td>
                        <td width="15%"><?php echo $search['Country1']; ?></td>
                    </tr>
<?php }}}else{
                if(count($searchs)>0){					
					$aURL="?action=search&name=$_REQUEST[name]&type=$_REQUEST[type]";
					addActivity('search',$_REQUEST['name'],$LEVEL,$aURL);
				foreach($searchs as $search){  ?>
	<?php 			if($search['cnt']>1){ ?>
                    <tr>	
                        <td width="5%">
                        	 <a href="javascript:void(0)">
                             	<img class="pls" onclick="showShearches('<?php echo $search['FullName']; ?>',<?php echo $search['id']; ?>,this)" src="img/plusIcon.gif" >
                             </a>
                        </td>
                        <td colspan="3"><?php echo $search['FullName']; ?> 
                        	<span style="color:#999;"> # Profiles [ <?php echo $search['cnt']; ?> ]</span>
                        </td>
                    </tr>
                    <tr id="tr<?php echo $search['id']; ?>" style="display:none">
                        <td colspan="4" class="inTD" id="td<?php echo $search['id']; ?>">&nbsp;</td>
                    </tr>
                    <tr style="display:none">
                        <td colspan="4">&nbsp;</td>
                    </tr>                    	   
    <?php 			}else{ ?>
    				<tr onclick="searchDetails(<?php echo $search['id']; ?>,'<?php echo isset($_SESSION['user_id'])?'true':'false'; ?>')" class="phover">	
    					<td width="5%">&nbsp;</td>
                        <td width="35%"><?php echo $search['FullName']; ?></td>
                        <td width="45%"><?php echo wordwrap($search['OffenceDescription'],30,'<br/>'); ?></td>
                        <td width="15%"><?php echo $search['Country1']; ?></td>
                    </tr>
    <?php }}}else{ ?>
    				<tr>
                    	<td colspan="4"><h2 align="center">No Record Found</h2></td>
                    </tr>
	<?php }}}else{?>
            <tr>
                <td colspan="4"><h2 align="center">No Record Found</h2></td>
            </tr>
     <?php } ?>
</table>