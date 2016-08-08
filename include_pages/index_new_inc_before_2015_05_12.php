<div id="main_container" class="main_container container_16 clearfix">
		<?php include('includes/navigation.php');?>
		<div>
        	<ul class="breadcrumb clearfix">
            	<li class="first">
                	<a href="?action=dashboard">Dashboard</a>   
                </li>
				<?php 
				if($IPAGE){
				$sLinks = shortLinks();
                      if($sLinks){
                            for($ind=(count($sLinks)-1);0<=$ind;$ind--){ 
                                $sLink=$sLinks[$ind];
								if($sLink['m_brdm']=='0'){
                                $link="?action=$sLink[m_action]".(($sLink['m_atype']!='')?"&atype=$sLink[m_atype]":"");
								if($sLink['m_prm']!=''){
									$parms = explode('|',$sLink['m_prm']);
									foreach($parms as $parm){$link="$link&$parm=".$_REQUEST[$parm];}
								} //$isCur = (($ACTION==$sLink['m_action'] && $ATYPE==$sLink['m_atype']) && $SSTR==''); ?>
                                <li>
                                    <a href="<?=$link?>">
                                    	<?=str_ireplace('/ Edit','',"$sLink[m_actitle] $sLink[m_attitle]");?>
                                    </a>
                                </li>
                <?php			}
							}			
                      }}?>
                <?php if(isset($_REQUEST['edit'])){?>
                      	<li>
                            <a href="javascript:void()">
                                <?=ucwords("$action Edit")?>
                            </a>
                        </li>
                <?php } ?>
                <?php if(is_numeric($_REQUEST['clntid'])){
						$company = getcompany($_REQUEST['clntid']);
						$company = mysql_fetch_assoc($company)?>
                      	<li>
                            <a href="javascript:void()" onclick="submitLink('clntid=<?=$_REQUEST['clntid']?>')">
                                <?=$company['name']?>
                            </a>
                        </li>
                <?php } ?>                
                <?php if(isset($_REQUEST['sstr']) && $_REQUEST['sstr']!='Search by Candidate Name / ID#'){?>
                      	<li>
                            <a href="javascript:void()">
                                <?=$_REQUEST['sstr']?>
                            </a>
                        </li>
                <?php } ?>                
            </ul>
            <div class="clear"></div>
        </div>

<?php if($_REQUEST['CNT']==1){
            if($_REQUEST['TERR']!='') { 
            foreach($_REQUEST['TERR'] as $ERR){?>
                <div class="alert dismissible alert_red">
                    <img height="24" width="24" src="images/icons/small/white/alert.png">
                    <?=$ERR?>
                    <div class="clearfix"></div>
                </div>
    <?php 	}}
            if($_REQUEST['TSCS']!='') { 
            foreach($_REQUEST['TSCS'] as $SCS){?>
                <div class="alert dismissible alert_green">
                    <img height="24" width="24" src="images/icons/small/white/cog_3.png">
                    <?=$SCS?>
                    <div class="clearfix"></div>
                </div>
    <?php 	}}		
    } 
	?>    
    
	<?php 
			if(!$IPAGE) $IPAGE['m_include']="access_inc.php";
			include("include_pages/$IPAGE[m_include]");
	?>
</div> 