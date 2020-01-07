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
            <h1>Purchase Information</h1>
          </div>
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
                <h3 class="card-title"> Purchase Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" autocomplete="off">
                <div class="card-body row">
                  <div class="form-group col-md-6 ">
                    <input type="text" class="form-control form-control-sm"  name="purchase_vc_no" id="purchase_vc_no" value="<?php if(isset($purchase_vc_no)){ echo $purchase_vc_no; } ?>" title="Vc No." placeholder="Vc No." readonly required>
                  </div>
                  <div class="form-group col-md-6 ">
                    <input type="text" class="form-control form-control-sm"  name="purchase_date"  id="date1" data-target="#date1" data-toggle="datetimepicker" value="<?php if(isset($purchase_date)){ echo $purchase_date; } ?>" title="Date" placeholder="Date" required>
                  </div>
                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" data-placeholder="Select Supplier" name="supplier_id" id="supplier_id" title="Select supplier" style="width: 100%;">
                      <option selected="selected" value="">Select Supplier</option>
                      <?php foreach ($supplier_list as $list) { ?>
                        <option value="<?php echo $list->supplier_id; ?>" <?php if(isset($supplier_id) && $list->supplier_id == $supplier_id){ echo 'selected'; } ?>><?php echo $list->supplier_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" data-placeholder="Select Newspaper" name="newspaper_info_id" id="newspaper_info_id" title="Select Newspaper" style="width: 100%;">
                      <option selected="selected" value="">Select Newspaper</option>
                      <?php foreach ($newspaper_list as $list) { ?>
                        <option value="<?php echo $list->newspaper_info_id; ?>" <?php if(isset($newspaper_info_id) && $list->newspaper_info_id == $newspaper_info_id){ echo 'selected'; } ?>><?php echo $list->newspaper_info_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control form-control-sm"  name="purchase_qty" id="purchase_qty" value="<?php if(isset($purchase_qty)){ echo $purchase_qty; } ?>" title="Enter Qty" placeholder="Enter Qty">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control form-control-sm"  name="return_qty" id="return_qty" value="<?php if(isset($return_qty)){ echo $return_qty; } ?>" title="Return Qty" placeholder="Return Qty">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control form-control-sm"  name="purchase_tot_amt" id="purchase_tot_amt" value="<?php if(isset($purchase_tot_amt)){ echo $purchase_tot_amt; } ?>" title="Total Amount" placeholder="Total Amount">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control form-control-sm"  name="purchase_pay_amt" id="purchase_pay_amt" value="<?php if(isset($purchase_pay_amt)){ echo $purchase_pay_amt; } ?>" title="Enter Payment amount" placeholder="Enter Payment amount">
                  </div>
                  <div class="form-group col-md-12">
                    <textarea name="purchase_note" id="purchase_note" rows="3"  class="form-control form-control-sm" cols="" title="Aditional Notes" placeholder="Aditional Notes"><?php if(isset($purchase_note)){ echo $purchase_note; } ?></textarea>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <?php if(isset($update)){ ?>
                    <button type="submit" class="btn btn-primary px-4">Update </button>
                  <?php } else{ ?>
                    <button type="submit" class="btn btn-success px-4">Add </button>
                  <?php } ?>
                  <a href="" class="btn btn-default ml-4">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
</body>
</html>
