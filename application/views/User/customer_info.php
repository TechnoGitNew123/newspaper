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
                  <div class="form-group col-md-12 drop-sm">
                    <select class="form-control select2 form-control-sm" data-placeholder="Select Delivery Line" name="delivery_line_id" id="delivery_line_id" title="Select Delivery Line">
                      <option selected="selected" value="">Select Delivery Line </option>
                      <?php foreach ($delivery_line_list as $d_line1) { ?>
                            <option value="<?php echo $d_line1->delivery_line_id; ?>" <?php if(isset($delivery_line_id)){ if($d_line1->delivery_line_id == $delivery_line_id){ echo "selected"; } }  ?>><?php echo $d_line1->delivery_line_name; ?></option>
                          <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control form-control-sm" name="customer_name" id="customer_name" value="<?php if(isset($customer_name)){ echo $customer_name; } ?>" title="Enter Name" placeholder="Enter Name">
                  </div>
                  <div class="form-group col-md-12">
                    <textarea class="form-control form-control-sm" rows="3" name="customer_address" id="customer_address" title="Address" placeholder="Address"><?php if(isset($customer_address)){ echo $customer_address; } ?></textarea>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control form-control-sm"  name="mobile" id="mobile" value="<?php if(isset($mobile)){ echo $mobile; } ?>" title="Mobile No." placeholder="Mobile No.">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="email" class="form-control form-control-sm"  name="email" id="email" value="<?php if(isset($email)){ echo $email; } ?>" title="Email" placeholder="Email">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="checkbox"> Bill Send Type : </label>
                  </div>
                  <div class="form-group col-md-1">
                    <div class="form-check">
                      <input type="checkbox" name="bill_send_sms" value="sms" <?php if(isset($bill_send_sms) && $bill_send_sms != ''){ echo 'checked';} ?> class="form-check-input">
                      <label class="form-check-label" for="exampleCheck1">SMS</label>
                    </div>
                  </div>
                  <div class="form-group col-md-1">
                    <div class="form-check">
                      <input type="checkbox"  name="bill_send_email" value="email" <?php if(isset($bill_send_email) && $bill_send_email != ''){ echo 'checked';} ?> class="form-check-input">
                      <label class="form-check-label">Email</label>
                    </div>
                  </div>
                  <div class="form-group col-md-6"></div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm"  name="delivery_charges" id="delivery_charges" value="<?php if(isset($delivery_charges)){ echo $delivery_charges; } ?>" title="Enter Delivery Charges" placeholder="Enter Delivery Charges">
                  </div>
                  <div class="form-group col-md-2 ml-4">
                    <input class="form-check-input" type="radio" name="paperwise" <?php if(isset($paperwise) && $paperwise == 'paperwise'){ echo 'checked';} ?> value="paperwise">
                    <label class="form-check-label">Paperwise</label>
                  </div>
                  <div class="form-group col-md-1">
                    <input class="form-check-input" type="radio" name="paperwise" <?php if(isset($paperwise) && $paperwise == 'all'){ echo 'checked';} if(!isset($paperwise)){echo 'checked';} ?>  value="all">
                    <label class="form-check-label">All</label>
                  </div>

                  <div class="form-group col-md-12"> <hr> </div>
                  <div class="form-group col-md-6">
                    <label for="checkbox">Newspaper details  : </label>
                  </div>
                  <div class="form-group col-md-6">
                      <button type="button"  id="add_row" class="btn btn-sm btn-primary px-4">Add More </button>
                  </div>
                  <table id="myTable1" class="table table-bordered mb-4 tbl_cust1">
                    <?php
                    if(isset($pdetails)){
                      $i = 0;
                      foreach ($pdetails as $p_details) {
                    ?>
                    <input type="hidden" name="input1[<?php echo $i; ?>][customer_pdetails_id]" value="<?php echo $p_details->customer_pdetails_id; ?>">
                    <tr>
                      <td>
                        <select class="form-control form-control-sm" name="input1[<?php echo $i; ?>][papertype_id]"  title="Select Type">
                          <option selected="selected">Select Type </option>
                          <?php foreach ($ptype_list as $ptype_list1) { ?>
                            <option value="<?php echo $ptype_list1->papertype_id; ?>" <?php if(isset($p_details->papertype_id)){ if($ptype_list1->papertype_id == $p_details->papertype_id){ echo "selected"; } }  ?>><?php echo $ptype_list1->papertype_name; ?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td>
                        <select class="form-control form-control-sm" name="input1[<?php echo $i; ?>][newspaper_info_id]" title="Select Newspaper">
                          <option selected="selected">Select Newspaper </option>
                          <?php foreach ($newspaper_list as $newspaper_list1) { ?>
                            <option value="<?php echo $newspaper_list1->newspaper_info_id; ?>" <?php if(isset($p_details->newspaper_info_id)){ if($newspaper_list1->newspaper_info_id == $p_details->newspaper_info_id){ echo "selected"; } }  ?>><?php echo $newspaper_list1->newspaper_info_name; ?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td>
                        <input type="text" class="form-control form-control-sm " name="input1[<?php echo $i; ?>][newspaper_qty]" value="<?php echo $p_details->newspaper_qty; ?>" title="Enter Qty" placeholder="Enter Qty">
                      </td>
                      <td>
                        <input type="date" class="form-control form-control-sm " name="input1[<?php echo $i; ?>][s_date]" value="<?php echo date("Y-m-d", strtotime($p_details->s_date)); ?>">
                      </td>
                      <td>
                        <input type="date" class="form-control form-control-sm " name="input1[<?php echo $i; ?>][e_date]" value="<?php echo date("Y-m-d", strtotime($p_details->e_date)); ?>">
                      </td>
                      <td><?php if($i > 0){ ?><a><i class="fa fa-trash text-danger"></i></a><?php } ?></td>
                    </tr>
                    <?php $i++; } } else{ ?>
                      <tr>
                        <td>
                          <select class="form-control form-control-sm" name="input1[0][papertype_id]"  title="Select Type">
                            <option selected="selected">Select Type </option>
                            <?php foreach ($ptype_list as $ptype_list1) { ?>
                              <option value="<?php echo $ptype_list1->papertype_id; ?>" <?php if(isset($papertype_id)){ if($ptype_list1->papertype_id == $papertype_id){ echo "selected"; } }  ?>><?php echo $ptype_list1->papertype_name; ?></option>
                            <?php } ?>
                          </select>
                        </td>
                        <td>
                          <select class="form-control form-control-sm" name="input1[0][newspaper_info_id]" title="Select Newspaper">
                            <option selected="selected">Select Newspaper </option>
                            <?php foreach ($newspaper_list as $newspaper_list1) { ?>
                              <option value="<?php echo $newspaper_list1->newspaper_info_id; ?>" <?php if(isset($newspaper_info_id)){ if($newspaper_list1->newspaper_info_id == $newspaper_info_id){ echo "selected"; } }  ?>><?php echo $newspaper_list1->newspaper_info_name; ?></option>
                            <?php } ?>
                          </select>
                        </td>
                        <td>
                          <input type="text" class="form-control form-control-sm " name="input1[0][newspaper_qty]" value="" title="Enter Qty" placeholder="Enter Qty">
                        </td>
                        <td>
                          <input type="date" class="form-control form-control-sm " name="input1[0][s_date]">
                        </td>
                        <td>
                          <input type="date" class="form-control form-control-sm " name="input1[0][e_date]">
                        </td>
                        <td></td>
                      </tr>
                    <?php } ?>
                  </table>

                  <div class="form-group col-md-12"> <hr> </div>
                  <div class="form-group col-md-6">
                    <label for="checkbox">Scheme details  : </label>
                  </div>

                  <div class="form-group col-md-6">
                      <button type="button"  id="add_row2" class="btn btn-sm btn-primary px-4">Add More </button>
                  </div>

                  <table id="myTable2" class="table table-bordered mb-4 tbl_cust">
                    <?php
                    if(isset($schdetails)){
                      $j = 0;
                      foreach ($schdetails as $s_details) {
                    ?>
                    <input type="hidden" name="input2[<?php echo $j; ?>][customer_schdetails_id]" value="<?php echo $s_details->customer_schdetails_id; ?>">
                    <tr>
                      <td>
                        <select class="form-control select2 form-control-sm scheme_info_id" name="input2[<?php echo $j; ?>][scheme_info_id]" title="Select Scheme">
                          <option selected="selected">Select Scheme </option>
                          <?php foreach ($scheme_list as $scheme_list1) { ?>
                            <option value="<?php echo $scheme_list1->scheme_info_id; ?>" <?php if(isset($s_details->scheme_info_id)){ if($scheme_list1->scheme_info_id == $s_details->scheme_info_id){ echo "selected"; } }  ?>><?php echo $scheme_list1->scheme_info_name; ?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td>
                        <input type="text" class="form-control form-control-sm qty" name="input2[<?php echo $j; ?>][qty]" value="<?php echo $s_details->qty; ?>" id="" title="Enter Qty" placeholder="Enter Qty">
                        <input type="text" style="display:none;" class="form-control form-control-sm mt-1 sch_amount" name="input2[<?php echo $j; ?>][sch_amount]" value="<?php echo $s_details->sch_amount; ?>" id="" title="Amount" placeholder="Amount">
                      </td>
                      <td>
                        <input type="date" class="form-control form-control-sm " name="input2[<?php echo $j; ?>][s_date]" value="<?php echo date("Y-m-d", strtotime($s_details->s_date)); ?>" title="Start Date" placeholder="Start Date">
                      </td>
                      <td>
                        <input type="date" class="form-control form-control-sm" name="input2[<?php echo $j; ?>][e_date]" value="<?php echo date("Y-m-d", strtotime($s_details->e_date)); ?>" title="End Date" placeholder="End Date">
                      </td>
                      <td><?php if($j > 0){ ?><a><i class="fa fa-trash text-danger"></i></a><?php } ?></td>
                    </tr>
                    <?php $j++; } } else{ ?>

                    <tr>
                      <td>
                        <select class="form-control select2 form-control-sm scheme_info_id" name="input2[0][scheme_info_id]" title="Select Scheme">
                          <option selected="selected">Select Scheme </option>
                          <?php foreach ($scheme_list as $scheme_list1) { ?>
                            <option value="<?php echo $scheme_list1->scheme_info_id; ?>" <?php if(isset($scheme_info_id)){ if($scheme_list1->scheme_info_id == $delivery_line_id){ echo "selected"; } }  ?>><?php echo $scheme_list1->scheme_info_name; ?></option>
                          <?php } ?>
                        </select>
                      </td>
                      <td class="ddd">
                        <input type="text" class="form-control form-control-sm qty" name="input2[0][qty]" value="" id="" title="Enter Qty" placeholder="Enter Qty">
                        <input type="text" style="display:none;" class="form-control form-control-sm mt-1 sch_amount" name="input2[0][sch_amount]" id="" title="Amount" placeholder="Amount">
                      </td>
                      <td>
                        <input type="date" class="form-control form-control-sm " name="input2[0][s_date]" title="Start Date" placeholder="Start Date">
                      </td>
                      <td>
                        <input type="date" class="form-control form-control-sm" name="input2[0][e_date]" title="End Date" placeholder="End Date">
                      </td>
                      <td></td>
                    </tr>
                    <?php } ?>
                  </table>

                  <div class="form-group col-md-12"> <hr> </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control form-control-sm"  name="opening_bal" id="opening_bal" value="<?php if(isset($opening_bal)){ echo $opening_bal; } ?>" title="Opening Balance" placeholder="Opening Balance">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="hidden" class="form-control form-control-sm"  name="advance" id="advance" value="<?php if(isset($advance)){ echo $advance; } ?>" title="Advance If Any" placeholder="Advance If Any">
                  </div>
                  <div class="form-group col-md-6">
                    <div class="form-check">
                      <input type="checkbox" name="customer_status" value="deactivate" <?php if(isset($customer_status) && $customer_status == 'deactivate'){ echo 'checked';} ?> class="form-check-input" id="exampleCheck1">
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
  <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
  <script type="text/javascript">
    var mobile1 = $('#mobile').val();
    $('#mobile').on('change',function(){
      var mobile = $(this).val();
      $.ajax({
        url:'<?php echo base_url(); ?>User/check_duplication',
        type: 'POST',
        data: {"column_name":"mobile",
               "column_val":mobile,
               "table_name":"customer"},
        context: this,
        success: function(result){
          if(result > 0){
            $('#mobile').val(mobile1);
            toastr.error(mobile+' Mobile No Exist.');
          }
        }
      });
    });
    $("#myTable2").on("change", "select.scheme_info_id", function(){
      var scheme_info_id = $(this).val();
      $.ajax({
          url:'<?php echo base_url(); ?>User/check_is_yearly_scheme',
          type: 'POST',
          data: {"scheme_info_id":scheme_info_id},
          context: this,
          success: function(result){
            if(result == 2){
              var a = $(this).closest('tr').find('.sch_amount').css('display','block');
            }
          }
      });
    });

    $(document).ready(function(){
      $('.scheme_info_id').each(function(){
        var scheme_info_id =  $(this).find("option:selected").val();
        $.ajax({
            url:'<?php echo base_url(); ?>User/check_is_yearly_scheme',
            type: 'POST',
            data: {"scheme_info_id":scheme_info_id},
            context: this,
            success: function(result){
              if(result == 2){
                var a = $(this).closest('tr').find('.sch_amount').css('display','block');
              }
            }
        });
      });
    });


    <?php if(isset($update)){ ?> var i=<?php echo $i-1; ?>;  <?php } else{ ?> var i=0; <?php } ?>
    $('#add_row').click(function(){
      $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
    i++;
    var row = '<tr>'+
              '<td>'+
                '<select class="form-control select2 form-control-sm" name="input1['+i+'][papertype_id]"  title="Select Type">'+
                  '<option selected="selected">Select Type </option>'+
                  <?php foreach ($ptype_list as $ptype_list1) { ?>
                    '<option value="<?php echo $ptype_list1->papertype_id; ?>" <?php if(isset($papertype_id)){ if($ptype_list1->papertype_id == $papertype_id){ echo "selected"; } }  ?>><?php echo $ptype_list1->papertype_name; ?></option>'+
                  <?php } ?>
                '</select>'+
              '</td>'+
              '<td>'+
                '<select class="form-control select2 form-control-sm" name="input1['+i+'][newspaper_info_id]" title="Select Newspaper">'+
                  '<option selected="selected">Select Newspaper </option>'+
                  <?php foreach ($newspaper_list as $newspaper_list1) { ?>
                    '<option value="<?php echo $newspaper_list1->newspaper_info_id; ?>" <?php if(isset($newspaper_info_id)){ if($newspaper_list1->newspaper_info_id == $newspaper_info_id){ echo "selected"; } }  ?>><?php echo $newspaper_list1->newspaper_info_name; ?></option>'+
                  <?php } ?>
                '</select>'+
              '</td>'+
              '<td>'+
                '<input type="text" class="form-control form-control-sm " name="input1['+i+'][newspaper_qty]" value="" id="" title="Enter Qty" placeholder="Enter Qty">'+
              '</td>'+
              '<td>'+
                '<input type="date" class="form-control form-control-sm " name="input1['+i+'][s_date]">'+
              '</td>'+
              '<td>'+
                '<input type="date" class="form-control form-control-sm " name="input1['+i+'][e_date]">'+
              '</td>'+
              '<td><a><i class="fa fa-trash text-danger"></i></a></td>'+
            '</tr>';
    $('#myTable1').append(row);
    });

    $('#myTable1').on('click', 'a', function () {
      $(this).closest('tr').remove();
    });

    <?php if(isset($update)){ ?> var j=<?php echo $j-1; ?>;  <?php } else{ ?> var j=0; <?php } ?>
    var j=0;
    $('#add_row2').click(function(){
      j++;
      var row = '<tr>'+
                '<td>'+
                  '<select class="form-control select2 form-control-sm scheme_info_id" name="input2['+j+'][scheme_info_id]" title="Select Scheme">'+
                    '<option selected="selected">Select Scheme </option>'+
                    <?php foreach ($scheme_list as $scheme_list1) { ?>
                      '<option value="<?php echo $scheme_list1->scheme_info_id; ?>" <?php if(isset($scheme_info_id)){ if($scheme_list1->scheme_info_id == $delivery_line_id){ echo "selected"; } }  ?>><?php echo $scheme_list1->scheme_info_name; ?></option>'+
                    <?php } ?>
                  '</select>'+
                '</td>'+
                '<td>'+
                  '<input type="text" class="form-control form-control-sm qty" name="input2['+j+'][qty]" value="" id="" title="Enter Qty" placeholder="Enter Qty">'+
                  '<input type="text" style="display:none;" class="form-control form-control-sm mt-1 sch_amount" name="input2['+j+'][sch_amount]" id="" title="Amount" placeholder="Amount">'+
                '</td>'+
                '<td>'+
                  '<input type="date" class="form-control form-control-sm " name="input2['+j+'][s_date]" title="Start Date" placeholder="Start Date">'+
                '</td>'+
                '<td>'+
                  '<input type="date" class="form-control form-control-sm" name="input2['+j+'][e_date]" title="End Date" placeholder="End Date">'+
                '</td>'+
                '<td><a><i class="fa fa-trash text-danger"></i></a></td>'+
              '</tr>';
      $('#myTable2').append(row);
    });

    $('#myTable2').on('click', 'a', function () {
      $(this).closest('tr').remove();
    });
  </script>
</body>
</html>
