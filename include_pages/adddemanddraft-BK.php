<?php
	if(!isset($_REQUEST['edit'])) $_REQUEST['edit'] = 0;
	if(!is_numeric($_REQUEST['edit'])) $_REQUEST['edit'] = 0;
	
	$where = "dd_id=$_REQUEST[edit]";
	$parys = array(
					'dd_bcode'=>'bcode',
					'dd_uni'=>'verifying',
					'dd_bene'=>'beneficiary',
					'dd_units'=>'units',
					'dd_fee'=>'famount',
					'dd_vdid'=>'',
					'dd_vdcost'=>'vdcost'
	);
	
	setPost($parys,"dd_data",$where);
	
	if(!is_numeric($_POST['units'])) $_POST['units'] = 1;
	if(!is_numeric($_POST['famount'])) $_POST['famount'] = 0;
	if(!is_numeric($_POST['vdcost'])) $_POST['vdcost'] = 0;
	$_POST['tamount'] =  $_POST['famount'] * $_POST['units'];
	$_POST['vamount'] =  ($_POST['tamount']+$_POST['vdcost']);

?>

<link href="css/chosen.css" type="text/css" rel="stylesheet">
<link href="css/chosen.min.css" type="text/css" rel="stylesheet">


<script type="text/javascript" src="js/chosen.jquery.js"></script>
<script type="text/javascript" >
    	var fee = new Array();
		var ben = new Array();
	<?php

		$unins = $db->select("uni_info","*");
		while($unin = mysql_fetch_assoc($unins)){ ?>
			fee[<?=$unin['uni_id']?>] = <?=$unin['uni_fee']?>;
			ben[<?=$unin['uni_id']?>] = '<?=addslashes($unin['uni_ben'])?>';			
	<?php	} ?>
    
	function calculateVal(){
		var units = document.getElementById('units').value	
		var famount = document.getElementById('famount').value
		var vdcost = document.getElementById('vdcost').value
		
	
		if(!isNaN(units) && !isNaN(famount)) document.getElementById('tamount').value = (units*famount);
		
	}
	
	
	function updatefields(val){
		document.getElementById('beneficiary').value = ben[val];
		document.getElementById('famount').value = fee[val];
		
	}
</script>

  
<form method="post" enctype="multipart/form-data" class="label_side" >

    <div class="box grid_16">
        <h2 class="box_head"><?=$IPAGE['m_actitle']?></h2>
        <a href="#" class="grabber">&nbsp;</a>
        <a href="#" class="toggle">&nbsp;</a>
        <div class="toggle_container">
            <div class="block">
						
                        <input class="req input etitle" title="Input bar code" type="hidden" name="bcode" value="<?=$_POST['bcode']?>" >
                          
                        
                        <fieldset class="label_side">
                            <label>Verifying Authoritys</label>
                            <div>
                                <select name="verifying" class="chosen-select req etitle" title="Select Verifying Authoritys" onchange="updatefields(this.value)" >
                                        <option value="">--Verifying Authority/Beneficiary--</option> <?php 										
                                        $unies = $db->select("uni_info","*","1=1 $SSTR ORDER BY uni_id DESC");
                                        while($unie =mysql_fetch_array($unies)){?>
                                            <option value="<?=$unie['uni_id']?>" <?=($_POST['verifying']==$unie['uni_id'])?'selected="selected"':''?>>
												<?=$unie['uni_Name']?> 
                                            </option>
                                <?php	} ?>
                                </select>
                            </div>
                        </fieldset>
                        
                        <fieldset class="label_side">
                            <label>Beneficiary:</label>
                            <div>
                                <input class="input" type="text" id="beneficiary" name="beneficiary" value="<?=$_POST['beneficiary']?>" >
                            </div>
                        </fieldset>
                        
                        <fieldset class="label_side">
                            <label>Check(s):</label>
                            <div>
                                <select name="tcheck[]" class="chosen-select dd-select req etitle" title="Select checks" multiple="multiple" >
                                        <option value="">--Select check--</option>
                                        <?php 				
										$tabls = "ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id INNER JOIN checks ck ON vc.checks_id=ck.checks_id";						
										if($_REQUEST['edit']!=0){
											$where = "ck.checks_show=1 AND vd.v_isdlt=0 AND vc.as_isdlt=0 LIMIT 10";
										}else{
											$where = "ck.checks_show=1 AND vd.v_isdlt=0 AND vc.as_isdlt=0 AND vc.as_update=0 LIMIT 10";
										}
										
                                        $checks = $db->select($tabls,"*",$where);
                                        while($check =mysql_fetch_array($checks)){
											$com = getcompany($check['com_id']);
											$com = mysql_fetch_assoc($com);
											$selected=false;
											if($_REQUEST['edit']!=0){
												$ddcheck = $db->select('dd_checks',"*","as_id=$check[as_id] AND dd_id=$_REQUEST[edit] AND dc_active=1");
												
												if(mysql_num_rows($ddcheck)>0) $selected = true;
											}?>
                                            <option value="<?=$check['as_id']?>" <?=($selected)?'selected="selected"':''?>>
												<?="#:$check[emp_id] ".$check['v_name']." ($com[name]) $check[checks_title]"?> 
                                            </option>
                                <?php	} ?> 
                                </select>
                            </div>
                        </fieldset>

                                                
						<fieldset class="label_side">
                            <label>Unit(s):</label>
                            <div>
                                <input class="req input etitle" disabled="disabled" 
                                title="Input Unit(s)" type="text" id="tunits" name="tunits" value="<?=$_POST['units']?>" >
                                
                                <input type="hidden" id="units" name="units" value="<?=$_POST['units']?>" >
                            </div>
                        </fieldset>
                        
						<fieldset class="label_side">
                            <label>Fee Amount:</label>
                            <div>
                                <input class="req input etitle" title="Input fee amount" onchange="calculateVal()" id="famount" type="text" name="famount" value="<?=$_POST['famount']?>" >
                            </div>
                        </fieldset>

                        
						<fieldset class="label_side">
                            <label>Total Amount:</label>
                            <div>
                                <input disabled="disabled" type="text" id="tamount" name="tamount" value="<?=$_POST['tamount']?>" >
                            </div>
                        </fieldset>
                        
    
                        <input  type="hidden" id="vdcost" name="vdcost" value="<?=$_POST['vdcost']?>" onchange="calculateVal()" >

                        
					
                        <fieldset class="label_side">
                            <label >Status:</label>
                            <div>
                            <select name="status" class="select_box " >
                                    <?php if($LEVEL==6){?>
                                    <option value="2" <?=($_POST['status']==2)?'selected="selected"':''?>>Paid</option>
                                    <option value="3" <?=($_POST['status']==3)?'selected="selected"':''?>>Returned</option>
                                    <?php }else{ ?>
                                    <option value="0" <?=($_POST['status']==0)?'selected="selected"':''?>>Draft</option>
                                    <option value="1" <?=($_POST['status']==1)?'selected="selected"':''?>>Send to Finance</option>
									<?php }?>
                            </select>
                            </div>
                        </fieldset>

                <?php if($_REQUEST['edit']!=''){?>
                 <input type="hidden" name="edit" value="<?=$_REQUEST['edit']?>"  /> 
                <?php }?> 
                <div class="button_bar clearfix">
                    <button name="adddemanddraft" type="submit" class="btnright div_icon has_text text_only">
                        <span><?=($_REQUEST['edit']!=0)?'Save':$IPAGE['m_actitle']?></span>
                    </button>                       
                </div>      
            </div>
        </div>
    </div>


</form>

<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
	
	
	$(".dd-select").chosen().change(function() {
		var data = $(this).val();
		console.log(data);		
		document.getElementById('tunits').value = data.length;
		document.getElementById('units').value = data.length;
		calculateVal();
	});

/*$('.chosen-choices input').autocomplete({
  source: function( request, response ) {
    $.ajax({
      url: "jason.php?term="+request.term+"/",
      dataType: "json",
      beforeSend: function(){$('ul.chosen-results').empty();},
      success: function( data ) {
		//var JSON = jQuery.parseJSON(data);
        response( $.map( data, function( item ) {
          $('ul.chosen-results').append('<li class="active-result">' + item.name + '</li>');
        }));
		
      }
    });
  }
});*/

  </script>