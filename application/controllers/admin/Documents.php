<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'controllers/Base_Controller.php';

class Documents extends Base_Controller {

	function __construct(){
		parent::__construct();

		$this->primaryTable = 'document';
		$this->categoryTable = 'document_category';
	}

	public function index(){

		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Document Management';
		$pageData['page_title'] = 'Document Management';
		$pageData['parent_menu'] = 'document_management';
		$pageData['child_menu'] = 'documents';

		$this->load->view('admin/document_management/index', $pageData);
	}


	/**
	 * [ngGetUsers get users list]
	 * @return [object] [response object]
	 */
	function ngGetDocuments(){
		$select = 'document.*, document_category.category_name';
		$from = $this->primaryTable;
		$where = 'document.status_id !='.DELETE;
		$records = 2;
		$join =  $this->categoryTable." ON document.category_id = document_category.id";
		$users = $this->base_model->customSelectQuery($select, $this->primaryTable , $where, $records, $join);
		$response = array('status' => TRUE, 'message' => 'Documents found successfully.', 'data' => $users);
		echo json_encode($response);
	}

	/**
	 * [add load add new user wizard]
	 */
	function add(){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Add Document';
		$pageData['page_title'] = 'Document Management';
		$pageData['parent_menu'] = 'document_management';
		$pageData['child_menu'] = 'add_new_document';

		//get User category
		$where = array('status_id =' => ACTIVE);
		$select = '*';
		$records = 2;
		$document_categories = $this->base_model->getCommon($this->categoryTable, $where, $select, $records);
		$pageData['document_categories'] = json_encode($document_categories);

		$this->load->view('admin/document_management/add', $pageData);
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
			$config['upload_path']          = SITE_DATA_PATH.'documents/';
	        $config['allowed_types']        = 'doc|docx|pdf';
	        $config['max_size']             = 10000;
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
        	$response = array('status' => false, 'message' => $this->upload->display_errors(), 'data' => '');
        }else{
			$saveData = array(
						'document_title'	=>	$postData->document_title,
						'category_id'		=>	$postData->category_id,
						'is_downloadable'	=>	$postData->is_downloadable,
						'status_id'		=>	$postData->status_id
					);
			if($uploadResult!=''){
        		$uploadDetails = array('upload_data' => $this->upload->data());
        		$saveData['document_url']	=	$uploadDetails['upload_data']['file_name'];
        	}
			$insertID = $this->base_model->saveCommon($this->primaryTable, $saveData);

			if($insertID){
				$response = array('status' => TRUE, 'message' => 'Document added successfully.', 'data' => '');
				$this->setSessionSuccessMessage('Document added successfully.');
			}else{
				$response = array('status' => FALSE, 'message' => 'Failed to add document.', 'data' => '');
			}
		}
		echo json_encode($response);	
	}

	/**
	 * [edit load edit user wizard]
	 */
	function edit($id){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Edit Document';
		$pageData['page_title'] = 'Document Management';
		$pageData['parent_menu'] = 'document_management';
		$pageData['child_menu'] = 'documents';

		//get document
		$where = array('id' => $id);
		$document = $this->base_model->getCommon($this->primaryTable, $where);

		//get document category
		$where = array('status_id =' => ACTIVE);
		$select = '*';
		$records = 2;
		$document_categories = $this->base_model->getCommon($this->categoryTable, $where, $select, $records);

		$pageData['document_details'] = json_encode($document);
		$pageData['document_categories'] = json_encode($document_categories);

		$this->load->view('admin/document_management/edit', $pageData);
	}


	/**
	 * [ngUpdateDetails update document details]
	 * @return [object] [response object]
	 */
	function ngUpdateDetails(){
		$postData = json_decode($_POST['model']);
		$uploadResult = '';
		$invalidFile = true;
		if(count($_FILES)>0){
			$config['upload_path']          = SITE_DATA_PATH.'documents/';
	        $config['allowed_types']        = 'doc|docx|pdf';
	        $config['max_size']             = 10000;
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
        	$response = array('status' => false, 'message' => $this->upload->display_errors(), 'data' => '');
        }else{

				$updateData = array(
						'document_title'	=>	$postData->document_title,
						'category_id'		=>	$postData->category_id,
						'is_downloadable'	=>	$postData->is_downloadable,
						'status_id'		=>	$postData->status_id
						);

				if($uploadResult!=''){
					$uploadDetails = array('upload_data' => $this->upload->data());
	        		$updateData['document_url']	=$uploadDetails['upload_data']['file_name'];
	        	}
	        	//print_r($updateData);die;
				$where = array('id' => $postData->id);

				$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

				if($result){
					$response = array('status' => TRUE, 'message' => 'Document updated successfully.', 'data' => '');
					$this->setSessionSuccessMessage('Document updated successfully.');
				}else{
					$response = array('status' => FALSE, 'message' => 'Failed to update document.', 'data' => '');
				}
		}
		echo json_encode($response);
	}

	/**
	 * [details load document details wizard]
	 */
	function details($id){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Document Details';
		$pageData['page_title'] = 'Document Management';
		$pageData['parent_menu'] = 'document_management';
		$pageData['child_menu'] = 'documents';

		//get Document
		$where = array('id' => $id);
		$document = $this->base_model->getCommon($this->primaryTable, $where);
		$pageData['document_details'] = json_encode($document);

		//get Document category
		$where = array('status_id =' => ACTIVE);
		$select = '*';
		$records = 2;
		$document_categories = $this->base_model->getCommon($this->categoryTable, $where, $select, $records);
		$pageData['document_categories'] = json_encode($document_categories);

		$this->load->view('admin/document_management/details', $pageData);
	}

	/**
	 * [delete update user record to deleted]
	 * @param  [integere] $id [user id]
	 */
	function delete($id){

		$where = array('id' => $id);
		$updateData = array('status_id' => DELETE);

		$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

		$this->setSessionSuccessMessage('Document deleted successfully.');
		redirect(base_url('admin/documents'));
	}


	/**
	 * [updateStatus update document status]
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

		$response = array('status' => TRUE, 'message' => 'Document status updated successfully.');

		echo json_encode($response);
	}

	/**
	 * [updateStatus update document downloadable status]
	 * @return [object] [response object]
	 */
	function updateDownloadableStatus(){
		$this->setPost();

		$postData = $_POST;

		if($postData->is_downloadable == 1){
			$updateData = array('is_downloadable' => 2);
		}else{
			$updateData = array('is_downloadable' => 1);
		}

		$where = array('id' => $postData->id);

		$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

		$response = array('status' => TRUE, 'message' => 'Document Downloadable status updated successfully.');

		echo json_encode($response);
	}

}
