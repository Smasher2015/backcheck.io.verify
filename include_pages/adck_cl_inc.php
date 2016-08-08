<table>
<?php
		$where  ="(fm.fl_face=4 AND vc.v_id=$_REQUEST[case])";
		$fields = $db->select("fields_maping fm INNER JOIN ver_checks vc ON vc.checks_id=fm.checks_id","DISTINCT *",$where);
		while($field = mysql_fetch_array($fields)){ ?>
			<tr>
            	<td>
                    <div>
                        <b><?php
								$checkInfo = getCheck($field['checks_id']);	
							 	echo $checkInfo['checks_title']; 
						?>:</b>
                         <div class="clear" ></div>
                    </div>
                    <div>
                        <?php if($field['in_id']==5){?>
                                        <div>
                                            <div style="float:right;">
                                                <label><?php echo $field['fl_title']; ?>:</label>
                                                <?php echo renderFields($field,$field['as_id']);  ?>
                                                <input type="hidden" name="casev[]" value="<?php echo "$field[as_id]|$field[fl_key]"; ?>" />
                                            </div>
                                            <div class="clear" ></div>  
                                        </div>
										<div>
							<?php			$attachments = getData($field['as_id'],$field['fl_key']);
											if(mysql_num_rows($attachments)>0){
												while($att =mysql_fetch_array($attachments)){ 
													if($att['d_stitle']!='') $title=$att['d_stitle']; else $title=$att['d_mtitle'];?>    
													<div style="padding:2px; margin:5px 5px 5px 0;border:#CCC solid 1px;">
														<div style="float:left;display:inline-block;padding:5px;">
                                                        	<b><?php echo $title;?></b>:
                                                        </div>
                                                    	<a title="<?php echo $title; ?>" class="multy" target="_blank" href="<?php echo $att['d_value']; ?>">
															<img style="width:24px;" src="img/attachment.png" />
														</a>
														<a class="multy" href="javascript:void(0)" onclick="dataActions(<?php echo $att['d_id'];?>,'<?php echo $title;?>')">
															<img style="width:24px;" src="img/delete.png" />	
														</a>                                                                            
														<div class="clear" ></div>
													</div>
									<?php		}
											}  ?>  
                                          </div>                                      
                        <?php }?>
                    </div>
                </td>
            </tr>
<?php	}
?>
</table>