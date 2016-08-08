<style type="text/css">
.mbox{
	width:49%;
	float:left;
	padding:5px;
}
.category-title>span i{font-size: 13px;margin-right: 7px;}
</style>

 <section class="retracted scrollable">
        <div class="row">
        <div class="col-md-12">
        <div class="report-sec">
		<div class="page-header">
            <div class="page-header-content">
            <div class="page-title2">
            <h1>My Profile</h1>
            </div></div>
        </div>
		<div class="content">	
		
		<?php include('include_pages/myaccount_sidebar.php');?>
		
		<div class="container-detached adv_rep">
		<div class="content-detached">
        <div class="panel panel-flat">
                     
                        <div class="panel-body">
                        <div class="">
                        <div class="toggle_container">	
		<?php
            
            if(isset($_REQUEST['updateProfile'])){
                echo updateProfile($_POST);	
            }
            
            $userInfo = getUserInfo($_SESSION['user_id']);
        ?>
              <form action="" method="post" enctype="multipart/form-data">
                <div class="dataFields">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label>First Name:</label>
                            <input type="text" class="form-control" name="fname" value="<?php echo $userInfo['first_name']; ?>" />
                            <div class="clear" ></div>
                        </div>
                        </div>
                         <div class="col-md-6">
                        <div class="form-group">
                             <label>Last Name:</label>
                            <input type="text" class="form-control" name="lname" value="<?php echo $userInfo['last_name']; ?>" />
                            <div class="clear" ></div>
                        </div></div>
                         <div class="col-md-6">
                        <div class="form-group">
                             <label>Email:</label>
                            <input type="text" class="form-control" name="email" value="<?php echo $userInfo['email']; ?>" />
                            <div class="clear" ></div>
                        </div> </div>   
                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Designation:</label>
                            <input type="text" class="form-control" name="desig" value="<?php echo $userInfo['designation']; ?>" />
                            <div class="clear" ></div>
                        </div></div>     
                     <?php  /*  <div>
                             <label>Company Name:</label>
                             <?php $comInfo = companyInfo($_SESSION['user_id']);?>
                            <input type="text" class="form-control" name="comp" value="<?php echo $comInfo['name']; ?>" />
                            <div class="clear" ></div>
                        </div>  
                        <div>
                             <label>Company Address:</label>
                            <textarea class="form-control" rows="3" name="adrs" ><?php echo $comInfo['address']; ?></textarea>
                            <div class="clear" ></div>
                        </div>  */ ?>
                         <div class="col-md-6">
                        <div class="form-group">
                             <label>City:</label>
                             <input type="text" class="form-control" name="city" value="<?php echo $userInfo['city']; ?>" />
                            <div class="clear" ></div>
                        </div></div>             
                         <div class="col-md-6">
                        <div class="form-group">
                            <label>Mobile Number:</label>
                            <input type="text" class="form-control" name="mfon" value="<?php echo $userInfo['cell_no']; ?>" />
                            <div class="clear" ></div>
                        </div></div> 
                         <div class="col-md-6">
                        <div class="form-group">
                            <label>Office Phone:</label>
                            <input type="text" class="form-control" name="sfon" value="<?php echo $userInfo['fone_no']; ?>" />
                            <div class="clear" ></div>
                        </div></div> 
						
							<div class="col-md-12">
                          <button class="btn bg-success pull-right" style="margin-top:5px;" type="submit" name="updateProfile"><i class="icon-reset position-left"></i> Update Profile</button>
                        </div>						
                        
                        <div class="clear"></div>
                </div>
            </form>          
        </div>
		</div>
		</div>
		</div>

		 <section class="retracted scrollable">
        <div class="row">
        <div class="col-md-12">
        <div>
     		<div class="page-header">
                    <div class="page-header-content">
                        <div class="page-title3">
                        
                    </div></div></div>
        <div class="panel panel-flat">
        	<div class="panel-heading">
            	<h6 class="text--semibold panel-title">Change Password</h6>
            </div>
                        <div class="panel-body">
                        <div class="">
                        <div class="toggle_container">	
			<?php include('include_pages/changepass_inc.php');?>
    	</div>
		</div>
		</div>
		</div>
        <div class="clear"></div>
</div>
</div>
</div>
</section>

<?php if($LEVEL==4){ ?>
<!--Email Notification Start-->

		 <section class="retracted scrollable" id="email_notify">
				<div class="row">
				<div class="col-md-12">
				<div>
					
				<div class="panel panel-flat">
							 <div class="panel-heading">
            	<h6 class="text--semibold panel-title">Email Notifications</h6>
            </div>
								<div class="panel-body">
								<div class="">
								<div class="toggle_container">	
					<?php include('include_pages/email_notifications_inc.php');?>
				</div>
				</div>
				</div>
				</div>
				<div class="clear"></div>
		</div>
		</div>
		</div>
		</section>
		<!--Email Notification End-->

		<!--Billing Contact Start-->
		<section class="retracted scrollable" id="billing_contact">
				<div class="row">
				<div class="col-md-12">
				<div>
					
				<div class="panel panel-flat">
						<div class="panel-heading">
            	<h6 class="text--semibold panel-title">Billing Contact</h6>
            </div>
								<div class="panel-body">
								<div class="">
								<div class="toggle_container">	
					<?php include('include_pages/billing_contact_inc.php');?>
				</div>
				</div>
				</div>
				</div>
				<div class="clear"></div>
		</div>
		</div>
		</div>
		</section>
		<!--Billing Contact End-->


<?php } ?>
		</div>
		</div>

		
		</div>
		</div>
		</div>
</section>

<?php //include('include_pages/Invoice_inc.php');?>











