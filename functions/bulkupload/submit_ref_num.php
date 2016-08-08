<?php
$uID = $_SESSION['user_id'];
$where = "dd_active=1 $IPAGE[m_where]";

switch($LEVEL){
	case 3:
	case 9:
		//$where = "$where AND dd_user=$uID";
		$where = "$where";
	break;	
}


if(isset($_REQUEST['bbcode']) && $_REQUEST['bbcode']!=""){
$bbcode  = urldecode($_REQUEST['bbcode']);
$where = ($where!="")?" $where AND dd_bcode='$bbcode'":" dd_bcode='$bbcode' ";
}

if(isset($_REQUEST['dd_bene']) && $_REQUEST['dd_bene']!="" ){
$dd_bene  = urldecode($_REQUEST['dd_bene']);
$where = ($where!="")?" $where AND dd_bene LIKE '%$dd_bene%'":" dd_bene='$dd_bene' ";
}

if(isset($_REQUEST['from_date']) && $_REQUEST['to_date']!="" ){
 
$from_date = date('Y-m-d H:i:s' ,strtotime($_REQUEST['from_date']));
$to_date =  date('Y-m-d H:i:s' ,strtotime($_REQUEST['to_date']));

  
 $where = ($where!="")?" $where AND  DATE(dd_cdate) BETWEEN DATE('".$from_date."') AND DATE('".$to_date."')":"  DATE(dd_cdate) BETWEEN DATE('".$from_date."') AND DATE('".$to_date."')";

}
?>
<style>
	.ui-datepicker.ui-widget.ui-widget-content.ui-helper-clearfix.ui-corner-all{z-index: 1061 !important;
}

</style>
<script>
function mainfunction(addoredit,id)
	{ // alert(addoredit+" -- "+id);
	 //event.preventDefault();
		  var formData = $('#reference_letter_form').serialize();
	//var asd = formData.append("xxx1122", "xxssss");
	 
	 
		/* 	var formData = new FormData();

			formData.append("case_check_statu_update", "yes");
		 
		*/ 
 
	 if(id != "" && addoredit == 'edit')
	 {
		   $.ajax({
					type: 'POST',
					url: "actions.php",
					dataType: 'json',
					data: "edit=yes&misID="+id+"+&"+formData,
					success: function(response){
				if(response.err == '')
				{	             
				$("#response_msg").text("");	

	/*			$("#candidatename_"+id).val(response.v_name);
				$("#clientname_"+id).val(response.Client);
				$("#componenets_"+id).val(response.checks_title);
				$("#ianame_"+id).val(response.ia_name);
	*/			}
				else
				{
				$("#response_msg").text(response.err);	
	/*			$("#candidatename_"+id).val("");
				$("#clientname_"+id).val("");
				$("#componenets_"+id).val("");
				$("#ianame_"+id).val("");
	*/			}
					 
						}




	});


	 }
	 else if(id == "" && addoredit == 'add')
	 {
	 var insid = $("#insertID").val();
	// alert(insid+" xxxx");
  	   $.ajax({
 				type: 'POST',
 				url: "actions.php",
 				dataType: 'json',
 				data: "add=yes&insertID="+insid+"&"+formData,
 				success: function(response){ console.log(response);  
 			if(response.msg == 'success')
			{	
		 $.jGrowl('Record Updated.', {
						header: 'Success!',
						theme: 'bg-success'
						});
		
		///console.log(response);            
            	$("#aaaaa").val(response); 
//insertID 
//windows.localtion.reload();
			$("#insertID").val(response.insertID);
			$("#response_msg").text("");	

			$("#receivdate").val("<?=date("d-F-Y")?>");

			$("#candidatename").val(response.v_name);
			$("#clientname").val(response.Client);
			$("#componenets").val(response.checks_title);
			$("#ianame").val(response.ia_name);
			$("#cnicnum").val(response.v_nic);
			$("#fathername").val(response.v_ftname);
			
			if(response.v_name != "-" && response.Client != "-" && response.checks_title != "-"  && response.ia_name != "-" ) 
			{
			
			$('#receivdate').prop('readonly', true);
			$('#clientname').prop('readonly', true);
			$('#candidatename').prop('readonly', true);
			$('#componenets').prop('readonly', true);
			$('#ianame').prop('readonly', true);
			$('#cnicnum').prop('readonly', true);
			$('#fathername').prop('readonly', true);
			
			}
			else
			{
			$('#clientname').prop('readonly', false);
			$('#candidatename').prop('readonly', false);
			$('#componenets').prop('readonly', false);
			$('#ianame').prop('readonly', false);
			$('#cnicnum').prop('readonly', false);
			$('#fathername').prop('readonly', false);
			}
			//if(response.v_name != "-" || response.Client != "-" || response.checks_title != "-" ) 
			//{location.reload(true);
			//}
			
			} 
			else
			{
			 $.jGrowl(response.msg, {
						header: 'Error!',
						theme: 'bg-danger'
						});	
			$("#response_msg").text(response.err);	
			var clientname = $("#clientname").val();
			var candidatename = $("#candidatename").val();
			var componenets = $("#componenets").val();
			var ianame = $("#ianame").val();
			var cnicnum = $("#cnicnum").val();
			var fathername = $("#fathername").val();
			
			
			$("#candidatename").val(candidatename);
			 $("#clientname").val(clientname);
			$("#componenets").val(componenets);
			$("#ianame").val(ianame);
			$("#cnicnum").val(cnicnum);
			$("#fathername").val(fathername);
			
			
			$('#clientname').prop('readonly', false);
			$('#candidatename').prop('readonly', false);
			$('#componenets').prop('readonly', false);
			$('#ianame').prop('readonly', false);
			$('#cnicnum').prop('readonly', false);
			$('#fathername').prop('readonly', false);

			$("#insertID").val(response.insertID);

			}
				 
					}
	});


	 }
	 else
	{
		alert("Hello!!!");
	}
	 
	 
	 
	 
	 
	}	


	function getallsubcats()
	{	
			$('#ifnocatselect').hide();

		var checksource = $("#checksource").val(); //getsubcats
		if(checksource == "Local")
		{
			
	 
			$('#subcat_local').show();
			//$('#subcat_df').prop('disabled', true);
			//$('#subcat_local').prop('disabled', false);
			$('#subcat_df').hide();
		}
		else if(checksource == "DF")
		{
			$('#subcat_df').show();
			//$('#subcat_df').prop('disabled', false);
			//$('#subcat_local').prop('disabled', true);
			$('#subcat_local').hide();
		}
		else
		{
			$('#subcat_df').hide();
			$('#subcat_local').hide();
			$('#ifnocatselect').show();
			
		}
		
		//alert(checksource);
	}
	/*                    <select name="checksource" id="checksource" onchange="getallsubcats();" onblur="mainfunction('add','')">
							<option value="Savvion">Savvion</option>
							<option value="Offline">Offline</option>
							<option value="Veriflow">Veriflow</option>
							<option value="Bitrix">Bitrix</option>
						</select>
	*/


	function getfilx(id)
	{ alert(id);
		   $.ajax({
					type: 'POST',
					url: "https://backcheck.io/verify/testfordocx.php?id="+id,
					dataType: 'json',
					data: "getfilex=yes&fileid=2222&" ,
					success: function(response){
				if(response.err == '')
				{
				}
					 
						}
	 
	});


	}
</script>

<section class="retracted scrollable">
        <div class="row">
            <div class="col-md-12">
                 <div class="manager-report-sec">

				 <div class="page-section-title">
                    	<h2 class="box-head"><?=$IPAGE['m_actitle']?></h2>
                    </div>
                    <div class="row">
            <div class="col-md-3"><a href="/?action=demanddraft&atype=sub_ref_num" ><button class="btn btn-success has_text" title="Add New Record"><span><i class="icon-plus3"></i></span></button></a>
			</div></div>

<div class="list-group">





			
                          <!-- Modal -->
 

        
     <!--<a href="#" onclick="getfilx()" >Download File</a>       -->
           <div class="clear"></div> 
            <div class="list-group-item">
            <div id="dt2" class="table-responsive">
            <div id="response_msg"></div>
		<form method="post" enctype="multipart/form-data" id="reference_letter_form" name="reference_letter_form">
        <input type="hidden" name="ePage" value="add_rating" />
        <input type="hidden" name="missystem" value="yes" />
          <input type="hidden" name="insertID" id="insertID"  />
		  <input type="hidden" name="download_letter" id="download_letter"  />
		  <div class="row">
            <div class="col-md-3 pull-right">
			 <a  value="Download Reference Letter"  href="javascript:void(0)" onclick="download_reference_letter()" class="btn btn-lg filebtn btn-success float-right" style="" >Download Reference Letter</a>
	
	
			</div>
			</div>
          <table class="table table-bordered table-striped dataTable" id="tableSortable">
            <thead>
                <tr>
                    <th> <input type="checkbox" id="select_all"/></th> 
					<th>Sr.#</th>
					<th>Receiving Date</th>
                    <th>Check Source</th>
                    <!--<th >Sub Category</th>-->
                    <th>Barcode</th>
                    <th>Client Name</th>
                    <th>Candidate Name</th>
                    <th>Components</th>
                    <th>Status</th>
					<th>Age</th>
					<th>IA Name</th>
					<th>Qualification/ Component Detail</th>
					<th>Father Name</th>
					<th>Cnic #</th>
					<th>Close Date</th>
					<th>Closed TAT</th>
					<th>Roll #</th>
					<th>DD Amount</th>
					<th>DD Number</th>
					<th>Letter Ref. Number</th>
					<th>Sent Date</th>
					<th>Out Courier No.</th>
					<th>Status</th>
					<th>Followup-1</th>
					<th>Followup-2</th>
					<th>Followup-3</th>
					<th>Followup-4</th>
					<th>Followup-5</th>
					<th>Courier Company</th>
					<th>Curier Number</th>
					<th>Date</th>
					<th>Time</th>



                    <?php if($LEVEL!=3){ ?><th>Actions</th><?php } ?>
                </tr>
            </thead>
            <tbody>
            <?php 
                $tbls = "mis_management_system";
				//echo "select * from $tbls $where ORDER BY dd_id DESC";
              ?>
              
               <tr>
				                                 <th>&nbsp;</th>
					<td>&nbsp;</td>
					<td><input id="receivdate" type="text" name="receivdate"  class="datetimepicker-month1ss form-control" placeholder="Search by Start Date"  value="-" onblur="mainfunction('add','')">            
</td>
                    <td>
                    <select name="checksource" id="checksource" onblur="mainfunction('add','')" class="select">
                    	<option value="">--Select Check Source--</option>
                    	<option value="Savvion">Savvion</option>
                     	<option value="Veriflow">Veriflow</option>
                     	<option value="DF-Offline">DF-Offline</option>
                     	<option value="LO-Offline">LO-Offline</option>
                     	<option value="Bitrix">Bitrix</option>
                     </select>
                    <div id="getsubcats"></div>
                    </td> 
                   
                    <td><input type="text" name="barcode" id="barcode" placeholder="Barcode" onblur="mainfunction('add','')"  value="-" /></td>
                    <td><input type="text" name="clientname" id="clientname" placeholder="Client Name" readonly="readonly" onblur="mainfunction('add','')"  value="-" /></td>
                    <td><input type="text" name="candidatename" readonly="readonly" id="candidatename" placeholder="Candidate Name" onblur="mainfunction('add','')"  value="-"  /></td>
                     
                    <td>
                    <?php
					$checks = $db->select("checks","checks_title,checks_id","is_active=1");
					 
					?>

                    <select name="componenets" id="componenets" onblur="mainfunction('add','')" readonly="readonly" class="select">
                    	<option value="">Select Component</option>
                        <?php
                        while($check = mysql_fetch_assoc($checks))
						{
							echo '<option value='.$check['checks_title'].'>'.$check['checks_title'].'</option>';
						}
						?>
                        
                     </select>
                    </td>
                    <td>
                    <select name="status" id="status" onblur="mainfunction('add','')" class="select">
                    	<option value="-">-- Select Status --</option>
                    	<option value="Not Initiated">Not Initiated</option>
                    	<option value="WIP">WIP</option>
                    	<option value="Insufficient">Insufficient</option>
                    	<option value="Unable to Verify">Unable to Verify</option>
                    	<option value="Online Result Found">Online Result Found</option>
                    	<option value="Verbal OK">Verbal OK</option>
                    	<option value="Verified Verbal">Verified Verbal</option>
                    	<option value="Verified Written">Verified Written</option>
                    	<option value="Verified Online">Verified Online</option>
                    	<option value="Verified Negative">Verified Negative</option>
            		    </select>
                    </td>
					<td><input type="text" name="age" id="age" placeholder="Age" value="-" onblur="mainfunction('add','')"/></td>
					<td>
                    <?php
					$sql = "SELECT * FROM `uni_info`";
					$data = mysql_query($sql);
					
					?>
                    <select name="ianame" id="ianame" onblur="mainfunction('add','')" class="select" style="width: 162px;">
                    	<option value="-">-- Select IA Name --</option>
                    <?php
                    while($rows = mysql_fetch_array($data)){
					?>    
                    	<option value="<?=$rows['uni_Name']?>"><?=$rows['uni_Name']?></option>
                    <?php
					}
					?>   
                    	 
           		    </select>
                    </td>
					<td><input name="qualification_detail" id="qualification_detail" placeholder="Qualification / Component Detail" value="-" onblur="mainfunction('add','')"/></td>
					<td><input name="fathername" id="fathername" placeholder="Father Name" value="-" onblur="mainfunction('add','')"/></td>
					<td><input type="text" name="cnicnum" id="cnicnum" placeholder="Cnic #" value="-" onblur="mainfunction('add','')"/></td>
					<td><input type="text" name="closeddate" id="closeddate" placeholder="Close Date"  onblur="mainfunction('add','')" value="-"/></td>
					<td><input type="text" name="closedtat" id="closedtat" placeholder="Closed TAT" onblur="mainfunction('add','')" value="-"/></td>
					<td><input type="text" name="rollnum" id="rollnum" placeholder="Roll #" onblur="mainfunction('add','')" value="-"/></td>
					<td><input type="text" name="ddamount" id="ddamount" placeholder="DD Amount" onblur="mainfunction('add','')" value="-"/></td>
					<td><input type="text" name="ddnumber" id="ddnumber" placeholder="DD Number" onblur="mainfunction('add','')" value="-"/></td>
					<td><input type="text" name="letter_ref_num" id="letter_ref_num" placeholder="Letter Ref. Number" value="-" onblur="mainfunction('add','')"/></td>
					<td><input type="text" name="sent_date" id="sent_date" placeholder="Sent Date"  onblur="mainfunction('add','')"/></td>
					<td><input type="text" name="out_mail_courier_num" id="out_mail_courier_num" placeholder="Out mail courier num"  onblur="mainfunction('add','')"/></td>
					<td><input type="text" name="out_mail_status" id="out_mail_status" placeholder="Out mail status"  onblur="mainfunction('add','')"/></td>
					<td><textarea name="followup1" id="followup1" placeholder="Followup-1" onblur="mainfunction('add','')">-</textarea></td>
					<td><textarea name="followup2" id="followup2" placeholder="Followup-2" onblur="mainfunction('add','')">-</textarea></td>
					<td><textarea name="followup3" id="followup3" placeholder="Followup-3" onblur="mainfunction('add','')">-</textarea></td>
					<td><textarea name="followup4" id="followup4" placeholder="Followup-4" onblur="mainfunction('add','')">-</textarea></td>
					<td><textarea name="followup5" id="followup5" placeholder="Followup-5" onblur="mainfunction('add','')">-</textarea></td>
					<td><input type="text" name="couriercompany" id="couriercompany" placeholder="Courier Company" value="-" onblur="mainfunction('add','')" /></td>
					<td><input type="text" name="couriernumber" id="couriernumber" placeholder="Curier Number" value="-" onblur="mainfunction('add','')" /></td>
					<td><input type="text" name="mdate" id="mdate" placeholder="Date" value="-" onblur="mainfunction('add','')" /></td>
					<td><input type="text" name="mtime" id="mtime" placeholder="Time" value="-" onblur="mainfunction('add','')" /></td>
                    <?php if($LEVEL!=3){ ?><td>Actions</td><?php } ?>	
                    </tr>
                    <!--<tr>
                    <td><input type="button" name="submitrec" onclick="ifaddnew(); mainfunction('add','')" value="Submit"  />
                    </td></tr>-->
                <tr>
              
              <?php 

			$db_count = $db->select($tbls,"COUNT(misID) as cnt","(1=1)");
			$db_count =  mysql_fetch_array($db_count);
			$db_count = $db_count['cnt'];
			
			if($db_count>0){
			//if(0>1){
				//include("include_pages/pagination_inc.php");
				$data = $db->select($tbls,"*","1=1 ORDER BY misID DESC");
                $inx = 0;
				while($re = mysql_fetch_array($data)) { $inx++;
					$uni = $db->select("uni_info","*","uni_id=$re[ianame]");
					$uni = mysql_fetch_assoc($uni);?>
               <tr>
			<th><input type="checkbox" name="select[]" id="record_id[]" class="cheks" value="<?=$re['misID']?>" />  </th>
					<td><?=$inx?></td>
					<td><?php /*?><input id="receivdate_<?=$re['misID']?>" type="text" name="receivdate_<?=$re['misID']?>"  class="datetimepicker-month1ss form-control" placeholder="Search by Start Date"  value="<?=$re['receivingdate']?>" >  <?php */?> 
                    <?=$re['receivingdate']?>         
</td>
                    <td>
                    
                    <?=$re['checkSource']?>
<?php /*?>                    <select name="checksource_<?=$re['misID']?>" id="checksource_<?=$re['misID']?>" onblur="mainfunction('edit','<?=$re['misID']?>')">
                    	<option value="Savvion">Savvion</option>
                    	<option value="Offline">Offline</option>
                    	<option value="Veriflow">Veriflow</option>
                    	<option value="Bitrix">Bitrix</option>
                    </select>
                    <script>$('#checksource_<?=$re['misID']?>').val("<?=$re['checkSource']?>");</script><td><?=$re['sub_checkSource']?></td>
<?php */?>                    </td>
                    
                    <td><?php /*?><input type="text" name="barcode_<?=$re['misID']?>" id="barcode_<?=$re['misID']?>" placeholder="Barcode" onblur="mainfunction('edit','<?=$re['misID']?>')"  value="<?=$re['barcode']?>" readonly="readonly"/><?php */?>
                    <?=$re['barcode']?>
                    
                    </td>
                    
                    <td><?php /*?><input type="text" name="clientname_<?=$re['misID']?>" id="clientname_<?=$re['misID']?>" placeholder="Client Name" onblur="mainfunction('edit','<?=$re['misID']?>')"  value="<?=$re['clientname']?>" readonly="readonly" />             onclick="getfilx(<?=$re['misID']?>)"<?php */?>
                    <?=$re['clientname']?>
                    </td>
                    
                    <td><?php /*?><input type="text" name="candidatename_<?=$re['misID']?>" id="candidatename_<?=$re['misID']?>" placeholder="Candidate Name" onblur="mainfunction('edit','<?=$re['misID']?>')"  value="<?=$re['candidateName']?>" readonly="readonly" /><?php */?>
                    <?=$re['candidateName']?>
                    </td>
                     
                    <td>
                    <?php
                   $tCheck = getCheck($re['components'],0,0);
				   echo $tCheck['checks_title'];
					?>
                    <?php /*?><select name="componenets_<?=$re['misID']?>" id="componenets_<?=$re['misID']?>" onblur="mainfunction('edit','<?=$re['misID']?>')" disabled="disabled">
                    	<option value="Address">Address</option>
                    	<option value="Bankruptcy">Bankruptcy</option>
                    	<option value="Civil & Criminal Litigation Search">Civil & Criminal Litigation Search</option>
                    	<option value="Civil Litigation">Civil Litigation</option>
                    	<option value="Civil Litigation & Bankruptcy">Civil Litigation & Bankruptcy</option>
                    	<option value="CR">CR</option>
                    	<option value="Credit">Credit</option>
                    	<option value="Credit & Bankruptcy">Credit & Bankruptcy</option>
                    	<option value="Directorship / Title Check">Directorship / Title Check</option>
                    	<option value="Driving License">Driving License</option>
                    	<option value="Education">Education</option>
                    	<option value="Employment">Employment</option>
                    	<option value="GLOBAL CRIMINALITY CHECK">GLOBAL CRIMINALITY CHECK</option>
                    	<option value="Global Risk Database,Regularity,Watach List & San">Global Risk Database,Regularity,Watach List & San</option>
                    	<option value="Health License">Health License</option>
                    	<option value="International Worldwatch Plus">International Worldwatch Plus</option>
                    	<option value="Local Media Check">Local Media Check</option>
                    	<option value="NADRA">NADRA</option>
                    	<option value="Online Media Ser">Online Media Ser</option>
                    	<option value="Pak credit & Bankruptcy">Pak credit & Bankruptcy</option>
                    	<option value="Pak Criminality Terrorism & Fraud Search">Pak Criminality Terrorism & Fraud Search</option>
                    	<option value="Reference">Reference</option>
                     </select>
                     <script>$('#componenets_<?=$re['misID']?>').val("<?=$re['components']?>");</script>
                   <?php */?> </td>
                    <td>
                    <select name="status_<?=$re['misID']?>" id="status_<?=$re['misID']?>" onblur="mainfunction('edit','<?=$re['misID']?>')" disabled="disabled">
                    	<option value="-">-- Select Status --</option>
<!--                    	<option value="Not Initiated">Not Initiated</option>
                    	<option value="WIP">WIP</option>
                    	<option value="Insufficient">Insufficient</option>
-->           		  
                    	<option value="Not Initiated">Not Initiated</option>
                    	<option value="WIP">WIP</option>
                    	<option value="Insufficient">Insufficient</option>
                    	<option value="Unable to Verify">Unable to Verify</option>
                    	<option value="Online Result Found">Online Result Found</option>
                    	<option value="Verbal OK">Verbal OK</option>
                    	<option value="Verified Verbal">Verified Verbal</option>
                    	<option value="Verified Written">Verified Written</option>
                    	<option value="Verified Online">Verified Online</option>
                    	<option value="Verified Negative">Verified Negative</option>


				  </select>
                    <script>$('#status_<?=$re['misID']?>').val("<?=$re['status']?>");</script>
                    </td>
					<td><input type="text" name="age_<?=$re['misID']?>" id="age_<?=$re['misID']?>" placeholder="Age" value="<?=$re['age']?>" onblur="mainfunction('edit','<?=$re['misID']?>')" /></td>
					<td>
                    <?php /*?><select name="ianame_<?=$re['misID']?>" id="ianame_<?=$re['misID']?>">
                    	<option value="-">-- Select IA Name --</option>
                    	<option value="Mehran University">Mehran University</option>
                    	<option value="University of the Punjab">University of the Punjab</option>
                    	<option value="Shah Abdul Latif Bhitai University">Shah Abdul Latif Bhitai University</option>
                    	<option value="NED University of Engineering and Technology, Karachi">NED University of Engineering and Technology, Karachi</option>
           		    </select><script>$('#ianame_<?=$re['misID']?>').val("<?=$re['ianame']?>");</script><?php */?>
                    <?=$re['ianame']?>
					<input type="hidden" name="ianame[]" id="ianame_<?=$re['misID']?>"  value="<?=$re['ianame']?>" class="each_ianame" />
                    
                    </td>
					<td><?php /*?><input name="qualification_detail_<?=$re['misID']?>" id="qualification_detail_<?=$re['misID']?>" placeholder="Qualification / 
Component Detail" value="<?=$re['qualification_detail']?>"/><?php */?>
<?=$re['qualification_detail']?>
</td>

					<td><?php /*?><input name="fathername_<?=$re['misID']?>" id="fathername_<?=$re['misID']?>" placeholder="Father Name" value="<?=$re['fatherName']?>"/><?php */?><?=$re['fatherName']?></td>
                    
					<td><?php /*?><input type="text" name="cnicnum_<?=$re['misID']?>" id="cnicnum_<?=$re['misID']?>" placeholder="Cnic #" value="<?=$re['cnicno']?>"/><?php */?><?php if($re['cnicno']){echo $re['cnicno'];}else{echo "-";}?></td>
                    
					<td><input type="text" name="closeddate_<?=$re['misID']?>" id="closeddate_<?=$re['misID']?>" placeholder="Close Date" value="<?=$re['closedate']?>"/></td>
                    
					<td><input type="text" name="closedtat_<?=$re['misID']?>" id="closedtat_<?=$re['misID']?>" placeholder="Closed TAT" value="<?=$re['closedTAT']?>"/></td>
                    
					<td><input type="text" name="rollnum_<?=$re['misID']?>" id="rollnum_<?=$re['misID']?>" placeholder="Roll #" value="<?=$re['rollno']?>"/></td>
                    
					<td><input type="text" name="ddamount_<?=$re['misID']?>" id="ddamount_<?=$re['misID']?>" placeholder="DD Amount" value="<?=$re['ddamount']?>"/></td>
                    
					<td><input type="text" name="ddnumber_<?=$re['misID']?>" id="ddnumber_<?=$re['misID']?>" placeholder="DD Number" value="<?=$re['ddnum']?>"/></td>
                    
					<td><input type="text" name="letter_ref_num_<?=$re['misID']?>" id="letter_ref_num_<?=$re['misID']?>" placeholder="Letter Ref. Number" value="<?=$re['letter_ref_num']?>" /></td>
                    
					<td><input type="text" name="sent_date_<?=$re['misID']?>" id="sent_date_<?=$re['misID']?>" placeholder="Sent Date" value="<?=$re['sent_date']?>" /></td>
					<td><input type="text" name="out_mail_courier_num_<?=$re['misID']?>" id="out_mail_courier_num_<?=$re['misID']?>" placeholder="Out mail courier number" value="<?=$re['out_mail_courier_num']?>" /></td>
					<td><input type="text" name="out_mail_status_<?=$re['misID']?>" id="out_mail_status_<?=$re['misID']?>" placeholder="Out mail status" value="<?=$re['out_mail_status']?>" /></td>
                    
					<td><textarea name="followup1_<?=$re['misID']?>" id="followup1_<?=$re['misID']?>" onblur="mainfunction('edit','<?=$re['misID']?>')" placeholder="Followup-1"><?=$re['followup_1']?></textarea></td>
					<td><textarea name="followup2_<?=$re['misID']?>" id="followup2_<?=$re['misID']?>" onblur="mainfunction('edit','<?=$re['misID']?>')" placeholder="Followup-2"><?=$re['followup_2']?></textarea></td>
					<td><textarea name="followup3_<?=$re['misID']?>" id="followup3_<?=$re['misID']?>" onblur="mainfunction('edit','<?=$re['misID']?>')" placeholder="Followup-3"><?=$re['followup_3']?></textarea></td>
					<td><textarea name="followup4_<?=$re['misID']?>" id="followup4_<?=$re['misID']?>" onblur="mainfunction('edit','<?=$re['misID']?>')" placeholder="Followup-4"><?=$re['followup_4']?></textarea></td>
					<td><textarea name="followup5_<?=$re['misID']?>" id="followup5_<?=$re['misID']?>" onblur="mainfunction('edit','<?=$re['misID']?>')" placeholder="Followup-5"><?=$re['followup_5']?></textarea></td>
                    
					<td><input type="text" name="couriercompany_<?=$re['misID']?>" id="couriercompany_<?=$re['misID']?>" placeholder="Courier Company" value="<?=$re['courier_company']?>" onblur="mainfunction('edit','<?=$re['misID']?>')" /></td>
                    
					<td><input type="text" name="couriernumber_<?=$re['misID']?>" id="couriernumber_<?=$re['misID']?>" placeholder="Curier Number" value="<?=$re['curier_num']?>" onblur="mainfunction('edit','<?=$re['misID']?>')" /></td>
                    
					<td><input type="text" name="mdate_<?=$re['misID']?>" id="mdate_<?=$re['misID']?>" placeholder="Date" value="<?=$re['mdate']?>" /></td>
                    
					<td><input type="text" name="mtime_<?=$re['misID']?>" id="mtime_<?=$re['misID']?>" placeholder="Time" value="<?=$re['mtime']?>" /></td>
                    
                    <?php if($LEVEL!=3){ ?><td>Actions</td><?php } ?>	
                 
            <?php }
				}
				else
				{?>
               
				<?php
                }?>
            </tbody>
			
			 
        </table>
         </form>

 

<?php //include("include_pages/pager_inc.php"); ?>
            </div>
		</div>

	</div>
 	
</div>
</div>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
											  
	  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<script>
		
		



$(document).ready(function () {
            $('#tableSortable').dataTable({
                 "bPaginate": true,
				"bLengthChange": false,
				"bFilter": true,
				"bInfo": false,
				"bAutoWidth": false,
				"bSort": false
            });
        });
		
		
		
		
	$('#select_all').change(function() {
    var checkboxes = $(this).closest('form').find(':checkbox');
    if($(this).is(':checked')) {
        checkboxes.prop('checked', true);
    } else {
        checkboxes.prop('checked', false);
    }
});	


function download_reference_letter(){
	var selchbox = [];
	$('.cheks').each(function() {
        if(this.checked == true){
			selchbox.push($(this).val());
		};                        
     });
	 if(selchbox==''){
		 alert("Please select atleast 1 record");
		 $.jGrowl("Please select atleast 1 record", {
						header: 'Error!',
						theme: 'bg-danger'
						});	
		 return false;
	 }else{
	var each_ianame = [];
	$('.each_ianame').each(function() {
    each_ianame.push($(this).val());
	});
	checkIfArrayIsUnique(each_ianame)
	//console.log(checkIfArrayIsUnique(each_ianame));
	if(checkIfArrayIsUnique(each_ianame)===false){
	//alert(checkIfArrayIsUnique(each_ianame));
	alert("University not same");
	 return false;
	
	}else{
	$('#download_letter').val(1);
	document.reference_letter_form.submit();
	
	}
		 
	
 	//document.getElementById('merge_checkids').value=selchbox;
	
		 }
	
}

 function checkIfArrayIsUnique(arr) {
    var map = {}, i, size;
	console.log(arr);
    for (i = 0, size = arr.length; i < size; i++){
        if (map[arr[i]]){
            return false;
        }

        map[arr[i]] = true;
    }

    return true;
}
 

		
		
 $(document).ready(function(){
    $("#txtFromDate").datepicker({
       // numberOfMonths: 2,
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange: "1990:2016",
        onSelect: function(selected) {
          $("#txtToDate").datepicker("option","minDate", selected)
        }
    });
    $("#txtToDate").datepicker({ 
       // numberOfMonths: 2,
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange: "1990:2016",
        onSelect: function(selected) {
           $("#txtFromDate").datepicker("option","maxDate", selected)
        }
    });  

   $(function () {
		$( ".datetimepicker-month1ss").datepicker({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange: "1980:<?php echo date("Y");?>"
		});
		});


    $("#txtFromDatenew").datepicker({ 
       // numberOfMonths: 2,
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange: "1990:2016" 
        
    });  


});

				
</script>
