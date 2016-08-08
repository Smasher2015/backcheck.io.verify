<div class="sidebar-detached" id="filters">
						<div class="sidebar sidebar-default" style="max-height: none;">
							<div class="sidebar-content">

								<!-- Sidebar search -->
								
								<div class="sidebar-category">
						<div class="category-title">
							<span><i class="icon-user-tie"></i> <?php  echo ucfirst($_SESSION['fname']);?></span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>
						 <div class="category-content no-padding">
							<ul class="nav navigation" id="nav_iner">
							
							<li data-slide="1"><a href="?action=profile&atype=view"><i class="icon-profile"></i> Account Details</a></li>
							<?php if($LEVEL==4){?>
							<?php /* <li class="add_check_btn"><a href="#"><i class="icon-plus22"></i>Activity Feed</a></li> */ ?>
							<li class="add_check_btn"><a href="?action=profile&atype=view#email_notify"><i class="icon-bubble-dots3"></i>Email Notifications</a></li>
							<?php /* <li class="add_check_btn"><a href="#"><i class="icon-plus22"></i>Membership</a></li> */ ?>	
								                               
							<li data-slide="2"><a href="?action=profile&atype=view#billing_contact"><i class="icon-vcard"></i>Billing Contact</a></li>
							<?php /* <li data-slide="2"><a href="#tested"><i class="icon-stats-bars2"></i>Purchases</a></li> */ ?>
							<li data-slide="2"><a href="?action=invlist&atype=add/edit"><i class="icon-newspaper2"></i>Invoices</a></li>
							<?php /* <li data-slide="2"><a href="#tested"><i class="icon-stats-bars2"></i>Linked Accounts</a></li> */ ?>
							<?php } ?>
							
							</ul>
							
						</div>
					</div>
								</div>
								<!-- /sidebar search -->



							</div>
						</div>
		