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
            <h1>Expenses Information</h1>
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
                <h3 class="card-title"> Expenses Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" autocomplete="off">
                <div class="card-body row">
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="expense_vc_no" id="expense_vc_no" value="<?php if(isset($expense_vc_no)){ echo $expense_vc_no;} ?>" title="Expenses VCH. No." placeholder="Expenses VCH. No." readonly required>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="expense_date" id="date1" data-target="#date1" data-toggle="datetimepicker" title="Date" value="<?php if(isset($expense_date)){ echo $expense_date; } ?>" placeholder="Date" required>
                  </div>
                  <div class="form-group col-md-12 drop-lg">
                    <select class="form-control select2 form-control-sm" name="expense_type" id="expense_type" title="Select Expenses Type" style="width: 100%;">
                      <option selected="selected">Select Expenses Type </option>
                      <?php foreach ($expense_type_list as $list) { ?>
                        <option value="<?php echo $list->expense_type_id; ?>" <?php if(isset($expense_type) && $list->expense_type_id == $expense_type){ echo 'selected'; } ?>><?php echo $list->expense_type_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control"  name="expense_amount" id="expense_amount" value="<?php if(isset($expense_amount)){ echo $expense_amount; } ?>" title="Enter Amount" placeholder="Enter Amount">
                  </div>
                  <div class="form-group col-md-12">
                    <textarea class="form-control" rows="3" name="expense_notes" id="expense_notes" placeholder="Additional Notes"><?php if(isset($expense_notes)){ echo $expense_notes; } ?></textarea>
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
