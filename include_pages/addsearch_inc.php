<?php
if(isset($_REQUEST['edur'])){
	if(is_numeric($_REQUEST['s_id'])){
		enabdisb("search","s_id=$_REQUEST[s_id]");
	}
}

if(isset($_REQUEST['edit'])){
	if(is_numeric($_REQUEST['s_id'])){
		$info = getInfo("search","s_id=".$_REQUEST['s_id']);
		$_REQUEST['s_table'] = $info['s_table'];
		$_REQUEST['s_fields']  = $info['s_fields'];
		$_REQUEST['s_title']  = $info['s_title'];
	}
}
?>

    <div class="box grid_16">
                        <h2 class="box_head"><?=isset($_REQUEST['s_id'])?'Edit':'Add'?> Search</h2>
                        <a href="#" class="grabber">&nbsp;</a>
                        <a href="#" class="toggle">&nbsp;</a>
                        <div class="toggle_container" <?php if(isset($_REQUEST['edit'])){}else{ echo 'style="display:none;"';} ?>>	
    <form class="cstm" name="" method="post" >
  				
								<fieldset class="label_side">
									<label>Tabel Name:</label>
									<div>
										<input class="input" type="text" name="s_table" value="<?=$_REQUEST['s_table']?>" >
									</div>
								</fieldset>
       							<fieldset class="label_side">
									<label>Fields:</label>
									<div>
										<input class="input" type="text" name="s_fields" value="<?=$_REQUEST['s_fields']?>" >
									</div>
								</fieldset>
       							<fieldset class="label_side">
									<label>Field Title:</label>
									<div>
										<input class="input" type="text" name="s_title" value="<?=$_REQUEST['s_title']?>" >
									</div>
								</fieldset>
       							
                <?php if(is_numeric($_REQUEST['s_id'])){ ?>
                	<input type="hidden" name="s_id" value="<?=$_REQUEST['s_id']?>"  />
                <?php } ?>
                	
					<button type="submit" class=" div_icon has_text" style="float:right;" name="addsearch" >	    
                            <span><?=isset($_REQUEST['s_id'])?'Edit':'Add'?> Search</span>
                     </button>
    </form>
</div>
</div>
</div>

<div id="main_container" class="main_container container_16 clearfix">
<div class="box grid_16 tabs">		
        <h2 class="box_head">Search Listing</h2>
        <a href="#" class="grabber">&nbsp;</a>
        <a href="#" class="toggle">&nbsp;</a>
        <div class="toggle_container">
            <div class="block">
             <div id="dt2">
<table class="display datatable">
        <thead>
            <tr>
                <th>Search Table</th>
                <th>Fields</th>
                <th>Fields Title</th>
               <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    <?php	$searches= $db->select("search","*");
            if(mysql_num_rows($searches)>0){
            while($search = mysql_fetch_array($searches)){ ?>
                <tr>
                    <td><?=$search['s_table']?></td>
                    <td style="text-align:left"><?=$search['s_fields']?></td>
                   
                    <td><?=$search['s_title']?></td>
                    <td align="center">
						<?php  if($search['is_active']==1) {
                                  $img="accept.png";
                                    $tit="Disable"; 
                                }else{
                                     $img="cog_4.png";
                                     $tit="Enable";
                                } 
                                $link="s_id=$search[s_id]";
                        ?>
              <a href="javascript:void(0)" >                  <img onclick="submitLink('<?=$link?>&edur')" src="images/icons/small/grey/<?=$img?>" class="edits" title="<?=$tit?>"  />	</a>
                     <a href="javascript:void(0)" >           <img onclick="submitLink('<?=$link?>&edit')" src="images/icons/small/grey/edit-icon.png"  class="edits" title="Edit"  /></a>
                    </td>
                </tr>	    
        <?php }} ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>