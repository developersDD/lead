<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'controllers/Base_Controller.php';

class Branches extends Base_Controller {

	function __construct(){
		parent::__construct();

		$this->primaryTable = 'branches';
		$this->categoryTable = 'user_category';
	}

	public function index(){

		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Branch Management';
		$pageData['page_title'] = 'Branch Management';
		$pageData['parent_menu'] = 'branch_management';
		$pageData['child_menu'] = 'branches';

		$this->load->view('admin/branch_management/index', $pageData);
	}

	

	/**
	 * [ngGetBranchs get branchs list]
	 * @return [object] [response object]
	 */
	function ngGetBranches(){
        $where = array('status_id =' => ACTIVE);
        $select = '*';
        $records = 2;
        $branches = $this->base_model->getCommon($this->primaryTable, $where, $select, $records);
        $pageData['branches'] = json_encode($branches);
		$response = array('status' => TRUE, 'message' => 'Branchs found successfully.', 'data' => $branches);
		echo json_encode($response);
	}

	/**
	 * [add load add new branch wizard]
	 */
	function add(){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Add Branch';
		$pageData['page_title'] = 'Branch Management';
		$pageData['parent_menu'] = 'branch_management';
		$pageData['child_menu'] = 'add_new_branch';

		//get Branch category
		$where = array('status_id =' => ACTIVE);
		$select = '*';
		$records = 2;
		$branch_categories = $this->base_model->getCommon($this->categoryTable, $where, $select, $records);
		$pageData['branch_categories'] = json_encode($branch_categories);

		$this->load->view('admin/branch_management/add', $pageData);
	}

	/**
	 * [ngSave save new branch]
	 * @return [object] [reponse object]
	 */
	function ngSave(){
		$postData = json_decode($_POST['model']);

		$uploadResult = '';
		$invalidFile = true;
		if(count($_FILES)>0){
			$config['upload_path']          = SITE_DATA_PATH.'branch_profiles/';
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
        	print_r($profile);
		//get branch profile
		$where = array('email_id' => $postData->email_id, 'status_id !=' => DELETE);
		$profile = $this->base_model->getCommon($this->primaryTable, $where);
		if(!$profile){
			$where = array('contact_no' => $postData->contact_no);
			$profile = $this->base_model->getCommon($this->primaryTable, $where);
		}

		if(!$profile){
			$saveData = array(
						'first_name'	=>	$postData->first_name,
						'last_name'		=>	$postData->last_name,
						'email_id'		=>	$postData->email_id,
						'gender_id'		=>	$postData->gender_id,
						'contact_no'	=>	$postData->contact_no,
						'category_id'	=>	$postData->category_id,
						'descripton'	=>	$postData->descripton,
						'created_by'	=>	$this->session->branchdata['branchProfile']->id
					);
			if($uploadResult!=''){
        		$uploadDetails = array('upload_data' => $this->upload->data());
        		$saveData['branch_profile']	=	$uploadDetails['upload_data']['file_name'];
        	}
			$insertID = $this->base_model->saveCommon($this->primaryTable, $saveData);

			if($insertID){
				$response = array('status' => TRUE, 'message' => 'Branch added successfully.', 'data' => '');
				$this->setSessionSuccessMessage('Branch added successfully.');
			}else{
				$response = array('status' => FALSE, 'message' => 'Failed to add branch.', 'data' => '');
			}
		}else{
			$response = array('status' => FALSE, 'message' => 'Branch already registered.', 'data' => '');
		}
		}
		echo json_encode($response);	
	}

	/**
	 * [edit load edit branch wizard]
	 */
	function edit($id){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Edit Branch';
		$pageData['page_title'] = 'Branch Management';
		$pageData['parent_menu'] = 'branch_management';
		$pageData['child_menu'] = 'branches';

		//get branch profile
		$where = array('id' => $id);
		$profile = $this->base_model->getCommon($this->primaryTable, $where);

		//get Branch category
		$where = array('status_id =' => ACTIVE);
		$select = '*';
		$records = 2;
		$branch_categories = $this->base_model->getCommon($this->categoryTable, $where, $select, $records);

		$pageData['branch_details'] = json_encode($profile);
		$pageData['branch_categories'] = json_encode($branch_categories);

		$this->load->view('admin/branch_management/edit', $pageData);
	}


	/**
	 * [ngUpdateDetails update branch details]
	 * @return [object] [response object]
	 */
	function ngUpdateDetails(){
		$postData = json_decode($_POST['model']);
		$uploadResult = '';
		$invalidFile = true;
		if(count($_FILES)>0){
			$config['upload_path']          = SITE_DATA_PATH.'branch_profiles/';
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

			$where = array('id !=' => $postData->id, 'email_id' => $postData->email_id);
			$profile = $this->base_model->getCommon($this->primaryTable, $where);

			if(!$profile){
				$where = array('id !=' => $postData->id, 'contact_no' => $postData->contact_no);
				$profile = $this->base_model->getCommon($this->primaryTable, $where);
			}

			if(!$profile){
				$updateData = array(
							'first_name'	=>	$postData->first_name,
							'last_name'		=>	$postData->last_name,
							// 'email_id'		=>	$postData->email_id,
							'gender_id'		=>	$postData->gender_id,
							// 'contact_no'	=>	$postData->contact_no,
							'category_id'	=>	$postData->category_id,
							'descripton'	=>	$postData->descripton,
							'status_id'		=>	$postData->status_id,
							'updated_by'	=>	$this->session->branchdata['branchProfile']->id,
							'updated_date'	=>	date('Y-m-d h:i:s')
						);

				if($uploadResult!=''){
					$uploadDetails = array('upload_data' => $this->upload->data());
	        		$updateData['branch_profile']	=$uploadDetails['upload_data']['file_name'];
	        	}
	        	//print_r($updateData);die;
				$where = array('id' => $postData->id);

				$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

				if($result){
					$response = array('status' => TRUE, 'message' => 'Branch updated successfully.', 'data' => '');
					$this->setSessionSuccessMessage('Branch updated successfully.');
				}else{
					$response = array('status' => FALSE, 'message' => 'Failed to update branch.', 'data' => '');
				}
			}else{
				$response = array('status' => FALSE, 'message' => 'Duplicate email id or mobile no.', 'data' => '');
			}
		}
		echo json_encode($response);
	}

	/**
	 * [details load branch details wizard]
	 */
	function details($id){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Branch Details';
		$pageData['page_title'] = 'Branch Management';
		$pageData['parent_menu'] = 'branch_management';
		$pageData['child_menu'] = 'branches';

		//get branch profile
		$where = array('id' => $id);
		$profile = $this->base_model->getCommon($this->primaryTable, $where);
		$pageData['branch_details'] = json_encode($profile);

		//get Branch category
		$where = array('status_id =' => ACTIVE);
		$select = '*';
		$records = 2;
		$branch_categories = $this->base_model->getCommon($this->categoryTable, $where, $select, $records);
		$pageData['branch_categories'] = json_encode($branch_categories);

		$this->load->view('admin/branch_management/details', $pageData);
	}

	/**
	 * [delete update branch record to deleted]
	 * @param  [integere] $id [branch id]
	 */
	function delete($id){

		$where = array('id' => $id);
		$updateData = array('status_id' => DELETE);

		$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

		$this->setSessionSuccessMessage('Branch deleted successfully.');
		redirect(base_url('admin/branches'));
	}


	/**
	 * [updateStatus update branch account status]
	 * @return [object] [response object]
	 */
	function updateStatus(){
		$this->setPost();

		$postData = $_POST;

		if($postData->status_id == 1){
			$updateData = array('status_id' => 2);
		}else{
			$updateData = array('status_id' => 1);
		}

		$where = array('id' => $postData->id);

		$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

		$response = array('status' => TRUE, 'message' => 'Branch status updated successfully.');

		echo json_encode($response);
	}

}
