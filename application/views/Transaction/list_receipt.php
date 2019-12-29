<!DOCTYPE html>
<html>
<style>
  td{
    padding:2px 10px !important;
  }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 mt-1">
            <h4>RECEIPT INFORMATION</h4>
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
            <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-list"></i>Receipt Information</h3>
              <div class="card-tools">
                <a href="<?php echo base_url() ?>Transaction/add_receipt" class="btn btn-sm btn-block btn-primary">Add receipt</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Receipt No</th>
                  <th>Date</th>
                  <th>Del. Line</th>
                  <th>Customer</th>
                  <th>Total Amount</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 0;
                  foreach ($receipt_list as $list) {
                    $i++;
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $list->receipt_no; ?></td>
                    <td><?php echo $list->receipt_date; ?></td>
                    <td><?php echo $list->delivery_line_name; ?></td>
                    <td><?php echo $list->customer_name; ?></td>
                    <td><?php echo $list->rec_amount; ?></td>
                    <td>
                      <a href="<?php echo base_url(); ?>Transaction/edit_receipt/<?php echo $list->receipt_id; ?>"> <i class="fa fa-edit"></i> </a>
                      <a class="ml-2" target="_blank" href="<?php echo base_url(); ?>Report/receipt/<?php echo $list->receipt_id; ?>"> <i class="fa fa-print"></i> </a>
                      <a class="ml-2" href="<?php echo base_url(); ?>Transaction/delete_receipt/<?php echo $list->receipt_id; ?>" onclick="return confirm('Delete this Expense');"> <i class="fa fa-trash"></i> </a>
                    </td>
                  </tr>
                  <?php } ?>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
</body>
</html>
