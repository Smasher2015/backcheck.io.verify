<?php if(isset($_SESSION['user_id'])){ ?>
<style type="text/css">
#footer-bar {
    -moz-border-radius: 6px 6px 0 0;
	-webkit-border-radius:6px 6px 0 0;
	border-radius:6px 6px 0 0;
    -moz-box-shadow: 0 -1px 1px rgba(0, 0, 0, 0.05);
	-webkit-box-shadow:0 -1px 1px rgba(0, 0, 0, 0.05);
	box-shadow: 0 -1px 1px rgba(0, 0, 0, 0.05);
	
    background: url("img/topline.gif") repeat-x scroll left top #EEF4F9;
    border-color: #BCC9D6 #BCC9D6 -moz-use-text-color;
    border-style: solid solid none;
    border-width: 1px 1px 0;
    color: #5E6A77;
    font-size: 1em;
    height: 38px;
    width: 1000px;
    text-align: left;
    z-index: 95;
	margin:auto;
}
#usernav-container {
    background: none repeat scroll 0 0 transparent;
    min-height: 34px;
}
#usernav-wrapper {
    float: left;
    position: relative;
}

#footer-bar div,#footer-bar ul, #footer-bar li, #footer-bar p{
    margin: 0;
    padding: 0;
}
#user_navigation {
    background: none repeat scroll 0 0 transparent;
    border-width: 0;
    float: right;
    font-size: 1em;
    position: relative;
    text-shadow: 1px 1px 0 #FFFFFF;
    z-index: 50;
}


#footer-bar .left {
    float: left;
}
#user_navigation ul#user_other {
    margin: 4px 0px 0;
}
#user_navigation .photo {
    -moz-border-radius: 4px 4px 4px 4px;
	-webkit-border-radius:4px 4px 4px 4px;
	border-radius:4px 4px 4px 4px;

    background: none repeat scroll 0 0 #FFFFFF;
    float: left;
    margin: 4px 0 5px 5px;
}
#footer-bar img {
    vertical-align: middle;
	border: none;
}
#user_navigation p {
    color: #5E6A77;
    white-space: nowrap;
}
#user_navigation ul#user_link_menucontent {
    -moz-border-radius: 5px;
	-webkit-border-radius:5px;
	border-radius:5px;
    -moz-box-shadow: 0 -2px 2px rgba(0, 0, 0, 0.08);
	-webkit-box-shadow:0 -2px 2px rgba(0, 0, 0, 0.08);
	box-shadow: 0 -2px 2px rgba(0, 0, 0, 0.08);
	
    background-color: #DCE4EA;
    border-color: #B7C1C9 #B7C1C9 -moz-use-text-color;
    border-style: solid solid none;
    border-width: 1px 1px 0;
    float: left;
	bottom:40px;
    padding: 3px 0;
    width: 225px;
    z-index: 96;
}
#user_navigation ul#user_link_menucontent li {
    float: none;
    margin: 0 3px;
    padding: 1px;
}

#user_navigation ul#user_other li {
    float: right;
}

#user_navigation p a {
    color: #424F5D;
}

#user_navigation #user_link {
    -moz-border-radius: 4px 4px 4px 4px;
	-webkit-border-radius:4px 4px 4px 4px;
	border-radius:4px 4px 4px 4px;
    background: url("img/usernav_normal.png") repeat-x scroll left top #D7E1EA;
    border: 1px solid #BDCAD5;
    display: inline-block;
    margin: 4px 5px 0 10px;
    min-width: 110px;
    overflow: hidden;
    padding: 4px 26px 3px 10px;
    position: relative;
}
#user_navigation #user_link img {
    position: absolute;
    right: 5px;
    top: 9px;
}
#user_navigation ul#user_link_menucontent a {
    -moz-border-radius: 4px 4px 4px 4px;
	-webkit-border-radius:4px 4px 4px 4px;
	border-radius:4px 4px 4px 4px;
    color: #5E6A77;
    display: block;
    text-decoration: none;
}
#user_navigation ul#user_link_menucontent a img {
    margin-right: 5px;
    margin-top: -2px;
    position: relative;
}
#user_navigation ul#user_other li a {
    border: 1px solid transparent;
    display: block;
    padding: 4px 8px 3px;
    text-decoration: none;
}
#user_navigation ul a {
    color: #424F5D;
}
#user_navigation ul#user_other li a img {
    margin-right: 3px;
    margin-top: -3px;
    position: relative;
}

#user_navigation ul#user_link_menucontent a:hover{
	background: none repeat scroll 0 0 #CCD6DE;
}


#user_navigation #user_link,#user_navigation ul, #user_navigation ul#user_link_menucontent {
    color: #424F5D;
    text-decoration: none;
}
#user_navigation ul {

    font-size: 1em;
    margin-top: 4px;
}
#footer-bar .right {
    float: right;
}
#footer-bar ul {
    list-style: none outside none;
}

#user_navigation #user_link:hover{
	background-color:#CDD9E3;
}

</style>
<script type="text/javascript">
var mSwitch = 's';
function showUserLinks(){
		switch(mSwitch){
			case 's':
				document.getElementById('user_link_menucontent').style.display = 'block';
				document.getElementById('imoc').src = 'img/cat_maximize.png';
				mSwitch = 'h';
			break;
			case 'h':
				document.getElementById('user_link_menucontent').style.display = 'none';
				document.getElementById('imoc').src = 'img/cat_minimize.png';
				mSwitch = 's';
			break;
		}
}
</script>

<div id="footer">
    <div id="footer-bar">
        <div id="usernav-container">
            <div id="usernav-wrapper">
                <div class="logged_in" id="user_navigation" style="float:left;">
                        <a title="Your Profile" href="#">
                                <img height="28px" width="30px" class="photo" src="img/default_thumb.png"  />
                        </a>
                        <div id="user_info" class="left">
                            <p>
                                <a onclick="showUserLinks()" href="javascript:void(0)" class="ipbmenu translation" id="user_link">
                                     <?php echo $UNAME; ?> <img id="imoc" alt="&gt;" src="img/cat_minimize.png">
                                </a>
                            </p> 
                            <ul id="user_link_menucontent" style="display:none;position:absolute;">
                                <li id="user_profile" style="z-index: 10000;">
                                    <a class="translation" title="My Profile" href="<?php echo SURL."?action=profile"; ?>">
                                        <img src="img/icon_profile.png" style="z-index: 10000;"> My Profile
                                    </a>
                                </li>
                            </ul>
                        </div>                        
                </div>
                <div class="clear"></div>
            </div>
             <div class="clear"></div>
        </div>
         <div class="clear"></div>
    </div>
</div>
<?php } ?>