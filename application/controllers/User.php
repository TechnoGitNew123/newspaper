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

      $this->load->view('Include/head');
      $this->load->view('Include/navbar');
      $this->load->view('User/dashboard');
      $this->load->view('Include/footer');
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



   public function party_information(){
    $this->load->view('User/party_information');
  }
  public function party_information_list(){
   $this->load->view('User/party_information_list');
  }

public function add_expenses(){
 $this->load->view('User/add_expenses');
}
public function expenses_list(){
$this->load->view('User/list_expenses');
}



public function add_party(){
 $this->load->view('User/add_party');
}
public function party_list(){
$this->load->view('User/list_party');
}

public function add_purchase(){
 $this->load->view('User/add_purchase');
}
public function purchase_list(){
$this->load->view('User/list_purchase');
}

public function add_scheme(){
 $this->load->view('User/add_scheme');
}
public function scheme_list(){
$this->load->view('User/list_scheme');
}

public function add_bill(){
 $this->load->view('User/add_generate_bill');
}
public function bill_list(){
$this->load->view('User/list_bill');
}

public function add_paper(){
 $this->load->view('User/add_paper');
}
public function paper_list(){
$this->load->view('User/list_paper');
}

public function add_receipt(){
 $this->load->view('User/add_receipt');
}
public function receipt_list(){
$this->load->view('User/list_receipt');
}
  public function add_customer(){
   $this->load->view('User/customer_info');
  }

  public function customer_information_list(){
   $this->load->view('User/customer_info_list');
  }

  public function add_user(){
   $this->load->view('User/add_user');
  }


  public function user_information_list(){
   $this->load->view('User/user_information_list');
  }
  public function add_account(){
   $this->load->view('User/creat_account');
  }
  public function account_information_list(){
   $this->load->view('User/account_list');
  }

  public function add_bill_cycle(){
   $this->load->view('User/add_bill_cycle');
  }
  public function bill_cycle_list(){
   $this->load->view('User/list_bill_cycle');
  }
  public function change_password(){
   $this->load->view('User/change_password');
  }
  public function delivery_challan(){
   $this->load->view('User/delivery_chalan');
  }



}
?>
