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
            <h1>Delivery Line Information</h1>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div> -->
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
                <h3 class="card-title">Delivery Line Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php if(isset($update)){ ?>
                <form action="<?php echo base_url(); ?>User/update_delivery_line" method="post" enctype="multipart/form-data" role="form">
                  <input type="hidden" name="delivery_line_id" value="<?php echo $delivery_line_id; ?>">
              <?php }else{ ?>
                <form action="<?php echo base_url(); ?>User/save_delivery_line" method="post" enctype="multipart/form-data" role="form">
              <?php } ?>
                <div class="card-body row">
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control"  name="delivery_line_name" id="delivery_line_name" value="<?php if(isset($delivery_line_name)){ echo $delivery_line_name; } ?>" title="Delivery Line Name" placeholder="Delivery Line Name">
                  </div>

                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" name="lineboy_id" id="lineboy_id" title="Select Line Boy" style="width: 100%;">
                      <option selected="selected">Select Line Boy </option>
                      <?php foreach ($lineboy_list as $lineboy_list1) { ?>
                            <option value="<?php echo $lineboy_list1->lineboy_id; ?>" <?php if(isset($liboy_id)){ if($lineboy_list1->lineboy_id == $liboy_id){ echo "selected"; } }  ?>><?php echo $lineboy_list1->lineboy_name; ?></option>
                          <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" name="collboy_id" id="collboy_id" title="Select  Collection Boy " style="width: 100%;">
                      <option selected="selected">Select Collection Boy </option>
                      <?php foreach ($lineboy_list as $lineboy_list1) { ?>
                            <option value="<?php echo $lineboy_list1->lineboy_id; ?>" <?php if(isset($collboy_id)){ if($lineboy_list1->lineboy_id == $collboy_id){ echo "selected"; } }  ?>><?php echo $lineboy_list1->lineboy_name; ?></option>
                          <?php } ?>
                    </select>
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

</body>
</html>
