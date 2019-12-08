<!DOCTYPE html>
<html>
<?php
  $page = "party_information";
  include('head.php');
?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include('navbar.php'); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include('sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-center mt-2">
            <h1>ACCOUNT INFORMATION</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>



    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12 ">
            <!-- general form elements -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Account Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body row">

                  <div class="form-group col-md-12">
                    <input type="text" class="form-control" name="" id="" title="Account Name" placeholder="Account Name ">
                  </div>
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control" name="" id="" title="Print Name" placeholder="Print Name ">
                  </div>
                  <div class="form-group col-md-6">
                    <select class="form-control select2 form-control-sm" title="Group" style="width: 100%;">
                      <option selected="selected">Select Group</option>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <input type="text" class="form-control" name="" title="Opening Balance"  id="" placeholder="Opening Balance">
                  </div>
                  <div class="form-group col-md-3">
                    <select class="form-control select2 form-control-sm" title="Group" style="width: 100%;">
                      <option selected="selected">Cr</option>
                        <option selected="">Dr</option>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <textarea class="form-control" rows="2" name="company_address" id="company_address" title="Enter Company Address" placeholder="Enter Company Address" required><?php if(isset($company_address)){ echo $company_address; } ?></textarea>
                  </div>
                  <div class="form-group col-md-4">
                    <select class="form-control select2 form-control-sm" style="width: 100%;">
                      <option selected="selected">Select Country</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <select class="form-control select2 form-control-sm" style="width: 100%;">
                      <option selected="selected">Select State</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="company_state" id="company_state" value="<?php if(isset($company_state)){ echo $company_state; } ?>" title="State Code" placeholder="State Code" required>
                  </div>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="company_city" id="company_city" value="<?php if(isset($company_city)){ echo $company_city; } ?>" title="City" placeholder="City" required>
                  </div>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control" name="company_district" id="company_district" value="<?php if(isset($company_district)){ echo $company_district; } ?>" title="District" placeholder="District" required>
                  </div>
                  <div class="form-group col-md-4">
                    <input type="number" class="form-control" name="company_pincode" id="company_pincode" value="<?php if(isset($company_pincode)){ echo $company_pincode; } ?>" title="Pincode" placeholder="Pincode" required>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control" name="company_mob1" id="company_mob1" value="<?php if(isset($company_mob1)){ echo $company_mob1; } ?>" title="Mobile No. 1" placeholder="Mobile No. 1">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="number" class="form-control" name="company_mob2" id="company_mob2" value="<?php if(isset($company_mob2)){ echo $company_mob2; } ?>" title="Mobile No. 2" placeholder="Mobile No. 2">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="email" class="form-control" name="company_email" id="company_email" value="<?php if(isset($company_email)){ echo $company_email; } ?>" title="Email" placeholder="Email" required>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="email" class="form-control" name="company_email" id="company_email" value="<?php if(isset($company_email)){ echo $company_email; } ?>" title="Contact Person" placeholder="Contact Person" required>
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="company_lic1" id="company_lic1" value="<?php if(isset($company_lic1)){ echo $company_lic1; } ?>" title="GST No." placeholder="GST No.">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="company_lic2" id="company_lic2" value="<?php if(isset($company_lic2)){ echo $company_lic2; } ?>" title="Adhar Card No." placeholder="Adhar Card No.">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="company_lic1" id="company_lic1" value="<?php if(isset($company_lic1)){ echo $company_lic1; } ?>" title="VAT No." placeholder="VAT No.">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="company_lic2" id="company_lic2" value="<?php if(isset($company_lic2)){ echo $company_lic2; } ?>" title="U Card No." placeholder="U Card No.">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="company_lic1" id="company_lic1" value="<?php if(isset($company_lic1)){ echo $company_lic1; } ?>"  title="DL No. 1" placeholder="DL No. 1">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="company_lic2" id="company_lic2" value="<?php if(isset($company_lic2)){ echo $company_lic2; } ?>"  title="DL No. 2" placeholder="DL No. 2">
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="company_lic1" id="company_lic1" value="<?php if(isset($company_lic1)){ echo $company_lic1; } ?>" title="Credit Limit" placeholder="Credit Limit">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="company_lic2" id="company_lic2" value="<?php if(isset($company_lic2)){ echo $company_lic2; } ?>" title="Bill Limit" placeholder="Bill Limit">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="company_lic1" id="company_lic1" value="<?php if(isset($company_lic1)){ echo $company_lic1; } ?>"  title="Credit Days For Sale" placeholder="Credit Days For Sale">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="company_lic2" id="company_lic2" value="<?php if(isset($company_lic2)){ echo $company_lic2; } ?>"  title="Credit Days For Purches" placeholder="Credit Days For Purches">
                  </div>
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control" name="company_lic2" id="company_lic2" value="<?php if(isset($company_lic2)){ echo $company_lic2; } ?>"  title="Audit Upto" placeholder="Audit Upto">
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="" id="" title="Birthday On" placeholder="Birthday On ">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="" id="" title="Anniversary On" placeholder="Anniversary On">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="" id="" title="Bank Name" placeholder="Bank Name">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="" id="" title="Bank Account No." placeholder="Bank Account No. ">
                  </div>

                  <div class="form-group col-md-12">
                    <input type="text" class="form-control" name="" id="" title="Cheque Printing Name" placeholder="Cheque Printing Name ">
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Create Account</button>
                  <button type="submit" class="btn btn-default ml-4">Cancel</button>
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
  <?php include('footer.php'); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include('script.php') ?>
</body>
</html>
