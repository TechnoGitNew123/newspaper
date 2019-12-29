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
            <h4>Supplier Information</h4>
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
              <h3 class="card-title"><i class="fa fa-list"></i>Supplier Information</h3>
              <div class="card-tools">
                <a href="<?php echo base_url() ?>User/add_supplier" class="btn btn-sm btn-block btn-primary">Add Supplier</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Supplier Name</th>
                  <th>Mobile</th>
                  <th>City</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 0;
                  foreach ($supplier_list as $list) {
                    $i++;
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $list->supplier_name; ?></td>
                    <td><?php echo $list->supplier_mobile; ?></td>
                    <td><?php echo $list->supplier_city; ?></td>
                    <td>
                      <a href="<?php echo base_url(); ?>User/edit_supplier/<?php echo $list->supplier_id; ?>"> <i class="fa fa-edit"></i> </a>
                      <a class="ml-2" href="<?php echo base_url(); ?>User/delete_supplier/<?php echo $list->supplier_id; ?>" onclick="return confirm('Delete this Expense');"> <i class="fa fa-trash"></i> </a>
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
