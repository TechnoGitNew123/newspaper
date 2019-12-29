<?php
class API_Model extends CI_Model{
  public function get_list($company_id,$id,$order,$tbl_name){
    $query = $this->db->select('*')
    ->where('company_id', $company_id)
    ->order_by($id, $order)
    ->from($tbl_name)
    ->get();
    $result = $query->result_array();
    return $result;
  }

  public function get_info_array($id_type, $id, $tbl_name){
    $query = $this->db->select('*')
            ->where($id_type, $id)
            ->from($tbl_name)
            ->get();
    $result = $query->result_array();
    return $result;
  }

  public function UserLogin($email, $password, $imei){
    $this->db->select('*');
    $this->db->where('user_mobile', $email);
    $this->db->where('user_password', $password);
    $this->db->where('user_imei', $imei);
    $this->db->from('user');
    $query = $this->db->get();
    $result = $query->result_array();
    $q = $this->db->last_query();
    return $result;
  }

  public function check_otp($user_id, $otp){
    $this->db->select('user_id');
    $this->db->where('user_id', $user_id);
    $this->db->where('user_otp', $otp);
    $this->db->from('user');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

}
?>
