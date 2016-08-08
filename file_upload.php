<?php
/*
 * jQuery File Upload Plugin PHP Example 5.14
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

error_reporting(E_ALL | E_STRICT);
require('include/global_config.php');
require('include/db_class.php');
require('UploadHandler.php');

$upload_handler = new UploadHandler();

//var_dump(json_decode($_REQUEST)); die;