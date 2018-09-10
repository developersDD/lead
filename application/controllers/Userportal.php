<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Userportal extends CI_Controller {
	
	function index(){

		$this->load->view('userportal/default');
	}
}