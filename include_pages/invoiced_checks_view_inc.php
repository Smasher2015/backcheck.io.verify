<?php 
$inv_num 	= ($_REQUEST['inv'])?$_REQUEST['inv']:0;
// DATE_FORMAT($cols_date, '%Y-%m-%d')
$where = "invoice_number='".$inv_num."'";

$tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN checks ck ON c.checks_id=ck.checks_id INNER JOIN company co ON d.com_id=co.id";

$cols = "d.image,d.v_name,d.v_ftname,ck.checks_title,c.as_stdate,d.v_id,c.as_id,c.as_status,c.as_vstatus,c.as_remarks,c.as_pdate,c.as_date,c.as_addate,c.invoice_number,c.is_tax,ck.checks_id,c.invoiced_date,c.check_cost,co.name,d.com_id,c.tax";
//echo "SELECT $cols FROM $tbls WHERE $where ORDER BY c.as_id DESC";
$data = $db->select($tbls,$cols,"$where ORDER BY c.as_id DESC ");	
$data2 = $db->select($tbls,$cols,"$where ORDER BY c.as_id DESC ");	

$info = mysql_fetch_assoc($data);
$PriceSymble = "Rs. ";
?>


<section class="retracted scrollable">
  <div class="row">
    <div class="col-md-12">
      <div class="manager-report-sec">
        <div id="filters" class="section" >
          <div class="list-group-item" >
            <div class="page-section-title">
              <h2 class="box_head">Invoice</h2>
            </div>
            <div style="margin-bottom:30px;">
            
             
             
              <div class="form-group">
                <div class="row">
				
                  <div class="col-md-3">
                    <label>Invoice #:</label>
                  </div>
                  <div class="col-md-3">
                  <?php echo $inv_num;?>
                    
                  </div>
				  
				  
				  <div class="col-md-3">
                    <label>Company:</label>
                  </div>
                  <div class="col-md-3">
                    <?php echo $info['name'];?>
                  </div>
				  
				  
				  
                </div>
				</div>
				
				
				<div class="form-group">&nbsp;</div>
				<div class="form-group">
                <div class="row" >
				
				  <div class="col-md-3">
                    <label>Include Tax:</label>
                  </div>
                
                       <div class="col-md-3">
                  
					<?=($info['is_tax']==1)?'Yes ( '.$info['tax'].' % ) ':'No'?>
                  </div>  
				
				
                  <div class="col-md-3">
                    <label>Date:</label>
                  </div>
                
                       <div class="col-md-3">
                    <?php $invoiced_date = strtotime($info['invoiced_date']);?>
					<?=date("Y-m-d",$invoiced_date)?>
                  </div>                  
                                    
                </div>
				
					<div class="form-group">&nbsp;</div>
				
            <style type="text/css">
			.page-section-title h2{ padding:0; margin:0;}
			</style>
             <div style="clear:both; margin-bottom:30px;"></div>
              <div id="titleBar" class="page-section-title"> 
              <div class="row">
             
               <div class="col-md-6"><h2> Invoiced Checks</h2></div>
               
                </div>
                </div>
                <div class="block">
                  <div id="dt2">
                  
                      <div class="panel panel-default panel-block">
                        <table class="table table-bordered table-striped" id="">
                          <thead>
                            <tr>
                            <th>#</th>
							<th>Name</th>
                            <th>Checks Title</th>
							<th>Amount</th>
                            <th>Uni Fee</th>
							<th>Uni Name</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
							
							
							
						
                            $db_count =  mysql_num_rows($data2);
                           
                            if($db_count>0){
                              
                              	$counter = 0;
								$index = 0;
								$total =0;
                                while($re = mysql_fetch_array($data2)) {  
								$clientinfo=getInfo("company","id=".$re['com_id']."");
								$slab_id=$clientinfo['slab_id'];
								$counter++;
								$submitted_date = strtotime($re['invoiced_date']);
									 ?>
                            <tr>
                             <td ><?=$counter?></td>
                              <td ><?=$re['v_name']?></td>
                              <td ><?=$re['checks_title']?></td>
							  
							  
							  
							  
							  
							  
							  
							   <?php 
							  if($slab_id==1){ ?>
							  <td ><?php 
							 $selCot = $db->select('clients_checks','clt_cost'," com_id=".$re['com_id']." AND checks_id='".$re['checks_id']."'");
							  $rsCost = mysql_fetch_assoc($selCot);
							  $cost = ($re['check_cost']!='')?$re['check_cost']:$rsCost['clt_cost'];
							  $cost = round($cost);
							  echo $cost;
							  $total = $total+$cost;
							  ?>
							  
							  </td>
							  <td><?php 
							  $selUniName = $db->select('add_data','d_value',"as_id='".$re['as_id']."' AND d_type='vuni'");
							  $rsUni = mysql_fetch_assoc($selUniName);
							  $uniName = $rsUni['d_value']; 
							  
							  $selUniCost = $db->select('uni_info','uni_fee',"uni_name='".$uniName."'");
							  $rsUniFee = mysql_fetch_assoc($selUniCost);
							  echo ($rsUniFee['uni_fee'])?$rsUniFee['uni_fee']:'N/A';  ?>
							  </td>
                              <?php }else{ ?>
                              	  <td ><?php 
							 // echo "SELECT clt_cost from clients_checks WHERE com_id=".$clntid." AND checks_id='".$re['checks_id']."'";
							  
							$selCot = $db->select('clients_checks','clt_cost'," com_id=".$re['com_id']." AND checks_id='".$re['checks_id']."'");
							  $rsCost = mysql_fetch_assoc($selCot);
							  $checkCost = ($re['check_cost'])?$re['check_cost']:$rsCost['clt_cost'];
							  
							  
							   $selUniName = $db->select('add_data','d_value',"as_id='".$re['as_id']."' AND d_type='vuni'");
							  $rsUni = mysql_fetch_assoc($selUniName);
							  $uniName = $rsUni['d_value']; 
							  $selUniCost = $db->select('uni_info','uni_fee',"uni_name='".$uniName."'");
							  $rsUniFee = mysql_fetch_assoc($selUniCost);
							  
							   $cost= $rsCost['clt_cost']+$rsUniFee['uni_fee'];
							   $cost = round($cost);
							   echo $cost;
							    $total = $total+$cost;
							  ?>
							  
							  </td>
							  <td><?=($rsUniFee['uni_fee'])?$rsUniFee['uni_fee']:'N/A';?>
							  </td>
                              <?php } ?>
							 
							  							  
							  
							  
							  
							  
							  
							  
							  
							
							  
							  
								 
							  
							  <td><?php 
							
							  echo ($uniName)?$uniName:'N/A';
							
							  
							 
							  
							  
							  
							  ?></td> 
								 								 
							 
                             
                            </tr>
                          
                            <?php 
									$index = $index+1;
								}?>
							 <tr>
                              <td colspan="2" align="center"></td>
							  <td   align="left">  <strong>Total: <br />
							 
								   Tax: <br />
								   Sub Total:
								   
							   
							 </strong>
							  </td>
							   <td colspan="2" align="left">
							     <strong>
							   <?php
							   echo $PriceSymble.$total."<br />";
							   if($info['is_tax']==1){
								   $Tax  = $info['tax'];
								   $netTax = 100-$Tax;
									$netTax =  $total / $netTax;
									//$taxAmount = $Tax * $netTax;
								   $taxAmount = $Tax * $total / 100;
								    echo $PriceSymble.round($taxAmount)." ( ".$Tax." % ) <br />";
								   $subTotal = $taxAmount+$total;
							   }else{
								   
								   echo $PriceSymble."0 <br />";
								    $subTotal = $total;
							 }
								 
	 
								?>
							   
							 
							   <?php echo $PriceSymble.round($subTotal); 
							   
							   
							 $selInv = $db->select('invoice_total_amount','id',"invoice_number='".$_REQUEST['inv']."'");	
							
							 if(mysql_num_rows( $selInv)==0){
							$isInsUpd = $db->insert("invoice_number,total_amount","'".$_REQUEST['inv']."','".round($subTotal,2)."'","invoice_total_amount");	 
							 }
							   
							   ?>
							   </strong></td>
                            </tr>

								<?php }else{ ?>
                            <tr>
                              <td colspan="5" align="center"><strong>No Record Found</strong></td>
                            </tr>
                            <?php } ?>
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
	  </div>
      </div>
  <div class="clear"></div>
  
  
  
</section>
