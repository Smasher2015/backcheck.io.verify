<section role="main">
	<div style="min-height:163px;">
		<?php include("widget.php"); ?>
		<div class="clearfix"></div>
	</div>
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