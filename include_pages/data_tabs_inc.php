<?php $intr = (isset($_REQUEST['intr']))?$_REQUEST['intr']:'';?>
<div class="comTabs" style="margin-top:10px;">
			<a href="?action=close&atype=case&intr=admin" class="<?php if($intr=='admin')   echo 'current'; else echo 'normal'; ?>" >Admin</a>
            <a href="?action=close&atype=case&intr=client" class="<?php if($intr=='client') echo 'current'; else echo 'normal'; ?>" >Client</a>
	<div class="clear"></div>
</div>