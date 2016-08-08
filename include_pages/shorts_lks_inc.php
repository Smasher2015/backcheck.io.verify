<div class="slinks">
	<?php $sLinks = shortLinks();
		  if($sLinks){
				for($ind=(count($sLinks)-1);0<=$ind;$ind--){ 
					$sLink=$sLinks[$ind];
					$link="?action=$sLink[m_action]".(($sLink['m_atype']!='')?"&atype=$sLink[m_atype]":"");
					$isCur = (($ACTION==$sLink['m_action'] && $ATYPE==$sLink['m_atype']) && $SSTR==''); ?>
					<a href="<?=$link?>" class="<?=($isCur)?'current':''?>">
					<?="$sLink[m_actitle] $sLink[m_attitle]"?>
                    </a>
	<?php	}			
	      }?>
    <?php if($SSTR!=''){
			$link="?action=$IPAGE[m_action]".(($IPAGE['m_atype']!='')?"&atype=$IPAGE[m_atype]":"");?>
            <a href="<?=$link?>&search_str=<?=$_REQUEST['search_str']?>" class="current">
            	<?=$_REQUEST['search_str']?>
            </a>
    <?php } ?>            
    <div class="clear"></div>
</div>