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
            <h4>Delivery Line Information</h4>
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
              <h3 class="card-title"><i class="fa fa-list"></i>Delivery Line Information</h3>
              <div class="card-tools">
                <a href="<?php echo base_url() ?>User/delivery_line" class="btn btn-sm btn-block btn-primary">Add Delivery line</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Delivery line Name</th>
                  <th>Line Boy</th>
                  <th>Collection Boy</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
              $i=0;
              foreach ($dline_list as $dline_list1) {
              $i++;
            ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $dline_list1->delivery_line_name; ?> </td>
                  <td><?php echo $dline_list1->liboyname; ?></td>
                  <td><?php echo $dline_list1->colboyname; ?></td>
                  <td>
                      <a href="<?php echo base_url(); ?>User/edit_delivery_line/<?php echo $dline_list1->delivery_line_id; ?>"> <i class="fa fa-edit"></i> </a>
                      <a class="ml-4" href="<?php echo base_url(); ?>User/delete_delivery_line/<?php echo $dline_list1->delivery_line_id; ?>" onclick="return confirm('Delete Confirm');"> <i class="fa fa-trash"></i> </a>
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
