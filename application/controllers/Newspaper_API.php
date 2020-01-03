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
    $response["status"] = TRUE;
		$response["delivery_line_list"] = $delivery_line;

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }

  public function delivery_line_details(){
    $delivery_line_id = $_REQUEST['delivery_line_id'];
    $delivery_line_details = $this->API_Model->get_info_array('delivery_line_id', $delivery_line_id, 'delivery_line');
    $response["status"] = TRUE;
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

    $response["status"] = TRUE;
		$response["msg"] = "Delivery Line Updated Successful";

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }
/************************ Lineboy ***************************/
  // Save Lineboy...
  public function save_lineboy(){
    $save_data['company_id'] = $_REQUEST['company_id'];
    $save_data['lineboy_name'] = $_REQUEST['lineboy_name'];
    $save_data['mobile1'] = $_REQUEST['mobile1'];
    $save_data['mobile2'] = $_REQUEST['mobile2'];
    $save_data['password'] = $_REQUEST['password'];
    $save_data['salary'] = $_REQUEST['salary'];
    $save_data['l_imei'] = $_REQUEST['l_imei_no'];
    $save_data['is_lineboy'] = $_REQUEST['is_lineboy'];
    $save_data['is_collectionboy'] = $_REQUEST['is_collectionboy'];

    $mobile1 = $_REQUEST['mobile1'];
    $is_lineboy = $_REQUEST['is_collectionboy'];
    $is_collectionboy = $_REQUEST['is_collectionboy'];
    if(!isset($is_lineboy)){ $is_lineboy='';}
    if(!isset($is_collectionboy)){ $is_collectionboy='';}

    $check = $this->User_Model->check_duplication($save_data['company_id'],$mobile1,'mobile1','lineboy');
    if($check){
      $response["status"] = FALSE;
  		$response["msg"] = "Mobile Number Exist";
    }
    else{
      $this->User_Model->save_data('lineboy', $save_data);
      $response["status"] = TRUE;
  		$response["msg"] = "Lineboy Saved Successful";
    }
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }
  // Lineboy List...
  public function lineboy_list(){
    $company_id = $_REQUEST['company_id'];
    $lineboy = $this->API_Model->get_list($company_id,'lineboy_id','ASC','lineboy');
    $response["status"] = TRUE;
		$response["lineboy"] = $lineboy;

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }
  // Lineboy Details...
  public function lineboy_details(){
    $lineboy_id = $_REQUEST['lineboy_id'];
    $lineboy_details = $this->API_Model->get_info_array('lineboy_id', $lineboy_id, 'lineboy');
    $response["status"] = TRUE;
		$response["lineboy_details"] = $lineboy_details;

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }
  // Update Lineboy...
  public function update_lineboy(){
    $lineboy_id = $_REQUEST['lineboy_id'];
    $update_data['lineboy_name'] = $_REQUEST['lineboy_name'];
    $update_data['mobile1'] = $_REQUEST['mobile1'];
    $update_data['mobile2'] = $_REQUEST['mobile2'];
    $update_data['password'] = $_REQUEST['password'];
    $update_data['salary'] = $_REQUEST['salary'];
    $update_data['l_imei'] = $_REQUEST['l_imei_no'];
    $update_data['is_lineboy'] = $_REQUEST['is_lineboy'];
    $update_data['is_collectionboy'] = $_REQUEST['is_collectionboy'];

    $mobile1 = $_REQUEST['mobile1'];
    $is_lineboy = $_REQUEST['is_collectionboy'];
    $is_collectionboy = $_REQUEST['is_collectionboy'];
    if(!isset($is_lineboy)){ $is_lineboy='';}
    if(!isset($is_collectionboy)){ $is_collectionboy='';}

    $update = $this->User_Model->update_info('lineboy_id', $lineboy_id, 'lineboy', $update_data);

    $response["status"] = TRUE;
		$response["msg"] = "Lineboy Updated Successful";

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }

  public function delete_lineboy(){
    $lineboy_id = $_REQUEST['lineboy_id'];
    $this->User_Model->delete_info('lineboy_id', $lineboy_id, 'lineboy');
    $response["status"] = TRUE;
		$response["msg"] = "Lineboy Deleted Successfully";

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }

/************************ Newspaper ***************************/
  // Language List...
  public function language_list(){
    $company_id = $_REQUEST['company_id'];
    $language_list = $this->User_Model->get_list1('language_id','ASC','language');
    $response["status"] = TRUE;
    $response["language_list"] = $language_list;

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }

  // Language List...
  public function paper_type_list(){
    $company_id = $_REQUEST['company_id'];
    $paper_type_list = $this->User_Model->get_list1('papertype_id','ASC','papertype');
    $response["status"] = TRUE;
    $response["paper_type_list"] = $paper_type_list;

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }

  // Save Newspaper...
  public function save_newspaper(){
    $save_data['company_id'] = $_REQUEST['company_id'];
    $save_data['newspaper_info_name'] = $_REQUEST['newspaper_name'];
    $save_data['rate'] = $_REQUEST['rate'];
    $save_data['papertype_id'] = $_REQUEST['papertype_id'];
    $save_data['language_id'] = $_REQUEST['language_id'];

    $this->User_Model->save_data('newspaper_info', $save_data);
    $response["status"] = TRUE;
		$response["msg"] = "Newspaper Info Saved Successfully";

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }
  // Newspaper List...
  public function newspaper_list(){
    $company_id = $_REQUEST['company_id'];
    $newspaper = $this->API_Model->get_list($company_id,'newspaper_info_id','ASC','newspaper_info');
    $response["status"] = TRUE;
		$response["newspaper_list"] = $newspaper;

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }
  // Newspaper Details...
  public function newspaper_details(){
    $newspaper_id = $_REQUEST['newspaper_id'];
    $newspaper_details = $this->API_Model->get_info_array('newspaper_info_id', $newspaper_id, 'newspaper_info');
    $response["status"] = TRUE;
		$response["newspaper_details"] = $newspaper_details;

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }
  // Update Newspaper...
  public function update_newspaper(){
    $newspaper_id = $_REQUEST['newspaper_id'];
    $update_data['newspaper_info_name'] = $_REQUEST['newspaper_name'];
    $update_data['rate'] = $_REQUEST['rate'];
    $update_data['papertype_id'] = $_REQUEST['papertype_id'];
    $update_data['language_id'] = $_REQUEST['language_id'];

    $update = $this->User_Model->update_info('newspaper_info_id', $newspaper_id, 'newspaper_info', $update_data);

    $response["status"] = TRUE;
		$response["msg"] = "Newspaper Updated Successful";

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }
  // Delete Newspaper...
  public function delete_newspaper(){
    $newspaper_id = $_REQUEST['newspaper_id'];
    $this->User_Model->delete_info('newspaper_info_id', $newspaper_id, 'newspaper_info');
    $response["status"] = TRUE;
		$response["msg"] = "Newspaper Deleted Successfully";

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }

/*************************** Scheme *************************/
  // Scheme Type List...
  public function scheme_type_list(){
    $company_id = $_REQUEST['company_id'];
    $scheme_type_list = $this->User_Model->get_list1('scheme_type_id','ASC','scheme_type');
    $response["status"] = TRUE;
    $response["scheme_type_list"] = $scheme_type_list;

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Save Scheme...
  public function save_scheme(){
    $save_data['company_id'] = $_REQUEST['company_id'];
    $save_data['scheme_info_name'] = $_REQUEST['scheme_name'];
    $save_data['month_count'] = $_REQUEST['month_count'];
    $save_data['booking_fee'] = $_REQUEST['booking_fee'];
    $save_data['scheme_fee'] = $_REQUEST['scheme_fee'];
    $save_data['gift_count'] = $_REQUEST['gift_count'];
    $save_data['scheme_type_id'] = $_REQUEST['scheme_type_id'];
    $save_data['newspaper_info_id'] = $_REQUEST['newspaper_id'];
    $save_data['is_monthly_bill'] = $_REQUEST['is_monthly_bill'];
    $scheme_info_status = $_REQUEST['scheme_info_status'];
    if(!isset($scheme_info_status)){ $scheme_info_status='active';}
    $save_data['scheme_info_status'] = $scheme_info_status;

    $this->User_Model->save_data('scheme_info', $save_data);
    $response["status"] = TRUE;
		$response["msg"] = "Scheme Saved Successfully";

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }
  // Scheme List...
  public function scheme_list(){
    $company_id = $_REQUEST['company_id'];
    $scheme = $this->API_Model->get_list($company_id,'scheme_info_id','ASC','scheme_info');
    $response["status"] = TRUE;
		$response["scheme_list"] = $scheme;
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }
  // Scheme Details...
  public function scheme_details(){
    $scheme_id = $_REQUEST['scheme_id'];
    $scheme_details = $this->API_Model->get_info_array('scheme_info_id', $scheme_id, 'scheme_info');
    $response["status"] = TRUE;
		$response["scheme_details"] = $scheme_details;

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }
  // Update Scheme...
  public function update_scheme(){
    $scheme_id = $_REQUEST['scheme_id'];
    $update_data['scheme_info_name'] = $_REQUEST['scheme_name'];
    $update_data['month_count'] = $_REQUEST['month_count'];
    $update_data['booking_fee'] = $_REQUEST['booking_fee'];
    $update_data['scheme_fee'] = $_REQUEST['scheme_fee'];
    $update_data['gift_count'] = $_REQUEST['gift_count'];
    $update_data['scheme_type_id'] = $_REQUEST['scheme_type_id'];
    $update_data['newspaper_info_id'] = $_REQUEST['newspaper_id'];
    $update_data['is_monthly_bill'] = $_REQUEST['is_monthly_bill'];
    $scheme_info_status = $_REQUEST['scheme_info_status'];
    if(!isset($scheme_info_status)){ $scheme_info_status='active';}
    $update_data['scheme_info_status'] = $scheme_info_status;

    $update = $this->User_Model->update_info('scheme_info_id', $scheme_id, 'scheme_info', $update_data);

    $response["status"] = TRUE;
		$response["msg"] = "Scheme Updated Successful";

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }
  // Delete Scheme...
  public function delete_scheme(){
    $scheme_id = $_REQUEST['scheme_id'];
    $this->User_Model->delete_info('scheme_info_id', $scheme_id, 'scheme_info');
    $response["status"] = TRUE;
		$response["msg"] = "Scheme Deleted Successfully";

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		echo str_replace('\\/','/',$json_response);
  }

/**************************** Supplier *********************/
  // Save Supplier...
  public function save_supplier(){
    $save_data['company_id'] = $_REQUEST['company_id'];
    $save_data['supplier_name'] = $_REQUEST['supplier_name'];
    $save_data['supplier_mobile'] = $_REQUEST['supplier_mobile'];
    $save_data['supplier_email'] = $_REQUEST['supplier_email'];
    $save_data['supplier_city'] = $_REQUEST['supplier_city'];
    $save_data['supplier_op_bal'] = $_REQUEST['supplier_op_bal'];
    $supplier_status = $_REQUEST['supplier_status'];
    if(!isset($supplier_status)){ $supplier_status='active';}
    $save_data['supplier_status'] = $supplier_status;

    $this->User_Model->save_data('supplier', $save_data);
    $response["status"] = TRUE;
    $response["msg"] = "Supplier Saved Successfully";

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Supplier List...
  public function supplier_list(){
    $company_id = $_REQUEST['company_id'];
    $supplier = $this->API_Model->get_list($company_id,'supplier_id','ASC','supplier');
    $response["status"] = TRUE;
    $response["supplier_list"] = $supplier;
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Supplier Details...
  public function supplier_details(){
    $supplier_id = $_REQUEST['supplier_id'];
    $supplier_details = $this->API_Model->get_info_array('supplier_id', $supplier_id, 'supplier');
    $response["status"] = TRUE;
    $response["supplier_details"] = $supplier_details;

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Update Supplier...
  public function update_supplier(){
    $supplier_id = $_REQUEST['supplier_id'];
    $update_data['supplier_name'] = $_REQUEST['supplier_name'];
    $update_data['supplier_mobile'] = $_REQUEST['supplier_mobile'];
    $update_data['supplier_email'] = $_REQUEST['supplier_email'];
    $update_data['supplier_city'] = $_REQUEST['supplier_city'];
    $update_data['supplier_op_bal'] = $_REQUEST['supplier_op_bal'];
    $supplier_status = $_REQUEST['supplier_status'];
    if(!isset($supplier_status)){ $supplier_status='active';}
    $update_data['supplier_status'] = $supplier_status;

    $update = $this->User_Model->update_info('supplier_id', $supplier_id, 'supplier', $update_data);
    $response["status"] = TRUE;
    $response["msg"] = "Supplier Updated Successful";
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Delete Supplier...
  public function delete_supplier(){
    $supplier_id = $_REQUEST['supplier_id'];
    $this->User_Model->delete_info('supplier_id', $supplier_id, 'supplier');
    $response["status"] = TRUE;
    $response["msg"] = "Supplier Deleted Successfully";

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }

/**************************** Expenses Type *********************/
  // Save Expenses Type...
  public function save_expense_type(){
    $save_data['company_id'] = $_REQUEST['company_id'];
    $save_data['expense_type_name'] = $_REQUEST['expense_type_name'];
    $save_data['expense_type_addedby'] = $_REQUEST['user_id'];

    $this->User_Model->save_data('expense_type', $save_data);
    $response["status"] = TRUE;
    $response["msg"] = "Expenses Type Saved Successfully";

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Expenses Type List...
  public function expense_type_list(){
    $company_id = $_REQUEST['company_id'];
    $expense_type = $this->API_Model->get_list($company_id,'expense_type_id','ASC','expense_type');
    $response["status"] = TRUE;
    $response["expense_type_list"] = $expense_type;
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Expenses Type Details...
  public function expense_type_details(){
    $expense_type_id = $_REQUEST['expense_type_id'];
    $expense_type_details = $this->API_Model->get_info_array('expense_type_id', $expense_type_id, 'expense_type');
    $response["status"] = TRUE;
    $response["expense_type_details"] = $expense_type_details;

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Update Expenses Type...
  public function update_expense_type(){
    $expense_type_id = $_REQUEST['expense_type_id'];
    $update_data['expense_type_name'] = $_REQUEST['expense_type_name'];
    $update_data['expense_type_addedby'] = $_REQUEST['user_id'];

    $update = $this->User_Model->update_info('expense_type_id', $expense_type_id, 'expense_type', $update_data);
    $response["status"] = TRUE;
    $response["msg"] = "Expenses Type Updated Successful";
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Delete Expenses Type...
  public function delete_expense_type(){
    $expense_type_id = $_REQUEST['expense_type_id'];
    $this->User_Model->delete_info('expense_type_id', $expense_type_id, 'expense_type');
    $response["status"] = TRUE;
    $response["msg"] = "Expenses Type Deleted Successfully";

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }




/********************************************************************************/
/*                                  Transaction                                 */
/********************************************************************************/


/**************************** Expense *********************/
  // Save Expense...
  public function save_expense(){
    $save_data['company_id'] = $_REQUEST['company_id'];
    $save_data['expense_vc_no'] = $this->Transaction_Model->get_count_no($save_data['company_id'], 'expense_vc_no', 'expense');
    $save_data['expense_date'] = $_REQUEST['expense_date'];
    $save_data['expense_type'] = $_REQUEST['expense_type_id'];
    $save_data['expense_amount'] = $_REQUEST['expense_amount'];
    $save_data['expense_notes'] = $_REQUEST['expense_notes'];
    $save_data['expense_addedby'] = $_REQUEST['user_id'];

    $this->User_Model->save_data('expense', $save_data);
    $response["status"] = TRUE;
    $response["msg"] = "Expense Saved Successfully";
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Expense List...
  public function expense_list(){
    $company_id = $_REQUEST['company_id'];
    $expense = $this->API_Model->get_list($company_id,'expense_id','ASC','expense');
    $response["status"] = TRUE;
    $response["expense_list"] = $expense;
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Expense Details...
  public function expense_details(){
    $expense_id = $_REQUEST['expense_id'];
    $expense_details = $this->API_Model->get_info_array('expense_id', $expense_id, 'expense');
    $response["status"] = TRUE;
    $response["expense_details"] = $expense_details;
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Update Expense...
  public function update_expense(){
    $expense_id = $_REQUEST['expense_id'];
    $update_data['expense_date'] = $_REQUEST['expense_date'];
    $update_data['expense_type'] = $_REQUEST['expense_type_id'];
    $update_data['expense_amount'] = $_REQUEST['expense_amount'];
    $update_data['expense_notes'] = $_REQUEST['expense_notes'];
    $update_data['expense_addedby'] = $_REQUEST['user_id'];

    $update = $this->User_Model->update_info('expense_id', $expense_id, 'expense', $update_data);
    $response["status"] = TRUE;
    $response["msg"] = "Expense Updated Successful";
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Delete Expense...
  public function delete_expense(){
    $expense_id = $_REQUEST['expense_id'];
    $this->User_Model->delete_info('expense_id', $expense_id, 'expense');
    $response["status"] = TRUE;
    $response["msg"] = "Expense Deleted Successfully";
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }

/**************************** Purchase Information *********************/
  // Save Purchase...
  public function save_purchase(){
    $save_data['company_id'] = $_REQUEST['company_id'];
    $save_data['purchase_vc_no'] = $this->Transaction_Model->get_count_no($save_data['company_id'], 'purchase_vc_no', 'purchase');
    $save_data['purchase_date'] = $_REQUEST['purchase_date'];
    $save_data['supplier_id'] = $_REQUEST['supplier_id'];
    $save_data['newspaper_info_id'] = $_REQUEST['newspaper_id'];
    $save_data['purchase_qty'] = $_REQUEST['purchase_qty'];
    $save_data['purchase_tot_amt'] = $_REQUEST['purchase_tot_amt'];
    $save_data['purchase_pay_amt'] = $_REQUEST['purchase_pay_amt'];
    $save_data['purchase_out_amt'] = $_REQUEST['purchase_out_amt'];
    $save_data['purchase_note'] = $_REQUEST['purchase_note'];
    $save_data['purchase_addedby'] = $_REQUEST['user_id'];

    $this->User_Model->save_data('purchase', $save_data);
    $response["status"] = TRUE;
    $response["msg"] = "Purchase Saved Successfully";
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Purchase List...
  public function purchase_list(){
    $company_id = $_REQUEST['company_id'];
    $purchase = $this->API_Model->get_list($company_id,'purchase_id','ASC','purchase');
    $response["status"] = TRUE;
    $response["purchase_list"] = $purchase;
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Purchase Details...
  public function purchase_details(){
    $purchase_id = $_REQUEST['purchase_id'];
    $purchase_details = $this->API_Model->get_info_array('purchase_id', $purchase_id, 'purchase');
    $response["status"] = TRUE;
    $response["purchase_details"] = $purchase_details;
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Update Purchase...
  public function update_purchase(){
    $purchase_id = $_REQUEST['purchase_id'];
    $update_data['purchase_date'] = $_REQUEST['purchase_date'];
    $update_data['supplier_id'] = $_REQUEST['supplier_id'];
    $update_data['newspaper_info_id'] = $_REQUEST['newspaper_id'];
    $update_data['purchase_qty'] = $_REQUEST['purchase_qty'];
    $update_data['purchase_tot_amt'] = $_REQUEST['purchase_tot_amt'];
    $update_data['purchase_pay_amt'] = $_REQUEST['purchase_pay_amt'];
    $update_data['purchase_out_amt'] = $_REQUEST['purchase_out_amt'];
    $update_data['purchase_note'] = $_REQUEST['purchase_note'];
    $update_data['purchase_addedby'] = $_REQUEST['user_id'];

    $update = $this->User_Model->update_info('purchase_id', $purchase_id, 'purchase', $update_data);
    $response["status"] = TRUE;
    $response["msg"] = "Purchase Updated Successfully";
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Delete Purchase...
  public function delete_purchase(){
    $purchase_id = $_REQUEST['purchase_id'];
    $this->User_Model->delete_info('purchase_id', $purchase_id, 'purchase');
    $response["status"] = TRUE;
    $response["msg"] = "Purchase Deleted Successfully";
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }

/**************************** Bill Cycle Information *********************/
  // Save Bill Cycle...
  public function save_bill_cycle(){
    $save_data['company_id'] = $_REQUEST['company_id'];
    $save_data['bill_cycle_name'] = $_REQUEST['bill_cycle_name'];
    $save_data['bill_cycle_from'] = $_REQUEST['bill_cycle_from'];
    $save_data['bill_cycle_to'] = $_REQUEST['bill_cycle_to'];
    $save_data['bill_cycle_addedby'] = $_REQUEST['user_id'];
    $company_id = $save_data['company_id'];
    $bill_cycle_from = $save_data['bill_cycle_from'];
    $bill_cycle_to = $save_data['bill_cycle_to'];
    $check = $this->Transaction_Model->check_bill_cycle($company_id,$bill_cycle_from,$bill_cycle_to);
    if($check){
      $response["status"] = FALSE;
      $response["msg"] = "Bill Cycle Exist";
    } else{
      $this->User_Model->save_data('bill_cycle', $save_data);
      $response["status"] = TRUE;
      $response["msg"] = "Bill Cycle Saved Successfully";
    }
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Bill Cycle List...
  public function bill_cycle_list(){
    $company_id = $_REQUEST['company_id'];
    $bill_cycle = $this->API_Model->get_list($company_id,'bill_cycle_id','ASC','bill_cycle');
    $response["status"] = TRUE;
    $response["bill_cycle_list"] = $bill_cycle;
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Bill Cycle Details...
  public function bill_cycle_details(){
    $bill_cycle_id = $_REQUEST['bill_cycle_id'];
    $bill_cycle_details = $this->API_Model->get_info_array('bill_cycle_id', $bill_cycle_id, 'bill_cycle');
    $response["status"] = TRUE;
    $response["bill_cycle_details"] = $bill_cycle_details;
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Update Bill Cycle...
  public function update_bill_cycle(){
    $bill_cycle_id = $_REQUEST['bill_cycle_id'];
    $update_data['bill_cycle_name'] = $_REQUEST['bill_cycle_name'];
    $update_data['bill_cycle_from'] = $_REQUEST['bill_cycle_from'];
    $update_data['bill_cycle_to'] = $_REQUEST['bill_cycle_to'];
    $update_data['bill_cycle_addedby'] = $_REQUEST['user_id'];

    $update = $this->User_Model->update_info('bill_cycle_id', $bill_cycle_id, 'bill_cycle', $update_data);
    $response["status"] = TRUE;
    $response["msg"] = "Bill Cycle Updated Successfully";
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Delete Bill Cycle...
  public function delete_bill_cycle(){
    $bill_cycle_id = $_REQUEST['bill_cycle_id'];
    $this->User_Model->delete_info('bill_cycle_id', $bill_cycle_id, 'bill_cycle');
    $response["status"] = TRUE;
    $response["msg"] = "Bill Cycle Deleted Successfully";
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }


/**************************** Receipt Information *********************/
  // Save Receipt...
  public function save_receipt(){
    $save_data['company_id'] = $_REQUEST['company_id'];
    $save_data['receipt_no'] = $this->Transaction_Model->get_count_no($save_data['company_id'], 'receipt_no', 'receipt');
    $save_data['receipt_date'] = $_REQUEST['receipt_date'];
    $save_data['delivery_line_id'] = $_REQUEST['delivery_line_id'];
    $save_data['customer_id'] = $_REQUEST['customer_id'];
    $save_data['out_amount'] = $_REQUEST['out_amount'];
    $save_data['rec_amount'] = $_REQUEST['rec_amount'];
    $save_data['pay_mode'] = $_REQUEST['pay_mode'];
    $save_data['cheque_no'] = $_REQUEST['cheque_no'];
    $save_data['cheque_date'] = $_REQUEST['cheque_date'];
    $save_data['cheque_amt'] = $_REQUEST['cheque_amt'];
    $save_data['receipt_ref_no'] = $_REQUEST['receipt_ref_no'];
    $save_data['receipt_note'] = $_REQUEST['receipt_note'];
    $save_data['receipt_addedby'] = $_REQUEST['user_id'];
    $this->User_Model->save_data('receipt', $save_data);

    $response["status"] = TRUE;
    $response["msg"] = "Receipt Saved Successfully";
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Receipt List...
  public function receipt_list(){
    $company_id = $_REQUEST['company_id'];
    $receipt = $this->API_Model->get_list($company_id,'receipt_id','ASC','receipt');
    $response["status"] = TRUE;
    $response["receipt_list"] = $receipt;
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Receipt Details...
  public function receipt_details(){
    $receipt_id = $_REQUEST['receipt_id'];
    $receipt_details = $this->API_Model->get_info_array('receipt_id', $receipt_id, 'receipt');
    $response["status"] = TRUE;
    $response["receipt_details"] = $receipt_details;
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Update Receipt...
  public function update_receipt(){
    $receipt_id = $_REQUEST['receipt_id'];
    $update_data['receipt_date'] = $_REQUEST['receipt_date'];
    $update_data['delivery_line_id'] = $_REQUEST['delivery_line_id'];
    $update_data['customer_id'] = $_REQUEST['customer_id'];
    $update_data['out_amount'] = $_REQUEST['out_amount'];
    $update_data['rec_amount'] = $_REQUEST['rec_amount'];
    $update_data['pay_mode'] = $_REQUEST['pay_mode'];
    $update_data['cheque_no'] = $_REQUEST['cheque_no'];
    $update_data['cheque_date'] = $_REQUEST['cheque_date'];
    $update_data['cheque_amt'] = $_REQUEST['cheque_amt'];
    $update_data['receipt_ref_no'] = $_REQUEST['receipt_ref_no'];
    $update_data['receipt_note'] = $_REQUEST['receipt_note'];
    $update_data['receipt_addedby'] = $_REQUEST['user_id'];

    $update = $this->User_Model->update_info('receipt_id', $receipt_id, 'receipt', $update_data);
    $response["status"] = TRUE;
    $response["msg"] = "Receipt Updated Successfully";
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Delete Receipt...
  public function delete_receipt(){
    $receipt_id = $_REQUEST['receipt_id'];
    $this->User_Model->delete_info('receipt_id', $receipt_id, 'receipt');
    $response["status"] = TRUE;
    $response["msg"] = "Receipt Deleted Successfully";
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }

/**************************** Customer Information *********************/


  // Save Customer...
  public function save_customer(){
    $mobile = $_REQUEST['mobile'];
    $bill_send_sms = $_REQUEST['bill_send_sms'];
    $bill_send_email = $_REQUEST['bill_send_email'];
    if(!isset($bill_send_sms)){ $bill_send_sms = ''; }
    if(!isset($bill_send_email)){ $bill_send_email = ''; }

    $save_data['company_id'] = $_REQUEST['company_id'];
    $save_data['delivery_line_id'] = $_REQUEST['delivery_line_id'];
    $save_data['customer_name'] = $_REQUEST['customer_name'];
    $save_data['customer_address'] = $_REQUEST['customer_address'];
    $save_data['mobile'] = $_REQUEST['mobile'];
    $save_data['email'] = $_REQUEST['email'];
    $save_data['bill_send_sms'] = $bill_send_sms;
    $save_data['bill_send_email'] = $bill_send_email;
    $save_data['delivery_charges'] = $_REQUEST['delivery_charges'];
    $save_data['paperwise'] = $_REQUEST['paperwise'];
    $save_data['opening_bal'] = $_REQUEST['opening_bal'];
    $save_data['advance'] = $_REQUEST['advance'];
    $save_data['customer_addedby'] = $_REQUEST['user_id'];

    $news_json_decode = json_decode($_REQUEST['newspaper_list'], true);
    $scheme_json_decode = json_decode($_REQUEST['scheme_list'], true);

    $check = $this->User_Model->check_dupli_num($save_data['company_id'],$mobile,'mobile','customer');
    if($check > 0){
      $response["status"] = FALSE;
      $response["msg"] = "Mobile Number Exist";
    }
    else{
      $customer_id=$this->User_Model->save_data('customer', $save_data);
      if($customer_id){
        foreach ($news_json_decode as $news) {
          $date1 = $news['s_date'];
          $date2 = $news['e_date'];
          $s_date = date("d-m-Y", strtotime($date1));
          $e_date = date("d-m-Y", strtotime($date2));

  				$news_items = array(
  					'customer_id' => $customer_id,
  					'company_id' => $save_data['company_id'],
  					'papertype_id' => $news['papertype_id'],
  					'newspaper_info_id' => $news['newspaper_info_id'],
  					'newspaper_qty' => $news['newspaper_qty'],
  					's_date' => $s_date,
  					'e_date' => $e_date,
  					'customer_addedby' => $save_data['customer_addedby'],
  				);
  				$this->User_Model->save_data('customer_pdetails', $news_items);
        }

        foreach ($scheme_json_decode as $scheme) {
          $date1 = $scheme['s_date'];
          $date2 = $scheme['e_date'];
          $s_date = date("d-m-Y", strtotime($date1));
          $e_date = date("d-m-Y", strtotime($date2));

  				$scheme_items = array(
  					'customer_id' => $customer_id,
  					'company_id' => $save_data['company_id'],
  					'scheme_info_id' => $scheme['scheme_info_id'],
  					'qty' => $scheme['qty'],
  					'sch_amount' => $scheme['sch_amount'],
  					's_date' => $s_date,
  					'e_date' => $e_date,
  					'customer_addedby' => $save_data['customer_addedby'],
  				);
  				$this->User_Model->save_data('customer_schdetails', $scheme_items);
        }

        $response["status"] = TRUE;
        $response["msg"] = "Customer Saved Successfully";
      }
      else{
        $response["status"] = FALSE;
        $response["msg"] = "Customer Not Saved";
      }
    }

    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Customer List...
  public function customer_list(){
    $company_id = $_REQUEST['company_id'];
    $customer = $this->API_Model->get_list($company_id,'customer_id','ASC','customer');
    $response["status"] = TRUE;
    $response["customer_list"] = $customer;
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Customer Details...
  public function customer_details(){
    $customer_id = $_REQUEST['customer_id'];
    $customer_details = $this->API_Model->get_info_array('customer_id', $customer_id, 'customer');
    $response["status"] = TRUE;
    $response["customer_details"] = $customer_details;
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Update Customer...
  public function update_customer(){
    $bill_send_sms = $_REQUEST['bill_send_sms'];
    $bill_send_email = $_REQUEST['bill_send_email'];
    if(!isset($bill_send_sms)){ $bill_send_sms = ''; }
    if(!isset($bill_send_email)){ $bill_send_email = ''; }

    $customer_id = $_REQUEST['customer_id'];
    $update_data['company_id'] = $_REQUEST['company_id'];
    $update_data['delivery_line_id'] = $_REQUEST['delivery_line_id'];
    $update_data['customer_name'] = $_REQUEST['customer_name'];
    $update_data['customer_address'] = $_REQUEST['customer_address'];
    $update_data['mobile'] = $_REQUEST['mobile'];
    $update_data['email'] = $_REQUEST['email'];
    $update_data['bill_send_sms'] = $bill_send_sms;
    $update_data['bill_send_email'] = $bill_send_email;
    $update_data['delivery_charges'] = $_REQUEST['delivery_charges'];
    $update_data['paperwise'] = $_REQUEST['paperwise'];
    $update_data['opening_bal'] = $_REQUEST['opening_bal'];
    $update_data['advance'] = $_REQUEST['advance'];
    $update_data['customer_addedby'] = $_REQUEST['user_id'];

    $update = $this->User_Model->update_info('customer_id', $customer_id, 'customer', $update_data);

    $news_json_decode = json_decode($_REQUEST['newspaper_list'], true);
    $scheme_json_decode = json_decode($_REQUEST['scheme_list'], true);
    foreach ($news_json_decode as $news) {
      $date1 = $news['s_date'];
      $date2 = $news['e_date'];
      $s_date = date("d-m-Y", strtotime($date1));
      $e_date = date("d-m-Y", strtotime($date2));
      if(isset($news['customer_pdetails_id'])){
        $customer_pdetails_id = $news['customer_pdetails_id'];
        if(!isset($news['papertype_id'])){
          $this->User_Model->delete_info('customer_pdetails_id', $customer_pdetails_id, 'customer_pdetails');
        }else{
          $news_items_up = array(
            'papertype_id' => $news['papertype_id'],
            'newspaper_info_id' => $news['newspaper_info_id'],
            'newspaper_qty' => $news['newspaper_qty'],
            's_date' => $s_date,
            'e_date' => $e_date,
            'customer_addedby' => $update_data['customer_addedby'],
          );
            $this->User_Model->update_info('customer_pdetails_id', $customer_pdetails_id, 'customer_pdetails', $news_items_up);
        }
      } else{
        $news_items = array(
          'customer_id' => $customer_id,
          'company_id' => $update_data['company_id'],
          'papertype_id' => $news['papertype_id'],
          'newspaper_info_id' => $news['newspaper_info_id'],
          'newspaper_qty' => $news['newspaper_qty'],
          's_date' => $s_date,
          'e_date' => $e_date,
          'customer_addedby' => $update_data['customer_addedby'],
        );
        $this->User_Model->save_data('customer_pdetails', $news_items);
      }
    }

    foreach ($scheme_json_decode as $scheme) {
      $date1 = $scheme['s_date'];
      $date2 = $scheme['e_date'];
      $s_date = date("d-m-Y", strtotime($date1));
      $e_date = date("d-m-Y", strtotime($date2));
      if(isset($scheme['customer_schdetails_id'])){
        $customer_schdetails_id = $scheme['customer_schdetails_id'];
        if(!isset($scheme['scheme_info_id'])){
          $this->User_Model->delete_info('customer_schdetails_id', $customer_schdetails_id, 'customer_schdetails');
        }else{
          $scheme_items_up = array(
            'scheme_info_id' => $scheme['scheme_info_id'],
            'qty' => $scheme['qty'],
            'sch_amount' => $scheme['sch_amount'],
            's_date' => $s_date,
            'e_date' => $e_date,
            'customer_addedby' => $update_data['customer_addedby'],
          );
          $this->User_Model->update_info('customer_schdetails_id', $customer_schdetails_id, 'customer_schdetails', $scheme_items_up);
        }
      } else{
        $scheme_items = array(
          'customer_id' => $customer_id,
          'company_id' => $update_data['company_id'],
          'scheme_info_id' => $scheme['scheme_info_id'],
          'qty' => $scheme['qty'],
          'sch_amount' => $scheme['sch_amount'],
          's_date' => $s_date,
          'e_date' => $e_date,
          'customer_addedby' => $update_data['customer_addedby'],
        );
        $this->User_Model->save_data('customer_schdetails', $scheme_items);
      }
    }

    $response["status"] = TRUE;
    $response["msg"] = "Customer Updated Successfully";
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Delete Customer...
  public function delete_customer(){
    $customer_id = $_REQUEST['customer_id'];
    $this->User_Model->delete_info('customer_id', $customer_id, 'customer_pdetails');
    $this->User_Model->delete_info('customer_id', $customer_id, 'customer_schdetails');
    $this->User_Model->delete_info('customer_id', $customer_id, 'customer');
    $response["status"] = TRUE;
    $response["msg"] = "Customer Deleted Successfully";
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }

/**************************** Bill Information *********************/
  public function paper_list_by_billid(){
    $bill_id = $_REQUEST['bill_id'];
    $bill_paper_list = $this->Transaction_Model->bill_paper_list($bill_id);
    $response["status"] = TRUE;
    $response["paper_list_by_billid"] = $bill_paper_list;
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }

  public function scheme_list_by_billid(){
    $bill_id = $_REQUEST['bill_id'];
    $bill_scheme_list = $this->Transaction_Model->bill_scheme_list($bill_id);
    $response["status"] = TRUE;
    $response["scheme_list_by_billid"] = $bill_scheme_list;
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }

  public function customer_by_delivery_line(){
    $delivery_line_id = $_REQUEST['delivery_line_id'];
    $customer = $this->Transaction_Model->get_customer_by_delivery_line($delivery_line_id);
    $response["status"] = TRUE;
    $response["customer_by_delivery_line"] = $customer;
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }

  // Save Bill...
  public function save_bill(){
    $save_data['company_id'] = $_REQUEST['company_id'];
    $save_data['bill_no'] = $this->Transaction_Model->get_count_no($save_data['company_id'], 'bill_no', 'bill');
    $save_data['bill_date'] = $_REQUEST['bill_date'];
    $save_data['bill_cycle_id'] = $_REQUEST['bill_cycle_id'];
    $save_data['delivery_line_id'] = $_REQUEST['delivery_line_id'];
    $save_data['customer_id'] = $_REQUEST['customer_id'];
    $save_data['del_charges'] = $_REQUEST['del_charges'];
    $save_data['paper_wise'] = 0;
    $save_data['tot_gros_amt'] = $_REQUEST['tot_gros_amt'];
    $save_data['tot_del_charges'] = $_REQUEST['tot_del_charges'];
    $save_data['tot_less_amt'] = $_REQUEST['tot_less_amt'];
    $save_data['tot_add_amt'] = $_REQUEST['tot_add_amt'];
    $save_data['tot_net_amt'] = $_REQUEST['tot_net_amt'];
    $save_data['bill_addedby'] = $_REQUEST['user_id'];

    $bill_id = $this->User_Model->save_data('bill', $save_data);
    $news_json_decode = json_decode($_REQUEST['newspaper_list'], true);
    $scheme_json_decode = json_decode($_REQUEST['scheme_list'], true);
    if($bill_id){
      foreach ($news_json_decode as $news) {
        $news_items = array(
          'bill_id' => $bill_id,
          'newspaper_info_id' => $news['newspaper_info_id'],
          'newspaper_qty' => $news['newspaper_qty'],
          'amount' => $news['amount'],
        );
        $this->User_Model->save_data('bill_paper', $news_items);
      }
      foreach ($scheme_json_decode as $scheme) {
        $scheme_items = array(
          'bill_id' => $bill_id,
          'scheme_info_id' => $scheme['scheme_info_id'],
          'qty' => $scheme['qty'],
          'amount' => $scheme['amount'],
        );
        $this->User_Model->save_data('bill_scheme', $scheme_items);
      }
      $response["status"] = TRUE;
      $response["msg"] = "Bill Saved Successfully";
    }
    else{
      $response["status"] = FALSE;
      $response["msg"] = "Bill Not Saved";
    }



    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Bill List...
  public function bill_list(){
    $company_id = $_REQUEST['company_id'];
    $bill = $this->API_Model->get_list($company_id,'bill_id','ASC','bill');
    $response["status"] = TRUE;
    $response["bill_list"] = $bill;
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Bill Details...
  public function bill_details(){
    $bill_id = $_REQUEST['bill_id'];
    $bill_details = $this->API_Model->get_info_array('bill_id', $bill_id, 'bill');
    $response["status"] = TRUE;
    $response["bill_details"] = $bill_details;
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Update Bill...
  public function update_bill(){
    $bill_id = $_REQUEST['bill_id'];
    $update_data['bill_date'] = $_REQUEST['bill_date'];
    $update_data['bill_cycle_id'] = $_REQUEST['bill_cycle_id'];
    $update_data['delivery_line_id'] = $_REQUEST['delivery_line_id'];
    $update_data['customer_id'] = $_REQUEST['customer_id'];
    $update_data['del_charges'] = $_REQUEST['del_charges'];
    $update_data['tot_gros_amt'] = $_REQUEST['tot_gros_amt'];
    $update_data['tot_del_charges'] = $_REQUEST['tot_del_charges'];
    $update_data['tot_less_amt'] = $_REQUEST['tot_less_amt'];
    $update_data['tot_add_amt'] = $_REQUEST['tot_add_amt'];
    $update_data['tot_net_amt'] = $_REQUEST['tot_net_amt'];
    $update_data['bill_addedby'] = $_REQUEST['user_id'];
    $update = $this->User_Model->update_info('bill_id', $bill_id, 'bill', $update_data);

    $news_json_decode = json_decode($_REQUEST['newspaper_list'], true);
    $scheme_json_decode = json_decode($_REQUEST['scheme_list'], true);

    $this->User_Model->delete_info('bill_id', $bill_id, 'bill_paper');
    $this->User_Model->delete_info('bill_id', $bill_id, 'bill_scheme');

    foreach ($news_json_decode as $news) {
      $news_items = array(
        'bill_id' => $bill_id,
        'newspaper_info_id' => $news['newspaper_info_id'],
        'newspaper_qty' => $news['newspaper_qty'],
        'amount' => $news['amount'],
      );
      $this->User_Model->save_data('bill_paper', $news_items);
    }
    foreach ($scheme_json_decode as $scheme) {
      $scheme_items = array(
        'bill_id' => $bill_id,
        'scheme_info_id' => $scheme['scheme_info_id'],
        'qty' => $scheme['qty'],
        'amount' => $scheme['amount'],
      );
      $this->User_Model->save_data('bill_scheme', $scheme_items);
    }

    $response["status"] = TRUE;
    $response["msg"] = "Bill Updated Successfully";
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
  // Delete Bill...
  public function delete_bill(){
    $bill_id = $_REQUEST['bill_id'];
    $this->User_Model->delete_info('bill_id', $bill_id, 'bill_paper');
    $this->User_Model->delete_info('bill_id', $bill_id, 'bill_scheme');
    $this->User_Model->delete_info('bill_id', $bill_id, 'bill');
    $response["status"] = TRUE;
    $response["msg"] = "Bill Deleted Successfully";
    $json_response = json_encode($response,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo str_replace('\\/','/',$json_response);
  }
}


?>
