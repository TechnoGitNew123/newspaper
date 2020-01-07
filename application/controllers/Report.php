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

/************************** Report ******************************/

  // Customer Summary...
  // public function get_outstanding_amt($customer_id,$from_date){
  //   $cust_info = $this->User_Model->get_info_array('customer_id', $customer_id, 'customer');
  //   $opening_bal = $cust_info[0]['opening_bal'];
  //   $advance = $cust_info[0]['advance'];
  //   $tot_bill = $this->Transaction_Model->cust_total_bill($customer_id, $from_date);
  //   $from_date2 = date("Y-m-d h:i:s", strtotime($from_date));
  //   $tot_sceme_amt = $this->Transaction_Model->cust_tot_sceme_amt($customer_id, $from_date2);
  //   $tot_received = $this->Transaction_Model->cust_tot_received($customer_id, $from_date);
  //   $out_amount = ($tot_bill + $opening_bal + $tot_sceme_amt) - ($tot_received + $advance);
  //   return $out_amount;
  // }

  public function customer_report(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('from_date', 'From Date', 'trim|required');
    $this->form_validation->set_rules('to_date', 'To Date', 'trim|required');
    if($this->form_validation->run() != FALSE){
      $from_date = $this->input->post('from_date');
      $to_date = $this->input->post('to_date');
      $delivery_line_id = $this->input->post('delivery_line_id');
      $customer_id = $this->input->post('customer_id');
      $data['from_date'] = $from_date;
      $data['to_date'] = $to_date;
      $data['delivery_line_id'] = $delivery_line_id;
      $data['customer_id'] = $customer_id;
      if($customer_id == ''){
        $data['report_type'] = 'customer_wise';
      } else{
        $data['report_type'] = 'customer_detail';
        $data['cust_bill_report'] = $this->Report_Model->cust_bill_report($from_date,$to_date,$customer_id);
        $data['cust_receipt_report'] = $this->Report_Model->cust_receipt_report($from_date,$to_date,$customer_id);
        // $data['customer_report'] = $this->Report_Model->customer_report($from_date,$to_date,$customer_id);
      }

    }
    $data['delivery_line'] = $this->User_Model->get_list($company_id,'delivery_line_id','ASC','delivery_line');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Report/customer_report',$data);
    $this->load->view('Include/footer',$data);
  }
  // Purchase Summary...
  public function purchase_report(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('from_date', 'From Date', 'trim|required');
    $this->form_validation->set_rules('to_date', 'To Date', 'trim|required');
    if($this->form_validation->run() != FALSE){
      $from_date = $this->input->post('from_date');
      $to_date = $this->input->post('to_date');
      $supplier_id = $this->input->post('supplier_id');
      $data['from_date'] = $from_date;
      $data['to_date'] = $to_date;
      $data['supplier_id'] = $supplier_id;
      if($supplier_id == ''){
        $data['report_type'] = 'all_purchase';
        // $data['all_purchase_report'] = $this->Report_Model->all_purchase_report($from_date,$to_date,$supplier_id);
      } else{
        $data['report_type'] = 'supplier_purchase';
        $data['supplier_purchase_report'] = $this->Report_Model->all_purchase_report($from_date,$to_date,$supplier_id);
        // $data['customer_report'] = $this->Report_Model->customer_report($from_date,$to_date,$customer_id);
      }

    }
    $data['supplier_list'] = $this->User_Model->get_list($company_id,'supplier_id','ASC','supplier');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Report/purchase_report',$data);
    $this->load->view('Include/footer',$data);
  }
  // Expense Summary...
  public function expense_report(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('from_date', 'From Date', 'trim|required');
    $this->form_validation->set_rules('to_date', 'To Date', 'trim|required');
    if($this->form_validation->run() != FALSE){
      $from_date = $this->input->post('from_date');
      $to_date = $this->input->post('to_date');
      $expense_type_id = $this->input->post('expense_type_id');
      $data['from_date'] = $from_date;
      $data['to_date'] = $to_date;
      $data['expense_type_id'] = $expense_type_id;
      $data['expense_report'] = $this->Report_Model->expense_report($from_date,$to_date,$expense_type_id);
    }
    $data['expense_type'] = $this->User_Model->get_list($company_id,'expense_type_id','ASC','expense_type');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Report/expense_report',$data);
    $this->load->view('Include/footer',$data);
  }
  // Receipt Summary...
  public function receipt_report(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('from_date', 'From Date', 'trim|required');
    $this->form_validation->set_rules('to_date', 'To Date', 'trim|required');
    if($this->form_validation->run() != FALSE){
      $from_date = $this->input->post('from_date');
      $to_date = $this->input->post('to_date');
      $delivery_line_id = $this->input->post('delivery_line_id');
      $data['from_date'] = $from_date;
      $data['to_date'] = $to_date;
      $data['delivery_line_id'] = $delivery_line_id;
      $data['receipt_report'] = $this->Report_Model->receipt_report($from_date,$to_date,$delivery_line_id);
      // print_r($data['receipt_report']);
    }
    $data['delivery_line'] = $this->User_Model->get_list($company_id,'delivery_line_id','ASC','delivery_line');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Report/receipt_report',$data);
    $this->load->view('Include/footer',$data);
  }
}

?>
