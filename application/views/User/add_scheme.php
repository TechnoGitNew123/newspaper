<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-center mt-2">
            <h1>Scheme Information</h1>
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
                <h3 class="card-title"> Scheme Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php if(isset($update)){ ?>
                <form action="<?php echo base_url(); ?>User/update_scheme" method="post" enctype="multipart/form-data" role="form">
                  <input type="hidden" name="scheme_info_id" value="<?php echo $scheme_info_id; ?>">
              <?php }else{ ?>
                <form action="<?php echo base_url(); ?>User/save_scheme" method="post" enctype="multipart/form-data" role="form">
              <?php } ?>
                <div class="card-body row">
                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" name="scheme_type_id" id="scheme_type_id" title="Select Scheme Type" style="width: 100%;">
                      <option selected="selected">Select Scheme Type </option>
                      <?php foreach ($scheme_list as $scheme_list1) { ?>
                            <option value="<?php echo $scheme_list1->scheme_type_id; ?>" <?php if(isset($scheme_type_id)){ if($scheme_list1->scheme_type_id == $scheme_type_id){ echo "selected"; } }  ?>><?php echo $scheme_list1->scheme_type_name; ?></option>
                          <?php } ?>
                    </select>
                    </select>
                  </div>

                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" name="newspaper_id" id="newspaper_id" title="Select Newspaper" style="width: 100%;">
                      <option selected="selected">Select  Newspaper </option>
                      <?php foreach ($newspaper_list as $newspaper_list1) { ?>
                            <option value="<?php echo $newspaper_list1->newspaper_info_id; ?>" <?php if(isset($newspaper_info_id)){ if($newspaper_list1->newspaper_info_id == $newspaper_info_id){ echo "selected"; } }  ?>><?php echo $newspaper_list1->newspaper_info_name; ?></option>
                          <?php } ?>
                    </select>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control"  name="scheme_name" id="scheme_name" title="Enter Scheme Name" value="<?php if(isset($scheme_info_name)){ echo $scheme_info_name; } ?>" placeholder="Enter Scheme Name">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control"  name="month_count" id="month_count" title="Month Count " value="<?php if(isset($month_count)){ echo $month_count; } ?>" placeholder="Month Count ">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control"  name="booking_fee" id="booking_fee" title="Scheme Booking Fee" value="<?php if(isset($booking_fee)){ echo $booking_fee; } ?>" placeholder="Scheme Booking Fee">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control"  name="scheme_fee" id="scheme_fee" title="Scheme Monthly Fee" value="<?php if(isset($scheme_fee)){ echo $scheme_fee; } ?>" placeholder="Scheme Monthly Fee">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control"  name="gift_count" id="gift_count" title="Enter Gift Count" value="<?php if(isset($gift_count)){ echo $gift_count; } ?>" placeholder="Enter Gift Count">
                  </div>
                  <div class="form-group col-md-4">
                    Include in Monthly Bill :
                  </div>
                  <div class="form-group col-md-1">
                    <input type="radio" name="is_monthly_bill" id="use_monthly_yes" <?php if(isset($is_monthly_bill) && $is_monthly_bill == 'Yes'){ echo 'checked'; } ?> value="Yes"> Yes
                  </div>
                  <div class="form-group col-md-1">
                    <input type="radio" name="is_monthly_bill" id="use_monthly_no" value="No" <?php if(isset($is_monthly_bill) && $is_monthly_bill == 'No'){ echo 'checked'; } elseif(!isset($is_monthly_bill)){ echo 'checked'; } ?>> No
                  </div>
                  <div class="form-group col-md-12">
                    <div class="form-check">
                      <input type="checkbox" name="scheme_info_status" <?php if(isset($scheme_status)&& $scheme_status!='') { echo 'checked'; } ?> value="deactivate" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label"  for="exampleCheck1">Deactive This Scheme</label>
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
                    <a href="<?php echo base_url(); ?>/User/dashboard" class="btn btn-default ml-4">Cancel</a>
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
    $('#scheme_type_id').on('change', function(){
      var scheme_type =  $(this).find("option:selected").text();
      if(scheme_type == 'Yearly'){
        $('#scheme_fee').val('');
        $('#scheme_fee').attr('readonly',true);
      }
      else{
        $('#scheme_fee').attr('readonly',false);
      }
    });

    $(document).ready(function(){
      var scheme_type =  $('#scheme_type_id').find("option:selected").text();
      if(scheme_type == 'Yearly'){
        $('#scheme_fee').val('');
        $('#scheme_fee').attr('readonly',true);
      }
      else{
        $('#scheme_fee').attr('readonly',false);
      }
    })
  </script>
</body>
</html>
