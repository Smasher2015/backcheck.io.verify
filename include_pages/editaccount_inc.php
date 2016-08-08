<section class="retracted scrollable">

 <div class="row">
        <div class="col-md-12">
        
        <div class="manager-report-sec">
        	<div class="list-group-item">
    			
                <div class="page-section-title" style="margin: 0 0 17px;">
                <h2 class="box_head">My Account</h2>
                  <!--  <a href="#" class="grabber">&nbsp;</a>
                    <a href="#" class="toggle">&nbsp;</a>-->
    			</div>
    
            <form class="cstm validate_form" method="post" enctype="multipart/form-data">
										
                                        <fieldset class="form-group">
										<input type="hidden" name="id" value="<?=$COMINF['id']?>"/>
											<label for="required_field">Company Name</label>
											<div>
											<input class="form-control" type="text" name="name" value="<?=$COMINF['name']?>"/>
                                            </div>
										</fieldset>
                                        <fieldset class="form-group">
										
											<label for="required_field">Address</label>
											<div>
											<input class="form-control" type="text" name="address" value="<?=$COMINF['address']?>"/>
                                            </div>
										</fieldset>
                                        <fieldset class="form-group">
										
											<label for="required_field">Email</label>
											<div>
											<input class="form-control" type="text" name="email" value="<?=$COMINF['email']?>"/>
                                            </div>
										</fieldset>
                                        <fieldset class="form-group">
										
											<label for="required_field">Company Title</label>
											<div>
											<input class="form-control" type="text" name="title" value="<?=$COMINF['title']?>"/>
                                            </div>
										</fieldset>
                                        <fieldset class="form-group">
										
											<label for="required_field">Company Logo</label>
											<div>
											<input class="form-control" type="file" style="margin:0 0 15px 0;" name="logo" value="<?=$COMINF['logo']?>"/>
                                            <?php if($COMINF['logo']!=''){ ?>
                                            <img src="<?=$COMINF['logo']?>"/>
                                            <?php }?>
                                            </div>
										</fieldset>
                                        <fieldset class="form-group">
										
											<label for="required_field">Company Page Title</label>
											<div>
											<input class="form-control" type="text" name="pagetitle" value="<?=$COMINF['pagetitle']?>"/>
                                            </div>
										</fieldset>
                                        <fieldset class="form-group">
										
											<label for="required_field">Company Page Solgan</label>
											<div>
											<input class="form-control" type="text" name="pagesolgan" value="<?=$COMINF['pagesolgan']?>"/>
                                            </div>
										</fieldset>
                                        <fieldset class="form-group">
										
											<label for="required_field">Company Page Desc</label>
											<div>
											<input class="form-control" type="text" name="pagedesc" value="<?=$COMINF['pagedesc']?>"/>
                                            </div>
										</fieldset>
                                        <fieldset class="form-group">
										
											<label for="required_field">Company Agreement</label>
											<div>
                                            <textarea class="form-control" name="agreement" cols="36" rows="15"><?=$COMINF['agreement']?>
                                            </textarea>
                                            </div>
										</fieldset>
                                         <div class="list-group-item" style="margin-bottom:30px;">
											<div class="form-group" style="text-align:right">
                                        	<button type="submit" class="btn btn-lg btn-success" name="edit_profile"  id="normForm" />Edit Profile</button>
										</div>
                                    </div>
                     	               </form>
                                       
                </div>
            </div>
        </div>
    </div>
</section>