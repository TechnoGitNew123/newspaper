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
            <h4> Line Boy Information</h4>
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
              <h3 class="card-title"><i class="fa fa-list"></i> Line Boy Information</h3>
              <div class="card-tools">
                <a href="<?php echo base_url() ?>User/line_boy" class="btn btn-sm btn-block btn-primary">Add Line Boy</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th> Line Boy Name</th>
                  <th>Mobile No.</th>
                  <th>Address</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
              $i=0;
              foreach ($line_boy_list as $line_boy_list1) {
              $i++;
            ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $line_boy_list1->lineboy_name; ?> </td>
                  <td><?php echo $line_boy_list1->mobile1; ?></td>
                    <td><?php echo $line_boy_list1->lineboy_address; ?></td>
                    <td>
                        <a href="<?php echo base_url(); ?>User/edit_lineboy/<?php echo $line_boy_list1->lineboy_id; ?>"> <i class="fa fa-edit"></i> </a>
                        <a class="ml-4" href="<?php echo base_url(); ?>User/delete_lineboy/<?php echo $line_boy_list1->lineboy_id; ?>" onclick="return confirm('Delete Confirm');"> <i class="fa fa-trash"></i> </a>
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
