<?php
class Report_Model extends CI_Model{
  public function get_bill_details($bill_id){
    $this->db->select('bill.*, bill_cycle.*,delivery_line.*,customer.*');
    $this->db->from('bill');
    $this->db->where('bill_id',$bill_id);
    $this->db->join('bill_cycle','bill_cycle.bill_cycle_id = bill.bill_cycle_id','LEFT');
    $this->db->join('delivery_line','delivery_line.delivery_line_id = bill.delivery_line_id','LEFT');
    $this->db->join('customer','customer.customer_id = bill.customer_id','LEFT');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  public function receipt_details($receipt_id){
    $this->db->select('receipt.*,	customer.*');
    $this->db->from('receipt');
    $this->db->where('receipt_id',$receipt_id);
    $this->db->join('customer','customer.customer_id = receipt.customer_id','LEFT');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

/***************************** Report ***********************/
  // Customer Report...
  // Used in customer_report.php
  public function get_cust_tot_bill($customer_id,$from_date,$to_date){
    $this->db->select('SUM(tot_net_amt) as cust_tot_bill');
    $this->db->from('bill');
    $this->db->where('customer_id',$customer_id);
    $this->db->where("str_to_date(bill_date,'%d-%m-%Y')  BETWEEN str_to_date('$from_date','%d-%m-%Y') AND str_to_date('$to_date','%d-%m-%Y')");
    $query = $this->db->get();
    $result = $query->result_array();
    return $result[0]['cust_tot_bill'];
  }
  // Used in customer_report.php
  public function get_cust_scheme_amt($customer_id,$from_date,$to_date){
    $this->db->select('SUM(sch_amount) as cust_scheme_amt');
    // $this->db->select('*');
    $this->db->from('customer_schdetails');
    $this->db->where('customer_id',$customer_id);
    $this->db->where("date BETWEEN '$from_date' AND '$to_date'");
    $query = $this->db->get();
    $result = $query->result_array();
    // $q = $this->db->last_query();
    return $result[0]['cust_scheme_amt'];
    // return $q;
  }
  // Used in customer_report.php
  public function get_cust_tot_received($customer_id,$from_date,$to_date){
    $this->db->select('SUM(rec_amount) as cust_tot_received');
    $this->db->from('receipt');
    $this->db->where('customer_id',$customer_id);
    $this->db->where("str_to_date(receipt_date,'%d-%m-%Y')  BETWEEN str_to_date('$from_date','%d-%m-%Y') AND str_to_date('$to_date','%d-%m-%Y')");
    $query = $this->db->get();
    $result = $query->result_array();
    return $result[0]['cust_tot_received'];
  }
  // Used in customer_report.php
  public function cust_total_bill($customer_id, $from_date){
    $this->db->select('SUM(tot_net_amt) as cust_total_bill');
    $this->db->from('bill');
    $this->db->where('customer_id',$customer_id);
    $this->db->where("str_to_date(bill_date,'%d-%m-%Y')  < str_to_date('$from_date','%d-%m-%Y')");
    $query = $this->db->get();
    // $q = $this->db->last_query();
    $result = $query->result_array();
    return $result[0]['cust_total_bill'];
  }
  // Used in customer_report.php
  public function cust_tot_sceme_amt($customer_id, $from_date){
    $this->db->select('SUM(sch_amount) as cust_tot_sceme_amt');
    $this->db->from('customer_schdetails');
    $this->db->where('customer_id',$customer_id);
    $this->db->where("date < '$from_date' ");
    $query = $this->db->get();
    // $q = $this->db->last_query();
    $result = $query->result_array();
    return $result[0]['cust_tot_sceme_amt'];
  }
  // Used in customer_report.php
  public function cust_tot_received($customer_id, $from_date){
    $this->db->select('SUM(rec_amount) as cust_tot_received');
    $this->db->from('receipt');
    $this->db->where('customer_id',$customer_id);
    $this->db->where("str_to_date(receipt_date,'%d-%m-%Y') < str_to_date('$from_date','%d-%m-%Y')");
    $query = $this->db->get();
    // $q = $this->db->last_query();
    $result = $query->result_array();
    return $result[0]['cust_tot_received'];
  }

  public function customer_report($from_date,$to_date,$customer_id){
    $this->db->select('bill.*,receipt.*');
    $this->db->from('receipt');

    $this->db->where('bill.customer_id',$customer_id);
    $this->db->or_where('receipt.customer_id',$customer_id);
    $this->db->join('bill','bill.customer_id = receipt.customer_id','FULL OUTER');
    // $this->db->where("str_to_date(receipt_date,'%d-%m-%Y')  BETWEEN str_to_date('$from_date','%d-%m-%Y') AND str_to_date('$to_date','%d-%m-%Y')");

    $query = $this->db->get();
    // $query = $this->db->query('SELECT * FROM bill UNION SELECT * FROM receipt');
    $q = $this->db->last_query();
    $result = $query->result();
    return $q;
  }



  // Used in customer_report.php
  public function cust_bill_report($from_date,$to_date,$customer_id){
    $this->db->select('*');
    $this->db->from('bill');
    $this->db->where('customer_id',$customer_id);
    $this->db->where("str_to_date(bill_date,'%d-%m-%Y') BETWEEN str_to_date('$from_date','%d-%m-%Y') AND str_to_date('$to_date','%d-%m-%Y')");
    $query = $this->db->get();
    // $q = $this->db->last_query();
    $result = $query->result();
    return $result;
  }
  public function cust_receipt_report($from_date,$to_date,$customer_id){
    $this->db->select('*');
    $this->db->from('receipt');
    if($customer_id != ''){
      $this->db->where('customer_id',$customer_id);
    }
    $this->db->where("str_to_date(receipt_date,'%d-%m-%Y')  BETWEEN str_to_date('$from_date','%d-%m-%Y') AND str_to_date('$to_date','%d-%m-%Y')");
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }
  // Expense Report...
  public function receipt_report($from_date,$to_date,$delivery_line_id){
    $this->db->select('*');
    $this->db->from('receipt');
    if($delivery_line_id != ''){
      $this->db->where('delivery_line_id',$delivery_line_id);
    }
    $this->db->where("str_to_date(receipt_date,'%d-%m-%Y')  BETWEEN str_to_date('$from_date','%d-%m-%Y') AND str_to_date('$to_date','%d-%m-%Y')");
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }
  // Receipt Report...
  public function expense_report($from_date,$to_date,$expense_type_id){
    $this->db->select('*');
    $this->db->from('expense');
    if($expense_type_id != ''){
      $this->db->where('expense_type_id',$expense_type_id);
    }
    $this->db->where("str_to_date(expense_date,'%d-%m-%Y')  BETWEEN str_to_date('$from_date','%d-%m-%Y') AND str_to_date('$to_date','%d-%m-%Y')");
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }

  // Purchase Report...
  public function all_purchase_report($from_date,$to_date,$supplier_id){
    $this->db->select('purchase.*,supplier.*,newspaper_info.*');
    $this->db->from('purchase');
    if($supplier_id != ''){
      $this->db->where('purchase.supplier_id',$supplier_id);
    }
    $this->db->join('supplier','supplier.supplier_id = purchase.supplier_id','LEFT');
    $this->db->join('newspaper_info','newspaper_info.newspaper_info_id = purchase.newspaper_info_id','LEFT');
    $this->db->where("str_to_date(purchase_date,'%d-%m-%Y')  BETWEEN str_to_date('$from_date','%d-%m-%Y') AND str_to_date('$to_date','%d-%m-%Y')");
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }

}
?>
