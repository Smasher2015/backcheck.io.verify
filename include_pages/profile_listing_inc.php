 <div class="page-header">
    <div class="page-header-content">
        <div class="page-title2">
        <h1>Profile Lists</h1>
        </div>
        
    </div>
</div>

	<div class="content">
    
      <div class="panel panel-flat">               
        
       
<div class="table-responsive">
 
  <div id="opntkt_sub_response2"></div>
   
   		<table class="table text-nowrap table-striped" id="myTable" cellpadding="0" cellspacing="0">							<thead>
								<tr>
									<th style="width:10%;">Latest update</th>
					                <th>Full Name</th>
                                    <th>Candidate ID</th>
                                    <th class="text-center text-muted" style="width: 30px;"><i class="icon-checkmark3"></i></th>
					            </tr>
							</thead>
							<tbody id="loadmoreresponse">

		<!--<tr class="active border-double"><td colspan="8" class="text-semibold">Yesterday</td></tr>-->
   <?php
 
 
 if($LEVEL == 4 && isset($_SESSION['user_id']) && $_SESSION['user_id'] == 446)
 {
	 		 $search_history_instant = $db->select("parsing_data_record","*","userID = '".$_SESSION['user_id']."' ORDER BY parID DESC"); 
 	 
  if(mysql_num_rows($search_history_instant) > 0){
//$pars_data = mysql_fetch_array($search_history_instant);
 
while($val=mysql_fetch_array($search_history_instant)){
  $time_diff = dateTimeExe($val['search_date']);
 	 $parID = $val['parID'];
 ?>  
                             
								<tr>
									<td class="text-center"><h6 class="no-margin"><?=date("d",strtotime($time_diff)).'<small class="display-block text-size-small no-margin">'.date("F Y",strtotime($time_diff)).'</small>'?></h6></td>
					                 
                                    <td>
					                	<div class="text-muted"><?=$val['firstname']." ".$val['lastname']?></div>
				                	</td>
					                <td>
					                	 
					                	<div class="btn-group">
                                         <?=$val['candidateID']?>                                                
                                         </div>
					                </td>
					                
					                 
					                
					               
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="<?=SURL?>/?action=singlereport&atype=view&cid=<?=$parID?>" target="_blank" >View Detail</a><?php /*?>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"  data-toggle="modal" data-target="#exampleModal<?=$parID?>" ><i class="icon-undo"></i> Quick reply</a></li>
												</ul><?php */?>
											</li>
										</ul>
                                        
                                        
                                        
 <div class="modal fade" id="exampleModal<?=$parID?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Reply To <?=$val['firstname']." ".$val['lastname']?></h4>
      </div>
      <div class="modal-body">
        <form method="post">
           <input type="hidden" class="form-control" name="parID" value="<?=$parID?>" >
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" name="replymessage" required id="message-text"></textarea>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="submitreply" class="btn bg-info-400" value="Send message"> 
      </div>
        </form>
         
      </div>
     
    </div>
  </div>
</div>
                                        
									</td>
					            </tr>

 <?php
}


}
else
{echo "<tr><td align='center' colspan='4'>No Record Found</td></tr>";}


}
else
{echo "<tr><td align='center' colspan='4'>No Record Found</td></tr>";}





//}
?>

							</tbody><div class="items"></div>
						</table>
					
					<!-- /task manager table -->
                    
                    <div class="form-group mt-20 p-20">
<?php  if($arr3['WHMCSAPI']['TOTALRESULTS']>10){ ?>
<button type="button" class="btn btn-success btn-lg" id="load_more"><i class="icon-rotate-cw3 position-left"></i> Load More</button><?php } ?>
<div id="nomoreres" style="display:none">No More Result</div>
<?php
 if($LEVEL == 4){
	 ?>
<!--<a href="javascript:;" class="btn bg-danger-600 heading-btn" id="open_ticket"><i class="icon-ticket position-left"></i> New Ticket</a>
-->
<?php
 }
 ?>

</div>
 <!--<div id="open_ticket_response" class="modal fade" tabindex="-1"></div>-->
                    


</div> 

 </div>
	
	</div>    
    <!-- /page container -->  
    <script type="text/javascript">
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
            data: 'ePage=add_rating&ticket_list=yes&limit='+cur_index+'&userid='+<?=$user_id?>,
            success: function(result){
				console.log(result);
				
                cur_index +=10;
                screen_height = $('body').height();
				
                $( "#loadmoreresponse" ).fadeIn( 400 ).append(result);
				if(result == '')
				{
					$('#nomoreres').show();$('#load_more').hide(); 
				}
            }
        });
});












/*$(document).ready(function(){ var $modal = $('#open_ticket_response'); $('#open_ticket').on('click', function(){ $modal.load('load.php',{'id1': '1', 'id2': '2'}, function(){ $modal.modal('show'); }); }); });  
*/




	</script>
