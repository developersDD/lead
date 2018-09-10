<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'controllers/Base_Controller.php';

class Users extends Base_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->primaryTable = 'users';
		$this->rolesTable = 'roles';
		$this->branchesTable = 'branches';
	}

	public function index()
	{

		if (!$this->checkLogin()) {
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME . ' | User Management';
		$pageData['page_title'] = 'User Management';
		$pageData['parent_menu'] = 'user_management';
		$pageData['child_menu'] = 'users';

		$this->load->view('admin/user_management/index', $pageData);
	}



	/**
	 * [ngGetUsers get users list]
	 * @return [object] [response object]
	 */
	function ngGetUsers()
	{
		$sql = "SELECT u.*, r.name as role_name,b.branch_name as branch_name 
		FROM users u 
		LEFT JOIN roles r ON u.role_id = r.id LEFT JOIN branches b ON u.branch_id = b.id
		WHERE u.status_id != ". DELETE . ";";

		$result = $this->db->query($sql);
		$response = $result->result();
		echo json_encode($response);
	}


	/**
	 * [add load add new user wizard]
	 */
	function add()
	{
		if (!$this->checkLogin()) {
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME . ' | Add User';
		$pageData['page_title'] = 'User Management';
		$pageData['parent_menu'] = 'user_management';
		$pageData['child_menu'] = 'add_new_user';

		//get roles
		$where = array('status_id =' => ACTIVE);
		$select = '*';
		$records = 2;
		$roles = $this->base_model->getCommon($this->rolesTable, $where, $select, $records);
		$pageData['roles'] = json_encode($roles);

		//get branches
		$where = array('status_id =' => ACTIVE);
		$select = '*';
		$records = 2;
		$branches = $this->base_model->getCommon($this->branchesTable, $where, $select, $records);
		$pageData['branches'] = json_encode($branches);

		$this->load->view('admin/user_management/add', $pageData);
	}

	/**
	 * [ngSave save new user]
	 * @return [object] [reponse object]
	 */
	function ngSave()
	{
		$postData = json_decode($_POST['model']);

		$uploadResult = '';
		$invalidFile = true;
		if (count($_FILES) > 0) {
			$config['upload_path'] = SITE_DATA_PATH . 'user_profiles/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 2048;
	        /*$config['max_width']            = 1024;
	        $config['max_height']           = 768;*/
			$this->load->library('upload', $config);
			$uploadResult = $this->upload->do_upload('file-0');

			if (!$uploadResult) {
				$invalidFile = false;
			}
		}
		// print_r($uploadResult);die;
		$saveResult = false;
		$response = '';
		if ($invalidFile == false) {
			$response = array('status' => false, 'message' => 'Invalid image.', 'data' => '');
		} else {
			print_r($profile);
		//get user profile
			$where = array('email_id' => $postData->email_id, 'status_id !=' => DELETE);
			$profile = $this->base_model->getCommon($this->primaryTable, $where);
			if (!$profile) {
				$where = array('contact_no' => $postData->contact_no);
				$profile = $this->base_model->getCommon($this->primaryTable, $where);
			}

			if (!$profile) {
				$saveData = array(
					'first_name' => $postData->first_name,
					'last_name' => $postData->last_name,
					'email_id' => $postData->email_id,
					'gender_id' => $postData->gender_id,
					'contact_no' => $postData->contact_no,
					'branch_id' => $postData->branch_id,
					'role_id' => $postData->role_id,
					'descripton' => $postData->descripton,
					'created_by' => $this->session->userdata['userProfile']->id
				);
				if ($uploadResult != '') {
					$uploadDetails = array('upload_data' => $this->upload->data());
					$saveData['user_profile'] = $uploadDetails['upload_data']['file_name'];
				}
				$insertID = $this->base_model->saveCommon($this->primaryTable, $saveData);

				if ($insertID) {
					$response = array('status' => true, 'message' => 'User added successfully.', 'data' => '');
					$this->setSessionSuccessMessage('User added successfully.');
				} else {
					$response = array('status' => false, 'message' => 'Failed to add user.', 'data' => '');
				}
			} else {
				$response = array('status' => false, 'message' => 'User already registered.', 'data' => '');
			}
		}
		echo json_encode($response);
	}

	/**
	 * [edit load edit user wizard]
	 */
	function edit($id)
	{
		if (!$this->checkLogin()) {
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME . ' | Edit User';
		$pageData['page_title'] = 'User Management';
		$pageData['parent_menu'] = 'user_management';
		$pageData['child_menu'] = 'users';

		//get user profile
		$where = array('id' => $id);
		$profile = $this->base_model->getCommon($this->primaryTable, $where);

		//get User category
		$where = array('status_id =' => ACTIVE);
		$select = '*';
		$records = 2;
		$roles = $this->base_model->getCommon($this->rolesTable, $where, $select, $records);
		$branches = $this->base_model->getCommon($this->branchesTable, $where, $select, $records);

		$pageData['user_details'] = json_encode($profile);
		$pageData['roles'] = json_encode($roles);
		$pageData['branches'] = json_encode($branches);

		$this->load->view('admin/user_management/edit', $pageData);
	}


	/**
	 * [ngUpdateDetails update user details]
	 * @return [object] [response object]
	 */
	function ngUpdateDetails()
	{
		$postData = json_decode($_POST['model']);
		$uploadResult = '';
		$invalidFile = true;
		if (count($_FILES) > 0) {
			$config['upload_path'] = SITE_DATA_PATH . 'user_profiles/';
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = 2048;
	        /*$config['max_width']            = 1024;
	        $config['max_height']           = 768;*/


			$this->load->library('upload', $config);

			$uploadResult = $this->upload->do_upload('file-0');
	        //echo $this->upload->display_errors();
			if (!$uploadResult) {
				$invalidFile = false;
			}

		}
		$result = false;
		$response = '';
		if ($invalidFile == false) {
			$response = array('status' => false, 'message' => 'Invalid image.', 'data' => '');
		} else {

			$where = array('id !=' => $postData->id, 'email_id' => $postData->email_id);
			$profile = $this->base_model->getCommon($this->primaryTable, $where);

			if (!$profile) {
				$where = array('id !=' => $postData->id, 'contact_no' => $postData->contact_no);
				$profile = $this->base_model->getCommon($this->primaryTable, $where);
			}

			if (!$profile) {
				$updateData = array(
					'first_name' => $postData->first_name,
					'last_name' => $postData->last_name,
							// 'email_id'		=>	$postData->email_id,
					'gender_id' => $postData->gender_id,
							// 'contact_no'	=>	$postData->contact_no,
					'role_id' => $postData->role_id,
					'branch_id' => $postData->branch_id,
					'descripton' => $postData->descripton,
					'status_id' => $postData->status_id,
					'updated_by' => $this->session->userdata['userProfile']->id,
					'updated_date' => date('Y-m-d h:i:s')
				);

				if ($uploadResult != '') {
					$uploadDetails = array('upload_data' => $this->upload->data());
					$updateData['user_profile'] = $uploadDetails['upload_data']['file_name'];
				}
	        	//print_r($updateData);die;
				$where = array('id' => $postData->id);

				$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

				if ($result) {
					$response = array('status' => true, 'message' => 'User updated successfully.', 'data' => '');
					$this->setSessionSuccessMessage('User updated successfully.');
				} else {
					$response = array('status' => false, 'message' => 'Failed to update user.', 'data' => '');
				}
			} else {
				$response = array('status' => false, 'message' => 'Duplicate email id or mobile no.', 'data' => '');
			}
		}
		echo json_encode($response);
	}

	/**
	 * [details load user details wizard]
	 */
	function details($id)
	{
		if (!$this->checkLogin()) {
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME . ' | User Details';
		$pageData['page_title'] = 'User Management';
		$pageData['parent_menu'] = 'user_management';
		$pageData['child_menu'] = 'users';

		//get user profile
		$where = array('id' => $id);
		$profile = $this->base_model->getCommon($this->primaryTable, $where);
		$pageData['user_details'] = json_encode($profile);

		//get User category
		$where = array('status_id =' => ACTIVE);
		$select = '*';
		$records = 2;
		$roles = $this->base_model->getCommon($this->rolesTable, $where, $select, $records);
		$branches = $this->base_model->getCommon($this->branchesTable, $where, $select, $records);
		$pageData['roles'] = json_encode($roles);
		$pageData['branches'] = json_encode($branches);

		$this->load->view('admin/user_management/details', $pageData);
	}

	/**
	 * [delete update user record to deleted]
	 * @param  [integere] $id [user id]
	 */
	function delete($id)
	{

		$where = array('id' => $id);
		$updateData = array('status_id' => DELETE);

		$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

		$this->setSessionSuccessMessage('User deleted successfully.');
		redirect(base_url('admin/users'));
	}


	/**
	 * [updateStatus update user account status]
	 * @return [object] [response object]
	 */
	function updateStatus()
	{
		$this->setPost();

		$postData = $_POST;

		if ($postData->status_id == 1) {
			$updateData = array('status_id' => 2);
		} else {
			$updateData = array('status_id' => 1);
		}

		$where = array('id' => $postData->id);

		$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

		$response = array('status' => true, 'message' => 'User status updated successfully.');

		echo json_encode($response);
	}

}
