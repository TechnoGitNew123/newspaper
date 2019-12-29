<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-center mt-2">
            <h1>Expenses Type</h1>
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
                <h3 class="card-title">Expenses Type</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" autocomplete="off">
                <div class="card-body row">
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control" name="expense_type_name" id="expense_type_name" value="<?php if(isset($expense_type_name)){ echo $expense_type_name; } ?>" placeholder="Enter Expense Type">
                  </div>
                </div>
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
      </div><!-- /.container-fluid -->
    </section>
  </div>
</body>
</html>
