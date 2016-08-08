<?php

	// Function start for cron //


	function generateMonthlyInvoices($com_id){
		global $db;
		$today = date("Y-m-d");
		$invoice_date = date("Y-m-d (h:i A)");
		$thisMonth = date("Y-m-01");
		$lastDay = date("Y-m-t");
		$due_date = getdatedifference($today,15);
		$due_date = 	date("Y-m-d", strtotime($due_date));
		$companyTax = getCompanyTax($com_id);
		$selCom = getcompany($com_id);
		$rsCom = @mysql_fetch_assoc($selCom);
		$credits = $rsCom['credits'];
		$comName = $selCom['name'];
		$comPName = ($selCom['pname']!="")?$selCom['pname']:'';
		$comPEmail = $selCom['email'];
		$comPPhone = $selCom['phone'];
		$comPAddress = $selCom['address'];
		// if payment check wise or case wise
		if($rsCom['is_check_wise_pay']==1){
		$whr = " AND v_status='Close' ";
		}
		
		// Postpaid = 0 or Prepaid = 1
		if($rsCom['account_type']==0){
		$whr2 = " AND as_status='Close' AND as_sent=4 ";
		}
		
		
		$monthly_credits_allowed = $rsCom['monthly_credits_allowed'];
		$citbls= "client_invoices ci INNER JOIN ver_data vd ON ci.v_id=vd.v_id INNER JOIN ver_checks vc ON vd.v_id=vc.v_id";
		$cicols = "SUM(as_cost2) AS cost ,ci.invoice_number";
		$ciwhere = "ci.paid=0 AND m_invoiced=0 AND ci.invoiced=0 AND DATE(as_addate) >= '$thisMonth' AND DATE(as_addate) <= '$today' AND ci.com_id=$com_id AND vd.v_isdlt=0 AND vc.as_isdlt=0 AND ci.v_id!='' $whr $whr2";
		echo "SELECT $cicols FROM $citbls WHERE $ciwhere";
		$rsCost =  @mysql_fetch_assoc($db->select($citbls,$cicols,$ciwhere));
		$total = $rsCost['cost'];
		if(is_numeric($companyTax) && $companyTax!=0){
		$taxAmount = round(($total*$companyTax)/100);	
		$grand_total = $total+$taxAmount;
		}
		
		
		if($rsCost['invoice_number']==""){
		if(strtotime($lastDay)==strtotime($today)){
		$upd=true;	
		
		// Insert Monthly Invoice
		$db->insert("total,grand_total,due_date","'$total','$grand_total','$due_date'","monthly_invoice");	
		$invoice_id = $db->insertedID;
		$invoice_number = "RD/L/".date("y")."/".date("m")."/".$invoice_id;
		$our_ref = "RD/$rsCom[sname]/".date("y")."/".date("m")."/".$invoice_id."-".$invoice_id;
		$db->updateCol("invoice_number,our_ref","'$invoice_number','$our_ref'",'monthly_invoice',"id=$invoice_id");
		
		}else{
		die("Invoice will generate on the last date of the month");
		}
		}else{
		$upd=false;
		$rsInv =  @mysql_fetch_assoc($db->select("monthly_invoice","id,add_date,our_ref","invoice_number='$rsCost[invoice_number]'"));
		$invoice_id = $rsInv['id'];
		$invoice_date = $rsInv['add_date'];
		$invoice_date = date("Y-m-d (h:i A)",strtotime($invoice_date));
		$invoice_number = $rsCost['invoice_number'];
		$our_ref = $rsInv['our_ref'];
		}
		$tblsss = "ci.id as ci_id, ci.v_id, v_name AS  'Applicant', as.as_cost2 AS cost,  v_name, ci.add_date";
		$wheres = "ci.paid=0 AND m_invoiced=0 AND  invoiced=0 AND DATE(as_addate) >= '$thisMonth' AND DATE(as_addate) <= '$today' AND ci.com_id=$com_id  AND vd.v_isdlt=0 AND vc.as_isdlt=0 AND ci.v_id!='' $whr $whr2";
		$rst = $db->select($citbls,$tblsss,$wheres);
		
		$tbls = "ver_checks";
		$cols = "*";
		$bodyText = '<table width="100%" border="0" >
					<tr>
					<td align="center"  colspan="6" >SALES TAX INVOICE<br />
					'.OFFICE_ADDRESS.'
					</td>
					</tr>
					<tr><td align="center"  colspan="6" >&nbsp;</td></tr>
					<tr>
					<td align="left"  colspan="2" >Party Details :<br />
					'.$comName.'<br />
					'.$comPName.'<br />
					'.$comPAddress.'<br />
					Tele: '.$comPPhone.'<br />
					</td>
					<td align="left"  colspan="2" >
					Invoice No.  :<br />
					Dated :<br />
					Payment Due Dat :<br />
					Our Ref. :<br />
					Your Ref.<br />
					 NTN #:<br />
					</td>
					<td align="left"  colspan="2" >
					 '.$invoice_number.'<br />
					 '.$invoice_date.'<br />
					 '.$due_date.'<br />
					'.$our_ref.'<br />
					 NILL<br />
					 2913136-7 <br />
					</td>
					</tr>
					<tr><td align="center"  colspan="6" >&nbsp;</td></tr>
					<tr>
					<th align="center"   >S.N</th>
					<th align="center"  >Description of Goods </th>
					<th align="center"  >Add. Field </th>
					<th align="center"   >Qty. Unit </th>
					<th align="center"  >Price</th>
					<th align="center"   > Amount(Rs.)</th>
					
					
					</tr>
					<tr><td align="center"  colspan="6" >&nbsp;</td></tr>';
					
				$InvoiceBody = $bodyText;	
			
					
					
					
					
					
					
					
				 
			  
			$c=0; 
			$applicant_count=@mysql_num_rows($rst);
			
			$total = 0;
			$checks_count =0;
		while($rs = @mysql_fetch_assoc($rst)) { 
		if($upd){
		$db->updateCol("invoice_number,invoiced","'$invoice_number',1",'client_invoices',"id=$rs[ci_id]");
		//echo "update  client_invoices set invoice_number='$invoice_number'  where id=$rs[ci_id]";
		}
		$checks = $db->select($tbls,$cols,"v_id=$rs[v_id]  AND as_isdlt=0");
	
		
		while($rsc = @mysql_fetch_assoc($checks)){
			if($upd){
			$db->updateCol("m_invoiced,m_invoice_number,m_invoiced_date","1,'$invoice_number',CURRENT_TIMESTAMP",'ver_checks',"as_id=$rsc[as_id]");
			}
			$c++;
			$checks_count++;
			$bodyText .= '
			<tr>
			<td align="center"  >'.$c.'	</td>		
			<td align="left"  >'.getCheckTitle($rsc['checks_id']).'</td>
			<td align="center"  >--	</td>
			<td align="center"  >--	</td>
			<td align="center"  >--	</td>
			<td align="center"  >'.$rsc['as_cost2'].'</td>
			</tr>';
			
			$total = $total+$rsc['as_cost2'];
		
		}	
			
			
		}
		if($upd){
		// update invoice
		$db->updateCol("applicant_count,checks_count","'$applicant_count','$checks_count'",'monthly_invoice',"id=$invoice_id");
		}
		
		
		$InvoiceBody .= ' 
		
		<tr>
		<td align="center"   >1.</td>
		<td align="left"  >Total Checks '.$c.' in this month (<a href="'.SITE_URL.'?action=calcinv&atype=view&cid='.$com_id.'" >View details</a>) </td>
		<td align="center"   >--</td>
		<td align="center"   >--</td>
		<td align="center"   >--</td>
		<td align="center"   >'.$total.'</td>
		</tr>
			
		<tr>
		<td align="center"   >2.</td>
		<td align="left"  >Sales Tax ('.$companyTax.'%)</td>
		<td align="center"   >--</td>
		<td align="center"   >--</td>
		<td align="center"   >--</td>
		<td align="center"   >'.$taxAmount.'</td>
		</tr>
		<tr><td align="center"  colspan="6" style="border-bottom:1px solid #999;">&nbsp;</td></tr>
		<tr>
		<td align="center"   ></td>
		<td align="center"  ></td>
		<td align="center"   ></td>
		<td align="center"   ></td>
		<td align="center"   >Grand Total:</td>
		<td align="center"   >'.$grand_total.'</td>
		</tr>
		<tr><td align="center"  colspan="6" style="border-bottom:1px solid #999;">&nbsp;</td></tr>
		
		
		
		<tr>
		<td align="center"  colspan="2" ></td>
		<td align="center"  colspan="2" >DECLARATION<br />
		'.DECLARATION.'</td>
		 <td align="center"  colspan="2" ></td></tr>
		<tr><td align="center"  colspan="6" style="border-bottom:1px solid #999;">&nbsp;</td></tr>
		</table>';
		
		
		
		
		$bodyText .= '
			
		<tr>
		<td align="center"   >'.($c+1).'</td>
		<td align="left"  >Sales Tax ('.$companyTax.'%) </td>
		<td align="center"   >--</td>
		<td align="center"   >--</td>
		<td align="center"   >--</td>
		<td align="center"   >'.$taxAmount.'</td>
		</tr>
		
		<tr>
		<td align="center"   >Total Checks:</td>
		<td align="center"  >'.$checks_count.'</td>
		<td align="center"   >Total Applicants:</td>
		<td align="center"   >'.$applicant_count.'</td>
		<td align="center"   >Grand Total:</td>
		<td align="center"   >'.$grand_total.'</td>
		</tr>
		
		<tr><td align="center"  colspan="6" style="border-bottom:1px solid #999;">&nbsp;</td></tr>
		<tr><td align="center"  colspan="6" >DECLARATION
		Payment Instructions: Name of Beneficiary:- Background Check (Pvt.) Ltd.
		Beneficiary Account No.08517900292703: (PKR) IBAN #: PKHABB0008577900292703
		Name and Address of the Beneficiary Bank: Habib Bank Limited, PNSC Karachi. Pakistan
		Swift Code: HABBPKKA </td></tr>
		<tr><td align="center"  colspan="6" style="border-bottom:1px solid #999;">&nbsp;</td></tr>
		
		</table>';
		
		
		echo $bodyText;
		
		if((!isset($_REQUEST['cid'])) && $invoice_number!="" ){
			
		$db->updateCol("credits","'$monthly_credits_allowed'",'company',"id=$com_id");	
		
		$db->updateCol("sent,sent_date","1,CURRENT_TIMESTAMP",'monthly_invoice',"invoice_number='$invoice_number'");	
		
		
		$emailSubject = "New Invoice submitted from ".PORTAL;
		
		
							$clUsers = getClUser($com_id);

							if($clUsers){

								while($clUser = mysql_fetch_assoc($clUsers)){
									$fullName = $clUser['first_name'].' '.$clUser['last_name'];
									//$toEamil = $clUser['email'];
									$toEamil = "khalique@xcluesiv.com";
									$cc = "hassan@xcluesiv.com";
									
									
									
									
									
									emailTmp($InvoiceBody,$emailSubject,$toEamil,'',$cc,'','',$fullName);

								}

							}
		}

						
		

	}


	// Function end for cron //




 





	function getCheckTitle($checks_id){
		global $db;
		$checks = @mysql_fetch_assoc($db->select("checks","checks_title","checks_id=$checks_id"));
		
		return $checks[checks_title];
		
	}
	
	function getCompanyTax($com_id){
		global $db;
		
		$selCom = getcompany($com_id);
		$rsCom = @mysql_fetch_assoc($selCom);
		$country_id = $rsCom['location'];
		$Com_tax = getTax(0,$country_id);
			
	return $Com_tax;
		
	}
	
	
	function isCaseReadyForInvoice($v_id){
	global $db;
	
	$countStatus = $db->select("ver_checks"," as_id "," v_id=$v_id  AND as_isdlt=0 AND  as_sent=4 AND as_status='Close' AND m_invoiced=0");
	$countChecks = $db->select("ver_checks"," as_id "," v_id=$v_id  AND as_isdlt=0 AND m_invoiced=0");
	
	if($countStatus==$countChecks){
	return true;
	}else{
	return false;
	}
	
	}
	



?>