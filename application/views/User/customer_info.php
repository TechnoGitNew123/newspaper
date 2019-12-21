<!DOCTYPE html>
<html>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">



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
              <?php if(isset($update)){ ?>
                <form action="<?php echo base_url(); ?>User/update_customer" method="post" enctype="multipart/form-data" role="form">
                  <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
              <?php }else{ ?>
                <form action="<?php echo base_url(); ?>User/save_customer" method="post" enctype="multipart/form-data" role="form">
              <?php } ?>
                <div class="card-body row">

                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" name="delivery_line_id" id="delivery_line_id" title="Select Delivery Line" style="width: 100%;">
                      <option selected="selected">Select Delivery Line </option>
                      <?php foreach ($delivery_line_list as $d_line1) { ?>
                            <option value="<?php echo $d_line1->delivery_line_id; ?>" <?php if(isset($delivery_line_id)){ if($d_line1->delivery_line_id == $delivery_line_id){ echo "selected"; } }  ?>><?php echo $d_line1->delivery_line_name; ?></option>
                          <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-12">
                    <input type="text" class="form-control"  name="customer_name" id="customer_name" title="Enter Name" placeholder="Enter Name">
                  </div>

                  <div class="form-group col-md-12">
                    <textarea class="form-control" rows="3" name="customer_address" id="customer_address" title="Address" placeholder="Address"></textarea>
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="mobile" id="mobile" title="Mobile No." placeholder="Mobile No.">
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="email" id="email" title="Email" placeholder="Email">
                  </div>

                  <div class="form-group col-md-4">
                    <label for="checkbox"> Bill Send Type : </label>
                  </div>

                  <div class="form-group col-md-2">
                    <div class="form-check">
                      <input type="checkbox" name="bill_send" value="sms" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">SMS</label>
                    </div>
                  </div>
                  <div class="form-group col-md-2">
                    <div class="form-check">
                      <input type="checkbox"  name="bill_send" value="email" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Email</label>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="delivery_charges" id="delivery_charges" title="Enter Delivery Charges" placeholder="Enter Delivery Charges">
                  </div>

                  <!-- <div class="form-group col-md-6">
                    <select class="form-control select2 form-control-sm" title="Paperwise" style="width: 100%;">
                      <option selected="selected">Paperwise </option>
                    </select>
                  </div> -->

                  <div class="form-group  col-md-6 ">
                    <div class="row">
                      <div class="form-check col-md-6 pl-5">
                        <input class="form-check-input" type="radio" name="paperwise" value="paperwise">
                        <label class="form-check-label">Paperwise</label>
                      </div>
                      <div class="form-check col-md-6">
                        <input class="form-check-input" type="radio" name="paperwise" checked="" value="all">
                        <label class="form-check-label">All</label>
                      </div>
                    </div>

                      </div>
                  <div class="form-group col-md-6">
                    <label for="checkbox">Newspaper details  : </label>
                  </div>

                  <div class="form-group col-md-6">
                      <button type="button"  id="add_row" class="btn btn-success px-4">Add More </button>
                  </div>
                  <table id="myTable" class="table table-bordered table-striped tbl_add" style="">
                    <!-- <tbody> -->
                        <tr>
                          <td class="td_w">
                            <select class="form-control select2 form-control-sm" name="input1[0][papertype_id]"  title="Select Type" style="width: 100%;">
                              <option selected="selected">Select Type </option>
                              <?php foreach ($ptype_list as $ptype_list1) { ?>
                                    <option value="<?php echo $ptype_list1->papertype_id; ?>" <?php if(isset($papertype_id)){ if($ptype_list1->papertype_id == $papertype_id){ echo "selected"; } }  ?>><?php echo $ptype_list1->papertype_name; ?></option>
                                  <?php } ?>
                            </select>
                              </td>
                          <td class="td_w">
                            <select class="form-control select2 form-control-sm" name="input1[0][newspaper_info_id]" title="Select Newspaper" style="width: 100%;">
                              <option selected="selected">Select Newspaper </option>
                              <?php foreach ($newspaper_list as $newspaper_list1) { ?>
                                    <option value="<?php echo $newspaper_list1->newspaper_info_id; ?>" <?php if(isset($newspaper_info_id)){ if($newspaper_list1->newspaper_info_id == $newspaper_info_id){ echo "selected"; } }  ?>><?php echo $newspaper_list1->newspaper_info_name; ?></option>
                                  <?php } ?>
                            </select>
                              </td>
                          <td class="td_w">
                            <input type="date" class="form-control datemask" name="input1[0][s_date]" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                        </td>
                        <td class="td_w">
                          <input type="date" class="form-control datemask" name="input1[0][e_date]" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy"  data-mask>
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
                            <select class="form-control select2 form-control-sm" name="input2[0][scheme_info_id]" title="Select Scheme" style="width: 100%;">
                              <option selected="selected">Select Scheme </option>
                              <?php foreach ($scheme_list as $scheme_list1) { ?>
                                    <option value="<?php echo $scheme_list1->scheme_info_id; ?>" <?php if(isset($scheme_info_id)){ if($scheme_list1->scheme_info_id == $delivery_line_id){ echo "selected"; } }  ?>><?php echo $scheme_list1->scheme_info_name; ?></option>
                                  <?php } ?>
                            </select>
                              </td>
                              <td class="td_w">
                                <input type="text" class="form-control form-control-sm " name="input2[0][qty]" value="" id="" title="Enter Qty" placeholder="Enter Qty">
                              </td>
                          <td class="td_w">
                            <input type="date" class="form-control form-control-sm " name="input2[0][s_date]" id="date2" data-target="#date2" data-toggle="datetimepicker"  title="Start Date" placeholder="Start Date">
                          </td>
                          <td class="td_w">
                            <input type="text" class="form-control form-control-sm " name="input2[0][e_date]" id="date3" data-target="#date3" data-toggle="datetimepicker"  title="End Date" placeholder="End Date">
                          </td>
                        </tr>
                  </table>

                  <br> <br> <br>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="opening_bal" id="opening_bal" title="Opening Balance" placeholder="Opening Balance">
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="advance" id="advance" title="Advance If Any" placeholder="Advance If Any">
                  </div>

                  <div class="form-group col-md-6">
                    <div class="form-check">
                      <input type="checkbox" name="customer_status" value="deactivate" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Deactivate This Customer</label>
                    </div>
                  </div>

                </div>

                <!-- /.card-body -->
                <div class="card-footer">
                    <?php if(isset($update)){ ?>
                      <button type="submit" class="btn btn-primary">Update</button>
                    <?php }else{ ?>
                      <button type="submit" class="btn btn-success">Add</button>
                    <?php } ?>
                    <a href="<?php echo base_url(); ?>/User/customer_list" class="btn btn-default ml-4">Cancel</a>
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

<script type="text/javascript">
var i=0;
$('#add_row').click(function(){
  $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
i++;
var row = '';
    row += '<tr ><td class="td_w"><select class="form-control select2 form-control-sm" name="input1['+i+'][papertype_id]" title="Select Type" style="width: 100%;"><option selected="selected">Select Type </option></select></td>';
          row += '<td class="td_w"><select class="form-control select2 form-control-sm" name="input1['+i+'][newspaper_info_id]" title="Select Newspaper" style="width: 100%;"><option selected="selected">Select Newspaper </option></select></td>';
          row += '<td class="td_w"><input type="date" class="form-control datemask" name="input1['+i+'][s_date]" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask></td>';
          row += '<td class="td_w"><input type="date" class="form-control datemask" name="input1['+i+'][e_date]" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask></td>';
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
          row += '<td class="td_w"><input type="date" class="form-control form-control-sm " name="" value="" id="" title="Start Date" placeholder="Start Date"></td>';
          row += '<td class="td_w"><input type="date" class="form-control form-control-sm " name="" value="" id="" title="End Date" placeholder="End Date"></td>';
            row += '</tr>';
$('#myTable2').append(row);
});

</script>
<script src="<?php echo base_url('assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
<script type="text/javascript">

  $('.date').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
</script>
</body>
</html>
