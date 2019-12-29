<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newspaper_API extends CI_Controller{
  public function __construct(){
    header('Access-Control-Allow-Origin: *');
	  header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    parent::__construct();
    $this->load->model('User_Model');
    $this->load->model('Transaction_Model');
    $this->load->model('Report_Model');
    $this->load->model('API_Model');
  }

  public function sign_up(){
    $c_name = $_REQUEST['owner_name'];
    $company_name = $_REQUEST['company_name'];
    $company_city = $_REQUEST['city'];
    $company_mob1 = $_REQUEST['mob_no1'];
    $user_password = $_REQUEST['password'];
    $company_imei = $_REQUEST['imei_no1'];
    $company_imei2 = $_REQUEST['imei_no2'];

    $company_data = array(
      'c_name' => $c_name,
      'company_name' => $company_name,
      'company_city' => $company_city,
      'company_mob1' => $company_mob1,
      'company_imei' => $company_imei,
      'company_imei2' => $company_imei2,
    );
    $com_save = $this->User_Model->save_data('company', $company_data);
    $user_data = array(
      'user_name' => $c_name,
      'user_city' => $company_city,
      'user_mobile' => $company_mob1,
      'user_password' => $user_password,
      'user_imei' => $company_imei,
      'company_id' => $com_save,
    );
    $user_save = $this->User_Model->save_data('user', $user_data);
    if($com_save && $user_save){
      $otp = mt_rand(100000, 999999);
      $up_otp['user_otp'] = $otp;
      $this->User_Model->update_info('user_id', $user_save, 'user', $up_otp);

      $response["status"] = TRUE;
  		$response["msg"] = "Registered Successful";
    } else{
      $response["status"] = FALSE;
  		$response["msg"] = "Registration Failed";
    }
		$json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }

  public function save_company(){
    $company_id = $_REQUEST['company_id'];
    $update_data['c_name'] = $_REQUEST['owner_name'];
    $update_data['company_name'] = $_REQUEST['company_name'];
    $update_data['company_address'] = $_REQUEST['address'];
    $update_data['company_city'] = $_REQUEST['city'];
    $update_data['company_state'] = $_REQUEST['state'];
    $update_data['company_mob1'] = $_REQUEST['mob_no1'];
    $update_data['company_mob2'] = $_REQUEST['mob_no2'];
    $update_data['company_email'] = $_REQUEST['email'];
    $update_data['company_gpay_no'] = $_REQUEST['gpay_no'];
    $update_data['company_pan_no'] = $_REQUEST['pan_no'];
    $update_data['company_lic1'] = $_REQUEST['lic_no1'];
    $update_data['company_lic2'] = $_REQUEST['lic_no2'];
    $update_data['company_imei'] = $_REQUEST['imei_no1'];
    $update_data['company_imei2'] = $_REQUEST['imei_no2'];

    $this->User_Model->update_info('company_id', $company_id, 'company', $update_data);
    $response["status"] = TRUE;
    $response["msg"] = "Company Saved Successful";
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }

  public function sign_in(){
    $phoneno = $_REQUEST['mob_no1'];
    $password = $_REQUEST['password'];
		$imei = $_REQUEST['imei_no1'];

		$user = $this->API_Model->UserLogin($phoneno, $password, $imei);
    // $response["msg"] = $user;
    if($user == null){
			$response["status"] = FALSE;
			$response["msg"] = "Login not SuccessFul \n\n Check Your Phone Number or Password";
		}else{
			$response["status"] = TRUE;
			$response["msg"] = "Login SuccessFul";
		}

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }

  public function change_password(){
    $user_id = $_REQUEST['user_id'];
    $old_password = $_REQUEST['old_password'];
		$new_password = $_REQUEST['new_password'];

    $check = $this->User_Model->check_password($user_id,$old_password);
    if($check == null){
      $response["status"] = FALSE;
			$response["msg"] = "Incorrect Old Password";
    }
    else{
      $up_data['user_password'] = $new_password;
      $this->User_Model->update_info('user_id', $user_id, 'user', $up_data);
      $response["status"] = TRUE;
			$response["msg"] = "Password Changed Successful";
    }
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }

  public function check_otp(){
    $user_id = $_REQUEST['user_id'];
    $otp = $_REQUEST['otp'];
    $check_otp = $this->API_Model->check_otp($user_id,$otp);
    if($check_otp == null){
      $response["status"] = FALSE;
			$response["msg"] = "Incorrect OTP";
    }
    else{
      $response["status"] = TRUE;
			$response["msg"] = "Correct OTP";
    }
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }

  public function save_delivery_line(){
    $save_data['company_id'] = $_REQUEST['company_id'];
    $save_data['delivery_line_name'] = $_REQUEST['delivery_line_name'];
    $save_data['liboy_id'] = $_REQUEST['line_boy_id'];
    $save_data['collboy_id'] = $_REQUEST['collection_boy_id'];

    $save = $this->User_Model->save_data('delivery_line', $save_data);
    if($save == null){
      $response["status"] = FALSE;
			$response["msg"] = "Delivery Line Not Saved";
    }
    else{
      $response["status"] = TRUE;
			$response["msg"] = "Delivery Line Saved";
    }
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }

  public function delivery_line_list(){
    $company_id = $_REQUEST['company_id'];
    $delivery_line = $this->API_Model->get_list($company_id,'delivery_line_id','ASC','delivery_line');
    $response["status"] = FALSE;
		$response["delivery_line_list"] = $delivery_line;

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }

  public function delivery_line_details(){
    $delivery_line_id = $_REQUEST['delivery_line_id'];
    $delivery_line_details = $this->API_Model->get_info_array('delivery_line_id', $delivery_line_id, 'delivery_line');
    $response["status"] = FALSE;
		$response["delivery_line_details"] = $delivery_line_details;

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }

  public function update_delivery_line(){
    $delivery_line_id = $_REQUEST['delivery_line_id'];
    $update_data['delivery_line_name'] = $_REQUEST['delivery_line_name'];
    $update_data['liboy_id'] = $_REQUEST['line_boy_id'];
    $update_data['collboy_id'] = $_REQUEST['collection_boy_id'];

    $update = $this->User_Model->update_info('delivery_line_id', $delivery_line_id, 'delivery_line', $update_data);

    $response["status"] = FALSE;
		$response["msg"] = "Delivery Line Updated Successful";

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }
}


?>
