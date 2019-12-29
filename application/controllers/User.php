<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('User_Model');
  }

  public function index(){
    $this->form_validation->set_rules('mobile', 'Mobile No.', 'trim|required');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    if ($this->form_validation->run() == FALSE) {
    	$this->load->view('User/login');
    }
    else{
      $mobile = $this->input->post('mobile');
      $password = $this->input->post('password');

      $login = $this->User_Model->check_login($mobile, $password);
      if($login == null){
        $this->session->set_flashdata('msg','login_error');
        header('location:'.base_url().'User');
      }
      else{
        foreach ($login as $login){
          $this->session->set_userdata('user_id', $login['user_id']);
          $this->session->set_userdata('company_id', $login['company_id']);
          $this->session->set_userdata('roll_id', $login['roll_id']);
        }
        header('location:'.base_url().'User/dashboard');
      }
    }
  }

  public function logout(){
    $this->session->sess_destroy();
    header('location:'.base_url().'User');
  }

  public function dashboard(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
      $data['del_line_cnt'] = $this->User_Model->get_dash_cnt($company_id,'delivery_line_id','delivery_line');
      $data['del_lineboy_cnt'] = $this->User_Model->get_dash_cnt($company_id,'lineboy_id','lineboy');
      $data['npaper_cnt'] = $this->User_Model->get_dash_cnt($company_id,'newspaper_info_id','newspaper_info');
      $data['scheme_cnt'] = $this->User_Model->get_dash_cnt($company_id,'scheme_info_id','scheme_info');
      $data['cust_cnt'] = $this->User_Model->get_dash_cnt($company_id,'customer_id','customer');
      $data['supplier_cnt'] = $this->User_Model->get_dash_cnt($company_id,'supplier_id','supplier');
      $data['exp_cnt'] = $this->User_Model->get_dash_cnt($company_id,'expense_id','expense');
      $data['purchase_cnt'] = $this->User_Model->get_dash_cnt($company_id,'purchase_id','purchase');
      $data['bill_cnt'] = $this->User_Model->get_dash_cnt($company_id,'bill_id','bill');
      $data['receipt_cnt'] = $this->User_Model->get_dash_cnt($company_id,'receipt_id','receipt');
      $this->load->view('Include/head',$data);
      $this->load->view('Include/navbar',$data);
      $this->load->view('User/dashboard',$data);
      $this->load->view('Include/footer',$data);
  }

  /***************************** Company Information ************************/
  // Company list...
  public function company_information_list(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $data['company_list'] = $this->User_Model->get_list($company_id,'company_id','ASC','company');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/company_information_list',$data);
    $this->load->view('Include/footer',$data);
  }
  // Edit Company...
  public function edit_company($company_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
      $company_info = $this->User_Model->get_info('company_id', $company_id, 'company');
      if($company_info){
        foreach($company_info as $info){
          $data['update'] = 'update';
          $data['company_id'] = $info->company_id;
          $data['c_name'] = $info->c_name;
          $data['company_imei'] = $info->company_imei;
          $data['company_name'] = $info->company_name;
          $data['company_address'] = $info->company_address;
          $data['company_city'] = $info->company_city;
          $data['company_state'] = $info->company_state;
          $data['company_district'] = $info->company_district;
          $data['company_statecode'] = $info->company_statecode;
          $data['company_mob1'] = $info->company_mob1;
          $data['company_mob2'] = $info->company_mob2;
          $data['company_email'] = $info->company_email;
          $data['company_gpay_no'] = $info->company_gpay_no;
          $data['company_website'] = $info->company_website;
          $data['company_pan_no'] = $info->company_pan_no;
          $data['company_gst_no'] = $info->company_gst_no;
          $data['company_lic1'] = $info->company_lic1;
          $data['company_lic2'] = $info->company_lic2;
          $data['company_start_date'] = $info->company_start_date;
          $data['company_end_date'] = $info->company_end_date;
        }
        $this->load->view('Include/head',$data);
        $this->load->view('Include/navbar',$data);
        $this->load->view('User/company_information',$data);
        $this->load->view('Include/footer',$data);
      }
    }

  // Update Company...
  public function update_company(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }

      $company_id = $this->input->post('company_id');
      $data = array(
        'c_name' => $this->input->post('c_name'),
        'company_imei' => $this->input->post('company_imei'),
        'company_name' => $this->input->post('company_name'),
        'company_address' => $this->input->post('company_address'),
        'company_city' => $this->input->post('company_city'),
        'company_state' => $this->input->post('company_state'),
        'company_district' => $this->input->post('company_district'),
        'company_statecode' => $this->input->post('company_statecode'),
        'company_mob1' => $this->input->post('company_mob1'),
        'company_mob2' => $this->input->post('company_mob2'),
        'company_email' => $this->input->post('company_email'),
        'company_gpay_no' => $this->input->post('company_gpay_no'),
        'company_website' => $this->input->post('company_website'),
        'company_pan_no' => $this->input->post('company_pan_no'),
        'company_gst_no' => $this->input->post('company_gst_no'),
        'company_lic1' => $this->input->post('company_lic1'),
        'company_lic2' => $this->input->post('company_lic2'),
        'company_start_date' => $this->input->post('company_start_date'),
        'company_end_date' => $this->input->post('company_end_date'),
      );
      $this->User_Model->update_info('company_id', $company_id, 'company', $data);
      header('location:'.base_url().'User/company_information_list');

  }




 public function line_boy(){
   $user_id = $this->session->userdata('user_id');
   $company_id = $this->session->userdata('company_id');
   $roll_id = $this->session->userdata('roll_id');
   if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
   $this->load->view('Include/head');
   $this->load->view('Include/navbar');
  $this->load->view('User/lineboy_information');
   $this->load->view('Include/footer');
 }
 public function line_boy_list(){
   $user_id = $this->session->userdata('user_id');
   $company_id = $this->session->userdata('company_id');
   $roll_id = $this->session->userdata('roll_id');
   if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
   $data['line_boy_list'] = $this->User_Model->get_list($company_id,'company_id','ASC','lineboy');
   $this->load->view('Include/head',$data);
   $this->load->view('Include/navbar',$data);
  $this->load->view('User/list_line_boy',$data);
   $this->load->view('Include/footer',$data);

 }

 // Save lineboy...
  public function save_lineboy(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }

      $lineboy_name = $this->input->post('lineboy_name');
      $is_lineboy = $this->input->post('is_lineboy');
      $is_collectionboy = $this->input->post('is_collectionboy');
      if(!isset($is_lineboy)){ $is_lineboy='';}
      if(!isset($is_collectionboy)){ $is_collectionboy='';}

      $data = array(
        'company_id' => $company_id,
        'lineboy_name' => $this->input->post('lineboy_name'),
        'lineboy_name' => $this->input->post('lineboy_name'),
        'lineboy_address' => $this->input->post('lineboy_address'),
        'mobile1' => $this->input->post('mobile1'),
        'mobile2' => $this->input->post('mobile2'),
        'password' => $this->input->post('password'),
        'salary' => $this->input->post('salary'),
        'l_imei' => $this->input->post('l_imei'),
        'is_lineboy' =>$is_lineboy,
        'is_collectionboy' => $is_collectionboy,
      );
      $check = $this->User_Model->check_duplication($company_id,$lineboy_name,'lineboy_name','lineboy');
      if($check){
        header('location:'.base_url().'User/line_boy');
      }
      else{
        $this->User_Model->save_data('lineboy', $data);
        header('location:'.base_url().'User/line_boy_list');
      }
    }

    //edit lineboy ...
  public function edit_lineboy($id){
    $user_id = $this->session->userdata('lineboy_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
      $lineboy_info = $this->User_Model->get_info('lineboy_id', $id, 'lineboy');

      if($lineboy_info){
        foreach($lineboy_info as $info){
          $data['update'] = 'update';
          $data['lineboy_id'] = $info->lineboy_id;
          $data['lineboy_name'] = $info->lineboy_name;
          $data['lineboy_address'] = $info->lineboy_address;
          $data['mobile1'] = $info->mobile1;
          $data['mobile2'] = $info->mobile2;
          $data['password'] = $info->password;
          $data['salary'] = $info->salary;
          $data['l_imei'] = $info->l_imei;
          $data['is_lineboy'] = $info->is_lineboy;
          $data['is_collectionboy'] = $info->is_collectionboy;
          $data['lineboy_status'] = $info->lineboy_status;
        }
        $this->load->view('Include/head',$data);
        $this->load->view('Include/navbar',$data);
        $this->load->view('User/lineboy_information',$data);
        $this->load->view('Include/footer',$data);
      }

}

  // Update Item Group ... DB...
public function update_lineboy(){
  $user_id = $this->session->userdata('lineboy_id');
  $company_id = $this->session->userdata('company_id');
  $roll_id = $this->session->userdata('roll_id');
  if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
  $is_lineboy = $this->input->post('is_lineboy');
  $is_collectionboy = $this->input->post('is_collectionboy');
  if(!isset($is_lineboy)){ $is_lineboy='';}
  if(!isset($is_collectionboy)){ $is_collectionboy='';}
    $lineboy_id = $this->input->post('lineboy_id');
    $data = array(
      'lineboy_name' => $this->input->post('lineboy_name'),
      'lineboy_address' => $this->input->post('lineboy_address'),
      'mobile1' => $this->input->post('mobile1'),
      'mobile2' => $this->input->post('mobile2'),
      'password' => $this->input->post('password'),
      'salary' => $this->input->post('salary'),
      'l_imei' => $this->input->post('l_imei'),
      'is_lineboy' =>$is_lineboy,
      'is_collectionboy' => $is_collectionboy,
    );
    $this->User_Model->update_info('lineboy_id', $lineboy_id, 'lineboy', $data);
    header('location:'.base_url().'User/line_boy_list');

}
// Delete Item Group
public function delete_lineboy($id){
  $user_id = $this->session->userdata('lineboy_id');
  $company_id = $this->session->userdata('company_id');
  $roll_id = $this->session->userdata('roll_id');
  if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->User_Model->delete_info('lineboy_id', $id, 'lineboy');
    header('location:'.base_url().'User/line_boy_list');
  }
// ***********************************************Delivery Line Information************************

  public function delivery_line(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $data['lineboy_list'] = $this->User_Model->get_list($company_id,'lineboy_id','ASC','lineboy');

    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/add_delivery_line',$data);
    $this->load->view('Include/footer',$data);

  }


  public function delivery_line_list(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $data['dline_list'] = $this->User_Model->get_delivery_list($company_id);
    // $data['dline_list'] = $this->User_Model->get_list($company_id,'company_id','ASC','delivery_line');
    // $data['lineboy_list'] = $this->User_Model->get_list($company_id,'lineboy_id','ASC','lineboy');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
   $this->load->view('User/list_delivery_line',$data);
    $this->load->view('Include/footer',$data);
  }

  public function save_delivery_line(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
      $delivery_line_name = $this->input->post('delivery_line_name');
      $data = array(
        'company_id' => $company_id,
        'delivery_line_name' => $this->input->post('delivery_line_name'),
        'liboy_id' => $this->input->post('lineboy_id'),
        'collboy_id' => $this->input->post('collboy_id'),
      );
      $check = $this->User_Model->check_duplication($company_id,$delivery_line_name,'delivery_line_name','delivery_line');
      if($check){
        header('location:'.base_url().'User/delivery_line');
      }
      else{
        $this->User_Model->save_data('delivery_line', $data);
        header('location:'.base_url().'User/delivery_line_list');
      }
    }

    //edit lineboy ...
  public function edit_delivery_line($id){
    $user_id = $this->session->userdata('lineboy_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
      $dline_details= $this->User_Model->get_delivery_details($company_id,$id);
      $data['lineboy_list'] = $this->User_Model->get_list($company_id,'lineboy_id','ASC','lineboy');
      if($dline_details){
        foreach($dline_details as $info){
          $data['update'] = 'update';
          $data['delivery_line_name'] = $info->delivery_line_name;
          $data['delivery_line_id'] = $info->delivery_line_id;
          $data['liboy_id'] = $info->liboy_id;
          $data['collboy_id'] = $info->collboy_id;
          $data['liboyname'] = $info->liboyname;
          $data['colboyname'] = $info->colboyname;
        }
        $this->load->view('Include/head',$data);
        $this->load->view('Include/navbar',$data);
        $this->load->view('User/add_delivery_line',$data);
        $this->load->view('Include/footer',$data);
      }

  }

  // Update Item Group ... DB...
  public function update_delivery_line(){
  $user_id = $this->session->userdata('lineboy_id');
  $company_id = $this->session->userdata('company_id');
  $roll_id = $this->session->userdata('roll_id');
  if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
  $is_lineboy = $this->input->post('is_lineboy');
  $is_collectionboy = $this->input->post('is_collectionboy');
  if(!isset($is_lineboy)){ $is_lineboy='';}
  if(!isset($is_collectionboy)){ $is_collectionboy='';}
    $delivery_line_id = $this->input->post('delivery_line_id');
    $data = array(
      'delivery_line_name' => $this->input->post('delivery_line_name'),
      'liboy_id' => $this->input->post('lineboy_id'),
      'collboy_id' => $this->input->post('collboy_id'),
    );
    $this->User_Model->update_info('delivery_line_id', $delivery_line_id, 'delivery_line', $data);
    header('location:'.base_url().'User/delivery_line_list');

  }
//  Delete Item Group
  public function delete_delivery_line($id){
  $user_id = $this->session->userdata('lineboy_id');
  $company_id = $this->session->userdata('company_id');
  $roll_id = $this->session->userdata('roll_id');
  if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->User_Model->delete_info('delivery_line_id', $id, 'delivery_line');
    header('location:'.base_url().'User/delivery_line_list');
  }


  // ***********************************************Newspaper Information************************

    public function add_newspaper(){
      $user_id = $this->session->userdata('user_id');
      $company_id = $this->session->userdata('company_id');
      $roll_id = $this->session->userdata('roll_id');
      if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
      $data['papertype_list'] = $this->User_Model->get_list1('papertype_id','ASC','papertype');
      $data['language_list'] = $this->User_Model->get_list1('language_id','ASC','language');
      $this->load->view('Include/head',$data);
      $this->load->view('Include/navbar',$data);
      $this->load->view('User/add_news_paper',$data);
      $this->load->view('Include/footer',$data);

    }


    public function newspaper_list(){
      $user_id = $this->session->userdata('user_id');
      $company_id = $this->session->userdata('company_id');
      $roll_id = $this->session->userdata('roll_id');
      if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
      $data['news_list'] = $this->User_Model->get_newspaper_list($company_id);
      $this->load->view('Include/head',$data);
      $this->load->view('Include/navbar',$data);
     $this->load->view('User/list_newspaper',$data);
      $this->load->view('Include/footer',$data);
    }

    public function save_newspaper(){
      $user_id = $this->session->userdata('user_id');
      $company_id = $this->session->userdata('company_id');
      $roll_id = $this->session->userdata('roll_id');
      if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
        $newspaper_info_name = $this->input->post('newspaper_info_name');
        $data = array(
          'company_id' => $company_id,
          'newspaper_info_name' => $this->input->post('newspaper_info_name'),
          'papertype_id' => $this->input->post('papertype_id'),
          'language_id' => $this->input->post('language_id'),
          'rate' => $this->input->post('rate'),
        );
        $check = $this->User_Model->check_duplication($company_id,$newspaper_info_name,'newspaper_info_name','newspaper_info');
        if($check){
          header('location:'.base_url().'User/delivery_line');
        }
        else{
          $this->User_Model->save_data('newspaper_info', $data);
          header('location:'.base_url().'User/newspaper_list');
        }
      }

      //edit lineboy ...
    public function edit_newspaper($id){
      $user_id = $this->session->userdata('lineboy_id');
      $company_id = $this->session->userdata('company_id');
      $roll_id = $this->session->userdata('roll_id');
      if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
        $dnewsp_details= $this->User_Model->get_newspaper_details($company_id,$id);
          $data['news_list'] = $this->User_Model->get_newspaper_list($company_id);
          $data['papertype_list'] = $this->User_Model->get_list1('papertype_id','ASC','papertype');
          $data['language_list'] = $this->User_Model->get_list1('language_id','ASC','language');
        if($dnewsp_details){
          foreach($dnewsp_details as $info){
            $data['update'] = 'update';
            $data['newspaper_info_name'] = $info->newspaper_info_name;
            $data['newspaper_info_id'] = $info->newspaper_info_id;
            $data['papertype_name'] = $info->papertype_name;
            $data['rate'] = $info->rate;
            $data['papertype_id'] = $info->papertype_id;
            $data['papertype_name'] = $info->papertype_name;
            $data['language_id'] = $info->language_id;
            $data['language_name'] = $info->language_name;
            // $data['colboyname'] = $info->colboyname;
          }
          $this->load->view('Include/head',$data);
          $this->load->view('Include/navbar',$data);
          $this->load->view('User/add_news_paper',$data);
          $this->load->view('Include/footer',$data);
        }

    }

    // Update Item Group ... DB...
    public function update_newspaper(){
    $user_id = $this->session->userdata('lineboy_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
      $newspaper_info_id = $this->input->post('newspaper_info_id');
      $data = array(
        'newspaper_info_name' => $this->input->post('newspaper_info_name'),
        'papertype_id' => $this->input->post('papertype_id'),
        'language_id' => $this->input->post('language_id'),
        'rate' => $this->input->post('rate'),
      );
      $this->User_Model->update_info('newspaper_info_id', $newspaper_info_id, 'newspaper_info', $data);
      header('location:'.base_url().'User/newspaper_list');

    }
  //  Delete Item Group
    public function delete_newspaper($id){
    $user_id = $this->session->userdata('lineboy_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
      $this->User_Model->delete_info('newspaper_info_id', $id, 'newspaper_info');
      header('location:'.base_url().'User/newspaper_list');
    }


    public function add_scheme(){
      $user_id = $this->session->userdata('user_id');
      $company_id = $this->session->userdata('company_id');
      $roll_id = $this->session->userdata('roll_id');
      if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
      $data['newspaper_list'] = $this->User_Model->get_list1('newspaper_info_id','ASC','newspaper_info');
      $data['scheme_list'] = $this->User_Model->get_list1('scheme_type_id','ASC','scheme_type');
      $this->load->view('Include/head',$data);
      $this->load->view('Include/navbar',$data);
     $this->load->view('User/add_scheme',$data);
      $this->load->view('Include/footer',$data);
    }

    public function scheme_list(){
      $user_id = $this->session->userdata('user_id');
      $company_id = $this->session->userdata('company_id');
      $roll_id = $this->session->userdata('roll_id');
      if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
      $data['scheme_list'] = $this->User_Model->get_scheme_list($company_id);
      $this->load->view('Include/head',$data);
      $this->load->view('Include/navbar',$data);
      $this->load->view('User/list_scheme',$data);
      $this->load->view('Include/footer',$data);

    }

    public function save_scheme(){
      $user_id = $this->session->userdata('user_id');
      $company_id = $this->session->userdata('company_id');
      $roll_id = $this->session->userdata('roll_id');
      if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
        $scheme_info_name = $this->input->post('scheme_info_name');
        $scheme_info_status = $this->input->post('scheme_info_status');
        if(!isset($scheme_info_status)){ $scheme_info_status='active';}
        $data = array(
          'company_id' => $company_id,
          'scheme_info_name' => $this->input->post('scheme_name'),
          'scheme_type_id' => $this->input->post('scheme_type_id'),
          'newspaper_info_id' => $this->input->post('newspaper_id'),
          'month_count' => $this->input->post('month_count'),
          'booking_fee' => $this->input->post('booking_fee'),
          'scheme_fee' => $this->input->post('scheme_fee'),
          'gift_count' => $this->input->post('gift_count'),
          'is_monthly_bill' => $this->input->post('is_monthly_bill'),
          'scheme_info_status' => $scheme_info_status,
        );
        $check = $this->User_Model->check_duplication($company_id,$scheme_info_name,'scheme_info_name','scheme_info');
        if($check){
          header('location:'.base_url().'User/delivery_line');
        }
        else{
          $this->User_Model->save_data('scheme_info', $data);
          header('location:'.base_url().'User/scheme_list');
        }
      }


      public function edit_scheme($id){
        $user_id = $this->session->userdata('lineboy_id');
        $company_id = $this->session->userdata('company_id');
        $roll_id = $this->session->userdata('roll_id');
        if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
          $dscheme_details= $this->User_Model->get_scheme_details($company_id,$id);
            // $data['scheme_list'] = $this->User_Model->get_scheme_list($company_id);
            $data['newspaper_list'] = $this->User_Model->get_list1('newspaper_info_id','ASC','newspaper_info');
            $data['scheme_list'] = $this->User_Model->get_list1('scheme_type_id','ASC','scheme_type');
          if($dscheme_details){
            foreach($dscheme_details as $info){
              $data['update'] = 'update';
              $data['scheme_info_id'] = $info->scheme_info_id;
              $data['scheme_info_name'] = $info->scheme_info_name;
              $data['scheme_type_id'] = $info->scheme_type_id;
              $data['scheme_type_name'] = $info->scheme_type_name;
              $data['newspaper_info_name'] = $info->newspaper_info_name;
              $data['newspaper_info_id'] = $info->newspaper_info_id;
              $data['month_count'] = $info->month_count;
              $data['booking_fee'] = $info->booking_fee;
              $data['scheme_fee'] = $info->scheme_fee;
              $data['gift_count'] = $info->gift_count;
              $data['is_monthly_bill'] = $info->is_monthly_bill;

              // $data['colboyname'] = $info->colboyname;
            }

            $this->load->view('Include/head',$data);
            $this->load->view('Include/navbar',$data);
            $this->load->view('User/add_scheme',$data);
            $this->load->view('Include/footer',$data);
          }

      }

      public function update_scheme(){
      $user_id = $this->session->userdata('lineboy_id');
      $company_id = $this->session->userdata('company_id');
      $roll_id = $this->session->userdata('roll_id');
      if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
        $scheme_info_id = $this->input->post('scheme_info_id');
        $data = array(
          'scheme_info_name' => $this->input->post('scheme_name'),
          'scheme_type_id' => $this->input->post('scheme_type_id'),
          'newspaper_info_id' => $this->input->post('newspaper_id'),
          'month_count' => $this->input->post('month_count'),
          'booking_fee' => $this->input->post('booking_fee'),
          'scheme_fee' => $this->input->post('scheme_fee'),
          'gift_count' => $this->input->post('gift_count'),
          'is_monthly_bill' => $this->input->post('is_monthly_bill'),
          'scheme_info_status' => $scheme_info_status,
        );
        $this->User_Model->update_info('scheme_info_id', $scheme_info_id, 'scheme_info', $data);
        header('location:'.base_url().'User/scheme_list');

      }
    //  Delete Item Group
      public function delete_scheme($id){
      $user_id = $this->session->userdata('lineboy_id');
      $company_id = $this->session->userdata('company_id');
      $roll_id = $this->session->userdata('roll_id');
      if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
        $this->User_Model->delete_info('scheme_info_id', $id, 'scheme_info');
        header('location:'.base_url().'User/scheme_list');
      }



      public function add_customer(){
        $user_id = $this->session->userdata('user_id');
        $company_id = $this->session->userdata('company_id');
        $roll_id = $this->session->userdata('roll_id');
        if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
        $data['delivery_line_list'] = $this->User_Model->get_list($company_id,'delivery_line_id','ASC','delivery_line');
        $data['ptype_list'] = $this->User_Model->get_list1('papertype_id','ASC','papertype');
        $data['newspaper_list'] = $this->User_Model->get_list($company_id,'newspaper_info_id','ASC','newspaper_info');
        $data['scheme_list'] = $this->User_Model->get_list($company_id,'scheme_info_id','ASC','scheme_info');

        // $data['customer_list'] = $this->User_Model->get_list1('customer_type_id','ASC','customer_type');
        $this->load->view('Include/head',$data);
        $this->load->view('Include/navbar',$data);
       $this->load->view('User/customer_info',$data);
        $this->load->view('Include/footer',$data);
      }
      public function customer_information_list(){
        $user_id = $this->session->userdata('user_id');
        $company_id = $this->session->userdata('company_id');
        $roll_id = $this->session->userdata('roll_id');
        if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
        $data['customer_list'] = $this->User_Model->get_list($company_id,'customer_id','ASC','customer');
        $this->load->view('Include/head',$data);
        $this->load->view('Include/navbar',$data);
        $this->load->view('User/customer_info_list',$data);
        $this->load->view('Include/footer',$data);

      }

      public function save_customer(){
        $user_id = $this->session->userdata('user_id');
        $company_id = $this->session->userdata('company_id');
        $roll_id = $this->session->userdata('roll_id');
        if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
          $mobile = $this->input->post('mobile');
          $bill_send_sms = $this->input->post('bill_send_sms');
          $bill_send_email = $this->input->post('bill_send_email');
          if(!isset($bill_send_sms)){ $bill_send_sms = ''; }
          if(!isset($bill_send_email)){ $bill_send_email = ''; }
          $data = array(
            'company_id' => $company_id,
            'delivery_line_id' => $this->input->post('delivery_line_id'),
            'customer_name' => $this->input->post('customer_name'),
            'customer_address' => $this->input->post('customer_address'),
            'mobile' => $this->input->post('mobile'),
            'email' => $this->input->post('email'),
            'bill_send_sms' => $bill_send_sms,
            'bill_send_email' => $bill_send_email,
            'delivery_charges' => $this->input->post('delivery_charges'),
            'paperwise' => $this->input->post('paperwise'),
            'opening_bal' => $this->input->post('opening_bal'),
            'advance' => $this->input->post('advance'),
          );
          $check = $this->User_Model->check_dupli_num($company_id,$mobile,'mobile','customer');
          if($check > 0){ header('location:'.base_url().'User/add_customer'); }
          else{
            $customer_id=$this->User_Model->save_data('customer', $data);
            foreach($_POST['input1'] as $user){
              $date1 = $user['s_date'];
              $date2 = $user['e_date'];
              $user['s_date'] = date("d-m-Y", strtotime($date1));
              $user['e_date'] = date("d-m-Y", strtotime($date2));
              $user['company_id'] = $company_id;
              $user['customer_id'] = $customer_id;
              $this->db->insert('customer_pdetails', $user);
            }
            foreach($_POST['input2'] as $user2){
              $user2['s_date'] = date("d-m-Y", strtotime($user2['s_date']));
              $user2['e_date'] = date("d-m-Y", strtotime($user2['e_date']));
              $user2['company_id'] = $company_id;
              $user2['customer_id'] = $customer_id;
              $this->db->insert('customer_schdetails', $user2);
            }
            header('location:'.base_url().'User/customer_information_list');
          }
        }

    public function edit_customer($customer_id){
      $user_id = $this->session->userdata('user_id');
      $company_id = $this->session->userdata('company_id');
      $roll_id = $this->session->userdata('roll_id');
      if($user_id == null && $company_id == null ){ header('location:'.base_url().'User'); }
      $data['delivery_line_list'] = $this->User_Model->get_list($company_id,'delivery_line_id','ASC','delivery_line');
      $data['ptype_list'] = $this->User_Model->get_list1('papertype_id','ASC','papertype');
      $data['newspaper_list'] = $this->User_Model->get_list($company_id,'newspaper_info_id','ASC','newspaper_info');
      $data['scheme_list'] = $this->User_Model->get_list($company_id,'scheme_info_id','ASC','scheme_info');

      $customer_details = $this->User_Model->get_info_array('customer_id', $customer_id, 'customer');
      if(!$customer_details){ header('location:'.base_url().'User/customer_information_list'); }
      $data['update'] = 'update';
      $data['customer_id'] = $customer_id;
      $data['delivery_line_id'] = $customer_details[0]['delivery_line_id'];
      $data['customer_name'] = $customer_details[0]['customer_name'];
      $data['customer_address'] = $customer_details[0]['customer_address'];
      $data['mobile'] = $customer_details[0]['mobile'];
      $data['email'] = $customer_details[0]['email'];
      $data['bill_send_sms'] = $customer_details[0]['bill_send_sms'];
      $data['bill_send_email'] = $customer_details[0]['bill_send_email'];
      $data['delivery_charges'] = $customer_details[0]['delivery_charges'];
      $data['paperwise'] = $customer_details[0]['paperwise'];
      $data['opening_bal'] = $customer_details[0]['opening_bal'];
      $data['advance'] = $customer_details[0]['advance'];
      $data['customer_status'] = $customer_details[0]['customer_status'];

      $data['pdetails'] = $this->User_Model->get_child_list('customer_id',$customer_id,'customer_pdetails');
      $data['schdetails'] = $this->User_Model->get_child_list('customer_id',$customer_id,'customer_schdetails');

      $this->load->view('Include/head',$data);
      $this->load->view('Include/navbar',$data);
      $this->load->view('User/customer_info',$data);
      $this->load->view('Include/footer',$data);

    }

    public function update_customer(){
      $user_id = $this->session->userdata('user_id');
      $company_id = $this->session->userdata('company_id');
      $roll_id = $this->session->userdata('roll_id');
      if($user_id == null && $company_id == null ){ header('location:'.base_url().'User'); }
      $customer_id = $this->input->post('customer_id');
      $mobile = $this->input->post('mobile');
      $bill_send_sms = $this->input->post('bill_send_sms');
      $bill_send_email = $this->input->post('bill_send_email');
      $customer_status = $this->input->post('customer_status');
      if(!isset($bill_send_sms)){ $bill_send_sms = ''; }
      if(!isset($bill_send_email)){ $bill_send_email = ''; }
      if(!isset($customer_status)){ $customer_status = 'active'; }
      $update_data = array(
        'delivery_line_id' => $this->input->post('delivery_line_id'),
        'customer_name' => $this->input->post('customer_name'),
        'customer_address' => $this->input->post('customer_address'),
        'mobile' => $this->input->post('mobile'),
        'email' => $this->input->post('email'),
        'bill_send_sms' => $bill_send_sms,
        'bill_send_email' => $bill_send_email,
        'delivery_charges' => $this->input->post('delivery_charges'),
        'paperwise' => $this->input->post('paperwise'),
        'opening_bal' => $this->input->post('opening_bal'),
        'advance' => $this->input->post('advance'),
        'customer_status' => $customer_status,
      );
      $this->User_Model->update_info('customer_id', $customer_id, 'customer', $update_data);

      foreach($_POST['input1'] as $user1){
        $user1['s_date'] = date("d-m-Y", strtotime($user1['s_date']));
        $user1['e_date'] = date("d-m-Y", strtotime($user1['e_date']));
        if(isset($user1['customer_pdetails_id'])){
          $customer_pdetails_id = $user1['customer_pdetails_id'];
          if(!isset($user1['papertype_id'])){
            $this->User_Model->delete_info('customer_pdetails_id', $customer_pdetails_id, 'customer_pdetails');
          }else{
              $this->User_Model->update_info('customer_pdetails_id', $customer_pdetails_id, 'customer_pdetails', $user1);
          }
        }
        else{
          $user1['customer_id'] = $customer_id;
          $this->db->insert('customer_pdetails', $user1);
        }
      }

      foreach($_POST['input2'] as $user2){
        $user2['s_date'] = date("d-m-Y", strtotime($user2['s_date']));
        $user2['e_date'] = date("d-m-Y", strtotime($user2['e_date']));
        if(isset($user2['customer_schdetails_id'])){
          $customer_schdetails_id = $user2['customer_schdetails_id'];
          if(!isset($user2['scheme_info_id'])){
            $this->User_Model->delete_info('customer_schdetails_id', $customer_schdetails_id, 'customer_schdetails');
          }else{
              $this->User_Model->update_info('customer_schdetails_id', $customer_schdetails_id, 'customer_schdetails', $user2);
          }
        }
        else{
          $user2['customer_id'] = $customer_id;
          $this->db->insert('customer_schdetails', $user2);
        }
      }
      header('location:'.base_url().'User/customer_information_list');
    }

    public function delete_customer($customer_id){
      $user_id = $this->session->userdata('user_id');
      $company_id = $this->session->userdata('company_id');
      $roll_id = $this->session->userdata('roll_id');
      if($user_id == null && $company_id == null ){ header('location:'.base_url().'User'); }
      $this->User_Model->delete_info('customer_id', $customer_id, 'customer_schdetails');
      $this->User_Model->delete_info('customer_id', $customer_id, 'customer_pdetails');
      $this->User_Model->delete_info('customer_id', $customer_id, 'customer');
      header('location:'.base_url().'User/customer_information_list');
    }

    public function check_duplication(){
      $column_name = $this->input->post('column_name');
      $column_val = $this->input->post('column_val');
      $table_name = $this->input->post('table_name');
      $company_id = '';
      $cnt = $this->User_Model->check_dupli_num($company_id,$column_val,$column_name,$table_name);
      echo $cnt;
    }

  public function check_is_yearly_scheme(){
    $scheme_info_id = $this->input->post('scheme_info_id');
    $check_is_yearly_scheme = $this->User_Model->check_is_yearly_scheme($scheme_info_id);
    $scheme_type_id = $check_is_yearly_scheme[0]['scheme_type_id'];
    echo $scheme_type_id;
  }

  public function change_password(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('old_password','Old Password','trim|required');
    if($this->form_validation->run() != FALSE){
      $old_password = $this->input->post('old_password');
      $new_password = $this->input->post('new_password');
      $con_password = $this->input->post('con_password');
      if($new_password == $con_password){
        $check = $this->User_Model->check_password($user_id,$old_password);
        if($check){
          $up_data['user_password'] = $new_password;
          $this->User_Model->update_info('user_id', $user_id, 'user', $up_data);
          $this->session->sess_destroy();
          header('location:'.base_url().'User');
        }
        else{
          $ses_data['pas_error'] = 'Pass_Error';
          $this->session->set_flashdata($ses_data);
          header('location:'.base_url().'User/change_password');
        }
      }
      else{
        // $ses_data['old_password'] = $old_password;
        // $ses_data['new_password'] = $new_password;
        // $ses_data['con_password'] = $con_password;
        $ses_data['con_error'] = 'Confirm_Error';
        $this->session->set_flashdata($ses_data);
        header('location:'.base_url().'User/change_password');
      }
    }

    $this->load->view('Include/head');
    $this->load->view('Include/navbar');
    $this->load->view('User/change_password');
    $this->load->view('Include/footer');
  }
/************************** Expense Type **************************/
// Add Expense Type...
  public function add_expense_type(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('expense_type_name', 'Expense Type', 'trim|required');
    if($this->form_validation->run() != FALSE){
      $save_data['expense_type_name'] = $this->input->post('expense_type_name');
      $save_data['expense_type_addedby'] = $user_id;
      $save_data['company_id'] = $company_id;

      $expense_type_id = $this->User_Model->save_data('expense_type', $save_data);
      header('location:'.base_url().'User/expense_type_list');
    }
    $this->load->view('Include/head');
    $this->load->view('Include/navbar');
    $this->load->view('User/add_expense_type');
    $this->load->view('Include/footer');
  }
// Expense Type List...
  public function expense_type_list(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $data['expense_type_list'] = $this->User_Model->get_list($company_id,'expense_type_id','ASC','expense_type');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/list_expense_type',$data);
    $this->load->view('Include/footer',$data);
  }
// Edit Expense Type...
  public function edit_expense_type($expense_type_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('expense_type_name', 'Expense Type', 'trim|required');
    if($this->form_validation->run() != FALSE){
      $update_data['expense_type_name'] = $this->input->post('expense_type_name');
      $update_data['expense_type_addedby'] = $user_id;
      $this->User_Model->update_info('expense_type_id', $expense_type_id, 'expense_type', $update_data);
      header('location:'.base_url().'User/expense_type_list');
    }
    $expense_type_details = $this->User_Model->get_info_array('expense_type_id', $expense_type_id, 'expense_type');

    if($expense_type_details == ''){ header('location:'.base_url().'User/expense_type_list'); }
    $data['update'] = 'update';
    $data['expense_type_name'] = $expense_type_details[0]['expense_type_name'];
    // echo print_r($data['expense_type_name']);
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/add_expense_type',$data);
    $this->load->view('Include/footer',$data);
  }
// Delete Expense Type...
  public function delete_expense_type($expense_type_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->User_Model->delete_info('expense_type_id', $expense_type_id, 'expense_type');
    header('location:'.base_url().'User/expense_type_list');
  }
/**************************** Supplier ***********************/
// Add Supplier...
  public function add_supplier(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('supplier_name', 'Expense Type', 'trim|required');
    if($this->form_validation->run() != FALSE){
      $supplier_status = $this->input->post('supplier_status');
      if(!isset($supplier_status)){ $supplier_status = 'active'; }
      $save_data['supplier_name'] = $this->input->post('supplier_name');
      $save_data['supplier_mobile'] = $this->input->post('supplier_mobile');
      $save_data['supplier_email'] = $this->input->post('supplier_email');
      $save_data['supplier_city'] = $this->input->post('supplier_city');
      $save_data['supplier_op_bal'] = $this->input->post('supplier_op_bal');
      $save_data['supplier_status'] = $supplier_status;
      $save_data['supplier_addedby'] = $user_id;
      $save_data['company_id'] = $company_id;

      $supplier_id = $this->User_Model->save_data('supplier', $save_data);
      header('location:'.base_url().'User/supplier_list');
    }
    $this->load->view('Include/head');
    $this->load->view('Include/navbar');
    $this->load->view('User/add_supplier');
    $this->load->view('Include/footer');
  }
// Supplier List...
  public function supplier_list(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $data['supplier_list'] = $this->User_Model->get_list($company_id,'supplier_id','ASC','supplier');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/list_supplier',$data);
    $this->load->view('Include/footer',$data);
  }
// Edit Supplier...
  public function edit_supplier($supplier_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('supplier_name', 'Supplier', 'trim|required');
    if($this->form_validation->run() != FALSE){
      $supplier_status = $this->input->post('supplier_status');
      if(!isset($supplier_status)){ $supplier_status = 'active'; }
      $update_data['supplier_name'] = $this->input->post('supplier_name');
      $update_data['supplier_mobile'] = $this->input->post('supplier_mobile');
      $update_data['supplier_email'] = $this->input->post('supplier_email');
      $update_data['supplier_city'] = $this->input->post('supplier_city');
      $update_data['supplier_op_bal'] = $this->input->post('supplier_op_bal');
      $update_data['supplier_status'] = $supplier_status;
      $update_data['supplier_addedby'] = $user_id;
      $this->User_Model->update_info('supplier_id', $supplier_id, 'supplier', $update_data);
      header('location:'.base_url().'User/supplier_list');
    }
    $supplier_details = $this->User_Model->get_info_array('supplier_id', $supplier_id, 'supplier');

    if($supplier_details == ''){ header('location:'.base_url().'User/supplier_list'); }
    $data['update'] = 'update';
    $data['supplier_name'] = $supplier_details[0]['supplier_name'];
    $data['supplier_mobile'] = $supplier_details[0]['supplier_mobile'];
    $data['supplier_email'] = $supplier_details[0]['supplier_email'];
    $data['supplier_city'] = $supplier_details[0]['supplier_city'];
    $data['supplier_op_bal'] = $supplier_details[0]['supplier_op_bal'];
    $data['supplier_status'] = $supplier_details[0]['supplier_status'];

    // echo print_r($data['supplier_name']);
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/add_supplier',$data);
    $this->load->view('Include/footer',$data);
  }
// Delete Supplier...
  public function delete_supplier($supplier_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->User_Model->delete_info('supplier_id', $supplier_id, 'supplier');
    header('location:'.base_url().'User/supplier_list');
  }

}
?>
