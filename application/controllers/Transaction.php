<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('User_Model');
    $this->load->model('Transaction_Model');
  }
/********************** Expenses ****************************/

  public function expenses_list(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $data['expenses_list'] = $this->Transaction_Model->expenses_list($company_id);
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/list_expenses',$data);
    $this->load->view('Include/footer',$data);
  }

  public function add_expenses(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('expense_vc_no', 'expense vc no', 'trim|required');
    $this->form_validation->set_rules('expense_date', 'expense date', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = array(
        'expense_vc_no' => $this->input->post('expense_vc_no'),
        'company_id' => $company_id,
        'expense_date' => $this->input->post('expense_date'),
        'expense_type' => $this->input->post('expense_type'),
        'expense_amount' => $this->input->post('expense_amount'),
        'expense_notes' => $this->input->post('expense_notes'),
        'expense_addedby' => $user_id,
      );
      $this->User_Model->save_data('expense', $save_data);
      header('location:'.base_url().'Transaction/expenses_list');
    }
    $data['expense_vc_no'] = $this->Transaction_Model->get_count_no($company_id, 'expense_vc_no', 'expense');
    $data['expense_type_list'] = $this->User_Model->get_list($company_id,'expense_type_id','ASC','expense_type');

    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/add_expenses',$data);
    $this->load->view('Include/footer',$data);
  }

  public function edit_expense($expense_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('expense_vc_no', 'expense vc no', 'trim|required');
    $this->form_validation->set_rules('expense_date', 'expense date', 'trim|required');
    if ($this->form_validation->run() != FALSE) {

      $update_data = array(
        'expense_date' => $this->input->post('expense_date'),
        'expense_type' => $this->input->post('expense_type'),
        'expense_amount' => $this->input->post('expense_amount'),
        'expense_notes' => $this->input->post('expense_notes'),
        'expense_addedby' => $user_id,
      );
      $this->User_Model->update_info('expense_id', $expense_id, 'expense', $update_data);
      header('location:'.base_url().'Transaction/expenses_list');
    }

    $expense_details = $this->User_Model->get_info_array('expense_id', $expense_id, 'expense');
    if($expense_details == ''){ header('location:'.base_url().'Transaction/expenses_list'); }
    $data['update'] = 'update';
    $data['expense_id'] = $expense_details[0]['expense_id'];
    $data['expense_vc_no'] = $expense_details[0]['expense_vc_no'];
    $data['expense_date'] = $expense_details[0]['expense_date'];
    $data['expense_type'] = $expense_details[0]['expense_type'];
    $data['expense_amount'] = $expense_details[0]['expense_amount'];
    $data['expense_notes'] = $expense_details[0]['expense_notes'];
    $data['expense_type_list'] = $this->User_Model->get_list($company_id,'expense_type_id','ASC','expense_type');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/add_expenses',$data);
    $this->load->view('Include/footer',$data);
  }

  public function delete_expense($expense_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->User_Model->delete_info('expense_id', $expense_id, 'expense');
    header('location:'.base_url().'Transaction/expenses_list');
  }
/********************** Purchase ****************************/
  public function purchase_list(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $data['purchase_list'] = $this->User_Model->get_list($company_id,'purchase_id','ASC','purchase');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/list_purchase',$data);
    $this->load->view('Include/footer',$data);
  }

  public function add_purchase(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('purchase_vc_no', 'purchase vc no', 'trim|required');
    $this->form_validation->set_rules('purchase_date', 'purchase date', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = array(
        'purchase_vc_no' => $this->input->post('purchase_vc_no'),
        'company_id' => $company_id,
        'purchase_date' => $this->input->post('purchase_date'),
        'supplier_id' => $this->input->post('supplier_id'),
        'newspaper_info_id' => $this->input->post('newspaper_info_id'),
        'purchase_qty' => $this->input->post('purchase_qty'),
        'return_qty' => $this->input->post('return_qty'),
        'purchase_tot_amt' => $this->input->post('purchase_tot_amt'),
        'purchase_pay_amt' => $this->input->post('purchase_pay_amt'),
        'purchase_note' => $this->input->post('purchase_note'),
        'purchase_addedby' => $user_id,
      );
      $this->User_Model->save_data('purchase', $save_data);
      header('location:'.base_url().'Transaction/purchase_list');
    }
    // $data['newspaper_list'] = $this->User_Model->get_newspaper_list($company_id);
    $data['purchase_vc_no'] = $this->Transaction_Model->get_count_no($company_id, 'purchase_vc_no', 'purchase');
    $data['supplier_list'] = $this->User_Model->get_list($company_id,'supplier_id','ASC','supplier');
    $data['newspaper_list'] = $this->User_Model->get_list($company_id,'newspaper_info_id','ASC','newspaper_info');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/add_purchase',$data);
    $this->load->view('Include/footer',$data);
  }

  public function edit_purchase($purchase_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('purchase_vc_no', 'purchase vc no', 'trim|required');
    $this->form_validation->set_rules('purchase_date', 'purchase date', 'trim|required');
    if ($this->form_validation->run() != FALSE) {

      $update_data = array(
        'purchase_date' => $this->input->post('purchase_date'),
        'supplier_id' => $this->input->post('supplier_id'),
        'newspaper_info_id' => $this->input->post('newspaper_info_id'),
        'purchase_qty' => $this->input->post('purchase_qty'),
        'return_qty' => $this->input->post('return_qty'),
        'purchase_tot_amt' => $this->input->post('purchase_tot_amt'),
        'purchase_pay_amt' => $this->input->post('purchase_pay_amt'),
        'purchase_note' => $this->input->post('purchase_note'),
        'purchase_addedby' => $user_id,
      );
      $this->User_Model->update_info('purchase_id', $purchase_id, 'purchase', $update_data);
      header('location:'.base_url().'Transaction/purchase_list');
    }

    $purchase_details = $this->User_Model->get_info_array('purchase_id', $purchase_id, 'purchase');
    if($purchase_details == ''){ header('location:'.base_url().'Transaction/purchase_list'); }
    $data['update'] = 'update';
    $data['purchase_id'] = $purchase_details[0]['purchase_id'];
    $data['purchase_vc_no'] = $purchase_details[0]['purchase_vc_no'];
    $data['purchase_date'] = $purchase_details[0]['purchase_date'];
    $data['supplier_id'] = $purchase_details[0]['supplier_id'];
    $data['newspaper_info_id'] = $purchase_details[0]['newspaper_info_id'];
    $data['purchase_qty'] = $purchase_details[0]['purchase_qty'];
    $data['return_qty'] = $purchase_details[0]['return_qty'];
    $data['purchase_tot_amt'] = $purchase_details[0]['purchase_tot_amt'];
    $data['purchase_pay_amt'] = $purchase_details[0]['purchase_pay_amt'];
    $data['purchase_note'] = $purchase_details[0]['purchase_note'];
    $data['supplier_list'] = $this->User_Model->get_list($company_id,'supplier_id','ASC','supplier');
    $data['newspaper_list'] = $this->User_Model->get_list($company_id,'newspaper_info_id','ASC','newspaper_info');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/add_purchase',$data);
    $this->load->view('Include/footer',$data);
  }

  public function delete_purchase($purchase_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->User_Model->delete_info('purchase_id', $purchase_id, 'purchase');
    header('location:'.base_url().'Transaction/purchase_list');
  }

/********************** Bill Cycle ****************************/
  public function bill_cycle_list(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $data['bill_cycle_list'] = $this->User_Model->get_list($company_id,'bill_cycle_id','ASC','bill_cycle');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/list_bill_cycle',$data);
    $this->load->view('Include/footer',$data);
  }

  public function add_bill_cycle(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('bill_cycle_name', 'bill_cycle_name', 'trim|required');
    $this->form_validation->set_rules('bill_cycle_from', 'bill_cycle_from', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = array(
        'company_id' => $company_id,
        'bill_cycle_name' => $this->input->post('bill_cycle_name'),
        'bill_cycle_from' => $this->input->post('bill_cycle_from'),
        'bill_cycle_to' => $this->input->post('bill_cycle_to'),
        'bill_cycle_addedby' => $user_id,
      );
      $this->User_Model->save_data('bill_cycle', $save_data);
      header('location:'.base_url().'Transaction/bill_cycle_list');
    }
    $this->load->view('Include/head');
    $this->load->view('Include/navbar');
    $this->load->view('Transaction/add_bill_cycle');
    $this->load->view('Include/footer');
  }

  public function edit_bill_cycle($bill_cycle_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('bill_cycle_name', 'bill_cycle_name', 'trim|required');
    $this->form_validation->set_rules('bill_cycle_from', 'bill_cycle_from', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = array(
      'bill_cycle_name' => $this->input->post('bill_cycle_name'),
      'bill_cycle_from' => $this->input->post('bill_cycle_from'),
      'bill_cycle_to' => $this->input->post('bill_cycle_to'),
      'bill_cycle_addedby' => $user_id,
      );
      $this->User_Model->update_info('bill_cycle_id', $bill_cycle_id, 'bill_cycle', $update_data);
      header('location:'.base_url().'Transaction/bill_cycle_list');
    }

    $bill_cycle_details = $this->User_Model->get_info_array('bill_cycle_id', $bill_cycle_id, 'bill_cycle');
    if($bill_cycle_details == ''){ header('location:'.base_url().'Transaction/bill_cycle_list'); }
    $data['update'] = 'update';
    $data['bill_cycle_id'] = $bill_cycle_details[0]['bill_cycle_id'];
    $data['bill_cycle_name'] = $bill_cycle_details[0]['bill_cycle_name'];
    $data['bill_cycle_from'] = $bill_cycle_details[0]['bill_cycle_from'];
    $data['bill_cycle_to'] = $bill_cycle_details[0]['bill_cycle_to'];
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/add_bill_cycle',$data);
    $this->load->view('Include/footer',$data);
  }

  public function delete_bill_cycle($bill_cycle_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->User_Model->delete_info('bill_cycle_id', $bill_cycle_id, 'bill_cycle');
    header('location:'.base_url().'Transaction/bill_cycle_list');
  }
/********************** Generate Bill ****************************/
// Bill List...
  public function bill_list(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $data['bill_list'] = $this->Transaction_Model->bill_list($company_id);
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/list_bill',$data);
    $this->load->view('Include/footer',$data);
  }
  // Add Bill...
  public function add_bill(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('bill_cycle_id', 'bill_cycle_id', 'trim|required');
    $this->form_validation->set_rules('delivery_line_id', 'delivery_line_id', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = array(
        'company_id' => $company_id,
        'bill_no' => $this->input->post('bill_no'),
        'bill_date' => $this->input->post('bill_date'),
        'bill_cycle_id' => $this->input->post('bill_cycle_id'),
        'delivery_line_id' => $this->input->post('delivery_line_id'),
        'customer_id' => $this->input->post('customer_id'),
        'del_charges' => $this->input->post('del_charges'),
        'paper_wise' => $this->input->post('paper_wise'),
        'tot_gros_amt' => $this->input->post('tot_gros_amt'),
        'tot_del_charges' => $this->input->post('tot_del_charges'),
        'tot_less_amt' => $this->input->post('tot_less_amt'),
        'tot_add_amt' => $this->input->post('tot_add_amt'),
        'tot_net_amt' => $this->input->post('tot_net_amt'),
        'bill_addedby' => $user_id,
      );
      $bill_id = $this->User_Model->save_data('bill', $save_data);
      foreach($_POST['input1'] as $user1){
        $user1['bill_id'] = $bill_id;
        $this->db->insert('bill_paper', $user1);
      }
      foreach($_POST['input2'] as $user2){
        $user2['bill_id'] = $bill_id;
        $this->db->insert('bill_scheme', $user2);
      }

      header('location:'.base_url().'Transaction/bill_list');
    }
    $data['bill_no'] = $this->Transaction_Model->get_count_no($company_id, 'bill_no', 'bill');
    $data['bill_cycle_list'] = $this->User_Model->get_list($company_id,'bill_cycle_id','ASC','bill_cycle');
    $data['delivery_line_list'] = $this->User_Model->get_list($company_id,'delivery_line_id','ASC','delivery_line');
    $data['customer_list'] = $this->User_Model->get_list($company_id,'customer_id','ASC','customer');
    // echo $company_id;
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/add_generate_bill',$data);
    $this->load->view('Include/footer',$data);
  }
  //Edit Bill...
  public function edit_bill($bill_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('bill_cycle_id', 'bill_cycle_id', 'trim|required');
    $this->form_validation->set_rules('delivery_line_id', 'delivery_line_id', 'trim|required');
    if($this->form_validation->run() != FALSE) {
      $update_data = array(
        'bill_date' => $this->input->post('bill_date'),
        'bill_cycle_id' => $this->input->post('bill_cycle_id'),
        'delivery_line_id' => $this->input->post('delivery_line_id'),
        'customer_id' => $this->input->post('customer_id'),
        'del_charges' => $this->input->post('del_charges'),
        'paper_wise' => $this->input->post('paper_wise'),
        'tot_gros_amt' => $this->input->post('tot_gros_amt'),
        'tot_del_charges' => $this->input->post('tot_del_charges'),
        'tot_less_amt' => $this->input->post('tot_less_amt'),
        'tot_add_amt' => $this->input->post('tot_add_amt'),
        'tot_net_amt' => $this->input->post('tot_net_amt'),
        'bill_addedby' => $user_id,
      );
      $this->User_Model->update_info('bill_id', $bill_id, 'bill', $update_data);
      $this->User_Model->delete_info('bill_id', $bill_id, 'bill_paper');
      $this->User_Model->delete_info('bill_id', $bill_id, 'bill_scheme');

      foreach($_POST['input1'] as $user1){
        $user1['bill_id'] = $bill_id;
        $this->db->insert('bill_paper', $user1);
      }
      foreach($_POST['input2'] as $user2){
        $user2['bill_id'] = $bill_id;
        $this->db->insert('bill_scheme', $user2);
      }
      header('location:'.base_url().'Transaction/bill_list');
    }
    $bill_details = $this->User_Model->get_info_array('bill_id', $bill_id, 'bill');
    if($bill_details == ''){ header('location:'.base_url().'Transaction/bill_list'); }
    $data['update'] = 'update';
    $data['bill_no'] = $bill_details[0]['bill_no'];
    $data['bill_date'] = $bill_details[0]['bill_date'];
    $data['bill_cycle_id'] = $bill_details[0]['bill_cycle_id'];
    $data['delivery_line_id'] = $bill_details[0]['delivery_line_id'];
    $data['customer_id'] = $bill_details[0]['customer_id'];
    $data['del_charges'] = $bill_details[0]['del_charges'];
    $data['paper_wise'] = $bill_details[0]['paper_wise'];
    $data['tot_gros_amt'] = $bill_details[0]['tot_gros_amt'];
    $data['tot_del_charges'] = $bill_details[0]['tot_del_charges'];
    $data['tot_less_amt'] = $bill_details[0]['tot_less_amt'];
    $data['tot_add_amt'] = $bill_details[0]['tot_add_amt'];
    $data['tot_net_amt'] = $bill_details[0]['tot_net_amt'];

    $data['bill_cycle_list'] = $this->User_Model->get_list($company_id,'bill_cycle_id','ASC','bill_cycle');
    $data['delivery_line_list'] = $this->User_Model->get_list($company_id,'delivery_line_id','ASC','delivery_line');
    $data['customer_list'] = $this->User_Model->get_list($company_id,'customer_id','ASC','customer');

    $data['paper_list'] = $this->Transaction_Model->bill_paper_list($bill_id);
    $data['scheme_list'] = $this->Transaction_Model->bill_scheme_list($bill_id);

    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/add_generate_bill',$data);
    $this->load->view('Include/footer',$data);
  }

  public function delete_bill($bill_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->User_Model->delete_info('bill_id', $bill_id, 'bill');
    $this->User_Model->delete_info('bill_id', $bill_id, 'bill_paper');
    $this->User_Model->delete_info('bill_id', $bill_id, 'bill_scheme');
    header('location:'.base_url().'Transaction/bill_list');
  }

  public function get_paper_by_customer(){
    $customer_id = $this->input->post('customer_id');
    $bill_cycle_id = $this->input->post('bill_cycle_id');
    $bill_cycle_details = $this->User_Model->get_info_array('bill_cycle_id', $bill_cycle_id, 'bill_cycle');
    $from_date = $bill_cycle_details[0]['bill_cycle_from'];
    $to_date = $bill_cycle_details[0]['bill_cycle_to'];
    $paper_list = $this->Transaction_Model->get_paper_by_customer($customer_id);
    $scheme_list = $this->Transaction_Model->get_scheme_by_customer($customer_id);

    $paper = "";
    $i = 0;
    foreach ($paper_list as $paper_list) {
      $e_date = $paper_list->e_date;
      $e_date2 = strtotime($paper_list->e_date);
      $from_date2 = strtotime($from_date);
      if($e_date == '' || $e_date2 > $from_date2){
        $paper = $paper.'<div class="form-group col-md-4">
          <input type="text" class="form-control form-control-sm"  name="" value="'.$paper_list->newspaper_info_name.'" title="Paper" placeholder="Paper">
          <input type="hidden" name="input1['.$i.'][newspaper_info_id]" value="'.$paper_list->newspaper_info_id.'">
        </div>
        <div class="form-group col-md-4">
          <input type="text" class="form-control form-control-sm"  name="input1['.$i.'][newspaper_qty]" value="'.$paper_list->newspaper_qty.'" title="Quantity" placeholder="Quantity">
        </div>
        <div class="form-group col-md-4">
          <input type="text" class="form-control form-control-sm"  name="input1['.$i.'][amount]" title="Amount" placeholder="Amount">
        </div>';
      }
      $i++;
    }
    $data['newspaper'] = $paper;

    $scheme = "";
    $j = 0;
    foreach ($scheme_list as $scheme_list) {
      $e_date = $scheme_list->e_date;
      $e_date2 = strtotime($scheme_list->e_date);
      $from_date2 = strtotime($from_date);
      if(($e_date == '' || $e_date2 > $from_date2) && $scheme_list->is_monthly_bill == 'Yes'){
        $scheme = $scheme.'<div class="form-group col-md-4">
          <input type="text" class="form-control form-control-sm"  name="" value="'.$scheme_list->scheme_info_name.'" title="Scheme" placeholder="Scheme">
          <input type="hidden" name="input2['.$j.'][scheme_info_id]" value="'.$scheme_list->scheme_info_id.'">
        </div>
        <div class="form-group col-md-4">
          <input type="text" class="form-control form-control-sm"  name="input2['.$j.'][qty]" value="'.$scheme_list->qty.'" title="Quantity" placeholder="Quantity">
        </div>
        <div class="form-group col-md-4">
          <input type="text" class="form-control form-control-sm"  name="input2['.$j.'][amount]" title="Amount" placeholder="Amount">
        </div>';
      }
      $j++;
    }
    $data['scheme'] = $scheme;

    echo json_encode($data);
  }
/********************** Receipt ****************************/
// Receipt List...
  public function receipt_list(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $data['receipt_list'] = $this->Transaction_Model->receipt_list($company_id);
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/list_receipt',$data);
    $this->load->view('Include/footer',$data);
  }
  // Add Receipt...
  public function add_receipt(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('receipt_no', 'receipt_no', 'trim|required');
    $this->form_validation->set_rules('receipt_date', 'receipt_date', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = array(
        'company_id' => $company_id,
        'receipt_no' => $this->input->post('receipt_no'),
        'receipt_date' => $this->input->post('receipt_date'),
        'delivery_line_id' => $this->input->post('delivery_line_id'),
        'customer_id' => $this->input->post('customer_id'),
        'out_amount' => $this->input->post('out_amount'),
        'rec_amount' => $this->input->post('rec_amount'),
        'pay_mode' => $this->input->post('pay_mode'),
        'cheque_no' => $this->input->post('cheque_no'),
        'cheque_date' => $this->input->post('cheque_date'),
        'cheque_amt' => $this->input->post('cheque_amt'),
        'receipt_ref_no' => $this->input->post('receipt_ref_no'),
        'receipt_note' => $this->input->post('receipt_note'),
        'receipt_addedby' => $user_id,
      );
      $bill_id = $this->User_Model->save_data('receipt', $save_data);
      header('location:'.base_url().'Transaction/receipt_list');
    }

    $data['receipt_no'] = $this->Transaction_Model->get_count_no($company_id, 'receipt_no', 'receipt');
    $data['delivery_line_list'] = $this->User_Model->get_list($company_id,'delivery_line_id','ASC','delivery_line');
    $data['customer_list'] = $this->User_Model->get_list($company_id,'customer_id','ASC','customer');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/add_receipt',$data);
    $this->load->view('Include/footer',$data);
  }
  // Edit Receipt...
  public function edit_receipt($receipt_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('receipt_no', 'receipt_no', 'trim|required');
    $this->form_validation->set_rules('receipt_date', 'receipt_date', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = array(
        'receipt_date' => $this->input->post('receipt_date'),
        'delivery_line_id' => $this->input->post('delivery_line_id'),
        'customer_id' => $this->input->post('customer_id'),
        'out_amount' => $this->input->post('out_amount'),
        'rec_amount' => $this->input->post('rec_amount'),
        'pay_mode' => $this->input->post('pay_mode'),
        'cheque_no' => $this->input->post('cheque_no'),
        'cheque_date' => $this->input->post('cheque_date'),
        'cheque_amt' => $this->input->post('cheque_amt'),
        'receipt_ref_no' => $this->input->post('receipt_ref_no'),
        'receipt_note' => $this->input->post('receipt_note'),
        'receipt_addedby' => $user_id,
      );
      $this->User_Model->update_info('receipt_id', $receipt_id, 'receipt', $update_data);
      header('location:'.base_url().'Transaction/receipt_list');
    }

    $receipt_details = $this->User_Model->get_info_array('receipt_id', $receipt_id, 'receipt');
    if($receipt_details == ''){ header('location:'.base_url().'Transaction/receipt_list'); }
    $data['update'] = 'update';
    $data['receipt_no'] = $receipt_details[0]['receipt_no'];
    $data['receipt_date'] = $receipt_details[0]['receipt_date'];
    $data['delivery_line_id'] = $receipt_details[0]['delivery_line_id'];
    $data['customer_id'] = $receipt_details[0]['customer_id'];
    $data['out_amount'] = $receipt_details[0]['out_amount'];
    $data['rec_amount'] = $receipt_details[0]['rec_amount'];
    $data['pay_mode'] = $receipt_details[0]['pay_mode'];
    $data['cheque_no'] = $receipt_details[0]['cheque_no'];
    $data['cheque_date'] = $receipt_details[0]['cheque_date'];
    $data['cheque_amt'] = $receipt_details[0]['cheque_amt'];
    $data['receipt_ref_no'] = $receipt_details[0]['receipt_ref_no'];
    $data['receipt_note'] = $receipt_details[0]['receipt_note'];

    $data['delivery_line_list'] = $this->User_Model->get_list($company_id,'delivery_line_id','ASC','delivery_line');
    $data['customer_list'] = $this->User_Model->get_list($company_id,'customer_id','ASC','customer');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/add_receipt',$data);
    $this->load->view('Include/footer',$data);
  }
  // Delete...
  public function delete_receipt($receipt_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->User_Model->delete_info('receipt_id', $receipt_id, 'receipt');
    header('location:'.base_url().'Transaction/receipt_list');
  }

/************************** Payment Entry ************************/
// Payment Entry List...
  public function payment_list(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $data['payment_list'] = $this->User_Model->get_list($company_id,'payment_id','ASC','payment');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/list_payment',$data);
    $this->load->view('Include/footer',$data);
  }
  // Add Payment Entry...
  public function add_payment(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('payment_no', 'payment_no', 'trim|required');
    $this->form_validation->set_rules('payment_date', 'payment_date', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = array(
        'company_id' => $company_id,
        'payment_no' => $this->input->post('payment_no'),
        'payment_date' => $this->input->post('payment_date'),
        'supplier_id' => $this->input->post('supplier_id'),
        'out_amount' => $this->input->post('out_amount'),
        'paid_amount' => $this->input->post('paid_amount'),
        'pay_mode' => $this->input->post('pay_mode'),
        'cheque_no' => $this->input->post('cheque_no'),
        'cheque_date' => $this->input->post('cheque_date'),
        'cheque_amt' => $this->input->post('cheque_amt'),
        'payment_ref_no' => $this->input->post('payment_ref_no'),
        'payment_note' => $this->input->post('payment_note'),
        'payment_addedby' => $user_id,
      );
      $bill_id = $this->User_Model->save_data('payment', $save_data);
      header('location:'.base_url().'Transaction/payment_list');
    }

    $data['payment_no'] = $this->Transaction_Model->get_count_no($company_id, 'payment_no', 'payment');
    $data['supplier_list'] = $this->User_Model->get_list($company_id,'supplier_id','ASC','supplier');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/add_payment',$data);
    $this->load->view('Include/footer',$data);
  }
  // Edit Payment Entry...
  public function edit_payment($payment_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('payment_no', 'payment_no', 'trim|required');
    $this->form_validation->set_rules('payment_date', 'payment_date', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = array(
        'payment_date' => $this->input->post('payment_date'),
        'supplier_id' => $this->input->post('supplier_id'),
        'out_amount' => $this->input->post('out_amount'),
        'paid_amount' => $this->input->post('paid_amount'),
        'pay_mode' => $this->input->post('pay_mode'),
        'cheque_no' => $this->input->post('cheque_no'),
        'cheque_date' => $this->input->post('cheque_date'),
        'cheque_amt' => $this->input->post('cheque_amt'),
        'payment_ref_no' => $this->input->post('payment_ref_no'),
        'payment_note' => $this->input->post('payment_note'),
        'payment_addedby' => $user_id,
      );
      $this->User_Model->update_info('payment_id', $payment_id, 'payment', $update_data);
      header('location:'.base_url().'Transaction/payment_list');
    }

    $payment_details = $this->User_Model->get_info_array('payment_id', $payment_id, 'payment');
    if($payment_details == ''){ header('location:'.base_url().'Transaction/payment_list'); }
    $data['update'] = 'update';
    $data['payment_no'] = $payment_details[0]['payment_no'];
    $data['payment_date'] = $payment_details[0]['payment_date'];
    $data['supplier_id'] = $payment_details[0]['supplier_id'];
    $data['out_amount'] = $payment_details[0]['out_amount'];
    $data['paid_amount'] = $payment_details[0]['paid_amount'];
    $data['pay_mode'] = $payment_details[0]['pay_mode'];
    $data['cheque_no'] = $payment_details[0]['cheque_no'];
    $data['cheque_date'] = $payment_details[0]['cheque_date'];
    $data['cheque_amt'] = $payment_details[0]['cheque_amt'];
    $data['payment_ref_no'] = $payment_details[0]['payment_ref_no'];
    $data['payment_note'] = $payment_details[0]['payment_note'];


    $data['supplier_list'] = $this->User_Model->get_list($company_id,'supplier_id','ASC','supplier');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/add_payment',$data);
    $this->load->view('Include/footer',$data);
  }
  // Delete Payment Entry...
  public function delete_payment($payment_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->User_Model->delete_info('payment_id', $payment_id, 'payment');
    header('location:'.base_url().'Transaction/payment_list');
  }

  public function get_supplier_outstanding_amount(){
    $supplier_id = $this->input->post('supplier_id');
    $from_date = '';
    $to_date = '';
    $tot_purchase_amount = $this->Transaction_Model->get_supplier_purchase_amount($supplier_id,$from_date,$to_date);
    $tot_purchase_pay_amount = $this->Transaction_Model->get_supplier_purchase_pay_amount($supplier_id,$from_date,$to_date);
    $tot_payment = $this->Transaction_Model->get_supplier_payment_amount($supplier_id,$from_date,$to_date);
    $outstanding_amount = $tot_purchase_amount - ($tot_purchase_pay_amount + $tot_payment);
    echo $outstanding_amount;
  }



/********************************* Gift Entry **************************/

// Gift Entry List...
  public function gift_entry_list(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $data['gift_entry_list'] = $this->User_Model->get_list($company_id,'gift_entry_id','ASC','gift_entry');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/list_gift_entry',$data);
    $this->load->view('Include/footer',$data);
  }
  // Add Gift Entry...
  public function add_gift_entry(){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('gift_entry_no', 'gift_entry_no', 'trim|required');
    $this->form_validation->set_rules('gift_entry_date', 'gift_entry_date', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = array(
        'company_id' => $company_id,
        'gift_entry_no' => $this->input->post('gift_entry_no'),
        'gift_entry_date' => $this->input->post('gift_entry_date'),
        'supplier_id' => $this->input->post('supplier_id'),
        'out_amount' => $this->input->post('out_amount'),
        'paid_amount' => $this->input->post('paid_amount'),
        'pay_mode' => $this->input->post('pay_mode'),
        'cheque_no' => $this->input->post('cheque_no'),
        'cheque_date' => $this->input->post('cheque_date'),
        'cheque_amt' => $this->input->post('cheque_amt'),
        'gift_entry_ref_no' => $this->input->post('gift_entry_ref_no'),
        'gift_entry_note' => $this->input->post('gift_entry_note'),
        'gift_entry_addedby' => $user_id,
      );
      $bill_id = $this->User_Model->save_data('gift_entry', $save_data);
      header('location:'.base_url().'Transaction/gift_entry_list');
    }

    $data['gift_entry_no'] = $this->Transaction_Model->get_count_no($company_id, 'gift_entry_no', 'gift_entry');
    $data['supplier_list'] = $this->User_Model->get_list($company_id,'supplier_id','ASC','supplier');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/add_gift_entry',$data);
    $this->load->view('Include/footer',$data);
  }
  // Edit Gift Entry...
  public function edit_gift_entry($gift_entry_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('gift_entry_no', 'gift_entry_no', 'trim|required');
    $this->form_validation->set_rules('gift_entry_date', 'gift_entry_date', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = array(
        'gift_entry_date' => $this->input->post('gift_entry_date'),
        'supplier_id' => $this->input->post('supplier_id'),
        'out_amount' => $this->input->post('out_amount'),
        'paid_amount' => $this->input->post('paid_amount'),
        'pay_mode' => $this->input->post('pay_mode'),
        'cheque_no' => $this->input->post('cheque_no'),
        'cheque_date' => $this->input->post('cheque_date'),
        'cheque_amt' => $this->input->post('cheque_amt'),
        'gift_entry_ref_no' => $this->input->post('gift_entry_ref_no'),
        'gift_entry_note' => $this->input->post('gift_entry_note'),
        'gift_entry_addedby' => $user_id,
      );
      $this->User_Model->update_info('gift_entry_id', $gift_entry_id, 'gift_entry', $update_data);
      header('location:'.base_url().'Transaction/gift_entry_list');
    }

    $gift_entry_details = $this->User_Model->get_info_array('gift_entry_id', $gift_entry_id, 'gift_entry');
    if($gift_entry_details == ''){ header('location:'.base_url().'Transaction/gift_entry_list'); }
    $data['update'] = 'update';
    $data['gift_entry_no'] = $gift_entry_details[0]['gift_entry_no'];
    $data['gift_entry_date'] = $gift_entry_details[0]['gift_entry_date'];
    $data['supplier_id'] = $gift_entry_details[0]['supplier_id'];
    $data['out_amount'] = $gift_entry_details[0]['out_amount'];
    $data['paid_amount'] = $gift_entry_details[0]['paid_amount'];
    $data['pay_mode'] = $gift_entry_details[0]['pay_mode'];
    $data['cheque_no'] = $gift_entry_details[0]['cheque_no'];
    $data['cheque_date'] = $gift_entry_details[0]['cheque_date'];
    $data['cheque_amt'] = $gift_entry_details[0]['cheque_amt'];
    $data['gift_entry_ref_no'] = $gift_entry_details[0]['gift_entry_ref_no'];
    $data['gift_entry_note'] = $gift_entry_details[0]['gift_entry_note'];


    $data['supplier_list'] = $this->User_Model->get_list($company_id,'supplier_id','ASC','supplier');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('Transaction/add_gift_entry',$data);
    $this->load->view('Include/footer',$data);
  }
  // Delete Gift Entry...
  public function delete_gift_entry($gift_entry_id){
    $user_id = $this->session->userdata('user_id');
    $company_id = $this->session->userdata('company_id');
    $roll_id = $this->session->userdata('roll_id');
    if($user_id==null && $company_id == null ){ header('location:'.base_url().'User'); }
    $this->User_Model->delete_info('gift_entry_id', $gift_entry_id, 'gift_entry');
    header('location:'.base_url().'Transaction/gift_entry_list');
  }

/*********************************************************************************************/

  public function get_cust_by_delivery_line(){
    $company_id = $this->session->userdata('company_id');
    $delivery_line_id = $this->input->post('delivery_line_id');
    $cust_list = $this->Transaction_Model->get_cust_by_delivery_line($company_id,$delivery_line_id);
    echo "<option value='' selected >Select Customer</option>";
    foreach ($cust_list as $list) {
      echo "<option class='' value=".$list->customer_id."> ".$list->customer_name." </option>";
    }
  }

  public function get_outstanding_amount(){
    $company_id = $this->session->userdata('company_id');
    $customer_id = $this->input->post('customer_id');
    $cust_info = $this->User_Model->get_info_array('customer_id', $customer_id, 'customer');
    $opening_bal = $cust_info[0]['opening_bal'];
    $advance = $cust_info[0]['advance'];
    $tot_bill = $this->Transaction_Model->cust_total_bill($customer_id);
    $tot_sceme_amt = $this->Transaction_Model->cust_tot_sceme_amt($customer_id);
    $tot_received = $this->Transaction_Model->cust_tot_received($customer_id);
    $out_amount = ($tot_bill + $opening_bal + $tot_sceme_amt) - ($tot_received + $advance);
    echo $out_amount;
  }


  // public function gift_count(){
  //
  // }



}
