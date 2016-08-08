
<?php
//print_r($_REQUEST);  
 function get_records(){

	 $maxposts = 1;
 	// $url = 'https://api.pipl.com/search/?email=ata_inside110%40hotmail.com&phone=%2B923323602388&first_name=ata&last_name=abbas&username=ata_inside110%40hotmail.com&key=CONTACT-DEMO-mifuwano9tju4kpegpecbpgr';
 echo $url = 'https://api.pipl.com/search/?email='.urlencode($_REQUEST['emailadd']).'&phone='.urlencode($_REQUEST['phone']).'&first_name='.urlencode($_REQUEST['FirstName']).'&last_name='.urlencode($_REQUEST['LastName']).'&username=ata_inside110%40hotmail.com&key=
CONTACT-DEMO-yh5dxzlz8vcuare840v2ty1p';
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_URL,$url);
 $result=curl_exec($ch);
 curl_close($ch);
  $asd =  json_decode($result);
	return $asd;
 }
 ?>

	
                                                    
		<?php
		
	$get_records = get_records();
	 
		
	if(count($get_records->query) > 0)
	{
	
	$email = $get_records->query->emails[0]->address;
	$persons_count = $get_records->persons_count;
		$inc = 0;
    foreach($get_records->possible_persons as $data) 
	{ //echo " filenamexxxx ".$data->filename;
	 // $getrecord_single =getrecord_single($data->id);
	 // $getdataset_single =getdataset_single($data->filename);
	  //print_r($getdataset_single->dataset[0]);
//print_r($data)."<br><br><br><br>";

$firstname = $data->names[0]->first;
$middlename = $data->names[0]->middle;
$lastname = $data->names[0]->last;
$displayname = $data->names[0]->display;

$gender = $data->gender->content;

$valid_since = $data->addresses[0]->valid_since;
$country = $data->addresses[0]->country;
$state = $data->addresses[0]->state;
$city = $data->addresses[0]->city;
$zip_code = $data->addresses[0]->zip_code;
$display = $data->addresses[0]->display;
$street = $data->addresses[0]->street;
$house = $data->addresses[0]->house;
$apartment = $data->addresses[0]->apartment;

$dob = $data->dob->date_range->start;
$dobdisplay = $data->dob->display;

    if($inc % 2 == 0 )
	{
		$post_even = "post-even";
	}	 
	else
	{
		$post_even = "";
	}	 
	
	?>
      
        <div class="timeline-row <?=$post_even?>" style=" <?=$first_margine?>" id="hidesec<?=$data->id?>">
            <div class="timeline-icon" style="text-align: center;font-size: 22px;font-weight: 500;line-height: 37px;">
            <div class="bg-info-400">
            J
            </div>
            </div>
            
                <div class="timeline-content">
                
                
                
	                <div class="panel border-left-lg border-left-danger invoice-grid timeline-content">
                <div class="panel-body">
                <div class="row">
                <div class="col-sm-6">
                <h6 class="text-semibold no-margin-top"><?php echo $displayname;?></h6>                        
                <ul class="list list-unstyled">
                <li>Email : <?php echo $email; ?></li>
                </ul>
                
                
                </div>
                
                <div class="col-sm-6">
                <ul class="list list-unstyled text-right">
                <li><label class="label bg-success"><?php //$getdataset_single->dataset[0]->name?></label></li>
                </ul>
                </div>
                </div>
                </div>
                
                <div class="panel-footer">
                <ul class="pull-right">
                <?php /*?> <?php //print_r($data)."<br><br><br>";
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
                <?php */?> 
                <li> <a href="#" data-toggle="modal" data-target="#single_record_<?=$inc?>"><i class="icon-eye8 position-left"></i></a></li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i> <span class="caret"></span></a>
                <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#" data-toggle="modal" data-target="#single_record_<?=$inc?>"><i class="icon-eye8 position-left"></i> View Report</a></li>
                
                <li><a href="<?=SURL?>?action=singlereport&atype=download&id=<?=$inc?>" target="_blank" ><i class="icon-file-download2 position-left"></i>Report Download</a></li>
                
                </ul>
                </li>
                
                <div id="single_record_<?=$inc?>" class="modal fade in">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><?php echo $displayname;?> Full Report</h5>
                </div>
                
                <div class="modal-body" style="font-size:14px; width:100%; display:inline-block;">
                
                
                <div class="col-md-3 prof-serc-img">
                <?php /*?><?php
                if($PhotographUrl)
                {
                echo '<div class="form-group">
                <img src="'.$PhotographUrl.'" width="100px" height="100px"  />
                </div>';
                }else{
                ?>NA<?php 
                }
                
                ?><?php */?>
                
                </div>
                
                <div class="col-md-8">
                
                <?php  
                echo '<div class="form-group">
                Full Name : '.$displayname.'
                </div>';
                echo '<div class="form-group">
                Gender : '.$gender.'
                </div>';
                echo '<div class="form-group">
                valid_since : '.$valid_since.'
                </div>';
                echo '<div class="form-group">
                country : '.$country.'
                </div>';
                echo '<div class="form-group">
                state : '.$state.'
                </div>';
                echo '<div class="form-group">
                city : '.$city.'
                </div>';
                echo '<div class="form-group">
                zip_code : '.$zip_code.'
                </div>';
                echo '<div class="form-group">
                display : '.$display.'
                </div>';
                echo '<div class="form-group">
                street : '.$street.'
                </div>';
                echo '<div class="form-group">
                house : '.$house.'
                </div>';
                echo '<div class="form-group">
                apartment : '.$apartment.'
                </div>';
                echo '<div class="form-group">
                dob : '.$dob.'
                </div>';
                echo '<div class="form-group">
                dobdisplay : '.$dobdisplay.'
                </div>';
                ?>
                
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
        


<?php
 
	}	}
	 
	else
	{echo "No record found.";}
?>



						
                            
                            
                            
		
		<?php //include("include_pages/contact"); ?>