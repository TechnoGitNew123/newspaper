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
            <h4>Newspaper Information</h4>
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
              <h3 class="card-title"><i class="fa fa-list"></i>Newspaper Information</h3>
              <div class="card-tools">
                <a href="<?php echo base_url() ?>User/add_newspaper" class="btn btn-sm btn-block btn-primary">Add Newspaper</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Newspaper Name</th>
                  <th>Newspaper Type</th>
                  <th>Language</th>
                  <th> Rate</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
              $i=0;
              foreach ($news_list as $news_list1) {
              $i++;
            ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $news_list1->newspaper_info_name; ?> </td>
                  <td><?php echo $news_list1->papertype_name; ?></td>
                  <td><?php echo $news_list1->language_name; ?></td>
                  <td><?php echo $news_list1->rate; ?></td>
                  <td>
                      <a href="<?php echo base_url(); ?>User/edit_newspaper/<?php echo $news_list1->newspaper_info_id; ?>"> <i class="fa fa-edit"></i> </a>
                      <a class="ml-4" href="<?php echo base_url(); ?>User/delete_newspaper/<?php echo $news_list1->newspaper_info_id; ?>" onclick="return confirm('Delete Confirm');"> <i class="fa fa-trash"></i> </a>
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
