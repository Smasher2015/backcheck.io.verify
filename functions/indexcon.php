<?php
//###==###
error_reporting(0); 


 if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class indexcon extends CI_Controller {



	/**

	 * Index Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://example.com/index.php/welcome

	 *	- or -  

	 * 		http://example.com/index.php/welcome/index

	 *	- or -

	 * Since this controller is set as the default controller in 

	 * config/routes.php, it's displayed at http://example.com/

	 *

	 * So any other public methods not prefixed with an underscore will

	 * map to /index.php/welcome/<method_name>

	 * @see http://codeigniter.com/user_guide/general/urls.html

	 */

	

	public function setSetings(){

		$this->theme->loader = $this;

		$this->theme->thmUrl = $this->config->base_url();

	}



	public function loadParms($parms,$type){

		if($parms!=""){

			$parms = explode("|",$parms);

			foreach($parms as $parm){

					$iparms = explode("=",$parm);

					if($type==1){

						 $_POST[$iparms[0]] = $iparms[1];

						 $_REQUEST[$iparms[0]] = $iparms[1];

					}else{

						 $_POST[$iparms[0]] = $_REQUEST[$iparms[1]];

						 $_REQUEST[$iparms[0]] = $_REQUEST[$iparms[1]];

					}

			}

		}

	}

	

	public function submitForms($views){

		foreach ($views->result() as $view){

			if($view->md_submd!=0){

				$subview = $this->core->getViews(array("md.md_id"=>$view->md_submd,"at.lv_id"=>$this->session->userdata('levelid')));

				if($subview->num_rows>0){

					$subview=$subview->row();

					if(isset($_POST[$subview->md_file])){

						call_user_func(array($this,$subview->md_file),$subview);

					}

				}

			}

			if(isset($_POST[$view->md_file])){

				call_user_func(array($this,$view->md_file),$view);

			}

		}

	}

	

	public function index(){
		
		
		if(!isset($_REQUEST['action'])) $_REQUEST['action'] = "noaccess";

		if($_REQUEST['action']=="approvereq"){

			$this->approvereq();

			return 0;

		}

		if($_REQUEST['action']=="login" && !$this->session->userdata('validated')){

			$this->login();

		}else{

			if(isset($_POST['upcStatus'])) $this->upcStatus();

			if(isset($_POST['reqDelete'])) $this->purchasereRemov();

			

			if(!isset($_POST['verifiedby'])){

				if(isset($_REQUEST['skey']) && isset($_REQUEST['verified']) && is_numeric($_REQUEST['rqid']) && is_numeric($_REQUEST['type'])){

					if($_REQUEST['verified']=='Approved' || $_REQUEST['verified']=='Rejected' || $_REQUEST['verified']=='On Hold'){

						if(!isset($_POST['rqtatus'])) $_POST['rqtatus'] = $_REQUEST['verified'];

						if(!isset($_POST['rqcomment'])) $_POST['rqcomment']= '';

						if(!isset($_POST['type'])) $_POST['type'] = $_REQUEST['type'];

						$_POST['rqid'] = $_REQUEST['rqid'];

						 $this->verifiedby();

					}

				}

			}

			$this->setSetings();

			$page = $this->core->getPage();

			if($page){

				$views = $this->core->getViews(array("at._ida"=>$page->pg_id,"at.lv_id"=>$this->session->userdata('levelid')));

				if($views) $this->submitForms($views);

				if(!isset($_POST['ajxfun'])){

					if($page->pg_sheader==1) $this->theme->loadDHead();

					

					if($views){

						foreach ($views->result() as $view){

								$this->loadParms($view->at_parms,1);

								$this->loadParms($view->at_posts,2);

								$this->theme->loadViews($view->md_file,$view);

						}

					}

					

					if($page->pg_sheader==1) $this->theme->loadFooter();

				}

			}

			

		}
		
		if(isset($_POST['rqtatus'])){
			$this->pendingapproval();
		}

	}

	

	public function login(){

		$this->setSetings();

		$this->theme->sidebar = false;

		$this->theme->navibar = false;

		$this->theme->options = false;

		$this->theme->loadDHead();

		$this->theme->loadViews('login',array());

		$this->theme->loadFooter();

	}



	public function approvereq(){

		$this->setSetings();

		$this->theme->sidebar = false;

		$this->theme->navibar = false;

		$this->theme->options = false;

		$this->theme->loadDHead();

		$this->theme->loadViews('approvereq',array());

		$this->theme->loadFooter();

	}



	public function upcStatus(){

			if($this->db->query("UPDATE complain SET cm_status='$_POST[cstatus]' WHERE cm_id=$_POST[cmid]")){

				$this->core->addMsgs("sec","Complaint Status Updated successfully...");

			}else{

				$this->core->addMsgs('err',"Complaint Status Updatation error, please try again!");

			}		

	}



	public function addpages($view){

		if(trim($_POST['page'])=="") $this->core->addMsgs('err',"Please input page name!");

		if(trim($_POST['image'])=="") $this->core->addMsgs('err',"Please select page image!");

				

		if(!is_numeric($_POST['porder'])) $_POST['porder'] = 0;

		if(!is_numeric($_POST['parent'])) $_POST['parent'] = 0;

		

		if(!isset($_POST['ssbar'])) $_POST['ssbar'] = 0; else  $_POST['ssbar'] = 1;

		if(!isset($_POST['sfooter'])) $_POST['sfooter'] = 0; else  $_POST['sfooter'] = 1;

		if(!isset($_POST['sheader'])) $_POST['sheader'] = 0; else  $_POST['sheader'] = 1;

		$_POST['action'] = str_ireplace(" ","",$_POST['page']);

		

		if(!isset($_POST['edit'])){

			$where = array('pg_action' => $_POST['action']);

			$page = $this->db->get_where("pages", $where);	

			if($page->num_rows>0) {

				 $this->core->addMsgs('err',"Page '$_POST[action]' is already exist!");	

			}

		}

		if(!$this->core->error){					

				$data = array(

							'pg_pid' =>    	$_POST['parent'],

							'pg_action' =>	$_POST['action'],

							'pg_title'=>   	$_POST['page'],

							'pg_mdesc' => 	$_POST['description'],

							'pg_mkeyw'=> 	$_POST['keywords'],

							'pg_img'=> 		$_POST['image'],

							'pg_order'=> 	$_POST['porder'],

							'pg_parms'=> 	$_POST['params'],

							'pg_show'=> 	$_POST['mshow'],

							'pg_sheader'=> 	$_POST['sheader'],

							'pg_sfooter'=> 	$_POST['sfooter'],

							'pg_ssbar'=> 	$_POST['ssbar'],

							'pg_active'=> 	$_POST['status'],

							'pg_cdate'=> 	date('Y-m-d H:i:s'),

							'pg_cuser'=>    $this->session->userdata('userid')

				);

			if(isset($_POST['edit'])){

				$this->db->where('pg_id', $_POST['edit']);

				if($this->db->update('pages', $data)){

					$this->core->addMsgs("sec","Page Updated successfully...");

				}else{

					$this->core->addMsgs('err',"Page updation error, please try again!");

				}				

			}else{

				if($this->db->insert('pages', $data)){

					$lastID = $this->db->insert_id();

					$this->core->addMsgs("sec","Page added successfully...");

				}else{

					$this->core->addMsgs('err',"Page adding error, please try again!");

				}

			}

		}				

	}

	

	public function upload_picture($view){

			if (!empty($_FILES['usr_image']['name'])){

				$this->load->library('upload');

				$path=getcwd()."/assets/uploads/user_images/";

				$config['upload_path'] = $path;

				$config['allowed_types']='gif|jpg|png|jpeg';

				$this->upload->initialize($config);

				$rid=$this->core->getRrand(12);

				 if ($this->upload->do_upload('usr_image',$rid))

            {

                $img = $this->upload->data();

				//print_r($img);

					$fullpath_file = $img['full_path'];

					$filename = $img['client_name'];

					$config['image_library'] = 'gd2';

					 $config['source_image'] = $fullpath_file; 

					 $config['new_image'] = "$path".$rid.$this->session->userdata('userid').$_FILES['usr_image']['name'];

					 $updateurl=$rid.$this->session->userdata('userid').$_FILES['usr_image']['name'];

					 $config['create_thumb'] = FALSE; $config['maintain_ratio'] = TRUE; $config['width'] = 57; $config['height'] = 57; // Load the Library $this->load->library('image_lib', $config); // resize image

					 $this->load->library('image_lib', $config); 

					 $this->image_lib->resize();

					 @unlink($fullpath_file);

					  

					 if($this->core->showImagePath($this->session->userdata('userid'),"usr_image_fullpath")!=''){

						 @unlink($this->core->showImagePath($this->session->userdata('userid'),"usr_image_fullpath"));

					 }

					 

					 $this->db->query("update users set usr_image='". $updateurl."',usr_image_fullpath='".$config['new_image']."' where ur_id=".$this->session->userdata('userid')."");

					 $this->core->addMsgs("sec","Profile picture updated successfully...");

					

					  // handle if there is any problem 

					 // if ( ! $this->image_lib->resize()){ echo $this->image_lib->display_errors(); }

			//unlink("C:\wamp\www\paypal\oes\uploads\story_images\eghdhdgfhbfg.jpg");

	        }

            else

            {

                $this->core->addMsgs('err',$this->upload->display_errors());

            }

			}else{

				$this->core->addMsgs('err',"Please Select Profile Picture!");

			}

	}

	

	public function addmodules($view){

		if(trim($_POST['module'])=="") $this->core->addMsgs('err',"Please input module name!");

		if(trim($_POST['fname'])=="") $this->core->addMsgs('err',"Please input file!");

		if(!is_numeric($_POST['porder'])) $_POST['porder'] = 0;

		

		if(!$this->core->error){					

				$data = array(

							'md_title' =>    $_POST['module'],

							'md_subbtn' =>	$_POST['sbutton'],

							'md_file' => 	$_POST['fname'],

							'md_order'=> 	$_POST['porder'],

							'md_active'=> 		$_POST['status'],

							'md_cdate'=> 		date('Y-m-d H:i:s'),

							'md_cuser'=>    $this->session->userdata('userid')

				);

			if(isset($_POST['edit'])){

				$this->db->where('md_id', $_POST['edit']);

				if($this->db->update('modules', $data)){

					$this->core->addMsgs("sec","Module Updated successfully...");

				}else{

					$this->core->addMsgs('err',"Module updation error, please try again!");

				}				

			}else{

				if($this->db->insert('modules', $data)){

					$lastID = $this->db->insert_id();

					$this->core->addMsgs("sec","Module added successfully...");

				}else{

					$this->core->addMsgs('err',"Module adding error, please try again!");

				}

			}

		}				

	}

	

	private function assignaccess($view){

			if(isset($_POST['apid'])){

					$parms = explode('|',$_POST['apid']);

					if(count($parms)==3 && is_numeric($parms[0]) && is_numeric($parms[1]) && is_numeric($parms[2])){

						$pageid = $parms[0];

						$levlid = $parms[1];

						$modlid = $parms[2];				



						$mwhere = array('_ida' => $pageid,'_idb' => $modlid,'lv_id' => $levlid,'at_key' => 'views');

						$pwhere = array('_ida' => $pageid,'_idb' => 0,'lv_id' => $levlid,'at_key' => 'paces');

						

						if($_POST['atype']=='add') $active = 1; else $active = 0;

						$maccs = $this->db->get_where('attributes', $mwhere);

						$paccs = $this->db->get_where('attributes', $pwhere);

						if($maccs->num_rows>0){

							$this->db->where($mwhere);

							$this->db->update('attributes',array('at_active'=> $active));

						}else{

							$data = array(

									'_ida' =>		$pageid,		

									'_idb' =>    	$modlid,

									'lv_id' =>  	$levlid,

									'at_key' => 	'views',

									'at_active'=> 	$active,

									'at_cdate'=> 	date('Y-m-d H:i:s'),

									'at_cuser'=>    $this->session->userdata('userid')

							);	

							$this->db->insert('attributes', $data);

						}		

						

						$mwhere = array('_ida' => $pageid,'lv_id' => $levlid,'at_key' => 'views','at_active'=>1);

						$maccs = $this->db->get_where('attributes', $mwhere);

						if($maccs->num_rows>0) $active = 1; else $active = 0;

						

						if($paccs->num_rows>0){

							$this->db->where($pwhere);

							$this->db->update('attributes',array('at_active'=> $active));	

						}else{

							$data = array(

									'_ida' =>		$pageid,		

									'_idb' =>    	0,

									'lv_id' =>  	$levlid,

									'at_key' => 	'paces',

									'at_active'=> 	$active,

									'at_cdate'=> 	date('Y-m-d H:i:s'),

									'at_cuser'=>    $this->session->userdata('userid')

							);

							$this->db->insert('attributes', $data);

						}

						

					}

			}

	}



	public function addcategory($view){

		if(trim($_POST['category'])=="") $this->core->addMsgs('err',"Please input category name!");

		if(!is_numeric($_POST['parent'])) $_POST['parent']=0;

		if(isset($_POST['edit']))

			{}

			else

			{

		if(trim($_POST['category'])!=""){

			$where = array('_ida' => $_POST['parent'],'at_value' => $_POST['category'],'at_key' => 'cmpcat');

			$caccs = $this->db->get_where('attributes', $where);

			if($caccs->num_rows>0) $this->core->addMsgs('err',"Category '$_POST[category]' is already exist!");

			

		}

			}

		if(!$this->core->error){								

				$data = array(

							'at_key' 	=>  'cmpcat',

							'at_value' 	=>  $_POST['category'],

							'_ida' 	   	=>	$_POST['parent'],

							'at_desc'	=>  $_POST['description'],

							'at_cdate'	=> 	date('Y-m-d H:i:s'),

							'at_cuser'	=>  $this->session->userdata('userid')

				);

			

				

		if(isset($_POST['edit'])){

					$data = array(

							'at_key' 	=>  'cmpcat',

							'at_value' 	=>  $_POST['category'],

							'_ida' 	   	=>	$_POST['parent'],

							'at_desc'	=>  $_POST['description'],

							'at_cdate'	=> 	date('Y-m-d H:i:s'),

							'at_cuser'	=>  $this->session->userdata('userid')

				);

				

				$this->db->where('at_id', $_POST['edit']);

				if($this->db->update('attributes', $data)){

					$this->core->addMsgs("sec","Category Updated successfully...");

				}else{

					$this->core->addMsgs('err',"Category updation error, please try again!");

				}				

			}	else

			{

			

			

			if($this->db->insert('attributes', $data)){

				if($_POST['parent']!=0) {

							$this->db->where(array('at_id' => $_POST['parent']));

							$this->db->update('attributes',array('at_hsub'=> 1));				

				}

				$this->core->addMsgs("sec","Category added successfully...");

			}else{

				$this->core->addMsgs('err',"Category adding error, please try again!");

			}

			}

		}				

	}

	

	public function adddepartment($view){

		if(trim($_POST['department'])=="") $this->core->addMsgs('err',"Please input department name!");

		if(trim($_POST['sname'])=="") $this->core->addMsgs('err',"Please input department short name!");

		if(!is_numeric($_POST['head'])) $this->core->addMsgs('err',"Please select department head!");

		

		if(!$this->core->error){					

				$data = array(

							'dp_name' =>    $_POST['department'],

							'dp_sname' =>	$_POST['sname'],

							'dp_desc'=>   	$_POST['description'],

							'dp_head'=> 	$_POST['head'],

							'dp_cdate'=> 	date('Y-m-d H:i:s'),

							'dp_cuser'=>    $this->session->userdata('userid')

				);

			if($this->db->insert('department', $data)){

				$this->core->addMsgs("sec","Department added successfully...");

			}else{

				$this->core->addMsgs('err',"Department adding error, please try again!");

			}

		}				

	}

	

	public function addindustry($view){

		if(trim($_POST['industry'])=="") $this->core->addMsgs('err',"Please input industry name!");





		if(!$this->core->error){	

		

					

		if(isset($_POST['edit'])){

					$data = array(

							'in_name' =>    $_POST['industry'],

							'in_desc'=>   	$_POST['description'],

							'in_cdate'=> 	date('Y-m-d H:i:s'),

							'in_cuser'=>    $this->session->userdata('userid')

				);

				

				$this->db->where('in_id', $_POST['edit']);

				if($this->db->update('industry', $data)){

					$this->core->addMsgs("sec","Industry Updated successfully...");

				}else{

					$this->core->addMsgs('err',"Industry updation error, please try again!");

				}				

			}

		

		else{				

				$data = array(

							'in_name' =>    $_POST['industry'],

							'in_desc'=>   	$_POST['description'],

							'in_cdate'=> 	date('Y-m-d H:i:s'),

							'in_cuser'=>    $this->session->userdata('userid')

				);

			if($this->db->insert('industry', $data)){

				$this->core->addMsgs("sec","Industry added successfully...");

			}else{

				$this->core->addMsgs('err',"Industry adding error, please try again!");

			}

		}

		}				

	}

	

	public function addvendor($view){

		if(trim($_POST['company'])=="") $this->core->addMsgs('err',"Please input company name!");

				

		//if(!$this->core->validateEmail($_POST['cemail'])) $this->core->addMsgs('err',"Please input a valid email adress!");

			

		if(!is_numeric($_POST['industry'])) $this->core->addMsgs('err',"Please select industry!");

		

		if(!$this->core->error){					

				$data = array(

							'vd_name' =>    	$_POST['company'],

							'vd_email' =>		$_POST['cemail'],

							'vd_adress'=>   	$_POST['address'],

							'vd_cperson' => 	$_POST['cperson'],

							'vd_contact'=> 		$_POST['cphone'],

							'vd_mobile'=> 		$_POST['cmobile'],

							'vd_regnum'=> 		$_POST['rnumber'],

							'in_id'=> 			$_POST['industry'],

							'vd_cuser'=>    	$this->session->userdata('userid'),

							'vd_bankname'=> 	$_POST['vdbankname'],

							'vd_acctitle'=> 	$_POST['vdacctitle'],

							'vd_accnumber'=> 	$_POST['vdaccnumber'],

							'vd_branchname'=> 	$_POST['vdbranchname'],

							'vd_branchcode'=> 	$_POST['vdbranchcode'],

							'vd_swiftcode'=> 	$_POST['vdswiftcode'],

							'vd_cnicnumber'=> 	$_POST['cnicnumber'],

							'vd_remarks'=> 		$_POST['vdremarks'],

							'vd_area'=>			$_POST['carea'],

							'vd_city'=>			$_POST['ccity'],
							
							'vd_website'=>		$_POST['website'],
						
							'vd_approval' => 	$_POST['vdapproval'],
							
							'vd_gst' => 		$_POST['gstno'],
							
							'vd_govt_license' =>$_POST['govt_license'],
							
							'vd_designation' => $_POST['designation'],
							
							'vd_fax' => 		$_POST['fax']
					
				);

			if(isset($_POST['edit'])){

				$this->db->where('vd_id', $_POST['edit']);

				if($this->db->update('vendors', $data)){

					$this->core->addMsgs("sec","Vendor Updated successfully...");

				}else{

					$this->core->addMsgs('err',"Vendor updation error, please try again!");

				}				

			}else{

				if($this->db->insert('vendors', $data)){

				$this->core->addMsgs("sec","Vendor added successfully...");

				}else{

				$this->core->addMsgs('err',"Vendor adding error, please try again!");

				}

			}

		}				

	}

	

	

	public function addemployee($view){

		if(trim($_POST['fname'])=="") $this->core->addMsgs('err',"Please input first name!");

		if(trim($_POST['lname'])=="") $this->core->addMsgs('err',"Please input last name!");

		if(trim($_POST['dob'])=="") $this->core->addMsgs('err',"Please input Dob!");

		if(trim($_POST['nic'])=="") $this->core->addMsgs('err',"Please input nic!");

		

		if(!$this->core->validateEmail($_POST['email'])){

				$this->core->addMsgs('err',"Please input a valid email adress!");

		}else{

				if(!isset($_POST['edit']))

				{

			$_POST['email'] = addslashes(trim($_POST['email']));

			$where = array('ur_uname' => $_POST['email']);

			$user = $this->db->get_where("users", $where);	

			if($user->num_rows>0) {

				 $this->core->addMsgs('err',"User '$_POST[email]' is already exist!");	

					}

			}

		}

			

		if(!is_numeric($_POST['company'])) $this->core->addMsgs('err',"Please select company!");

		

		if(!is_numeric($_POST['department'])) $this->core->addMsgs('err',"Please select department!");

		if(!is_numeric($_POST['ulevel'])) $this->core->addMsgs('err',"Please select user level!");

			if(!isset($_POST['edit']))

				{

		if(trim($_POST['password'])!=trim($_POST['password']) && trim($_POST['password'])!="") $this->core->addMsgs('err',"Please input correct password!");

				}

		



		if(!$this->core->error){

				$salt = $this->core->getRrand(8);

				if(!isset($_POST['edit']))

				{

				$pass = md5(md5($_POST['password']).md5($salt));					

				$data = array(

							'ur_fname' =>     $_POST['fname'],

							'ur_lname'=>     $_POST['lname'],

							'ur_email'=>     trim($_POST['email']),

							'cm_id'=>     $_POST['company'],

							'dp_id'=>     $_POST['department'],

							'ur_sup'=>     $_POST['supervisor'],

							'ur_uname'=>     trim($_POST['email']),

							'ur_pass'=>     $pass,

							'ur_salt'=>     $salt,

							'ur_passport'=>     $_POST['passport'],

							'ur_phone'=>     $_POST['phone'],

							'ur_mobile'=>     $_POST['mobile'],
							
							'ur_emergency_contact'=>     $_POST['emergency_contact'],

							'ur_dob'=>     $_POST['dob'],

							'ur_gender'=>     $_POST['gender'],

							'ur_address'=>     $_POST['Address'],

							'ur_nic'=>     $_POST['nic'],

							'lv_id'=>     $_POST['ulevel'],

							'ur_active'=>     $_POST['status'],

							'ur_cdate'=>     date('Y-m-d H:i:s'),

							'ur_cuser'=>     $this->session->userdata('userid')

				);

				}

				else

				{

					$data = array(

							'ur_fname' =>     $_POST['fname'],

							'ur_lname'=>     $_POST['lname'],

							'ur_email'=>     trim($_POST['email']),

							'cm_id'=>     $_POST['company'],

							'dp_id'=>     $_POST['department'],

							'ur_sup'=>     $_POST['supervisor'],

							'ur_uname'=>     trim($_POST['email']),

							'ur_passport'=>     $_POST['passport'],

							'ur_phone'=>     $_POST['phone'],

							'ur_mobile'=>     $_POST['mobile'],

							'ur_dob'=>     $_POST['dob'],

							'ur_gender'=>     $_POST['gender'],

							'ur_address'=>     $_POST['Address'],

							'ur_nic'=>     $_POST['nic'],

							'lv_id'=>     $_POST['ulevel'],

							'ur_active'=>     $_POST['status'],

							'ur_cdate'=>     date('Y-m-d H:i:s'),

							'ur_cuser'=>     $this->session->userdata('userid')

							);

				}

				

			if(isset($_POST['edit']))

			{

				$this->db->where('ur_id', $_POST['edit']);

				if($this->db->update('users', $data)){

					$this->core->addMsgs("sec","User Updated successfully...");

				}else{

					$this->core->addMsgs('err',"User updation error, please try again!");

				}			

			}

			else{

				if($this->db->insert('users', $data)){

				$this->core->addMsgs("sec","User added successfully...");

				}else{

				$this->core->addMsgs('err',"User adding error, please try again!");

					}

			}

			

			

			

		}	

	}

	

	

	public function verifiedby(){

		if(is_numeric($_POST['rqid'])){

		if(trim($_POST['rqtatus'])=="") $this->core->addMsgs('err',"Please select requisition status!");

			if(!$this->core->error){

					switch($_POST['type']){

						case 1:

							$data = array(

							   'rq_chksts' =>   $_POST['rqtatus'],

							   'rq_chkdate' =>   date('Y-m-d H:i:s'),

							   'rq_chkcm' =>     $_POST['rqcomment'],

							   'rq_chkby' => $this->session->userdata('userid')

							);

							$apvke='f1916ffa5cecdfa5e48bfc2a33c8c94f23';
							$emaile='a.rahman@riskdiscovered.com';
							
							$apvk='e7a005031292b59bf934b7f13c3e6219v';

							$email='masad@riskdiscovered.com';

							$type='2';	

							$subject = "$_POST[rqtatus] by Admin";

							$this->purchaseStats($subject,$_POST['rqid'],$_POST['rqtatus'],'ashabbir@riskdiscovered.com');
							
							$this->purchaseStats($subject,$_POST['rqid'],$_POST['rqtatus'],'khizer@riskdiscovered.com');	
							
							$this->purchaseStats($subject,$_POST['rqid'],$_POST['rqtatus'],'suresh@riskdiscovered.com');
							
						break;

						case 2:
							if(!isset($_POST['rqcomment'])) $_POST['rqcomment']='';
							
							$data = array(

							   'rq_versts' =>   $_POST['rqtatus'],

							   'rq_verdate' =>   date('Y-m-d H:i:s'),

							   'rq_vercm' =>     $_POST['rqcomment'],

							   'rq_verby' => $this->session->userdata('userid')

							);
							
										
							$apvk='d907c75dba1a3e6a3510339b88f4750cv';

							$email='danish@xcluesiv.com';

							$type='3';	

							$subject = "$_POST[rqtatus] by finance";		

							$this->purchaseStats($subject,$_POST['rqid'],$_POST['rqtatus'],'kamal@riskdiscovered.com');

							$this->purchaseStats($subject,$_POST['rqid'],$_POST['rqtatus'],'ashabbir@riskdiscovered.com');
							
							$this->purchaseStats($subject,$_POST['rqid'],$_POST['rqtatus'],'Khizer@riskdiscovered.com');
							
							$this->purchaseStats($subject,$_POST['rqid'],$_POST['rqtatus'],'suresh@riskdiscovered.com');					

						break;

						case 3:

							$data = array(

							   'rq_ceosts' =>   $_POST['rqtatus'],

							   'rq_ceodate' =>   date('Y-m-d H:i:s'),

							   'rq_ceocm' =>     $_POST['rqcomment'],

							   'rq_ceoapp' => $this->session->userdata('userid')

							);	

							$subject = "$_POST[rqtatus] by CEO";	

							$this->purchaseStats($subject,$_POST['rqid'],$_POST['rqtatus'],'kamal@riskdiscovered.com');

							$this->purchaseStats($subject,$_POST['rqid'],$_POST['rqtatus'],'ashabbir@riskdiscovered.com');
							
							$this->purchaseStats($subject,$_POST['rqid'],$_POST['rqtatus'],'khizer@riskdiscovered.com');
							
							$this->purchaseStats($subject,$_POST['rqid'],$_POST['rqtatus'],'suresh@riskdiscovered.com');	
							
							$this->purchaseStats($subject,$_POST['rqid'],$_POST['rqtatus'],'a.rahman@riskdiscovered.com');	
							
							$this->purchaseStats($subject,$_POST['rqid'],$_POST['rqtatus'],'masad@riskdiscovered.com');	
							
						break;

					}

					$this->db->where('rq_id', $_POST['rqid']);

					if(!$this->db->update('requisition',$data)){

						$this->core->addMsgs('err',"Requisition status updation error!");

					}else{

						if($_POST['rqtatus']=='Approved' && isset($apvk)){
							 $this->purchaseEmail($_POST['rqid'],$apvk,$email,$type);
								if(isset($apvke)){
									$this->purchaseEmail($_POST['rqid'],$apvke,$emaile,$type);
							 	}
						}

						$this->core->addMsgs("sec","Requisition status updated successfully...");

					}

			}

		}

	}

	

	public function commentslist($view){

		if(trim($_POST['reply'])=="") $this->core->addMsgs('err',"Please input reply!");

		if(!$this->core->error){

				$data = array(

				   '_ida' =>     $_POST['sysid'],

				   '_idb' =>     $_POST['rpid'],

				   'at_value' => $_POST['reply'],

				   'at_key' =>   $_POST['cmdkes'],

				   'at_cuser' => $this->session->userdata('userid')

				);

			if($this->db->insert('attributes', $data)){

				$this->core->addMsgs("sec","Reply submitted successfully...");

			}else{

				$this->core->addMsgs('err',"Reply Adding error, please try again!");

			}

		}

	}

	

	public function porderdetail($view){

		if(isset($_FILES["Invoice"])){

				$poid= $_REQUEST['rqid'];

				$fPath = $this->core->attachFile($poid.'-invc',"attachments/",$_FILES['Invoice']['tmp_name'],$_FILES['Invoice']['name']);

				if($fPath){

					$this->db->where('rq_id', $poid);

					if($this->db->update('requisition', array("re_invatt" => $fPath,"re_invtit"=>$_FILES['Invoice']['name']))){

						$this->core->addMsgs("sec","Invoice Attached successfully...");

					}else{

						$this->core->addMsgs("err","Invoice Attachment error!");

					}

				}					

		}

	}

	

	public function addcomments($view){

		if(trim($_POST['comTxt'])=="") $this->core->addMsgs('err',"Please input some Comments!");

		if(!$this->core->error){

				$data = array(

				   '_ida' =>     $_POST['sysid'],

				   'at_value' => $_POST['comTxt'],

				   'at_key' =>   $_POST['cmdkes'],

				   'at_cuser' => $this->session->userdata('userid')

				);

			if($this->db->insert('attributes', $data)){

				$this->core->addMsgs("sec","Comments submitted successfully...");

			}else{

				$this->core->addMsgs('err',"Comments Adding error, please try again!");

			}

		}

	}

	

	public function purchaseItems($lastID){

		foreach($_POST['items']as $key=>$item){

				if(trim($_POST['items'][$key])!=""){

					$data = array(

							   'rq_id' =>     $lastID,

							   'it_name' => $_POST['items'][$key],

							   'it_units' =>   $_POST['units'][$key],

							   'it_quantity' =>   $_POST['quantity'][$key],

							   'it_desc' =>   $_POST['description'][$key],

							   'it_uprice' =>   $_POST['price'][$key],

							   'it_cuser' => $this->session->userdata('userid')

					);

							

					if(is_numeric($_POST['item'][$key])){

						$this->db->where('it_id', $_POST['item'][$key]);

						if(!$this->db->update('items', $data)){

							$this->core->addMsgs('err',"Requisition items ($_POST[items][$key]) updation error!");

						}

					}else{

						if(!$this->db->insert('items', $data)){

							$this->core->addMsgs('err',"Requisition items ($_POST[items][$key]) adding error!");

						}

					}

				}

		}

		

		if(isset($_POST['delete'])){

			foreach($_POST['delete']as $key=>$delete){

				if(is_numeric($delete)){

					$data = array('it_active'=>0);

					$this->db->where('it_id',$delete);

					$this->db->update('items', $data);

				}

			}

		}

		

		$fInd = 1;

		if(isset($_FILES["attch"])){

			foreach($_FILES["attch"]["error"] as $key => $error) {

			   if ($error == UPLOAD_ERR_OK){

					$fPath = $this->core->attachFile($lastID.$fInd,"attachments/",$_FILES['attch']['tmp_name'][$key],$_FILES['attch']['name'][$key]);

					if($fPath){

						$this->db->where('rq_id', $lastID);

						$this->db->update('requisition', array("rq_att$fInd" => $fPath,"rq_attt$fInd"=>$_FILES['attch']['name'][$key]));	

						$fInd++;	

					}

				}

			}

		}

										

	}

	

	public function purchaserequisition($view){

		if(!is_numeric($_REQUEST['edit'])){

			if(!is_numeric($_POST['complaint'])) $this->core->addMsgs('err',"Please select complaint #!");

		}

		if(!is_numeric($_POST['requested'])) $this->core->addMsgs('err',"Please select requested By!");

		if(!is_numeric($_POST['vendor'])) $this->core->addMsgs('err',"Please select vendor!");

		if(!is_numeric($_POST['company'])) $this->core->addMsgs('err',"Please select company!");

		if(!is_numeric($_POST['department'])) $this->core->addMsgs('err',"Please select department!");

		if(trim($_POST['nature'])=="") $this->core->addMsgs('err',"Please select nature!");

		if(!is_numeric($_POST['taxes']))  $_POST['taxes'] = 0;

		if(!is_numeric($_POST['shipp']))  $_POST['shipp'] = 0;

		if(!is_numeric($_POST['misc']))   $_POST['misc'] = 0;

		if(!$this->core->error){

				$data = array(

				   'rq_nature' =>     $_POST['nature'],

				   'rq_vendor' => $_POST['vendor'],

				   'rq_taxamount' =>   $_POST['taxes'],

				   'rq_shipping' =>   $_POST['shipp'],

				   'rq_depart' =>   $_POST['department'],

				   'rq_misc' =>   $_POST['misc'],

				   'rq_justfi' =>   $_POST['justifi'],

				   'rq_requby' =>   $_POST['requested'],

				   'cm_id' =>   $_POST['company']

				);

				

				if(is_numeric($_REQUEST['edit'])){

					$this->db->where('rq_id', $_REQUEST['edit']);

					if($this->db->update('requisition', $data)){

						

						$this->purchaseItems($_REQUEST['edit']);

						

						$this->core->addMsgs("sec","Requisition Updated successfully...");

					}else{

						$this->core->addMsgs('err',"Requisition updation error, please try again!");

					}

				}else{

				 	$data = array_merge($data,array('cp_id'=>$_POST['complaint'],'rq_cuser'=>$this->session->userdata('userid')));

					if($this->db->insert('requisition', $data)){

					$lastID = $this->db->insert_id();

					$pr = $this->core->cCode($lastID);

					

					$this->db->where('rq_id', $lastID);

					$this->db->update('requisition', array('rq_refnum' => "PR-$pr",'rq_podrnum' => "PO-$pr")); 

					

					$this->purchaseItems($lastID);

					

					$this->purchaseEmail($lastID,'0676d5377e06ada02fa2711c404b4eb0v','jawaid@riskdiscovered.com',1);

					

					$this->core->addMsgs("sec","Requisition Added successfully...");

				}else $this->core->addMsgs('err',"Requisition Adding error, please try again!");

				}

			}else{

				$this->core->addMsgs('err',"Requisition Adding error, please try again!");

			}

	}

	

	public function purchasereRemov(){

			if(is_numeric($_POST['reqDelete'])){

				$this->db->where('rq_id', $_POST['reqDelete']);

				if($this->db->update('requisition', array('rq_active'=>0))){

					$this->core->addMsgs("sec","Requisition removed successfully...");

				}

			}		

	}

	public function pendingapproval(){
		if(isset($_POST['rq_ids'])) {
			foreach($_POST['rq_ids'] as $rq_ids) {
				$_POST['rqid'] = $rq_ids;
				$_POST['type'] = 3;
				$this->verifiedby();
    		}
		}
	}
	
	public function requesitionapproval(){
                    		 
						    $html = "";
                            $tbls = "complain cm INNER JOIN requisition rq ON cm.cm_id=rq.cp_id";				
                            $where = array('rq.rq_active' => 1, 'rq_chksts' => 'Approved', 'rq_versts' => 'Approved', 'rq_ceosts' => NULL );
                            $this->db->select('cm_cat,rq_justfi,rq_chksts,rq_versts,rq_ceosts,rq_cdate,rq_depart,rq_nature,rq_requby,rq_refnum,rq.rq_id,rq.cm_id,cm.cm_rid,rq.cp_id');
							$this->db->limit(10);
							$requisitions = $this->db->get_where($tbls, $where);

                            if($requisitions->num_rows>0){
		$html = $html.'<table style="width:100%;">
                    <thead>
                        <tr>
                        	<th>Requisition #</th>
                            <th>Requisition Date</th>
                            <th>Quantity</th>
                        	<th>Item</th>
                            <th>Description</th>
                            <th>Nature</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                	<tbody>';

                                foreach ($requisitions->result() as $requisition){
                                	$html = $html. '<tr>
                                    	<td><a href="'.$this->config->base_url().'?action=requisitiondetail&rqid='.$requisition->rq_id.'">'.$requisition->rq_refnum.'</a></td> 
                                        <td>'.date("j-M-Y",strtotime($requisition->rq_cdate)).'</td>
                                        <td>';
                                      
											$rq_id  = $requisition->rq_id;
                                        	$query = $this->db->query("select * from `items` where `rq_id`=$rq_id LIMIT 1");

											if ($query->num_rows() > 0)
											{
  											 foreach ($query->result() as $row)
  												 {
     											 $html = $html.$row->it_quantity;
      										
   												}
											}
										
                                   $html = $html.' </td>
                                   		<td>';
                                        
                                       
											$rq_id  = $requisition->rq_id;
                                        	$query = $this->db->query("select * from `items` where `rq_id`=$rq_id LIMIT 1");

											if ($query->num_rows() > 0)
											{
  											 foreach ($query->result() as $row)
  												 {
     											 $html = $html.$row->it_name;
      										
   												}
											}
										$html = $html.'</td>
                                        <td>'.$requisition->rq_justfi.'</td>
                                        <td>'.$requisition->rq_nature.'</td> 
                                        
                                        <td>';
											$show = true;
                                        	if($requisition->rq_ceosts!=""){
												$show = false;
												$html = $html. "$requisition->rq_ceosts (CEO)";
											}elseif($requisition->rq_versts!="") {
												$html = $html. "$requisition->rq_versts (FIN)";
											}elseif($requisition->rq_chksts!="") {
												$html = $html. "$requisition->rq_chksts (ADM)";
											}
										$html = $html.'</td>
                                        <td>';
                                         
										$apvk='d907c75dba1a3e6a3510339b88f4750cv';
										$typ = 3;
										$link = $this->config->base_url()."?action=requisitiondetail&rqid=$rq_id&apvkey=$apvk&type=$typ";

										$rjklnk="$link&verified=Rejected";

										$aprlnk="$link&verified=Approved";

										$hldlnk="$link&verified=On Hold";
									
										   $html = $html.'<div style="margin-top:10px;vertical-align:central;" > 
                                            		<a href="'.$aprlnk.'" style="margin-top:5px;">Approve</a><br />
                                               	 	<a href="'.$rjklnk.'" style="margin-top:5px;">Reject</a><br />
                                                	<a href="'.$hldlnk.'" style="margin-top:5px;">On Hold</a>
                                            	</div>';
                            $html = $html.' </td>
                                    </tr>';
                        	}
                            
                       
                        	
                $html = $html.'  </tbody>
                 
                </table>';
				
				}
				
				return $html;
	}
	

	public function addcomplaint($view){

			if(trim($_POST['cmcat'])=="") $this->core->addMsgs('err',"Please select complaint Category!");

			if(trim($_POST['cmdes'])=="")    $this->core->addMsgs('err',"Please input complaint description!");

			

			$where = array('at_active' => 1,'at_key' => 'sellist','_idb' => $view->md_id,'_ida' => $view->_ida,'lv_id' =>$this->session->userdata('levelid'));

			$employees = $this->db->get_where("attributes", $where);

			

			if($employees->num_rows>0){

				if(!is_numeric($_POST['empid'])) $this->core->addMsgs('err',"Please select Employee!");

			}

			

			$userid = ($employees->num_rows>0)?$_POST['empid']:$this->session->userdata('userid');

	

	

	

	

	

			if(!$this->core->error){

				if(isset($_POST['edit'])){

					$data = array(

					   'cm_cat' => $_POST['cmcat'],

					   'cm_des' => $_POST['cmdes'],

					   'cm_nut' => $_POST['nature']

	

					);

					

				$this->db->where('cm_id', $_POST['edit']);

				if($this->db->update('complain', $data)){

					

					$fInd=1;

					if(isset($_FILES["attch"])){

			foreach($_FILES["attch"]["error"] as $key => $error) {

			   if ($error == UPLOAD_ERR_OK){

					$fPath = $this->core->attachFile($_POST['edit'].$fInd,"attachments/",$_FILES['attch']['tmp_name'][$key],$_FILES['attch']['name'][$key]);

					if($fPath){

						$this->db->where('cm_id',$_POST['edit']);

						$this->db->update('complain', array("cm_att$fInd" => $fPath));	

						$fInd++;	

					}

				}

			}

		}

					

					

					$this->core->addMsgs("sec","Complain Updated successfully...");

					}else{

					$this->core->addMsgs('err',"Complain updation error, please try again!");

					}				

				}else{

				

				$data = array(

					   'cm_cat' => $_POST['cmcat'],

					   'cm_des' => $_POST['cmdes'],

					   'cm_nut' => $_POST['nature'],

					   'cm_user' => $userid,

					   'cm_added' => $this->session->userdata('userid'),

					   'cm_status' => 'Open'

					);

				if($this->db->insert('complain', $data)){

					$lastID = $this->db->insert_id();

					$cm = "CM-".$this->core->cCode($lastID);

					$this->db->where('cm_id', $lastID);

					$this->db->update('complain', array('cm_rid' => $cm));

					

					$fInd=1;

					if(isset($_FILES["attch"])){

			foreach($_FILES["attch"]["error"] as $key => $error) {

			   if ($error == UPLOAD_ERR_OK){

					$fPath = $this->core->attachFile($lastID.$fInd,"attachments/",$_FILES['attch']['tmp_name'][$key],$_FILES['attch']['name'][$key]);

					if($fPath){

						$this->db->where('cm_id', $lastID);

						$this->db->update('complain', array("cm_att$fInd" => $fPath));	

						$fInd++;	

					}

				}

			}

		}

										

					$date = date("j-M-Y");

					

					$uInfo = $this->core->getUsers(array('ur.ur_id'=>$userid));

					$uInfo = $uInfo->row();

					$uName = $uInfo->ur_fname." ".$uInfo->ur_lname;

					$table = "<table width=\"100%\">

									<tr>

										<td><strong>Complaint Person</strong></td>

										<td>$uName</td>

									</tr>					

									<tr>

										<td><strong>Complaint Category</strong></td>

										<td>$_POST[cmcat]</td>

									</tr>

									<tr>

										<td><strong>Nature</strong></td>

										<td>$_POST[nature]</td>

									</tr>									

									<tr>

										<td><strong>Complaint Date</strong></td>

										<td>$date</td>

									</tr>

									<tr>

										<td><strong>Description</strong></td>

										<td>$_POST[cmdes]</td>

									</tr>																		

							 </table>";

					

					$cmail = "danish@xcluesiv.com,ashabbir@riskdiscovered.com,Khizer@riskdiscovered.com,suresh@riskdiscovered.com,".$uInfo->ur_email;
					
					
					if($_POST['cmcat'] == "Information Technology (IT)")  $cmail = "$cmail,saqib@riskdiscovered.com,ubaid@riskdiscovered.com";
					 	
					if($uInfo->ur_sup!=0){

						$sInfo = $this->core->getUsers(array('ur.ur_id'=>$uInfo->ur_sup));

						$sInfo = $sInfo->row();	

						$cmail = $cmail.",".$sInfo->ur_email;

					}

					

					$this->core->emailTmp($table,"[Complaint ID:$cm] Added by $uName","kamal@riskdiscovered.com",'',$cmail);

					

					$this->core->addMsgs("sec","Your complaint Submitted successfully...");

				}else{

					$this->core->addMsgs('err',"Complaint Submitted error, please try again!");

				}

			}

			

			}

	}

		

	public function purchaseEmail($reqid,$apvkey,$toEmail,$typ){

		

		$where = array('rq_active'=>1,'rq_id'=>$reqid);

		$requisition = $this->db->get_where("requisition", $where);

		

			

		if($requisition->num_rows>0){

			

			$requisition = $requisition->row();

			

			$where = $this->core->getWhere(array('it_active'=>1,'rq_id'=>$requisition->rq_id),'','');

			$items = $this->db->get_where("items", $where);

			

			if($items->num_rows>0){		

		

			$link = $this->config->base_url()."?action=requisitiondetail&rqid=$reqid&apvkey=$apvkey&type=$typ";

			$rjklnk="$link&verified=Rejected";

			$aprlnk="$link&verified=Approved";

			$hldlnk="$link&verified=On Hold";

			

			

			$buttons = '<div style="text-align:center;">

		

			<a href="'.$aprlnk.'"

			style="background-color: #e31c23;	

			background-image: -webkit-gradient(linear, left top, left bottom, from(#e31c23), to(#b40911)); /* Saf4+, Chrome */

			background-image: -webkit-linear-gradient(top, #e31c23, #b40911); /* Chrome 10+, Saf5.1+, iOS 5+ */

			background-image:    -moz-linear-gradient(top, #e31c23, #b40911); /* FF3.6 */

			background-image:     -ms-linear-gradient(top, #e31c23, #b40911); /* IE10 */

			background-image:      -o-linear-gradient(top, #e31c23, #b40911); /* Opera 11.10+ */

			background-image:         linear-gradient(top, #e31c23, #b40911);

			border-radius:6px;

			-moz-border-radius:6px;

			-webkit-border-radius:6px;

			-o-border-radius:6px;

			font-weight:bold;

			border-color: #b40911;

			color: white;

			border: 1px solid #000;

			text-shadow: 0 1px 0 #000;

			padding:5px 10px;

			box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3);

			transition: background 5000ms ease-in;"

			>Approve</a>

			

			<a href="'.$rjklnk.'"

			style="background-color: #e31c23;	

			background-image: -webkit-gradient(linear, left top, left bottom, from(#e31c23), to(#b40911)); /* Saf4+, Chrome */

			background-image: -webkit-linear-gradient(top, #e31c23, #b40911); /* Chrome 10+, Saf5.1+, iOS 5+ */

			background-image:    -moz-linear-gradient(top, #e31c23, #b40911); /* FF3.6 */

			background-image:     -ms-linear-gradient(top, #e31c23, #b40911); /* IE10 */

			background-image:      -o-linear-gradient(top, #e31c23, #b40911); /* Opera 11.10+ */

			background-image:         linear-gradient(top, #e31c23, #b40911);

			border-radius:6px;

			-moz-border-radius:6px;

			-webkit-border-radius:6px;

			-o-border-radius:6px;

			font-weight:bold;

			border-color: #b40911;

			color: white;

			border: 1px solid #000;

			text-shadow: 0 1px 0 #000;

			padding:5px 10px;

			box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3);

			transition: background 5000ms ease-in;"

			>Reject</a>

			

			<a href="'.$hldlnk.'"

			style="background-color: #e31c23;	

			background-image: -webkit-gradient(linear, left top, left bottom, from(#e31c23), to(#b40911)); /* Saf4+, Chrome */

			background-image: -webkit-linear-gradient(top, #e31c23, #b40911); /* Chrome 10+, Saf5.1+, iOS 5+ */

			background-image:    -moz-linear-gradient(top, #e31c23, #b40911); /* FF3.6 */

			background-image:     -ms-linear-gradient(top, #e31c23, #b40911); /* IE10 */

			background-image:      -o-linear-gradient(top, #e31c23, #b40911); /* Opera 11.10+ */

			background-image:         linear-gradient(top, #e31c23, #b40911);

			border-radius:6px;

			-moz-border-radius:6px;

			-webkit-border-radius:6px;

			-o-border-radius:6px;

			font-weight:bold;

			border-color: #b40911;

			color: white;

			border: 1px solid #000;

			text-shadow: 0 1px 0 #000;

			padding:5px 10px;

			box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3);

			transition: background 5000ms ease-in;"

			>Hold</a>

			

			</div>';

	

				$company = $this->core->getCompany(array("cm_id"=>$requisition->cm_id));

				$company = $company->row();

				

				

				$vendor = $this->core->getData(array("vd_id"=>$requisition->rq_vendor),'vendors');

				$vendor = $vendor->row();

				

				

				$requisition_data = '<div class="section">

							<h2>Requested by '.$this->core->showUname($requisition->rq_requby).'</h2>                             

							<div class="columns clearfix">

								<div class="col_50"><strong>Requisition #:</strong><a href="'.$link.'">'.$requisition->rq_refnum.'</a></div>

								<div class="col_50"><strong>Company:</strong>'.$company->cm_name.'</div>

								<div class="col_50"><strong>Vendor Name:</strong>'.$vendor->vd_name.'</div>            

							</div> 

					</div>

					<br/><br/>

					<div class="section">

						<table width="100%">

							<thead>

								<tr>

									<th>Quantity</th>

									<th>Item</th>

									<th>Units</th>

									<th>Description</th>

									<th>Estimated Unit Price</th>

									<th>Total</th>

								</tr>

							</thead>

							<tbody>';

							

										$subTotal = 0;

										foreach ($items->result() as $item){ 

											$subTotal = $subTotal+($item->it_uprice*$item->it_quantity);

											$requisition_data = $requisition_data.'<tr> <td>'.$item->it_quantity.'</td> <td>'.$item->it_name.'</td>                                    

												<td>'.$item->it_units.'</td> <td>'.$item->it_desc.'</td> <td>'.$item->it_uprice.'</td> <td>'.$item->it_uprice*$item->it_quantity.'</td> </tr>';

										}

										

										$requisition_data = $requisition_data.'<tr>

											<td colspan="4"><strong>* - Taxes as Applicable</strong></td>

											<td><strong>Subtotal</strong></td>

											<td>'.$subTotal.'</td>

										</tr>

										<tr>

											<td colspan="4"></td>

											<td><strong>Tax Amount*</strong></td>

											<td>'.$requisition->rq_taxamount.'</td>

										</tr>

										<tr>

											<td colspan="4"></td>

											<td><strong>Shipping</strong></td>

											<td>'.$requisition->rq_shipping.'</td>

										</tr>

										<tr>

											<td colspan="4"></td>

											<td><strong>Miscellaneous</strong></td>

											<td>'.$requisition->rq_misc.'</td>

										</tr>

										<tr>

											<td colspan="4"></td>

											<td><strong>Total</strong></td>

											<td>'.($subTotal+$requisition->rq_misc+$requisition->rq_shipping+$requisition->rq_taxamount).'</td>

										</tr>

						  </tbody>

						</table>

						<br/><br/>'.$buttons.'</div>';


					if($typ==3) $requisition_data = $requisition_data.$this->requesitionapproval();
					
					$rqnum = $requisition->rq_refnum;

					//"rizwan@riskdiscovered.com"

					$this->core->emailTmp($requisition_data,"Need Approval [Purchase Requisition #:$rqnum]",$toEmail,'','');

					return true;

			}

		}

				return false;

	}

	

	

	public function purchaseStats($eSubject,$reqid,$status,$toEmail){

		

		$where = array('rq_active'=>1,'rq_id'=>$reqid);

		$requisition = $this->db->get_where("requisition", $where);

		

			

		if($requisition->num_rows>0){

			

			$requisition = $requisition->row();

			

			$where = $this->core->getWhere(array('it_active'=>1,'rq_id'=>$requisition->rq_id),'','');

			$items = $this->db->get_where("items", $where);

			

			if($items->num_rows>0){		

		

			$link = $this->config->base_url()."?action=requisitiondetail&rqid=$reqid";



				$company = $this->core->getCompany(array("cm_id"=>$requisition->cm_id));

				$company = $company->row();

				

				

				$vendor = $this->core->getData(array("vd_id"=>$requisition->rq_vendor),'vendors');

				$vendor = $vendor->row();

				

				

				$requisition_data = '<div class="section">

							<h2>Requested by '.$this->core->showUname($requisition->rq_requby).'</h2>                             

							<div class="columns clearfix">

								<div class="col_50"><strong>Requisition #:</strong><a href="'.$link.'">'.$requisition->rq_refnum.'</a></div>

								<div class="col_50"><strong>Company:</strong>'.$company->cm_name.'</div>

								<div class="col_50"><strong>Vendor Name:</strong>'.$vendor->vd_name.'</div>            

							</div> 

					</div>

					<br/><br/>

					<div class="section">

						<table width="100%">

							<thead>

								<tr>

									<th>Quantity</th>

									<th>Item</th>

									<th>Units</th>

									<th>Description</th>

									<th>Estimated Unit Price</th>

									<th>Total</th>

								</tr>

							</thead>

							<tbody>';

							

										$subTotal = 0;

										foreach ($items->result() as $item){ 

											$subTotal = $subTotal+($item->it_uprice*$item->it_quantity);

											$requisition_data = $requisition_data.'<tr> <td>'.$item->it_quantity.'</td> <td>'.$item->it_name.'</td>                                    

												<td>'.$item->it_units.'</td> <td>'.$item->it_desc.'</td> <td>'.$item->it_uprice.'</td> <td>'.$item->it_uprice*$item->it_quantity.'</td> </tr>';

										}

										

										$requisition_data = $requisition_data.'<tr>

											<td colspan="4"><strong>* - Taxes as Applicable</strong></td>

											<td><strong>Subtotal</strong></td>

											<td>'.$subTotal.'</td>

										</tr>

										<tr>

											<td colspan="4"></td>

											<td><strong>Tax Amount*</strong></td>

											<td>'.$requisition->rq_taxamount.'</td>

										</tr>

										<tr>

											<td colspan="4"></td>

											<td><strong>Shipping</strong></td>

											<td>'.$requisition->rq_shipping.'</td>

										</tr>

										<tr>

											<td colspan="4"></td>

											<td><strong>Miscellaneous</strong></td>

											<td>'.$requisition->rq_misc.'</td>

										</tr>

										<tr>

											<td colspan="4"></td>

											<td><strong>Total</strong></td>

											<td>'.($subTotal+$requisition->rq_misc+$requisition->rq_shipping+$requisition->rq_taxamount).'</td>

										</tr>

						  </tbody>

						</table></div>';

					$rqnum = $requisition->rq_refnum;

					$this->core->emailTmp($requisition_data,"PR #:$rqnum ".$eSubject,$toEmail,'','');

					return true;

			}

		}

				return false;

	}

}





/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */