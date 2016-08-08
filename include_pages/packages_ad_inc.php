<?php
	if(isset($_REQUEST['addPackage']) && is_numeric($_REQUEST['screening'])){
		addPackage($_REQUEST);
	}
	
	if(isset($_REQUEST['op'])){
		if(is_numeric($_REQUEST['pkg'])){
				$isDelt = $db->delete("packages","pkg_id=$_REQUEST[pkg]");	
				if($isDelt){
					echo msg('sec',"Package Deleted Successfully...");
				}else{
					echo msg('err',"Package Deletion Error!");
				}
		}
	}	
?>
<h1>Add Packages</h1>	
<form enctype="multipart/form-data" method="post">
	<table class="cstm">
    	<tr>
        	<td><b>Screening:*</b></td>
        	<td>
            <?php
				$screenings = $db->select("screenings","*");
			?>
                <select class="input req" name="screening" >
                <?php if(!isset($_REQUEST['screening'])){?> 
                	<option value="0" >--Select Screening--</option><?php } ?>
        <?php 	while($screening = mysql_fetch_array($screenings)){?>
                    <option value="<?php echo $screening['sc_id'];?>" <?php if($screening['sc_id']==$_REQUEST['screening']) echo 'selected="selected"'; ?> >
                            <?php echo $screening['sc_name'];?>
                    </option>
        <?php 	} ?>
                </select>
            </td>
        </tr>	
        <tr>
        	<td><b>Check:*</b></td>
        	<td>
            <?php $checks = $db->select("checks","*"); ?>
                <select class="input req" name="check" >
                <?php if(!isset($_REQUEST['check'])){?> <option value="0" >--Select Check--</option><?php } ?>
        <?php 	while($check = mysql_fetch_array($checks)){?>
                        <option value="<?php echo $check['checks_id'];?>" <?php if($check['checks_id']==$_REQUEST['check']) echo 'selected="selected"'; ?> >
								<?php echo $check['checks_title'];?>
                        </option>
        <?php 	} ?>
                </select>
            </td>
        </tr>
        <tr>
        	<td colspan="2">
      			<input class="button btnright" type="submit" name="addPackage" value="Add Package >>" >
            </td>
        </tr>
     </table>
 </form>
 

 <table>
	<thead>
    	<tr>
        	<th >Screenings</th>
            <th>checks</th>
            <th >Actions</th>
        </tr>
    </thead>
    <tbody>
<?php	$packages =getPackage();
		while($package = mysql_fetch_array($packages)){ ?>
    		<tr>
            	<td style="text-align:left;"><?php echo $package['sc_name']; ?></td>
            	<td style="text-align:left;">
                    <?php echo mb_convert_encoding($package['checks_title'], 'HTML-ENTITIES','UTF-8'); ?>
                </td>
                <td>  	
                    <a href="?action=packages&atype=list&op=d&pkg=<?php echo $package['pkg_id']?>">
                        <img src="img/disable.png"  class="dico" title="Delete"  />	
                    </a>
                </td>                
            </tr> 
<?php 	} ?>
	</tbody>
</table>