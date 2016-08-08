 <?php 
	if(isset($_SESSION['user_id'])){
		 include('include_pages/user_tools_inc.php'); 
    } 
?>
<div class="footer bradius" <?php if(isset($_SESSION['user_id'])){ ?>style="margin-bottom:35px;" <?php } ?>>
    <ul class="sbld">
        <li><a href="">Privacy Policy</a></li>
        <li><a href="">Terms of Use</a></li>
        <li><a href="<?php echo SURL; ?>">Home</a></li>
    </ul>
</div>
<script type="text/javascript">
	document.onload = loadTitle();
</script>
