<div class="timeline-date text-muted"><h2>Twitter Data</h2></div>
<?php

if(((isset($_POST['FirstName']) && ($_POST['FirstName'] !='')) && (isset($_POST['FirstName']) && ($_POST['FirstName'] !='')))) {
     include_once(dirname(__FILE__).'/lib/config.php');
    include_once(dirname(__FILE__).'/lib/TwitterSentimentAnalysis.php');

    $TwitterSentimentAnalysis = new TwitterSentimentAnalysis(DATUMBOX_API_KEY,TWITTER_CONSUMER_KEY,TWITTER_CONSUMER_SECRET,TWITTER_ACCESS_KEY,TWITTER_ACCESS_SECRET);

    //Search Tweets parameters as described at https://dev.twitter.com/docs/api/1.1/get/search/tweets
    $twitterSearchParams=array(
        'q'=>$_POST['FirstName']."+".$_POST['LastName'],
        'lang'=>'en',
        'count'=>10,
    );
    $results=$TwitterSentimentAnalysis->sentimentAnalysis($twitterSearchParams);
// print_r($results);
     ?>
     
    <?php /*?><table border="1">
        <tr>
            <td>Id</td>
            <td>User</td>
            <td>Text</td>
            <td>Twitter Link</td>
            <td>Sentiment</td>
        </tr>
        <?php
        foreach($results as $tweet) {
            
            $color=NULL;
            if($tweet['sentiment']=='positive') {
                $color='#00FF00';
            }
            else if($tweet['sentiment']=='negative') {
                $color='#FF0000';
            }
            else if($tweet['sentiment']=='neutral') {
                $color='#FFFFFF';
            }
            ?>
            <tr style="background:<?php echo $color; ?>;">
                <td><?php echo $tweet['id']; ?></td>
                <td><?php echo $tweet['user']; ?></td>
                <td><?php echo $tweet['text']; ?></td>
                <td><a href="<?php echo $tweet['url']; ?>" target="_blank">View</a></td>
                <td><?php echo $tweet['sentiment']; ?></td>
            </tr>
            <?php
        }
        ?>    
    </table><?php */?>
    <?php
 	
		//print_r($results);
$limit_twitt = 5;
	if(count($results) > 0)
	{
	
	//$email = $get_records->query->emails[0]->address;
	//$persons_count = $get_records->persons_count;
		$inc = 0;
    foreach($results as $data) 
	{
		if($inc == 0)
	{
		$first_margine = "margin-top:0";
	}
	else
	{
		$first_margine = '';
	}	 
	 // print_r($data).'<br><br><br>';//echo " filenamexxxx ".$data->filename;
	 // $getrecord_single =getrecord_single($data->id);
	 // $getdataset_single =getdataset_single($data->filename);
	  //print_r($getdataset_single->dataset[0]);
//print_r($data)."<br><br><br><br>";

/*$firstname = $data->names[0]->first;
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
*/
    if($inc % 2 == 0 )
	{
		$post_even = "post-even";
	}	 
	else
	{
		$post_even = "";
	}	 
	?>
       
        <div class="timeline-row <?=$post_even?>" style=" <?=$first_margine?>"  id="hidesec<?=$data->id?>">
            <div class="timeline-icon" style="text-align: center;font-size: 22px;font-weight: 500;line-height: 37px;">
            <div class="bg-info-400">
            
            <?php
            if($data['profile_image_url'] != "")
			{
			?>
            <img src="<?php echo $data['profile_image_url']; ?>" />
            <?php
			}
			else
			{
			?>
            <?=substr($data['user'],0,1)?>
            <?php
			}
			?>
            
            </div>
            </div>
            
                <div class="timeline-content">
                
                
                
	                <div class="panel border-left-lg border-left-danger invoice-grid timeline-content">
                <div class="panel-body">
                <div class="row">
                <div class="col-sm-6">
                <h6 class="text-semibold no-margin-top"><?php echo $data['user'];?></h6>                        
                <ul class="list list-unstyled">
                <li><span class="text-semibold">Detail:</span> <?php echo $data['text']; ?></li>
                 
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
                <h5 class="modal-title"><?php echo $data['user'];?> Full Report</h5>
                </div>
                
                <div class="modal-body" style="font-size:14px; width:100%; display:inline-block;">
                
                
                <div class="col-md-3 prof-serc-img">
                
                
                </div>
                
                <div class="col-md-8">
                
                <?php  
               /* echo '<div class="form-group">
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
                </div>';*/
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
 
	}	?>
    <!--<div class="items_twitt"></div> 
                 <button type="button" class="btn bg-success-600 btn-lg" id="load_more_twitter"><i class="icon-rotate-cw3 position-left"></i>Load More Twitter Record</button> 
                 
                 <div class="blockui-animation-container" id="loader_twitter" style="
    width: 56%;
    margin: 0 auto; display:none; color:#FFFFFF;
">
         <span class="text-semibold"><i class="icon-spinner4 spinner position-left"></i>&nbsp; Loading...</span>
        </div>-->

    <?php
    
	}
	 
	else
	{echo "No record found.";}
	
	
}
//exit;
?>


<script>

 
 	var cur_index=<?=$limit_twitt?>;
	cur_index=parseInt(cur_index)+<?=$limit_twitt?>;;
	var screen_height = $('body').height();
	var cury = $(window).scrollTop();
	var screen = $(window).height();
	$('#load_more_twitter').click(function(){
		
	$('#loader_twitter').show();
	$('#load_more_twitter').hide();
		
      // make an ajax call to your server and fetch the next 100, then update
      //some vars 
        $.ajax({
			type: 'POST',
            url: "actions.php",
            data: 'ePage=add_rating&twitter_rec_list_ajax=yes&fullname=<?=$_POST['FirstName']." ".$_POST['LastName']?>&loppnum=<?=$inc?>&limit='+cur_index,
            success: function(result){
				 var str = result;
    //alert(str.trim());
	//var asd = str.trim();
			
		$('#loader_twitter').hide();
		$('#load_more_twitter').show();
				
		if(result=='No More Record Found.')
			{
				$('#load_more_twitter').hide();
			}			
				
                cur_index +=<?=$limit_twitt?>;;
                screen_height = $('body').height();
				
                $( ".items_twitt" ).fadeIn( 400 ).append(result);
            }
        });
});
	</script>

 