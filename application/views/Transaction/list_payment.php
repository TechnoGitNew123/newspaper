<!DOCTYPE html>
<html>
<?php
$page = "party_list";
?>
<style>
  td{
    padding:2px 10px !important;
  }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 mt-1">
            <h4>Payment Information</h4>
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
              <h3 class="card-title"><i class="fa fa-list"></i>Payment Information</h3>
              <div class="card-tools">
                <a href="<?php echo base_url() ?>Transaction/add_payment" class="btn btn-sm btn-block btn-primary">Add Payment</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Payment No.</th>
                  <th>Date</th>
                  <th>Supplier Name</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 0;
                  foreach ($payment_list as $list) {
                    $i++;

                    $sup_data = $this->User_Model->get_info_array('supplier_id', $list->supplier_id, 'supplier');
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $list->payment_no; ?></td>
                    <td><?php echo $list->payment_date; ?></td>
                    <td><?php echo $sup_data[0]['supplier_name']; ?></td>
                    <td><?php echo $list->paid_amount; ?></td>
                    <td>
                      <a href="<?php echo base_url(); ?>Transaction/edit_payment/<?php echo $list->payment_id; ?>"> <i class="fa fa-edit"></i> </a>
                      <a class="ml-2" href="<?php echo base_url(); ?>Transaction/delete_payment/<?php echo $list->payment_id; ?>" onclick="return confirm('Delete this Payment');"> <i class="fa fa-trash"></i> </a>
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
