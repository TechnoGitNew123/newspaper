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
            <h4>Purchase Information</h4>
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
              <h3 class="card-title"><i class="fa fa-list"></i>Purchase Information</h3>
              <div class="card-tools">
                <a href="<?php echo base_url() ?>Transaction/add_purchase" class="btn btn-sm btn-block btn-primary">Add Purchase</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Purchase Date</th>
                  <th>Qty</th>
                  <th>Total Amount</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 0;
                  foreach ($purchase_list as $list) {
                    $i++;
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $list->purchase_date; ?></td>
                    <td><?php echo $list->purchase_qty; ?></td>
                    <td><?php echo $list->purchase_tot_amt; ?></td>
                    <td>
                      <a href="<?php echo base_url(); ?>Transaction/edit_purchase/<?php echo $list->purchase_id; ?>"> <i class="fa fa-edit"></i> </a>
                      <a class="ml-2" target="_blank" href="<?php echo base_url(); ?>Report/purchase_print/<?php echo $list->purchase_id; ?>"> <i class="fa fa-print"></i> </a>
                      <a class="ml-2" href="<?php echo base_url(); ?>Transaction/delete_purchase/<?php echo $list->purchase_id; ?>" onclick="return confirm('Delete this Purchase');"> <i class="fa fa-trash"></i> </a>
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
