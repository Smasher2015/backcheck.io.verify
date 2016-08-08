<?php /*?><?php 
$packages = $db->select("package","*","pkg_active=1");
if(mysql_num_rows($packages)>0){
	$pnum = 0; $pRates[][] = array();
	while($package = mysql_fetch_assoc($packages)){?>
        <div class="box grid_16 tabs">		
            <h2 class="box_head"><?=$package['pkg_title']?></h2>
            <a href="#" class="grabber">&nbsp;</a>
            <a href="#" class="toggle">&nbsp;</a>
            <div class="toggle_container">
                <div class="block">
                    <table class="static" >
                        <thead>
                        	<tr>
                            	<th>Compnent</th>
							<?php
								$tabls = "pkg_pricing pr INNER JOIN compnents cm ON pr.cmp_id=cm.cmp_id";
								$where = "cm.cmp_active=1 AND pr.prc_active=1 AND pr.cmp_id=1 AND pr.pkg_id=$package[pkg_id] ORDER BY pr.prc_id";
                                $pricing = $db->select($tabls,"pr.prc_min,pr.prc_max,pr.prc_disc",$where);
								
								if(mysql_num_rows($pricing)>0){ 
									$pricing = bindArray($pricing);
                                    foreach($pricing as $price){?>
                                    <th>
									<?=(($price['prc_max']==0))?"Above $price[prc_min] Checks":"$price[prc_min]-$price[prc_max] Checks"?>
                                    <?=($price['prc_disc']==0)?'':" ($price[prc_disc] disc)"?>
                                    </th>
                            <?php 	}
                                }?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        	$compnents = $db->select("compnents","*","cmp_active=1 ORDER BY cmp_id");
							if(mysql_num_rows($compnents)>0){
								$rows=0;
								while($compnent = mysql_fetch_assoc($compnents)){
									$cols=0;?>
                                    <tr>
                                        <td><?=$compnent['cmp_title']?></td>
                                        <?php foreach($pricing as $price){?>
                                        <td>
                                        <?php 	
											if($pnum==0){
												if($price['prc_disc']!=0){
                                                      $num = ($compnent['cmp_price'] - (($compnent['cmp_price']*$price['prc_disc'])/100));
                                                }else $num = $compnent['cmp_price'];
                                                $pRates[$rows][$cols] = $num;
                                                echo number_format($num);
											}else{
												$num = ($pRates[$rows][$cols] - (($pRates[$rows][$cols]*$price['prc_disc'])/100));
												echo number_format($num);
											}
                                                ?>
                                        </td>
                                        <?php 	$cols = $cols+1;
                                              }?>
                                    </tr>
                        <?php 		$rows = $rows+1;
								}
							}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<?php 
	$pnum = $pnum+1;
	}
	
}?>   <?php */?> 
<section class="retracted scrollable">
<div class="row">
<div class="col-md-12">
  <div class="report-sec">
  <div class="page-section-title">
    
    <h2 class="box_head">Dashboard</h2>
    </div>
    <div class="list-group-item">
	
<?php 
$packages = $db->select("package","*","pkg_active=1");
if(mysql_num_rows($packages)>0){
		
	$pnum = 0; $pRates[][] = array();
	while($package = mysql_fetch_assoc($packages)){?>
    
      
            <div id="data-table" class="panel-heading datatable-heading">
                <h4 class="section-title"><?=$package['pkg_title']?></h4>
            </div>	
                    <table class="table table-bordered table-striped customtableSortable">
                        <thead>
                        	<tr>
                            	<th>Compnent</th>
							<?php
								$tabls = "pkg_pricing pr INNER JOIN compnents cm ON pr.cmp_id=cm.cmp_id";
								$where = "cm.cmp_active=1 AND pr.prc_active=1 AND pr.cmp_id=1 AND pr.pkg_id=$package[pkg_id] ORDER BY pr.prc_id";
                                $pricing = $db->select($tabls,"pr.prc_min,pr.prc_max,pr.prc_disc",$where);
								
								if(mysql_num_rows($pricing)>0){ 
									$pricing = bindArray($pricing);
                                    foreach($pricing as $price){?>
                                    <th>
									<?=(($price['prc_max']==0))?"Above $price[prc_min] Checks":"$price[prc_min]-$price[prc_max] Checks"?>
                                    <?=($price['prc_disc']==0)?'':" ($price[prc_disc] disc)"?>
                                    </th>
                            <?php 	}
                                }?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        	$compnents = $db->select("compnents","*","cmp_active=1 ORDER BY cmp_id");
							if(mysql_num_rows($compnents)>0){
								$rows=0;
								while($compnent = mysql_fetch_assoc($compnents)){
									$cols=0;?>
                                    <tr class="gradeX">
                                        <td><?=$compnent['cmp_title']?></td>
                                        <?php foreach($pricing as $price){?>
                                        <td>
                                        <?php 	
											if($pnum==0){
												if($price['prc_disc']!=0){
                                                      $num = ($compnent['cmp_price'] - (($compnent['cmp_price']*$price['prc_disc'])/100));
                                                }else $num = $compnent['cmp_price'];
                                                $pRates[$rows][$cols] = $num;
                                                echo number_format($num);
											}else{
												$num = ($pRates[$rows][$cols] - (($pRates[$rows][$cols]*$price['prc_disc'])/100));
												echo number_format($num);
											}
                                                ?>
                                        </td>
                                        <?php 	$cols = $cols+1;
                                              }?>
                                    </tr>
                        <?php 		$rows = $rows+1;
								}
							}?>
                        </tbody>
                    </table>
       
<?php 
	$pnum = $pnum+1;
	}
	
}
?>
 </div>
</div>
</div>
</div>
</section>


 <script src="scripts/proton/tables.js"></script>

