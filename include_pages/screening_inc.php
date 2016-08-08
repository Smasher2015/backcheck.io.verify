<?php
    $screening = $db->select("screenings","*","sc_id=".$_REQUEST['screening']);
    $screening = mysql_fetch_array($screening); ?>
<div class="innerdiv">
     <h2 class="head-alt"><?php echo $screening['sc_name']; ?></h2>
        <div class="innercontent">
    <p style="margin-bottom:10px;">
		<?php echo mb_convert_encoding($screening['sc_desc'], 'HTML-ENTITIES','UTF-8'); ?>
    </p>
<?php
	if(isset($_REQUEST['subPackage'])){
		if(isset($_SESSION['user_id'])){
			$isSub = subPackage($_REQUEST);
		}
	}
	
if(isset($_REQUEST['subcontactus'])){
	$_REQUEST['_id'] = $_REQUEST['screening'];	
	addComments($_REQUEST,"screening");
}
	
	if(!isset($_REQUEST['subPackage'])){ ?>    
    <div class="nstyle">
        <h4 class="subHdr">
        	<?php if(isset($_SESSION['user_id'])) $rqQuotes = "submitFrm('package')"; else $rqQuotes = "LoadBoxs('User Login','login')";?>
        	<a href="javascript:void(0);" onclick="<?php echo $rqQuotes;?>">[ Get Price Quotes ]</a>
            <a href="javascript:void(0);" style="margin-left:30px;" onclick="showAjax('contactus','Contact Us','infp=1')">
            	[ Contact Us ]
            </a>	
            <div class="rpImgs">
                <a target="_blank" title="View Sample Report" href="sample_report.php"><img  src="img/samplebutic.png"  /></a>
            </div>
        </h4>
        <form method="post" name="package" enctype="multipart/form-data" onsubmit="return subPackage('package')">
            <ul class="pkgs nt">
            <?php 	$packages = $db->select("packages pkg INNER JOIN checks chk ON pkg.checks_id= chk.checks_id","*","pkg.sc_id=".$screening['sc_id']); 
                    while($package =mysql_fetch_array($packages)){ ?>		
                        <li>
                            <input type="checkbox" name="checks[]" value="<?php echo $package['checks_id']; ?>" id="id<?php echo $package['checks_id']; ?>" />
                            <label for="id<?php echo $package['checks_id']; ?>">
                                <?php echo $package['checks_title']; ?>
                            </label>
                            <div class="rpImgs">
                                <a href="javascript:viod(0);" title="View Info" onclick="showAjax('sample','Demo Report Information','infp=1')">
                                    <img  src="img/infobutic.png"  />
                                </a>
                            </div>
                            <div  class="rpImgs">
                                <?php echo $package['checks_wdays']; ?> 
                            </div>
                            <div class="clear"></div>
                        </li>
            <?php  }?>
            </ul>      
            <input type="hidden" name="subPackage" value="1"  /> 
        </form>  
    </div>	
<?php }else{
		  if($isSub){ ?>
			<h1 align="center">Thanks, we will get back to you shortly</h1>
	<?php } 
}?>	
</div>
</div>