<?php
include ('include/config.php');
include ('include/config_actions.php');

	 
				
				
				
				
				
?>  <script type="text/javascript" src="<?php echo SURL;?>scripts/jquery-latest.js"></script>
     <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script><link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">  
      
    <?php
    if(isset($_REQUEST['forbulkupdate']))
	{
		print_r($_REQUEST);
	}


    if(isset($_REQUEST['singleupdate']))
	{
		print_r($_REQUEST);
	}
	
	?>  
      
      
      
 <div id="tabs">     
    
 <ul>
<!--    <li><a href="#tabs-1">Savvion Checks</a></li>
-->    <li><a href="#tabs-2">Local Checks</a></li>
   </ul>   
  <?php /*?><div id="tabs-1">  
      
  <h2>Savvion Checks</h2>    
       
<table>
<form method="post">
 <input type="text" name="searchfield" value="<?=$_REQUEST['searchfield']?>" />
 <select name="selectby">
 	<option value="0" >--Search By--</option>
 	<option value="subbarcode" <?php if($_REQUEST['selectby'] == "subbarcode"){echo "selected";}?>>Sub Barcode</option>
 	<option value="ianame" <?php if($_REQUEST['selectby'] == "ianame"){echo "selected";}?>>IA Name</option>
 	<option value="applicantname" <?php if($_REQUEST['selectby'] == "applicantname"){echo "selected";}?>>Candidate</option>
 </select>
 <input type="submit" name="searched" value="Search" />
 </form>
 <form method="post" id="formsubmit">
 
 <input type="hidden" name="bulkupdate" value="yes" />
 <input type="hidden" name="checkbulk_sav" value="yes" />
 <div id="commonmessage_savv" style="display:none"><textarea name="commonmessage" id="commonmessage" placeholder="Type Here Common Message"></textarea></div>
	<thead>
        <tr>
            <th><input type="checkbox" id="select_all"/></th>
            <th>Serial # </th>
            
            <th>Sub Barcode</th>
            <th>IA Name</th>
            <th>Candidate</th>
            <th>Qualification</th>
            <th>Create Date</th>
            <th>Internal History</th>
            <th>Internal Comment</th>
            <th>External History</th>
            <th>External Comment</th>
            <th>Action</th>
        </tr>
    </thead>
   
   <tbody id="loadmoreresponse">
	<?php
 SELECT * FROM records WHERE subbarcode LIKE '%HUSSAIN%' OR EMP_IA_Name LIKE '%HUSSAIN%'  
 OR HLT_ia_name LIKE '%HUSSAIN%'  OR EDU_ia_name LIKE '%HUSSAIN%' OR applicantname LIKE '%HUSSAIN%' 	
 	
if(isset($_REQUEST['searched']))
	{
		$searchfield = $_REQUEST['searchfield'];
		$selectby = $_REQUEST['selectby'];
		
		
		
		if($searchfield != "" && $selectby == "" || $selectby == "0")
		{
$searchTerms = explode(' ', $searchfield);
$searchTermBits = array();
foreach ($searchTerms as $term) {
    $term = trim($term);
    if (!empty($term)) {
        $searchTermBits1[] = "EMP_IA_Name LIKE '%$term%'";
    }
}
$searchTerms = explode(' ', $searchfield);
$searchTermBits = array();
foreach ($searchTerms as $term) {
    $term = trim($term);
    if (!empty($term)) {
        $searchTermBits2[] = "HLT_ia_name LIKE '%$term%'";
    }
}
$searchTerms = explode(' ', $searchfield);
$searchTermBits = array();
foreach ($searchTerms as $term) {
    $term = trim($term);
    if (!empty($term)) {
        $searchTermBits3[] = "EDU_ia_name LIKE '%$term%'";
    }
}
			
 
$searchTerms = explode(' ', $searchfield);
$searchTermBits = array();
foreach ($searchTerms as $term) {
    $term = trim($term);
    if (!empty($term)) {
        $applicantname[] = "applicantname LIKE '%$term%'";
    }
}


		$where = "and subbarcode LIKE '%".$searchfield."%' OR ".implode(' AND ', $searchTermBits1)." OR ".implode(' AND ', $searchTermBits2)."  OR ".implode(' AND ', $searchTermBits3)." OR ".implode(' AND ', $applicantname)."";
 		$select_by = "noby";
 		}
		else if($searchfield != "" && $selectby != "" && $selectby != "0")
		{
	
		if($selectby == "subbarcode")
		{
		$where = "and subbarcode LIKE '%".$searchfield."%'";
		
		}
		else if($selectby == "ianame")
		{
$searchTerms = explode(' ', $searchfield);
$searchTermBits = array();
foreach ($searchTerms as $term) {
    $term = trim($term);
    if (!empty($term)) {
        $searchTermBits1[] = "EMP_IA_Name LIKE '%$term%'";
    }
}
$searchTerms = explode(' ', $searchfield);
$searchTermBits = array();
foreach ($searchTerms as $term) {
    $term = trim($term);
    if (!empty($term)) {
        $searchTermBits2[] = "HLT_ia_name LIKE '%$term%'";
    }
}
$searchTerms = explode(' ', $searchfield);
$searchTermBits = array();
foreach ($searchTerms as $term) {
    $term = trim($term);
    if (!empty($term)) {
        $searchTermBits3[] = "EDU_ia_name LIKE '%$term%'";
    }
}
			
		$where = "and ".implode(' AND ', $searchTermBits1)." OR ".implode(' AND ', $searchTermBits2)."  OR ".implode(' AND ', $searchTermBits3)."";
		
		
		
		}
		else if($selectby == "applicantname")
		{
$searchTerms = explode(' ', $searchfield);
$searchTermBits = array();
foreach ($searchTerms as $term) {
    $term = trim($term);
    if (!empty($term)) {
        $searchTermBits[] = "applicantname LIKE '%$term%'";
    }
}
			
 		$where = "and ".implode(' AND ', $searchTermBits)."";
		}

				$select_by = $selectby;
 		}
		
		else
		{
			$where = "";
			$searchfield = "nosearch";
			$select_by = "noby";
		}
	
	
	}
 	 
	  
		$records = $db->select("records","*","1=1 $where LIMIT 0,10");

	$inc = 1;
    while($savvion = mysql_fetch_array($records))
	{
			switch($savvion['component']){
				case "education":
				$ia_name = urldecode($savvion['EDU_ia_name']);
				$qualification = urldecode($savvion['EDU_QualificationSelect_Ver']); 
				$history = urldecode($savvion['EDU_history']); 
				$component = "EDU_"; 
				break;
				case  "employment":
				$ia_name = urldecode($savvion['EMP_IA_Name']);
				$qualification = "-"; 
				$history = urldecode($savvion['EMP_history']); 
				$component = "EMP_"; 
				break;
				case "healthlicense":
				$ia_name = urldecode($savvion['HLT_ia_name']);
				$qualification = "-";
				$history = urldecode($savvion['HLT_history']);
				$component = "HLT_"; 
				break;
				default:
				$ia_name = "";
				$qualification = "-"; 
				$history = "-"; 
				$component = ""; 
			}
		
	?>
	<tr>
    	<td id="record_list_<?=$savvion['primid']?>">
        <input type="checkbox" name="select[]" id="checkid[]" class="cheks savchecks checksingle_sav_<?=$savvion['primid']?>" value="<?=$savvion['primid']?>"/>
        </td>
    	<td><?=$inc?></td>
    	<td><?=$savvion['subbarcode']?></td>
    	<td><?=$ia_name?></td>
    	<td><?=urldecode($savvion['applicantname'])?></td>
        <td><?=$qualification?></td>
    	<td><?=date("d-m-Y",strtotime($savvion['Timestamp']))?></td>
        <td><textarea readonly="readonly"><?php if($history != "" && $history != '-'){echo $history;}else{echo '-';}?></textarea></td>
        <td><textarea id="intrcmnt_<?=$savvion['primid']?>" name="intrcmnt_<?=$savvion['primid']?>"><?=$savvion['InsufficiencyComment']?></textarea>
        </td>
        <td><textarea readonly="readonly"><?php if($history != "" && $history != '-'){echo $history;}else{echo '-';}?></textarea></td>
     	<td><textarea name="extrnlcmnt_<?=$savvion['primid']?>" id="extrnlcmnt_<?=$savvion['primid']?>"><?=$savvion['extra_qc_comments']?></textarea></td>
    	<td>
        <input type="hidden" name="checkcomponent_<?=$savvion['primid']?>" id="check_comp_<?=$savvion['primid']?>" value="<?=$component?>"  />
        <input type="button" onclick="submitsinglerecord(<?=$savvion['primid']?>,'savv_sing');" name="singleupdate" value="Submit" /></td>
    </tr>
	<?php
	$inc++;
	}
	?>
    <input type="submit"  name="forbulkupdate" value="All Update" />
    
    </tbody>
</form>
</table> 
<div id="nomoreres_savv" style="display:none;">No More Result Found.</div>

<button type="button" class="btn btn-success btn-lg" id="load_more"><i class="icon-rotate-cw3 position-left"></i> Load More</button>

 </div><?php */?>
  
  

  
  
  <!--tab 1 close here and tab 2 start-->
  
  
  <div id="ta ">  
 
  <h2>Local Checks</h2>    
     <style>
	 .fornotrecord { width:100%; color:#FF0000;}
	 </style>  
     <form method="post">
 <input type="text" name="searchfield_loc" value="<?=$_REQUEST['searchfield_loc']?>" /><input type="submit" name="searched_loc" value="Search" />
 </form>
<table id="example" class="table">


 <form method="post" id="formsubmit_loc">
 <input type="hidden" name="bulkupdate" value="yes" />
  <input type="hidden" name="checkbulk_loc" value="yes" />
	<div id="commonmessage_loc" style="display:none"><textarea name="commonmessage" id="commonmessage" placeholder="Type Here Common Message"></textarea></div>
    <thead>
    <tr>
    	<th><input type="checkbox" id="select_all_loc"/></th>
    	<th>Serial # </th>
    	<th>Barcode</th>
    	<th>IA Name</th>
        <th>TAT</th>
    	<th>V Status</th>
    	<th>Follow Up History</th>
    	<th>Add Follow Ups</th>
    	<th>Check Add Date</th>
    	<th>Action</th>
    </tr>
    </thead>
   
   <tbody id="loadmoreresponse_loc">
	<?php
if(isset($_REQUEST['searched_loc']))
	{
$searchfield_loc = $_REQUEST['searchfield_loc'];

		
$searchTerms = explode(' ', $searchfield_loc);
$searchTermBits = array();
foreach ($searchTerms as $term) {
    $term = trim($term);
    if (!empty($term)) {
        $searchTermBits[] = "ui.uni_Name LIKE '%$term%'";
    }
}		
		
		 $where = "and vc.as_bcode LIKE '%".$searchfield_loc."%' OR ".implode(' AND ', $searchTermBits)."";
 	 
	}
	else
	{
		$where = "";
		$searchfield_loc = "nosearch";
	}
		 
		$tabl = "ver_checks vc INNER JOIN add_data ad ON vc.as_id=ad.as_id INNER JOIN ver_data vd ON vc.v_id=vd.v_id INNER JOIN uni_info ui ON vc.as_uni=ui.uni_id";
		$cols = "*";
		$selRoles = $db->select($tabl,$cols,"vc.as_vstatus='Followup' $where AND vc.checks_id=1 AND vc.as_uni <> 0 AND vc.as_isdlt = 0 AND vd.v_isdlt = 0 AND vc.as_status <> 'Close' GROUP BY vc.as_id ORDER BY vc.as_addate DESC ");
	//$records_loc = $db->select("records","*","1=1 $where LIMIT 0,10");
	/*$savvion2 = mysql_fetch_array($selRoles);
	print_r($savvion2);*/
	//echo $tabl.$cols."vc.as_vstatus='Followup' $where AND vc.checks_id=1 AND vc.as_uni <> 0 AND vc.as_isdlt = 0 AND vd.v_isdlt = 0 AND vc.as_status <> 'Close' GROUP BY vc.as_id ORDER BY vc.as_id DESC LIMIT 0,10";
	$inc = 1;
    while($savvion = mysql_fetch_array($selRoles))
	{ 
$add_data = $db->select("add_data","*","as_id = ".$savvion['as_id']." and d_type='followup'");	
$flw_ups = mysql_fetch_array($add_data);
 	//print_r($flw_ups);
	?>
	<tr>
    	<td id="record_list_<?=$savvion['as_id']?>">
        <input type="checkbox" name="select_loc[]" id="checkid[]" class="cheks locchecks checksingle_loc_<?=$savvion['as_id']?>" value="<?=$savvion['as_id']?>"/>
        </td>
    	<td><?=$inc?></td>
    	<td><?=$savvion['as_bcode']?></td>
    	<td><?=$savvion['uni_Name']?></td>
        <td><?=getDaysFromDates(date("Y-m-d"),$savvion['as_addate'],$savvion['com_id']);?></td>
        <td><?=urldecode($savvion['as_vstatus'])?></td>
    	<td><textarea readonly="readonly"><?=$flw_ups['d_value']?></textarea></td>
    	<td><textarea name="followups_ins_<?=$savvion['as_id']?>" id="followups_ins_<?=$savvion['as_id']?>"></textarea></td>

    	
        
    	<td><?=date("m-d-Y",strtotime($savvion['as_addate']))?></td>
        
        
    	<td><input type="button" onclick="submitsinglerecord(<?=$savvion['as_id']?>,'loc_sing');" name="singleupdate" value="Submit" /></td>
    </tr>
	<?php
	$inc++;
	}
	?>
    <input type="submit"  name="forbulkupdate_loc" value="All Update" />
     </tbody>
</form>
</table>
 

</div>
<script>
//FOR SAVVION // 

$("#select_all").change(function () {
    $(".savchecks").prop('checked', $(this).prop("checked"));
	
	         if(this.checked)
            $('#commonmessage_savv').fadeIn('slow');
        else
            $('#commonmessage_savv').fadeOut('slow');

});


// FOR ALL savvion CHECKS START  HERE //

  $("#formsubmit").submit(function(e) {

    var url = "followupsubmit.php"; // the script where you handle the form input.

var selchbox = [];
	$('.savchecks').each(function() {
        if(this.checked == true){
			selchbox.push($(this).val());
		};                        
     });
	 if(selchbox==''){
		 alert("Please select atleast 1 savvion check");
		 return false;
	 }
else{


    $.ajax({
           type: "POST",
           url: url,
           data: $("#formsubmit").serialize(), // serializes the form's elements.
           success: function(data)
           {
               alert(data); // show response from the php script.
           }
         });
		 
}

    e.preventDefault(); // avoid to execute the actual submit of the form.
});

// FOR ALL CHECKS END HERE //


// FOR ALL local CHECKS START  HERE //

  $("#formsubmit_loc").submit(function(e) {

    var url = "followupsubmit.php"; // the script where you handle the form input.

var selchbox = [];
	$('.locchecks').each(function() {
        if(this.checked == true){
			selchbox.push($(this).val());
		};                        
     });
	 if(selchbox==''){
		 alert("Please select atleast 1 local check");
		 return false;
	 }
else{
    $.ajax({
           type: "POST",
           url: url,
           data: $("#formsubmit_loc").serialize(), // serializes the form's elements.
           success: function(data)
           {
               alert(data); // show response from the php script.
           }
         });
}
    e.preventDefault(); // avoid to execute the actual submit of the form.
});

// FOR ALL CHECKS END HERE //


// FOR SAVVION END HERE

// FOR LOCAL // 

$("#select_all_loc").change(function () {
    $(".locchecks").prop('checked', $(this).prop("checked"));
	
         if(this.checked)
            $('#commonmessage_loc').fadeIn('slow');
        else
            $('#commonmessage_loc').fadeOut('slow');

 	
	 
});



// FOR LOCAL END HERE //



// FOR INDIVIDUAL CHECK COMMON //



function submitsinglerecord(id,single_check)
{
	var url = "followupsubmit.php"; 
 
	if(single_check == "savv_sing")
	{
	    var intcomment = $("#intrcmnt_"+id).val(); 
	    var extcomment = $("#extrnlcmnt_"+id).val();
		var forclas = '.checksingle_sav_'+id;
		var msgx = 'Please check on this record of savvion check';
		var checkdetail = 'savvion';
		var component = $("#check_comp_"+id).val();
		var checkcomponent = '&checkcomponent='+component;
		
		
	}
	else if(single_check == "loc_sing")
	{
	    var intcomment = ''; 
	    var extcomment = $("#followups_ins_"+id).val();
		var forclas = '.checksingle_loc_'+id;
		var msgx = 'Please check on this record of local check';
		var checkdetail = 'local';
		var checkcomponent = '';
	}
	 


var selchbox = [];
	$(forclas).each(function() {
        if(this.checked == true){
			selchbox.push($(this).val());
		};                        
     });
	 if(selchbox==''){
		 alert(msgx);
		 return false;
	 }else{
		 	 
		 
		 
    $.ajax({
           type: "POST",
           url: url,
           data: 'individual=yes&checkid='+id+'&intcomment='+intcomment+'&extcomment='+extcomment+'&checknature='+checkdetail+checkcomponent, // serializes the form's elements.
           success: function(data)
           {
               alert(data); // show response from the php script.
           }
         });
}
 
}
/*$(function() {
    $( "#tabs" ).tabs();
  });*/
  
  
  
  var cur_index=10;
	cur_index=parseInt(cur_index)+10;
	var screen_height = $('body').height();
	var cury = $(window).scrollTop();
	var screen = $(window).height();
	$('#load_more').click(function(){
      // make an ajax call to your server and fetch the next 100, then update
      //some vars
        $.ajax({
			type: 'POST',
            url: "actions.php",
            data: 'ePage=add_rating&followup_listing_savv=yes&limit='+cur_index+'&searchword=<?=$searchfield?>&searchby=<?=$select_by?>',
            success: function(result){
				console.log(result);
				
                cur_index +=10;
                screen_height = $('body').height();
				
                $( "#loadmoreresponse" ).fadeIn( 400 ).append(result);
				if(result == ''|| result == '0')
				{
					$('#nomoreres_savv').show();$('#load_more').hide(); 
				}
            }
        });
});

$('#load_more_loc').click(function(){
      // make an ajax call to your server and fetch the next 100, then update
      //some vars
        $.ajax({
			type: 'POST',
            url: "actions.php",
            data: 'ePage=add_rating&followup_listing_loc=yes&limit='+cur_index+'&searchword=<?=$searchfield_loc?>',
            success: function(result){
				console.log(result);
				
                cur_index +=10;
                screen_height = $('body').height();
				
                $( "#loadmoreresponse_loc" ).fadeIn( 400 ).append(result);
				if(result == '' || result == '0')
				{
					$('#nomoreres_loc').show();$('#load_more_loc').hide(); 
				}
            }
        });
});
 </script>
   <script>
   $( document ).ready(function() {
 $('#example').DataTable({"order": [[4, 'desc']]});
   });
  </script>