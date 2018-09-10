<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'controllers/Base_Controller.php';

class Quicklinks extends Base_Controller {

	function __construct(){
		parent::__construct();

		$this->primaryTable = 'quick_links';
	}

	public function index(){

		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Quick Link Management';
		$pageData['page_title'] = 'Quick Link Management';
		$pageData['parent_menu'] = 'quick_links';
		$pageData['child_menu'] = 'quicklinks';

		$this->load->view('admin/quicklinks_management/index', $pageData);
	}

	/**
	 * [ngGetUsers get messages list]
	 * @return [object] [response object]
	 */
	function ngGetQuickLinks(){
		$where = array('status_id !=' => DELETE);
		$select = '*';
		$records = 2;
		$messages = $this->base_model->getCommon($this->primaryTable, $where, $select, $records);
		$response = array('status' => TRUE, 'message' => 'QuickLinks found successfully.', 'data' => $messages);

		echo json_encode($response);
	}

	/**
	 * [details load user details wizard]
	 */
	function details($id){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Quick Link Details';
		$pageData['page_title'] = 'Quick Link Management';
		$pageData['parent_menu'] = 'quick_links';
		$pageData['child_menu'] = 'quicklinks';

		//get user profile
		$where = array('id' => $id);
		$quicklink = $this->base_model->getCommon($this->primaryTable, $where);
		$pageData['quicklink_details'] = json_encode($quicklink);

		$this->load->view('admin/quicklinks_management/details', $pageData);
	}

	/**
	 * [add load add new user category wizard]
	 */
	function add(){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Add Quick Link';
		$pageData['page_title'] = 'Quick Link Management';
		$pageData['parent_menu'] = 'quick_links';
		$pageData['child_menu'] = 'add_quick_links';

		$this->load->view('admin/quicklinks_management/add', $pageData);
	}
	/**
	 * [ngSave save new user]
	 * @return [object] [reponse object]
	 */
	function ngSave(){
		$this->setPost();
		$postData = $_POST;

			$saveData = array(
						'link_name'	=>	$postData->link_name,
						'link_address'	=>	$postData->link_address,
						'status_id'	=>	$postData->status_id
					);
			$insertID = $this->base_model->saveCommon($this->primaryTable, $saveData);

			if($insertID){
				$response = array('status' => TRUE, 'message' => 'Quick Link added successfully.', 'data' => '');
				$this->setSessionSuccessMessage('Quick Link added successfully.');
			}else{
				$response = array('status' => FALSE, 'message' => 'Failed to add Quick Link.', 'data' => '');
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

		$response = array('status' => TRUE, 'message' => 'Quick Link updated successfully.');

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

		$this->setSessionSuccessMessage('Quick Link deleted successfully.');
		redirect(base_url('admin/quicklinks/'));
	}

	/**
	 * [edit load edit user wizard]
	 */
	function edit($id){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Edit Quick Link';
		$pageData['page_title'] = 'Quick Link Management';
		$pageData['parent_menu'] = 'quick_links';
		$pageData['child_menu'] = 'quicklinks';

		//get user profile
		$where = array('id' => $id);
		$quicklink = $this->base_model->getCommon($this->primaryTable, $where);
		$pageData['quicklink_details'] = json_encode($quicklink);

		$this->load->view('admin/quicklinks_management/edit', $pageData);
	}

	/**
	 * [ngUpdateDetails update user details]
	 * @return [object] [response object]
	 */
	function ngUpdateDetails(){
		$this->setPost();

		$postData = $_POST;

			$updateData = array(
						'link_name'	=>	$postData->link_name,
						'link_address'	=>	$postData->link_address,
						'status_id'	=>	$postData->status_id
					);
			$where = array('id' => $postData->id);

			$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

			if($result){
				$response = array('status' => TRUE, 'message' => 'Quick Link updated successfully.', 'data' => '');
				$this->setSessionSuccessMessage('Quick Link updated successfully.');
			}else{
				$response = array('status' => FALSE, 'message' => 'Failed to update Quick Link.', 'data' => '');
			}
		echo json_encode($response);
	}

}
