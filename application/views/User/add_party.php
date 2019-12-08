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
            <h1> Party Information</h1>
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
                <h3 class="card-title"> Party Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body row">

                  <div class="form-group col-md-12">
                    <input type="text" class="form-control"  name="" id="" title="Customer Name" placeholder="Customer Name">
                  </div>

                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" title="Select Delivery line " style="width: 100%;">
                      <option selected="selected">Select Delivery line </option>
                    </select>    </div>

                  <div class="form-group col-md-12">
                    <input type="text" class="form-control"  name="" id="" title="Password" placeholder="Password">
                  </div>

                  <div class="form-group col-md-12">
                    <textarea class="form-control" rows="3" name="" id="" placeholder="Address"></textarea>
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="" id="" title="Mobile No." placeholder="Mobile No.">
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="" id="" title="Whats up No." placeholder="Whats up No.">
                  </div>

                  <div class="form-group col-md-12">
                    <input type="text" class="form-control"  name="" id="" title="Email id" placeholder="Email id">
                  </div>
                  <div class="form-group col-md-4">
                    <label class="form-check-label" for="exampleCheck1">Bill Send Type : </label>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Email</label>
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">SMS</label>
                    </div>
                  </div>


                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="" id="" title="Enter Delivery Charges" placeholder="Enter Delivery Charges">
                  </div>
                  <div class="form-group col-md-6">
                    <select class="form-control select2 form-control-sm" title="Paperwise " style="width: 100%;">
                      <option selected="selected">Paperwise </option>
                    </select>    </div>




                </div>

                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success px-4">ADD </button>
                  <button type="submit" class="btn btn-default ml-4">Cancel</button>
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
