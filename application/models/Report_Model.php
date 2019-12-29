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
}
?>
