<?php 
define(ZOHO_URL,SITE_URL."?action=zoho&atype=recruit");
if(is_numeric($_SESSION['user_id'])){
	$user_id=$_SESSION['user_id'];
	$email=$_SESSION['email'];
	require_once("recruit/zoho_actions.php");
	//$string=$zoho_model->getauthen($_SESSION['email'],"zindagi123");
	$user_info = getUserInfo($user_id);
	if($user_info['zoho_key']!=''){
	$zoho_model->zoho_token=$user_info['zoho_key'];?>
    <ul>
    	<li><a href="<?=ZOHO_URL?>">Home</a></li>
        <li><a href="<?=ZOHO_URL?>&module=JobOpenings">Job Openings</a></li>
        <li><a href="<?=ZOHO_URL?>&module=Candidates">Candidates</a></li>
    </ul>
    <table>
    <?php 
	if(isset($_REQUEST['module'])){
		
		if(isset($_POST['submitrecord']))
		{  $_REQUEST['module'] = 'Candidates';
			 
		 $asd = addRecords($_REQUEST['module']);
		 // print_r($asd);
		}
		
		switch($_REQUEST['module']){
			case "JobOpenings":
			$module="JobOpenings";
			break;

			case "Candidates":
			$module="Candidates";
			break;
		}
		//start work on module
		if($module == "JobOpenings")
		{
			  		include("zoho/JobOpenings.php");	

/*		$xmldata=processZohomodulerecords($module);
		      $xmlString = <<<XML
$xmldata 
XML;
        $xml = simplexml_load_string($xmldata);
		//	print_r($xmldata);
		$table=$module;
        $numberOfRecords = count($xml->result->$table->row);
       // $records[row value][field value]  
        $records[][] = array();
        for ($i = 0; $i < $numberOfRecords; $i++) {
            $numberOfValues = count($xml->result->$table->row[$i]->FL);
            for ($j = 0; $j < $numberOfValues; $j++){
				//echo (string) $xml->result->$table->row[$i]->FL[$j]['val'];
                switch ((string) $xml->result->$table->row[$i]->FL[$j]['val']) { 
                    // Get attributes as element indices   
                    case 'Job Opening ID':
                      echo  "<tr><td>".$records[$i]['Job Opening ID'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td>";
                        break;
                    case 'Posting Title':
                       echo "<td>".$records[$i]['Posting Title'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td>";
                        break;
                    case 'Account Manager':
                    echo    "<td>".$records[$i]['Account Manager'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td>";
                        break;
                    case 'Target Date':
                   echo     "<td>".$records[$i]['Target Date'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td>";
                        break;
					case 'Job Opening Status':
                    echo   "<td>". $records[$i]['Job Opening Status'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td>";
                        break;
						case 'Client Name':
                   echo     "<td>".$records[$i]['Client Name'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td></tr>";
                        break;
                }
				 
            }
        }
		*/
		
		}
		else if($module == "Candidates")
		{
 		$xmldata=processZohomodulerecords($module);
		      $xmlString = <<<XML
$xmldata 
XML;
        $xml = simplexml_load_string($xmldata); // print_r($xml);
		//	print_r($xmldata);
		$table=$module;
        $numberOfRecords = count($xml->result->$table->row);
        /* $records[row value][field value] */
        $records[][] = array();
        for ($i = 0; $i < $numberOfRecords; $i++) {
            $numberOfValues = count($xml->result->$table->row[$i]->FL);
            for ($j = 0; $j < $numberOfValues; $j++){
				// echo (string) $xml->result->$table->row[$i]->FL[$j]['val']."<br><br><br>";
                switch ((string) $xml->result->$table->row[$i]->FL[$j]['val']) {
					?><?php
                    /* Get attributes as element indices */
                    case 'First Name':
                   // echo    "<tr><td>".$records[$i]['First Name'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td>";
                        break;
                    case 'Last Name':
                    //echo    "<td>".$records[$i]['Last Name'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td>";
                        break;

				    case 'Candidate Status':
                    //  echo  "<td>".$records[$i]['Candidate Status'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td>";
                        break;
                    case 'Updated On':
                     //  echo "<td>".$records[$i]['Updated On'] = (string) $xml->result->$table->row[$i]->FL[$j]."</td></tr>";
                        break;
                }
				?><?php
            }
        }
			
 		include("zoho/Candidates.php");	

		}
		?>
        <form action="" method="post">
        <?php
		//end work on module <form method="post">
				
		$getformfields = getformfields($module);
		$xmlString = <<<XML
$getformfields 
XML;
		
		 $xml = simplexml_load_string($getformfields);   //print_r($xml);
		 		$table=$module;
				$recx = $xml->section;
				foreach($recx as $asaasdasd)
				{
					foreach($asaasdasd as $xxxx)
					{ 
						if($xxxx['label'] == 'Last Name' || $xxxx['label'] == 'First Name')
						{ 
						if($xxxx['label'] == 'Last Name')
						{$req = "property(Last Name)";}else{$req = '';}
						?>
                        
                    <input type="text" name="property(<?=$xxxx['label']?>)" id="<?=$req?>" class="textField" style="width:100%" maxlength="80" placeholder="<?=$xxxx['label']?>"/> 
					<?php 
						// print_r($xxxx);
					}
					}
				}
			// $asdxxx = $xml->section;
			 //print_r($asdxxx->result->$table->row);
       ?>
        
        
        
        
        
        
<!--<form action="" method="post"><input type="hidden" id="createFromHid" value="null"><input type="hidden" id="pcVersionInfo" value="2"><input type="hidden" name="fieldname" value="property(Experience in Years);property(LEADCF111);property(Last Name);property(Email);property(Phone);property(Last Mailed Time)"><input type="hidden" name="fieldlabel" value="Experience in Years;Total work exp (month);Last Name;Email;Phone;Last Mailed Time"><input type="hidden" name="fielddatatype" value="DE~O~0;I~O;V~M;E~O;P~O;DT~O~Last Mailed Time~OTH"><input type="hidden" name="rowCount" value="1"><input type="hidden" name="dtPtn" value="MM/dd/yyyy"><input type="hidden" name="relmodule" value="null"><input type="hidden" name="range_value" value="null"><input type="hidden" name="FROM_INDEX" value="null"><input type="hidden" name="TO_INDEX" value="null"><input type="hidden" name="picklistFields" value="null"><input type="hidden" name="actionRedirect" value="null"><input type="hidden" name="module" id="module" value="Candidates"><input type="hidden" name="property(module)" value="Candidates"><input type="hidden" id="cvid" name="cvid" value="null"><input type="hidden" id="recordNum" name="recordNum" value="null"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td class="Leads-titleIcon"> </td><td height="30" class="title hline" style="padding-left:10px"> Create Candidate</td><td class="hline alignright"> <a id="context-helplink" class="toplink" onclick="openHelp('http://www.zoho.com/recruit/helpnew/data-administration/record-management/common-operations/create-records.html')" href="javascript:;">Help</a> </td></tr></tbody></table><p></p>
<input type="hidden" name="singularModule" id="singularModule" value="Candidate"><div class=" mandatory"></div><input type="hidden" value="create" name="operation" id="operation"><input type="hidden" id="productLineItems" value="{}"><table width="95%" border="0" cellpadding="0" cellspacing="0"><tbody><tr><td align="center"><div class=" floatR"><a target="_blank" class="smalledit" href="/recruit/ShowSetup.do?module=Leads&amp;tab=customize&amp;subTab=layouts">Edit Page Layout »»»</a></div><input class="newgraybtn" type="submit" name="Button" data-zcqa="btn_CreateRecord_Save" id="btn_CreateRecord_top_Id" value="Save">  
<input class="newgraybtn" type="button" name="Button" data-zcqa="btn_CreateRecord_SaveAndNew" id="btn_CreateRecord_SaveNew_top_Id" value="Save &amp; New" onclick="selectCreateEntityAction('Create&amp;New','Leads',this.name,event  )">  
<input type="button" name="Cancel" data-zcqa="btn_CreateRecord_Cancel" class="newgraybtn" data-cid="backOneLevel" value="Cancel">
 
</td></tr></tbody></table><p></p>
<div id="preHTMLContainer"><div id="secDivBasic Info"><table id="secHeadBasic Info" width="95%" cellspacing="0" cellpadding="0"><tbody width="100%"><tr><td class="secHead">Basic Info</td></tr></tbody></table><table id="secContentBasic Info" class="secContent" width="95%" border="0" cellspacing="1" cellpadding="0"><tbody width="100%"><tr id="row0_Basic Info"><td width="25%" class="label">First Name:</td><td width="0%" class="element"><input type="hidden" name="uiType_property(First Name)" id="uiType_property(First Name)" value="27"><select name="property(saltName)" class="select" style="width:28 %" onclick="setDependent(this,false,undefined," leads')'=""><option value="">-None-</option><option value="Mr.">Mr.</option><option value="Mrs.">Mrs.</option><option value="Ms.">Ms.</option></select><input type="text" name="property(First Name)" class="textField" style="width:70%" maxlength="40" autocomplete="off"></td></tr><tr id="row1_Basic Info"><td width="0%" class="label mandatory">*Last Name:</td><td width="0%" class="element"><input type="hidden" name="uiType_property(Last Name)" id="uiType_property(Last Name)" value="127"><input type="text" name="property(Last Name)" id="property(Last Name)" class="textField" style="width:100%" maxlength="80"></td></tr><tr id="row2_Basic Info"><td width="25%" class="label">Contact address:</td><td width="0%" class="element"><input type="hidden" name="uiType_property(LEADCF3)" id="uiType_property(LEADCF3)" value="3"><textarea name="property(LEADCF3)" maxlength="6000" id="property(LEADCF3)" class="textField" rows="5" cols="5" style="width:100%"></textarea></td></tr><tr id="row3_Basic Info"><td width="0%" class="label">Email:</td><td width="0%" class="element"><input type="hidden" name="uiType_property(Email)" id="uiType_property(Email)" value="25"><input type="text" name="property(Email)" id="property(Email)" class="textField" style="width:100%" maxlength="100"></td></tr><tr id="row4_Basic Info"><td width="0%" class="label">Phone:</td><td width="0%" class="element"><input type="hidden" name="uiType_property(Phone)" id="uiType_property(Phone)" value="33"><input type="text" name="property(Phone)" id="property(Phone)" class="textField" style="width:100%" maxlength="30"></td></tr><tr id="row5_Basic Info"><td width="0%" class="label">Source:</td><td width="0%" class="element"><input type="hidden" name="uiType_property(Source)" id="uiType_property(Source)" value="2"><select name="property(Source)" class="select" style="width:95%" onchange="setDependent(this,false,undefined,'Leads')"><option value="">-None-</option><option value="Internal">Internal</option><option value="Embed">Embed</option><option value="Import">Import</option><option value="Imported by parser">Imported by parser</option><option value="API">API</option><option value="Google import">Google import</option><option value="Resume Inbox">Resume Inbox</option><option value="Imported from Zoho CRM">Imported from Zoho CRM</option><option value="Un-Qualified">Un-Qualified</option></select></td></tr></tbody></table></div><p></p><div id="secDivOther Info"><table id="secHeadOther Info" width="95%" cellspacing="0" cellpadding="0"><tbody width="100%"><tr><td class="secHead">Other fields</td></tr></tbody></table><table id="secContentOther Info" class="secContent" width="95%" border="0" cellspacing="1" cellpadding="0"><tbody width="100%"><tr id="row0_Other Info"><td width="0%" class="label">Candidate Owner:</td><td width="0%" class="element"><input type="hidden" name="uiType_property(Lead Owner)" id="uiType_property(Lead Owner)" value="8"><input type="text" name="property(Lead Owner)" id="ownerName" class="textField" style="width:85%" maxlength="80" onchange="clearId('ownerName')" readonly="true"><img src="//img.zohostatic.com/recruit/images/spacer.gif" class="OwnerNameLookup" width="17" height="17" border="0" title="Owner Name Lookup" align="absmiddle" onclick="showLookUp('ownerName','ownerId','Assigned To','ownername',undefined,undefined,undefined,undefined,undefined,undefined,undefined,undefined,undefined,undefined,undefined,event)"><input type="hidden" name="property(ownerId)" id="ownerId" value="252987000000048003"></td></tr><tr id="row1_Other Info"><td width="0%" class="label">Email Opt Out:</td><td width="0%" class="element"><input type="hidden" name="uiType_property(Email Opt Out)" id="uiType_property(Email Opt Out)" value="301"><input type="checkbox" name="property(Email Opt Out)"></td></tr></tbody></table></div><p></p><div id="secDivProfessional Details"><table id="secHeadProfessional Details" width="95%" cellspacing="0" cellpadding="0"><tbody width="100%"><tr><td class="secHead">Professional Details</td></tr></tbody></table><table id="secContentProfessional Details" class="secContent" width="95%" border="0" cellspacing="1" cellpadding="0"><tbody width="100%"><tr id="row0_Professional Details"><td width="0%" class="label">Experience in Years:</td><td width="0%" class="element"><input type="hidden" name="uiType_property(Experience in Years)" id="uiType_property(Experience in Years)" value="38"><input type="text" name="property(Experience in Years)" id="property(Experience in Years)" class="textField" style="width:100%" maxlength="2"></td></tr><tr id="row1_Professional Details"><td width="0%" class="label">Total work exp (month):</td><td width="0%" class="element"><input type="hidden" name="uiType_property(LEADCF111)" id="uiType_property(LEADCF111)" value="32"><input type="text" name="property(LEADCF111)" id="property(LEADCF111)" class="textField" style="width:100%" maxlength="9"></td></tr><tr id="row2_Professional Details"><td width="0%" class="label">Current Job Title:</td><td width="0%" class="element"><input type="hidden" name="uiType_property(Current Job Title)" id="uiType_property(Current Job Title)" value="2"><select name="property(Current Job Title)" class="select" style="width:95%" onchange="setDependent(this,false,undefined,'Leads')"><option value="">-None-</option><option value="Fresher" selected="true">Fresher</option><option value="Project-Lead">Project-Lead</option><option value="Project-Manager">Project-Manager</option><option value="Un-Qualified">Un-Qualified</option></select></td></tr><tr id="row3_Professional Details"><td width="0%" class="label">Current Employer:</td><td width="0%" class="element"><input type="hidden" name="uiType_property(Current Employer)" id="uiType_property(Current Employer)" value="1"><input type="text" name="property(Current Employer)" id="property(Current Employer)" class="textField" style="width:100%" maxlength="100"></td></tr><tr id="row4_Professional Details"><td width="25%" class="label">Skill Set:</td><td width="0%" class="element"><input type="hidden" name="uiType_property(Skill Set)" id="uiType_property(Skill Set)" value="3"><textarea name="property(Skill Set)" maxlength="6000" id="property(Skill Set)" class="textField" rows="5" cols="5" style="width:100%"></textarea></td></tr><tr id="row5_Professional Details"><td width="0%" class="label">Expected salary:</td><td width="0%" class="element"><input type="hidden" name="uiType_property(LEADCF1)" id="uiType_property(LEADCF1)" value="2"><select name="property(LEADCF1)" class="select" style="width:95%" onchange="setDependent(this,false,undefined,'Leads')"><option value="">-None-</option><option value="100,000-200,000">100,000-200,000</option><option value="200,000-300,000">200,000-300,000</option></select></td></tr><tr id="row6_Professional Details"><td width="0%" class="label">Highest Qualification Held:</td><td width="0%" class="element"><input type="hidden" name="uiType_property(Highest Qualification Held)" id="uiType_property(Highest Qualification Held)" value="2"><select name="property(Highest Qualification Held)" class="select" style="width:95%" onchange="setDependent(this,false,undefined,'Leads')"><option value="">-None-</option><option value="B.E">B.E</option><option value="B.Tech">B.Tech</option><option value="Un-Qualified">Un-Qualified</option></select></td></tr><tr id="row7_Professional Details"><td width="25%" class="label">Additional Info:</td><td width="0%" class="element"><input type="hidden" name="uiType_property(Additional Info)" id="uiType_property(Additional Info)" value="3"><textarea name="property(Additional Info)" maxlength="6000" id="property(Additional Info)" class="textField" rows="5" cols="5" style="width:100%"></textarea></td></tr><tr id="row8_Professional Details"><td width="0%" class="label">Current salary:</td><td width="0%" class="element"><input type="hidden" name="uiType_property(LEADCF2)" id="uiType_property(LEADCF2)" value="2"><select name="property(LEADCF2)" class="select" style="width:95%" onchange="setDependent(this,false,undefined,'Leads')"><option value="">-None-</option><option value="100,000-200,000">100,000-200,000</option><option value="200,000-300,000">200,000-300,000</option></select></td></tr><tr id="row9_Professional Details"><td width="0%" class="label">Candidate Status:</td><td width="0%" class="element"><input type="hidden" name="uiType_property(Candidate Status)" id="uiType_property(Candidate Status)" value="2"><select name="property(Candidate Status)" class="select" style="width:95%" onchange="setDependent(this,false,undefined,'Leads')"><option value="New" selected="true">New</option><option value="Waiting-for-Evaluation">Waiting-for-Evaluation</option><option value="Submitted-to-client">Submitted-to-client</option><option value="Approved by client">Approved by client</option><option value="Rejected by client">Rejected by client</option><option value="Associated">Associated</option><option value="Interview-to-be-Scheduled">Interview-to-be-Scheduled</option><option value="Interview-Scheduled">Interview-Scheduled</option><option value="Rejected-for-Interview">Rejected-for-Interview</option><option value="Interview-in-Progress">Interview-in-Progress</option><option value="Waiting-for-Consensus">Waiting-for-Consensus</option><option value="To-be-Offered">To-be-Offered</option><option value="On-Hold">On-Hold</option><option value="Rejected">Rejected</option><option value="Rejected-Hirable">Rejected-Hirable</option><option value="Offer-Made">Offer-Made</option><option value="Offer-Accepted">Offer-Accepted</option><option value="Offer-Declined">Offer-Declined</option><option value="Offer-Withdrawn">Offer-Withdrawn</option><option value="Hired">Hired</option><option value="No-Show">No-Show</option><option value="Un-Qualified">Un-Qualified</option></select></td></tr></tbody></table></div><p></p><div id="secDivAttachment Information"><table id="secHeadAttachment Information" cellpadding="0" cellspacing="0" width="95%"><tbody width="100%"><tr><td class="secHead">Attachment Information</td></tr></tbody></table><table id="secContentAttachment Information" class="secContent" border="0" cellpadding="0" cellspacing="1" width="95%"><tbody width="100%"><tr id="row0_Attachment Information"><td class="label" width="25%">Attach resume:</td><td width="10%" valign="top" id="theFile_252987000000069231" class="pt10" colspan="2"><span id="theFile_inp_252987000000069231_1"><a href="javascript:void(0)" onclick="ZRCommonUtil.triggerAttachClick(undefined, this)" class="btn-browse cus-file">Browse</a><input class="file-hide" onchange="ZRCommonUtil.attachMoreUpload(undefined, this, ZRCommonUtil.constructAttachFile)" data-attachdetail="{&quot;attachid&quot;:&quot;252987000000069231&quot;, &quot;count&quot;:&quot;1&quot;, &quot;isbulk&quot;:&quot;false&quot;}" uitype="uploadfile" name="theFile_property(Attach resume)" type="file" style="display:none"></span></td><td width="65%" class="label attach-file-block" id="theFile_label_252987000000069231" colspan="2"></td></tr><tr id="row1_Attachment Information"><td class="label" width="25%">Formatted resume:</td><td width="10%" valign="top" id="theFile_252987000000069233" class="pt10" colspan="2"><span id="theFile_inp_252987000000069233_1"><a href="javascript:void(0)" onclick="ZRCommonUtil.triggerAttachClick(undefined, this)" class="btn-browse cus-file">Browse</a><input class="file-hide" onchange="ZRCommonUtil.attachMoreUpload(undefined, this, ZRCommonUtil.constructAttachFile)" data-attachdetail="{&quot;attachid&quot;:&quot;252987000000069233&quot;, &quot;count&quot;:&quot;1&quot;, &quot;isbulk&quot;:&quot;false&quot;}" uitype="uploadfile" name="theFile_property(Formatted resume)" type="file" style="display:none"></span></td><td width="65%" class="label attach-file-block" id="theFile_label_252987000000069233" colspan="2"></td></tr><tr id="row2_Attachment Information"><td class="label" width="25%">Cover Letter:</td><td width="10%" valign="top" id="theFile_252987000000069235" class="pt10" colspan="2"><span id="theFile_inp_252987000000069235_1"><a href="javascript:void(0)" onclick="ZRCommonUtil.triggerAttachClick(undefined, this)" class="btn-browse cus-file">Browse</a><input class="file-hide" onchange="ZRCommonUtil.attachMoreUpload(undefined, this, ZRCommonUtil.constructAttachFile)" data-attachdetail="{&quot;attachid&quot;:&quot;252987000000069235&quot;, &quot;count&quot;:&quot;1&quot;, &quot;isbulk&quot;:&quot;false&quot;}" uitype="uploadfile" name="theFile_property(Cover Letter)" type="file" style="display:none"></span></td><td width="65%" class="label attach-file-block" id="theFile_label_252987000000069235" colspan="2"></td></tr><tr id="row3_Attachment Information"><td class="label" width="25%">Others:</td><td width="10%" valign="top" id="theFile_252987000000069237" class="pt10" colspan="2"><span id="theFile_inp_252987000000069237_1"><a href="javascript:void(0)" onclick="ZRCommonUtil.triggerAttachClick(undefined, this)" class="btn-browse cus-file">Browse</a><input class="file-hide" onchange="ZRCommonUtil.attachMoreUpload(undefined, this, ZRCommonUtil.constructAttachFile)" data-attachdetail="{&quot;attachid&quot;:&quot;252987000000069237&quot;, &quot;count&quot;:&quot;1&quot;, &quot;isbulk&quot;:&quot;true&quot;}" uitype="uploadfile" name="theFile_property(Others)" type="file" style="display:none"></span></td><td width="65%" class="label attach-file-block" id="theFile_label_252987000000069237" colspan="2"></td></tr></tbody></table></div><input type="hidden" name="comboCount" value="1"><input type="hidden" name="dateFields" value="null"><input type="hidden" name="focusid" value="property(First Name)"><input type="hidden" id="currencyFields" value="">
</div><input type="hidden" name="fieldvalues" value="{&quot;ownerName&quot;:&quot;team.technology team.technology&quot;,&quot;ownerId&quot;:&quot;252987000000048003&quot;}"><p></p>
<table width="95%" border="0" cellpadding="0" cellspacing="0"><tbody><tr><td align="center"><input class="newgraybtn" type="submit" data-zcqa="btn_CreateRecord_Save_Bottom" id="btn_CreateRecord_bottom_Id" name="Button" value="Save">  
<input class="newgraybtn" type="button" data-zcqa="btn_SaveAndNew_Bottom" id="btn_CreateRecord_SaveNew_bottom_Id" name="Button" value="Save &amp; New" onclick="selectCreateEntityAction('Create&amp;New','Leads',this.name,event )">  >
<input type="button" name="Cancel" data-zcqa="btn_CreateRecord_Cancel_Bottom" class="newgraybtn" data-cid="back" value="Cancel"> </td></tr></tbody></table><p></p>
<div id="copy" class="dropDownMenu" style="display:none;"><table border="0" cellspacing="0" cellpadding="4"><tbody><tr onclick="copyMapLocation( 'Billing to Shipping' )" class="dropDownItem" onmouseover="this.className='dropDownItemOver'" onmouseout="this.className='dropDownItem'"><td nowrap="">Billing to Shipping</td></tr><tr onclick="copyMapLocation( 'Shipping to Billing' )" class="dropDownItem" onmouseover="this.className='dropDownItemOver'" onmouseout="this.className='dropDownItem'"><td nowrap="">Shipping to Billing</td> </tr></tbody></table></div><div id="drillDownPtr" style="position:absolute;top:-1000px;left:-1000px;"><img src="//img.zohostatic.com/recruit/ZR22APR2016_1/images/spacer.gif" width="19" height="16" class="red-arrow"></div>         
  -->      
        
        
        
        
          
        
       <input type="submit" name="submitrecord" value="Add <?=$module?>"  />
       </form>
       <?php

	}
	}else{
		echo "Home Page";
	}
}
?>