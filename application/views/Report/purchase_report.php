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
            <h1>Purchase Report</h1>
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
                <h3 class="card-title">Purchase Summary</h3>
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
                    <select class="form-control select2 form-control-sm" name="supplier_id" id="supplier_id" data-placeholder="Select Supplier" title="Select Supplier">
                      <option selected="selected" value="">Select Supplier</option>
                      <?php if(isset($supplier_list)){
                        foreach ($supplier_list as $list) { ?>
                        <option value="<?php echo $list->supplier_id; ?>"><?php echo $list->supplier_name; ?></option>
                      <?php } } ?>
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
                  <?php if(isset($report_type) && $report_type == 'all_purchase'){ ?>
                  <div class="row">
                    <div class="col-12" style="text-align:center; margin-bottom:15px; font-weight:600;">
                      Purchase Report
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
                          <th> <p style="text-align:center">Supplier Name</p> </th>
                          <th> <p style="text-align:center">Total Bill Amount</p> </th>
                          <th> <p style="text-align:center">Total Paid Amount</p> </th>
                          <th> <p style="text-align:center">Total Balance Amount</p> </th>
                        </thead>
                        <tbody>
                          <?php $i = 0;
                          foreach ($supplier_list as $details) {
                            $supplier_id = $details->supplier_id;
                            $tot_purchase_amount = $this->Transaction_Model->get_supplier_purchase_amount($supplier_id,$from_date,$to_date);
                            $tot_purchase_pay_amount = $this->Transaction_Model->get_supplier_purchase_pay_amount($supplier_id,$from_date,$to_date);
                            $tot_payment = $this->Transaction_Model->get_supplier_payment_amount($supplier_id,$from_date,$to_date);
                            $payment_amount = $tot_purchase_pay_amount + $tot_payment;
                            $outstanding_amount = $tot_purchase_amount - $payment_amount;
                            if($tot_purchase_amount == ''){ $tot_purchase_amount = 0; }
                            $i++;
                          ?>
                          <tr>
                            <td> <p style="text-align:center"><?php echo $i; ?></p></td>
                            <td> <p style="text-align:center"><?php echo $details->supplier_name; ?></p></td>
                            <td> <p style="text-align:center"><?php echo $tot_purchase_amount; ?></p></td>
                            <td> <p style="text-align:center"><?php echo $payment_amount; ?></p></td>
                            <td> <p style="text-align:center"><?php echo $outstanding_amount; ?></p></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                      <br><br>
                    </div>
                  </div>
                <?php } if(isset($report_type) && $report_type == 'supplier_purchase'){
                  $sup_data = $this->User_Model->get_info_array('supplier_id', $supplier_id, 'supplier');
                ?>
                  <div class="row">
                    <div class="col-12" style="text-align:center; margin-bottom:15px; font-weight:600;">
                      Purchase Report
                    </div>
                    <div class="col-12" style="text-align:center; margin-bottom:15px; ">
                      From : <?php echo $from_date; ?> To : <?php echo $to_date; ?>
                    </div>
                    <div class="col-12" style="margin-bottom:15px; font-weight:600;">
                      Supplier Name : <?php echo $sup_data[0]['supplier_name']; ?>
                    </div>
                    <div class="col-12 table-responsive">
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
                          <th> <p style="text-align:center">Perticulars</p> </th>
                          <th> <p style="text-align:center">Bill Amount</p> </th>
                          <th> <p style="text-align:center">Description</p> </th>
                          <th> <p style="text-align:center">Paid Amount</p> </th>
                          <!-- <th> <p style="text-align:center">Balance Amount</p> </th> -->
                        </thead>
                        <tbody>
                          <?php $i = 0;
                          foreach ($supplier_purchase_report as $details) {
                            $i++;
                          ?>
                          <tr>
                            <td> <p style="text-align:center"><?php echo $i; ?></p></td>
                            <td> <p style="text-align:center"><?php echo $details->purchase_date; ?></p></td>
                            <td> <p style="text-align:center">
                              <?php echo $details->newspaper_info_name.', Qty: '.$details->purchase_qty; ?><br>
                              Return Qty: <?php echo $details->return_qty; ?>
                            </p></td>
                            <td> <p style="text-align:center"><?php echo $details->purchase_tot_amt; ?></p></td>
                            <td> <p style="text-align:center"><?php echo $details->purchase_note; ?></p></td>
                            <td> <p style="text-align:center"><?php echo $details->purchase_pay_amt; ?></p></td>
                            <!-- <td> <p style="text-align:center"><?php echo $details->purchase_out_amt; ?></p></td> -->
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                      <br><br>
                    </div>
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
