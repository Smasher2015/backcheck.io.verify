<?php if($ISRCH){ ?>
    <div style="margin-bottom:5px;"> 
        <div class="searchFrm">
        <?php 
			$tLink = "?action=$ISRCH[m_action]".(($ISRCH['m_atype']!='')?"&atype=$ISRCH[m_atype]":"");
			$srStr = (isset($_REQUEST['search_str']))?$_REQUEST['search_str']:$ISRCH['s_title'];
		?>
        <form name="search_frm" enctype="multipart/form-data" method="post" action="<?=$tLink?>" >
            <input class="req auto title" type="text" size="40" name="search_str" title="<?=$ISRCH['s_title']?>" value="<?=$srStr?>" />
            <input type="submit" name="search_btn" value="Search" class="button" />   
        </form>
        </div>        
        <div class="clear" ></div>
    </div>
<?php } ?>