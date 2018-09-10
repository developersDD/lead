<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'controllers/Base_Controller.php';

class Messages extends Base_Controller {

	function __construct(){
		parent::__construct();

		$this->primaryTable = 'message_board';
	}

	public function index(){

		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Message Board Management';
		$pageData['page_title'] = 'Message Board Management';
		$pageData['parent_menu'] = 'message_board';
		$pageData['child_menu'] = 'messages';

		$this->load->view('admin/messageboard_management/index', $pageData);
	}

	/**
	 * [ngGetUsers get messages list]
	 * @return [object] [response object]
	 */
	function ngGetMessages(){
		$where = array('status_id !=' => DELETE);
		$select = '*';
		$records = 2;
		$messages = $this->base_model->getCommon($this->primaryTable, $where, $select, $records);

		$response = array('status' => TRUE, 'message' => 'Messages found successfully.', 'data' => $messages);

		echo json_encode($response);
	}

	/**
	 * [details load user details wizard]
	 */
	function details($id){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Message Details';
		$pageData['page_title'] = 'Message Board Management';
		$pageData['parent_menu'] = 'message_board';
		$pageData['child_menu'] = 'messages';

		//get user profile
		$where = array('id' => $id);
		$message = $this->base_model->getCommon($this->primaryTable, $where);
		$pageData['message_details'] = json_encode($message);

		$this->load->view('admin/messageboard_management/details', $pageData);
	}

	/**
	 * [add load add new user category wizard]
	 */
	function add(){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Add Message';
		$pageData['page_title'] = 'Message Board Management';
		$pageData['parent_menu'] = 'message_board';
		$pageData['child_menu'] = 'add_new_message';

		$this->load->view('admin/messageboard_management/add', $pageData);
	}
	/**
	 * [ngSave save new user]
	 * @return [object] [reponse object]
	 */
	function ngSave(){
		$this->setPost();
		$postData = $_POST;

			$saveData = array(
						'content'	=>	$postData->content,
						'status_id'		=>	$postData->status_id
					);
			$insertID = $this->base_model->saveCommon($this->primaryTable, $saveData);

			if($insertID){
				$response = array('status' => TRUE, 'message' => 'Message added successfully.', 'data' => '');
				$this->setSessionSuccessMessage('Message added successfully.');
			}else{
				$response = array('status' => FALSE, 'message' => 'Failed to add Message.', 'data' => '');
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

		$response = array('status' => TRUE, 'message' => 'Message status updated successfully.');

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

		$this->setSessionSuccessMessage('Message deleted successfully.');
		redirect(base_url('admin/messages/'));
	}

	/**
	 * [edit load edit user wizard]
	 */
	function edit($id){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Edit Message';
		$pageData['page_title'] = 'Message Board Management';
		$pageData['parent_menu'] = 'message_board';
		$pageData['child_menu'] = 'messages';

		//get user profile
		$where = array('id' => $id);
		$message = $this->base_model->getCommon($this->primaryTable, $where);
		$pageData['message_details'] = json_encode($message);

		$this->load->view('admin/messageboard_management/edit', $pageData);
	}

	/**
	 * [ngUpdateDetails update user details]
	 * @return [object] [response object]
	 */
	function ngUpdateDetails(){
		$this->setPost();

		$postData = $_POST;

			$updateData = array(
						'content'	=>	$postData->content,
						'status_id'		=>	$postData->status_id
					);
			$where = array('id' => $postData->id);

			$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

			if($result){
				$response = array('status' => TRUE, 'message' => 'Message updated successfully.', 'data' => '');
				$this->setSessionSuccessMessage('User updated successfully.');
			}else{
				$response = array('status' => FALSE, 'message' => 'Failed to update Message.', 'data' => '');
			}
		echo json_encode($response);
	}

}
