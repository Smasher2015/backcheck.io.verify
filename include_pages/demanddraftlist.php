<?php
$uID = $_SESSION['user_id'];
$where = "dd_active=1 $IPAGE[m_where]";

switch($LEVEL){
	case 3:
	case 9:
		$where = "$where AND dd_user=$uID";
	break;	
}


if(isset($_REQUEST['dd_number']) && $_REQUEST['dd_number']!=""){
$dd_number  = urldecode($_REQUEST['dd_number']);
$where = ($where!="")?" $where AND dd_number='$dd_number'":" dd_number='$dd_number' ";
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

  
 $where = ($where!="")?" $where AND  DATE(dd_cdate) BETWEEN DATE('".$from_date."') AND DATE('".$to_date."')":"   DATE(dd_cdate) BETWEEN DATE('".$from_date."') AND DATE('".$to_date."')";

}



if(isset($_REQUEST['paid_from_date']) && ($_REQUEST['paid_from_date']!="") && isset($_REQUEST['paid_to_date']) && ($_REQUEST['paid_to_date']!="") ){
 

$paid_from_date = date('Y-m-d H:i:s' ,strtotime($_REQUEST['paid_from_date']));
$paid_to_date =  date('Y-m-d H:i:s' ,strtotime($_REQUEST['paid_to_date']));

  
 $where = ($where!="")?" $where AND  DATE(dd_pdate) BETWEEN DATE('".$paid_from_date."') AND DATE('".$paid_to_date."')":"   DATE(dd_pdate) BETWEEN DATE('".$paid_from_date."') AND DATE('".$paid_to_date."')";

}

?>
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
            <?php $dd_number=(isset($_REQUEST['dd_number']))?$_REQUEST['dd_number']:''?>
            <input type="text" class="form-control" name="dd_number" value="<?=$dd_number?>" placeholder="Search by DD Number" >
            </div>
            </fieldset>
            
			
			
			<fieldset class="mrg-bottom custom-input float-left search-width">
            <div class="form-group ">
            <?php $from_date=(isset($_REQUEST['from_date']))?$_REQUEST['from_date']:''?>
   			<input id="txtFromDate" type="text" name="from_date" value="<?=$from_date?>" class="datetimepicker-month1 form-control" placeholder="Search by (Add Date) Start Date" >            
            </div>
            </fieldset>

 			<fieldset class="mrg-bottom custom-input float-left search-width">
            <div class="form-group ">
            <?php $to_date=(isset($_REQUEST['to_date']))?$_REQUEST['to_date']:''?>
           
 <input id="txtToDate" type="text" name="to_date" value="<?php echo $to_date;?>" class="datetimepicker-month2 form-control" placeholder="Search by (Add Date) End Date">           
            </div>
            </fieldset>

<?php //print_r($IPAGE);
if($IPAGE['m_atype'] == "paid")
{
?>            
            <!--For Paid Search Only-->
  			
			
			<fieldset class="mrg-bottom custom-input float-left search-width">
            <div class="form-group ">
            <?php $paid_from_date=(isset($_REQUEST['paid_from_date']))?$_REQUEST['paid_from_date']:''?>
   			<input id="txtFromDate_paid" type="text" name="paid_from_date" value="<?=$paid_from_date?>" class="datetimepicker-month1 form-control" placeholder="Search by (Paid) Start Date" >            
            </div>
            </fieldset>

 			<fieldset class="mrg-bottom custom-input float-left search-width">
            <div class="form-group ">
            <?php $paid_to_date=(isset($_REQUEST['paid_to_date']))?$_REQUEST['paid_to_date']:''?>
           
 <input id="txtToDate_paid" type="text" name="paid_to_date" value="<?php echo $paid_to_date;?>" class="datetimepicker-month2 form-control" placeholder="Search by (Paid) End Date">           
            </div>
            </fieldset>
            
            <!--For Paid Search Only-->
          
<?php
}
?>          
            
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





<!--For PDF GENERATOR START--> 
<?php //print_r($IPAGE);
if($IPAGE['m_atype'] == "paid")
{
?>

<section class="retracted scrollable">
            <div class="report-sec">
            <div class="page-section-title">
            <h2 class="box_head">Report Filters</h2>
            </div>
            <div class="panel panel-default panel-block">	
            <div id="filters" class="section" >
            
            <div class="panel panel-default panel-block">
            	<div class="list-group">
                <div class="list-group-item">
            <form action="export_paid_groupby.php" class="table-form" method="post">
            <div style="float:left; margin-top:20px; " class="col-md-12">
            
 			<fieldset class="mrg-bottom custom-input float-left search-width">
            <div class="form-group ">
            <?php $r_from_date=(isset($_REQUEST['r_from_date']))?$_REQUEST['r_from_date']:''?>
   			<input id="txtFromDate2" type="text" name="r_from_date" value="<?=$r_from_date?>" class="datetimepicker-month1 form-control" placeholder="Search by Start Date" > 
            
            <input  type="hidden" name="m_where" value="<?=$IPAGE['m_where']?>" / >            
            </div>
            </fieldset>


			<fieldset class="mrg-bottom custom-input float-left search-width">
            <div class="form-group ">
            <?php $r_to_date=(isset($_REQUEST['r_to_date']))?$_REQUEST['r_to_date']:''?>
           
 <input id="txtToDate2" type="text" name="r_to_date" value="<?php echo $r_to_date;?>" class="datetimepicker-month2 form-control" placeholder="Search by End Date">           
            </div>
            </fieldset>
             
<input type="submit" class="btn btn-lg filebtn btn-success" style="float: right;margin-top: 12px;" name="reportgenerate" value="Report Generate">
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
}
?>

<!--For PDF GENERATOR END --> 




 





                <div class="manager-report-sec">

				 <div class="page-section-title">
                    	<h2 class="box-head"><?=$IPAGE['m_actitle']?></h2>
      
  <?php
if($LEVEL == 6)
{
?> 

         <form method="post" action="export_dmnddrft.php">         
  
  <input type="hidden" name="bbcode" value="<?=$_REQUEST['bbcode']?>" />
 <input type="hidden" name="dd_bene" value="<?=$_REQUEST['dd_bene']?>" />
 <input type="hidden" name="dd_number" value="<?=$_REQUEST['dd_number']?>" />
 <input type="hidden" name="from_date" value="<?=$_REQUEST['from_date']?>" />
 <input type="hidden" name="to_date" value="<?=$_REQUEST['to_date']?>" />
 <input type="hidden" name="paid_from_date" value="<?=$_REQUEST['paid_from_date']?>" />
 <input type="hidden" name="paid_to_date" value="<?=$_REQUEST['paid_to_date']?>" />
 <input type="hidden" name="m_where" value="<?=$IPAGE['m_where']?>" />


<input type="submit" class="btn btn-lg filebtn btn-success" style="float: right;margin-top: -44px;" name="exportfile_dd" value="Export CSV">
</form>
<?php
}
?>        
                    </div>
                    
                                      
                    
<div class="list-group">
            <div class="list-group-item">
            <div id="dt2" class="section">
		
          <table class="table table-bordered table-striped" id="tableSortable">
            <thead>
                <tr>
                    <th>&nbsp;</th>
					<th>Sr.#</th>
					<th>Barcode</th>
                    <th>DD #</th>
                    <th>Submitted by</th>
                    <th>Request Date</th>
                    <th>Beneficiary / Name of Verifying Authority</th>
                    <th>Unit(s)</th>
                    <th>Fee</th>
                    <th>Total Amount</th>
					<th>Status</th>
					<!--<th>Attachment</th>-->
                    <th>Actions</th>
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
                	<td></td>
					
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
					<td><?=($re['dd_number']!="")?$re['dd_number']:"--"?></td>
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
                    <?php /*?> <td>
					 <?php
					 if($re['dd_common_att'])
					 {
						 echo 'exists';
					 }
					 else
					 {
						 echo '-';
					 }
					 ?>
                     </td><?php */?>
                    <td>
                    	<?php if($re['dd_status']!=2 || $LEVEL==6){?>
                        <a href="javascript:void(0)"  onclick="submitLink('ddid=<?=$re['dd_id']?>&delete')"><i class="icon-remove-circle"></i>Delete</a>
                        <a href="?action=demanddraft&atype=add&edit=<?=$re['dd_id']?>"><i class="icon-edit"></i>Edit</a>
                        <?php }else{?>
                        	<img class="imFr" src="images/icons/chk_bx.png" style="width:22px; height:22px;">
                        <?php }?>
                        <?php
					 if($re['dd_common_att'])
					 {
						 ?>
                         <a href="javascript:void(0)" data-toggle="modal" data-target="#viewatt"  >View Attachment</a>
<div class="modal fade" id="viewatt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Attachment</h4>
      </div>
      <div class="modal-body">
         
       <img src="<?=SURL.$re['dd_common_att']?>" height="300" width="200" />
      
         
      </div>
      <div class="modal-footer">
              
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         
         
         
        
         
         
         
      </div>
    </div>
  </div>
</div>

                           
                         <?php
					 }
					 else
					 {
						 
					 }
					 ?>
                    </td>
                </tr>        
            <?php }
				}?>
            </tbody>
			
			<tfoot>
                                 <th>&nbsp;</th>
					<th>Sr.#</th>
					<th>Barcode</th>
                     <th>DD #</th>
                    <th>Submitted by</th>
                    <th>Request Date</th>
                    <th>Beneficiary / Name of Verifying Authority</th>
                    <th>Unit(s)</th>
                    <th>Fee</th>
                    <th>Total Amount</th>
					<th>Status</th>
					<!--<th>Attachment</th>-->
                    <th>Actions</th>
                            </tfoot>
        </table>

<?php include("include_pages/pager_inc.php"); ?>
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
                 "bPaginate": false,
				"bLengthChange": false,
				"bFilter": true,
				"bInfo": false,
				"bAutoWidth": false
            });
        });
		
/*$(function () {
		$( ".datetimepicker-month1, .datetimepicker-month2, .datetimepicker-month3").datepicker({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange: "1980:2016"
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
});



	 $(document).ready(function(){
    $("#txtFromDate2").datepicker({
       // numberOfMonths: 2,
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange: "1990:2016",
        onSelect: function(selected) {
          $("#txtToDate2").datepicker("option","minDate", selected)
        }
    });
    $("#txtToDate2").datepicker({ 
       // numberOfMonths: 2,
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange: "1990:2016",
        onSelect: function(selected) {
           $("#txtFromDate2").datepicker("option","maxDate", selected)
        }
    });  
});




	 $(document).ready(function(){
    $("#txtFromDate_paid").datepicker({
       // numberOfMonths: 2,
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange: "1990:2016",
        onSelect: function(selected) {
          $("#txtToDate_paid").datepicker("option","minDate", selected)
        }
    });
    $("#txtToDate_paid").datepicker({ 
       // numberOfMonths: 2,
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange: "1990:2016",
        onSelect: function(selected) {
           $("#txtFromDate_paid").datepicker("option","maxDate", selected)
        }
    });  
});
	
</script>
