<div id="lightBoxBg" class="lightBoxBg" style="display:none; height:100%;"></div>

<div id="showConfirm" class="alert_boxes2" style="display:none;z-index:1005">
    <div id="lbConfirm" class="popupBox">
        <img onClick="closeBox(this,true)" class="clsBtn" src="<?=SURL?>img/cross-circle-p.png" alt="x">
        <div class="head-alt">
                <h3 class="head-alt" id="confirmHeaser">Are You Sure !</h3>
        </div>
        <div class="clear"></div>
        <div style="margin-bottom:8px;">
            <h4 align="center" id="confirmContent"></h4>
            <div id="buttons" style="margin-right:20px;margin-top:20px;" >
                <button id="btnYes" type="button" value="Yes" class="btn btn-primary next_step move send_right img_icon has_text">
                       <span>Yes</span>
                </button>
                <button type="button" value="No"  onclick="closeBox(this.parentNode.parentNode,true);" class="btn btn-primary next_step move send_right img_icon has_text">
                       <span>No</span>
                </button>	
            </div>
            <div class="clear"></div>
        </div>
    </div>
     <div class="clear"></div>
</div>

<div id="showalerts" class="alert_boxes2"  style="display:none;z-index:1005">
    <div id="lbalerts" class="popupBox">
    	<img onClick="closeBox(this,true)" class="clsBtn" src="<?=SURL?>img/cross-circle-p.png" alt="x" >
    	<div class="head-alt">
            <h3 class="head-alt" id="alertHeaser">Alert !</h3>
    	</div>
		<div class="clear"></div>
        <div style="margin-bottom:8px;">
            <div align="center" id="alertContent" ></div>
            <div id="buttons" style="margin-right:20px;margin-top:20px;" >
                <button type="button" value="OK"  onclick="closeBox(this.parentNode.parentNode,true);" class="btn btn-primary next_step move send_right img_icon has_text">
                       <span>OK</span>
                </button>                
            </div>
            <div class="clear"></div>
        </div>
	</div>
 	<div class="clear"></div>
</div>

<div id="showNotific" class="alert_boxes2" style="display:none;z-index:1005">
    <div id="lblnoticfic" class="popupBox">
    	<img onClick="closeBox(this,true)" class="clsBtn" src="<?=SURL?>img/cross-circle-p.png" alt="x" >
    	<div class="head-alt">
            <h3 class="head-alt" >Notification Message(s)</h3>
    	</div>
		<div class="clear"></div>
        <div style="margin-bottom:8px;">
            <div id="notificContnt">
			<?php
            if($_REQUEST['CNT']>1){
                    if($_REQUEST['TERR']!='') { 
                    foreach($_REQUEST['TERR'] as $ERR){?>
                        <div class="alert dismissible alert_red">
                            <img height="24" width="24" src="<?=SURL?>images/icons/small/white/alert.png">
                            <?=$ERR?>
                            <div class="clearfix"></div>
                        </div>
            <?php 	}}
                    if($_REQUEST['TSCS']!='') { 
                    foreach($_REQUEST['TSCS'] as $SCS){?>
                        <div class="alert dismissible alert_green">
                            <img height="24" width="24" src="<?=SURL?>images/icons/small/white/cog_3.png">
                            <?=$SCS?>
                            <div class="clearfix"></div>
                        </div>
            <?php 	}}		
            } 
            ?>   
            	<div class="clear"></div>
            </div>
            <div id="buttons" style="margin-right:20px;margin-top:20px;" >
                <button type="button" value="OK"  onclick="closeBox(this.parentNode.parentNode,true);" class="btn btn-primary next_step move send_right img_icon has_text">
                       <span>OK</span>
                </button>             
            </div>
            <div class="clear"></div>
        </div>
	</div>
 	<div class="clear"></div>
</div>

<div id="showAjax" class="alert_boxes2" style="display:none;z-index:1005">
    <div id="lblAjax" class="popupBox">
        <img onClick="closeBox(this,true,'showContent')" class="clsBtn" src="<?=SURL?>img/cross-circle-p.png" alt="x" >
    	<div class="head-alt">
            <h3 class="head-alt" id="showHeader"></h3>
            <div id="rightBtn" style="position:absolute;">
            	
            </div>
    	</div>
		<div class="clear"></div>
        <div style="margin:10px;">
            <div align="center" id="showContent" class="popupBox"></div>
            <div class="clear"></div>
        </div>
 	</div>
    	<div class="clear"></div> 
</div>

<div id="ajaxLoader" align="center" style="display:none;z-index:1005" >
    <div>
    	<strong>Loading...</strong>
    </div>
    <img src="img/ajaxloader.gif" />
</div>

<div id="showPDFLoader" style="display:none;z-index:1005">
    <div id="lbPDF" class="popupBox" style="display:block;text-align:center; width:250px;">
    <img onClick="closePDF()" class="clsBtn" src="<?=SURL?>img/cross-circle-p.png" alt="x" title="Close Downloading" >
        <div>
            <div style="margin-bottom:10px; margin-top:10px;">
                <div>
                <h4>Preparing PDF Please Wait</h4> 
                    <div style="margin-top:5px;">
                        <img src="images/loader_pdf.gif"  />
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>

<form style="display:none;" method="post" name="dataFrm" >
        <input type="hidden" name="daction" value="delete"  />
        <input type="hidden" name="datav" value="0"  />
</form>

<form style="display:none;" method="post" name="acfrom" >
	
</form>