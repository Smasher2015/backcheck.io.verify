<script type="text/javascript">
var Tax = <?php echo  (isset($_REQUEST['clntid']))?(getCompanyTax($_REQUEST['clntid'])):getTax();?>;
$(document).ready(function(){
$('#checkAll').click(function(event) {   
 if(this.checked) {
     $('.cheks').each(function() {
        this.checked = true;                        
     });
 }
 else{
     $('.cheks').each(function(){
        this.checked = false;
     });
 }
});
$(document).scroll(function(){
	if($(this).scrollTop() > 2){
		}
	});

});
function merge_checks(){
	var selchbox = [];
	$('.cheks').each(function() {
        if(this.checked == true){
			selchbox.push($(this).val());
		};                        
     });
	 if(selchbox==''){
		 alert("Please select atleast 1 check to merge!");
		 return false;
	 }else{
		 	document.getElementById('merge_checkids').value=selchbox;
		 }
	
}
</script>
<?php

if(isset($_REQUEST['merge_checks']) && is_numeric($_REQUEST['merger_id'])  && isset($_REQUEST['merge_checkids'])){
	global $db;
	//id given to put or master id
	$merger_id=$_REQUEST['merger_id'];
	//selectedid
	$merge_checkids=@explode(",",$_REQUEST['merge_checkids']);
	foreach($merge_checkids as $ids){
		$isInsUpd = $db->update("master_check='$merger_id',invoiced=1","ver_checks","as_id=$ids");
	}
}
$clntid 	= ($_REQUEST['clntid'])?$_REQUEST['clntid']:'';
$checks_id 	= ($_REQUEST['as_id'])?$_REQUEST['as_id']:'';
$as_status 	= ($_REQUEST['as_status'])?$_REQUEST['as_status']:'Close';
$today = date("Y-m-d");
$pastMonth = strtotime("-1 month");
$one_month = date("Y-m-d",$pastMonth);
$from_dt 	= ($_REQUEST['from_dt'])?$_REQUEST['from_dt']:$one_month;
$to_dt 		= ($_REQUEST['to_dt'])?$_REQUEST['to_dt']:$today;
if(isset($_REQUEST['submitinvoice'])){
if($as_status=='invoiced'){
								$dweher = "as_status='Close' AND invoiced=1";
								
							}else{
								$dweher = "as_status='".$as_status."' AND invoiced !=1";
							}
							switch($as_status){
								case "Close":
								$date_column="as_cldate";
								$date_column_label="Close Date";
								break;
								case "Not Assign":
								$date_column="as_addate";
								$date_column_label="Submitted Date";
								break;
								case "Open":
								$date_column="as_addate";
								$date_column_label="Submitted Date";
								break;
								case "Problem":
								$date_column="as_addate";
								$date_column_label="Submitted Date";
								break;
								case "invoiced":
								$date_column="invoiced_date";
								$date_column_label="Invoiced Date";
								break;
								default:
								$date_column="as_addate";
								$date_column_label="Submitted Date";
								break;
							}

							if($checks_id!=''){
								$ewhere1="AND checks_id=".$checks_id."";
							}else{$ewhere1='';}
							if($clntid!=''){
								$ewhere="AND com_id=".$clntid."";
							}else{$ewhere='';}	
							$where = " $dweher $ewhere   AND DATE_FORMAT($date_column, '%Y-%m-%d') BETWEEN '".$from_dt."' AND '".$to_dt."'   ";
							$tbls = "ver_data d INNER JOIN ver_checks c ON d.v_id=c.v_id INNER JOIN checks ck ON c.checks_id=ck.checks_id INNER JOIN company co ON d.com_id=co.id";
							$cols = "d.image,d.v_name,d.v_ftname,ck.checks_title,c.as_stdate,d.v_id,c.as_id,c.as_status,c.as_vstatus,c.as_remarks,c.as_pdate,c.as_date,c.as_addate,c.as_cldate,c.invoice_number,c.is_tax,ck.checks_id,c.invoiced_date,c.check_cost,co.name,d.com_id,c.tax";
							$data = $db->select($tbls,$cols,"$where ORDER BY c.as_id DESC ");	
                            $db_count =  mysql_num_rows($data);
}
?>


<section class="retracted scrollable">
  <div class="row">
    <div class="col-md-12">
      <div class="manager-report-sec">
	  
	  <div class="page-section-title">
              <h2 class="box_head">Submit Invoices on Checks</h2>
            </div>
        <div id="filters" class="panel panel-flat" >
        	<div class="panel-heading">
            	<h5 class="panel-title">Search Invoice</h5>
            </div>
          <div class="panel-body">
            
						
            <div>
            <form action="?action=invoicedchecks&atype=checks" class="table-form" method="post" target="_blank" >
              <div class="form-group">
             
                    <label for="basic-input">Invoice Number </label>
                 
				
			<input type="text" id="inv" name="inv" class="form-control" placeholder="Invoice Number" value="" > 
                      
                  </div>
         
              
             
            
              <div  class="class="form-group"">
                <button class="btn btn-success"  type="submit" name="updatetax"> <span>Search Invoice</span> </button>
              </div>
               
            </form>
            </div>
             <div style="clear:both; margin-bottom:30px;"></div>
             
             
               </div>
            </div>  
	  
   
        <div id="filters" class="panel panel-flat">
           <div class="panel-heading">
              <h2 class="panel-title">Submit Invoices on Checks</h2>
            </div>
          <div class="panel-body">
            
            <div style="margin-bottom:30px; margin-top:41px;">
            <form action="?action=submitinvoices&atype=checks" class="table-form"  method="post">
             
             
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label>Select Client:</label>
                  </div>
                  <div class="col-md-9">
                    <select id="clntid" name="clntid" class="form-control select" >
                      <option value=""> --------Select Client-------- </option>
                      <?php 	$db = new DB();
                                                $dWhere="1=1 order by name asc";							
                                                $coms = $db->select("company","*",$dWhere);
                                              //   echo "select * from company where $dWhere";
                                                $coid = (isset($_REQUEST['clntid']))?$_REQUEST['clntid']:0;
                                                while($com =mysql_fetch_array($coms)){  ?>
                      <option value="<?=$com['id']?>" <?php echo ($com['id']==$clntid)?'selected="selected"':'';?>>
                      <?=$com['name']?>
                      </option>
                      <?php	} ?>
                    </select>
                  </div>
                </div>
				</div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label>Select Check:</label>
                  </div>
                  <div class="col-md-9">
                    <select id="as_id" name="as_id" class="form-control select" >
                      <option value=""> --------Select Checks-------- </option>
                      <?php 	$db = new DB();
                                                $dWhere="is_active=1 order by checks_title asc";							
                                                $checks = $db->select("checks","*",$dWhere);
                                                $as_id = (isset($_REQUEST['as_id']))?$_REQUEST['as_id']:0;
                                                while($checks_arr =mysql_fetch_array($checks)){  ?>
                      <option value="<?=$checks_arr['checks_id']?>" <?php echo ($checks_arr['checks_id']==$as_id)?'selected="selected"':'';?>>
                      <?=$checks_arr['checks_title']?>
                      </option>
                      <?php	} ?>
                    </select>
                  </div>
                </div>
				</div>
				<div class="form-group">&nbsp;</div>
				  <div class="form-group">
                <div class="row">
                  <div class="col-md-3">
                    <label>Select Status:</label>
                  </div>
                  <div class="col-md-9">
                    <select id="as_status" name="as_status" class="form-control select" >
                      <option value=""> --------Select Status-------- </option>
                      <?php 	$db = new DB();
                                                $dWhere="";							
                                                $selstatus = $db->select("ver_checks","DISTINCT(as_status)",$dWhere);
                                                
                                                while($st =mysql_fetch_array($selstatus)){  ?>
                      <option value="<?=$st['as_status']?>" <?php echo ($st['as_status']==$as_status)?'selected="selected"':'';?>>
                      <?=$st['as_status']?>
                      </option>
                      <?php	} ?>
					  <option value="invoiced" <?php echo ('invoiced'==$as_status)?'selected="selected"':'';?>>Invoiced</option>
                    </select>
                  </div>
                </div>
				</div>
				
				<div class="form-group">&nbsp;</div>
				<div class="form-group">
                <div class="row" id="date-range">
                  <div class="col-md-3">
                    <label>Select Date:</label>
                  </div>
                
                                        <label for="" class="col-lg-1 control-label">From:</label>
                                        <div class="col-lg-2">
                                            <input id="" type="text" name="from_dt" value="<?php echo $from_dt;?>" class="datetimepicker-month1 form-control" placeholder="Start Date" >
                                        </div>
                                    
                                    
                                        <label for="" class="col-lg-1 control-label">To:</label>
                                        <div class="col-lg-2">
                                            <input id="" type="text" name="to_dt" value="<?php echo $to_dt;?>" class="datetimepicker-month2 form-control" placeholder="End Date">
                                        </div>
                                        <div class="col-lg-2"><button class="btn btn-lg btn-success" style="float:right;" type="submit" name="submitinvoice"> <span>   Search  </span> </button></div>
                </div>
              </div>
            </form>
            </div>
            <style type="text/css">
			.page-section-title h2{ padding:0; margin:0;}
			</style>
             <div style="clear:both; margin-bottom:30px;"></div>
             <?php if(isset($_REQUEST['submitinvoice'])){?>
              <div id="titleBar" class="page-section-title"> 
              <div class="row">
             
               <div class="col-md-6"><h2> Checks List <?php echo ($db_count)?'(Total Checks Found '.$db_count.')':'' ;?></h2> 
               		
               </div>
               <div class="col-md-6">
               <?php 
			   		if(isset($_REQUEST['submitinvoice'])){
			   ?>
                          <a data-toggle="modal" href="#messageModel1"  > 
                         <button class="btn btn-lg btn-success" style="float:right; margin-left:22px;" type="button"  onclick="return merge_checks()" > <span>   Merge Checks  </span> </button></a>
               <form method="post" action="export_logs.php">
                    	<input type="hidden" name="clntid" value="<?=$clntid?>"/>
                        <input type="hidden" name="as_id" value="<?=$checks_id?>"/>
                        <input type="hidden" name="as_status" value="<?=$as_status?>"/>
                         <input type="hidden" name="from_dt" value="<?=$from_dt?>"/>
                         <input type="hidden" name="to_dt" value="<?=$to_dt?>"/>
                         <button class="btn btn-lg btn-success" style="float:right; margin-left:22px;" type="submit" name="export_csv"> <span>   Export CSV  </span> </button>
               </form>
                   
             	<?php } if($as_status=='Close'){?>			 
			   <div  style="text-align:right;">
<a data-toggle="modal" href="#messageModel" onclick="calculateAmount(1); document.getElementById('is_tax').checked='checked'" > 
  <button class="btn btn-lg btn-success" style="float:right;"  type="button" name=""> <span>Submit Invoice</span> </button></a>
              </div>
				<?php } ?>
             	</div>
                </div>
                </div>
                <div class="block">
                  <div id="dt2">
                    <form class="table-form" action="" method="post" name="assignTask" enctype="multipart/form-data" id="checks_ids">
                      <div class="panel panel-default panel-block">
                        <table class="table table-bordered table-striped" id="">
                          <thead>
                            <tr>
                            <?php
							

							if($as_status=='Close'){?>  <th>	<label><input type="checkbox" id="checkAll"> Select All </label></th><?php } ?>
							  <?php if($as_status=='invoiced'){?>
								 <th >Invoice #</th> 
														 
							 <?php }?>
                             <th>Check Id</th>
							<th>Name</th>
                            <th>Checks Title</th>
							<th>Amount</th>
							<th>Uni Fee</th>
							<th>Uni Name</th>
                              <th><?php echo $date_column_label;?></th>
							
                                    <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
							
							// DATE_FORMAT($cols_date, '%Y-%m-%d')
							
							
                            if($db_count>0){
								$index = 0;
                                while($re = mysql_fetch_array($data)) {
									$clientinfo=getInfo("company","id=".$re['com_id']."");
									$slab_id=$clientinfo['slab_id'];
								$submitted_date = strtotime($re["$date_column"]);
									 ?>
                            <tr>
                             <?php if($as_status=='Close'){?> <td><input class="cheks" type="checkbox" name="checks[]" id="checks[]" value="<?=$re['as_id']?>"></td><?php } ?>
							 
							  <?php if($as_status=='invoiced'){?>
								 <td ><a href="?action=invoicedchecks&atype=checks&inv=<?=$re['invoice_number']?>"><?=$re['invoice_number']?></a></td> 
															 
							 <?php }?>
							 
							  <td ><?=$re['as_id']?></td>
                              <td ><?=$re['v_name']?></td>
                             
                              <td ><?=$re['checks_title']?></td>
                              <?php 
							  if($slab_id==1){ ?>
							  <td ><?php 
							 // echo "SELECT clt_cost from clients_checks WHERE com_id=".$clntid." AND checks_id='".$re['checks_id']."'";
							  
							 $selCot = $db->select('clients_checks','clt_cost'," com_id=".$re['com_id']." AND checks_id='".$re['checks_id']."'");
							  $rsCost = mysql_fetch_assoc($selCot);
							  //echo $rsCost['clt_cost'];
							  ?>
							  
							  <input type="text" style=" border: 1px solid #dddddd; text-align:center;" onkeyup="this.value=this.value.replace(/[^\d]/,'');" size="5" id="cost_id_<?=$re['as_id']?>" name="cost[<?=$re['as_id']?>]" value="<?=round(($rsCost['clt_cost']!="")?$rsCost['clt_cost']:0)?>" readonly>
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
							   $selUniName = $db->select('add_data','d_value',"as_id='".$re['as_id']."' AND d_type='vuni'");
							  $rsUni = mysql_fetch_assoc($selUniName);
							  $uniName = $rsUni['d_value']; 
							  $selUniCost = $db->select('uni_info','uni_fee',"uni_name='".$uniName."'");
							  $rsUniFee = mysql_fetch_assoc($selUniCost);
							  
							   $cost=$rsCost['clt_cost']+$rsUniFee['uni_fee'];
							   $cost = round($cost);
							   //echo $cost;
							  ?>
							  <input  type="text" style=" border: none;" onkeyup="this.value=this.value.replace(/[^\d]/,'');" size="5" id="cost_id_<?=$re['as_id']?>" name="cost[<?=$re['as_id']?>]" value="<?=$cost?>" readonly>
							  </td>
							  <td><?=($rsUniFee['uni_fee'])?$rsUniFee['uni_fee']:'N/A';?>
							  </td>
                              <?php } ?>
							  <td><?php 
							
							  echo ($uniName)?$uniName:'N/A';
							
							  
							 
							  
							  
							  
							  ?></td> 
							  
							  
							  
							  
							  <td ><?=date("Y-m-d",$submitted_date)?></td>
							 
                              <td ><?=$re['as_status']?></td>
                            </tr>
                          
                            <?php 
									$index = $index+1;
								} }else{ ?>
                            <tr>
                              <td colspan="8" align="center"><strong>No Record Found</strong></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </form>
                   
                  </div>
                </div>
               <?php } ?> 
              </div>
            </div>
          </div>
        </div>
      </div>
  <div class="clear"></div>
  
  <div id="messageModel1" tabindex="-1" role="dialog" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form name="" method="post" id="sub_inv" >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><i class="icon-check"></i><span>Merge Checks</span></h4>
        </div>
        <div class="modal-body">
          <div id="msg-merg"></div>
        <?php /*   <div class="form-group">
            <label>To</label>
            <select id="source" name="to_msg" class="form-control parsley-validated" data-parsley-required="true">
				<option value="">Please Select</option>
			<?php 
				$get_managers = $db->select("users","*","`level_id` = 2 AND `is_active` = 1");
				while($manager = mysql_fetch_array($get_managers)){?>
                  <option value="<?=$manager['user_id']?>"><?php echo $manager['first_name'] .' '. $manager['last_name'];?> </option>
              <?php }?>
            </select>
          </div> */ ?>
          <div class="form-group">
            <input id="merger_id"  placeholder="Type Master Check Id" name="merger_id" class="form-control parsley-validated" data-parsley-required="true">
          </div>
        </div>
        <div class="modal-footer">
        <input type="hidden" value="" id="merge_checkids" name="merge_checkids" />
               	<input type="hidden" name="clntid" value="<?=$clntid?>"/>
                        <input type="hidden" name="as_id" value="<?=$checks_id?>"/>
                        <input type="hidden" name="as_status" value="<?=$as_status?>"/>
                         <input type="hidden" name="from_dt" value="<?=$from_dt?>"/>
                         <input type="hidden" name="to_dt" value="<?=$to_dt?>"/>
                          <input type="hidden" name="submitinvoice"/>
        	<input type="submit" name="merge_checks" value="Submit"  class="btn btn-lg btn-success"/>
          <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">CANCEL</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
  <div id="messageModel" tabindex="-1" role="dialog" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form name="" method="post" id="sub_inv" >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><i class="icon-check"></i><span>Submit Invoice Number</span></h4>
        </div>
        <div class="modal-body">
          <div id="msg-inv"></div>
        <?php /*   <div class="form-group">
            <label>To</label>
            <select id="source" name="to_msg" class="form-control parsley-validated" data-parsley-required="true">
				<option value="">Please Select</option>
			<?php 
				$get_managers = $db->select("users","*","`level_id` = 2 AND `is_active` = 1");
				while($manager = mysql_fetch_array($get_managers)){?>
                  <option value="<?=$manager['user_id']?>"><?php echo $manager['first_name'] .' '. $manager['last_name'];?> </option>
              <?php }?>
            </select>
          </div> */ ?>
          <div class="form-group">
            <label for="invoice_number">Invoice #</label>
            <input id="invoice_number"  placeholder="Type Invoice #" name="invoice_number" class="form-control parsley-validated" data-parsley-required="true">
          </div>
		  
		   <div class="form-group">
            <label for="invoice_date">Date</label>
            <input id="invoice_date"  placeholder="Select Date" name="invoice_date" class="form-control parsley-validated datetimepicker-month3" data-parsley-required="true" value="<?php echo date("Y-m-d");?>">
          </div>
		   <div class="form-group">
            <label for="is_tax">  <input type="checkbox" checked="checked" id="is_tax"   name="is_tax" class="parsley-validated" data-parsley-required="true" value="1" onclick="calcTax(this);"> Include Tax </label>
            
			
			
			
			<section class="panel stat stat-danger stat-color">
                        <div class="panel-heading">
                            <div id="loadAmount">
                               
                            </div>
                        </div>
                    </section>
			
          </div>
		  
		  
		  
		 
		  
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-lg btn-success" name="submit_inv" value="submitinvoice" onclick="return submitInvoiceNumber();" >Submit</button>
          <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">CANCEL</button>
		  <input type="hidden" name="cc_email" value="khalique@xcluesiv.com" />
		  <input type="hidden" name="to_msg" value="49">  <!-- rizwan@xcluesiv.com  -->
        </div>
      </form>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
  
  
  
</section>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
											  
	  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script type="text/javascript">
		
		$(function () {
		$( ".datetimepicker-month1, .datetimepicker-month2, .datetimepicker-month3").datepicker({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange: "1980:<?php echo date("Y");?>"
		});
		});
												
												
		function submitInvoiceNumber(){
    
       //alert("test");
	var is_tax;
    var response = false;
	var mydata = $("#checks_ids").serialize();
	var invoice_number = $("#invoice_number").val();
	var invoice_date = $("#invoice_date").val();
	if($('#is_tax:checked').val()){ is_tax = $('#is_tax:checked').val(); } else { is_tax=0; }
	
	
		$("#msg-inv").html('<img align="center" src="images/spinners/3.gif" />');
              $.ajax({
	url: "actions.php",
	data:'ePage=add_rating&sub_inv=1&invoice_number='+invoice_number+'&invoice_date='+invoice_date+'&is_tax='+is_tax+'&'+mydata,
	type: "POST",
	success: function(res){
    if(res=='success'){
		$('#msg-inv').html('<div class="alert alert-dismissable alert-success fade in "><button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-remove"></i></button><span class="title"><i class="icon-check-sign"></i> SUCCESS</span> Invoice Number added successfully.</div>');
		
		setTimeout(function() {
		window.location.href = "?action=invoicedchecks&atype=checks&inv="+invoice_number;
		}, 1000);
		
		return true;

	}else{
		
		$('#msg-inv').html('<div class="alert alert-dismissable alert-danger fade in "><button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-remove"></i></button><span class="title"><i class="icon-check-sign"></i> ERROR</span> '+res+'</div>');
		
		
		
		return false;
	}
	},
	error: function(){
   $('#msg-inv').html('<div class="alert alert-dismissable alert-danger fade in "><button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-remove"></i></button><span class="title"><i class="icon-check-sign"></i> ERROR</span> Failed to submit ! Please try again.</div>');
	}
	
	
	});
	

    return response;
        
	}

$(function(){
  $('#header_nav').data('size','big');
});


function calculateAmount(isTax){
	var totalAmount = 0;
	var taxAmount = 0;
	var subTotal =0;
	
	$('.cheks').each(function() {
        if(this.checked == true){
			var checks_id = $(this).val();
			
			totalAmount += parseFloat($('#cost_id_'+checks_id).val());
			
		};                        
     });
	 
	 if(isTax==1){
		// console.log('Tax:'+Tax);
	//calculating tax
		//var netTax = 100 - parseFloat(Tax);
		//netTax = totalAmount / parseFloat(netTax);
		//taxAmount = parseFloat(netTax) * parseFloat(Tax);
		
	 taxAmount = parseFloat(Tax)* totalAmount / 100;
	 
	 subTotal = totalAmount+taxAmount;
	 $('#loadAmount').html(' <i class="icon-cash"></i><h5>TOTAL AMOUNT<br>WITH TAX ('+Tax+'%)</h5><div class="counter counter-small">Rs. '+subTotal.toFixed()+'</div>');
	 
	 }else{
		
	subTotal = totalAmount;		
	 $('#loadAmount').html(' <i class="icon-cash"></i><h5>TOTAL AMOUNT<br>WITHOUT TAX</h5><div class="counter counter-small">Rs. '+subTotal.toFixed()+'</div>');	 
	 }
	
	// alert("taxAmount: "+taxAmount+" SubTotal: "+subTotal);
	
	
	
}

function calcTax(ths){
	
	if(ths.checked == true){
	calculateAmount(1);	
	}else{
	calculateAmount(0);		
	}
}
</script>