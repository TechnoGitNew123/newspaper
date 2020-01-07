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
            <h1>Payment</h1>
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
                <h3 class="card-title">Payment</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" autocomplete="off">
                <div class="card-body row">
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm"  name="payment_no" id="payment_no" value="<?php if(isset($payment_no)){ echo $payment_no; } ?>" title="Payment No." placeholder="Payment No." readonly required>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm"  name="payment_date" id="date1" value="<?php if(isset($payment_date)){ echo $payment_date; } ?>" data-target="#date1" data-toggle="datetimepicker"  title="Date" placeholder="Date" required>
                  </div>
                  <div class="form-group col-md-12 drop-sm">
                    <select class="form-control select2 form-control-sm" data-placeholder="Select Supplier" name="supplier_id" id="supplier_id" title="Select Supplier" style="width: 100%;" required>
                      <option selected="selected" value="">Select Supplier</option>
                      <?php foreach ($supplier_list as $list) { ?>
                        <option value="<?php echo $list->supplier_id; ?>" <?php if(isset($supplier_id) && $list->supplier_id == $supplier_id){ echo 'selected'; } ?>><?php echo $list->supplier_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm"  name="out_amount" id="out_amount" value="<?php if(isset($out_amount)){ echo $out_amount; } ?>" title="Total Outstanding Amount" placeholder="Total Outstanding Amount" readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm"  name="paid_amount" id="paid_amount" value="<?php if(isset($paid_amount)){ echo $paid_amount; } ?>" title="Enter Receipt Amount" placeholder="Enter Receipt Amount">
                  </div>
                  <div class="form-group col-md-3">
                    <label for=""> Payment Mode : </label>
                  </div>
                  <div class="form-group col-md-2">
                    <input type="radio" name="pay_mode" value="Cash" <?php if(isset($pay_mode) && $pay_mode == 'Cash'){ echo 'checked'; } if(!isset($pay_mode)){ echo 'checked'; }  ?>> Cash
                  </div>
                  <div class="form-group col-md-2">
                    <input type="radio" name="pay_mode" value="Cheque" <?php if(isset($pay_mode) && $pay_mode == 'Cheque'){ echo 'checked'; } ?>> Cheque
                  </div>
                  <div class="form-group col-md-3">
                    <input type="radio" name="pay_mode" value="Online Transfer" <?php if(isset($pay_mode) && $pay_mode == 'Online Transfer'){ echo 'checked'; } ?>> Online Transfer
                  </div>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control form-control-sm"  name="cheque_no" id="cheque_no" value="<?php if(isset($cheque_no)){ echo $cheque_no; } ?>" title="Cheque No." placeholder="Cheque No.">
                  </div>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control form-control-sm"  name="cheque_date" id="date2" value="<?php if(isset($cheque_date)){ echo $cheque_date; } ?>" data-target="#date2" data-toggle="datetimepicker" title="Cheque Date" placeholder="Cheque Date">
                  </div>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control form-control-sm"  name="cheque_amt" id="cheque_amt" value="<?php if(isset($cheque_amt)){ echo $cheque_amt; } ?>" title="Cheque Amount" placeholder="Cheque Amount">
                  </div>
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control form-control-sm"  name="payment_ref_no" id="payment_ref_no" value="<?php if(isset($payment_ref_no)){ echo $payment_ref_no; } ?>" title="Enter Ref No" placeholder="Enter Ref No">
                  </div>
                  <div class="form-group col-md-12">
                    <textarea class="form-control form-control-sm" rows="3" name="payment_note" id="payment_note" title="Additional Note" placeholder="Additional Note"><?php if(isset($payment_note)){ echo $payment_note; } ?></textarea>
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
  <script type="text/javascript">
    $('#supplier_id').on('change',function(){
      var supplier_id = $(this).val();
      $.ajax({
        url:'<?php echo base_url(); ?>Transaction/get_supplier_outstanding_amount',
        type: 'POST',
        data: {"supplier_id":supplier_id},
        context: this,
        success: function(result){
          $('#out_amount').val(result);
        }
      });
    });
  </script>
</body>
</html>
