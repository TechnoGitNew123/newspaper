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
            <h1>Change Password</h1>
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
                <h3 class="card-title"> Change Password</h3>
              </div>
              <form role="form" method="post" autocomplete="off">
                <div class="card-body row">
                  <div class="form-group col-md-12">
                    <input type="password" class="form-control"  name="old_password" id="old_password" title="Enter Old Password" placeholder="Enter  Old Password" required>
                  </div>
                  <div class="form-group col-md-12">
                    <input type="password" class="form-control"  name="new_password" id="new_password" title="Enter New Password" placeholder="Enter  New Password" required>
                  </div>
                  <div class="form-group col-md-12">
                    <input type="password" class="form-control"  name="con_password" id="con_password" title="Confirm Password" placeholder="Confirm Password" required>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer ">
                  <div class="col-md-4 offset-md-4">
                    <button type="submit" class="btn btn-success px-4">Save </button>
                    <button type="submit" class="btn btn-default ml-4">Cancel</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
  <?php if($this->session->flashdata('con_error') == 'Confirm_Error'){ ?>
    <script type="text/javascript">
      $(document).ready(function(){
        toastr.error('Password Not Matched.');
      });
    </script>
  <?php } ?>
  <?php if($this->session->flashdata('pas_error') == 'Pass_Error'){ ?>
    <script type="text/javascript">
      $(document).ready(function(){
        toastr.error('Invalid Old Password.');
      });
    </script>
  <?php } ?>

</body>
</html>
