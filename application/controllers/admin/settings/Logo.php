<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'controllers/Base_Controller.php';

class Logo extends Base_Controller {

	function __construct(){
		parent::__construct();

		$this->primaryTable = 'logo';
	}

	public function index(){

		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Logo Management';
		$pageData['page_title'] = 'Logo Management';
		$pageData['parent_menu'] = 'settings';
		$pageData['child_menu'] = 'logo_management';

		$this->load->view('admin/settings/logo/index', $pageData);
	}

	/**
	 * [ngGetUsers get categories list]
	 * @return [object] [response object]
	 */
	function ngGetLogos(){
		$where = array('status_id !=' => DELETE);
		$select = '*';
		$records = 2;
		$categories = $this->base_model->getCommon($this->primaryTable, $where, $select, $records);

		$response = array('status' => TRUE, 'message' => 'Logos found successfully.', 'data' => $categories);

		echo json_encode($response);
	}

	/**
	 * [add load add new Logo wizard]
	 */
	function add(){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Add Logo';
		$pageData['page_title'] = 'Logo Management';
		$pageData['parent_menu'] = 'settings';
		$pageData['child_menu'] = 'logo_management';

		$this->load->view('admin/settings/logo/add', $pageData);
	}
	/**
	 * [ngSave save new user]
	 * @return [object] [reponse object]
	 */
	function ngSave(){
		$postData = json_decode($_POST['model']);

		$uploadResult = '';
		$invalidFile = true;
		if(count($_FILES)>0){
			$config['upload_path']          = SITE_DATA_PATH.'logos/';
	        $config['allowed_types']        = 'gif|jpg|jpeg|png';
	        $config['max_size']             = 1024;
	        /*$config['max_width']            = 1024;
	        $config['max_height']           = 768;*/
	        $this->load->library('upload', $config);
	        $uploadResult = $this->upload->do_upload('file-0');
	        
	        if(!$uploadResult){
	        	$invalidFile = false;
	        }
	    }
	    $saveResult = false;
	    $response = '';
        if($invalidFile == false){
        	$response = array('status' => false, 'message' => 'Invalid image.', 'data' => '');
        }else{

			$saveData = array(
						'logo_name'	=>	$postData->logo_name
						//'status_id'		=>	$postData->status_id
					);
			if($uploadResult!=''){
        		$uploadDetails = array('upload_data' => $this->upload->data());
        		$saveData['logo_image']	=	$uploadDetails['upload_data']['file_name'];
        	}
			$insertID = $this->base_model->saveCommon($this->primaryTable, $saveData);

			if($insertID){
				$response = array('status' => TRUE, 'message' => 'Logo added successfully.', 'data' => '');
				$this->setSessionSuccessMessage('Logo added successfully.');
			}else{
				$response = array('status' => FALSE, 'message' => 'Failed to add Category.', 'data' => '');
			}
		}
		echo json_encode($response);	
	}

	/**
	 * [updateStatus update logo status]
	 * @return [object] [response object]
	 */
	function updateStatus(){
		$this->setPost();

		$postData = $_POST;

		if($postData->status_id == 1){
			$updateData = array('status_id' => 2);
			$updateallData = array('status_id' => 1);
			$whereall = array('id' => $postData->id);

			//update user session
			$sessionData = $this->session->userdata('userProfile');
			$sessionData->logo_image = 'default.png';
		}else{
			$updateData = array('status_id' => 1);
			$updateallData = array('status_id' => 2);
			$whereall = array('status_id !=' => DELETE);

			//update user session
			$sessionData = $this->session->userdata('userProfile');
			$sessionData->logo_image = $postData->logo_image;
		}
		$this->session->set_userdata('userProfile', $sessionData);

		//Update All logo statuses
		$this->base_model->updateCommon($this->primaryTable, $updateallData, $whereall);

		$where = array('id' => $postData->id);

		$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

		$response = array('status' => TRUE, 'message' => 'Logo status updated successfully.', 'data' => $sessionData);
		$this->setSessionSuccessMessage('Logo status updated successfully.');

		echo json_encode($response);
	}

	/**
	 * [delete update Logo record to deleted]
	 * @param  [integere] $id [user id]
	 */
	function delete($id){

		$where = array('id' => $id);
		$updateData = array('status_id' => DELETE);

		$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

		$this->setSessionSuccessMessage('Logo deleted successfully.');
		redirect(base_url('admin/settings/logo/'));
	}

	/**
	 * [edit load edit user wizard]
	 */
	function edit($id){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Edit Logo';
		$pageData['page_title'] = 'Logo Management';
		$pageData['parent_menu'] = 'settings';
		$pageData['child_menu'] = 'logo_management';

		//get logo
		$where = array('id' => $id);
		$logo = $this->base_model->getCommon($this->primaryTable, $where);
		$pageData['logo_details'] = json_encode($logo);

		$this->load->view('admin/settings/logo/edit', $pageData);
	}

	/**
	 * [ngUpdateDetails logo details]
	 * @return [object] [response object]
	 */
	function ngUpdateDetails(){
		$postData = json_decode($_POST['model']);
		$uploadResult = '';
		$invalidFile = true;
		if(count($_FILES)>0){
			$config['upload_path']          = SITE_DATA_PATH.'logos/';
	        $config['allowed_types']        = 'gif|jpg|jpeg|png';
	        $config['max_size']             = 1024;


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

			$updateData = array(
						'logo_name'	=>	$postData->logo_name
						//'status_id'		=>	$postData->status_id
					);
			
			if($uploadResult!=''){
					$uploadDetails = array('upload_data' => $this->upload->data());
	        		$updateData['logo_image']	=$uploadDetails['upload_data']['file_name'];
	        	}

	        $where = array('id' => $postData->id);
			$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

			if($result){
				$response = array('status' => TRUE, 'message' => 'Logo updated successfully.', 'data' => '');
				$this->setSessionSuccessMessage('Logo updated successfully.');
			}else{
				$response = array('status' => FALSE, 'message' => 'Failed to update Category.', 'data' => '');
			}
		}
		echo json_encode($response);
	}

}
