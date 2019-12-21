<?php
class User_Model extends CI_Model{

  function check_login($email, $password){
    $query = $this->db->select('*')
        ->where('user_mobile', $email)
        ->where('user_password', $password)
        ->from('user')
        ->get();
      $result = $query->result_array();
      return $result;
  }

  public function get_count($id_type,$company_id,$key,$tbl_name){
    $this->db->select($id_type);
    if($key != ''){
      $this->db->where('is_delete', 0);
    }
    $this->db->where('company_id', $company_id);
    $this->db->from($tbl_name);
      $query =  $this->db->get();
    $result = $query->num_rows();
    return $result;
  }

  public function save_data($tbl_name, $data){
    $this->db->insert($tbl_name, $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }

  public function get_list($company_id,$id,$order,$tbl_name){
    $query = $this->db->select('*')
            ->where('company_id', $company_id)
            ->order_by($id, $order)
            ->from($tbl_name)
            ->get();
    $result = $query->result();
    return $result;
  }

  public function get_list1($id,$order,$tbl_name){
    $query = $this->db->select('*')
            ->order_by($id, $order)
            ->from($tbl_name)
            ->get();
    $result = $query->result();
    return $result;
  }

  public function get_info($id_type, $id, $tbl_name){
    $query = $this->db->select('*')
            ->where($id_type, $id)
            ->from($tbl_name)
            ->get();
    $result = $query->result();
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

  public function update_info($id_type, $id, $tbl_name, $data){
    $this->db->where($id_type, $id)
    ->update($tbl_name, $data);
  }

  public function delete_info($id_type, $id, $tbl_name){
    $this->db->where($id_type, $id)
    ->delete($tbl_name);
  }

  public function check_duplication($company_id,$value,$field_name,$table_name){
    $query = $this->db->select($field_name)
      ->where('company_id', $company_id)
      ->where($field_name,$value)
      ->from($table_name)
      ->get();
    $result = $query->result();
    return $result;
  }



  public function get_user_list($company_id){
  $query = $this->db->select('user.*, roll.*')
  ->from('user as user')
  ->where('user.company_id', $company_id)
  ->where('user.is_admin', 0)
   ->join('user_roll as roll', 'user.roll_id = roll.roll_id', 'LEFT')
   ->get();
   $result = $query->result();
   return $result;
}

public function get_delivery_list($company_id){
$query = $this->db->select('delivery_line.*, line.lineboy_name as liboyname,col.lineboy_name as colboyname')
->from('delivery_line as delivery_line')
->where('delivery_line.company_id', $company_id)
 ->join('lineboy as line', 'delivery_line.liboy_id = line.lineboy_id', 'LEFT')
 ->join('lineboy as col', 'delivery_line.collboy_id = col.lineboy_id', 'LEFT')
 ->get();
 $result = $query->result();
 return $result;
}

public function get_delivery_details($company_id, $id){
  $query = $this->db->select('delivery_line.*, line.lineboy_name as liboyname,col.lineboy_name as colboyname')
  ->from('delivery_line as delivery_line')
  ->where('delivery_line.company_id', $company_id)
  ->where('delivery_line.delivery_line_id', $id)
   ->join('lineboy as line', 'delivery_line.liboy_id = line.lineboy_id', 'LEFT')
   ->join('lineboy as col', 'delivery_line.collboy_id = col.lineboy_id', 'LEFT')
   ->get();
   $result = $query->result();
   return $result;
  }


  public function get_newspaper_list($company_id){
  $query = $this->db->select('news.*, papertype.*,language.*')
  ->from('newspaper_info as news')
  ->where('news.company_id', $company_id)
   ->join('papertype as papertype', 'papertype.papertype_id = news.papertype_id', 'LEFT')
   ->join('language as language', 'language.language_id = news.language_id', 'LEFT')
   ->get();
   $result = $query->result();
   return $result;
  }

  public function get_newspaper_details($company_id, $id){
    $query = $this->db->select('news.*, papertype.*,language.*')
    ->from('newspaper_info as news')
    ->where('news.company_id', $company_id)
    ->where('news.newspaper_info_id', $id)
     ->join('papertype as papertype', 'papertype.papertype_id = news.papertype_id', 'LEFT')
     ->join('language as language', 'language.language_id = news.language_id', 'LEFT')
     ->get();
     $result = $query->result();
     return $result;
    }

    public function get_scheme_list($company_id){
    $query = $this->db->select('scheme_info.*, scheme_type.*,newspaper_info.*')
    ->from('scheme_info')
    ->where('scheme_info.company_id', $company_id)
     ->join('scheme_type', 'scheme_type.scheme_type_id = scheme_info.scheme_type_id', 'LEFT')
     ->join('newspaper_info', 'newspaper_info.newspaper_info_id = scheme_info.newspaper_info_id', 'LEFT')
     ->get();
     $result = $query->result();
     return $result;
    }

    public function get_scheme_details($company_id, $id){
      $query = $this->db->select('scheme_info.*, scheme_type.*,newspaper_info.*')
      ->from('scheme_info')
      ->where('scheme_info.company_id', $company_id)
      ->where('scheme_info.scheme_info_id', $id)
       ->join('scheme_type','scheme_type.scheme_type_id = scheme_info.scheme_type_id', 'LEFT')
       ->join('newspaper_info', 'newspaper_info.newspaper_info_id = scheme_info.newspaper_info_id', 'LEFT')
       ->get();
       $result = $query->result();
       return $result;
      }

    


}?>
