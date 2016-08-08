		<!-- Page content -->
<div class="content">


<div class="panel panel-flat">

<?php

  $getUserInfo = getUserInfo($_SESSION['user_id']); 

  // 
  $ticket_id = $_REQUEST['ticketID'];
 	  
if(isset($_POST['submitreply']))
{
	$tid = $_POST['ticketid'];
	$replymessage = $_POST['replymessage'];
 	
 $postfields["action"] = "addticketreply"; 
 $postfields["ticketid"] = $tid;
 if($LEVEL != 4)
 {
 $postfields["adminusername"] = "Staff";
 }
 else
 {
 $postfields["clientid"] = $getUserInfo['whmcs_clid'];;
 }
 $postfields["message"] = $replymessage;
  
// print_r($postfields);die;
$xml= whmcs_api(WHMCS_APIURL,$postfields);
 // $xml=validatelogin($email,$pass,$url);
 $arrx = whmcsapi_xml_parser($xml); 
  //print_r($arrx);
	if($arrx['WHMCSAPI']['RESULT'] == "success")
	{
		echo '<div class="alert alert-success"><strong>Success!</strong> Reply Send Successfully.</div>';
	}	
	else
	{
		echo '<div class="alert alert-danger"><strong>Error!</strong> Reply Send Failed.</div>';
	}
 }

 	  
if(isset($_POST['closeticket']))
{
	$tid = $_POST['ticketid'];
  	
 $postfields["action"] = "updateticket"; 
 $postfields["ticketid"] = $tid;
 if($LEVEL != 4)
 {
 $postfields["adminusername"] = "Staff";
 }
 else
 {
 $postfields["clientid"] = $getUserInfo['whmcs_clid'];;
 }
 $postfields["status"] = "Closed";
  
// print_r($postfields);die;
$xml= whmcs_api(WHMCS_APIURL,$postfields);
 // $xml=validatelogin($email,$pass,$url);
 $arrx = whmcsapi_xml_parser($xml); 
  //print_r($arrx);
	if($arrx['WHMCSAPI']['RESULT'] == "success")
	{
		echo '<div class="alert alert-success"><strong>Success!</strong>Ticket Close Successfully.</div>';
	}	
	else
	{
		echo '<div class="alert alert-danger"><strong>Error!</strong>Ticket Close Failed.</div>';
	}
 }
	  
	  
	  
	  
	  
	  
	  
	  
	  
 	$postfields2["action"] = "getticket";
	$postfields2["ticketid"] = $ticket_id;
  	$postfields2["deptid"] = "1";

$xml2= whmcs_api(WHMCS_APIURL,$postfields2);
  $arr2 = whmcsapi_xml_parser($xml2); 
$ticketslink=$arr2['WHMCSAPI']; /*print_r($ticketslink['REPLIES']); echo count($ticketslink['REPLIES']).' total';*/
//print_r($arr2);


?>

<div class="panel-heading">
<h3 class="panel-title">Tickets <?=$ticketslink['SUBJECT']?></h3>
<div class="heading-elements">
	
    <div class="heading-text">Ticket Status : <span class="label bg-info"><?=$ticketslink['STATUS']?></span></div>
	

</div>
</div>

 <?php
 

  ?>
  
 
  <?php

if(($ticketslink['USERID'] == $getUserInfo['whmcs_clid']) || $LEVEL == 2)
{ 
	 
 

$time_diff = time_ago(strtotime($ticketslink['DATE']));
 ?>                                        
      
  
  
  
  
  <div class="panel-body">  
  
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Reply To <?=$ticketslink['NAME']?></h4>
      </div>
      <div class="modal-body">
        <form method="post">
           <input type="hidden" class="form-control" name="ticketid" value="<?=$ticket_id?>" >
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" name="replymessage" required id="message-text"></textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="submitreply" class="btn btn-primary" value="Send message"> 
      </div>
        </form>
         
      </div>
     
    </div>
  </div>
</div>  
  
  
  
  
<div class="ticket-comment-section">
									<ul>
   
                                  
                                        
										<tbody id="loadmoreresponse">



<?php //print_r($ticketslink['REPLIES']);
$count = 0;
foreach($ticketslink['REPLIES'] as $key=>$replies)
{ 
	
	$time_diff = time_ago(strtotime($replies['DATE']));



	if ($count % 2 == 0)
	{
		$color_class = "info";
	}
	else
	{
		$color_class = "success";
	}	
	?>
    
    	<li>
													<div class="ticket-comment-data-sec left_side_c">
														<div class="ticket-comment-left-data-sec">
															<img src="images/default.png" title="John Smith">
															
														</div>
														<div class="ticket-comment-right-data-sec" style="text-align:justify;">														<div class="alert alert-<?=$color_class?>  alert-styled-left alert-arrow-left alert-component">
                                                        <h6 class="alert-heading text-bold">
                                                       <?php if($replies['USERID'] == 0){echo $replies['ADMIN'];}else{echo $replies['NAME'];}?>		 				<div style="width:auto; height:auto; float:right;">
																																<span style="font-size:12px;">Posted by <?php if($replies['USERID'] == 0){echo $replies['ADMIN'];}else{echo $replies['NAME'];}?> |   <?=$time_diff?></span>
															</div>
                                                            </h6>
															 <?=$replies['MESSAGE']?>															
															
															
																													</div>
                                                        </div>
														<div class="clearFix"></div>
													</div>
												<div class="clearFix"></div>
												</li>								 
 
<?php
$count++;
}?>

<!--<a href="#" id="open_ticket" >Open Ticket</a>

 <div id="open_ticket_response" class="modal fade" tabindex="-1"></div>

<div id="opntkt_sub_response"></div>
-->

<?php /*?><?php  if($arr['WHMCSAPI']['TOTALRESULTS']>3){ ?>
<button type="button" class="btn filebtn btn-success float-left check_cnic" id="load_more">Load More...</button><?php } ?>
<?php */?>

<div class="items"></div>
									</ul>
								</div>
     <div class="form-group mt-20 col-md-1"><a href="#"  data-toggle="modal" data-target="#exampleModal" class="btn btn-lg bg-warning-400"><i class="icon-reply position-left"></i> Reply</a></div>
     <?php if($ticketslink['STATUS']!='Closed'){?>
     <div class="form-group mt-20 col-md-2"><form method="post">
           <input type="hidden" class="form-control" name="ticketid" value="<?=$ticket_id?>" >
        <input type="submit" name="closeticket" class="btn btn-lg btn-danger" value="Close Ticket" onclick="return doclose()"> 
        </form></div>
        <?php } ?>
     
     
    <!-- FOR REPLY :-->
     
     
      
<?php
}else{
?>    
      <div >No Record Available</div>                   
<?php } ?>

</div> 

</div>

</div> 
	<!-- /page container -->  
    <script type="text/javascript">
	function doclose(){
		var txt;
		var r = confirm("Are you sure you want to close the ticket?");
		if (r == true) {
    txt = "You pressed OK!";
} else {
    txt = "You pressed Cancel!";
}return false;
	}
/*	var cur_index=4;
	cur_index=parseInt(cur_index)+3;
	var screen_height = $('body').height();
	var cury = $(window).scrollTop();
	var screen = $(window).height();
	$('#load_more').click(function(){
      // make an ajax call to your server and fetch the next 100, then update
      //some vars
        $.ajax({
			type: 'POST',
            url: "actions.php",
            data: 'ePage=add_rating&ticket_list=yes&limit='+cur_index,
            success: function(result){
                cur_index +=3;
                screen_height = $('body').height();
				
                $( "#loadmoreresponse" ).fadeIn( 400 ).append(result);
            }
        });
});
*/
 
	</script>
