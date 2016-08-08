<?php
if(isset($_REQUEST['register'])){
	register_();
} 

if(isset($_REQUEST['addadCheck'])){
	add_Check();
}

if(isset($_REQUEST['addProject'])){
	addProject();
}

if(isset($_POST['addlevel'])){
	addlevel();
}

if(isset($_POST['addpage'])){
	addpage();
}

if(isset($_REQUEST['right']) || isset($_REQUEST['right'])){
	adUpRights();
}

// -------by khl-----------
if(isset($_REQUEST['sentto'])){
		srChecks();
	}	

	if(isset($_REQUEST['assigncases']) || isset($_REQUEST['rassigncases'])){
		assignChecks();
	}
	
	if(isset($_REQUEST['opencasck']) || isset($_REQUEST['delecasck'])){
		removeOpenCs();
	}
//------------------------
?>