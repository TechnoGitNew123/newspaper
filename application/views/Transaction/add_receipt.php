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
            <h1>Receipt</h1>
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
                <h3 class="card-title"> Receipt</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" autocomplete="off">
                <div class="card-body row">
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="receipt_no" id="receipt_no" value="<?php if(isset($receipt_no)){ echo $receipt_no; } ?>" title="Receipt No." placeholder="Receipt No." readonly required>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="receipt_date" id="date1" value="<?php if(isset($receipt_date)){ echo $receipt_date; } ?>" data-target="#date1" data-toggle="datetimepicker"  title="Date" placeholder="Date" required>
                  </div>
                  <div class="form-group col-md-6 drop-lg">
                    <select class="form-control select2 form-control-sm" data-placeholder="Select  Delivery Line" name="delivery_line_id" id="delivery_line_id" title="Select Delivery Line" style="width: 100%;" required>
                      <option selected="selected" value="">Select Delivery Line</option>
                      <?php foreach ($delivery_line_list as $list) { ?>
                        <option value="<?php echo $list->delivery_line_id; ?>" <?php if(isset($delivery_line_id) && $list->delivery_line_id == $delivery_line_id){ echo 'selected'; } ?>><?php echo $list->delivery_line_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6 drop-lg">
                    <select class="form-control select2 form-control-sm" data-placeholder="Select Customer" name="customer_id" id="customer_id" title="Select Customer" style="width: 100%;" required>
                      <option selected="selected" value="">Select Customer</option>
                      <?php foreach ($customer_list as $list) { ?>
                        <option value="<?php echo $list->customer_id; ?>" <?php if(isset($customer_id) && $list->customer_id == $customer_id){ echo 'selected'; } ?>><?php echo $list->customer_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="out_amount" id="out_amount" value="<?php if(isset($out_amount)){ echo $out_amount; } ?>" title="Total Outstanding Amount" placeholder="Total Outstanding Amount">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="rec_amount" id="rec_amount" value="<?php if(isset($rec_amount)){ echo $rec_amount; } ?>" title="Enter Receipt Amount" placeholder="Enter Receipt Amount">
                  </div>

                  <div class="form-group">
                    <label for=""> Payment Mode : </label>
                  </div>
                  <div class="form-group col-md-2">
                    <input type="radio" name="pay_mode" value="Cash" <?php if(isset($pay_mode) && $pay_mode == 'Cash'){ echo 'checked'; } if(!isset($pay_mode)){ echo 'checked'; }  ?>> Cash
                  </div>
                  <div class="form-group col-md-2">
                    <input type="radio" name="pay_mode" value="Cheque" <?php if(isset($pay_mode) && $pay_mode == 'Cheque'){ echo 'checked'; } ?>> Cheque
                  </div>
                  <div class="form-group col-md-3">
                    <input type="radio" name="pay_mode" value="Online transfer" <?php if(isset($pay_mode) && $pay_mode == 'Online Transfer'){ echo 'checked'; } ?>> Online Transfer
                  </div>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control"  name="cheque_no" id="cheque_no" value="<?php if(isset($cheque_no)){ echo $cheque_no; } ?>" title="Cheque No." placeholder="Cheque No.">
                  </div>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control"  name="cheque_date" id="date2" value="<?php if(isset($cheque_date)){ echo $cheque_date; } ?>" data-target="#date2" data-toggle="datetimepicker" title="Cheque Date" placeholder="Cheque Date">
                  </div>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control"  name="cheque_amt" id="cheque_amt" value="<?php if(isset($cheque_amt)){ echo $cheque_amt; } ?>" title="Cheque Amount" placeholder="Cheque Amount">
                  </div>
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control"  name="receipt_ref_no" id="receipt_ref_no" value="<?php if(isset($receipt_ref_no)){ echo $receipt_ref_no; } ?>" title="Enter Ref No" placeholder="Enter Ref No">
                  </div>
                  <div class="form-group col-md-12">
                    <textarea class="form-control" rows="3" name="receipt_note" id="receipt_note" title="Additional Note" placeholder="Additional Note"><?php if(isset($receipt_note)){ echo $receipt_note; } ?></textarea>
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
    $('#delivery_line_id').on('change',function(){
      var delivery_line_id = $(this).val();
      $.ajax({
        url:'<?php echo base_url(); ?>Transaction/get_cust_by_delivery_line',
        type: 'POST',
        data: {"delivery_line_id":delivery_line_id},
        context: this,
        success: function(result){
          $('#customer_id').html(result);
        }
      });
    });
    // Outstanding Amount...
    $('#customer_id').on('change',function(){
      var customer_id = $(this).val();
      $.ajax({
        url:'<?php echo base_url(); ?>Transaction/get_outstanding_amount',
        type: 'POST',
        data: {"customer_id":customer_id},
        context: this,
        success: function(result){
          $('#out_amount').val(result);
          $('#out_amount').attr('readonly',true);
        }
      });
    });

    // $(document).ready(function(){
    //   var delivery_line_id =  $('#delivery_line_id').find("option:selected").val();
    //   $.ajax({
    //     url:'<?php echo base_url(); ?>Transaction/get_cust_by_delivery_line',
    //     type: 'POST',
    //     data: {"delivery_line_id":delivery_line_id},
    //     context: this,
    //     success: function(result){
    //       $('#out_amount').html(result);
    //
    //     }
    //   });
      // alert(delivery_line_id);
    // });
  </script>
</body>
</html>
