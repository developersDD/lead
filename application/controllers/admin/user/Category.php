<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'controllers/Base_Controller.php';

class Category extends Base_Controller {

	function __construct(){
		parent::__construct();

		$this->primaryTable = 'user_category';
	}

	public function index(){

		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | User Category Management';
		$pageData['page_title'] = 'User Category Management';
		$pageData['parent_menu'] = 'user_management';
		$pageData['child_menu'] = 'user_category';

		$this->load->view('admin/user_management/category/index', $pageData);
	}

	/**
	 * [ngGetUsers get categories list]
	 * @return [object] [response object]
	 */
	function ngGetUsersCategory(){
		$where = array('status_id !=' => DELETE);
		$select = '*';
		$records = 2;
		$categories = $this->base_model->getCommon($this->primaryTable, $where, $select, $records);

		$response = array('status' => TRUE, 'message' => 'User Categories found successfully.', 'data' => $categories);

		echo json_encode($response);
	}

	/**
	 * [add load add new user category wizard]
	 */
	function add(){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Add User Category';
		$pageData['page_title'] = 'User Category Management';
		$pageData['parent_menu'] = 'user_management';
		$pageData['child_menu'] = 'user_category';

		$this->load->view('admin/user_management/category/add', $pageData);
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
				$response = array('status' => TRUE, 'message' => 'User Category added successfully.', 'data' => '');
				$this->setSessionSuccessMessage('User Category added successfully.');
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

		$response = array('status' => TRUE, 'message' => 'User status updated successfully.');

		echo json_encode($response);
	}

	/**
	 * [delete update user record to deleted]
	 * @param  [integere] $id [user id]
	 */
	function delete($id){

		$where = array('id' => $id);
		$updateData = array('status_id' => DELETE);

		$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

		$this->setSessionSuccessMessage('User Category deleted successfully.');
		redirect(base_url('admin/user/category/'));
	}

	/**
	 * [edit load edit user wizard]
	 */
	function edit($id){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Edit User Category';
		$pageData['page_title'] = 'User Category Management';
		$pageData['parent_menu'] = 'user_management';
		$pageData['child_menu'] = 'user_category';

		//get user profile
		$where = array('id' => $id);
		$profile = $this->base_model->getCommon($this->primaryTable, $where);
		$pageData['category_details'] = json_encode($profile);

		$this->load->view('admin/user_management/category/edit', $pageData);
	}

	/**
	 * [ngUpdateDetails update user details]
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
				$response = array('status' => TRUE, 'message' => 'User Category updated successfully.', 'data' => '');
				$this->setSessionSuccessMessage('User updated successfully.');
			}else{
				$response = array('status' => FALSE, 'message' => 'Failed to update Category.', 'data' => '');
			}
		echo json_encode($response);
	}

}
