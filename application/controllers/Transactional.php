<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactional extends CI_Controller{

  // Transaction...


  public function delivery_challan(){
   $this->load->view('Admin/delivery_chalan');
  }

  public function delivery_challan_list(){
   $this->load->view('Admin/delivery_challan_list');
  }

 public function sale_bill(){
   $this->load->view('Admin/sale_bill');
 }
 public function sale_bill_list(){
  $this->load->view('Admin/sale_bill_list');
 }



}
