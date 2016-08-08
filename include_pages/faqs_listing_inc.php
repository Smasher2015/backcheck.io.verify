<style  type="text/css">
.faq-section a:after
{
	font-family: 'FontAwesome';
	content: "\f067";
	margin-left: 10px;
	font-size: 12px;
}
.faq-section a.active:after
{
	content: "\f068";
}
</style>

<section class="retracted scrollable">
<div class="row">
  <div class="col-md-12">
    <div class="manager-report-sec">
      <div class="panel panel-default panel-block">
        <div class="list-group-item">
			<div>
                    <div class="list-group-item">
                      <h2 class="box_head">FAQ's</h2>
                             <div class="faq-section">
                             <?php	
									$system_faqs = $db->select("`system_faqs`","*","sf_active=1");
                                    if(mysql_num_rows($system_faqs)>0){
										$faq_arr = array();
										while($faqs = mysql_fetch_array($system_faqs)){ 
										$faq_arr[] = array('id' => $faqs['sf_id']);?>		
                                            <div class="list-group-item" style="background-color:#fbfbfb;">
                                                <a class="crm-remarks-btn<?=$faqs['sf_id']?>" href="javascript:void(0);"><?=ucwords($faqs['sf_question'])?></a>
                                                <div class="clearfix"></div>
                                                <div class="crm-remarks<?=$faqs['sf_id']?>" style="display:none; padding-top:15px;">
                                                	<p><?=html_entity_decode($faqs['sf_answer'])?></p>
                                                </div>
                                            </div>
                                             <div class="clearfix"></div>
									 <?php }
									 	$faq_arr = json_encode($faq_arr);
									}
								 ?>
                             </div>  
                            <div class="clearfix"></div>
                    </div>
        		</div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
// Developed By Ayaz
var arr = '<?php echo $faq_arr;?>';
$(document).ready(function(){
	data = $.parseJSON(arr);
	$.each(data, function(i, item) {
		var sf_id =  item.id;
		$('a.crm-remarks-btn' + sf_id).click(function(){
			$('.crm-remarks' + sf_id).slideToggle(700);
			$('a.crm-remarks-btn' + sf_id).toggleClass("active");
		});
	});
});
// Developed By Ayaz
</script>