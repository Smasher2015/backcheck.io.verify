<body onLoad="document.getElementById('redirect').submit();">
<center>
  <h3>Please wait ...</h3>
<form action="http://verify.backgroundcheck365.com/index.php" id="redirect" method="get">
<input type="hidden" name="action" value="register">
<input type="hidden" name="hash" value="<?php echo $_REQUEST['hash'] ?>">
<input type="hidden" name="pkg" value="<?php echo $_REQUEST['pkg'] ?>">
<input type="hidden" name="email" value="<?php echo $_REQUEST['email'] ?>">
<input type="hidden" name="name" value="<?php echo $_REQUEST['name'] ?>">
</form>  
  </center>
