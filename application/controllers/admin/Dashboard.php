<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'controllers/Base_Controller.php';

class Dashboard extends Base_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index(){

		$pageData['header_title'] = APP_NAME.' | Dashboard';
		$pageData['page_title'] = 'Welcome to Dashboard';
		$pageData['parent_menu'] = 'dashboard';
		$pageData['child_menu'] = '';

		$this->load->view('admin/dashboard/index', $pageData);
	}

	/**
	 * [ngGetLogo]
	 * @return [object] [response object]
	 */
	function ngGetTotals(){
		$where = array('status_id!=' => DELETE);
		$select = '*';
		$records = 2;
		$users = $this->base_model->getCommon('users', $where, $select, $records);
		$messages = $this->base_model->getCommon('message_board', $where, $select, $records);
		$quick_links = $this->base_model->getCommon('quick_links', $where, $select, $records);
		$documents = $this->base_model->getCommon('document', $where, $select, $records);

		$totals['users'] = count($users);
		$totals['messages'] = count($messages);
		$totals['quick_links'] = count($quick_links);
		$totals['documents'] = count($documents);
		if(!empty($totals)){
			$response = array('status' => TRUE, 'message' => 'Total records found successfully.', 'data' => $totals);
		}

		echo json_encode($response);
	}
}
