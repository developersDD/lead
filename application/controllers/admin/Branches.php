<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'controllers/Base_Controller.php';

class Branches extends Base_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->primaryTable = 'branches';
	}

	public function index()
	{

		if (!$this->checkLogin()) {
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME . ' | Branch Management';
		$pageData['page_title'] = 'Branch Management';
		$pageData['parent_menu'] = 'branch_management';
		$pageData['child_menu'] = 'branches';

		$this->load->view('admin/branch_management/index', $pageData);
	}



	/**
	 * [ngGetBranchs get branchs list]
	 * @return [object] [response object]
	 */
	function ngGetBranches()
	{
		$where = array('status_id !=' => DELETE);
		$select = '*';
		$records = 2;
		$branches = $this->base_model->getCommon($this->primaryTable, $where, $select, $records);
		$pageData['branches'] = json_encode($branches);
		$response = array('status' => true, 'message' => 'Branchs found successfully.', 'data' => $branches);
		echo json_encode($response);
	}

	/**
	 * [add load add new branch wizard]
	 */
	function add()
	{
		if (!$this->checkLogin()) {
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME . ' | Add Branch';
		$pageData['page_title'] = 'Branch Management';
		$pageData['parent_menu'] = 'branch_management';
		$pageData['child_menu'] = 'add_new_branch';

		$this->load->view('admin/branch_management/add', $pageData);
	}

	/**
	 * [ngSave save new branch]
	 * @return [object] [reponse object]
	 */
	function ngSave()
	{
		$this->setPost();
		$postData = $_POST->branch;

		$response = '';
        	// print_r($postData);die;
		//get branch profile
		$where = array('branch_email' => $postData->branch_email, 'status_id !=' => DELETE);
		$profile = $this->base_model->getCommon($this->primaryTable, $where);
		if (!$profile) {
			$where = array('branch_mobile' => $postData->branch_mobile);
			$profile = $this->base_model->getCommon($this->primaryTable, $where);
		}

		if (!$profile) {
			$saveData = array(
				'branch_name' => $postData->branch_name,
				'branch_code' => $postData->branch_code,
				'branch_email' => $postData->branch_email,
				'branch_mobile' => $postData->branch_mobile,
				'branch_phone' => $postData->branch_phone,
				'branch_fax' => $postData->branch_fax
			);
			$insertID = $this->base_model->saveCommon($this->primaryTable, $saveData);

			if ($insertID) {
				$response = array('status' => true, 'message' => 'Branch added successfully.', 'data' => '');
				$this->setSessionSuccessMessage('Branch added successfully.');
			} else {
				$response = array('status' => false, 'message' => 'Failed to add branch.', 'data' => '');
			}
		} else {
			$response = array('status' => false, 'message' => 'Branch already registered.', 'data' => '');
		}
		echo json_encode($response);
	}

	/**
	 * [edit load edit branch wizard]
	 */
	function edit($id)
	{
		if (!$this->checkLogin()) {
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME . ' | Edit Branch';
		$pageData['page_title'] = 'Branch Management';
		$pageData['parent_menu'] = 'branch_management';
		$pageData['child_menu'] = 'branches';

		//get branch profile
		$where = array('id' => $id);
		$profile = $this->base_model->getCommon($this->primaryTable, $where);
		$pageData['branch_details'] = json_encode($profile);

		$this->load->view('admin/branch_management/edit', $pageData);
	}


	/**
	 * [ngUpdateDetails update branch details]
	 * @return [object] [response object]
	 */
	function ngUpdateDetails()
	{
		$this->setPost();
		$postData = $_POST->branch;
		$result = false;
		$response = '';
		$where = array('id !=' => $postData->id, 'branch_email' => $postData->branch_email);
		$profile = $this->base_model->getCommon($this->primaryTable, $where);

		if (!$profile) {
			$where = array('id !=' => $postData->id, 'branch_mobile' => $postData->branch_mobile);
			$profile = $this->base_model->getCommon($this->primaryTable, $where);
		}
		// print_r($profile);die;

		if (!$profile) {
			$updateData = array(
				'branch_name' => $postData->branch_name,
				'branch_code' => $postData->branch_code,
				'branch_email' => $postData->branch_email,
				'branch_mobile' => $postData->branch_mobile,
				'branch_phone' => $postData->branch_phone,
				'branch_fax' => $postData->branch_fax,
				'status_id' => $postData->status_id
			);
	        	// print_r($updateData);die;
			$where = array('id' => $postData->id);

			$result = $this->base_model->updateCommon($this->primaryTable, $updateData, $where);

			if ($result) {
				$response = array('status' => true, 'message' => 'Branch updated successfully.', 'data' => '');
				$this->setSessionSuccessMessage('Branch updated successfully.');
			} else {
				$response = array('status' => false, 'message' => 'Failed to update branch.', 'data' => '');
			}
		} else {
			$response = array('status' => false, 'message' => 'Duplicate email id or mobile no.', 'data' => '');
		}
		echo json_encode($response);
	}

	/**
	 * [details load branch details wizard]
	 */
	function details($id)
	{
		if (!$this->checkLogin()) {
			redirect(base_url());
		}

		$pageData['header_title'] = APP_NAME . ' | Branch Details';
		$pageData['page_title'] = 'Branch Management';
		$pageData['parent_menu'] = 'branch_management';
		$pageData['child_menu'] = 'branches';

		//get branch profile
		$where = array('id' => $id);
		$profile = $this->base_model->getCommon($this->primaryTable, $where);
		$pageData['branch_details'] = json_encode($profile);

		$this->load->view('admin/branch_management/details', $pageData);
	}

	/**
	 * [delete update branch record to deleted]
	 * @param  [integere] $id [branch id]
	 */
	function delete($id)
	{

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

		$response = array('status' => true, 'message' => 'Branch status updated successfully.');

		echo json_encode($response);
	}

}
