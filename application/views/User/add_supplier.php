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
            <h1>Supplier</h1>
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
                <h3 class="card-title">Supplier</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" autocomplete="off">
                <div class="card-body row">
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control" name="supplier_name" id="supplier_name" value="<?php if(isset($supplier_name)){ echo $supplier_name; } ?>" placeholder="Supplier Name">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control" name="supplier_mobile" id="supplier_mobile" value="<?php if(isset($supplier_mobile)){ echo $supplier_mobile; } ?>" placeholder="Mobile No.">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="email" class="form-control" name="supplier_email" id="supplier_email" value="<?php if(isset($supplier_email)){ echo $supplier_email; } ?>" placeholder="Email">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="supplier_city" id="supplier_city" value="<?php if(isset($supplier_city)){ echo $supplier_city; } ?>" placeholder="City">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control" name="supplier_op_bal" id="supplier_op_bal" value="<?php if(isset($supplier_op_bal)){ echo $supplier_op_bal; } ?>" placeholder="Opening Balance">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="checkbox" style="width:18px; height:18px;" name="supplier_status" id="supplier_status" value="deactive" <?php if(isset($supplier_status) && $supplier_status == 'deactive'){ echo 'checked'; } ?>>
                    Deactive this Supplier.
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
