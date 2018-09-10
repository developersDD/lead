<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * [send_email common function to send email]
	 * @param  [string] $html_template   [email htmltemplate file name]
	 * @param  [string] $to_email   [to email id]
	 * @param  [array] $data       	[html template data array]
	 * @param  [string] $subject    [subject string]
	 * @param  [string] $from_email [from email]
	 * @return [boolean]            [true / false]
	 */
	function send_email($html_template, $to_email, $data, $subject, $from_email){
		if($from_email=''){
			$from_email = EMAIL_FROM;
		}
		$this->load->library('email');

		$this->email->from($from_email);
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($this->load->view($html_template), $data, TRUE);

		if($this->email->send()){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	/**
	 * [send_sms common helper for sending sms]
	 * @param  [string] $number  [mobile number to send sms on]
	 * @param  [string] $message [message text]
	 * @return [boolean]         [response]
	 */
	function send_sms($number, $message){
		$message = urlencode($message);
		$message_string = "username=".SMS_USERNAME."&hash=".SMS_HASH."&message=".$message."&sender=".SMS_SENDERNAME."&numbers=".$number;

		$ch = curl_init(SMS_API.'?');
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $message_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}

	
	/**
	 * [convertDate common helper function from converting date format]
	 * @param  [string] $date            [date to be converted]
	 * @param  [string] $current_format  [current date format]
	 * @param  [string] $expected_format [expected date format]
	 * @return [string]                  [converted date]
	 */
	function convertDate($date, $current_format, $expected_format){

			 if($current_format=='Y-m-d'){ $date = explode('-', $date); $day = $date[2]; $month = $date[1]; $year = $date[0]; }
		else if($current_format=='Y/m/d'){ $date = explode('/', $date); $day = $date[2]; $month = $date[1]; $year = $date[0]; }
		else if($current_format=='Y m d'){ $date = explode(' ', $date); $day = $date[2]; $month = $date[1]; $year = $date[0]; }
		else if($current_format=='m-d-Y'){ $date = explode('-', $date); $day = $date[1]; $month = $date[0]; $year = $date[2]; }
		else if($current_format=='m/d/Y'){ $date = explode('/', $date); $day = $date[1]; $month = $date[0]; $year = $date[2]; }
		else if($current_format=='m d Y'){ $date = explode(' ', $date); $day = $date[1]; $month = $date[0]; $year = $date[2]; }
		else if($current_format=='d-m-Y'){ $date = explode('-', $date); $day = $date[0]; $month = $date[1]; $year = $date[2]; }
		else if($current_format=='d/m/Y'){ $date = explode('/', $date); $day = $date[0]; $month = $date[1]; $year = $date[2]; }
		else if($current_format=='d m Y'){ $date = explode(' ', $date); $day = $date[0]; $month = $date[1]; $year = $date[2]; }
		else if($current_format=='Y-d-m'){ $date = explode('-', $date); $day = $date[1]; $month = $date[2]; $year = $date[0]; }
		else if($current_format=='Y/d/m'){ $date = explode('/', $date); $day = $date[1]; $month = $date[2]; $year = $date[0]; }
		else if($current_format=='Y d m'){ $date = explode(' ', $date); $day = $date[1]; $month = $date[2]; $year = $date[0]; }

			 if($expected_format == 'Y-m-d'){ $date = $year.'-'.$month.'-'.$day; }
		else if($expected_format == 'Y/m/d'){ $date = $year.'/'.$month.'/'.$day; }
		else if($expected_format == 'Y m d'){ $date = $year.' '.$month.' '.$day; }
		else if($expected_format == 'm-d-Y'){ $date = $month.'-'.$day.'-'.$year; }
		else if($expected_format == 'm/d/Y'){ $date = $month.'/'.$day.'/'.$year; }
		else if($expected_format == 'm d Y'){ $date = $month.' '.$day.' '.$year; }
		else if($expected_format == 'd-m-Y'){ $date = $day.'-'.$month.'-'.$year; }
		else if($expected_format == 'd/m/Y'){ $date = $day.'/'.$month.'/'.$year; }
		else if($expected_format == 'd m Y'){ $date = $day.' '.$month.' '.$year; }
		else if($expected_format == 'Y-d-m'){ $date = $year.'-'.$day.'-'.$month; }
		else if($expected_format == 'Y/d/m'){ $date = $year.'/'.$day.'/'.$month; }
		else if($expected_format == 'Y d m'){ $date = $year.' '.$day.' '.$month; }

		return $date;		
	}
?>