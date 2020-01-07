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
            <h1>Receipt Report</h1>
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
                <h3 class="card-title">Receipt Summary</h3>
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
                  <div class="form-group col-md-12 text-center">
                    <button type="submit" class="btn btn-sm btn-success px-4">View</button>
                    <a href="" class="btn btn-sm btn-default ml-4 px-4">Cancel</a>
                  </div>
                </div>
              </form>
              <?php //print_r($receipt_report); ?>
              <section style="width:100%;" class="p-4" >
                <?php if(isset($receipt_report)){ ?>
                <div class="invoice" id="print_invoice">
                  <div class="row">
                    <div class="col-12" style="text-align:center; margin-bottom:15px; font-weight:600;">
                      Receipt Report
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
                          <th> <p style="text-align:center">Date</p> </th>
                          <th> <p style="text-align:center">Receipt No.</p> </th>
                          <th> <p style="text-align:center">Receipt Amount</p> </th>
                          <th> <p style="text-align:center">Description</p> </th>
                          <th> <p style="text-align:center">Added By</p> </th>
                        </thead>
                        <tbody>
                        <?php $i = 0;
                        foreach ($receipt_report as $details) {
                          $i++;
                          $addedby = $details->receipt_addedby;
                          $user_data = $this->User_Model->get_info_array('user_id', $addedby, 'user')
                        ?>
                          <tr>
                            <td> <p style="text-align:center"><?php echo $i; ?></p></td>
                            <td> <p style="text-align:center"><?php echo $details->receipt_date; ?></p></td>
                            <td> <p style="text-align:center"><?php echo $details->receipt_no; ?></p></td>
                            <td> <p style="text-align:center">&#8377; <?php echo $details->rec_amount; ?></p></td>
                            <td> <p style="text-align:center"><?php echo $details->receipt_note; ?></p></td>
                            <td> <p style="text-align:center"><?php echo $user_data[0]['user_name']; ?></p></td>
                          </tr>
                        <?php } ?>
                        </tbody>
                      </table>
                      <br><br>
                    </div>
                  </div>
                </div>
                <div class="row no-print">
                  <div class="col-12">
                    <a onclick='printDiv();' class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  </div>
                </div>
                <?php } ?>
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
