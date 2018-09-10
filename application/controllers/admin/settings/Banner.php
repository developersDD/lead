<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'controllers/Base_Controller.php';

class Banner extends Base_Controller {

	function __construct(){
		parent::__construct();

		$this->primaryTable = 'banner';
	}

	public function index(){

		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Banner Management';
		$pageData['page_title'] = 'Banner Management';
		$pageData['parent_menu'] = 'settings';
		$pageData['child_menu'] = 'banner_management';

		$this->load->view('admin/settings/banner/index', $pageData);
	}

	/**
	 * [ngGetUsers get categories list]
	 * @return [object] [response object]
	 */
	function ngGetBanners(){
		$where = array('status_id !=' => DELETE);
		$select = '*';
		$records = 2;
		$categories = $this->base_model->getCommon($this->primaryTable, $where, $select, $records);

		$response = array('status' => TRUE, 'message' => 'Banners found successfully.', 'data' => $categories);

		echo json_encode($response);
	}

	/**
	 * [add load add new Banner wizard]
	 */
	function add(){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Add Banner';
		$pageData['page_title'] = 'Banner Management';
		$pageData['parent_menu'] = 'settings';
		$pageData['child_menu'] = 'banner_management';

		$this->load->view('admin/settings/banner/add', $pageData);
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
			$config['upload_path']          = SITE_DATA_PATH.'banners/';
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
						'banner_name'	=>	$postData->banner_name
						//'status_id'		=>	$postData->status_id
					);
			if($uploadResult!=''){
        		$uploadDetails = array('upload_data' => $this->upload->data());
        		$saveData['banner_image']	=	$uploadDetails['upload_data']['file_name'];
        	}
			$insertID = $this->base_model->saveCommon($this->primaryTable, $saveData);

			if($insertID){
				$response = array('status' => TRUE, 'message' => 'Banner added successfully.', 'data' => '');
				$this->setSessionSuccessMessage('Banner added successfully.');
			}else{
				$response = array('status' => FALSE, 'message' => 'Failed to add Category.', 'data' => '');
			}
		}
		echo json_encode($response);	
	}

	/**
	 * [updateStatus update category status]
	 * @return [object] [response object]
	 */
	function updateStatus(){
		$this->setPost();

		$postData = $_POST;

		if($postData->status_id == 1){
			$updateData = array('status_id' => 2);
			$updateallData = array('status_id' => 1);
			$whereall = array('id' => $postData->id);
		}else{
			$updateData = array('status_id' => 1);
			$updateallData = array('status_id' => 2);
			$whereall = array('status_id !=' => DELETE);
		}

		//Update All banner statuses
		$this->base_model->updateCommon($this->primaryTable, $updateallData, $whereall);

		$where = array('id' => $postData->id);

		$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

		$response = array('status' => TRUE, 'message' => 'Banner status updated successfully.');

		echo json_encode($response);
	}

	/**
	 * [delete update Banner record to deleted]
	 * @param  [integere] $id [user id]
	 */
	function delete($id){

		$where = array('id' => $id);
		$updateData = array('status_id' => DELETE);

		$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

		$this->setSessionSuccessMessage('Banner deleted successfully.');
		redirect(base_url('admin/settings/banner/'));
	}

	/**
	 * [edit load edit user wizard]
	 */
	function edit($id){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Edit Banner';
		$pageData['page_title'] = 'Banner Management';
		$pageData['parent_menu'] = 'settings';
		$pageData['child_menu'] = 'banner_management';

		//get banner
		$where = array('id' => $id);
		$banner = $this->base_model->getCommon($this->primaryTable, $where);
		$pageData['banner_details'] = json_encode($banner);

		$this->load->view('admin/settings/banner/edit', $pageData);
	}

	/**
	 * [ngUpdateDetails banner details]
	 * @return [object] [response object]
	 */
	function ngUpdateDetails(){
		$postData = json_decode($_POST['model']);
		$uploadResult = '';
		$invalidFile = true;
		if(count($_FILES)>0){
			$config['upload_path']          = SITE_DATA_PATH.'banners/';
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
						'banner_name'	=>	$postData->banner_name
						//'status_id'		=>	$postData->status_id
					);
			
			if($uploadResult!=''){
					$uploadDetails = array('upload_data' => $this->upload->data());
	        		$updateData['banner_image']	=$uploadDetails['upload_data']['file_name'];
	        	}

	        $where = array('id' => $postData->id);
			$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

			if($result){
				$response = array('status' => TRUE, 'message' => 'Banner updated successfully.', 'data' => '');
				$this->setSessionSuccessMessage('Banner updated successfully.');
			}else{
				$response = array('status' => FALSE, 'message' => 'Failed to update Category.', 'data' => '');
			}
		}
		echo json_encode($response);
	}

}
