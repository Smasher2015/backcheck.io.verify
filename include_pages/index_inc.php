<section role="main">
	<div style="min-height:163px;">
		<?php include("widget.php"); ?>
        <?php include("include_pages/search_inc.php");?>
		<div class="clearfix"></div>
	</div>
    <?php include("include_pages/shorts_lks_inc.php"); ?>
    <span id="msgs">
	<?php
        if($_REQUEST['CNT']==1){
            if($_REQUEST['ERR']!='') echo $_REQUEST['ERR'];
            if($_REQUEST['SCS']!='') echo $_REQUEST['SCS'];
        }
    ?>    
    </span>
	<?php	
		if(!$IPAGE) $IPAGE['m_include']="access_inc.php";
		include("include_pages/$IPAGE[m_include]");
	?>
</section>
<?php include("right.php"); ?>