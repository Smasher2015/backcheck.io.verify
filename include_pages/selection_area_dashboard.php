
<div class="search_dash">
                            	<div class="panel panel-flat">

						<div class="panel-body">
							
								<?php if($LEVEL == 5 || $LEVEL == 4 || $LEVEL == 3 || $LEVEL == 2){ ?>
                                    <?php if($LEVEL != 5){ ?>
                                 <form action="?action=search&atype=record" method="POST" id="validateSearchform" class="main-search">
                                <div class="input-group content-group">
									<div class="has-feedback has-feedback-left">
										
                                        <input type="text" name="search" id="searcha" class="form-control input-xlg" value="" placeholder="Search Candidate & Employee" value="<?php echo $_REQUEST['search']; ?>">
										<div class="form-control-feedback">
											<i class="icon-search4 text-muted text-size-base"></i>
										</div>
									</div>

									<div class="input-group-btn">
										<button type="submit" class="btn bgc-success btn-xlg">Search</button>
									</div>
								</div>
                                </form>
								<?php } ?>
                
        
        	
        
        
        
        <?php }?>
        				<form name="frm_client" id="frm_client" method="post" class="main-search">
								<div class="row search-option-buttons">
									<div class="col-sm-9">
										<ul class="list-inline list-inline-condensed no-margin-bottom">
											<?php if($LEVEL!=4) { ?><li class="dropdown">
												
									
                                   
									<select  name="client_id" class="select " id="client_id_db" onchange="document.frm_client.submit()">
									  <option value=""> Select Client </option>
									  <?php 
									  $clients = $db->select("company","name,id","is_active=1 ORDER BY name ASC");
									  while($client = @mysql_fetch_assoc($clients)){ 
									   ?>
									  <option value="<?php echo $client['id'];?>" <?php echo chk_or_sel($client['id'],$company_id,'selected');?>>
									 <?php echo $client['name'];?>
									  </option>
									  <?php } ?>
									</select>	
									
                                   
									
											</li><?php }else{?>
											<input type="hidden" id="client_id_db"	value="<?php echo $COMINF['id'];?>">
											<?php } ?>
                                            <li class="dropdown">
												  <select class="select" name="mnth" onchange="document.frm_client.submit()">
                                   <?php echo getMonthsDropDown($_REQUEST['mnth']);?>
                                    </select>
											</li>
                                            
											<li class="dropdown">
                                            	 <select class="select" name="yr" onchange="document.frm_client.submit()">
                                    <?php echo getYearsDropDown(2000,'',$_REQUEST['yr']);?>
                                    </select>
                                            </li>
										</ul>
									</div>

									<div class="col-sm-3 text-right">
										<ul class="list-inline no-margin-bottom">
											<li><a href="#" class="btn btn-link btn-sm"><i class="icon-menu7 position-left"></i> Advanced search</a></li>
										</ul>
									</div>
								</div>
							</form>
						</div>
					</div>
                            </div>

