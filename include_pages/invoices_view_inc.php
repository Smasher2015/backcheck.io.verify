<section class="retracted scrollable">
<div class="row">
  <div class="col-md-12">
    
    
    <div class="report-sec">
    	<div class="page-header">
       		<div class="page-header-content">
        		<div class="page-title3">	
                    <h2>Invoice</h2>
             </div></div>
    
    </div>
    
      <div class="panel panel-default panel-block">
        <div class="panel-body">
			
					  
				   
					  <?php  

$getinvoicenum = $_GET['invoicenum'];

		$today = date("Y-m-d");
		$invoice_date = date("Y-m-d (h:i A)");
		$thisMonth = date("Y-m-01");
		$due_date = getdatedifference($today,15);
		$due_date = date("Y-m-d", strtotime($due_date));
		
//echo "select * from ver_data vd JOIN client_invoices ci ON vd.v_id=ci.v_id  where ci.paid=0 AND invoiced=1  AND ci.invoice_number='$getinvoicenum' AND vd.v_isdlt=0";
		$query = $db->select("ver_data vd JOIN client_invoices ci ON vd.v_id=ci.v_id ","*","ci.paid=0 AND invoiced=1  AND ci.invoice_number='$getinvoicenum' AND vd.v_isdlt=0");
		
		$rsCost =  @mysql_fetch_assoc($query);
		
		$com_id = $rsCost['com_id'];
		
		$companyTax = getCompanyTax($com_id);
		//var_dump($companyTax);
		$selCom = getcompany($com_id);
		$rsCom = @mysql_fetch_assoc($selCom);
		 
		$credits = $rsCom['credits'];
		$monthly_credits_allowed = $rsCom['monthly_credits_allowed'];		
		
		
		
		
		if($rsCost['invoice_number']==""){
		$upd=true;	
		
 		$invoice_number = "RD/L/".date("y")."/".date("m")."/".$invoice_id;
		$our_ref = "RD/PPL/".date("y")."/".date("m")."/".$invoice_id."-".$invoice_id;
		
		
 		}else{
		$upd=false;
		$rsInv =  @mysql_fetch_assoc($db->select("monthly_invoice","id,add_date,our_ref","invoice_number='$rsCost[invoice_number]'"));
		$invoice_id = $rsInv['id'];
		$invoice_date = $rsInv['add_date'];
		$invoice_date = date("Y-m-d",strtotime($invoice_date));
		$invoice_number = $rsCost['invoice_number'];
		$our_ref = $rsInv['our_ref'];
		}











?> 
                      
                      
                      
           <div class="row">
								<div class="col-md-6 content-group">
									<h4>Background Check (Private) Limited</h4>
		 							<ul class="list-condensed list-unstyled">
										
 

  

                                        <li>3rd Floor, GSA House, 19 Timber Pond,,</li>
										<li>Near KPT Overpass Bridge East Wharf,</li>
										<li>Keamari, Karachi - Pakistan</li>
                                        <li>Tel. : 92-21-32863920 - 31</li>
                                        <li>Fax : 92-21-32863931</li>
                                        <li>email : info@riskdiscovered.com</li>
                                        <li>SNTN: S2913136-7, NTN: 2913136-7 </li>
									</ul>
								</div>

								<div class="col-md-6 content-group">
									<div class="invoice-details">
										<h5 class="text-uppercase text-semibold">Invoice # <?=$invoice_number?></h5>
										<ul class="list-condensed list-unstyled">
											<li>Date: <span class="text-semibold"> <?=$invoice_date?></span></li>
											<li>Due date: <span class="text-semibold"><?=$due_date?></span></li>
										</ul>
									</div>
								</div>
							</div>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <div class="row">
								<div class="col-md-6 col-lg-9 content-group">
									<span class="text-muted">Invoice To:</span>
		 							<ul class="list-condensed list-unstyled">
										<li><h5>Saleem Ahmed Payment</h5></li>
										<li><span class="text-semibold">Pakistan Petroleum Limited</span></li>
										<li>Road</li>
										<li>Karachi</li>
										<li>Pakistan</li>
										<li>35234610</li>
										<li><a href="#">saleem@ppl.com</a></li>
									</ul>
								</div>

								<div class="col-md-6 col-lg-3 content-group">
									<span class="text-muted">Payment Details:</span>
									<ul class="list-condensed list-unstyled invoice-payment-details">
										<li><h5>Total Due: <span class="text-right text-semibold"><?=$grand_total?></span></h5></li>
										<li>Bank name: <span class="text-semibold">Habib Bank Limited</span></li>
										<li>Country: <span>Pakistan</span></li>
										<li>City: <span>Karachi</span></li>
										<li>Address: <span>PNSC</span></li>
										<li>IBAN: <span class="text-semibold">PKHABB0008577900292703</span></li>
										<li>SWIFT code: <span class="text-semibold">HABBPKKA</span></li>
									</ul>
								</div>
							</div>
                      
                      
                      <div class="table-responsive">
						    <table class="table table-lg">
						        <thead>
						            <tr>
						                <th>Description</th>
						                <th class="col-sm-1">Rate</th>
						                <th class="col-sm-1">Hours</th>
						                <th class="col-sm-1">Total</th>
						            </tr>
						        </thead>
						        <tbody>
						             
						         <?php
									$tbls = "ver_checks";
									$cols = "*";


		$query2 = $db->select("ver_data vd JOIN client_invoices ci ON vd.v_id=ci.v_id ","*","ci.paid=0  AND ci.invoice_number='$getinvoicenum' AND vd.v_isdlt=0");
		$getTax = $db->select("monthly_invoice","tax","invoice_number='$getinvoicenum'");
		$rsTax = @mysql_fetch_assoc($getTax);
		$invoicedTax = ($rsTax['tax']!='')?$rsTax['tax']:14;
 
									while($rs = @mysql_fetch_assoc($query2)) { 
											 
											$checks = $db->select($tbls,$cols,"v_id=$rs[v_id]  AND as_isdlt=0");
										
											
											while($rsc = @mysql_fetch_assoc($checks)){  
												$c++;
												$checks_count++;
												echo '
												<tr>
												<td><h6 class="no-margin">'.getCheckTitle($rsc['checks_id']).'</h6></td>
												<td>-</td>
												<td>-</td>
												<td><span class="text-semibold">'.$rsc['as_cost2'].'</span></td>
												</tr>';
												
												  $total = $total+$rsc['as_cost2'];
											
											}	
												
												
											}									
									
											
											if(is_numeric($invoicedTax) && $invoicedTax!=0){
											$taxAmount = round(($total*$invoicedTax)/100);	
											$grand_total = $total+$taxAmount;
											}
								 ?>    
						          
						        </tbody>
						    </table>
						</div>
                      
                      <div class="row invoice-payment">
								

								<div class="col-sm-5 pull-right">
									<div class="content-group">
										
										<div class="table-responsive no-border">
											<table class="table">
												<tbody>
													<tr>
														<th>Subtotal:</th> 
														<td class="text-right"><?=$total?></td>
													</tr>
													<tr>
														<th>Tax: <span class="text-regular">(<?=$invoicedTax?>%)</span></th>
														<td class="text-right"><?=$taxAmount?></td>
													</tr>
													<tr>
														<th>Total:</th>
														<td class="text-right text-primary">
                                                        <h5 class="text-semibold"><?=$grand_total?></h5>
                                                        </td>
													</tr>
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
   
    
        

 