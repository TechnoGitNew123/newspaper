<!DOCTYPE html>
<html>

<style>
  td{
    padding:2px 10px !important;
  }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 mt-1">
            <h4>Scheme Information</h4>
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
              <h3 class="card-title"><i class="fa fa-list"></i>Scheme Information</h3>
              <div class="card-tools">
                <a href="<?php echo base_url() ?>User/add_scheme" class="btn btn-sm btn-block btn-primary">Add Scheme</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Scheme Type</th>
                  <th>Name</th>
                  <th>Qty</th>
                  <th>Total Amount</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
              $i=0;
              foreach ($scheme_list as $scheme_list1) {
              $i++;
            ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $scheme_list1->scheme_type_name; ?> </td>
                  <td><?php echo $scheme_list1->scheme_info_name; ?> </td>
                  <td><?php echo $scheme_list1->month_count; ?></td>
                  <td><?php echo $scheme_list1->scheme_fee; ?></td>
                  <td>
                      <a href="<?php echo base_url(); ?>User/edit_scheme/<?php echo $scheme_list1->scheme_info_id; ?>"> <i class="fa fa-edit"></i> </a>
                      <a class="ml-4" href="<?php echo base_url(); ?>User/delete_scheme/<?php echo $scheme_list1->scheme_info_id; ?>" onclick="return confirm('Delete Confirm');"> <i class="fa fa-trash"></i> </a>
                      </td>
                </tr>
                    <?php  }  ?>
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
  <!-- /.content-wrapper -->

</body>
</html>
