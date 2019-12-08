<!DOCTYPE html>
<html>
<?php
$page = "party_list";
include('head.php');
?>
<style>
  td{
    padding:2px 10px !important;
  }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <?php include('navbar.php'); ?>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <?php include('sidebar.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 mt-1">
            <h4>ACCOUNT INFORMATION</h4>
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
              <h3 class="card-title"><i class="fa fa-list"></i> List Account Information</h3>
              <div class="card-tools">
                <a href="<?php echo base_url() ?>Admin/add_account" class="btn btn-sm btn-block btn-primary">Add Account</a>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-2">
                <select class="form-control select2 form-control-sm" title="Account Name" style="width: 100%;">
                  <option selected="selected">Account Name</option>
                </select>
                </div>
              <div class="form-group col-sm-2">
                <input type="text" class="form-control form-control-sm" name="" id="" title="Account No" placeholder="Account No.">
              </div>
              <div class="form-group col-sm-2">
                <select class="form-control select2 form-control-sm" title="Select Group " style="width: 100%;">
                  <option selected="selected">Select Group</option>
                </select>
                </div>
              <div class="form-group col-sm-2">
                <input type="text" class="form-control form-control-sm" name="" id="" title="Group No" placeholder="Group No.">
              </div>
              <div class="form-group col-sm-2">
                <select class="form-control select2 form-control-sm" title="Select City " style="width: 100%;">
                  <option selected="selected">Select City</option>
                </select>
                  </div>
              <div class="form-group col-sm-2">
                <input type="text" class="form-control form-control-sm" name="" id="" title="City" placeholder="City ">
              </div>
              <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-success">Search </button>
                <button type="submit" class="btn btn-default ml-4">Locate</button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Name</th>
                  <th>Group</th>
                  <th>Address</th>
                  <th>City</th>
                  <th>Phone No.</th>
                  <th>Mobile No.</th>
                  <th>Contact Person</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>ABC </td>
                  <td>Expenses</td>
                  <td>Rajarampuri Kolhapur</td>
                  <td>Kolhapur</td>
                  <td>9876543210</td>
                  <td>9876543210</td>
                  <td>Abc</td>

                  <td>
                    <a href=""> <i class="fa fa-edit"></i> </a>
                    <a class="ml-4" href=""> <i class="fa fa-trash"></i> </a>
                  </td>
                </tr>
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
  <?php include('footer.php'); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include('script.php') ?>
</body>
</html>
