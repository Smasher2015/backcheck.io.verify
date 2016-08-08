   <fieldset class="label_side">
										<label for="required_field">List Of Included Checks</label>
										<div>
											<ul>
											<?php 
											$cid=$db->select("package_items","checks_id","pkg_id=$_REQUEST[pkg_id]");
											while($chid=mysql_fetch_array($cid)){
												
												$cnames=$db->select("checks","checks_title","checks_id=$chid[checks_id]");
												$cname=mysql_fetch_array($cnames);
												?>
                                                <li><span class="tooltip" title="<?php echo mb_convert_encoding($cname['checks_title'], 'HTML-ENTITIES','UTF-8');?>">
												<?php echo mb_convert_encoding($cname['checks_title'], 'HTML-ENTITIES','UTF-8');?>
                                                </span></li>
												
												<?php 
												}
											
											$chc=$db->select("packages","*","pkg_id=$_REQUEST[pkg_id]");
											$ch_na=mysql_fetch_array($chc);
											if($ch_na['pkg_type']==1 && $ch_na['user_id']==$_SESSION['user_id'] ){
											?>
                                             </ul>
                               			<a href="?action=edit&atype=package&pkg_id=<?=$_REQUEST['pkg_id']?>">Edit Package</a>
                                        <? }?>
                                       
										</div>
									</fieldset>
                                    									<div class="alert alert_grey">
									<img height="24" width="24" src="images/icons/small/grey/speech_bubble_2.png">
									This alert cannot be dismissed.
									</div>