<!DOCTYPE html>
<html>
<?php
$page = "add_user";
include('head.php');
?>
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
          <div class="col-sm-12 text-center mt-2">
            <h1>USER INFORMATION</h1>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>



    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8 offset-md-2">
            <!-- general form elements -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">User Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body row">
                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" title="Select Position " style="width: 100%;">
                      <option selected="selected">Select Your Position</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="" id="" title="Enter First Name of User" placeholder="Enter First Name of User">
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="" id="" title="Enter Last Name of User" placeholder="Enter Last Name of User">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="" id="" title="Mobile No." placeholder="Mobile No.">
                  </div>


                  <div class="form-group col-md-6">
                    <input type="password" class="form-control" name="" id="" title="Enter Password" placeholder="Enter Password">
                  </div>
                  <!-- <div class="form-group col-md-12">
                    <input type="password" class="form-control" name="" id="" title="confirm Password" placeholder="Confirm Password">
                  </div> -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success px-4">Add</button>

                  <button type="submit" class="btn btn-default ml-4">Delete</button>
                </div>
              </form>
            </div>

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <!--/.col (right) -->
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
