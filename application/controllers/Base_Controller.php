<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Base_Controller extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		
	}

	/**
	 * [checkLogin check if user logged in or not]
	 * @return [boolean] [return true if user is logged in or return false if not]
	 */
	function checkLogin(){
		if($this->session->userdata('userProfile')){
			return true;
		}else{
			return false;
		}
	}
	
	function setPost(){
		if(empty($_POST)){
			$_POST = json_decode(file_get_contents('php://input'));
		}
	}

	/**
	 * [printData print data]
	 * @param  [type] $data [data to print]
	 * @param  string $exit [prevent execution]
	 */
	function printData($data, $exit=''){
		echo "<pre>";
		print_r($data);
		if($exit){
			exit;
		}
	}


	/**
	 * [setSessionSuccessMessage set session success message to show message on page redirection during ajax call]
	 */
	function setSessionSuccessMessage($message){
		$this->session->set_userdata('success', $message);
	}

	/**
	 * [setSessionFailedMessage set session failed message to show message on page redirection during ajax call]
	 */
	function setSessionFailedMessage($message){
		$this->session->set_userdata('failed', $message);
	}
}