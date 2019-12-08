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
            <h1>RECEIPT </h1>
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
                <h3 class="card-title"> Receipt</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body row">

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="" id="" title="Receipt No." placeholder="Receipt No.">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="" id="" title="Date" placeholder="Date">
                  </div>

                  <div class="form-group col-md-6">
                    <select class="form-control select2 form-control-sm" title="Select Delivery Line" style="width: 100%;">
                      <option selected="selected">Select  Delivery Line </option>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <select class="form-control select2 form-control-sm" title="Select Customer" style="width: 100%;">
                      <option selected="selected">Select  Customer </option>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="" id="" title="Total Outstanding Amount" placeholder="Total Outstanding Amount">
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="" id="" title="Enter Receipt Amount" placeholder="Enter Receipt Amount">
                  </div>

                  <div class="form-group">
                    <label for=""> Payment Mode : </label>
                  </div>
                  <div class="form-group col-md-2">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Cash</label>
                    </div>
                  </div>

                  <div class="form-group col-md-2">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Cheque</label>
                    </div>
                  </div>

                  <div class="form-group col-md-3">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Online transfer</label>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <input type="text" class="form-control"  name="" id="" title="Cheque No." placeholder="Cheque No.">
                  </div>

                  <div class="form-group col-md-4">
                    <input type="text" class="form-control"  name="" id="" title="Cheque Date" placeholder="Cheque Date">
                  </div>

                  <div class="form-group col-md-4">
                    <input type="text" class="form-control"  name="" id="" title="Cheque Amount" placeholder="Cheque Amount">
                  </div>

                  <div class="form-group col-md-12">
                    <input type="text" class="form-control"  name="" id="" title="Enter Ref No" placeholder="Enter Ref No">
                  </div>

                  <div class="form-group col-md-12">
                    <textarea class="form-control" rows="3" name="" id="" title="Additional Note" placeholder="Additional Note"></textarea>
                  </div>

                </div>

                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success px-4">Save </button>

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
