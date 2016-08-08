		<!-- Page content -->

<div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title2"><h4><i class="icon-arrow-left52 position-left"></i> Annoucements</h4>
					
                </div>
                </div>
                </div>
                
<div class="content">

<div class="panel panel-white">
<div class="panel-heading">
	<h5 class="panel-title">All Annoucements</h5>
</div>


<div class="panel-body">




<?php
$postfields["action"] = "getannouncements";
$xml=whmcs_api(WHMCS_APIURL,$postfields);
$arr=whmcsapi_xml_parser($xml);
if($arr['WHMCSAPI']['TOTALRESULTS']>0){
	//include("include_pages/pagination_inc.php");
	$postfields["limitstart"] = "0";
$postfields["limitnum"] = "3";
$xml=whmcs_api(WHMCS_APIURL,$postfields);
$arr=whmcsapi_xml_parser($xml);
$announcements=$arr['WHMCSAPI']['ANNOUNCEMENTS'];
foreach($announcements as $announcement){?>

<div class="panel panel-body stack-media-on-mobile">
						<div class="media-left">
							<a href="http://backcheckgroup.com/support/announcements.php?id=<?=$announcement['ID']?>" class="btn btn-link btn-icon text-teal">
								<i class="icon-megaphone icon-2x no-edge-top"></i>
							</a>
						</div>

						<div class="media-body media-middle">
							<h6 class="media-heading text-semibold"><a href="http://backcheckgroup.com/support/announcements.php?id=<?=$announcement['ID']?>" target="_blank" class="text-default display-inline-block"><?=$announcement['TITLE']?></a></h6>
							<?=$announcement['ANNOUNCEMENT']?>
                            <div class="display-block text-muted text-small"><?=date("d-M-Y H:i:s A",strtotime($announcement['DATE']))?></div>
						</div>

						<div class="media-right media-middle">
							<a target="_blank" href="http://backcheckgroup.com/support/announcements.php?id=<?=$announcement['ID']?>" class="btn bg-danger-400 btn-lg"><i class="icon-file-text position-left"></i> View Detail</a>
						</div>
					</div>
        
	<?php }
}
?>
<div class="items"></div>
<?php if($arr['WHMCSAPI']['TOTALRESULTS']>3){ ?>
<button type="button" class="btn bg-success-600 btn-lg" id="load_more"><i class="icon-rotate-cw3 position-left"></i>Load More</button><?php } ?>




</div>
</div>

</div>
	<!-- /page container -->
    <script type="text/javascript">
	var cur_index=3;
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
            data: 'ePage=add_rating&annouce_list=yes&limit='+cur_index,
            success: function(result){
                cur_index +=3;
                screen_height = $('body').height();
				
                $( ".items" ).fadeIn( 400 ).append(result);
            }
        });
});
	</script>
