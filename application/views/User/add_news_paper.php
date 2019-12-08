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
            <h1>Newspaper Information</h1>
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
                <h3 class="card-title"> Newspaper Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php if(isset($update)){ ?>
                <form action="<?php echo base_url(); ?>User/update_newspaper" method="post" enctype="multipart/form-data" role="form">
                  <input type="hidden" name="newspaper_info_id" value="<?php echo $newspaper_info_id; ?>">
              <?php }else{ ?>
                <form action="<?php echo base_url(); ?>User/save_newspaper" method="post" enctype="multipart/form-data" role="form">
              <?php } ?>
                <div class="card-body row">

                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" name="papertype_id" id="papertype_id" title="Select Newspaper Type" style="width: 100%;">
                      <option selected="selected">Select Newspaper Type </option>
                      <?php foreach ($papertype_list as $papertype_list1) { ?>
                            <option value="<?php echo $papertype_list1->papertype_id; ?>" <?php if(isset($papertype_id)){ if($papertype_list1->papertype_id == $papertype_id){ echo "selected"; } }  ?>><?php echo $papertype_list1->papertype_name; ?></option>
                          <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" name="language_id" id="language_id" title="Select Publish Language" style="width: 100%;">
                      <option selected="selected">Select Publish Language</option>
                      <?php foreach ($language_list as $language_list1) { ?>
                        <option value="<?php echo $language_list1->language_id; ?>" <?php if(isset($language_id)){ if($language_list1->language_id == $language_id){ echo "selected"; } }  ?>><?php echo $language_list1->language_name; ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <!-- <div class="form-group col-md-12">
                    <select class="form-control select2 form-control-sm" title="Select Publish Type" style="width: 100%;">
                      <option selected="selected">Select Publish Type</option>
                    </select>
                  </div> -->

                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="newspaper_info_name" id="newspaper_info_name" value="<?php if(isset($newspaper_info_name)){ echo $newspaper_info_name; } ?>" title="Enter Newspaper Name" placeholder="Enter Newspaper Name">
                  </div>


                  <div class="form-group col-md-6">
                    <input type="text" class="form-control"  name="rate" id="rate" value="<?php if(isset($rate)){ echo $rate; } ?>" title="Enter Rate" placeholder="Enter  Rate">
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
