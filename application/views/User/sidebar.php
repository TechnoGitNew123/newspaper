<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo base_url(); ?>Admin/dashboard" class="brand-link">
    <!-- <img src="" alt="" class="brand-image img-circle elevation-3"
         style="opacity: .8"> -->
    <span class="brand-text font-weight-light">Paper</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

      <div class="info">
        <a href="#" class="d-block">Admin</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>Admin/dashboard" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Admin/company_information_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Company Information
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Admin/delivery_line_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Delivery Line Information
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Admin/line_boy_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                     Line Boy Information
                  </p>
                </a>
              </li>


              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Admin/newspaper_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Newspaper Information
                  </p>
                </a>
              </li>

              <!-- <li class="nav-item">
                <a href="<?php echo base_url(); ?>Admin/party_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Party Information
                  </p>
                </a>
              </li> -->



              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Admin/scheme_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Scheme  Information
                  </p>
                </a>
              </li>

              <!-- <li class="nav-item">
                <a href="<?php echo base_url(); ?>Admin/bill_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Bill  Information
                  </p>
                </a>
              </li> -->

              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Admin/paper_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Paper Information
                  </p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="<?php echo base_url(); ?>Admin/user_information_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    User Information
                  </p>
                </a>
              </li> -->
              <!-- <li class="nav-item">
                <a href="<?php echo base_url(); ?>Admin/account_information_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Account Information
                  </p>
                </a>
              </li> -->

              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Admin/customer_information_list" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Customer Information
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo base_url(); ?>Admin/change_password" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Change Password
                  </p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Transaction
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">

                <li class="nav-item">
                  <a href="<?php echo base_url(); ?>Admin/expenses_list" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Expenses Information
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?php echo base_url(); ?>Admin/purchase_list" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Purchase Information
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?php echo base_url(); ?>Admin/bill_cycle_list" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                    Bill Cycle Information
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?php echo base_url(); ?>Admin/bill_list" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                   Generate  Bill  Information
                    </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?php echo base_url(); ?>Admin/receipt_list" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                   Receipt
                    </p>
                  </a>
                </li>

                <!-- <li class="nav-item">
                  <a href="<?php echo base_url(); ?>Transactional/delivery_challan_list" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                    Delivery Challan List
                    </p>
                  </a>
                </li>



                <li class="nav-item">
                  <a href="<?php echo base_url(); ?>Transactional/sale_bill_list" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                  Sale Bill List
                    </p>
                  </a>
                </li> -->
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
