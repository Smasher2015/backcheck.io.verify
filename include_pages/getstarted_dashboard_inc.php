<?php
function get_countries(){

	 $maxposts = 1;
 	 $url = 'http://compliant.one/dashboard/api.php?token=sdsvdsvb]3.bg%3E8%3E&method=getcountries';
 
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_URL,$url);
 $result=curl_exec($ch);
 curl_close($ch);
  $asd =  json_decode($result);
	return $asd;
 }
 
  $get_countries = get_countries();
  
  
  

/* function get_countries(){

	 $maxposts = 1;
 	 $url = 'http://compliant.one/dashboard/api.php?token=sdsvdsvb]3.bg%3E8%3E&method=getcountries';
 
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_URL,$url);
 $result=curl_exec($ch);
 curl_close($ch);
  $asd =  json_decode($result);
	return $asd;
 }
 
  $get_countries = get_countries();
 
 
 	 function forgetcompletedata($keyword,$country='',$conditions='',$pagination_start=1){
if($country != "")
{$getcountry = '&country='.$country;}
else{$getcountry ="";}

	 $maxposts = 1;
 	echo $url = 'http://compliant.one/dashboard/api.php?keyword='.$keyword.'&limit=100'.$getcountry.'&token=sdsvdsvb]3.bg%3E8%3E&method=getrecords';
 
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_URL,$url);
 $result=curl_exec($ch);
 curl_close($ch);
  $asd =  json_decode($result);
	return $asd;
 }

 	 function getrecord_single($keyword,$country='',$conditions='',$pagination_start=1){
if($country != "")
{$getcountry = '&country='.$country;}
else{$getcountry ="";}

	 $maxposts = 1;
 	 $url = 'http://compliant.one/dashboard/api.php?keyword='.$keyword.'&limit=100'.$getcountry.'&token=sdsvdsvb]3.bg%3E8%3E&method=getrecord&alloweddatasets=1,2,3,4,5,6,7,8,9';
 
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_URL,$url);
 $result=curl_exec($ch);
 curl_close($ch);
  $asd =  json_decode($result);
	return $asd;
 }
*/
 
 
 
/*if(isset($_POST['submit_ssn']))
{//print_r($_POST);
 $forgetcompletedata =forgetcompletedata($_POST['FirstName']."%20".$_POST['LastName'],$_POST['country']);


 $getrecord_single =getrecord_single($_POST['FirstName']."%20".$_POST['LastName'],$_POST['country']);
 // print_r($getrecord_single);
?>

<table>
	<tr>
    	<th>Offence Description</th><th>FullName</th><th>id</th> 
    </tr>
    <?php
    foreach($forgetcompletedata->records as $data) 
	{ 
			?>
	<tr>
    	<th><?php echo $data->FullName; ?></th><th><?php echo $data->FullName; ?></th><th><?php echo $data->id; ?></th> 
    	
    </tr>
<?php
	}
	?>
</table>
<?php


	// FirstName
}*/
?>
<?php /*?>if(isset($_POST['submit_ssn']))
{
	//print_r($_POST);
	$array = array(
	"cv" => $_POST['cv'],
	"candidateid" => $_POST['candidateid'],
	//"cvcontent" => $_POST['cvcontent'],
	"FirstName" => $_POST['FirstName'],
	"LastName" => $_POST['LastName'],
	"emailadd" => $_POST['emailadd'],
	"phone" => $_POST['phone'],
	"Current_Employer" => $_POST['Current_Employer']
);
	$json_encode = json_encode($array);
	 print_r($json_encode);
	 
	 
 			$cols="userID,candidateID,cand_email,cv_content,allrecord";
		
		$values="'".$_SESSION['user_id']."','".$_POST['candidateid']."','".$_POST['emailadd']."','".$_POST['cvcontent']."','".$json_encode."' ";
					//echo "cols: ".$cols." values: ".$values; exit; caddress
 
					$isInserted=$db->insert($cols,$values,"parsing_data_record");
					$insertedID=$db->insertedID;
	 //header("Location:http://backcheck.io");
	 
	 ?>
     <script type="text/javascript">
         <!--
$(document).ready(function() {
               window.location="<?=SURL?>?action=singlereport&atype=view&cid=<?=$_POST['candidateid']?>";
            });
         //-->
      </script>
     <?php
	// exit;
	 
	 
	 
	 
	 
	 
	 

}  
<?php */?>  
<script  type="text/javascript">
$(document).ready(function() {
	
	
	
$('#cv').on('change', function() {
	
		 $('#loader_occrp').show();

	
    var file_data = $('#cv').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    console.log(form_data);                             
    $.ajax({
                url: 'upload_for_old.php', // point to server-side PHP script 
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                //data: 'ePage=add_rating&cvuploader=yes&form_data='+form_data,                         
                data: form_data,       
				type: 'POST',
                success: function(php_script_response){
					 $('#loader_occrp').hide(); 
					// console.log(php_script_response);
                    //alert(php_script_response); // display response from the PHP script, if any
					//if(php_script_response != 0)
					//{
						  //$("#box"+ids).trigger('click');
						  $("#loader_occrp").hide();
 						// window.location="<?php //echo SURL;?>?action=singlereport&atype=view&cid="+php_script_response;
					$("#existingdatas").html(php_script_response);
					$("#submit_data").trigger( "click" );
					//}
					//else
					//{
					//	alert("Failed to insert data.");
					//}
					//window.location="<?php //echo SURL;?>?action=singlereport&atype=view&cid="+response;
					//$("#existingdatas").html(php_script_response);
                }
     });
});




 });





 function submitdata() {
	 
		 $('#loader_occrp').show();
     //e.preventDefault();
	 var formdatas = $('form').serialize();
	 //console.log(xsadata);
	//var formData = new FormData();
/*		var form = $("#parsingdata").serialize(); // You need to use standart javascript object here
		var formData = new FormData(form);	

var candidateid = $("#candidateid").val();
var cvcontent = $("#cvcontent").val();
var FirstName = $("#FirstName").val();
var LastName = $("#LastName").val();
var emailadd = $("#emailadd").val();
var phone = $("#phone").val();
var current_emp = $("#current_emp").val();*/
 //alert(candidateid+" candidateid "+FirstName+" FirstName "+LastName+" LastName "+emailadd);

$.ajax({
				type: 'POST',
				url: "upload_for_old.php",
<!--				data: "dataparsinginsert=yes&candidateid="+candidateid+"&cvcontent="+cvcontent+"&FirstName="+FirstName+"&LastName="+LastName+"&emailadd="+emailadd+"&phone="+phone+"&current_emp="+current_emp,
-->		
		data: "dataparsinginsert=yes&candidateid="+formdatas,
				success: function(response){ //alert("ressss. "+response);
					if(response != 0)
					{
						  //$("#box"+ids).trigger('click');
						  $("#loader_occrp").hide();
 						  window.location="<?php echo SURL;?>?action=singlereport&atype=view&cid="+response;
					}
					else
					{
						alert("Failed to insert data.");
					}
			 
				 
					}

		});   
   
   
   
   
} 


 </script>






<div id="modal_form_vertical" class="modal fade in">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">×</button>
									<h5 class="modal-title">Verification form</h5>
								</div>

								<?php /*?><form action="<?=SURL?>?action=singlereport&atype=view"  method="post"><?php */?>
								
                                <form method="post" id="parsingdata">
									<div class="modal-body">
										<div class="form-group">
											<!--<h5><label><input type="radio" name="strt_check" class="styled" checked="checked" value="0"> Upload Cv </label></h5>-->
                                            <div class="form-group">
                                    <div class="row">	
									<label class="col-lg-3 control-label">Choose File:</label>
									<div class="col-lg-9">	
					<div class="fileinput fileinput-new" data-provides="fileinput">
                      <div class="input-group">
                        <div class="form-control uneditable-input span3" data-trigger="fileinput"><i class="icon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                        <span class="input-group-addon btn bg-info-400 btn-file">
                        <span class="fileinput-new"><i class="icon-plus2  icon-rotate-cw3"></i></span>
                        <span class="fileinput-exists"><i class="icon-rotate-cw3"></i></span>
                        <!--<input type="file" class="files" name="bulk_file">-->
                        <input type="file" name="cv" value="" id="cv" class="multipleImageFileInput" style="width:50%"  >
                        </span> <a href="#" class="input-group-addon btn bg-info-400 fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                    </div><!--<span class="help-block pull-right">Choose File (Format)</span>-->
									</div>
                                    </div>
                                    </div>
										
                                        </div>
										
                        
										<div class="form-group">
											<!--<h5><label><input type="radio" name="strt_check" class="styled" value="1"> Wizard </label></h5>-->
                                            <div class="blockui-animation-container" id="loader_occrp" style="width: 100%;margin: 0 auto;display: none;color: #555;background: transparent;text-align: center;font-size: 16px;">
         <span class="text-semibold"><i class="icon-spinner4 spinner position-left" style="font-size: 18px;"></i>&nbsp; Loading...</span>
        </div>
                                            <div id="existingdatas"> 
                                            
                                            
                                            
                                            
                                             
                                   <div id="xxxxxxxs"><h1></h1></div>         
                                          
                                           <!-- <div class="form-group">
                                            <div class="row">
												<div class="col-sm-6">
													<label>First name</label>
        <input id="name" type="text" name="FirstName" placeholder="First Name" class="form-control"/>
												</div>
                                                
                                                
                                                <div class="col-sm-6">
													<label>Last name</label>
        <input id="lname" type="text" name="LastName" class="form-control" placeholder="Your Last Name"  />
												</div>
                                                
                                                </div></div>
                                                
                                            <div class="form-group">
                                                <div class="row">
                                                <div class="col-sm-6">
													<label>Email Address</label>
        <input id="emailadd" type="email" name="emailadd" class="form-control"   />
												</div>
                                                <div class="col-sm-6">
													<label>Country</label>
        
        <select name="country" class="select">
        	<option value="">- Select Country -</option>
        	<?php
            foreach($get_countries->countries as $country)
			{
			?>
            <option value="<?=$country->name?>"><?=$country->name?></option>
        	<?php
			}
			?>
        </select>
												</div>
                                                </div>
                                              
											  
											     <div class="row">
												<div class="col-sm-6">
													<label>Phone No.</label>
        <input id="name" type="text" name="phone" placeholder="Phone Number" class="form-control"/>
												</div>
                                                
                                                </div>
											  
											  
											  
											  
												 
											</div>-->
										</div>
                                        </div>

										 

										 

										 
									</div>

									 <div class="modal-footer">
										<!--<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>-->
										 
         <input type="button" class="button btn btn-primary" value="Submit" onclick="submitdata();" name="submit_data" id="submit_data" /> 
									</div> 
								</form>
							</div>
						</div>
					</div>



<div class="content-wrapper">
  
  
  <section class="instanat">
  
  	 <div class="page-header">
        <div class="page-header-content">
            <div class="page-title2">
                <h1>Get Started</h1>
            </div>
        </div>             
     </div>	
 
  <div class="profile-cover">
					<div class="profile-cover-img" style="background-image: url(<?=SURL?>img/dashbord_blur.jpg)"></div>
					<div class="media">
						<ul class="list-inline list-inline-condensed no-margin-bottom text-nowrap">
								<li><a href="#" class="btn btn-lg bg-red" data-toggle="modal" data-target="#modal_form_vertical"><i class="icon-checkmark position-left"></i> Start a new Check</a></li>
						</ul>					

					</div>
				</div>
  
  
  </section>
            
 </div>