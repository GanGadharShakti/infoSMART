<div class="container-scroller">
  <!-- Main Navigation Bar -->
  <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
      <!-- Logo -->
      <a class="navbar-brand brand-logo" href="<?= base_url('dashboard') ?>">
        <h3>Pine Store</h3>
      </a>
      <!-- Mini Logo -->
      <a class="navbar-brand brand-logo-mini" href="<?= base_url('dashboard') ?>">
      </a>
    </div>

    <div class="navbar-menu-wrapper d-flex align-items-stretch">
      <!-- Mobile Menu Toggle -->
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
      </button>

      <!-- Right Navigation Items -->
      <ul class="navbar-nav navbar-nav-right">
        <!-- User Profile Dropdown -->
        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
            aria-expanded="false">
            <div class="nav-profile-img">
              <div style="padding:0 5px; color:black; font-size:20px; font-weight:bold; border-radius:100%  ; background-color:aqua; display:flex; justify-content:center; align-item:center"></div>

              <!-- <img src="<?= base_url() ?>assets/images/faces/face1.jpg" alt="image"> -->
              <span style="padding:10px 15px ; font-weight:bold; background-color:#04bf9d; color:white;border-radius:100%">
                <?php $userName = session()->get('user_name');
                echo $userName ? esc($userName[0]) : "<?=>";
                ?>
              </span>
            </div>

            <div class="nav-profile-text">
              <p class="mb-1 text-black">
                <?php
                $userName = session()->get('user_name');
                if (!$userName) {
                  header("Location: " . base_url('/'));
                  exit;
                }
                echo $userName ? esc($userName) : "<?=>";
                ?>
              </p>
            </div>
          </a>
          <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="<?= base_url('forgot-password') ?>">
              <i class="mdi mdi-cached me-2 text-success"></i> Forgot Password
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= base_url('/logout') ?>" id="">
              <i class="mdi mdi-logout me-2 text-primary"></i> Signout
            </a>
          </div>

        </li>

        <!-- Fullscreen Toggle -->
        <li class="nav-item d-none d-lg-block full-screen-link c-p">
          <a class="nav-link">
            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
          </a>
        </li>

        <!-- Logout Button -->
        <li class="nav-item nav-logout d-none d-lg-block c-p">
          <a class="nav-link" href="<?= base_url('logout') ?>">
            <i class="mdi mdi-power"></i>
          </a>
        </li>
      </ul>

      <!-- Mobile Menu Toggle for Small Screens -->
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
        data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>

  <!-- Main Content Wrapper -->
  <div class="container-fluid page-body-wrapper">
    <!-- Sidebar Navigation -->
    <?php $userRole = session()->get('user_role'); ?>

    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">

        <!-- Dashboard: Only for admin -->
        <?php if ($userRole === 'admin'): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard') ?>">
              <span class="menu-title">Admin Dashboard</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>
        <?php endif; ?>

        <!-- Manager Dashboard -->
        <?php if ($userRole === 'manager'): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('manager') ?>">
              <span class="menu-title">Dashboard</span>
              <i class="mdi mdi-speedometer menu-icon"></i>
            </a>
          </li>
        <?php endif; ?>

        <!-- All Employee: Only for admin -->
        <?php if ($userRole === 'admin'): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('allemployee') ?>">
              <span class="menu-title">Users</span>
              <i class="menu-icon fa fa-vcard"></i>
            </a>
          </li>
        <?php endif; ?>

        <!--Customer Dashoard: Only for customers -->
        <?php if ($userRole === 'customer'): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('customer/Dashboard') ?>">
              <span class="menu-title">Dashboard</span>
              <i class="fa fa-id-card mdi-package menu-icon"></i>
            </a>
          </li>
        <?php endif; ?>
        <!-- Inventory List: Only for customers -->
        <?php if ($userRole === 'customer'): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('inventorylist') ?>">
              <span class="menu-title">Inventory List</span>
              <i class="mdi  mdi-package menu-icon"></i>
            </a>
          </li>
        <?php endif; ?>

        <!-- pdf UPLOAD: Only for customers -->
        <?php if ($userRole === 'customer'): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('customer/upload-pdf') ?>">
              <span class="menu-title">PDF Upload</span>
              <i class="fa fa-book mdi-package menu-icon"></i>
            </a>
          </li>
        <?php endif; ?>




        <!-- Barcode: For admin and manager -->
        <?php if (in_array($userRole, ['admin'])): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('barcode/list') ?>">
              <span class="menu-title">Barcodes</span>
              <i class="fa fa-qrcode mdi-package menu-icon"></i>
            </a>
          </li>
        <?php endif; ?>

        <?php if (session()->get('user_role') === 'manager'): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('manager/barcodes') ?>">
              <span class="menu-title">Stored Barcodes</span>
              <i class="fa fa-barcode menu-icon"></i>
            </a>
          </li>
        <?php endif; ?>


        <!-- Inventory Report: Only for customer -->
        <?php if ($userRole === 'customer'): ?>
          <?php $customerId = session()->get('customer_id'); ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('inventoryreport/' . $customerId) ?>">
              <span class="menu-title">Inventory Report</span>
              <i class="fa fa-edit menu-icon"></i>
            </a>
          </li>
        <?php endif; ?>

        <!-- Warehouse: Only for admin -->
        <?php if ($userRole === 'admin'): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('warehouse') ?>">
              <span class="menu-title">Warehouse</span>
              <i class="menu-icon fa fa-home"></i>
            </a>
          </li>
        <?php endif; ?>

      </ul>
    </nav>