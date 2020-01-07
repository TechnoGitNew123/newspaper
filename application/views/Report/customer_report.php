<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-center mt-2">
            <h1>Customer Report</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Customer Summary</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" autocomplete="off">
                <div class="card-body row">
                  <div class="form-group col-md-4 offset-md-2">
                    <input type="text" class="form-control form-control-sm" name="from_date" id="date1" data-target="#date1" data-toggle="datetimepicker" title="From Date" placeholder="From Date">
                  </div>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control form-control-sm" name="to_date" id="date2" data-target="#date2" data-toggle="datetimepicker" title="To Date" placeholder="To Date">
                  </div>
                  <div class="form-group col-md-4 offset-md-2">
                    <select class="form-control select2 form-control-sm" name="delivery_line_id" id="delivery_line_id" data-placeholder="Select Delivery Line" title="Select Delivery Line">
                      <option selected="selected" value="">Select Delivery Line</option>
                      <?php if(isset($delivery_line)){
                        foreach ($delivery_line as $list) { ?>
                        <option value="<?php echo $list->delivery_line_id; ?>"><?php echo $list->delivery_line_name; ?></option>
                      <?php } } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <select class="form-control select2 form-control-sm" name="customer_id" id="customer_id" data-placeholder="Select Customer" title="Select Customer" >
                      <option selected="selected" value="">Select Customer</option>
                    </select>
                  </div>
                  <div class="form-group col-md-12 text-center">
                    <button type="submit" class="btn btn-sm btn-success px-4">View</button>
                    <a href="" class="btn btn-sm btn-default ml-4 px-4">Cancel</a>
                  </div>
                </div>
              </form>

              <section style="width:100%;" class="invoice p-4" >
                <div class="" id="print_invoice">
                  <?php if(isset($report_type) && $report_type == 'customer_wise'){ ?>
                  <div class="row">
                    <div class="col-12" style="text-align:center; margin-bottom:15px; font-weight:600;">
                      Customer Report
                    </div>
                    <div class="col-12" style="text-align:center; margin-bottom:15px; ">
                      From : <?php echo $from_date; ?> To : <?php echo $to_date; ?>
                    </div>
                    <div class="col-12 table-responsive">
                      <table class="table table-botttom" id="exp_tbl1"  width="100%">
                        <style media="print">
                          .table-responsive table {
                            border-collapse: collapse!important;
                            Width:100%!important;
                          }
                          .table-responsive table, .table-responsive tr, .table-responsive td, .table-responsive th{
                            border: 1px solid #000;
                            margin-left: auto;
                            margin-right: auto;
                            padding: 5px;
                          }
                        </style>
                        <style media="screen">
                          .table-responsive table {
                            border-collapse: collapse!important;
                            Width:100%!important;
                            margin-bottom: 0px!important;
                          }
                          .table-responsive .table thead th{
                            border: 1px solid #000;
                          }
                          .table-responsive table, .table-responsive tr, .table-responsive td, .table-responsive th{
                            border: 1px solid #000;
                            margin-left: auto;
                            margin-right: auto;
                            padding: 5px;
                          }
                        </style>
                        <thead>
                          <th> <p style="text-align:center">Sr. No.</p> </th>
                          <th> <p style="text-align:center">Customer Name</p> </th>
                          <th> <p style="text-align:center">Total Bill Amount</p> </th>
                          <th> <p style="text-align:center">Total Received Amount</p> </th>
                          <th> <p style="text-align:center">Total Balance Amount</p> </th>
                        </thead>
                        <tbody>
                          <?php $i = 0;
                          $cust_list = $this->Transaction_Model->get_customer_by_delivery_line($delivery_line_id);
                          // echo print_r();
                          foreach ($cust_list as $cust_list1) {
                            $cust_id = $cust_list1->customer_id;
                            $tot_bill = $this->Report_Model->get_cust_tot_bill($cust_id,$from_date,$to_date);
                            $tot_received = $this->Report_Model->get_cust_tot_received($cust_id,$from_date,$to_date);
                            $from_date2 = date("Y-m-d h:i:s", strtotime($from_date));
                            $to_date2 = date("Y-m-d h:i:s", strtotime($to_date));
                            $tot_scheme_amt = $this->Report_Model->get_cust_scheme_amt($cust_id,$from_date2,$to_date2);
                            // Calculate Outstanding Amount Up to From_date..
                            $opening_bal = $cust_list1->opening_bal;
                            $advance = $cust_list1->advance;
                            $tot_out_bill = $this->Report_Model->cust_total_bill($customer_id, $from_date);
                            $tot_out_sceme_amt = $this->Report_Model->cust_tot_sceme_amt($customer_id, $from_date2);
                            $tot_out_received = $this->Report_Model->cust_tot_received($customer_id, $from_date);
                            $out_amount = ($tot_out_bill + $opening_bal + $tot_out_sceme_amt) - ($tot_out_received + $advance);
                            // Bill Amount..
                            $bill_amt = $out_amount + $tot_bill + $tot_scheme_amt;
                            // Balance Amount..
                            $balance_amt = $bill_amt - $tot_received;
                            $i++;
                          ?>

                          <tr>
                            <td> <p style="text-align:center"><?php echo $i; ?></p></td>
                            <td> <p style="text-align:center"><?php echo $cust_list1->customer_name; ?></p></td>
                            <td> <p style="text-align:center"><?php echo $bill_amt; ?></p></td>
                            <td> <p style="text-align:center"><?php echo $tot_received; ?></p></td>
                            <td> <p style="text-align:center"><?php echo $balance_amt; ?></p></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                      <br><br>
                    </div>
                  </div>
                <?php } if(isset($report_type) && $report_type == 'customer_detail'){ ?>
                  <?php $cust_data = $this->User_Model->get_info_array('customer_id', $customer_id, 'customer'); ?>
                  <?php
                    $opening_bal = $cust_data[0]['opening_bal'];
                    $advance = $cust_data[0]['advance'];
                    $from_date2 = date("Y-m-d h:i:s", strtotime($from_date));
                    $to_date2 = date("Y-m-d h:i:s", strtotime($to_date));
                    $tot_scheme_amt = $this->Report_Model->get_cust_scheme_amt($customer_id,$from_date2,$to_date2);
                    $tot_out_bill = $this->Report_Model->cust_total_bill($customer_id, $from_date);
                    $tot_out_sceme_amt = $this->Report_Model->cust_tot_sceme_amt($customer_id, $from_date2);
                    $tot_out_received = $this->Report_Model->cust_tot_received($customer_id, $from_date);
                    $out_amount = ($tot_out_bill + $opening_bal + $tot_out_sceme_amt) - ($tot_out_received + $advance);

                    $tot_bill = $this->Report_Model->get_cust_tot_bill($customer_id,$from_date,$to_date);
                    $tot_received = $this->Report_Model->get_cust_tot_received($customer_id,$from_date,$to_date);

                    // Bill Amount..
                    $bill_amt = $out_amount + $tot_bill + $tot_scheme_amt;
                    // Balance Amount.. Closing Amount
                    $balance_amt = $bill_amt - $tot_received;
                 ?>
                  <div class="row">
                    <div class="col-12" style="text-align:center; margin-bottom:15px; font-weight:600;">
                      Customer Report
                    </div>
                    <table style="width:100%;">
                      <tr>
                        <td>
                          <div class="" style="margin-bottom:15px; font-weight:600;">

                            Customer Name : <?php echo $cust_data[0]['customer_name']; ?>
                          </div>
                        </td>
                        <td>
                          <div class="" style="text-align:right; margin-bottom:15px; ">
                            From : <?php echo $from_date; ?> To : <?php echo $to_date; ?>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="" style="margin-bottom:15px; font-weight:600;">
                            Opening Balance : <?php echo $out_amount; ?>
                          </div>
                        </td>
                        <td>
                          <div class="" style="margin-bottom:15px; font-weight:600;">
                            Closing Balance : <?php echo $balance_amt; ?>
                          </div>
                        </td>
                      </tr>
                      <tr valign="top">
                        <td style="width:50%; padding-right:10px;">
                          <div class="" style="margin-bottom:15px; font-weight:600;">
                            Bill Details:
                          </div>
                          <div class="table-responsive">
                            <table class="table table-botttom" id="exp_tbl2"  width="100%">
                              <style media="print">
                                .table-responsive table {
                                  border-collapse: collapse!important;
                                  Width:100%!important;
                                }
                                .table-responsive table, .table-responsive tr, .table-responsive td, .table-responsive th{
                                  border: 1px solid #000;
                                  margin-left: auto;
                                  margin-right: auto;
                                  padding: 5px;
                                }
                              </style>
                              <style media="screen">
                                .table-responsive table {
                                  border-collapse: collapse!important;
                                  Width:100%!important;
                                  margin-bottom: 0px!important;
                                }
                                .table-responsive .table thead th{
                                  border: 1px solid #000;
                                }
                                .table-responsive table, .table-responsive tr, .table-responsive td, .table-responsive th{
                                  border: 1px solid #000;
                                  margin-left: auto;
                                  margin-right: auto;
                                  padding: 5px;
                                }
                              </style>
                              <thead>
                                <th> <p style="text-align:center">Sr. No.</p> </th>
                                <th> <p style="text-align:center">Date</p> </th>
                                <th> <p style="text-align:center">Bill No</p> </th>
                                <th> <p style="text-align:center">Bill Amount</p> </th>
                              </thead>
                              <tbody>
                                <?php $i = 0;
                                foreach ($cust_bill_report as $details) {
                                  $i++;
                                ?>
                                <tr>
                                  <td> <p style="text-align:center"><?php echo $i; ?></p></td>
                                  <td> <p style="text-align:center"><?php echo $details->bill_date; ?></p></td>
                                  <td> <p style="text-align:center"><?php echo $details->bill_no; ?></p></td>
                                  <td> <p style="text-align:center"><?php echo $details->tot_net_amt; ?></p></td>
                                </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                          </div>
                          <div class="" style="margin-bottom:15px; margin-top:15px; font-weight:600;">
                            Scheme Amount : <?php echo $tot_scheme_amt; ?>
                          </div>
                        </td>
                        <td style="width:50%; padding-left:10px;">
                          <div class="" style="margin-bottom:15px; font-weight:600;">
                            Receipt Details:
                          </div>
                          <div class="table-responsive">
                            <table class="table table-botttom" id="exp_tbl2"  width="100%">
                              <style media="print">
                                .table-responsive table {
                                  border-collapse: collapse!important;
                                  Width:100%!important;
                                }
                                .table-responsive table, .table-responsive tr, .table-responsive td, .table-responsive th{
                                  border: 1px solid #000;
                                  margin-left: auto;
                                  margin-right: auto;
                                  padding: 5px;
                                }
                              </style>
                              <style media="screen">
                                .table-responsive table {
                                  border-collapse: collapse!important;
                                  Width:100%!important;
                                  margin-bottom: 0px!important;
                                }
                                .table-responsive .table thead th{
                                  border: 1px solid #000;
                                }
                                .table-responsive table, .table-responsive tr, .table-responsive td, .table-responsive th{
                                  border: 1px solid #000;
                                  margin-left: auto;
                                  margin-right: auto;
                                  padding: 5px;
                                }
                              </style>
                              <thead>
                                <th> <p style="text-align:center">Sr. No.</p> </th>
                                <th> <p style="text-align:center">Date</p> </th>
                                <th> <p style="text-align:center">Reciept No</p> </th>
                                <th> <p style="text-align:center">Amount</p> </th>
                                <th> <p style="text-align:center">Description</p> </th>
                              </thead>
                              <tbody>
                                <?php $i = 0;
                                foreach ($cust_receipt_report as $details) {
                                  $i++;
                                ?>
                                <tr>
                                  <td> <p style="text-align:center"><?php echo $i; ?></p></td>
                                  <td> <p style="text-align:center"><?php echo $details->receipt_date; ?></p></td>
                                  <td> <p style="text-align:center"><?php echo $details->receipt_no; ?></p></td>
                                  <td> <p style="text-align:center"><?php echo $details->rec_amount; ?></p></td>
                                  <td> <p style="text-align:center"><?php echo $details->receipt_note; ?></p></td>
                                </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                          </div>
                        </td>
                      </tr>
                    </table>










                  </div>
                  <?php } ?>
                </div>
                <div class="row no-print">
                  <div class="col-12">
                    <a onclick='printDiv();' class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <script type="text/javascript">

  $('#delivery_line_id').on('change',function(){
    var delivery_line_id = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>Transaction/get_cust_by_delivery_line',
      type: 'POST',
      data: {"delivery_line_id":delivery_line_id},
      context: this,
      success: function(result){
        $('#customer_id').html(result);
      }
    });
  });

  function printDiv()
  {
    var divToPrint=document.getElementById('print_invoice');
    var newWin=window.open('','Print-Window');
    newWin.document.open();
    newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
    newWin.document.close();
    setTimeout(function(){newWin.close();},10);
  }
  </script>
</body>
</html>
