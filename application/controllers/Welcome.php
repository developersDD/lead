<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'controllers/Base_Controller.php';

class Welcome extends Base_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		
		// $this->load->view('welcome_message');
		if($this->session->userdata('userProfile')){
			redirect(base_url('admin/dashboard'));
		}else{
			$this->load->view('admin/login/index');
		}
	}

	/**
	 * [sample_dt_conversion sample function for date conversion]
	 */
	function sample_dt_conversion(){
		$date = '2018-04-23'; //Y-m-d
		$current_format = 'Y-m-d';
		$expected_format = 'd-m-Y';

		$conversion = convertDate($date, $current_format, $expected_format);

		echo $conversion; exit;
	}

	/**
	 * [login user login]
	 * @return [array] [response array]
	 */
	function login(){
		$this->setPOST();
		
		if($this->do_login()){
			$response = array('status' => TRUE, 'message' => 'User logged in successfully.', 
							'data' => $this->session->userdata('userProfile'));
		}else{
			$response = array('status' => FALSE, 'message' => 'Invalid username and password.', 'data' => '');
		}
		echo json_encode($response);
	}

	function logout(){
		$this->session->unset_userdata('userProfile');

		$response = array('status' => TRUE, 'message' => 'User logged out successfully.');
		echo json_encode($response);
	}

	function test(){
		$response = array('status' => TRUE, 'message' => 'Data found successfully.', 'data' => array('id' => 1, 'name' => 'Daren Sammy'));
		echo json_encode($response);
	}
}
