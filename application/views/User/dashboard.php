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
            <h1>Dashboard</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <hr>
        <h4 class="mb-3">Master Summary</h4>
        <div class="row">
          <!-- left column -->
          <div class="col-md-2 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $del_line_cnt; ?></h3>
                <p>Delivery Line</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo base_url(); ?>User/delivery_line_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-md-2 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $del_lineboy_cnt; ?></h3>
                <p>LineBoy</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo base_url(); ?>User/line_boy_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-md-2 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $npaper_cnt; ?></h3>
                <p>Newspaper</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo base_url(); ?>User/newspaper_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-md-2 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $scheme_cnt; ?></h3>
                <p>Scheme</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo base_url(); ?>User/scheme_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-md-2 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $cust_cnt; ?></h3>
                <p>Customer</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo base_url(); ?>User/customer_information_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-md-2 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $supplier_cnt; ?></h3>
                <p>Supplier</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo base_url(); ?>User/supplier_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <hr>
        <h4 class="mb-3">Transaction Summary</h4>
        <div class="row">
          <!-- left column -->
          <div class="col-md-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $exp_cnt; ?></h3>
                <p>Expenses</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo base_url(); ?>Transaction/expenses_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $purchase_cnt; ?></h3>
                <p>Purchase</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo base_url(); ?>Transaction/purchase_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php echo $bill_cnt; ?></h3>
                <p>Bill</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo base_url(); ?>Transaction/bill_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $receipt_cnt; ?></h3>
                <p>Receipt</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo base_url(); ?>Transaction/receipt_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <!-- /.content-wrapper -->

</body>
</html>
