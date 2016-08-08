<link rel="stylesheet" href="dbmenu_files/mbcsmbdbmenu.css" type="text/css" />

<div id="header-top">

	<div style="width:980px; margin:auto; height:80px;">
        <div style=" float:left;padding-top:10px;">
            <a href="<?php echo SURL; ?>"><img src="img/logo.png" /></a>
        </div>
	
    	<div style="padding-top:15px;   float:right;">
			<ul id="ebul_mbdbmenu_2" class="ebul_mbdbmenu" style="display: none; width:320px;">
				<li><a href="<?php echo SURL; ?>billing.php" title="" >Invoices</a></li>
				<li></li>
				<li><a href="<?php echo SURL; ?>billing-transaction.php" title="">Transactions</a></li>
				<li></li>
				<li><a href="<?php echo SURL; ?>search-history.php" title="">My Searches</a></li>
				<li></li>
				<li><a href="<?php echo SURL; ?>profile.php" title="">My Account</a></li>
			</ul>
			<ul id="ebul_mbdbmenu_3" class="ebul_mbdbmenu" style="display: none; width:100px;">
				<li><a href="<?php echo SURL; ?>add-ticket.php" title="">Open New Ticket</a></li>
				<li></li>
				<li><a href="<?php echo SURL; ?>support.php" title="">Support Center</a></li>
				<li></li>
				<li><a href="<?php echo SURL; ?>feedback.php" title="">Feedback</a></li>
			</ul>
			<ul id="ebul_mbdbmenu_4" class="ebul_mbdbmenu" style="display: none; width:240px;">
				<li><a href="<?php echo SURL; ?>aboutus.php" title=""  target="_blank">About Us</a></li>
				<li></li>
				<li><a href="<?php echo SURL; ?>contact.php" title=""  target="_blank">Contact Us</a></li>
				<li></li>
                <li><a href="<?php echo SURL; ?>psl.php" title=""  target="_blank">Sources</a></li>
				<li></li>
                <?php if(isset($_SESSION['user_id'])) $aLog="logout"; else $aLog="login"; ?>
				<li><a href="<?php echo SURL."?action=$aLog"; ?>" title=""><?php echo ucwords($aLog); ?></a></li>
			</ul>
			<ul id="mbdbmenuebul_table" class="mbdbmenuebul_menulist" style="width: 487px; height: 47px;">
  				<li class="spaced_li">
  					<a href="<?php echo SURL; ?>?action=dashboard">
        				<img id="mbi_mbdbmenu_1" src="dbmenu_files/mb_dashboard.png" name="mbi_mbdbmenu_1" width="121" height="47" style="vertical-align: bottom;" border="0" alt="Dashboard"/>
        			</a>
  				</li>
  				<li class="spaced_li" >
                    <a href="<?php echo SURL; ?>?action=billing">
                        <img id="mbi_mbdbmenu_2" src="dbmenu_files/mb_billing.png" name="mbi_mbdbmenu_2" width="122" height="47" style="vertical-align: bottom;" border="0" alt="Billing" title=""  />
                    </a>
  				</li>
               	<li class="spaced_li">
                    <a href="javascript:void(0)">
                        <img id="mbi_mbdbmenu_3" src="dbmenu_files/mb_support.png" name="mbi_mbdbmenu_3" width="122" height="47" style="vertical-align: bottom;" border="0" alt="Support" title=""  />
                    </a>
               	</li>
              	<li>
                    <a href="javascript:void(0)">
                        <img id="mbi_mbdbmenu_4" src="dbmenu_files/mb_menu.png" name="mbi_mbdbmenu_4" width="122" height="47" style="vertical-align: bottom;" border="0" alt="Menu" />
                    </a>
              	</li>
			</ul>
		</div>
   	</div>
</div>
<script type="text/javascript">
function showMenu(divID,img){
	document.getElementById(divID).src ='dbmenu_files/'+img;
	
}
</script>
<script type="text/javascript" src="dbmenu_files/mbjsmbdbmenu.js"></script>


