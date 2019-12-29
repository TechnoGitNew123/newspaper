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
            <h1>Bill Information</h1>
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
                <h3 class="card-title"> Bill Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" autocomplete="off">
                <div class="card-body row">
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm" name="bill_no" id="bill_no" value="<?php if(isset($bill_no)){ echo $bill_no; } ?>" title="Bill No." placeholder="Bill No." readonly required>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm" name="bill_date" id="date1" data-target="#date1" data-toggle="datetimepicker" value="<?php if(isset($bill_date)){ echo $bill_date; } ?>" title="Bill Date" placeholder="Bill Date">
                  </div>
                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" data-placeholder="Select Bill Cycle Name" name="bill_cycle_id" id="bill_cycle_id" title="Select Bill Cycle Name" style="width: 100%;">
                      <option selected="selected" value="">Select Bill Cycle Name </option>
                      <?php foreach ($bill_cycle_list as $list) { ?>
                        <option value="<?php echo $list->bill_cycle_id; ?>" <?php if(isset($bill_cycle_id) && $list->bill_cycle_id == $bill_cycle_id){ echo 'selected'; } ?>><?php echo $list->bill_cycle_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" data-placeholder="Select Delivery Line" name="delivery_line_id" id="delivery_line_id" title="Select Delivery Line" style="width: 100%;">
                      <option selected="selected" value="">Select Delivery Line </option>
                      <?php foreach ($delivery_line_list as $list) { ?>
                        <option value="<?php echo $list->delivery_line_id; ?>" <?php if(isset($delivery_line_id) && $list->delivery_line_id == $delivery_line_id){ echo 'selected'; } ?>><?php echo $list->delivery_line_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" data-placeholder="Select Customer" name="customer_id" id="customer_id" title="Select Customer" style="width: 100%;">
                      <option selected="selected" value="">Select Customer </option>
                      <?php foreach ($customer_list as $list) { ?>
                        <option value="<?php echo $list->customer_id; ?>" <?php if(isset($customer_id) && $list->customer_id == $customer_id){ echo 'selected'; } ?>><?php echo $list->customer_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-12 mb-0"><hr></div>
                  <div class="form-group col-md-12 mb-0">
                  <label for="" > Paper Details : </label>
                  </div>
                  <div id="paper_details" class="form-group col-md-12 row">
                  <?php if(isset($update)){
                    $i = 0;
                    foreach ($paper_list as $paper_list) {

                  ?>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control form-control-sm"  name="" value="<?php echo $paper_list->newspaper_info_name; ?>" title="Paper" placeholder="Paper">
                    <input type="hidden" name="input1[<?php echo $i; ?>][newspaper_info_id]" value="<?php echo $paper_list->newspaper_info_id; ?>">
                  </div>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control form-control-sm"  name="input1[<?php echo $i; ?>][newspaper_qty]" value="<?php echo $paper_list->newspaper_qty; ?>" title="Quantity" placeholder="Quantity">
                  </div>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control form-control-sm"  name="input1[<?php echo $i; ?>][amount]" value="<?php echo $paper_list->amount; ?>" title="Amount" placeholder="Amount">
                  </div>
                  <?php $i++; }  }  ?>
                  </div>

                  <div class="form-group col-md-12 mb-0"><hr></div>
                  <div class="form-group col-md-12 mb-0">
                  <label for="" > Scheme Details : </label>
                  </div>
                  <div id="scheme_details" class="form-group col-md-12 row">
                    <?php if(isset($update)){
                      $j = 0;
                      foreach ($scheme_list as $scheme_list) {
                    ?>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control form-control-sm"  name="" value="<?php echo $scheme_list->scheme_info_name; ?>" title="Paper" placeholder="Paper">
                      <input type="hidden" name="input2[<?php echo $j; ?>][scheme_info_id]" value="<?php echo $scheme_list->scheme_info_id; ?>">
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control form-control-sm"  name="input2[<?php echo $j; ?>][qty]" value="<?php echo $scheme_list->qty; ?>" title="Quantity" placeholder="Quantity">
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control form-control-sm"  name="input2[<?php echo $j; ?>][amount]" value="<?php echo $scheme_list->amount; ?>" title="Amount" placeholder="Amount">
                    </div>
                  <?php $j++; }  }  ?>
                  </div>
                  <div class="form-group col-md-12"><hr></div>

                  <div class="form-group col-md-6 d-none">
                    <input type="text" class="form-control form-control-sm"  name="del_charges" id="del_charges" value="<?php if(isset($del_charges)){ echo $del_charges; } ?>" title="Delivery Charges" placeholder="Delivery Charges">
                  </div>

                  <div class="form-group col-md-6 d-none">
                    <select class="form-control select2 form-control-sm" name="paper_wise" id="paper_wise" title="Per Paper Wise" style="width: 100%;">
                      <option selected="selected">Per Paper Wise </option>
                    </select>
                  </div>


                  <div class="form-group col-md-6">
                    <input type="number" class="form-control form-control-sm" name="tot_gros_amt" id="tot_gros_amt" value="<?php if(isset($tot_gros_amt)){ echo $tot_gros_amt; } ?>" title="Total Gross Amount" placeholder="Total Gross Amount">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control form-control-sm" name="tot_del_charges" id="tot_del_charges" value="<?php if(isset($tot_del_charges)){ echo $tot_del_charges; } ?>" title="Total Delivery Charges " placeholder="Total Delivery Charges ">
                  </div>
                  <div class="form-group col-md-4">
                    <input type="number" class="form-control form-control-sm" name="tot_less_amt" id="tot_less_amt" value="<?php if(isset($tot_less_amt)){ echo $tot_less_amt; } ?>" title="Total Less Amount" placeholder="Total Less Amount">
                  </div>
                  <div class="form-group col-md-4">
                    <input type="number" class="form-control form-control-sm" name="tot_add_amt" id="tot_add_amt" value="<?php if(isset($tot_add_amt)){ echo $tot_add_amt; } ?>" title="Total Add Amount" placeholder="Total Add Amount">
                  </div>
                  <div class="form-group col-md-4">
                    <input type="number" class="form-control form-control-sm" name="tot_net_amt" id="tot_net_amt" value="<?php if(isset($tot_net_amt)){ echo $tot_net_amt; } ?>" title="Total Net Amount" placeholder="Total Net Amount">
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
    $('#customer_id').on('change',function(){
      var customer_id = $(this).val();
      var bill_cycle_id = $('#bill_cycle_id').val();
      $.ajax({
        url:'<?php echo base_url(); ?>Transaction/get_paper_by_customer',
        type: 'POST',
        data: {"customer_id":customer_id,
               "bill_cycle_id" : bill_cycle_id},
        context: this,
        success: function(result){
          var data = JSON.parse(result)
          $('#paper_details').html(data['newspaper']);
          $('#scheme_details').html(data['scheme']);
        }
      });
    });

    $('#tot_gros_amt, #tot_del_charges, #tot_less_amt, #tot_add_amt, #tot_net_amt').on('change',function(){
      // var customer_id = $(this).val();
      // var bill_cycle_id = $('#bill_cycle_id').val();
      // $.ajax({
      //   url:'<?php echo base_url(); ?>Transaction/get_paper_by_customer',
      //   type: 'POST',
      //   data: {"customer_id":customer_id,
      //          "bill_cycle_id" : bill_cycle_id},
      //   context: this,
      //   success: function(result){
      //     var data = JSON.parse(result)
      //     $('#paper_details').html(data['newspaper']);
      //     $('#scheme_details').html(data['scheme']);
      //   }
      // });
    });
  </script>


</body>
</html>
