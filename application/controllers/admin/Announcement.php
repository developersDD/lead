<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'controllers/Base_Controller.php';

class Announcement extends Base_Controller {

	function __construct(){
		parent::__construct();

		$this->primaryTable = 'announcement_board';
	}

	public function index(){

		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Announcement Board Management';
		$pageData['page_title'] = 'Announcement Board Management';
		$pageData['parent_menu'] = 'announcement_board';
		$pageData['child_menu'] = 'announcements';

		$this->load->view('admin/announcement_management/index', $pageData);
	}

	/**
	 * [ngGetUsers get announcements list]
	 * @return [object] [response object]
	 */
	function ngGetAnnouncements(){
		$where = array('status_id !=' => DELETE);
		$select = '*';
		$records = 2;
		$announcements = $this->base_model->getCommon($this->primaryTable, $where, $select, $records);

		$response = array('status' => TRUE, 'message' => 'Announcements found successfully.', 'data' => $announcements);

		echo json_encode($response);
	}

	/**
	 * [details load user details wizard]
	 */
	function details($id){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Announcement Details';
		$pageData['page_title'] = 'Announcement Board Management';
		$pageData['parent_menu'] = 'announcement_board';
		$pageData['child_menu'] = 'announcements';

		//get user profile
		$where = array('id' => $id);
		$announcement = $this->base_model->getCommon($this->primaryTable, $where);
		$pageData['announcement_details'] = json_encode($announcement);

		$this->load->view('admin/announcement_management/details', $pageData);
	}

	/**
	 * [add load add new user category wizard]
	 */
	function add(){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Add Announcement';
		$pageData['page_title'] = 'Announcement Board Management';
		$pageData['parent_menu'] = 'announcement_board';
		$pageData['child_menu'] = 'add_new_announcement';

		$this->load->view('admin/announcement_management/add', $pageData);
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
				$response = array('status' => TRUE, 'message' => 'Announcement added successfully.', 'data' => '');
				$this->setSessionSuccessMessage('Announcement added successfully.');
			}else{
				$response = array('status' => FALSE, 'message' => 'Failed to add Announcement.', 'data' => '');
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

		$response = array('status' => TRUE, 'message' => 'Announcement status updated successfully.');

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

		$this->setSessionSuccessMessage('Announcement deleted successfully.');
		redirect(base_url('admin/announcement/'));
	}

	/**
	 * [edit load edit user wizard]
	 */
	function edit($id){
		if(!$this->checkLogin()){
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME.' | Edit Announcement';
		$pageData['page_title'] = 'Announcement Board Management';
		$pageData['parent_menu'] = 'announcement_board';
		$pageData['child_menu'] = 'announcements';

		//get user profile
		$where = array('id' => $id);
		$announcement = $this->base_model->getCommon($this->primaryTable, $where);
		$pageData['announcement_details'] = json_encode($announcement);

		$this->load->view('admin/announcement_management/edit', $pageData);
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
				$response = array('status' => TRUE, 'message' => 'Announcement updated successfully.', 'data' => '');
				$this->setSessionSuccessMessage('User updated successfully.');
			}else{
				$response = array('status' => FALSE, 'message' => 'Failed to update Announcement.', 'data' => '');
			}
		echo json_encode($response);
	}

}
