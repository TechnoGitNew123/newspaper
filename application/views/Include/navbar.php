<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <!-- SEARCH FORM -->
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
    <a class="nav-link" href="<?php echo base_url(); ?>User/logout">
      <i class="fas fa-sign-out-alt"></i>
    </a>
  </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
  </ul>
</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo base_url(); ?>User/dashboard" class="brand-link">
    <!-- <img src="" alt="" class="brand-image img-circle elevation-3"
         style="opacity: .8"> -->
    <span class="brand-text font-weight-light">Paper</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block">User</a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>User/dashboard" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>Master <i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>User/company_information_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Company Information</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>User/delivery_line_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Delivery Line Information</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>User/line_boy_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Line Boy Information</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>User/newspaper_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Newspaper Information</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>User/scheme_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Scheme  Information</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>User/customer_information_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Customer Information</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>User/supplier_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Supplier Information</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>User/expense_type_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Expense Type</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>User/change_password" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Change Password</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>Transaction<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>Transaction/expenses_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Expenses Information</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>Transaction/purchase_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Purchase Information</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>Transaction/bill_cycle_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Bill Cycle Information</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>Transaction/bill_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Generate Bill Information</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>Transaction/receipt_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Receipt</p>
              </a>
            </li>
        </ul>
      </li>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
