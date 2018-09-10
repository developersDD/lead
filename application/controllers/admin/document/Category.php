<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'controllers/Base_Controller.php';

class Category extends Base_Controller {

	function __construct(){
		parent::__construct();

		$this->primaryTable = 'document_category';
	}

	public function index(){

		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Document Category Management';
		$pageData['page_title'] = 'Document Category Management';
		$pageData['parent_menu'] = 'document_management';
		$pageData['child_menu'] = 'document_category';

		$this->load->view('admin/document_management/category/index', $pageData);
	}

	/**
	 * [ngGetUsers get categories list]
	 * @return [object] [response object]
	 */
	function ngGetDocumentCategory(){
		$where = array('status_id !=' => DELETE);
		$select = '*';
		$records = 2;
		$categories = $this->base_model->getCommon($this->primaryTable, $where, $select, $records);

		$response = array('status' => TRUE, 'message' => 'Document Categories found successfully.', 'data' => $categories);

		echo json_encode($response);
	}

	/**
	 * [add load add new Document Category wizard]
	 */
	function add(){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Add Document Category';
		$pageData['page_title'] = 'Document Category Management';
		$pageData['parent_menu'] = 'document_management';
		$pageData['child_menu'] = 'document_category';

		$this->load->view('admin/document_management/category/add', $pageData);
	}
	/**
	 * [ngSave save new user]
	 * @return [object] [reponse object]
	 */
	function ngSave(){
		$this->setPost();
		$postData = $_POST;

			$saveData = array(
						'category_name'	=>	$postData->category_name,
						'status_id'		=>	$postData->status_id
					);
			$insertID = $this->base_model->saveCommon($this->primaryTable, $saveData);

			if($insertID){
				$response = array('status' => TRUE, 'message' => 'Document Category added successfully.', 'data' => '');
				$this->setSessionSuccessMessage('Document Category added successfully.');
			}else{
				$response = array('status' => FALSE, 'message' => 'Failed to add Category.', 'data' => '');
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
		}else{
			$updateData = array('status_id' => 1);
		}

		$where = array('id' => $postData->id);

		$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

		$response = array('status' => TRUE, 'message' => 'Document status updated successfully.');

		echo json_encode($response);
	}

	/**
	 * [delete update document category record to deleted]
	 * @param  [integere] $id [user id]
	 */
	function delete($id){

		$where = array('id' => $id);
		$updateData = array('status_id' => DELETE);

		$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

		$this->setSessionSuccessMessage('Document Category deleted successfully.');
		redirect(base_url('admin/document/category/'));
	}

	/**
	 * [edit load edit user wizard]
	 */
	function edit($id){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Edit Document Category';
		$pageData['page_title'] = 'Document Category Management';
		$pageData['parent_menu'] = 'document_management';
		$pageData['child_menu'] = 'document_category';

		//get category
		$where = array('id' => $id);
		$category = $this->base_model->getCommon($this->primaryTable, $where);
		$pageData['category_details'] = json_encode($category);

		$this->load->view('admin/document_management/category/edit', $pageData);
	}

	/**
	 * [ngUpdateDetails update category details]
	 * @return [object] [response object]
	 */
	function ngUpdateDetails(){
		$this->setPost();

		$postData = $_POST;

			$updateData = array(
						'category_name'	=>	$postData->category_name,
						'status_id'		=>	$postData->status_id
					);
			$where = array('id' => $postData->id);

			$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

			if($result){
				$response = array('status' => TRUE, 'message' => 'Document Category updated successfully.', 'data' => '');
				$this->setSessionSuccessMessage('User updated successfully.');
			}else{
				$response = array('status' => FALSE, 'message' => 'Failed to update Category.', 'data' => '');
			}
		echo json_encode($response);
	}

}
