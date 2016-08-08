<style>
.card {
    position: relative;
    background-color: #fff;
    transition: box-shadow .25s;
    border-radius: 2px;
    margin: 8px 0;
}

.card {
    position: relative;
    width: 100%;
    height: 350px;
    overflow: hidden;
    z-index: 1;
    background: #06a763;
    margin: -20px 3px 0 0;
}
.profile-img {
    position: absolute;
    right: 0;
    z-index: 1;
}
.profile-img .slant {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    border-style: dashed;
    border-width: 400px 0 0 100px;
    border-color: transparent transparent transparent #06a763;
}
 @media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
          .profile-img .slant {
            /*slant properties for ie*/
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            border-style: solid;
            border-width: 400px 0 0 100px;
            border-color: transparent transparent transparent #06a763; } }

@-moz-document url-prefix() {
 .profile-img .slant {
    /*for firefox*/
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    border-style: solid;
    border-width: 400px 0 0 100px;
    border-color: transparent transparent transparent #06a763; } }

@supports (-ms-accelerator: true) {
          .profile-img .slant {
            /*for edge*/
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            border-style: solid;
            border-width: 400px 0 0 100px;
            border-color: transparent transparent transparent #06a763; } }





.profile-img .img-responsive{height: 350px;}
.card .card-content {
    padding: 40px;
    border-radius: 0 0 2px 2px;
}
.info-headings {
    max-width: 514px;
}
.info-headings h4 {
    display: block;
    width: 100%;
    font-weight: 500;
    color: #fff;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.29);
	font-size: 38px;
}
.info-headings h6 {
    display: block;
    width: 100%;
    font-weight: 300;
    margin-top: -10px;
    margin-bottom: 30px;
    font-size: 1.2em;
    color: #fff;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.29);
}
.infos {
    max-width: 515px;
    margin-top: 29px;
}
.infos .profile-list .title {
    display: block;
    float: left;
    color: #fff;
    line-height: 19px;
}
.infos .profile-list .content {
    margin-left: 3px;
    font-size: 15px;
    font-weight: 400;
    line-height: 15px;
    color: #fff;
	padding-top: 0;
    padding-bottom: 0;
}
.links {
    max-width: 500px;
    margin-left: 0;
    margin-top: -8px;
    height: 100%;
}
.links .fab-menu-btn.btn-float{padding: 19px; margin-right: 9px;}


.profile-list {list-style-type:none;padding:0;}
.profile-list li{    width: 100%;
    display: inline-block;
    float: left;
    line-height: 15px;}

</style>


 <script>
  
 
 function forappendfields(idx)
{ 
	var field_html= $("#field_html_"+idx).html();
       
$("#field_append_"+idx).append(field_html);
}</script>
  <?php   
global $db;
if(isset($_POST['submitdata']))
{  
		//$json_encode = json_encode($_POST);
		//$updatedx = $db->update("allrecord = '".$json_encode."',firstname = '".$_POST['firstname']."',lastname = '".$_POST['lastname']."',cand_email = '".$_POST['email'][0]."', detailconfirm=1","parsing_data_record","parID=".$_REQUEST['cid']." ");
	$sd = json_encode($_POST);
	echo  $sd;
	echo '<br><br><br>';
	print_r(json_decode($sd));
	
	echo "Update Record Successfully.";	 
 	
}
 										
		 $parsing_data_record = $db->select("parsing_data_record","*","parID = '".$_REQUEST['cid']."' and userID = ".$_SESSION['user_id']." "); 
	if(mysql_num_rows($parsing_data_record) > 0)
	{
	$pars_data = mysql_fetch_assoc($parsing_data_record);

	$firstname = $pars_data['firstname']; 
	$lastname = $pars_data['lastname']; 
	$cand_email = $pars_data['cand_email']; 
	$candidateID = $pars_data['candidateID']; 
	$allrecord = $pars_data['allrecord']; 
	$detailconfirm = $pars_data['detailconfirm']; 
	 
/*	 $sadads = json_decode('{"cv":"null","candidateid":"360217000000142042","FirstName":"Ata","LastName":"AbbasR","emailadd":"ata_abbas110@yahoo.com","phone":" 92-333-4265075","Mobile":"92-333-4265075","Website":"null","Street":"497jjF-B Area ff20","City":"Karachi","State":"null","zipcode":"null","Country":"PAKISTAN","exp_years":"3","Current_Employer":"Back Check Group","curr_job_tit":"Web Developer","skillsets":"Technical Skills Languageh PHPsJQUERYs SQLsHTMs CSS DatabaseshMySQs SQL Server CMsCodeigniters Wordpress","expct_salary":"null","curr_salary":"null","skype_id":"null","twitter_id":"null","additional_info":"BCG is Background Screening company. We integrate systems for background screening of employment and others.s Crystal Workforce is product base software house, I was a part of development team as a web developer. Worked on Codeigniters development and architecture design using Wordpresss Ps Codeigneter And MySql.Develop administrative control panels for websites.Design database structures"}');
*/	 
	
	$allrecord_data = json_decode($allrecord);
	
	
	$candidateid = $allrecord_data->candidateid;
	$FirstName = $allrecord_data->FirstName;
	$LastName = $allrecord_data->LastName;
	$emailadd = $allrecord_data->emailadd;
	$phone = $allrecord_data->phone;
	$Mobile = $allrecord_data->Mobile;
	$Website = $allrecord_data->Website;
	$Street = $allrecord_data->Street;
	$City = $allrecord_data->City;
	$State = $allrecord_data->State;
	$zipcode = $allrecord_data->zipcode;
	$Country = $allrecord_data->Country;
	$exp_years = $allrecord_data->exp_years;
	$Current_Employer = $allrecord_data->Current_Employer;
	$curr_job_tit = $allrecord_data->curr_job_tit;
	$skillsets = $allrecord_data->skillsets;
	$expct_salary = $allrecord_data->expct_salary;
	$curr_salary = $allrecord_data->curr_salary;
	$skype_id = $allrecord_data->skype_id;
	$twitter_id = $allrecord_data->twitter_id;
	$additional_info = $allrecord_data->additional_info;
	
	
	
	 //var_dump($allrecord_data);
	 
/*	 $kasd = '{"candidateid":"360217000000142042","firstname":"John","lastname":"Smith","phone":[""],"email":[""],"street":[""],"city":[""],"state":[""],"zipcode":[""],"school":[""],"employer":[""],"first_name_spouse":[""],"last_name_spouse":[""],"submitdata":"Submit"}';
	//$json_encode = json_encode($allrecord);
	$json = str_replace('&quot;', '"', $allrecord); $json = rtrim($json, "\0");
	$json = json_decode($json);
*/	
	
	//'{"candidateid":"360217000000142042","firstname":"John","lastname":"Smith","phone":[""],"email":[""],"street":[""],"city":[""],"state":[""],"zipcode":[""],"school":[""],"employer":[""],"first_name_spouse":[""],"last_name_spouse":[""],"submitdata":"Submit"}'
	
	
	//$jsonData = rtrim($axx, "\0");
	
	 
	//$asd222 = "'".$axx."'";
	//var_dump($json);
	}
	else 
	{
		echo "No Access"; exit;
	}
										
		$tbls_login = "coupon_assign_company as cac INNER JOIN coupon_code as cc ON cac.coup_id=cc.id";
		$cols_login = "*"; 
		$whre_login = "cac.com_id = ".$COMINF['id']." AND DATE(NOW())  >= DATE(cc.valid_from) AND DATE(cc.valid_to) >=  DATE(NOW()) ";
		//echo 'select * from '.$tbls_login.' where ('.$whre_login.')';
		
		$activityquery_login = $db->select($tbls_login,$cols_login,$whre_login);
		$rec = mysql_fetch_array($activityquery_login); //echo 'test2';
 		$selected_prod = $rec['selected_prod']; 
		$_SESSION['datasetsperson'] = $selected_prod;
				
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
 
  function get_datasets(){

	 $maxposts = 1;
 	 $url = 'http://compliant.one/dashboard/api.php?token=sdsvdsvb]3.bg%3E8%3E&method=datasets&alloweddatasets='.$_SESSION['datasetsperson'].'';
 
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
  $get_datasets = get_datasets();
 
 
 	 function forgetcompletedata($keyword,$country='',$conditions='',$pagination_start=1){
if($country != "")
{$getcountry = '&country='.$country;}
else{$getcountry ="";} 
//echo $dataset_assigned.' ========== '; //print_r($_SESSION);
	 $maxposts = 1;
 	   $url = 'http://compliant.one/dashboard/api.php?keyword='.$keyword.'&limit=99'.$getcountry.'&token=sdsvdsvb]3.bg%3E8%3E&method=getrecords&alloweddatasets=1,2,3,6,7,13';
  $ch = curl_init();
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_URL,$url);
 $result=curl_exec($ch);
 curl_close($ch);
  $asd =  json_decode($result);
	return $asd;
 }
  	 function getrecord_single($userID){
if($country != "")
{$getcountry = '&country='.$country;}
else{$getcountry ="";}

	 $maxposts = 1;
 	  $url = 'http://compliant.one/dashboard/api.php?token=sdsvdsvb]3.bg%3E8%3E&method=getrecord&alloweddatasets='.$_SESSION['datasetsperson'].'&id='.$userID.'';
 
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_URL,$url);
 $result=curl_exec($ch);
 curl_close($ch);
  $asd =  json_decode($result);
	return $asd;
 }
   	 function getdataset_single($datasetID){
 
	 $maxposts = 1;
 	  $url = 'http://compliant.one/dashboard/api.php?token=sdsvdsvb]3.bg%3E8%3E&method=dataset&id='.$datasetID.'';
 
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_URL,$url);
 $result=curl_exec($ch);
 curl_close($ch);
  $asd =  json_decode($result);
	return $asd;
 }

  $forgetcompletedata =forgetcompletedata($FirstName."%20".$LastName);
 ?>
 
    <?php
	if(count($forgetcompletedata->records) > 0)
	{
 		
    foreach($forgetcompletedata->records as $data) 
	{ 
	$datasets[] = $data->filename;
			?>
	 
<?php
	}
	}
	else
	{ 
	}
 ?>
 
<div class="content-wrapper">
   <section class="instanat_report">
   	 <div class="page-header">
        <div class="page-header-content">
            <div class="page-title2">
                <h1>Search Result </h1>
            </div>
        </div>             
     </div>	
 				<!-- Cover area -->
				 
				<!-- /cover area -->
     
			<div class="content">
 					<!-- Tabs -->
					<ul class="nav nav-lg nav-tabs nav-tabs-bottom search-results-tabs ">
						<li class="active"><a href="#schedule" data-toggle="tab"><i class="icon-display4 position-left"></i> Search Data</a></li>
						<li><a href="#activity" data-toggle="tab"><i class="icon-people position-left"></i> Search Result</a></li>
						<li><a href="#formupdate" data-toggle="tab"><i class="icon-image2 position-left"></i> Edit Form</a></li>
						<li><a href="#report" data-toggle="tab"><i class="icon-file-play position-left"></i> Report</a></li>
						<li class="dropdown pull-right">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="visible-xs-inline-block position-right">Options</span> <span class="caret"></span></a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else</a></li>
								<li class="divider"></li>
								<li><a href="#">One more line</a></li>
							</ul>
						</li>
					</ul>
					<!-- /tabs -->
             
            	<!-- User profile -->
				<div class="row mt-20 pt-20">                        
                        <div class="col-lg-12">
							<div class="tabbable">
								<div class="tab-content">
                                <!-- FORM SUBMIT TAB 1 -->
                                	<div class="tab-pane fade in active" id="schedule">
<?php
 function getRecordById($url_query,$param)
	{
		 $ch = curl_init();
//echo $url_query."?".$param."<br />"; die;
	curl_setopt($ch, CURLOPT_URL,$url_query);
    // Set a referer
  // curl_setopt($ch, CURLOPT_HEADER, FALSE);
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Download the given URL, and return output
 $output = curl_exec($ch);
		return $output;
	
	}
 $authToken ="e00fac174c4e4e0edfc8dc4fc2d0f8c1";

	$url2="https://recruit.zoho.com/recruit/private/xml/Candidates/getRecordById";
	$param="authtoken=".$authToken."&scope=recruitapi&id=".$candidateID."&version=2&newFormat=2&selectColumns=Candidates(First Name,Last Name,Email,Created On,Mobile,Experience in Years,Current Job Title,Current Employer,Skill Set,Phone,Website,Fax,Street,City,State,Zip Code,Country,Highest Qualification Held,Current Salary,Expected Salary,Additional Info,Skype ID,Twitter)";


$getresponse = getRecordById($url2,$param);
$xmlxxxx=simplexml_load_string($getresponse);

 

?>
										<!-- Selected Datasets -->
										<div class="panel panel-flat">
											<div class="panel-body">
                                            
                                            <div class="blockui-animation-container" id="loader_occrp" style="width: 100%;margin: 0 auto;display: none;color: #555;background: transparent;text-align: center;font-size: 16px;">
         <span class="text-semibold"><i class="icon-spinner4 spinner position-left" style="font-size: 18px;"></i>&nbsp; Loading...</span>
        </div>
                                            
                                            
                                        <form class="form-horizontal" action="<?=SURL?>?action=singlereport&atype=view&cid=<?=$_REQUEST['cid']?>" method="post" id="detailsubmit">
                                        
                                        <input type="hidden" name="candidateid" value="<?=$candidateID?>" />
                                        
                                        <input type="hidden" name="Mobile" value="<?=$Mobile?>" />
                                        
                                        <input type="hidden" name="Website" value="<?=$Website?>" />
                                        
                                        <input type="hidden" name="Country" value="<?=$Country?>" />
                                        
                                        <input type="hidden" name="exp_years" value="<?=$exp_years?>" />
                                        <input type="hidden" name="curr_job_tit" value="<?=$curr_job_tit?>" />
                                        
                                        
                                         <textarea name="skillsets" style="display:none"><?=$skillsets?></textarea>
                                        <input type="hidden" name="expct_salary" value="<?=$expct_salary?>" />
                                        <input type="hidden" name="curr_salary" value="<?=$curr_salary?>" />
                                        <input type="hidden" name="skype_id" value="<?=$skype_id?>" />
                                        <input type="hidden" name="twitter_id" value="<?=$twitter_id?>" />
                                        <textarea name="additional_info" style="display:none"><?=$additional_info?></textarea>
                                        
                                        
                                        
                                        
                                        <fieldset class="content-group">
                                        	<legend class="text-bold">Subject Information</legend>
									
                                    <div class="form-group">
										<label class="control-label col-lg-2">Name</label>
										<div class="col-lg-10">
											<div class="row">
												<div class="col-md-4">
													<input type="text" class="form-control" name="FirstName" value="<?=$FirstName?>" placeholder="First Name">
												</div>

												<div class="col-md-4">
													<input type="text" name="LastName" value="<?=$LastName?>" class="form-control" placeholder="Last Name">
												</div>
											</div>
										</div>
									</div>
                                         	

                                    <div class="form-group">
										<label class="control-label col-lg-2">Birth Date</label>
										<div class="col-lg-10">
											<div class="row">
												<div class="col-md-4">
													<input type="text" class="form-control" placeholder="Birth Date">
												</div>
											</div>
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="control-label col-lg-2">Contact Info</label>
										<div class="col-lg-10">
											<div class="row">	 

												<div class="col-md-4">
                                                <?php
                                               echo $total_num= count($allrecord_data->phone);
												//for($i=0; $sad > $i; $i++)
												//{
												?>
                                                 <div id="field_html_1">
                                               
													<input type="text" name="phone[]" class="form-control" placeholder="Phone" value="<?=$phone?>">
                                                    </div>
                                                 <?php
												//}
												 ?>   
												<div id="field_append_1"></div>
                                                	<div class="label-block">
														<a href="javascript:;" onClick="forappendfields(1);" class="label bg-blue">Add Another</a>
													</div>
												</div>

												<div class="col-md-4"><div id="field_html_2">
													<input type="text" name="emailadd[]" class="form-control" placeholder="Email" value="<?=$emailadd?>">
                                                    </div><div id="field_append_2"></div><div class="label-block">
														<a href="javascript:;" onClick="forappendfields(2);" class="label bg-blue">Add Another</a>
													</div>
												</div>
											</div>
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="control-label col-lg-2">Residence</label>
										<div class="col-lg-10">
											<div class="row">
                                            <div id="field_html_3">
												<div class="col-md-4">
                                                
													<input type="text" name="Street[]" class="form-control" placeholder="Street" value="<?=$Street?>">
                                                    
													
												</div>

												<div class="col-md-2">
													<input type="text" name="City[]" class="form-control" placeholder="City" value="<?=$City?>">
												</div>

												<div class="col-md-2">
													<input type="text" name="State[]" class="form-control" placeholder="State" value="<?=$State?>">
												</div>

												<div class="col-md-2">
													<input type="text" name="zipcode[]" class="form-control" placeholder="Zip Code" value="<?=$zipcode?>">
												</div>
                                                
                                                </div><div id="field_append_3"></div>


												<div class="label-block">
														<a href="javascript:;" onClick="forappendfields(3);" class="label bg-blue">Add Another</a>
													</div>
											</div>
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="control-label col-lg-2">School</label>
										<div class="col-lg-10">
											<div class="row">
												<div class="col-md-4">
                                                <div id="field_html_4">
													<input type="text" name="school[]" class="form-control" placeholder="School">
													</div><div id="field_append_4"></div>
                                                    <div class="label-block">
														<a href="javascript:;" onClick="forappendfields(4);" class="label bg-blue">Add Another</a>
													</div>
												</div>

											</div>
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="control-label col-lg-2">Current Employer</label>
										<div class="col-lg-10">
											<div class="row">
												<div class="col-md-4">
                                                 <div id="field_html_5">
													<input type="text" name="Current_Employer[]" class="form-control" placeholder="Current Employer" value="<?=$Current_Employer?>">
													</div><div id="field_append_5"></div>
                                                    <div class="label-block">
														<a href="javascript:;" onClick="forappendfields(5);" class="label bg-blue">Add Another</a>
													</div>
												</div>

											</div>
										</div>
									</div>
                                     
                                    <div class="form-group">
										<label class="control-label col-lg-2">Current Spouse</label>
										<div class="col-lg-10">
											<div class="row">
                                             <div id="field_html_6">
												<div class="col-md-4">
                                               
													<input type="text" name="first_name_spouse[]" class="form-control" placeholder="First Name">
                                                   
                                                  
												</div>

												<div class="col-md-4">
													<input type="text" name="last_name_spouse[]" class="form-control" placeholder="Last Name">
												</div>
                                                 </div><div id="field_append_6"></div>
                                                  <div class="label-block">
														<a href="javascript:;" onClick="forappendfields(6);" class="label bg-blue">Add Another</a>
													</div>
											</div>
										</div>
									</div>
 										</fieldset>
                                         <div class="form-group">
										<label class="control-label col-lg-3">refine Search  by country</label>
										<div class="col-lg-9">
											<div class="row">
												<div class="col-md-4">
													<select class="select">
                                                    	<option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                    </select>
												</div>
<?php
if($detailconfirm == 0)
{
?>
 												<div class="col-md-8 text-right">
													<input type="submit" name="submitdata" class="btn bg-blue" value="Search"><!--Search <i class="icon-arrow-right14 position-right"></i></button>-->
												</div>
    <?php
}
 ?>										<!-- /Selected Datasets -->
                                             
											</div>
										</div>
 									</div>
                                    
                                        </form>                                            
                                            
                                            </div>
     									 </div>

									</div>
                                
                                <!-- FORM SUBMIT TAB 2 END HERE -->
                                
                                <!-- VIEW DETAILSS TAB 2 -->
                                
                                
                                
									<div class="tab-pane fade" id="activity">
                                    <!-- Cover area -->
                                    <?php
                                    if($detailconfirm == 1)
									{
									?>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                    
                                            <!-- V-CARD -->
                                            <div id="v-card" class="card">
                    
                                                <!-- PROFILE PICTURE -->
                                                <div id="profile" class="float-right profile-img">
                                                    <img alt="profile-image" class="img-responsive" src="images/avtr_case.png">
                                                    <div class="slant"></div>
                                                   
                                                </div>
                    
                                                <div class="card-content">
                    
                                                    <!-- NAME & STATUS -->
                                                    <div class="info-headings">
                                                        <h4 class="text-uppercase left"><?=$firstname." ".$lastname?></h4>
                                                        <!--<h6 class="text-capitalize left">Software Engineer &amp; UI/UX Expert</h6>-->
                                                    </div>
                    
                                                    <!-- CONTACT INFO -->
                                                    <div class="infos">
                                                        <ul class="profile-list">
                                                            <li class="clearfix">
                                                                <span class="title"><i class="icon-envelop"></i></span>
                                                                <span class="content"><?=$cand_email?></span>
                                                            </li>
                                                          
                                                           <!-- <li class="clearfix">
                                                                <span class="title"><i class="icon-skype" aria-hidden="true"></i></span>
                                                                <span class="content">yourusername@skype.com</span>
                                                            </li>-->
                                                            <li class="clearfix">
                                                                <span class="title"><i class="icon-phone2"></i></span>
                                                                <span class="content"><?=$cand_email?></span>
                                                            </li>
                                                            <li class="clearfix">
                                                                <span class="title"><i class="icon-location3"></i></span>
                                                                <span class="content">LampStreet 34/3, London, UK</span>
                                                            </li>
                    
                                                        </ul>
                                                    </div>
                    
                                                    <!--LINKS-->
                                                    <div class="links">
                                                         <a href="#" id="first_one" class="fab-menu-btn btn btn-float btn-rounded btn-icon bg-indigo"><i class="icon-facebook"></i></a>
                                                         <a href="#" class="fab-menu-btn btn btn-float btn-rounded btn-icon bg-info-400"><i class="icon-twitter"></i></a>
                                                         <a href="#" class="fab-menu-btn btn btn-float btn-rounded btn-icon bg-danger"><i class="icon-google-plus"></i></a>
                                                         <a href="#" class="fab-menu-btn btn btn-float btn-rounded btn-icon bg-blue"><i class="icon-linkedin2"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <!-- Cover area -->
                                     
                                     <div class="timeline-date fisrt_rw"><h2><i class="icon-user position-left"></i> Cross Check Data</h2></div>
										<div class="timeline timeline-center">
						<div class="timeline-container">
 							   <?php
 												  
	if(count($forgetcompletedata->records) > 0)
	{

	  $json_encodedata = json_encode($forgetcompletedata->records);
 
 			$cols="user_id,firstname,lastname,email,cross_check_resp,search_date";
		
		$values="'".$_SESSION['user_id']."','".$firstname."','".$lastname."','".$cand_email."','".$json_encodedata."','".date("Y-m-d h:i:s")."' ";
 					
					$search_history_instant = $db->select("search_history_instant","serID","email = '".$cand_email."'"); 
					//$rsV_nic = mysql_fetch_assoc($Sel_v_nic);
					if(mysql_num_rows($search_history_instant) > 0)
					{
						$rsV_nic = mysql_fetch_assoc($search_history_instant);
					echo '<input type="hidden" id="lastinsertid" name="lst_inst_id" value="'.$rsV_nic['serID'].'" />';
					
					$updatedx = $db->update("cross_check_resp = '".$json_encodedata."'","search_history_instant","serID=".$rsV_nic['serID']." ");
	
					}
					else
					{
					$isInserted=$db->insert($cols,$values,"search_history_instant");
					$insertedID=$db->insertedID;
					//$rsV_nic = mysql_fetch_assoc($Sel_v_nic);
					echo '<input type="hidden" id="lastinsertid" name="lst_inst_id" value="'.$insertedID.'" />';
					}
 
$inc = 1;
	$i=0;
    foreach($forgetcompletedata->records as $data) 
	{ 
	if($i<=2){
 	  $getrecord_single =getrecord_single($data->id);
	  $getdataset_single =getdataset_single($data->filename);
 	if($inc == 1)
	{
		$first_margine = "margin-top:0";
	}
	else
	{
		$first_margine = '';
	}	 
		 
	if($inc % 2 == 0 )
	{
		$post_even = "post-even";
	}	 
	else
	{
		$post_even = "";
	}	 
		 
 	?><!--<a data-action='close'>-->
 							<!-- Invoices -->
							<div class="timeline-row <?=$post_even?>" style=" <?=$first_margine?>" id="hidesec<?=$data->id?>">
								<div class="timeline-icon" style="text-align: center;font-size: 22px;font-weight: 500;line-height: 37px;">
									<div class="bg-info-400">
										<?=substr($firstname,0,1)?>
									</div>
								</div>

								<div class="timeline-content">
									<div class="panel border-left-lg border-left-danger invoice-grid">
       
                                       <div class="panel-body"> 
    <div class="row">
    <div class="col-sm-6">
    <h6 class="text-semibold no-margin-top"><?=$data->FullName?></h6>                        
    <ul class="list list-unstyled">
    <li>Reason: <?=$data->OffenceDescription?></li>
    </ul>
                                                
                                                
                                                </div>
    
    <div class="col-sm-6">
    <ul class="list list-unstyled text-right">
    <li><label class="label bg-success"><?=$getdataset_single->dataset[0]->name?></label></li>
    </ul>
    </div>
                                            </div>
                                        </div>
    
                                       <div class="panel-footer">
                <ul>
                    <li><a href="javascript:;" onclick="removefromlist('<?=$data->id?>');">Remove This Result</a></li>
                </ul>
                                            
                                            <ul class="pull-right">
    <?php //print_r($data)."<br><br><br>";
    foreach($getrecord_single->result as $singlerec)
    {
    //print_r($singlerec)."<br><br><br>";
    //echo $singlerec->WordSummary."<br>";
    $Address1 = $singlerec->Address1;
    $Country1 = $singlerec->Country1;
    $Address2 = $singlerec->Address2;
    $ActualRelationship = $singlerec->ActualRelationship;
    $Dateofresearch = $singlerec->Dateofresearch;
    $Source1 = $singlerec->Source1;
    $filename = $singlerec->filename;
    $Country2 = $singlerec->Country2;
    $Nationality = $singlerec->Nationality;
    $PhotographUrl = $singlerec->PhotographUrl;
    $EntityType = $singlerec->EntityType;
     
    $id = $singlerec->id;
    
    ?>
      
    <li> <a href="#" data-toggle="modal" data-target="#single_record_<?=$id?>"><i class="icon-eye8 position-left"></i></a></li>
    
    <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i> <span class="caret"></span></a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#" data-toggle="modal" data-target="#single_record_<?=$id?>"><i class="icon-eye8 position-left"></i> View Report</a></li>
                                                        
                                                        <li><a href="<?=SURL?>instant_report_download_inc.php?id=<?=$id?>" target="_blank" ><i class="icon-file-download2 position-left"></i>Report Download</a></li>
                                                          
                                                      
                                                    </ul>
                                                </li>
                                
    <div id="single_record_<?=$id?>" class="modal fade in">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h5 class="modal-title"><?=$data->FullName?> Full Report</h5>
        </div>
    
         <div class="modal-body" style="font-size:14px; width:100%; display:inline-block; background:transparent;">
    
                              
    <div class="col-md-3 prof-serc-img">
        <?php
             if($PhotographUrl)
         {
            echo '<div class="form-group">
               <img src="'.$PhotographUrl.'" width="100px" height="100px"  />
                </div>';
         }else{
                ?><div class="form-group"><img src="https://backcheck.io/verify/images/avtr_case.png"></div><?php 
            }
        
        ?>
        
        <a href="<?=SURL?>?action=singlereport&atype=download&id=<?=$id?>" style="width:100%;" class="btn bg-info-400" target="_blank" >Report Download</a>
    
    </div>
    
    
    <div class="col-md-8">
        <div class="table-responsive">
    
            <table class="table table-striped">
            <?php  //print_r($singlerec)."<br><br><br>";
         
            echo '<tr>
               <td>Crime :</td> <td>'.$getdataset_single->dataset[0]->name.'</td>
                </tr>';
         
         
         if($Address1)
         {
            echo '<tr>
                <td>Address 1 :</td> <td>'.$Address1.'</td>
                </tr>';
         }
         
         if($Address2)
         {
            echo '<tr>
                <td>Address 2 :</td> <td>'.$Address2.'</td>
                </tr>';
         }
         
         if($Country1)
         {
            echo '<tr>
                <td>Country	 :</td> <td>'.$Country1.'<s/td>
                </tr>';
         }
         
         if($Country2)
         {
            echo '<tr>
                <td>Country 2 :</td> <td>'.$Country2.'</td>
                </tr>';
         }
         
         if($ActualRelationship)
         {
            echo '<tr>
                <td>Actual Relationship :</td> <td>'.$ActualRelationship.'</td>
                </tr>';
         }
         
         if($Dateofresearch)
         {
            echo '<tr>
                <td>Date of Research :</td> <td>'.$Dateofresearch.'</td>
                </tr>';
         }
         
         if($Source1)
         {
            echo '<tr>
                <td>Source :</td> <td>'.$Source1.'</td>
                </tr>';
         }
         
        /* if($filename)
         {
            echo '<div class="form-group">
                File Name : '.$filename.'
                </div>';
         }*/
         
         if($Nationality)
         {
            echo '<tr>
                <td>Nationality :</td> <td>'.$Nationality.'</td>
                </tr>';
         }
         
         
         if($EntityType)
         {
            echo '<tr>
               <td>Entity Type :</td> <td>'.$EntityType.'</td>
                </tr>';
         }
         
         ?>
        
        </table>
    
        </div>	
    
    </div>
    
    
    
           </div>     
    </div>
    </div>
    </div>
    
    
    <?php
    }
    
    ?>
                                                
                                              
                                            </ul>
    
                                            
                                        </div>
                                        
                                    </div>

									
								</div>
							</div>
							<!-- /invoices -->
							
                            <?php
 $i++;
	}
	
	$inc++;
	}
 	}
	else
	{echo "No record found.";}
?>

						

                       	<?php //include("include_pages/pipl_instant_inc.php"); ?>
                        
                         	<?php  //include("include_pages/twiiter_sentimnt_inc.php"); ?>
                        
                       
                       <div class="timeline-date"><h2><i class="icon-users position-left"></i> Occrp Data</h2></div>
 						<?php  $limit_occr=5;
									$fullname=$firstname." ".$lastname;
									if($firstname!=''){
										
										$arr = get_occrp_data_api($fullname,$limit_occr,$offset=0);
 		if(count($arr->results) > 0)
		{ 
		$inc2=1;		   
		$i=1;
		foreach($arr->results as $val){
			 // print_r($val).'<br><br><br><br><br>';
		if($inc2 == 1)
		{
			$first_margine = "margin-top:0";
		}
		else
		{
			$first_margine = '';
		}	 
			
		if($inc2 % 2 == 0 )
		{
			$post_even = "post-even";
		}	 
		else
		{
			$post_even = "";
		}	
		
 			
			?>                                                
		<div class="timeline-row <?=$post_even?>" style=" <?=$first_margine?>"  id="hidesec<?=$val->id?>">
	<div class="timeline-icon" style="text-align: center;font-size: 22px;font-weight: 500;line-height: 37px;">
	<div class="bg-info-400">
	<?=substr($firstname,0,1)?>
	</div>
	</div>
	
	<div class="timeline-content">
	
	
		<div class="panel border-left-lg border-left-danger invoice-grid timeline-content">
	<div class="panel-body">
	<div class="row">
	<div class="col-sm-12">
	<h6 class="text-semibold no-margin-top"><?=str_replace("&#65533;","",$val->title)?></h6>                        
	<ul class="list list-unstyled">
	<li><span class="text-semibold">Source Url:</span> <?=str_replace("&#65533;","",$val->source_url)?></li>
	</ul>
 	</div>
 	</div>
	</div>
	
	<div class="panel-footer">
	<ul class="pull-right">
	 
	<li> <a href="#" data-toggle="modal" data-target="#single_record_occrp_<?=$val->id?>"><i class="icon-eye8 position-left"></i></a> </a></li>
	<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i> <span class="caret"></span></a>
	<ul class="dropdown-menu dropdown-menu-right">
	<li><a href="#" data-toggle="modal" data-target="#single_record_occrp_<?=$val->id?>"><i class="icon-eye8 position-left"></i> View Report</a></li>
	
	<li><a href="#"  ><i class="icon-file-download2 position-left"></i>Report Download</a></li>
	
	</ul>
	</li>
 	
	  <div id="single_record_occrp_<?=$val->id?>" class="modal fade in">
		<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title"><?=$data->FullName?> Full Report</h5>
			</div>
		
			 <div class="modal-body" style="font-size:14px; width:100%; display:inline-block; background:transparent;">
		
								  
		<div class="col-md-3 prof-serc-img">
		   
		
		</div>
		
		
		<div class="col-md-8">
			<div class="table-responsive">
		
				<table class="table table-striped">
				<?php  //echo $val->id.' thisisdiddd';//print_r($singlerec)."<br><br><br>";
				//echo "https://data.occrp.org/api/1/documents/".$val->id."/pages/".$val->records->results[0]->page;
			  $occrp_details = occrp_details($val->id,$val->records->results[0]->page);
		//print_r($asd); str_replace("&#65533;","",$occrp_details->text).utf8_decode($occrp_details->text)
		
 				echo '<tr>
					 <td>'.str_replace("&#65533;","",$occrp_details->text).'</td>
					</tr>';
			 
			 
			 /*if($Address1)
			 {
				echo '<tr>
					<td>Address 1 :</td> <td>'.$Address1.'</td>
					</tr>';
			 }
			 
			 if($Address2)
			 {
				echo '<tr>
					<td>Address 2 :</td> <td>'.$Address2.'</td>
					</tr>';
			 }
			 
			 if($Country1)
			 {
				echo '<tr>
					<td>Country	 :</td> <td>'.$Country1.'<s/td>
					</tr>';
			 }
			 
			 if($Country2)
			 {
				echo '<tr>
					<td>Country 2 :</td> <td>'.$Country2.'</td>
					</tr>';
			 }
			 
			 if($ActualRelationship)
			 {
				echo '<tr>
					<td>Actual Relationship :</td> <td>'.$ActualRelationship.'</td>
					</tr>';
			 }
			 
			 if($Dateofresearch)
			 {
				echo '<tr>
					<td>Date of Research :</td> <td>'.$Dateofresearch.'</td>
					</tr>';
			 }
			 
			 if($Source1)
			 {
				echo '<tr>
					<td>Source :</td> <td>'.$Source1.'</td>
					</tr>';
			 }
			 
			
			 
			 if($Nationality)
			 {
				echo '<tr>
					<td>Nationality :</td> <td>'.$Nationality.'</td>
					</tr>';
			 }
			 
			 
			 if($EntityType)
			 {
				echo '<tr>
				   <td>Entity Type :</td> <td>'.$EntityType.'</td>
					</tr>';
			 }
			 */
			 ?>
			
			</table>
		
			</div>	
		
		</div>
		
		
		
			   </div>     
		</div>
		</div>
		</div>
	<?php
 	
	$inc++; 
	//}
	
	?>
	
	
	</ul>
	
	
	</div>
	</div>
	
	
	
	</div>
	</div>
	
					<?php $inc2++; $i++;  } ?>
                
                 <div class="items"></div> 
                 <button type="button" class="btn bg-success-600 btn-lg" id="load_more"><i class="icon-rotate-cw3 position-left"></i>Load More</button> 
                 
                 
                <div class="blockui-animation-container" id="loader_occrp" style="
    width: 56%;
    margin: 0 auto; display:none; color:#FFFFFF;
">
         <span class="text-semibold"><i class="icon-spinner4 spinner position-left"></i>&nbsp; Loading...</span>
        </div> 
    	
                            <?php  }
							else
							{
							echo "No Record Found";
							}
							
							} ?>
                            
                            
						</div>
				    </div>
                                        
                                        <div class="row">
 
													 
													</div>
										
										
										<?php //include("pipl_instant_inc.php"); ?>
                                     <?php
									}
									else
									{echo 'First Submit Informations.';}
									 ?>   
									

									   
									</div>

								<!-- VIEW DETAILSS TAB 2 END HERE -->

									<!-- FORM DATA MODIFICATIONS TAB 3 -->

									<div class="tab-pane fade in" id="formupdate">
                                                                         <!-- Selected Datasets -->
                                                                        <div class="panel panel-flat">
                                                                            <div class="panel-body">
                                                                             
                                                                        <?php /*?><form class="form-horizontal" action="<?=SURL?>/?action=singlereport&atype=view&cid=<?=$_REQUEST['cid']?>" method="post" id="detailsubmit">
                                                                        <input type="hidden" name="candidateid" value="<?=$candidateID?>" />
                                                                        
                                                                        <fieldset class="content-group">
                                                                            <legend class="text-bold">Subject Information</legend>
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="control-label col-lg-2">Name</label>
                                                                        <div class="col-lg-10">
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <input type="text" class="form-control" name="firstname" value="<?=$firstname?>" placeholder="First Name">
                                                                                </div>
                                
                                                                                <div class="col-md-4">
                                                                                    <input type="text" name="lastname" value="<?=$lastname?>" class="form-control" placeholder="Last Name">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                            
                                
                                                                    <div class="form-group">
                                                                        <label class="control-label col-lg-2">Birth Date</label>
                                                                        <div class="col-lg-10">
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <input type="text" class="form-control" placeholder="Birth Date">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="control-label col-lg-2">Contact Info</label>
                                                                        <div class="col-lg-10">
                                                                            <div class="row">	 
                                
                                                                                <div class="col-md-4">
                                                                                <div id="field_html_1">
                                                                                    <input type="text" name="phone[]" class="form-control" placeholder="Phone">
                                                                                    
                                                                                </div><div id="field_append_1"></div>
                                                                                    <div class="label-block">
                                                                                        <a href="javascript:;" onClick="forappendfields(1);" class="label bg-blue">Add Another</a>
                                                                                    </div>
                                                                                </div>
                                
                                                                                <div class="col-md-4"><div id="field_html_2">
                                                                                    <input type="text" name="email[]" class="form-control" placeholder="Email">
                                                                                    </div><div id="field_append_2"></div><div class="label-block">
                                                                                        <a href="javascript:;" onClick="forappendfields(2);" class="label bg-blue">Add Another</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="control-label col-lg-2">Residence</label>
                                                                        <div class="col-lg-10">
                                                                            <div class="row">
                                                                            <div id="field_html_3">
                                                                                <div class="col-md-4">
                                                                                
                                                                                    <input type="text" name="street[]" class="form-control" placeholder="Street">
                                                                                    
                                                                                    
                                                                                </div>
                                
                                                                                <div class="col-md-2">
                                                                                    <input type="text" name="city[]" class="form-control" placeholder="City">
                                                                                </div>
                                
                                                                                <div class="col-md-2">
                                                                                    <input type="text" name="state[]" class="form-control" placeholder="State">
                                                                                </div>
                                
                                                                                <div class="col-md-2">
                                                                                    <input type="text" name="zipcode[]" class="form-control" placeholder="Zip Code">
                                                                                </div>
                                                                                
                                                                                </div><div id="field_append_3"></div>
                                
                                
                                                                                <div class="label-block">
                                                                                        <a href="javascript:;" onClick="forappendfields(3);" class="label bg-blue">Add Another</a>
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="control-label col-lg-2">School</label>
                                                                        <div class="col-lg-10">
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                <div id="field_html_4">
                                                                                    <input type="text" name="school[]" class="form-control" placeholder="School">
                                                                                    </div><div id="field_append_4"></div>
                                                                                    <div class="label-block">
                                                                                        <a href="javascript:;" onClick="forappendfields(4);" class="label bg-blue">Add Another</a>
                                                                                    </div>
                                                                                </div>
                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="control-label col-lg-2">Employer</label>
                                                                        <div class="col-lg-10">
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                 <div id="field_html_5">
                                                                                    <input type="text" name="employer[]" class="form-control" placeholder="Street">
                                                                                    </div><div id="field_append_5"></div>
                                                                                    <div class="label-block">
                                                                                        <a href="javascript:;" onClick="forappendfields(5);" class="label bg-blue">Add Another</a>
                                                                                    </div>
                                                                                </div>
                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                     
                                                                     
                                                                    
                                                                     
                                                                    
                                                                    <div class="form-group">
                                                                        <label class="control-label col-lg-2">Current Spouse</label>
                                                                        <div class="col-lg-10">
                                                                            <div class="row">
                                                                             <div id="field_html_6">
                                                                                <div class="col-md-4">
                                                                               
                                                                                    <input type="text" name="first_name_spouse[]" class="form-control" placeholder="First Name">
                                                                                   
                                                                                  
                                                                                </div>
                                
                                                                                <div class="col-md-4">
                                                                                    <input type="text" name="last_name_spouse[]" class="form-control" placeholder="Last Name">
                                                                                </div>
                                                                                 </div><div id="field_append_6"></div>
                                                                                  <div class="label-block">
                                                                                        <a href="javascript:;" onClick="forappendfields(6);" class="label bg-blue">Add Another</a>
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                        </fieldset>
                                                                    
                                                                        <div class="form-group">
                                                                        <label class="control-label col-lg-3">refine Search  by country</label>
                                                                        <div class="col-lg-9">
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <select class="select">
                                                                                        <option>1</option>
                                                                                        <option>2</option>
                                                                                        <option>3</option>
                                                                                    </select>
                                                                                </div>
                                <?php
                                if($detailconfirm == 0)
                                {
                                ?>
                                
                                                                                <div class="col-md-8 text-right">
                                                                                    <input type="submit" name="submitdata" class="btn bg-blue">Search <i class="icon-arrow-right14 position-right"></i></button>
                                                                                </div>
                                    <?php
                                }
                                 ?>										<!-- /Selected Datasets -->
                                                                             
                                                                            </div>
                                                                        </div>
                                                                     </div>
                                                                         </form><?php */?>                                            
                                                                             </div>
                                                             
                                                            </div>
                                
 									</div>
                                    
                                    <!-- FORM DATA MODIFICATIONS TAB 3 END HEREEE-->
                                    
                                    <!-- REPORT TAB 4 -->
                                    
                                    
                                    
                                    
                                    <div class="tab-pane fade in" id="report">
 
										<!-- Selected Datasets -->
										<div class="panel panel-flat">
											<div class="panel-body">
                                            
                                             AAAA
                                             
                                            </div> 
                           				 </div>

									</div>
                                    
                                    <!-- REPORT TAB 4 END HEREEEE -->
								</div>
							</div>
						</div>
						
					</div>
				<!-- /user profile -->
            
            </div>
   </section>
  </div>
  <script>
  
 
   
 function removefromlist(ids)
	{
		var lastinsertid = $("#lastinsertid").val();
		 
		if(confirm("Are you sure want to delete this record?")){
			$.ajax({
				type: 'POST',
				url: "actions.php",
				data: "ePage=add_rating&delete_from_list_instant=1&lastinsertid="+lastinsertid+"&ids="+ids,
				success: function(response){
					if(response == '1')
					{
						  //$("#box"+ids).trigger('click');
						  $("#hidesec"+ids).hide();
 						 
					}
					else
					{
					}
			 
				 
					}

		});
		}
	}
 
 
  
 
 	//var cur_index=<?php //$limit_occr?>;
	//cur_index=parseInt(cur_index)+<?php //$limit_occr?>; 
	var screen_height = $('body').height();
	var cury = $(window).scrollTop();
	var screen = $(window).height();
	$('#load_more').click(function(){
		
	$('#loader_occrp').show();
	$('#load_more').hide();
		
         $.ajax({
			type: 'POST',
            url: "actions.php",
            data: 'ePage=add_rating&occr_rec_list_ajax=yes&fullname=<?=$firstname." ".$lastname?>&loppnum=<?=$inc2?>&limit='+cur_index,
            success: function(result){
				 var str = result;
 			
		$('#loader_occrp').hide();
		$('#load_more').show();
				
		if(result=='No More Record Found.')
			{
				$('#load_more').hide();
			}			
				
                cur_index +=<?=$limit_occr?>;;
                screen_height = $('body').height();
				
                $( ".items" ).fadeIn( 400 ).append(result);
            }
        });
});
	</script>
