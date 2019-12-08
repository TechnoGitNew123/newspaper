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
      $this->load->view('Admin/dashboard');
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
          'company_name' => $this->input->post('company_name'),
          'company_address' => $this->input->post('company_address'),
          'company_city' => $this->input->post('company_city'),
          'company_state' => $this->input->post('company_state'),
          'company_district' => $this->input->post('company_district'),
          'company_statecode' => $this->input->post('company_statecode'),
          'company_mob1' => $this->input->post('company_mob1'),
          'company_mob2' => $this->input->post('company_mob2'),
          'company_email' => $this->input->post('company_email'),
          'company_website' => $this->input->post('company_website'),
          'company_pan_no' => $this->input->post('company_pan_no'),
          'company_gst_no' => $this->input->post('company_gst_no'),
          'company_lic1' => $this->input->post('company_lic1'),
          'company_lic2' => $this->input->post('company_lic2'),
          'company_start_date' => $this->input->post('company_start_date'),
          'company_end_date' => $this->input->post('company_end_date'),
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
            $data['company_website'] = $info->company_website;
            $data['company_pan_no'] = $info->company_pan_no;
            $data['company_gst_no'] = $info->company_gst_no;
            $data['company_lic1'] = $info->company_lic1;
            $data['company_lic2'] = $info->company_lic2;
            $data['company_start_date'] = $info->company_start_date;
            $data['company_end_date'] = $info->company_end_date;
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
          'company_name' => $this->input->post('company_name'),
          'company_address' => $this->input->post('company_address'),
          'company_city' => $this->input->post('company_city'),
          'company_state' => $this->input->post('company_state'),
          'company_district' => $this->input->post('company_district'),
          'company_statecode' => $this->input->post('company_statecode'),
          'company_mob1' => $this->input->post('company_mob1'),
          'company_mob2' => $this->input->post('company_mob2'),
          'company_email' => $this->input->post('company_email'),
          'company_website' => $this->input->post('company_website'),
          'company_pan_no' => $this->input->post('company_pan_no'),
          'company_gst_no' => $this->input->post('company_gst_no'),
          'company_lic1' => $this->input->post('company_lic1'),
          'company_lic2' => $this->input->post('company_lic2'),
          'company_start_date' => $this->input->post('company_start_date'),
          'company_end_date' => $this->input->post('company_end_date'),
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





   public function party_information(){
    $this->load->view('Admin/party_information');
  }


  public function party_information_list(){
   $this->load->view('Admin/party_information_list');
  }

  public function delivery_line(){
   $this->load->view('Admin/add_delivery_line');
 }
 public function delivery_line_list(){
  $this->load->view('Admin/list_delivery_line');
 }

 public function line_boy(){
  $this->load->view('Admin/lineboy_information');
}
public function line_boy_list(){
 $this->load->view('Admin/list_line_boy');
}

public function add_expenses(){
 $this->load->view('Admin/add_expenses');
}
public function expenses_list(){
$this->load->view('Admin/list_expenses');
}

public function add_newspaper(){
 $this->load->view('Admin/add_news_paper');
}
public function newspaper_list(){
$this->load->view('Admin/list_newspaper');
}

public function add_party(){
 $this->load->view('Admin/add_party');
}
public function party_list(){
$this->load->view('Admin/list_party');
}

public function add_purchase(){
 $this->load->view('Admin/add_purchase');
}
public function purchase_list(){
$this->load->view('Admin/list_purchase');
}

public function add_scheme(){
 $this->load->view('Admin/add_scheme');
}
public function scheme_list(){
$this->load->view('Admin/list_scheme');
}

public function add_bill(){
 $this->load->view('Admin/add_generate_bill');
}
public function bill_list(){
$this->load->view('Admin/list_bill');
}

public function add_paper(){
 $this->load->view('Admin/add_paper');
}
public function paper_list(){
$this->load->view('Admin/list_paper');
}

public function add_receipt(){
 $this->load->view('Admin/add_receipt');
}
public function receipt_list(){
$this->load->view('Admin/list_receipt');
}
  public function add_customer(){
   $this->load->view('Admin/customer_info');
  }

  public function customer_information_list(){
   $this->load->view('Admin/customer_info_list');
  }

  public function add_user(){
   $this->load->view('Admin/add_user');
  }


  public function user_information_list(){
   $this->load->view('Admin/user_information_list');
  }
  public function add_account(){
   $this->load->view('Admin/creat_account');
  }
  public function account_information_list(){
   $this->load->view('Admin/account_list');
  }

  public function add_bill_cycle(){
   $this->load->view('Admin/add_bill_cycle');
  }
  public function bill_cycle_list(){
   $this->load->view('Admin/list_bill_cycle');
  }
  public function change_password(){
   $this->load->view('Admin/change_password');
  }
  public function delivery_challan(){
   $this->load->view('Admin/delivery_chalan');
  }



}
?>
