<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('Admin_Model');
  }


  public function index(){
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    if ($this->form_validation->run() == FALSE) {
    	$this->load->view('Admin/login');
    }
    else{
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $login = $this->Admin_Model->check_login($email, $password);
      if($login == null){
        $this->session->set_flashdata('msg','login_error');
        header('location:'.base_url().'Admin');
      }
      else{
        foreach ($login as $login){
          $this->session->set_userdata('admin_id', $login['admin_id']);
        }
        header('location:'.base_url().'Admin/dashboard');
      }
    }
  }

  public function logout(){
    $this->session->sess_destroy();
    header('location:'.base_url().'Admin');
  }


  public function dashboard(){
    $admin_id = $this->session->userdata('admin_id');
    if($admin_id){
      $data['all_c_count'] = $this->Admin_Model->all_c_count();
      $data['active_c_count'] = $this->Admin_Model->active_c_count();
      $data['inactive_c_count'] = $this->Admin_Model->inactive_c_count();
      $this->load->view('Admin/dashboard',$data);
    } else{
      header('location:'.base_url().'Admin');
    }
  }

  public function company_information(){
    $admin_id = $this->session->userdata('admin_id');
    if($admin_id){
      $this->load->view('Admin/company_information');
    } else{
      header('location:'.base_url().'Admin');
    }
  }

  // Company List...
  public function company_information_list(){
    $admin_id = $this->session->userdata('admin_id');
    if($admin_id){
      $data['company_list'] = $this->Admin_Model->get_company_list();
      // echo print_r($data['company_list']);
      $this->load->view('Admin/company_information_list',$data);
    } else{
      header('location:'.base_url().'Admin');
    }
  }

  // Save company Data...
    public function save_company(){
      $admin_id = $this->session->userdata('admin_id');
      if($admin_id){
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
          'company_status' => $this->input->post('company_status'),
          'company_reg_date' => date('d-m-Y'),
          // 'admin_email' => $this->input->post('admin_email'),
          // 'admin_password' => $this->input->post('admin_password'),
        );
        // echo print_r($data);
        $company_id = $this->Admin_Model->save_data('company', $data);
        $data2 = array(
          'company_id'=>$company_id,
          'user_email'=>$this->input->post('admin_email'),
          'user_password'=>$this->input->post('admin_password'),
          'user_name'=>'Admin',
          'user_city'=>$this->input->post('company_city'),
          'user_mobile'=>$this->input->post('company_mob1'),
          'user_addedby'=>'Admin',
          'is_admin'=>1,
        );
        $this->Admin_Model->save_data('user', $data2);
        header('location:'.base_url().'Admin/company_information_list');
      } else{
        header('location:'.base_url().'Admin');
      }
    }

    public function edit_company($company_id){
      $admin_id = $this->session->userdata('admin_id');
      if($admin_id){
        $company_info = $this->Admin_Model->get_info('company_id', $company_id, 'company');
        if($company_info){
          foreach($company_info as $info){
            $data['update'] = 'update';
            $data['c_name'] = $info->c_name;
            $data['company_imei'] = $info->company_imei;
            $data['company_id'] = $info->company_id;
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
            $data['company_status'] = $info->company_status;
          }
          $this->load->view('Admin/company_information',$data);
        }
      } else{
        header('location:'.base_url().'Admin');
      }
    }

    public function update_company(){
      $admin_id = $this->session->userdata('admin_id');
      if($admin_id){
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
          'company_status' => $this->input->post('company_status'),
        );
        $this->Admin_Model->update_info('company_id', $company_id, 'company', $data);
        header('location:'.base_url().'Admin/company_information_list');
      } else{
        header('location:'.base_url().'Admin');
      }
    }

    public function delete_company($company_id){
      $admin_id = $this->session->userdata('admin_id');
      if($admin_id){
        // $company_id = $this->input->post('company_id');
        $this->Admin_Model->delete_info('company_id', $company_id, 'company');
        header('location:'.base_url().'Admin/company_information_list');
      } else{
        header('location:'.base_url().'Admin');
      }
    }

}
?>
