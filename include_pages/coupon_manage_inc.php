<?php

 function get_datasets(){

	 $maxposts = 1;
 	 $url = 'http://compliant.one/dashboard/api.php?token=sdsvdsvb]3.bg%3E8%3E&method=datasets';
 
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_URL,$url);
 $result=curl_exec($ch);
 curl_close($ch);
  $asd =  json_decode($result);
	return $asd;
 }
 $get_datasets = get_datasets();


if(isset($_REQUEST['edur'])){
	if(is_numeric($_REQUEST['couponid'])){
		//enabdisb("company","id=$_REQUEST[couponid]");
	}
}

if(isset($_REQUEST['edit'])){
	if(is_numeric($_REQUEST['couponid'])){
		$data = getInfo('coupon_code',"id=$_REQUEST[couponid]");
		$_REQUEST['coupon_code'] =$data['coupon_code'];
		$_REQUEST['usr_email_add'] =$data['usr_email_add'];
		$_REQUEST['selec_prod'] =$data['selected_prod'];
		$_REQUEST['description'] =$data['description'];
		$_REQUEST['price'] =$data['price'];
		$_REQUEST['max_count_use'] =$data['max_count_use'];
			
		$_REQUEST['use_count'] = $data['use_count'];
		$_REQUEST['redeem_point_id'] = $data['redeem_point_id'];
		$_REQUEST['valid_from'] = $data['valid_from'];
		$_REQUEST['valid_to'] = $data['valid_to'];
		$_REQUEST['coupon_type'] = $data['coupon_type'];
		$_REQUEST['status'] = $data['status'];
		 
					
	}
} 
?>
<script type="text/javascript">
	function unpaid(ths){
		if(ths.options[ths.selectedIndex].value=='Test'){
			jQuery("#upaid").show();
		}else{
			jQuery("#upaid").hide();
		}
		
		if(ths.options[ths.selectedIndex].value=='Individual'){
			jQuery("#cnm").html('Name<sup class="sreq">*</sup>:');
			jQuery("#public").show();
			jQuery("#mainind").hide();
		}else{
			jQuery("#cnm").html('Client Name<sup class="sreq">*</sup>:');
			jQuery("#public").hide();
			jQuery("#mainind").show();			
		}
	}
	var attcnt=1;
	function deleteattach(ths){
		attcnt=attcnt-1;
		jQuery(ths).parent().parent().remove();
		
	}

	function addattach(){
		
		if(attcnt<3){ 
			jQuery("#doattach").append('<div>'+jQuery("#doattach #attchfile").html()+'</div>');
			attcnt++;
		}
		
	}
		
</script>
<style>
	#attchfile .doclose{
		display:none !important;
	}
.whiteBackground{ padding:15px;}
ul.block content_accordion{ padding:0; margin:0;}
ul.content_accordion li{ list-style:none;}	
h2.box-head{ margin:0; padding:0;} 
</style>

<section class="retracted scrollable content-body" <?=(isset($_REQUEST['addnew']) || isset($_REQUEST['couponid']))?'style="display:block;"':'style="display:none;"'?>>
<div class="row">
 	<div class="col-md-12">
        <div class="manager-report-sec">
        <div class="panel panel-default panel-block">
        <div class="page-section-title">
        	<h2 class="box-head"><?=(isset($_REQUEST['couponid']))?'Edit':'Add'?> Coupon code</h2>
        </div>
                    <div class="list-group">
                    
                        <div class="list-group-item">

                       <form class="cstm form-horizontal" action="" name="myform" method="post" enctype="multipart/form-data" >
                          
                          <div class="row">   
                            	<div class="col-md-3"></div>
                          		<div class="col-md-9">
                           <div class="form-group">
                                <div class="col-lg-3 "><label for="">Coupon Code<sup class="sreq">*</sup>:</label></div>
                           			<div class="col-lg-9">
                                   
								   <input class="form-control" type="text" name="coupon_code" value="<?=$_REQUEST['coupon_code']?>" >
                                </div>
                            </div>
							<div class="form-group">
                                <div class="col-lg-3 "><label for="">Type<sup class="sreq">*</sup>:</label></div>
                           			<div class="col-lg-9">
                                   
								   <select name="coupon_type" class="form-control" title="Select coupon type"  >
																	<option value="free_trial" <?=($_REQUEST['coupon_type']=='free_trial')?'selected':''?>>Free Trial</option>
																	<option value="discount" <?=($_REQUEST['coupon_type']=='discount')?'selected':''?>>Discount</option>
																	</select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-lg-3 "><label for="">User Email Address<sup class="sreq">*</sup>:</label></div>
                           			<div class="col-lg-9">
                                   
								   <input class="form-control" type="email" name="usr_email_add" value="<?=$_REQUEST['usr_email_add']?>" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-lg-3 "><label for="">Products<sup class="sreq">*</sup>:</label></div>
                           			<div class="col-lg-9">
                                   <?php
								  // $asd =  explode(",",$_REQUEST['selec_prod']);
                                    
									//print_r($asd).'implode';
									//$checks = $db->select("checks","*","is_active=1"); 
									
								   ?>
								   <select name="selec_prod[]" multiple  class="select placeholder populate" placeholder="Select Products" >
															
								   <?php
								   
  /*?>     while($check = mysql_fetch_array($$get_datasets)){?>
      <option value="<?=$check['checks_id']?>" <?php echo (in_array($check['checks_id'],explode(",",$_REQUEST['selec_prod'])))?'selected="selected"':'';?>><?=$check['checks_title']?></option>
<?php */?>   



<?php  
   // }
	?>
                                         <?php 
                                    foreach($get_datasets->dataset as $get_dataset)
									{
									  	
										?>
                                     <option value="<?=$get_dataset->id?>" <?php echo (in_array($get_dataset->id,explode(",",$_REQUEST['selec_prod'])))?'selected="selected"':'';?>><?=$get_dataset->name?></option>
                                        <?php
									  
									}
									?>
                              
                                   
                                   </select>
                                </div>
                            </div>
                            
                            
                           <div class="form-group">
                            <div class="col-lg-3 "><label for="cerp">Discount Percent (%)<sup class="sreq">*</sup>:</label></div>
                                <div class="col-lg-9"><input class="form-control" type="number" name="price" value="<?=$_REQUEST['price']?>" > </div>
                            </div>
                           <div class="form-group">
                            <div class="col-lg-3 "><label for="cName" id="cnm">Max Number of Attempts<sup class="sreq">*</sup>:</label></div>
                            <div>
                              <div class="col-lg-9"><input class="form-control" type="number" name="max_count_use" value="<?=$_REQUEST['max_count_use']?>" > </div>
                            </div>
                          </div>
						  
						  <div class="form-group">
                            <div class="col-lg-3 "><label for="" >Validity:</label></div>
                            <div>
                              <div class="col-lg-3">
							  <input id="" class="form-control datetimepicker-month1" title="Valid From" type="text" name="valid_from" value="<?=$_REQUEST['valid_from']?>" placeholder="Valid From"></div>
							   <div class="col-lg-3">
							  <input id="" class="form-control datetimepicker-month2" title="Valid To" type="text" name="valid_to" value="<?=$_REQUEST['valid_to']?>"  placeholder="Valid To"></div>
                            </div>
                          </div>
						  
				<div class="form-group">
                                <div class="col-lg-3 "><label for="">Status<sup class="sreq">*</sup>:</label></div>
                           			<div class="col-lg-9">
                                   
								   <select name="status" class="form-control" title="Select Status"  >
																	<option value="Available" <?=($_REQUEST['status']=='Available')?'selected':''?>>Available</option>
																	<option value="Expire" <?=($_REQUEST['status']=='Expire')?'selected':''?>>Expire</option>
																	</select>
                                </div>
                            </div>
                          </div>
                          </div>
                          
                              
                          
                    <div class="clearfix"></div>
                           <div class="row">
                            <div class="col-md-3">&nbsp;</div>
                            <div class="col-md-9">
                           <div class="form-group">
                            <div class="col-lg-3 "><label for="description">Description:</label></div>
                            <div class="clearfix">
                             <div class="col-lg-9"><textarea class="input form-control" title="Input description"  name="description" rows="5" ><?=$_REQUEST['description']?></textarea></div>
                            </div>
                          </div>
                          </div>
                          </div>
                         
                 	
						
						 <?php if(isset($_REQUEST['couponid'])){ ?>
                                <input type="hidden" name="couponid" value="<?=$_REQUEST['couponid']?>" >
                                <input type="hidden" name="edit" value="" >
                          <?php	} ?>
                          <div class="button_bar clearfix">
                              <button type="submit" class="btn btn-success has_text" style="float:right;" name="add_coupon_code" > 
                                    <span><?=isset($_REQUEST['couponid'])?'Save':'Add'?> Coupon Code </span> 
                              </button>
                          </div>
                        </form>
            			</div>
                	</div>
           </div>



		</div>
	</div>
</div>
</section>
<section class="retracted scrollable">
	<div class="row">
    <div class="col-md-12">
    	<div class="manager-report-sec">
                   
<div class="panel panel-default panel-block">
 <div class="page-section-title">
<h2 class="box-head">Coupons Listing </h2>
<a href="?action=coupon&atype=add/edit&addnew"><button  class="btn btn-success has_text"   title="Add New Client" ><span><i class="icon-plus3"></i></span></button></a>
                    </div>
       <table class="table table-bordered table-striped" id="tableSortable">
          <thead>
            <tr>
              
              <th>Promo Code</th>
              <th>Discount(%)</th>
              <th>Max Attempts</th>
              <th>Already Used</th>
              <th>Valid From</th>
			  <th>Valid To</th>
			  <th>Type</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php	
			
			
			$coupon_code= $db->select("coupon_code","*"," isdlt=0 ORDER BY `id` DESC");
			if(mysql_num_rows($coupon_code)>0){
			while($coupon = mysql_fetch_array($coupon_code)){ ?>
            <tr class="gradeX">
             
              <td><?=$coupon['coupon_code']?></td>
              <td><?=$coupon['price']?></td>
              <td><?php echo $coupon['max_count_use'];?></td>
              <td> <?php echo $coupon['use_count'];?></td>
              <td> <?php echo $coupon['valid_from'];?></td>
			  <td> <?php echo $coupon['valid_to'];?></td>
			  <td> <?php echo ($coupon['coupon_type']=='free_trial')?'Free Trial':ucwords($coupon['coupon_type']);?></td>
              <td> <?php echo $coupon['status'];?></td>
               <td align="center"><?php  if($coupon['status']=='Available') {
                                    $img="accept.png";
                                    $tit="Expire"; 
									$color="style='color:#0DAF0D;'";
                                }else{
									 $img="acces_denied_sign.png";
                                     $tit="Available";
									 
									 $color="style='color:#ff0000;'";
                                } 
                                $link="couponid=$coupon[id]";
                        ?>
               <a href="javascript:void(0)" >  <i onclick="submitLink('<?=$link?>&edit')"  class="icon-pencil5"  title="Edit" ></i></a></td>
            </tr>
            <?php }} ?>
          </tbody>
        </table>
</div>
</div>
</div>
</div>
</section>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>

$(function(){
			$("#updateclient_status").on("click",function () {
				
			if($('#updateclient_status').is(':checked')){
				$('#disabled_id').removeAttr('disabled');
				$('#enabled_id').removeAttr('disabled');
			}else{
				$('#disabled_id').attr('disabled','disabled');
				$('#enabled_id').attr('disabled','disabled');
			}
			
			});
			
			
			$( ".datetimepicker-month1, .datetimepicker-month2").datepicker({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		yearRange: "1980:<?php  echo date("Y");?>"
		});
		
		
		
			});
			
		
		
		
		
		
</script>