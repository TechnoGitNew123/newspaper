<!DOCTYPE html>
<html>
<?php
$page = "add_customer";
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
            <h1> Customer Information </h1>
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
          <div class="col-md-10 offset-md-1">
            <!-- general form elements -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"> Customer Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body row">

                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" title="Select Delivery Line" style="width: 100%;">
                      <option selected="selected">Select Delivery Line </option>
                    </select>
                  </div>

                  <div class="form-group col-md-12">
                    <input type="text" class="form-control"  name="" id="" title="Enter Name" placeholder="Enter Name">
                  </div>

                  <div class="form-group col-md-12">
                    <textarea class="form-control" rows="3" name="" id="" title="Address" placeholder="Address"></textarea>
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="" id="" title="Mobile No." placeholder="Mobile No.">
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="" id="" title="Email" placeholder="Email">
                  </div>

                  <div class="form-group col-md-4">
                    <label for="checkbox"> Bill Send Type : </label>
                  </div>
                  <div class="form-group col-md-2">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">SMS</label>
                    </div>
                  </div>
                  <div class="form-group col-md-2">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Email</label>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="" id="" title="Enter Delivery Charges" placeholder="Enter Delivery Charges">
                  </div>

                  <div class="form-group col-md-6">
                    <select class="form-control select2 form-control-sm" title="Paperwise" style="width: 100%;">
                      <option selected="selected">Paperwise </option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="checkbox">Newspaper details  : </label>
                  </div>

                  <div class="form-group col-md-6">
                      <button type="button"  id="add_row" class="btn btn-success px-4">Add More </button>
                  </div>
                  <table id="myTable" class="table table-bordered table-striped tbl_add" style="">
                    <tbody>
                        <tr>
                          <td class="td_w">
                            <select class="form-control select2 form-control-sm" title="Select Type" style="width: 100%;">
                              <option selected="selected">Select Type </option>
                            </select>
                              </td>
                          <td class="td_w">
                            <select class="form-control select2 form-control-sm" title="Select Newspaper" style="width: 100%;">
                              <option selected="selected">Select Newspaper </option>
                            </select>
                              </td>
                          <td class="td_w">
                            <input type="text" class="form-control form-control-sm " name="" value="" id="" title="Start Date" placeholder="Start Date">
                          </td>
                        </tr>
                  </table>
<br><br> <br> <br>
                  <div class="form-group col-md-6">
                    <label for="checkbox">Scheme details  : </label>
                  </div>

                  <div class="form-group col-md-6">
                      <button type="button"  id="add_row2" class="btn btn-success px-4">Add More </button>
                  </div>

                  <table id="myTable2" class="table table-bordered table-striped tbl_add" style="">
                    <tbody>
                        <tr>
                          <td class="td_w">
                            <select class="form-control select2 form-control-sm" title="Select Scheme" style="width: 100%;">
                              <option selected="selected">Select Scheme </option>
                            </select>
                              </td>
                              <td class="td_w">
                                <input type="text" class="form-control form-control-sm " name="" value="" id="" title="Enter Qty" placeholder="Enter Qty">
                              </td>
                          <td class="td_w">
                            <input type="text" class="form-control form-control-sm " name="" value="" id="" title="Start Date" placeholder="Start Date">
                          </td>
                          <td class="td_w">
                            <input type="text" class="form-control form-control-sm " name="" value="" id="" title="End Date" placeholder="End Date">
                          </td>
                        </tr>
                  </table>

                  <br> <br> <br>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="" id="" title="Opening Balance" placeholder="Opening Balance">
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="" id="" title="Advance If Any" placeholder="Advance If Any">
                  </div>

                  <div class="form-group col-md-6">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Deactivate This Customer</label>
                    </div>
                  </div>

                </div>

                <!-- /.card-body -->
                <div class="card-footer">
                  <div class="col-md-6 offset-md-4" >
                    <button type="submit" class="btn btn-success px-4">Save </button>
                    <button type="submit" class="btn btn-default ml-4">Cancel</button>
                  </div>
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
<script type="text/javascript">
var i=0;
$('#add_row').click(function(){
i++;
var row = '';
    row += '<tr ><td class="td_w"><select class="form-control select2 form-control-sm" title="Select Type" style="width: 100%;"><option selected="selected">Select Type </option></select></td>';
          row += '<td class="td_w"><select class="form-control select2 form-control-sm" title="Select Newspaper" style="width: 100%;"><option selected="selected">Select Newspaper </option></select></td>';
          row += '<td class="td_w"><input type="text" class="form-control form-control-sm " name="" value="" id="" title="Start Date" placeholder="Start Date"></td>';
            row += '</tr>';
            row +='<br>';
$('#myTable').append(row);
});
var j=0;
$('#add_row2').click(function(){
j++;
var row = '';
    row += '<tr ><td class="td_w"><select class="form-control select2 form-control-sm" title="Select Type" style="width: 100%;"><option selected="selected">Select Type </option></select></td>';
          row += '<td class="td_w"><select class="form-control select2 form-control-sm" title="Select Newspaper" style="width: 100%;"><option selected="selected">Select Newspaper </option></select></td>';
          row += '<td class="td_w"><input type="text" class="form-control form-control-sm " name="" value="" id="" title="Start Date" placeholder="Start Date"></td>';
            row += '</tr>';
$('#myTable2').append(row);
});
</script>
</body>
</html>
