<!DOCTYPE html>
<html>
<?php
  $page = "party_information";
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
            <h1>ENQUIRY INFORMATION</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>



    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-10 offset-md-1">
            <!-- general form elements -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Enquiry Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body row">

                  <div class="form-group col-md-12">
                    <input type="text" class="form-control" name="" id="" placeholder="Enter Name of Firm">
                  </div>
                  <div class="form-group col-md-12">
                    <textarea class="form-control" rows="3" name="" id="" placeholder="Enter Address"></textarea>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="" id="" placeholder="Enter Area/Village/Town">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="" id="" placeholder="Enter Taluka">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="" id="" placeholder="Enter District">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control" name="" id="" placeholder="Enter Pincode">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control" name="" id="" placeholder="Mobile No. 1">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control" name="" id="" placeholder="Mobile No. 2">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="email" class="form-control" name="" id="" placeholder="Email">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="" id="" placeholder="Website">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="" id="" placeholder="GST No.">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="" id="" placeholder="Pan No.">
                  </div>
                  <div class="form-group col-md-6">
                    <!-- <input type="text" class="form-control" name="" id="" > -->
                    <textarea name="name" rows="4" cols="55" placeholder="Requirment details"></textarea>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="" id="" placeholder="Nature Of Business">
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Add Enquiry</button>
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
