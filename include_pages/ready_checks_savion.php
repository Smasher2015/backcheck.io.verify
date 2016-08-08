<?php 
if(isset($_REQUEST['update']) && is_numeric($_REQUEST['check'])){
	mysql_query("update savvion_check set status=4 where id=".$_REQUEST['check']."");
}
?>
<div style="margin-left:90px; overflow-x: scroll; width:93%;">
                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                          	 <th>Id</th>
                            <th>Reference No</th>
                            <th>Client Name</th>
                            <th>Client Reference No</th>
                            <th>Date Of Birth</th>
                            <th>Passport No.</th>
                            <th>AKAName</th>
                            <th>Gender</th>
                            <th>Nationality</th>
                            <th>ArabicName</th>
                            <th>Education_UniversityName</th>
                            <th>Education_UniversityAddress</th>
                            <th>Education_City</th>
                            <th>Education_Country</th>
                            <th>Education_Telephone</th>
                            <th>IA_Name</th>
                            <th>IA_Address</th>
                            <th>IA_City</th>
                            <th>IA_Country</th>
                            <th>IA_Fax</th>
                            <th>IA_Email</th>
                            <th>IA_WebAddress</th>
                            <th>IA_IsFake</th>
                            <th>IA_IsOnline</th>
                            <th>Employment_CompanyName</th>
                            <th>Employment_CompanyAddress</th>
                            <th>Employment_City</th>
                            <th>Employment_Country</th>
                            <th>Employment_Telephone</th>
                             <th>Employment_WebAddress</th>
                             <th>IA_Telephone</th>
                               <th>IA_ContactPerson</th>
                             <th>HltLicense_AuthorityName</th>
                              <th>HltLicense_AuthorityAddress</th>
                              <th>HltLicense_City</th>
                            <th>HltLicense_Country</th>
                              <th>HltLicense_Telephone</th>
                           <th>HltLicense_WebAddress</th>
                           <th>_UNBOUND_textArea3</th>
                            <th>HistoryRemarks</th>
                            <th>_UNBOUND_historyNew</th>
                            <th width="60">Actions</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php	
							$checks = $db->select("savvion_check","*","status = 3");
                        if(mysql_num_rows($checks)>0){
                        while($check = mysql_fetch_array($checks)){ ?>
                          <tr>
                          	<td><?=$check['id']?></td>
                            <td><?=mb_convert_encoding($check['SubBarcode'], 'HTML-ENTITIES','UTF-8');?></td>
                            <td style="text-align:left"><?=$check['ClientName']?></td>
                            <td><?=$check['ClientRefNo']?></td>
                             <td><?=$check['DateOfBirth']?></td>
                              <td><?=$check['PassportNo']?></td>
                               <td><?=$check['AKAName']?></td>
                                <td><?=$check['Gender']?></td>
                                 <td><?=$check['Nationality']?></td>
                                  <td><?=$check['ArabicName']?></td>
                                   <td><?=$check['Education_UniversityName']?></td>
                                    <td><?=$check['Education_UniversityAddress']?></td>
                                     <td><?=$check['Education_City']?></td>
                                      <td><?=$check['Education_Country']?></td>
                                       <td><?=$check['Education_Telephone']?></td>
                                       <td><?=$check['IA_Name']?></td>
                                         <td><?=$check['IA_Address']?></td>
                                        <td><?=$check['IA_City']?></td>
                                        <td><?=$check['IA_Country']?></td>
                                        <td><?=$check['IA_Fax']?></td>
                                        <td><?=$check['IA_Email']?></td>
                                        <td><?=$check['IA_WebAddress']?></td>
                                        <td><?=$check['IA_IsFake']?></td>
                                        <td><?=$check['IA_IsOnline']?></td>
                                         <td><?=$check['Employment_CompanyName']?></td>
                                         <td><?=$check['Employment_CompanyAddress']?></td>
                                         <td><?=$check['Employment_City']?></td>
                                           <td><?=$check['Employment_Country']?></td>
                                             <td><?=$check['Employment_Telephone']?></td>
                                        <td><?=$check['Employment_WebAddress']?></td>
                                         <td><?=$check['IA_Telephone']?></td>
                                          <td><?=$check['IA_ContactPerson']?></td>
                                           <td><?=$check['HltLicense_AuthorityName']?></td>
                                           <td><?=$check['HltLicense_AuthorityAddress']?></td>
                                           <td><?=$check['HltLicense_City']?></td>
                                           <td><?=$check['HltLicense_Country']?></td>
                                           <td><?=$check['HltLicense_Telephone']?></td>
                                           <td><?=$check['HltLicense_WebAddress']?></td>
                                           <td><?=$check['_UNBOUND_textArea3']?></td>
                                           <td><?=$check['HistoryRemarks']?></td>
                                           <td><?=$check['_UNBOUND_historyNew']?></td>
                            <td align="center">
                             <a href="javascript:void(0)" ><img onclick="submitLink('&update&check=<?=$check['id']?>')" src="images/icons/small/grey/pencil.png"  class="edits" title="Edit"  /> </a></td>
                          </tr>
                          <?php }}else{ ?>
                          <tr>
                            <td colspan="3"><h2 align="center">No Checks</h2></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                   </div>