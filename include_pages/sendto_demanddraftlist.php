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


<section class="retracted scrollable">
        <div class="row">
            <div class="col-md-12">








<section class="retracted scrollable">
            <div class="report-sec">
            <div class="page-section-title">
            <h2 class="box_head">Search Filters</h2>
            </div>
            <div class="panel panel-default panel-block">	
            <div id="filters" class="section" >
            
            <div class="panel panel-default panel-block">
            	<div class="list-group">
                <div class="list-group-item">
            <form action="<?="?action=$action&atype=$aType"?>" class="table-form" method="post">
            <div style="float:left; margin-top:20px; " class="col-md-12">
            <fieldset class="mrg-bottom custom-input float-left search-width">
            <div class="form-group ">
            <?php $bbcode=(isset($_REQUEST['bbcode']))?$_REQUEST['bbcode']:''?>
            <input type="text" class="form-control" name="bbcode" value="<?=$bbcode?>" placeholder="Search by Barcode" >
            </div>
            </fieldset>
           
			
			
			<fieldset class="mrg-bottom custom-input float-left search-width">
            <div class="form-group ">
            <?php $dd_bene=(isset($_REQUEST['dd_bene']))?$_REQUEST['dd_bene']:''?>
            <input type="text" class="form-control" name="dd_bene" value="<?=$dd_bene?>" placeholder="Search by Beneficiary" >
            </div>
            </fieldset>
            
            
			
			
			<fieldset class="mrg-bottom custom-input float-left search-width">
            <div class="form-group ">
            <?php $from_date=(isset($_REQUEST['from_date']))?$_REQUEST['from_date']:''?>
   			<input id="txtFromDate" type="text" name="from_date" value="<?=$from_date?>" class="datetimepicker-month1 form-control" placeholder="Search by Start Date" >            
            </div>
            </fieldset>


			<fieldset class="mrg-bottom custom-input float-left search-width">
            <div class="form-group ">
            <?php $to_date=(isset($_REQUEST['to_date']))?$_REQUEST['to_date']:''?>
           <?php /*?> <input type="text" class="form-control" name="dd_cdate" value="<?=$dd_cdate?>" placeholder="Search by Date" ><?php */?>
            
 <input id="txtToDate" type="text" name="to_date" value="<?php echo $to_date;?>" class="datetimepicker-month2 form-control" placeholder="Search by End Date">           
            </div>
            </fieldset>
            
            
            
            
            
			 <button class="btn filebtn btn-success float-left" style="float:left;" type="submit" name="Search_btn">
            <span>Search</span>
            </button>	
            </div>
           
            </form>
            <div class="clear"></div>
            </div>
            </div>
            </div>
            
            </div>
            </div>
            <div class="clear"></div>
            </div>
</section> 


 









<?php							 
 	
function fileUpload22($key,$exs,$path='',$sname='',$exnm=true){
	$fName=$_FILES[$key]['name'];
	$fary  = explode('.',$fName);
	
	if($sname==''){
		$sname = preg_replace('/[^a-zA-Z0-9\-_]/','',ucwords(strtolower($fary[0])));
	}
	if(count($fary)>0) $ex = $fary[count($fary)-1]; else $ex = 'NA';
	$exs = getExts($exs,0);
	if(in_array($ex,$exs)){
		$indx=strtoupper(get_rand_val(6));
		if($exnm){
			 $fPath = $path."$sname-$indx.$ex";
		}else{
			 $fPath = $path."$sname.$ex";
		}
		if(move_uploaded_file($_FILES[$key]['tmp_name'],$fPath)){
			return $fPath;
		}
	}else{
		$exs = implode(',',$exs);
		msg('err',"$ex File type is not allowed!, Please Upload the following types [ $exs ] !");
	}
	return false;
}
						
							
if(isset($_POST['updateselected']))
{   //print_r($_POST);
//print_r($_FILES);
//echo $_FILES["dd_filex"]["name"];
	
	if($_POST['updateselected'] == 'Paid')
	{  
	
		if(count($_POST['select']) > 0)
		{
		 $dd_num = $_POST['dd_num'];	
		 $dd_cus_date = $_POST['dd_cus_date'];	
		 $dd_common_attach = $_FILES["dd_filex"]["name"];
			
		 $today = date("Y-m-d H:i:s");
		 
		if ($_FILES["dd_filex"]["error"] <= 0){
			
			$dd_filex =  fileUpload22('dd_filex','ddrequest','files/banks_dd/');
			 
		}
		else
		{
			$dd_filex = '';
			}
		 
		foreach($_POST['select'] as $recx)
		{
			 
			 //$db->update("dd_status = 2,dd_pdate = '".$today."'","dd_data","dd_id=$recx");
			$db->update("dd_status = 2,dd_pdate = '".$today."',dd_common_att = '".$dd_filex."',dd_custom_date = '".$dd_cus_date."',dd_number = '".$dd_num."'","dd_data","dd_id=$recx");
		}
			msg("sec","Records updated successfully...");
			
	
	
		}
		else
		{
			msg("err","Please Check At Least 1 Record.");
		}

	}
	else if($_POST['updateselected'] == 'Rejected')
	{
		if(count($_POST['select']) > 0)
		{
		foreach($_POST['select'] as $recx)
		{
			$db->update("dd_status = 3","dd_data","dd_id=$recx");
		}
			msg("sec","Records updated successfully...");
		}
		else
		{
			msg("err","Please Check At Least 1 Record.");
		}
	}
 
  	else
	{
 	}

}

 
?>













                <div class="manager-report-sec">

				 <div class="page-section-title">
                    	<h2 class="box-head"><?=$IPAGE['m_actitle']?></h2>
                    </div>
                    
<div class="col-md-6">
                 <?php
if($LEVEL == 6)
{
?> 

         <form method="post" action="export_sndtofinc.php">         
  <input type="hidden" name="bbcode" value="<?=$_REQUEST['bbcode']?>" />
 <input type="hidden" name="dd_bene" value="<?=$_REQUEST['dd_bene']?>" />
 <input type="hidden" name="from_date" value="<?=$_REQUEST['from_date']?>" />
 <input type="hidden" name="to_date" value="<?=$_REQUEST['to_date']?>" />
 <input type="hidden" name="m_where" value="<?=$IPAGE['m_where']?>" />
 

<input type="submit" class="btn btn-lg filebtn btn-success" style="float: right;margin-top: 6px;" name="exportfile" value="Export CSV">
</form><?php
}
?> 
                 </div>                    
                    
<div class="list-group">





			<form method="post" enctype="multipart/form-data">
                          <!-- Modal -->
<div class="modal fade" id="version" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Fill Data</h4>
      </div>
      <div class="modal-body">
      <div class="form-group ">
      <label>DD Number *</label>
 		<input type="text" name="dd_num" class="form-control" required />
      </div>  
      <div class="form-group ">
      <label>File *</label>
        <input type="file" name="dd_filex" id="dd_file"  />
      </div>
      
        <div class="form-group ">
             <label>Add Date *</label>
   			<input  id="txtFromDatenew" type="text" name="dd_cus_date"  class="datetimepicker-month12 form-control" required>            
            </div>
      </div>
      <div class="modal-footer">
               <input type="submit" onclick="merge_checks()" class="btn btn-success " name="updateselected" value="Paid">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         
         
         
        
         
         
         
      </div>
    </div>
  </div>
</div>

        
<?php
if($LEVEL == 6)
{
?>            
            
            <?php /*?><div>
<input type="submit" class="btn filebtn btn-success float-left" style="float:left;" name="updateselected" value="Paid">

&nbsp;&nbsp;&nbsp;

<input type="submit" class="btn filebtn btn-success float-left" style="float:left;" name="updateselected" value="Rejected">
<!--&nbsp;&nbsp;&nbsp;
<input type="submit" class="btn filebtn btn-success float-left" style="float:left;" name="updateselected" value="Export CSV">
-->
			</div><?php */?>
<div>
<!--<input type="submit" onclick="merge_checks()" class="btn btn-lg filebtn btn-success float-left" style="float:left; margin-right:20px;" name="updateselected" value="Paid">
-->
<a href="javascript:void(0)" onclick="merge_checks2()" class="btn btn-lg filebtn btn-success float-left" style="float:left; margin-right:10px;" >Paid</a>


<a href="javascript:void(0)" data-toggle="modal" data-target="#version" class="versionize" id="version"> </a>

&nbsp;&nbsp;&nbsp;
 <input type="submit" onclick="merge_checks()"  class="btn btn-lg filebtn btn-success float-left" style="float:left;" name="updateselected" value="Rejected">


 
<!--<input type="submit" onclick="merge_checks()"  class="btn btn-lg filebtn btn-success float-left" style="float:left;" name="updateselected" value="Rejected">
--> 
			</div>            
            
<?php
}
?>            
           <div class="clear"></div> 
            <div class="list-group-item">
            <div id="dt2" class="section">
		
          <table class="table table-bordered table-striped" id="tableSortable">
            <thead>
                <tr>
                    <th><?php
if($LEVEL == 6)
{
?> <input type="checkbox" id="select_all"/><?php
}
?></th>
					<th>Sr.#</th>
					<th>Barcode</th>
                    <th>Submitted by</th>
                    <th>Request Date</th>
                    <th>Beneficiary / Name of Verifying Authority</th>
                    <th>Unit(s)</th>
                    <th>Fee</th>
                    <th>Total Amount</th>
					<th>Status</th>
                    <th>Type</th>
                    <?php if($LEVEL!=3){ ?><th>Actions</th><?php } ?>
                </tr>
            </thead>
            <tbody>
            <?php 
                $tbls = "dd_data";
				//echo "select * from $tbls $where ORDER BY dd_id DESC";
               

			$db_count = $db->select($tbls,"COUNT(dd_id) as cnt","($where)");
			$db_count =  mysql_fetch_array($db_count);
			$db_count = $db_count['cnt'];
			
			if($db_count>0){
				include("include_pages/pagination_inc.php");
				$data = $db->select($tbls,"*","$where ORDER BY dd_id DESC $pages->limit");
                while($re = mysql_fetch_array($data)) {
					$uni = $db->select("uni_info","*","uni_id=$re[dd_uni]");
					$uni = mysql_fetch_assoc($uni);?>
                <tr >
                	<td>
                     
                    <?php
if($LEVEL == 6)
{
?><input type="checkbox" name="select[]" id="checkid[]" class="cheks" value="<?=$re['dd_id']?>"/><?php
}
?>
                    </td>
					
                    <td><a href="?action=demanddraft&atype=details&ddid=<?=$re['dd_id']?>">
                    <?php
                    
						if($re['dd_id']<100){
							if($re['dd_id']<10) echo (string)"00$re[dd_id]"; else echo (string)"0$re[dd_id]";
						}else{
							echo $re['dd_id'];
						}
						
					?>
					</a></td>
					<td><?=($re['dd_bcode']!="")?$re['dd_bcode']:"--"?></td>
                    <td><?php
                    		$userInfo = getUserInfo($re['dd_user']);
							echo "$userInfo[first_name] $userInfo[last_name]";
                    ?></td>
                    <td><?=date("j-M-Y",strtotime($re['dd_cdate']))?></td>
                    <td><?="$uni[uni_Name] / $re[dd_bene]"?></td>
                    <td><?=$re['dd_units']?></td>
                    <td><?=$re['dd_fee']?></td>
					<td><?=($re['dd_units']*$re['dd_fee'])?></td>
                    <td><?=getDDStatus($re['dd_status'])?></td>
                      <td><?=($re['dd_dataflow']==1?'Dataflow':'Local')?></td>
                     <?php if($LEVEL!=3){ ?>
                    <td>
                    	<?php if($re['dd_status']!=2 || $LEVEL==6){?>
                        <a href="javascript:void(0)"  onclick="submitLink('ddid=<?=$re['dd_id']?>&delete')"><i class="icon-cross"></i>Delete</a>
                        <a href="?action=demanddraft&atype=add&edit=<?=$re['dd_id']?>"><i class="icon-pencil"></i>Edit</a>
                        <?php }else{?>
                        	<img class="imFr" src="images/icons/chk_bx.png" style="width:22px; height:22px;">
                        <?php }?>
                    </td><?php } ?>
                </tr>        
            <?php }
				}?>
            </tbody>
			
			<tfoot>
                                 <th>&nbsp;</th>
					<th>Sr.#</th>
					<th>Barcode</th>
                    <th>Submitted by</th>
                    <th>Request Date</th>
                    <th>Beneficiary / Name of Verifying Authority</th>
                    <th>Unit(s)</th>
                    <th>Fee</th>
                    <th>Total Amount</th>
					<th>Status</th>
                    <th>Actions</th>
                            </tfoot>
        </table>

<?php include("include_pages/pager_inc.php"); ?>
            </div>
		</div>
 </form>
	</div>
 	
</div>
</div>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
											  
	  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<script>
$(document).ready(function () {
            $('#tableSortable').dataTable({
                 "bPaginate": false,
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


function merge_checks(){
	var selchbox = [];
	$('.cheks').each(function() {
        if(this.checked == true){
			selchbox.push($(this).val());
		};                        
     });
	 if(selchbox==''){
		 alert("Please select atleast 1 check");
		 return false;
	 }else{
		   document.getElementById('merge_checkids').value=selchbox;
		 }
	
}


function merge_checks2(){
	var selchbox = [];
	$('.cheks').each(function() {
        if(this.checked == true){
			selchbox.push($(this).val());
		};                        
     });
	 if(selchbox==''){
		 alert("Please select atleast 1 check");
		 return false;
	 }else{
		 
		 $(document).ready(function(){
$(".versionize").trigger("click");

});

		 
		 	//document.getElementById('merge_checkids').value=selchbox;
		 }
	
}

 
/*$(function () {
		$( ".datetimepicker-month1, .datetimepicker-month2, .datetimepicker-month3").datepicker({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange: "1990:2016"
		});
		});		
*/
		
		
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


    $("#txtFromDatenew").datepicker({ 
       // numberOfMonths: 2,
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange: "1990:2016" 
        
    });  


});

		
		
		
				
</script>
