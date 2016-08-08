<?php
	$dataflow = true;
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
					'dd_vdcost'=>'vdcost',
					'dd_dataflow'=>'dataflow',
					'dd_att1'=>'att1',
					'dd_tit1'=>'tit1',
					'dd_att2'=>'att2',
					'dd_tit2'=>'tit2',
					'dd_att3'=>'att3',
					'dd_tit3'=>'tit3',					
					
	);
	
	setPost($parys,"dd_data",$where);
	if($_POST['dataflow']==1) $dataflow = true;
	if(!is_numeric($_POST['units'])) $_POST['units'] = 1;
	if(!is_numeric($_POST['famount'])) $_POST['famount'] = 0;
	if(!is_numeric($_POST['vdcost'])) $_POST['vdcost'] = 0;
	$_POST['tamount'] =  $_POST['famount'] * $_POST['units'];
	$_POST['vamount'] =  ($_POST['tamount']+$_POST['vdcost']);
	if($LEVEL==9) $dataflow = true;
?>
<link href="css/chosen.css" type="text/css" rel="stylesheet">
<link href="css/chosen.min.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="js/chosen.jquery.js"></script>
<script type="text/javascript" >
    	var fee = new Array();
		var ben = new Array();
		var nam = new Array();
		var chr = new Array();
	<?php

		$unins = $db->select("uni_info","*");
		while($unin = mysql_fetch_assoc($unins)){ ?>
			fee[<?=$unin['uni_id']?>] = <?=$unin['uni_fee']?>;
			ben[<?=$unin['uni_id']?>] = '<?=addslashes($unin['uni_ben'])?>';
			chr[<?=$unin['uni_id']?>] = '<?=addslashes($unin['uni_vchar'])?>';
			nam[<?=$unin['uni_id']?>] = '<?=addslashes($unin['uni_vendor'])?>';			
	<?php	} ?>
    
	function calculateVal(){
		var units = document.getElementById('units').value	
		var famount = document.getElementById('famount').value
		var vdcost = document.getElementById('vdcost').value
		
		famount = parseInt(famount)+parseInt(vdcost);
		
		if(!isNaN(units) && !isNaN(famount)) document.getElementById('tamount').value = (units*famount);
		
	}
	
	
	function updatefields(val){
		document.getElementById('beneficiary').value = ben[val];
		document.getElementById('famount').value = fee[val];
		
		document.getElementById('vdcost').value = chr[val];
		document.getElementById('vendor').value = nam[val];
		calculateVal();
		
	}
</script>
<section class="retracted scrollable">
  <div class="row">
    <div class="col-md-12">
      <div class="manager-report-sec">
        <div class="page-section-title">
          <h2 class="box_head">
            <?=$IPAGE['m_actitle']?>
          </h2>
        </div>
        <div class="panel panel-default panel-block">
          <div class="list-group">
            <div class="list-group-item">
              <form method="post" enctype="multipart/form-data" class="label_side form-horizontal" >
              
                <?php if($dataflow){?>
                <div class="form-group">
                  <div class="col-md-3">
                    <h3>Client Name</h3>
                  </div>
                  <div class="col-md-9">
                    <h3>BCG</h3>
          <div class="col-md-9">
                    <select name="dataflow">
                     <option value="0" <?=($LEVEL==3?'selected':'')?>>Local</option>
                     <option value="1" <?=($LEVEL==11 || $LEVEL==13 || $LEVEL==10?'selected':'')?>>Dataflow</option>
                     
                    </select>
                  </div>
                   
                  </div>
                </div>
                <?php }?>
                <div class="form-group">
                  <div class="col-md-3">
                    <label>Barcode:</label>
                  </div>
                  <div class="col-md-9">
                    <input class="req input form-control" title="Input bar code" maxlength="22" type="text" name="bcode" value="<?=$_POST['bcode']?>" >
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                    <label class="control-label">Verifying Authority</label>
                  </div>
                  <div class="col-md-9">
                    <select name="verifying" class="select chosen-select req" title="Select Verifying Authoritys" onchange="updatefields(this.value)" >
                      <option value="">--Verifying Authority/Beneficiary--</option>
                      <?php 										
                                        $unies = $db->select("uni_info","*","1=1 $SSTR ORDER BY uni_Name");
                                        while($unie =mysql_fetch_array($unies)){?>
                      <option value="<?=$unie['uni_id']?>" <?=($_POST['verifying']==$unie['uni_id'])?'selected="selected"':''?>>
                      <?=$unie['uni_Name']?>
                      </option>
                      <?php	} ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                    <label>Beneficiary:</label>
                  </div>
                  <div class="col-md-9">
                    <input class="input form-control"  placeholder="Beneficiary" type="text" id="beneficiary" name="beneficiary" value="<?=$_POST['beneficiary']?>" >
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                    <label>Vendor:</label>
                  </div>
                  <div class="col-md-9">
                    <input class="input form-control"  placeholder="Vendor" type="text" id="vendor" name="vendor" readonly value="<?=$_POST['vendor']?>" >
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                    <label>Vendor Charges:</label>
                  </div>
                  <div class="col-md-9">
                    <input class="input form-control"  placeholder="Vendor Charges" type="text" id="vdcost" name="vdcost" readonly value="<?=$_POST['vdcost']?>" >
                  </div>
                </div>
                <?php if(!$dataflow){?>
                <div class="form-group">
                  <div class="col-md-3">
                    <label>Check(s):</label>
                  </div>
                  <div class="col-md-9">
                    <div class="chosen-container chosen-container-multi chosen-container-active chosen-with-drop" style="width: 577px;" title="Select checks">
                      <ul class="chosen-choices ddchosen-choices">
                        <?php 				
													
										if($_REQUEST['edit']!=0){
											
											$ddchecks = $db->select('dd_checks',"*","dd_id=$_REQUEST[edit] AND dc_active=1");
											
                                        while($ddcheck =mysql_fetch_array($ddchecks)){
											
											$tabls = "ver_data vd INNER JOIN ver_checks vc ON vd.v_id=vc.v_id INNER JOIN checks ck ON vc.checks_id=ck.checks_id";		
											$where = "vc.as_id=$ddcheck[as_id]";
										
										
                                            $check = $db->select($tabls,"*",$where);
											$check = mysql_fetch_array($check);
										
											$com = getcompany($check['com_id']);
											$com = mysql_fetch_assoc($com);?>
                        <li class="search-choice"> <span>
                          <?="#:$check[emp_id] ".$check['v_name']." ($com[name]) $check[checks_title]"?>
                          </span>
                          <input type="hidden" name="tcheck[]" value="<?=$check['as_id']?>">
                          <a onclick="removesearch(this)" class="search-choice-close"></a> </li>
                        <?php	} 
								
								
										}?>
                        <li class="search-field">
                          <input class="sfield form-control" type="text" style="width:100%;" >
                        </li>
                      </ul>
                      <div class="chosen-drop ddchosen-drop"> </div>
                    </div>
                  </div>
                </div>
                <?php }?>
                <div class="form-group">
                  <div class="col-md-3">
                    <label for="input-grid-2-10" class="col-lg-2 control-label">Unit(s):</label>
                  </div>
                  <div class="col-md-9">
                    <?php if($dataflow){?>
                    <input type="text"  class="form-control"  placeholder="Unit(s)" id="units" name="units" value="<?=$_POST['units']?>" onchange="calculateVal()" >
                    <?php }else{?>
                    <input class="req input etitle form-control"  placeholder="Unit(s)" disabled="disabled" 
                                title="Input Unit(s)" type="text" id="tunits" name="tunits" value="<?=$_POST['units']?>" >
                    <input type="hidden" id="units" name="units" value="<?=$_POST['units']?>" >
                    <?php }?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                    <label for="input-grid-2-10" class="col-lg-2 control-label">Fee Amount:</label>
                  </div>
                  <div class="col-md-9">
                    <input class="req input etitle form-control"  placeholder="Fee Amount" title="Input fee amount" onchange="calculateVal()" id="famount" type="text" name="famount" value="<?=$_POST['famount']?>" >
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                   <label for="input-grid-2-10" class="col-lg-2 control-label">Total Amount:</label>
                  </div>
                  <div class="col-md-9">
                    <input disabled="disabled" type="text" id="tamount" class="form-control" name="tamount" value="<?=$_POST['tamount']?>" >
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-3">
                      <label> Attachments:</label>
                    </div>
                    <div class="col-md-9">
                      <div class="fileinput fileinput-new" data-provides="fileinput"> <span class="btn btn-primary btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span>
                        <input type="file" class="form-control" name="...">
                        </span> <span class="fileinput-filename"></span> <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a> </div>
                    </div>
                  </div>
                  <div>
                    <div class="col-md-3">&nbsp;</div>
                    <div class="col-md-9">
                      <input type="file" class="form-control" name="att1" />
                      <?php if($_POST['att1']!=''){?>
                      <a target="_blank" href="<?=$_POST['att1']?>">
                      <?=$_POST['tit1']?>
                      </a>
                      <?php }?>
                      <br />
                      <input type="file" class="form-control" name="att2" />
                      <?php if($_POST['att2']!=''){?>
                      <a target="_blank" href="<?=$_POST['att2']?>">
                      <?=$_POST['tit2']?>
                      </a>
                      <?php }?>
                      <br />
                      <input type="file" class="form-control" name="att3" />
                      <?php if($_POST['att3']!=''){?>
                      <a target="_blank" href="<?=$_POST['att3']?>">
                      <?=$_POST['tit3']?>
                      </a>
                      <?php }?>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                    <label >Status:</label>
                  </div>
                  <div class="col-md-9">
                    <select name="status" class="select select_box" >
                      <?php if($LEVEL==6){?>
                      <option value="2" <?=($_POST['status']==2)?'selected="selected"':''?>>Paid</option>
                      <option value="3" <?=($_POST['status']==3)?'selected="selected"':''?>>Returned</option>
                      <?php }else{ ?>
                      <option value="0" <?=($_POST['status']==0)?'selected="selected"':''?>>Draft</option>
                      <option value="1" <?=($_POST['status']==1)?'selected="selected"':''?>>Send to Finance</option>
                      <?php }?>
                    </select>
                  </div>
                </div>
                <?php if($_REQUEST['edit']!=''){?>
                <input type="hidden" name="edit" class="form-control" value="<?=$_REQUEST['edit']?>"  />
                <?php }?>
                <div class="button_bar clearfix">
                  <button name="adddemanddraft" type="submit" class="btn btn-success"> <span>
                  <?=($_REQUEST['edit']!=0)?'Save':$IPAGE['m_actitle']?>
                  </span> </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
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



function inputdata(){
		var data = Array();           
		$('input[name^=tcheck]').each(function(){
			data.push($(this).val());
		});
		
		console.log(data);	
		
		document.getElementById('tunits').value = data.length;
		document.getElementById('units').value = data.length;
		calculateVal();
		return data;
		
}
		
$('.search-field input').autocomplete({		
  source: function( request, response ) {
    $.ajax({
      url: "actions.php?&ePage=optionscheck&input="+request.term+'&checks='+inputdata(),
      dataType: "html",
      	  beforeSend: function(){
		  	$('div.ddchosen-drop').empty();
	      },
		  success: function( data ) {
			  $('div.ddchosen-drop').html(data);
		  }
    });
  }
});

  function addsearch(html,ddid){ 
	 var data = $(html).html();
	 
	 var input = document.createElement('input');
	 input.name = "tcheck[]";
	 input.type = "hidden";
	 input.id = 'ddi'+ddid;
	 
	 var a = document.createElement('a');
	 a.className = 'search-choice-close';
	 a.onclick = function(){
		 	this.parentNode.parentNode.removeChild(this.parentNode);
	   		inputdata();
		 };
	 
	 var span = document.createElement('span');
	 span.innerHTML = data;
	 
	 
	 var li = document.createElement('li');
	 li.className = 'search-choice';
	 li.appendChild(span);
	 
	 li.appendChild(input);
	 
	 li.appendChild(a);
	 
	 $('ul.ddchosen-choices .search-field').before(li); 
	 
	 
	 
	 $('div.ddchosen-drop').empty();
	 
	 $('.search-field input').val('');
	 document.getElementById('ddi'+ddid).value = ddid
	 console.log(ddid);
	 inputdata();
	 
	 
   }
   
   function removesearch(ths){
	   ths.parentNode.parentNode.removeChild(ths.parentNode);
	   inputdata();
   }
  </script> 
