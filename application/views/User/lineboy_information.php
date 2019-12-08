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
            <h1> Line Boy Information</h1>
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
                <h3 class="card-title"> Line Boy / Collection Boy Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php if(isset($update)){ ?>
                <form action="<?php echo base_url(); ?>User/update_lineboy" method="post" enctype="multipart/form-data" role="form">
                  <input type="hidden" name="lineboy_id" value="<?php echo $lineboy_id; ?>">
              <?php }else{ ?>
                <form action="<?php echo base_url(); ?>User/save_lineboy" method="post" enctype="multipart/form-data" role="form">
              <?php } ?>
                <div class="card-body row">

                  <div class="form-group col-md-12">
                    <input type="text" class="form-control"  name="lineboy_name" id="lineboy_name" value="<?php if(isset($lineboy_name)){ echo $lineboy_name; } ?>" title="Enter Name" placeholder="Enter Name">
                  </div>
                  <!-- <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="" id="" title="Last Name" placeholder="Last Name">
                  </div> -->
                  <div class="form-group col-md-12">
                    <textarea class="form-control" rows="3" name="lineboy_address" id="lineboy_address" title="Address" placeholder="Address"><?php if(isset($lineboy_address)){ echo $lineboy_address; } ?></textarea>
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="mobile1" id="mobile1" value="<?php if(isset($mobile1)){ echo $mobile1; } ?>" title="Mobile No. 1" placeholder="Mobile No. 1">
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="mobile2" id="mobile2" value="<?php if(isset($mobile2)){ echo $mobile2; } ?>" title="Mobile No. 2" placeholder="Mobile No. 2">
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="password" id="password" value="<?php if(isset($password)){ echo $password; } ?>" title="Password" placeholder="Password">
                  </div>

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="con_password" id="con_password" value="<?php if(isset($lineboy_name)){ echo $lineboy_name; } ?>" title="confirm Password" placeholder="confirm Password">
                  </div>



                  <div class="form-group col-md-12">
                    <input type="text" class="form-control"  name="salary" id="salary" title="Salary" value="<?php if(isset($salary)){ echo $salary; } ?>" placeholder="Salary">
                  </div>

                  <div class="form-group col-md-6">
                    <div class="form-check">
                      <input type="checkbox" name="is_lineboy" <?php if(isset($is_lineboy)&& $is_lineboy!='') { echo 'checked'; } ?> value="yes" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label"  for="exampleCheck1">Tick Same As For Collection</label>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <div class="form-check">
                      <input type="checkbox" name="is_collectionboy" <?php if(isset($is_collectionboy)&& $is_collectionboy!='') { echo 'checked'; } ?> value="yes" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label"  for="exampleCheck1">Tick Same As For Lineboy</label>
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
                    <a href="<?php echo base_url(); ?>/User/company_information_list" class="btn btn-default ml-4">Cancel</a>
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

</body>
</html>
