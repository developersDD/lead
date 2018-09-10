<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an seller user interaction methods you could use
 * *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Santosh Patil
 * @license         GPL
 * @link            https://www.sample.com
 */
class Base extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['doctor_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['doctor_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['doctor_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    /**
     * [_send_email common function to send email]
     * @param  [string] $type    [email template file name]
     * @param  [string] $email   [to email id]
     * @param  [array] $data    [email template data array]
     * @param  [string] $subject [email subject]
     * @param  [string] $from    [email from email id]
     * @return [boolean]          [return true / false]
     */
    function _send_email($type, $email,$data, $subject,$from){  

        $this->load->library('email'); 
        $this->email->from(FROM_EMAIL, EMAIL_TITLE);
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
        if($this->email->send()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * [getTwelveHrsTimeFormat get 12 hours time format]
     * @param  [string] $date [time for conversion]
     * @return [string]       [12 hours convertered time]
     */
    public function getTwelveHrsTimeFormat($date){
        return date("h:i a", strtotime($date));
    }

    /**
     * [getcountries_get get country list]
     * @return [object] [result object with country list]
     */
    function getcountries_get(){

        $from = 'countries';
        $where = array();
        $select = '*';
        $records = 2;

        $countries = $this->base_model->getCommon($from, $where, $select, $records);

        if ($countries) {
            
            $response = array(
                'status' => TRUE,
                'message' => 'Countries found successfully.',
                'result' => $countries);

            $this->set_response($response, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code   
        }else{
            $response = array(
                    'status' => FALSE,
                    'message' => 'Country not found.');
            $this->response($response, REST_Controller::FIELD_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    /**
     * [getstate_get get state list]
     * @return [object] [result object with state list]
     */
    function getstate_get(){

        $countryID = $this->uri->segment(4);

        $countryID = isset($countryID) ? $countryID : "";

        if ($countryID == FALSE) {
            $response = array(
                    'status' => FALSE,
                    'message' => 'Country id should not be empty.'
                    );
            $this->response($response, REST_Controller::FIELD_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
            
        $from = 'states';
        $where = array('country_id' => $countryID);
        $select = '*';
        $records = 2;

        $states = $this->base_model->getCommon($from, $where, $select, $records);

        if ($states) {
            
            $response = array(
                'status' => TRUE,
                'message' => 'States found successfully.',
                'result' => $states);

            $this->set_response($response, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code   
        }else{
            $response = array(
                    'status' => FALSE,
                    'message' => 'Country not found.');
            $this->response($response, REST_Controller::FIELD_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    /**
     * [getcity_get get list of cities for passed state]
     * @return [object] [response array with city list]
     */
    function getcity_get(){

        $stateID = $this->uri->segment(4);

        $stateID = isset($stateID) ? $stateID : "";

        if ($stateID == FALSE) {
            $responsedata = array(
                    'status' => FALSE,
                    'message' => 'State id should not be empty.'
                    );
            $this->response($responsedata, REST_Controller::FIELD_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
        
        $from = 'cities';
        $where = array('state_id' => $stateID);
        $select = '*';
        $records = 2;

        $cities = $this->base_model->getCommon($from, $where, $select, $records);

        if ($cities) {
            $responsedata = array(
                'status' => TRUE,
                'message' => 'Cities found successfully.',
                'result' => $cities
                );
            $this->set_response($responsedata, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code   
        }else{
            $responsedata = array(
                    'status' => FALSE,
                    'message' => 'State not found.'
                    );
            $this->response($responsedata, REST_Controller::FIELD_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

}//## end Doctor Controller class