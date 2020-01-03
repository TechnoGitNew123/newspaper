<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('User_Model');
    $this->load->model('Transaction_Model');
    $this->load->model('Report_Model');
  }

  public function bill($bill_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $company_info = $this->User_Model->get_info_array('company_id', $company_id, 'company');
    $data['company_name'] = $company_info[0]['company_name'];
    $data['company_address'] = $company_info[0]['company_address'];
    $data['company_mob1'] = $company_info[0]['company_mob1'];
    $data['company_email'] = $company_info[0]['company_email'];

    $bill_details = $this->Report_Model->get_bill_details($bill_id);
    $data['customer_id'] = $bill_details[0]['customer_id'];
    $data['customer_name'] = $bill_details[0]['customer_name'];
    $data['customer_address'] = $bill_details[0]['customer_address'];
    $data['mobile'] = $bill_details[0]['mobile'];
    $data['delivery_line_name'] = $bill_details[0]['delivery_line_name'];
    $data['bill_no'] = $bill_details[0]['bill_no'];
    $data['bill_date'] = $bill_details[0]['bill_date'];
    $data['tot_gros_amt'] = $bill_details[0]['tot_gros_amt'];
    $data['tot_del_charges'] = $bill_details[0]['tot_del_charges'];
    $data['tot_less_amt'] = $bill_details[0]['tot_less_amt'];
    $data['tot_add_amt'] = $bill_details[0]['tot_add_amt'];
    $data['tot_net_amt'] = $bill_details[0]['tot_net_amt'];

    $customer_id = $bill_details[0]['customer_id'];
    $cust_info = $this->User_Model->get_info_array('customer_id', $customer_id, 'customer');
    $opening_bal = $cust_info[0]['opening_bal'];
    $advance = $cust_info[0]['advance'];
    $tot_bill = $this->Transaction_Model->cust_total_bill($customer_id);
    $tot_sceme_amt = $this->Transaction_Model->cust_tot_sceme_amt($customer_id);
    $tot_received = $this->Transaction_Model->cust_tot_received($customer_id);
    $out_amount = ($tot_bill + $opening_bal + $tot_sceme_amt) - ($tot_received + $advance);
    $data['out_amount'] = $out_amount + $data['tot_net_amt'];
    $data['paper_list'] = $this->Transaction_Model->bill_paper_list($bill_id);
    $data['scheme_list'] = $this->Transaction_Model->bill_scheme_list($bill_id);

    $this->load->view('Report/bill',$data);
  }

  public function receipt($receipt_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $company_info = $this->User_Model->get_info_array('company_id', $company_id, 'company');
    $data['company_name'] = $company_info[0]['company_name'];
    $data['company_address'] = $company_info[0]['company_address'];
    $data['company_mob1'] = $company_info[0]['company_mob1'];
    $data['company_email'] = $company_info[0]['company_email'];
    $receipt_details = $this->Report_Model->receipt_details($receipt_id);
    // print_r($receipt_details);
    $data['receipt_no'] = $receipt_details[0]['receipt_no'];
    $data['receipt_date'] = $receipt_details[0]['receipt_date'];
    $data['rec_amount'] = $receipt_details[0]['rec_amount'];
    $data['receipt_note'] = $receipt_details[0]['receipt_note'];
    $data['customer_name'] = $receipt_details[0]['customer_name'];
    $data['customer_address'] = $receipt_details[0]['customer_address'];
    $this->load->view('Report/receipt',$data);
  }

  public function sale_report(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }

    $this->load->view('Include/head');
    $this->load->view('Include/navbar');
    $this->load->view('Report/sale_report');
    $this->load->view('Include/footer');

  }
}

?>
