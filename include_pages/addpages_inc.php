<?php
if(isset($_REQUEST['edur'])){
	if(is_numeric($_REQUEST['pid'])){
		enabdisb("menus2","m_id=$_REQUEST[pid]");
	}
}

if(isset($_REQUEST['edit'])){
	if(is_numeric($_REQUEST['pid'])){
		$data = getInfo('menus2',"m_id=$_REQUEST[pid]");
		$_REQUEST['search']  = $data['s_id'];
		$_REQUEST['ppage']  = $data['m_pid'];
		$_REQUEST['doptn']  = $data['m_lrb'];
		$_REQUEST['aname']  = $data['m_action'];
		$_REQUEST['actyp']  = $data['m_atype'];
		$_REQUEST['atitl']  = $data['m_actitle'];
		$_REQUEST['ttitl']  = $data['m_attitle'];
		$_REQUEST['ifile']  = $data['m_include'];
		$_REQUEST['mdisc']  = $data['m_mdesc'];
		$_REQUEST['mkeyw']  = $data['m_mkeyw'];
		$_REQUEST['dodr']	= $data['m_odr'];
		$_REQUEST['m_img']	= $data['m_img'];
	}
}
?>
<div class="report-sec">
                     <div class="page-header">
            <div class="page-header-content">
                <div class="page-title3">
                	<h2><?=(isset($_REQUEST['pid']))?'Edit':'Add'?> Pages</h2>
        </div></div></div>
  <div class="panel panel-default panel-block">
    <div>
	
                        <div class="toggle_container panel-body" <?php //if(isset($_REQUEST['edit'])){}else{ echo 'style="display:none;"';} ?>>
    <form class="cstm" name="" method="post" >
           <div class="col-md-6">
            <fieldset class="form-group">
                <label>Parent Page:</label>
                <div>
                         	<select class="input form-control" name="ppage">
                    	<option value="0" <?php if(!isset($_REQUEST['ppage'])) echo 'selected="selected"'; ?> >---Parent---</option>
                        <?php
						$menus= $db->select("menus2","*","is_active=1");
						if(mysql_num_rows($menus)>0){
							while($menu = mysql_fetch_array($menus)){ ?>
                        		<option value="<?=$menu['m_id']?>" 
									<?php if(isset($_REQUEST['ppage'])) if($menu['m_id']==$_REQUEST['ppage']) echo 'selected="selected"'; ?>>
									<?="$menu[m_actitle] $menu[m_attitle]" ?>
                                </option>
                        <?php }
						} ?>
                    </select>
       
                </div>
            </fieldset>
            </div>
            <div class="col-md-6">
               <fieldset class="form-group">
                <label>Add Search:</label>
                <div>
           	<select class="input form-control" name="search">
                    	<option value="0" <?php if(!isset($_REQUEST['search'])) echo 'selected="selected"'; ?> >---Search---</option>
                        <?php
						$searches= $db->select("search","*","is_active=1");
						if(mysql_num_rows($searches)>0){
							while($serch = mysql_fetch_array($searches)){ ?>
                        		<option value="<?=$serch['s_id']?>" 
									<?php if(isset($_REQUEST['search'])) if($serch['s_id']==$_REQUEST['search']) echo 'selected="selected"'; ?>>
									<?="$serch[s_title]" ?>
                                </option>
                        <?php }
						} ?>
                    </select>
       
                </div>
            </fieldset>
            </div>
           	<div class="col-md-6">
            <fieldset class="form-group">
                <label>Display Page:</label>
                <div>
                  	<select class="input form-control" name="doptn">
                        		<option value="0" <?=($_REQUEST['doptn']==0)?'selected="selected"':''?> >---Display All Side--</option>
                                <option value="-1" <?=($_REQUEST['doptn']==-1)?'selected="selected"':''?> >Hide</option>
                                <option value="1" <?=($_REQUEST['doptn']==1)?'selected="selected"':''?> >Top</option>
                                <option value="2" <?=($_REQUEST['doptn']==2)?'selected="selected"':''?> >Left</option>
                    </select>
       
                </div>
            </fieldset>
            </div>
              <div class="col-md-6">
              <fieldset class="form-group">
                <label>Action:</label>
                <div>
            <input class="input form-control" type="text" name="aname" value="<?=$_REQUEST['aname']?>" >
       
                </div>
            </fieldset>
            </div>
             <div class="col-md-6">
             <fieldset class="form-group">
                <label>Type:</label>
                <div>
       <input class="input form-control" type="text" name="actyp" value="<?=$_REQUEST['actyp']?>" >
       
                </div>
            </fieldset>
            </div>                                 
            <div class="col-md-6">
            <fieldset class="form-group">
                <label>Action Title:</label>
                <div>
           <input class="input form-control" type="text" name="atitl" value="<?=$_REQUEST['atitl']?>" >
       
                </div>
            </fieldset>
            </div>
             <div class="col-md-6">                                
             <fieldset class="form-group">
                <label>Type Title:</label>
                <div>
          <input class="input form-control" type="text" name="ttitl" value="<?=$_REQUEST['ttitl']?>" >
       
                </div>
            </fieldset>
            </div>
            <div class="col-md-6">
            <fieldset class="form-group">
                <label>Filename:</label>
                <div>
           <input class="input form-control" type="text" name="ifile" value="<?=$_REQUEST['ifile']?>" >
       
                </div>
            </fieldset>
            </div>
            <div class="col-md-6">
            <fieldset class="form-group">
                <label>Meta Desc:</label>
                <div>
            <input class="input form-control" type="text" name="mdisc" value="<?=$_REQUEST['mdisc']?>" >
       
                </div>
            </fieldset>
            </div>
            <div class="col-md-6">
            <fieldset class="form-group">
                <label>Meta keywords:</label>
                <div>
            	<input class="input form-control" type="text" name="mkeyw" value="<?=$_REQUEST['mkeyw']?>" >
       
                </div>
            </fieldset>
            </div>
            <div class="col-md-6">
            <fieldset class="form-group">
                <label>Display Order:</label>
                <div>
            	<input class="input form-control" type="text" name="dodr" value="<?=$_REQUEST['dodr']?>" >
       
                </div>
            </fieldset>
            </div>
            <div class="col-md-6">
            
            <fieldset class="form-group">
                <label>Icon Class:</label>
                <div>
            	<input class="input form-control" type="text" name="m_img" value="<?=$_REQUEST['m_img']?>" >
       
                </div>
                
            </fieldset>
            </div>
            
            <div class="col-md-12">
                      <fieldset class="form-group">
   
                <div>
            <?php if(is_numeric($_REQUEST['pid'])){ ?>
                	<input type="hidden" name="pid" value="<?=$_REQUEST['pid']?>"  />
                <?php } ?>
                	<button  class="btn btn-success btn-labeled" style="float:right; margin-top:10px;" type="submit" name="addpage" value="<?=isset($_REQUEST['pid'])?'Edit':'Add'?> Page" >
                    	<b><i class="<?=isset($_REQUEST['pid'])?'icon-pencil':'icon-plus2'?>"></i></b>
											<?=isset($_REQUEST['pid'])?'Edit':'Add'?> Page
       </button>
                </div>
            </fieldset>
             </div>
                 
            </form>
            
            
                        </div>
                        </div>
		</div>
        
        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title3">
        <h2 class="box_head">Pages Listing</h2>
        </div>
        </div>
        </div>
        <div class="panel panel-default panel-block">
       <div class="">
	    <div class="panel-body">
                        <a href="#" class="grabber">&nbsp;</a>
                        <a href="#" class="toggle">&nbsp;</a>
                        <div class="toggle_container"> 
              <div class="block">
             <div id="dt2">  

   <table class="table datatable-basic table-hover dataTable" id="tableSortable" aria-describedby="tableSortable_info">
        <thead>
            <tr class="full">
              <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="tableSortable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Title: activate to sort column descending" style="width: 111px;">Title</th>
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="tableSortable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Title: activate to sort column descending" style="width: 111px;">Page</th>
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="tableSortable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Title: activate to sort column descending" style="width: 111px;">Meta Description</th>
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="tableSortable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Title: activate to sort column descending" style="width: 111px;">Meta Keywords</th>
                 <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="tableSortable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Title: activate to sort column descending" style="width: 111px;">Actions</th>
            </tr>
        </thead>
        <tbody>
    <?php	$datas= $db->select("menus2","*");
            if(mysql_num_rows($datas)>0){
            while($data = mysql_fetch_array($datas)){ ?>
                <tr>
                  <td><?=trim($data['m_actitle']." ".$data['m_attitle'])?></td>
                    <td style="text-align:left"><?=$data['m_include']?></td>
                    <td><?=$data['m_mdesc']?></td>
                    <td><?=$data['m_mkeyw']?></td>
                    <td>
						<?php  if($data['is_active']==1) {
                                    $img="icon-blocked";
                                    $tit="Disable"; 
                                }else{
                                     $img="icon-check";
                                     $tit="Enable";
                                } 
                                $link="pid=$data[m_id]";
                        ?>
    
    
        <ul class="icons-list">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="icon-menu9"></i>
                </a>
        
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="javascript:void(0)" onclick="submitLink('<?=$link?>&edit')"><i class="icon-pencil5"></i> Edit</a></li>     
                    <li><a href="javascript:void(0)" onclick="submitLink('<?=$link?>&edur')"><i class="<?=$img?>"></i> <?=$tit?></a></li>
                   
                    
                </ul>
            </li>
        </ul>
    
    				

                    </td>
                </tr>	    
        <?php }}?>
        </tbody>
    </table>
    <div class="clear"></div>
    </div>
    </div>
</div>
</div>
</div>
</div>
</div>