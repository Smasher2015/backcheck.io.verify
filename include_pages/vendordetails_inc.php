<?php if(is_numeric($_REQUEST['vdid'])){
                $tbls = "vendors";
                $data = $db->select($tbls,"*","vd_active=1 AND vd_id=$_REQUEST[vdid]");
                $re = mysql_fetch_array($data);
	?>
<div class="box grid_16">

	<h2 class="box_head">Vendor Details</h2>	
 	<a href="#" class="grabber">&nbsp;</a>
    <a href="#" class="toggle">&nbsp;</a>
    <div class="toggle_container">
    <div class="block">
          <div class="columns clearfix">
          	<div class="section">
                 <h1><?=$re['vd_name']?></h1>
            	<div class="col_33">
                        <div class="section">                                 
                            <p><strong>Contact Person:</strong> <?=$re['vd_cperson']?></p>
                            <p><strong>Account Title:</strong> <?=$re['vd_acctitle']?></p>
                            <p><strong>Branch Code:</strong> <?=$re['vd_branchcode']?></p>
                            <p><strong>City:</strong> <?=$re['vd_city']?></p>
                            <p><strong>Mobile#:</strong> <?=$re['vd_mobile']?></p>
                        </div>
                 </div>
                 
            	<div class="col_33">
                        <div class="section">                                 
                            <p><strong>Bank:</strong> <?=$re['vd_bankname']?></p>
                            <p><strong>Branch:</strong> <?=$re['vd_branchname']?></p>
                            <p><strong>Swift Code:</strong> <?=$re['vd_swiftcode']?></p>
                            <p><strong>Area:</strong> <?=$re['vd_area']?></p>
                            <p><strong>Phone#:</strong> <?=$re['vd_contact']?></p>
                        </div>
                 </div>
         
                <div class="col_33">
                        <div class="section">                                 
                            <p><strong>Account#:</strong> <?=$re['vd_accnumber']?></p>
                            <p><strong>Fee:</strong> <?=$re['vd_fee']?></p>
                            <p><strong>NIC:</strong> <?=$re['vd_cnicnumber']?></p>
                            <p>&nbsp;</p>
                            <p><strong>Email:</strong> <?=$re['vd_email']?></p>
                            
                        </div>
                 </div>
            
            <div class="section"> <strong>Remarks:</strong>  <?=$re['vd_remarks']?></div>
            
            <div class="section"> <strong>Address:</strong>  <?=$re['vd_adress']?></div>
            
            </div>  
		</div>
        
          	<div class="button_bar clearfix">
            	<form action="?action=add&atype=vendor&edit=<?=$re['vd_id']?>" method="post" enctype="multipart/form-data">
                    <button class="btnright div_icon has_text"  type="submit" name="vedit" >
                        <span>Edit</span>
                    </button>  
                </form>
             </div>
		</div>
 	</div>
</div>
<?php }?>