<?php
	if(!isset($_REQUEST['edit'])) $_REQUEST['edit'] = 0;
	if(!is_numeric($_REQUEST['edit'])) $_REQUEST['edit'] = 0;
	
	$where = "vd_id=$_REQUEST[edit]";
	$parys = array('vd_name'=>'company',
					'vd_cnicnumber'=>'cnicnumber',
					'vd_fee'=>'vfee',
					'vd_regnum'=>'rnumber',
					'vd_cperson'=>'cperson',
					'vd_email'=>'cemail',
					'vd_contact'=>'cphone',
					'vd_mobile'=>'cmobile',
					'vd_adress'=>'address',
					'vd_bankname'=>'vdbankname',
					'vd_acctitle'=>'vdacctitle',
					'vd_accnumber'=>'vdaccnumber',
					'vd_branchname'=>'vdbranchname',
					'vd_branchcode'=>'vdbranchcode',
					'vd_swiftcode'=>'vdswiftcode',
					'vd_remarks'=>'vdremarks',
					'vd_area'=>'carea',
					'vd_city'=>'ccity'
	);
	
	setPost($parys,"vendors",$where);
	
?>

    <div class="box grid_16">
        <h2 class="box_head">Add Vendor</h2>
        <a href="#" class="grabber">&nbsp;</a>
        <a href="#" class="toggle">&nbsp;</a>
        <div class="toggle_container">
            <form class="validate_form" method="post" enctype="multipart/form-data" >
                <fieldset class="label_side">
                    <label>Name:<span>Full Legal Name</span></label>
                    <div>
                        <input class="required" title="Input "  type="text" name="company" value="<?=$_POST['company']?>">
                        <div class="required_tag"></div>
                    </div>
                </fieldset>
                
                
                
                <div class="columns clearfix">
                    <div class="col_50">
                    <fieldset class="label_side">
                        <label>Fee Amount:</label>
                        <div>
                            <input type="text" name="vfee" value="<?=$_POST['vfee']?>" >
                        </div>
                    </fieldset>
                        
 					</div>
                    <div class="col_50">
                        <fieldset class="label_side">
                            <label>CNIC No:</label>
                            <div>
                                <input  type="text" name="cnicnumber" value="<?=$_POST['cnicnumber']?>" >
                            </div>
                        </fieldset> 
                	</div>
                </div>
                
                <div class="columns clearfix">
                    <div class="col_50">
                    <fieldset class="label_side">
                    <label>Contact Person:</label>
                    <div>
                        <input type="text" name="cperson" value="<?=$_POST['cperson']?>" >
                    </div>
                </fieldset>
                        
 					</div>
                    <div class="col_50">
                        <fieldset class="label_side">
                            <label>Email Address:</label>
                            <div>
                                <input   type="text" name="cemail" value="<?=$_POST['cemail']?>" >
                                
                            </div>
                        </fieldset> 
                	</div>
                </div>

			<div class="columns clearfix">
                <div class="col_50">
                              
            <fieldset class="label_side">
                    <label>Phone:</label>
                    <div>
                        <input  type="text" name="cphone" value="<?=$_POST['cphone']?>" >
                    </div>
                </fieldset>
                </div>
                <div class="col_50">
                <fieldset class="label_side">
                <label>Mobile:</label>
                <div>
                    <input  type="text" name="cmobile" value="<?=$_POST['cmobile']?>" >
                </div>
            </fieldset>
                </div>
            </div>
            
            
            <div class="columns clearfix">
                <div class="col_50">
                              
            <fieldset class="label_side">
                    <label>Area:</label>
                    <div>
                        <input  type="text" name="carea" value="<?=$_POST['carea']?>" >
                    </div>
                </fieldset>
                </div>
                <div class="col_50">
                <fieldset class="label_side">
                <label>City:</label>
                <div>
                    <input  type="text" name="ccity" value="<?=$_POST['ccity']?>" >
                </div>
            </fieldset>
                </div>
            </div>
                
                                                                                           
                <fieldset class="label_side">
                    <label>Address:</label>
                    <div>
                        <textarea  name="address" rows="5"><?=$_POST['address']?></textarea>
                    </div>
                </fieldset>
                
                                                                                              
                <fieldset class="label_side">
                    <label>Remarks:</label>
                    <div>
                        <textarea  name="vdremarks" rows="5"><?=$_POST['vdremarks'];?></textarea>
                    </div>
                </fieldset>
                <h2 class="box_head">Vendor Bank Information</h2>
                
                <fieldset class="label_side">
                    <label>Bank Name :</label>
                    <div>
                        <input  type="text" name="vdbankname" value="<?=$_POST['vdbankname']?>" >
                    </div>
                </fieldset>
            	
            <div class="columns clearfix">
                    <div class="col_50">
                    <fieldset class="label_side">
                    <label>Account Title : </label>
                    <div>
                        <input type="text" name="vdacctitle" value="<?=$_POST['vdacctitle']?>" >
                    </div>
                </fieldset>
                        
 					</div>
                    <div class="col_50">
                        <fieldset class="label_side">
                            <label>Account Number :</label>
                            <div>
                                <input   type="text" name="vdaccnumber" value="<?=$_POST['vdaccnumber']?>" >
                                
                            </div>
                        </fieldset> 
                	</div>
                </div>    
                <div class="columns clearfix">
                    <div class="col_50">
                    <fieldset class="label_side">
                    <label>Branch Name: </label>
                    <div>
                        <input type="text" name="vdbranchname" value="<?=$_POST['vdbranchname']?>" >
                    </div>
                </fieldset>
                        
 					</div>
                    <div class="col_50">
                        <fieldset class="label_side">
                            <label>Branch Code:</label>
                            <div>
                                <input   type="text" name="vdbranchcode" value="<?=$_POST['vdbranchcode']?>" >
                                
                            </div>
                        </fieldset> 
                	</div>
                </div>
                 <fieldset class="label_side">
                    <label>Swift Code:</label>
                    <div>
                        <input  type="text" name="vdswiftcode" value="<?=$_POST['vdswiftcode']?>" >
                    </div>
                </fieldset>
                <?php if($_REQUEST['edit']!=''){?>
                 <input type="hidden" name="edit" value="<?=$_REQUEST['edit']?>"  /> 
                <?php }?> 
                <div class="button_bar clearfix">
                    <button name="addvendor" type="submit" class="btnright div_icon has_text text_only">
                        <span><?=($_REQUEST['edit']!=0)?'Save':'Add Vendor'?></span>
                    </button>                       
                </div>
    </form>
        </div>
    </div>



  
<div class="box grid_16">

	<h2 class="box_head">Vendor Listing</h2>	

 	<a href="#" class="grabber">&nbsp;</a>

    <a href="#" class="toggle">&nbsp;</a>

    <div class="toggle_container">

    <div class="block">

            <div id="dt2">

          <table class="display datatable">
            <thead>
                <tr>
                    <th>&nbsp;</th>
					<th>Name</th>
                    <th>Contact Person</th>
                    <th>Email Address</th>
                    <th>Contact#</th>
                    <th>Account Number</th>
                    <th>Fee</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $tbls = "vendors";
                $data = $db->select($tbls,"*","vd_active=1 ORDER BY vd_id DESC");
                while($re = mysql_fetch_array($data)) { ?>
                <tr >
                    <td></td>
                    <td><a href="?action=vendor&atype=details&vdid=<?=$re['vd_id']?>"> <?=$re['vd_name']?></a></td>
                    <td><?=$re['vd_cperson']?></td>
                    <td><?=$re['vd_email']?></td>
                    <td><?="Pho: $re[vd_contact], Mob: $re[vd_mobile]"?></td>
					<td><?=$re['vd_accnumber']?></td>
                    <td><?=$re['vd_fee']?></td>
                    <td align="center">
                    <a href="javascript:void(0)"> 
                    <img title="Delete" class="edits" src="images/icons/small/grey/acces_denied_sign.png" 
                    onclick="submitLink('vdid=<?=$re['vd_id']?>&delete')"> 
                    </a> <a href="javascript:void(0)"> 
                    <img title="Edit" class="edits" src="images/icons/small/grey/pencil.png" onclick="submitLink('edit=<?=$re['vd_id']?>')"> 
                    </a>
                    </td>
                </tr>        
            <?php }?>
            </tbody>
        </table>
            </div>
		</div>
 	</div>
</div>