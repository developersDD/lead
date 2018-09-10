<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'controllers/Base_Controller.php';

class Login extends Base_Controller {

	function __construct(){
		parent::__construct();
		$this->primaryTable = 'admin';
	}

	public function index(){
		if($this->session->userdata('userProfile')){
			redirect(base_url('admin/dashboard'));
		}else{
			$this->load->view('admin/login/index');
		}
	}

	/**
	 * [login user login]
	 * @return [array] [response array]
	 */
	function ngLogin(){
		$this->setPost();
		
		$postData = $_POST;

		$from = 'admin';
		$where = array('email_id' => $postData->email, 'password' => md5($postData->password) );
		$userProfile = $this->base_model->getCommon($from, $where);	
		

		if($userProfile){
			if($userProfile->status_id != ACTIVE){
				$response = array('status' => FALSE, 'message' => 'Your account is inactive please contact admin.', 'data' => '');
			}else{
				//set logo in session
				$logofrom = 'logo';
				$logowhere = array('status_id' => ACTIVE );
				$logo = $this->base_model->getCommon($logofrom, $logowhere);
				if($logo->logo_image){
					$userProfile->logo_image = $logo->logo_image;
				}else{
					$userProfile->logo_image = 'default.png';
				}
				$this->session->set_userdata('userProfile', $userProfile);
				$response = array('status' => TRUE, 'message' => 'User logged in successfully.', 'data' => '');
			}
		}else{
			$response = array('status' => FALSE, 'message' => 'Invalid username and password.', 'data' => '');
		}

		echo json_encode($response);
	}

	function ngLogout(){
		$this->session->unset_userdata('userProfile');

		$response = array('status' => TRUE, 'message' => 'User logged out successfully.');
		echo json_encode($response);
	}

	/**
	 * [ngGetLogo]
	 * @return [object] [response object]
	 */
	function ngHeaderLogo(){
		$where = array('status_id ' => ACTIVE);
		$select = '*';
		$records = 1;
		$settings = $this->base_model->getCommon('logo', $where, $select, $records);

		$response = array('status' => TRUE, 'message' => 'Logo found successfully.', 'data' => $settings);

		echo json_encode($response);
	}

	function ngUpdateMyProfile(){
		$postData = json_decode($_POST['model']);
		$uploadResult = '';
		$invalidFile = true;
		if(count($_FILES)>0){
			$config['upload_path']          = SITE_DATA_PATH.'user_profiles/admin/';
	        $config['allowed_types']        = 'gif|jpg|jpeg|png';
	        $config['max_size']             = 1024;
	        /*$config['max_width']            = 1024;
	        $config['max_height']           = 768;*/
	        $this->load->library('upload', $config);        
	        $uploadResult = $this->upload->do_upload('file-0');
	        //echo $this->upload->display_errors();
	        if(!$uploadResult){
	        	$invalidFile = false;
	        }

	    }
	    $result = false;
	    $response = '';
        if($invalidFile == false){
        	$response = array('status' => false, 'message' => 'Invalid image.', 'data' => '');
        }else{
        	$updateData = array('first_name' => $postData->first_name, 'last_name' => $postData->last_name,
							'gender_id' => $postData->gender_id);
			$updateWhere = array('id' => $postData->id);
			if($uploadResult!=''){
				$uploadDetails = array('upload_data' => $this->upload->data());
	        	$updateData['user_profile']	=$uploadDetails['upload_data']['file_name'];
	        }
			$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $updateWhere);

			//update user session
			$sessionData = $this->session->userdata('userProfile');
			$sessionData->first_name = $postData->first_name;
			$sessionData->last_name = $postData->last_name;
			$sessionData->gender_id = $postData->gender_id;
			if($uploadResult!=''){
				$sessionData->user_profile = $uploadDetails['upload_data']['file_name'];
			}
			//reset session
			$this->session->set_userdata('userProfile', $sessionData);

			$response = array('status' => TRUE, 'message' => 'Profile updated successfully.', 'data' => $sessionData);
		}
		echo json_encode($response);
	}



	
	/**
	 * [ngChangePassword change account password]
	 * @return [object] [response object]
	 */
	function ngChangePassword(){
		$this->setPost();
		$postData = $_POST;

		//get user profile
		$table = 'admin';
		$where = array('id' => $this->session->userdata['userProfile']->id);
		$profile = $this->base_model->getCommon($table, $where);

		if($profile->password == md5($postData->current_password)){
			if($postData->new_password == $postData->confirm_password){
				$updateData = array('password' => md5($postData->new_password));
				$result = $this->base_model->updateCommon($table, $updateData, $where);

				$response = array('status' => TRUE, 'message' => 'Password updated successfully.');
			}else{
				$response = array('status' => FALSE, 'message' => 'New password and confirm password does not match.');
			}
		}else{
			$response = array('status' => FALSE, 'message' => 'Invalid current password.');
		}

		echo json_encode($response);
	}
}
