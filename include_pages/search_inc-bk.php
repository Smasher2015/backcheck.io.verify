<?php
	if(isset($_SESSION['slink'])){ 
		$tAction=$_SESSION['slink'];
		$taType=$_SESSION['stype'];
	}else{
		if($LEVEL==4){
			$_SESSION['stite'] = "Close Case(s)";
			$tAction="close";
			$taType="history";
		}else{
			$_SESSION['stite'] = "Assigned Check(s)";
			$tAction="assigned";
			$taType="case";
		}
	}

	if($action=='unies'){
		$dfTitle = "Search By [ $_SESSION[stite] ]";
		$searchStr  = isset($_REQUEST['search_str'])?$_REQUEST['search_str']:$dfTitle;
	}else{
		$dfTitle = "Enter Your Search [ ID / Name ]";
		$searchStr  = isset($_REQUEST['search_str'])?$_REQUEST['search_str']:$dfTitle;	
	}
	
?>

<div style="margin-bottom:5px;"> 
    <div class="searchFrm">
    <form name="search_frm" enctype="multipart/form-data" method="post" style="padding-bottom:0" action="/?action=<?=$tAction?>&atype=<?=$taType?>" >
        <input class="req auto title" type="text" size="40" name="search_str" title="<?=$dfTitle?>" value="<?=$searchStr?>" />
        <?php if(is_numeric($_REQUEST['alstid'])){ ?>
        <input type="hidden" name="alstid" value="<?=$_REQUEST['alstid']?>" />
        <?php } ?>
        <?php if(is_numeric($_REQUEST['clntid'])){ ?>
        <input type="hidden" name="clntid" value="<?=$_REQUEST['clntid']?>" />
        <?php } ?>
        <input type="submit" name="search_btn" value="Search" class="button" />   
    </form>
    </div>
        
    <?php if($CURRENT && ($LEVEL!=4) && $action!='unies' && $action!='project' && $action!='company'){ ?>
        <div class="filters">
            <form enctype="multipart/form-data" method="post" style="padding-bottom:0" >
                <?php 
			if($LEVEL==2){
				if($action!='assign' && $action!='case'){?>
                <select name="alstid" >
                        <option value="">--Analyst [ All ]--</option>
            <?php 	$db = new DB();
					$anid = (isset($_REQUEST['alstid']))?$_REQUEST['alstid']:0;
                    $users = $db->select("users","*","is_active=1 AND level_id=3");
                    while($user =mysql_fetch_array($users)){  ?>
                        <option value="<?=$user['user_id']?>" <?php echo ($user['user_id']==$anid)?'selected="selected"':'';?>>
                            <?=trim($user['first_name'].' '.$user['last_name'])?>
                        </option>
           <?php } } ?>
                </select>
          <?php }  ?>
                <select name="clntid" >
                        <option value="">--Client [ All ]--</option>
            <?php 	$db = new DB();
                    $coms = $db->select("company","*","is_active=1");
					$coid = (isset($_REQUEST['clntid']))?$_REQUEST['clntid']:0;
                    while($com =mysql_fetch_array($coms)){  ?>
                        <option value="<?=$com['id']?>" <?php echo ($com['id']==$coid)?'selected="selected"':'';?>>
							<?=$com['name']?>
                        </option>
            <?php	} ?>
                </select>
                <input type="submit" name="filter_btn" value="Filter" class="button" />
            </form>
        </div>
    <?php } ?>
    <div class="clear" ></div>
</div>
<?php
	$SSTR='';
	if(isset($_REQUEST['search_str'])){
		$_REQUEST['search_str']=trim($_REQUEST['search_str']);
		if($_REQUEST['search_str'] !=$dfTitle && $_REQUEST['search_str']!=''){
			if($action=='unies'){
				$SSTR = "AND uni_Name LIKE '%$_REQUEST[search_str]%'";
			}else{
				if(is_numeric($_REQUEST['search_str'])){
					$SSTR = "AND d.emp_id=$_REQUEST[search_str]";
				}else{
					$SSTR = "AND d.v_name LIKE '%$_REQUEST[search_str]%'";
				}
			}
		}
	}

	if($LEVEL!=4){	
		if(is_numeric($_REQUEST['clntid'])){
			$SSTR.= " AND p.id=$_REQUEST[clntid]";
		}	
	}

	if($LEVEL==2){
		if(is_numeric($_REQUEST['alstid'])){
			$SSTR.=" AND c.user_id=$_REQUEST[alstid]";
		}		
	}
	
?>

<?php include("include_pages/shorts_lks_inc.php"); ?>