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
            <h1>BILL CYCLE INFORMATION</h1>
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
                <h3 class="card-title"> Bill Cycle Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" autocomplete="off">
                <div class="card-body row">
                  <div class="form-group col-md-12 ">
                    <input type="text" class="form-control" name="bill_cycle_name" id="bill_cycle_name" value="<?php if(isset($bill_cycle_name)){ echo $bill_cycle_name; } ?>" title="Bill Cycle Name" placeholder="Bill Cycle Name" required>
                  </div>
                  <div class="form-group col-md-6 ">
                    <input type="text" class="form-control" name="bill_cycle_from" id="date1" value="<?php if(isset($bill_cycle_from)){ echo $bill_cycle_from; } ?>" data-target="#date1" data-toggle="datetimepicker" title="From Date" placeholder="From Date" required>
                  </div>
                  <div class="form-group col-md-6 ">
                    <input type="text" class="form-control" name="bill_cycle_to" id="date2" value="<?php if(isset($bill_cycle_to)){ echo $bill_cycle_to; } ?>" data-target="#date2" data-toggle="datetimepicker" title="To Date" placeholder="To Date" required>
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
