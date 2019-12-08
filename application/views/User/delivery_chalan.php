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
  table{
    /* overflow: hidden; */
  }
  th, td { min-width:200px; }
  .sr_no, .td_btn{
    min-width:50px !important;
  }
  .td_w{
    min-width:100px !important;
  }
  html, body, .row{
    overflow-x: hidden;
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
          <div class="col-sm-12 mt-1 text-center">
            <h4>DELIVERY CHALLAN</h4>
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
            <!-- <div class="card-header">
              <h3 class="card-title"><i class="fa fa-list"></i> List Party Information</h3>
              <div class="card-tools">
                <a href="party_information" class="btn btn-sm btn-block btn-primary">Add Party</a>
              </div>
            </div> -->
            <!-- /.card-header -->
            <div class="card-body" >
              <form role="form">
                <div class="card-body row">
                  <div class="form-group col-md-4 offset-md-2">
                    <input type="text" class="form-control form-control-sm" name="" id="" placeholder="Dellivery Challan No.">
                  </div>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control form-control-sm" name=""  placeholder="Dellivery Challan Date">
                  </div>
                  <div class="form-group col-md-8 offset-md-2">
                    <select class="form-control select2 form-control-sm" style="width: 100%;">
                      <option selected="selected">Alabama</option>
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <a href="accessories_information" class="btn btn-sm btn-block btn-primary">Add New Party</a>
                  </div>

                  <!-- <div class="form-group col-md-4 offset-md-2">
                    <input type="text" class="form-control form-control-sm" name="" id="" placeholder="Name of Transporter">
                  </div>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control form-control-sm" name="" id="" placeholder="LR/Docket No.">
                  </div> -->
                </div>
              </form>
              <div class=" w-100 text-right">
                <button id="add_row" class="btn btn-sm btn-primary mb-3 mr-1" width="150px">Add Row</button>
              </div>

              <div class="" style="overflow-x:auto;">

                <table id="myTable" class="table table-bordered table-striped " style="">
                  <thead>
                  <tr>
                    <th class="sr_no">Sr. No.</th>
                    <th>Date</th>
                    <th>Perticulars</th>
                    <th>Plate Size</th>
                    <th>HSN code</th>
                    <th class="td_w">GST</th>
                    <th class="td_w">Qty</th>
                    <th class="td_w">Rate</th>
                    <th class="td_w">Amount</th>
                    <th class="td_btn"></th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td class="sr_no">1</td>
                    <td>
                      <input type="text" class="form-control form-control-sm" name="" id="" placeholder="">
                    </td>
                    <td>
                      <textarea name="name" rows="3" cols="40"></textarea>
                        </td>
                    <td class="td_w">
                      <input type="text" class="form-control form-control-sm" name="" id="" placeholder="">
                    </td>

                    <td>
                      <input type="text" class="form-control form-control-sm" name="" id="" placeholder="">

                    </td>
                    <td class="td_w">
                      <input type="text" class="form-control form-control-sm" name="" id="" placeholder="">
                    </td>
                    <td class="td_w">
                      <input type="text" class="form-control form-control-sm" name="" id="" placeholder="">
                    </td>
                    <td class="td_w">
                      <input type="text" class="form-control form-control-sm" name="" id="" placeholder="">
                    </td>
                    <td class="td_w">
                      <input type="text" class="form-control form-control-sm" name="" id="" placeholder="">
                    </td>
                    <td class="td_btn"></td>
                  </tr>
                </table>
              </div>

                <div class="col-md-6 offset-md-6 ">
                  <div class="form-group row pt-4 float-right">
                    <label for="inputEmail3" class=" col-form-label mr-3">Total Amount : </label>
                    <div class="">
                      <input type="text" class="form-control" id="inputEmail3">
                    </div>
                  </div>
                  <div class="form-group row pt-4 float-right">
                    <label for="inputEmail3" class=" col-form-label mr-3">GST Amount : </label>
                    <div class="">
                      <input type="text" class="form-control" id="inputEmail3">
                    </div>
                  </div>
                  <div class="form-group row pt-4 float-right">
                    <label for="inputEmail3" class=" col-form-label mr-3">Net Amount : </label>
                    <div class="">
                      <input type="text" class="form-control" id="inputEmail3">
                    </div>
                  </div>
                  </div>


              </div>
              <br>
              <div class="col-md-8 offset-md-4">
              <div class="">
                    <button type="submit" class="btn btn-primary  mr-3">Save</button>
                    <button type="submit" class="btn btn-default ">Cancel</button>
                  </div>
                </div>
                <br><br>

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
<script type="text/javascript">
  $('#add_terms').click(function(){
    var terms = $('.select2-selection__choice').val();
    // var res = terms.replace("×", ",");
    // $('#txt_terms').val(res);
    alert(terms);
  });

  $('#add_row').click(function(){
    var row = '<tr><td class="sr_no">1</td>'+
              '<td><input type="text" class="form-control form-control-sm" name="" id="" placeholder=""></td>'+
              '<td><textarea name="name" rows="3" cols="40"></textarea></td>'+
              '<td>  <input type="text" class="form-control form-control-sm" name="" id="" placeholder=""></td>'+
              '<td><input type="text" class="form-control form-control-sm" name="" id="" placeholder=""></td>'+
              '<td><input type="text" class="form-control form-control-sm" name="" id="" placeholder=""></td>'+
              '<td><input type="text" class="form-control form-control-sm" name="" id="" placeholder=""></td>'+
              '<td><input type="text" class="form-control form-control-sm" name="" id="" placeholder=""></td>'+
              '<td class="td_w"><input type="text" class="form-control form-control-sm" name="" id="" placeholder=""></td>'+
              '<td class="td_btn"><a> <i class="fa fa-trash text-danger"></i> </a></td>'+
              '</tr>';
    $('#myTable').append(row);
  });

  $('#myTable').on('click', 'a', function () {
    $(this).closest('tr').remove();
  });
</script>
</body>
</html>
